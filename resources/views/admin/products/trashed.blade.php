{{ Form::open(['id' => 'delete', 'route' => ['product.kill', $product->id], 'method' => 'delete']) }}
    {{ Form::submit(trans('header.delete'), ['data-id' => $product->id, 'class' => 'btn btn-xs btn-danger']) }}
{{ Form::close() }}
