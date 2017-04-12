@extends('admin.master')

@section('content')
    <div class="col-md-6">
        <h1>{{ $thread->subject }}</h1>
        @each('admin.partials.messages', $thread->messages, 'message')

        @include('admin.partials.form-message')
    </div>
@stop