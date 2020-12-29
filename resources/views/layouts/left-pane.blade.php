<div class="col-md-3 mt-5">
    <div class="panel text-center">
        <div>
            <div class="avatar m-auto">
                <a href="/profile/{{ Auth::id() }}">
                    <img src="{{ auth()->user()->profile->avatar }}" class="avatar" alt="">
                </a>
            </div>
            <div class="mt-2">
                <p class="font-weight-bolder">{{ getFullName(auth()->user()->id) }}</p>
            </div>

            <div class="mt-1">
                <p class="small">{{ auth()->user()->profile->bio }}</p>
            </div>
        </div>
    </div>
</div>
