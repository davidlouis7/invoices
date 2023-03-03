<footer class="border-top w-100 pt-4 mt-7">
    <div class="d-flex justify-content-between">
        <p class="fs-6 text-gray-600">All Rights Reserved ©{{ \Carbon\Carbon::now()->year }}
            <a href="{{ url('/') }}" class="text-decoration-none">{{ getAppName() }}</a>
        </p>
        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
        <div>v{{ getCurrentVersion() }}</div>
        @endif
    </div>
</footer>

