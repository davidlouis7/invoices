<div class="d-flex align-items-center">
    <a href="#">
        <div class="image image-circle image-mini {{ app()->getLocale() == 'ar' ? 'ms-3' : 'me-3' }}">
            <img src="{{ $row->profile_image }}" alt="user" class="user-img">
        </div>
    </a>
    <div class="d-flex flex-column">
        <a href="{{ route('users.show', $row->id) }}" class="mb-1 text-decoration-none fs-6">
            {!! $row->full_name !!}
        </a>
        <span class="fs-6">{{ $row->email }}</span>
    </div>
</div>
