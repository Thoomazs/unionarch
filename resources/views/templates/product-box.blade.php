
<div class="col-sm-4">
    <div class="product-box">
        <a href="{{ route('products.detail', [$product->slug]) }}">
            <img src="{{ $product->photo }}" class="img-responsive" alt=""/>
            <hr/>
            <div class="clearfix">
                <h4 class="pull-left no-margin">{{ $product->name }}</h4>
                <span class=".h4 text-success font-weight-bold pull-right">{{ $product->price . ' ' . trans('Kč')}}</span>
            </div>

        </a>
    </div>
</div>