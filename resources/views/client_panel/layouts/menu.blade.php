<li class="nav-item {{ Request::is('client/dashboard*') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('client.dashboard') }}">
        <span class="menu-icon">
            <i class="fa-solid fa-chart-pie {{ app()->getLocale() == 'ar' ? 'ps-3' : 'pe-3' }}"></i>
        </span>
        <span class="aside-menu-title">{{ __('messages.dashboard') }}</span>
    </a>
</li>

<li class="nav-item {{ Request::is('client/quotes*') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('client.quotes.index') }}">
        <span class="menu-icon">
            <i class="fa-solid fas fa-quote-left {{ app()->getLocale() == 'ar' ? 'ps-3' : 'pe-3' }}"></i>
        </span>
        <span class="aside-menu-title">{{__('messages.quotes')}}</span>
    </a>
</li>

<li class="nav-item {{ Request::is('client/invoices*') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('client.invoices.index') }}">
        <span class="menu-icon">
            <i class="far fa-file-alt {{ app()->getLocale() == 'ar' ? 'ps-3' : 'pe-3' }}"></i>
        </span>
        <span class="aside-menu-title">{{__('messages.invoices')}}</span>
    </a>
</li>

<li class="nav-item {{ Request::is('client/transactions*') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center py-3" aria-current="page"
        href="{{ route('client.transactions.index') }}">
        <span class="menu-icon">
            <i class="fas fa-money-check {{ app()->getLocale() == 'ar' ? 'ps-3' : 'pe-3' }}"></i>
        </span>
        <span class="aside-menu-title">{{__('messages.transactions')}}</span>
    </a>
</li>