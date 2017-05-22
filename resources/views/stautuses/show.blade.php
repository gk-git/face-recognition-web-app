@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.stautus.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.stautus.fields.status')</th>
                            <td>{{ Form::checkbox("status", 1, $stautus->status == 1, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.stautus.fields.action-open')</th>
                            <td>{{ Form::checkbox("action_open", 1, $stautus->action_open == 1, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.stautus.fields.action-black')</th>
                            <td>{{ Form::checkbox("action_black", 1, $stautus->action_black == 1, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.stautus.fields.action-wait')</th>
                            <td>{{ Form::checkbox("action_wait", 1, $stautus->action_wait == 1, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.stautus.fields.action-else')</th>
                            <td>{{ Form::checkbox("action_else", 1, $stautus->action_else == 1, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.stautus.fields.door')</th>
                            <td>{{ $stautus->door->door_key or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('stautuses.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop