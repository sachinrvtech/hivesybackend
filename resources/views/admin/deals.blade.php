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
            Deal Data Tables
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Deal Data tables</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Deals Data Table With Full Features</h3>
                  <a href="{{ url('/admin/addeditdeal')}}" class="btn btn-primary pull-right">Add More Deal</a>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Deal name</th>
                        <th>Deal Price</th>
                        <th>Business Name</th>
                        <th>Avail Deal</th>
                        <th>Deal Performance</th>
                        <th>Deal PICs</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach($dealdata as $dealdatas)
                           <tr>
                          <td>{{ @$dealdatas['deal_name']}}</td>
                          <td>{{ @$dealdatas['deal_price']}}</td>
                          <td>{{ @$dealdatas['businessinfo']['business_name']}}</td>
                          <td>{{ @$dealdatas['total_deal']}}</td>
                          <td>
                          <a href="javascript:void(0);" id="{{ $dealdatas['id'] }}" class="btn btn-primary viewperformance">View Performance</a>
                          </td>
                          <td>
                          @if(@$dealdatas['image_count']>0)
                          <a href="javascript:void(0);" id="{{ $dealdatas['id'] }}" class="btn btn-primary view_image">View Images</a>
                          @endif
                          </td>
                          <td><a href="{{ url('/admin/addeditdeal/'.base64_encode(@$dealdatas['id']))}}"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;<a href="{{ url('/admin/updateactivedeal/'.base64_encode(@$dealdatas['id']).'/'.base64_encode(@$dealdatas['active']))}}"><i class="fa fa-{{ @$dealdatas['active']!=1?'play':'pause'}}"></i></a> &nbsp;&nbsp;<a href="{{ url('/admin/deletedeal/'.base64_encode(@$dealdatas['id']))}}"   onclick="return confirm('are you sure to delete this one?');" ><i class="fa fa-close"></i></a></td>
                         </tr>
                          @endforeach
                 </tbody>
                    <tfoot>
                      <tr>
                      <th>Deal name</th>
                        <th>Deal Price</th>
                        <th>Business Name</th>
                        <th>Avail Deal</th>
                        <th>Deal Performance</th>
                        <th>Deal PICs</th>
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
        <div id="viewimages" class="modal fade" role="dialog">
           <div class="modal-dialog">
                <!-- Modal content-->
             <div class="modal-content">
                <div id='image_slide_Show'></div>
             </div>
          </div>
        </div>
<script type="text/javascript">
     $('.view_image').on('click',function(){
        var dataId = $(this).attr('id');
      $.ajax({
          url: '{{ url('/admin/viewdealimages') }}',
          type: 'POST',
          data: {
          "_token": "{{ csrf_token() }}",
          "id": dataId
          },
          success: function( msg ) {
              $("#image_slide_Show").html(msg);
              }
          });
          $("#viewimages").modal('show');
      });
    function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    x[slideIndex-1].style.display = "block";  
  }

  $(document).on('click','.deleteProductImage',function(){
      var objthis=$(this);
      var imageid=$(this).attr('id');
       $.ajax({
        url: '{{url("/admin/deletedealimage")}}',
        type:'POST',
        data:{
          "_token":"{{ csrf_token() }}",
          "id":imageid
        },
        success: function(msg){
          objthis.parent('div').parent('div').remove();
          $("#viewimages").modal('hide');
        }
      })


    });
   $(document).on('click','.viewperformance',function(){
      var objthis=$(this);
        $.ajax({
        url: '{{url("/admin/viewperformance")}}',
        type:'POST',
        data:{
          "_token":"{{ csrf_token() }}",
          "id":imageid
        },
        success: function(msg){
         console.log(msg);
        }
      })
    });
</script>
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
    