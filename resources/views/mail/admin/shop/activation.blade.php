<x-mail::message>
# Introduction



Shop Name : {{$shop->name}}
Shop Owner : {{$shop->owner->name}}
<x-mail::button :url="url('/admin/shops')">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
