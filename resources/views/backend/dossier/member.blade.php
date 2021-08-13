@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" href="{{ asset('style/timeline.css') }}">    
@endsection

@section('subcontent')

{{-- <div class="col-lg-12 col-xl-12"> --}}
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
                                        <a href="#" class="m-btn m-btn-sm m-btn-theme2nd col-lg-6" onclick="showDossierTransaction({{ Auth::user()->dossierTransaction()->first() }},{{ App\Models\Product::whereId(Auth::user()->dossierTransaction()->first()->product_id)->with('location')->first() }} )">@lang('app.btn.more_info')</a>
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
                                <i class="fa fa-file"></i>
                            </div>

                            <div class="vertical-timeline-content">
                                <h2>@lang('app.select_afa')</h2>
                                <p>@lang('app.txt.dossier.select_afa.description')</p>
                                @if (Auth::user()->hasAfa())
                                    <div class="row col-lg-12">
                                        <a href="#" class="m-btn m-btn-sm m-btn-theme2nd col-lg-6" onclick="showAfa({{ Auth::user()->afa }})">@lang('app.btn.more_info')</a>
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
                            </div>
                        </div>
                    </div>

                </div>
			</div>
		</div>
	</div>
	@endif
{{-- </div> --}}

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
    </script>
	
@endpush