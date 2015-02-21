@extends("module.performance.layout")
@section("performance_content")
    <div class="col-md-10">
        <!--Table Bordered-->
        <div class="table-search-v1 panel panel-grey margin-bottom-50">
            <div class="panel-heading">
                <h3 class="panel-title pull-left"><i class="fa fa-line-chart"></i> Performance Appraisal</h3>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <img id="logo-header" src="{{ URL::to('assets/img/performance/performance_appraisal_flow_chart_' . $data['current_quarter'] . '_quarter.png') }}" class="center-block">
				
            </div>
        </div>
        <!--End Table Bordered-->
    </div>
@stop