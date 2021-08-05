@extends('layouts.backend')

@section('subcontent')

    <div class="profile-content-area m-40px-tb card card-body">
      @if(!$item)
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
          <h5>@lang('member.order')</h5>
          <p>@lang('member.empty_order')</p>
        </div>
      @else
      <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
        <h5>@lang('member.order')</h5>
            <div class="row">
              @if($item->product)
                  <div class="col-md-4 m-10px-tb">
                      <div class="media">
                          <div class="only-icon-20">
                              <i class="fas fa-user"></i>
                          </div>
                          <div class="media-body p-15px-l lh-normal">
                              <div class="dark-color m-5px-b font-w-600">{{$item->product->title}}</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 m-10px-tb">
                      <div class="media">
                          <div class="only-icon-20">
                              <i class="fas fa-user"></i>
                          </div>
                          <div class="media-body p-15px-l lh-normal">
                              <div class="dark-color m-5px-b font-w-600">@lang('app.txt.apl'):</div>
                              <a class="body-color" href="#">{{$item->apl->name}}</a>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 m-10px-tb">
                      <div class="media">
                          <div class="only-icon-20">
                              <i class="fas fa-user"></i>
                          </div>
                          <div class="media-body p-15px-l lh-normal">
                              <div class="dark-color m-5px-b font-w-600">@lang('app.price'):</div>
                              <a class="body-color" href="#">{{$item->apl->name}}</a>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 m-10px-tb">
                      <div class="media">
                          <div class="only-icon-20">
                              <i class="fas fa-user"></i>
                          </div>
                          <div class="media-body p-15px-l lh-normal">
                              <div class="dark-color m-5px-b font-w-600">@lang('app.txt.tauxdereservation'):</div>
                              <a class="body-color" href="#">{{$item->tma}}</a>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 m-10px-tb">
                      <div class="media">
                          <div class="only-icon-20">
                              <i class="fas fa-user"></i>
                          </div>
                          <div class="media-body p-15px-l lh-normal pull-right">
                              <div class="dark-color m-5px-b font-w-600 badge">{{$item->tma}}</div>
                          </div>
                      </div>
                  </div>
              @endif
              <div class="col-md-4 m-10px-tb">
                  <div class="media">
                      <div class="media-body p-15px-l lh-normal pull-right">
                        <form action="{{route('shop.order.last')}}" method="post">
                          {{csrf_field()}}
                            <input type="hidden" name="action" value="session">
                          <button type="submit" class="btn btn-default pull-left">@lang('member.cancel_order')</button>
                        </form>
                        <a href="{{route('shop.checkout')}}" class="btn btn-primary pull-right">@lang('member.goto_payment')</a>
                      </div>
                  </div>
              </div>
            </div>
        </div>
      @endif        
    </div>

@endsection