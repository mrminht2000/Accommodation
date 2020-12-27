@extends('admin.layout.master')
@section('content2')
<!-- Main content -->
<div class="content-wrapper">
	<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Danh sách các  thành viên cần duyệt</h4>
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
						
                        @if(session('thongbao'))
                        <div class="alert bg-success">
							<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
							<span class="text-semibold">Well done!</span>  {{session('thongbao')}}
						</div>
                        @endif
						<table class="table datatable-show-all">
							<thead>
								<tr class="bg-blue">
									<th>ID</th>
									
									<th>Họ Tên</th>
									<th>Email</th>
									<th>Quyền</th>
									<th>Trạng thái</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($user as $tk)
								@if($tk->isApproval == 0)
								<tr>
									<td>{{$tk->id}}</td>
									
									<td>{{$tk->fullname}}</td>
									<td>{{$tk->email}}</td>
									
									<td>
											@if($tk->isOwner == 1)
												Chủ nhà trọ
											@endif
									</td>
									<td>
										@if($tk->isApproval == 0)
											<span class="label label-danger">Chờ phê duyệt</span>
										@endif
									</td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													
													@if($tk->isApproval == 0)
														<li><a href="account/approve/{{$tk->id}}"><i class="icon-file-pdf"></i> Kiểm duyệt</a></li>
													@endif
													
													
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
					</div>
			</div>
		</div>
		
	</div>
</div>
@endsection