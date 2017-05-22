@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.pasts.title')</h3>
    @can('past_create')
    <p>
        <a href="{{ route('pasts.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped ajaxTable @can('past_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('past_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.pasts.fields.action')</th>
                        <th>@lang('quickadmin.pasts.fields.door')</th>
                        <th>@lang('quickadmin.pasts.fields.intruder')</th>
                        <th>@lang('quickadmin.pasts.fields.user')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('past_delete')
            window.route_mass_crud_entries_destroy = '{{ route('pasts.mass_destroy') }}';
        @endcan
$(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('pasts.index') !!}';
            window.dtDefaultOptions.columns = [
                @can('past_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan
                {data: 'action', name: 'action'},
                {data: 'door.door_key', name: 'door.door_key'},
                {data: 'intruder', name: 'intruder'},
                {data: 'name', name: 'name'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection