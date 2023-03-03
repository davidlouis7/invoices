<div class="d-flex align-items-center">
    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
        <a href="{{route('products.show', $row->id)}}">
            <div class="image image-circle image-mini {{ app()->getLocale() == 'ar' ? 'ms-3' : 'me-3' }}">
                <img src="{{$row->product_image}}" alt="" class="user-img object-cover" width="50px" height="50px">
            </div>
        </a>
    </div>
    <div class="d-flex flex-column">
        <a href="{{route('products.show', $row->id)}}" class="mb-1 text-decoration-none">{{$row->name}}</a>
        <span>{{$row->code}}</span>
    </div>
</div>
