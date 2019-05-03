@extends('layouts.app')
@section('content')
    <div class="card-header">@lang('header.category.title_category')</div>
    <table class="table table-hover">
        <thead>
            <th>
                @lang('header.category.col_category')
            </th>
            <th>
                @lang('header.category.col_parent')
            </th>
            <th>
                @lang('header.category.col_edit')
            </th>
            <th>
                @lang('header.delete')
            </th>
        </thead>
        <tbody>
        @if($categories->count() > config('setting.default_value_0') )
            @foreach($categories as $category)
                <tr>
                    <td>
                        {{$category->name}}
                    </td>
                    <td>
                        @if($category->parent)
                            {{ $category->parent->name }}
                        @endif
                    </td>
                    <td>
                        <a href="{{route('admin.category.edit', ['id' => $category->id]) }}" class=" btn btn-primary">
                            @lang('header.category.col_edit')
                        </a>
                    </td>
                    <td>
                        {!! Form::open(['id' => 'delete', 'route' => ['admin.category.destroy', $category->id], 'method' => 'delete'])  !!}
                            {!! Form::submit(@trans('header.delete'), ['data-id' => $category->id, 'class' => 'btn btn-xs btn-danger'])  !!}
                        {!! Form::close()  !!}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">@lang('header.category.no_category')</td>
            </tr>
        @endif
        </tbody>
    </table>
    {{ $categories->links() }}
@endsection
