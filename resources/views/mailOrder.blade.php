@component('mail::message')
    @lang('layouts.mail.order_product') {{ $transaction->created_at }}

    @lang('layouts.mail.order_mess')

    @lang('header.order.id') {{ $transaction->id }}
    @lang('header.order.total_price') {{ $transaction->amount }}
    @lang('layouts.mail.message') {{$transaction->message}}

@component('mail::table')

        |@lang('header.product.title_product')  |@lang('layouts.mail.qty')  |@lang('header.product.col_price')   |
        |--------------|---------|------------|
        @foreach ($transaction->order as $or)
            |{{$or->product->name}} |{{$or->quantity}}   |   ${{$or->amount}}|
        @endforeach
        |&nbsp;   |@lang('header.order.total_price')|${{$transaction->amount}}|

@endcomponent

@component('mail::button',  ['url' => $url])
    @lang('layouts.mail.view_detail')
@endcomponent

    @lang('layouts.mail.regards')
    @lang('layouts.mail.system')
@endcomponent
