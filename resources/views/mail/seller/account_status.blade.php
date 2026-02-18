<x-mail::message>
# Account Status Update

@if ($status == true)
Your account ban has now been lifted. You can now login to continue using our platform.
@else
Your account has now been banned due to some suspicious activites. Please contact support if you think the decision is not right.
@endif

</x-mail::message>
