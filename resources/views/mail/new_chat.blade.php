<x-mail::message>
# New Message Alert

Hello {{ $fname }}, 

You have a new messages on your TastyHouse account!

<x-mail::button :url="$chatUrl">
Chat Now
</x-mail::button>

Click on the button above to view the message

</x-mail::message>
