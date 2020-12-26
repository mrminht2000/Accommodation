@extends('admin.layout.master')
@section('content2')
<!-- Main content -->
<div class="content-wrapper">
	<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Danh sách các phòng trọ</h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="admin"><i class="icon-home2 position-left"></i> Trang chủ</a></li>
							<li class="active">Trang Quản Lý</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->
	<div class="content">
		<div class="row">
			<div class="col-12">
				<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Số lượt bình luận <span class="badge badge-primary">{{$review->count()}}</span></h5>
						</div>

						<div class="panel-body">
							Các <code>Tài khoản</code> được liệt kê tại đây. <strong>Dữ liệu đang cập nhật.</strong>
						</div>
                        @if(session('thongbao'))
                        <div class="alert bg-success">
							<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
							<span class="text-semibold">Well done!</span>  {{session('thongbao')}}
						</div>
                        @endif
						<table class="table datatable-show-all">
							<thead>
								<tr class="bg-blue">
									<th>Người bình luận</th>
									<th>Bài đăng</th>
                                    <th>Bình luận</th>
                                    <th>Đánh giá</th>
									<th>Trạng thái</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($review as $re)
								<tr>
									<td><a href="#" target="_blank">{{$re->account->fullname}}</a></td>
									<td>{{$re->house->title}}</td>
									
                                    <td>{{$re->describe}}</td>
                                    <td>
                                        <?php
									for ($i = 5; $i > $re->rating; $i--)
										echo ('<span class="float-right"><i class="fa fa-star"></i></span>');
									for ($i = 0; $i < $re->rating; $i++)
										echo ('<span class="float-right"><i class="text-warning fa fa-star"></i></span>');
                                    ?> 
                                    </td>
									<td>
										@if($re->isApproval == 1)
											<span class="label label-success">Đã kiểm duyệt</span>
										@elseif($re->isApproval == 0 || $re->isApproval == 2)
											<span class="label label-danger">Chờ Phê Duyệt</span>
										@endif
									</td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													@if($re->isApproval == 1)
														<li><a href="{{route('unapprovereview', $re->id)}}"><i class="icon-file-pdf"></i> Bỏ kiểm duyệt</a></li>
													@elseif($re->isApproval == 0 || $re->isApproval == 2)
														<li><a href="{{route('approvereview', $re->id)}}"><i class="icon-file-pdf"></i> Kiểm duyệt</a></li>
													@endif
													
													<li><a href="{{route('deletereview', $re->id)}}"><i class="icon-file-excel"></i> Xóa</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
			</div>
		</div>
		
	</div>
</div>
@endsection