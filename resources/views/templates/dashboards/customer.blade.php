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
                @include('templates.forms.withoutdiv.range', ['name' => 'amount', 'start' => '1', 'end' => '10', 'selected' => '1' ,'attributes' => ['class' => 'form-control product-amount', 'id' => 'amount-' . $product->id], ])
                @include('templates.forms.withoutdiv.button', ['name' => 'Adicionar', 'attributes' => ['value' => $product->id, 'class' => 'btn', 'id' => 'btn-add-' . $product->id]])
            </div>
        </div>
    </div>
@endforeach

@section('content-js')
    <!-- JS Cookie CDN -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script> 
        /* JQuery e funções do sistema */

        $(document).ready(() => {
            if(Cookies.get('order_value_total_formatted') != undefined){
                $('#order-value').text('Valor do pedido: R$ ' + Cookies.get('order_value_total_formatted'));
            }
        });

        $('#content-view').on('click', 'button', (value) => {    
            id = $(value.target).val();
            amount = $('#amount-' + id).val();

            $.ajax({
                url: "{{ route('add.cart.product') }}",
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id,
                    'amount': amount
                },
                success:function(response){
                    if(Cookies.get('product_cart') == undefined){
                        Cookies.set('product_cart', response['id'] + '-' + response['amount'] + '-' + response['order_value'] + '-' + response['name']);
                    }
                    else{
                        product_cart = Cookies.get('product_cart');
                        Cookies.set('product_cart', product_cart + '|' + response['id'] + '-' + response['amount'] + '-' + response['order_value'] + '-' + response['name']);
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
                },
            });
        });
         
        $('#btn-vieworder').click(() => {
            if(Cookies.get('product_cart') != undefined){
                products = Cookies.get('product_cart').split('|');
                $.ajax({
                    url: "{{ route('show.cart.products') }}",
                    method: 'post',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'products': products                
                    },
                    success:function(response){
                        for(i = 0; i < response.length; i++){
                            product_information = response[i].split('-');
                            product_id = product_information[0];
                            product_name = product_information[1];
                            product_amount = product_information[2];
                            product_total_value = product_information[3];
                            product_total_value = formatValue(product_total_value);
                            $('.modal-body').append('<div class="form-group"><h4>' + product_amount + 'x ' + product_name + ' R$ ' + product_total_value + '</h4> <button type="button" class="btn btn-remove-product" id="' + product_id + '">Remover</button><br></div>');
                            if(i != response.length-1){
                                $('.modal-body').append('<hr>');
                            }
                        }
                        $('#modal-total-value').text('Valor do pedido: R$ ' + Cookies.get('order_value_total_formatted'));
                        $('#btn-checkout').prop('disabled', true);
                        $('#modal-checkout').modal('show');
                    }
                });
            }
            else{
                swal({
                    title: "Aviso",
                    text: "É necessário adicionar pelo menos 1 item!",
                    icon: "warning"
                });
            }            
        });

        $('#money-value').keyup(() => {
            troco = parseFloat($('#money-value').val() - Cookies.get('order_value_total'))
            if(troco >= 0){
                $('#change-value').text('Troco: R$ ' + formatValue(troco.toFixed(2)));
                $('#change-value').removeClass('d-none');
                $('#btn-checkout').prop('disabled', false);
            }
            else{
                $('#change-value').text('');
                $('#change-value').addClass('d-none');
                $('#btn-checkout').prop('disabled', true);
            }          
        });

        $('#btn-checkout').click(() => {
            products = Cookies.get('product_cart').split('|');
            order_value_total = Cookies.get('order_value_total');
            money_value = $('#money-value').val();
            change_value = $('#change-value').text().split(' ');
            change_value = change_value[2].replace(',', '.');
            customer_name = $('#customer-name').val().toUpperCase();
            $.ajax({
                url: "{{ route('checkout') }}",
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'products': products,
                    'order_value_total': order_value_total,
                    'money_value': money_value,
                    'change_value': change_value,
                    'customer_name': customer_name
                },
                success:function(response){
                    clearCookies();
                    $('#modal-checkout').modal('hide');
                    $('#order-value').text('Valor do pedido: ');
                    $('.product-amount').val('1');
                    swal({
                        title: "Pedido confirmado!",
                        text: "Seu número: " + response,
                        icon: "success",
                    })
                }
            });
        });

        $('#btn-cancel-order').click(() => {
            clearCookies();
            $('#order-value').text('Valor do pedido: ');
            $('.product-amount').val('1');
            $('#modal-checkout').modal('hide');
            swal({
                title: "Pedido cancelado!",
                icon: "success"
            });
        });

        

        $('.modal-body').on('click', 'button', (value) => {    
            id = $(value.target).attr('id');
            swal({
                title: "Aviso",
                text: "Essa função ainda não foi implementada!",
                icon: "warning"
            });
        });

        /* Limpa os campos estáticos ao fechar o modal */
        $('#modal-checkout').on('hidden.bs.modal', function () {
            $('.modal-body').text(''); 
            $('#money-value').val('');
            $('#change-value').addClass('d-none');
            $('#customer-name').val('');
        });

        function showOrderValueTotal(order_value){            
            order_value_total_formatted = formatValue(order_value);
            Cookies.set('order_value_total_formatted', order_value_total_formatted);
            $('#order-value').text('Valor do pedido: R$ ' + Cookies.get('order_value_total_formatted'));
        }

        /* Funções gerais */

        function formatValue(value){
            order_value_total_formatted = value.toString().split('.');
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
            return order_value_total_formatted;
        }

        function clearCookies(){
            Cookies.remove('PHPSESSID');
            Cookies.remove('XSRF-TOKEN');
            Cookies.remove('product_cart');
            Cookies.remove('order_value_total');
            Cookies.remove('order_value_total_formatted');
        }
    </script>
@endsection