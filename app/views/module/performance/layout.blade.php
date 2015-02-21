@extends("layout")
@section("content")
    <!--=== Menu ===-->
    <div class="parallax-team parallaxBg">
        <div class="row">
            <!-- side menu -->
            @include("module.performance.menu")
            
            <!-- each page under local module -->
            @yield("performance_content")
            
        </div>
    </div>  
    <!--=== End Menu ===-->
    
@stop