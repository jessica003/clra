<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AuditScheduler;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(){
        return view('auth.login');
    }

    function check(Request $request){
        //Validate requests
        $request->validate([
             'email'=>'required|email',
             'password'=>'required|min:5'
        ]);

        $credentials = array('email' =>$request->email,'password' => $request->password);
        $userInfo = User::where('email','=', $request->email)->first();

        if(!$userInfo)
        {
            return back()->with('fail','We do not recognize your email address');
        }
        else
        {
            //check password
            if(Hash::check($request->password, $userInfo->password))
            {
                $request->session()->put('LoggedUser', $userInfo->user_id);
                if($request->id==$userInfo->clra_role)
                {
                    if($userInfo->clra_role==1)
                    {
                        return redirect('/employer/dashboard');
                    }
                    elseif ($userInfo->clra_role==2) 
                    {
                        return redirect('/contractor/dashboard');
                    }
                    elseif($userInfo->clra_role==3)
                    {
                        return redirect('/auditor/dashboard');
                    }                    
                }
                else
                {
                   return back()->with('fail','You are not authorized user!'); 
                }
            }
            else
            {
                return back()->with('fail','Incorrect password');
            }
        }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/');
        }
    }

    function employerdashboard(){
        $data = ['LoggedUserInfo'=>User::where('user_id','=', session('LoggedUser'))->first()];
        return view('employer.dashboard', $data);
    }

    function contractordashboard(){
        $data = User::where('user_id','=', session('LoggedUser'))->first();
        $auditlists=AuditScheduler::join('comply_live_db.companies as dt1','audit_schedulers.company_id','dt1.id')                       ->join('comply_live_db.companies_address as dt2','audit_schedulers.site_id','dt2.company_address_id')
                                   ->join('comply_live_db.users as dt3','audit_schedulers.contractor_id','dt3.user_id')
                                   ->where('audit_schedulers.contractor_id',$data->user_id)
                                   ->select('audit_schedulers.*','dt1.company_name','dt2.company_office_loc_name','dt3.email')
                                   ->orderBy('audit_schedulers.id','desc')
                                   ->get();
        return view('contractor.dashboard',compact('data','auditlists'));
    }

    function auditordashboard(){
        $data = User::where('user_id','=', session('LoggedUser'))->first();            
        $auditlists=AuditScheduler::join('comply_live_db.companies as dt1','audit_schedulers.company_id','dt1.id')                       ->join('comply_live_db.companies_address as dt2','audit_schedulers.site_id','dt2.company_address_id')
                                   ->join('comply_live_db.users as dt3','audit_schedulers.contractor_id','dt3.user_id')
                                   ->select('audit_schedulers.*','dt1.company_name','dt2.company_office_loc_name','dt3.email')
                                   ->orderBy('audit_schedulers.id','desc')
                                   ->get();
        return view('auditor.dashboard',compact('data','auditlists'));
    }

}
