<?php

namespace App\Http\Controllers;

use App\pengguna;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    public function index(Request $request, Redirector $redirect)
    {

        switch ($request->method()) {
            case 'POST':

                $username = $request->username;
                $password = $request->password;

                $data = Pengguna::where('username', $username)->first();
                if ($data) {
                    //apakah email tersebut ada atau tidak

                    if ($data->password === md5($password)) {
                        $request->session()->put('user_id', $data->id);
                        $request->session()->put('user_username', $data->username);
                        $request->session()->put('user_level', $data->level);
                        //echo Session::get('user_level');
                        // echo $data->level;
                        // exit();
                        

                        return redirect($data->level);
                    } else {
                        return $redirect->to('/')->with('alert-danger', 'Password atau Email salah !')->send();
                    }
                } else {
                    return $redirect->to('/')->with('alert-danger', 'Password atau Email salah !')->send();
                }

                break;

            case 'GET':

                return view('web.login');
                break;

            default:
                # code...
                break;
        }

    }

    public function logout(){
        Session::flush();
        return redirect('/')->with('alert-danger','Kamu sudah logout');
    }
}
