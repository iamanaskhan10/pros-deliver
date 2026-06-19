@extends('backend.layout.master')
@section('title', __('Assign Permission'))
@section('style')
    <style>
        .simplePresentCart-one {
            padding: 30px 24px;
            border-radius: 16px;
        }

        .white-bg {
            background: var(--white);
        }

        .mb-24 {
            margin-bottom: 24px;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

        .section-tittle-one .title {
            color: var(--heading-color);
            font-family: var(--heading-font);
            text-transform: capitalize;
            font-size: 18px;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 10px;
            display: inline-block;
            position: relative;
            z-index: 0;
        }

        .cmn-btn.style-3 {
            overflow: hidden;
            -webkit-transition: border-color 0.3s, background-color 0.3s;
            transition: border-color 0.3s, background-color 0.3s;
            -webkit-transition-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
            transition-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
        }

        .cmn-btn.style-7::after,
        .cmn-btn.style-5 span,
        .cmn-btn.style-5::before,
        .cmn-btn.style-5,
        .cmn-btn.style-3::after,
        .cmn-btn.style-3,
        .cmn-btn {
            padding: 7px 16px;
        }

        .cmn-btn {
            display: inline-block;
            min-width: 100px;
            margin-bottom: 10px;
            border: inherit;
            background: inherit;
            vertical-align: middle;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .border-style-solid {
            border-style: solid !important;
        }

        .border-1 {
            border-width: 1px !important;
        }

        .border-main-one {
            border-color: var(--main-color-one) !important;
            color: var(--main-color-one);
        }

        .radius-16 {
            border-radius: 16px !important;
        }

        .btn-danger {
            background-color: var(--danger-color) !important;
            border-color: var(--danger-color) !important;
        }

        .custom-dataTable,
        .custom-dataTable * {
            font-size: 12px;
        }

        .custom-dropdown button {
            background: none;
            padding: 0;
            border: 0;
            font-size: 40px;
            color: #A1A5A8;
            line-height: 1;
        }

        .custom-dataTable,
        .custom-dataTable * {
            font-size: 12px;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .custom-dataTable,
        .custom-dataTable * {
            font-size: 12px;
        }

        .dropdown-toggle {
            white-space: nowrap;
        }

        .custom-dataTable .custom-dropdown button>i {
            font-size: 30px !important;
            font-weight: 700;
            color: #333;
            border: 1px solid #e2e2e2e2;
            border-radius: 10px;
            line-height: 20px;
            padding: 2px 6px;
        }

        .dropdown-menu {
            border: 0;
            -webkit-box-shadow: 0 3px 12px rgba(45, 23, 191, 0.09);
            box-shadow: 0 3px 12px rgba(45, 23, 191, 0.09);
        }

        .custom-dataTable,
        .custom-dataTable * {
            font-size: 12px;
        }

        .swal_delete_button {
            cursor: pointer;
        }

        .dropdown-item {
            font-weight: 500;
            color: var(--paragraph-color);
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: var(--bs-dropdown-item-padding-y) var(--bs-dropdown-item-padding-x);
            clear: both;
            font-weight: 400;
            color: var(--bs-dropdown-link-color);
            text-align: inherit;
            text-decoration: none;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .custom-dataTable,
        .custom-dataTable * {
            font-size: 12px;
        }

        .custom-dataTable td {
            font-size: 12px;
        }

        .cmn-btn1 {
            font-family: var(--heading-font);
            -webkit-transition: 0.4s;
            transition: 0.4s;
            border: 1px solid transparent;
            background: var(--main-color-one);
            color: var(--white);
            padding: 13px 15px;
            font-size: 16px;
            font-weight: 500;
            display: inline-block;
            border-radius: 30px;
            text-align: center;
            text-transform: capitalize;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .vendor-coupon-switch {
            position: relative;
            display: inline-block;
            margin: 0;
        }

        .vendor-coupon-switch .custom-switch {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .vendor-coupon-switch .switch-label {
            display: block;
            width: 44px;
            height: 24px;
            background-color: #ddd;
            border-radius: 24px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .vendor-coupon-switch .switch-label::after {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: white;
            top: 2px;
            left: 3px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .vendor-coupon-switch .custom-switch:checked+.switch-label {
            background-color: var(--main-color-one);
        }

        .vendor-coupon-switch .custom-switch:focus+.switch-label {
            box-shadow: 0 0 0 3px rgba(var(--main-color-one-rgb), 0.2);
        }

        /* Permission layout refinements */
        .permission-toolbar-shell {
            position: sticky;
            top: 74px;
            z-index: 12;
            margin-bottom: 20px;
        }

        .permission-toolbar {
            background: var(--white);
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 16px 18px;
            border-radius: 12px;
            transition: box-shadow 0.3s ease;
        }

        .permission-toolbar.sticky-shadow {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.50);
        }

        .permission-toolbar-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 14px;
        }

        .permission-toolbar-bottom {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .permission-toolbar .form-control {
            min-width: 240px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            font-family: var(--body-font);
            font-size: 14px;
        }

        .permission-toolbar .form-control::placeholder {
            color: var(--body-color);
        }

        .permission-toolbar .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .permission-toolbar .form-check-input {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid var(--border-color);
            background-color: var(--white);
            transition: background-color 0.15s ease, border-color 0.15s ease;
        }

        .permission-toolbar .form-check-input:checked {
            background-color: var(--main-color-one);
            border-color: var(--main-color-one);
        }

        .permission-toolbar .form-check-input:checked[type="checkbox"] {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
        }

        .permission-toolbar .form-check-label {
            font-family: var(--body-font);
            font-size: 14px;
            color: var(--paragraph-color);
            margin-bottom: 0;
            cursor: pointer;
        }

        .permission-group-wrapper {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px 18px 14px;
            margin-bottom: 14px;
            background: var(--white);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.02);
            transition: box-shadow 0.2s ease;
        }

        .permission-group-wrapper:hover {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .permission-group-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 12px;
            margin-bottom: 12px;
        }

        .permission-group-header-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.2px;
            color: var(--heading-color);
            font-family: var(--heading-font);
        }

        .permission-group-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .permission-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 11px;
            background: var(--section-bg-1);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--paragraph-color);
            border: 1px solid var(--border-color);
            font-family: var(--body-font);
        }

        .collapse-toggle {
            background: var(--section-bg-1);
            border: 1px solid var(--border-color);
            color: var(--paragraph-color);
            border-radius: 8px;
            padding: 7px 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: var(--body-font);
            font-size: 13px;
            transition: background 0.15s ease, border 0.15s ease;
        }

        .collapse-toggle:hover {
            background: var(--white);
            border-color: var(--main-color-one);
            color: var(--main-color-one);
        }

        .permission-group-body {
            transition: all 0.2s ease;
        }

        .permission-card {
            margin-bottom: 10px;
        }

        .permission-card .vendor-coupon-switch {
            margin-right: 0;
        }

        .permission-card label {
            cursor: pointer;
            padding: 10px 12px;
            border-radius: 10px;
            display: inline-block;
            transition: background 0.15s ease, border 0.15s ease, color 0.15s ease;
            border: 1px solid var(--border-color);
            background: var(--white);
            font-family: var(--body-font);
            font-size: 14px;
            color: var(--paragraph-color);
            font-weight: 500;
            width: 100%;
            margin: 0;
        }

        .permission-card:hover label {
            border: 1px solid var(--main-color-one);
            color: var(--heading-color);
        }

        .permission-filter-empty {
            display: none;
            padding: 16px;
            border-radius: 12px;
            background: var(--section-bg-1);
            border: 1px dashed var(--border-color);
            color: var(--paragraph-color);
            font-weight: 600;
            text-align: center;
            font-family: var(--body-font);
        }

        .permission-card.highlight label {
            background: var(--section-bg-1);
            border-radius: 10px;
            padding: 4px 8px;
        }

        .soft-btn {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 8px 14px;
            background: var(--white);
            color: var(--paragraph-color);
            font-weight: 600;
            font-family: var(--body-font);
            font-size: 13px;
            transition: background 0.15s ease, border 0.15s ease, color 0.15s ease;
        }

        .soft-btn:hover {
            background: var(--section-bg-1);
            border-color: var(--main-color-one);
            color: var(--main-color-one);
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--section-bg-1);
            color: var(--paragraph-color);
            border-radius: 999px;
            padding: 8px 14px;
            font-weight: 600;
            font-size: 13px;
            border: 1px solid var(--border-color);
            font-family: var(--body-font);
        }

        .permission-card .form-group {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0;
            margin: 0;
        }

        .permission-card .form-group label.m-0 {
            flex: 1;
            margin: 0 !important;
        }
    </style>
@endsection

@section('content')
    <div class="bodyContent">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="simplePresentCart-one white-bg mb-24">
                        <div class="section-tittle-one d-flex justify-content-between mb-2">
                            <h3 class="title">{{ $role->name }}: {{ __('Permissions') }}</h3>
                            <div class="button-wrapper">
                                <a href="{{ route('admin.role.create') }}"
                                    class="btn btn-primary border-style-solid border-main-one" data-text="All Roles"><span>
                                        {{ __('All Roles') }} </span></a>
                            </div>
                        </div>

                        <div class="permission-wrap">
                            <form action="{{ route('admin.role.permission.create', $role->id) }}" method="post">
                                @csrf

                                <div class="permission-toolbar-shell">
                                    <div class="permission-toolbar">
                                        <div class="permission-toolbar-top">
                                            <div class="pill">
                                                <span>{{ __('Total') }}</span>
                                                <span id="total-count">{{ $permissions->flatten()->count() }}</span>
                                            </div>
                                            <div class="pill">
                                                <span>{{ __('Selected') }}</span>
                                                <span id="selected-count">{{ count($rolePermissions) }}</span>
                                            </div>
                                        </div>
                                        <div class="permission-toolbar-bottom">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="permission-select-all">
                                                <label class="form-check-label"
                                                    for="permission-select-all">{{ __('Select all') }}</label>
                                            </div>
                                            <button class="soft-btn" type="button"
                                                id="permission-select-none">{{ __('Select none') }}</button>
                                            <button class="collapse-toggle" type="button"
                                                id="permission-expand-all">{{ __('Expand all') }}</button>
                                            <button class="collapse-toggle" type="button"
                                                id="permission-collapse-all">{{ __('Collapse all') }}</button>
                                            <input type="text" id="permission-search" class="form-control"
                                                placeholder="{{ __('Search permissions...') }}">
                                            <button class="soft-btn" type="button"
                                                id="permission-clear-search">{{ __('Clear search') }}</button>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="permission-compact-toggle">
                                                <label class="form-check-label"
                                                    for="permission-compact-toggle">{{ __('Compact view') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="permission-filter-empty" id="permission-filter-empty">
                                    {{ __('No permissions match your search.') }}</div>
                                <div class="checkbox-wrapper">
                                    @foreach ($permissions as $key => $permission_value)
                                        @php
                                            $groupName = str_replace('-', ' ', strtolower($key));
                                        @endphp
                                        <div class="permission-group-wrapper">
                                            <div class="permission-group-header">
                                                <h5 class="permission-group-header-title">
                                                    {{ ucwords($groupName) }}

                                                    <div class="vendor-coupon-switch">
                                                        <input class="custom-switch permisssion-group-switch"
                                                            type="checkbox"
                                                            id="permisssion-group-switch-{{ $groupName }}" />
                                                        <label class="switch-label"
                                                            for="permisssion-group-switch-{{ $groupName }}"></label>
                                                    </div>
                                                </h5>
                                                <div class="permission-group-actions">
                                                    <div class="permission-chip">
                                                        <span class="group-selected"
                                                            data-group="{{ $groupName }}"></span>
                                                        <span>/</span>
                                                        <span class="group-total" data-group="{{ $groupName }}"></span>
                                                    </div>
                                                    <button type="button" class="collapse-toggle collapse-toggle-single"
                                                        data-target="group-body-{{ $loop->index }}">{{ __('Toggle') }}</button>
                                                </div>
                                            </div>
                                            <div class="permission-group-body" id="group-body-{{ $loop->index }}">
                                                <div class="row g-4">
                                                    @foreach ($permission_value as $permission)
                                                        <div class="col-lg-3 col-md-4 col-sm-6 permission-card"
                                                             data-permission-name="{{ strtolower(str_replace(['-', '.'], [' ', ' '], $permission->name)) }}"
                                                             data-menu-name="{{ strtolower($permission->menu_name) }}"
                                                             data-group="{{ $groupName }}">
                                                            <div class="form-group d-flex align-items-center gap-3 p-0 m-0">
                                                                <div class="vendor-coupon-switch">
                                                                    <input @if (in_array($permission->id, $rolePermissions)) checked @endif
                                                                    class="permission-switch custom-switch"
                                                                           type="checkbox"
                                                                           id="permisssion-switch-{{ $permission->id }}"
                                                                           name="permission[]"
                                                                           value="{{ $permission->id }}" />
                                                                    <label class="switch-label"
                                                                           for="permisssion-switch-{{ $permission->id }}"></label>
                                                                </div>

                                                                <label class="m-0"
                                                                       for="permisssion-switch-{{ $permission->id }}">
                                                                    <strong>{{ ucfirst(str_replace(['-', '.'], [' ', ' '], $permission->name)) }}</strong>
                                                                    <small class="d-block text-muted">{{ $permission->menu_name }}</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="btn-wrapper mt-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit Now') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        // handle group switch button click
        $(document).on("change", ".permisssion-group-switch", function() {
            let currentEl = $(this);
            let permissionGroup = currentEl.closest(".permission-group-wrapper");
            let availableSwitch = permissionGroup.find('.permission-switch');

            if (currentEl.is(':checked')) {
                availableSwitch.each(function() {
                    $(this).prop("checked", true);
                });
            } else {
                availableSwitch.each(function() {
                    $(this).prop("checked", false);
                });
            }
            updateCounters();
        });

        $(document).on("click", ".permission-switch", function() {
            // get this input group first
            let currentEl = $(this);
            let permissionGroup = currentEl.closest(".permission-group-wrapper");

            handleGroupSwitch(permissionGroup);
        })

        function handleGroupSwitch(permissionGroup = null) {
            // select permission group wrapper
            let permissionGroupWrapper = (permissionGroup == null) ? $('.permission-group-wrapper') : permissionGroup;

            permissionGroupWrapper.each(function() {
                let availableSwitch = $(this).find('.permission-switch').length;
                let checkedSwitch = $(this).find('.permission-switch:checked').length;

                if (availableSwitch === checkedSwitch) {
                    $(this).find('.permisssion-group-switch').prop("checked", true);
                } else {
                    $(this).find('.permisssion-group-switch').prop("checked", false);
                }
            });
            updateCounters();
        }

        handleGroupSwitch();

        // global select all
        $(document).on('change', '#permission-select-all', function() {
            const checked = $(this).is(':checked');
            $('.permission-switch').prop('checked', checked);
            $('.permisssion-group-switch').prop('checked', checked);
            updateCounters();
        });

        // select none
        $('#permission-select-none').on('click', function() {
            $('.permission-switch, .permisssion-group-switch, #permission-select-all').prop('checked', false);
            updateCounters();
        });

        // group stats & global counters
        function updateCounters() {
            const total = $('.permission-switch').length;
            const selected = $('.permission-switch:checked').length;
            $('#total-count').text(total);
            $('#selected-count').text(selected);

            $('.permission-group-wrapper').each(function() {
                const group = $(this);
                const totalGroup = group.find('.permission-switch').length;
                const selectedGroup = group.find('.permission-switch:checked').length;
                group.find('.group-total').text(totalGroup);
                group.find('.group-selected').text(selectedGroup);
            });
        }

        updateCounters();

        $(document).on('change', '.permission-switch', updateCounters);
        $(document).on('change', '.permisssion-group-switch', updateCounters);

        // search filter
        $('#permission-search').on('input', function() {
            const term = $(this).val().toLowerCase().trim();

            if (term === '') {
                // Show ALL permission cards and groups when search is empty
                $('.permission-card').show().removeClass('highlight');
                $('.permission-group-wrapper').show();
                $('#permission-filter-empty').hide();
                return;
            }

            let anyVisible = false;

            // Update group visibility based on current matches
            $('.permission-group-wrapper').each(function() {
                let anyCardVisibleInGroup = false;

                // IMPORTANT: Iterate cards within THIS group
                $(this).find('.permission-card').each(function() {
                    const permissionName = $(this).data('permission-name') || '';
                    const menuName = $(this).data('menu-name') || '';

                    // Search in both permission name and menu name
                    const match = permissionName.includes(term) || menuName.includes(term);

                    // Always set visibility based on current match
                    $(this).toggle(match);
                    $(this).toggleClass('highlight', match && term.length > 1);

                    if (match) {
                        anyCardVisibleInGroup = true;
                        anyVisible = true;
                    }
                });

                // Set group visibility - toggle(true) shows it even if it was hidden before
                $(this).toggle(anyCardVisibleInGroup);
            });

            $('#permission-filter-empty').toggle(!anyVisible);
        });

        $('#permission-clear-search').on('click', function() {
            $('#permission-search').val('');
            $('.permission-card').show().removeClass('highlight');
            $('.permission-group-wrapper').show();
            $('#permission-filter-empty').hide();
        });

        // expand / collapse
        $('#permission-expand-all').on('click', function() {
            $('.permission-group-body').slideDown(120);
        });

        $('#permission-collapse-all').on('click', function() {
            $('.permission-group-body').slideUp(120);
        });

        $(document).on('click', '.collapse-toggle-single', function() {
            const target = $(this).data('target');
            $('#' + target).slideToggle(120);
        });

        // compact view
        $('#permission-compact-toggle').on('change', function() {
            const compact = $(this).is(':checked');
            $('.permission-card').toggleClass('col-lg-3 col-md-4 col-sm-6', !compact)
                .toggleClass('col-lg-2 col-md-3 col-sm-4', compact);
        });


        $(document).on("click", ".add", function() {
            $(this).closest('tr').after($(this).closest('tr').clone());
        });

        (function($) {
            "use strict";
            $(document).on("click", ".edit_role", function(e) {
                e.preventDefault();
                let modalContainer = $("#editRoles");

                modalContainer.find("form").attr("action", $(this).data("action"));
                modalContainer.find("input[name='id']").val($(this).data("id"));
                modalContainer.find("input[name='name']").val($(this).data("name"));
            })
        })(jQuery);

        // ensure counts reflect initial state
        updateCounters();

        // Sticky toolbar shadow effect
        $(window).on('scroll', function() {
            const toolbar = $('.permission-toolbar');
            const scrollTop = $(window).scrollTop();

            if (scrollTop > 50) {
                toolbar.addClass('sticky-shadow');
            } else {
                toolbar.removeClass('sticky-shadow');
            }
        });

        // Check initial scroll position
        $(window).trigger('scroll');
    </script>
@endsection
