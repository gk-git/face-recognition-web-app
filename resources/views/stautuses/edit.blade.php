@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.stautus.title')</h3>
    
    {!! Form::model($stautus, ['method' => 'PUT', 'route' => ['stautuses.update', $stautus->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('status', 'Status*', ['class' => 'control-label']) !!}
                    {!! Form::hidden('status', 0) !!}
                    {!! Form::checkbox('status', 1, old('status')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('action_open', 'Action open', ['class' => 'control-label']) !!}
                    {!! Form::hidden('action_open', 0) !!}
                    {!! Form::checkbox('action_open', 1, old('action_open')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('action_open'))
                        <p class="help-block">
                            {{ $errors->first('action_open') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('action_black', 'Action black', ['class' => 'control-label']) !!}
                    {!! Form::hidden('action_black', 0) !!}
                    {!! Form::checkbox('action_black', 1, old('action_black')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('action_black'))
                        <p class="help-block">
                            {{ $errors->first('action_black') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('action_wait', 'Action wait', ['class' => 'control-label']) !!}
                    {!! Form::hidden('action_wait', 0) !!}
                    {!! Form::checkbox('action_wait', 1, old('action_wait')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('action_wait'))
                        <p class="help-block">
                            {{ $errors->first('action_wait') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('action_else', 'Action else', ['class' => 'control-label']) !!}
                    {!! Form::hidden('action_else', 0) !!}
                    {!! Form::checkbox('action_else', 1, old('action_else')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('action_else'))
                        <p class="help-block">
                            {{ $errors->first('action_else') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('door_id', 'Door', ['class' => 'control-label']) !!}
                    {!! Form::select('door_id', $doors, old('door_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('door_id'))
                        <p class="help-block">
                            {{ $errors->first('door_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

