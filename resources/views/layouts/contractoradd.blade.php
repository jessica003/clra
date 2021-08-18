<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<title>CLRA-Home</title>
</head>
<body>   
<style>
	.particulars:first-child
	{
	  position:sticky;
	  left:0px;
	  background-color:whitesmoke;
	}
	input[type=text],input[type=file],input[type=date]{
		width: 100%;
	}
</style>
<form action="{{ route('contractor.store') }}" method="POST" enctype='multipart/form-data' class="formiv">	
	@csrf
	<div class="card mt-3">
		<div class="card-header text-center">
			{{$audittype == 'clraaudit' ? 'CLRA AUDIT' :'INVOICE VERIFICATION AUDIT'}}
		</div>
		<div class="card-body" style="padding: 7px 1rem;">
			@foreach($auditDet as $audit)
				<p>Client Name: {{$audit->user_name}}<br>Audit Period: {{date('M-Y', strtotime($audit->audit_from))}} - {{date('M-Y', strtotime($audit->audit_to))}}</p><hr>
			@endforeach			
			<input type="hidden" name="audit_id" class="audit_id" value="{{$id}}">
			<input type="hidden" name="status" class="contractorstatus" value="">
			<table class="table table-bordered table-responsive">
				<thead>
					<th style="text-align:left; width: 250px;" class="particulars">Particulars</th>
					@foreach($month as $m)
					<th style="text-align:left; width: 180px;">Upload 1 ({{$m}})</th>
					@endforeach
					<th>Remarks</th>
				</thead>
				<tbody>
					@foreach($auditcol as $audit)
					<tr>
						<th style="text-align:left;" class="particulars">{{$audit->column_name}}</td>
						@foreach($month as $m)
						<td style="text-align:left">
							@if($audit->id=='1'||$audit->id=='17')						
							<input type="text" name="{{$audit->id.$m}}" class="empnum">
							@elseif($audit->id=='2'||$audit->id=='4'||$audit->id=='18'||$audit->id=='20'||$audit->id=='53'||$audit->id=='56'||$audit->id=='57'||$audit->id=='58'||$audit->id=='59'||$audit->id=='64'||$audit->id=='65'||$audit->id=='66'||$audit->id=='67'||$audit->id=='68'||$audit->id=='69'||$audit->id=='70'||$audit->id=='84'||$audit->id=='85'||$audit->id=='86')
								<input type="file" name="{{$audit->id.$m}}" class="{{$audit->id.$m}} infile" data-id="{{$audit->id.$m}}">
								<input type="checkbox" name="na{{$audit->id.$m}}" class="na{{$audit->id.$m}} na" data-id="{{$audit->id.$m}}">
								<label for="na" class="na{{$audit->id.$m}}">NA</label>
							@elseif($audit->id=='3'||$audit->id=='19')
								<input type="text" class="blackborder mt-1" name="datefilter">
							@elseif($audit->id=='37')							
								<div class="radio">
								  <label><input type="radio" name="{{$audit->id.$m}}" value="We Provide">We Provide</label>
								</div>
								<div class="radio">
								  <label><input type="radio" name="{{$audit->id.$m}}" value="Principal Employer Provides">Principal Employer Provides</label>
								</div>
							@else
							<input type="file" name="{{$audit->id.$m}}" class="{{$audit->id.$m}} infile reqfile" data-id="{{$audit->id.$m}}">
							@endif
						</td>
						@endforeach
						<td><textarea rows="1" style="width:100%"></textarea></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="save_sub mt-2 mb-4 text-center">	
		<a class="btn btn-sm btn-secondary" href="{{ url('/contractor/dashboard') }}">cancel</a>
		<a class="btn btn-sm btn-warning savebtn">save</a>
		<a class="btn btn-sm btn-primary submitbtn">Final submit</a>	
	</div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
	$(function() {
	  $('input[name="datefilter"]').daterangepicker({
	      autoUpdateInput: false,
	      locale: {
	          cancelLabel: 'Clear'
	      }
	  });
	  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
	      $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
	  });
	  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
	      $(this).val('');
	  });
	});
	$(".na").on("click", function(){
	  var dataId = $(this).attr("data-id");
	  var month = dataId.substring(2);
	  var particularId = dataId.substring(0, 2); 
	  if($(".na"+dataId).is(":checked")) {
      $("."+dataId).hide();
      $("."+dataId).val('');
      if (particularId==18){
      	$(".na64"+month).hide();
      	$(".na65"+month).hide();
      	$(".na66"+month).hide();
      	$(".na67"+month).hide();
      	$(".na68"+month).hide();
      	$(".na69"+month).hide();
      	$(".na70"+month).hide();
      }
    }else {
      $("."+dataId).show();
      $(".na64"+month).show();
      $(".na65"+month).show();
    	$(".na66"+month).show();
    	$(".na67"+month).show();
    	$(".na68"+month).show();
    	$(".na69"+month).show();
    	$(".na70"+month).show();
    }
	});	
	$(".infile").on("change", function(){
	  var dataId = $(this).attr("data-id");
	  if ($("."+dataId).val()) {
      $("."+dataId).css('color','red');
    }
	});
	$(".submitbtn").on("click", function(){
	  if (confirm('You are about to do final submit. Are you sure?')) {
	  	  $(".contractorstatus").val('1');
	  		$(".formiv").submit();
	  		alert('Submitted Successfully!');
	  }
	});	
	$(".savebtn").on("click", function(){
	  if (confirm('It will save your files temporarily. Are you sure?')) {
	  	  $(".contractorstatus").val('0');
		  	$(".formiv").submit();
		  	alert('Saved Successfully!'); 
	  }
	});	
</script>
</body>
</html>