@extends("layout")
@section("content")
    <!--=== Slider ===-->
    <div id="sequence-theme" class="sequence-inner">
        <div id="sequence">
            <img class="prev" src="{{ URL::to('assets/plugins/horizontal-parallax/images/bt-prev1.png') }}" alt="Previous" />
            <img class="next" src="{{ URL::to('assets/plugins/horizontal-parallax/images/bt-next1.png') }}" alt="Next" />
            <ul>
                <li class="animate-in">
                    <div class="info">
                        <h2>Airbus Helicopters Southeast Asia Pte. Ltd.</h2>
                        <p>Intranet back office application</p>
                    </div>
                    <img class="balloon" src="{{ URL::to('assets/plugins/horizontal-parallax/images/EC225.png') }}" alt="Balloon" />
                </li>
                <li>
                    <div class="info">
                        <h2>We are upgrading!</h2>
                        <p>New layout, user-friendly interface, added functionalities and securities. </p>
                    </div>
                    <img class="aeroplane" src="{{ URL::to('assets/plugins/horizontal-parallax/images/aeroplane.png') }}" alt="Aeroplane" />
                </li>
                <li>
                    <div class="info">
                        <h2>We are migrating!</h2>
                        <p>First module to be released is Employee Appraisal a.k.a. (E-Appraisal)</p>
                    </div>
                    <img class="kite" src="{{ URL::to('assets/plugins/horizontal-parallax/images/kite.png') }}" alt="Kite" />
                </li>
            </ul>
        </div>
    </div><!--/sequence-theme-->
    <!--=== End Slider ===-->
@stop