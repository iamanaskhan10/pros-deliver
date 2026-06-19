@props([
    'title' => '',
    'name' => '',
    'id' => $name,
    'type' => 'number',
    'value' => null,  // ← accept explicit value (e.g., from edit form)
    'placeholder' => '',
    'class' => 'form--control',
    'divClass' => 'mb-3',
    'labelClass' => 'label-title',
    'step' => '1',
    'min' => '0',
    'helper' => __('Enter minimum number of followers required'),
])

@php
    // Priority: old input > explicit value > default 0
    $inputValue = old($name, $value ?? 0);
@endphp

<div class="single-input {{ $divClass }}">
    @if ($title)
        <label for="{{ $id }}" class="{{ $labelClass }}">{{ $title }}</label>
    @endif

    <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            value="{{ $inputValue }}"
            placeholder="{{ $placeholder }}"
            class="{{ $class }}"
            step="{{ $step }}"
            min="{{ $min }}"
            {{ $attributes }}
    >

    @if ($helper)
        <small class="form-text text-muted">{{ $helper }}</small>
    @endif
</div>