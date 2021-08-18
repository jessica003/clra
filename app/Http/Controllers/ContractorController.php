<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Response;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\Contractor;
use App\Models\AuditScheduler;
use App\Models\AuditFile;
use Illuminate\Support\Str;

class ContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
       $data = $request->all();
       dd($data);
       $created_by = User::where('user_id','=', session('LoggedUser'))->pluck('user_id')->first();
       foreach ($data as $key => $value) {
        preg_match_all('/[A-Z]/', $key, $matches, PREG_OFFSET_CAPTURE);
        if (count($matches[0])){
            $split = $matches[0][0][0];
            $reptxt = str_replace($split,'#'.$split,$key);
            $splittxt = explode('#',$reptxt);
            if ($value!='') {
                $particular_date = date("Y-m-01", strtotime($splittxt[1]));
                // dump($splittxt[0]);
                if(str_starts_with($splittxt[0],"na")){
                    $splitna = explode('na',$splittxt[0]);
                    $auditdata = ['audit_id'=> $request->audit_id,'particular_id'=> $splitna[1],'particular_date'=> $particular_date,'created_by'=>$created_by,'na'=>1];
                }else{
                    $auditdata = ['audit_id'=> $request->audit_id,'particular_id'=> $splittxt[0],'particular_date'=> $particular_date,'created_by'=>$created_by];
                }
                if ($request->file($key)!='') {
                    $file = $request->file($key)->getClientOriginalName();
                    $fileName = Str::random(10);
                    $file=$fileName.$file;
                    $path =$request->file($key)->storeAs('public/auditfiles', $file);
                    $auditFile = array_merge($auditdata, ['clra_from'=> '2021-08-11','clra_to'=> '2021-08-11',           'particular_file'=> $file]);
                }else{
                    $auditFile = array_merge($auditdata, ['clra_from'=> '2021-08-11','clra_to'=> '2021-08-11','text_content'=> $value]);
                }
                $createdData = AuditFile::create($auditFile);              
            }
        }
       }
       if ($createdData) {
           AuditScheduler::whereId($request->audit_id)->update(['contractor_status'=>$request->status]);
       }
       return back();
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
    public function conaddiv($id,$audittype)
    {
        if ($audittype=='invoiceverification') {
            $auditTypeId = '1';
        }else{
            $auditTypeId = '2';
        }
        $auditDet= AuditScheduler::join('comply_live_db.users as dt','audit_schedulers.contractor_id','dt.user_id')
                                  ->where('audit_schedulers.id',$id)
                                  ->select('audit_schedulers.*','dt.user_name')
                                  ->get();
        foreach ($auditDet as $audit) {            
            $period = \Carbon\CarbonPeriod::create($audit->audit_from, '1 month', $audit->audit_to);
            $month = [];
            foreach ($period as $dt) {
                 array_push($month, $dt->format("M-Y"));
            }
        }
        $auditcol = DB::table('audit_columns')->where('audit_type_id',$auditTypeId)->get();
        return view('layouts.contractoradd',compact('auditDet','auditcol','month','audittype','id'));
    }
    public function conviewiv(Request $request,$id)
    { 
        $auditCol = DB::table('audit_columns')
                        ->where('audit_type_id',1)
                        ->get();
        $auditDet= AuditScheduler::join('comply_live_db.users as dt','audit_schedulers.contractor_id','dt.user_id')
                                  ->where('audit_schedulers.id',$id)
                                  ->select('audit_schedulers.*','dt.user_name')
                                  ->get();
        foreach ($auditDet as $audit) {            
            $period = \Carbon\CarbonPeriod::create($audit->audit_from, '1 month', $audit->audit_to);
            $month = [];
            foreach ($period as $dt) {
                 array_push($month, $dt->format("M-Y"));
            }
        }
        // dd($month);
        return view('layouts.contractorviewiv',compact('auditCol','month','auditDet'));
    }
}


