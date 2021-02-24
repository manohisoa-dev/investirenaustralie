@extends('layouts.backend')

@section('subcontent')

<div class="col-lg-8 col-xl-9">
    {{-- <div class="profile-content-area m-40px-tb card card-body">
        <div class="form-group">
            <a href="{{route('profile.edit')}}" class="btn btn-info">Modifier Profile</a>
            <a href="{{route('avatar.edit')}}"  class="btn btn-warning">Modifier Avatar</a>
            <a href="{{route('password.edit')}}"  class="btn btn-success">Modifier Mot de passe</a>
            <a href="{{route('location.edit')}}" class="btn btn-info">Modifier Localisation</a>
        </div>
    </div> --}}
    <div class="profile-content-area m-40px-tb card card-body">
        <form action="{{route('profile.edit')}}" method="POST" enctype="multipart/form-data" id="form_profil">
            {{ csrf_field() }}
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h5>@lang('app.txt.logininfo')</h5>
                {{-- <div class="col-md-3 m-15px-tb m-100px-l">
                    <div class="media">
                        <section class="widget">
                            <img src="{{$item->imageUrl(false)}}" alt="{{$item->name}}"  width="100%">
                        </section>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.login') </div>
                                <input type="text" class="form-control" value="{{$item->name}}" name="nom" id="nom" readonly>
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
                                <input type="text" name="apl_name" id="apl_name" class="form-control" value="{{$item->apl->name?$item->apl->name:trans('app.txt.noinfo')}}" readonly>
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
                                <input type="text" name="apl_email" id="apl_email" class="form-control" value="{{$item->apl->email?$item->apl->email:trans('app.txt.noinfo')}}" readonly>
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
                                <input type="text" name="apl_type" id="apl_type" class="form-control" value="{{$item->apl->type?$item->apl->type:trans('app.txt.noinfo')}}" readonly>
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
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{$item->get_meta('first_name')?$item->get_meta('first_name')->value:trans('app.txt.noinfo')}}" readonly>
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
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{$item->get_meta('last_name')?$item->get_meta('last_name')->value:trans('app.txt.noinfo')}}" readonly>
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
                                <input type="text" class="form-control" value="{{$item->get_meta('phone')?$item->get_meta('phone')->value:trans('app.txt.noinfo')}}" name="phone" id="phone" readonly>
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
                                <input type="text" class="form-control" placeholder="@lang('app.txt.businessname')" name="orga_name" id="orga_name" value="{{$item->get_meta('orga_name')?$item->get_meta('orga_name')->value:old('orga_name')}}">
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
                                <input type="text" class="form-control" name="orga_email" id="orga_email" placeholder="@lang('app.txt.businessemail')" value="{{$item->get_meta('orga_email')?$item->get_meta('orga_email')->value:old('orga_email')}}" >
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
                                <input type="text" class="form-control" name="orga_phone" id="orga_phone" placeholder="@lang('app.txt.businessphone')" value="{{$item->get_meta('orga_phone')?$item->get_meta('orga_phone')->value:old('orga_phone')}}">
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
                                <input type="text" class="form-control" name="orga_website" placeholder="@lang('app.txt.businesswebsite')" value="{{$item->get_meta('orga_website')?$item->get_meta('orga_website')->value:old('orga_website')}}">
                                <span class="text-danger">{{ $errors->first('orga_website') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-10px-tb">
                        <div class="media">
                            <div class="only-icon-20">
                                <i class="fas fa-info"></i>
                            </div>
                            <div class="media-body p-15px-l lh-normal">
                                <div class="dark-color m-5px-b font-w-600">@lang('app.txt.businesspresentation')</div>
                                <input type="text" name="orga_presentation" id="orga_presentation" class="form-control" placeholder="@lang('app.txt.businesspresentation')" value="{{$item->get_meta('orga_presentation')?$item->get_meta('orga_presentation')->value:old('orga_presentation')}}">
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
                                <input type="text" class="form-control" placeholder="@lang('app.txt.stateoflegaloperation')" value="{{$item->get_meta('orga_operation_state')?$item->get_meta('orga_operation_state')->value:''}}" name="orga_operation_state">
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
                                <input type="text" class="form-control" placeholder="@lang('app.txt.rangeofoperation')" value="{{$item->get_meta('orga_operation_range')?$item->get_meta('orga_operation_range')->value:''}}" name="orga_operation_range">
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
    
            @endif
    
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h5>@lang('app.txt.localityinformation')</h5>
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
                                <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="@lang('app.txt.contactname')" value="{{$item->get_meta('contact_name')?$item->get_meta('contact_name')->value:''}}">
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
                                <input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="@lang('app.txt.contactemail')" value="{{$item->get_meta('contact_email')?$item->get_meta('contact_email')->value:''}}">
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
                                <input type="text" name="contact_phone" id="contact_phone" placeholder="@lang('app.txt.contactphone')" value="{{$item->get_meta('contact_phone')?$item->get_meta('contact_phone')->value:''}}" class="form-control">
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
                                <input type="text" class="form-control" name="crm_name" id="crm_name" placeholder="@lang('app.txt.crmprovidername')" value="{{$item->get_meta('crm_name')?$item->get_meta('crm_name')->value:''}}">
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
                                <input type="text" name="crm_email" id="crm_email" placeholder="@lang('app.txt.crmprovideremail')" value="{{$item->get_meta('crm_email')?$item->get_meta('crm_email')->value:''}}" class="form-control">
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

