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
			@php $rowspan=0; $columnName=''; $parDate=null; @endphp
			@foreach($audits as $key => $audit)
				@if($key == 0)
					@php $rowspan=1; @endphp
					<p>Client Name: {{$audit->user_name}}<br>Audit Period: {{date('M-Y', strtotime($audit->audit_from))}} - {{date('M-Y', strtotime($audit->audit_to))}}</p><hr>
					
					<table class="table table-bordered table-responsive" border="1">
						<thead>
							<th style="text-align:left; width: 250px;" class="particulars">Particulars</th>
							<th>date</th>
							<th>audit_id</th>
							<th>particular_id</th>
							<th>particular_date</th>
							<th>particular_file</th>
							<th>text_content</th>
							<th>clra_from</th>
							<th>clra_to</th>
							<th>na</th>
							<th>Remarks</th>
						</thead>
				@endif
				<tbody>
					@php 
						if($columnName == $audit->column_name){
							$rowspan++;
						}else {
							$rowspan = 1;
						}
					@endphp
					<tr>
						@if($columnName != $audit->column_name)
							<td rowspan="">{{$audit->column_name}}</td>
							@else
							<td></td>
						@endif
						@if($parDate != $audit->particular_date || $columnName != $audit->column_name)
							<td rowspan="">{{date('M-Y', strtotime($audit->particular_date))}}</td>
							@else
							<td></td>
						@endif
						<td>{{$audit->audit_id}}</td>
						<td>{{$audit->particular_id}}</td>
						<td>{{$audit->particular_date}}</td>
						<td>{{$audit->particular_file}}</td>
						<td>{{$audit->text_content}}</td>
						<td>{{$audit->clra_from}}</td>
						<td>{{$audit->clra_to}}</td>
						<td>{{$audit->na}}</td>
						<td>{{$audit->remarks}}</td>
					</tr>
				</tbody>
				@php $columnName = $audit->column_name; $parDate = $audit->particular_date; @endphp
			@endforeach
			</table>
			@if(!count($audits))
			<p>Data not found</p>
			@endif
		</div>
	</div>
</form>