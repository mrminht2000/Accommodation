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

    public function getIndex() {
        return view('home.index');
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
        
         //Kiểm tra file 
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
         //Tiện ích
         $json_tienich = json_encode($request->tienich,JSON_FORCE_OBJECT);
         /* ----*/ 
         //Lấy LaTLng cho Google Map 
         $arrlatlng = array();
         $arrlatlng[] = $request->txtlat;
         $arrlatlng[] = $request->txtlng;
         $json_latlng = json_encode($arrlatlng,JSON_FORCE_OBJECT);

         /* --- */
         // Phòng trọ mới
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
