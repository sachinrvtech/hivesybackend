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
            Business Data Tables
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Business Data tables</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Users Data Table With Full Features</h3>
                  <a href="{{ url('/admin/addeditbusiness')}}" class="btn btn-primary pull-right">Add More Business</a>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Business name</th>
                        <th>Category Name</th>
                        <th>Business Email</th>
                        <th>Business Address</th>
                        <th>Phone Number</th>
                        <th>Logo</th>
                        <th>Cover Pic</th>
                        <th>Total Deals</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach($businessdata as $businessdatas)
                           <tr>
                          <td>{{ @$businessdatas['business_name']}}</td>
                          <td>{{ @$businessdatas['cat_name']}}</td>
                          <td>{{ @$businessdatas['business_email']}}</td>
                          <td>{{ @$businessdatas['business_address']}}</td>
                          <td>{{ @$businessdatas['phone']}}</td>
                          <td>@if(@$businessdatas['logo']!='')<img width="50" height="50" src="{{ asset('/logopics/'.@$businessdatas['logo'])}}">@endif</td>
                          <td>@if(@$businessdatas['cover_picture']!='')<img width="100" height="100" src="{{ asset('/coverpics/'.@$businessdatas['cover_picture'])}}">@endif</td>
                          <td>{{ $businessdatas['deal_count']}}</td>
                          <td><a href="{{ url('/admin/addeditbusiness/'.base64_encode(@$businessdatas['id']))}}"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;<a href="{{ url('/admin/updateactivebusiness/'.base64_encode(@$businessdatas['id']).'/'.base64_encode(@$businessdatas['active']))}}"><i class="fa fa-{{ @$businessdatas['active']!=1?'play':'pause'}}"></i></a> &nbsp;&nbsp;<a href="{{ url('/admin/deletebusiness/'.base64_encode(@$businessdatas['id']))}}"   onclick="return confirm('are you sure to delete this one?');" ><i class="fa fa-close"></i></a></td>
                         </tr>
                          @endforeach
                 </tbody>
                    <tfoot>
                      <tr>
                        <th>Business name</th>
                        <th>Category Name</th>
                        <th>Business Email</th>
                        <th>Business Address</th>
                        <th>Phone Number</th>
                        <th>Logo</th>
                        <th>Cover Pic</th>
                        <th>Total Deals</th>
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
    