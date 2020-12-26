@extends('layout.master')
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-12">
                @if($house->count() + $review->count() + $houseunapproval->count() + $reviewunapproval->count() +  $reviewwaiting->count() == 0)
                    <div>Không có thông báo nào</div>
                @else
                    <div class="panel-heading">
						<h5 class="panel-title">Bạn có  <span class="badge badge-primary">{{ $house->count() + $review->count() + $houseunapproval->count() + $reviewunapproval->count() + $housewaiting->count() + $reviewwaiting->count()}} thông báo</span></h5>
					</div>
                        
                        @foreach($house as $room)
                                <div class="alert bg-success">
                                <span><a href="{{route('xoathongbaonha', $room->id)}}">Xóa</a></span>
                                <span class="text-semibold">Bài viết {{$room->title}} của bạn đã được phê duyệt.</span>  
                                </div>
                        @endforeach

                        @foreach($review as $re)
                                <div class="alert bg-success">
                                <span><a href="{{route('xoathongbaoreview', $re->id)}}">Xóa</a></span>
					<span class="text-semibold">Bình luận của bạn về bài viết " {{$re->house->title}} " của bạn đã được phê duyệt</span>  
                                </div>
                        @endforeach

                        @foreach($houseunapproval as $roomun)
                                <div class="alert bg-danger">
                                <span><a href="{{route('xoathongbaonha', $roomun->id)}}">Xóa</a></span>
			        <span class="text-semibold">Bài viết {{$roomun->title}} của bạn đã bị admin từ chối phê duyệt.</span>  
                                </div>
                        @endforeach

                        @foreach($reviewunapproval as $reunap)
                                <div class="alert bg-danger">
                                <span><a href="{{route('xoathongbaoreview', $reunap->id)}}">Xóa</a></span>
							    <span class="text-semibold">Bình luận của bạn về bài viết " {{$reunap->house->title}} " của bạn đã bị admin từ chối phê duyệt</span>  
                                </div>
                        @endforeach

                        @foreach($housewaiting as $roomwwait)
                                <div class="alert bg-warning">
                                <span><a href="{{route('xoathongbaonha', $roomwwait->id)}}">Xóa</a></span>
							    <span class="text-semibold">Bài viết {{$roomwwait->title}} của bạn đang đợi admin phê duyệt.</span>  
                                </div>
                        @endforeach

                        @foreach($reviewwaiting as $reviewating)
                                <div class="alert bg-warning">
                                <span><a href="{{route('xoathongbaoreview', $reviewating->id)}}">Xóa</a></span>
							    <span class="text-semibold">Bình luận của bạn về bài viết " {{$reviewating->house->title}} " của bạn đang đợi admin phê duyệt.</span>  
                                </div>
                        @endforeach
                        
                @endif
            </div>
        </div>
    </div>

@endsection