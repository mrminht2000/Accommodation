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
				<!--	@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif-->
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
                  <label for="usr">Quận/ Huyện:</label>
                  <select class="selectpicker pull-right" data-live-search="true" name="iddistrict">
                  
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="usr">Danh mục:</label>
                  <select class="selectpicker pull-right" data-live-search="true" class="form-control" name="idcategory"> 
                   
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="usr">SĐT Liên hệ:</label>
                  <input type="text" name="txtphone" class="form-control" placeholder="0915111234">
                </div>
              </div>
            </div> 

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Chung chủ:</label>
                  <br/>
                  <input type="radio" id="iswithowner" name="isWithOwner" value="isWithOwner">
                    <label for="isWithOwner">Có</label><br>
                  <input type="radio" id="iswithowner" name="isWithOwner" value="isWithOwner">
                    <label for="isWithOwner">Không</label><br>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Phòng tắm: </label>
                  <br/>
                  <input type="radio" id="bathroom" name="bathroom" value="bathroom">
                    <label for="bathroom">Có</label><br>
                  <input type="radio" id="bathroom" name="bathroom" value="bathroom">
                    <label for="bathroom">Không</label><br>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Phòng bếp: </label>
                  <br/>
                  <input type="radio" id="kitchen" name="kitchen" value="kitchen">
                    <label for="kitchen">Bếp riêng</label><br>
                  <input type="radio" id="kitchen" name="kitchen" value="kitchen">
                    <label for="kitchen">Bếp chung</label><br>
                  <input type="radio" id="kitchen" name="kitchen" value="kitchen">
                    <label for="kitchen">Không nấu ăn</label><br>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  
                  <label>Điều hòa:</label>
                  <br/>
                  <input type="radio" id="air_conditioning" name="air_conditioning" value="air_conditioning">
                    <label for="air_conditioning">Có</label><br>
                  <input type="radio" id="air_conditioning" name="air_conditioning" value="air_conditioning">
                    <label for="air_conditioning">Không</label><br>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Ban công: </label>
                  <br/>
                  <input type="radio" id="balcony" name="balcony" value="balcony">
                    <label for="balcony">Có</label><br>
                  <input type="radio" id="balcony" name="balcony" value="balcony">
                    <label for="balcony">Không</label><br>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Điện(giá thuê 1 số điện) :</label>
                  <br/>
                  <input type="text" name="electric">
                  <br/>
                  <label>Nước(giá thuê 1 m3 nước) :</label>
                  <br/>
                  <input type="text" name="water">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="comment">Mô tả ngắn:</label>
              <textarea class="form-control" rows="5" name="txtdescription" style=" resize: none;"></textarea>
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
        <img src="assets/images/noavt.png" class="img-circle" alt="Cinque Terre" width="100" height="100"> 
      </div>
     
    </div>
  </div>
  
  <div class="gap"></div>
  <img src="images/banner-1.png" width="100%">
</div>
</div>
</div>
<script type="text/javascript">
  $('#file-5').fileinput({
    theme: 'fa',
    language: 'vi',
    showUpload: false,
    allowedFileExtensions: ['jpg', 'png', 'gif']
  });
</script>
<script>
  var map;
  var marker;
  function initialize() {
    var mapOptions = {
      center: {lat: 16.070372, lng: 108.214388},
      zoom: 12
    };
    map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // Get GEOLOCATION
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
        position.coords.longitude);
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({
        'latLng': pos
      }, function (results, status) {
        if (status ==
          google.maps.GeocoderStatus.OK) {
          if (results[0]) {
            console.log(results[0].formatted_address);
          } else {
            console.log('No results found');
          }
        } else {
          console.log('Geocoder failed due to: ' + status);
        }
      });
      map.setCenter(pos);
      marker = new google.maps.Marker({
        position: pos,
        map: map,
        draggable: true
      });
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }

  function handleNoGeolocation(errorFlag) {
    if (errorFlag) {
      var content = 'Error: The Geolocation service failed.';
    } else {
      var content = 'Error: Your browser doesn\'t support geolocation.';
    }

    var options = {
      map: map,
      zoom: 19,
      position: new google.maps.LatLng(16.070372,108.214388),
      content: content
    };

    map.setCenter(options.position);
    marker = new google.maps.Marker({
      position: options.position,
      map: map,
      zoom: 19,
      icon: "images/gps.png",
      draggable: true
    });
    /* Dragend Marker */ 
    google.maps.event.addListener(marker, 'dragend', function() {
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {
            $('#location-text-box').val(results[0].formatted_address);
            $('#txtaddress').val(results[0].formatted_address);
            $('#txtlat').val(marker.getPosition().lat());
            $('#txtlng').val(marker.getPosition().lng());
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(map, marker);
          }
        }
      });
    });
    /* End Dragend */

  }

  // get places auto-complete when user type in location-text-box
  var input = /** @type {HTMLInputElement} */
  (
    document.getElementById('location-text-box'));


  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  marker = new google.maps.Marker({
    map: map,
    icon: "images/gps.png",
    anchorPoint: new google.maps.Point(0, -29),
    draggable: true
  });

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      return;
    }
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'latLng': place.geometry.location}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          $('#txtaddress').val(results[0].formatted_address);
          infowindow.setContent(results[0].formatted_address);
          infowindow.open(map, marker);
        }
      }
    });
    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17); // Why 17? Because it looks good.
    }
    marker.setIcon( /** @type {google.maps.Icon} */ ({
      url: "images/gps.png"
    }));
    document.getElementById('txtlat').value = place.geometry.location.lat();
    document.getElementById('txtlng').value = place.geometry.location.lng();
    console.log(place.geometry.location.lat());
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
      (place.address_components[0] && place.address_components[0].short_name || ''), (place.address_components[1] && place.address_components[1].short_name || ''), (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }
    /* Dragend Marker */ 
    google.maps.event.addListener(marker, 'dragend', function() {
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {
            $('#location-text-box').val(results[0].formatted_address);
            $('#txtlat').val(marker.getPosition().lat());
            $('#txtlng').val(marker.getPosition().lng());
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(map, marker);
          }
        }
      });
    });
    /* End Dragend */
  });

}


// google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script type="text/javascript" src="assets/js/selectize.js"></script>
<script>
  $(function() {
    $('select').selectize(options);
  });
  $('#select-state').selectize({
    maxItems: null
  });
</script>
@endsection