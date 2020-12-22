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
        $total_users_deactive = account::where('isApproval',0)->get()->count();
        $total_house_approve = house::where('isApproval',1)->get()->count();
        $total_house_unapprove = house::where('isApproval',0)->get()->count();
        
        return view('admin.index', compact('total_account', 'total_house_approve','total_users_deactive', 'total_house_unapprove'));
    }

    /* house */
    public function getListHouse() {
        $house = house::all();
        return view('admin.house.listhouses', compact('house'));
    }

    public function ApproveHouse($id) {
        $house = house::find($id);
        $house->isApproval = 1;
        $house->save();
        return redirect('house/list')->with('thongbao','Đã kiểm duyệt bài đăng: '.$house->title);
    }

    public function UnApproveHouse($id) {
        $house = house::find($id);
        $house->isApproval = 0;
        $house->save();
        return redirect('house/list')->with('thongbao','Đã hủy bỏ kiểm duyệt bài đăng: '.$house->title);
    }

    public function DelHouse($id) {
        $house = house::find($id);
        $house->delete();
        return redirect('house/list')->with('thongbao','Đã xóa bài đăng');
    }

    /* Account /*/
    public function getListAccount() {
        $user = account::all();
        return view('admin.accounts.listaccount', compact('user'));
    }

    public function getUpdateAccount($id) {
        $user = account::find($id);
        return view('admin.accounts.edit',compact('user'));
    }
    
    public function postUpdateAccount(Request $req, $id) {
        $req->validate([
            'fullname' => 'required'
          ],[
            'fullname.required' => 'Vui lòng nhập đầy đủ Họ Tên'
          ]);
            $user = account::find($id);
            $user->fullname = $req->fullname;
            $user->tinhtrang = (int)$req->tinhtrang;
    
            if($req->password != ''){
            $this->validate($req,[
                'password' => 'min:3|max:32',
                'repassword' => 'same:password',
            ],[
                'password.min' => 'password phải lớn hơn 3 và nhỏ hơn 32 kí tự',
                'password.max' => 'password phải lớn hơn 3 và nhỏ hơn 32 kí tự',
                'repassword.same' => 'Nhập lại mật khẩu không đúng',
                'repassword.required' => 'Vui lòng nhập lại mật khẩu',
            ]);
            $user->password = bcrypt($req->password);
            }
    
            
            $user->save();
            return redirect('edit/'.$id)->with('thongbao','Chỉnh sửa thành công tài khoản '.$req->username.' .');
    }
}
