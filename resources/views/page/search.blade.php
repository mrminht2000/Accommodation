@extends('layout.master')
@section('content')

<div class="container-fluid">
	
		<div id="searchbar">
			<div class="container">
				<form action="{{route('search')}}" method="GET">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="search_field">
						<div class="clearfix">
							<div class="search_field_item search_field_item_danh_muc">
								<lable class="search_field_item_label">Danh mục</lable>
									<select class="form-cotrol" data-live-search="true" id="id_type" name="id_type">
										@foreach($danh_muc as $damu)
										<option value="{{ $damu->id }}">{{ $damu->name }}</option>
										@endforeach
									</select>
							</div>
							<div class="search_field_item search_field_item_tinh_thanh_pho">
								<lable class="search_field_item_label">Tỉnh/ Thành phố</lable>
									<select class="form-cotrol" data-live-search="true" id="province_id" name="province_id">
										@foreach($provinces as $city)
										<option value="{{ $city->id }}">{{ $city->name }}</option>
										@endforeach
									</select>
							</div>
							<div class="search_field_item search_field_item_quan_huyen">
								<lable class="search_field_item_label">Quận/ Huyện</lable>
									<select class="form-cotrol" data-live-search="true" id="id_districts" name="id_districts">
										@foreach($provinces as $city)
										<option value="{{ $city->id }}">{{ $city->name }}</option>
										@endforeach
									</select>
							</div>
							<div class="search_field_item search_field_item_gia_thue">
								<lable class="search_field_item_label">Giá thuê</lable>
									<select class="form-cotrol" data-live-search="true" id="price" name="price">
									<option data-tokens="khoang gia" min="1" max="10000000">Khoảng giá</option>
										<option data-tokens="Tu 500.000 VNĐ - 700.000 VNĐ" min="500000" max ="700000">Từ 500.000 VNĐ - 700.000 VNĐ</option>
										<option data-tokens="Tu 700.000 VNĐ - 1.000.000 VNĐ" min="700000" max ="1000000">Từ 700.000 VNĐ - 1.000.000 VNĐ</option>
										<option data-tokens="Tu 1.000.000 VNĐ - 1.500.000 VNĐ" min="1000000" max ="1500000">Từ 1.000.000 VNĐ - 1.500.000 VNĐ</option>
										<option data-tokens="Tu 1.500.000 VNĐ - 3.000.000 VNĐ" min="1500000" max ="3000000">Từ 1.500.000 VNĐ - 3.000.000 VNĐ</option>
										<option data-tokens="Tren 3.000.000 VNĐ" min="3000000" max="10000000">Trên 3.000.000 VNĐ</option>
									</select>
							</div>
							<div class="search_field_item search_field_item_dien_tich">
								<lable class="search_field_item_label">Diện tích</lable>
									<select class="form-cotrol" data-live-search="true" id="size" name="size">
									<option data-tokens="dien tich" min="1" max="200">Diện tích</option>
										<option data-tokens="Tu 1 - 20 m2" min="1" max ="20">Dưới 20 m2</option>
										<option data-tokens="Tu 20 m2 - 30 m2" min="20" max ="30">Từ 20 m2 - 30 m2</option>
										<option data-tokens="Tu 30 m2 - 40 m2" min="30" max ="40">Từ 30 m2 - 40 m2</option>
										<option data-tokens="Tu 40 m2 - 50 m2" min="40" max ="50">Từ 40 m2 - 50 m2</option>	
										<option data-tokens="Trên 50 m2" min="50" >Trên 50 m2</option>	
									</select>
							</div>
							<div class="search_field_item search_field_item_submit">
								<lable class="search_field_item_label">&nbsp;</lable>
								<button type="submit" class="btn btn-default btn_search_box">Tìm kiếm</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	
	<div class="space60">&nbsp;</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Kết quả tìm kiếm</h4>
							<div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{count($house)}} phòng</p>
								<div class="clearfix"></div>
							</div>
							
							<div class="row">
							@foreach($house as $ho)
							<?php 
								$img_thumb = json_decode($house->Image,true);
							
						 	?>
							<div class="col-md-4 col-sm-6">
								<div class="room-item">
									<div class="wrap-img" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">
										<img src="" class="lazyload img-responsive">
										<div class="category">
											<a href="{{route('chitietphong', $house->id)}}">{{ $ho->housetype->name }}</a>
										</div>
									</div>
									<div class="room-detail">
										<h3><a href="{{route('chitietphong', $house->id)}}">{{ $ho->title }}</a></h3>
										<div class="room-meta">
											<span><i class="fas fa-user-circle"></i> Người đăng: <a href="/"> {{ $ho->account->fullname }}</a></span>
										</div>
										<div class="room-info">
											<span><i class="far fa-stop-circle"></i> Diện tích: <b>{{ $ho->size }} m<sup>2</sup></b></span>
											<span class="pull-right">
												<i class="fas fa-eye"></i> Lượt xem: <b>{{ $ho->count_view }}</b>
											</span>
											<br/>
											<span>
												<a class="single-item add-to-cart pull-right" href="{{route('follow', $house->id)}}"><i class="fa fa-shopping-cart"></i></a>
											</span>
											<div><i class="fas fa-map-marker"></i> Địa chỉ: {{ $ho->address }}</div>
											<div style="color: #e74c3c"><i class="far fa-money-bill-alt"></i> Giá thuê: 
												<b>{{$ho->price}} đồng/{{$ho->pricePer}}</b></div>
											</div>
										</div>

									</div>
								</div>
							@endforeach
							</div>
						</div> <!-- .beta-products-list -->

						

						
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
</div> <!-- .container -->

@endsection