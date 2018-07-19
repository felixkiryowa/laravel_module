<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }   

    public function list(){

           $users = DB::select('select  * FROM users');
           $res = $users;
           return response($res, 200);
            
    }
     public function detail($id)
    {
             $users = DB::select('select  * FROM users where id =?',[$id]);
             $res = $users;
             return response($res, 200);
       
    }
}
