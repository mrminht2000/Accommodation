@extends('layout.master')
@section('content')
<div class="gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h1 class="entry-title entry-prop">Đăng tin Phòng trọ</h1>
			<hr>
			<div class="panel panel-default">
				<div class="panel-heading">Thông tin bắt buộc*</div>
				<div class="panel-body">
					<div class="gap"></div>
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					@if(session('warn'))
          <div class="alert bg-danger">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            <span class="text-semibold">Error!</span>  {{session('warn')}}
          </div>
          @endif
          @if(session('success'))
					<div class="alert bg-success">
						<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
						<span class="text-semibold">Done!</span>  {{session('success')}}
					</div>
					@endif
       
					<form action="{{ route ('post') }}" method="POST" enctype="multipart/form-data" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label for="usr">Tiêu đề bài đăng:</label>
							<input type="text" class="form-control" name="title">
						</div>
						
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="usr">Giá phòng( vnđ ):</label>
                  <input type="number" name="price" class="form-control" placeholder="750000" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="usr">Diện tích(m2):</label>
                  <input type="number" name="size" class="form-control" placeholder="16">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="usr">Tỉnh/ Thành phố:</label>
                  <select class="form-cotrol " data-live-search="true" data-type="provinces" id="province" name="province_id">
										<option>--Chọn tỉnh--</option>
										@foreach($provinces as $city)
										<option value="{{ $city->id }}" name="{{ $city->id }}">{{ $city->name }}</option>
										@endforeach
									</select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="usr">Quận / Huyện:</label>
                  <select class="form-cotrol " data-live-search="true" data-type="districts" id="districts" name="id_districts">
										<option>--Chọn Quận/Huyện--</option>
									</select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="usr">Danh mục:</label>
                  <select class="form-cotrol" data-live-search="true" class="form-control" name="id_type"> 
                      @foreach($danh_muc  as $danh)
                    <option data-tokens="{{$danh->slug}}" value="{{ $danh->id }}">{{ $danh->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="usr">SĐT Liên hệ:</label>
                  <input type="text" name="phoneNumber" class="form-control" placeholder="0915111234">
                </div>
              </div>
            </div> 

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Chung chủ:</label>
                  <br/>
                  <input type="radio" id="iswithowner" name="isWithOwner" value=1>
                    <label for="isWithOwner">Có</label><br>
                  <input type="radio" id="iswithowner" name="isWithOwner" value=0>
                    <label for="isWithOwner">Không</label><br>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Phòng tắm: </label>
                  <br/>
                  <input type="radio" id="bathroom" name="bathroom" value=1>
                    <label for="bathroom">Khép kín</label><br>
                  <input type="radio" id="bathroom" name="bathroom" value=0>
                    <label for="bathroom">Chung</label><br>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Phòng bếp: </label>
                  <br/>
                  <input type="radio" id="kitchen" name="kitchen" value="Bếp riêng">
                    <label for="kitchen">Bếp riêng</label><br>
                  <input type="radio" id="kitchen" name="kitchen" value="Bếp chung">
                    <label for="kitchen">Bếp chung</label><br>
                  <input type="radio" id="kitchen" name="kitchen" value="Không nấu ăn">
                    <label for="kitchen">Không nấu ăn</label><br>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  
                  <label>Điều hòa:</label>
                  <br/>
                  <input type="radio" id="air_conditioning" name="air_conditioning" value=1>
                    <label for="air_conditioning">Có</label><br>
                  <input type="radio" id="air_conditioning" name="air_conditioning" value=0>
                    <label for="air_conditioning">Không</label><br>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Ban công: </label>
                  <br/>
                  <input type="radio" id="balcony" name="balcony" value=1>
                    <label for="balcony">Có</label><br>
                  <input type="radio" id="balcony" name="balcony" value=0>
                    <label for="balcony">Không</label><br>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Điện(giá thuê 1 số điện) :</label>
                  <br/>
                  <input type="number" name="electricPrice" id="electricPrice">
                  <br/>
                  <label>Nước(giá thuê 1 m3 nước) :</label>
                  <br/>
                  <input type="number" id="waterPrice" name="waterPrice">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="comment">Mô tả ngắn:</label>
              <textarea class="form-control" rows="5" id="description" name="description" style=" resize: none;"></textarea>
            </div>
            <div class="form-group">
              <label for="comment">Thêm hình ảnh:</label>
              <div class="file-loading">
                <input id="file-5" type="file" class="file" name="hinhanh[]" multiple data-preview-file-type="any" data-upload-url="#">
              </div>
            </div>
            
            <button class="btn btn-primary">Đăng Tin</button>
          </form>
          
        </div>
      </div>
    </div>
    <div class="col-md-4">
     <div class="contactpanel">
      <div class="row">
       <div class="col-md-4 text-center">
        <!-- <img src="assets/images/noavt.png" class="img-circle" alt="Cinque Terre" width="100" height="100">  -->
      </div>
     
    </div>
  </div>
  
  <div class="gap"></div>
  <!-- <img src="images/banner-1.png" width="100%"> -->
</div>
</div>
</div>

<script>
     $('#file-5').fileinput({
    theme: 'fa',
    language: 'vi',
    showUpload: false,
    allowedFileExtensions: ['jpg', 'png', 'gif']
  });
</script>
<script>
		$(document).ready(function(){
			$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
            });
            $('#province').change(function(event){
               	event.preventDefault();
				
				let route = '{{route('districts')}}';
				let $this = $(this);
				let type = $this.attr('data-type');
				let provinceid = $this.val();
               	$.ajax({
					method: "GET",
					url: route,
					data: {
						type: type,
						province_id: provinceid
					}
                })
				.done(function(msg) {
					if(msg.data) {
						let html = '';
						let element = '';
						if(type == 'provinces')
						{
							html = "<option>--Chọn Quận Huyện--</option>";
							element = '#districts';
						}
						$.each(msg.data, function(index, value) {
						html += "<option value='"+value.id+"' name='"+value.id+"'>"+value.name+"</option>"
						});

						$(element).html('').append(html);
					}

					
				});
            });
        });
	</script>

@endsection