@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Php based translation</h1>
                    <h2>{{ __('messages.welcome') }}</h2>
                    <h2>@lang('messages.welcome') </h2>
                    <h2>{{ __('messages.example_with_value',['name'=>'Rabie']) }}</h2>
                    <h2>@lang('messages.example_with_value',['name'=>'Rabie'])</h2>
                    <p>{{ trans_choice('messages.plural',0) }}</p>
                    <p>{{ trans_choice('messages.plural',1) }}</p>
                    <p>{{ trans_choice('messages.plural',20) }}</p>

                    <h1>Json translation :</h1>

                    <h4> {{ __('welcome') }}</h4>
                    <h4> {{ __('example_with_value') }}</h4>
                    <h4> {{ __('example_with_value') }}</h4>
                    <p>{{ trans_choice('plural',0) }}</p>
                    <p>{{ trans_choice('plural',1) }}</p>
                    <p>{{ trans_choice('plural',20) }}</p>

                </div>
                @can('secret.page')
                     <p><a href="/secret">Administration</a></p>
                @endcan
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
