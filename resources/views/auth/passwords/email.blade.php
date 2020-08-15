@extends('auth.layout.master.index')

@section('content')

    <div class="container">
        <div class="text-center">
            <h1 class="text-center mt-4">{{ __('messages.reset_password') }}</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="container">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email"
                               class="col-md-4 col-form-label ">{{ __('messages.EmailAddress') }}</label>

                        <div class="col-md-3 m-auto">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-3 m-auto">
                            <button type="submit" class="btn btn-primary">
                                {{ __('messages.resetEmailButton') }}
                            </button>
                        </div>
                    </div>
                </form>
                </div>
        </div>
    </div>
@endsection
