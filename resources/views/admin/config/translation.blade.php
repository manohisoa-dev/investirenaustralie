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
                                                    @foreach ($langFiles as $langFile)
                                                        <option value="{{ strtoupper($langFile) }}">{{ strtoupper($langFile) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-primary btn-sm" id="btn_add" data-toggle="modal" data-target="#addTranslationModal"><i class="fa fa-plus"></i> @lang('app.btn.add')</button>
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
                                        <th></th>
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

    <!-- Edit Translation Modal -->
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
                        <label for="new_content">@lang('app.txt.new_value') *</label>
                        <textarea class="form-control" name="new_content" id="new_content" cols="60" rows="10"></textarea>
                        <span class="text-danger m-25px-t" id="error_0"></span>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" id="btn_cancel" class="btn btn-secondary" data-dismiss="modal">@lang('app.btn.cancel')</button>
                <button type="button" id="btn_save" class="btn btn-primary">@lang('app.btn.save')</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Translation Modal -->
    <div id="addTranslationModal" data-backdrop="static" data-keyboard="false" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <!-- Vertically centered modal -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">@lang('app.txt.add')</h5>
                </div>
                <div class="modal-body">
                    <form action="#" id="addLangForm" class="form-validation">
                        {{ csrf_field() }}
                        <div class="row col-lg-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-lg-12" for="new_file">@lang('app.txt.file')</label>
                                    <select class="form-control" name="new_file" id="new_file">
                                        @foreach ($langFiles as $langFile)
                                            <option value="{{ strtoupper($langFile) }}">{{ strtoupper($langFile) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-lg-12" for="new_key">@lang('app.txt.key') *</label>
                                    <input class="form-control col-lg-12" type="text" name="new_key" id="new_key">
                                </div>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label class="col-lg-12" for="new_content_fr">@lang('app.txt.content_fr') *</label>
                            <textarea class="form-control col-lg-12" name="new_content_fr" id="new_content_fr" cols="60" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-12" for="new_content_en">@lang('app.txt.content_en') *</label>
                            <textarea class="form-control col-lg-12" name="new_content_en" id="new_content_en" cols="60" rows="5"></textarea>
                        </div>
                    </form>
                    <span class="text-danger m-25px-t" id="error"></span>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('app.btn.cancel')</button>
                <button type="button" id="btn_new_save" class="btn btn-primary">@lang('app.btn.save')</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom-script')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var newContent="";
            var rowIndex="";

            var tablelang = $('#tablelang').DataTable( {
                order: [[ 0, "desc" ]],
                ajax: {
                    url: '{{ route("admin.config.get.translation") }}',
                    dataSrc: 'data'
                },
                columns: [
                    {data: 'id', name: 'id', visible:false},
                    {data: 'groupe', name: 'groupe', render:function(){
                        return $('#select_file_name').val();
                    }},
                    {data: 'key', name: 'key'},
                    {data: 'content', name: 'content'},
                    {data: 'content', name: 'content'},
                    {data: 'action', name: 'action', render:function(){
                        var actionBtn = '<span class="btn_edit">'+
                            '<a href="javascript:void(0)" title="{{ trans('app.btn.edit') }}" class="btn btn-default btn-circle btn-edit">'+
                                '<i class="fa fa-pencil-square-o"></i>'+
                            '</a>'+
                        '</span>';
                        return actionBtn;
                    }},
                ],
            } );
        
            $('#tablelang').on('click','tr .btn-edit',function(){
                // var rowData = tablelang.rows( { selected: true } ).data()[rowIndex];
                var tr = $(this).closest("tr");
                var rowData = tablelang.row( tr ).data();
                    rowIndex = rowData.id;
                var oldContent =tablelang.cell(rowIndex,4).data();
                var key = tablelang.cell(rowIndex,2).data();
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
                var newContent = $('#new_content').val();

                if(newContent!==''){
                    // disable button
                    $(this).prop("disabled", true);
                    // add spinner to button
                    $(this).html(
                        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                    );
                    
                    var datas = {
                        "_token": "{{ csrf_token() }}",
                        'lang' : $('#lang').val(),
                        'file' : $('#file').val(),
                        'key' : $('#key').val(),
                        'new_content' : $('#new_content').val(),
                    };
                    
                    // new value to set on datatable
                    // newContent= $('#new_content').val();

                    $.ajax({
                        url: '{{ route("admin.config.save.translation") }}',
                        method: 'POST',
                        data: datas,
                        dataType: 'json',
                        success: function(data){
                            // // Close edit content lang modal
                            // $('#editLangModal').modal('hide');

                            // // Reset value on input
                            // $('#lang').val('');
                            // $('#file').val('');
                            // $('#key').val('');
                            // $('#new_content').text('');

                            // Refresh page after update
                            setTimeout(function(){
                                location.reload();
                                
                                // Close edit content lang modal
                                $('#editLangModal').modal('hide');

                            }, 5000);
                        }
                    });
                }else{
                    $('#error_0').html('(*): {{ trans("app.txt.champobligatoire") }}');
                    $('#error_0').delay(10000).fadeOut();
                }

                // return tablelang.cell( rowIndex, 4 ).data(newContent).draw();
            });

            // $('#addLangForm').validate({
            //     ignore: [],
            //     rules: {
            //         'new_key': {
            //             required: true
            //         },
            //         'new_content_fr': {
            //             required: true
            //         },
            //         'new_content_en': {
            //             required: true
            //         },
            //     },
            //     messages: {
            //         'new_key': {
            //             required: "Champ obligatoire"
            //         },
            //         'new_content_fr': {
            //             required: "Champ obligatoire"
            //         },
            //         'new_content_en': {
            //             required: "Champ obligatoire",
            //         },
            //     },
            //     errorPlacement: function ( error, element ) {
            //         if(element.parent().hasClass('input-group')){
            //             error.insertBefore( element.parent() );
            //         }else{
            //             error.insertAfter( element );
            //         }
            //     },
            // });
            

            $('#btn_new_save').click(function(){
                var newKey = $('#new_key').val();
                var newContentFr = $('#new_content_fr').val();
                var newContentAn = $('#new_content_en').val();

                if(newKey!=='' && newContentFr!=='' && newContentAn!==''){
                    // disable button
                    $(this).prop("disabled", true);
                    // add spinner to button
                    $(this).html(
                        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                    );
                    
                    var datas = {
                        "_token": "{{ csrf_token() }}",
                        'lang' : new Array('fr','en'),
                        'file' : $('#new_file').val(),
                        'key' : $('#new_key').val(),
                        'new_content_fr' : $('#new_content_fr').val(),
                        'new_content_en' : $('#new_content_en').val(),
                    };

                    $.ajax({
                        url: '{{ route("admin.config.save.translation") }}',
                        method: 'POST',
                        data: datas,
                        dataType: 'json',
                        success: function(data){
                            $('#error').html();

                            // Refresh page after update
                            setTimeout(function(){
                                // Close edit content lang modal
                                $('#addTranslationModal').modal('hide');

                                location.reload();
                            }, 5000);
                        },
                    });
                }else{
                    $('#error').html('(*): {{ trans("app.txt.complete_all_fields") }}');
                    $('#error').delay(10000).fadeOut();
                }
            });


            $('#btn_refresh').click(function(){
                return tablelang.ajax.reload();
            });

            $('#searchForm').on('change','#select_lang',function(){
                var lang = $('#select_lang').val();
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
                    order: [[ 0, "desc" ]],
                    ajax: {
                        url: '{{ route("admin.config.get.translation") }}',
                        method: "GET",
                        data : {'select_file_name':file, 'select_lang':lang},
                    },
                    columns: [
                        {data: 'id', name: 'id', visible:false},
                        {data: 'groupe', name: 'groupe', render:function(){
                            return $('#select_file_name').val();
                        }},
                        {data: 'key', name: 'key'},
                        {data: 'content', name: 'content'},
                        {data: 'content', name: 'content'},
                        {data: 'action', name: 'action', render:function(){
                            var actionBtn = '<span class="btn_edit">'+
                                '<a href="javascript:void(0)" title="{{ trans('app.btn.edit') }}" class="btn btn-default btn-circle btn-edit">'+
                                    '<i class="fa fa-pencil-square-o"></i>'+
                                '</a>'+
                            '</span>';
                            return actionBtn;
                        }},
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
                    order: [[ 0, "desc" ]],
                    ajax: {
                        url: '{{ route("admin.config.get.translation") }}',
                        method: "GET",
                        data : {'select_file_name':file, 'select_lang':lang},
                    },
                    columns: [
                        {data: 'id', name: 'id', visible:false},
                        {data: 'groupe', name: 'groupe', render:function(){
                            return $('#select_file_name').val();
                        }},
                        {data: 'key', name: 'key'},
                        {data: 'content', name: 'content'},
                        {data: 'content', name: 'content'},
                        {data: 'action', name: 'action', render:function(){
                            var actionBtn = '<span class="btn_edit">'+
                                '<a href="javascript:void(0)" title="{{ trans('app.btn.edit') }}" class="btn btn-default btn-circle btn-edit">'+
                                    '<i class="fa fa-pencil-square-o"></i>'+
                                '</a>'+
                            '</span>';
                            return actionBtn;
                        }},
                    ],
                });
            });

            function reloadDatatable(){
                var lang = $('#lang').val();
                var file = $('#new_file').val();

                $('#tablelang').dataTable().fnDestroy();
                
                return tablelang = $('#tablelang').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json'
                    },
                    processing: true,
                    serverSide: false,
                    autoWidth: false,
                    pageLength: 10,
                    order: [[ 0, "desc" ]],
                    ajax: {
                        url: '{{ route("admin.config.get.translation") }}',
                        method: "GET",
                        data : {'select_file_name':file, 'select_lang':lang},
                    },
                    columns: [
                        {data: 'id', name: 'id', visible:false},
                        {data: 'groupe', name: 'groupe', render:function(){
                            return $('#select_file_name').val();
                        }},
                        {data: 'key', name: 'key'},
                        {data: 'content', name: 'content'},
                        {data: 'content', name: 'content'},
                        {data: 'action', name: 'action', render:function(){
                            var actionBtn = '<span class="btn_edit">'+
                                '<a href="javascript:void(0)" title="{{ trans('app.btn.edit') }}" class="btn btn-default btn-circle btn-edit">'+
                                    '<i class="fa fa-pencil-square-o"></i>'+
                                '</a>'+
                            '</span>';
                            return actionBtn;
                        }},
                    ],
                });
            }
        
        });

    </script>
@endsection