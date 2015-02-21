@section("menu_setup")
	<!-- Begin Sidebar Menu -->
	<div class="col-md-2">
		<ul class="list-group sidebar-nav-v1" id="sidebar-nav">
			<!-- Setup -->
			<li class="list-group-item list-toggle {{ ($data['page_module'] == 'Setup') ? 'active' : '' }}">
				<a class="accordion-toggle" href="#collapse-setup" data-toggle="collapse">Setup</a>
				<ul id="collapse-setup" class="collapse {{ ($data['page_module'] == 'Setup') ? 'in' : '' }}">
					@if ($level_access == 'Y')
						<li class="{{ ($data['page_title'] == 'Level') ? 'active' : '' }}"><a href="{{ URL::to('level') }}"><i class="fa fa-level-up"></i> Level</a></li>
					@endif
                    
					@if ($rank_access == 'Y')
						<li class="{{ ($data['page_title'] == 'Rank') ? 'active' : '' }}"><a href="{{ URL::to('rank') }}"><i class="fa fa-graduation-cap"></i> Rank</a></li>
					@endif
                    
					@if ($tournament_access == 'Y')
						<li class="{{ ($data['page_title'] == 'Tournament') ? 'active' : '' }}"><a href="{{ URL::to('tournament') }}"><i class="fa fa-trophy"></i> Tournament</a></li>
					@endif
                    
					@if ($user_access == 'Y')
						<li class="{{ ($data['page_title'] == 'User') ? 'active' : '' }}"><a href="{{ URL::to('user') }}"><i class="fa fa-user"></i> User</a></li>
					@endif
                    
					@if ($debt_access == 'Y')
						<li class="{{ ($data['page_title'] == 'Debt') ? 'active' : '' }}"><a href="{{ URL::to('debt') }}"><i class="fa fa-money"></i> Debt</a></li>
					@endif
                    
					@if ($location_access == 'Y')
						<li class="{{ ($data['page_title'] == 'Location') ? 'active' : '' }}"><a href="{{ URL::to('location') }}"><i class="fa fa-map-marker"></i> Location</a></li>
					@endif
                    
					@if ($game_access == 'Y')
						<li class="{{ ($data['page_title'] == 'Game') ? 'active' : '' }}"><a href="{{ URL::to('game') }}"><i class="fa fa-gamepad"></i> Game</a></li>
					@endif
				</ul>
			</li>
			<!-- End Setup -->
		</ul>
	</div>
	<!-- End Sidebar Menu -->
@show