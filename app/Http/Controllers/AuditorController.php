<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\Contractor;
use App\Models\AuditScheduler;

class AuditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('user_id','=', session('LoggedUser'))->first();
        $companies = Company::join('companies_address','companies.id','companies_address.companies_id')
                    ->join('company_address_location_type','companies_address.company_address_id','company_address_location_type.company_address_id')
                    ->where('company_address_location_type.location_type_id',3)
                    // ->groupBy('companies.id')
                    ->get();
                    // dd($companies);
        return view('auditor.auditscheduler',compact('companies','data'));
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
        $audit_from = $request->auditfrom.'-01';
        $audit_to = $request->auditto.'-01';
        AuditScheduler::create(array_merge($request->all(), ['audit_from' => $audit_from,'audit_to' => $audit_to]));             
        return redirect()->route('auditscheduler.index')
                        ->with('success','Audit scheduled successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    public function conLoc(Request $request)
    {
        $locations = CompanyAddress::join('company_address_location_type','companies_address.company_address_id','company_address_location_type.company_address_id')
                                    ->where('companies_address.companies_id',$request->company_id)
                                    ->where('company_address_location_type.location_type_id',3)
                                    // ->groupBy('companies_address.company_address_id')
                                    ->get();
        $contractors = Contractor::join('companies','contractors.company_id','companies.id')
                                    ->join('users','contractors.user_id','users.user_id')
                                    ->where('contractors.company_id',$request->company_id)
                                    ->get();
        return Response::json(['locations' => $locations, 'contractors' => $contractors]);
    }
}
