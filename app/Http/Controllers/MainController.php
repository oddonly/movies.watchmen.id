<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use validator;
use Auth;
use Session;
use DB;
class MainController extends Controller
{
	
	
    function index()
	{
		return view('login');
	}
	
	function checklogin(Request $request)
	{
		 if($request->isMethod('post')){
            $data = $request->input();
             if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                //echo "Success"; die;
				/*Session::put('adminSession',$data['email']);*/
				  //$research = DB::table('users')->where('user_id', Auth::id())->get();
				 // echo $research; die;
       			 return redirect('home');
            }else{
                //echo "failed"; die;
               return redirect('/login')->with('error', 'Invalid Username and Password');
            }
        }
        return view('/login');
	}
	
	 public function dashboard(){
        /*if(Session::has('adminSession')){
            //Perform all dashboard tasks
        }else{
            return redirect('/admin')->with('flash_message_error','Please login to access');
        }*/
        return view('dashboard');
    }
	
	function logout()
	{
		Session::flush();
		return redirect('login');
	}
	
}
