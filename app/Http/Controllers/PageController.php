<?php

namespace App\Http\Controllers;
use Hash;
use Auth;
use App\Models\User;
use App\Models\account;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getsignup() {
        return view('account.signup');
    }

    public function getsignin() {
        return view('account.signin');
    }

    public function postsignup(Request $req) {
        $req->validate(
            [
                'username'=>'required|unique:account,username',
                'email'=>'required|email|unique:account,email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
                'repassword'=>'required|same:password',
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng emai',
                'email.unique'=>'Email có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'repassword:same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự'
            ]);
        $user = new Account();
        $user->username = $req->username;
        $user->fullname = $req->fullname;
        $user->email = $req->email;
        $user->address = $req->address;
        $user->password = Hash::make($req->password);
        $user->phoneNumber = $req->phoneNumber;
        $user->indentityCard = $req->indentityCard;
        $user->save(); 
        return redirect()->back()->with('success', 'Đăng kí thành công');
    }

    public function postsignin(Request $req) {
        $req->validate( [
            'email'=>'required|email',
            'password'=>'required|min:6|max:20'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'email không đúng định dạng',
            'password.required'=>'Vui lòng nhập password',
            'password.min'=>'password trên 6 kí tự',
            'password.max'=>'password dưới 20 kí tự',
        ]);

        $credentials = array('email'=>$req->email, 'password'=>$req->password);
        if(Auth::attempt($credentials)) {
            return redirect()->back()->with(['flag'=>'success', 'message'=>'Đăng nhập thành công']); 
        } else {
            return redirect()->back()->with(['flag'=>'danger', 'message'=>'Đăng nhập không thành công']);
        }
    }
}
