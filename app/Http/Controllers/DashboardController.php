<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $this_device_session = \Session::getId();
        if(!Auth::user()){
            return redirect()->route('login');
        }

        //check in sessions table. If record exist then delete it skipping the current session.
        if(DB::table('sessions')->where('id','!=',$this_device_session)->where('user_id',Auth::user()->id)->exists()) {
            //delete their session
            DB::table('sessions')->where('id','!=',$this_device_session)->where('user_id',Auth::user()->id)->delete();
        }

        return view('pages.dashboard');
    }
}
