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
<form class="formiv">	
	@csrf
	<div class="card mt-3">
		<div class="card-header text-center">
			INVOICE VERIFICATION AUDIT
		</div>
		<div class="card-body" style="padding: 7px 1rem;">
			@foreach($auditDet as $audit)
				<p>Client Name: {{$audit->user_name}}<br>Audit Period: {{date('M-Y', strtotime($audit->audit_from))}} - {{date('M-Y', strtotime($audit->audit_to))}}</p><hr>
			@endforeach
			<table class="table table-bordered table-responsive">
				<thead>
					<th style="text-align:left; width: 250px;" class="particulars">Particulars</th>
					@foreach($month as $m)
					<th style="text-align:left; width: 180px;">Upload 1 ({{$m}})</th>
					@endforeach
					<th>Remarks</th>
				</thead>
				<tbody>
					@php $i=0; @endphp
					@foreach($auditCol as $audit)
					@php $i++; @endphp
					<tr>
						<th style="text-align:left;" class="particulars">{{$audit->column_name}}</th>
						@foreach($month as $m)
						<th style="text-align:left;" class="particulars">{{$m}}</th>
						@endforeach
						<th style="text-align:left;" class="particulars">{{$i}}</th>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</form>