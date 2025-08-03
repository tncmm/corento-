<div class="container position-relative z-2">
    <div class="text-start mb-40">
        @if($title = $shortcode->title)
            <h2 class="heading-4 my-4 shortcode-title">{!! BaseHelper::clean($title) !!}</h2>
        @endif

        @if ($description = $shortcode->description)
            <p class="text-xl-medium shortcode-subtitle">{!! BaseHelper::clean($description) !!}</p>
        @endif
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($faqs as $faq)
            <div class="col">
                <div class="h-100">
                    @if($faq->category && $faq->category->name)
                        <div class="text-muted small mb-1">{!! BaseHelper::clean($faq->category->name) !!}</div>
                    @endif
                    <h6 class="fw-bold mb-1">{!! BaseHelper::clean($faq->question) !!}</h6>
                    @if($faq->category && $faq->category->description)
                        <p class="text-sm text-muted">{!! BaseHelper::clean($faq->category->description) !!}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-12 wow fadeInUp mt-4">
            <div class="d-flex justify-content-center gap-2">
                @if(($btnSecondaryLabel = $shortcode->button_secondary_label) && ($btnSecondaryUrl = $shortcode->button_secondary_url))
                    <a class="btn btn-gray2" href="{{ $btnSecondaryUrl }}">
                        {!! BaseHelper::clean($btnSecondaryLabel) !!}
                        <svg class="svg-icon-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 15L15 8L8 1M15 8L1 8" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                @endif

                @if (($btnPrimaryLabel = $shortcode->button_primary_label) && ($btnPrimaryUrl = $shortcode->button_primary_url))
                    <a class="btn btn-primary rounded-3" href="{{ $btnPrimaryUrl }}">
                        {!! BaseHelper::clean($btnPrimaryLabel) !!}
                        <svg class="svg-icon-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 15L15 8L8 1M15 8L1 8" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                @endif
                    </div>
    </div>

    <div class="row mt-6">
        <div class="col-13">
            <div class="text-start">
                <a href="/faq" class="btn px-4 py-3 border border-2 border-dark rounded">
                    View all FAQs
                </a>
            </div>
        </div>
    </div>
</div>
