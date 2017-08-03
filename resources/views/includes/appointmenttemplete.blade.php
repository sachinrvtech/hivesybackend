<p>Time Slots for {{ @$dayss }}  @if(count($dataapp)==0)<a href="javascript:void(0);" class="btn btn-primary pull-right addmore" id="{{ @$dayss}}">Add</a></p>@endif
<ul>
     <li>Start Time-End Time </li>
   @foreach ($dataapp as $dataapps)
            <li id="{{ @$dayss }}">{{ date("h:i A",strtotime($dataapps->start_time))."-".date("h:i A",strtotime($dataapps->end_time))}} &nbsp;&nbsp;<a href="javascript:void(0);" title="delete" id="{{ $dataapps->id}}" class="deleteappoint"><i class="fa fa-close"></i></a>&nbsp;&nbsp;<a href="javascript:void(0);" title="Edit" id="{{ $dataapps->id}}" data-starttime="{{ date('h:i A',strtotime($dataapps->start_time)) }}" data-endtime="{{ date('h:i A',strtotime($dataapps->end_time)) }}" class="editappoint"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
@if($dataapps->schedule_count>0)<a href="javascript:void(0);" title="View Schedules" id="{{ $dataapps->id}}" class="viewschedule"><i class="fa fa-eye"></i></a>
@endif
</li>
    @endforeach
</ul>
