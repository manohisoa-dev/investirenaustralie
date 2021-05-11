@extends('admin.layouts.app')

@section('title', 'Configuration site')

@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>@lang('app.translation')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('V2/admin')}}">@lang('app.home')</a>
                </li>
                <li class="breadcrumb-item">
                    <a>@lang('app.config')</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>@lang('app.translation')</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>@lang('app.translation') <small>@lang('app.txt.lang_update')</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="search-form" id="searchForm">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-default btn-sm " id="btn_refresh"><i class="fa fa-refresh"></i> @lang('app.btn.refresh')</button>
                                            </div> 
                                            <div class="col-lg-3">
                                                <select class="form-control" name="select_lang" id="select_lang">
                                                    <option {{ app()->getLocale()=='fr' ? 'selected' : '' }}>FR</option>
                                                    <option {{ app()->getLocale()=='en' ? 'selected' : '' }}>EN</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <select class="form-control" name="select_file_name" id="select_file_name">
                                                    {{-- <option value="" selected disabled>@lang('app.txt.choose_select_file_name')</option> --}}
                                                    @foreach ($langFiles as $langFile)
                                                        <option value="{{ strtoupper($langFile) }}">{{ strtoupper($langFile) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-primary btn-sm" id="btn_add"><i class="fa fa-plus"></i> @lang('app.btn.add')</button>
                                                {{-- <button type="button" class="btn btn-default btn-sm " id="btn_refresh"><i class="fa fa-refresh"></i> @lang('app.btn.refresh')</button> --}}
                                            </div> 
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="ibox-content">
                            <table class="table table-striped grid-view-tbl datatable yajra-datatable" id="tablelang">
                                <thead>
                                    <tr class="header-row">
                                        <th>{{ strtoupper(trans('app.txt.group_single')) }}</th>
                                        <th>{{ strtoupper(trans('app.txt.key')) }}</th>
                                        <th>{{ strtoupper(trans('app.txt.old_value')) }}</th>
                                        <th>{{ strtoupper(trans('app.txt.new_value')) }}</th>
                                        <th>{{ strtoupper(trans('app.txt.action')) }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="editLangModal" data-backdrop="static" data-keyboard="false" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <!-- Vertically centered modal -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">@lang('app.txt.edit')</h5>
                </div>
                <div class="modal-body">
                    <form action="" id="editLangForm">
                        {{ csrf_field() }}
                        <input type="hidden" name="lang" id="lang">
                        <input type="hidden" name="file" id="file">
                        <input type="hidden" name="key" id="key">
                        <textarea class="form-control" name="new_content" id="new_content" cols="60" rows="10"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" id="btn_cancel" class="btn btn-secondary" data-dismiss="modal">@lang('app.btn.cancel')</button>
                <button type="button" id="btn_save" class="btn btn-primary">@lang('app.btn.save')</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom-script')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var newContent="";
            var rowIndex="";

            var tablelang = $('#tablelang').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json'
                },
                processing: true,
                serverSide: false,
                autoWidth: false,
                pageLength: 10,
                ajax: '{{ route("admin.config.get.translation") }}',
                columns: [
                    {data: 'groupe', name: 'groupe', render:function(){
                        return $('#select_file_name').val();
                    }},
                    {data: 'key', name: 'key'},
                    {data: 'content', name: 'content'},
                    {data: 'content', name: 'content'},
                    {data: 'action', name: 'action'},
                ],
            });
        
            $('#tablelang').on('click','tr .btn-edit',function(){
                    var tr = $(this).closest("tr");
                        rowIndex = tr.index();
                    var rowData = tablelang.rows( { selected: true } ).data()[rowIndex];
                    var oldContent =tablelang.cell(rowIndex,3).data();
                    var key = tablelang.cell(rowIndex,1).data();
                    var file = $('#select_file_name').val();
                    var lang = $('#select_lang').val();

                    // Show edit content lang modal
                    $('#editLangModal').modal('show');

                    // Set value on input edit
                    $('#lang').val(lang);
                    $('#file').val(file);
                    $('#key').val(key);
                    $('#new_content').val(oldContent);

            });

            $('#btn_cancel').click(function(){
                // Set value on input edit
                $('#lang').val('');
                $('#file').val('');
                $('#key').val('');
               $('#new_content').val('');
            });

            $('#btn_save').click(function(){
                
                var datas = {
                    "_token": "{{ csrf_token() }}",
                    'lang' : $('#lang').val(),
                    'file' : $('#file').val(),
                    'key' : $('#key').val(),
                    'new_content' : $('#new_content').val(),
                };
                
                // Set value on input edit
                newContent= $('#new_content').val();

                $.ajax({
                    url: '{{ route("admin.config.save.translation") }}',
                    method: 'POST',
                    data: datas,
                    dataType: 'json',
                    success: function(data){
                        // Close edit content lang modal
                        $('#editLangModal').modal('hide');

                        // Reset value on input
                        $('#lang').val('');
                        $('#file').val('');
                        $('#key').val('');
                        $('#new_content').text('');
                    }
                });

                return tablelang.cell( rowIndex, 3 ).data(newContent).draw();
            });


            $('#btn_refresh').click(function(){
                return tablelang.ajax.reload();
            });

            $('#searchForm').on('change','#select_lang',function(){
                var lang = $(this).val();
                var file = $('#select_file_name').val();

                $('#tablelang').dataTable().fnDestroy();
                
                tablelang = $('#tablelang').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json'
                    },
                    processing: true,
                    serverSide: false,
                    autoWidth: false,
                    pageLength: 10,
                    ajax: {
                        url: '{{ route("admin.config.get.translation") }}',
                        method: "GET",
                        data : {'select_file_name':file, 'select_lang':lang},
                    },
                    columns: [
                        {data: 'groupe', name: 'groupe', render:function(){
                            return $('#select_file_name').val();
                        }},
                        {data: 'key', name: 'key'},
                        {data: 'content', name: 'content'},
                        {data: 'content', name: 'content'},
                        {data: 'action', name: 'action'},
                    ],
                });
            });

            $('#searchForm').on('change','#select_file_name',function(){
                var lang = $('#select_lang').val();
                var file = $(this).val();

                $('#tablelang').dataTable().fnDestroy();
                
                tablelang = $('#tablelang').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json'
                    },
                    processing: true,
                    serverSide: false,
                    autoWidth: false,
                    pageLength: 10,
                    ajax: {
                        url: '{{ route("admin.config.get.translation") }}',
                        method: "GET",
                        data : {'select_file_name':file, 'select_lang':lang},
                    },
                    columns: [
                        {data: 'groupe', name: 'groupe', render:function(){
                            return $('#select_file_name').val();
                        }},
                        {data: 'key', name: 'key'},
                        {data: 'content', name: 'content'},
                        {data: 'content', name: 'content'},
                        {data: 'action', name: 'action'},
                    ],
                });
            });
        
        });
    </script>
@endsection