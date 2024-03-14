<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function bangla(){
        //session()->get('language');
        session()->forget('language');
        Session::put('language','bangla');

        // Redirect back with a success message
		$notification = array(
			'message' => 'Language changed into Bangla successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
    }
 
    public function english(){
        //session()->get('language');
        session()->forget('language');
        Session::put('language','english');

        // Redirect back with a success message
		$notification = array(
			'message' => 'Language changed into English successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
    }
}
