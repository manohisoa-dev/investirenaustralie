@include('includes.alerts')
<table class="shop_table shop_table_responsive cart table table-striped table-hover">
    <thead>
        <tr>
            <th></th>
            <th>@lang('app.products')</th>
            @if(\Auth::check()&&\Auth::user()->hasRole(4))
            <th>@lang('app.user')</th>
            @endif
            <th>@lang('app.txt.status')</th>
            {{-- @if($sales[0]->status == 'pinged') --}}
            <th style="width:20%;">@lang('app.txt.action')</th>
            {{-- @endif --}}
        </tr>
    </thead>
    <tbody>
        @foreach($items as $trans)
        @php
            $prod = App\Models\Product::whereId($trans->product_id)->first();
        @endphp	
        <tr>
            <td class="product-thumbnail" width="100">
                @php
                    $photo_principal = \App\Models\ProductsImage::where('products_images.product_id', '=', $prod->id)->where('products_images.is_principal', '=', 1)->join('images', 'products_images.image_id', '=', 'images.id')->first();
                    $first_photo = \App\Models\ProductsImage::where('products_images.product_id', '=', $prod->id)->join('images', 'products_images.image_id', '=', 'images.id')->first();
                @endphp
                @if($first_photo)
                    @if($photo_principal)
                    <!-- Programme sans principal -->
                    <img src="{{asset($photo_principal->filepath)}}" class="img-responsive" style="height:50px" />
                    @else
                    <!-- Programme principal -->
                    <img src="{{asset($first_photo->filepath)}}" class="img-responsive" style="height:50px" />
                    @endif
                @else
                    <!-- Programme aucun photo -->
                    <img class="img-responsive" src="{{asset('images/product.png')}}" style="height:50px">
                @endif
            </td>
            <td>{{ $prod->title }}</td> 
            <td>{{ $trans->status }}</td>
            <td align="center">
                @if (Auth::user()->hasRole(5))
                    @php
                        if($trans->status==2 || $trans->status==10 || $trans->status==11){
                            $btnText="En attente";
                        }else{
                            $btnText=trans('app.btn.continuer');
                        }
                    @endphp
                    @if ($trans->status == 0 || $trans->status == 1)
                        <a href="{{route('member.continueTransaction',$trans)}}" class="m-btn m-btn-theme2nd m-btn-sm">{{$btnText}}</a>
                    @elseif ($trans->status == 3 )
                        <a href="javascript:void(0)" onclick="submitFile()" class="m-btn m-btn-theme2nd m-btn-sm">{{trans('app.btn.submit').' Mandate'}}</a>
                    @elseif ($trans->status == 4 )
                        <a href="javascript:void(0)" onclick="submitMove({{$trans->id}})" class="btn btn-success btn-sm" style="margin-bottom:5px;">{{trans('app.btn.i_move')}}</a>
                        <a href="javascript:void(0)" onclick="submitNoMove({{$trans->id}})" class="btn btn-danger btn-sm">{{trans('app.btn.i_not_moving')}}</a>    
                    @elseif ($trans->status == 5 )
                        <small style="margin-bottom:5px;">Dossier de Transaction reste ouvert pendant 5 jours</small>
                        <a href="javascript:void(0)" onclick="submitMove({{$trans->id}})" class="btn btn-success btn-sm">{{trans('app.btn.i_move')}}</a>
                    @elseif ($trans->status == 6 )
                        @php
                            $prod=App\Models\Product::whereId($trans->product_id)->first();
                        @endphp
                        <a href="{{url('product').'/'.$prod->slug}}" class="btn btn-success btn-sm">{{trans('app.btn.add_to_cart')}}</a>
                    @elseif ($trans->status == 7 )
                        <small style="margin-bottom:5px;">En attente</small>
                    @elseif ($trans->status == 8 )
                        <a href="javascript:void(0)" onclick="confirmDossierTrans()" class="btn btn-success btn-sm">{{trans('app.btn.confirm_purchase')}}</a>
                    @elseif ($trans->status == 9 )
                        <a href="javascript:void(0)" onclick="submitFile()" class="m-btn m-btn-theme2nd m-btn-sm">{{trans('app.txt.sent_eoi_finalized')}}</a>
                    @elseif ($trans->status == 12 )
                        <small class="text-info" style="margin-bottom:5px;padding:10px;">@lang('app.txt.waiting_initial_deposit') </small>
                    @elseif ($trans->status == 13 )
                        <small class="text-info" style="margin-bottom:5px;padding:10px;">@lang('app.txt.awaiting_payment_of_the_first_cpc') </small>
                    @elseif ($trans->status == 14 )
                        <small class="text-info" style="margin-bottom:5px;padding:10px;">@lang('app.txt.awaiting_payment_of_the_second_cpc') </small>
                    @elseif ($trans->status == 15 )
                        <small class="text-info" style="margin-bottom:5px;padding:10px;">@lang('app.txt.awaiting_payment_of_the_bonus_cpc') </small>
                    @elseif ($trans->status == 16 )
                        <small class="badge-success" style="margin-bottom:5px;padding:10px;">@lang('app.txt.end_of_transaction') </small>
                    @else
                        <a href="javascript:void(0)" class="m-btn m-btn-theme m-btn-sm" disabled>{{$btnText}}</a>
                    @endif
                @else
                    @php
                        if($trans->status==2){
                            $btnText=trans('app.btn.submit').' CA';
                        }else{
                            $btnText="En attente";
                        }
                    @endphp
                    @if ($trans->status == 2)
                        <a href="javascript:void(0)" onclick="submitFile()" class="m-btn m-btn-theme2nd m-btn-sm">{{$btnText}}</a>
                    @elseif ($trans->status == 3 || $trans->status == 4 )
                        <small style="margin-bottom:5px;">En attente</small>
                    @elseif ($trans->status == 5 )
                        <small style="margin-bottom:5px;" class="text-danger">Membre ne veut pas se déplacer</small>
                    @elseif ($trans->status == 6 )
                        <small style="margin-bottom:5px;" class="text-success">Membre veut se déplacer</small>    
                    @elseif ($trans->status == 7 )
                        <a href="javascript:void(0)" onclick="completeDossTrans()" class="m-btn m-btn-theme2nd">@lang('app.txt.complete_transaction_file_info')</a>
                    @elseif ($trans->status == 10 )
                        <a href="javascript:void(0)" onclick="submitFile()" class="btn btn-success btn-sm" style="margin-bottom:5px;">{{trans('app.txt.upload_eoi_finalized')}}</a>
                        <a href="javascript:void(0)" onclick="resendFile({{$trans->id}})" class="btn btn-warning btn-sm">{{trans('app.txt.resend_eoi_finalized_to_seller')}}</a>    
                    @elseif ($trans->status == 11 )
                        <a href="javascript:void(0)" onclick="submitEoi()" class="m-btn m-btn-theme2nd m-btn-sm">{{trans('app.txt.send_finalized_eoi')}}</a>
                    @elseif ($trans->status == 12 )
                        <a href="javascript:void(0)" onclick="initialDepositConfirm({{$trans->id}})" class="m-btn m-btn-theme2nd m-btn-sm">{{trans('app.txt.initial_deposit_confirmation')}}</a>
                    @elseif ($trans->status == 13 )
                        <a href="javascript:void(0)" onclick="resendCourielInitialDepositConfirm({{$trans->id}})" class="m-btn m-btn-theme2nd m-btn-sm" style="margin-bottom:5px;">{{trans('app.txt.initial_deposit_confirmation')}}</a>
                        <a href="javascript:void(0)" onclick="setCpcOnCommissionFirstPayment({{$trans->id}})" class="m-btn m-btn-theme4rd m-btn-sm">{{trans('app.txt.cpc_on_commission_first_payement')}}</a>
                    @elseif ($trans->status == 14 )
                        <a href="javascript:void(0)" onclick="setCpcOnCommissionSecondPayment({{$trans->id}})" class="m-btn m-btn-theme4rd m-btn-sm">{{trans('app.txt.cpc_on_commission_second_payement')}}</a>
                    @elseif ($trans->status == 15 )
                        <a href="javascript:void(0)" onclick="setCpcOnBonusPayment({{$trans->id}})" class="m-btn m-btn-theme4rd m-btn-sm">{{trans('app.txt.cpc_on_bonus_payment')}}</a>
                    @elseif ($trans->status == 16 )
                        <small class="badge-success" style="margin-bottom:5px;padding:10px;">@lang('app.txt.end_of_transaction') </small>
                    @else
                        <a href="javascript:void(0)" class="m-btn m-btn-theme m-btn-sm" disabled>{{$btnText}}</a>
                    @endif
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Upload Modal --}}
<div id="uploadModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content white-bg">
            <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                <h4 class="modal-title white-color text-center">{{ strtoupper(trans('app.txt.submit_contract_signed')) }} </h4>
                <button type="button" class="close" data-dismiss="modal" onclick="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <form action="" id="formUpload" enctype="multipart/form-data">
                    <div class="form-group ">
                        <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id_doss_trans" id="id_doss_trans" value="{{$trans->id}}">
                        @php
                            if($trans->status==9 || $trans->status==10){
                                $filename='"'.strtolower(trans('app.txt.eoi')).'"';
                            }
                            elseif($trans->status==3){
                                $filename='"'.strtolower(trans('app.txt.conjunction_agreement')).'"';
                            }elseif($trans->status==4){
                                $filename='"'.strtolower(trans('app.txt.research_mandate')).'"';
                            }else{
                                $filename=strtolower(trans('app.txt.contract'));
                            }
                        @endphp
                        <label for="">@lang('app.txt.please_choose_your_signed_contract',['filename'=>$filename]) *</label>
                        <input type="file" required name="file_ca" id="file_ca" accept="application/pdf">
                    </div>
                    <hr/>
                    <div class="input-group">
                        <a type="button" class="m-btn m-btn-theme m-10px-r" href="javascript:void(0)" data-dismiss="modal">@lang('app.btn.cancel')</a>
                        @if (Auth::user()->hasRole(5))
                            @if ($trans->status == 9)
                                <button type="button" onclick="sendEoi()" class="m-btn m-btn-theme2nd" id="btn_send_contract">@lang('app.btn.send')</button>
                            @else
                                <button type="button" onclick="sendMr()" class="m-btn m-btn-theme2nd" id="btn_send_contract">@lang('app.btn.send')</button>
                            @endif
                        @else
                            @if ($trans->status == 10)
                                <button type="button" onclick="sendEoiFinalized()" class="m-btn m-btn-theme2nd" id="btn_send_contract">@lang('app.btn.send')</button>
                            @else
                                <button type="button" onclick="sendCa()" class="m-btn m-btn-theme2nd" id="btn_send_contract">@lang('app.btn.send')</button>
                            @endif
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal to complete dossier transaction information -->
<div id="completeDossierTransactionModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content white-bg">
            <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                <h4 class="modal-title white-color"> @lang('app.txt.complete_transaction_file_info') | N° : {{$trans->numero}}<span></span></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route("afa.dossier.update_dt") }}" id="completeDossierTransactionInformationForm" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group"><label class="col-sm-12 control-label" for="numero">N° : </label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="doss_id" name="doss_id" value="{{ $trans->id }}">
                            <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero')?old('numero'):$trans->numero }}" readonly>
                                <span class="text-danger">{{ $errors->first("numero") }}</span>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-12 control-label" for="name">Ref : </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="prod_ref" name="prod_ref" value="{{ old('prod_ref')?old('prod_ref'):$prod->reference }}" readonly>
                                <span class="text-danger">{{ $errors->first("prod_ref") }}</span>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-12 control-label" for="prod_name">Program/Product name : </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{ old('prod_name')?old('prod_name'):$prod->title }}" readonly>
                                <span class="text-danger">{{ $errors->first("prod_name") }}</span>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-12 control-label" for="lot_type">Lot Type : *</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="lot_type" name="lot_type" placeholder="Ex: B3 type unit" value="{{ old('lot_type')?old('lot_type'):'' }}">
                                <span class="text-danger">{{ $errors->first("lot_type") }}</span>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-12 control-label" for="lot_level">Lot Level : *</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="lot_level" name="lot_level" placeholder="Ex: level 8" value="{{ old('lot_level')?old('lot_level'):'' }}">
                                <span class="text-danger">{{ $errors->first("lot_level") }}</span>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-12 control-label" for="lot_id">Lot ID : *</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="lot_id" name="lot_id" placeholder="Ex: unit 804" value="{{ old('lot_id')?old('lot_id'):'' }}">
                                <span class="text-danger">{{ $errors->first("lot_id") }}</span>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-12 control-label" for="final_sales_price">Final sales price : *</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="final_sales_price" min="0" name="final_sales_price" placeholder="AUD" value="{{ old('final_sales_price')?old('final_sales_price'):'' }}">
                                <span class="text-danger">{{ $errors->first("final_sales_price") }}</span>
                        </div>
                    </div>
                    <div class="form-group m-25px-t{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        {{-- <label class="col-md-4 control-label">Captcha</label> --}}
                        <div class="col-md-12">
                            {!! app('captcha')->display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="float-right m-15px-t">
                        <button type="reset" class="m-btn m-btn-theme" data-dismiss="modal" id="btn_cancel">@lang("app.btn.cancel")</button> 
                        <button type="submit" class="m-btn m-btn-theme2nd"  id="btn_save">@lang("app.btn.save")</button></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @lang('app.form.required')
            </div>
        </div>
    </div>
</div>

<!-- Modal to confirm dossier transaction information -->
@if($trans->status >= 8)
<div id="confirmDossierTransactionModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content white-bg">
            <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                <h4 class="modal-title white-color"> @lang('app.message')<span></span></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route("member.dossier.confirm_dt") }}" id="comfirmInformationDossierTransactionForm" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="doss_id" value="{{$trans->id}}">
                    @php
                        $dt = Carbon\Carbon::now();
                        $dtDate = $dt->format('m-d-Y');
                        $dtTime = $dt->format('H:i:m');
                        $member = App\Models\User::whereId($trans->user_id)->first();
                        $user_name= $member->isPerson()?$member->userinfos->first_name.' '.$member->userinfos->last_name:$member->userinfos->orga_name;
                        $afa = $member->afa->name;
                        $product = App\Models\Product::whereId($trans->product_id)->first();
                        $city = $product->location->locality;
                        $etat = $product->location->area_level_1;
                        $title = $product->title;
                        $lotLevel = $trans->lot_level;
                        $lotType = $trans->lot_type;
                        $lotId = $trans->lot_id;
                        $finalSalesPrice = $trans->final_sales_price;
   
                        // Send message and notif email to membre after transaction information sent
                        // get template mail AFA
                        $template = App\Models\MailsTemplate::where('id', 32)->get();
                        App::setLocale($member->language);
                        $lang = $member->language;
                        $body = 'template_' . $lang;
                        $sujet_tpl = 'sujet_'.$lang;
                        $confirmLink = setLinkDynamic(route('member.transaction'),strtoupper(trans('app.btn.confirm_purchase')));
                        $vars = array(
                            '{date}' => $dtDate,
                            '{heure}' => $dtTime,
                            '{name}' => $user_name,
                            '{afa}' => $afa,
                            '{city}' => $city,
                            '{state}' => $etat,
                            '{title}' => $title,
                            '{lottype}' => $lotType,
                            '{lotid}' => $lotId,
                            '{lotlevel}' => $lotLevel,
                            '{price}' => $finalSalesPrice,
                            '{confirmLink}' => '',
                            '{checkbox1}' => '<input type="checkbox" name="checkbox1">',
                            '{checkbox2}' => '<input type="checkbox" name="checkbox2">',
                            '{checkbox3}' => '<input type="checkbox" name="checkbox3">',
                            '{checkbox4}' => '<input type="checkbox" name="checkbox4">',
                            '{checkbox5}' => '<input type="checkbox" name="checkbox5">',
                            '{checkbox6}' => '<input type="checkbox" name="checkbox6">',
                        );
                        $sujet = $template[0]->$sujet_tpl;
                        $contenu = strtr($template[0]->$body, $vars);
                    @endphp
                    
                    {!! $contenu !!}

                    <div class="float-right m-15px-t">
                        <button type="reset" class="m-btn m-btn-theme" data-dismiss="modal" id="btn_cancel">@lang("app.btn.cancel")</button> 
                        <button type="submit" class="m-btn m-btn-theme2nd"  id="btn_save">@lang("app.txt_confirm_btn")</button></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @lang('app.form.required')
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal to send finalized eoi with afa -->
@if($trans->status >= 10)
<div id="sellingProcessClearanceModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content white-bg">
            <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                <h4 class="modal-title white-color"> @lang('app.message')<span></span></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route("afa.dossier.send_eoi_finalized") }}" id="sellingProcessClearanceForm" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="doss_id" value="{{$trans->id}}">
                    @php
                        $user = App\Models\User::whereId($trans->user_id)->first();
                        $afa = App\Models\User::whereId($trans->afa_id)->first();
                        $seller = App\Models\User::whereId($product->seller_id)->first();
                        $template = App\Models\MailsTemplate::where('id', 37)->get();
                        App::setLocale(Auth::user()->language);
                        $lang = 'en';
                        $body = 'template_' . $lang;
                        $sujet_tpl = 'sujet_'.$lang;
                        $pathLink = url('/uploads/pdf/transaction/').'/'.$trans->eoi_finalize_file_name_afa;
                        $downloadeoiLink = '<b>'.setLinkDynamic($pathLink,strtoupper(trans('app.txt.eoi_finalized'))).'</b>';
                        $vars = array(
                            '{date}' => Carbon\Carbon::now()->toFormattedDateString(),
                            '{afa}' => $afa?$afa->name:'',
                            '{name}' => $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name,
                            '{seller}' => $seller?$seller->name:'',
                            '{sellerparentcompany}' => $seller?$seller->userinfos->orga_parent_name:'',
                            '{title}' => $product->title,
                            '{lottype}' => $trans->lot_type,
                            '{lotlevel}' => $trans->lot_level,
                            '{lotid}' => $trans->lot_id,
                            '{price}' => $trans->final_sales_price,
                            '{checkbox}' => '<input type="checkbox" name="confirm_firb" id="confirm_firb">',
                            '{downloadLink}' => $downloadeoiLink,
                        );
                        $sujet = $template[0]->$sujet_tpl;
                        $contenu = strtr($template[0]->$body, $vars);
                        $content = ['title' => '', 'body' => $contenu];
                    @endphp
                    
                    {!! $contenu !!}

                    <div class="float-right m-15px-t">
                        <button type="reset" class="m-btn m-btn-theme" data-dismiss="modal" id="btn_cancel">@lang("app.btn.cancel")</button> 
                        <button type="submit" class="m-btn m-btn-theme2nd"  id="btn_save">@lang("app.txt_confirm_btn")</button></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @lang('app.form.required')
            </div>
        </div>
    </div>
</div>
@endif

{{$items->links()}}

@push('script')
    {!! NoCaptcha::renderJs() !!}
    <script>
        function submitFile(){
            // show modal upload
            $('#uploadModal').modal('show');
        }

        function sendCa(){
            var formData = new FormData($('#formUpload')[0]);

            // show loading icon
            loadingPage();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({               
                url: '{{ route("afa.dossier.upload_ca") }}',
                data: formData,
                async: true,
				cache: false,
				contentType: false,
				processData: false,
                type: 'POST',
                dataType:'json',
                enctype: 'multipart/form-data',
                success: function( data ){
                    // hide loading icon
                    stopLoadingPage();

                    if(data.response == 'false'){
					swal("Upload Conjunction Agreement", "Upload error! Choose a right format .pdf", "error");
                    }else{
                        // show loading icon
                        loadingPage();

                        swal({
                            title: "Upload Conjunction Agreement", 
                            text: "Conjunction Agreement Sent", 
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
                    swal("Upload Conjunction Agreement", "Upload error", "error");
                }
            });  
        }

        function sendMr(){
            var formData = new FormData($('#formUpload')[0]);

            // show loading icon
            loadingPage();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({               
                url: '{{ route("member.dossier.upload_mr") }}',
                data: formData,
                async: true,
				cache: false,
				contentType: false,
				processData: false,
                type: 'POST',
                dataType:'json',
                enctype: 'multipart/form-data',
                success: function( data ){
                    // hide loading icon
                    stopLoadingPage();

                    if(data.response == 'false'){
					swal("Upload Mandat de Recherche Finalisé", "Upload error! Choose a right format .pdf", "error");
                    }else{
                        // show loading icon
                        loadingPage();

                        swal({
                            title: "Mandat de Recherche Finalisé", 
                            text: "Mandat de Recherche Sent", 
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
                    swal("Upload Research Mandate", "Upload error", "error");
                }
            });  
        }
        
        function submitNoMove(id_doss_trans){
            // show loading icon
            loadingPage();

            var status = 5;


            swal({
                title: "Confirmation de déplacement",
                text: "Vous ne voulez-pas vous déplacer ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#ff3547',
                confirmButtonText: "@lang('app.yes')",
                cancelButtonText: "@lang('app.no')",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){	
                if (isConfirm){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("member.dossier.update_dossier_trans") }}',
                        type: "POST",
                        dataType: "JSON",
                        data:{"id_doss_trans": id_doss_trans,'status':status},
                        success: function(data)
                        {
                            swal("Confirmation de déplacement", "Vous avez annulé votre déplacement", "success");
                            location.reload();	
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Confirmation de déplacement", "Erreur de confirmation", "error");
                            location.reload();	
                        }
                    }); 
                } else {
                    stopLoadingPage();
                    swal("Confirmation de déplacement", "@lang('app.jquery.delete_cancel')", "error");
                }
            });
        }

        function resendFile(id_doss_trans){
            swal({
                title: "{{trans('app.txt.resend_eoi_finalized_to_seller')}}",
                text: "{{trans('app.txt.are_you_sure')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#0075B7',
                confirmButtonText: "@lang('app.yes')",
                cancelButtonText: "@lang('app.no')",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){	
                if (isConfirm){
                    loadingPage();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("afa.dossier.resend_eoi_to_seller") }}',
                        type: "POST",
                        dataType: "JSON",
                        data:{"id_doss_trans": id_doss_trans},
                        success: function(data)
                        {
                            swal("{{trans('app.txt.resend_eoi_finalized_to_seller')}}", "{{trans('app.txt.eoi_finalized_resent')}}", "success");
                            stopLoadingPage();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("{{trans('app.txt.resend_eoi_finalized_to_seller')}}", "{{trans('app.txt.resent_error')}}", "error");	
                            stopLoadingPage();
                        }
                    }); 
                } else {
                    stopLoadingPage();
                    swal("{{trans('app.txt.resend_eoi_finalized_to_seller')}}", "{{trans('app.txt.operation_canceled')}}", "warning");
                }
            });
        }
        
        function submitMove(id_doss_trans){
            // show loading icon
            loadingPage();

            var status = 6;

            swal({
                title: "Confirmation de déplacement",
                text: "Voulez-vous confirmer votre déplacement ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#ff3547',
                confirmButtonText: "@lang('app.yes')",
                cancelButtonText: "@lang('app.no')",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){	
                if (isConfirm){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("member.dossier.update_dossier_trans") }}',
                        type: "POST",
                        dataType: "JSON",
                        data:{"id_doss_trans": id_doss_trans,'status':status},
                        success: function(data)
                        {
                            swal("Confirmation de déplacement", "Vous avez confirmé votre déplacement", "success");
                            location.reload();	
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal("Confirmation de déplacement", "Erreur de confirmation", "error");
                            location.reload();	
                        }
                    }); 
                } else {
                    stopLoadingPage();
                    swal("Confirmation de déplacement", "@lang('app.jquery.delete_cancel')", "error");
                }
            });
        }

        function completeDossTrans(){
            $('#completeDossierTransactionModal').modal('show');
        }

        function confirmDossierTrans(){
            $('#confirmDossierTransactionModal').modal('show');
        }

        function sendEoi(){
            var formData = new FormData($('#formUpload')[0]);

            // show loading icon
            loadingPage();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({               
                url: '{{ route("member.dossier.upload_eoi") }}',
                data: formData,
                async: true,
				cache: false,
				contentType: false,
				processData: false,
                type: 'POST',
                dataType:'json',
                enctype: 'multipart/form-data',
                success: function( data ){
                    // hide loading icon
                    stopLoadingPage();

                    if(data.response == 'false'){
					swal("Upload Expression Of Interest Finalisé", "Upload error! Choose a right format .pdf", "error");
                    }else{
                        // show loading icon
                        loadingPage();

                        swal({
                            title: "Expression Of Interest finalisé", 
                            text: "Expression Of Interest finalisé Sent", 
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
                    swal("Upload Expression Of Interest Finalisé", "Upload error", "error");
                }
            });  
        }

        function sendEoiFinalized(){
            var formData = new FormData($('#formUpload')[0]);

            // show loading icon
            loadingPage();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({               
                url: '{{ route("afa.dossier.upload_eoi_finalized") }}',
                data: formData,
                async: true,
				cache: false,
				contentType: false,
				processData: false,
                type: 'POST',
                dataType:'json',
                enctype: 'multipart/form-data',
                success: function( data ){
                    // hide loading icon
                    stopLoadingPage();

                    if(data.response == 'false'){
					swal("Upload Expression Of Interest Finalisé", "Upload error! Choose a right format .pdf", "error");
                    }else{
                        // show loading icon
                        loadingPage();

                        swal({
                            title: "Expression Of Interest finalisé", 
                            text: "Expression Of Interest finalisé Sent", 
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
                    swal("Upload Expression Of Interest Finalisé", "Upload error", "error");
                }
            });  
        }

        function submitEoi(doss_id){
            $('#sellingProcessClearanceModal').modal('show');
        }

        $(document).ready(function(){
            // jquery validate form
            $('#completeDossierTransactionInformationForm').validate({
                ignore: [],
                rules: {
                    lot_type: {
                        required: true
                    },
                    lot_level: {
                        required: true
                    },
                    lot_id: {
                        required: true,
                    },
                    final_sales_price: {
                        required: true,
                        number: true,
                        minlength:0,
                    },
                    'g-recaptcha-response': {
                        required: true,
                    },
                },
                messages: {
                    lot_type: {
                        required: "@lang('app.txt.champobligatoire')"
                    },
                    lot_level: {
                        required: "@lang('app.txt.champobligatoire')"
                    },
                    lot_id: {
                        required: "@lang('app.txt.champobligatoire')",
                    },
                    final_sales_price: {
                        required: "@lang('app.txt.champobligatoire')"
                    },
                    'g-recaptcha-response': {
                        required: "@lang('app.txt.champobligatoire')",
                    },
                },
                errorPlacement: function ( error, element ) {
                    if(element.parent().hasClass('input-group')){
                        error.insertBefore( element.parent() );
                    }else{
                        error.insertAfter( element );
                    }
                },
            });

            $('#completeDossierTransactionInformationForm').submit(function() { // fires on every keyup & blur
                if ($('#completeDossierTransactionInformationForm').valid()) {                   // checks form for validity
                    loadingPage();
                }
            });


            $('#comfirmInformationDossierTransactionForm').validate({
                ignore: [],
                rules: {
                    'checkbox1': {
                        required: true,
                    },
                    'checkbox2': {
                        required: true,
                    },
                    'checkbox3': {
                        required: true,
                    },
                    'checkbox4': {
                        required: true,
                    },
                    'checkbox5': {
                        required: true,
                    },
                    'checkbox6': {
                        required: true,
                    },
                },
                messages: {
                    'checkbox1': {
                        required: "@lang('app.txt.champobligatoire')",
                    },
                    'checkbox2': {
                        required: "@lang('app.txt.champobligatoire')",
                    },
                    'checkbox3': {
                        required: "@lang('app.txt.champobligatoire')",
                    },
                    'checkbox4': {
                        required: "@lang('app.txt.champobligatoire')",
                    },
                    'checkbox5': {
                        required: "@lang('app.txt.champobligatoire')",
                    },
                    'checkbox6': {
                        required: "@lang('app.txt.champobligatoire')",
                    }
                },
                errorPlacement: function ( error, element ) {
                    if(element.parent().hasClass('input-group')){
                        error.insertBefore( element.parent() );
                    }else{
                        error.insertAfter( element );
                    }
                },
            });

            $('#sellingProcessClearanceForm').validate({
                ignore: [],
                rules: {
                    'confirm_firb': {
                        required: true,
                    },
                },
                messages: {
                    'confirm_firb': {
                        required: "@lang('app.txt.champobligatoire')",
                    },
                },
                errorPlacement: function ( error, element ) {
                    if(element.parent().hasClass('input-group')){
                        error.insertBefore( element.parent() );
                    }else{
                        error.insertAfter( element );
                    }
                },
            });

            $('#sellingProcessClearanceForm').submit(function() { // fires on every keyup & blur
                if ($('#sellingProcessClearanceForm').valid()) {                   // checks form for validity
                    loadingPage();
                }
            });
        });

        function initialDepositConfirm(id_doss_trans){
            swal({
                title: "{{ trans('app.txt.initial_deposit_confirmation') }}",
                text: "{{ trans('app.do_you_confirm') }}",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: '#0075B7',
                confirmButtonText: "@lang('app.yes')",
                cancelButtonText: "@lang('app.no')",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm){
                loadingPage();

                if (isConfirm){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("afa.dossier.initialDepositConfirm") }}',
                        type: "POST",
                        dataType: "JSON",
                        data:{"doss_id": id_doss_trans},
                        success: function(data)
                        {
                            var msg = data.msg;

                            swal("{{ trans('app.txt.initial_deposit_confirmation') }}", msg, "success");
                            location.reload();	
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            stopLoadingPage();
                            swal("{{ trans('app.txt.initial_deposit_confirmation') }}", "{{ trans('app.txt.confirmation_error') }}", "error");	
                        }
                    }); 
                } else {
                    stopLoadingPage();
                    swal("{{ trans('app.txt.initial_deposit_confirmation') }}", "@lang('app.jquery.delete_cancel')", "error");
                }
            });
        }

        function resendCourielInitialDepositConfirm(id_doss_trans){
            swal({
                title: "{{ trans('app.txt.initial_deposit_confirmation') }}",
                text: "{{ trans('app.do_you_confirm') }}",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: '#0075B7',
                confirmButtonText: "@lang('app.yes')",
                cancelButtonText: "@lang('app.no')",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm){
                loadingPage();

                if (isConfirm){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("afa.dossier.resendCourielInitialDepositConfirm") }}',
                        type: "POST",
                        dataType: "JSON",
                        data:{"doss_id": id_doss_trans},
                        success: function(data)
                        {
                            var msg = data.msg;

                            swal("{{ trans('app.txt.initial_deposit_confirmation') }}", msg, "success");
                            location.reload();	
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            stopLoadingPage();
                            swal("{{ trans('app.txt.initial_deposit_confirmation') }}", "{{ trans('app.txt.confirmation_error') }}", "error");	
                        }
                    }); 
                } else {
                    stopLoadingPage();
                    swal("{{ trans('app.txt.initial_deposit_confirmation') }}", "@lang('app.jquery.delete_cancel')", "error");
                }
            });
        }

        function setCpcOnCommissionFirstPayment(id_doss_trans){
            swal({
                title: "{{ trans('app.txt.cpc_on_commission_first_payement') }}",
                text: "{{ trans('app.do_you_confirm') }}",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: '#0075B7',
                confirmButtonText: "@lang('app.yes')",
                cancelButtonText: "@lang('app.no')",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm){
                loadingPage();

                if (isConfirm){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("afa.dossier.setCpcOnCommissionFirstPayment") }}',
                        type: "POST",
                        dataType: "JSON",
                        data:{"doss_id": id_doss_trans},
                        success: function(data)
                        {
                            var msg = data.msg;

                            swal("{{ trans('app.txt.cpc_on_commission_first_payement') }}", msg, "success");
                            location.reload();	
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            stopLoadingPage();
                            swal("{{ trans('app.txt.cpc_on_commission_first_payement') }}", "{{ trans('app.txt.confirmation_error') }}", "error");	
                        }
                    }); 
                } else {
                    stopLoadingPage();
                    swal("{{ trans('app.txt.cpc_on_commission_first_payement') }}", "@lang('app.jquery.delete_cancel')", "error");
                }
            });
        }

        function setCpcOnCommissionSecondPayment(id_doss_trans){
            swal({
                title: "{{ trans('app.txt.cpc_on_commission_second_payement') }}",
                text: "{{ trans('app.do_you_confirm') }}",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: '#0075B7',
                confirmButtonText: "@lang('app.yes')",
                cancelButtonText: "@lang('app.no')",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm){
                loadingPage();

                if (isConfirm){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("afa.dossier.setCpcOnCommissionSecondPayment") }}',
                        type: "POST",
                        dataType: "JSON",
                        data:{"doss_id": id_doss_trans},
                        success: function(data)
                        {
                            var msg = data.msg;

                            swal("{{ trans('app.txt.cpc_on_commission_second_payement') }}", msg, "success");
                            location.reload();	
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            stopLoadingPage();
                            swal("{{ trans('app.txt.cpc_on_commission_second_payement') }}", "{{ trans('app.txt.confirmation_error') }}", "error");	
                        }
                    }); 
                } else {
                    stopLoadingPage();
                    swal("{{ trans('app.txt.cpc_on_commission_second_payement') }}", "@lang('app.jquery.delete_cancel')", "error");
                }
            });
        }

        function setCpcOnBonusPayment(id_doss_trans){
            swal({
                title: "{{ trans('app.txt.cpc_on_bonus_payment') }}",
                text: "{{ trans('app.do_you_confirm') }}",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: '#0075B7',
                confirmButtonText: "@lang('app.yes')",
                cancelButtonText: "@lang('app.no')",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm){
                loadingPage();

                if (isConfirm){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("afa.dossier.setCpcOnBonusPayment") }}',
                        type: "POST",
                        dataType: "JSON",
                        data:{"doss_id": id_doss_trans},
                        success: function(data)
                        {
                            var msg = data.msg;

                            swal("{{ trans('app.txt.cpc_on_bonus_payment') }}", msg, "success");
                            location.reload();	
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            stopLoadingPage();
                            swal("{{ trans('app.txt.cpc_on_bonus_payment') }}", "{{ trans('app.txt.confirmation_error') }}", "error");	
                        }
                    }); 
                } else {
                    stopLoadingPage();
                    swal("{{ trans('app.txt.cpc_on_bonus_payment') }}", "@lang('app.jquery.delete_cancel')", "error");
                }
            });
        }



        // $(document).ready(function(){
        //     $('#formUpload').validate({
        //         ignore: [],
        //         rules: {
        //             file_ca: {
        //                 required: true,
        //             },
        //         },
        //         messages: {
        //             file_ca: {
        //                 required: "@lang('app.txt.champobligatoire')",
        //             },
        //         },
        //         errorPlacement: function ( error, element ) {
        //             if(element.parent().hasClass('input-group')){
        //                 error.insertBefore( element.parent() );
        //             }else{
        //                 error.insertAfter( element );
        //             }
        //         },
        //     });
        // });

        

        // $('#formUpload').submit(function(e) { 
        //     if ($('#formSendContract').valid()) {
        //         e.preventDefault();
        //         var fileToUpload = new FormData();
                
        //         // Show loading icon
        //         loadingPage();
                
        //         fileToUpload.append('_token', $( '#csrf_token' ).val() );
        //         fileToUpload.append('user_id', $( '#user_id' ).val() );
        //         fileToUpload.append('file_ca', $( '#file_ca' )[0].files[0] );                
        //         $.ajax({
        //             url: "{{route('confirm.registration.send.contract')}}",
        //             type:"POST",
        //             data: fileToUpload,
        //             processData: false,
        //             contentType: false,
        //             type: 'POST',
        //             dataType:'json',
        //             enctype: 'multipart/form-data',
        //             success: function( data ){
        //                 // hide loading icon
        //                 stopLoadingPage();

        //                 if(data.response == 'true'){
        //                     //  show loading icon
        //                     loadingPage();

        //                     swal({
        //                         title: "{{ trans('app.txt.submit_contract_signed') }}", 
        //                         text: "{{ trans('app.txt.file_sent') }}", 
        //                         type: "success"
        //                         },
        //                         function(){ 
        //                             // hide modal
        //                             $('#submitContractModal').modal('hide');
                                    
        //                             // go to home page
        //                             window.location.href= "{{route('home')}}";
        //                         }
        //                     );
        //                 }else{
        //                     if(data.status == 2){
        //                         swal({
        //                             title: "{{ trans('app.txt.submit_contract_signed') }}", 
        //                             text: "{{ trans('app.txt.contract_validated') }}", 
        //                             type: "info"
        //                             },
        //                             function(){ 
        //                                 // go to home page
        //                                 window.location.href= "{{route('home')}}";
        //                             }
        //                         );
        //                     }
        //                     else if(data.status == 1){
        //                         swal({
        //                             title: "{{ trans('app.txt.submit_contract_signed') }}", 
        //                             text: "{{ trans('app.txt.contract_awaiting_validation') }}", 
        //                             type: "info"
        //                             },
        //                             function(){ 
        //                                 // go to home page
        //                                 window.location.href= "{{route('home')}}";
        //                             }
        //                         );
        //                     }
        //                     else{
        //                         swal("{{ trans('app.txt.submit_contract_signed') }}", "{{ trans('app.txt.upload_error') }}", "error");
        //                     }
        //                 }
        //             },
        //             error:function(){
        //                 // hide loading icon
        //                 stopLoadingPage();
        //                 swal("{{ trans('app.txt.submit_contract_signed') }}", "{{ trans('app.txt.upload_error') }}", "error");
        //             }
        //         });


        //     } else {
        //         stopLoadingPage();
        //     }
        // });
    </script>
@endpush