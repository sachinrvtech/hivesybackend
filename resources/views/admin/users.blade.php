            @include('layouts.admin')
      <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
       <?php if(session('status')){?>
       <div class="alert alert-success">
      <?php echo session('status'); ?>
       </div>
     <?php }?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Users Data Tables
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Users Data tables</li>
          </ol>
        </section>
       <?php 
    $regex = "((https?|ftp)\:\/\/)?"; // SCHEME 
    $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass 
    $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP 
    $regex .= "(\:[0-9]{2,5})?"; // Port 
    $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path 
    $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query 
    $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor 
?>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Users Data Table With Full Features</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Zipcode</th>
                        <th>Phone Number</th>
                        <th>Profile Pic</th>
                        <th>User Role</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach($userdata as $userdatas)
                           <tr>
                          <td>{{ @$userdatas['username']}}</td>
                          <td>{{ @$userdatas['name']}}</td>
                          <td>{{ @$userdatas['email']}}</td>  
                          <td>{{ @$userdatas['zip_code']}}</td>
                          <td>{{ @$userdatas['user_phone']}}</td>
                          <td> 
                          @if(@$userdatas['user_pic']!='' && !is_null(@$userdatas['user_pic']))
                          <img width="50" style="display:{{ @$userdatas['user_pic']!=''?'block':'none'}}" src="{{ preg_match("/^$regex$/i", @$userdatas['user_pic'])?@$userdatas['user_pic']:asset('/profilepics/'.@$userdatas['user_pic'])}}"> @endif
                          </td>
                          <td><?php if(@$userdatas['role']=='1') { ?>{{ 'Admin'}} <?php } elseif(@$userdatas['role']=='2'){?>{{ 'Normal User'}}<?php } else{?>{{ 'other'}}<?php }?></td>
                          <td><a href="{{ url('/admin/addedituser/'.base64_encode(@$userdatas['id']))}}"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;<a href="{{ url('/admin/updateactive/'.base64_encode(@$userdatas['id']).'/'.base64_encode(@$userdatas['active']))}}"><i class="fa fa-{{ @$userdatas['active']!=1?'play':'pause'}}"></i></a> &nbsp;&nbsp;<a href="{{ url('/admin/deleteuser/'.base64_encode(@$userdatas['id']))}}"   onclick="return confirm('are you sure to delete this one?');" ><i class="fa fa-close"></i></a></td>
                         </tr>
                          @endforeach
                 </tbody>
                    <tfoot>
                      <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Zipcode</th>
                        <th>Phone Number</th>
                        <th>Profile Pic</th>
                        <th>User Role</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
       @include('includes.footer')
</div>
<script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    