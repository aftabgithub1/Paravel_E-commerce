<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditProfilePost;
use App\Mail\PassChangeConfirm;
use App\User;
use Auth;
use Hash;
use Mail;
use Image;

class EditProfileController extends Controller
{
    public function userProfile(){
        return view('admin.users.edit_profile');
    }

    public function editName(Request $request){
        User::find(Auth::user()->id)->update(['name' => $request->name]);
        return back();
    }

    public function editEmail(Request $request){
        User::find(Auth::user()->id)->update(['email'=>$request->email]);
        return back();
    }

    public function editPassword(EditProfilePost $request){
		$old_password = $request->old_password;
		$db_password = Auth::user()->password;
		if (Hash::check($old_password, $db_password)){
			User::find(Auth::id())->update([
				'password'=> Hash::make($request->password)
			]);
			Mail::to(Auth::user()->email)->send(new PassChangeConfirm());
			return back()->with('passChangeAlert', 'Password Changed Successfully!');
		} else {
			return back()->with('passChangeAlert', "Old Password didn't match!");
		}
	}

    public function editImage(Request $request){
        if($request->hasFile('image')){
            $image_file = $request->file('image');
            $image_name = Auth::id().'.'.$image_file->extension();
            $location = public_path("uploads/users/$image_name");
            Image::make($image_file)
                ->resize(540, 540, function($constraint){$constraint->aspectRatio();})
                ->save($location);
            User::find(Auth::id())->update(['image'=>$image_name]);
        };
        return back();
    }
}
