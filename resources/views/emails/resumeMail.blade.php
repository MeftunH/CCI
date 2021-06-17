@component('mail::message')
    # {{ $mailData['title'] }}
    {{$file}}
    @component('mail::button', ['url' => $mailData['url']])
        Button Text
    @endcomponent
    {{ config('app.name') }}
@endcomponent
