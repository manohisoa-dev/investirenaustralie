@extends('admin.layouts.app')

@section('title', 'Procedure Achat - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.procedure_achat')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.lists')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action"></div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>@lang('app.txt.procedure_achat')</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                	<thead>
                    	<tr class="header-row">
                        <th>Numéro</th>
                        <th>Produit</th>
                        <th>Membre acheteur</th>
                        <th>AFA</th>
                        <th>Vendeur</th>
                        <th>Cabinet vendeur</th>
                        <th>Statut</th>
                        <th>Action</th>
                    	</tr>
                    </thead>
                    <tbody>
					@foreach($items as $item)
                        <tr>
							<td>{{$item->numero}}</td>
							<td>
							@if($item->product_id != 0)
								{{ sizeOf(\App\Models\Product::whereId($item->product_id)->pluck('title'))!=0?\App\Models\Product::whereId($item->product_id)->pluck('title')[0]:'-' }}
							@endif
							</td>
							<td>
							@if($item->user_id != 0)
								{{ sizeOf(\App\Models\User::whereId($item->user_id)->pluck('name'))!=0?\App\Models\User::whereId($item->user_id)->pluck('name')[0]:'-' }}
							@endif
							</td>
							<td>
								@if($item->afa_id != 0)
									{{ sizeOf(\App\Models\User::whereId($item->afa_id)->first()->userinfos())!=0?\App\Models\User::whereId($item->afa_id)->first()->userinfos->orga_name:'-' }}
								@endif
							</td>
							<td>
								@if($item->vendeur_id != 0)
									{{ sizeOf(\App\Models\User::whereId($item->vendeur_id)->first()->userinfos())!=0?\App\Models\User::whereId($item->vendeur_id)->first()->userinfos->orga_name:'-' }}
								@endif
							</td>
							<td>
								@if($item->sollicitor_id != 0)
									{{ sizeOf(\App\Models\Solicitor::whereId($item->sollicitor_id)->pluck('cabinet_name'))!=0?\App\Models\Solicitor::whereId($item->sollicitor_id)->pluck('cabinet_name')[0]:'-' }}
								@endif
							</td>
							<td>
                @php
                    $member=App\Models\User::whereId($item->user_id)->first();
                    $prod=App\Models\Product::whereId($item->product_id)->first();
                    $status=$item->status;

                    if(!$prod->isReserved()){
                      if($member->isMove()){
                        if($status==0){
                          echo "<span class='badge badge-info'>".trans('app.txt.transaction_file_create')."</span>";
                        }elseif($status==1){
                          echo "<span class='badge badge-info'>".trans('app.txt.select_afa')."</span>";
                        }elseif($status==2){
                          echo "<span class='badge badge-info'>".trans('app.txt.afa_selectéd')."</span>";
                        }elseif($status==3){
                          echo "<span class='badge badge-info'>".trans('app.txt.submit_a_search_mandate')."</span>";
                        }elseif($status==4){
                          echo "<span class='badge badge-info'>".trans('app.txt.mr_send')."</span>";
                        }elseif($status==5){
                          echo "<span class='badge badge-info'>".trans('app.txt.awaiting_move_decision')."</span>";
                        }elseif($status==6){
                          echo "<span class='badge badge-info'>".trans('app.txt.waiting_for_the_move')."</span>";
                        }elseif($status==7){
                          echo "<span class='badge badge-info'>".trans('app.txt.complete_registration_file')."</span>";
                        }elseif($status==8){
                          echo "<span class='badge badge-info'>".trans('app.txt.purchase_confirmation')."</span>";
                        }elseif($status==9){
                          echo "<span class='badge badge-info'>".trans('app.txt.confirmed_purchase')."</span>";
                        }elseif($status==10){
                          echo "<span class='badge badge-info'>".trans('app.txt.eoi_finalized_sent')."</span>";
                        }elseif($status==11){
                          echo "<span class='badge badge-info'>".trans('app.txt.eoi_finalized_sent')."</span>";
                        }elseif($status==12){
                          echo "<span class='badge badge-info'>".trans('app.txt.make_initial_deposit')."</span>";
                        }elseif($status==13){
                          echo "<span class='badge badge-info'>".trans('app.txt.initial_deposit_made')."</span>";
                        }elseif($status==14){
                          echo "<span class='badge badge-info'>".trans('app.txt.payment_first_cpc_commission_made')."</span>";
                        }elseif($status==15){
                          if($prod->haveBonus()){
                            echo "<span class='badge badge-info'>".trans('app.txt.payment_second_cpc_commission_made')."</span>";
                          }else{
                            echo "<span class='badge badge-info'>".trans('app.txt.payment_last_cpc_commission_made')."</span>";
                          }
                        }elseif($status==16){
                          echo "<span class='badge badge-info'>".trans('app.txt.payment_bonus_cpc_made')."</span>";
                        }
                      }else{
                        if($status==0){
                          echo "<span class='badge badge-info'>".trans('app.txt.transaction_file_create')."</span>";
                        }elseif($status==1){
                          echo "<span class='badge badge-info'>".trans('app.txt.complete_registration_file')."</span>";
                        }elseif($status==2){
                          echo "<span class='badge badge-info'>".trans('app.txt.afa_selectéd')."</span>";
                        }elseif($status==3){
                          echo "<span class='badge badge-info'>".trans('app.txt.submit_a_search_mandate')."</span>";
                        }elseif($status==7){
                          echo "<span class='badge badge-info'>".trans('app.txt.mr_send')."</span>";
                        }elseif($status==8){
                          echo "<span class='badge badge-info'>".trans('app.txt.purchase_confirmation')."</span>";
                        }elseif($status==9){
                          echo "<span class='badge badge-info'>".trans('app.txt.confirmed_purchase')."</span>";
                        }elseif($status==10){
                          echo "<span class='badge badge-info'>".trans('app.txt.eoi_finalized_sent')."</span>";
                        }elseif($status==11){
                          echo "<span class='badge badge-info'>".trans('app.txt.eoi_finalized_sent')."</span>";
                        }elseif($status==12){
                          echo "<span class='badge badge-info'>".trans('app.txt.make_initial_deposit')."</span>";
                        }elseif($status==13){
                          echo "<span class='badge badge-info'>".trans('app.txt.initial_deposit_made')."</span>";
                        }elseif($status==14){
                          echo "<span class='badge badge-info'>".trans('app.txt.payment_first_cpc_commission_made')."</span>";
                        }elseif($status==15){
                          if($prod->haveBonus()){
                            echo "<span class='badge badge-info'>".trans('app.txt.payment_second_cpc_commission_made')."</span>";
                          }else{
                            echo "<span class='badge badge-info'>".trans('app.txt.payment_last_cpc_commission_made')."</span>";
                          }
                        }elseif($status==16){
                          echo "<span class='badge badge-info'>".trans('app.txt.payment_bonus_cpc_made')."</span>";
                        }
                      }
                    }else{
                      echo "<span class='badge badge-danger'>".trans('app.txt.product_already_reserved')."</span>";
                    }
                @endphp
              </td>
							<td>
                 @if (!$prod->isReserved())
                    <button type="button" data-toggle="modal" data-target="#showinfoModal_{{$item->id}}" class="btn btn-default btn-circle" title="@lang('app.btn.show_detail')" id="delRecord"><i class="fa fa-info text-info"></i>
                  </button>
                 @endif
              </td>
						</tr>
					@endforeach					
                    </tbody>
                </table>
				{!! $items->render() !!}
			</div>
		</div>
	</div>
</div>

{{-- Show info modal --}}
@foreach($items as $item)
  <div class="modal fade" id="showinfoModal_{{$item->id}}" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-default modal-lg">
      <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title">@lang('app.txt.transaction_file') : {{$item->numero}}</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="ibox-content profile-content">
                {{-- information transaction --}}
                <h3><strong>Information</strong></h3>
                <hr>
                <h5>Numéro :</h5>
                <p>{{$item->numero}}</p>
                <h5>Produit :</h5>
                <p>{{ sizeOf(\App\Models\Product::whereId($item->product_id)->pluck('title'))!=0?\App\Models\Product::whereId($item->product_id)->pluck('title')[0]:'-' }}</p>
                <h5>Membre acheteur :</h5>
                <p>{{ sizeOf(\App\Models\User::whereId($item->user_id)->pluck('name'))!=0?\App\Models\User::whereId($item->user_id)->pluck('name')[0]:'-' }}</p>
                <h5>AFA :</h5>
                <p>{{ sizeOf(\App\Models\User::whereId($item->afa_id)->first()->userinfos())!=0?\App\Models\User::whereId($item->afa_id)->first()->userinfos->orga_name:'-' }}</p>
                <h5>Vendeur :</h5>
                <p>{{ sizeOf(\App\Models\User::whereId($item->vendeur_id)->first()->userinfos())!=0?\App\Models\User::whereId($item->vendeur_id)->first()->userinfos->orga_name:'-' }}</p>
                <h5>Cabinet vendeur :</h5>
                <p>{{ sizeOf(\App\Models\Solicitor::whereId($item->sollicitor_id)->pluck('cabinet_name'))!=0?\App\Models\Solicitor::whereId($item->sollicitor_id)->pluck('cabinet_name')[0]:'-' }}</p>
                <h5>Statut :</h5>
                <p>
                  @php
                    $member=App\Models\User::whereId($item->user_id)->first();
                    $prod=App\Models\Product::whereId($item->product_id)->first();
                    $status=$item->status;

                    if(!$prod->isReserved()){
                      if($member->isMove()){
                        if($status==0){
                          echo "<span class='badge badge-info'>".trans('app.txt.transaction_file_create')."</span>";
                        }elseif($status==1){
                          echo "<span class='badge badge-info'>".trans('app.txt.select_afa')."</span>";
                        }elseif($status==2){
                          echo "<span class='badge badge-info'>".trans('app.txt.afa_selectéd')."</span>";
                        }elseif($status==3){
                          echo "<span class='badge badge-info'>".trans('app.txt.submit_a_search_mandate')."</span>";
                        }elseif($status==4){
                          echo "<span class='badge badge-info'>".trans('app.txt.mr_send')."</span>";
                        }elseif($status==5){
                          echo "<span class='badge badge-info'>".trans('app.txt.awaiting_move_decision')."</span>";
                        }elseif($status==6){
                          echo "<span class='badge badge-info'>".trans('app.txt.waiting_for_the_move')."</span>";
                        }elseif($status==7){
                          echo "<span class='badge badge-info'>".trans('app.txt.complete_registration_file')."</span>";
                        }elseif($status==8){
                          echo "<span class='badge badge-info'>".trans('app.txt.purchase_confirmation')."</span>";
                        }elseif($status==9){
                          echo "<span class='badge badge-info'>".trans('app.txt.confirmed_purchase')."</span>";
                        }elseif($status==10){
                          echo "<span class='badge badge-info'>".trans('app.txt.eoi_finalized_sent')."</span>";
                        }elseif($status==11){
                          echo "<span class='badge badge-info'>".trans('app.txt.eoi_finalized_sent')."</span>";
                        }elseif($status==12){
                          echo "<span class='badge badge-info'>".trans('app.txt.make_initial_deposit')."</span>";
                        }elseif($status==13){
                          echo "<span class='badge badge-info'>".trans('app.txt.initial_deposit_made')."</span>";
                        }elseif($status==14){
                          echo "<span class='badge badge-info'>".trans('app.txt.payment_first_cpc_commission_made')."</span>";
                        }elseif($status==15){
                          if($prod->haveBonus()){
                            echo "<span class='badge badge-info'>".trans('app.txt.payment_second_cpc_commission_made')."</span>";
                          }else{
                            echo "<span class='badge badge-info'>".trans('app.txt.payment_last_cpc_commission_made')."</span>";
                          }
                        }elseif($status==16){
                          echo "<span class='badge badge-info'>".trans('app.txt.payment_bonus_cpc_made')."</span>";
                        }
                      }else{
                        if($status==0){
                          echo "<span class='badge badge-info'>".trans('app.txt.transaction_file_create')."</span>";
                        }elseif($status==1){
                          echo "<span class='badge badge-info'>".trans('app.txt.complete_registration_file')."</span>";
                        }elseif($status==2){
                          echo "<span class='badge badge-info'>".trans('app.txt.afa_selectéd')."</span>";
                        }elseif($status==3){
                          echo "<span class='badge badge-info'>".trans('app.txt.submit_a_search_mandate')."</span>";
                        }elseif($status==7){
                          echo "<span class='badge badge-info'>".trans('app.txt.mr_send')."</span>";
                        }elseif($status==8){
                          echo "<span class='badge badge-info'>".trans('app.txt.purchase_confirmation')."</span>";
                        }elseif($status==9){
                          echo "<span class='badge badge-info'>".trans('app.txt.confirmed_purchase')."</span>";
                        }elseif($status==10){
                          echo "<span class='badge badge-info'>".trans('app.txt.eoi_finalized_sent')."</span>";
                        }elseif($status==11){
                          echo "<span class='badge badge-info'>".trans('app.txt.eoi_finalized_sent')."</span>";
                        }elseif($status==12){
                          echo "<span class='badge badge-info'>".trans('app.txt.make_initial_deposit')."</span>";
                        }elseif($status==13){
                          echo "<span class='badge badge-info'>".trans('app.txt.initial_deposit_made')."</span>";
                        }elseif($status==14){
                          echo "<span class='badge badge-info'>".trans('app.txt.payment_first_cpc_commission_made')."</span>";
                        }elseif($status==15){
                          if($prod->haveBonus()){
                            echo "<span class='badge badge-info'>".trans('app.txt.payment_second_cpc_commission_made')."</span>";
                          }else{
                            echo "<span class='badge badge-info'>".trans('app.txt.payment_last_cpc_commission_made')."</span>";
                          }
                        }elseif($status==16){
                          echo "<span class='badge badge-info'>".trans('app.txt.payment_bonus_cpc_made')."</span>";
                        }
                      }
                    }else{
                      echo "<span class='badge badge-danger'>".trans('app.txt.product_already_reserved')."</span>";
                    }
                  @endphp
                </p><br>
                
                {{-- all file transaction --}}
                <h3><strong>@lang('app.txt.files')</strong></h3>
                <hr>
                <div class="row m-t-lg">
                  {{-- show conjunction agreement file --}}
                  @if ($item->ca_id != 0)
                    @php
                        $ca=App\Models\ConjunctionAgreement::whereId($item->ca_id)->first();
                        $ca_file_name=$ca->file_name;
                        $ca_path=asset($ca->path);
                        $ca_added=Carbon\Carbon::parse($ca->created_at)->format('M d, Y');
                    @endphp
                    <div class="col-md-4">
                      <div class="file-box">
                          <div class="file">
                              <a target="_blank" href="{{$ca_path}}">
                                  <span class="corner"></span>
                                  <div class="icon">
                                      <i class="fa fa-file"></i>
                                  </div>
                                  <div class="file-name">
                                      {{$ca_file_name}}
                                      <br>
                                      <small>@lang('app.txt.added'): {{$ca_added}}</small>
                                  </div>
                              </a>
                          </div>
                      </div>
                    </div>
                  @endif

                  {{-- show search mandat(form 6) file --}}
                  @if ($item->mr_id != 0)
                    @php
                        $mr=App\Models\MandatRecherche::whereId($item->ca_id)->first();
                        $mr_file_name=$mr->file_name;
                        $mr_path=asset('uploads/pdf/form6'.'/'.$mr_file_name);
                        $mr_added=Carbon\Carbon::parse($mr->created_at)->format('M d, Y');
                    @endphp
                    <div class="col-md-4">
                      <div class="file-box">
                          <div class="file">
                              <a target="_blank" href="{{$mr_path}}">
                                  <span class="corner"></span>
                                  <div class="icon">
                                      <i class="fa fa-file"></i>
                                  </div>
                                  <div class="file-name">
                                      {{$mr_file_name}}
                                      <br>
                                      <small>@lang('app.txt.added'): {{$mr_added}}</small>
                                  </div>
                              </a>
                          </div>
                      </div>
                    </div>
                  @endif

                  {{-- show mr finalize --}}
                  @if ($item->mr_finalize_file_name !== "")
                    @php
                        $mr_file_name=$item->mr_finalize_file_name;
                        $mr_path=asset('uploads/pdf/form6'.'/'.$mr_file_name);
                        $mr_added=Carbon\Carbon::parse($item->date_mr_finalize)->format('M d, Y');
                    @endphp
                    <div class="col-md-4">
                      <div class="file-box">
                          <div class="file">
                              <a target="_blank" href="{{$mr_path}}">
                                  <span class="corner"></span>
                                  <div class="icon">
                                      <i class="fa fa-file"></i>
                                  </div>
                                  <div class="file-name">
                                      {{$mr_file_name}}
                                      <br>
                                      <small>@lang('app.txt.added'): {{$mr_added}}</small>
                                  </div>
                              </a>
                          </div>
                      </div>
                    </div>
                  @endif

                  {{-- show oei finalize by member file --}}
                  @if ($item->eoi_finalize_file_name !== "")
                    @php
                        $eoi_file_name=$item->eoi_finalize_file_name;
                        $eoi_path=asset('uploads/pdf/transaction'.'/'.$eoi_file_name);
                        $eoi_added=Carbon\Carbon::parse($item->date_eoi_finalize)->format('M d, Y');
                    @endphp
                    <div class="col-md-4">
                      <div class="file-box">
                          <div class="file">
                              <a target="_blank" href="{{$eoi_path}}">
                                  <span class="corner"></span>
                                  <div class="icon">
                                      <i class="fa fa-file"></i>
                                  </div>
                                  <div class="file-name">
                                      {{$eoi_file_name}}
                                      <br>
                                      <small>@lang('app.txt.added'): {{$eoi_added}}</small>
                                  </div>
                              </a>
                          </div>
                      </div>
                    </div>
                  @endif

                  {{-- show oei finalize by afa file --}}
                  @if ($item->eoi_finalize_file_name_afa !== "")
                    @php
                        $eoi_file_name=$item->eoi_finalize_file_name_afa;
                        $eoi_path=asset('uploads/pdf/transaction'.'/'.$eoi_file_name);
                        $eoi_added=Carbon\Carbon::parse($item->date_eoi_finalize_afa)->format('M d, Y');
                    @endphp
                    <div class="col-md-4">
                      <div class="file-box">
                          <div class="file">
                              <a target="_blank" href="{{$eoi_path}}">
                                  <span class="corner"></span>
                                  <div class="icon">
                                      <i class="fa fa-file"></i>
                                  </div>
                                  <div class="file-name">
                                      {{$eoi_file_name}}
                                      <br>
                                      <small>@lang('app.txt.added'): {{$eoi_added}}</small>
                                  </div>
                              </a>
                          </div>
                      </div>
                    </div>
                  @endif
                </div>

                {{-- all invoice --}}
                <h3><strong>@lang('app.txt.invoices')</strong></h3>
                <hr>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.btn.close')</button>
          </div>
      </div>
    </div>
  </div>
@endforeach
{{-- !End Show info modal --}}

@endsection

@section('custom-script')
<style>
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: visible;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript"></script>
@endsection
