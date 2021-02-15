@extends('layouts.backend')

@section('subcontent')

<div class="col-lg-8 col-xl-9">
    <div class="profile-content-area m-40px-tb card card-body">
        <div class="form-group">
            <a href="{{route('profile.edit')}}" class="btn btn-info">Modifier Profile</a>
            <a href="{{route('avatar.edit')}}"  class="btn btn-warning">Modifier Avatar</a>
            <a href="{{route('password.edit')}}"  class="btn btn-success">Modifier Mot de passe</a>
            <a href="{{route('location.edit')}}" class="btn btn-info">Modifier Localisation</a>
        </div>
    </div>
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
                            <span>{{$item->name}}</span>
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
                            <a class="body-color" href="#">{{$item->email}}</a>
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
                            <span>{{$item->type?$item->type:trans('app.txt.noinfo')}}</span>
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
                            <span>{{$item->language=='en'?'Anglais':'Français'}}</span>
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
                            <span>{{$item->name}}</span>
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
                            <a class="body-color" href="#">{{$item->email}}</a>
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
                            <span>{{$item->type}}</span>
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
                            <span>{{$item->get_meta('first_name')?$item->get_meta('first_name')->value:trans('app.txt.noinfo')}}</span>
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
                            <a class="body-color" href="#">{{$item->get_meta('last_name')?$item->get_meta('last_name')->value:trans('app.txt.noinfo')}}</a>
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
                            <span>{{$item->get_meta('phone')?$item->get_meta('phone')->value:trans('app.txt.noinfo')}}</span>
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
                            <span>{{$item->orga_name?$item->get_meta('orga_name')->value:trans('app.txt.noinfo')}}</span>
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
                            <a class="body-color" href="#">{{$item->last_names?$item->get_meta('last_name')->value:trans('app.txt.noinfo')}}</a>
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
                            <span>{{$item->phone?$item->get_meta('phone')->value:trans('app.txt.noinfo')}}</span>
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
                            <p>{{$item->orga_presentation?$item->get_meta('orga_presentation')->value:trans('app.txt.noinfo')}}</p>
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
                            <span>{{$item->orga_website?$item->get_meta('orga_website')->value:trans('app.txt.noinfo')}}</span>
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
                            <a class="body-color" href="#">{{$item->contact_email?$item->get_meta('contact_email')->value:trans('app.txt.noinfo')}}</a>
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
                            <span>{{$item->contact_phone?$item->get_meta('contact_phone')->value:trans('app.txt.noinfo')}}</span>
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
                            <span>{{$item->crm_name?$item->get_meta('crm_name')->value:trans('app.txt.noinfo')}}</span>
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
                            <a class="body-color" href="#">{{$item->v?$item->get_meta('crm_email')->value:trans('app.txt.noinfo')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

