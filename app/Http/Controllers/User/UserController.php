<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {

        if(User::authPermission('users-read'))
        {
            //        $employeeList = Employee::join('companies', 'company_id', '=', 'companies.id')->orderBy('employees.company_id', 'asc')->paginate(10);
            $employees = User::all();
            if(User::authRole('superadministrator'))
            {
                return View::make('Super.employeeIndex', compact('employees'));
            }
            if(User::authRole('administrator'))
            {
                return View::make('Admin.employeeIndex', compact('employees'));
            }
            if(User::authRole('user'))
            {
                return View::make('User.index');
            }
        }else
        {
            $this->SessionAlert();
            return View::make('welcome');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        if(User::authPermission('users-create'))
        {
            $companies = Company::all();
            if(User::authRole('administrator'))
            {
                return View::make('Admin.employeeCreate', compact('companies'));
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        if(User::authPermission('users-create'))
        {
            $employee = new User();
            $this->storeEmployee($employee);
            if(User::authRole('administrator'))
            {
                $this->SessionMessage();
                return View::make('Admin.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        if(User::authPermission('users-read'))
        {
            $user = User::findOrFail($id);
            if(User::authRole('user') && auth()->user()->id == $id)
            {
                return View::make('User.show', compact('user'));
            }
            if(User::authRole('administrator'))
            {
                return View::make('Admin.show', compact('user'));
            }
            if(User::authRole('superadministrator'))
            {
                return View::make('Super.employeeShow', compact('user'));
            }
            $this->SessionAlert();
            return View::make('welcome');

        }else
        {
            $this->SessionAlert();
            return View::make('welcome');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        if(User::authPermission('users-update'))
        {
            $employee = User::findOrFail($id);
            $companies = Company::all();
            if(User::authRole('user'))
            {
                return View::make('User.edit', compact('employee'));
            }
            if(User::authRole('administrator'))
            {
                return View::make('Admin.employeeEdit', compact('employee', 'companies'));
            }
            if(User::authRole('superadministrator'))
            {
                return View::make('Super.employeeEdit', compact('employee', 'companies'));
            }
        }else
        {
            $this->SessionAlert();
            return View::make('welcome');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function update(Request $request, $id)
    {
        if(User::authPermission('users-update'))
        {
            $employee = User::findOrFail($id);
            $this->updateEmployee($employee);
            if(User::authRole('user'))
            {
                $this->SessionMessage();
                return View::make('User.index');
            }
            if(User::authRole('administrator'))
            {
                $this->SessionMessage();
                return View::make('Admin.index');
            }
            if(User::authRole('superadministrator'))
            {
                $this->SessionMessage();
                return View::make('Super.employeeShow', compact('employee'));
            }
        }else
        {
            $this->SessionAlert();
            return View::make('welcome');
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function destroy($id)
    {
        if(User::authPermission('users-delete'))
        {
            $employee = User::findOrFail($id);
            $employee->delete();
            if(User::authRole('administrator'))
            {
                $this->SessionMessage();
                return View::make('Admin.index');
            }
        }

    }

    private function validateRequest()
    {
        return tap(request()->validate([
            'name' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'company_id' => 'sometimes|integer',
            'company_name' => 'sometimes|string',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password'
        ]), function (){
            if(request()->hasFile('photo')){
                request()->validate([
                    'image' => 'file|image|max:5000'
                ]);
            }
        });
    }


    private function storeEmployee($employee)
    {
        $this->validateRequest();
        $company = Company::findOrFail(request()->company_id);
        if (request()->has('photo')) {

            $employee->name = request()->name;
            $employee->lastName = request()->lastName;
            $employee->email = request()->email;
            $employee->phone = request()->phone;
            $employee->photo = request()->photo->hashName();
            $employee->password = Hash::make(request()->password);
            $employee->company_id = request()->company_id;
            $employee->company_name = $company->name;

            request()->photo->store('uploads', 'public');

        }else{

            $employee->name = request()->name;
            $employee->lastName = request()->lastName;
            $employee->email = request()->email;
            $employee->phone = request()->phone;
            $employee->company_id = request()->company_id;
            $employee->company_name = $company->name;
            $employee->password = Hash::make(request()->password);
        }
        $employee->save();
        $employee->attachRole(request()->role);
    }

    private function validateUpdate()
    {
        return tap(request()->validate([
            'name' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'company_id' => 'sometimes|integer',
            'company_name' => 'sometimes|string',
        ]), function (){
            if(request()->hasFile('photo')){
                request()->validate([
                    'image' => 'file|image|max:5000'
                ]);
            }
        });
    }

    private function updateEmployee($employee)
    {
        $this->validateUpdate();
        $company = Company::findOrFail(request()->company_id);
        if (request()->has('photo')) {

            $employee->name = request()->name;
            $employee->lastName = request()->lastName;
            $employee->email = request()->email;
            $employee->phone = request()->phone;
            $employee->photo = request()->photo->hashName();
            $employee->company_id = request()->company_id;
            $employee->company_name = $company->name;

            request()->photo->store('uploads', 'public');

        }else{

            $employee->name = request()->name;
            $employee->lastName = request()->lastName;
            $employee->email = request()->email;
            $employee->phone = request()->phone;
            $employee->company_id = request()->company_id;
            $employee->company_name = $company->name;
        }
        $employee->save();
    }

    private function SessionMessage(): void
    {
        Session::flash('message', 'Your Date Successfully Updated.');
    }

    private function SessionAlert(): void
    {
        Session::flash('alert', 'YOU DONT HAVE RIGHT TO ACCESS TO THIS INFORMATION.');
    }
}
