@section("form_local_modal")
<!--a href="javascript:void(0);"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#responsive"><i class="fa fa-search"></i> Search</button></a-->
    <!-- Forms -->
    <div class="margin-bottom-40">
        {{ Form::open(array('action' => 'local.store', 'class' => 'sky-form')) }}
            <div class="modal fade" id="responsive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Search</h4>
                        </div>
                        <div class="modal-body">
                            <fieldset>
                                <div class="row">
                                    <section class="col col-4"><label class="label"> Group Name</label></section>
                                    <section class="col col-8">
                                        <label class="input">
                                            <i class="icon-append fa fa-group"></i>
                                            <input type="text" name="s_name" value="">
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
    <!-- End Forms -->
    
@show