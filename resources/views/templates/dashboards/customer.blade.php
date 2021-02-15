<h1>PRODUTOS</h1>
@foreach ($products as $product)
    <div id="product" class="col-8 col-sm-6 col-md-5 col-lg-4">
        <div id="img-content">
            <img src="{{ asset($product->photo) }}">
        </div>
        <h4>{{ $product->name }}</h4>
        
        @if (!strpos($product->value, '.'))
            <h5>R$ {{ $product->value = $product->value . ',00' }}</h5>
        @else
            @php
                $value = explode('.', $product->value);
                $num_decimals = strlen($value[1]);
            @endphp
            @if ($num_decimals == 1)
                <h5>R$ {{ str_replace('.', ',', $product->value . '0') }} </h5>            @else
                <h5>R$ {{ str_replace('.', ',', $product->value) }}</h5>
            @endif
        @endif
        
        <div id="product-content">
            <div class="form-group">
                @include('templates.forms.withoutdiv.range', ['name' => 'amount', 'start' => '1', 'end' => '10', 'selected' => '1' ,'attributes' => ['class' => 'form-control', 'id' => 'amount-' . $product->id], ])
                @include('templates.forms.withoutdiv.button', ['name' => 'Adicionar', 'attributes' => ['value' => $product->id, 'class' => 'btn', 'id' => 'btn-add-' . $product->id]])
            </div>
        </div>
    </div>
@endforeach

@section('content-js')
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script> 
        $(document).ready(() => {
            if(Cookies.get('order_value_total_formatted') != undefined){
                $('#order-value').text('Valor do pedido: R$ ' + Cookies.get('order_value_total_formatted'));
            }
        });

        $('#content-view').on('click', 'button', (value) => {    
            id = $(value.target).val();
            amount = $('#amount-' + id).val();

            $.ajax({
                url: "{{ route('add.product') }}",
                method: 'post',
                data: {
                    'id': id,
                    'amount': amount
                },
                success:function(response){
                    if(Cookies.get('product_cart') == undefined){
                        Cookies.set('product_cart', response['id'] + ' ' + response['amount'] + ' ' + response['order_value']);
                    }
                    else{
                        product_cart = Cookies.get('product_cart');
                        Cookies.set('product_cart', product_cart + '|' + response['id'] + ' ' + response['amount'] + ' ' + response['order_value']);
                    }

                    if(Cookies.get('order_value_total') == undefined){
                        order_value_total = parseFloat(response['order_value']).toFixed(2);
                        Cookies.set('order_value_total', order_value_total);
                        showOrderValueTotal(order_value_total);
                    }
                    else{
                        order_value_total = parseFloat(Cookies.get('order_value_total')) + parseFloat(response['order_value']);
                        order_value_total = order_value_total.toFixed(2);
                        Cookies.set('order_value_total', order_value_total);
                        showOrderValueTotal(order_value_total);
                    }
                    console.log(Cookies.get());
                },
            });
        });
         
        $('#btn-checkout').click(() => {
            console.log('checkin');
        });

        function showOrderValueTotal(order_value){
            order_value_total_formatted = order_value.toString().split('.');

            if(order_value_total_formatted[1] != undefined){                        
                num_lines = order_value_total_formatted[1].length;
                
                if(num_lines == 1){
                    order_value_total_formatted = order_value_total_formatted[0] + ',' + order_value_total_formatted[1] + '0';
                }
                else{
                    order_value_total_formatted = order_value_total_formatted[0] + ',' + order_value_total_formatted[1];
                }                    
            }
            else{
                order_value_total_formatted = order_value_total_formatted[0] + ',00';
            }

            Cookies.set('order_value_total_formatted', order_value_total_formatted);
            $('#order-value').text('Valor do pedido: R$ ' + Cookies.get('order_value_total_formatted'));
        }

        function clearCookies(){
            Cookies.remove('XSRF-TOKEN');
            Cookies.remove('product_cart');
            Cookies.remove('order_value_total');
            Cookies.remove('order_value_total_formatted');
        }

    </script>
@endsection