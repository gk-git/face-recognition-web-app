@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.stautus.title')</h3>
    @can('stautus_create')
    <p>
        <a href="{{ route('stautuses.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped ajaxTable @can('stautus_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('stautus_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.stautus.fields.status')</th>
                        <th>@lang('quickadmin.stautus.fields.action-open')</th>
                        <th>@lang('quickadmin.stautus.fields.action-black')</th>
                        <th>@lang('quickadmin.stautus.fields.action-wait')</th>
                        <th>@lang('quickadmin.stautus.fields.action-else')</th>
                        <th>@lang('quickadmin.stautus.fields.door')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('stautus_delete')
            window.route_mass_crud_entries_destroy = '{{ route('stautuses.mass_destroy') }}';
        @endcan
$(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('stautuses.index') !!}';
            window.dtDefaultOptions.columns = [
                @can('stautus_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan
                {data: 'status', name: 'status'},
                {data: 'action_open', name: 'action_open'},
                {data: 'action_black', name: 'action_black'},
                {data: 'action_wait', name: 'action_wait'},
                {data: 'action_else', name: 'action_else'},
                {data: 'door.door_key', name: 'door.door_key'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection