@extends("setup.layout")
@section("setup_content")
    <div class="col-md-10">
        <!--Table Bordered-->
        <div class="table-search-v1 panel panel-grey">
            <div class="panel-heading">
                <h3 class="panel-title pull-left"><i class="fa fa-user"></i> User List</h3>
                <div class="pull-right">
                    <div class="navbar-right">
                        <a class="btn btn-success btn-xs" data-toggle="modal" data-target="#search_modal"><i class="fa fa-search"></i> Search</a>
                        <a href="{{ URL::to('user_invite') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Invite User</a>
                        <a href="{{ URL::to('user/create') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="1%"><p>#</p></th>
                            @if ($data['url_sort']['sort_by'] == 'user_firstname')
                            <th class="col-sm-4"><p><i class="{{ $shareView['order'][$data['url_sort']['order_by']]['class'] }}"></i> {{ link_to_action('UserController@index', 'First Name', array_merge($data['url_sort'], array('sort_by' => 'user_firstname'))) }}</p></th>
                            @else
                            <th class="col-sm-4"><p><i class="{{ $shareView['order']['']['class'] }}"></i> {{ link_to_action('UserController@index', 'First Name', array_merge($data['url_sort'], array('sort_by' => 'user_firstname'))) }}</p></th>
                            @endif
                            
                            @if ($data['url_sort']['sort_by'] == 'user_lastname')
                            <th class="col-sm-4"><p><i class="{{ $shareView['order'][$data['url_sort']['order_by']]['class'] }}"></i> {{ link_to_action('UserController@index', 'Last Name', array_merge($data['url_sort'], array('sort_by' => 'user_lastname'))) }}</p></th>
                            @else
                            <th class="col-sm-4"><p><i class="{{ $shareView['order']['']['class'] }}"></i> {{ link_to_action('UserController@index', 'Last Name', array_merge($data['url_sort'], array('sort_by' => 'user_lastname'))) }}</p></th>
                            @endif
                            
                            @if ($data['url_sort']['sort_by'] == 'user_status')
                            <th class="col-sm-2"><p><i class="{{ $shareView['order'][$data['url_sort']['order_by']]['class'] }}"></i> {{ link_to_action('UserController@index', 'Status', array_merge($data['url_sort'], array('sort_by' => 'user_status'))) }}</p></th>
                            @else
                            <th class="col-sm-2"><p><i class="{{ $shareView['order']['']['class'] }}"></i> {{ link_to_action('UserController@index', 'Status', array_merge($data['url_sort'], array('sort_by' => 'user_status'))) }}</p></th>
                            @endif
                            <th width="1%" colspan="2"><p>Action</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!is_null($data['users']) && $data['users']->count())
                            @foreach($data['users'] as $key => $value)
                                <tr>
                                    <td><p>{{ $data['count']++ }}</p></td>
                                    <td><p>{{ $value->user_firstname }}</p></td>
                                    <td><p>{{ $value->user_lastname }}</p></td>
                                    <td><p><i class="{{ $shareView['status'][$value->user_status][1] }}"></i> {{ $shareView['status'][$value->user_status][0] }}</p></td>
                                    <td>
                                        <p><a href="{{ URL::to('user/' . $value->user_key . '/edit') }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Update</a></p></td>
                                    <td>
                                        <p><button class="open-ConfirmDelete btn btn-danger btn-xs" data-toggle="modal" data-target="#confirm_delete" name="temp_user_id[]" value="{{ $value->user_key }}"><i class="fa fa-trash-o"></i> Delete</button></p></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No Record Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <input type="hidden" name="path" value="user">
                {{ $data["users"]->appends($data['url_pagination'])->links() }}
            </div>
            
            <!-- Search Forms -->
            <div class="margin-bottom-40">
                {{ Form::open(array('action' => array('user.index'), 'method' => 'get', 'class' => 'sky-form')) }}
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
                                            <section class="col col-4"><label class="label"> First Name</label></section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="s_firstname" value="{{ $data['s_firstname'] }}">
                                                </label>
                                            </section>
                                        </div>
                                        
                                        <div class="row">
                                            <section class="col col-4"><label class="label"> Last Name</label></section>
                                            <section class="col col-8">
                                                <label class="input">
                                                    <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="s_lastname" value="{{ $data['s_lastname'] }}">
                                                </label>
                                            </section>
                                        </div>
                                        
                                        <div class="row">
                                            <section class="col col-4"><label class="label"> Status</label></section>
                                            <section class="col col-4">
                                                <label class="select">
                                                    <select name="s_status">
                                                        <option value="" selected>All</option>
                                                        @foreach($data["status"] as $key => $value)
                                                            @if($data['s_status'] == $key)
                                                                <option value="{{ $key }}" selected>{{ $value }}</option>
                                                            @else
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <i></i>
                                                    <em class="invalid error-msg">&nbsp;<em>
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
            
            <!-- Delete Confirmation -->
            <div class="margin-bottom-40">
                {{ Form::open(array('action' => array('user.index'), 'method' => 'DELETE', 'id' => 'form_delete')) }}
                    <div class="modal fade" id="confirm_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Delete this record?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-u btn-u-default" data-dismiss="modal"><i class="fa fa-thumbs-down"></i> No</button>
                                    <button type="submit" class="btn-u"><i class="fa fa-thumbs-up"></i> Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            <!-- End Delete Confirmation -->
        </div>
        <!--End Table Bordered-->
    </div>
@stop