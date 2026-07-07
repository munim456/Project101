<x-mail::message>
# New contact form message

**From:** {{ $contactMessage->name }} ({{ $contactMessage->email }})
@if($contactMessage->phone)
**Phone:** {{ $contactMessage->phone }}
@endif

{{ $contactMessage->message }}

<x-mail::button :url="route('admin.contact-messages.show', $contactMessage)">
View in Admin Dashboard
</x-mail::button>

Sent from the {{ config('app.name') }} website contact form.
</x-mail::message>
