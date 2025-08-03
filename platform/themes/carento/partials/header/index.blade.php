@php
    $isHeaderTransparent = theme_option('is_header_transparent', false);
@endphp

{!! apply_filters('ads_render', null, 'header_before', ['class' => 'mb-2']) !!}

<header @class(['header sticky-bar', 'header-home-2' => ! $isHeaderTransparent])>
    @if (theme_option('display_header_top', true))
        {!! Theme::partial('header.header-top') !!}
    @endif

    <div @class(['container-fluid', 'background-body' => ! $isHeaderTransparent])>
        <div class="main-header">
            <div class="header-left">
                {!! Theme::partial('logo') !!}


                <div class="header-right">
    {!! Theme::partial('header.action-buttons.index') !!}
    <div class="d-none d-xl-inline-block me-3">
    <a href="{{ url('/help-center') }}" class="text-sm-medium text-uppercase">
        <i class="fas fa-question-circle me-1"></i> {{ __('Help Center') }}
    </a>
</div>

    {{-- 💱 Currency Switcher --}}
    @if (is_plugin_active('car-rentals') && ($currencies = get_all_currencies()) && $currencies->count() > 1)
    <div class="">
        <span class="text-14-medium icon-list icon-cart"><span class="text-sm-medium">{{ get_application_currency()->title }}</span></span>
        <div class="dropdown-cart">
            <ul>
                @foreach ($currencies as $currency)
                    @continue($currency->getKey() === get_application_currency()->getKey())
                    <li>
                        <a class="text-sm-medium" href="{{ route('public.currency.switch', $currency->title) }}">{{ $currency->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif




    {{-- 🌗 Theme Mode Toggle --}}
    @if (theme_option('hide_theme_mode_switcher', 'no') !== 'yes')
        <div class="top-button-mode me-3"> {{-- ⬅️ added spacing --}}
            <a class="btn btn-mode change-mode" href="#" title="{{ __('Toggle dark/light mode') }}" data-bs-theme-value="dark">
                <img class="light-mode" src="{{ Theme::asset()->url('images/icons/light.svg') }}" alt="{{ __('Light mode') }}" />
                <img class="dark-mode" src="{{ Theme::asset()->url('images/icons/light-w.svg') }}" alt="{{ __('Dark mode') }}" />
            </a>
        </div>
    @endif

    
    
</div>

            </div>
        </div>
    </div>
</header>

{!! apply_filters('ads_render', null, 'header_after', ['class' => 'mt-2']) !!}
