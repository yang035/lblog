@extends('admin.layout')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a href="/admin/message/create" class="btn btn-success btn-md">
                            <i class="fa fa-plus-circle"></i> New Message
                        </a>
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">

                            <table id="messages-table"
                                   class="table table-striped table-bordered table-hover dataTables-example">

                                <thead>
                                <tr>
                                    <th>Published</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Status</th>
                                    <th data-sortable="false">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($messages as $message)
                                    <tr class="gradeC">
                                        <td data-order="{{ $message->created_at->timestamp }}">
                                            {{ $message->created_at->format('Y-m-d H:i:s') }}
                                        </td>
                                        <td>{{ substr($message->title,0,50) }}</td>
                                        <td>{{ str_limit($message->content,50,'...') }}</td>
                                        <td>@if(1 == $message->status)启用@else 禁用@endif</td>
                                        <td class="center">
                                            <a href="/admin/message/{{ $message->id }}/edit" class="btn btn-xs btn-info">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Published</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Status</th>
                                    <th data-sortable="false">Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function () {
            $('#messages-table').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {
                        extend: 'print',
                        customize: function (win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });
        });
    </script>
@stop