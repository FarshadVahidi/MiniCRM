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
        $a = auth()->user();
        if($a->hasPermission('users-read'))
        {
            //        $employeeList = Employee::join('companies', 'company_id', '=', 'companies.id')->orderBy('employees.company_id', 'asc')->paginate(10);
            $employees = User::all();
            if($a->hasRole('administrator'))
            {
                return View::make('Admin.employeeIndex', compact('employees'));
            }
            if($a->hasRole('user'))
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
        $a = auth()->user();
        if($a->hasPermission('users-create'))
        {
            $companies = Company::all();
            if($a->hasRole('administrator'))
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
        $a = auth()->user();
        if($a->hasPermission('users-create'))
        {
            $employee = new User();
            $this->storeEmployee($employee);
            if($a->hasRole('administrator'))
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
        $a = auth()->user();
        if($a->hasPermission('users-read'))
        {
            $user = User::findOrFail($id);
            if($a->hasRole('user'))
            {
                return View::make('User.show', compact('user'));
            }
            if($a->hasRole('administrator'))
            {
                return View::make('Admin.show', compact('user'));
            }
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
        $a = auth()->user();
        if($a->hasPermission('users-update'))
        {
            $employee = User::findOrFail($id);
            if($a->hasRole('user'))
            {
                return View::make('User.edit', compact('employee'));
            }
            if($a->hasRole('administrator'))
            {
                $companies = Company::all();
                return View::make('Admin.employeeEdit', compact('employee', 'companies'));
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
        $a = auth()->user();
        if($a->hasPermission('users-update'))
        {
            $employee = User::findOrFail($id);
            $this->updateEmployee($employee);
            if($a->hasRole('user'))
            {
                $this->SessionMessage();
                return View::make('User.index');
            }
            if($a->hasRole('administrator'))
            {
                $this->SessionMessage();
                return View::make('Admin.index');
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
        $a = auth()->user();
        if($a->hasPermission('users-delete'))
        {
            $employee = User::findOrFail($id);
            $employee->delete();
            if($a->hasRole('administrator'))
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
