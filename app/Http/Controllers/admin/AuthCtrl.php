<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\adminpemda\Role;
use App\Models\adminpemda\User;

class AuthCtrl extends Controller
{
    //
    public function getLogin()
    {
    	return view('auth.login');
    }

    public function postLogin(Request $request)
    {
    	if (Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {
            
            if (Auth::user()->hasRole('Admin Pemda')) {
    		  return redirect()->route('adminpemda');
            }

            if (Auth::user()->hasRole('User Pemda 1')) {
                return redirect()->route('userpemda1');
            }

            if (Auth::user()->hasRole('User Pemda 2')) {
                return redirect()->route('userpemda2');
            }

            if (Auth::user()->hasRole('Admin OPD')) {
                return redirect()->route('adminopd');
            }

            if (Auth::user()->hasRole('User OPD 1')) {
                return redirect()->route('useropd1');
            }

            if (Auth::user()->hasRole('User OPD 2')) {
                return redirect()->route('useropd2');
            }

            if (Auth::user()->hasRole('User OPD Kegiatan 1')) {
                return redirect()->route('opdkegiatan1');
            }

            if (Auth::user()->hasRole('User OPD Kegiatan 2')) {
                return redirect()->route('opdkegiatan2');
            }
        
    	}
    	return redirect()->back();
    }

    public function getlogout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }

}
