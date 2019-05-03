@extends('layouts.app')
@section('content')
    <div class="card-header">
        @lang('header.users.title_user')
    </div>
    <table class="table table-hover">
        <thead>
            <th>
                @lang('header.users.header_name')
            </th>
            <th>
                @lang('header.users.header_permissions')
            </th>
            <th>
                @lang('header.users.header_detail')
            </th>
            <th>
                @lang('header.delete')
            </th>
        </thead>
        <tbody>
        @if ($users->count() > config('setting.default_value_0'))
            @foreach ($users as $user)
                <tr>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        @if ($user->isAdmin())
                            @lang('header.users.col_admin')
                        @else
                            @lang('header.users.col_member')
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info btn-group-sm " href="{{ route('admin.user.show', ['id' => $user->id ]) }}" >@lang('header.users.header_detail')</a>
                    </td>
                    <td>
                        @if (Auth::id() !== $user->id && !$user->isAdmin())
                            <a class="btn btn-danger btn-group-sm " href="{{ route('admin.user.destroy', ['id' => $user->id ]) }}" >@lang('header.delete')</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">@lang('header.users.no_user')</td>
            </tr>
        @endif
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
