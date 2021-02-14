<div id="content-view">
    <h1>PRODUTOS</h1>
    <div id="product" class="col-lg-5">
        <div id="img-content">
            <img src="{{ asset('images/hamburguer.jpg') }}">
        </div>
        <h4>Product Name</h4>
        <div id="product-content">
            <div class="form-group">
                @include('templates.forms.withoutdiv.range', ['name' => 'amount', 'start' => '1', 'end' => '10', 'selected' => '1' ,'attributes' => ['class' => 'form-control'], ])
                @include('templates.forms.withoutdiv.button', ['name' => 'Adicionar', 'attributes' => ['value' => 'add', 'class' => 'btn', 'id' => 'btn-add']])
            </div>
        </div>
    </div>
</div>