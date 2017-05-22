@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.doors.title')</h3>
    @can('door_create')
    <p>
        <a href="{{ route('doors.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped ajaxTable @can('door_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('door_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.doors.fields.door-key')</th>
                        <th>@lang('quickadmin.doors.fields.location')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('door_delete')
            window.route_mass_crud_entries_destroy = '{{ route('doors.mass_destroy') }}';
        @endcan
$(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('doors.index') !!}';
            window.dtDefaultOptions.columns = [
                @can('door_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan
                {data: 'door_key', name: 'door_key'},
                {data: 'location', name: 'location'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection