@component('mail::message')
Hi {{$user->name}}

Your total work hours in the last month ({{$last_month}}) : <span style="color: blue">{{$totalHours}} hours</span>

{{-- @component('mail::button', ['url' => ''])
Click Your Post
@endcomponent --}}

@endcomponent