<td>
    {{ Form::open(['id' => 'delete', 'route' => ['product.restore', $product->id], 'method' => 'get']) }}
        {{ Form::submit(trans('header.product.col_restore'), ['data-id' => $product->id, 'class' => 'btn btn-xs btn-primary']) }}
    {{ Form::close() }}
</td>
<td>
    {{ Form::open(['id' => 'delete', 'route' => ['product.kill', $product->id], 'method' => 'delete']) }}
        {{ Form::submit(trans('header.delete'), ['data-id' => $product->id, 'class' => 'btn btn-xs btn-danger']) }}
    {{ Form::close() }}
</td>
