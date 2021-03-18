<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
        if(auth()->user()->hasRole('user'))
        {
            return View::make('User.index');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        if(auth()->user()->hasRole('user'))
        {
            return View::make('User.show', compact('user'));
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
        $employee = User::findOrFail($id);
        if(auth()->user()->hasRole('user'))
        {
            return View::make('User.edit', compact('employee'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $employee = User::findOrFail($id);
        $this->storeEmployee($employee);
        if(auth()->user()->hasRole('user'))
        {
            Session::flash('message', 'Your Date Successfully Updated.');
            return redirect()->route('User.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        if (request()->has('photo')) {

            $employee->name = request()->name;
            $employee->lastName = request()->lastName;
            $employee->email = request()->email;
            $employee->phone = request()->phone;
            $employee->photo = request()->photo->hashName();
            $employee->company_id = request()->company_id;
            $employee->company_name = request()->company_name;

            request()->photo->store('uploads', 'public');

        }else{

            $employee->name = request()->name;
            $employee->lastName = request()->lastName;
            $employee->email = request()->email;
            $employee->phone = request()->phone;
            $employee->company_id = request()->company_id;
            $employee->company_name = request()->company_name;
        }
        $employee->save();
    }
}
