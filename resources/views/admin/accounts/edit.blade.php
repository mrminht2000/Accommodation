@extends('admin.layout.master')
@section('content2')
<!-- Main content -->
<div class="content-wrapper">
	<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Trang Chỉnh sửa thông tin thành viên</h4>
			</div>

			
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="admin"><i class="icon-home2 position-left"></i> Trang chủ</a></li>
				<li><a href="admin/users/list">Danh sách thành viên</a></li>
				<li class="active">Trang Chỉnh sửa thông tin thành viên</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->
	<div class="content">
		<div class="row">
			<div class="col-md-8">
				
				<div class="content-group border-top-lg border-top-primary">
					<!-- Basic datatable -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title"><span class="badge badge-primary">{{$user->fullname}}</span> Chỉnh sửa Tài Khoản  </h5>
							
						</div>

						<div class="panel-body">
							Nếu bạn không muốn thay đổi <code>Mật khẩu</code> thì hãy để trống 2 trường nhập giá trị mật khẩu.<div style="margin-bottom:10px; "></div>
							@if(count($errors)>0)
							<div class="alert bg-danger">
								<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
								<span class="text-semibold">Lỗi!</span><br>
								@foreach($errors->all() as $err)
								{{$err}}<br>
								@endforeach
							</div>
							@endif
							@if(session('thongbao'))
							<div class="alert bg-success">
								<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
								<span class="text-semibold">Well done!</span>  {{session('thongbao')}}
							</div>
							@endif			
							<form action="{{ route('editadmin', $user->id)}}" method="POST">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="row">
									<div class="form-group">
										<label class="control-label col-lg-2">Tài khoản</label>
										<div class="col-lg-10">
											<div class="input-group">
												<span class="input-group-addon"><i class="icon-git-pull-request"></i></span>
												<input type="text" readonly="" name="username" value="{{$user->username}}" class="form-control" placeholder="username lớn hơn 4 kí tự">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Email</label>
										<div class="col-lg-10">
											<div class="input-group">
												<span class="input-group-addon"><i class="icon-git-pull-request"></i></span>
												<input type="email" readonly="" value="{{$user->email}}" name="email" class="form-control" placeholder="Nhập email">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Họ Tên</label>
										<div class="col-lg-10">
											<div class="input-group">
												<span class="input-group-addon"><i class="icon-git-pull-request"></i></span>
												<input type="text" value="{{$user->fullname}}" name="fullname" class="form-control" placeholder="Nhập đầy đủ họ tên">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Mật khẩu</label>
										<div class="col-lg-10">
											<div class="input-group">
												<span class="input-group-addon"><i class="icon-git-pull-request"></i></span>
												<input type="password" value="" name="password" class="form-control password" placeholder="Mật khẩu lớn hơn 3 và nhỏ hơn 32 kí tự">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Nhập lại Mật khẩu</label>
										<div class="col-lg-10">
											<div class="input-group">
												<span class="input-group-addon"><i class="icon-git-pull-request"></i></span>
												<input type="password" value="" name="repassword" class="form-control password" placeholder="">
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Chọn quyền:</label>
										<div class="col-lg-10">
											<select class="form-control" name="quyen">
												<option 
												@if($user->isAdmin == 1)
												selected=""
												@endif
												value="1">Quản trị viên</option>
												<option
												@if($user->isOwner == 1)
												selected=""
												@endif
												value="2">Chủ nhà trọ</option>
												<option
												@if($user->isAdmin != 1 && $user->isOwner != 1)
												selected=""
												@endif
												value="3">Người thuê trọ</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Trạng thái:</label>
										<div class="col-lg-10">
											<select class="form-control" name="tinhtrang">
												<option 
												@if($user->tinhtrang == 0)
												selected=""
												@endif
												value="0">Kích hoạt</option>
												<option
												@if($user->tinhtrang == 1)
												selected=""
												@endif
												value="1">Tạm khóa</option>
											</select>
										</div>
									</div>
									<center>
										<input type="submit" style="margin-top:20px" value="Chỉnh sửa" class="btn btn-success btn-rounded">
									</center>
									
								</div>
								<p></p>
								
							</form>
						</div>


					</div>

				</div>
			</div>
			<div class="col-md-4">
				<div class="content-group border-top-lg border-top-danger">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title"><span class="badge badge-primary"></span> Chú ý  </h5>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="collapse"></a></li>
									<li><a data-action="reload"></a></li>
									<li><a data-action="close"></a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body">

							<span class="badge badge-success" style="margin-bottom: 5px">Bỏ trống 2 trường giá trị mật khẩu nếu không thay đổi</span>
							<span class="badge badge-danger" style="margin-bottom: 5px">Mật khẩu lớn hơn 3 và nhỏ hơn 32 kí tự</span>
							<span class="badge badge-primary">Bỏ trống 2 trường giá trị mật khẩu nếu không thay đổi</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
@endsection