@extends('layouts.app')

@section('content')

<!-- Main -->
<main>
    <!-- Page Title -->
    @php
        if(@getimagesize($item->imageUrl())) {
            $img=$item->imageUrl();
        } else {
            $img=asset('ulooad/images/blog/iea.png');
        }
		
		$lang = \App::getLocale();
		$slug = 'slug_'.$lang;
		$title = 'title_'.$lang;
		$content = 'content_'.$lang;
    @endphp
    <section class="bg-center bg-cover bg-fiexd effect-section" style="background-image: url({{ $img }});">
        <div class="mask dark-g-bg opacity-7"></div>
        <div class="container">
            <div class="row screen-65 justify-content-center align-items-center p-100px-tb">
                <div class="col-lg-10 text-center m-50px-t">
                    <h1 class="display-4 white-color m-25px-b">{{ $item->$title }}</h1>
                    <div class="d-flex align-items-center m-25px-t justify-content-center text-left">
                        <div>
                            <div class="avatar-50 border-radius-50">
                                <img src="{{$item->imageUrl()}}" title="{{$item->$title}}" alt="{{$item->$title}}">
                            </div>
                        </div>
                        <div class="p-15px-l">
                            <p class="h6 white-color m-0px">{{$item->author ? $item->author->name : ""}}</p>
                            <small class="white-color-light">Co-Founder</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->
    <!-- Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <span>
                        @include('includes.alerts')
                    </span>

                    <div class="nav p-25px-b">
                        <span class="dark-color font-w-600"><i class="fas fa-calendar-alt "></i> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year }}</span>
                        <!-- <a class="dark-color font-w-600 m-15px-l" href="#"><i class="far fa-folder-open"></i> Categories</a> -->
                    </div>

                    <div class="text-justify">{!! $item->$content !!}</div>

                    <div class="p-25px-tb m-35px-tb border-top-1 border-bottom-1 border-color-gray">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="m-0px">@lang('app.txt.sharepost')</h5>
                            </div>
                            <div>
                                <div class="nav justify-content-center justify-content-md-end social-icon si-30 gray">
                                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(URL::current()) }}"><i class="fab fa-facebook-f"></i></a>
                                    <a target="_blank" href="https://twitter.com/intent/tweet?text={{ urlencode(URL::current()) }}"><i class="fab fa-twitter"></i></a>
                                    <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(URL::current()) }}"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="media gray-bg p-20px">
                        <div class="avatar-80 border-radius-50">
                            <img src="{{$item->imageUrl()}}" title="" alt="">
                        </div>
                        <div class="media-body p-20px-l">
                            <h5 class="m-10px-b">{{$item->author ? $item->author->name : ""}}</h5>
                            {{-- <p class="m-0px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> --}}
                        </div>
                    </div>
                    <div class="comments-area m-40px-t m-50px-b">
                        <div class="border-bottom-1 border-color-gray p-10px-b m-25px-b">
                            <h4 class="m-0px">{{$item->comments_count}} {{ ($item->comments_count>1) ? trans('app.txt.commentaires') : trans('app.txt.commentaire') }}</h4>
                        </div>
                        <ul class="comment-list">
                            @foreach ($item->comments as $comment)
                                <li class="comment">
                                    @if ($comment->reply_id == 0)
                                        <article class="comment-body">
                                            <div class="comment-meta d-flex align-items-center">
                                                <div class="comment-author"><img src="{{ App\Models\User::find($comment->user_id)->imageUrl() }}" title="" alt=""></div>
                                                <div class="comment-metadata">
                                                    <div class="c-name">{{ App\Models\User::find($comment->user_id)->name }}</div>
                                                    <span class="c-date">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->year }}</span>
                                                </div>
                                            </div>
                                            <div class="comment-content">
                                                <p>{{ getGTranslateAutoDetect( App::getLocale() ,$comment->content) }}.</p>
                                            </div>

                                            @if (Auth::id() && Auth::id() !== $comment->user_id)
                                                <div class="comment-reply">
                                                    <a class="m-btn m-btn-t-theme m-btn-sm btn_reply" href="javascript:void(0)" value="{{ $comment->id }}">@lang('app.btn.reply')</a>
                                                </div>
                                            @endif
                                        </article>

                                        @if ($comment->replies)
                                            @foreach ($comment->replies as $repl)
                                                <ul class="children">
                                                    <li class="comment">
                                                        <article class="comment-body">
                                                            <div class="comment-meta d-flex align-items-center">
                                                                <div class="comment-author"><img src="{{ App\Models\User::find($repl->user_id)->imageUrl() }}" title="" alt=""></div>
                                                                <div class="comment-metadata">
                                                                    <div class="c-name">{{ App\Models\User::find($repl->user_id)->name }}</div>
                                                                    <span class="c-date">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $repl->created_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $repl->created_at)->year }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="comment-content">
                                                                <p>{{ getGTranslateAutoDetect( App::getLocale() ,$repl->content) }}.</p>
                                                            </div>
                                                            @if (Auth::id() && Auth::id() !== $repl->user_id )
                                                                <div class="comment-reply">
                                                                    <a class="m-btn m-btn-t-theme m-btn-sm btn_reply" href="javascript:void(0)" value="{{ $comment->id }}">@lang('app.btn.reply')</a>
                                                                </div>
                                                            @endif
                                                        </article>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        @endif
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card gray-bg">
                        <div class="card-body">
                            @if (Auth::id())
                                <h4 class="m-30px-b">@lang('app.txt.leavereply')</h4>
                                <form action="{{ route('comment.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label">@lang('app.txt.yourcomment')</label>
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                <input type="hidden" name="blog_id" value="{{ $item->id }}">
                                                <input type="hidden" name="reply_id" value="0">
                                                <textarea class="form-control" rows="6" maxlength="5000" name="content" placeholder="..." aria-label="Please enter an answer." required="" data-msg="Please enter an answer." data-error-class="u-has-error" data-success-class="u-has-success">{{ session()->get('old')?session()->get('old'):'' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="m-btn m-btn-theme">@lang('app.btn.submit')</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="col-md-12">
                                    <button class="m-btn m-btn-theme col-md-12" type="button" id="btn_comment">@lang('app.txt.logintocomment')</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                    @include('includes.sidebar')
                <!-- fin sidebar -->

            </div>
        </div>
    </section>
    <!-- End Section -->
</main>

{{-- Modal --}}
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="commentModalLabel">@lang('app.txt.leavereply')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('comment.store') }}" method="POST" id="comment_form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label">@lang('app.txt.yourcomment')</label>
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <input type="hidden" name="blog_id" value="{{ $item->id }}">
                            <input type="hidden" name="reply_id" id="reply_id">
                            <textarea class="form-control" rows="6" name="content" placeholder="..." aria-label="How'd you hear about Front?" required="" data-msg="Please enter an answer." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="m-btn m-btn-theme" data-dismiss="modal">@lang('app.btn.close')</button>
          <button class="m-btn m-btn-theme" id="btn_reply_comment">@lang('app.btn.submit')</button>
        </div>
      </div>
    </div>
</div>
{{-- end modal --}}


{{-- Modal --}}
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('app.txt.login')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('login')}}" id="login_form" method="post">
                {{ csrf_field() }}
                {{ Session()->put('comment','login_comment') }}
                <div class="form-group">
                    <label class="form-control-label">@lang('app.txt.email')</label>
                    <input type="email" name="email" class="form-control" placeholder="Votre email *" required="required" value="{{ old('email') }}" autofocus>
                    <span>{{ $errors->has('email') ? ' has-error' : '' }}</span>
                </div>
                <div class="form-group">
                    <label class="form-control-label">@lang('app.txt.password')</label>
                    <input name="password"  type="password" placeholder="Votre mot de passe *" class="form-control" required="required">
                    <span>{{ $errors->has('password') ? ' has-error' : '' }}</span>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('app.form.login.remember')
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="m-btn m-btn-theme" data-dismiss="modal">@lang('app.btn.close')</button>
          <button type="button" id="btn_submit" class="m-btn m-btn-theme2nd">@lang('app.btn.login')</button>
        </div>
      </div>
    </div>
</div>
{{-- end modal --}}

@endsection

@push('script')
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        $('#btn_comment').click(function(){
            $('#loginModal').modal('show');
        });

        $('#btn_submit').click(function(){
            $('#login_form').submit();
        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                $('#login_form').submit();
            }
        });

        $('.btn_reply').click(function(){
            var comment_id = $(this).attr('value');
            $('#commentModal').modal('show');
            $('#reply_id').attr('value',comment_id);
        });

        $('#btn_reply_comment').click(function(){
            $('#comment_form').submit();
        });
    </script>
@endpush('script')

