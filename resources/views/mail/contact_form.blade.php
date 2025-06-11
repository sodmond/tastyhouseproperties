<x-mail::message>
# Contact Form Details 

See the details of the new user that has just submitted the contact form below;

<x-mail::panel>
@foreach($contactInfo as $key => $info)
<p><strong>{{ ucwords($key) }}:</strong> {{ $info }}</p>
@endforeach
</x-mail::panel>

</x-mail::message>
