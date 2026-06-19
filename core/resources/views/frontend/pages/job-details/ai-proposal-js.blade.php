<script>
(function () {
    'use strict';

    /**
     * Phase 2: AI Proposal Generator
     * Handles async dispatch + polling to auto-fill the proposal form.
     */

    const GENERATE_URL = "{{ route('influencer.ai.proposal.generate') }}";
    const STATUS_BASE   = "{{ url('influencer/ai/proposal-status') }}";
    const CSRF_TOKEN    = "{{ csrf_token() }}";

    // Poll interval in ms and max poll attempts (2s * 20 = 40s timeout)
    const POLL_INTERVAL_MS = 2000;
    const MAX_POLL_ATTEMPTS = 20;

    let pollTimer    = null;
    let pollAttempts = 0;

    const $btn          = $('#ai_generate_proposal_btn');
    const $btnText      = $('#ai_proposal_btn_text');
    const $spinner      = $('#ai_proposal_spinner');
    const $coverLetter  = $('#cover_letter');
    const $amount       = $('#amount');
    const $duration     = $('#duration');

    /**
     * Reset the button to its idle state.
     */
    function resetButton() {
        $btn.prop('disabled', false);
        $btnText.text("{{ __('✨ Generate with AI') }}");
        $spinner.addClass('d-none');
    }

    /**
     * Set the button to a loading state.
     */
    function setLoadingState() {
        $btn.prop('disabled', true);
        $btnText.text("{{ __('Generating...') }}");
        $spinner.removeClass('d-none');
    }

    /**
     * Stop the polling interval.
     */
    function stopPolling() {
        if (pollTimer) {
            clearInterval(pollTimer);
            pollTimer = null;
        }
        pollAttempts = 0;
    }

    /**
     * Auto-fill the proposal form fields with AI-generated data.
     */
    function fillForm(data) {
        // Cover letter
        if (data.proposal) {
            $coverLetter.val(data.proposal).trigger('change').trigger('input');
        }

        // Suggested price — only override if field is empty or matches the default
        if (data.suggested_price && parseInt(data.suggested_price) > 0) {
            $amount.val(data.suggested_price).trigger('change').trigger('input');
        }

        // Duration — try to match against the select dropdown
        if (data.estimated_days) {
            let matched = false;
            $duration.find('option').each(function () {
                if ($(this).text().trim().toLowerCase().includes(data.estimated_days.toLowerCase()) ||
                    data.estimated_days.toLowerCase().includes($(this).text().trim().toLowerCase())) {
                    $duration.val($(this).val()).trigger('change');
                    matched = true;
                    return false; // break
                }
            });

            // If no match, select first available non-empty option as fallback
            if (!matched) {
                let firstVal = $duration.find('option').filter(function () {
                    return $(this).val() !== '';
                }).first().val();
                if (firstVal) $duration.val(firstVal).trigger('change');
            }
        }

        toastr_success_js("{{ __('AI proposal generated! Review and edit before sending.') }}");
    }

    /**
     * Poll the status endpoint until the result is ready.
     */
    function startPolling(uuid) {
        pollAttempts = 0;
        pollTimer = setInterval(function () {
            pollAttempts++;

            if (pollAttempts > MAX_POLL_ATTEMPTS) {
                stopPolling();
                resetButton();
                toastr_warning_js("{{ __('The AI is taking too long. Please try again.') }}");
                return;
            }

            $.ajax({
                url: STATUS_BASE + '/' + uuid,
                method: 'GET',
                success: function (response) {
                    if (response.status === 'processing') {
                        // Still waiting — keep polling
                        return;
                    }

                    stopPolling();
                    resetButton();

                    if (response.status === 'done' && response.data) {
                        fillForm(response.data);
                    } else {
                        // status === 'failed'
                        let msg = response.message || "{{ __('AI generation failed. Please write manually.') }}";
                        toastr_warning_js(msg);
                    }
                },
                error: function () {
                    stopPolling();
                    resetButton();
                    toastr_warning_js("{{ __('An error occurred while checking the AI status.') }}");
                }
            });
        }, POLL_INTERVAL_MS);
    }

    /**
     * Main click handler: dispatch the AI job and start polling.
     */
    $(document).ready(function () {
        $(document).on('click', '#ai_generate_proposal_btn', function () {
            const jobId = $(this).data('job-id');
            if (!jobId) {
                toastr_warning_js("{{ __('Job ID is missing. Cannot generate proposal.') }}");
                return;
            }

            setLoadingState();

            $.ajax({
                url:  GENERATE_URL,
                method: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    job_id: jobId,
                },
                success: function (response) {
                    if (response.status === 'processing' && response.uuid) {
                        startPolling(response.uuid);
                    } else {
                        resetButton();
                        toastr_warning_js("{{ __('Unexpected response from AI. Please try again.') }}");
                    }
                },
                error: function (xhr) {
                    resetButton();
                    let msg = xhr.responseJSON?.message || "{{ __('AI request failed. Please try again.') }}";
                    toastr_warning_js(msg);
                }
            });
        });
    });

}());
</script>
