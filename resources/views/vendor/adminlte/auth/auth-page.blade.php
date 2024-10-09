@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

@section('body')
<video autoplay muted loop id="bg-video">
    <source src="https://cdn.shopify.com/videos/c/o/v/e3ba870855904fc389bd509897d8e929.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
</video>
<form method="POST" action="{{route('admin.login.user')}}">
    @method('post')
    @csrf
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <div class="card box-glass">
                    <div class="card-header">
                        <h5 class="">Redline Management</h5>
                    </div>
                    <div class="card-body">
                        <input class="form-control box-glass my-3" type="email" name="email" placeholder="Email">
                        <input class="form-control box-glass my-3" type="password" name="password" placeholder="Password">
                        <button type="submit" class="btn btn-primary btn-sm w-100">sign in</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    .box-glass{
        background: rgba( 255, 255, 255, 0.1 );
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
        backdrop-filter: blur( 7px );
        -webkit-backdrop-filter: blur( 7px );
        border-radius: 10px;
        border: 1px solid rgba( 255, 255, 255, 0.18 );
    }
    #bg-video {
    position: fixed;
    right: 0;
    bottom: 0;
    min-width: 100%;
    min-height: 100%;
    z-index: -1;
    opacity: 0.7; /* ปรับความโปร่งใสของวิดีโอ */
    }

</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var video = document.getElementById('bg-video');
        video.play();
    });
</script>

@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
