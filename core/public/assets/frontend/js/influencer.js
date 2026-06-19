(function ($) {
    "use strict";

    $(document).ready(function () {

        let fvt_icon = document.querySelectorAll('.add-fvt-icon');
        fvt_icon.forEach(icon => {
            if (icon) {
                icon.addEventListener('click', function () {
                    icon.classList.toggle('fvt');
                });
            }
        });

        // Faq Accordion
        $('.inf-faq-item:not(.open) .inf-faq-content-wraper').slideUp(300);
        $(".inf-faq-title-wraper").on('click', function (e) {
            let faq = $(this).parent('.inf-faq-item');
            if (faq.hasClass("open")) {
                faq.removeClass("open");
                faq.find('.inf-faq-content-wraper').slideUp(300);
            }
            else {
                faq.addClass("open");
                faq.find('.inf-faq-content-wraper').slideDown(300);
                faq.siblings('.inf-faq-item').children('.inf-faq-content-wraper').slideUp(300);
                faq.siblings('.inf-faq-item').removeClass('open');
            }
        });
        // Install select2
        if ($('#gender-filter').length) {
            $('#gender-filter').select2({
                dropdownParent: $('.gander-filter-wraper')
            });
        }

        if ($('#country-filter').length) {
            $('#country-filter').select2();
        }

        if ($('#level').length) {
            $('#level').select2();
        }

        if ($('#duration').length) {
            $('#duration').select2();
        }

        if ($('#blog-category').length) {
            $('#blog-category').select2();
        }

        if ($('#delivery_day').length) {
            $('#delivery_day').select2();
        }

        if ($('.gender_select2').length) {
            $('.gender_select2').select2();
        }

        if ($('#chose-rating-filter').length) {
            $('#chose-rating-filter').select2();
        }

        if ($('#chose-blogs-filter').length) {
            $('#chose-blogs-filter').select2({
                dropdownParent: $('.all-blog-searchbar-wraper')
            });
        }

        // Blog sidebar accordion
        $('.blog-sidebar-title').on('click', function () {
            const $title = $(this);
            const $content = $title.next('.blog-sidebar-content');

            if ($title.hasClass('open')) {
                $title.removeClass('open');
                $content.slideUp(300);
            } else {
                $title.addClass('open');
                $content.slideDown(300);
            }
        });
        // Custom budget selector 
        document.querySelectorAll('.budget-filter-wraper').forEach(wrapper => {
            const input = wrapper.querySelector('.custom-selector');
            const dropdown = wrapper.querySelector('.custom-selector-option');
            const minInput = wrapper.querySelector('.min-input');
            const maxInput = wrapper.querySelector('.max-input');
            const submitButton = wrapper.querySelector('#set_price_range');

            // Toggle dropdown
            input.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdown.classList.toggle('open');
            });

            // Prevent negative values
            function preventNegativeValues(inputElement) {
                inputElement.addEventListener('input', function () {
                    this.value = this.value.replace(/[^0-9.]/g, '');

                    // Ensure only one decimal point
                    const parts = this.value.split('.');
                    if (parts.length > 2) {
                        this.value = parts[0] + '.' + parts.slice(1).join('');
                    }
                });

                inputElement.addEventListener('keydown', function (e) {
                    // Prevent minus key, plus key, and 'e' key (scientific notation)
                    if (e.key === '-' || e.key === '+' || e.key === 'e' || e.key === 'E') {
                        e.preventDefault();
                    }
                });

                inputElement.addEventListener('paste', function (e) {
                    // Handle paste event
                    setTimeout(() => {
                        this.value = this.value.replace(/[^0-9.]/g, '');
                        const parts = this.value.split('.');
                        if (parts.length > 2) {
                            this.value = parts[0] + '.' + parts.slice(1).join('');
                        }
                        updateBudgetValue();
                    }, 0);
                });
            }

            preventNegativeValues(minInput);
            preventNegativeValues(maxInput);

            // Update input field with formatted min/max
            function updateBudgetValue() {
                const min = minInput.value.trim();
                const max = maxInput.value.trim();

                if (min || max) {
                    input.value = `Budget: ${min || '0'} - ${max || '∞'}`;
                } else {
                    input.value = '';
                    input.placeholder = 'Budget';
                }
            }

            minInput.addEventListener('input', updateBudgetValue);
            maxInput.addEventListener('input', updateBudgetValue);

            // Handle submit button click
            submitButton.addEventListener('click', function () {
                const min = minInput.value.trim();
                const max = maxInput.value.trim();

                if (min && max) {
                    dropdown.classList.remove('open');
                    updateBudgetValue();
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (e) {
                if (!wrapper.contains(e.target)) {
                    dropdown.classList.remove('open');
                }
            });
        });

        document.querySelectorAll('.follower-filter-wraper').forEach(wrapper => {
            const input = wrapper.querySelector('.custom-selector');
            const dropdown = wrapper.querySelector('.custom-selector-option');
            const minInput = wrapper.querySelector('.min-input');
            const maxInput = wrapper.querySelector('.max-input');
            const submitButton = wrapper.querySelector('#set_follower_range');

            // Toggle dropdown
            input.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdown.classList.toggle('open');
            });

            // Prevent negative values
            function preventNegativeValues(inputElement) {
                inputElement.addEventListener('input', function () {
                    this.value = this.value.replace(/[^0-9.]/g, '');

                    // Ensure only one decimal point
                    const parts = this.value.split('.');
                    if (parts.length > 2) {
                        this.value = parts[0] + '.' + parts.slice(1).join('');
                    }
                });

                inputElement.addEventListener('keydown', function (e) {
                    // Prevent minus key, plus key, and 'e' key (scientific notation)
                    if (e.key === '-' || e.key === '+' || e.key === 'e' || e.key === 'E') {
                        e.preventDefault();
                    }
                });

                inputElement.addEventListener('paste', function (e) {
                    // Handle paste event
                    setTimeout(() => {
                        this.value = this.value.replace(/[^0-9.]/g, '');
                        const parts = this.value.split('.');
                        if (parts.length > 2) {
                            this.value = parts[0] + '.' + parts.slice(1).join('');
                        }
                        updateBudgetValue();
                    }, 0);
                });
            }

            preventNegativeValues(minInput);
            preventNegativeValues(maxInput);

            // Update input field with formatted min/max
            function updateBudgetValue() {
                const min = minInput.value.trim();
                const max = maxInput.value.trim();

                if (min || max) {
                    input.value = `Followers: ${min || '0'} - ${max || '∞'}`;
                } else {
                    input.value = '';
                    input.placeholder = 'Followers';
                }
            }

            minInput.addEventListener('input', updateBudgetValue);
            maxInput.addEventListener('input', updateBudgetValue);

            // Handle submit button click
            submitButton.addEventListener('click', function () {
                const min = minInput.value.trim();
                const max = maxInput.value.trim();

                if (min && max) {
                    dropdown.classList.remove('open');
                    updateBudgetValue();
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (e) {
                if (!wrapper.contains(e.target)) {
                    dropdown.classList.remove('open');
                }
            });
        });

    });

})(jQuery);