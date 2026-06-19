<script>
(function ($) {
    'use strict';

    // ---- State flag to prevent duplicate requests ----
    var aiRequestInProgress = false;

    // ---- Modal open / close ----
    $(document).on('click', '#btn_open_ai_modal', function () {
        $('#ai_modal_overlay').addClass('active');
        $('#ai_description_input').focus();
    });

    function closeAiModal() {
        $('#ai_modal_overlay').removeClass('active');
        $('#ai_unmatched_notice').hide().html('');
    }

    $(document).on('click', '#btn_close_ai_modal', closeAiModal);

    // Close on overlay click (outside box)
    $(document).on('click', '#ai_modal_overlay', function (e) {
        if ($(e.target).is('#ai_modal_overlay')) {
            closeAiModal();
        }
    });

    // Close on Escape key
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape') { closeAiModal(); }
    });

    // ---- Character counter ----
    $(document).on('input', '#ai_description_input', function () {
        $('#ai_char_count').text($(this).val().length);
    });

    // ---- Submit AI request ----
    $(document).on('click', '#btn_submit_ai', function () {
        if (aiRequestInProgress) { return; } // prevent duplicate requests

        var description = $('#ai_description_input').val().trim();

        if (description.length < 10) {
            toastr_warning_js('{{ __("Please enter at least 10 characters to describe your job.") }}');
            return;
        }

        // Set loading state
        aiRequestInProgress = true;
        var $btn = $('#btn_submit_ai');
        $btn.prop('disabled', true);
        $('#ai_submit_text').hide();
        $('#ai_submit_spinner').css('display', 'inline-block');
        $('#ai_unmatched_notice').hide().html('');

        $.ajax({
            url: '{{ route("client.job.generate.ai") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_description: description,
            },
            success: function (response) {
                if (response.status === 'success') {
                    var data = response.data;

                    // Fill title
                    if (data.title) {
                        $('#title').val(data.title).trigger('input').trigger('change');
                        // Trigger slug generation if it exists
                        $('#title').trigger('keyup');
                    }

                    // Fill description (Summernote)
                    if (data.description) {
                        if ($('.description').data('summernote') || $('.note-editor').length) {
                            try {
                                $('.description').summernote('code', data.description);
                            } catch(e) {
                                $('#description').val(data.description);
                            }
                        } else {
                            $('#description').val(data.description);
                        }
                    }

                    // Fill budget
                    if (data.budget) {
                        $('#budget').val(data.budget);
                    }

                    // Fill type
                    if (data.type) {
                        $('#type').val(data.type).trigger('change');
                    }

                    // Set category via Select2
                    if (data.category_id) {
                        $('#category').val(data.category_id).trigger('change');
                    }

                    // Set Subcategory (Robust wait for AJAX)
                    if (data.sub_category_id) {
                        let subRetryCount = 0;
                        let subInterval = setInterval(function() {
                            subRetryCount++;
                            let $sub = $('#subcategory');
                            let $option = $sub.find('option[value="' + data.sub_category_id + '"]');
                            
                            if ($option.length > 0) {
                                $sub.val(data.sub_category_id).trigger('change');
                                clearInterval(subInterval);
                            } else if ($sub.find('option').length > 1) {
                                // Fallback: if the specific sub isn't there but others are, pick the first one
                                let firstVal = $sub.find('option').eq(1).val();
                                if (firstVal) {
                                    $sub.val(firstVal).trigger('change');
                                    clearInterval(subInterval);
                                }
                            } else if (subRetryCount > 40) { // 4 seconds timeout
                                clearInterval(subInterval);
                            }
                        }, 150);
                    }

                    // Set Duration
                    if (data.duration) {
                        $('#duration').val(data.duration).trigger('change');
                    }

                    // Set Level
                    if (data.level) {
                        $('#level').val(data.level).trigger('change');
                    }

                    // Set Min Followers
                    if (data.min_followers !== undefined) {
                        $('#min_followers').val(data.min_followers);
                    }

                    // Set Meta Tags
                    if (data.meta_title) {
                        $('#meta_title').val(data.meta_title).trigger('change').trigger('input');
                    }
                    if (data.meta_description) {
                        $('#meta_description').val(data.meta_description).trigger('change').trigger('input');
                    }

                    // Set skills via Select2 (after a longer delay)
                    if (data.skills && data.skills.length > 0) {
                        setTimeout(function () {
                            let $skillSelect = $('#skill');
                            data.skills.forEach(function(skill) {
                                // If option doesn't exist, create it
                                if ($skillSelect.find("option[value='" + skill.id + "']").length === 0) {
                                    let newOption = new Option(skill.name, skill.id, true, true);
                                    $skillSelect.append(newOption);
                                }
                            });
                            $skillSelect.val(data.skills.map(s => s.id)).trigger('change');
                        }, 2000);
                    }

                    // Show unmatched skills notice if any
                    if (data.unmatched_skills && data.unmatched_skills.length > 0) {
                        var notice = '{{ __("AI suggested these skills not in our system:") }} <strong>' + data.unmatched_skills.join(', ') + '</strong>. {{ __("Please add them manually if needed.") }}';
                        $('#ai_unmatched_notice').html(notice).show();
                    }

                    toastr_success_js('{{ __("AI generated everything! Title, Description, Budget, and Skills are now filled. Check the next steps!") }}');
                    closeAiModal();

                } else {
                    toastr_error_js(response.message || '{{ __("AI generation failed. Please try again.") }}');
                }
            },
            error: function (xhr) {
                var msg = '{{ __("AI generation failed. Please fill the form manually.") }}';
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON;
                    if (errors && errors.message) { msg = errors.message; }
                } else if (xhr.status === 429) {
                    msg = '{{ __("Too many requests. Please wait a moment and try again.") }}';
                }
                toastr_error_js(msg);
            },
            complete: function () {
                // Reset loading state
                aiRequestInProgress = false;
                var $btn = $('#btn_submit_ai');
                $btn.prop('disabled', false);
                $('#ai_submit_text').show();
                $('#ai_submit_spinner').hide();
            }
        });
    });

}(jQuery));
</script>
