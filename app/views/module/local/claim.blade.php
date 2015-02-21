@extends("module.local.layout")
@section("local_content")
    <!-- Begin Content -->
    <div class="col-md-9">
        <div class="shadow-wrapper">
            <!-- Shadow effects -->
            <div class="tag-box tag-box-v1 box-shadow shadow-effect-2">
                <h2 class="pull-left">
                    <i class="fa fa-thumb-tack"> Claims</i>
                </h2>
                <div class="pull-right">
                    <div class="btn-group navbar-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#search_modal"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
                <!--Table Bordered-->
                <div class="table-search-v1 panel panel-grey margin-bottom-50">
                @if ($data['result'])
                    @foreach ($data['local_expenses'] as $local_expense)
                    
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left"><i class="{{ $local_expense['template_icon'] }}"></i> {{ $local_expense['template_name'] }}</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th width="1%"><p>#</p></th>
                                        @foreach($local_expense['field'] as $key => $header)
                                            <th class="col-sm-{{ $header['size'] }}"><p>{{ $key }}</p></th>
                                        @endforeach
                                        <th class="col-sm-2"><p>Status</p></th>
                                        <th width="1%"><p>Action</p></th>
                                    </tr>
                                </thead>
                                {? $count = 1 ?}
                                <tbody>
                                    @foreach($local_expense['value'] as $id => $index)
                                    <tr>
                                        <td><p>{{ $count++ }}</p></td>
                                        @foreach($index as $key => $value)
                                            <td><p>{{ $value }}</p></td>
                                        @endforeach
                                        <td>
                                            <button type="button" value="{{ $id }}" class="btn btn-xs btn-success view_info" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-eye"></i> View</button>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @endif
                </div>
                <!--End Table Bordered-->
            </div>
            <!-- End Shadow effects -->
        </div>
                
        <!-- View full details -->
        <div class="margin-bottom-40">
            {{ Form::open(array('action' => array('LocalController@updateForm', '_5448cfbdd99960.19410084'), 'class' => 'sky-form', 'files' => true, 'method' => 'PUT', 'id' => 'frm')) }}
                <div class="modal fade bs-example-modal-lg sky-form" id="view_details" tabindex="-1" role="dialog" aria-labelledby="ViewModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title modal-title-form" id="ViewModal"></h4>
                            </div>
                            
                            <div class="modal-body modal-body-form"></div>

                            <div class="modal-footer">
                                
                                <button type="button" class="btn-u btn-u-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                <button type="button" class="open-ConfirmDelete btn-u" data-toggle="modal" data-target="#confirm_submit"><i class="fa fa-paper-plane"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                @include("confirmation.claim_submission")
            {{ Form::close() }}
        </div>
        <!-- End View full details -->
        
        <!-- Search Forms -->
        <div class="margin-bottom-40">
            {{ Form::open(array('action' => array('LocalController@getClaims'), 'method' => 'get', 'class' => 'sky-form')) }}
                <div class="modal fade" id="search_modal" tabindex="-1" role="dialog" aria-labelledby="SearchModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="SearchModal">Search</h4>
                            </div>
                            <div class="modal-body">
                                <fieldset>
                                    <div class="row">
                                        <section class="col col-4"><label class="label"> Status</label></section>
                                        <section class="col col-4">
                                            <label class="select">
                                                <select name="s_status">
                                                    <option value="0" selected>All Pending</option>
                                                    @foreach($data["template_status"] as $value)
                                                        @if($data['s_status'] == $value->approver_type_code)
                                                            <option value="{{ $value->approver_type_code }}" selected>{{ $value->approver_type_name }}</option>
                                                        @else
                                                            <option value="{{ $value->approver_type_code }}">{{ $value->approver_type_name }}</option>
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
    <!-- End Content -->
@stop