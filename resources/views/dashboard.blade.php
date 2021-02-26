@extends('templates.master')

@section('modal')
    @if (session('permission'))
        @if (session('permission') == 'app.user')
            <div class="modal fade" id="modal-checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <div class="modal-payment">
                        <div class="form-group">
                            <h2>Pagamento em dinheiro: </h2> 
                            @include('templates.forms.withoutdiv.number', ['name' => 'money-value', 'attributes' => ['min' => '0', 'placeholder' => '', 'class' => 'form-control' ,'id' => 'money-value']])
                        </div>                        
                    </div>
                    <div class="modal-give-change">
                        <h2 id="change-value" class="d-none"></h2>
                    </div>
                    <div class="modal-customer-name">
                        @include('templates.forms.withoutdiv.text', ['name' => 'customer-name', 'attributes' => ['placeholder' => 'Digite o seu nome (Opcional)', 'class' => 'form-control', 'id' => 'customer-name', 'maxlength' => '20']])
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn" id="btn-cancel-order">CANCELAR PEDIDO</button>
                    <button type="button" class="btn" id="btn-checkout" disabled>CONFIRMAR PEDIDO</button>
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
            <div id="c-content" class="col-lg-11 mx-auto mt-5 shadow-lg">
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
                <div class="container h-100">
                    <div class="row h-100">
                        <div id="order-footer">
                            <h2 id="order-value">Valor do pedido: </h2>                                                           
                            @include('templates.forms.button', ['name' => 'VER PEDIDO', 'attributes' => ['class' => 'btn', 'id' => 'btn-vieworder']])                   
                        </div>                        
                    </div>
                </div>       
            </div>
        @endif
    @endif
@endsection