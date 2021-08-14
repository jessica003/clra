<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{ asset('bootstrap-3.1.1/css/bootstrap.min.css') }}"> --}}
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
                <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
              </li>
              <li class="nav-item dropdown" style="position: absolute;right: 5%">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ $LoggedUserInfo['user_name'] }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
      </nav>
      <div class="container-fluid"> 
        <table class="table table-bordered mt-5">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Audit #</th>
              <th scope="col">Date</th>
              <th scope="col">Site Name</th>
              <th scope="col">Contractor Name</th>
              <th scope="col">Audit Type</th>
              <th scope="col">From</th>
              <th scope="col">To</th>
              <th scope="col">Contractor Status</th>
              <th scope="col">Audit Status</th>
              <th scope="col">Documents</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>CI/IN/BLR/343</td>
              <td>08-04-2021</td>
              <td>Bangalore</td>
              <td>Contractor 1</td>
              <td>Invoice Verification</td>
              <td>Mar-21</td>
              <td>Mar-21</td>
              <td>Uploaded</td>
              <td>Under Process</td>
              <td><button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">View</button></td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>CI/CL/CHN/421</td>
              <td>14-04-2021</td>
              <td>Chennai</td>
              <td>Contractor 1</td>
              <td>CLRA Audit</td>
              <td>Jan-21</td>
              <td>Mar-21</td>
              <td>Scheduled</td>
              <td>Pending</td>
              <td>-</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>CI/IN/MUM/007</td>
              <td>14-02-2021</td>
              <td>Mumbai</td>
              <td>Contractor 1</td>
              <td>Invoice Verification</td>
              <td>Jan-21</td>
              <td>Jan-21</td>
              <td>Uploaded</td>
              <td>Completed</td>
              <td><button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2">View</button></td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>CI/CL/MUM/873</td>
              <td>22-02-2021</td>
              <td>Mumbai</td>
              <td>Contractor 1</td>
              <td>CLRA Audit</td>
              <td>Jan-21</td>
              <td>Mar-21</td>
              <td>Scheduled</td>
              <td>Pending</td>
              <td>-</td>
            </tr>
            <tr>
              <th scope="row">5</th>
              <td>CI/CL/MUM/774</td>
              <td>08-01-2021</td>
              <td>Mumbai</td>
              <td>Contractor 2</td>
              <td>CLRA Audit</td>
              <td>Oct-20</td>
              <td>Dec-20</td>
              <td>Uploaded</td>
              <td>Incomplete Docs</td>
              <td><button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal3">View</button></td>
            </tr>
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
                      <th scope="col">Audit Check Points</th>
                      <th scope="col">Update by Contractor</th>
                      <th scope="col">Upload 1</th>
                      <th scope="col">Contractor Remarks</th>
                      <th scope="col">Compliance Status</th>
                      <th scope="col">Auditor Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>NA</td>
                      <td>Number of Contract Employees</td>
                      <td>5</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>NA</td>
                      <td>CLRA Labour license</td>
                      <td><a href="https://clra.complyindia.com/assets/files/CLRA Labour license_Contractor 1 BLR.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>NA</td>
                      <td>Form V Issued by Principal Employer</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Form V Issued by Principal Employer Cintractor_1_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Form V is attached</td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>NA</td>
                      <td>Service Agreement</td>
                      <td>-</td>
                      <td>-</td>
                      <td>Not-Complied</td>
                      <td>Service agreement is not shared by vendor</td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td>Whether attendance list is approved by Principal Employer?</td>
                      <td>Attendance list of all employees</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Attendance Report_blr.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Not-Complied</td>
                      <td>Confirmation email not shared</td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td>Whether Contractor Employee count matches with attendance list?</td>
                      <td>Attendance list of all employees</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Attendance Report_blr.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Employee count is matching</td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td>Whether the register contains details of Gross wages and respective deductions from wages?</td>
                      <td>Register of Wages</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Register of Wages_blr.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Not-Complied</td>
                      <td>Register of wages is not as per statutory format. Same to be shared in given format</td>
                    </tr>
                    <tr>
                      <th scope="row">8</th>
                      <td>Whether Contribution made is as per the PF Act?</td>
                      <td>EPF ECR</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PF_ECR_BANGALORE.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Deducted as per PF rate</td>
                    </tr>
                    <tr>
                      <th scope="row">9</th>
                      <td>Whether Contribution to all employees is made?</td>
                      <td>EPF ECR</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PF_ECR_BANGALORE.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Contribution deposited for all the eligible employees</td>
                    </tr>
                    <tr>
                      <th scope="row">10</th>
                      <td>Whether employee NCP days is as per attendance list?</td>
                      <td>EPF ECR</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PF_ECR_BANGALORE.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>NCP day is updated</td>
                    </tr>
                    <tr>
                      <th scope="row">11</th>
                      <td>Whether Monthly returns under the PF Act is submitted before due date?</td>
                      <td>EPF ECR</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PF_ECR_BANGALORE.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Paid before due date</td>
                    </tr>
                    <tr>
                      <th scope="row">12</th>
                      <td>Whether payments under the PF Act is submitted before due date?</td>
                      <td>EPF paid challan/TRRN</td>
                      <td><a href="https://clra.complyindia.com/assets/files/EPF paid challanTRRN_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Paid before due date</td>
                    </tr>
                    <tr>
                      <th scope="row">13</th>
                      <td>Whether Contribution to all eligible employees is made?</td>
                      <td>ESI Contribution List</td>
                      <td><a href="https://clra.complyindia.com/assets/files/ESI Contribution history_BANGALORE.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Partially Complied</td>
                      <td>Employee name Ram short contribution is deposited.Supplimantory payment to paid and proof to be shared</td>
                    </tr>
                    <tr>
                      <th scope="row">14</th>
                      <td>Whether employee worked days is as per attendance list?</td>
                      <td>ESI Contribution List</td>
                      <td><a href="https://clra.complyindia.com/assets/files/ESI Contribution history_BANGALORE.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Partially Complied</td>
                      <td>As per attendance report employee Ram worked for full month and ESIC contribution is deposited only for 10 days worked. Supplimetory challan to be deposited and proof to be shared</td>
                    </tr>
                    <tr>
                      <th scope="row">15</th>
                      <td>Whether Monthly returns under the ESI Act is submitted before due date?</td>
                      <td>ESI double verification challan</td>
                      <td><a href="https://clra.complyindia.com/assets/files/ESI double verification challan_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Not-Complied</td>
                      <td>Upload correct file before 11th June 2021. Uploaded file belongs to someother site</td>
                    </tr>
                    <tr>
                      <th scope="row">16</th>
                      <td>Whether payments under the PT Act is paid before due date?</td>
                      <td>PT Paid Challan</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PT pad Challan_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Paid before due date</td>
                    </tr>
                    <tr>
                      <th scope="row">17</th>
                      <td>Whether PT is deduction is as per Act?</td>
                      <td>Register of PT deduction</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Register of PT deduction_blr.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Deducted as per slab rate</td>
                    </tr>
                    <tr>
                      <th scope="row">18</th>
                      <td>Whether returns under the PT Act is submitted before due date?</td>
                      <td>PT Return Copy</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PT Return_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Return submitted before due date</td>
                    </tr>
                    <tr>
                      <th scope="row">19</th>
                      <td>Whether payments under the LWF Act is paid before due date?</td>
                      <td>LWF Paid Challan</td>
                      <td><a href="https://clra.complyindia.com/assets/files/LWF Paid Receipt_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>-</td>
                      <td>LWF deduction report and payment proof is not shared</td>
                    </tr>
                    <tr>
                      <th scope="row">20</th>
                      <td>Whether LWF is deduction is as per Act?</td>
                      <td>Register of LWF deduction</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Register of LWF deduction_blr.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>-</td>
                      <td>LWF deduction report and payment proof is not shared</td>
                    </tr>
                    <tr>
                      <th scope="row">21</th>
                      <td>Whether returns under the LWF Act is submitted before due date?</td>
                      <td>LWF Return Copy</td>
                      <td><a href="https://clra.complyindia.com/assets/files/LWF Return Copy_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>-</td>
                      <td>LWF deduction report and payment proof is not shared</td>
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
                      <th scope="col">Audit Check Points</th>
                      <th scope="col">Update by Contractor</th>
                      <th scope="col">Upload 1</th>
                      <th scope="col">Contractor Remarks</th>
                      <th scope="col">Compliance Status</th>
                      <th scope="col">Auditor Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>NA</td>
                      <td>Number of Contract Employees</td>
                      <td>5</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>NA</td>
                      <td>CLRA Labour license</td>
                      <td><a href="https://clra.complyindia.com/assets/files/CLRA Labour license_Contractor_1 MUM.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>NA</td>
                      <td>Form V Issued by Principal Employer</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Form V Issued by Principal Employer.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Form V is attached</td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>NA</td>
                      <td>Service Agreement</td>
                      <td>-</td>
                      <td>-</td>
                      <td>Not-Complied</td>
                      <td>Service agreement is not shared by vendor</td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td>Whether attendance list is approved by Principal Employer?</td>
                      <td>Attendance list of all employees</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Attendance Report.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Confirmation email shared</td>
                    </tr>
                    <tr>
                      <th scope="row">6</th>
                      <td>Whether Contractor Employee count matches with attendance list?</td>
                      <td>Attendance list of all employees</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Attendance Report.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Employee count is matching</td>
                    </tr>
                    <tr>
                      <th scope="row">7</th>
                      <td>Whether the register contains details of Gross wages and respective deductions from wages?</td>
                      <td>Register of Wages</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Register of Wages.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Yes</td>
                    </tr>
                    <tr>
                      <th scope="row">8</th>
                      <td>Whether Contribution made is as per the PF Act?</td>
                      <td>EPF ECR</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PF_ECR_Mumbai(1).pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Deducted as per PF rate</td>
                    </tr>
                    <tr>
                      <th scope="row">9</th>
                      <td>Whether Contribution to all employees is made?</td>
                      <td>EPF ECR</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PF_ECR_Mumbai(1).pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Partially Complied</td>
                      <td>For Employee Name Satish PF is deducted but not deposited</td>
                    </tr>
                    <tr>
                      <th scope="row">10</th>
                      <td>Whether employee NCP days is as per attendance list?</td>
                      <td>EPF ECR</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PF_ECR_Mumbai(1).pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Partially Complied</td>
                      <td>For Employee Name Satish PF is deducted but not deposited, NCP Days to be updated</td>
                    </tr>
                    <tr>
                      <th scope="row">11</th>
                      <td>Whether Monthly returns under the PF Act is submitted before due date?</td>
                      <td>EPF ECR</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PF_ECR_Mumbai(1).pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Partially Complied</td>
                      <td>For Employee Name Satish PF is deducted but not deposited</td>
                    </tr>
                    <tr>
                      <th scope="row">12</th>
                      <td>Whether payments under the PF Act is submitted before due date?</td>
                      <td>EPF paid challan/TRRN</td>
                      <td><a href="https://clra.complyindia.com/assets/files/EPF paid challanTRRN.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Partially Complied</td>
                      <td>For Employee Name Satish PF is deducted but not deposited</td>
                    </tr>
                    <tr>
                      <th scope="row">13</th>
                      <td>Whether Contribution to all eligible employees is made?</td>
                      <td>ESI Contribution List</td>
                      <td><a href="https://clra.complyindia.com/assets/files/ESI Contribution history_Mumbai(1).pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Contribution deposited for all the eligible employees</td>
                    </tr>
                    <tr>
                      <th scope="row">14</th>
                      <td>Whether employee worked days is as per attendance list?</td>
                      <td>ESI Contribution List</td>
                      <td><a href="https://clra.complyindia.com/assets/files/ESI Contribution history_Mumbai(1).pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Yes</td>
                    </tr>
                    <tr>
                      <th scope="row">15</th>
                      <td>Whether Monthly returns under the ESI Act is submitted before due date?</td>
                      <td>ESI double verification challan</td>
                      <td><a href="https://clra.complyindia.com/assets/files/ESI double verification challan.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Not-Complied</td>
                      <td>Paid 1 day delay, Interest to be paid and proof required for the same</td>
                    </tr>
                    <tr>
                      <th scope="row">16</th>
                      <td>Whether payments under the PT Act is paid before due date?</td>
                      <td>PT Paid Challan</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PT Paid Challan.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Paid before due date</td>
                    </tr>
                    <tr>
                      <th scope="row">17</th>
                      <td>Whether PT is deduction is as per Act?</td>
                      <td>Register of PT deduction</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Register of PT deduction.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Deducted as per slab rate</td>
                    </tr>
                    <tr>
                      <th scope="row">18</th>
                      <td>Whether returns under the PT Act is submitted before due date?</td>
                      <td>PT Return Copy</td>
                      <td><a href="https://clra.complyindia.com/assets/files/PT_Return.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Non-Complied</td>
                      <td>Return filed after due date; Interest to be paid and proof required for the same</td>
                    </tr>
                    <tr>
                      <th scope="row">19</th>
                      <td>Whether payments under the LWF Act is paid before due date?</td>
                      <td>LWF Paid Challan</td>
                      <td><a href="https://clra.complyindia.com/assets/files/LWF Paid Challan.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Complied</td>
                      <td>Paid before due date</td>
                    </tr>
                    <tr>
                      <th scope="row">20</th>
                      <td>Whether LWF is deduction is as per Act?</td>
                      <td>Register of LWF deduction</td>
                      <td><a href="https://clra.complyindia.com/assets/files/Register of LWF deduction.xlsx" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Partially Complied</td>
                      <td>Some employees, deducted excess, to be refunded to employee</td>
                    </tr>
                    <tr>
                      <th scope="row">21</th>
                      <td>Whether returns under the LWF Act is submitted before due date?</td>
                      <td>LWF Return Copy</td>
                      <td><a href="https://clra.complyindia.com/assets/files/LWF Return Copy_blr.pdf" class="btn btn-success btn-sm" target="_blank">view</a></td>
                      <td>-</td>
                      <td>Partially Complied</td>
                      <td>Deduction details to be corrected</td>
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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>