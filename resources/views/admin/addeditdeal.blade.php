      @include('layouts.admin')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add/edit Deal
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ url('/').'/admin/dashboard'}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="javascript:void(0);">Deals</a></li>
            <li class="active">New Deals</li>
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
                <form role="form" method="post" action="{{ url('/').'/admin/addeditdeal' }}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                    <input name="id" type="hidden" value="{{ @$dealdata['id']}}">
                    <div class="form-group{{ $errors->has('businessId') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">Business</label>
                      <select class="form-control" name="businessId">
                        @foreach($businessdata as $businessdatas)
                        <option value="{{ $businessdatas->id}}" {{ $businessdatas->id==@$dealdata['businessId']?'selected':'' }}>{{ $businessdatas->business_name}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('businessId'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('businessId') }}</strong>
                                    </span>
                       @endif
                    </div>
                    <div class="form-group{{ $errors->has('deal_name') ? ' has-error' : '' }}">
                    <label for="exampleInputEmail1">Deal Category</label>
                    <select class="form-control" id="exampleInputEmail1" name="deal_category">
                      <option value="American Restaurants" 
                        @if(old('deal_category')=="American Restaurants")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="American Restaurants")
                        {{ "selected" }}
                        @else
                        @endif>American Restaurants</option>
                      <option value="Italian Restaurants"   @if(old('deal_category')=="Italian Restaurants")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Italian Restaurants")
                        {{ "selected" }}
                        @else
                        @endif>Italian Restaurants</option>
                      <option value="Mexican Restaurants" @if(old('deal_category')=="Mexican Restaurants")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Mexican Restaurants")
                        {{ "selected" }}
                        @else
                        @endif>Mexican Restaurants</option>
                      <option value="Asian Restaurants" @if(old('deal_category')=="Asian Restaurants")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Asian Restaurants")
                        {{ "selected" }}
                        @else
                        @endif>Asian Restaurants</option>
                      <option value="Japanese Restaurants" @if(old('deal_category')=="Japanese Restaurants")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Japanese Restaurants")
                        {{ "selected" }}
                        @else
                        @endif>Japanese Restaurants</option>
                      <option value="Chinese Restaurants" @if(old('deal_category')=="Chinese Restaurants")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Chinese Restaurants")
                        {{ "selected" }}
                        @else
                        @endif>Chinese Restaurants</option>
                      <option value="Middle Eastern Restaurants" @if(old('deal_category')=="Middle Eastern Restaurants")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Middle Eastern Restaurants")
                        {{ "selected" }}
                        @else
                        @endif>Middle Eastern Restaurants</option>
                      <option value="Pizza" @if(old('deal_category')=="Pizza")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Pizza")
                        {{ "selected" }}
                        @else
                        @endif>Pizza</option>
                      <option value="Burgers" @if(old('deal_category')=="Burgers")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Burgers")
                        {{ "selected" }}
                        @else
                        @endif>Burgers</option>
                      <option value="Cafes" @if(old('deal_category')=="Cafes")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Cafes")
                        {{ "selected" }}
                        @else
                        @endif>Cafes</option>
                      <option value="BarFood" @if(old('deal_category')=="BarFood")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="BarFood")
                        {{ "selected" }}
                        @else
                        @endif>BarFood</option>
                      <option value="Sandwiches" @if(old('deal_category')=="Sandwiches")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Sandwiches")
                        {{ "selected" }}
                        @else
                        @endif>Sandwiches</option>
                      <option value="Sushi" @if(old('deal_category')=="Sushi")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Sushi")
                        {{ "selected" }}
                        @else
                        @endif>Sushi</option>
                      <option value="Diners" @if(old('deal_category')=="Diners")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Diners")
                        {{ "selected" }}
                        @else
                        @endif>Diners</option>
                      <option value="Steakhouse" @if(old('deal_category')=="Steakhouse")
                         {{ "selected" }}
                        @elseif(@$dealdata['deal_category']=="Steakhouse")
                        {{ "selected" }}
                        @else
                        @endif>Steakhouse</option>
                    </select>
                    @if ($errors->has('deal_category'))
                    <span class="help-block">
                    <strong>{{ $errors->first('deal_category') }}</strong>
                    </span>
                    @endif
                    </div> 
                    <div class="form-group{{ $errors->has('deal_name') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">Deal Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value="{{ old('deal_name')!=''?old('deal_name'):@$dealdata['deal_name']}}" name="deal_name" placeholder="Enter deal name">
                       @if ($errors->has('deal_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deal_name') }}</strong>
                                    </span>
                                @endif
                    </div>  
                    <div class="form-group{{ $errors->has('about_deal') ? ' has-error' : '' }}">
                      <label for="exampleInputabout_deal1">About Deal</label>
                      <textarea class="form-control" id="exampleInputabout_us1" name="about_deal" raw="5" placeholder="Enter Some thing about business">{{ old('about_deal')!=''?old('about_deal'):@$dealdata['about_deal']}}</textarea>
                       @if ($errors->has('about_deal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('about_deal') }}</strong>
                                    </span>
                                @endif
                    </div>
                     <div class="form-group{{ $errors->has('fine_print') ? ' has-error' : '' }}">
                      <label for="exampleInputabout_deal1">Fine Print</label>
                      <textarea class="form-control" id="exampleInputabout_us1" name="fine_print" raw="5" placeholder="Enter Some thing about business">{{ old('fine_print')!=''?old('fine_print'):@$dealdata['fine_print']}}</textarea>
                       @if ($errors->has('fine_print'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fine_print') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group{{ $errors->has('deal_price') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">Deal Price</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value="{{ old('   deal_price')!=''?old('deal_price'):@$dealdata['deal_price']}}" name="deal_price" placeholder="Enter deal price">
                       @if ($errors->has('deal_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deal_price') }}</strong>
                                    </span>
                                @endif
                    </div>
                     <div class="form-group{{ $errors->has('expiry_date') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">Expiry Date</label>
                      <input type="date" class="form-control" id="exampleInputEmail1" value="{{ old('   expiry_date')!=''?old('expiry_date'):@$dealdata['expiry_date']}}" name="expiry_date" placeholder="Enter deal price">
                       @if ($errors->has('expiry_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('expiry_date') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group{{ $errors->has('total_deal') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">Avail Deal</label>
                      <input type="number" class="form-control" id="exampleInputEmail1" value="{{ old('   total_deal')!=''?old('total_deal'):@$dealdata['total_deal']}}" name="total_deal" placeholder="Enter total number of deal" min="1" max="50">
                       @if ($errors->has('total_deal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('total_deal') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group{{ $errors->has('deal_pic') ? ' has-error' : '' }}">
                      <label for="exampleInputEm">Deal pic(can be upload 5 pics for deal)</label>
                      <input type="file" class="form-control" id="dealspicturs" name="deal_pic[]" multiple="">
                      <div class="multipleimage">
                         @if(count(@$dealdata['images'])>0)
                           @foreach($dealdata['images'] as $images)
                           <img src="{{ asset('/dealpics/'.$images->image_name)}}" width="150">
                           @endforeach
                          @endif
                      </div>
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
@include('includes.footer')
</div>
<script type="text/javascript">
  $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img width="150">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#dealspicturs').on('change', function() {
        imagesPreview(this, 'div.multipleimage');
    });
});
</script>

