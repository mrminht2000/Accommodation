@extends('layout.master')
@section('content')

<div class="container-fluid" style="padding-left: 0px;padding-right: 0px;">
	<div class="container">
		<div class="box-search">
			<form onsubmit="return false">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group row">
							<div class="col-xs-6">
								<select class="selectpicker" data-live-search="true" id="province_id" name="province_id">
									@foreach($provinces as $city)
									<option data-tokens="{{$city->slug}}" value="{{ $city->id }}">{{ $city->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-6">
								
							</div>
							<div class="col-xs-6">
								<select class="selectpicker" data-live-search="true" id="selectcategory">
									@foreach($danh_muc as $damu)
									<option data-tokens="{{ $damu->slug }}" value="{{ $damu->id }}">{{ $damu->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-xs-6">
								<select class="selectpicker" id="selectprice" data-live-search="true">
									<option data-tokens="khoang gia" min="1" max="10000000">Khoảng giá</option>
									<option data-tokens="Tu 500.000 VNĐ - 700.000 VNĐ" min="500000" max ="700000">Từ 500.000 VNĐ - 700.000 VNĐ</option>
									<option data-tokens="Tu 700.000 VNĐ - 1.000.000 VNĐ" min="700000" max ="1000000">Từ 700.000 VNĐ - 1.000.000 VNĐ</option>
									<option data-tokens="Tu 1.000.000 VNĐ - 1.500.000 VNĐ" min="1000000" max ="1500000">Từ 1.000.000 VNĐ - 1.500.000 VNĐ</option>
									<option data-tokens="Tu 1.500.000 VNĐ - 3.000.000 VNĐ" min="1500000" max ="3000000">Từ 1.500.000 VNĐ - 3.000.000 VNĐ</option>
									<option data-tokens="Tren 3.000.000 VNĐ" min="3000000" max="10000000">Trên 3.000.000 VNĐ</option>
								</select>
							</div>
							<div class="col-xs-6">
								<button class="btn btn-success" onclick="searchMotelajax()">Tìm kiếm ngay</button>
							</div>
						</div>
						
			<form>
		</div>
	</div>
	
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Nhà trọ mới đăng</h4>
							<div class="beta-products-details">
								<div class="clearfix"></div>
							</div>
							
							<div class="row">
							@foreach($newHouse as $house)
							<?php 
								$img_thumb = json_decode($house->Image,true);
							
						 	?>
							<div class="col-md-4 col-sm-6">
								<div class="room-item">
									<div class="wrap-img" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">
										<img src="" class="lazyload img-responsive">
										<div class="category">
											<a href="{{route('chitietphong', $house->id)}}">{{ $house->housetype->name }}</a>
										</div>
									</div>
									<div class="room-detail">
										<h3><a href="{{route('chitietphong', $house->id)}}">{{ $house->title }}</a></h3>
										<div class="room-meta">
											<span><i class="fas fa-user-circle"></i> Người đăng: <a href="/"> {{ $house->account->fullname }}</a></span>
										</div>
										<div class="room-info">
											<span><i class="far fa-stop-circle"></i> Diện tích: <b>{{ $house->size }} m<sup>2</sup></b></span>
											<span class="pull-right">
												<i class="fas fa-eye"></i> Lượt xem: <b>{{ $house->count_view }}</b>
											</span>
											<br/>
											<span>
												<a class="single-item add-to-cart pull-right" href="{{route('follow', $house->id)}}"><i class="fa fa-shopping-cart"></i></a>
											</span>
											<div><i class="fas fa-map-marker"></i> Địa chỉ: {{ $house->address }}</div>
											<div style="color: #e74c3c"><i class="far fa-money-bill-alt"></i> Giá thuê: 
												<b>{{$house->price}} đồng/{{$house->pricePer}}</b></div>
											</div>
										</div>

									</div>
								</div>
							@endforeach
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Nhà trọ được xem nhiều nhất</h4>
							<div class="beta-products-details">
								<div class="clearfix"></div>
							</div>
							<div class="row">
							@foreach($topHouse as $house)
							<?php 
								$img_thumb = json_decode($house->Image,true);
							
						 	?>
							<div class="col-md-4 col-sm-6">
								<div class="room-item">
									<div class="wrap-img" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">
										<img src="" class="lazyload img-responsive">
										<div class="category">
											<a href="{{route('chitietphong', $house->id)}}">{{ $house->housetype->name }}</a>
										</div>
									</div>
									<div class="room-detail">
										<h3><a href="{{route('chitietphong', $house->id)}}">{{ $house->title }}</a></h3>
										<div class="room-meta">
											<span><i class="fas fa-user-circle"></i> Người đăng: <a href="/"> {{ $house->account->fullname }}</a></span>
										</div>
										<div class="room-info">
											<span><i class="far fa-stop-circle"></i> Diện tích: <b>{{ $house->size }} m<sup>2</sup></b></span>
											<span class="pull-right">
												<i class="fas fa-eye"></i> Lượt xem: <b>{{ $house->count_view }}</b>
											</span>
											<br/>
											<span>
												<a class="single-item add-to-cart pull-right" href="{{route('follow', $house->id)}}"><i class="fa fa-shopping-cart"></i></a>
											</span>
											<div><i class="fas fa-map-marker"></i> Địa chỉ: {{ $house->address }}</div>
											<div style="color: #e74c3c"><i class="far fa-money-bill-alt"></i> Giá thuê: 
												<b>{{$house->price}} đồng/{{$house->pricePer}}</b></div>
											</div>
										</div>

									</div>
								</div>
							@endforeach
								
							</div>
							<div class="space40">&nbsp;</div>
							
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection