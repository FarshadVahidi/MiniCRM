<?php

namespace App\Http\Controllers;

use App\Events\NewCompanyHasRegistered;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $a = auth()->user();
        if($a->hasPermission('company-read'))
        {
            $companies = Company::all();
            if($a->hasRole('administrator'))
            {
                return View::make('Admin.companyShow', compact('companies'));
            }
        }else
        {
            Session::flash('alert', 'YOU DONT HAVE RIGHT TO ACCESS TO THIS INFORMATION.');
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
        if($a->hasPermission('company-create'))
        {
            if($a->hasRole('administrator'))
            {
                return View::make('Admin.companyCreate');
            }
        }else
        {
            Session::flash('alert', 'YOU DONT HAVE RIGHT TO ACCESS TO THIS INFORMATION.');
            return View::make('welcome');
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
        if($a->hasPermission('company-create'))
        {
            $co = new Company();
            $company = $this->storeCompany($co);
            $company->save();
            return View::make('Admin.company', compact('company'));
        }else
        {
            Session::flash('alert', 'YOU DONT HAVE RIGHT TO ACCESS TO THIS INFORMATION.');
            return View::make('welcome');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return string
     */
    public function show($id)
    {
        $a = auth()->user();
        if($a->hasPermission('company-read'))
        {
            $company = Company::findOrFail($id);
            if ($a->hasRole('user')) {
                return View::make('User.company', compact('company'));
            }
            if ($a->hasRole('administrator'))
            {
                return View::make('Admin.company', compact('company'));
            }
        }else{
            Session::flash('alert', 'YOU DONT HAVE RIGHT TO ACCESS TO THIS INFORMATION.');
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
        if($a->hasPermission('company-update'))
        {
            $company = Company::findOrFail($id);
            if($a->hasRole('administrator')){
                return View::make('Admin.companyEdit', compact('company'));
            }
        }else
        {
            Session::flash('alert', 'YOU DONT HAVE RIGHT TO ACCESS TO THIS INFORMATION.');
            return View::make('welcome');
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
        $a = auth()->user();
        if($a->hasPermission('company-update'))
        {
            $company = Company::findOrFail($id);
            $this->storeCompany($company);
            if($a->hasRole('administrator'))
            {
                Session::flash('message', 'Company Update Successfully.');
                return Redirect::to('Company/'.$company->id);
            }
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
            'name' => 'required|min:3',
            'email' => 'required|email',
            'website' => ['sometimes', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
        ]), function (){
            if(request()->hasFile('image')){
                request()->validate([
                    'image' => 'file|image|max:5000'
                ]);
            }
        });
    }

    private function storeCompany($company)
    {
        $this->validateRequest();
        if (request()->has('image')) {

            $company->name = request()->name;
            $company->email = request()->email;
            $company->website = request()->website;
            $company->image = request()->image->hashName();

            request()->image->store('uploads', 'public');
        }else{

            $company->name = request()->name;
            $company->email = request()->email;
            $company->website = request()->website;

        }
        $company->save();
        return $company;
    }
}
