@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.doors.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.doors.fields.door-key')</th>
                            <td>{{ $door->door_key }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.doors.fields.location')</th>
                            <td>{{ $door->location }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#pasts" aria-controls="pasts" role="tab" data-toggle="tab">Pasts</a></li>
<li role="presentation" class=""><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a></li>
<li role="presentation" class=""><a href="#stautus" aria-controls="stautus" role="tab" data-toggle="tab">Stautus</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="pasts">
<table class="table table-bordered table-striped {{ count($pasts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.pasts.fields.action')</th>
                        <th>@lang('quickadmin.pasts.fields.door')</th>
                        <th>@lang('quickadmin.pasts.fields.intruder')</th>
                        <th>@lang('quickadmin.pasts.fields.user')</th>
                        <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @if (count($pasts) > 0)
            @foreach ($pasts as $past)
                <tr data-entry-id="{{ $past->id }}">
                    <td>{{ $past->action }}</td>
                                <td>{{ $past->door->door_key or '' }}</td>
                                <td>{{ Form::checkbox("intruder", 1, $past->intruder == 1, ["disabled"]) }}</td>
                                <td>{{ $past->user->email or '' }}</td>
                                <td>
                                    @can('past_view')
                                    <a href="{{ route('pasts.show',[$past->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('past_edit')
                                    <a href="{{ route('pasts.edit',[$past->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('past_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['pasts.destroy', $past->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="users">
<table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.users.fields.name')</th>
                        <th>@lang('quickadmin.users.fields.email')</th>
                        <th>@lang('quickadmin.users.fields.role')</th>
                        <th>@lang('quickadmin.users.fields.door-key')</th>
                        <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @if (count($users) > 0)
            @foreach ($users as $user)
                <tr data-entry-id="{{ $user->id }}">
                    <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->title or '' }}</td>
                                <td>{{ $user->door_key->door_key or '' }}</td>
                                <td>
                                    @can('user_view')
                                    <a href="{{ route('users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('user_edit')
                                    <a href="{{ route('users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('user_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['users.destroy', $user->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="stautus">
<table class="table table-bordered table-striped {{ count($stautuses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.stautus.fields.status')</th>
                        <th>@lang('quickadmin.stautus.fields.action-open')</th>
                        <th>@lang('quickadmin.stautus.fields.action-black')</th>
                        <th>@lang('quickadmin.stautus.fields.action-wait')</th>
                        <th>@lang('quickadmin.stautus.fields.action-else')</th>
                        <th>@lang('quickadmin.stautus.fields.door')</th>
                        <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @if (count($stautuses) > 0)
            @foreach ($stautuses as $stautus)
                <tr data-entry-id="{{ $stautus->id }}">
                    <td>{{ Form::checkbox("status", 1, $stautus->status == 1, ["disabled"]) }}</td>
                                <td>{{ Form::checkbox("action_open", 1, $stautus->action_open == 1, ["disabled"]) }}</td>
                                <td>{{ Form::checkbox("action_black", 1, $stautus->action_black == 1, ["disabled"]) }}</td>
                                <td>{{ Form::checkbox("action_wait", 1, $stautus->action_wait == 1, ["disabled"]) }}</td>
                                <td>{{ Form::checkbox("action_else", 1, $stautus->action_else == 1, ["disabled"]) }}</td>
                                <td>{{ $stautus->door->door_key or '' }}</td>
                                <td>
                                    @can('stautus_view')
                                    <a href="{{ route('stautuses.show',[$stautus->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('stautus_edit')
                                    <a href="{{ route('stautuses.edit',[$stautus->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('stautus_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['stautuses.destroy', $stautus->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('doors.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop