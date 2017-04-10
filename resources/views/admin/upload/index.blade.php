@extends('admin.layout')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="pull-right">
                        <ul class="breadcrumb">
                            当前目录：
                            @foreach ($breadcrumbs as $path => $disp)
                                <li><a href="/admin/upload?folder={{ $path }}">{{ $disp }}</a></li>
                            @endforeach
                            <li class="active">{{ $folderName }}</li>
                        </ul>
                    </div>
                    <div class="ibox-title">
                        <button type="button" class="btn btn-success btn-md" data-toggle="modal"
                                data-target="#modal-folder-create">
                            <i class="fa fa-plus-circle"></i> New Folder
                        </button>
                        <button type="button" class="btn btn-primary btn-md" data-toggle="modal"
                                data-target="#modal-file-upload">
                            <i class="fa fa-upload"></i> Upload
                        </button>
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">

                            <table id="uploads-table"
                                   class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Size</th>
                                    <th data-sortable="false">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                {{-- 子目录 --}}
                                @foreach ($subfolders as $path => $name)
                                    <tr>
                                        <td>
                                            <a href="/admin/upload?folder={{ $path }}">
                                                <i class="fa fa-folder fa-lg fa-fw"></i>
                                                {{ $name }}
                                            </a>
                                        </td>
                                        <td>Folder</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger"
                                                    onclick="delete_folder('{{ $name }}')">
                                                <i class="fa fa-times-circle fa-lg"></i>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                {{-- 所有文件 --}}
                                @foreach ($files as $file)
                                    <tr>
                                        <td>
                                            <a href="{{ $file['webPath'] }}">
                                                @if (is_image($file['mimeType']))
                                                    <i class="fa fa-file-image-o fa-lg fa-fw"></i>
                                                @else
                                                    <i class="fa fa-file-o fa-lg fa-fw"></i>
                                                @endif
                                                {{ $file['name'] }}
                                            </a>
                                        </td>
                                        <td>{{ $file['mimeType'] or 'Unknown' }}</td>
                                        <td>{{ $file['modified']->format('j-M-y g:ia') }}</td>
                                        <td>{{ human_filesize($file['size']) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger"
                                                    onclick="delete_file('{{ $file['name'] }}')">
                                                <i class="fa fa-times-circle fa-lg"></i>
                                                Delete
                                            </button>
                                            @if (is_image($file['mimeType']))
                                                <button type="button" class="btn btn-xs btn-success"
                                                        onclick="preview_image('{{ $file['webPath'] }}')">
                                                    <i class="fa fa-eye fa-lg"></i>
                                                    Preview
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Size</th>
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
    @include('admin.upload._modals')

@stop

@section('scripts')
    <script>

        // 确认文件删除
        function delete_file(name) {
            $("#delete-file-name1").html(name);
            $("#delete-file-name2").val(name);
            $("#modal-file-delete").modal("show");
        }

        // 确认目录删除
        function delete_folder(name) {
            $("#delete-folder-name1").html(name);
            $("#delete-folder-name2").val(name);
            $("#modal-folder-delete").modal("show");
        }

        // 预览图片
        function preview_image(path) {
            $("#preview-image").attr("src", path);
            $("#modal-image-view").modal("show");
        }

        // 初始化数据
        $(function () {
            $("#uploads-table").DataTable({
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