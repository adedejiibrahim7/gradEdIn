{{--@component('mail:message')--}}
<div class="container">
    <div>
        <h3>Hello</h3>

        <div style="background-color: #3b2acd">
            <p>Please click the following link to update your admin details. Link expires soon</p>
            <p>{{ $link }}</p>
        </div>
        <p>Kind Regards</p>
    </div>
</div>
{{--    @endcomponent--}}
