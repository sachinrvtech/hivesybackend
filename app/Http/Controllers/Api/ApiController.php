<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Validator;
use App\User;
use App\Deal;
use App\Business;
use App\UserDeal;
use App\UserCart;
use DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
//use Auth;

class ApiController extends Controller
{
 
   public function getdealnearby(Request $request)
  {
    try {
    	    $user_id=$request->user()->id;
    	    $lat=$request->user()->latitude;
    	    $long=$request->user()->longitude;
          $dealids=UserCart::where('user_id','=',$user_id)->pluck('deal_id');
          
          if($request->has('deal_category') && $request->get('deal_category')!='')
          {
            $salecategory=explode(",", $request->get('deal_category'));
          }
          else
          {
            $salecategory=array();
          }
    	    if($request->has('min_distance') && $request->get('min_distance')!='')
    	    {
    	    	$min_distance=$request->get('min_distance');
    	    }
    	    else
    	    {
    	    	$min_distance=0;	
    	    }
    	    if($request->has('max_distance') && $request->get('max_distance')!='')
    	    {
    	    	$max_distance=$request->get('max_distance');
    	    }
    	     else
    	    {
    	    	$max_distance=50;	
    	    }

          if($request->has('min_price') && $request->get('min_price')!='')
          {
            $min_price=$request->get('min_price');
          }
          else
          {
            $min_price=0;  
          }
          if($request->has('max_price') && $request->get('max_price')!='')
          {
            $max_price=$request->get('max_price');
          }
           else
          {
            $max_price=500; 
          }
    	    $businessids=Business::where('active','=',1)->select('businesses.*')->selectRaw('( 6371 * acos( cos( radians(?) ) *
                               cos( radians( latitude ) )
                               * cos( radians( longitude ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( latitude ) ) )
                             ) AS distance', [$lat, $long, $lat])
            ->havingRaw('(distance>="'.$min_distance.'" AND distance<="'.$max_distance.'")')
            ->orderBy('created_at','DESC')
            ->pluck('id');
        //    return $businessids;
          $data=Deal::where(function($query)use($salecategory){
            if(count($salecategory)>0)
            {
              $query->whereIn('deal_category',$salecategory);
            }
          })->whereNotIn('id',$dealids)->whereIn('businessId',$businessids)->whereBetween('deal_price', [$min_price, $max_price])->with(array('hassaved'=>function($query) use($user_id){
            $query->where('user_id','=',$user_id);
          }))->where('active','=',1)->with('images')->with(array('businessinfo'=>function($query) use($lat,$long){
          	$query->select('businesses.*')->selectRaw('( 6371 * acos( cos( radians(?) ) *
                               cos( radians( latitude ) )
                               * cos( radians( longitude ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( latitude ) ) )
                             ) AS distance', [$lat, $long, $lat]);
          }))->orderBy('created_at','DESC')->paginate(50);
          $result['message']="Success";
          $result['data']=$data;
        }
       catch (\Exception $e)
        {
        $result = [
            'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
        ];
        Log::error($e->getTraceAsString());
        }
         return $result;
  }

   public function haversineGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
      // convert from degrees to radians
      $latFrom = deg2rad((float)$latitudeFrom);
      $lonFrom = deg2rad((float)$longitudeFrom);
      $latTo = deg2rad((float)$latitudeTo);
      $lonTo = deg2rad((float)$longitudeTo);
      $latDelta = $latTo - $latFrom;
      $lonDelta = $lonTo - $lonFrom;

      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
      return $angle * $earthRadius;
    }

    public function addinfavourite(Request $request)
    {
      try{
           $user_id=$request->user()->id;
           $post_data=$request->all();
           	if($post_data['type']=='like')
           	{

           		 if(Favourite::where('user_id','=',$user_id)->where('supplier_id','=',$post_data['supplier_id'])->count())
		           {
		            $result['message']="This supplier already added in favourite";
		            return $result;
		           }
	            $favobj=new Favourite;
	            $favobj->user_id=$user_id;
	            $favobj->supplier_id=$post_data['supplier_id'];
	            $favobj->status=1;
	            if($favobj->save())
	            {
	              $result['message']="Successfully added in favourite";
	            }
          	}
          	else
          	{
          		if(Favourite::where('user_id','=',$user_id)->where('supplier_id','=',$post_data['supplier_id'])->delete())
          		{
          			$result['message']="Successfully removed from favourites";
          		}
          	}
          
      }
      catch (\Exception $e)
      {
         $result = [
            'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
        ];
        Log::error($e->getTraceAsString());
      }
      return $result;
    }

    public function updatefcmtoken(Request $request)
    {
      try{
           $user_id=$request->user()->id;
           $post_data=$request->all();
          if(User::where('id','=',$user_id)->update(['fcm_token'=>$post_data['fcm_token']]))
          {
            User::where('id','!=',$user_id)->where('fcm_token','=',$post_data['fcm_token'])->update(['fcm_token'=>'']);
           $result['message']="Success";
          }
          
        }
      catch(\Exception $e)
      {
          $result = [
                'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
            ];
            Log::error($e->getTraceAsString());
      }
      return $result;
      
    }


    public function updatelatlong(Request $request)
    {
      try{
           $user_id=$request->user()->id;
           $post_data=$request->all();
          if(User::where('id','=',$user_id)->update(['latitude'=>$post_data['latitude'],'longitude'=>$post_data['longitude']]))
          {
            $result['message']="Success";
          }
         }
        catch(\Exception $e)
        {
            $result = [
                  'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
              ];
              Log::error($e->getTraceAsString());
        }
      return $result;
      
    }

     public function updateprofile(Request $request)
    {
      try{
           $user_id=$request->user()->id;
           $post_data=$request->all();
           if($request->has('new_password') && $request->get('new_password')!='' && $request->has('old_password') && $request->get('old_password')!='')
           {
                     $userdata=User::where('id','=',$user_id)->first(['password']);
              if (Hash::check($request->get('old_password'), $userdata['password'])) {
                  $rendomstrind=$request->get('new_password');
                  $new_pass=Hash::make($rendomstrind);
                  if(User::where('id','=',$user_id)->update(['password'=>$new_pass]))
                  {
                       $result['message']  ='Successfully Changed';
                  }
                  else
                  {
                      $result['message']  ='Some thing went wrong!';
                  }
              }
              else
              {
                $result['message']  ='Old password does not matched!';
              }
           }

           if($request->has('new_email') && $request->get('new_email')!='' && $request->has('old_email') && $request->get('old_email')!='')
           {
                if(User::where('email','=',$request->get('old_email'))->where('id','=',$user_id)->count())
                {
                  if(User::where('email','=',$request->get('new_email'))->where('id','!=',$user_id)->count()==0)
                      {
                            if(User::where('id','=',$user_id)->update(['email'=>$request->get('new_email')]))
                          {
                               $result['message']  ='Successfully Changed';
                          }
                          else
                          {
                              $result['message']  ='Some thing went wrong!';
                          }
                      }
                      else
                      {
                          $result['message']  ='new email already been taken';
                      }
                }
                else
                {
                  $result['message']  ='Old email does not matched!';
                }
           }
             if($request->has('user_phone') && $request->get('user_phone')!='')
           {

                if(User::where('id','=',$user_id)->update(['user_phone'=>$request->get('user_phone')]))
              {
                   $result['message']  ='Successfully Changed';
              }
              else
              {
                  $result['message']  ='Some thing went wrong!';
              }
                    
           }

             if($request->has('address') && $request->get('address')!='')
           {

                if(User::where('id','=',$user_id)->update(['address'=>$request->get('address')]))
              {
                   $result['message']  ='Successfully Changed';
              }
              else
              {
                  $result['message']  ='Some thing went wrong!';
              }
                    
           }
          
         }
        catch(\Exception $e)
        {
            $result = [
                  'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
              ];
              Log::error($e->getTraceAsString());
        }
      return $result;
      
    }

   public function updateinterest(Request $request)
    {
      try{
           $user_id=$request->user()->id;
           $post_data=$request->all();
          if(User::where('id','=',$user_id)->update(['interest'=>$post_data['interest']]))
          {
             $result['message']="Success";
          }
          
        }
      catch(\Exception $e)
      {
          $result = [
                'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
            ];
            Log::error($e->getTraceAsString());
      }
      return $result;
      
    }

      public function updateprofilepic(Request $request)
    {
      try{
           $user_id=$request->user()->id;
           $user_pic=$request->user()->user_pic;
           $post_data=$request->all();
           if ($request->hasFile('user_pic') && $request->file('user_pic')->isValid()) {
            $file = $request->user_pic;
            $image_file = $request->file('user_pic');
            $upload_path = '/profilepics/';
            $destinationPath = public_path().$upload_path;
            $fileName = time(). '-' . $file->getClientOriginalName();
            $request->file('user_pic')->move($destinationPath, $fileName);
            $image = $fileName;
              if(file_exists($destinationPath.$user_pic) && !is_null($user_pic))
              {
                unlink($destinationPath.$user_pic);
              }
            $result['new_image']=$image;
            }
            else
            {
             $image = $user_pic;
            }

          if(User::where('id','=',$user_id)->update(['user_pic'=>$image]))
          {
             $result['message']="Success";
          }
        }
        catch(\Exception $e)
        {
            $result = [
                  'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
              ];
              Log::error($e->getTraceAsString());
        }
        return $result;
      
    }


     public function saveunsavetodeal(Request $request)
    {
      try{
           $user_id=$request->user()->id;
           $post_data=$request->all();
          if(UserDeal::where('deal_id','=',$post_data['deal_id'])->where('user_id','=',$user_id)->count())
          {
             $newobj=UserDeal::where('deal_id','=',$post_data['deal_id'])->where('user_id','=',$user_id)->first();
          }
          else
          {
            $newobj=new UserDeal;
          } 
            $newobj->deal_id=$post_data['deal_id'];
            $newobj->status=$post_data['status'];
            $newobj->user_id=$user_id;
            if($newobj->save())
            {
               $result['message']="Success";
            }
          
        }
      catch(\Exception $e)
      {
          $result = [
                'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
            ];
            Log::error($e->getTraceAsString());
      }
      return $result;
      
    }

     public function togetsaveddeal(Request $request)
  {
    try {
          $user_id=$request->user()->id;
          $lat=$request->user()->latitude;
          $long=$request->user()->longitude;
          $dealids=UserDeal::where('user_id','=',$user_id)->where('status','=',1)->orderBy('created_at','DESC')->pluck('deal_id');
       //    return $businessids;
          $data=Deal::whereIn('id',$dealids)->where('active','=',1)->with('images')->with(array('businessinfo'=>function($query) use($lat,$long){
            $query->select('businesses.*')->selectRaw('( 6371 * acos( cos( radians(?) ) *
                               cos( radians( latitude ) )
                               * cos( radians( longitude ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( latitude ) ) )
                             ) AS distance', [$lat, $long, $lat]);
          }))->orderBy('created_at','DESC')->paginate(50);
          $result['message']="Success";
          $result['data']=$data;
        }
       catch (\Exception $e)
        {
        $result = [
            'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
        ];
        Log::error($e->getTraceAsString());
        }
         return $result;
  }


     public function adddealtocart(Request $request)
    {
      try{
           $user_id=$request->user()->id;
           $post_data=$request->all();
          if(UserCart::where('deal_id','=',$post_data['deal_id'])->where('user_id','=',$user_id)->count())
          {
             $newobj=UserCart::where('deal_id','=',$post_data['deal_id'])->where('user_id','=',$user_id)->first();
          }
          else
          {
            $newobj=new UserCart;
          } 
            $newobj->deal_id=$post_data['deal_id'];
            $newobj->user_id=$user_id;
            $newobj->status=0;
            if($newobj->save())
            {
               $dealobj=Deal::where('id','=',$post_data['deal_id'])->first();
               $dealobj->total_deal=$dealobj['total_deal']-1;
               $dealobj->save();
               $result['message']="Success";
            }
          
        }
      catch(\Exception $e)
      {
          $result = [
                'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
            ];
            Log::error($e->getTraceAsString());
      }
      return $result;
      
    }

     public function togetcartddeals(Request $request)
  {
    try {
          $user_id=$request->user()->id;
          $lat=$request->user()->latitude;
          $long=$request->user()->longitude;
          $dealids=UserCart::where('user_id','=',$user_id)->where('status','=',0)->orderBy('created_at','DESC')->pluck('deal_id');
       //    return $businessids;
          $data=Deal::whereIn('id',$dealids)->where('active','=',1)->with('images')->with(array('businessinfo'=>function($query) use($lat,$long){
            $query->select('businesses.*')->selectRaw('( 6371 * acos( cos( radians(?) ) *
                               cos( radians( latitude ) )
                               * cos( radians( longitude ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( latitude ) ) )
                             ) AS distance', [$lat, $long, $lat]);
          }))->orderBy('created_at','DESC')->paginate(50);
          $result['message']="Success";
          $result['data']=$data;
        }
       catch (\Exception $e)
        {
        $result = [
            'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
        ];
        Log::error($e->getTraceAsString());
        }
         return $result;
  }


   
}
