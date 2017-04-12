@extends('admin.master')

@section('content')
    @include('admin.partials.flash')

    @each('admin.partials.thread', $threads, 'thread', 'admin.partials.no-threads')
@stop