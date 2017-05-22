@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.pasts.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['pasts.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('action', 'Action*', ['class' => 'control-label']) !!}
                    {!! Form::text('action', old('action'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('action'))
                        <p class="help-block">
                            {{ $errors->first('action') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('door_id', 'Door*', ['class' => 'control-label']) !!}
                    {!! Form::select('door_id', $doors, old('door_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('door_id'))
                        <p class="help-block">
                            {{ $errors->first('door_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('intruder', 'Intruder', ['class' => 'control-label']) !!}
                    {!! Form::hidden('intruder', 0) !!}
                    {!! Form::checkbox('intruder', 1, true) !!}
                    <p class="help-block"></p>
                    @if($errors->has('intruder'))
                        <p class="help-block">
                            {{ $errors->first('intruder') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', 'User', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

