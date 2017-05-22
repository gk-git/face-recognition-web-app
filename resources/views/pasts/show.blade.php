@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.pasts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.pasts.fields.action')</th>
                            <td>{{ $past->action }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pasts.fields.door')</th>
                            <td>{{ $past->door->door_key or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pasts.fields.intruder')</th>
                            <td>{{ Form::checkbox("intruder", 1, $past->intruder == 1, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pasts.fields.user')</th>
                            <td>{{ $past->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('pasts.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop