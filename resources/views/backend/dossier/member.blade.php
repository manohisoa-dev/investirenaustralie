@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" href="{{ asset('style/timeline.css') }}">    
@endsection

@section('subcontent')

	@if($aplActive->apl_id != 0)
    <div class="profile-content-area m-40px-tb">
		<div class="card m-40px-b">
			{{-- <div class="card-header">
				<div class="row">
					<div class="col-5 col-lg-8">
						<span class="h6 font-w-500">@lang('app.txt.file')</span>
					</div>
				</div>
			</div> --}}
			<div class="card-body">
				<div class="ibox-content" id="ibox-content">
                    <div id="vertical-timeline" class="vertical-container dark-timeline center-orientation">
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon grenate-bg">
                                <i class="fa fa-file"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <h2>@lang('app.txt.dossier.transaction')</h2>
                                <p>@lang('app.txt.dossier.transaction.description')</p>
                                @if (Auth::user()->hasCurrentTransaction())
                                    <div class="row col-lg-12">
                                        <a href="javascript:void(0)" class="m-btn m-btn-sm m-btn-theme2nd col-lg-6" onclick="showDossierTransaction({{ Auth::user()->dossierTransaction()->first() }},{{ App\Models\Product::whereId(Auth::user()->dossierTransaction()->first()->product_id)->with('location')->first() }} )">@lang('app.btn.more_info')</a>
                                        <span class="col-lg-6 text-right"><small><b>@lang('app.status') : </b> <i class="badge badge-pill badge-success white-color">@lang('app.txt.created')</i></small></span>
                                    </div>
                                    <span class="vertical-date">
                                        {{Auth::user()->dossierTransaction()->first()->created_at->diffForHumans()}} <br/>
                                        <small>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->dossierTransaction()->first()->created_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->dossierTransaction()->first()->created_at)->year }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon grenate-bg">
                                <i class="fa fa-building"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <h2>@lang('app.select_afa')</h2>
                                <p>@lang('app.txt.dossier.select_afa.description')</p>
                                @if (Auth::user()->hasAfa())
                                    <div class="row col-lg-12">
                                        <a href="javascript:void(0)" class="m-btn m-btn-sm m-btn-theme2nd col-lg-6" onclick="showAfa({{ Auth::user()->afa }})">@lang('app.btn.more_info')</a>
                                        <span class="col-lg-6 text-right"><small><b>@lang('app.status') : </b> <i class="badge badge-pill badge-success white-color">@lang('app.txt.selected')</i></small></span>
                                    </div>
                                    @php
                                        $ca = Auth::user()->conjunctionAgreement(Auth::user()->id,Auth::user()->afa->id);
                                    @endphp

                                    @if ($ca!=="")
                                        <span class="vertical-date">        
                                            {{Auth::user()->conjunctionAgreement(Auth::user()->id,Auth::user()->afa->id)->created_at->diffForHumans()}} <br/>
                                            <small>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->conjunctionAgreement(Auth::user()->id,Auth::user()->afa->id)->created_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->conjunctionAgreement(Auth::user()->id,Auth::user()->afa->id)->created_at)->year }}</small>
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon grenate-bg">
                                <i class="fa fa-file"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <h2>@lang('app.txt.dossier.conjunction_agreement')</h2>
                                <p>@lang('app.txt.dossier.conjunction_agreement.description')</p>
                                @if (Auth::user()->hasAfa())
                                    @if (Auth::user()->afaHasSendCa(Auth::user()->id,Auth::user()->afa->id))
                                        <div class="row col-lg-12">
                                            {{-- <a href="#" class="m-btn m-btn-sm m-btn-theme2nd col-lg-6" onclick="showConjunctionAgreement({{ Auth::user()->conjunctionAgreement(Auth::user()->id,Auth::user()->afa->id) }})">@lang('app.btn.more_info')</a> --}}
                                            <span class="col-lg-12 text-right"><small><b>@lang('app.status') : </b> <i class="badge badge-pill badge-success white-color">@lang('app.txt.finalized')</i></small></span>
                                        </div>
                                    @else
                                        <div class="row col-lg-12">
                                            <span class="col-lg-12 text-right"><small><b>@lang('app.status') : </b> <i class="badge badge-pill badge-warning white-color">@lang('app.txt.sent_and_awaiting_finalization')</i></small></span>
                                        </div>
                                    @endif
                                    @php
                                        $ca = Auth::user()->conjunctionAgreement(Auth::user()->id,Auth::user()->afa->id);
                                    @endphp

                                    @if ($ca!=="")
                                        <span class="vertical-date">        
                                            {{Auth::user()->conjunctionAgreement(Auth::user()->id,Auth::user()->afa->id)->created_at->diffForHumans()}} <br/>
                                            <small>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->conjunctionAgreement(Auth::user()->id,Auth::user()->afa->id)->created_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->conjunctionAgreement(Auth::user()->id,Auth::user()->afa->id)->created_at)->year }}</small>
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon grenate-bg">
                                <i class="fa fa-download"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <h2>@lang('app.txt.dossier.mandat_recherche.download')</h2>
                                <p>@lang('app.txt.dossier.mandat_recherche.download.description')</p>
                                @if (Auth::user()->hasAfa())
                                    @php
                                        $mr = Auth::user()->mandatRecherche(1,Auth::user()->id,Auth::user()->afa->id);
                                    @endphp

                                    @if ($mr!=="")
                                        @if (!Auth::user()->memberHasSendMr(1,Auth::user()->id,Auth::user()->afa->id))
                                            <div class="row col-lg-12">
                                                <a href="{{ url($mr->path) }}" target="_blank" class="m-btn m-btn-sm m-btn-theme2nd col-lg-6">@lang('app.btn.download')</a>
                                            </div>
                                            <div class="row col-lg-12 m-15px-t">
                                                <span class="col-lg-12 text-right"><small><b>@lang('app.status') : </b> <i class="badge badge-pill badge-danger white-color">@lang('app.txt.to_download')</i></small></span>
                                            </div>
                                        @endif
                                        <span class="vertical-date">        
                                            {{Auth::user()->mandatRecherche(1,Auth::user()->id,Auth::user()->afa->id)->created_at->diffForHumans()}} <br/>
                                            <small>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->mandatRecherche(1,Auth::user()->id,Auth::user()->afa->id)->created_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->mandatRecherche(1,Auth::user()->id,Auth::user()->afa->id)->created_at)->year }}</small>
                                        </span>
                                    @else
                                        <div class="row col-lg-12 m-15px-t">
                                            <span class="col-lg-12 text-right"><small><b>@lang('app.status') : </b> <i class="badge badge-pill badge-info white-color">@lang('app.txt.not_available')</i></small></span>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon grenate-bg">
                                <i class="fa fa-paper-plane"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <h2>@lang('app.txt.dossier.mandat_recherche.finalized')</h2>
                                <p>@lang('app.txt.dossier.mandat_recherche.finalized.description')</p>
                                @if (Auth::user()->hasAfa())
                                    @if ($mr!=="")
                                        @if (!Auth::user()->memberHasSendMr(1,Auth::user()->id,Auth::user()->afa->id))
                                            <div class="col-lg-12">
                                                <button href="javascript:void(0)" class="m-btn m-btn-sm m-btn-theme float-left" id="btnUploadFile" onclick="uploadFile({{$mr->id}})" value="{{ $mr->id }}">@lang('app.btn.upload')</button>
                                            </div>
                                            <div class="row col-lg-12">
                                                <div class="col-lg-10">
                                                    <span id="spnFilePath"></span>
                                                    <form id="formSendMrFile">
                                                        <input type="file" id="FileUpload1" onchange="fileUploadChange({{$mr->id}})" name="file_mr" style="display: none" />
                                                        <input type="hidden" value="{{$mr->id}}" id="mr_id" name="mr_id"/>
                                                    </form>
                                                </div>
                                                {{-- <a href="javascript:void(0)" class="m-btn m-btn-sm m-btn-theme col-lg-6">@lang('app.btn.upload')</a> --}}
                                            </div>
                                            <div class="row col-lg-12 m-15px-t">
                                                <span class="col-lg-12 text-right"><small><b>@lang('app.status') : </b> <i class="badge badge-pill badge-danger white-color">@lang('app.txt.to_upload')</i></small></span>
                                            </div>
                                        @else
                                            <div class="row col-lg-12">
                                                <div class="col-lg-10">
                                                    <p><b>@lang('app.txt.reference') : </b> {{ explode('.pdf', $mr->file_name)[0] }}</p>
                                                </div>
                                                <div class="col-lg-2 m-25px-t">
                                                    <a href="{!! url($mr->path) !!}" target="_blank" class="m-btn m-btn-sm m-btn-theme2nd">@lang('app.txt.detail')</a>       
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 m-15px-t">
                                                <span class="col-lg-12 text-right"><small><b>@lang('app.status') : </b> <i class="badge badge-pill badge-success white-color">@lang('app.txt.finalized')</i></small></span>
                                            </div>
                                            <span class="vertical-date">        
                                                {{Auth::user()->mandatRecherche(1,Auth::user()->id,Auth::user()->afa->id)->updated_at->diffForHumans()}} <br/>
                                                <small>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->mandatRecherche(1,Auth::user()->id,Auth::user()->afa->id)->updated_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->mandatRecherche(1,Auth::user()->id,Auth::user()->afa->id)->updated_at)->year }}</small>
                                            </span>
                                        @endif
                                    @else
                                        <div class="row col-lg-12 m-15px-t">
                                            <span class="col-lg-12 text-right"><small><b>@lang('app.status') : </b> <i class="badge badge-pill badge-info white-color">@lang('app.txt.not_available')</i></small></span>
                                        </div>
                                    @endif
                                @endif
                                
                            </div>
                        </div>

                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon grenate-bg">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <h2>@lang('app.txt.dossier.i_would_like_to_buy_this')</h2>
                                <p>@lang('app.txt.dossier.i_would_like_to_buy_this.description')</p>
                                <div class="row col-lg-12 m-15px-t">
                                    @if (Auth::user()->hasAfa())
                                        @if (Auth::user()->memberHasSendMr(1,Auth::user()->id,Auth::user()->afa->id))<span class="col-lg-12 text-right"><small><b>@lang('app.status') : </b> <i class="badge badge-pill badge-info white-color">@lang('app.waiting')</i></small></span>@endif
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
			</div>
		</div>
	</div>
	@endif

    <!-- Modal to show timeline each CA folder -->
    <div id="showInfoStepModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content white-bg">
                <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                    <h4 class="modal-title white-color"></h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <a type="button" class="m-btn m-btn-theme" href="javascript:void(0)" data-dismiss="modal">@lang('app.btn.close')</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
	<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/js/jquery-dateFormat.min.js') }}"></script>
    <script>
        function showDossierTransaction(dossierTransaction,product){
            var numero = dossierTransaction.numero;
            var productRef = product.reference;
            var productName = product.title;
            var state = product.location.area_level_1;
            var city = product.location.locality;
            var status = dossierTransaction.status;
            var createdAt = dossierTransaction.created_at;
            var titleModal = "Info Dossier Transaction";
            var content = "";
            
            content = '<div>'+
                    '<p><b>Numero du Dossier : </b>'+numero+'</p>'+
                    '<p><b>Référence Produit : </b>'+productRef+'</p>'+
                    '<p><b>Nom Programme ou Produit : </b>'+productName+'</p>'+
                    '<p><b>Statut : </b>'+status+'</p>'+
                    '<p><b>Date de création : </b>'+$.format.date(createdAt, "dd MMMM yyyy")+'</p>'+
                    '<p><b>Etat : </b>'+state+'</p>'+
                    '<p><b>Ville : </b>'+city+'</p>'+
                '</div>';

            $('#showInfoStepModal .modal-title').html(titleModal);
            $('#showInfoStepModal .modal-body').html(content);
            
            return $('#showInfoStepModal').modal('show');
        }

        function showAfa(afa){
            var immat = afa.immat;
            var endRelation = '{{ Auth::user()->afa_ends_at }}';
            var titleModal = "Info AFA";
            var content = "";
            
            content = '<div>'+
                    '<p><b>Immatriculation : </b>'+immat+'</p>'+
                    '<p><b>Fin relation : </b>'+$.format.date(endRelation, "dd MMMM yyyy")+'</p>'+
                '</div>';

            $('#showInfoStepModal .modal-title').html(titleModal);
            $('#showInfoStepModal .modal-body').html(content);
            
            return $('#showInfoStepModal').modal('show');
        }

        // Mandat de recherche script
        $(function () {
            var fileupload = $("#FileUpload1");
            var filePath = $("#spnFilePath");
            var button = $("#btnUploadFile");
            var folderId = button.val();
            var buttonsend = '<button type="button" class="m-btn m-btn-sm m-btn-theme4rd m-15px-l" onclick="sendFile('+folderId+')" title={{trans("app.btn.send")}} id="btnSendFile"><i class="fa fa-paper-plane"></i></button>';

            button.click(function () {
                // fileupload.click();
                fileupload.change(function () {
                    var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                    filePath.html("<b>Selected File: </b>" + fileName +" " +buttonsend);
                });
            });
        });

        function uploadFile(){
            var fileupload = $("#FileUpload1");
            var filePath = $("#spnFilePath");
            var button = $("#btnUploadFile");
            var folderId = button.val();
            var buttonsend = '<button type="button" class="m-btn m-btn-sm m-btn-theme4rd" onclick="sendFile('+folderId+')" id="btnSendFile">Send</button>';

            fileupload.click();
        }

        function fileUploadChange(folderId){
            var fileName = $('#FileUpload1').val().split('\\')[$('#FileUpload1').val().split('\\').length - 1];
            var filePath = $("#spnFilePath");
            var button = $("#btnUploadFile");
            var buttonsend = '<button type="button" class="m-btn m-btn-sm m-btn-theme4rd" onclick="sendFile('+folderId+')" id="btnSendFile">Send</button>';
                filePath.html("<b>Selected File: </b>" + fileName +" " +buttonsend);
        }

        function sendFile(mrId){
            var fileToUpload = new FormData();

            // show loading icon
            loadingPage();

            fileToUpload.append('file_mr', $( '#FileUpload1' )[0].files[0] );
            fileToUpload.append('mr_id', $( '#mr_id' ).val() );

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({               
                url: '{{ route("member.dossier.upload_mr") }}',
                data: fileToUpload,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType:'json',
                enctype: 'multipart/form-data',
                success: function( data ){
                    // hide loading icon
                    stopLoadingPage();

                    if(data.response == 'false'){
					swal("{{ trans('app.txt.upload_research_mandate') }}", "{{ trans('app.txt.pdf_upload_error') }}", "error");
                    }else{
                        // Change ca status to 1: mandat recherche (mr) finalized
                        updateMrTable(mrId);

                        // show loading icon
                        loadingPage();

                        swal({
                            title: "{{ trans('app.txt.finalized_research_mandate') }}", 
                            text: "{{ trans('app.txt.research_mandate_sent') }}", 
                            type: "success"
                            },
                        function(){ 
                            // reload page
                            location.reload();
                        }
                        );
                    }
                },
                error:function(){
                    // hide loading icon
                    stopLoadingPage();
                    swal("{{ trans('app.txt.upload_research_mandate') }}", "{{ trans('app.txt.upload_error') }}", "error");
                }
            });  
        }

        function updateMrTable(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({               
                url: '{{ route("member.dossier.update_mr") }}',
                type: 'POST',
                data: {'id':id},
                dataType:'json',
                success: function( data ){
                    console.log(data.success);
                }
            });  
        }
    </script>
	
@endpush