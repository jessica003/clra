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
			{{$audittype == '2' ? 'CLRA AUDIT' :'INVOICE VERIFICATION AUDIT'}}
		</div>
		<div class="card-body" style="padding: 7px 1rem;">
			@php $rowspan=0; $auditColId=''; $parDate=null; @endphp
			@foreach($audits as $key => $audit)
				@if($key == 0)
					@php $rowspan=1; 
					$auditFrom = isset($audit->audit_from) ? date('M-Y', strtotime($audit->audit_from)) : '-'; 
					$auditTo = isset($audit->audit_to) ? date('M-Y', strtotime($audit->audit_to)) : '-'; 
					@endphp
					<p>Client Name: {{$audit->user_name}}<br>Audit Period: {{$auditFrom}} - {{$auditTo}}</p><hr>
					<input type="hidden" name="audit_id" class="audit_id" value="{{$audit->audit_sch_id}}">
			        <input type="hidden" name="status" class="contractorstatus" value="">
					<table class="table table-bordered table-responsive" border="1">
						<thead>
							<th style="text-align:left; width: 250px;" class="particulars">Particulars</th>
							<th style="width:150px;">Date</th>
							<!-- <th>audit_id</th> -->
							<!-- <th>particular_id</th> -->
							<th>particular_date</th>
							<th style="width:250px;">Content</th>
							<!-- <th>Value</th> -->
							<th>Clra_from</th>
							<th>Clra_to</th>
							<th>NA</th>
							<th>Remarks</th>
						</thead>
				@endif
				<tbody>
					@php 
						if($auditColId == $audit->audit_col_id){
							$rowspan++;
						}else {
							$rowspan = 1;
							$auditColId='';
						}
					@endphp
					<tr>
						@if($auditColId != $audit->audit_col_id)
							<td rowspan="">{{$audit->column_name}}</td>
							@else
							<td></td>
						@endif
						@if($parDate != $audit->particular_date || $auditColId != $audit->audit_col_id)
						@php $parDate = isset($audit->particular_date) ? date('M-Y', strtotime($audit->particular_date)) : '-'; @endphp
							<td rowspan="">{{$parDate}}</td>
							@else
							<td></td>
						@endif
						@if($audit->particular_file!='')
							<td><a href="{{$audit->particular_file}}" class="btn btn-sm btn-success">view</a></td>
						@else
							<td></td>
						@endif
						<td>{{$audit->text_content}}</td>
						<td>{{$audit->clra_from=='0000-00-00'?'':$audit->clra_from}}</td>
						<td>{{$audit->clra_to=='0000-00-00'?'':$audit->clra_to}}</td>
						<td>{{$audit->na==0?'':'Yes'}}</td>
						<td>{{$audit->remarks}}</td>
					</tr>
				</tbody>
				@php $auditColId = $audit->audit_col_id; $parDate = $audit->particular_date; @endphp
			@endforeach
			</table>
			@if(!count($audits))
			<p>Data not found</p>
			@endif
		</div>
	</div>	
	<div class="save_sub mt-2 mb-4 text-center {{$contractorstatus==1?'d-none':''}}">	
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
	  $('.datefilter').daterangepicker({
	      autoUpdateInput: false,
	      locale: {
	          cancelLabel: 'Clear'
	      }
	  });
	  $('.datefilter').on('apply.daterangepicker', function(ev, picker) {
	      $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
	  });
	  $('.datefilter').on('cancel.daterangepicker', function(ev, picker) {
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