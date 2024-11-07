@extends('layouts.app')

@section('content')
    <h3 class="page-title">Trait</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.traits.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app.create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('trait', 'Trait*', ['class' => 'control-label']) !!}
                    {!! Form::text('trait', old('trait'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('trait'))
                        <p class="help-block">
                            {{ $errors->first('trait') }}
                        </p>
                    @endif
                </div>
                
                <div class="col-xs-6 form-group">
                    {!! Form::label('key', 'Key*', ['class' => 'control-label']) !!}
                    {!! Form::text('key', old('key'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('key'))
                        <p class="help-block">
                            {{ $errors->first('key') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('number', 'Number*', ['class' => 'control-label']) !!}
                    {!! Form::number('number', old('number'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('number'))
                        <p class="help-block">
                            {{ $errors->first('number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::submit(trans('global.app.save'), ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            
            
            
        </div>
    </div>

   
@stop

