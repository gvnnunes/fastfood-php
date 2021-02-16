@extends('templates.master')

@section('modal')
    @if (session('permission'))
        @if (session('permission') == 'app.user')
            <div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h2 class="modal-title" id="modal-title">RESUMO DO PEDIDO</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-body-value">
                        <hr class="mt-0">
                        <h2 id="modal-total-value"></h2>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn" id="btn-cancel-order">CANCELAR PEDIDO</button>
                    <button type="button" class="btn" id="btn-checkout">CONFIRMAR PEDIDO</button>
                    </div>
                </div>
                </div>
            </div>
        @endif
    @endif  
@endsection

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