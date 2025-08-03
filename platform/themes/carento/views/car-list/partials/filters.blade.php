@php
    [$carCategories, $carColors, $carTypes, $carTransmissions, $carFuelTypes, $carBookingLocations, $carReviewScores, $carMaxRentalRate, $carAmenities, $advancedTypes] = CarListHelper::dataForFilter(request()->input());

   $layout = BaseHelper::stringify(request()->query('layout'));

    if (!in_array($layout, ['list', 'grid'])) {
        $layout = $defaultLayout ?? 'grid';
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
<div class="content-left order-lg-first">
    {!! Form::open(['url' => route('public.ajax.cars'), 'method' => 'GET', 'id' => 'cars-filter-form', 'class' => 'sidebar-filter-mobile__content']) !!}
        <input type="hidden" name="page" value="{{ $cars->currentPage() ?: 1 }}" data-value="{{ $cars->currentPage() ?: 1 }}" />
        <input type="hidden" name="per_page" />
        <input type="hidden" name="layout" value="{{ $layout }}" />
        <input type="hidden" name="layout_col" value="{{ $col }}" />
        <input type="hidden" name="filter" value="{{ $enableFilter }}" />
        <input type="hidden" name="sort_by" value="{{ BaseHelper::stringify(request()->query('sort_by')) }}" />
        <input type="hidden" name="start_date" value="{{ BaseHelper::stringify(request()->query('start_date')) }}" />
        <input type="hidden" name="end_date" value="{{ BaseHelper::stringify(request()->query('end_date')) }}" />
    {!! Form::close() !!}

    <div class="card card-filters-wrapper border-1 background-body p-3">

    {{-- Location --}}
        @if (CarRentalsHelper::isEnabledFilterCarsBy('locations') && is_plugin_active('location') && (empty($stateId) && empty($cityId)))
            <div class="filter-block mb-30">
                <div class="mb-3 select-style select-style-icon">
                    <select class="form-control submit-form-filter form-icons select-active select-location"
                        form="cars-filter-form"
                        id=""
                        name=""
                        data-location-type="{{ theme_option('car_location_filter_by', 'state') }}"
                        data-placeholder="{{ BaseHelper::stringify(request()->query('location')) ?: __('Select location') }}"
                    >
                    </select>
                    <img class="icon-location" src="{{ Theme::asset()->url('images/icons/location.svg') }}" alt="icon location" />
                    
                </div>
            </div>
        @endif

        {{-- Vehicle Condition --}}
        @if(CarRentalsHelper::isEnabledFilterCarsBy('vehicle_condition'))
            <div class="block-filter border-1 mb-3">
                <h6 class="text-lg-bold item-collapse neutral-500">{{  __('Vehicle Condition') }}</h6>
                <div class="box-collapse scrollFilter car-filter-checkbox">
                    <select name="adv_type" form="cars-filter-form">
                        @foreach($advancedTypes as $type => $label)
                            @php $advType = request()->input('adv_type', 'all') ?: 'all'; @endphp
                            <option @selected($advType === $type) value="{{ $type }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        <hr style="divider">

        {{-- Rental Rate --}}
        @if($carMaxRentalRate)
            <div class="block-filter border-1 mb-3">
                <h6 class="text-lg-bold item-collapse neutral-1000">{{ __('Filter Price') }}</h6>
                <div class="box-collapse scrollFilter">
                    <div class="pt-20">
                        <div class="box-slider-range">
                            <div id="slider-range"
                                 data-current-range="{{ request()->query('rental_rate_to') > 0 ? BaseHelper::stringify(request()->query('rental_rate_to')) : 0 }}"
                                 data-max-rental-rate-range="{{ $carMaxRentalRate }}"
                                 data-currency="{{ get_application_currency()?->title }}"
                                 data-currency-rate="{{ get_application_currency()?->exchange_rate }}">
                            </div>
                            <div class="box-value-price">
                                <span class="text-md-medium neutral-1000 rental-rate-from">{{ format_price(0) }}</span>
                                <span class="text-md-medium neutral-1000 rental-rate-to">{{ format_price($carMaxRentalRate) }}</span>
                            </div>
                            <input class="input-disabled form-control submit-form-filter value-money" name="rental_rate_from" type="hidden" value="{{ request()->query('rental_rate_from') > 0 ? BaseHelper::stringify(request()->query('rental_rate_from')) : 0 }}">
                            <input class="input-disabled form-control submit-form-filter value-money" name="rental_rate_to" type="hidden" value="{{ BaseHelper::stringify(request()->query('rental_rate_to', $carMaxRentalRate)) }}" data-default-value="{{ $carMaxRentalRate }}">
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <hr style="divider">

        {{-- Dynamic Filters --}}
        @php $firstDynamic = true; @endphp
        @foreach([
            ['items' => $carCategories, 'title' => __('Car categories'), 'name' => 'car_categories'],
            ['items' => $carColors, 'title' => __('Car colors'), 'name' => 'car_colors'],
            ['items' => $carTypes, 'title' => __('Car types'), 'name' => 'car_types'],
            ['items' => $carTransmissions, 'title' => __('Car transmissions'), 'name' => 'car_transmissions'],
            ['items' => $carAmenities, 'title' => __('Car Amenities'), 'name' => 'car_amenities'],
            ['items' => $carFuelTypes, 'title' => __('Fuel types'), 'name' => 'car_fuel_types'],
            
        ] as $filter)
            @if($filter['items']->isNotEmpty())
                @if (!$firstDynamic)
                    <hr style="divider">
                @endif
                @php $firstDynamic = false; @endphp

                <div class="block-filter border-1 mb-3">
                    <h6 class="text-lg-bold item-collapse neutral-1000">{{ $filter['title'] }}</h6>
                    <div class="box-collapse scrollFilter car-filter-checkbox">
                        <ul class="list-filter-checkbox">
                            @foreach($filter['items'] as $item)
                                <li>
                                    <label class="cb-container">
                                        <input type="checkbox"
                                               class="submit-form-filter"
                                               value="{{ $item->id }}"
                                               name="{{ $filter['name'] }}[]"
                                               id="check-{{ $filter['name'] }}-{{ $item->id }}"
                                               form="cars-filter-form"
                                               @checked(in_array($item->id, (array) request()->input($filter['name'], [])))
                                        >
                                        <span class="text-small truncate-1-custom">{{ $item->name ?? $item->detail_address }}</span>
                                        <span class="checkmark"></span>
                                    </label>
                                    <span class="number-item">{{ $item->cars_count ?: 0 }}</span>
                                </li>
                            @endforeach
                        </ul>
                        @if($filter['items']->count() > 5)
                            <div class="box-see-more mt-20 mb-25">
                                <span class="link-see-more link-see-more-js">{{ __('See more') }}</span>
                                <span class="link-see-more link-see-less">{{ __('See less') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach

        <hr style="divider">

        {{-- Review Scores --}}
        @if($carReviewScores->isNotEmpty())
            <div class="block-filter border-1 mb-3">
                <h6 class="text-lg-bold item-collapse neutral-1000">{{ __('Review Score') }}</h6>
                <div class="box-collapse scrollFilter">
                    <ul class="list-filter-checkbox">
                        @foreach($carReviewScores as $score)
                            <li>
                                <label class="cb-container">
                                    <input type="checkbox"
                                           class="submit-form-filter"
                                           value="{{ $score->star }}"
                                           name="car_review_scores[]"
                                           id="check-car-review-score-{{ $score->star }}"
                                           form="cars-filter-form"
                                           @checked(in_array($score->star, (array) request()->input('car_review_scores', [])))
                                    >
                                    @include(Theme::getThemeNamespace('views.car-list.partials.review-scores'), ['score' => $score->star])
                                    <span class="checkmark"></span>
                                </label>
                                <span class="number-item">{{ $score->cars_count ?: 0 }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

    </div> {{-- end card --}}
</div>
