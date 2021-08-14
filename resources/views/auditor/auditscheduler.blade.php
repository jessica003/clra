<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>CLRA-Home</title>
  </head>
  <body>
      <style>
        .navbar{
          background-color: #357EC7!important;
        }
        .navbar-nav li a,.navbar-brand{
          color:white!important;
        }
        .navbar-nav li .dropdown-item{
          color:black!important;
        }
        .blackborder{
          border: 1px solid black;
        }
        .activemenu .nav-link{
          background-color: white;
          color: black!important;
        } 
      </style>
      <nav class="navbar navbar-expand-lg navbar-light" style="padding-left: 3%">
          <a class="navbar-brand" href="">CLRA</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown" style="padding-left: 3%">
            <ul class="navbar-nav" id="navlist">
              <li class="nav-item">
                <a class="nav-link" aria-current="page"  href="{{ url('auditor/dashboard') }}">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="">Audit Scheduler</a>
              </li>
              <li class="nav-item dropdown" style="position: absolute;right: 5%">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ $data->user_name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
      </nav>
      <div class="container mt-5">
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
        <div class="card blackborder">
          <div class="card-body">
            <form action="{{ route('auditscheduler.store') }}" method="POST">
              @csrf
              <div class="row">
                <input type="hidden" name="created_by" value="{{ $data->user_id }}">
                <div class="form-group col-md-4">
                  <label for="inputClient">Client Name <span style="color:red;">*</span></label>
                  <select id="inputClient" class="form-control blackborder" name="company_id" required>
                    <option value="">Choose Company</option>
                    @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->company_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputSite">Site Name <span style="color:red;">*</span></label>
                  <select id="inputSite" class="form-control blackborder" name="site_id" required>
                    <option value="">Choose Site</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputContractor">Contractor Name <span style="color:red;">*</span></label>
                  <select id="inputContractor" class="form-control blackborder" name="contractor_id" required>
                    <option value="">Choose Contractor</option>
                  </select>
                </div>
              </div>
              <div class="row mt-4">                
                <div class="form-group col-md-3">
                  <label for="inputaudit">Date of audit <span style="color:red;">*</span></label>
                  <input type="date" class="form-control blackborder" id="inputaudit" name="date_of_audit" min="<?php echo date('Y-m-d');?>" required>
                </div>
                <div class="form-group col-md-3">
                  <label for="inputaudittype">Audit Type <span style="color:red;">*</span></label>
                  <select id="inputaudittype" class="form-control blackborder" name="audit_type" required>
                    <option value="">Choose Type</option>
                    <option value="clraaudit">CLRA Audit</option>
                    <option value="invoiceverification">Invoice Verification</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="inputauditfrom">Audit From <span style="color:red;">*</span></label>
                  <input type="month" class="form-control blackborder" id="inputauditfrom" name="auditfrom" max="<?php echo date('Y-m');?>" required>
                </div>
                <div class="form-group col-md-3">
                  <label for="inputauditto">Audit To <span style="color:red;">*</span></label>
                  <input type="month" class="form-control blackborder" id="inputauditto" name="auditto" max="<?php echo date('Y-m');?>" required>
                </div>
              </div>
              <div class="row text-center">                
                <div class="form-group col-md-12">                  
                  <button type="submit" class="btn btn-sm mt-4" style="background-color: #357EC7;color: white;">Schedule</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    @include('layouts.csrf-js')
    $(document).ready(function(){
      $("#inputClient").change(function(){
        var company_id = $("#inputClient").val();
        $.ajax({
            url: '/contractor-location',
            type: "POST",
            data: { company_id: company_id },
            dataType: 'JSON',
        }).done(function (data) {
            console.log(data);
            $("#inputSite").html('');
            $("#inputContractor").html('');
            if (data.locations.length > 0) {
                if (data.locations.length>1) {
                    $("#inputSite").append('<option value="">Choose Location</option>');
                }
                data.locations.forEach(function(msg){
                    $("#inputSite").append("<option value=" +msg.company_address_id + ">" + msg.company_office_loc_name + "</option>");
                }); 
            }
            if (data.contractors.length > 0) {
                if (data.contractors.length>1) {
                    $("#inputContractor").append('<option value="">Choose Contractor</option>');
                }
                data.contractors.forEach(function(msg2){
                    $("#inputContractor").append("<option value=" +msg2.user_id + ">" + msg2.email + "</option>");
                }); 
            }
            else{
                    $("#inputContractor").html('<option value="">No Contractor found</option>');
            }
        });
      });
      
      var CurrentUrl = window.location.origin+window.location.pathname;
       $('#navlist li a').each(function(Key,Value)
          {
            if(Value['href'] === CurrentUrl)
            {
                $(Value).parent().addClass('activemenu');
            }
            //   $(".activemenu .nav-link").css('padding','13.5%');
              $(".activemenu .nav-link").css('background-color','#fff');
          });
    });
    </script>
  </body>
</html>