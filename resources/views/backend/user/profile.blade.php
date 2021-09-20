@extends('layouts.backend')

@section('subcontent')


    @include('includes.alerts')
    <div class="profile-content-area m-40px-tb card card-body">
        <form action="{{route('profile.edit')}}" method="POST" enctype="multipart/form-data" id="form_profil">
            {{ csrf_field() }}
            <input type="hidden" name="role" value="{{ $item->role }}">
            <input type="hidden" name="userinfos_id" value="{{ $item->userinfos ? $item->userinfos->id : ''}}">
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h5>@lang('app.txt.logininfo')</h5>
                <div class="row">
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.typemembre')</div>
                                <input type="text" name="type" id="type" class="form-control" value="{{$item->type_users_id?App\Models\TypeUser::find($item->type_users_id)->type_user_name:trans('app.txt.noinfo')}}" readonly>
                            </div>
                        </div>
                    </div>
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

                    @if ($item->hasRole(5) && $item->isPerson())
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.country') </div>
                                    <select class="form-control" name="country" required>
                                        <option value="" selected disabled>@lang('app.select_country')</option>
                                        @foreach(App\Models\Country::all() as $country)
                                        <option value="{{$country->code}}" {{ $item->location->country==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                        @endforeach
                                    </select>
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
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.nationality') </div>
                                    <input type="text" name="nationality" id="nationality" placeholder="@lang('app.txt.nationality')" class="form-control" value="{{isset($item->userinfos->nationality)?$item->userinfos->nationality:''}}">
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
                                    <select name="sexe" class="form-control" id="sexe">
                                        <option value="fr" {{$item->userinfos->sexe=='M'?'selected':''}}>@lang('app.txt.male')</option>
                                        <option value="en" {{$item->userinfos->sexe=='F'?'selected':''}}>@lang('app.txt.female')</option>
                                    </select>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-8 m-10px-tb">
                        <div class="media">
                            <div class="media-body p-15px-l lh-normal p-40px-t">
                                <i class="fas fa-key"></i> <a style="color: #AE4435;" href="{{ route('password.edit') }}">@lang('app.txt.editpassword')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{$item->userinfos->last_name?$item->userinfos->last_name:trans('app.txt.noinfo')}}">
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
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{$item->userinfos->first_name?$item->userinfos->first_name:trans('app.txt.noinfo')}}">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.phone')</div>
                                <input type="text" class="form-control" value="{{$item->userinfos->phone?$item->userinfos->phone:trans('app.txt.noinfo')}}" name="phone" id="phone" readonly>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            @else
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
                                                @php
                                                    $codetamps = preg_match('#\((.*?)\)#', $item->userinfos->orga_phone, $match);
                                                    $code = $match[1];
                                                    $allCode = $match[0];
                                                    $num = $item->userinfos?explode(')',$item->userinfos->orga_phone)[1]:'';
                                                @endphp
                                                @foreach (App\Models\Indicatif::all() as $indicatif)
                                                    <option value="+{{ $indicatif->code }}" {{ $indicatif->code==$code?'selected':'' }}>{{ $allCode }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="custom-file">
                                            <input type="text" pattern="[0-9]{1}[0-9]{7|14}" minlength="6" maxlength="15" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="orga_phone" name="orga_phone" value="{{ old('orga_phone')?old('orga_phone'):($num) }}">
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
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessphone')</div>
                                    <div class="input-group mb-3 col-sm-12">
                                        <div class="input-group-prepend">
                                            <select class="form-control" name="indicatif" id="indicatif">
                                                @php
                                                    $codetamps = preg_match('#\((.*?)\)#', $item->userinfos->orga_mobile_phone, $match);
                                                    $code = $match[1];
                                                    $allCode = $match[0];
                                                    $num = $item->userinfos?explode(')',$item->userinfos->orga_mobile_phone)[1]:'';
                                                @endphp
                                                @foreach (App\Models\Indicatif::all() as $indicatif)
                                                    <option value="+{{ $indicatif->code }}" {{ $indicatif->code==$code?'selected':'' }}>{{ $allCode }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="custom-file">
                                            <input type="text" pattern="[0-9]{1}[0-9]{7|14}" minlength="6" maxlength="15" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="orga_mobile_phone" name="orga_mobile_phone" value="{{ old('orga_mobile_phone')?old('orga_mobile_phone'):($num) }}">
                                        </div>
                                    </div>
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
                                    <input type="text" class="form-control" placeholder="@lang('app.txt.businessname')" name="orga_name" id="orga_name" value="{{ old('orga_name')?old('orga_name'):($item->userinfos ?$item->userinfos->orga_name:'')}}">
                                    <span class="text-danger">{{ $errors->first('orga_name') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.organizationregistrationnumber') </div>
                                    <input type="text" class="form-control" name="orga_registration_number" id="orga_registration_number" placeholder="@lang('app.txt.organizationregistrationnumber')" value="{{ old('orga_registration_number')?old('orga_registration_number'):(isset($item->userinfos->orga_registration_number)?$item->userinfos->orga_registration_number:'') }}">
                                    <span class="text-danger">{{ $errors->first('orga_registration_number') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.organizationrepregistrationofficial')</div>
                                    <input type="text" class="form-control" name="orga_rep_official_registration" placeholder="@lang('app.txt.organizationrepregistrationofficial')" value="{{ old('orga_rep_official_registration')?old('orga_rep_official_registration'):($item->userinfos ?$item->userinfos->orga_rep_official_registration:'')}}">
                                    <span class="text-danger">{{ $errors->first('orga_rep_official_registration') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
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
                                    <input type="text" class="form-control" name="orga_type" placeholder="@lang('app.txt.type_of_organization')" value="{{ old('orga_type')?old('orga_type'):$orga_type}}" readonly>
                                    <span class="text-danger">{{ $errors->first('orga_type') }}</span>
                                </div>
                            </div>
                        </div>
                        @if ($item->userinfos->orga_type!=='public')
                            <div class="col-md-4 m-10px-tb">
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
                        @if($item->hasRole(3))
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.stateoflegaloperation')</div>
                                    <input type="text" class="form-control" placeholder="@lang('app.txt.stateoflegaloperation')" value="{{old('orga_operation_state')?old('orga_operation_state'):($item->userinfos?$item->userinfos->orga_operation_state:'')}}" name="orga_operation_state">
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
                                    <input type="text" class="form-control" placeholder="@lang('app.txt.rangeofoperation')" value="{{$item->userinfos ?$item->userinfos->orga_operation_range:''}}" name="orga_operation_range">
                                    <span class="text-danger">{{ $errors->first('orga_operation_range') }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
    
                    </div>
                </div>
            @endif

            @if($item->hasRole(5) && !$item->isPerson() && $item->isComplete())
                {{-- Physical address --}}
                <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                    <h5>@lang('app.txt.physical_address')</h5>
                    <div class="row">
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-road"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.streetaddress') </div>
                                    <input type="text" class="form-control" value="{{$item->location?$item->location->route:trans('app.txt.noinfo')}}" disabled>
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
                                    <input type="text" value="{{$item->location?$item->location->locality:trans('app.txt.noinfo')}}" class="form-control" disabled>
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
                                    <input type="text" value="{{$item->location?$item->location->area_level_1:trans('app.txt.noinfo')}}" class="form-control" disabled>
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
                                    <input type="text" value="{{$item->location?$item->location->postalCode:trans('app.txt.noinfo')}}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($item->isComplete())
                <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                    <h5>@lang('app.locality')</h5>
                    <div class="row">
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-road"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.streetaddress') </div>
                                    <input type="text" class="form-control" value="{{$item->location?$item->location->route:trans('app.txt.noinfo')}}" disabled>
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
                                    <input type="text" value="{{$item->location?$item->location->locality:trans('app.txt.noinfo')}}" class="form-control" disabled>
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
                                    <input type="text" value="{{$item->location?$item->location->area_level_1:trans('app.txt.noinfo')}}" class="form-control" disabled>
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
                                    <input type="text" value="{{$item->location?$item->location->postalCode:trans('app.txt.noinfo')}}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                    <h5>@lang('app.txt.contactinfo')</h5>
                    <div class="row">
                        <div class="col-md-4 m-10px-tb">
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
                        <div class="col-md-4 m-10px-tb">
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
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.contactphone')</div>
                                    <div class="input-group mb-3 col-sm-12">
                                        <div class="input-group-prepend">
                                            <select class="form-control" name="indicatif2" id="indicatif2">
                                                @php
                                                    $codetamps2 = preg_match('#\((.*?)\)#', $item->userinfos->contact_phone, $match2);
                                                    $code2 = $match2[1];
                                                    $allCode2 = $match2[0];
                                                    $num2 = $item->userinfos?explode(')',$item->userinfos->contact_phone)[1]:'';
                                                @endphp
                                                @foreach (App\Models\Indicatif::all() as $indicatif)
                                                    <option value="+{{ $indicatif->code }}" {{ $indicatif->code==$code2?'selected':'' }}>{{ $allCode2 }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="custom-file">
                                            <input type="text" pattern="[0-9]{1}[0-9]{7|14}" minlength="6" maxlength="15" placeholder="61XXXXXXXXXXXXX" class="form-control m-15px-t" id="contact_phone" name="contact_phone" value="{{ old('contact_phone')?old('contact_phone'):($item->userinfos?$num2:'') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Member only --}}
            @if($item->apl && $item->hasRole(5) && $item->isComplete())
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
            @endif

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
                    <h5>@lang('app.txt.banking_information')</h5>
                    <div class="row">
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.iban_bank_account') </div>
                                    <input type="text" class="form-control" name="bank_iban" id="bank_iban" placeholder="@lang('app.txt.iban_bank_account')" value="{{old('bank_iban')?old('bank_iban'):($item->userinfos ?$item->userinfos->bank_iban:'')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.bic_code') </div>
                                    <input type="text" name="bank_bic" id="bank_bic" placeholder="@lang('app.txt.bic_code')" value="{{ old('bank_bic')?old('bank_bic'):($item->userinfos ?$item->userinfos->bank_bic:'')}}" class="form-control">
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
                orga_name: {
                    required: true,
                },
                orga_phone: {
                    required: true,
                    number:true,
                    minlength:6,
                    maxlength:15,
                },
                orga_website: {
                    required: true,
                    url:true
                },
                orga_presentation: {
                    maxlength: 2000,
                },
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
                    minlength: 6,
                    maxlength: 15,
                },
                bank_iban: {
                    required: true,
                },
                bank_bic: {
                    required: true,
                },
                // afa
                orga_operation_range: {
                    required: true,
                },
                orga_operation_state: {
                    required: true,
                },

                // member person
                nationality: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                first_name: {
                    required: true,
                },
                
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
@endpush

@endsection

