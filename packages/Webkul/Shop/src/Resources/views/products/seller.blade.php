{!! view_render_event('bagisto.shop.products.seller.before', ['product' => $product]) !!}

@if ($product->type == 'simple')
    <div slot="header">
    </div>
    <div slot="body">
        <div class="full-description">
            {{ __('shop::app.products.seller')}}:

            <a href="{{$product->store->path()}}">{{ $product->store->name }}</a>
        </div>
    </div>
@else
@endif

{!! view_render_event('bagisto.shop.products.seller.after', ['product' => $product]) !!}