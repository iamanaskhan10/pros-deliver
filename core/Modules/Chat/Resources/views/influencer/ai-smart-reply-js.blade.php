{{-- AI Smart Reply JS --}}
<style>
    @keyframes ai-spin { to { transform: rotate(360deg); } }
    .ai-smart-reply-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px; padding: 0 8px; }
    .ai-smart-reply-pill {
        background: #ede9fe;
        color: #6d28d9;
        border: 1px solid #c4b5fd;
        border-radius: 18px;
        padding: 5px 14px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s, color .15s;
        max-width: 100%;
        white-space: normal;
        word-wrap: break-word;
        line-height: 1.4;
    }
    .ai-smart-reply-pill:hover { background: #7c3aed; color: #fff; border-color: #7c3aed; }
</style>

<script>
(function () {
    'use strict';

    var btn        = document.getElementById('ai-smart-reply-btn');
    var spinner    = document.getElementById('ai-smart-reply-spinner');
    var btnText    = document.getElementById('ai-smart-reply-btn-text');
    var messageBox = document.getElementById('message');

    // Container for pill suggestions — insert after the footer form
    var pillContainer = document.createElement('div');
    pillContainer.className = 'ai-smart-reply-pills';
    pillContainer.style.display = 'none';

    var footer = document.getElementById('freelancer-message-footer');
    if (footer) {
        footer.appendChild(pillContainer);
    }

    if (!btn) return;

    var pollInterval = null;
    var pollCount    = 0;
    var MAX_POLLS    = 20;

    // Detect which client is currently active by reading the active chat item's data attribute
    function getActiveClientId() {
        var activeItem = document.querySelector('.chat-wrapper-contact-list .active');
        if (activeItem) {
            return activeItem.dataset.clientId || null;
        }
        // Fallback: try hidden input if it exists
        var hiddenInput = document.getElementById('client_id');
        return hiddenInput ? hiddenInput.value : null;
    }

    btn.addEventListener('click', function () {
        var clientId = getActiveClientId();
        if (!clientId) {
            showToast('{{ __("Please select a conversation first.") }}');
            return;
        }

        pillContainer.style.display = 'none';
        pillContainer.innerHTML     = '';
        setLoading(true);

        $.ajax({
            url:  '{{ route("influencer.ai.smart.replies") }}',
            type: 'POST',
            data: { client_id: clientId, _token: '{{ csrf_token() }}' },
            success: function (res) {
                if (res.status === 'processing') {
                    startPolling(res.uuid);
                } else {
                    showToast(res.message || '{{ __("An error occurred.") }}');
                    setLoading(false);
                }
            },
            error: function (xhr) {
                showToast(xhr.responseJSON?.message || '{{ __("Failed to generate smart replies.") }}');
                setLoading(false);
            }
        });
    });

    function startPolling(uuid) {
        pollCount = 0;
        pollInterval = setInterval(function () {
            pollCount++;
            if (pollCount > MAX_POLLS) {
                clearInterval(pollInterval);
                showToast('{{ __("Smart Reply timed out. Please try again.") }}');
                setLoading(false);
                return;
            }

            $.ajax({
                url:  '/freelancer/live/ai/reply-status/' + uuid,
                type: 'GET',
                success: function (res) {
                    if (res.status === 'done') {
                        clearInterval(pollInterval);
                        setLoading(false);
                        renderPills(res.replies || []);
                    } else if (res.status === 'failed') {
                        clearInterval(pollInterval);
                        setLoading(false);
                        showToast(res.message || '{{ __("Smart Reply failed. Please try again.") }}');
                    }
                }
            });
        }, 1000);
    }

    function renderPills(replies) {
        if (!replies.length) {
            showToast('{{ __("No suggestions available for this conversation.") }}');
            return;
        }

        pillContainer.innerHTML = '';

        replies.forEach(function (reply) {
            var pill = document.createElement('button');
            pill.type      = 'button';
            pill.className = 'ai-smart-reply-pill';
            pill.title     = reply;
            pill.textContent = reply;

            pill.addEventListener('click', function () {
                if (messageBox) {
                    messageBox.value = reply;
                    messageBox.focus();
                }
                // Clear pills after selection
                pillContainer.style.display = 'none';
                pillContainer.innerHTML     = '';
            });

            pillContainer.appendChild(pill);
        });

        pillContainer.style.display = 'flex';
    }

    function setLoading(loading) {
        btn.disabled              = loading;
        spinner.style.display     = loading ? 'inline-block' : 'none';
        btnText.innerHTML         = loading
            ? '{{ __("Thinking...") }}'
            : '&#128172; {{ __("Smart Reply") }}';
    }

    function showToast(message) {
        if (typeof toastr_warning_js === 'function') {
            toastr_warning_js(message);
        } else {
            console.warn(message);
        }
    }
})();
</script>
