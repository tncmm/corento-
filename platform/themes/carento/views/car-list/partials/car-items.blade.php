@php
    $layout = BaseHelper::stringify(request()->query('layout'));

    if (!in_array($layout, ['list', 'grid'])) {
        $layout = 'list';
    }

    $col = BaseHelper::stringify(request()->query('col'));

    if (empty($col)) {
        $col = (int) ($layoutCol ?? 4);
    }

    if(empty($enableFilter)) {
        $enableFilter = BaseHelper::stringify(request()->query('filter'));

        if (empty($enableFilter)) {
            $enableFilter = 'no';
        }
    }
@endphp

<div class="content-right cars-listing bg-light p-4 rounded">
    @if($enableFilter === 'no')
        {!! Form::open(['url' => route('public.ajax.cars'), 'method' => 'GET', 'id' => 'cars-filter-form', 'class' => 'sidebar-filter-mobile__content']) !!}
        <input type="hidden" name="page" value="{{ $cars->currentPage() ?: 1 }}" data-value="{{ $cars->currentPage() ?: 1 }}" />
        <input type="hidden" name="per_page" />
        <input type="hidden" name="layout" value="{{ $layout }}" />
        <input type="hidden" name="layout_col" value="{{ $col }}" />
        <input type="hidden" name="filter" value="{{ $enableFilter }}" />
        <input type="hidden" name="sort_by" value="{{ BaseHelper::stringify(request()->query('sort_by')) }}" />
    @endif

    <div class="box-filters mb-25 pb-5 border-bottom border-1">
        <div class="row align-items-center">
            <div class="col-xl-4 col-md-4 mb-10 text-lg-start text-center">
                <div class="box-view-type">
                    
                    <span class="text-sm-bold neutral-500 number-found">{{ $cars->total() }} items found</span>
                </div>
            </div>
            <div class="col-xl-8 col-md-8 mb-10 text-lg-end text-center">
                <div class="box-item-sort">
                    
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
