@component('mail::message')
# You have some pending payments

The body of your message.

@component('mail::table')
|Name|Payment|Due Date|Status|
|:---|:------|:-------|:-----|

@foreach ($payments as $payment)
|{{$payment['users']['name']}}|{{$payment['payment']}}|{{$payment['due_date']}}|Pending|

@endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
