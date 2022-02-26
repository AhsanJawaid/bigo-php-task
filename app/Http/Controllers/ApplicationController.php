<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Http\Requests\ApplicationRequest;

class ApplicationController extends Controller
{
    public function index(Request $request) 
    {
        $userId = $request->session()->get('user_id');
        $userRole = $request->session()->get('user_role');
        $this->_assign_data['UserRole'] = $userRole;
        $this->_assign_data['arrValues'] = \DB::table('applications as a')->leftJoin('users as u', 'u.id', 'a.user_id', false)->where('user_id', '=', $userId)->get();
        return view('application.index', $this->_assign_data);
    }

    public function add(Request $request) 
    {
        $userId = $request->session()->get('user_id');
        $this->_assign_data['UserId'] = $userId;
        $userRole = $request->session()->get('user_role');
        $this->_assign_data['UserRole'] = $userRole;
        return view('application.add', $this->_assign_data);
    }

    public function _add(ApplicationRequest $request) 
    {
        $file = new Application;
        if($request->file()) {
            $name = time().'_'.$request->file('resume')->getClientOriginalName();
            $filePath = $request->file('resume')->storeAs('uploads', $name, 'public');
            
            $file->user_id = $request->user_id;
            $file->profile_url = $request->profile_url;
            $file->cover_letter = $request->cover_letter;
            $file->resume = $name;
            $file->save();
        }

        return redirect('/my-applications')->with('success', "Application successfully submitted.");
    }

    public function update(Request $request, $id) 
    {
        $userId = $request->session()->get('user_id');
        $this->_assign_data['UserId'] = $userId;
        $userRole = $request->session()->get('user_role');
        $this->_assign_data['UserRole'] = $userRole;
        $this->_assign_data['ApplicationId'] = $id;
        $this->_assign_data['arrValues'] = \DB::table('applications')->where('user_id', '=', $userId)->where('id', '=', $id)->get();
        return view('application.update', $this->_assign_data);
    }

    public function _update(ApplicationRequest $request, $id) 
    {
        $file = new Application;
        if($request->file()) {
            $name = time().'_'.$request->file('resume')->getClientOriginalName();
            $filePath = $request->file('resume')->storeAs('uploads', $name, 'public');

            $file::where('id', $id)->update(['user_id'=>$request->user_id, 'profile_url'=>$request->profile_url, 'cover_letter'=>$request->cover_letter,'resume'=>$name]);
        }

        return redirect('/my-applications')->with('success', "Application successfully submitted.");
    }

    public function list(Request $request) 
    {
        $userRole = $request->session()->get('user_role');
        $this->_assign_data['UserRole'] = $userRole;
        $this->_assign_data['arrValues'] = \DB::table('applications as a')->select('a.*', 'u.username', 'u.email', 'u.user_role')->leftJoin('users as u', 'u.id', 'a.user_id', false)->where('status', '=', '1')->get();
        return view('application.list', $this->_assign_data);
    }

    public function _list(Request $request, $id, $status) 
    {
        Application::where('id', $id)->update(['status'=>$status]);
        return redirect('/applicants-list')->with('success', "Application successfully updated.");
    }
}
