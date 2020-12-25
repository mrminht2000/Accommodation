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
use App\Models\provinces;
use App\Models\review;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class PageController extends Controller
{

   public function getIndex()
   {
      $newHouse = house::all();
      $provinces = provinces::all();
      $danh_muc = housetype::all();
      return view('home.index', compact('newHouse', 'provinces', 'danh_muc'));
   }

   public function getdistricts(Request $req)
   {
      $provinceid = $req->province_id;
      if ($provinceid) {
         $districts = districts::where('province_id', $provinceid)->get();
         return response(['data' => $districts]);
      }
   }


   public function get_dangtin(Request $req)
   {
      $provinces = provinces::all();
      $danh_muc = housetype::all();
      return view('account.dangtin', compact('provinces', 'danh_muc'));
   }



   public function post_dangtin(Request $request)
   {
      $request->validate(
         [
            'title' => 'required',

            'price' => 'required',
            'size' => 'required',
            'phoneNumber' => 'required',
            'description' => 'required',
            'electricPrice' => 'required',
            'waterPrice' => 'required'

         ],
         [
            'title.required' => 'Nhập tiêu đề bài đăng',

            'price.required' => 'Nhập giá thuê phòng trọ',
            'size.required' => 'Nhập diện tích phòng trọ',
            'phoneNumber.required' => 'Nhập SĐT chủ phòng trọ (cần liên hệ)',
            'description.required' => 'Nhập mô tả ngắn cho phòng trọ',
            'electricPrice.required' => 'Nhập giá điện phòng trọ',
            'waterPrice.required' => 'Nhập giá nước phòng trọ',
         ]
      );

      //Kiểm tra file 
      $json_img = "";
      $random = Str::random(5);
      if ($request->hasFile('hinhanh')) {
         $arr_images = array();
         $inputfile =  $request->file('hinhanh');
         foreach ($inputfile as $filehinh) {
            $namefile = "phongtro-" . Str::random(5) . "-" . $filehinh->getClientOriginalName();
            while (file_exists('uploads/images' . $namefile)) {
               $namefile = "phongtro-" . $random . "-" . $filehinh->getClientOriginalName();
            }
            $arr_images[] = $namefile;
            $filehinh->move('uploads/images', $namefile);
         }
         $json_img =  json_encode($arr_images, JSON_FORCE_OBJECT);
      } else {
         $arr_images[] = "no_img_room.png";
         $json_img = json_encode($arr_images, JSON_FORCE_OBJECT);
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
      $house->province_id = (int)$request->province_id;
      $house->bathroom = (int)$request->bathroom;
      $house->kitchen = $request->kitchen;
      $house->airConditioner = (int)$request->air_conditioning;
      $house->balcony = (int)$request->balcony;

      $house->otherUltilities = 'Add more...';
      $house->image = $json_img;
      $house->idOwner = Auth::guard()->user()->id;
      $house->id_type = $request->id_type;
      $house->id_districts = (int)$request->id_districts;
      $house->phoneNumber = $request->phoneNumber;
      $house->electricPrice = $request->electricPrice;
      $house->waterPrice = $request->waterPrice;
      $house->province_id = (int)$request->province_id;
      $house->save();
      return redirect()->back()->with('success', 'Đăng tin thành công. Vui lòng đợi Admin kiểm duyệt');
   }




   //Xử lý trang danh sách theo dõi
   public function getFollow(Request $req)
   {
      if (!Auth::guard()->user()) return redirect('dang-nhap');
      if (!choosedhouse::select('idRenter', 'idHouse')
         ->where('idRenter', Auth::guard()->user()->id)
         ->where('idHouse', (int)$req->id)->first()) {
         $choosedHouse = new choosedhouse;
         $choosedHouse->idRenter = Auth::guard()->user()->id;
         $choosedHouse->idHouse = (int)$req->id;
         $choosedHouse->save();
      }
      return redirect()->back();
   }

   public function getCart()
   {
      $housefollow = choosedhouse::where('idRenter', Auth::guard('account')->user()->id)->get();
      return view('page.theodoi', compact('housefollow'));
   }

   public function deleteFollow(Request $req) {
      choosedhouse::where('id',$req->id)->first()->delete();
      return redirect()->back();
   }


   public function getchitietPhongtro(Request $req)
   {
      $house = house::where('id', $req->id)->first();
      $provinces = provinces::where('id', $req->province_id)->first();
      $districts = districts::where('id', $req->id_districts)->first();
      $current_view = house::where('id', $req->id)->first();
      house::where('id', $req->id)
         ->update(['count_view' => $current_view['count_view'] + 1]);
      $housetype = housetype::where('id', $req->id_type)->first();
      $user = account::where('id', $req->idOwner)->first();
      $review = review::where('idHouse',$req->id)->get();
      return view('home.chitietphong', compact('house', 'housetype', 'provinces', 'districts', 'current_view', 'user', 'review'));


      // $housetype = housetype::where('id', $req->id)->first();
      // $user = account::where('id', $req->id)->first();
      // return view('home.chitietphong', compact('house', 'housetype', 'user'));

      // $current_view = house::where('id',$req->id)->first();
      // house::where('id',$req->id)
      //      ->update(['count_view' =>$current_view['count_view'] + 1]);
      //   return view('home.chitietphong', compact('house'));

   }

   public function getloaiphong($type)
   {
      $phong_theodanhmuc = house::where('id_type', $type)->paginate(3);
      $phong_khacdanhmuc = house::where('id_type', '<>', $type)->paginate(3);
      $danh_muc = housetype::all();
      $danh_muc_phong = housetype::where('id', $type)->first();
      return view('page.danhmuc', compact('phong_theodanhmuc', 'phong_khacdanhmuc', 'danh_muc', 'danh_muc_phong'));
   }

   public function getsearchhouse(Request $request)
   {
      $provinces = provinces::all();
      $danh_muc = housetype::all();
      $house = house::where([
         ['id_districts', (int)$request->id_districts],
         ['province_id', (int)$request->province_id],
         ['price', '>=', (int)$request->min_price],
         ['price', '<=', (int)$request->max_price],
         ['size', '>=', (int)$request->min_size],
         ['size', '<=', (int)$request->max_size],
         ['id_type', (int)$request->id_type]
      ])->get();
      return view('page.search', compact('provinces', 'danh_muc', 'house'));
   }

   // public function searchhouse(Request $request) {
   //    $house = house::where([
   //       ['id_districts',(int)$request->id_districts],
   //       ['province_id',(int)$request->province_id],
   // 		['price','>=',(int)$request->min_price],
   //       ['price','<=',(int)$request->max_price],
   //       ['size','>=',(int)$request->min_size],
   //       ['size','<=',(int)$request->max_size],
   // 		['id_type',(int)$request->id_type],
   //    ])->get();
   //    return redirect('page.search')->back()->with(compact('house'));
   // }

   public function getMessage() {
      if (Auth::guard('account')->user())
         return view('home.messages');
      else return redirect('dang-nhap');
   }

   //Review
   public function postReview(Request $req){
      if(!Auth::guard('account')->user()) {
         return redirect('dang-nhap');
      }

      if(review::where('idUser',Auth::guard('account')->user()->id)
               ->where('idHouse',(int)$req->postReview)->get()->count() == 0 ) {
         $review = new review();
         $review->idUser = Auth::guard('account')->user()->id;
         $review->idHouse = (int)$req->postReview;
         $review->rating = (int)$req->rating;
         $review->describe = $req->description;
         $review->isApproval = 0;
         
         $review->save();
         return back()->with('success', 'Đánh giá thành công. Vui lòng đợi Admin kiểm duyệt');
      }

      return back()->with('warn', 'Bạn đã đánh giá cho nhà trọ này');
   }

   public function getthongbao($id) {
      $house = house::where([
         ['idOwner', $id],
         ['isApproval', '1'],
         ['hienthi', '0'],
     ])->get();
     
      $review = review::where([
         ['idUser', $id],
         ['isApproval', '1'],
         ['hienthi', '0'],
     ])->get();
      
      // $house = house::where('idOwner', $id)->get();
      // $review = review::where('idUser', $id)->get();
      return view('home.thongbao', compact('house', 'review'));
   }

   public function getxoathongbao($id) {
         $house = house::find($id);
        $house->hienthi = 1;
        $house->save();
        return redirect();
   }
}


