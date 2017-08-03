<?php 
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Business;
use App\Deal;
use App\Category;
use App\DealImage;
use Illuminate\Support\Facades\Hash;
use View;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;
use HTML;
class AdminController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */


	public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		return view('dashboard');
	}
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function addedituser(Request $request,$id=null)
	{
        if(empty($request->all()))
        {
		        if($id!='')
		        {
		           $id=base64_decode($id);
                  $userdata=User::where('id','=',$id)->first();
		        }
		        else
		        {
		        	$userdata=array();
		        }
                return view('admin.addedituser')->with(compact('userdata'));
	     	}
        else
        {
  		   if($request->input('id')!='')
  		   {

  		   		$this->validate($request, [
                   'name' => 'required|max:255',
                   'email' => 'required|email|max:255|unique:users,email,'.$request->input('id'),
                    ]); 
  		   		$newuser=User::where('id','=',$request->input('id'))->first();
  		   }
  		   else
  		   {
  			$this->validate($request, [
                   'name' => 'required|max:255',
                   'email' => 'required|email|max:255|unique:users',
                   'password' => 'required|min:6|confirmed',
                     ]);  
  		    $newuser=new User;
              $newuser->password=Hash::make($request->input('password')); 
              $newuser->active=1;
  		   }
             $newuser->name=$request->input('name');
             $newuser->email=$request->input('email');
             $newuser->role=$request->input('role');
             if($newuser->save())
             {
             	return redirect('admin/users/customer')->with('status', 'successfully updated!');
             }     	
        }
	}

  public function approveornot(Request $request,$id=null,$key=null)
  {
      if($id!='' && $key !='')
        {
         $id=base64_decode($id);
         $key=base64_decode($key);
         if(trim($key)=='1')
         {
          $newkey=0;
         }
         if(trim($key)=='0')
         {
          $newkey=1;
         }
         if(Supplier::where('id','=',$id)->update(['status'=>$newkey]))
         {
            return redirect('admin/suppliers')->with('status', 'successfully updated!');
         }  
        }
  }
  public function allowornot(Request $request,$id=null,$key=null)
  {
    $get_data=$request->all();
      
         if($get_data['key']=='1')
         {
          $newkey=0;
         }
         if($get_data['key']=='0')
         {
          $newkey=1;
         }
         if(Supplier::where('id','=',$get_data['id'])->update(['timing_status'=>$newkey]))
         {
            return 'successfully Updated!';
         }  
       
        
  }

	public function users(Request $request,$key=null)
	{
      $id=Auth::id();
    	$userdata=User::where('id','!=',$id)->orderBy('created_at','=','DESC')->get();	
    	//return $userdata;
		return view('admin.users')->with(compact('userdata'));
	}
	public function updateactive(Request $request,$id=null,$key=null)
	{
        if($id!='' && $key !='')
        {
         $id=base64_decode($id);
         $key=base64_decode($key);
         if(trim($key)=='1')
         {
         	$newkey=0;
         }
         if(trim($key)=='0')
         {
         	$newkey=1;
         }
         if(User::where('id','=',$id)->update(['active'=>$newkey]))
    	   {
          	return redirect('admin/users')->with('status', 'successfully updated!');
    	   }	
        }
	}
  public function updateactivebusiness(Request $request,$id=null,$key=null)
  {
        if($id!='' && $key !='')
        {
         $id=base64_decode($id);
         $key=base64_decode($key);
         if(trim($key)=='1')
         {
          $newkey=0;
         }
         if(trim($key)=='0')
         {
          $newkey=1;
         }
         if(Business::where('id','=',$id)->update(['active'=>$newkey]))
         {
            return redirect('admin/businesses')->with('status', 'successfully updated!');
         }  
        }
  }

    public function deletebusiness(Request $request,$id=null)
  {
        if($id!='')
        {
         $id=base64_decode($id);
         $data=Business::where('id','=',$id)->first();
            if($data['logo']!='')
             {
                unlink(public_path().'/logopics/'.$data['logo']);
             }
             if($data['cover_picture']!='')
             {
                unlink(public_path().'/coverpics/'.$data['cover_picture']);
             }
            if(Business::where('id','=',$id)->delete())
         {
            return redirect('admin/businesses')->with('status', 'successfully deleted!');
         }  
        }
  }

    public function deleteuser(Request $request,$id=null)
	{
        if($id!='')
        {
         $id=base64_decode($id);
         $firstdata=User::where('id','=',$id)->first();
            if(User::where('id','=',$id)->delete())
    	   {
            if(file_exists(public_path().'/profilepics/'.$firstdata['user_pic']) && $firstdata['user_pic']!='' && !is_null($firstdata['user_pic']))
            {
              unlink(public_path().'/profilepics/'.$firstdata['user_pic']);
            }
          	return redirect('admin/users')->with('status', 'successfully deleted!');
    	   }	
        }
	}

  public function approvedornot(Request $request,$keyy=null,$id=null,$key=null)
  {
        if($id!='' && $key !='')
        {
         $id=base64_decode($id);
         $key=base64_decode($key);
         if(trim($key)=='1')
         {
          $newkey=0;
          $message="Your ad has been rejected by Admin";
         }
         if(trim($key)=='0')
         {
          $newkey=1;
          $message="Your ad has been added.";
         }
         if(Add::where('id','=',$id)->update(['status'=>$newkey]))
         {
          $adddataasd=Add::where('id','=',$id)->first();
          $userdatasdds=User::where('id','=',$adddataasd['user_id'])->first();
                   if($userdatasdds['apns_token']!='')
                    {
                    $response=PushNotification::app('appNameIOS')
                    ->to($userdatasdds['apns_token'])
                    ->send($message);
                    } 
                     if($userdatasdds['gcm_token']!='')
                    {
                    $response=PushNotification::app('appNameAndroid')
                    ->to($userdatasdds['gcm_token'])
                    ->send($message);
                    }
            return redirect('admin/products/'.$keyy)->with('status', 'successfully updated!');
         }  
        }
  }

  public function businesses(Request $request)
  {
     $id=Auth::id();
      $businessdata=Business::orderBy('created_at','=','DESC')->get();  
      //return $userdata;
    return view('admin.businesses')->with(compact('businessdata'));
  }

    public function addeditbusiness(Request $request,$id=null)
  {
        if(empty($request->all()))
        {
            if($id!='')
            {
               $id=base64_decode($id);
                  $businessdata=Business::where('id','=',$id)->first();
            }
            else
            {
              $businessdata=array();
            }
               $category=Category::get();
               return view('admin.addeditbusiness')->with(compact('businessdata','category'));
        }
        else
        {
         if($request->input('id')!='')
         {

            $this->validate($request, [
                   'business_name' => 'required|max:255|unique:businesses,business_name,'.$request->input('id'),
                   'business_address' => 'required|max:255',
                   'phone' => 'required|max:255',
                   'business_email' => 'required|email|max:255',
                   'about_us'=>'required|max:255',
                   'business_address'=>'required|max:255',
                      ]); 
            $newbusiness=Business::where('id','=',$request->input('id'))->first();
         }
         else
         {
        $this->validate($request, [
                   'business_name' => 'required|max:255|unique:businesses',
                   'business_address' => 'required|max:255',
                   'phone' => 'required|max:255',
                   'business_email' => 'required|email|max:255',
                   'about_us'=>'required|max:255',
                   'business_address'=>'required|max:255',

                          ]);  
          $newbusiness=new Business;
               $newbusiness->active=1;
         }

             if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
              $file = $request->logo;
              $image_file = $request->file('logo');
              $upload_path = '/logopics/';
              $destinationPath = public_path().$upload_path;
              $fileName = time(). '-' . $file->getClientOriginalName();
              $request->file('logo')->move($destinationPath, $fileName);
              $logo = $fileName;
                if($request->has('id') && $request->get('id')!='')
                {
                   if($newbusiness->logo!='' && !is_null($newbusiness->logo))
                   {
                    unlink($destinationPath.$newbusiness->logo);
                   }
                }
              $newbusiness->logo=$logo;
                }
                if ($request->hasFile('cover_picture') && $request->file('cover_picture')->isValid()) {
              $file = $request->cover_picture;
              $image_file = $request->file('cover_picture');
              $upload_path = '/coverpics/';
              $destinationPath = public_path().$upload_path;
              $fileName = time(). '-' . $file->getClientOriginalName();
              $request->file('cover_picture')->move($destinationPath, $fileName);
              $cover_picture = $fileName;
              if($request->has('id') && $request->get('id')!='')
                {
                   if($newbusiness->cover_picture!='' && !is_null($newbusiness->cover_picture))
                   {
                    unlink($destinationPath.$newbusiness->cover_picture);
                   }
                }
              $newbusiness->cover_picture=$cover_picture;
                }
             $newbusiness->website_url=$request->input('website_url');
             $newbusiness->facebook_page_url=$request->input('facebook_page_url'); 
             $newbusiness->category=$request->input('category');
             $newbusiness->business_name=$request->input('business_name');
             $newbusiness->business_email=$request->input('business_email');
             $newbusiness->about_us=$request->input('about_us');
             $newbusiness->business_address=$request->input('business_address');
             $newbusiness->latitude=$request->input('latitude');
             $newbusiness->longitude=$request->input('longitude');
             $newbusiness->phone=$request->input('phone');
              if($newbusiness->save())
             {
              return redirect('admin/businesses')->with('status', 'successfully updated!');
             }      
        }
  }

   public function deals(Request $request)
  {
     $id=Auth::id();
      $dealdata=Deal::with('businessinfo')->orderBy('created_at','=','DESC')->get();  
      //return $userdata;
    return view('admin.deals')->with(compact('dealdata'));
  }

    public function addeditdeal(Request $request,$id=null)
  {
        if(empty($request->all()))
        {
            if($id!='')
            {
               $id=base64_decode($id);
                  $dealdata=Deal::with('images')->where('id','=',$id)->first();
            }
            else
            {
              $dealdata=array();
            }
               $businessdata=Business::get();
               return view('admin.addeditdeal')->with(compact('dealdata','businessdata'));
        }
        else
        {
         if($request->input('id')!='')
         {

            $this->validate($request, [
                   'deal_name' => 'required|max:255|unique:deals,deal_name,'.$request->input('id'),
                   'fine_print'=>'required|max:255',
                   'about_deal'=>'required|max:255',
                   'deal_price'=>'required|max:255',
                   'total_deal'=>'required|max:255',
                     ]); 
            $newdeal=Deal::where('id','=',$request->input('id'))->first();
         }
         else
         {
        $this->validate($request, [
                   'deal_name' => 'required|max:255|unique:deals',
                   'fine_print'=>'required|max:255',
                   'about_deal'=>'required|max:255',
                   'deal_price'=>'required|max:255',
                   'total_deal'=>'required|max:255',
                          ]);  
          $newdeal=new Deal;
               $newdeal->active=1;
         }

             $newdeal->businessId=$request->input('businessId');
             $newdeal->deal_category=$request->input('deal_category');
             $newdeal->fine_print=$request->input('fine_print');
             $newdeal->deal_name=$request->input('deal_name');
             $newdeal->about_deal=$request->input('about_deal');
             $newdeal->deal_price=$request->input('deal_price');
             $newdeal->expiry_date=date('Y-m-d',strtotime($request->input('expiry_date')));
             $newdeal->total_deal=$request->input('total_deal');
             if($newdeal->save())
             {
                $files = Input::file('deal_pic');
                // Making counting of uploaded images
                $file_count = count($files);
                // start count how many uploaded
                $uploadcount = 0;
                if($file_count > 0)
                {
                  foreach($files as $file) {
                    $rules = array('file' => 'mimes:jpeg,png,bmp,jpg,gif,svg|max:2048'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                    $validator = Validator::make(array('file'=> $file), $rules);
                    if($validator->passes()){
                      $upload_path = '/dealpics/';
                      $destinationPath = public_path().$upload_path;
                      $filename = uniqid().'-'.$file->getClientOriginalName();
                      $upload_success = $file->move($destinationPath, $filename);
                      $uploadcount ++;
                      $newdealim=new DealImage;
                      $newdealim->deal_id=$newdeal->id;
                      $newdealim->image_name=$filename;
                      $newdealim->status=1;
                      $newdealim->save();
                    }
                  }
                }
                return redirect('admin/deals')->with('status', 'successfully updated!');
             }      
        }
  }

  public function viewdealimages(Request $request)
    {
        $post_data=$request->all();
        $dealpics=DealImage::where('deal_id','=',$post_data['id'])->get();
        return view('includes.viewdealimages')->with(compact('dealpics'));
    }

public function deletedealimage(Request $request ) 
    {
        $get_image=DealImage::where('id','=',$request->get('id'))->first();
          $upload_path = '/dealpics/';
          $destinationPath = public_path().$upload_path;
        if (DealImage::where('id','=',$request->get('id'))->delete())
        {
          unlink($destinationPath.$get_image->image_name);
          return "Success";
        }
        else
        {
          return "error";
        }
    }

   public function updateactivedeal(Request $request,$id=null,$key=null)
  {
        if($id!='' && $key !='')
        {
         $id=base64_decode($id);
         $key=base64_decode($key);
         if(trim($key)=='1')
         {
          $newkey=0;
         }
         if(trim($key)=='0')
         {
          $newkey=1;
         }
         if(Deal::where('id','=',$id)->update(['active'=>$newkey]))
         {
            return redirect('admin/deals')->with('status', 'successfully updated!');
         }  
        }
  }

    public function deletedeal(Request $request,$id=null)
  {
        if($id!='')
        {
         $id=base64_decode($id);
         $data=Deal::where('id','=',$id)->first();
            if($data['deal_pic']!='')
             {
                unlink(public_path().'/dealpics/'.$data['deal_pic']);
             }
             if($data['deal_cover_picture']!='')
             {
                unlink(public_path().'/dealcoverpics/'.$data['deal_cover_picture']);
             }
            if(Deal::where('id','=',$id)->delete())
         {
            return redirect('admin/deals')->with('status', 'successfully deleted!');
         }  
        }
  }

  public function addeditcategory(Request $request)
  {
       if($request->has('id') && $request->get('id'))
       {
           if(Category::where('id','!=',$request->get('id'))->where('category_name','=',$request->get('category_name'))->count())
           {
            return "error";
           }
        $catobj=Category::where('id','=',$request->get('id'))->first();

       }
       else
      {
        if(Category::where('category_name','=',$request->get('category_name'))->count())
           {
            return "error";
           }
        $catobj=new Category;
      }
       $catobj->category_name=$request->get('category_name');
       if($catobj->save())
       {
          $catgorydata=Category::orderBy('created_at','DESC')->get();
          $cateoption='';
          foreach ($catgorydata as $catgorydatas) {
            $cateoption.='<option value="'.$catgorydatas->id.'">'.$catgorydatas->category_name.'</option>';
          }
          $lasttr='<tr id="datacate'.$catobj->id.'">
                          <td>'.$catobj->category_name.'</td>
                          <td><a href="javascript:void(0);" data-name="'.$catobj->category_name.'" id="'.$catobj->id.'" class="editwordrow"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;<a href="javascript:void(0);" id="'.$catobj->id.'" class="deletecateraw"><i class="fa fa-close"></i></a></td>
                         </tr>';
          $resdata=array('tabledata'=>$lasttr,'seloptiondata'=>$cateoption);
          return $resdata;
       }
  }

   public function deletecategory(Request $request)
  {
        if(Category::where('id','=',$request->get('id'))->delete())
         {
            $catgorydata=Category::orderBy('created_at','DESC')->get();
          $cateoption='';
          foreach ($catgorydata as $catgorydatas) {
            $cateoption.='<option value="'.$catgorydatas->id.'">'.$catgorydatas->category_name.'</option>';
          }
          $resdata=array('message'=>'success','seloptiondata'=>$cateoption);
          return $resdata;
         }  
         else
         {
          return "error";
         }
  }
  
	
}
