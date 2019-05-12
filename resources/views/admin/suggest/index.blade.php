@extends('layouts.app')
@section('content')
    <div class="card-header">
        @lang('header.suggest.title')
    </div>
    <table class="table table-hover">
        <thead>
        <th>
            @lang('header.users.header_name')
        </th>
        <th>
            @lang('header.category.col_category')
        </th>
        <th>
            @lang('header.suggest.content')
        </th>
        <th>
            @lang('header.order.status')
        </th>
        </thead>
        <tbody>
        @if ($suggests->count() > config('setting.default_value_0'))
            @foreach ($suggests as $suggest)
                <tr>
                    <td>
                        {{ $suggest->product_name }}
                    </td>
                    <td>
                        {{ $suggest->category->name }}
                    </td>
                    <td>
                        {{ $suggest->content }}
                    </td>
                    <td>
                        <a class="btn btn-info btn-group-sm " href="{{ route('admin.changeStatus', [ 'id'=>$suggest->id, 'status'=>$suggest->status  ]) }}">{{$suggest->getStatus()}}</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">@lang('header.suggest.no_suggest')</td>
            </tr>
        @endif
        </tbody>
    </table>
    {{ $suggests->links() }}
@endsection
