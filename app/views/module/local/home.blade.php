@extends("module.local.layout")
@section("local_content")
    <!-- Begin Content -->
    <div class="col-md-9">
        <div class="shadow-wrapper">
            <div class="tag-box tag-box-v1 box-shadow shadow-effect-2">
                <h2>
                    <i class="fa fa-paper-plane"> Submission of claims</i>
                </h2>
                <p>The submission of claims for {{ $data['cutoffs'][0]->cutoff_name }} is between <strong>{{ date($shareView['date_format_2'], strtotime($data['cutoffs'][0]->cutoff_start)) }}</strong> until <strong>{{ date($shareView['date_format_2'], strtotime($data['cutoffs'][0]->cutoff_end)) }}</strong>.</p>
            </div>
        </div>
    </div>                
    <!-- End Content -->
@stop