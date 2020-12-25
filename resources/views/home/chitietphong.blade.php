@extends('layout.master')
@section('content')
<?php
function limit_description($string)
{
	$string = strip_tags($string);
	if (strlen($string) > 150) {

		// truncate string
		$stringCut = substr($string, 0, 150);
		$endPoint = strrpos($stringCut, ' ');

		//if the string doesn't contain any space then it will cut without word basis.
		$string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
		$string .= '...';
	}
	return $string;
}
function time_elapsed_string($datetime, $full = false)
{
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'năm',
		'm' => 'tháng',
		'w' => 'tuần',
		'd' => 'ngày',
		'h' => 'giờ',
		'i' => 'phút',
		's' => 'giây',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' trước' : 'Vừa xong';
}
function time_translate($pricePer)
{
	if ($pricePer == 'month') return 'tháng';
	if ($pricePer == 'quarter') return 'quý';
	if ($pricePer == 'year') return 'năm';
}
?>

<style>
	table,
	th,
	td {
		border: 1px solid black;
		border-collapse: collapse;


	}

	@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

	/* Styling h1 and links
––––––––––––––––––––––––––––––––– */
	.starrating>input {
		display: none;
	}

	/* Remove radio buttons */

	.starrating>label:before {
		content: "\f005";
		/* Star */
		margin: 2px;
		font-size: 8em;
		font-family: FontAwesome;
		display: inline-block;
	}

	.starrating>label {
		color: #222222;
		/* Start color when not clicked */
	}

	.starrating>input:checked~label {
		color: #ffca08;
	}

	/* Set yellow color when star checked */

	.starrating>input:hover~label {
		color: #ffca08;
	}

	/* Set yellow color when star hover */
</style>
<div class="gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="index">Trang Chủ</a></li>
				<li><a href="{{route('danhmucphongtro', $house->id_type)}}">{{ $house->districts->name }} - {{ $house->housetype->name }}</a></li>
				<li class="active">{{ $house->title }}</li>
			</ul>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?php
			$arrimg =  json_decode($house->Image, true);
			?>
			<!-- <center> -->
			<!-- Slider Hình Ảnh -->
			<!-- @foreach($arrimg as $img)
				<img src="uploads/images/<?php echo $img; ?>" width="50%">
			@endforeach
			</center> -->
			<!-- END Slider Hình Ảnh -->

			<div id="carouselLoadHouseImage" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					@foreach($arrimg as $img)
					@if ($loop->first)
					<div class="carousel-item active">
						@else
						<div class="carousel-item">
							@endif
							<img class="image-house" src="uploads/images/<?php echo $img; ?>" height="400" width="800">
						</div>
						@endforeach
					</div>
					<a class="carousel-control-prev" href="#carouselLoadHouseImage" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselLoadHouseImage" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>

				<div class="gap"></div>
				<hr>

				<div class="row">
					<div class="col-md-6">
						<h1 class="entry-title entry-prop">{{ $house->title }}</h1>
					</div>
					<div class="col-md-6">
						<span class="pull-right">Lượt xem: {{ $house->count_view }} - <span>Ngày đăng: </span> <span style="color: red; font-weight: bold;">
								<?php echo time_elapsed_string($house->created_at); ?>
							</span></span>
						<!-- <span class="pull right">Người đăng: <a href="#">{{$house->account->fullname}}</a></span> -->
					</div>
				</div>

				<hr>
				<div class="detail">
					<p>
						<strong>Địa chỉ: {{ $house->districts->name }} - {{ $house->provinces->name }}</strong>
					</p>
					<p>
						<strong>Giá phòng: </strong><span class="price_area" style="font-size: 150%"> {{number_format($house->price)}} <span class="price_label"> VND/{{time_translate($house->pricePer)}}</span></span>
						<strong style="position:relative; left:100px"><i class="fas fa-street-view"></i> Diện tích: </strong><span style="position:relative; left:100px"> {{$house->size}} m<sup>2</sup> </span>

					</p>

					<?php $arrtienich = json_decode($house->utilities, true); ?>
					<div id="km-detail">
						<div class="fs-dtslt">Tiện ích Phòng Trọ</div>
						<div style="padding: 5px;">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Chung chủ:</label>
										@if($house->isWithOwner == 1)
										<label style="color:blue;">Có</label><br>
										@else
										<label style="color:blue;">Không</label><br>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Phòng tắm: </label>
										@if($house->bathroom == 1)
										<label style="color:blue;">Khép kín </label>
										@else
										<label style="color:blue;">Chung </label>
										@endif
										@if($house->waterheater == 1)
										<label style="color:blue;">có nóng lạnh</label><br>
										@else
										<label style="color:blue;">không nóng lạnh</label><br>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Phòng bếp: </label>
										<label style="color:blue;">{{$house->kitchen}}</label><br>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">

										<label>Điều hòa:</label>
										@if($house->airConditioner == 1)
										<label style="color:blue;">Có</label><br>
										@else
										<label style="color:blue;">Không</label><br>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Ban công: </label>
										@if($house->balcony == 1)
										<label style="color:blue;">Có</label><br>
										@else
										<label style="color:blue;">Không</label><br>
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Giá điện :</label>
										<label style="color:red"> {{number_format($house->electricPrice)}} VND/KWh</label>
										<br />
										<label>Giá nước :</label>
										<label style="color:red"> {{number_format($house->waterPrice)}} VND/khối</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<h4>Mô tả:</h4>
					<pre>
					<p class="pre">{{ $house->description }}</p>
				</pre>
				</div>
			</div>
			<div class="col-md-4">
				<div class="contactpanel">
					<div class="row">
						@if($house->account->avatar == 'no-avatar.jpg')
						<img src="source/images/no-avatar.jpg" class="img-circle" alt="Cinque Terre" width="100" height="100">
						@else
						<img src="uploads/avatars/<?php echo $house->account->avatar; ?>" class="img-circle" alt="Cinque Terre" width="100" height="100">
						@endif
						<div class="col-md-8">
							<h4>Thông tin người đăng</h4>
							<strong><a href="{{route('profile', $house->account->id)}}">{{ $house->account->fullname }}</a></strong><br>
							<i class="far fa-clock"></i> Ngày tham gia: 17-02-2018
						</div>
					</div>
					<div class="phone_btn">
						<a id="show_phone_bnt" href="callto:{{ $house->phoneNumber }}" class="btn btn-primary btn-block" style="font-weight: bold !important;
						font-size: 14px;">
							<i class="fas fa-phone-square" style="font-size: 20px"></i>
							<span>SĐT: {{ $house->phoneNumber }}</span></a>
					</div>

					<div class="gap"></div>


					@if(session('thongbao'))
					<div class="alert bg-success">
						<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
						<span class="text-semibold">Well done!</span> {{session('thongbao')}}
					</div>
					@else
					<div class="report">
						<h4>BÁO CÁO</h4>
						<form action="{{ route('reportuser', $house->id) }}">
							<label for="comment">Mô tả báo cáo:</label>
							<textarea class="form-control" rows="5" id="description" name="description" style=" resize: none;"></textarea>
							<button class="btn btn-danger">Gửi báo cáo</button>
						</form>
					</div>
					@endif

					<i class="fas fa-phone-square" style="font-size: 20px"></i>
					<span>SĐT: {{ $house->phoneNumber }}</span></a>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<h1 class="fs-dtslt" style="background-color:#80dfff; color:black">Review</h1>
			@if(session('warn'))
			<div class="alert bg-danger">
				<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
				<span class="text-semibold">Error!</span> {{session('warn')}}
			</div>
			@endif
			@if(session('success'))
			<div class="alert bg-success">
				<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
				<span class="text-semibold">Done!</span> {{session('success')}}
			</div>
			@endif
			<div class="container">
				<form method="POST" action="{{ route('review') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
						<input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 star">5</label>
						<input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star">4</label>
						<input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 star">3</label>
						<input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 star">2</label>
						<input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">1</label>
					</div>
					<div class="form-group">
						<label for="comment">Mô tả ngắn:</label>
						<textarea class="form-control" rows="5" id="description" name="description" style=" resize: none;"></textarea>
					</div>
					<button type="submit" class="btn btn-primary" name="postReview" value="{{$house->id}}">Đánh giá</button>
				</form>
			</div>
			@foreach($review as $review)
			<div class="container">
				<h2 class="text-center">Đánh giá</h2>

				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-2">
								@if($house->account->avatar == 'no-avatar.jpg')
								<img src="source/images/no-avatar.jpg" class="img img-rounded img-fluid" />
								@else
								<img src="uploads/avatars/<?php echo $review->account->avatar; ?>" class="img img-rounded img-fluid" />
								@endif
								<p class="text-secondary text-center"><?php echo time_elapsed_string($review->created_at); ?></p>
							</div>
							<div class="col-md-10">
								<p>
									<a class="float-left" href="{{route('profile', $review->idUser)}}"><strong>{{$review->account->fullname}}</strong></a>
									<?php
									for ($i = 5; $i > $review->rating; $i--)
										echo ('<span class="float-right"><i class="fa fa-star"></i></span>');
									for ($i = 0; $i < $review->rating; $i++)
										echo ('<span class="float-right"><i class="text-warning fa fa-star"></i></span>');
									?>

								</p>
								<div class="clearfix"></div>
								<p>{{$review->describe}}</p>
								<p>
									<a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>

	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			var slider = $('.pgwSlider').pgwSlider();
			slider.previousSlide();
		});
	</script>

	@endsection