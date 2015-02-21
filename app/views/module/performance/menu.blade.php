@section("menu_performance")
    <!-- Begin Sidebar Menu -->
    <div class="col-md-2">
        <ul class="list-group sidebar-nav-v1" id="sidebar-nav">
            <!-- My Appraisal -->
            <li class="list-group-item list-toggle {{ ($page_module == 'My Appraisal') ? ' active' : '' }}">
                <a class="accordion-toggle" href="#collapse-my_appraisal" data-toggle="collapse">My Appraisal</a>
                <ul id="collapse-my_appraisal" class="collapse {{ ($page_module == 'My Appraisal') ? 'in' : '' }}">
					<!--
                    @if (isset($data['menu_templates']))
                        @foreach ($data['menu_templates'] as $key => $value)
                            <li class="{{ (isset($data['template']['template_code']) && $value->template_code == $data['template']['template_code']) ? 'active' : '' }}">
								@if (isset($data['appraisals']) && isset($data['template_count'][$value->template_code]) && $data['appraisals']->count() != $data['template_count'][$value->template_code])
								<span class="badge badge-u rounded-x" title=" Please fill-up the {{ $value->template_name }} form"><i class="fa fa-exclamation"></i></span>
								@endif
                                <a href="{{ URL::to('performance/form/'.$value->template_code) }}"><i class="{{ $value->template_icon }}"></i> {{ $value->template_name }}</a></li>
                        @endforeach
                    @endif
					-->
					@if (isset($data['menu_templates']) && $data['menu_templates']->count() > 0)
					<li class="{{ ($page_subgroup == 'Appraisal Detail') ? 'active' : '' }}"><a href="{{ URL::to('performance/form/' . $data['menu_templates'][0]['template_code']) }}"><i class="fa fa-file-text"></i> Fill-up Appraisal</a></li>
					@endif
                    <li class="{{ ($page_subgroup == 'Appraisal Detail') ? 'active' : '' }}"><a href="{{ URL::to('performance/detail') }}"><i class="fa fa-file-text"></i> Summary</a></li>
                </ul>
            </li>
            <!-- End My Appraisal -->
            
            @if ($data["is_appraiser"])
            <!-- Appraiser -->
            <li class="list-group-item list-toggle {{ ($page_module == 'Appraiser') ? ' active' : '' }}">
                <a class="accordion-toggle" href="#collapse-appraiser" data-toggle="collapse">Appraiser</a>
                <ul id="collapse-appraiser" class="collapse {{ ($page_module == 'Appraiser') ? 'in' : '' }}">
                    <li class="{{ ($page_subgroup == 'Appraisee Review') ? 'active' : '' }}"><a href="{{ URL::to('performance/appraisee_list') }}"><i class="fa fa-list-alt"></i> Appraise Review</a></li>
                    <li class="{{ ($page_subgroup == 'Appraisee Rating') ? 'active' : '' }}"><a href="{{ URL::to('performance/appraisee_detail') }}"><i class="fa fa-thumbs-up"></i> Appraise Rating</a></li>
                    
                </ul>
            </li>
            <!-- End Appraiser -->
            @endif
            
            @if ($module_performance_report_access == 'Y')
            <!-- Performance Report -->
            <li class="list-group-item list-toggle {{ ($page_module == 'Report') ? ' active' : '' }}">
                <a class="accordion-toggle" href="#collapse-report" data-toggle="collapse">Report</a>
                <ul id="collapse-report" class="collapse {{ ($page_module == 'Report') ? 'in' : '' }}">
                    <li class="{{ ($page_subgroup == 'Summary Report') ? 'active' : '' }}"><a href="{{ URL::to('performance/appraisee_result') }}"><i class="fa fa-coffee"></i> Summary</a></li>
                </ul>
            </li>
            <!-- End Performance Report -->
            @endif
        </ul>
    </div>
    <!-- End Sidebar Menu -->
@show