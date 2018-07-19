<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\m_menu;
use App\m_menu_type;
use DB;

class MenuController extends Controller
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
            try {
                    //$menu = DB::table('m_menus')->join('m_menu_types', 'm_menus.id', '=', 'm_menu_types.menu_item_id')->select('m_menus.*', 'm_menu_types.type_name')->get();
                    //$res['success'] = true;
                    //$res['data'] = $menu;
                    //$res['count'] = $menu->count();
					$users = DB::select('SELECT * FROM users');
                    return response($users, 200);

                } 
                catch(\Illuminate\Database\QueryException $ex)
                {
                     $res['success'] = false;
                     $res['message'] = $ex->getMessage();
                     return response($res, 500);

                }
            
    }

    public function detail($id)
    {
        try {
            //$menu = DB::table('m_menus')->join('m_menu_types', 'm_menus.id', '=', 'm_menu_types.menu_item_id')->where('m_menus.id','=',$id)->select('m_menus.*', 'm_menu_types.type_name')->get();
            //$res['success'] = true;
            // $res['data'] = $menu[0];
            //$res['count'] = $menu->count();
			$single_user = DB::select('SELECT * FROM users WHERE id=?',[$id]);
            return response($single_user, 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            $res['success'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 500);
        }
    }

    public function save(Request $request)
    {
        try {

            $m_menu = new m_menu();
            $name = $request->input('name');
            $price = $request->input('price');
            $note = $request->input('note');
            $save = m_menu::create([
                'name'=> $name,
                'price'=> $price,
                'note'=> $note,
            ]);
            //Adding to gurantor 
            m_menu_type::create([
                'menu_item_id'=>$menu_item_id = $m_menu->id,
                'type_name' =>$request->input('type_name')
           ]);

            $res['success'] = true;
            return response($res, 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            $res['success'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 500);
        }
    }

    public function update(Request $req)
    {
        try {
            $menu = m_menu::find($req->input("id"));
            if ($menu) {
                $menu->name = $req->input("name");
                $menu->price = $req->input("price");
                $menu->note = $req->input("note");
                $menu->save();
                $res['success'] = true;
                return response($res, 200);
            } else {
                $res['success'] = false;
                $res['message'] = 'Menu not found';
                return response($res, 200);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            $res['success'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 500);
        }
    }

    public function delete($id)
    {
      try {
          $menu = m_menu::find($id);
          if ($menu) {
              $menu->delete();
              $res['success'] = true;
              return response($res, 200);
          } else {
              $res['success'] = false;
              $res['message'] = 'Menu not found';
              return response($res, 200);
          }
      } catch (\Illuminate\Database\QueryException $ex) {
          $res['success'] = false;
          $res['message'] = $ex->getMessage();
          return response($res, 500);
      }
    }

    
}
