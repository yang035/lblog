@extends('admin.layout')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a href="/admin/post/create" class="btn btn-success btn-md">
                            <i class="fa fa-plus-circle"></i> New Post
                        </a>
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">

                            <table id="posts-table"
                                   class="table table-striped table-bordered table-hover dataTables-example">

                                <thead>
                                <tr>
                                    <th>Published</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th data-sortable="false">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($posts as $post)
                                    <tr class="gradeC">
                                        <td data-order="{{ $post->published_at->timestamp }}">
                                            {{ $post->published_at->format('j-M-y g:ia') }}
                                        </td>
                                        <td>{{ substr($post->title,0,50) }}</td>
                                        <td>{{ str_limit($post->subtitle,50,'...') }}</td>
                                        <td class="center">
                                            <a href="/admin/post/{{ $post->id }}/edit" class="btn btn-xs btn-info">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a href="/blog/{{ $post->slug }}" class="btn btn-xs btn-warning">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Published</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
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
            $('#posts-table').DataTable({
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