@extends("module.performance.layout")
@section("performance_content")
    <div class="col-md-10">
        <!--Table Bordered-->
        <div class="table-search-v1 panel panel-grey">
            <div class="panel-heading">
                <h3 class="panel-title pull-left"><i class="fa fa-list-alt"></i> Evaluation Review List</h3>
                <div class="pull-right">
                    <div class="navbar-right">
                        <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#search_modal"><i class="fa fa-search"></i> Search</button>&nbsp;
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="1%"><p>#</p></th>
                            @if ($data['url_sort']['sort_by'] == 'employee_firstname')
                            <th class="col-sm-4"><p><i class="{{ $shareView['order'][$data['url_sort']['order_by']][1] }}"></i> {{ link_to_action('PerformanceController@showAppraiseeList', 'Employee', array_merge($data['url_sort'], array('sort_by' => 'employee_firstname'))) }}</p></th>
                            @else
                            <th class="col-sm-4"><p><i class="{{ $shareView['order'][''][1] }}"></i> {{ link_to_action('PerformanceController@showAppraiseeList', 'Employee', array_merge($data['url_sort'], array('sort_by' => 'employee_firstname'))) }}</p></th>
                            @endif
                            
                            <th class="col-sm-3"><p>Type</p></th>
                            
                            @if ($data['url_sort']['sort_by'] == 'appraisal_name')
                            <th class="col-sm-2"><p><i class="{{ $shareView['order'][$data['url_sort']['order_by']][1] }}"></i> {{ link_to_action('PerformanceController@showAppraiseeList', 'Appraisal', array_merge($data['url_sort'], array('sort_by' => 'appraisal_name'))) }}</p></th>
                            @else
                            <th class="col-sm-2"><p><i class="{{ $shareView['order'][''][1] }}"></i> {{ link_to_action('PerformanceController@showAppraiseeList', 'Appraisal', array_merge($data['url_sort'], array('sort_by' => 'appraisal_name'))) }}</p></th>
                            @endif
                            <th class="col-sm-3"><p>Status</p></th>
                            <th width="1%"><p>Action</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['performances']))
                            @foreach($data['performances'] as $key => $value)
                                <tr>
                                    <td><p>{{ $data['count']++ }}</p></td>
                                    <td><p>{{ $value->employee->employee_fullname }}</p></td>
                                    <td><p>{{ $value->template->template_name }}</p></td>
                                    <td><p>{{ $value->appraisal->appraisal_name }}</p></td>
                                    <td><p>{{ $data['appraisal_status'][$value->performance_status] }}</p></td>
                                    <td><p><a href="{{ URL::to('performance/form/' . $value->template->template_code .'/'. $value->random_id) }}" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> Update</a></p></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">No Record Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                
                {{ $data["performances"]->appends($data['url_pagination'])->links() }}
            </div>
            
            <!-- Search Forms -->
            <div class="margin-bottom-40">
                {{ Form::open(array('action' => array('PerformanceController@showAppraiseeList'), 'method' => 'get', 'class' => 'sky-form')) }}
                    <div class="modal fade" id="search_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Search</h4>
                                </div>
                                <div class="modal-body">
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-4"><label class="label"> Name</label></section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <i class="icon-append fa fa-trophy"></i>
                                                    <input type="text" name="s_name" value="{{ $data['s_name'] }}">
                                                </label>
                                            </section>
                                        </div>
                                        
                                        <div class="row">
                                            <section class="col col-4"><label class="label"> Appraisal</label></section>
                                            <section class="col col-8">
                                                <label class="select">
                                                    <select name="s_appraisal">
                                                        <option value="" selected>All</option>
                                                        @foreach ($data["appraisals"] as $value)
                                                            @if ($data['s_appraisal'] == $value->id)
                                                                <option value="{{ $value->id }}" selected>{{ $value->appraisal_name }}</option>
                                                            @else
                                                                <option value="{{ $value->id }}">{{ $value->appraisal_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <i></i>
                                                </label>
                                            </section>
                                        </div>
                                        
                                        <div class="row">
                                            <section class="col col-4"><label class="label"> Status</label></section>
                                            <section class="col col-8">
                                                <label class="select">
                                                    <select name="s_status">
                                                        <option value="" selected>All</option>
                                                        @foreach ($data["status"] as $key => $value)
                                                            @if ($data['s_status'] == $key)
                                                                <option value="{{ $key }}" selected>{{ $value }}</option>
                                                            @else
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <i></i>
                                                </label>
                                            </section>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-u btn-u-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" class="btn-u"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            <!-- End Search Forms -->
        </div>
        <!--End Table Bordered-->
    </div>
@stop