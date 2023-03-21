<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function dashboardRedirect(): RedirectResponse
    {
        //Admin
        if(Auth()->user()->getIsAdminAttribute()){
            return redirect()->route('admin.dashboard');
        }
        //User
        else{
            return redirect()->route('user.dashboard');
        }
    }

    public function userDashboard(): Response
    {
        return Inertia::render('Dashboard');
    }
}
