@extends('frontend.layouts.default')
@section('page_heading', trans('front.pages.test.title'))
@section('content')
    <div class="col-xl-10">
        @if (!empty($errors->first()))
            <div class="alert alert-warning" role="alert">
                <i class="fa fa-warning"></i> {{ $errors->first() }}
            </div>
        @endif

        @if ($page_num == $total_pages)
            {!! Form::open(['method' => 'POST', 'route' => ['test.save']]) !!}
        @else
            {!! Form::open(['method' => 'POST', 'route' => ['test']]) !!}
        @endif

        <table class="table table-striped table-hover">
            <thead class="thead-light">
            <tr>
                <th></th>
                <th class="lead">&nbsp;Y</th>
                <th class="lead">&nbsp;+</th>
                <th class="lead">&nbsp;M</th>
                <th class="lead">&nbsp;-</th>
                <th class="lead">&nbsp;N</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach ($questions as $q)
                <tr>
                    @php
                        $qid = "q[$q->id]";
                    @endphp
                    <td>{{ $q->number }}</td>
                    <td>
                        <label class="kt-radio kt-radio--bold">
                            {!! Form::radio($qid, 'Y', false, ['class' => 'control-label', 'required' => 'required']) !!}
                            <span></span>
                        </label>
                    </td>
                    <td>
                        <label class="kt-radio kt-radio--bold">
                            {!! Form::radio($qid, '+', false, ['class' => 'control-label', 'required' => 'required']) !!}
                            <span></span>
                        </label>
                    </td>
                    <td>
                        <label class="kt-radio kt-radio--bold">
                            {!! Form::radio($qid, 'M', false, ['class' => 'control-label', 'required' => 'required']) !!}
                            <span></span>
                        </label>
                    </td>
                    <td>
                        <label class="kt-radio kt-radio--bold">
                            {!! Form::radio($qid, '-', false, ['class' => 'control-label', 'required' => 'required']) !!}
                            <span></span>
                        </label>
                    </td>
                    <td>
                        <label class="kt-radio kt-radio--bold">
                            {!! Form::radio($qid, 'N', false, ['class' => 'control-label', 'required' => 'required']) !!}
                            <span></span>
                        </label>
                    </td>
                    <td>{{ $q->question }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <br>

        @php
            $progress = round(100 * $page_num / $total_pages);
        @endphp
        <div class="kt-section__content">
            <div class="progress progress-lg">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p><br></p>
        </div>

        <div class="row">
            <p> &nbsp; Page {{ $page_num }} of {{ $total_pages }} &nbsp;
                @if ($page_num == $total_pages)
                    {!! Form::submit(trans('front.test.submit_done'), ['class' => 'btn btn-success btn-lg']) !!}
                @else
                    {!! Form::submit(trans('front.test.submit_next'), ['class' => 'btn btn-primary']) !!}
                @endif
            </p>
        </div>

        {!! Form::close() !!}

        <div class="row">
            <p><br></p>
        </div>
    </div>

    <div class="col-xl-2">
        <div class="row">
            <p><br></p>
        </div>
    </div>
@stop
