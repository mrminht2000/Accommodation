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
	
	<script src="source/assets/jquery.min.js"></script>
	<script src="source/assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="source/assets/myjs.js"></script>
	<link rel="stylesheet" href="source/assets/selectize.default.css" data-theme="default">
	<script src="source/assets/js/fileinput/fileinput.js" type="text/javascript"></script>
	<script src="source/assets/js/fileinput/vi.js" type="text/javascript"></script>
	<link rel="stylesheet" href="source/assets/fileinput.css">
	<script src="source/assets/pgwslider/pgwslider.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="source/assets/pgwslider/pgwslider.min.css">
	
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/plugins/purify.min.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="source/assets/bootstrap/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="source/assets/bootstrap/bootstrap-select.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href=""><img src="images/logo.png"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
				<ul class="nav navbar-nav">
					<li><a href="#">Trang chủ</a></li>
					<li><a href="#">Loại Sản phẩm</a>
						<ul class="sub-menu">
						@foreach($Categories as $category)
							<li><a href="danh-muc/{{$category->id}}">{{ $category->name }}</a></li>
						@endforeach
						</ul>
					</li>
					<li><a href="#">Giới thiệu</a></li>
					<li><a href="#">Liên hệ</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">

					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Xin chào!<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Thông tin chi tiết</a></li>
							<li><a href="#">Đăng tin</a></li>
							<li><a href="#">Thoát</a></li>
						</ul>
					</li>
					
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a class="btn-dangtin" href="{{route('post')}}"><i class="fas fa-edit"></i> Đăng tin</a></li>
					<li><a href="{{route('signin')}}"><i class="fas fa-user-circle"></i> Đăng Nhập</a></li>
					<li><a href="{{route('signup')}}"><i class="fas fa-sign-in-alt"></i> Đăng Kí</a></li>
				</ul>
			</div>
		</div>
	</nav>
	
		@yield('content')
	<div class="gap"></div>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="logo-footer">
						<a href="/" title="Cổng thông tin số 1 về Dự án Bất động sản - Homedy.com">
							<img src="images/logo.png">                        
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
