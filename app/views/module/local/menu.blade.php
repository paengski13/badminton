@section("menu_local")
    <!-- Begin Sidebar Menu -->
    <div class="col-md-3">
        <ul class="list-group sidebar-nav-v1" id="sidebar-nav">
            <!-- Local Expenses -->
            <li class="list-group-item list-toggle {{ ($page_subgroup == 'local_expenses') ? ' active' : '' }}">
                <a class="accordion-toggle" href="#collapse-templates" data-toggle="collapse">Local Expenses</a>
                <ul id="collapse-templates" class="collapse {{ ($page_subgroup == 'local_expenses') ? 'in' : '' }}">
                    @if (isset($data['templates']))
                        @foreach ($data['templates'] as $key => $value)
                            <li class="{{ (isset($data['template']['template_code']) && $value->template->template_code == $data['template']['template_code']) ? 'active' : '' }}">
                                <a href="{{ URL::to('local/form/'.$value->template->template_code) }}"><i class="{{ $value->template->template_icon }}"></i> {{ $value->template->template_name }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </li>
            <!-- End Local Expenses -->
            
            <!-- Claims -->
            <li class="list-group-item {{ ($page_subgroup == 'claims') ? 'active' : '' }}"><a href="{{ URL::to('local/claim') }}">Claims</a></li>
            <!-- End Claims -->
        </ul>
    </div>
    <!-- End Sidebar Menu -->
@show