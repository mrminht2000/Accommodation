@extends('layout.master')
@section('content')	
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