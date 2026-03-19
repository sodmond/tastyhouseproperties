<x-mail::message>
# Email Verification

Copy and paste the link below into your web browser.

{{--<a href="{{ $url }}">{{ $url }}</a>--}}
<x-mail::panel>
    {{ $code }}
</x-mail::panel>

If you did not create an account, no further action is required.

</x-mail::message>
