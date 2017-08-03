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
            Add New Supplier
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ url('/').'/admin/dashboard'}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Supplier</a></li>
            <li class="active">New Supplier</li>
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
                <form role="form" method="post" action="{{ url('/').'/admin/addeditsupplier' }}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                    <input name="id" type="hidden" value="{{ @$supplierdata['id']}}">
                    <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">Company Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value="{{ old('company_name')!=''?old('company_name'):@$supplierdata['company_name']}}" name="company_name" placeholder="Enter Company Name">
                       @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                    </div>
                     <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">Company Description</label>
                      <textarea rows="3" name="description" class="form-control" placeholder="Enter Company Description">{{ old('description')!=''?old('description'):@$supplierdata['description']}}</textarea>
                      @if ($errors->has('description'))
                          <span class="help-block">
                              <strong>{{ $errors->first('description') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" value="{{ old('email')!=''?old('email'):@$supplierdata['email']}}" name="email" placeholder="Enter email">
                      @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group{{ $errors->has('brand') ? ' has-error' : '' }}">
                      <label for="exampleInputbrand1">brand</label>
                      <input type="text" class="form-control" id="exampleInputbrand1" name="brand" placeholder="brand" value="{{ old('brand')!=''?old('brand'):@$supplierdata['brand']}}">
                      @if ($errors->has('brand'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('brand') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                      <label for="exampleInputprice1">price</label>
                      <input type="text" class="form-control" id="exampleInputprice1" name="price" placeholder="price" value="{{ old('price')!=''?old('price'):@$supplierdata['price']}}">
                      @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                      <label for="exampleInputPassword1">Phone Number</label>
                      <input type="text" class="form-control" id="exampleInputPassword2" name="phone_number" placeholder="phone number" value="{{ old('phone_number')!=''?old('phone_number'):@$supplierdata['phone_number']}}">
                      @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Info Of Time</label>
                      <input type="text" class="form-control" id="exampleInputPassword2" name="time_info" placeholder="Info Of Time" >
                     <!--  @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif -->
                    </div>

                     <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                      <label for="exampleInputPassword1">Image</label>
                      <input type="file" class="form-control" name="image">
                      @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                    </div>

                    <div class="form-group">
                 <label class="hlabe">Address</label>
 <input id="pac-input" class="controls" type="text" placeholder="Search Box" value="{{ @$supplierdata['address']!=''?$supplierdata['address']:old('address') }}" name="address">
               <div id="map" style="width: 100%; height: 300px;"></div>
             <input type="hidden" id="us2-lat" name="latitude" value="{{ @$supplierdata['latitude']!=''?$supplierdata['latitude']:old('latitude') }}" />
             <input type="hidden" id="us2-lon" name="longitude" value="{{  @$supplierdata['longitude']!=''?$supplierdata['longitude']:old('longitude') }}" />
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

       <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {

        var map = new google.maps.Map(document.getElementById('map'), {
         center: {lat: <?php if(@$supplierdata['latitude']!='' && old('latitude')==''){echo @$supplierdata['latitude'];}elseif (@$supplierdata['latitude']=='' && old('latitude')!='') { echo old('latitude');}else{ echo "53.88749422522429";}?>, lng: <?php if(@$supplierdata['longitude']!='' && old('longitude')==''){echo @$supplierdata['longitude'];}elseif (@$supplierdata['longitude']=='' && old('longitude')!='') { echo old('longitude');}else{ echo "-119.11328125";}?>},
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
       var myLatLng = {lat: <?php if(@$supplierdata['latitude']!='' && old('latitude')==''){echo @$supplierdata['latitude'];}elseif (@$supplierdata['latitude']=='' && old('latitude')!='') { echo old('latitude');}else{ echo "53.88749422522429";}?>, lng: <?php if(@$supplierdata['longitude']!='' && old('longitude')==''){echo @$supplierdata['longitude'];}elseif (@$supplierdata['longitude']=='' && old('longitude')!='') { echo old('longitude');}else{ echo "-119.11328125";}?>};
              var markersa = new google.maps.Marker({
          position: myLatLng,
          map:map,
          title: '{{ @$supplierdata['address']!=''?$supplierdata['address']:old('address') }}'
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

