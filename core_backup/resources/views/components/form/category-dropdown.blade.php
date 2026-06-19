@props([
    'title' => '',
    'name' => '',
    'id' => '',
    'class' => '',
    'selectType' => 'default',
])


@php
    $allCategories = \Modules\Service\Entities\Category::all_categories();
@endphp



@if ($selectType === 'alternative')
    <select name="{{ $name ?? '' }}" id="{{ $id ?? '' }}" class="inf-custom-select {{ $class ?? '' }}">
        <option value="">{{ __('Select Category') }}</option>
        @foreach ($allCategories as $data)
            <option value="{{ $data->id }}" {{ old($name) == $data->id ? 'selected=selected' : '' }}>
                {{ $data->category }}</option>
        @endforeach
    </select>
@else
    <div class="single-input mt-3">
        <label class="label-title">{{ $title }}</label>
        <select name="{{ $name ?? '' }}" id="{{ $id ?? '' }}" class="inf-custom-select {{ $class ?? '' }}">
            <option value="">{{ __('Select Category') }}</option>
            @foreach ($allCategories as $data)
                <option value="{{ $data->id }}" {{ old($name) == $data->id ? 'selected=selected' : '' }}>
                    {{ $data->category }}</option>
            @endforeach
        </select>
    </div>
@endif
