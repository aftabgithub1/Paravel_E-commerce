@component('mail::message')
Hello **{{$name}}**,  {{-- use double space for line break --}}
{{$message}}

Sincerely,
{{$sender}}
@endcomponent