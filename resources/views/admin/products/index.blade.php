<td>
    {{ Form::open(['id' => 'delete', 'route' => ['admin.product.edit', $product->id], 'method' => 'get']) }}
        {{ Form::submit(trans('header.product.col_edit'), ['data-id' => $product->id, 'class' => 'btn btn-xs btn-primary']) }}
    {{ Form::close() }}
</td>
<td>
    {{ Form::open(['id' => 'delete', 'route' => ['admin.product.destroy', $product->id], 'method' => 'delete']) }}
        {{ Form::submit(trans('header.product.col_trash'), ['data-id' => $product->id, 'class' => 'btn btn-xs btn-danger']) }}
    {{ Form::close() }}
</td>
