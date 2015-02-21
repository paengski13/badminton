@section("menu")
<ul class="nav navbar-nav pull-right">
    @if (Auth::check())
		<!-- Home -->
		<li class="{{ ($data['page_module'] == 'Home') ? 'active' : '' }}"><a href="{{ URL::to('home') }}"><span class="icon-home"></span> Home</a></li>
		<!-- End Home -->

		@if ($level_access == 'Y' || $rank_access == 'Y' || $tournament_access == 'Y' || $user_access == 'Y' || $debt_access == 'Y' || $location_access == 'Y' || $game_access == 'Y')
		<!-- Setup -->
		<li class="dropdown {{ ($data['page_module'] == 'Setup') ? 'active' : '' }}">
			<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cogs"></span> Setup&nbsp;&nbsp;</a>
			<ul class="dropdown-menu">
            @if ($level_access == 'Y')
				<li class="{{ ($data['page_title'] == 'Level') ? 'active' : '' }}"><a href="{{ URL::to('level') }}"><span class="fa fa-level-up"></span> Level</a></li>
            @endif
            
            @if ($rank_access == 'Y')
				<li class="{{ ($data['page_title'] == 'Rank') ? 'active' : '' }}"><a href="{{ URL::to('rank') }}"><span class="fa fa-graduation-cap"></span> Rank</a></li>
            @endif
            
            @if ($tournament_access == 'Y')
				<li class="{{ ($data['page_title'] == 'Tournament') ? 'active' : '' }}"><a href="{{ URL::to('tournament') }}"><span class="fa fa-trophy"></span> Tournament</a></li>
            @endif
            
            @if ($user_access == 'Y')
				<li class="{{ ($data['page_title'] == 'User') ? 'active' : '' }}"><a href="{{ URL::to('user') }}"><span class="fa fa-user"></span> User</a></li>
            @endif
            
            @if ($debt_access == 'Y')
				<li class="{{ ($data['page_title'] == 'Debt') ? 'active' : '' }}"><a href="{{ URL::to('debt') }}"><span class="fa fa-money"></span> Debt</a></li>
            @endif
            
            @if ($location_access == 'Y')
				<li class="{{ ($data['page_title'] == 'Location') ? 'active' : '' }}"><a href="{{ URL::to('location') }}"><span class="fa fa-map-marker"></span> Location</a></li>
            @endif
            
            @if ($game_access == 'Y')
				<li class="{{ ($data['page_title'] == 'Game') ? 'active' : '' }}"><a href="{{ URL::to('game') }}"><span class="fa fa-gamepad"></span> Game</a></li>
            @endif
                
			</ul>
		</li>
		<!-- End Setup -->
		@endif
    @else
    <li><a></a>&nbsp;</li>
    @endif
</ul>
@show