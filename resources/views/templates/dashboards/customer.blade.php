<div id="content-view">
    <h1>PRODUTOS</h1>
    @foreach ($products as $product)
        <div id="product" class="col-10 col-sm-6 col-md-5 col-lg-5">
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
                    <h5>R$ {{ str_replace('.', ',', $product->value . '0') }} </h5>
                @else
                    <h5>R$ {{ str_replace('.', ',', $product->value) }}</h5>
                @endif
            @endif
            
            <div id="product-content">
                <div class="form-group">
                    @include('templates.forms.withoutdiv.range', ['name' => 'amount', 'start' => '1', 'end' => '10', 'selected' => '1' ,'attributes' => ['class' => 'form-control'], ])
                    @include('templates.forms.withoutdiv.button', ['name' => 'Adicionar', 'attributes' => ['value' => 'add', 'class' => 'btn', 'id' => 'btn-add']])
                </div>
            </div>
        </div>
    @endforeach    
</div>