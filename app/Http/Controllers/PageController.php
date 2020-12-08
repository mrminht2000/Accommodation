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
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class PageController extends Controller
{

   public function getIndex() {
      $newHouse = house::all();  
      $provinces = provinces::all();
      $danh_muc = housetype::all();
      return view('home.index', compact('newHouse', 'provinces', 'danh_muc'));
   }

   public function getdistricts(Request $req) {
      $provinceid = $req->province_id;
      if($provinceid) {
         $districts = districts::where('province_id',$provinceid)->get();
         return response(['data'=>$districts]);
      }
   }
   

   public function get_dangtin(Request $req) {
      $provinces = provinces::all();
     
      $danh_muc = housetype::all();
      return view('account.dangtin', compact('provinces', 'danh_muc'));
   }

   public function getlocation(Request $req) {
      $quan_huyen = districts::where('province_id', $req->id)->first;
      
      return view('account.dangtin', compact('quan_huyen'));
   }

   public function post_dangtin(Request $request) {
      $request->validate([
         'title' => 'required',
         // 'address' => 'required',
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
      $house->bathroom = (int)$request->bathroom;
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
      $house->province_id = (int)$request->province_id;
      $house->save();
      return redirect()->back()->with('success','Đăng tin thành công. Vui lòng đợi Admin kiểm duyệt');
   }


    
   
   //Xử lý trang danh sách theo dõi
   public function getFollow(Request $req) {
      if (!Auth::guard()->user()) return redirect('dang-nhap');
      if (!choosedhouse::select('idRenter','idHouse')
                       ->where('idRenter',Auth::guard()->user()->id)
                       ->where('idHouse',(int)$req->id)->first()) {
         $choosedHouse = new choosedhouse;
         $choosedHouse->idRenter = Auth::guard()->user()->id;
         $choosedHouse->idHouse = (int)$req->id;
         $choosedHouse->save();
      }
      return redirect()->back();
   }

   public function getCart() {
      return view('page.theodoi');
   }


   public function getchitietPhongtro(Request $req) {
      $house = house::where('id', $req->id)->first();

      $current_view = house::where('id',$req->id)->first();
      house::where('id',$req->id)
           ->update(['count_view' =>$current_view['count_view'] + 1]);
           $housetype = housetype::where('id', $req->id)->first();
      $user = account::where('id', $req->id)->first();
        return view('home.chitietphong', compact('house', 'housetype', 'current_view', 'user'));


      // $housetype = housetype::where('id', $req->id)->first();
      // $user = account::where('id', $req->id)->first();
      // return view('home.chitietphong', compact('house', 'housetype', 'user'));

      // $current_view = house::where('id',$req->id)->first();
      // house::where('id',$req->id)
      //      ->update(['count_view' =>$current_view['count_view'] + 1]);
      //   return view('home.chitietphong', compact('house'));

   }

   public function getloaiSP($type) {
        $phong_theodanhmuc= house::where('id_type', $type)->paginate(3);
        $phong_khacdanhmuc = house::where('id_type', '<>', $type)->paginate(3);
        $danh_muc = housetype::all();
        $danh_muc_phong = housetype::where('id', $type)->first();
        return view('page.danhmuc', compact('phong_theodanhmuc', 'phong_khacdanhmuc', 'danh_muc', 'danh_muc_phong'));
   }

   public function searchhouse(Request $request) {
      $house = house::where([
         ['id_districts',$request->id_ditrict],
         ['province_id',$request->province_id],
			['price','>=',$request->min_price],
         ['price','<=',$request->max_price],
         ['size','>=',$request->min_size],
         ['size','<=',$request->max_size],
			['id_type',$request->id_type],
      ])->get();

      return view('page.search', compact('house'));
   }
}
