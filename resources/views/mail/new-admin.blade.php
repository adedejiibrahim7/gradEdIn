{{--@component('mail:message')--}}
<div class="container">
    <div style="padding: 25px;">
        <h3>Hello</h3>
        <p>You just got registered as an admin of GradEdIn</p>
        <div>
            <p>Please click the following link to update your admin details and complete the process. Link expires soon</p>
            <p><a href="{{ $link }}">{{ $link }}</a></p>
        </div>
        <p>Kind Regards</p>
    </div>
</div>
{{--    @endcomponent--}}
