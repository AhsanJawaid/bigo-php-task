<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) 
    {
        $userRole = $request->session()->get('user_role');
        $this->_assign_data['UserRole'] = $userRole;
        return view('home.index', $this->_assign_data);
    }
}
