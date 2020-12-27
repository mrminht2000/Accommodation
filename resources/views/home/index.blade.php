@extends('layout.master')
@section('content')

<?php
use App\Models\house;
use App\Models\account;
use App\Models\choosedhouse;
function time_translate($pricePer)
{
	if ($pricePer == 'month') return 'tháng';
	if ($pricePer == 'quarter') return 'quý';
	if ($pricePer == 'year') return 'năm';
}
?>
<div class="container-fluid">

	<div id="searchbar">
		<div class="container">
			<form role="search" action="{{route('search')}}" method="GET">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="search_field">
					<div class="clearfix">
						<div class="search_field_item search_field_item_danh_muc">
							<lable class="search_field_item_label">Danh mục</lable>
							<select class="form-cotrol" data-live-search="true" id="id_type" name="id_type">
								@foreach($danh_muc as $damu)
								<option name="{{ $damu->id }}" value="{{ $damu->id }}">{{ $damu->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="search_field_item search_field_item_tinh_thanh_pho">
							<lable class="search_field_item_label">Tỉnh/ Thành phố</lable>
							<select class="form-cotrol " data-live-search="true" data-type="provinces" id="province" name="province_id">
								<option>--Chọn tỉnh--</option>
								@foreach($provinces as $city)
								<option value="{{ $city->id }}" name="{{ $city->id }}">{{ $city->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="search_field_item search_field_item_quan_huyen">
							<lable class="search_field_item_label">Quận/ Huyện</lable>

							<select class="form-cotrol " data-live-search="true" data-type="districts" id="districts" name="id_districts">
								<option>--Chọn Quận/Huyện--</option>
							</select>
						</div>
						<div class="search_field_item search_field_item_gia_thue">
							<lable class="search_field_item_label">Giá thuê</lable>
							<select class="form-cotrol" data-live-search="true" id="price" name="price">
								<option data-tokens="khoang gia" min_price="1" max_price="10000000">Khoảng giá</option>
								<option data-tokens="Tu 500.000 VNĐ - 700.000 VNĐ" min_price="500000" max_price="700000">Từ 500.000 VNĐ - 700.000 VNĐ</option>
								<option data-tokens="Tu 700.000 VNĐ - 1.000.000 VNĐ" min_price="700000" max_price="1000000">Từ 700.000 VNĐ - 1.000.000 VNĐ</option>
								<option data-tokens="Tu 1.000.000 VNĐ - 1.500.000 VNĐ" min_price="1000000" max_price="1500000">Từ 1.000.000 VNĐ - 1.500.000 VNĐ</option>
								<option data-tokens="Tu 1.500.000 VNĐ - 3.000.000 VNĐ" min_price="1500000" max_price="3000000">Từ 1.500.000 VNĐ - 3.000.000 VNĐ</option>
								<option data-tokens="Tren 3.000.000 VNĐ" min_price="3000000" max_price="10000000">Trên 3.000.000 VNĐ</option>
							</select>
						</div>
						<div class="search_field_item search_field_item_dien_tich">
							<lable class="search_field_item_label">Diện tích</lable>
							<select class="form-cotrol" data-live-search="true" id="size" name="size">
								<option data-tokens="dien tich" min_size="1" max_price="200">Diện tích</option>
								<option data-tokens="Tu 1 - 20 m2" min_size="1" max_price="20">Dưới 20 m2</option>
								<option data-tokens="Tu 20 m2 - 30 m2" min_size="20" max_price="30">Từ 20 m2 - 30 m2</option>
								<option data-tokens="Tu 30 m2 - 40 m2" min_size="30" max_price="40">Từ 30 m2 - 40 m2</option>
								<option data-tokens="Tu 40 m2 - 50 m2" min_size="40" max_price="50">Từ 40 m2 -50 m2</option>
								<option data-tokens="Trên 50 m2" min_size="50">Trên 50 m2</option>
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
							<h4>Nhà trọ mới đăng</h4>
							<div class="beta-products-details">
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($newHouse as $house)
								<?php
								$img_thumb = json_decode($house->Image, true);

								?>

								@if($house->isApproval == 1)
								<div class="col-md-4 col-sm-6">
									<div class="room-item">
										<div class="wrap-img" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">
											<img src="" class="lazyload img-responsive">
											<div class="category" style="background-color: black;">
												<a href="{{route('chitietphong', $house->id)}}">{{ $house->housetype->name }}</a>
											</div>
										</div>
										<div class="room-detail">
											<h3><a href="{{route('chitietphong', $house->id)}}">{{ $house->title }}</a></h3>
											<div class="room-meta">
												<span><i class="fas fa-user-circle"></i> Người đăng: <a href="{{route('profile', $house->account->id)}}"> {{ $house->account->fullname }}</a></span>
											</div>
											<div class="room-info">
												<span><i class="far fa-stop-circle"></i> Diện tích: <b>{{ $house->size }} m<sup>2</sup></b></span>
												<span class="pull-right">
													<i class="fas fa-eye"></i> Lượt xem: <b>{{ $house->count_view }}</b>
												</span>
												<br />
												<span>
													@if(Auth::guard('account')->user())
													<a class="single-item add-to-cart pull-right" href="{{route('follow', $house->id)}}"><i class="fa fa-shopping-cart"></i></a>
													@else
													<a class="single-item add-to-cart pull-right" href="{{route('signin')}}"><i class="fa fa-shopping-cart"></i></a>
													@endif
												</span>
												<div><i class="fas fa-map-marker"></i> Địa chỉ: {{ $house->districts->name }} - {{ $house->provinces->name }}</div>
												<div style="color: #e74c3c"><i class="far fa-money-bill-alt"></i> Giá thuê:
													<b>{{$house->price}} đồng/<?php echo time_translate($house->pricePer) ?></b></div>
											</div>
										</div>

									</div>
								</div>
								@endif
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
								$img_thumb = json_decode($house->Image, true);

								?>
								@if($house->isApproval == 1)
								<div class="col-md-4 col-sm-6">
									<div class="room-item">
										<div class="wrap-img" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">
											<img src="" class="lazyload img-responsive">
											<div class="category" style="background-color: black;">
												<a href="{{route('danhmucphongtro', $house->id_type)}}">{{ $house->housetype->name }}</a>
											</div>
										</div>
										<div class="room-detail">
											<h3><a href="{{route('chitietphong', $house->id)}}">{{ $house->title }}</a></h3>
											<div class="room-meta">
												<span><i class="fas fa-user-circle"></i> Người đăng: <a href="{{route('profile', $house->account->id)}}"> {{ $house->account->fullname }}</a></span>
											</div>
											<div class="room-info">
												<span><i class="far fa-stop-circle"></i> Diện tích: <b>{{ $house->size }} m<sup>2</sup></b></span>
												<span class="pull-right">
													<i class="fas fa-eye"></i> Lượt xem: <b>{{ $house->count_view }}</b>
												</span>
												<br />
												<span>
													@if(Auth::guard('account')->user())
													<a class="single-item add-to-cart pull-right" href="{{route('follow', $house->id)}}"><i class="fa fa-shopping-cart"></i></a>
													@else
													<a class="single-item add-to-cart pull-right" href="{{route('signin')}}"><i class="fa fa-shopping-cart"></i></a>
													@endif
												</span>
												<div><i class="fas fa-map-marker"></i> Địa chỉ: {{ $house->districts->name }} - {{ $house->provinces->name }}</div>
												<div style="color: #e74c3c"><i class="far fa-money-bill-alt"></i> Giá thuê:
													<b>{{$house->price}} đồng/<?php echo time_translate($house->pricePer) ?></b></div>
											</div>
										</div>

									</div>
								</div>
								@endif
								@endforeach

							</div>
							<div class="space40">&nbsp;</div>

						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->

	<script>
		$(document).ready(function() {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			$('#province').change(function(event) {
				event.preventDefault();

				let route = "{{route('districts')}}";
				let $this = $(this);
				let type = $this.attr('data-type');
				let provinceid = $this.val();
				$.ajax({
						method: "GET",
						url: route,
						data: {
							type: type,
							province_id: provinceid
						}
					})
					.done(function(msg) {
						if (msg.data) {
							let html = '';
							let element = '';
							if (type == 'provinces') {
								html = "<option>--Chọn Quận Huyện--</option>";
								element = '#districts';
							}
							$.each(msg.data, function(index, value) {
								html += "<option value='" + value.id + "' name='" + value.id + "'>" + value.name + "</option>"

							});

							$(element).html('').append(html);

						}


					});
			});

			
		});

	</script>
	

	@endsection