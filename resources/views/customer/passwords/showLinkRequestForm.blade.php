@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset password</div>
                <div class="panel-body">

                  @if(session('success'))
                      <!-- If reset password email sent successfully -->
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @elseif (count($errors) > 0)
                      <div class="alert alert-danger">                                                        
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  <form class="form-horizontal"
                        role="form"
                        method="POST"
                        action="{{ route('customers.password.sendRestLinkEmail') }}">
                      <input type="hidden"
                              name="_token"
                              value="{{ csrf_token() }}">

                      <div class="form-group">
                          <label class="col-md-4 control-label">Email</label>

                          <div class="col-md-6">
                              <input type="email"
                                      class="form-control"
                                      name="email"
                                      value="{{ old('email') }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit"
                                      class="btn btn-primary"
                                      style="margin-right: 15px;">
                                  Reset password
                              </button>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>

    <style>
      .alert-danger ul {
        list-style: none;
        padding-left: 0;
      }
    </style>
@endsection

