@php
    Theme::set('pageTitle', $carMake->name);

    $layout = BaseHelper::stringify(request()->query('layout'));

    if (!in_array($layout, ['list', 'grid'])) {
        $layout = $defaultLayout ?? 'grid';
    }

    $col = BaseHelper::stringify(request()->query('col'));

    if (empty($col)) {
        $col = (int) ($layoutCol ?? 4);
    }

    $enableFilter = 'no';
    $carMake = $carMake->getKey();
@endphp

<div class="content-right cars-listing">
    @if($enableFilter === 'no')
        {!! Form::open(['url' => route('public.ajax.car_makes'), 'method' => 'GET', 'id' => 'cars-filter-form', 'class' => 'sidebar-filter-mobile__content']) !!}
        <input type="hidden" name="page" data-value="{{ $cars->currentPage() ?: 1 }}" />
        <input type="hidden" name="per_page" />
        <input type="hidden" name="layout" value="{{ $layout }}" />
        <input type="hidden" name="layout_col" value="{{ $col }}" />
        <input type="hidden" name="filter" value="{{ $enableFilter }}" />
        <input type="hidden" name="car_make" value="{{ $carMake }}" />
        <input type="hidden" name="sort_by" value="{{ BaseHelper::stringify(request()->query('sort_by')) }}" />
    @endif

    <div class="box-filters mb-25 pb-5 border-bottom border-1">
        <div class="row align-items-center">
            <div class="col-xl-4 col-md-4 mb-10 text-lg-start text-center">
                <div class="box-view-type">
                    <a @class(['display-type display-grid layout-car', 'active' => $layout === 'grid']) href="#"
                       data-layout="grid">
                        <svg width="22" height="22" viewbox="0 0 22 22" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 8V2.75C20 2.3375 19.6625 2 19.25 2H14C13.5875 2 13.25 2.3375 13.25 2.75V8C13.25 8.4125 13.5875 8.75 14 8.75H19.25C19.6625 8.75 20 8.4125 20 8ZM19.25 0.5C20.495 0.5 21.5 1.505 21.5 2.75V8C21.5 9.245 20.495 10.25 19.25 10.25H14C12.755 10.25 11.75 9.245 11.75 8V2.75C11.75 1.505 12.755 0.5 14 0.5H19.25Z"
                                fill=""></path>
                            <path
                                d="M20 19.25V14C20 13.5875 19.6625 13.25 19.25 13.25H14C13.5875 13.25 13.25 13.5875 13.25 14V19.25C13.25 19.6625 13.5875 20 14 20H19.25C19.6625 20 20 19.6625 20 19.25ZM19.25 11.75C20.495 11.75 21.5 12.755 21.5 14V19.25C21.5 20.495 20.495 21.5 19.25 21.5H14C12.755 21.5 11.75 20.495 11.75 19.25V14C11.75 12.755 12.755 11.75 14 11.75H19.25Z"
                                fill=""></path>
                            <path
                                d="M8 8.75C8.4125 8.75 8.75 8.4125 8.75 8V2.75C8.75 2.3375 8.4125 2 8 2H2.75C2.3375 2 2 2.3375 2 2.75V8C2 8.4125 2.3375 8.75 2.75 8.75H8ZM8 0.5C9.245 0.5 10.25 1.505 10.25 2.75V8C10.25 9.245 9.245 10.25 8 10.25H2.75C1.505 10.25 0.5 9.245 0.5 8V2.75C0.5 1.505 1.505 0.5 2.75 0.5H8Z"
                                fill=""></path>
                            <path
                                d="M8 20C8.4125 20 8.75 19.6625 8.75 19.25V14C8.75 13.5875 8.4125 13.25 8 13.25H2.75C2.3375 13.25 2 13.5875 2 14V19.25C2 19.6625 2.3375 20 2.75 20H8ZM8 11.75C9.245 11.75 10.25 12.755 10.25 14V19.25C10.25 20.495 9.245 21.5 8 21.5H2.75C1.505 21.5 0.5 20.495 0.5 19.25V14C0.5 12.755 1.505 11.75 2.75 11.75H8Z"
                                fill=""></path>
                        </svg>
                    </a>
                    <a @class(['display-type display-grid layout-car', 'active' => $layout === 'list']) href="#"
                       data-layout="list">
                        <svg width="21" height="21" viewbox="0 0 21 21" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4.788 0H1.09497C0.491194 0 0 0.486501 0 1.08456V4.74269C0 5.34075 0.491194 5.82729 1.09497 5.82729H4.788C5.39177 5.82729 5.88297 5.34075 5.88297 4.74269V1.08456C5.88297 0.486501 5.39177 0 4.788 0ZM4.80951 4.74273C4.80951 4.75328 4.79865 4.76404 4.788 4.76404H1.09497C1.08432 4.76404 1.07345 4.75328 1.07345 4.74273V1.08456C1.07345 1.07401 1.08432 1.06329 1.09497 1.06329H4.788C4.79865 1.06329 4.80951 1.07401 4.80951 1.08456V4.74273ZM7.53412 1.32686C7.53412 1.03321 7.77444 0.795211 8.07084 0.795211H20.4632C20.7596 0.795211 21 1.03321 21 1.32686C21 1.62046 20.7596 1.8585 20.4632 1.8585H8.07084C7.77444 1.8585 7.53412 1.62046 7.53412 1.32686ZM21 4.50043C21 4.79408 20.7597 5.03208 20.4633 5.03208H8.07084C7.77444 5.03208 7.53412 4.79408 7.53412 4.50043C7.53412 4.20683 7.77444 3.96879 8.07084 3.96879H20.4632C20.7597 3.96879 21 4.20683 21 4.50043ZM4.788 7.58633H1.09497C0.491194 7.58633 0 8.07283 0 8.67089V12.329C0 12.9271 0.491194 13.4136 1.09497 13.4136H4.788C5.39177 13.4136 5.88297 12.9271 5.88297 12.329V8.67089C5.88297 8.07288 5.39177 7.58633 4.788 7.58633ZM4.80951 12.3291C4.80951 12.3396 4.79865 12.3504 4.788 12.3504H1.09497C1.08432 12.3504 1.07345 12.3396 1.07345 12.3291V8.67094C1.07345 8.66039 1.08432 8.64967 1.09497 8.64967H4.788C4.79865 8.64967 4.80951 8.66039 4.80951 8.67094V12.3291ZM4.788 15.1727H1.09497C0.491194 15.1727 0 15.6592 0 16.2573V19.9154C0 20.5135 0.491194 21 1.09497 21H4.788C5.39177 21 5.88297 20.5135 5.88297 19.9154V16.2573C5.88297 15.6592 5.39177 15.1727 4.788 15.1727ZM4.80951 19.9154C4.80951 19.926 4.79865 19.9368 4.788 19.9368H1.09497C1.08432 19.9368 1.07345 19.926 1.07345 19.9154V16.2573C1.07345 16.2468 1.08432 16.236 1.09497 16.236H4.788C4.79865 16.236 4.80951 16.2468 4.80951 16.2573V19.9154ZM21 12.0868C21 12.3805 20.7597 12.6185 20.4633 12.6185H8.07084C7.77444 12.6185 7.53412 12.3805 7.53412 12.0868C7.53412 11.7932 7.77444 11.5552 8.07084 11.5552H20.4632C20.7597 11.5552 21 11.7932 21 12.0868ZM21 8.91328C21 9.20688 20.7597 9.44492 20.4633 9.44492H8.07084C7.77444 9.44492 7.53412 9.20688 7.53412 8.91328C7.53412 8.61963 7.77444 8.38163 8.07084 8.38163H20.4632C20.7597 8.38163 21 8.61963 21 8.91328ZM21 16.4996C21 16.7932 20.7597 17.0313 20.4633 17.0313H8.07084C7.77444 17.0313 7.53412 16.7932 7.53412 16.4996C7.53412 16.206 7.77444 15.968 8.07084 15.968H20.4632C20.7597 15.968 21 16.206 21 16.4996ZM21 19.6732C21 19.9668 20.7597 20.2048 20.4633 20.2048H8.07084C7.77444 20.2048 7.53412 19.9668 7.53412 19.6732C7.53412 19.3796 7.77444 19.1415 8.07084 19.1415H20.4632C20.7597 19.1415 21 19.3796 21 19.6732Z"
                                fill=""></path>
                        </svg>
                    </a>
                    <span class="text-sm-bold neutral-500 number-found">{{ $cars->total() }} items found</span>
                </div>
            </div>
            <div class="col-xl-8 col-md-8 mb-10 text-lg-end text-center">
                <div class="box-item-sort">
                    <a class="btn btn-sort" href="#">
                        <svg width="18" height="18" viewbox="0 0 18 18" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.25 6L5.25 3M5.25 3L2.25 6M5.25 3L5.25 15" stroke=""
                                  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M9.75 12L12.75 15M12.75 15L15.75 12M12.75 15L12.75 3" stroke=""
                                  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <div class="item-sort border-1">
                        <span class="text-xs-medium neutral-500 mr-5">Show</span>
                        <div class="dropdown dropdown-sort border-1-right">
                            <button class="btn dropdown-toggle" id="dropdownSort2" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    data-bs-display="static"><span>{{ $cars->perPage() }}</span></button>
                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort2">
                                @foreach($perPages ?? CarListHelper::getPerPageParams() as $value)
                                    <li>
                                        <a class="dropdown-item dropdown-sort-by per-page-item" href="#"
                                           data-per-page="{{ $value }}">{{ $value }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="item-sort border-1">
                        @include(Theme::getThemeNamespace('views.car-list.partials.sort-by-dropdown'))
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-grid-hotels wow fadeIn car-items">
        <div class="row position-relative">
            @include(Theme::getThemeNamespace('views.car-list.partials.loading-ajax'))

            @forelse($cars as $car)
                @include(Theme::getThemeNamespace('views.car-list.partials.car-item-' . $layout), [
                    'car' => $car,
                    'layoutCol' => $col
                ])
            @empty
                @include(Theme::getThemeNamespace('views.car-list.partials.car-item-empty'))
            @endforelse
        </div>
    </div>
    {!! $cars->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}

</div>
