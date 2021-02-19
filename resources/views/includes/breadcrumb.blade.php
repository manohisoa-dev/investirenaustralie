<!-- Page Title -->
@php
if(Request::segment(1) != ''){
	$menuInfo = \App\Models\Menu::where('libelle', Request::segment(1))->first();
	if(!empty($menuInfo)){
		$photo_base = $menuInfo->photo;
		if($photo_base != ''){
			$image_fond = asset('images/slider/'.$photo_base);
		}else{
			$image_fond = asset('images/slider/1.jpg');
		}
	}else{
		$image_fond = asset('images/slider/1.jpg');
	}
}else{
	$image_fond = asset('images/slider/1.jpg');
}
@endphp
<section class="section bg-center bg-cover bg-fixed effect-section" style="background-image: url({{ $image_fond }});">
    <div class="mask theme-bg opacity-5"></div>
    <div class="container">
        <div class="row justify-content-center p-50px-t">
            <div class="col-lg-8 text-center">
                <h2 class="white-color h1 m-20px-b">{{ trans('app.txt.'.str_replace(' ','_',strtolower($slot))) }}</h2>
                <ol class="breadcrumb white justify-content-center">
                    <li><a href="{{ route('home') }}">@lang('app.home')</a></li>
                    <li class="active">{{ trans('app.txt.'.str_replace(' ','_',strtolower($slot))) }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- En Page Title -->	