@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (\Session::has('success'))
                <div class="alert alert-primary p-2 mt-4">
                    <ul class="mb-0">
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            @if (\Session::has('error'))
                <div class="alert alert-danger p-2 mt-4">
                    <ul class="mb-0">
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('updateProfile') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Password') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('changePassword') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="confirm_password" type="password" class="form-control" name="confirm_password" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Account Status') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('statusUpdate') }}">
                        @csrf
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                @if(Auth::user()->status == 'Active')
                                    <input type="hidden" name="status" value="Inactive">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Deactivate Account') }}
                                    </button>
                                @else
                                    <input type="hidden" name="status" value="Active">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Activate Account') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
