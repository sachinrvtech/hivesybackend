<?php

namespace App\Http\Controllers\Api;
use Mail;
use App\Mail\NewPassword;
use App\Mail\NewRegisteration;
use App\User;
use Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class UserController extends Controller
{
       use SendsPasswordResetEmails;

    public function login(Request $request) {
        

        //$rules['email'] = 'required';
        $rules['password']  = 'required';
                $check = User::checkUser($request->all());
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails() || !isset($check['id'] )){
            $result['errors'] = array_merge($check, $validator->errors()->toArray());
            return $result;
        }

        try {
            if($request->has('latitude') && $request->has('longitude'))
            {
            User::where('id','=',$check['id'])->update(['latitude'=>$request->get('latitude'),'longitude'=>$request->get('longitude')]);
            }
            $user = User::find($check['id']);
            $token = $user->createToken($check['id'] . ' token ')->accessToken;
            $result['access_token'] = $token;
            $result['user'] = $user;
        }catch (\Exception $e) {
            $result = [
                  'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
            ];
            Log::error($e->getTraceAsString());
        }

        return $result;

    }


    public function signup(Request $request) {
           
       try
       {
            
                    //return $request->all();
        $rules = [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
             ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $result['errors'] = $validator->errors()->toArray();
                return $result;
            }
            if ($request->hasFile('user_pic') && $request->file('user_pic')->isValid()) {
            $file = $request->user_pic;
            $image_file = $request->file('user_pic');
            $upload_path = '/profilepics/';
            $destinationPath = public_path().$upload_path;
            $fileName = time(). '-' . $file->getClientOriginalName();
            $request->file('user_pic')->move($destinationPath, $fileName);
            $image = $fileName;
            }
            else
            {
            $image = " ";
            }
               $user = User::create([
                'username' => $request->get('username'),
                'name' => $request->get('name'),
                'role'=>2,
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'user_pic'=>$image,
                'user_phone'=>$request->get('user_phone'),
                'active'=>1,
                'facebook_id'=>'',
                'google_id'=>'',
                'zip_code'=>$request->get('zip_code'),
                'promo_code'=>$request->get('promo_code'),
                'TnC'=>$request->get('TnC'),
                'latitude'=>$request->get('latitude'),
                'longitude'=>$request->get('longitude'),
                 ]);
            $result['user'] = $user;
            $token = $user->createToken($user->id . ' token ')->accessToken;
            $result['access_token'] = $token;
            $result['user'] = $user->toArray();
           /* Mail::to($user)->send(new NewRegisteration($user,$confirmation_code));
            $result['message'] = "Thanks for signing up! Please check your email.";*/
            }catch (\Exception $e) {
            $result = [
                'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
            ];
            Log::error($e->getTraceAsString());
        }
          
        return $result;
    }

    public function forget_password(Request $request) {


        $rules = [
            'email' => 'required|email|max:255'
        ];

        try {
            $user = User::where('email', $request->get('email'))->first();

            $validator = Validator::make($request->all(), $rules);

            if (!isset($user) || $validator->fails() || !$user->exists()) {
                $result['errors'][] = 'Check your email';
                return $result;
            }

            $random_pass = str_random(8);
            $user->password=bcrypt($random_pass);
            $user->save();

            Mail::to($user)->send(new NewPassword($user,$random_pass));

            $result['message'] = 'Please check your email to reset password';
        }catch (\Exception $e) {
            $result = [
                'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
            ];
            Log::error($e->getTraceAsString());
        }

        return $result;
    }
     public function user_profile(Request $request) {
      

       
        $user = User::get();

        if($user != null) {
            $result['message'] = 'success';
            $result['user'] = $user->toArray();
        }

        return $result;
    }
    public function fileuploadtesting(Request $request)
    {
        if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {
            $file = $request->profile_image;
            $image_file = $request->file('profile_image');
            $upload_path = '/profilepics/';
            $destinationPath = public_path().$upload_path;
            $fileName = time(). '-' . $file->getClientOriginalName();
            $request->file('profile_image')->move($destinationPath, $fileName);
            $image = $fileName;
            }
            else
            {
            $image = "no image";
            }
            return $image;
    }


     public function facebooklogin(Request $request) {
           try {
                $post_data=$request->all();
                if($post_data['login_with']=="facebook")
                {
                $count1=User::where('email','=',$post_data['email'])->where('facebook_id','=',$post_data['facebook_id'])->count();
                $count2=User::where('email','!=',$post_data['email'])->where('facebook_id','=',$post_data['facebook_id'])->count();
                $count3=User::where('email','=',$post_data['email'])->where('facebook_id','!=',$post_data['facebook_id'])->count();
               // return "first:".$count1."second:".$count2."third:".$count3;
               // $count4=User::where('email','=',$post_data['email'])->count();
               if($count1 && !$count2 && !$count3)
                {
                $userobj=User::where('email','=',$post_data['email'])->where('facebook_id','=',$post_data['facebook_id'])->first();
                }
                else if(!$count1 && $count2 && !$count3)
                {
                $userobj=User::where('email','!=',$post_data['email'])->where('facebook_id','=',$post_data['facebook_id'])->first();
                   $userobj->email=$post_data['email'];
                }
                else if(!$count1 && !$count2 && $count3)
                {
                $userobj=User::where('email','=',$post_data['email'])->where('facebook_id','!=',$post_data['facebook_id'])->first();
                $userobj->facebook_id=$post_data['facebook_id'];
                }
                else
                {
                $userobj=new User;
                $userobj->facebook_id=$post_data['facebook_id'];
                $userobj->role=2;
                $userobj->email=$post_data['email'];
                $userobj->active=1;
                $userobj->password=bcrypt(rand(999999,6));
                }
                $userobj->username=rand(999999999,9).str_replace(' ','',$post_data['name']); 
                $userobj->user_pic=$post_data['user_pic'];
                $userobj->user_phone=$post_data['user_phone'];
                $userobj->zip_code=$post_data['zip_code'];
                $userobj->TnC=$post_data['TnC'];
                $userobj->latitude=$post_data['latitude']; 
                $userobj->longitude=$post_data['longitude']; 
                  $userobj->name=$post_data['name'];
                  $userobj->save();
                }
                elseif($post_data['login_with']=="google")
                {
                $count1=User::where('email','=',$post_data['email'])->where('google_id','=',$post_data['google_id'])->count();
                $count2=User::where('email','!=',$post_data['email'])->where('google_id','=',$post_data['google_id'])->count();
                $count3=User::where('email','=',$post_data['email'])->where('google_id','!=',$post_data['google_id'])->count();
                //return $count3;
               // $count4=User::where('email','=',$post_data['email'])->count();
                if($count1 && !$count2 && !$count3)
                {
                $userobj=User::where('email','=',$post_data['email'])->where('google_id','=',$post_data['google_id'])->first();
                }
                else if(!$count1 && $count2 && !$count3)
                {
                $userobj=User::where('email','!=',$post_data['email'])->where('google_id','=',$post_data['google_id'])->first();
                   $userobj->email=$post_data['email'];
                }
                else if(!$count1 && !$count2 && $count3)
                {
                $userobj=User::where('email','=',$post_data['email'])->where('google_id','!=',$post_data['google_id'])->first();
                $userobj->google_id=$post_data['google_id'];
                }
                else
                {
                $userobj=new User;
                $userobj->google_id=$post_data['google_id'];
                $userobj->role=2;
                $userobj->email=$post_data['email'];
                $userobj->active=1;
                $userobj->password=bcrypt(rand(999999,6));
                }
                $userobj->username=rand(999999999,9).str_replace(' ','',$post_data['name']); 
                $userobj->user_pic=$post_data['user_pic'];
                $userobj->user_phone=$post_data['user_phone'];
                $userobj->zip_code=$post_data['zip_code'];
                $userobj->TnC=$post_data['TnC'];
                $userobj->latitude=$post_data['latitude']; 
                $userobj->longitude=$post_data['longitude']; 
                  $userobj->name=$post_data['name'];
                  $userobj->save();
                }
                else
                {
                    $result['message']="something went wrong";
                    return $result;
                }
            $user = User::find($userobj->id);
            $token = $user->createToken($user->id . ' token ')->accessToken;
            $result['access_token'] = $token;
            $result['user'] = $user;
        }catch (\Exception $e) {
            $result = [
                  'error' => $e->getMessage().' Line No '. $e->getLine(). ' in File'. $e->getFile()
            ];
            Log::error($e->getTraceAsString());
        }

        return $result;

    }
}
