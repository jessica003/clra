 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>CLRA-Home</title>
  </head>
  <body>   
    <style>
        .modaltable tbody tr td{
            font-size:13px!important;
        }
        .navbar{
            background-color: #357EC7!important;
        }
        .navbar-nav li a,.navbar-brand{
            color:white!important;
        }
        .navbar-nav li .dropdown-item{
            color:black!important;
        }
    </style> 
      <nav class="navbar navbar-expand-lg navbar-light" style="padding-left: 3%">
          <a class="navbar-brand" href="">CLRA</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown" style="padding-left: 3%">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="">Dashboard</a>
              </li>
              <li class="nav-item dropdown" style="position: absolute;right: 5%">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ $data->user_name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="{{ route('auth.logout') }}" style="color:black!important">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
      </nav>
      <div class="container-fluid conaddform">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" data-dismiss="alert" >
                <p>{{ $message }}</p>
            </div>
        @endif 
        @if ($message = Session::get('error'))
            <div class="alert alert-danger" data-dismiss="alert" >
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('warning'))
            <div class="alert alert-warning" data-dismiss="alert" >
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered mt-5">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Audit #</th>
              <th scope="col">Date</th>
              <th scope="col">Client Name</th>
              <th scope="col">Site Name</th>
              <th scope="col">Audit Type</th>
              <th scope="col">From</th>
              <th scope="col">To</th>
              <th scope="col">Contractor Status</th>
              <th scope="col">Audit Status</th>
              <th scope="col">Documents</th>
            </tr>
          </thead>
          <tbody>
            @php $i=0; @endphp
            @foreach($auditlists as $auditlist)
            @php
             $i++;
             $auditDetails = \App\Models\AuditScheduler::find($auditlist->id);
             $fileExist = $auditDetails->auditFiles;
             $currentDate = date('Y-m-d');
             if((count($fileExist)==0)){
                if(($auditlist->date_of_audit)>$currentDate){
                  $contractorStatus = 'Scheduled';
                }else{                
                  $contractorStatus = 'Pending';
                }
                $auditStatus = '-';
             }else{
                if($auditDetails->contractor_status==1){
                  $contractorStatus = 'Uploaded';
                  if($auditDetails->auditor_status==0){
                    $auditStatus = 'Pending';
                  }elseif($auditDetails->auditor_status==1){
                    $auditStatus = 'Completed';
                  }else{                
                    $auditStatus = 'In Process';
                  }
                }
                elseif($auditDetails->contractor_status==2){
                  $contractorStatus = 'Reverted';
                  $auditStatus = 'In Process';
                }else{
                  $contractorStatus = 'In Process';
                  $auditStatus = '-';
                }
             }
            @endphp
            <tr>
              <td>{{$i}}</td>
              <td>100{{$auditlist->id}}</td>
              <td>{{date('d-m-Y', strtotime($auditlist->date_of_audit))}}</td>
              <td>{{$auditlist->company_name}}</td>
              <td>{{$auditlist->company_office_loc_name}}</td>
              <td>{{$auditlist->fk_audit_type_id==2 ? 'CLRA AUDIT' : 'INVOICE VERIFICATION'}}</td>
              <td>{{date('M-Y', strtotime($auditlist->audit_from))}}</td>
              <td>{{date('M-Y', strtotime($auditlist->audit_to))}}</td>
              <td>{{$contractorStatus}}</td>
              <td>{{$auditStatus}}</td>
              <td>
                @if((count($fileExist)==0))
                  @if(($auditlist->date_of_audit)>$currentDate)
                    -
                  @else               
                    <a class="btn btn-sm btn-primary addbtn addauditfile{{$auditlist->fk_audit_type_id}}" href="{{url('/contractor-add-iv/'.$auditlist->id.'/'.$auditlist->fk_audit_type_id)}}">Add</a>
                  @endif
                @else
                  @if($auditDetails->contractor_status==1)
                    <a class="btn btn-sm btn-primary viewbtn viewauditfile{{$auditlist->fk_audit_type_id}}" href="{{url('/contractor-view-iv/'.$auditlist->id.'/'.$auditlist->fk_audit_type_id)}}">View</a>
                  @elseif($auditDetails->contractor_status==2)
                    <a class="btn btn-sm btn-primary viewbtn viewauditfile{{$auditlist->fk_audit_type_id}}" href="{{url('/contractor-view-iv/'.$auditlist->id.'/'.$auditlist->fk_audit_type_id)}}">Update</a>
                  @else
                    <a class="btn btn-sm btn-primary viewbtn viewauditfile{{$auditlist->fk_audit_type_id}}" href="{{url('/contractor-view-iv/'.$auditlist->id.'/'.$auditlist->fk_audit_type_id)}}">Update</a>
                  @endif
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">INVOICE VERIFICATION AUDIT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="row container-fluid mt-3">
                  <div class="offset-md-1 col-md-5"><p class="clientname">CLIENT NAME :- CONTRACTOR 1 (BLR)</p></div>
                  <div class="offset-md-1 col-md-5"><p class="auditperiod">AUDIT PERIOD :- MAR-21 TO MAR-21</p></div>
              </div>
              <div class="modal-body">
                <table class="table table-bordered modaltable" style="font-size:12px!important;">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Particulars</th>
                      <th scope="col">Upload 1</th>
                      <th scope="col">Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Number of Contract Employees</td>
                      <td>5</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>CLRA Labour license</td>
                      <td><a href="https://clra.complyindia.com/assets/files/CLRA Labour license_Contractor 1 BLR.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>CLRA License Valid From & To</td>
                      <td>MAR-21 to MAR-21</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>Form V Issued by Principal Employer</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Form V Issued by Principal Employer Cintractor_1_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td>Service Agreement</td>
                      <td>-</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td>Register of Wages</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Register of Wages_blr.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td>EPF ECR</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PF_ECR_BANGALORE.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">8</th>
                      <td>EPF paid challan/TRRN</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PT pad Challan_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">9</th>
                      <td>ESI Contribution history</td>
                      <td><a href="https://clra.complyindia.com/assets/files/ESI Contribution history_BANGALORE.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">10</th>
                      <td>ESI double verification challan</td>
                      <td><a href="https://clra.complyindia.com/assets/files/ESI double verification challan_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">11</th>
                      <td>PT Paid Challan</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PT pad Challan_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">12</th>
                      <td>Register of PT deduction</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Register of PT deduction_blr.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">13</th>
                      <td>PT Return Copy</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PT Return_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">14</th>
                      <td>LWF Paid Challan</td>
                      <td><a href="https://clra.complyindia.com/assets/files/LWF Paid Receipt_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">15</th>
                      <td>Register of LWF deduction</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Register of LWF deduction_blr.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">16</th>
                      <td>LWF Return Copy</td>
                      <td><a href="https://clra.complyindia.com/assets/files/LWF Return Copy_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">INVOICE VERIFICATION AUDIT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="row container-fluid mt-3">
                  <div class="offset-md-1 col-md-5"><p class="clientname">CLIENT NAME :- CONTRACTOR 1 (MUMBAI)</p></div>
                  <div class="offset-md-1 col-md-5"><p class="auditperiod">AUDIT PERIOD :- JAN-21 TO JAN-21</p></div>
              </div>
              <div class="modal-body">
                <table class="table table-bordered modaltable" style="font-size:12px!important;">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Particulars</th>
                      <th scope="col">Upload 1</th>
                      <th scope="col">Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Number of Contract Employees</td>
                      <td>5</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>CLRA Labour license</td>
                      <td><a href="https://clra.complyindia.com/assets/files/CLRA Labour license_Contractor_1 MUM.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>CLRA License Valid From & To</td>
                      <td>JAN-21 to JAN-21</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>Form V Issued by Principal Employer</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Form V Issued by Principal Employer.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td>Service Agreement</td>
                      <td>-</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td>Register of Wages</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Register of Wages.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td>EPF ECR</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PF_ECR_Mumbai(1).pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">8</th>
                      <td>EPF paid challan/TRRN</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PT Paid Challan.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">9</th>
                      <td>ESI Contribution history</td>
                      <td><a href="https://clra.complyindia.com/assets/files/ESI Contribution history_Mumbai(1).pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">10</th>
                      <td>ESI double verification challan</td>
                      <td><a href="https://clra.complyindia.com/assets/files/ESI double verification challan.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">11</th>
                      <td>PT Paid Challan</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PT Paid Challan.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">12</th>
                      <td>Register of PT deduction</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Register of PT deduction.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">13</th>
                      <td>PT Return Copy</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PT_Return.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">14</th>
                      <td>LWF Paid Challan</td>
                      <td><a href="https://clra.complyindia.com/assets/files/LWF Paid Challan.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">15</th>
                      <td>Register of LWF deduction</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Register of LWF deduction.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">16</th>
                      <td>LWF Return Copy</td>
                      <td><a href="#" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    </script>
  </body>
</html>
