<?php

namespace App\Http\Controllers;
use Hash;
use Auth;
use DB;
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
                'indentityCard'=>'required|unique:account,indentityCard',
                'phoneNumber'=>'required',
                'address'=>'required'
            ],
            [
                'username.required'=>'Vui lòng nhập tên đăng nhập',
                'username.unique'=>'Tên đăng nhập đã có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'repassword.required'=>'Vui lòng nhập lại mật khẩu',
                'repassword:same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự',
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng emai',
                'email.unique'=>'Email có người sử dụng',
                'fullname.required'=>'Vui lòng họ và tên',
                'indentityCard.required'=>'Vui lòng nhập CCCD',
                'indentityCard.unique'=>'CCCD này đã được đăng ký',
                'phoneNumber.required'=>'Vui lòng nhập số điện thoại',
                'address.required'=>'Vui lòng nhập địa chỉ'

            ]);
        $user = new Account();
        $user->username = $req->username;
        $user->fullname = $req->fullname;
        $user->email = $req->email;
        $user->address = $req->address;
        $user->password = Hash::make($req->password);
        $user->phoneNumber = $req->phoneNumber;
        $user->indentityCard = $req->indentityCard;
        $isOwner = $req->accounttype;
        if ($isOwner == 'true') {
            $user->isOwner = 1;
            $user->isApproval = 0;
        }
        else $user->isOwner = 0;
        $user->save(); 

        if ($isOwner == 'true') {
            return redirect()->back()->with('success', 'Đăng kí thành công, vui lòng xác nhận tài khoản trực tiếp với Admin để được sử dụng');
        }
        else return redirect()->back()->with('success', 'Đăng kí thành công');
    }

    public function postsignin(Request $req) {
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
        
        $credentials = array('username'=>$req->username, 'password'=>$req->password);
        if(Auth::attempt($credentials)) {
            if(DB::table('account')->select('isApproval')->where('username',$req->username)) 
                return redirect()->back()->with(['flag'=>'danger', 'message'=>'Tài khoản chưa được phê duyệt, vui lòng liên hệ Admin.']);
            else 
                return redirect()->back()->with(['flag'=>'success', 'message'=>'Đăng nhập thành công']); 
        } else {
            return redirect()->back()->with(['flag'=>'danger', 'message'=>'Đăng nhập không thành công']);
        }
    }
}
