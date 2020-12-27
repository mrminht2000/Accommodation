<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">
					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<div class="media-body pt-5">
								@if(Auth::guard('account')->user())
									<li class="dropdown">
										<span>{{Auth::user()->fullname}}</span>
										<i class="caret"></i>
									</li>
								@else
									{{route('signin')}};
								@endif
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small"></i> Hà Nội
									</div>
								</div>

								
							</div>
						</div>
					</div>
					<!-- /user menu -->
					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>QUẢN TRỊ</span> <i class="icon-menu" title="Main pages"></i></li>
								<li><a href="house/list"><i class="icon-home4"></i> <span>Danh sách Phòng trọ</span></a></li>
								<li><a href="account/listAccount"><i class="icon-user-check"></i><span> Danh sách người dùng</span></a></li>
								<li><a href="account/listaccountwaiting"><i class="icon-user"></i><span> Danh sách tài khoản cần duyệt</span></a></li>
								<li><a href="{{route('reviewadmin')}}"><i class="icon-lan"></i><span> Phê duyệt bình luận</span></a></li>
								<li><a href="{{route('reportadmin')}}"><i class="icon-bubble-notification"></i><span> Báo cáo nội dung</span></a></li>
								<li><a href="{{route('thongke')}}"><i class="icon-pie-chart8"></i><span> Thống kê</span></a></li>
								<li><a href="#"><i class="icon-home2"></i><span> Xem Trang chủ</span></a></li>
								
								
								<!-- /page kits -->

							</ul>
							
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->