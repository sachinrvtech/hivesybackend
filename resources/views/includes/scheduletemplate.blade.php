
<ul>
     <li>User Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li>
   @foreach ($dataapp as $dataapps)
	
            <li>{{ $dataapps['userdata']['first_name']}} &nbsp;&nbsp;{{ $dataapps['userdata']['last_name']}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- <a href="javascript:void(0);" title="Accept" id="{{ $dataapps->id}}" class="updateschedule" data-status="accept">@if($dataapps['status']==0)<i style="color:Green;" class="fa fa-check" id="check"></i>@endif 
<span id="accept_status" style="color:Green;">Accepted </span></a>
<a href="javascript:void(0);" title="Reject" id="{{ $dataapps->id}}" class="updateschedule" data-status="reject"><i style="color:red;" class="fa fa-close"></i></a> -->&nbsp;&nbsp;&nbsp;

</li>
	
    	@endforeach
</ul>
