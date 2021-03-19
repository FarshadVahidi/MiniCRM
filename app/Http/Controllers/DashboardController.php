<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function authUser()
    {
        if(auth()->user()->hasRole('user'))
        {
            return view('User.index');
        }

        if(auth()->user()->hasRole('administrator'))
        {
            return view('Admin.index');
        }

        if(User::authRole('superadministrator'))
        {
            return View::make('Super.index');
        }
        else
        {
            Session::flash('danger', 'YOU DO NOT RIGHT TO HAVE ACCESS TO THIS SECTION.');
            return View::make('dashboard');
        }
    }
}
