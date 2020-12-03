@extends('layout.master')
@section('content')
<?php 
function limit_description($string){
	$string = strip_tags($string);
	if (strlen($string) > 150) {

	    // truncate string
		$stringCut = substr($string, 0, 150);
		$endPoint = strrpos($stringCut, ' ');

	    //if the string doesn't contain any space then it will cut without word basis.
		$string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
		$string .= '...';
	}
	return $string;
}
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
<div class="gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="#">Trang Chủ</a></li>
				
				<li class="active">{{ $house->title }}</li>
			</ul>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h1 class="entry-title entry-prop">{{ $house->title }}</h1>

			<hr>
			<div class="row">
				<div class="col-md-6">
					<span class="price_area">{{ number_format($house->price) }} <span class="price_label">VND</span></span>
				</div>
				<div class="col-md-6">
					<span class="pull-right">Lượt xem: {{ $house->count_view }} - <span>Ngày đăng: </span> <span style="color: red; font-weight: bold;">
						<?php echo time_elapsed_string($house->created_at); ?>
					</span></span>
				</div>
			</div>
			
			<hr>
			<div class="detail">
				<p><strong>Địa chỉ: {{ $house->address }}</strong><br></p>
				<p>
					<strong>Giá phòng: </strong><span class="price_area"><?php echo number_format($house->price); ?>  <span class="price_label">VND</span></span>
					<strong><i class="fas fa-street-view"></i> Diện tích: </strong><span> {{$house->size}} m <sup>2</sup> </span>
				</p>
				<!-- Tiện ích -->
				<?php $arrtienich = json_decode($house->utilities,true); ?>
				<div id="km-detail">
					<div class="fs-dtslt">Tiện ích Phòng Trọ</div>
					<div style="padding: 5px;">
						
					</div>
				</div>
				<h4>Mô tả:</h4>
				<pre>
					<p class="pre">{{ $house->description }}</p>
				</pre>
			</div>
			
			<?php 
			$arrimg =  json_decode($house->Image,true);
			?>
			<center>
			<!-- Slider Hình Ảnh -->
			@foreach($arrimg as $img)
				<img src="uploads/images/<?php echo $img; ?>" width="50%">
			@endforeach
			</center>
			<!-- END Slider Hình Ảnh -->		
			<div class="gap"></div>
		</div>
		
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var slider = $('.pgwSlider').pgwSlider();
		slider.previousSlide();
	});
</script>
<!-- <script>

	var map;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map-detail'), {
			center: {lat: 16.067011, lng: 108.214388},
			zoom: 15,
			draggable: true
		});
		/* Get latlng vị trí phòng trọ */
		<?php
		// $arrmergeLatln = array();

		// $arrlatlng = json_decode($house->latlng,true);

		// $arrmergeLatln[] = ["lat"=> $arrlatlng[0],"lng"=> $arrlatlng[1],"title"=>$house->title,"address"=> $house->address,"phone"=> $house->phone,"slug"=>$house->slug];
		// $js_array = json_encode($arrmergeLatln);
		// echo "var javascript_array = ". $js_array . ";\n";

		?>
		/* ---------------  */
		
		for (i in javascript_array){
			var data = javascript_array[i];
			var latlng =  new google.maps.LatLng(data.lat,data.lng);
			var phongtro = new google.maps.Marker({
				position:  latlng,
				map: map,
				title: data.title,
				icon: "images/gps.png",
				content: 'dgfdgfdg'
			});
			var infowindow = new google.maps.InfoWindow();
			(function(phongtro, data){
				var content = '<div id="iw-container">' +
				'<a href="phongtro/'+data.slug+'"><div class="iw-title">' + data.title +'</div></a>' +
				'<p><i class="fas fa-map-marker" style="color:#003352"></i> '+ data.address +'<br>'+
				'<br>Phone. ' +data.phone +'</div>';
				infowindow.setContent(content);
				infowindow.open(map, phongtro);
				google.maps.event.addListener(phongtro, "click", function(e){

					infowindow.setContent(content);
					infowindow.open(map, phongtro);
                  // alert(data.title);
              });
			})(phongtro,data);

		}
		google.maps.event.addListener(map, 'mousemove', function (e) {
			document.getElementById("flat").innerHTML = e.latLng.lat().toFixed(6);
			document.getElementById("lng").innerHTML = e.latLng.lng().toFixed(6);

		});


	}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzlVX517mZWArHv4Dt3_JVG0aPmbSE5mE&callback=initMap"
async defer></script> -->
@endsection