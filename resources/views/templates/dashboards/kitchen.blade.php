<h1>PEDIDOS</h1>
@foreach ($orders as $order)
    @if ($order->status == 'preparing')
        <div id="order" class="col-8 col-sm-6 col-md-5 col-lg-4">
            <h4>NÚMERO DO PEDIDO</h4>
            <h4>{{ $order->id }}</h4>
            <hr>
            @php
                $products = explode('|', $order->products);
                for ($i = 0; $i < count($products) ; $i++) { 
                    $product = explode('-', $products[$i]);
                    $product_amount = $product[0];
                    $product_name = $product[2];
                    echo('<h5>' . $product_amount . 'x ' . $product_name . '<h5>');
                }
            @endphp
            <hr>
            <div id="order-content">        
                <div class="form-group">
                    @if ($order->customer_name)
                        <h5>Cliente: {{$order->customer_name}}</h5> 
                    @endif                    
                    @include('templates.forms.withoutdiv.button', ['name' => 'Pronto', 'attributes' => ['value' => $order->id, 'class' => 'btn', 'id' => 'btn-' . $order->id]])
                </div>
            </div>
        </div>    
    @endif
@endforeach

@section('content-js')
    <script>
        $('#content-view').on('click', 'button', (value) => {    
            swal({
                title: "Aviso",
                text: "Essa função ainda não foi implementada!",
                icon: "warning"
            }); 
        });  
    </script>      
@endsection
    
