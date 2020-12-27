@extends('layout.master')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="banner-info mb-5">
				<div  style="" >
					@if(Auth::guard('account')->user()->avatar == 'no-avatar.jpg')
					<img style="color:#ffffff;background-color:rgb(188, 188, 188);user-select:none;display:inline-flex;align-items:center;justify-content:center;font-size:40px;border-radius:50%;height:120px;width:120px;"  size="80" src="{{ URL:: to('source/images/no-avatar.jpg')}}" class="avatar" data-reactid="57">
					@else
					<img style="color:#ffffff;background-color:rgb(188, 188, 188);user-select:none;display:inline-flex;align-items:center;justify-content:center;font-size:40px;border-radius:50%;height:120px;width:120px;"  size="80" src="uploads/avatars/{{Auth::guard('account')->user()->avatar}}" class="avatar" data-reactid="57">
					@endif
				</div>
				<div class="info">
					<h4 class="name" data-reactid="59">{{ Auth::guard('account')->user()->fullname }}</h4>
				</div>
			</div>
			<div class="mypage">
				<h4>các bài viết mà bạn quan tâm</h4>
				<div class="mainpage">
					@if( count($housefollow) < 1)
					<div class="alert alert-info">
						Bạn chưa theo dõi nhà trọ nào.
					</div>
					@else
					<div class="table-responsive">
						<table class="table">
						<thead>
							<tr>
								<th>Tiêu đề</th>
								<th>Danh mục</th>
								<th>Gía phòng</th>
								<th>Lượt xem</th>
								<th> </th>
							</tr>
						</thead>
						<tbody>
							@foreach($housefollow as $post)
							<tr>	
								<td>{{ $post->house->title }}</td>
								<td>{{ $post->house->housetype->name }}</td>
								<td>{{ $post->house->price }}</td>
								<td>{{ $post->house->count_view }}</td>
								<td>
									<a href="{{route('chitietphong', $post->house->id)}}"><i class="fas fa-eye"></i> Xem</a>
									<a href="{{route('deletefollow', $post->id)}}" style="color:red"><i class="fas fa-trash-alt"></i> Bỏ theo dõi</a>
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