@extends('layouts.app')

@section('content')
    <h3 class="page-title">Question</h3>
    {!! Form::model($question, ['method' => 'PUT', 'route' => ['admin.questions.update', $question->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app.edit')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('question', 'Question*', ['class' => 'control-label']) !!}
                    {!! Form::text('question', old('question'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('question'))
                        <p class="help-block">
                            {{ $errors->first('question') }}
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
                <div class="col-xs-6 form-group">
                    {!! Form::label('group', 'Group*', ['class' => 'control-label']) !!}
                    {!! Form::number('group', old('group'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('group'))
                        <p class="help-block">
                            {{ $errors->first('group') }}
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

