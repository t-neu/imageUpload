<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Image;
use DB;

class UserController extends Controller
{
    //
    public function profile(){
    	if (Auth::check())
		{
		    return view('profile', array('user' => Auth::user()) );
		}else{
			return view('/auth/login');
		}
   
    }

    public function update_avatar(Request $request){

    	//enter fields from the form to be saved 

    	$theFields = Array('first_name', 'last_name', 'email');
    	$user = Auth::user();
    	foreach($theFields as $field) {
    		if($request->input($field)){
		    	$user->$field = $request->input($field);
    		}
    	}
		$user->save();
    	// Handle change in a text input box
    	/*
    	if($request->input('first_name')){
    		$first_name = $request->input('first_name');
    		$user = Auth::user();
	    	$user->first_name = $first_name;
	    	$user->save();
    	}
    	if($request->input('last_name')){
    		$last_name = $request->input('last_name');
    		$user = Auth::user();
	    	$user->last_name = $last_name;
	    	$user->save();
    	}
    	*/
    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		//check if the file is an image
    		if(substr($avatar->getMimeType(), 0, 5) == 'image') {
			    // this is an image
			    $filename = time() . '.' . $avatar->getClientOriginalExtension();
	    		//public_path likes to the public folder
	    		Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

	    		//save the image to the database under avatar
	    		$user = Auth::user();
	    		$user->avatar = $filename;
	    		$user->save();
	    		return view('profile', array('user' => Auth::user()) );
			}else{
				return view('profile')
					->with('badFile', '1')
					->with('user', Auth::user());
			}
    	}
    	return view('profile', array('user' => Auth::user()) );

    }
    public function gallery(){
    	if (Auth::check())
		{
		    $imagelist = DB::table('images')->where('user_id', '1')->pluck('image');
			return view('gallery')
				->with('imagelist', $imagelist)
				->with('user', Auth::user());
			}else{
				return view('/auth/login');
			}
    }
    public function update_gallery(Request $request){

    	// Handle the user upload of an image
    	if($request->hasFile('image')){
    		$image = $request->file('image');
    		//check if the file is an image
    		if(substr($image->getMimeType(), 0, 5) == 'image') {
			    // this is an image
			    $filename = time() . '.' . $image->getClientOriginalExtension();
	    		//public_path likes to the public folder
	    		Image::make($image)->resize(300, 300)->save( public_path('/uploads/gallery/' . $filename ) );

	    		//save the image to the database under avatar
	    		
	    		DB::table('images')->insert(
    			['user_id' => Auth::id(), 'image' => $filename]
				);
				$imagelist = DB::table('images')->where('user_id', '1')->pluck('image');
				return view('gallery')
					->with('imagelist', $imagelist)
					->with('user', Auth::user());
				//return view('gallery', array('user' => Auth::user()) );
			}else{
				return view('gallery')
					->with('badFile', '1')
					->with('user', Auth::user());
			}
    	}
    	return view('gallery', array('user' => Auth::user()) );

    }
}