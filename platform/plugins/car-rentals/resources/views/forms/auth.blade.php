@php
    $icon = Arr::get($formOptions, 'icon');
    $heading = Arr::get($formOptions, 'heading');
    $description = Arr::get($formOptions, 'description');
@endphp

@if (Arr::get($formOptions, 'has_wrapper', 'yes') === 'yes')
<div class="container">
    <div class="row justify-content-center py-3">
        <div class="col-xl-6 col-lg-8">
        @endif
            <div class="card bg-body-tertiary border-0 auth-card">
                @if ($banner = Arr::get($formOptions, 'banner'))
                    {{ RvMedia::image($banner, $heading ?: '', attributes: ['class' => 'card-img-top mb-3']) }}
                @endif

                @if ($icon || $heading || $description)
                    <div class="card-header bg-body-tertiary border-0 p-4 pb-0">
                        <div @class(['d-flex flex-column flex-md-row align-items-start gap-3' => $icon, 'text-center' => ! $icon])>
                            @if ($icon)
                                <div class="bg-white p-3 rounded">
                                    <x-core::icon :name="$icon" class="text-primary" />
                                </div>
                            @endif
                            <div>
                                @if ($heading)
                                    <h3 class="fs-4 mb-1">{{ $heading }}</h3>
                                @endif
                                @if ($description)
                                    <p class="text-muted">{{ $description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card-body p-4 pt-3">
                    @if ($showStart)
                        {!! Form::open(Arr::except($formOptions, ['template'])) !!}
                    @endif

                    @if (session()->has('status'))
                        <div role="alert" class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @elseif (session()->has('auth_error_message'))
                        <div role="alert" class="alert alert-danger">
                            {{ session('auth_error_message') }}
                        </div>
                    @elseif (session()->has('auth_success_message'))
                        <div role="alert" class="alert alert-success">
                            {{ session('auth_success_message') }}
                        </div>
                    @elseif (session()->has('auth_warning_message'))
                        <div role="alert" class="alert alert-warning">
                            {{ session('auth_warning_message') }}
                        </div>
                    @endif

                    @if ($showFields)
                        {{ $form->getOpenWrapperFormColumns() }}

                        @foreach ($fields as $field)
                            @continue(in_array($field->getName(), $exclude))

                            {!! $field->render() !!}
                        @endforeach

                        {{ $form->getCloseWrapperFormColumns() }}
                    @endif

                    @if ($showEnd)
                        {!! Form::close() !!}
                    @endif

                    @if ($form->getValidatorClass())
                        @push('footer')
                            {!! $form->renderValidatorJs() !!}
                        @endpush
                    @endif
                </div>
            </div>
            @if (Arr::get($formOptions, 'has_wrapper', 'yes') === 'yes')
        </div>
    </div>
</div>
@endif
