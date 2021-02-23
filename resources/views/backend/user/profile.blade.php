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
                            <input type="text" class="form-controler" value="{{$item->name}}" name="name" id="name" disabled>
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
                            <input type="text" name="email" id="email" class="form-controler" value="{{$item->email}}" disabled>
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
                            <input type="text" name="email" id="email" class="form-controler" value="{{$item->type?$item->type:trans('app.txt.noinfo')}}" disabled>
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
                            <input type="text" name="apl_name" id="apl_name" class="form-controler" value="{{$item->apl->name?$item->apl->name:trans('app.txt.noinfo')}}" disabled>
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
                            <input type="text" name="apl_email" id="apl_email" class="form-controler" value="{{$item->apl->email?$item->apl->email:trans('app.txt.noinfo')}}" disabled>
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
                            <input type="text" name="apl_type" id="apl_type" class="form-controler" value="{{$item->apl->type?$item->apl->type:trans('app.txt.noinfo')}}" disabled>
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
                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{$item->get_meta('first_name')?$item->get_meta('first_name')->value:trans('app.txt.noinfo')}}" disabled>
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
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{$item->get_meta('last_name')?$item->get_meta('last_name')->value:trans('app.txt.noinfo')}}" disabled>
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
                            <input type="text" class="form-control" value="{{$item->get_meta('phone')?$item->get_meta('phone')->value:trans('app.txt.noinfo')}}" name="phone" id="phone" disabled>
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
                            <input type="text" class="form-control" name="orga_name" id="orga_name" value="{{$item->get_meta('orga_name')?$item->get_meta('orga_name')->value:trans('app.txt.noinfo')}}">
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
                            <input type="text" class="form-control" name="orga_email" id="orga_email" value="{{$item->get_meta('orga_email')?$item->get_meta('orga_email')->value:trans('app.txt.noinfo')}}">
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
                            <input type="text" class="form-control" name="orga_phone" id="orga_phone" value="{{$item->get_meta('orga_phone')?$item->get_meta('orga_phone')->value:trans('app.txt.noinfo')}}">
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
                            <input type="text" name="orga_website" id="orga_website" >
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
                            <p>{{$item->get_meta('orga_presentation')?$item->get_meta('orga_presentation')->value:trans('app.txt.noinfo')}}</p>
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
                            <div class="dark-color m-5px-b font-w-600">State of legal operation of your present office</div>
                            <p>{{$item->get_meta('orga_operation_state')?$item->get_meta('orga_operation_state')->value:trans('app.txt.noinfo')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 m-10px-tb">
                    <div class="media">
                        <div class="only-icon-20">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="media-body p-15px-l lh-normal">
                            <div class="dark-color m-5px-b font-w-600">Range of operation of your present office</div>
                            <p>{{$item->get_meta('orga_operation_range')?$item->get_meta('orga_operation_range')->value:trans('app.txt.noinfo')}}</p>
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
                            <span>{{$item->location?$item->location->route:trans('app.txt.noinfo')}}</span>
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
                            <a class="body-color" href="#">{{$item->location?$item->location->locality:trans('app.txt.noinfo')}}</a>
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
                            <span>{{$item->location?$item->location->area_level_1:trans('app.txt.noinfo')}}</span>
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
                            <p>{{$item->location?$item->location->postalCode:trans('app.txt.noinfo')}}</p>
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
                            <span>{{$item->get_meta('orga_website')?$item->get_meta('orga_website')->value:trans('app.txt.noinfo')}}</span>
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
                            <a class="body-color" href="#">{{$item->get_meta('contact_email')?$item->get_meta('contact_email')->value:trans('app.txt.noinfo')}}</a>
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
                            <span>{{$item->get_meta('contact_phone')?$item->get_meta('contact_phone')->value:trans('app.txt.noinfo')}}</span>
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
                            <span>{{$item->get_meta('crm_name')?$item->get_meta('crm_name')->value:trans('app.txt.noinfo')}}</span>
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
                            <a class="body-color" href="#">{{$item->get_meta('crm_email')?$item->get_meta('crm_email')->value:trans('app.txt.noinfo')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

