@props([
    'title' => '',
    'name' => '',
    'id' => '',
    'class' => '',
    'selectType' => 'default',
])

@php
    $allSkills = \App\Models\Skill::all_skills();
@endphp

@if ($selectType === 'alternative')
    <select name="{{ $name ?? '' }}" id="{{ $id ?? '' }}" class="inf-custom-select  {{ $class ?? '' }}">
        <option value="">{{ __('Select Skill') }}</option>
        @foreach ($allSkills as $data)
            <option value="{{ $data->id }}">{{ $data->skill }}</option>
        @endforeach
    </select>
@else
    <div class="single-input mt-3">
        <label class="label-title">{{ $title }}</label>
        <select name="{{ $name ?? '' }}" id="{{ $id ?? '' }}" class="inf-custom-select {{ $class ?? '' }}">
            <option value="">{{ __('Select Skill') }}</option>
            @foreach ($allSkills as $data)
                <option value="{{ $data->id }}">{{ $data->skill }}</option>
            @endforeach
        </select>
    </div>
@endif
