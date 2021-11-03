@component('mail::message')
# {{ $content['title'] }}
{!! $content['body'] !!}
@endcomponent

{{-- Subcopy --}}
{{--@isset($content['body'])--}}
    {{--@component('mail::subcopy')--}}
        {{--@lang('app.txt.trouble_link', [ 'link'=>$content['actionUrl'], 'url'=>$content['actionUrl'] ] )--}}
    {{--@endcomponent--}}
{{--@endisset--}}