@php
    $transmission = $car->transmission;
    $types = $car->types;
    $make = $car->make;
    $carUrl = $car->url;

    $query = [];

    if ($startDate = BaseHelper::stringify(request()->query('start_date'))) {
        $query['rental_start_date'] = $startDate;
    }

    if ($endDate = BaseHelper::stringify(request()->query('end_date'))) {
        $query['rental_end_date'] = $endDate;
    }

    if ($query) {
        $carUrl = $car->url . '?' . http_build_query($query);
    }
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<div class="col-xl-12 col-lg-12 mb-4">
    <div class="d-flex border rounded overflow-hidden background-body shadow-sm" style="min-height: 180px;">

        {{-- Sol: Görsel --}}
        <div class="d-flex align-items-center justify-content-center " style="min-width: 200px;">
            <a href="{{ $carUrl }}">
                <img src="{{ RvMedia::getImageUrl($car->image, 'medium-rectangle', false, RvMedia::getDefaultImage()) }}"
                     alt="{{ $car->name }}"
                     style="max-width: 180px; height: auto; object-fit: cover;">
            </a>
        </div>

        {{-- Orta: Bilgi --}}
        <div class="flex-grow-1 d-flex flex-column justify-content-between p-3">
            <div>


                {{-- Başlık --}}
                <h5 class="mb-2 fw-semibold">
                    <h6 href="{{ $carUrl }}" class="text-dark text-decoration-none">{{ $car->name }}</h6>
                </h5>

                {{-- Lokasyon --}}
                @if($pickAddress = $car->pickupAddress)
                    <p class="mb-2 text-muted text-sm">
                        <strong>Pick-Up Location:</strong> {{ BaseHelper::clean($pickAddress->detail_address) ?? 'Free Shuttle Bus' }}
                    </p>
                @endif

                {{-- Özellikler: Görsel sırasına göre ama sadece mevcut olanlar --}}
                <div class="row text-sm text-secondary">
                    @if($car->number_of_seats)
                        <div class="col-4 mb-2">
                            <i class="fa-solid fa-user-group me-1 text-dark"></i> {{ $car->number_of_seats }} Seats
                        </div>
                    @endif
                    @if(!empty($car->mileage) && strtolower($car->mileage) === 'unlimited')
                        <div class="col-4 mb-2">
                            <i class="fa-solid fa-road me-1 text-dark"></i> Unlimited Mileage
                        </div>
                    @endif
                    @if(!empty($car->number_of_bags))
                        <div class="col-4 mb-2">
                            <i class="fa-solid fa-suitcase-rolling me-1 text-dark"></i> {{ $car->number_of_bags }} Bags
                        </div>
                    @endif
                    <div class="col-4 mb-2">
                        <i class="fa-solid fa-right-left me-1 text-dark"></i> Same to Same
                    </div>
                    @if($transmission && $transmission->name)
                        <div class="col-4 mb-2">
                            <i class="fa-solid fa-gear me-1 text-dark"></i> {{ $transmission->name }}
                        </div>
                    @endif
                    <div class="col-4 mb-2">
                        <i class="fa-solid fa-shield-halved me-1 text-dark"></i> Damage & theft coverage
                    </div>
                </div>
            </div>

            {{-- Puan --}}
            @if($car->avg_review)
                <div class="d-inline-flex align-items-center mt-2 px-2 py-1 bg-success text-white rounded" style="width: fit-content;">
                    <span class="fw-bold me-1">{{ number_format($car->avg_review, 1) }}</span>
                    <span class="text-white small">Good</span>
                </div>
            @endif
        </div>

        {{-- Sağ: Fiyat & Buton --}}
        <div class="d-flex flex-column justify-content-end text-center bg-body-secondary border-start p-3" style="min-width: 180px;">
            <div class="mb-2">
                <h4 class="text-dark mb-0">€ {{ number_format($car->price_for_9_days ?? 235.17, 2) }}</h4>
            </div>
            <div>
                <a href="{{ $carUrl }}" class="btn w-100 text-white" style="background-color: #007b99;">Select</a>
            </div>
        </div>
    </div>
</div>
