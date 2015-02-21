@extends("layout")
@section("content")
    
    <!--=== Menu ===-->
    <div class="parallax-team parallaxBg">
        <div class="row">
            <!-- side menu -->
            @include("my_account.menu")
            
            <!-- each page under local module -->
            @yield("show_content")
        </div>
    </div>  
    <!--=== End Menu ===-->
    
@stop