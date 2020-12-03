<?php

namespace App\Http\Controllers;
use Hash;
use Auth;
use DB;
use App\Models\User;
use App\Models\house;
use App\Models\account;
use App\Models\housetype;
use App\Models\districts;
use App\Models\choosedhouse;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class PageController extends Controller
{

   public function getIndex() {
      $newHouse = house::all();
      return view('home.index', compact('newHouse'));
   }

   public function get_dangtin() {
      $quan_huyen = districts::all();
      $danh_muc = housetype::all();
      return view('account.dangtin',[
         'quan_huyen'=>$quan_huyen,
         'danh_muc'=>$danh_muc
      ]);
   }

   public function post_dangtin(Request $request) {
      $request->validate([
         'title' => 'required',
         //'address' => 'required',
         'price' => 'required',
         'size' => 'required',
         'phoneNumber' => 'required',
        'description' => 'required',
         'electricPrice' => 'required',
         'waterPrice' => 'required'
            
      ],
      [  
         'title.required' => 'Nhập tiêu đề bài đăng',
        // 'address.required' => 'Nhập địa chỉ phòng trọ',
         'price.required' => 'Nhập giá thuê phòng trọ',
         'size.required' => 'Nhập diện tích phòng trọ',
         'phoneNumber.required' => 'Nhập SĐT chủ phòng trọ (cần liên hệ)',
         'description.required' => 'Nhập mô tả ngắn cho phòng trọ',
         'electricPrice.required' => 'Nhập giá điện phòng trọ',
         'waterPrice.required' => 'Nhập giá nước phòng trọ',
      ]);
        
      //Kiểm tra file 
      $json_img ="";
      $random = Str::random(5);
      if ($request->hasFile('hinhanh')){
         $arr_images = array();
         $inputfile =  $request->file('hinhanh');
         foreach ($inputfile as $filehinh) {
            $namefile = "phongtro-".Str::random(5)."-".$filehinh->getClientOriginalName();
            while (file_exists('uploads/images'.$namefile)) {
               $namefile = "phongtro-".$random."-".$filehinh->getClientOriginalName();
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
         //$json_tienich = json_encode($request->tienich,JSON_FORCE_OBJECT);
         /* ----*/ 
         
      /* New Phòng trọ */
      $house = new house;
      $house->title = $request->title;
      $house->description = $request->description;
      $house->price = $request->price;
      $house->pricePer = 'month';
      $house->size = $request->size;
      $house->count_view = 0;
      $house->address = 'Hà Nội';
      $house->bathroom = $request->bathroom;
      $house->kitchen = $request->kitchen;
      $house->airConditioner = (int)$request->air_conditioning;
      $house->balcony = (int)$request->balcony;
      //$house->latlng = $json_latlng;
      $house->otherUltilities = 'Add more...';
      $house->image = $json_img;
      $house->idOwner = Auth::guard()->user()->id;
      $house->id_type = $request->id_type;
      $house->id_districts = $request->id_districts;
      $house->phoneNumber = $request->phoneNumber;
      $house->electricPrice = $request->electricPrice;
      $house->waterPrice = $request->waterPrice;
      $house->save();
      return redirect()->back()->with('success','Đăng tin thành công. Vui lòng đợi Admin kiểm duyệt');
   }


    // public function gethousetype($type) {
    //     $house_type = housetype::all();
    //     return view('page.danhmuc', ['danh_muc'=> $house_type]);
    // }

    // public function getMotelByCategoryId($id){
		
	// 	$Categories = housetype::all();
	// 	return view('page.danhmuc',['categories'=>$Categories]);
   // }
   
   //Xử lý trang danh sách theo dõi
   public function getFollow(Request $req) {
      if (!choosedhouse::select('idRenter','idHouse')
                       ->where('idRenter',Auth::guard()->user()->id)
                       ->where('idHouse',(int)$req->id)->first()) {
         $choosedHouse = new choosedhouse;
         $choosedHouse->idRenter = Auth::guard()->user()->id;
         $choosedHouse->idHouse = (int)$req->id;
         $choosedHouse->save();
         return redirect()->back()->with('success','Đã theo dõi');
      }
   }

   public function getCart() {
      return view('page.theodoi');
   }

   public function getchitietPhongtro(Request $req) {
      $house = house::where('id', $req->id)->first();
        return view('home.chitietphong', compact('house'));
   }
}
