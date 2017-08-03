      @include('layouts.admin')
      <style type="text/css">
      #map-canvas{
        width: 320px;
        height: 320px;
      }
        .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
      .closeicon {
  margin-left: 76px;
  margin-top: 6px;
  position: absolute;
  opacity: 0;
     }
      .closeicon12 {
  margin-left:175px;
  margin-top: 6px;
  position: absolute;
  opacity: 0;
     }
    .mainicondiv:hover .closeicon {
  opacity: 1;
}
   .mainfeatureddiv:hover .closeicon12 {
  opacity: 1;
}
    </style>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add/edit Business
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ url('/').'/admin/dashboard'}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Business</a></li>
            <li class="active">New Business</li>
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
                <form role="form" method="post" action="{{ url('/').'/admin/addeditbusiness' }}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                    <input name="id" type="hidden" value="{{ @$businessdata['id']}}">
                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1" style="width:100%;">Category</label>
                      <a href="javascript:void(0);" class="btn btn-primary pull-right addmorecategory">Add More</a>
                      <select class="form-control" name="category" style="width:91%" id="allcategoryiddata">
                        @foreach($category as $categories)
                        <option value="{{ $categories->id}}" {{ $categories->id==@$businessdata['category']?'selected':'' }}>{{ $categories->category_name}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                       @endif
                    </div>
                    <div class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">BUsiness Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value="{{ old('business_name')!=''?old('business_name'):@$businessdata['business_name']}}" name="business_name" placeholder="Enter business_name">
                       @if ($errors->has('business_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('business_name') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group{{ $errors->has('business_email') ? ' has-error' : '' }}">
                      <label for="exampleInputbusiness_email1">Business email address</label>
                      <input type="business_email" class="form-control" id="exampleInputbusiness_email1" value="{{ old('business_email')!=''?old('business_email'):@$businessdata['business_email']}}" name="business_email" placeholder="Enter business_email">
                      @if ($errors->has('business_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('business_email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group{{ $errors->has('website_url') ? ' has-error' : '' }}">
                      <label for="exampleInputbusiness_email1">Website Url</label>
                      <input type="url" class="form-control" id="exampleInputbusiness_email1" value="{{ old('website_url')!=''?old('website_url'):@$businessdata['website_url']}}" name="website_url" placeholder="Enter Website Url">
                      @if ($errors->has('website_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website_url') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group{{ $errors->has('facebook_page_url') ? ' has-error' : '' }}">
                      <label for="exampleInputbusiness_email1">Facebook Page Url</label>
                      <input type="url" class="form-control" id="exampleInputbusiness_email1" value="{{ old('facebook_page_url')!=''?old('facebook_page_url'):@$businessdata['facebook_page_url']}}" name="facebook_page_url" placeholder="Enter Facebook page Url">
                      @if ($errors->has('facebook_page_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('facebook_page_url') }}</strong>
                                    </span>
                                @endif
                    </div>
                     <div class="form-group{{ $errors->has('about_us') ? ' has-error' : '' }}">
                      <label for="exampleInputabout_us1">About Us</label>
                      <textarea class="form-control" id="exampleInputabout_us1" name="about_us" raw="5" placeholder="Enter Some thing about business">{{ old('about_us')!=''?old('about_us'):@$businessdata['about_us']}}</textarea>
                       @if ($errors->has('about_us'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('about_us') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">Phone Number</label>
                      <input type="number" class="form-control" id="exampleInputEmail1" value="{{ old('   phone')!=''?old('phone'):@$businessdata['phone']}}" name="phone" placeholder="Enter phone number" max="99999999999" min="100000000">
                       @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                      <label for="exampleInputEm">Logo</label>
                      <input type="file" class="form-control logocoverimg" id="logoimgid" name="logo">
                     <img width="100" class="logoimage" src="{{ asset('/logopics/'.@$businessdata['logo']) }}" style="display: {{@$businessdata['phone']!=''?'block':'none'}};">
                     </div>

                    <div class="form-group{{ $errors->has('cover_picture') ? ' has-error' : '' }}">
                      <label for="exampleInputEm">cover_picture</label>
                      <input type="file" class="form-control logocoverimg" id="coverimgid" name="cover_picture">
                       <img width="150" class="coverimage" src="{{ asset('/coverpics/'.@$businessdata['cover_picture']) }}" style="display: {{@$businessdata['phone']!=''?'block':'none'}};">
                    </div>
                     <div class="form-group">
                 <label class="hlabe">Business Address</label>
 <input id="pac-input" class="controls" type="text" placeholder="Search Box" value="{{ @$businessdata['business_address']!=''?$businessdata['business_address']:old('business_address') }}" name="business_address">
               <div id="map" style="width: 100%; height: 300px;"></div>
             <input type="hidden" id="us2-lat" name="latitude" value="{{ @$businessdata['latitude']!=''?$businessdata['latitude']:old('latitude') }}" />
             <input type="hidden" id="us2-lon" name="longitude" value="{{  @$businessdata['longitude']!=''?$businessdata['longitude']:old('longitude') }}" />
             </div>
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
  

     <div id="myModal" class="modal fade" role="dialog" style="overflow: auto;">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Category table</h4>
          </div>
          <div class="modal-body ">
           <a href="javascript:void(0);" class="btn btn-primary pull-right addmcategory" id="">Add More</a>
            <div class="maindiv">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Category Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="wordspackdatatable">
                      @foreach($category as $categorys)
                          <tr id="datacate{{ @$categorys['id']}}">
                          <td>{{ @$categorys['category_name']}}</td>
                          <td><a href="javascript:void(0);" data-name="{{ @$categorys['category_name']}}" id="{{ @$categorys['id']}}" class="editwordrow"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;<a href="javascript:void(0);" id="{{ @$categorys['id']}}" class="deletecateraw"><i class="fa fa-close"></i></a></td>
                         </tr>
                       @endforeach
                 </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div>
               <form action="{{ url('/admin/addeditcategory')}}" method="post" id="packwordsform" style="display:none;">
                    <input type="hidden" name="id" value="" id="categoryidcc">
                     <div class="form-group" >
                     <label>Category Name</label>
                     <input type="text" class="form-control" id="categname" name="category_name" value="">
                     </div>
                  {{ csrf_field()}}
                <button type="submit" id="btnsubmit" class="btn btn-primary pull-right">Save</button>
              </form>
           </div>
           <div class="modal-footer">
          </div>
        </div>

      </div>
    </div>
    <script type="text/javascript">
    function readURL(input,thisobj) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
           thisobj.next('img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

//coverimage
$(".logocoverimg").change(function(){
    var thisobj=$(this);
    readURL(this,thisobj);
});

/*$("#logoimgid").change(function(){
    readURL(this);
});*/

       $(document).on('click','.addmorecategory',function(){
           $('#myModal').modal('show');
     });
       
       $(document).on('click','.addmcategory',function(){
        $('#categoryidcc').val('');
        $('#packwordsform')[0].reset();
           $('#packwordsform').show();
     });

         $(document).on('click','.editwordrow',function(){
$('#categoryidcc').val($(this).attr('id'));
$('#categname').val($(this).attr('data-name'));
          $('#packwordsform').show();
     });

         $("#packwordsform").submit(function(e) {
          var idval=$('#categoryidcc').val();
          var url = $(this).attr('action'); // the script where you handle the form input.
          var thisobj=$(this);
          $.ajax({
                 type: "POST",
                 url: url,
                 data: thisobj.serialize(), // serializes the form's elements.
                 success: function(data)
                 {
                   if(data=="error")
                   {
                     alert("Category already exist"); // show response from the php script.
                   }
                   else
                   {
                     if(idval!="")
                     {
                      $("#datacate"+idval).remove();
                     }
                      thisobj.hide();
                    $('.wordspackdatatable').append(data.tabledata);
                    $('#allcategoryiddata').html(data.seloptiondata);
                   }
                 }
               });
          
          e.preventDefault(); // avoid to execute the actual submit of the form.
        });
  $(document).on('click','.deletecateraw',function(){
   var id=$(this).attr('id');
   var thisobj=$(this);
   if(confirm("are you sure you want to delete this raw"))
   {
          $.ajax({
               type: "POST",
               url: '{{ url("/admin/deletecategory")}}',
               data: {
                          '_token': '{{ csrf_token() }}',
                          'id':id,
                     },
               success: function(data)
               {
                 if(data.message=='success')
                 {
                  thisobj.parent('td').parent('tr').remove();
                  $('#allcategoryiddata').html(data.seloptiondata);
                 }
               }
             });
  }
 });
    </script>

       <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {

        var map = new google.maps.Map(document.getElementById('map'), {
         center: {lat: <?php if(@$businessdata['latitude']!='' && old('latitude')==''){echo @$businessdata['latitude'];}elseif (@$businessdata['latitude']=='' && old('latitude')!='') { echo old('latitude');}else{ echo "53.88749422522429";}?>, lng: <?php if(@$businessdata['longitude']!='' && old('longitude')==''){echo @$businessdata['longitude'];}elseif (@$businessdata['longitude']=='' && old('longitude')!='') { echo old('longitude');}else{ echo "-119.11328125";}?>},
          zoom: 16,
          mapTypeId: 'roadmap'
        });
       
      
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
             });

  
 /*     if(lat==0 && lng==0)
      {*/
       var myLatLng = {lat: <?php if(@$businessdata['latitude']!='' && old('latitude')==''){echo @$businessdata['latitude'];}elseif (@$businessdata['latitude']=='' && old('latitude')!='') { echo old('latitude');}else{ echo "53.88749422522429";}?>, lng: <?php if(@$businessdata['longitude']!='' && old('longitude')==''){echo @$businessdata['longitude'];}elseif (@$businessdata['longitude']=='' && old('longitude')!='') { echo old('longitude');}else{ echo "-119.11328125";}?>};
              var markersa = new google.maps.Marker({
          position: myLatLng,
          map:map,
          title: '{{ @$businessdata['business_address']!=''?$businessdata['business_address']:old('business_address') }}'
        });  
    /*  }*/


        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
       
          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
                  marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
             markersa.setMap(null);
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            $('#us2-lat').val(lat);
            $('#us2-lon').val(lng);


            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              title: place.name,
            /*  draggable: true,*/
               icon: icon,
              position: place.geometry.location
            }));
     /*       google.maps.event.addListener(markers, "dragend", function (event) {
                var point = markers.getPosition();
                 map.panTo(point);
                 console.log(point.name);
            });*/
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
    
      }
  
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5HdR7GPPiQgWj7CCXCAhdB1SSRKPnLQw&libraries=places&callback=initAutocomplete" async defer></script>
 @include('includes.footer')
</div>

