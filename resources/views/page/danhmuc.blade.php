@extends('layout.master')
@section('content')

<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Kết quả </h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('trang-chu')}}">Home</a> / <span>danh mục</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
						@foreach($danh_muc as $damu)
							<li><a href="{{route('danhmucphongtro', $damu->id)}}">{{$damu->name}}</a></li>
						@endforeach
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>Kết quả</h4>
							<div class="beta-products-details">
								<p class="pull-left">{{count($phong_theodanhmuc)}} phòng</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
							@foreach($phong_theodanhmuc as $ptdm)
							<?php 
								$img_thumb = json_decode($ptdm->Image,true);
							
						 	?>
							<div class="col-md-4 col-sm-6">
								<div class="room-item">
									<div class="wrap-img" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">
										<img src="" class="lazyload img-responsive">
										<div class="category">
											<a href="{{route('chitietphong', $ptdm->id)}}">{{ $ptdm->housetype->name }}</a>
										</div>
									</div>
									<div class="room-detail">
										<h3><a href="{{route('chitietphong', $ptdm->id)}}">{{ $ptdm->title }}</a></h3>
										<div class="room-meta">
											<span><i class="fas fa-user-circle"></i> Người đăng: <a href="{{route('profile', $ptdm->account->id)}}"> {{ $ptdm->account->fullname }}</a></span>
										</div>
										<div class="room-info">
											<span><i class="far fa-stop-circle"></i> Diện tích: <b>{{ $ptdm->size }} m<sup>2</sup></b></span>
											<span class="pull-right">
												<i class="fas fa-eye"></i> Lượt xem: <b>{{ $ptdm->count_view }}</b>
											</span>
											<br/>
											<span>
												<a class="single-item add-to-cart pull-right" href="{{route('follow', $ptdm->id)}}"><i class="fa fa-shopping-cart"></i></a>
											</span>
											<div><i class="fas fa-map-marker"></i> Địa chỉ: {{ $ptdm->districts->name }} - {{ $ptdm->provinces->name }}</div>
											<div style="color: #e74c3c"><i class="far fa-money-bill-alt"></i> Giá thuê: 
												<b>{{$ptdm->price}} đồng/{{$ptdm->pricePer}}</b></div>
											</div>
										</div>

									</div>
								</div>
							@endforeach
							</div>
                            <div class="row">{{$phong_theodanhmuc->links()}}</div>
						</div> <!-- .beta-products-list -->
							<div class="row">{{$phong_khacdanhmuc->links()}}</div>
							<div class="space40">&nbsp;</div>

						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
    </div> <!-- .container -->

@endsection