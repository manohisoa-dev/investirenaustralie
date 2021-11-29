@extends('layouts.backend')

@section('subcontent')


    @include('includes.alerts')
    <div class="profile-content-area m-40px-tb card card-body">
        <form action="{{route('profile.edit')}}" method="POST" enctype="multipart/form-data" id="form_profil">
            {{ csrf_field() }}
            <input type="hidden" name="role" value="{{ $item->role }}">
            <input type="hidden" name="userinfos_id" value="{{ $item->userinfos ? $item->userinfos->id : ''}}">
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h5>@lang('app.txt.logininfo') </h5>
                <div class="row">
                    {{-- MEMBRE --}}
                    @if ($item->hasRole(5))
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.typemembre')</div>
                                    <input type="text" name="type" id="type" class="form-control" value="{{$item->type_users_id?App\Models\TypeUser::find($item->type_users_id)->type_user_name:''}}" placeholder="{{trans('app.txt.noinfo')}}" readonly>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.login') </div>
                                <input type="text" class="form-control" value="{{$item->name}}" name="name" id="name" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.email') </div>
                                <input type="text" name="email" id="email" class="form-control" value="{{$item->email}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.langage') </div>
                                <select name="language" class="form-control" id="language">
                                    <option value="fr" {{$item->language=='fr'?'selected':''}}>@lang('app.txt.fr')</option>
                                    <option value="en" {{$item->language=='en'?'selected':''}}>@lang('app.txt.en')</option>
                                </select>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 m-10px-tb">
                        <div class="media">
                            <div class="media-body p-15px-l lh-normal p-40px-t">
                                <i class="fas fa-key"></i> <a style="color: #AE4435;" href="{{ route('password.edit') }}">@lang('app.txt.editpassword')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{---------------------------------------------------}}
            {{---------------  MEMBRE PARTICULIER ---------------}}
            {{---------------------------------------------------}}
            @if($item->hasRole(5) && $item->isPerson())
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h5>@lang('member.member_identity')</h5>
                <div class="row">
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.civility') </div>
                                <select class="form-control" name="civility" required>
                                    <option value="" selected disabled>@lang('app.txt.choose_civility')</option>
                                    <option value="mr" {{ $item->userinfos->civility=='mr'? 'selected' : '' }}>@lang('app.txt.mr')</option>
                                    <option value="mrs" {{ $item->userinfos->civility=='mrs'? 'selected' : '' }}>@lang('app.txt.mrs')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.nom') </div>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{$item->userinfos->last_name?$item->userinfos->last_name:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.prenom') </div>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{$item->userinfos->first_name?$item->userinfos->first_name:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.nationality') </div>
                                <input type="text" name="nationality" id="nationality" placeholder="@lang('app.txt.nationality')" class="form-control" value="{{isset($item->userinfos->nationality)?$item->userinfos->nationality:''}}" readonly>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.sexe') </div>
                                <select name="sexe" class="form-control" id="sexe" readonly>
                                    <option value="{{ $item->userinfos->sexe }}" selected>{{ $item->userinfos->sexe=='M'?trans('app.txt.male'):trans('app.txt.female') }}</option>
                                </select>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    @if ($item->isComplete())
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.date_of_birth') </div>
                                    <input type="text" class="form-control datepickerfrom" placeholder="MM/DD/YYYY" name="date_of_birth" value="{{ old('date_of_birth')?old('date_of_birth'):($item->userinfos?$item->userinfos->date_of_birth:'') }}" placeholder="{{trans('app.txt.noinfo')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-map-marker"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.place_of_birth') </div>
                                    <input type="text" class="form-control" placeholder="@lang('app.txt.place_of_birth')" name="place_of_birth" value="{{ old('place_of_birth')?old('place_of_birth'):($item->userinfos?$item->userinfos->place_of_birth:'') }}" placeholder="{{trans('app.txt.noinfo')}}">
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.country') </div>
                                <select class="form-control" name="country">
                                    @foreach(\App\Models\Country::all() as $country)
                                        <option value="{{$country->code}}" {{$country->code == $item->location->country ? "selected" : ""}}> {{ $country->content }} ({{$country->code}})</option>
                                    @endforeach
                                </select>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                {{---------------------------------------------------}}
                {{----------------------- AFA -----------------------}}
                {{---------------------------------------------------}}
                @if ($item->hasRole(3))
                    <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                        <h5>@lang('app.txt.businessdetail')</h5>
                        <div class="row">
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.type_of_business') </div>
                                        <select name="type" class="form-control" id="type">
                                            <option value="10" {{$item->TypeUser->type_user_name=='Real Estate Agency'?'selected':''}}>@lang('app.txt.real_estate_agency')</option>
                                            <option value="11" {{$item->TypeUser->type_user_name=='Business Broker'?'selected':''}}>@lang('app.txt.business_broker')</option>
                                        </select>
                                        <span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessname') </div>
                                        <input type="text" class="form-control" placeholder="@lang('app.txt.businessname')" name="orga_name" id="orga_name" value="{{ old('orga_name')?old('orga_name'):($item->userinfos ?$item->userinfos->orga_name:'')}}" readonly>
                                        <span class="text-danger">{{ $errors->first('orga_name') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businesstradingname') </div>
                                        <input type="text" class="form-control" placeholder="@lang('app.txt.businesstradingname')" name="orga_trading_name" id="orga_trading_name" value="{{ old('orga_trading_name')?old('orga_trading_name'):($item->userinfos ?$item->userinfos->orga_trading_name:'')}}" readonly>
                                        <span class="text-danger">{{ $errors->first('orga_trading_name') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.business_abn') </div>
                                        <input type="text" minlength="11" maxlength="11" pattern="[0-9]{1}[0-9]{10}" class="form-control" id="orga_abn" name="orga_abn" placeholder="@lang('app.txt.abn_number')" value="{{ old('orga_abn')?old('orga_abn'):($item->userinfos ?$item->userinfos->orga_abn:'') }}" readonly>
                                        <span class="text-danger">{{ $errors->first('orga_abn') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.business_acn') </div>
                                        <input type="text" minlength="9" maxlength="9" pattern="[0-9]{1}[0-9]{8}" class="form-control" id="orga_acn" name="orga_acn" placeholder="@lang('app.txt.acn_number')" value="{{ old('orga_acn')?old('orga_acn'):($item->userinfos ?$item->userinfos->orga_acn:'') }}" readonly>
                                        <span class="text-danger">{{ $errors->first('orga_acn') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.real_estate_agent_licence_number') </div>
                                        <input type="text" minlength="7" maxlength="7" pattern="[0-9]{1}[0-9]{6}" class="form-control" id="orga_license_number" name="orga_license_number" placeholder="@lang('app.txt.real_estate_agent_licence_number')" value="{{ old('orga_license_number')?old('orga_license_number'):($item->userinfos ?$item->userinfos->orga_license_number:'') }}">
                                        <span class="text-danger">{{ $errors->first('orga_license_number') }}</span>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessemail') </div>
                                        <input type="email" class="form-control" placeholder="email@iea.com" name="orga_email" id="orga_email" value="{{ old('orga_email')?old('orga_email'):($item->userinfos ?$item->userinfos->orga_email:'')}}">
                                        <span class="text-danger">{{ $errors->first('orga_email') }}</span>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessphone')</div>
                                        <div class="input-group mb-3 col-sm-12">
                                            <div class="input-group-prepend">
                                                <select class="form-control" name="indicatif" id="indicatif">
                                                    @if (isset($item->userinfos->orga_phone) && $item->userinfos->orga_phone)
                                                        @php
                                                            $codetamps = preg_match('#\((.*?)\)#', $item->userinfos->orga_phone, $match);
                                                            $code = $match[1];
                                                            $num = $item->userinfos?explode(')',$item->userinfos->orga_phone)[1]:'';
                                                        @endphp
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code==$code?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                        @endforeach
                                                    @else
                                                        @php
                                                            $num="";
                                                        @endphp
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="custom-file">
                                                <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="9" maxlength="9" placeholder="@lang('app.txt.businessphone')" class="form-control m-15px-t" id="orga_phone" name="orga_phone" value="{{ old('orga_phone')?old('orga_phone'):($num) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessfax') </div>
                                        <input type="text" class="form-control" pattern="[0-9]{1}[0-9]{7|14}" minlength="6" maxlength="9" placeholder="@lang('app.txt.businessfax')" name="orga_fax" id="orga_fax" value="{{ old('orga_fax')?old('orga_fax'):($item->userinfos ?$item->userinfos->orga_fax:'')}}">
                                        <span class="text-danger">{{ $errors->first('orga_fax') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessmobile')</div>
                                        <div class="input-group mb-3 col-sm-12">
                                            <div class="input-group-prepend">
                                                <select class="form-control" name="indicatif3" id="indicatif3">
                                                    @if (isset($item->userinfos->orga_mobile_phone) && $item->userinfos->orga_mobile_phone)
                                                        @php
                                                            $codetamps = preg_match('#\((.*?)\)#', $item->userinfos->orga_mobile_phone, $match);
                                                            $code = $match[1];
                                                            $num = $item->userinfos?explode(')',$item->userinfos->orga_mobile_phone)[1]:'';
                                                        @endphp
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code==$code?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                        @endforeach
                                                    @else
                                                        @php
                                                            $num="";
                                                        @endphp
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="custom-file">
                                                <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="9" maxlength="9" placeholder="@lang('app.txt.businessphone')" class="form-control m-15px-t" id="orga_mobile_phone" name="orga_mobile_phone" value="{{ old('orga_mobile_phone')?old('orga_mobile_phone'):($num) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.websiteurl') </div>
                                        <input type="text" class="form-control" placeholder="@lang('app.txt.websiteurl')" name="orga_website" id="orga_website" value="{{ old('orga_website')?old('orga_website'):($item->userinfos ?$item->userinfos->orga_website:'')}}">
                                        <span class="text-danger">{{ $errors->first('orga_website') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-item"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businesspresentation')</div>
                                        <textarea class="form-control" placeholder="@lang('app.txt.businesspresentation')" name="orga_presentation" id="orga_presentation" cols="30" rows="5">{{old('orga_presentation')?old('orga_presentation'):($item->userinfos ?$item->userinfos->orga_presentation:'')}}</textarea>
                                        <span class="text-danger">{{ $errors->first('orga_presentation') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="form-group">
                                    <label for="orga_operation_state" class="col-sm-12 control-label dark-color m-5px-b font-w-600"><i class="fas fa-building only-icon-20"></i> @lang('app.txt.stateoflegaloperation') *</label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectpicker col-md-12" multiple data-live-search="true" name="orga_operation_state[]" required>
                                            @if (isset($item->userinfos->orga_operation_state))
                                                @foreach(App\Models\State::all() as $state)
                                                    @foreach (unserialize($item->userinfos->orga_operation_state) as $orgOpState)
                                                        @if ($orgOpState==$state->content)
                                                            <option value="{{$state->content}}" {{ $orgOpState==$state->content?'selected':'' }}> {{$state->content}} </option>
                                                        @endif
                                                    @endforeach
                                                    @if (!$loop->first && $orgOpState !== $state->content)
                                                        <option value="{{$state->content}}"> {{$state->content}} </option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="{{$state->content}}" {{ old('orga_operation_state')==$state->content?'selected':'' }}> {{$state->content}} </option>
                                            @endif
                                        </select>
                                        <span class="text-danger">{{ $errors->first('orga_operation_state') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.rangeofoperation')</div>
                                        <select class="form-control" name="orga_operation_range" id="orga_operation_range">
                                            <option value="5" {{ $item->userinfos?$item->userinfos->orga_operation_range:'5'=='5'?'selected':'' }}> 5 Km</option>
                                            <option value="10" {{ $item->userinfos?$item->userinfos->orga_operation_range:''=='10'?'selected':'' }}> 10 Km</option>
                                            <option value="25" {{ $item->userinfos?$item->userinfos->orga_operation_range:''=='25'?'selected':'' }}> 25 Km</option>
                                            <option value="50" {{ $item->userinfos?$item->userinfos->orga_operation_range:''=='50'?'selected':'' }}> 50 Km</option>
                                            <option value="100" {{ $item->userinfos?$item->userinfos->orga_operation_range:''=='100'?'selected':'' }}> 100 Km</option>
                                            <option value="250" {{ $item->userinfos?$item->userinfos->orga_operation_range:''=='250'?'selected':'' }}> 250 Km</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->first('orga_operation_range') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Office Address --}}
                    <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                        <h5>@lang('app.txt.office_address')</h5>
                        <div class="row">
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-city"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.name_building') </div>
                                        <input type="text" name="building_name" placeholder="@lang('app.txt.name_building')" class="form-control" value="{{$item->location?$item->location->building_name:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-road"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.name_of_the_road') </div>
                                        <input type="text" name="route" id="route" value="{{$item->location?$item->location->route:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
										<input type="hidden" value="{{$item->location?$item->location->longitude:''}}" name="afa_long" id="afa_long">
                                        <input type="hidden" value="{{$item->location?$item->location->latitude:''}}" name="afa_lat" id="afa_lat">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.number_of_the_road')</div>
                                        <input type="text" name="afa_route_number" id="afa_route_number" value="{{$item->location?$item->location->route_number:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.number_of_rooms')</div>
                                        <input type="text" name="num_rooms" placeholder="@lang('app.txt.number_of_rooms')" value="{{$item->location?$item->location->num_rooms:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.level')</div>
                                        <input type="text" name="num_floor" placeholder="@lang('app.txt.floor')" value="{{$item->location?$item->location->num_floor:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.suburb')</div>
                                        <input type="text" name="afa_locality" id="afa_locality" value="{{$item->location?$item->location->locality:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.city')</div>
                                        <input type="text" name="afa_area_level_2" id="afa_area_level_2" value="{{$item->location?$item->location->area_level_2:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                        <input type="text" name="afa_postalCode" id="afa_postalCode" value="{{$item->location?$item->location->postalCode:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat')</div>
                                        <select id="afa_area_level_1" class="form-control" name="afa_area_level_1">
                                            <option selected disabled>@lang('app.select_state')</option>
                                            @foreach(App\Models\State::all() as $state)
                                                <option value="{{ $state->content }}" {{ $item->location && ($item->location->area_level_1 == $state->content) ? 'selected' : '' }}>{{ trans('app.txt.'.$state->content) }} ({{ $state->content }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                        <select class="form-control" name="afa_country" id="afa_country">
                                            <option value="AUS" {{ $item->location->country=='AUS'?'selected':'' }}> @lang('app.txt.aus') (AUS)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Postal Address --}}
                    <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                        <h5>@lang('app.txt.postal_address')</h5>
                        <div class="row">
                            @if (isset($item->location) && $item->location->adrpost_postal_box=='')
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        @lang('app.txt.as_above')
                                    </div>
                                </div>
                            @else
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-city"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.postal_box') </div>
                                            <input type="text" name="adrpost_postal_box" placeholder="@lang('app.txt.postal_box')" class="form-control" value="{{$item->location?$item->location->adrpost_postal_box:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-city"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.suburb') </div>
                                            <input type="text" name="adrpost_locality" placeholder="@lang('app.txt.suburb')" class="form-control" value="{{$item->location?$item->location->adrpost_locality:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                            <input type="text" name="adrpost_postalCode" value="{{$item->location?$item->location->adrpost_postalCode:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat')</div>
                                            <select id="administrative_area_level_1" class="form-control" name="adrpost_area_level_1">
                                                <option selected disabled>@lang('app.select_state')</option>
                                                @foreach (App\Models\State::all() as $state)
                                                    <option value="{{ $state->content }}" {{ $item->location?$item->location->adrpost_area_level_1:''==$state->content?'selected':'' }}>{{ trans('app.txt.'.$state->content) }} ({{ $state->content }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                            <select class="form-control" name="adrpost_country">
                                                <option value="AUS" {{ $item->location->adrpost_country=='AUS'?'selected':'' }}> @lang('app.txt.aus') (AUS)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                {{-- END AFA ---}}

                {{---------------------------------------------------}}
                {{----------------------- APL -----------------------}}
                {{---------------------------------------------------}}
                @if ($item->hasRole(4))
                    <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                        <h5>@lang('app.txt.agencydetail')</h5>
                        <div class="row">
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.agencyname') </div>
                                        <input type="text" class="form-control" placeholder="@lang('app.txt.agencyname')" name="orga_name" id="orga_name" value="{{ old('orga_name')?old('orga_name'):($item->userinfos ?$item->userinfos->orga_name:'')}}" readonly>
                                        <span class="text-danger">{{ $errors->first('orga_name') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.organizationregistrationnumber') </div>
                                        <input type="text" class="form-control" name="orga_registration_number" id="orga_registration_number" placeholder="@lang('app.txt.agencyregistrationnumber')" value="{{ old('orga_registration_number')?old('orga_registration_number'):(isset($item->userinfos->orga_registration_number)?$item->userinfos->orga_registration_number:'') }}" readonly>
                                        <span class="text-danger">{{ $errors->first('orga_registration_number') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.organizationrepregistrationofficial') </div>
                                        <input type="text" class="form-control" name="orga_rep_official_registration" id="orga_rep_official_registration" placeholder="@lang('app.txt.organizationrepregistrationofficial')" value="{{ old('orga_rep_official_registration')?old('orga_rep_official_registration'):(isset($item->userinfos->orga_rep_official_registration)?$item->userinfos->orga_rep_official_registration:'') }}" readonly>
                                        <span class="text-danger">{{ $errors->first('orga_rep_official_registration') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.type_of_company')</div>
                                        @if($item->userinfos)
                                            @php
                                                $orga_type = $item->userinfos->orga_type;
                                                if($orga_type === 'individual')
                                                    $orga_type = trans('app.txt.individual');
                                                if($orga_type === 'society')
                                                    $orga_type = trans('app.txt.society');
                                            @endphp
                                        @else
                                            @php
                                                $orga_type = '';
                                            @endphp
                                        @endif
                                        <input type="text" class="form-control" placeholder="@lang('app.txt.type_of_company')" value="{{ old('orga_type')?old('orga_type'):$orga_type}}" readonly>
                                        <span class="text-danger">{{ $errors->first('orga_type') }}</span>
                                    </div>
                                </div>
                            </div>
                            @if ($item->userinfos->orga_type=='society')
                                <div class="col-md-6 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.company_form')</div>
                                            @if($item->userinfos)
                                                @php
                                                    $orga_form = $item->userinfos->orga_form;
                                                    if($orga_form === 'sarl')
                                                        $orga_form = 'SARL';
                                                    elseif($orga_form === 'sa')
                                                        $orga_form = 'SA';
                                                    else
                                                        $orga_form = strtoupper($orga_form);
                                                @endphp
                                            @else
                                                @php
                                                    $orga_form = '';
                                                @endphp
                                            @endif
                                            <input type="text" class="form-control" name="orga_form" placeholder="@lang('app.txt.company_form')" value="{{ old('orga_form')?old('orga_form'):$orga_form}}" readonly>
                                            <span class="text-danger">{{ $errors->first('orga_form') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.professional_license_number_of_apl')</div>
                                        <input type="text" class="form-control" name="orga_license_number" placeholder="@lang('app.txt.professional_license_number_of_apl')" value="{{ old('orga_license_number')?old('orga_license_number'):($item->userinfos ?$item->userinfos->orga_license_number:'')}}">
                                        <span class="text-danger">{{ $errors->first('orga_license_number') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-item"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.agencypresentation')</div>
                                        <textarea class="form-control" placeholder="@lang('app.txt.agencypresentation')" name="orga_presentation" id="orga_presentation" cols="30" rows="5">{{old('orga_presentation')?old('orga_presentation'):($item->userinfos ?$item->userinfos->orga_presentation:'')}}</textarea>
                                        <span class="text-danger">{{ $errors->first('orga_presentation') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.scope_of_intervention_around_establishment')</div>
                                        <select class="form-control" name="orga_operation_range" id="orga_operation_range">
                                            <option value="5" {{ $item->userinfos?$item->userinfos->orga_operation_range:'5'=='5'?'selected':'' }}> 5 Km</option>
                                            <option value="10" {{ $item->userinfos?$item->userinfos->orga_operation_range:''=='10'?'selected':'' }}> 10 Km</option>
                                            <option value="25" {{ $item->userinfos?$item->userinfos->orga_operation_range:''=='25'?'selected':'' }}> 25 Km</option>
                                            <option value="50" {{ $item->userinfos?$item->userinfos->orga_operation_range:''=='50'?'selected':'' }}> 50 Km</option>
                                            <option value="100" {{ $item->userinfos?$item->userinfos->orga_operation_range:''=='100'?'selected':'' }}> 100 Km</option>
                                            <option value="250" {{ $item->userinfos?$item->userinfos->orga_operation_range:''=='250'?'selected':'' }}> 250 Km</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->first('orga_operation_range') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Physical address --}}
                    <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                        <h5>@lang('app.txt.physical_address')</h5>
                        <div class="row">
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-city"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.name_building') </div>
                                        <input type="text" name="building_name" placeholder="@lang('app.txt.name_building')" class="form-control" value="{{$item->location?$item->location->building_name:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-road"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.name_of_the_road') </div>
                                        <input type="text" name="route" id="apl_route" value="{{$item->location?$item->location->route:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
										<input type="hidden" name="apl_lat" id="apl_lat" value="{{$item->location?$item->location->latitude:''}}" />
										<input type="hidden" name="apl_long" id="apl_long" value="{{$item->location?$item->location->longitude:''}}" />
										<input type="hidden" name="apl_suburb" id="apl_suburb" value="{{$item->location?$item->location->area_level_2:''}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.number_of_the_road')</div>
                                        <input type="text" name="route_number" id="apl_route_number" value="{{$item->location?$item->location->route_number:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.number_of_rooms')</div>
                                        <input type="text" name="num_rooms" placeholder="@lang('app.txt.number_of_rooms')" value="{{$item->location?$item->location->num_rooms:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.floor')</div>
                                        <input type="text" name="num_floor" placeholder="@lang('app.txt.floor')" value="{{$item->location?$item->location->num_floor:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.neighborhood_district_borough')</div>
                                        <input type="text" name="neighborhood" value="{{$item->location?$item->location->neighborhood:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.city')</div>
                                        <input type="text" name="locality" id="apl_locality" value="{{$item->location?$item->location->locality:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                        <input type="text" name="postalCode" id="apl_postalCode" value="{{$item->location?$item->location->postalCode:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</div>
                                        <input type="text" name="area_level_1" id="apl_state" placeholder="@lang('app.txt.etat')" value="{{$item->location?$item->location->area_level_1:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                        <select class="form-control" name="country" id="apl_country">
                                            <option value="" selected disabled>@lang('app.select_country')</option>
                                            @foreach(App\Models\Country::all() as $country)
                                                @if($country->prefixPhone)
                                                    <option value="{{$country->code}}" long="{{$country->content}}" {{ $item->location->country==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Postal Address --}}
                    <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                        <h5>@lang('app.txt.postal_address')</h5>
                        <div class="row">
                            @if (isset($item->location) && $item->location->adrpost_postal_box=='')
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        @lang('app.txt.as_above')
                                    </div>
                                </div>
                            @else
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-city"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.postal_box') </div>
                                            <input type="text" name="adrpost_postal_box" placeholder="@lang('app.txt.postal_box')" class="form-control" value="{{$item->location?$item->location->adrpost_postal_box:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-road"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.city') </div>
                                            <input type="text" name="adrpost_locality" value="{{$item->location?$item->location->adrpost_locality:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                            <input type="text" name="adrpost_postalCode" value="{{$item->location?$item->location->adrpost_postalCode:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</div>
                                            <input type="text" name="adrpost_area_level_1" placeholder="@lang('app.txt.etat')" value="{{$item->location?$item->location->adrpost_area_level_1:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                            <select class="form-control" name="adrpost_country">
                                                <option value="" selected disabled>@lang('app.select_country')</option>
                                                @foreach(App\Models\Country::all() as $country)
                                                    @if($country->prefixPhone)
                                                        <option value="{{$country->code}}" {{ $item->location->adrpost_country==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                {{--- END APL --}}

                {{---------------------------------------------------}}
                {{----------------------- SELLER---------------------}}
                {{---------------------------------------------------}}
                @if ($item->hasRole(2))
                    {{-- Real Estate Professionals AND Non-profesionnal Legal Persons  --}}
                    @if($item->TypeUser->type_user_name=='Builder' || $item->TypeUser->type_user_name=='Developer' || $item->TypeUser->type_user_name=='Organization')
                        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                            <h5>@lang('app.txt.businessdetail')</h5>
                            <div class="row">
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-globe"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.type_of_business') </div>
                                            <input type="text" class="form-control" placeholder="@lang('app.txt.type_of_business')" name="type" id="type" value="{{ old('type')?old('type'):($item->TypeUser ?$item->TypeUser->type_user_name:'')}}" readonly>
                                            {{-- <select name="type" class="form-control" id="type">
                                                <option value="Builder" {{$item->TypeUser->type_user_name=='Builder'?'selected':''}}>@lang('app.txt.builder')</option>
                                                <option value="Developer" {{$item->TypeUser->type_user_name=='Developer'?'selected':''}}>@lang('app.txt.developer')</option>
                                            </select> --}}
                                            <span></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessname') </div>
                                            <input type="text" class="form-control" placeholder="@lang('app.txt.businessname')" name="orga_name" id="orga_name" value="{{ old('orga_name')?old('orga_name'):($item->userinfos ?$item->userinfos->orga_name:'')}}" readonly>
                                            <span class="text-danger">{{ $errors->first('orga_name') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businesstradingname') </div>
                                            <input type="text" class="form-control" placeholder="@lang('app.txt.businesstradingname')" name="orga_trading_name" id="orga_trading_name" value="{{ old('orga_trading_name')?old('orga_trading_name'):($item->userinfos ?$item->userinfos->orga_trading_name:'')}}" readonly>
                                            <span class="text-danger">{{ $errors->first('orga_trading_name') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.business_abn') </div>
                                            <input type="text" minlength="11" maxlength="11" pattern="[0-9]{1}[0-9]{10}" class="form-control" id="orga_abn" name="orga_abn" placeholder="@lang('app.txt.abn_number')" value="{{ old('orga_abn')?old('orga_abn'):($item->userinfos ?$item->userinfos->orga_abn:'') }}" readonly>
                                            <span class="text-danger">{{ $errors->first('orga_abn') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.business_acn') </div>
                                            <input type="text" minlength="9" maxlength="9" pattern="[0-9]{1}[0-9]{8}" class="form-control" id="orga_acn" name="orga_acn" placeholder="@lang('app.txt.acn_number')" value="{{ old('orga_acn')?old('orga_acn'):($item->userinfos ?$item->userinfos->orga_acn:'') }}" readonly>
                                            <span class="text-danger">{{ $errors->first('orga_acn') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if (isset($item->userinfos->orga_parent_name) && $item->userinfos->orga_parent_name)
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessparentname') </div>
                                                <input type="text" class="form-control" placeholder="@lang('app.txt.businessparentname')" name="orga_parent_name" id="orga_parent_name" value="{{ old('orga_parent_name')?old('orga_parent_name'):($item->userinfos ?$item->userinfos->orga_parent_name:'')}}" readonly>
                                                <span class="text-danger">{{ $errors->first('orga_parent_name') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- <div class="col-md-6 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessemail') </div>
                                            <input type="email" class="form-control" placeholder="email@iea.com" name="orga_email" id="orga_email" value="{{ old('orga_email')?old('orga_email'):($item->userinfos ?$item->userinfos->orga_email:'')}}">
                                            <span class="text-danger">{{ $errors->first('orga_email') }}</span>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-6 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessphone')</div>
                                            <div class="input-group mb-3 col-sm-12">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif" id="indicatif">
                                                        @if (isset($item->userinfos->orga_phone) && $item->userinfos->orga_phone)
                                                            @php
                                                                $codetamps = preg_match('#\((.*?)\)#', $item->userinfos->orga_phone, $match);
                                                                $code = $match[1];
                                                                $allCode = $match[0];
                                                                $num = $item->userinfos?explode(')',$item->userinfos->orga_phone)[1]:'';
                                                            @endphp
                                                            @foreach (App\Models\Indicatif::all() as $indicatif)
                                                                <option value="+{{ $indicatif->code }}" {{ $indicatif->code==$code?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                            @endforeach
                                                        @else
                                                            @php
                                                                $num="";
                                                            @endphp
                                                            @foreach (App\Models\Indicatif::all() as $indicatif)
                                                                <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|14}" minlength="9" maxlength="9" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="orga_phone" name="orga_phone" value="{{ old('orga_phone')?old('orga_phone'):($num) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessfax') </div>
                                            <input type="text" class="form-control" placeholder="@lang('app.txt.businessfax')" name="orga_fax" id="orga_fax" value="{{ old('orga_fax')?old('orga_fax'):($item->userinfos ?$item->userinfos->orga_fax:'')}}">
                                            <span class="text-danger">{{ $errors->first('orga_fax') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessmobile')</div>
                                            <div class="input-group mb-3 col-sm-12">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif3" id="indicatif3">
                                                        @if (isset($item->userinfos->orga_mobile_phone) && $item->userinfos->orga_mobile_phone)
                                                            @php
                                                                $codetamps = preg_match('#\((.*?)\)#', $item->userinfos->orga_mobile_phone, $match);
                                                                $code = $match[1];
                                                                $num = $item->userinfos?explode(')',$item->userinfos->orga_mobile_phone)[1]:'';
                                                            @endphp
                                                            @foreach (App\Models\Indicatif::all() as $indicatif)
                                                                <option value="+{{ $indicatif->code }}" {{ $indicatif->code==$code?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                            @endforeach
                                                        @else
                                                            @php
                                                                $num="";
                                                            @endphp
                                                            @foreach (App\Models\Indicatif::all() as $indicatif)
                                                                <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="9" maxlength="9" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="orga_mobile_phone" name="orga_mobile_phone" value="{{ old('orga_mobile_phone')?old('orga_mobile_phone'):($num) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.websiteurl') </div>
                                            <input type="text" class="form-control" placeholder="@lang('app.txt.websiteurl')" name="orga_website" id="orga_website" value="{{ old('orga_website')?old('orga_website'):($item->userinfos ?$item->userinfos->orga_website:'')}}">
                                            <span class="text-danger">{{ $errors->first('orga_website') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-item"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businesspresentation')</div>
                                            <textarea class="form-control" placeholder="@lang('app.txt.businesspresentation')" name="orga_presentation" id="orga_presentation" cols="30" rows="5">{{old('orga_presentation')?old('orga_presentation'):($item->userinfos ?$item->userinfos->orga_presentation:'')}}</textarea>
                                            <span class="text-danger">{{ $errors->first('orga_presentation') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Office Address --}}
                        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                            <h5>@lang('app.txt.office_address')</h5>
                            <div class="row">
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-city"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.name_building') </div>
                                            <input type="text" name="building_name" placeholder="@lang('app.txt.name_building')" class="form-control" value="{{$item->location?$item->location->building_name:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-road"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.name_of_the_road') </div>
                                            <input type="text" name="route" id="route" value="{{$item->location?$item->location->route:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
											<input type="hidden" name="seller_long" id="seller_long" value="{{$item->location?$item->location->longitude:''}}" />
											<input type="hidden" name="seller_lat" id="seller_lat" value="{{$item->location?$item->location->latitude:''}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.number_of_the_road')</div>
                                            <input type="text" name="route_number" id="route_number" value="{{$item->location?$item->location->route_number:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.number_of_rooms')</div>
                                            <input type="text" name="num_rooms" placeholder="@lang('app.txt.number_of_rooms')" value="{{$item->location?$item->location->num_rooms:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.level')</div>
                                            <input type="text" name="num_floor" placeholder="@lang('app.txt.floor')" value="{{$item->location?$item->location->num_floor:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.suburb')</div>
                                            <input type="text" name="locality" id="seller_locality" value="{{$item->location?$item->location->locality:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.city')</div>
                                            <input type="text" name="area_level_2" id="seller_city" value="{{$item->location?$item->location->area_level_2:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                            <input type="text" name="postalCode" id="seller_cp" value="{{$item->location?$item->location->postalCode:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat')</div>
                                            <select id="administrative_area_level_1" class="form-control" name="area_level_1" id="seller_state">
                                                <option selected disabled>@lang('app.select_state')</option>
                                                
                                                @foreach(App\Models\State::all() as $state)
                                                    {{($state->content)}}
                                                    <option value="{{ $state->content }}" {{ ($item->location?$item->location->area_level_1:'ACT')==$state->content?'selected':'' }}>{{ trans('app.txt.'.$state->content) }} ({{ $state->content }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                            <select class="form-control" name="country">
                                                <option value="AUS" {{ $item->location->country=='AUS'?'selected':'' }}> @lang('app.txt.aus') (AUS)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Postal Address --}}
                        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                            <h5>@lang('app.txt.postal_address')</h5>
                            <div class="row">
                                @if (isset($item->location) && $item->location->adrpost_postal_box=='')
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            @lang('app.txt.as_above')
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-city"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.postal_box') </div>
                                                <input type="text" name="adrpost_postal_box" placeholder="@lang('app.txt.postal_box')" class="form-control" value="{{$item->location?$item->location->adrpost_postal_box:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-city"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.suburb') </div>
                                                <input type="text" name="adrpost_locality" placeholder="@lang('app.txt.suburb')" class="form-control" value="{{$item->location?$item->location->adrpost_locality:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                                <input type="text" name="adrpost_postalCode" value="{{$item->location?$item->location->adrpost_postalCode:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-flag"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat')</div>
                                                <select id="administrative_area_level_1" class="form-control" name="adrpost_area_level_1">
                                                    <option selected disabled>@lang('app.select_state')</option>
                                                    @foreach (App\Models\State::all() as $state)
                                                        <option value="{{ $state->content }}" {{ $item->location?$item->location->adrpost_area_level_1:''==$state->content?'selected':'' }}>{{ trans('app.txt.'.$state->content) }} ({{ $state->content }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-info"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                                <select class="form-control" name="adrpost_country">
                                                    <option value="AUS" {{ $item->location->adrpost_country=='AUS'?'selected':'' }}> @lang('app.txt.aus') (AUS)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    {{-- Non-profesionnal Natural Persons --}}
                    @if($item->isSnp())
                        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                            <h3>@lang('app.txt.seller_details')</h3>
                            @foreach ($item->sellerIndividual() as $key=>$snp)
                                @php
                                    $tot = $key+1;
                                    $sfx = $key!==0?'_'.$tot:'';
                                @endphp
                                @if($loop->last) <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b"></div> @endif
                                <p class="m-15px-t"><b>Seller #{{$key+1}}</b></p>
                                <div class="row">
                                    <input type="hidden" name="id_seller{{$sfx}}" value="{{ $snp->id }}">
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.nom') </div>
                                                <input type="text" class="form-control" id="last_name{{$sfx}}" name="last_name{{$sfx}}" value="{{old('last_name'.$sfx)?old('last_name'.$sfx):$snp->last_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.prenom') </div>
                                                <input type="text" class="form-control" name="first_name{{$sfx}}" id="first_name{{$sfx}}" value="{{old('first_name'.$sfx)?old('first_name'.$sfx):$snp->first_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.date_of_birth') </div>
                                                <input type="text" class="form-control datepickerfrom" placeholder="MM/DD/YYYY" name="date_of_birth{{$sfx}}" value="{{ old('date_of_birth'.$sfx)?old('date_of_birth'.$sfx):($snp->date_of_birth!=='0000-00-00'?$snp->date_of_birth:'') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-map-marker"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.place_of_birth') </div>
                                                <input type="text" class="form-control" placeholder="@lang('app.txt.place_of_birth')" name="place_of_birth{{$sfx}}" value="{{ old('place_of_birth'.$sfx)?old('place_of_birth'.$sfx):$snp->place_of_birth }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-globe"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.nationality') </div>
                                                <input type="text" name="nationality{{$sfx}}" id="nationality{{$sfx}}" placeholder="@lang('app.txt.nationality')" class="form-control" value="{{old('nationality'.$sfx)?old('nationality'.$sfx):$snp->nationality}}">
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-road"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.streetaddress') </div>
                                                <input type="text" name="street_adr{{$sfx}}" id="snp_personne_street{{$sfx}}" value="{{old('street_adr'.$sfx)?old('street_adr'.$sfx):$snp->street_adr}}" class="form-control">
												
												<input type="hidden" name="snp_personne_long{{$sfx}}" id="snp_personne_long" value="{{$item->location?$item->location->longitude:''}}" />
												<input type="hidden" name="snp_personne_lat{{$sfx}}" id="snp_personne_lat" value="{{$item->location?$item->location->latitude:''}}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-info"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.suburb')</div>
                                                <input type="text" name="suburb{{$sfx}}" id="snp_personne_suburb{{$sfx}}" value="{{old('suburb'.$sfx)?old('suburb'.$sfx):$snp->suburb}}" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-info"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.city')</div>
                                                <input type="text" name="city{{$sfx}}" id="snp_personne_city{{$sfx}}" value="{{old('city'.$sfx)?old('city'.$sfx):$snp->city}}" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                                <input type="text" name="post_code{{$sfx}}" id="snp_personne_cp{{$sfx}}" value="{{old('post_code'.$sfx)?old('post_code'.$sfx):$snp->post_code}}" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-flag"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat')</div>
                                                <input type="text" name="state{{$sfx}}" id="snp_personne_state{{$sfx}}" value="{{old('state'.$sfx)?old('state'.$sfx):$snp->state}}" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-info"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                                <select class="form-control" name="country{{$sfx}}" id="snp_personne_country{{$sfx}}">
                                                    <option value="" selected disabled>@lang('app.select_country')</option>
                                                    @foreach(App\Models\Country::all() as $country)
                                                        @if($country->prefixPhone)
                                                            <option value="{{$country->code}}" long="{{$country->content}}" {{ $snp->country==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.orga.fix_phone')</div>
                                                <div class="input-group mb-3 col-sm-12">
                                                    <div class="input-group-prepend">
                                                        <select class="form-control" name="indicatif{{$sfx}}" id="indicatif{{$sfx}}">
                                                            @if (isset($snp->phone) && $snp->phone)
                                                                @php
                                                                    $codetamps = preg_match('#\((.*?)\)#', $snp->phone, $match);
                                                                    $code = $match[1];
                                                                    $num = $snp->phone?explode(')',$snp->phone)[1]:'';
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $num = "";
                                                                @endphp
                                                            @endif
                                                            <option value="+61">(+61)</option>
                                                        </select>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="text" pattern="[0-9]{1}[0-9]{7|14}" minlength="6" maxlength="9" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="phone{{$sfx}}" name="phone{{$sfx}}" value="{{ old('phone'.$sfx)?old('phone'.$sfx):($num) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.mobile_seller',['num'=>$tot])</div>
                                                <div class="input-group mb-3 col-sm-12">
                                                    <div class="input-group-prepend">
                                                        <select class="form-control" name="indicatif3{{$sfx}}" id="indicatif3{{$sfx}}">
                                                            @if (isset($snp->phone) && $snp->mobile)
                                                                @php
                                                                    $codetamps = preg_match('#\((.*?)\)#', $snp->mobile, $match);
                                                                    $code = isset($match) && count($match) > 1 ? $match[1] : '';

                                                                    $snpSuffixe = explode(')',$snp->mobile) ;
                                                                    $num = $snp->phone && count($snpSuffixe) > 1 ? $snpSuffixe[1] : '';
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $num = "";
                                                                @endphp
                                                            @endif
                                                            <option value="+61">(+61)</option>
                                                        </select>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="text" pattern="[0-9]{1}[0-9]{7|14}" minlength="6" maxlength="9" placeholder="@lang('app.txt.mobile_seller',['num'=>$tot])" class="form-control m-15px-t" id="mobile{{$sfx}}" name="mobile{{$sfx}}" value="{{ old('mobile'.$sfx)?old('mobile'.$sfx):($num) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.email') </div>
                                                <input type="email" class="form-control" placeholder="email@iea.com" name="email_adr{{$sfx}}" id="email_adr{{$sfx}}" value="{{ old('email_adr'.$sfx)?old('email_adr'.$sfx):$snp->email_adr}}">
                                                <span class="text-danger">{{ $errors->first('email_adr'.$sfx) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if ($item->isSbaIndividual() || $item->isSbaBusiness())
                        {{-- Contact info --}}
                        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                            <h5>@lang('app.txt.contactinfo')</h5>
                            <div class="row">
                                <div class="col-md-6 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.contactname') </div>
                                            <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="@lang('app.txt.contactname')" value="{{old('contact_name')?old('contact_name'):($item->userinfos ?$item->userinfos->contact_name : '') }}">
                                            <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.contactemail') </div>
                                            <input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="@lang('app.txt.contactemail')" value="{{ old('contact_email')?old('contact_email'):($item->userinfos ?$item->userinfos->contact_email:'') }}">
                                            <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.contactphone')</div>
                                            <div class="input-group mb-3 col-sm-12">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif2" id="indicatif2">
                                                        @if (isset($item->userinfos->contact_phone))
                                                            @php
                                                                $codetamps = preg_match('#\((.*?)\)#', $item->userinfos->contact_phone, $match);
                                                                $code = $match[1];
                                                                $ct_num = $item->userinfos?explode(')',$item->userinfos->contact_phone)[1]:'';
                                                            @endphp
                                                        @else
                                                            @php
                                                                $ct_num="";
                                                            @endphp
                                                        @endif
                                                        <option value="+61" selected>(+61)</option>
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="9" maxlength="9" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="contact_phone" name="contact_phone" value="{{ old('contact_phone')?old('contact_phone'):($ct_num) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Seller by afa individual --}}
                    @if($item->isSbaIndividual())
                    <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                        <h3>@lang('app.txt.seller_details')</h3>
                        @foreach ($item->sellerIndividual() as $key=>$snp)
                            @php
                                $tot = $key+1;
                                $sfx = $key!==0?'_'.$tot:'';
                            @endphp
                            @if($loop->last) <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b"></div> @endif
                                <p class="m-15px-t"><b>Seller #{{$key+1}}</b></p>
                                <div class="row">
                                    <input type="hidden" name="id_seller{{$sfx}}" value="{{ $snp->id }}">
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.nom') </div>
                                                <input type="text" class="form-control" id="last_name{{$sfx}}" name="last_name{{$sfx}}" value="{{old('last_name'.$sfx)?old('last_name'.$sfx):$snp->last_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.prenom') </div>
                                                <input type="text" class="form-control" name="first_name{{$sfx}}" id="first_name{{$sfx}}" value="{{old('first_name'.$sfx)?old('first_name'.$sfx):$snp->first_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-road"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.streetaddress') </div>
                                                <input type="text" name="street_adr{{$sfx}}" id="street_adr{{$sfx}}" value="{{old('street_adr'.$sfx)?old('street_adr'.$sfx):$snp->street_adr}}" class="form-control">
												<input type="hidden" name="sba_lat{{$sfx}}" id="sba_lat{{$sfx}}" value="{{$item->location->latitude}}" />
												<input type="hidden" name="sba_long{{$sfx}}" id="sba_long{{$sfx}}" value="{{$item->location->longitude}}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-info"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.suburb')</div>
                                                <input type="text" name="suburb{{$sfx}}" id="sba_suburb{{$sfx}}" value="{{old('suburb'.$sfx)?old('suburb'.$sfx):$snp->suburb}}" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-info"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.city')</div>
                                                <input type="text" name="city{{$sfx}}" id="sba_city{{$sfx}}" value="{{old('city'.$sfx)?old('city'.$sfx):$snp->city}}" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                                <input type="text" name="post_code{{$sfx}}" id="sba_post_code{{$sfx}}" value="{{old('post_code'.$sfx)?old('post_code'.$sfx):$snp->post_code}}" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-flag"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat')</div>
                                                <input type="text" name="state{{$sfx}}" id="sba_state{{$sfx}}" value="{{old('state'.$sfx)?old('state'.$sfx):$snp->state}}" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-info"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                                <select class="form-control" name="country{{$sfx}}" id="sba_country{{$sfx}}">
                                                    <option value="" selected disabled>@lang('app.select_country')</option>
                                                    @foreach(App\Models\Country::all() as $country)
                                                        @if($country->prefixPhone)
                                                            <option value="{{$country->code}}" long="{{$country->content}}" {{ $snp->country==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.orga.fix_phone')</div>
                                                <div class="input-group mb-3 col-sm-12">
                                                    <div class="input-group-prepend">
                                                        <select class="form-control" name="indicatif{{$sfx}}" id="indicatif{{$sfx}}">
                                                            @if (isset($snp->phone) && $snp->phone)
                                                                @php
                                                                    $codetamps = preg_match('#\((.*?)\)#', $snp->phone, $match);
                                                                    $code = $match[1];
                                                                    $num = $snp->phone?explode(')',$snp->phone)[1]:'';
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $num = "";
                                                                @endphp
                                                            @endif
                                                            <option value="+61">(+61)</option>
                                                        </select>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="text" pattern="[0-9]{1}[0-9]{7|14}" minlength="6" maxlength="9" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="phone{{$sfx}}" name="phone{{$sfx}}" value="{{ old('phone'.$sfx)?old('phone'.$sfx):($num) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.mobile_seller',['num'=>$tot])</div>
                                                <div class="input-group mb-3 col-sm-12">
                                                    <div class="input-group-prepend">
                                                        <select class="form-control" name="indicatif3{{$sfx}}" id="indicatif3{{$sfx}}">
                                                            @if (isset($snp->phone) && $snp->mobile)
                                                                @php
                                                                    $codetamps = preg_match('#\((.*?)\)#', $snp->mobile, $match);
                                                                    $code = $match[1];
                                                                    $num = $snp->mobile?explode(')',$snp->mobile)[1]:'';
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $num = "";
                                                                @endphp
                                                            @endif
                                                            <option value="+61">(+61)</option>
                                                        </select>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="text" pattern="[0-9]{1}[0-9]{7|14}" minlength="6" maxlength="9" placeholder="@lang('app.txt.mobile_seller',['num'=>$tot])" class="form-control m-15px-t" id="mobile{{$sfx}}" name="mobile{{$sfx}}" value="{{ old('mobile'.$sfx)?old('mobile'.$sfx):($num) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 m-10px-tb">
                                        <div class="media">
                                            <div class="only-icon-20">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="media-body p-15px-l lh-normal">
                                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.email') </div>
                                                <input type="email" class="form-control" placeholder="email@iea.com" name="email_adr{{$sfx}}" id="email_adr{{$sfx}}" value="{{ old('email_adr'.$sfx)?old('email_adr'.$sfx):$snp->email_adr}}">
                                                <span class="text-danger">{{ $errors->first('email_adr'.$sfx) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    
                    {{-- Seller by afa business --}}
                    @if($item->isSbaBusiness())
                        @php
                            $sbaBus = $item->sellerBusiness();
                        @endphp
                        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                            <h3>@lang('app.txt.seller_details')</h3>
                            <div class="row">
                                <input type="hidden" name="id_seller" value="{{ $sbaBus->id }}">
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessname') </div>
                                            <input type="text" class="form-control" placeholder="@lang('app.txt.businessname')" name="business_name" id="business_name" value="{{ old('business_name')?old('business_name'):($sbaBus->business_name)}}">
                                            <span class="text-danger">{{ $errors->first('business_name') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessparentname')</div>
                                            <input type="text" class="form-control" placeholder="@lang('app.txt.businessparentname')" name="business_parent" id="business_parent" value="{{ old('business_parent')?old('business_parent'):($sbaBus->business_parent)}}">
                                            <span class="text-danger">{{ $errors->first('business_parent') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-road"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.streetaddress') </div>
                                            <input type="text" name="street_adr" id="snp_bus_street_adr" value="{{old('street_adr')?old('street_adr'):$sbaBus->street_adr}}" class="form-control">
											<input type="hidden" name="snp_bus_lat" id="snp_bus_lat" value="{{$item->location->latitude}}" />
											<input type="hidden" name="snp_bus_lon" id="snp_bus_long" value="{{$item->location->longitude}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.suburb')</div>
                                            <input type="text" name="suburb" id="snp_business_suburb" value="{{old('suburb')?old('suburb'):$sbaBus->suburb}}" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.city')</div>
                                            <input type="text" name="city" id="snp_bus_city" value="{{old('city')?old('city'):$sbaBus->city}}" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                            <input type="text" name="post_code" id="snp_bus_post_code" value="{{old('post_code')?old('post_code'):$sbaBus->post_code}}" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat')</div>
                                            <input type="text" name="state" id="snp_bus_state" value="{{old('state')?old('state'):$sbaBus->state}}" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                            <select class="form-control" name="country" id="snp_bus_country">
                                                <option value="" selected disabled>@lang('app.select_country')</option>
                                                @foreach(App\Models\Country::all() as $country)
                                                    @if($country->prefixPhone)
                                                        <option value="{{$country->code}}" long="{{$country->content}}" {{ $sbaBus->country==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.orga.fix_phone')</div>
                                            <div class="input-group mb-3 col-sm-12">
                                                <div class="input-group-prepend">
                                                    {{--<select class="form-control" name="indicatif" id="indicatif">--}}
                                                        @if (isset($sbaBus->phone) && $sbaBus->phone)
                                                            @php
                                                                $codetamps = preg_match('#\((.*?)\)#', $sbaBus->phone, $match);
                                                                $code = isset($match) && count($match) > 0 ? $match[1] : "";

                                                                $numSuffix = explode(')',$sbaBus->phone) ;
                                                                $num = $sbaBus->phone && count($numSuffix) > 1 ? $numSuffix[1] : '';
                                                            @endphp
                                                        @else
                                                            @php
                                                                $num = "";
                                                            @endphp
                                                        @endif
                                                        <option value="+61">(+61)</option>
                                                    {{--</select>--}}
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|14}" minlength="6" maxlength="9" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="phone" name="phone" value="{{ old('phone')?old('phone'):($num) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.mobile')</div>
                                            <div class="input-group mb-3 col-sm-12">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif3" id="indicatif3">
                                                        @if (isset($sbaBus->phone) && $sbaBus->mobile)
                                                            @php
                                                                $codetamps = preg_match('#\((.*?)\)#', $sbaBus->mobile, $match);
                                                                $code = isset($match) && count($match) > 0 ? $match[1] : "";

                                                                $mobSuffix = explode(')',$sbaBus->mobile) ;
                                                                $num = $sbaBus->mobile && count($mobSuffix) > 1 ? $mobSuffix[1] : '';
                                                            @endphp
                                                        @else
                                                            @php
                                                                $num = "";
                                                            @endphp
                                                        @endif
                                                        <option value="+61">(+61)</option>
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|14}" minlength="6" maxlength="9" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="mobile" name="mobile" value="{{ old('mobile')?old('mobile'):($num) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.email') </div>
                                            <input type="email" class="form-control" placeholder="email@iea.com" name="email_adr" id="email_adr" value="{{ old('email_adr')?old('email_adr'):$sbaBus->email_adr}}">
                                            <span class="text-danger">{{ $errors->first('email_adr') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                {{---END SELLER ---}}

                {{---------------------------------------------------}}
                {{------------  not AFA and APL and Seller ----------}}
                {{---------------------------------------------------}}
                @if (!$item->hasRole(3) && !$item->hasRole(4) && !$item->hasRole(2))
                    <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                        <h5>@lang('app.txt.businessdetail')</h5>
                        <div class="row">
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessphone')</div>
                                        <div class="input-group mb-3 col-sm-12">
                                            <div class="input-group-prepend">
                                                <select class="form-control" name="indicatif" id="indicatif">
                                                    @if (isset($item->userinfos->orga_phone) && $item->userinfos->orga_phone)
                                                        @php
                                                            $codetamps = preg_match('#\((.*?)\)#', $item->userinfos->orga_phone, $match);
                                                            $code = $match[1];
                                                            $allCode = $match[0];
                                                            $num = $item->userinfos?explode(')',$item->userinfos->orga_phone)[1]:'';
                                                        @endphp
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code==$code?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                        @endforeach
                                                    @else
                                                        @php
                                                            $num="";
                                                        @endphp
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="custom-file">
                                                <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="9" maxlength="9" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="orga_phone" name="orga_phone" value="{{ old('orga_phone')?old('orga_phone'):($num) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessfax') </div>
                                        <input type="text" class="form-control" placeholder="@lang('app.txt.businessfax')" name="orga_fax" id="orga_fax" value="{{ old('orga_fax')?old('orga_fax'):($item->userinfos ?$item->userinfos->orga_fax:'')}}">
                                        <span class="text-danger">{{ $errors->first('orga_fax') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessmobile')</div>
                                        <div class="input-group mb-3 col-sm-12">
                                            <div class="input-group-prepend">
                                                <select class="form-control" name="indicatif3" id="indicatif3">
                                                    @if (isset($item->userinfos->orga_mobile_phone) && $item->userinfos->orga_mobile_phone)
                                                        @php
                                                            $codetamps = preg_match('#\((.*?)\)#', $item->userinfos->orga_mobile_phone, $match);
                                                            $code = $match[1];
                                                            $num = $item->userinfos?explode(')',$item->userinfos->orga_mobile_phone)[1]:'';
                                                        @endphp
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code==$code?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                        @endforeach    
                                                    @else
                                                        @php
                                                            $num = "";
                                                        @endphp
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="custom-file">
                                                <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="9" maxlength="9" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="orga_mobile_phone" name="orga_mobile_phone" value="{{ old('orga_mobile_phone')?old('orga_mobile_phone'):($num) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessname') </div>
                                        <input type="text" class="form-control" placeholder="@lang('app.txt.businessname')" name="orga_name" id="orga_name" value="{{ old('orga_name')?old('orga_name'):($item->userinfos ?$item->userinfos->orga_name:'')}}" readonly>
                                        <span class="text-danger">{{ $errors->first('orga_name') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.organizationregistrationnumber') </div>
                                        <input type="text" class="form-control" name="orga_registration_number" id="orga_registration_number" placeholder="@lang('app.txt.organizationregistrationnumber.input')" value="{{ old('orga_registration_number')?old('orga_registration_number'):(isset($item->userinfos->orga_registration_number)?$item->userinfos->orga_registration_number:'') }}" readonly>
                                        <span class="text-danger">{{ $errors->first('orga_registration_number') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.organizationrepregistrationofficial')</div>
                                        <input type="text" class="form-control" name="orga_rep_official_registration" placeholder="@lang('app.txt.organizationrepregistrationofficial')" value="{{ old('orga_rep_official_registration')?old('orga_rep_official_registration'):($item->userinfos ?$item->userinfos->orga_rep_official_registration:'')}}" readonly>
                                        <span class="text-danger">{{ $errors->first('orga_rep_official_registration') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.type_of_organization')</div>
                                        @if($item->userinfos)
                                        @php
                                                $orga_type = $item->userinfos->orga_type;
                                                if($orga_type === 'public')
                                                    $orga_type = trans('member.public_organization');
                                                if($orga_type === 'private')
                                                    $orga_type = trans('member.private_entreprise');
                                                if($orga_type === 'mixte')
                                                    $orga_type = trans('member.mixed_organization');
                                        @endphp
                                        @else
                                            @php
                                                $orga_type = '';
                                            @endphp
                                        @endif
                                        <input type="text" class="form-control" placeholder="@lang('app.txt.type_of_organization')" value="{{ old('orga_type')?old('orga_type'):$orga_type}}" readonly>
                                        <span class="text-danger">{{ $errors->first('orga_type') }}</span>
                                    </div>
                                </div>
                            </div>
                            @if ($item->userinfos->orga_type!=='public')
                                <div class="col-md-6 m-10px-tb">
                                    <div class="media">
                                        <div class="only-icon-20">
                                            <i class="fas fa-info"></i>
                                        </div>
                                        <div class="media-body p-15px-l lh-normal">
                                            <div class="dark-color m-5px-b font-w-600">@lang('app.txt.company_form')</div>
                                            @if($item->userinfos)
                                                @php
                                                    $orga_form = $item->userinfos->orga_form;
                                                    if($orga_form === 'sarl')
                                                        $orga_form = 'SARL';
                                                    elseif($orga_form === 'sa')
                                                        $orga_form = 'SA';
                                                    else
                                                        $orga_form = strtoupper($orga_form);
                                                @endphp
                                            @else
                                                @php
                                                    $orga_form = '';
                                                @endphp
                                            @endif
                                            <input type="text" class="form-control" name="orga_form" placeholder="@lang('app.txt.company_form')" value="{{ old('orga_form')?old('orga_form'):$orga_form}}" readonly>
                                            <span class="text-danger">{{ $errors->first('orga_form') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-item"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businesspresentation')</div>
                                        <textarea class="form-control" placeholder="@lang('app.txt.businesspresentation')" name="orga_presentation" id="orga_presentation" cols="30" rows="5">{{old('orga_presentation')?old('orga_presentation'):($item->userinfos ?$item->userinfos->orga_presentation:'')}}</textarea>
                                        <span class="text-danger">{{ $errors->first('orga_presentation') }}</span>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-icon"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.logo')</div>
                                        <input type="file" class="form-control" id="image" name="image" >
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                @endif
            @endif

            {{---------------------------------------------------}}
            {{------------  MEMBRE PARTICULIER COMPLETE ---------}}
            {{---------------------------------------------------}}
            @if($item->hasRole(5) && $item->isPerson() && $item->isComplete())
                {{-- Physical address --}}
                <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                    <h5>@lang('app.txt.physical_address')</h5>
                    <div class="row">
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-city"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.name_building') </div>
                                    <input type="text" name="building_name" placeholder="@lang('app.txt.name_building')" class="form-control" value="{{$item->location?$item->location->building_name:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-road"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.name_of_the_road') </div>
                                    <input type="text" name="route" value="{{$item->location?$item->location->route:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-flag"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.number_of_the_road')</div>
                                    <input type="text" name="route_number" value="{{$item->location?$item->location->route_number:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.number_of_rooms')</div>
                                    <input type="text" name="num_rooms" placeholder="@lang('app.txt.number_of_rooms')" value="{{$item->location?$item->location->num_rooms:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.floor')</div>
                                    <input type="text" name="num_floor" placeholder="@lang('app.txt.floor')" value="{{$item->location?$item->location->num_floor:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.city')</div>
                                    <input type="text" name="area_level_2" value="{{$item->location?$item->location->area_level_2:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                    <input type="text" name="postalCode" value="{{$item->location?$item->location->postalCode:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-flag"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</div>
                                    <input type="text" name="area_level_1" placeholder="@lang('app.txt.etat')" value="{{$item->location?$item->location->area_level_1:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                    <select class="form-control" name="adrphy_country">
                                        <option value="" selected disabled>@lang('app.select_country')</option>
                                        @foreach(App\Models\Country::all() as $country)
                                            @if($country->prefixPhone)
                                                <option value="{{$country->code}}" {{ $item->location->adrphy_country==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Postal Address --}}
                <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                    <h5>@lang('app.txt.postal_address')</h5>
                    <div class="row">
                        @if (isset($item->location) && $item->location->adrpost_postal_box=='')
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    @lang('app.txt.as_above')
                                </div>
                            </div>
                        @else
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-city"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.postal_box') </div>
                                        <input type="text" name="adrpost_postal_box" placeholder="@lang('app.txt.postal_box')" class="form-control" value="{{$item->location?$item->location->adrpost_postal_box:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-road"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.city') </div>
                                        <input type="text" name="adrpost_area_level_2" value="{{$item->location?$item->location->adrpost_area_level_2:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                        <input type="text" name="adrpost_postalCode" value="{{$item->location?$item->location->adrpost_postalCode:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</div>
                                        <input type="text" name="adrpost_area_level_1" placeholder="@lang('app.txt.etat')" value="{{$item->location?$item->location->adrpost_area_level_1:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                        <select class="form-control" name="adrpost_country">
                                            <option value="" selected disabled>@lang('app.select_country')</option>
                                            @foreach(App\Models\Country::all() as $country)
                                                @if($country->prefixPhone)
                                                    <option value="{{$country->code}}" {{ $item->location->adrpost_country==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Member Contacts --}}
                <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                    <h5>@lang('app.txt.member_contacts')</h5>
                    <div class="row">
                        <div class="col-md-6 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.orga.fix_phone')</div>
                                    <div class="input-group mb-3 col-sm-12">
                                        <div class="input-group-prepend">
                                            <select class="form-control" name="indicatif" id="indicatif">
                                                @if (isset($item->userinfos->orga_phone) && $item->userinfos->orga_phone)
                                                    @php
                                                        $codetamps = preg_match('#\((.*?)\)#', $item->userinfos->orga_phone, $match);
                                                        $code = $match[1];
                                                        $num = $item->userinfos?explode(')',$item->userinfos->orga_phone)[1]:'';
                                                    @endphp
                                                    @foreach (App\Models\Indicatif::all() as $indicatif)
                                                        <option value="+{{ $indicatif->code }}" {{ $indicatif->code==$code?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                    @endforeach
                                                @else
                                                    @php
                                                        $num = "";
                                                    @endphp
                                                    @foreach (App\Models\Indicatif::all() as $indicatif)
                                                        <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="custom-file">
                                            <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="9" maxlength="9" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="orga_phone" name="orga_phone" value="{{ old('orga_phone')?old('orga_phone'):($num) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.mobile')</div>
                                    <div class="input-group mb-3 col-sm-12">
                                        <div class="input-group-prepend">
                                            <select class="form-control" name="indicatif3" id="indicatif3">
                                                @if (isset($item->userinfos->orga_mobile_phone) && $item->userinfos->orga_mobile_phone)
                                                    @php
                                                        $codetamps = preg_match('#\((.*?)\)#', $item->userinfos->orga_mobile_phone, $match);
                                                        $code = $match[1];
                                                        $num = $item->userinfos?explode(')',$item->userinfos->orga_mobile_phone)[1]:'';
                                                    @endphp
                                                    @foreach (App\Models\Indicatif::all() as $indicatif)
                                                        <option value="+{{ $indicatif->code }}" {{ $indicatif->code==$code?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                    @endforeach
                                                @else
                                                    @php
                                                        $num='';
                                                    @endphp
                                                    @foreach (App\Models\Indicatif::all() as $indicatif)
                                                        <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="custom-file">
                                            <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="9" maxlength="9" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="orga_mobile_phone" name="orga_mobile_phone" value="{{ old('orga_mobile_phone')?old('orga_mobile_phone'):($num) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.email_adr') </div>
                                    <input type="email" class="form-control" placeholder="email@iea.com" name="orga_email" id="orga_email" value="{{ old('orga_email')?old('orga_email'):($item->userinfos ?$item->userinfos->orga_email:'')}}">
                                    <span class="text-danger">{{ $errors->first('orga_email') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fab fa-skype"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.skype_nickname') </div>
                                    <input type="text" class="form-control" name="orga_skype" id="orga_skype" placeholder="Ex: live:xxxxxx" value="{{ old('orga_skype')?old('orga_skype'):(isset($item->userinfos->orga_skype)?$item->userinfos->orga_skype:'') }}">
                                    <span class="text-danger">{{ $errors->first('orga_skype') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fab fa-facebook"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.fb_page')</div>
                                    <input type="text" class="form-control" name="orga_fb" placeholder="https://www.facebook.com/iea" value="{{ old('orga_fb')?old('orga_fb'):($item->userinfos ?$item->userinfos->orga_fb:'')}}">
                                    <span class="text-danger">{{ $errors->first('orga_fb') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{---------------------------------------------------}}
            {{------------  MEMBRE ORGA COMPLETE ----------------}}
            {{---------------------------------------------------}}
            @if($item->hasRole(5) && !$item->isPerson() && $item->isComplete())
                {{-- Physical address --}}
                <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                    <h5>@lang('app.txt.physical_address')</h5>
                    <div class="row">
                        <div class="col-md-6 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-city"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.name_building') </div>
                                    <input type="text" name="building_name" placeholder="@lang('app.txt.name_building')" class="form-control" value="{{$item->location?$item->location->building_name:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-road"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.name_num_of_the_road') </div>
                                    <input type="text" value="{{$item->location?$item->location->route:''}}, {{$item->location?$item->location->route_number:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-flag"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.number_of_the_road')</div>
                                    <input type="text" name="route_number" value="{{$item->location?$item->location->route_number:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.number_of_rooms')</div>
                                    <input type="text" name="num_rooms" placeholder="@lang('app.txt.number_of_rooms')" value="{{$item->location?$item->location->num_rooms:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.floor')</div>
                                    <input type="text" name="num_floor" placeholder="@lang('app.txt.floor')" value="{{$item->location?$item->location->num_floor:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.city')</div>
                                    <input type="text" name="locality" value="{{$item->location?$item->location->locality:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                    <input type="text" name="postalCode" value="{{$item->location?$item->location->postalCode:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</div>
                                    <input type="text" name="area_level_1" placeholder="@lang('app.txt.etat')" value="{{$item->location?$item->location->area_level_1:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                    <select class="form-control" name="country" readonly>
                                        <option value="" selected disabled>@lang('app.select_country')</option>
                                        @foreach(App\Models\Country::all() as $country)
                                            @if($country->prefixPhone)
                                                <option value="{{$country->code}}" {{ $item->location->country==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Postal Address --}}
                <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                    <h5>@lang('app.txt.postal_address')</h5>
                    <div class="row">
                        @if (isset($item->location) && $item->location->adrpost_postal_box=='')
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    @lang('app.txt.as_above')
                                </div>
                            </div>
                        @else
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-city"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.postal_box') </div>
                                        <input type="text" name="adrpost_postal_box" placeholder="@lang('app.txt.postal_box')" class="form-control" value="{{$item->location?$item->location->adrpost_postal_box:''}}" placeholder="{{trans('app.txt.noinfo')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-road"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.city') </div>
                                        <input type="text" name="adrpost_locality" value="{{$item->location?$item->location->adrpost_locality:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                        <input type="text" name="adrpost_postalCode" value="{{$item->location?$item->location->adrpost_postalCode:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</div>
                                        <input type="text" name="adrpost_area_level_1" placeholder="@lang('app.txt.etat')" value="{{$item->location?$item->location->adrpost_area_level_1:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-10px-tb">
                                <div class="media">
                                    <div class="only-icon-20">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="media-body p-15px-l lh-normal">
                                        <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                        <select class="form-control" name="adrpost_country" readonly>
                                            <option value="" selected disabled>@lang('app.select_country')</option>
                                            @foreach(App\Models\Country::all() as $country)
                                                @if($country->prefixPhone)
                                                    <option value="{{$country->code}}" {{ $item->location->adrpost_country==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            
            {{-- information contact for APL && Seller (Real Estate Professionals and Non-profesionnal Legal Persons)  --}}
            @if($item->isComplete() && !$item->isPerson() && !$item->isSnp() && !$item->isSbaIndividual() && !$item->isSbaBusiness())
                {{-- <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                    <h5>@lang('app.locality')</h5>
                    <div class="row">
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-road"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.streetaddress') </div>
                                    <input type="text" class="form-control" value="{{$item->location?$item->location->route:''}}" placeholder="{{trans('app.txt.noinfo')}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-city"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.suburb') </div>
                                    <input type="text" value="{{$item->location?$item->location->locality:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-flag"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat')</div>
                                    <input type="text" value="{{$item->location?$item->location->area_level_1:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal')</div>
                                    <input type="text" value="{{$item->location?$item->location->postalCode:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
    
                <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                    <h5>@lang('app.txt.contactinfo')</h5>
                    <div class="row">
                        <div class="col-md-5 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.contactname') </div>
                                    <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="@lang('app.txt.contactname')" value="{{old('contact_name')?old('contact_name'):($item->userinfos ?$item->userinfos->contact_name : '') }}">
                                    <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.contactphone')</div>
                                    <div class="input-group mb-3 col-sm-12">
                                        <div class="input-group-prepend">
                                            <select class="form-control" name="indicatif2" id="indicatif2">
                                                @if (isset($item->userinfos->orga_phone))
                                                    @php
                                                        $codetamps2 = preg_match('#\((.*?)\)#', $item->userinfos->orga_phone, $match2);
                                                        $code2 = $match2[1];
                                                        $allCode2 = $match2[0];
                                                        $num2 = $item->userinfos?explode(')',$item->userinfos->orga_phone)[1]:'';
                                                    @endphp
                                                    @foreach (App\Models\Indicatif::all() as $indicatif)
                                                        <option value="+{{ $indicatif->code }}" {{ $indicatif->code==$code2?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                    @endforeach
                                                @elseif(isset($item->userinfos->contact_phone))
                                                    @php
                                                        $codetamps2 = preg_match('#\((.*?)\)#', $item->userinfos->contact_phone, $match2);
                                                        $code2 = $match2[1];
                                                        $allCode2 = $match2[0];
                                                        $num2 = $item->userinfos?explode(')',$item->userinfos->contact_phone)[1]:'';
                                                    @endphp
                                                    @foreach (App\Models\Indicatif::all() as $indicatif)
                                                        <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>{{ '(+'.$indicatif->code.')' }} </option>
                                                    @endforeach
                                                @else
                                                    @php
                                                        $num2="";
                                                    @endphp
                                                @endif
                                            </select>
                                        </div>
                                        <div class="custom-file">
                                            <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="9" maxlength="9" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="contact_phone" name="contact_phone" value="{{ old('contact_phone')?old('contact_phone'):($item->userinfos?$num2:'') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.contactemail') </div>
                                    <input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="@lang('app.txt.contactemail')" value="{{ old('contact_email')?old('contact_email'):($item->userinfos ?$item->userinfos->contact_email:'') }}">
                                    <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Member only (information APL) --}}
            {{-- @if($item->apl && $item->hasRole(5) && $item->isComplete())
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h5>@lang('app.txt.aplinformation')</h5>
                <div class="row">
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.login') </div>
                                <input type="text" name="apl_name" id="apl_name" class="form-control" value="{{$item->apl->name?$item->apl->name:''}}" placeholder="@lang('app.txt.login')" readonly>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.email') </div>
                                <input type="text" name="apl_email" id="apl_email" class="form-control" value="{{$item->apl->email?$item->apl->email:''}}" placeholder="@lang('app.txt.email')" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.typemembre')</div>
                                <input type="text" name="apl_type" id="apl_type" class="form-control" placeholder="@lang('app.txt.typemembre')" value="{{$item->apl->type?$item->apl->type:''}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif --}}

            {{-- Member only --}}
            @if ($item->hasRole(5))
                <div class="form-group m-25px-tb">
                    <div class="col-sm-offset-3 col-sm-12">
                        <div class="form-group m-50px-t">
                            <div class="row col-lg-12">
                                <div class="col-lg-2">
                                    <select name="newsletter" class="form-control">
                                        <option value="" selected disabled>@lang('app.txt.select')</option>
                                        <option value="yes" {{ $item->userinfos->newsletter=='yes'?'selected':'' }}>@lang('app.txt.yes')</option>
                                        <option value="no" {{ $item->userinfos->newsletter=='no'?'selected':'' }}>@lang('app.txt.no')</option>
                                    </select>
                                </div>
                                <div class="col-lg-10">
                                    <label class="control-label" for="newsletter">@lang('app.form.register.newsletter')</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-50px-t">
                            <div class="row col-lg-12">
                                <div class="col-lg-2">
                                    <select name="allow_sharing" class="form-control">
                                        <option value="" selected disabled>@lang('app.txt.select')</option>
                                        <option value="yes" {{ $item->userinfos->allow_sharing=='yes'?'selected':'' }}>@lang('app.txt.yes')</option>
                                        <option value="no" {{ $item->userinfos->allow_sharing=='no'?'selected':'' }}>@lang('app.txt.no')</option>
                                    </select>
                                </div>
                                <div class="col-lg-10">
                                    <label class="control-label" for="newsletter">@lang('app.form.register.shareinfo')</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- end Membre only --}}
            
            {{-- APL --}}
            @if($item->hasRole(4))
                <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                    <h5>@lang('app.txt.bank_account')</h5>
                    <div class="row">
                        <div class="col-md-6 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.bank') </div>
                                    <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="@lang('app.txt.bank')" value="{{old('bank_name')?old('bank_name'):($item->userinfos ?$item->userinfos->bank_name:'')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.agency') </div>
                                    <input type="text" class="form-control" name="bank_agency" id="bank_agency" placeholder="@lang('app.txt.bank')" value="{{old('bank_agency')?old('bank_agency'):($item->userinfos ?$item->userinfos->bank_agency:'')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.postal_box') </div>
                                    <input type="text" class="form-control" name="bank_postal_box" id="bank_postal_box" placeholder="@lang('app.txt.postal_box')" value="{{old('bank_postal_box')?old('bank_postal_box'):($item->location ?$item->location->bank_postal_box:'')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.city') </div>
                                    <input type="text" class="form-control" name="bank_locality" id="bank_locality" placeholder="@lang('app.txt.postal_box')" value="{{old('bank_locality')?old('bank_locality'):($item->location ?$item->location->bank_locality:'')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.codepostal') </div>
                                    <input type="text" class="form-control" name="bank_postalCode" id="bank_postalCode" placeholder="@lang('app.txt.postal_box')" value="{{old('bank_postalCode')?old('bank_postalCode'):($item->location ?$item->location->bank_postalCode:'')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-flag"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</div>
                                    <input type="text" name="bank_area_level_1" placeholder="@lang('app.txt.etat')" value="{{$item->location?$item->location->bank_area_level_1:''}}" placeholder="{{trans('app.txt.noinfo')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.country')</div>
                                    <select class="form-control" name="bank_country">
                                        <option value="" selected disabled>@lang('app.select_country')</option>
                                        @foreach(App\Models\Country::all() as $country)
                                            @if($country->prefixPhone)
                                                <option value="{{$country->code}}" {{ $item->location->bank_country==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.iban_bank_account') </div>
                                    <input type="text" class="form-control" maxlength="27" name="bank_iban" id="bank_iban" placeholder="@lang('app.txt.iban_bank_account')" value="{{old('bank_iban')?old('bank_iban'):($item->userinfos ?$item->userinfos->bank_iban:'')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.bic_code') </div>
                                    <input type="text" name="bank_bic" id="bank_bic" minlength="8" maxlength="11" placeholder="@lang('app.txt.bic_code')" value="{{ old('bank_bic')?old('bank_bic'):($item->userinfos ?$item->userinfos->bank_bic:'')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h5>@lang('app.txt.cancel_registration')</h5>
                <div class="row">
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <button type="button" class="m-btn m-btn-default pull-right" onclick="cancel_registration({{ Auth::id() }})" id="btn_cancel_registration">@lang('app.btn.cancel_my_registration')</button>
                        </div>
                    </div>
                </div>
            </div>


            <div>
                <button type="submit" class="m-btn m-btn-theme4rd pull-right" id="btn_save">@lang('app.btn.save')</button>
            </div>
        </form>
    </div>


@push('script')
    <script src="{{ asset('/js/sweetalert2.js') }}"></script>
    <!-- Jquery Validate -->
    <script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <!-- Include Bootstrap Datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    {{-- selectpicker --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    
    <script>
        $('.datepickerfrom').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
    <script>
        $.validator.addMethod('le', function (value, element, param) {
            return this.optional(element) || value !== $(param).val();
        }, '@lang("app.txt.invalid_value")');

        $.validator.addMethod('ge', function (value, element, param) {
            return this.optional(element) || value !== $(param).val();
        }, '@lang("app.txt.invalid_value")');

        $('#form_profil').validate({
            ignore: [],
            rules: {
                // afa && member && APL
                orga_name: {
                    required: true,
                },
                orga_phone: {
                    required: true,
                    number:true,
                    minlength:9,
                    maxlength:9,
                },
                orga_website: {
                    required: true,
                    url:true
                },
                orga_presentation: {
                    maxlength: 2000,
                },

                // member person && member organization && APL
                contact_name: {
                    required: true,
                },
                contact_email: {
                    required: true,
                    email:true,
                },
                contact_phone: {
                    required: true,
                    number:true,
                    minlength: 9,
                    maxlength: 9,
                },

                // afa
                orga_trading_name: {
                    required: true,
                },
                orga_abn: {
                    required: true,
                    number:true,
                    minlength:11,
                    maxlength:11
                },
                orga_acn: {
                    number:true,
                    minlength:9,
                    maxlength:9
                },
                orga_license_number: {
                    required: true,
                    minlength:7,
                    maxlength:7
                },
                orga_website: {
                    required: true,
                    url:true
                },
                orga_operation_state: {
                    required: true,
                },
                orga_operation_range: {
                    required: true,
                },

                // apl
                orga_license_number: {
                    required: true,
                },
                bank_name: {
                    required: true,
                },
                bank_agency: {
                    required: true,
                },
                bank_postal_box: {
                    required: true,
                },
                bank_locality: {
                    required: true,
                },
                bank_postalCode: {
                    required: true,
                    number:true,
                },
                bank_country: {
                    required: true,
                },
                bank_iban: {
                    required: true,
                    minlength:27,
                    maxlength:27,
                },
                bank_bic: {
                    required: true,
                    minlength:8,
                    maxlength:11,
                },

                // member person & member person complete
                nationality: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                first_name: {
                    required: true,
                },

                // member organization & member person complete && APL
                orga_mobile_phone: {
                    required: true,
                    number:true,
                    minlength:9,
                    maxlength:9,
                },
                orga_registration_number: {
                    required: true,
                },
                orga_rep_official_registration: {
                    required: false,
                },
                orga_type: {
                    required: true,
                },
                orga_form: {
                    required: true,
                },
                route: {
                    required: true,
                },
                route_number: {
                    required: true,
                },
                locality: {
                    required: true,
                },
                postalCode: {
                    required: true,
                },
                adrpost_postal_box: {
                    required: true,
                },
                adrpost_locality: {
                    required: true,
                },
                adrpost_postalCode: {
                    required: true,
                },

                // Member person complete && afa
                area_level_2: {
					required: true
				},
                adrpost_area_level_2: {
					required: true
				},
                orga_email: {
					required: true,
                    email:true
				},
                orga_fb: {
                    url:true
				},
                date_of_birth: {
                    required:true,
                    date:true
				},

                // seller non profesionnal natural person (SNP)
                place_of_birth: {
                    required: true,
                },
                street_adr: {
                    required: true,
                },
                suburb: {
                    required: true,
                },
                post_code: {
                    required: true,
                    number:true
                },
                // phone: {
                //     required: true,
                //     number:true,
                //     minlength:6,
                //     maxlength:9
                // },
                mobile: {
                    required: true,
                    number:true,
                    minlength:6,
                    maxlength:9
                },
                email_adr: {
                    required: true,
                    email:true,
                },
                // last_name_2: {
                //     required: true,
                // },
                // first_name_2: {
                //     required: true,
                // },
                date_of_birth_2: {
                    // required: true,
                    date:true
                },
                // place_of_birth_2: {
                //     required: true,
                // },
                // nationality_2: {
                //     required: true,
                // },
                // street_adr_2: {
                //     required: true,
                // },
                // suburb_2: {
                //     required: true,
                // },
                // city_2: {
                //     required: true,
                // },
                post_code_2: {
                    // required: true,
                    number:true
                },
                // country_2: {
                //     required: true,
                // },
                // phone_2: {
                //     // required: true,
                //     number: true,
                //     minlength:6,
                //     maxlength:9
                // },
                mobile_2: {
                    // required: true,
                    number: true,
                    minlength:6,
                    maxlength:9
                },
                email_adr_2: {
                    // required: true,
                    email: true,
                },
                // seller by afa business
                business_name: {
                    required: true,
                },
                country: {
                    required: true,
                },

                orga_fax: {
                    number:true,
                    minlength:6,
                    maxlength:9,
                },
				afa_long: {
					required: true,
				},
				sba_long: {
					required: true,
				},
                snp_personne_long: {
					required: true,
				},
				snp_bus_lon: {
					required: true,
				}
            },
            messages: {
                orga_name: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_phone: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_website: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                contact_name: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                contact_email: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                contact_phone: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                bank_bic: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                bank_iban: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_operation_range: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_operation_state: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                // member person
                nationality: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                last_name: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                first_name: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                // member organization
                orga_mobile_phone: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_registration_number: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_rep_official_registration: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_type: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_form: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                route: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                route_number: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                locality: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                postalCode: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                adrpost_postal_box: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                adrpost_locality: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                adrpost_postalCode: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                // Member person complete
                area_level_2: {
					required: "@lang('app.txt.champobligatoire')",
				},
                adrpost_area_level_2: {
					required: "@lang('app.txt.champobligatoire')",
				},
                orga_email: {
					required: "@lang('app.txt.champobligatoire')",
				},
                // afa
                orga_trading_name: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_abn: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_acn: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_license_number: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_website: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_operation_state: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_operation_range: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                // APL
                orga_license_number: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                bank_name: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                bank_agency: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                bank_postal_box: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                bank_locality: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                bank_postalCode: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                bank_country: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                bank_iban: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                bank_bic: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                // seller SNP
                place_of_birth: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                street_adr: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                suburb: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                post_code: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                phone: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                mobile: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                email_adr: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                // seller by afa business
                business_name: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                country: {
                    required: "@lang('app.txt.champobligatoire')",
                },
				afa_long: {
					required: "@lang('app.txt.autocomplete_error')",
				},
				sba_long: {
					required: "@lang('app.txt.autocomplete_error')",
				},
				snp_personne_long: {
					required: "@lang('app.txt.autocomplete_error')",
				},
				snp_bus_lon: {
					required: "@lang('app.txt.autocomplete_error')",
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

        $('#form_profil').submit(function() { // fires on every keyup & blur
            if ($('#form_profil').valid()) {                   // checks form for validity
                // set btn submit to loading btn
                $('#btn_save').attr('disabled','disabled');
                $('#btn_save').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>@lang("app.txt.loading")');
            } else {
                $('btn_save').prop('disabled', false);   // enable button
                $('#btn_save').html('@lang("app.btn.save")');
            }
        });
    </script>
    <style>
        .error {
            color: #F00;
            background-color: #FFF;
        }
    </style>
    <!-- End Jquery Validate -->
    <script>
        // $('#btn_save').click(function(){
        //     $('#form_profil').submit();
        // })

        function cancel_registration(user_id)
        {
            Swal.fire({
                title: "@lang('app.txt.notification_before_unsubscribe')",
                input: 'checkbox',
                inputPlaceholder: "@lang('app.txt.confirm_unsubscription')",
                confirmButtonColor: '#FF2525',
                confirmButtonText: "@lang('app.btn.confirm_unsubscription')",
                showCancelButton: true,
                cancelButtonText: "@lang('app.btn.cancel')",
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.value) {
                        $.ajax({
                            url : "{{ route('profile.ajaxDeleteAccount') }}",
                            type: "POST",
                            dataType: "JSON",
                            data:{"_token": "{{ csrf_token() }}",'user_id':user_id},
                            success: function(data)
                            {
                                Swal.fire({confirmButtonColor: '#00A3E7', icon: 'success', text: "@lang('app.txt.notification_after_unsubscribe')"});
                                location.href="{{ route('logout') }}";	
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                Swal.fire({confirmButtonColor: '#00A3E7', icon: 'error', text: "@lang('app.txt.unsubscribe_error')"});
                                // location.reload();
                            }
                        }); 
                    
                    } else {
                    Swal.fire({confirmButtonColor: '#00A3E7', icon: 'info', text: "@lang('app.txt.check_box_to_confirm_unsubscription')"});
                    }
                } else {
                    console.log(`modal was dismissed by ${result.dismiss}`)
                }
            })
        }
    </script>
	
	{{-- Google map autocomplete --}}
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2izG_M7K3gP6pFUH5cyzmDjuGpOYfgc4&libraries=places&callback=initMap&channel=GMPSB_addressselection_v1_cABC" async defer></script>
    <script>
		function initMap(){			
			// <!-- autocomplete AFA -->	
			var afa_autocomplete = new google.maps.places.Autocomplete($("#route")[0]);
			afa_autocomplete.setComponentRestrictions({'country': ['au']});	
			google.maps.event.addListener(afa_autocomplete, 'place_changed', function() {
				var place = afa_autocomplete.getPlace();
				var afa_arrAddress = place.address_components;
				var afa_itemRoute='';
				var afa_itemSuburb='';
				var afa_itemCountry='';
				var afa_itemCity = '';
				var afa_itemPc='';
				var afa_itemState='';
				var afa_itemSnumber='';
				var afa_lat = place.geometry.location.lat();
				var afa_long = place.geometry.location.lng();
				
				//console.log(arrAddress);
	
				$.each(afa_arrAddress, function (i, address_components) {
					if (address_components.types[0] == "street_number") {
						//console.log("street_number:" + address_components.long_name);
						afa_itemSnumber = address_components.long_name;
					}
					if (address_components.types[0] == "route") {
						//console.log(i + ": route:" + address_components.long_name);
						afa_itemRoute = address_components.long_name;
					}
					
					if (address_components.types[0] == "locality") {
						//console.log("town:" + address_components.long_name);
						afa_itemSuburb = address_components.long_name;
					}
					
					if (address_components.types[0] == "country") {
						// console.log("country:" + address_components.long_name);
						afa_itemCountry = address_components.long_name;
					}
					
					if (address_components.types[0] == "postal_code") {
						//console.log("pc:" + address_components.long_name);
						afa_itemPc = address_components.long_name;
					}
	
					if (address_components.types[0] == "administrative_area_level_1") {
						//console.log("pc:" + address_components.long_name);
						afa_itemState = address_components.short_name;
					}
					
					if (address_components.types[0] == "administrative_area_level_2") {
						//console.log("pc:" + address_components.long_name);
						afa_itemCity = address_components.short_name;
					}
	
					$('#route').val(afa_itemRoute);
					$('#afa_route_number').val(afa_itemSnumber);
					$('#afa_locality').val(afa_itemSuburb);
					$('#afa_area_level_2').val(afa_itemCity);
					$('#afa_postalCode').val(afa_itemPc);
					$('#afa_long').val(afa_long);
					$('#afa_lat').val(afa_lat);
	
					var val = afa_itemCountry;
					$('#afa_country option[long="'+val+'"]').prop('selected', true);
					$('#afa_area_level_1 option[value="'+afa_itemState+'"]').prop('selected', true);
					
					//seller
					$('#route_number').val(afa_itemSnumber);
					$('#seller_locality').val(afa_itemSuburb);
					$('#seller_city').val(afa_itemCity);
					$('#seller_cp').val(afa_itemPc);
					$('#seller_long').val(afa_long);
					$('#seller_lat').val(afa_lat);
					
					$('#seller_state option[value="'+afa_itemState+'"]').prop('selected', true);
	
				});
			});
			// <!-- Fin autocomplete AFA -->
			// <!-- autocomplete SELLER BY AFA -->	
			var sba_autocomplete = new google.maps.places.Autocomplete($("#street_adr")[0]);
			sba_autocomplete.setComponentRestrictions({'country': ['au']});	
			google.maps.event.addListener(sba_autocomplete, 'place_changed', function() {
				var place = sba_autocomplete.getPlace();
				var sba_arrAddress = place.address_components;
				var sba_itemRoute='';
				var sba_itemSuburb='';
				var sba_itemCountry='';
				var sba_itemCity = '';
				var sba_itemPc='';
				var sba_itemState='';
				var sba_itemSnumber='';
				var sba_lat = place.geometry.location.lat();
				var sba_long = place.geometry.location.lng();
				
				//console.log(arrAddress);
	
				$.each(sba_arrAddress, function (i, address_components1) {
					if (address_components1.types[0] == "street_number") {
						//console.log("street_number:" + address_components.long_name);
						sba_itemSnumber = address_components1.long_name;
					}
					if (address_components1.types[0] == "route") {
						//console.log(i + ": route:" + address_components.long_name);
						sba_itemRoute = address_components1.long_name;
					}
					
					if (address_components1.types[0] == "locality") {
						//console.log("town:" + address_components.long_name);
						sba_itemSuburb = address_components1.long_name;
					}
					
					if (address_components1.types[0] == "country") {
						// console.log("country:" + address_components.long_name);
						sba_itemCountry = address_components1.long_name;
					}
					
					if (address_components1.types[0] == "postal_code") {
						//console.log("pc:" + address_components.long_name);
						sba_itemPc = address_components1.long_name;
					}
	
					if (address_components1.types[0] == "administrative_area_level_1") {
						//console.log("pc:" + address_components.long_name);
						sba_itemState = address_components1.short_name;
					}
					
					if (address_components1.types[0] == "administrative_area_level_2") {
						//console.log("pc:" + address_components.long_name);
						sba_itemCity = address_components1.short_name;
					}
	
					$('#street_adr').val(sba_itemSnumber +' '+ sba_itemRoute );
					$('#sba_city').val(sba_itemSuburb);
					$('#sba_suburb').val(sba_itemCity);
					$('#sba_post_code').val(sba_itemPc);
					$('#sba_long').val(sba_long);
					$('#sba_lat').val(sba_lat);
					$('#sba_state').val(sba_itemState);
	
					var val1 = sba_itemCountry;
					$('#sba_country option[long="'+val1+'"]').prop('selected', true);
				});
			});
			
			var sba_autocomplete1 = new google.maps.places.Autocomplete($("#street_adr_2")[0]);
			sba_autocomplete1.setComponentRestrictions({'country': ['au']});	
			google.maps.event.addListener(sba_autocomplete1, 'place_changed', function() {
				var place1 = sba_autocomplete1.getPlace();
				var sba_arrAddress1 = place1.address_components;
				var sba_itemRoute1='';
				var sba_itemSuburb1='';
				var sba_itemCountry1='';
				var sba_itemCity1 = '';
				var sba_itemPc1='';
				var sba_itemState1='';
				var sba_itemSnumber1='';				
				//console.log(arrAddress);
	
				$.each(sba_arrAddress1, function (i, address_components2) {
					if (address_components2.types[0] == "street_number") {
						//console.log("street_number:" + address_components.long_name);
						sba_itemSnumber1 = address_components2.long_name;
					}
					if (address_components2.types[0] == "route") {
						//console.log(i + ": route:" + address_components.long_name);
						sba_itemRoute1 = address_components2.long_name;
					}
					
					if (address_components2.types[0] == "locality") {
						//console.log("town:" + address_components.long_name);
						sba_itemSuburb1 = address_components2.long_name;
					}
					
					if (address_components2.types[0] == "country") {
						// console.log("country:" + address_components.long_name);
						sba_itemCountry1 = address_components2.long_name;
					}
					
					if (address_components2.types[0] == "postal_code") {
						//console.log("pc:" + address_components.long_name);
						sba_itemPc1 = address_components2.long_name;
					}
	
					if (address_components2.types[0] == "administrative_area_level_1") {
						//console.log("pc:" + address_components.long_name);
						sba_itemState1 = address_components2.short_name;
					}
					
					if (address_components2.types[0] == "administrative_area_level_2") {
						//console.log("pc:" + address_components.long_name);
						sba_itemCity1 = address_components2.short_name;
					}
	
					$('#street_adr_2').val(sba_itemSnumber1 +' '+ sba_itemRoute1 );
					$('#sba_city_2').val(sba_itemSuburb1);
					$('#sba_suburb_2').val(sba_itemCity1);
					$('#sba_post_code_2').val(sba_itemPc1);
					$('#sba_state_2').val(sba_itemState1);
	
					var val2 = sba_itemCountry1;
					console.log(val2);
					$('#sba_country_2 option[long="'+val2+'"]').prop('selected', true);
				});
			});
			<!-- fin autocomplete SELLER BY AFA -->	
			<!-- seller non professionnel individuel -->
			var snp_autocomplete = new google.maps.places.Autocomplete($("#snp_personne_street")[0]);
			google.maps.event.addListener(snp_autocomplete, 'place_changed', function() {
				var place2 = snp_autocomplete.getPlace();
				var snp_arrAddress = place2.address_components;
				var snp_itemRoute ='';
				var snp_itemSuburb ='';
				var snp_itemCountry ='';
				var snp_itemCity = '';
				var snp_itemPc ='';
				var snp_itemState ='';
				var snp_itemSnumber ='';	
				var snp_lat = place2.geometry.location.lat();
				var snp_long = place2.geometry.location.lng();					
				//console.log(arrAddress);
	
				$.each(snp_arrAddress, function (i, snp_address_components) {
					if (snp_address_components.types[0] == "street_number") {
						//console.log("street_number:" + address_components.long_name);
						snp_itemSnumber = snp_address_components.long_name;
					}
					if (snp_address_components.types[0] == "route") {
						//console.log(i + ": route:" + address_components.long_name);
						snp_itemRoute = snp_address_components.long_name;
					}
					
					if (snp_address_components.types[0] == "locality") {
						//console.log("town:" + address_components.long_name);
						snp_itemSuburb = snp_address_components.long_name;
					}
					
					if (snp_address_components.types[0] == "country") {
						// console.log("country:" + address_components.long_name);
						snp_itemCountry = snp_address_components.long_name;
					}
					
					if (snp_address_components.types[0] == "postal_code") {
						//console.log("pc:" + address_components.long_name);
						snp_itemPc = snp_address_components.long_name;
					}
	
					if (snp_address_components.types[0] == "administrative_area_level_1") {
						//console.log("pc:" + address_components.long_name);
						snp_itemState = snp_address_components.short_name;
					}
					
					if (snp_address_components.types[0] == "administrative_area_level_2") {
						//console.log("pc:" + address_components.long_name);
						snp_itemCity = snp_address_components.short_name;
					}
	
					$('#snp_personne_street').val(snp_itemSnumber +' '+ snp_itemRoute );
					$('#snp_personne_city').val(snp_itemSuburb);
					$('#snp_personne_suburb').val(snp_itemCity);
					$('#snp_personne_cp').val(snp_itemPc);
					$('#snp_personne_state').val(snp_itemState);
					$('#snp_personne_lat').val(snp_lat);
					$('#snp_personne_long').val(snp_long);
	
					var val3 = snp_itemCountry;
					$('#snp_personne_country option[long="'+val3+'"]').prop('selected', true);
				});
			});
			
			var snp_autocomplete1 = new google.maps.places.Autocomplete($("#snp_personne_street_2")[0]);
			google.maps.event.addListener(snp_autocomplete1, 'place_changed', function() {
				var place3 = snp_autocomplete1.getPlace();
				var snp_arrAddress1 = place3.address_components;
				var snp_itemRoute1 ='';
				var snp_itemSuburb1 ='';
				var snp_itemCountry1 ='';
				var snp_itemCity1 = '';
				var snp_itemPc1 ='';
				var snp_itemState1 ='';
				var snp_itemSnumber1 ='';						
				//console.log(arrAddress);
	
				$.each(snp_arrAddress1, function (i, snp_address_components1) {
					if (snp_address_components1.types[0] == "street_number") {
						//console.log("street_number:" + address_components.long_name);
						snp_itemSnumber1 = snp_address_components1.long_name;
					}
					if (snp_address_components1.types[0] == "route") {
						//console.log(i + ": route:" + address_components.long_name);
						snp_itemRoute1 = snp_address_components1.long_name;
					}
					
					if (snp_address_components1.types[0] == "locality") {
						//console.log("town:" + address_components.long_name);
						snp_itemSuburb1 = snp_address_components1.long_name;
					}
					
					if (snp_address_components1.types[0] == "country") {
						// console.log("country:" + address_components.long_name);
						snp_itemCountry1 = snp_address_components1.long_name;
					}
					
					if (snp_address_components1.types[0] == "postal_code") {
						//console.log("pc:" + address_components.long_name);
						snp_itemPc1 = snp_address_components1.long_name;
					}
	
					if (snp_address_components1.types[0] == "administrative_area_level_1") {
						//console.log("pc:" + address_components.long_name);
						snp_itemState1 = snp_address_components1.short_name;
					}
					
					if (snp_address_components1.types[0] == "administrative_area_level_2") {
						//console.log("pc:" + address_components.long_name);
						snp_itemCity1 = snp_address_components1.short_name;
					}
	
					$('#snp_personne_street_2').val(snp_itemSnumber1 +' '+ snp_itemRoute1 );
					$('#snp_personne_city_2').val(snp_itemSuburb1);
					$('#snp_personne_suburb_2').val(snp_itemCity1);
					$('#snp_personne_cp_2').val(snp_itemPc1);
					$('#snp_personne_state_2').val(snp_itemState1);					
	
					var val4 = snp_itemCountry1;
					$('#snp_personne_country_2 option[long="'+val4+'"]').prop('selected', true);
				});
			});
			<!-- fin seller non professionnel individuel -->
			
			<!-- seller non professionnel business -->
			var bus_autocomplete = new google.maps.places.Autocomplete($("#snp_bus_street_adr")[0]);
			google.maps.event.addListener(bus_autocomplete, 'place_changed', function() {
				var place4 = bus_autocomplete.getPlace();
				var bus_arrAddress = place4.address_components;
				var bus_itemRoute ='';
				var bus_itemSuburb ='';
				var bus_itemCountry ='';
				var bus_itemCity = '';
				var bus_itemPc ='';
				var bus_itemState ='';
				var bus_itemSnumber ='';	
				var bus_lat = place4.geometry.location.lat();
				var bus_long = place4.geometry.location.lng();					
				//console.log(arrAddress);
	
				$.each(bus_arrAddress, function (i, bus_address_components) {
					if (bus_address_components.types[0] == "street_number") {
						//console.log("street_number:" + address_components.long_name);
						bus_itemSnumber = bus_address_components.long_name;
					}
					if (bus_address_components.types[0] == "route") {
						//console.log(i + ": route:" + address_components.long_name);
						bus_itemRoute = bus_address_components.long_name;
					}
					
					if (bus_address_components.types[0] == "locality") {
						//console.log("town:" + address_components.long_name);
						bus_itemSuburb = bus_address_components.long_name;
					}
					
					if (bus_address_components.types[0] == "country") {
						// console.log("country:" + address_components.long_name);
						bus_itemCountry = bus_address_components.long_name;
					}
					
					if (bus_address_components.types[0] == "postal_code") {
						//console.log("pc:" + address_components.long_name);
						bus_itemPc = bus_address_components.long_name;
					}
	
					if (bus_address_components.types[0] == "administrative_area_level_1") {
						//console.log("pc:" + address_components.long_name);
						bus_itemState = bus_address_components.short_name;
					}
					
					if (bus_address_components.types[0] == "administrative_area_level_2") {
						//console.log("pc:" + address_components.long_name);
						bus_itemCity = bus_address_components.short_name;
					}
	
					$('#snp_bus_street_adr').val(bus_itemSnumber +' '+ bus_itemRoute );
					$('#snp_bus_city').val(bus_itemSuburb);
					$('#snp_business_suburb').val(bus_itemCity);
					$('#snp_bus_post_code').val(bus_itemPc);
					$('#snp_bus_state').val(bus_itemState);
					$('#snp_bus_lat').val(bus_lat);
					$('#snp_bus_lon').val(bus_long);
	
					var val5 = bus_itemCountry;
					$('#snp_bus_country option[long="'+val5+'"]').prop('selected', true);
				});
			});
			<!-- seller non professionnel business -->
			
			<!-- APL -->
			var apl_autocomplete = new google.maps.places.Autocomplete($("#apl_route")[0]);
			google.maps.event.addListener(apl_autocomplete, 'place_changed', function() {
				var place_apl = apl_autocomplete.getPlace();
				var apl_arrAddress = place_apl.address_components;
				var apl_itemRoute ='';
				var apl_itemSuburb ='';
				var apl_itemCountry ='';
				var apl_itemCity = '';
				var apl_itemPc ='';
				var apl_itemState ='';
				var apl_itemSnumber ='';	
				var apl_lat = place_apl.geometry.location.lat();
				var apl_long = place_apl.geometry.location.lng();					
				//console.log(arrAddress);
	
				$.each(apl_arrAddress, function (i, apl_address_components) {
					if (apl_address_components.types[0] == "street_number") {
						//console.log("street_number:" + address_components.long_name);
						apl_itemSnumber = apl_address_components.long_name;
					}
					if (apl_address_components.types[0] == "route") {
						//console.log(i + ": route:" + address_components.long_name);
						apl_itemRoute = apl_address_components.long_name;
					}
					
					if (apl_address_components.types[0] == "locality") {
						//console.log("town:" + address_components.long_name);
						apl_itemSuburb = apl_address_components.long_name;
					}
					
					if (apl_address_components.types[0] == "country") {
						// console.log("country:" + address_components.long_name);
						apl_itemCountry = apl_address_components.long_name;
					}
					
					if (apl_address_components.types[0] == "postal_code") {
						//console.log("pc:" + address_components.long_name);
						apl_itemPc = apl_address_components.long_name;
					}
	
					if (apl_address_components.types[0] == "administrative_area_level_1") {
						//console.log("pc:" + address_components.long_name);
						apl_itemState = apl_address_components.short_name;
					}
					
					if (apl_address_components.types[0] == "administrative_area_level_2") {
						//console.log("pc:" + address_components.long_name);
						apl_itemCity = apl_address_components.short_name;
					}
	
					$('#apl_route').val(apl_itemRoute );
					$('#apl_route_number').val(apl_itemSnumber);
					$('#apl_locality').val(apl_itemSuburb);
					$('#apl_postalCode').val(apl_itemPc);
					$('#apl_state').val(apl_itemState);
					$('#apl_lat').val(apl_lat);
					$('#apl_long').val(apl_long);					
					$('#apl_suburb').val(apl_itemCity);
	
					$('#apl_country option[long="'+apl_itemCountry+'"]').prop('selected', true);
				});
			});
			<!-- fin APL -->
		}
    </script>
    {{-- End google map autocomplete --}}
@endpush

@endsection

