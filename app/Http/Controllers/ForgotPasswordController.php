<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('forgot-pass.forgot-pass');
    }

    public function submitEmail(Request $request)
    {
        $user = NULL;
        
        $getUser = DB::table('users')->where('email', $request->email)->first();
        if($getUser !=  NULL){
            $user = $getUser;
        }
        
        $id             =   Crypt::encrypt($user->id);
        $data           =   ['name' => $user->first_name . " " . $user->last_name, 'email' =>  $user->email, 'id'   =>  $id];
        $email['to']    =   $user->email;
        
        Mail::send('forgot-pass.reset_pass', $data, function ($message) use ($email) {
            $message->to($email['to']);
            $message->subject("Reset Password Link From Task Management System");
        });
        
        return back()->with(['success'=>'Reset Password Link Has Sent To Your Email '.$user->email]);
    }

    public function resetPass($val)
    {
        $id = Crypt::decrypt($val);
        return view('forgot-pass.change-pass',['id' =>  $id]);
    }

    public function changePass(Request $request)
    {
        $request->validate([
            'password'  =>  'required|min:6|alpha_num'
        ]);
        $data = [
            'password'  =>  Hash::make($request->password)
        ];

        DB::table('users')->where('id',$request->id)->update($data);
        return redirect(url('/login'))->with(['success' =>  'Your Password Has Updated Successfully']);
    }
}
