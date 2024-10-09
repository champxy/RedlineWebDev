@extends('adminlte::master')
@section('body')
    @include('layouts.components.nav')
    @yield('content')
    @include('layouts.components.footer')
@endsection
