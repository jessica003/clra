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
			INVOICE VERIFICATION AUDIT
		</div>
		<div class="card-body" style="padding: 7px 1rem;">
			@foreach($auditDet as $audit)
				<p>Client Name: {{$audit->user_name}}<br>Audit Period: {{date('M-Y', strtotime($audit->audit_from))}} - {{date('M-Y', strtotime($audit->audit_to))}}</p><hr>
			@endforeach			
			<input type="hidden" name="audit_id" class="audit_id">
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
							@if($audit->id=='1')						
							<input type="text" name="{{$audit->id.$m}}" class="empnum" required="">
							@elseif($audit->id=='2'||$audit->id=='4')
								<input type="file" name="{{$audit->id.$m}}" class="{{$audit->id.$m}} infile" data-id="{{$audit->id.$m}}">
								<input type="checkbox" name="na{{$audit->id.$m}}" class="na{{$audit->id.$m}} na" data-id="{{$audit->id.$m}}">
								<label for="na">NA</label>
							@elseif($audit->id=='3')							
								<input type="date" class="blackborder clra_from" id="inputaudit" name="from{{$audit->id.$m}}">
								<input type="date" class="blackborder mt-1 clra_to" id="inputaudit" name="to{{$audit->id.$m}}">
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
<script>
	$(".na").on("click", function(){
	  var dataId = $(this).attr("data-id");	  
	  if ($(".na"+dataId).is(":checked")) {
          $("."+dataId).hide();
          $("."+dataId).val('');

      } else {
          $("."+dataId).show();
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