<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use DB;
use App\Models\User;
use App\Models\house;
use App\Models\account;
use App\Models\housetype;
use App\Models\districts;
use App\Models\choosedhouse;
use App\Models\provinces;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class AdminController extends Controller
{
    public function getIndex(){
        $total_account = account::where('isApproval',1)->get()->count();
        // $total_users_deactive = User::where('tinhtrang',0)->get()->count();
        $total_house_approve = house::where('isApproval',1)->get()->count();
        $total_house_unapprove = house::where('isApproval',0)->get()->count();
        
        return view('admin.index', compact('total_account', 'total_house_approve', 'total_house_unapprove'));
    }

    public function getadminlogin() {
        return view('admin.login');
    }

    public function postadminlogin(Request $req) {
        $req->validate( [
            'username'=>'required',
            'password'=>'required|min:0|max:20'
        ],
        [
            'username.required'=>'Vui lòng nhập tên đăng nhập',
            'password.required'=>'Vui lòng nhập password',
            'password.min'=>'password trên 0 kí tự',
            'password.max'=>'password dưới 20 kí tự',
        ]);
        
        //Kiểm tra đăng nhập đúng hay chưa
        $credentials = array('username'=>$req->username, 
                             'password'=>$req->password);

                             if(Auth::guard('account')->attempt($credentials)) {
                                if(DB::table('account')->where('username',$req->username)->value('isAdmin') == 1) 
                                    return view('admin.index');
                               
                            } else {
                                return redirect()->back()->with('thongbao','Đăng nhập không thành công');
                            }
    }
}
