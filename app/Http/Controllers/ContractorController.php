<?php

namespace App\Http\Controllers;

use Response;
use App\Models\User;
use App\Models\Company;
use Carbon\CarbonPeriod;
use App\Models\AuditFile;
use App\Models\Contractor;
use App\Models\AuditColumn;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AuditScheduler;
use App\Models\CompanyAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
       $created_by = User::where('user_id','=', session('LoggedUser'))->pluck('user_id')->first();
       foreach ($data as $key => $value) {
        // dump($key);
        // dump($value);
        preg_match_all('/[A-Z]/', $key, $matches, PREG_OFFSET_CAPTURE);
        if (count($matches[0])){
            $split = $matches[0][0][0];
            $reptxt = str_replace($split,'#'.$split,$key);
            $splittxt = explode('#',$reptxt);
            if ($value!='') {
                // dump('hello');
                $particular_date = date("Y-m-01", strtotime($splittxt[1]));
                if(str_starts_with($splittxt[0],"na")){
                    $splitna = explode('na',$splittxt[0]);
                    $dataExists = AuditFile::where('audit_id',$request->audit_id)
                                            ->where('particular_id',$splitna[1])->where('particular_date',$particular_date)->first();
                    $auditdata = ['audit_id'=> $request->audit_id,'particular_id'=> $splitna[1],'particular_date'=> $particular_date,'created_by'=>$created_by,'na'=>1];
                }else{
                    $dataExists = AuditFile::where('audit_id',$request->audit_id)
                                            ->where('particular_id',$splittxt[0])->where('particular_date',$particular_date)->first();
                    $auditdata = ['audit_id'=> $request->audit_id,'particular_id'=> $splittxt[0],'particular_date'=> $particular_date,'created_by'=>$created_by];
                }
                if ($request->file($key)!=''){
                    $file = $request->file($key)->getClientOriginalName();
                    $fileName = Str::random(10);
                    $file=$fileName.$file;
                    $path =$request->file($key)->storeAs('public/auditfiles', $file);
                    $auditFile = array_merge($auditdata, ['particular_file'=> $file]);
                }else{
                    if ($splittxt[0]==3 || $splittxt[0]==19) {
                        $daterange = explode(' ',$value);
                        $clra_from = date('Y-m-d',strtotime($daterange[0]));
                        $clra_to = date('Y-m-d',strtotime($daterange[2]));
                        $auditFile = array_merge($auditdata, ['clra_from'=> $clra_from,'clra_to'=> $clra_to]);
                    }else{
                        if ($value=='on') {
                            $value = NULL;
                        }
                        $auditFile = array_merge($auditdata, ['text_content'=> $value]);                        
                    }
                }
                if($dataExists){
                    $createdData = AuditFile::whereId($dataExists->id)->update($auditFile);
                }else{
                    $createdData = AuditFile::create($auditFile);                    
                }              
            }
        }
        if(str_starts_with($key,"remarks")){
            $splitremarks = explode('remarks',$key);
            $auditUpdate = AuditFile::where('audit_id',$request->audit_id)
                                    ->where('particular_id',$splitremarks[1])
                                    ->update(['remarks'=>$value]);
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
        if ($audittype=='1') {
            $auditTypeId = '1';
        }else{
            $auditTypeId = '2';
        }
        $auditDet= AuditScheduler::join('comply_live_db.users as dt','audit_schedulers.contractor_id','dt.user_id')
                                  ->where('audit_schedulers.id',$id)
                                  ->select('audit_schedulers.*','dt.user_name')
                                  ->get();
        foreach ($auditDet as $audit) {            
            $period = CarbonPeriod::create($audit->audit_from, '1 month', $audit->audit_to);
            $month = [];
            foreach ($period as $dt) {
                 array_push($month, $dt->format("M-Y"));
            }
        }
        $auditcol = DB::table('audit_columns')->where('fk_audit_type_id',$auditTypeId)->get();
        return view('layouts.contractoradd',compact('auditDet','auditcol','month','audittype','id'));
    }
    public function conviewiv(Request $request,$id,$audittype)
    {
        // $auditCol = DB::table('audit_columns')
        //                 ->where('fk_audit_type_id',$audittype)
        //                 ->get();
        // $auditDet= AuditScheduler::join('comply_live_db.users as dt','audit_schedulers.contractor_id','dt.user_id')
        //                           ->where('audit_schedulers.id',$id)
        //                           ->select('audit_schedulers.*','dt.user_name')
        //                           ->get();
        // foreach ($auditDet as $audit) {            
        //     $period = \Carbon\CarbonPeriod::create($audit->audit_from, '1 month', $audit->audit_to);
        //     $month = [];
        //     foreach ($period as $dt) {
        //          array_push($month, $dt->format("M-Y"));
        //     }
        // }
        // // // dd($month);
        // return view('layouts.contractorviewiv-old',compact('auditCol','month','auditDet','audittype'));
        
        $audits = AuditColumn::from('audit_columns as AC')
                    ->leftJoin('audit_schedulers as AUD', function ($join) {
                        $join->on('AC.fk_audit_type_id', '=', 'AUD.fk_audit_type_id');
                    })
                    ->leftJoin('audit_files as AF', function ($join) {
                        $join->on('AC.id', '=', 'AF.fk_audit_column_id')
                            ->on('AUD.id', '=', 'AF.fk_audit_scheduler_id')
                            ->whereBetween('AF.particular_date', [DB::raw('AUD.audit_from'), DB::raw('AUD.audit_to')]);
                            // ->orWhere('AF.particular_date', '=', DB::raw('AUD.audit_to'));
                    })
                    ->leftJoin('comply_live_db.users as USR', function ($join) {
                        $join->on('AUD.contractor_id', '=', 'USR.user_id');
                    })
                    ->select('AC.id as audit_col_id', 'AC.column_name', 'AUD.id as audit_sch_id', 'AF.*')
                    
                    ->where([
                        'AC.fk_audit_type_id'=> DB::raw('AUD.fk_audit_type_id'),
                        'AUD.id'=> $id,
                        'USR.user_id' => session('LoggedUser')
                    ])
                    ->orderBy('AC.id')
                    ->orderBy('AF.particular_date')
                    ->groupBy('AC.id','AF.particular_date')
                    ->get();
        // dd($audits);
        return view('layouts.contractorviewiv',compact('audits','audittype'));
    }
}


