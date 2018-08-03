@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!Auth::user())
                        abort(403);
                    @elseif(Auth::user()->hasRole('admin'))
                        <div>Wellcome administrador</div>
                            You are logged in!
                    @else
                        abort(403);
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
