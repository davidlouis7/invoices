@if ($errors->any())
    <div class="alert alert-danger">
        <div>
            <div class="d-flex">
                <i class="fa-solid fa-face-frown {{app()->getLocale() == 'ar' ? 'ms-5' : 'me-5'}}"></i>
                <span class="mt-1">{{$errors->first()}}</span>
            </div>
        </div>
    </div>
@endif
