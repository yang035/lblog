@extends('admin.layout')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a href="/admin/tag/create" class="btn btn-success btn-md">
                            <i class="fa fa-plus-circle"></i> New Tag
                        </a>
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">

                            <table id="tags-table"
                                   class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>Tag</th>
                                    <th>Title</th>
                                    <th class="hidden-sm">Subtitle</th>
                                    <th class="hidden-md">Page Image</th>
                                    <th class="hidden-md">Meta Description</th>
                                    <th class="hidden-md">Layout</th>
                                    <th class="hidden-sm">Direction</th>
                                    <th data-sortable="false">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->tag }}</td>
                                        <td>{{ $tag->title }}</td>
                                        <td class="hidden-sm">{{ $tag->subtitle }}</td>
                                        <td class="hidden-md">{{ $tag->page_image }}</td>
                                        <td class="hidden-md">{{ $tag->meta_description }}</td>
                                        <td class="hidden-md">{{ $tag->layout }}</td>
                                        <td class="hidden-sm">
                                            @if ($tag->reverse_direction)
                                                Reverse
                                            @else
                                                Normal
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/admin/tag/{{ $tag->id }}/edit" class="btn btn-xs btn-info">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Tag</th>
                                    <th>Title</th>
                                    <th class="hidden-sm">Subtitle</th>
                                    <th class="hidden-md">Page Image</th>
                                    <th class="hidden-md">Meta Description</th>
                                    <th class="hidden-md">Layout</th>
                                    <th class="hidden-sm">Direction</th>
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
            $("#tags-table").DataTable({
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