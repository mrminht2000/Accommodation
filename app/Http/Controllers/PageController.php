<?php

namespace App\Http\Controllers;
use Hash;
use Auth;
use DB;
use App\Models\User;
use App\Models\account;
use App\Models\housetype;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getsignup() {
        return view('account.signup');
    }

    public function getsignin() {
        return view('account.signin');
    }

    //  public function getDanhmuc($type) {
    //      $danhmuc = housetype::where('id', $type)->first();
    //      return view('');
    //  }

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
            return redirect()->back()->with('success', 'Đăng kí thành công, vui lòng xác nhận tài khoản trực tiếp với Admin để được sử dụng');
        }
        else return redirect()->back()->with('success', 'Đăng kí thành công');
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
        $credentials = array('username'=>$req->username, 'password'=>$req->password);
        if(Auth::attempt($credentials)) {
            if(DB::table('account')->where('username',$req->username)->value('isApproval') == 0) 
                return redirect()->back()->with(['flag'=>'danger', 'message'=>'Tài khoản chưa được phê duyệt, vui lòng liên hệ Admin.']);
            else 
                return redirect()->back()->with(['flag'=>'success', 'message'=>'Đăng nhập thành công']); 
        } else {
            return redirect()->back()->with(['flag'=>'danger', 'message'=>'Đăng nhập không thành công']);
        }
    }

    public function get_dangtin() {
        return view('account.dangtin');
    }

    public function post_dangtin(Request $request) {
        $request->validate([
            'title' => 'required',
            'address' => 'required',
            'price' => 'required',
            'size' => 'required',
            'phoneNumber' => 'required',
            'describe' => 'required',
            
         ],
         [  
            'title.required' => 'Nhập tiêu đề bài đăng',
            'address.required' => 'Nhập địa chỉ phòng trọ',
            'price.required' => 'Nhập giá thuê phòng trọ',
            'size.required' => 'Nhập diện tích phòng trọ',
            'phoneNumber.required' => 'Nhập SĐT chủ phòng trọ (cần liên hệ)',
            'describe.required' => 'Nhập mô tả ngắn cho phòng trọ',
         ]);
        
         /* Check file */ 
         $json_img ="";
         if ($request->hasFile('hinhanh')){
            $arr_images = array();
            $inputfile =  $request->file('hinhanh');
            foreach ($inputfile as $filehinh) {
               $namefile = "phongtro-".str_random(5)."-".$filehinh->getClientOriginalName();
               while (file_exists('uploads/images'.$namefile)) {
                 $namefile = "phongtro-".str_random(5)."-".$filehinh->getClientOriginalName();
               }
              $arr_images[] = $namefile;
              $filehinh->move('uploads/images',$namefile);
            }
            $json_img =  json_encode($arr_images,JSON_FORCE_OBJECT);
         }
         else {
            $arr_images[] = "no_img_room.png";
            $json_img = json_encode($arr_images,JSON_FORCE_OBJECT);
         }
         /* tiện ích*/
         $json_tienich = json_encode($request->tienich,JSON_FORCE_OBJECT);
         /* ----*/ 
         /* get LatLng google map */ 
         $arrlatlng = array();
         $arrlatlng[] = $request->txtlat;
         $arrlatlng[] = $request->txtlng;
         $json_latlng = json_encode($arrlatlng,JSON_FORCE_OBJECT);

         /* --- */
         /* New Phòng trọ */
         $house = new house;
         $house->title = $request->title;
         $house->describe = $request->describe;
         $house->price = $request->price;
         $house->size = $request->size;
         $house->count_view = 0;
         $house->address = $request->address;
         $house->latlng = $json_latlng;
         $house->utilities = $json_tienich;
         $house->image = $json_img;
         $house->idOwner = Auth::account()->id;
         $house->category_id = $request->idcategory;
         $house->district_id = $request->iddistrict;
         $house->phoneNumber = $request->phoneNumber;
         $house->save();
         return redirect()->with('success','Đăng tin thành công. Vui lòng đợi Admin kiểm duyệt');
    }


    public function gethousetype($type) {
        $house_type = housetype::all();
        return view('page.danhmuc', ['danh_muc'=> $house_type]);
    }

    public function getMotelByCategoryId($id){
		
		$Categories = housetype::all();
		return view('page.danhmuc',['categories'=>$Categories]);
	}
}
