@extends('templates.master')

@section('content-view')
    @if (session('permission'))
        @if (session('permission') == 'app.user')
            @include('templates.dashboards.customer')
        @elseif (session('permission') == 'app.kitchen')
            @include('templates.dashboards.kitchen')
        @elseif (session('permission') == 'app.withdraw')
            @include('templates.dashboards.withdraw')
        @elseif (session('permission') == 'app.manager')
            @include('templates.dashboards.manager')
        @endif
    @endif
@endsection