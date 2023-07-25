<<<<<<< HEAD
=======
@extends('layouts.app')
>>>>>>> Costumers/User
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
<<<<<<< HEAD
                <customer-form></customer-form>aaaaaaa
=======
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        {{ __('You are logged in!') }}
                    </div>
                </div>
>>>>>>> Costumers/User
            </div>
        </div>
    </div>
@endsection
