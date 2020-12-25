@extends('layout.master')
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-12">
                @if($house->count() + $review->count()==0)
                    <div>Không có thông báo nào</div>
                @else
                    <div class="panel-heading">
						<h5 class="panel-title">Bạn có  <span class="badge badge-primary">{{ $house->count() + $review->count() }} thông báo</span></h5>
					</div>
                        
                        @foreach($house as $room)
                                <div class="alert bg-success">
                                    
                                <li><a href="{{ route('xoathongbao', $room->id)}}">Xóa</a></li>
                                
                                <span class="text-semibold">Bài viết {{$room->title}} đã được phê duyệt.</span>  
                                </div>
                        @endforeach

                        @foreach($review as $re)
                                <div class="alert bg-success">
							    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
							    <span class="text-semibold">Bình luận của bạn về bài viết " {{$re->house->title}} "đã được phê duyệt</span>  
                                </div>
                        @endforeach
                        
                @endif
            </div>
        </div>
    </div>

@endsection