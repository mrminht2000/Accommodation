@extends('layout.master')
@section('content')
<?php 
function time_elapsed_string($datetime, $full = false) {
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
?>

<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="banner-info mb-5">
				<div>
					@if($user->avatar == 'no-avatar.jpg')
					<img style="color:#ffffff;background-color:rgb(188, 188, 188);user-select:none;display:inline-flex;align-items:center;justify-content:center;font-size:40px;border-radius:50%;height:120px;width:1200px;"  size="80" src="{{ URL:: to('source/images/no-avatar.jpg')}}" class="avatar" data-reactid="57">
					@else
					<img style="color:#ffffff;background-color:rgb(188, 188, 188);user-select:none;display:inline-flex;align-items:center;justify-content:center;font-size:40px;border-radius:50%;height:120px;width:120px;"  size="80" src="uploads/avatars/{{$user->avatar}}" class="avatar" data-reactid="57">
					@endif
					
				</div>
				<div class="info">
					<h4 class="name" data-reactid="59">{{ $user->fullname }}</h4>
					<div class="infoText">
						Tham gia {{ time_elapsed_string($user->created_at) }} - {{ $user->created_at }}
					</div>
					<div style="margin:15px;"> 
					@if($user->id==Auth::guard('account')->user()->id)
					<a class="btn btn-info" href="{{route('edituser', Auth::guard('account')->user()->id)}}">Chỉnh sửa thông tin</a>
					@endif
					</div>
				</div>
			</div>
			<div class="mypage">
				<h4>Tin đã đăng gần đây</h4>
				@if(session('thongbao'))
				<div class="alert bg-danger">
					<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Hi!</span>  {{session('thongbao')}}
				</div>
				@endif
				<div class="mainpage">
					@if( count($mypost) < 1)
					<div class="alert alert-info">
						Bạn chưa có tin đăng phòng trọ nào đang cho thuê, thử đăng ngay.
					</div>
					<a href="{{route('post')}}" class="btn-post">ĐĂNG TIN</a>
					@else
					<div class="table-responsive">
						<table class="table">
						<thead>
							<tr>
								<th>Tiêu đề</th>
								<th>Danh mục</th>
								<th>Gía phòng</th>
								<th>Lượt xem</th>
								<th>Tình trạng</th>
								<th> </th>
							</tr>
						</thead>
						<tbody>
							@foreach($mypost as $post)
							<tr>	
								<td>{{ $post->title }}</td>
								<td>{{ $post->housetype->name }}</td>
								<td>{{ $post->price }}</td>
								<td>{{ $post->count_view }}</td>
								<td>
									@if($post->isApproval == 1)
										<span class="label label-success">Đã kiểm duyệt</span>
									@elseif($post->isApproval == 0)
										<span class="label label-danger">Chờ Phê Duyệt</span>
									@endif
								</td>
								<td>
									<a href="{{route('chitietphong', $post->id)}}"><i class="fas fa-eye"></i> Xem</a>
									@if($user->id==Auth::guard('account')->user()->id && $post->isApproval == 0)
									<a href="{{route('edithouse', $post->id)}}" style="color:red"><i class="fas fa-trash-alt"></i> Chỉnh sửa</a>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					</div>
					@endif
				</div>	
			</div>
		</div>
	</div>
</div>
@endsection