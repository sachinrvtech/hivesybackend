    <table class="table table-hover">
        <thead>
          <th class="csvth" width="5%">#</th>
          <th class="csvth" width="80%">Category Name</th>
          <th class="csvth" width="25%">Action</th>
        </thead>
        <tbody>
        <?php $ikf=1;?>
          @foreach ( $categorydata as $categorydatas )
                  <tr>
                <td>{{$ikf.'.'}}</td>
                <td>{{ $categorydatas['category'] }}</td>
                <td><input type="hidden" class="oldcate"  value="{{$categorydatas['category']}}">
                <input type="hidden" class="olddescription"  value="{{$categorydatas['description']}}"><a class="label label-success editcategory" id="{{$categorydatas['id']}}" href="javascript:void(0);">Edit</a>
<a class="label label-info secbut deletecateoo" onclick="return confirm('Are you Sure to delete?')" id="{{ $categorydatas['id'] }}" href="javascript:void(0);">X</a></td>
                  </tr>
                   <?php $ikf++;?>
                  @endforeach
        </tbody>
      </table>