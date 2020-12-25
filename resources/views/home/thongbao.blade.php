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
                                <span class="text-semibold">Bài viết {{$room->title}} đã được phê duyệt.</span>  
                                </div>
                        @endforeach

                        @foreach($review as $re)
                                <div class="alert bg-success">
							    <span class="text-semibold">Bình luận của bạn về bài viết " {{$re->house->title}} "đã được phê duyệt</span>  
                                </div>
                        @endforeach

                        @foreach($houseunapproval as $roomun)
                                <div class="alert bg-danger">
							    <span class="text-semibold">Bài viết {{$room->title}} đã bị admin từ chối phê duyệt.</span>  
                                </div>
                        @endforeach

                        @foreach($reviewunapproval as $reunap)
                                <div class="alert bg-danger">
							    <span class="text-semibold">Bình luận của bạn về bài viết " {{$reunap->house->title}} "đã bị admin từ chối phê duyệt</span>  
                                </div>
                        @endforeach

                        @foreach($housewaiting as $roomwwait)
                                <div class="alert bg-warning">
							    <span class="text-semibold">Bài viết {{$roomwwait->title}} đang đợi admin phê duyệt.</span>  
                                </div>
                        @endforeach

                        @foreach($reviewwaiting as $reviewating)
                                <div class="alert bg-warning">
							    <span class="text-semibold">Bình luận của bạn về bài viết " {{$reviewating->house->title}} "đang đợi admin phê duyệt.</span>  
                                </div>
                        @endforeach
                        
                @endif
            </div>
        </div>
    </div>

@endsection