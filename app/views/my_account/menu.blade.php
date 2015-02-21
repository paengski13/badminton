@section("menu_my_account")
	<!-- Begin Sidebar Menu -->
	<div class="col-md-2">
		<ul class="list-group sidebar-nav-v1" id="sidebar-nav">
			<!-- Setup -->
			<li class="list-group-item list-toggle {{ ($data['page_module'] == 'My Account') ? 'active' : '' }}">
				<a class="accordion-toggle" href="#collapse-setup" data-toggle="collapse">My Account</a>
				<ul id="collapse-setup" class="collapse {{ ($data['page_module'] == 'My Account') ? 'in' : '' }}">
                    <li class="{{ ($data['page_title'] == 'My Info') ? 'active' : '' }}"><a href="{{ URL::to('my_account/info') }}"><i class="fa fa-user"></i> My Info</a></li>
                    <li class="{{ ($data['page_title'] == 'Change Password') ? 'active' : '' }}"><a href="{{ URL::to('my_account/password') }}"><i class="fa fa-key"></i> Change Password</a></li>
				</ul>
			</li>
			<!-- End Setup -->
		</ul>
	</div>
	<!-- End Sidebar Menu -->
@show