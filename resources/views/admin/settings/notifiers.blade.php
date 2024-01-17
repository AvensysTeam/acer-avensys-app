@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="main-card">
            <div class="header">
                @isset($notifier)
                    Edit Notifier
                @else
                    Add Notifier
                @endisset
            </div>
            <form method="POST" action="{{ isset($notifier)?route('admin.notifier.update',$notifier->id): route("admin.notifier.store") }}"  enctype="multipart/form-data">
                @csrf
                @isset($notifier)
                    @method('PUT')
                @endisset
            <div class="body">
                <div class="form-group">
                    <label for="name" class="text-xs">Name</label>
                    <input type="text" id="name" name="name" required class="form-control" value="{{isset($notifier) ? $notifier->name : ''}}">
                </div>
                <div class="form-group">
                    <label for="email" class="text-xs">Email</label>
                    <input type="email" id="email" name="email" required class="form-control" value="{{isset($notifier) ? $notifier->email : ''}}">
                </div>
                <div class="form-group">
                    <label for="phone" class="text-xs">Phone</label>
                    <input type="text" id="phone" name="phone" required class="form-control" value="{{isset($notifier) ? $notifier->phone: ''}}">
                </div>
            </div>
            <div class="footer">
                <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="main-card">
            <div class="header">
                Notifiers
            </div>
            <div class="body">
                <table class="stripe hover bordered datatable datatable-Role">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.role.fields.id') }}
                            </th>
                            <th>
                                {{ trans('Name') }}
                            </th>
                            <th>
                                {{ trans('Email') }}
                            </th>
                            <th>
                                {{ trans('global.phone') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notifiers as $key => $notifier)
                            <tr data-entry-id="{{ $notifier->id }}">
                                <td align="center">
                                    {{ $notifier->id ?? '' }}
                                </td>
                                <td align="center">
                                    {{ $notifier->name ?? '' }}
                                </td>
                                <td align="center">
                                    {{ $notifier->email }}
                                </td>
                                <td align="center">
                                    {{ $notifier->phone }}
                                </td>
                                <td align="center">
                                    @can('role_edit')
                                        <a class="btn-sm btn-blue" href="{{ route('admin.notifier.edit', $notifier->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('role_delete')
                                        <form action="{{ route('admin.notifier.destroy', $notifier->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn-sm btn-red" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
@section('scripts')
    @parent
    <script>
        function saveSeller() {
            $.ajax({
                type: 'POST',
                url: '{{route('admin.settings.save.seller')}}',
                data: $('#seller_form').serialize(),
                headers: {'x-csrf-token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
                success: function(data) {
                    alert("Success in save seller data!");
                },
                error: function(xhr, status, error) {
                    alert("Failed connect to server");
                }
            })
        }

        function saveVersion() {
            $.ajax({
                type: 'POST',
                url: '{{route('admin.settings.save.version')}}',
                data: {version: $('#version').val().trim()},
                headers: {'x-csrf-token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
                success: function(data) {
                    alert("Success in save software version!");
                },
                error: function(xhr, status, error) {
                    alert("Failed connect to server");
                }
            })
        }
    </script>
@endsection
