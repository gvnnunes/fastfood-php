@extends('templates.master')

@section('content')
    @if (session('permission'))
        @if (session('permission') == 'app.user')
            <div id="c-content" class="col-lg-8 mx-auto mt-5 shadow-lg">
        @else
            <div id="content" class="col-lg-8 mx-auto my-auto shadow-lg">
        @endif
    @endif    
        <div id="content-view">
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
        </div>
    </div>
@endsection

@section('content-footer')
    @if (session('permission'))
        @if (session('permission') == 'app.user')
            <div id="footer">
                <div id="order">
                    <h2 id="order-value">Valor do pedido: </h2>
                </div>
                <div id="checkout">
                    @include('templates.forms.button', ['name' => 'VER PEDIDO', 'attributes' => ['class' => 'btn', 'id' => 'btn-checkin']])
                </div>        
            </div>
        @endif
    @endif
@endsection