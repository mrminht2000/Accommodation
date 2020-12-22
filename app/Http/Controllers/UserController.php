<?php

namespace App\Http\Controllers;
use Hash;
use Auth;
use DB;
use Session;
use App\Models\User;
use App\Models\Authaccount;
use App\Models\account;
use App\Models\housetype;
use App\Models\house;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getsignup() {
        if (Auth::guard('account')->user()) return redirect('index');
        else
            return view('account.signup');
    }

    public function getsignin() {
        if (Auth::guard('account')->user()) return redirect('index');
        else
            return view('account.signin');
    }

    //Xử lý đăng ký
    public function postsignup(Request $req) {
        //Kiểm tra thông tin đăng ký
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
        //Lưu thông tin đăng ký
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

        //Nếu tài khoản Owner thì cần phê duyệt
        if ($isOwner == 'true') {
            return redirect()->with('success', 'Đăng kí thành công, vui lòng xác nhận tài khoản trực tiếp với Admin để được sử dụng');
        }
        else return redirect()->with('success', 'Đăng kí thành công');
    }


    //Xử lý đăng nhập  
    public function postsignin(Request $req) {
        //Kiểm tra thông tin đăng nhập
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
            if(DB::table('account')->where('username',$req->username)->value('tinhtrang') == 1){
                return redirect()->back()->with(['flag'=>'danger', 'message'=>'Tài khoản đang bị khóa.']);
            } 
            else {
                if(DB::table('account')->where('username',$req->username)->value('isAdmin') == 0){
                    if(DB::table('account')->where('username',$req->username)->value('isApproval') == 0) 
                        return redirect()->back()->with(['flag'=>'danger', 'message'=>'Tài khoản chưa được phê duyệt, vui lòng liên hệ Admin.']);
                    else 
                        return redirect('index'); 
                } else {
                    return redirect('admin');
                }
            }
        } else {
            return redirect()->back()->with(['flag'=>'danger', 'message'=>'Đăng nhập không thành công']);
        }
    }

    //Xử lý đăng xuất
    public function getsignout() {
        Auth::logout();
        Session::flush();
        return redirect('index');
    }

    public function getprofile($id) {
        $mypost = house::where('idOwner',$id)->get();
        $housetype = housetype::all();
        $user = account::where('id',$id)->first();
        return view('account.profile', compact('mypost', 'housetype','user'));
    }
   

    public function getEditprofile($id){
        // $user = account::find(Auth::guard()->user()->id);
        $user = account::where('id', $id)->first();
        $housetype = housetype::all();
        return view('account.edit-profile', compact('user', 'housetype'));
     }
     public function postEditprofile(Request $request, $id){
        $housetype = housetype::all();
        // $user = account::find(Auth::guard()->user()->id);
        $user = account::where('id', $id)->first();
        if ($request->hasFile('avtuser')){
           $file = $request->file('avtuser');
           var_dump($file);
           $exten = $file->getClientOriginalExtension();
           if($exten != 'jpg' && $exten != 'png' && $exten !='jpeg' && $exten != 'JPG' && $exten != 'PNG' && $exten !='JPEG' )
               return redirect('account.edit-profile')->with('thongbao','Bạn chỉ được upload hình ảnh có định dạng JPG,JPEG hoặc PNG');
           $Hinh = 'avatar-'.$user->username.'-'.time().'.'.$exten;
           while (file_exists('uploads/avatars/'.$Hinh)) {
                $Hinh = 'avatar-'.$user->username.'-'.time().'.'.$exten;
           }
           if(file_exists($Hinh))
              unlink($Hinh);

           $file->move('uploads/avatars',$Hinh);
           $user->avatar = $Hinh;
        }
        $this->validate($request,[
              'fullname' => 'min:3|max:20'
           ],[
              'fullname.min' => 'Tên phải lớn hơn 3 và nhỏ hơn 20 kí tự',
              'fullname.max' => 'Tên phải lớn hơn 3 và nhỏ hơn 20 kí tự'
        ]);
        if(($request->password != '' ) || ($request->password != '')){
           $this->validate($request,[
              'password' => 'min:3|max:32',
              'password' => 'same:password',
           ],[
              'password.min' => 'password phải lớn hơn 3 và nhỏ hơn 32 kí tự',
              'password.max' => 'password phải lớn hơn 3 và nhỏ hơn 32 kí tự',
              'password.same' => 'Nhập lại mật khẩu không đúng',
              'password.required' => 'Vui lòng nhập lại mật khẩu',
           ]);
           $user->password = Hash::make($request->password);
        }
        
        $user->fullname = $request->fullname;
        $user->save();
        return redirect()->back()->with('thongbao','Cập nhật thông tin thành công');
        
        
     }
}
