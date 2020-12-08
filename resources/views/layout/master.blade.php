<!DOCTYPE html>
<html lang="en">

<head>
	<title>Project Phòng Trọ</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<base href="{{asset('')}}">
	<link rel="stylesheet" href="source/assets/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" href="source/assets/style.css">

	

	<link rel="stylesheet" href="source/assets/awesome/css/fontawesome-all.css">
	<link rel="stylesheet" href="source/assets/toast/toastr.min.css">
	<link rel="stylesheet" title="style" href="{{ URL::to('source/assets/dest/css/style.css')}}">
	<link rel="stylesheet" href="{{ URL::to('source/assets/dest/css/animate.css')}}">
	<link rel="stylesheet" title="style" href="{{ URL::to('source/assets/dest/css/huong-style.css')}}">

	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">

	<script src="source/assets/jquery.min.js"></script>
	<script src="source/assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="source/assets/myjs.js"></script>
	<link rel="stylesheet" href="source/assets/selectize.default.css" data-theme="default">
	<script src="source/assets/js/fileinput/fileinput.js" type="text/javascript"></script>
	<script src="source/assets/js/fileinput/vi.js" type="text/javascript"></script>
	<link rel="stylesheet" href="source/assets/fileinput.css">
	<script src="source/assets/pgwslider/pgwslider.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="source/assets/pgwslider/pgwslider.min.css">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>

	<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/plugins/purify.min.js" type="text/javascript"></script> -->
	<link rel="stylesheet" href="source/assets/bootstrap/bootstrap-select.min.css">
	<!-- Using Carousel -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="source/assets/bootstrap/bootstrap-select.min.js"></script>
</head>

<body>
	<div class="header-bottom" style="background-color: #003352;">
		<!-- <nav class="navbar navbar-inverse"> -->
		<div class="container">
			<div class="navbar-header">
				<!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button> -->
				<!--<a class="navbar-brand" href=""><img src="images/logo.png"></a>-->
			</div>
			<nav class="main-menu">
				<ul class="l-inline ov">
					<li><a href="{{route('trang-chu')}}">Trang chủ</a></li>
					<li><a href="#">Sản phẩm</a>
						<ul class="sub-menu">
							@foreach($danh_muc as $damu)
							<li><a href="{{route('danhmucphongtro', $damu->id)}}">{{$damu->name}}</a></li>
							@endforeach
						</ul>
					</li>
					<li><a href="about.html">Giới thiệu</a></li>
					@if(!Auth::guard('account')->user())
					<li><a href="{{route('signin')}}"><i class="fas fa-user-circle"></i> Đăng Nhập</a></li>
					<li><a href="{{route('signup')}}"><i class="fas fa-sign-in-alt"></i> Đăng Kí</a></li>
					@else
					@if(Auth::user()->isOwner == 1)
					<li><a class="btn-dangtin" href="{{route('post')}}"><i class="fas fa-edit"></i> Đăng tin mới</a></li>
					@endif

					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Xin chào! {{Auth::user()->fullname}}<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Thông tin chi tiết</a></li>
							<li><a href="{{route('cart')}}">Nhà trọ theo dõi</a></li>
							<li><a href="{{route('signout')}}">Thoát</a></li>
						</ul>
					</li>
					@endif
				</ul>

				<div class="clearfix"></div>
			</nav>
		</div>
		<!-- </nav> -->
	</div>

	@yield('content')

	<div class="gap"></div>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="logo-footer">
						<a href="/" title="Project của Ngọc Minh đẹp trai và Phạm Hoàng fanboi MU 20 năm">
							<img class="logo-img" src="./uploads/images/logo.png">
						</a>
						<div style="padding-top: 10px;">
							<p>Dự án phát triển Website Đăng tin và Tìm kiếm Phòng trọ Hà Nội.</p>
							<p>Sinh viên thực hiện: Phạm Văn Hoàng-Nguyễn Ngọc Minh - Lớp K63N.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</footer>

	<script type="text/javascript" src="source/assets/toast/toastr.min.js"></script>
</body>

</html>

<script>
	function cartFunction() {
		cartStyle = document.getElementById("box-follow").style.display;
		if (cartStyle == "block") document.getElementById("box-follow").style.display = "none";
		else document.getElementById("box-follow").style.display = "block";
	}

	$(document).ready(function($) {
		$(window).scroll(function() {
			if ($(this).scrollTop() > 40) {
				$(".header-bottom").addClass('fixNav')
			} else {
				$(".header-bottom").removeClass('fixNav')
			}
		})
	})
</script>