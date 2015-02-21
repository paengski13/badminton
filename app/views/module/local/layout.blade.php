@extends("layout")
@section("content")
    
    <!--=== Menu ===-->
    <div class="parallax-team parallaxBg">
        <div class="row">
            <!-- side menu -->
            @include("module.local.menu")
            
            <!-- each page under local module -->
            @yield("local_content")
        </div>
    </div>  
    <!--=== End Menu ===-->
    
@stop