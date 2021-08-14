<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Home</title>
    <style>
        body{
            overflow-x: hidden;font-family: Roboto;
        }
        .card{
            min-height: 450px;
        }
        .fs-14{
           font-size: 14px; 
        }
        .nav-item{
            width: 11rem; text-align: center; font-size: 14px;
        }
        .nav-line{
            margin-top: 8px;
        }
        ul li a{
            color: #000;
        }
        ul .active  a{
            color: rgba(255, 0, 0, 0.78);
        }
        footer{
            height: 10%;background: linear-gradient(180deg, rgba(255, 255, 255, 0.42) 0%, rgba(248, 255, 170, 0.42) 48.96%, rgba(0, 178, 189, 0.42) 100%);
        }
        @media only screen and (max-width: 991px) {
          .nav-line{
            display: none;
          }
          .mainlogo{
            text-align: center;
          }
          #navbarNav{
            background: whitesmoke; margin-top: 1%;
          }
          .nav-item{
            text-align: justify; padding-left: 10%; width: 100%;
          }
        }
    </style>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row" style="max-height: 93px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 mainlogo">
              <a href="">
                <img class="img-fluid" src="images/logoci.png" width="90" alt="">
              </a>              
            </div>
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-6 mt-3">
                <div class="row fs-14 topsub">
                    <div class="col-lg-12 col-md-12 text-center">
                        <label for="subscriber" style="color: grey"><span style="color: red">Complyindia's</span> INTEGRATED AI TOOL TO MANAGE CONTRACTOR AUDITS</label>
                    </div>
                </div>
                <div class="row">
                    <nav class="navbar navbar-expand-lg pt-2" style="z-index: 1;">
                      <!-- <button class="navbar-toggler bg-dark text-white" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                      </button> -->
                      <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav fs-14 font-weight-bold">
                          <li class="nav-item active">
                            <p class="nav-link">250+ Audit checks</p>
                          </li>
                          <div class="nav-line">|</div>
                          <li class="nav-item">
                            <p class="nav-link">100% Verification</p>
                          </li>
                          <div class="nav-line">|</div>
                          <li class="nav-item">
                            <p class="nav-link">Contractor Login</p>
                          </li>
                          <div class="nav-line">|</div>
                          <li class="nav-item">
                            <p class="nav-link">Compliance Certificate</p>
                          </li>
                          <div class="nav-line">|</div>
                          <li class="nav-item">
                            <p class="nav-link">Audit Dashboard</p>
                          </li>
                          <div class="nav-line">|</div>
                          <li class="nav-item">
                            <p class="nav-link">Auto Scheduler</p>
                          </li>
                        </ul>
                      </div>
                    </nav>    
                </div>
            </div>
        </div>
    </div>
    <div class="main" style="background: url('images/main_bg.png') no-repeat center;  height: 100%; background-size: 100% 100%;">
        <div class="container" style="padding-bottom: 100%;padding-top: 8%">
            @if ($message = Session::get('fail'))
                <div class="alert alert-danger" data-dismiss="alert" >
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row" style="">
                <div class="col-lg-4 col-md-4 mb-5">
                    <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <div class="card-body text-center">
                            <img src="images/employer.png" alt="" width="120px">
                            <p style="margin-top: -5%"><b>EMPLOYER</b><br>Login</p>
                            @include('auth.employerlogin')                
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 mb-5">
                    <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <div class="card-body text-center">
                            <img src="images/contractor.png" alt="" width="110px" height="110px">
                            <p style="margin-top: -5%"><b>CONTRACTOR</b><br>Login</p>
                            @include('auth.contractorlogin')                
                        </div>
                    </div>
                </div>
                <div class=" col-lg-4 col-md-4 mb-5">
                    <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <div class="card-body text-center">
                            <img src="images/auditor.png" alt="" width="110px" height="110px">
                            <p style="margin-top: -5%"><b>Auditor</b><br>Login</p>
                            @include('auth.auditorlogin')                   
                        </div>
                    </div>
                </div>            
            </div>
        </div>        
    </div>
    <footer>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="row text-center">
                    <div class="col-md-12 mt-4">
                        <a href=""><img class="img-fluid" src="images/logoci.png" width="90" alt=""></a> 
                    </div>             
                </div> 
                <div class="row text-center">
                   <div class="col-md-12">
                        <a href=""><img class="img-fluid" src="images/tool.png" width="180" alt=""></a> 
                    </div>             
                </div> 
            </div>
            <div class="col-md-4 mb-3">
                <p class="fs-14 font-weight-bold">QUICK LINKS</p>
                <a href="" class="text-dark fs-14">250+ Audit checks</a><br>
                <a href="" class="text-dark fs-14">100% Verification</a><br>
                <a href="" class="text-dark fs-14">Contractor Login</a><br>
                <a href="" class="text-dark fs-14">Compliance Certificate</a><br>
                <a href="" class="text-dark fs-14">Audit Dashboard</a><br>
                <a href="" class="text-dark fs-14">Auto Scheduler</a>
            </div>
            <div class="col-md-4 mb-3">
                <p class="fs-14 font-weight-bold">CONTACT INFO</p>
                <p><i class="fa fa-map-marker"></i> #252, 14th Cross, Sector A, Newtown,<br> Yelahanka, Bengaluru, Karnataka-560064</p>
                <p><i class="fa fa-phone"></i> +91 8043944566</p>
                <p><i class="fa fa-envelope"></i> contactus@complyindia.com</p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
      /*hide alert after 5 seconds*/
      $("#message").show().delay(5000).fadeOut();
      
    </script>
  </body>
</html>