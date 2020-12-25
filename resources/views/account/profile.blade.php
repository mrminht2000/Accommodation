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
				<div class="mapInfo false" style="" data-reactid="47" >
					@if($user->avatar == 'no-avatar.jpg')
					<img style="color:#ffffff;background-color:rgb(188, 188, 188);user-select:none;display:inline-flex;align-items:center;justify-content:center;font-size:40px;border-radius:50%;height:120px;width:1200px;"  size="80" src="{{ URL:: to('source/images/no-avatar.jpg')}}" class="avatar" data-reactid="57">
					@else
					<img style="color:#ffffff;background-color:rgb(188, 188, 188);user-select:none;display:inline-flex;align-items:center;justify-content:center;font-size:40px;border-radius:50%;height:120px;width:120px;"  size="80" src="uploads/avatars/{{$user->avatar}}" class="avatar" data-reactid="57">
					@endif
					@if($user->id==Auth::guard('account')->user())
					<a href="{{route('edituser', Auth::guard('account')->user()->id)}}"><div style="color: rgba(0, 0, 0, 0.87); background-color: transparent; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Verdana, Arial, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 10px, rgba(0, 0, 0, 0.23) 0px 3px 10px; border-radius: 50%; display: inline-block; position: absolute; right: 20px; bottom: -17px;"><button tabindex="0" type="button" style="border: 10px; box-sizing: border-box; display: inline-block; font-family: Verdana, Arial, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); cursor: pointer; text-decoration: none; margin: 0px; padding: 0px; outline: none; font-size: 25px; font-weight: inherit; position: relative; vertical-align: bottom; z-index: 1; background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 35px; width: 35px; overflow: hidden; border-radius: 50%; text-align: center; color: rgb(51, 51, 51);"><div><div style="transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; top: 0px;"><span class="ion-android-create" style="color: rgb(51, 51, 51); position: relative; font-size: 25px; display: inline-block; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 35px; line-height: 35px; fill: rgb(255, 255, 255);"><i class="fas fa-pencil-alt"></i></span></div></div></button></div></a>
					@endif
				</div>
				<div class="info">
					<h4 class="name" data-reactid="59">{{ $user->fullname }}</h4>
					<div class="infoText">
						Tham gia {{ time_elapsed_string($user->created_at) }} - {{ $user->created_at }}
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