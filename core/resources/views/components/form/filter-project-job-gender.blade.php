<select name="{{ $name ?? '' }}" id="{{ $id ?? '' }}" class="form-control gender_select2 inf-custom-select">
    <option value="">{{ $innerTitle ?? '' }}</option>
    <option value="male">{{ __('Male') }}</option>
    <option value="female">{{ __('Female') }}</option>
    <option value="others">{{ __('Others') }}</option>
</select>
