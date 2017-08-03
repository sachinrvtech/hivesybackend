      @include('layouts.admin')
      <style type="text/css">
      #map-canvas{
        width: 320px;
        height: 320px;
      }
      </style>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add New User
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ url('/').'/admin/dashboard'}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">User</a></li>
            <li class="active">New user</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">filll this form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{ url('/').'/admin/addedituser' }}">
                  {{ csrf_field() }}
                  <div class="box-body">
                    <input name="id" type="hidden" value="{{ @$userdata['id']}}">
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">User Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value="{{ old('username')!=''?old('username'):@$userdata['username']}}" name="username" placeholder="Enter username">
                       @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" value="{{ old('email')!=''?old('email'):@$userdata['email']}}" name="email" placeholder="Enter email">
                      @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    @if(@$userdata['id']=='')
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                      @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                      <label for="exampleInputPassword1">Confirm Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword2" name="password_confirmation" placeholder="Password">
                      @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                    </div>
                    @endif
                    <div class="form-group">
                      <label for="exampleuserType">User Type</label>
                      <select name="role" class="form-control"  value="{{ old('role')!=''?old('role'):@$userdata['role']}}">
                        <option value="1" {{ @$userdata['role']=='1'?'selected':''}}>Admin</option>
                        <option value="3" {{ @$userdata['role']=='2'?'selected':''}}>Normal User</option>
                      </select>
                    </div>
<!--                     <div class="checkbox">
                      <label>
                        <input type="checkbox"> Check me out
                      </label>
                    </div> -->
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
           </div><!--/.col (left) -->
            <!-- right column -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 @include('includes.footer')
</div>

