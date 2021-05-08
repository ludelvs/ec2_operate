@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="mb-3">
                        @if(!empty($state)) state: {{ $state }} @endif
                    </div>
                    <form action="/start_ec2" method="post">
                        @csrf
                        <div class="row justify-content-center">
                            <button type="submit"  class="btn-lg btn btn-primary btn-block">EC2起動</button>
                        </div>
                        @if(!empty($action) && $action == 'start') status code: {{ $statusCode }} @endif
                    </form>
                    <form action="/stop_ec2" method="post">
                        @csrf
                        <div class="row justify-content-center mt-3">
                            <button type="submit"  class="btn-lg btn btn-primary btn-block">EC2停止</button>
                        </div>
                        @if(!empty($action) && $action == 'stop') status code: {{ $statusCode }} @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
