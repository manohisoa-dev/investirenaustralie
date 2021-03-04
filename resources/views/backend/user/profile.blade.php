@extends('layouts.backend')

@section('subcontent')

<div class="col-lg-8 col-xl-9">
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
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.langage') </div>
                                <select name="language" class="form-control" id="language">
                                    <option value="fr" {{$item->language=='fr'?'selected':''}}>Français</option>
                                    <option value="en" {{$item->language=='en'?'selected':''}}>English</option>
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
    
            @if($item->apl && $item->hasRole(5))
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
    
            @if($item->hasRole(5) && $item->type == 'person')
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h5>@lang('app.txt.persondetail')</h5>
                <div class="row">
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.prenom') </div>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{$item->userinfos->first_name?$item->userinfos->first_name:trans('app.txt.noinfo')}}" readonly>
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
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{$item->userinfos->last_name?$item->userinfos->last_name:trans('app.txt.noinfo')}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.phone')</div>
                                <input type="text" class="form-control" value="{{$item->userinfos->phone?$item->userinfos->phone:trans('app.txt.noinfo')}}" name="phone" id="phone" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                    <h5>@lang('app.txt.businessdetail')</h5>
                    <div class="row">
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessname') </div>
                                    <input type="text" class="form-control" placeholder="@lang('app.txt.businessname')" name="orga_name" id="orga_name" value="{{ $item->userinfos ?$item->userinfos->orga_name:old('orga_name')}}">
                                    <span class="text-danger">{{ $errors->first('orga_name') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessemail') </div>
                                    <input type="text" class="form-control" name="orga_email" id="orga_email" placeholder="@lang('app.txt.businessemail')" value="{{$item->userinfos ?$item->userinfos->orga_email:old('orga_email')}}" >
                                    <span class="text-danger">{{ $errors->first('orga_email') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businessphone')</div>
                                    <input type="text" class="form-control" name="orga_phone" id="orga_phone" placeholder="@lang('app.txt.businessphone')" value="{{$item->userinfos ?$item->userinfos->orga_phone:old('orga_phone')}}">
                                    <span class="text-danger">{{ $errors->first('orga_phone') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businesswebsite')</div>
                                    <input type="text" class="form-control" name="orga_website" placeholder="@lang('app.txt.businesswebsite')" value="{{$item->userinfos ?$item->userinfos->orga_website:old('orga_website')}}">
                                    <span class="text-danger">{{ $errors->first('orga_website') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-item->userinfos"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businesspresentation')</div>
                                    <input type="text" name="orga_presentation" id="orga_presentation" class="form-control" placeholder="@lang('app.txt.businesspresentation')" value="{{$item->userinfos ?$item->userinfos->orga_presentation:old('orga_presentation')}}">
                                    <span class="text-danger">{{ $errors->first('orga_presentation') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-icon"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.logo')</div>
                                    <input type="file" class="form-control" id="image" name="image" >
                                </div>
                            </div>
                        </div>
                        
                        @if($item->hasRole(3))
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="media-body p-15px-l lh-normal">
                                    <div class="dark-color m-5px-b font-w-600">@lang('app.txt.stateoflegaloperation')</div>
                                    <input type="text" class="form-control" placeholder="@lang('app.txt.stateoflegaloperation')" value="{{$item->userinfos ?$item->userinfos->orga_operation_state:''}}" name="orga_operation_state">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 m-10px-tb">
                            <div class="media">
                                <div class="only-icon-20">
                                    <i class="fas fa-phone"></i>
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
    
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h5>@lang('app.locality')</h5>
                <div class="row">
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-building"></i>
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
                                <i class="fas fa-envelope"></i>
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
                                <i class="fas fa-phone"></i>
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
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.contactname') </div>
                                <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="@lang('app.txt.contactname')" value="{{$item->userinfos ?$item->userinfos->contact_name : old('contact_name') }}">
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
                                <input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="@lang('app.txt.contactemail')" value="{{$item->userinfos ?$item->userinfos->contact_email : old('contact_email') }}">
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
                                <input type="text" name="contact_phone" id="contact_phone" placeholder="@lang('app.txt.contactphone')" value="{{$item->userinfos ?$item->userinfos->contact_phone : old('contact_phone')}}" class="form-control">
                                <span class="text-danger">{{ $errors->first('contact_phone') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h5>@lang('app.txt.crmprovider')</h5>
                <div class="row">
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.crmprovidername') </div>
                                <input type="text" class="form-control" name="crm_name" id="crm_name" placeholder="@lang('app.txt.crmprovidername')" value="{{$item->userinfos ?$item->userinfos->crm_name:''}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.crmprovideremail') </div>
                                <input type="text" name="crm_email" id="crm_email" placeholder="@lang('app.txt.crmprovideremail')" value="{{$item->userinfos ?$item->userinfos->crm_email:''}}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <button type="button" class="m-btn m-btn-theme4rd pull-right" id="btn_save">@lang('app.btn.save')</button>
            </div>
        </form>
    </div>
</div>

@push('script')
    <script>
        $('#btn_save').click(function(){
            $('#form_profil').submit();
        })
    </script>
@endpush

@endsection

