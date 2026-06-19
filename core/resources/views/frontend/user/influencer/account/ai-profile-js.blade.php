{{-- AI Profile Enhancer JS --}}
<script>
(function () {
    'use strict';

    var btn     = document.getElementById('ai-enhance-profile-btn');
    var spinner = document.getElementById('ai-enhance-spinner');
    var btnText = document.getElementById('ai-enhance-btn-text');

    if (!btn) return;

    var pollInterval = null;
    var pollCount    = 0;
    var MAX_POLLS    = 30;

    btn.addEventListener('click', function () {
        setLoading(true);

        $.ajax({
            url:  '{{ route("influencer.ai.enhance.profile") }}',
            type: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function (res) {
                if (res.status === 'processing') {
                    startPolling(res.uuid);
                } else {
                    showError(res.message || '{{ __("An error occurred.") }}');
                    setLoading(false);
                }
            },
            error: function (xhr) {
                showError(xhr.responseJSON?.message || '{{ __("Failed to start enhancement. Please try again.") }}');
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
                showError('{{ __("Enhancement is taking too long. Please try again.") }}');
                setLoading(false);
                return;
            }

            $.ajax({
                url:  '/influencer/ai/enhance-status/' + uuid,
                type: 'GET',
                success: function (res) {
                    if (res.status === 'done') {
                        clearInterval(pollInterval);
                        setLoading(false);
                        showResultModal(res.data);
                    } else if (res.status === 'failed') {
                        clearInterval(pollInterval);
                        setLoading(false);
                        showError(res.message || '{{ __("Enhancement failed. Please try again.") }}');
                    }
                }
            });
        }, 1000);
    }

    function showResultModal(data) {
        var enhancedBio    = data.enhanced_bio    || '';
        var suggestedSkills = data.suggested_skills || [];

        var skillPills = suggestedSkills.map(function (s) {
            return '<span style="background:#ede9fe;color:#7c3aed;padding:4px 10px;border-radius:12px;font-size:12px;font-weight:600;">' + escapeHtml(s) + '</span>';
        }).join(' ');

        var modalHtml =
            '<div id="ai-enhance-modal-overlay" style="position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;display:flex;align-items:center;justify-content:center;">' +
            '<div style="background:#fff;border-radius:14px;padding:28px 32px;max-width:560px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,.2);">' +
            '<h3 style="font-size:17px;font-weight:700;margin-bottom:16px;">\u2728 {{ __("AI Enhanced Bio") }}</h3>' +
            '<textarea id="ai-enhanced-bio-text" style="width:100%;height:130px;border:1px solid #e2e8f0;border-radius:8px;padding:10px;font-size:13px;resize:vertical;">' + escapeHtml(enhancedBio) + '</textarea>' +
            (skillPills ? '<div style="margin-top:14px;"><strong style="font-size:13px;">{{ __("Suggested Skills to Add:") }}</strong><div style="margin-top:8px;display:flex;flex-wrap:wrap;gap:6px;">' + skillPills + '</div></div>' : '') +
            '<div style="display:flex;gap:10px;margin-top:20px;justify-content:flex-end;">' +
            '<button id="ai-enhance-discard" style="background:#f1f5f9;color:#475569;border:none;border-radius:8px;padding:8px 18px;font-size:13px;font-weight:600;cursor:pointer;">{{ __("Discard") }}</button>' +
            '<button id="ai-enhance-apply" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:8px;padding:8px 18px;font-size:13px;font-weight:600;cursor:pointer;">{{ __("Apply to Bio") }}</button>' +
            '</div>' +
            '</div></div>';

        document.body.insertAdjacentHTML('beforeend', modalHtml);

        document.getElementById('ai-enhance-discard').addEventListener('click', function () {
            document.getElementById('ai-enhance-modal-overlay').remove();
        });

        document.getElementById('ai-enhance-apply').addEventListener('click', function () {
            var bio = document.getElementById('ai-enhanced-bio-text').value;
            // Target the description textarea used in the introduction section
            var descriptionField = document.querySelector('textarea[name="description"]');
            if (descriptionField) {
                descriptionField.value = bio;
                // Trigger input event for any reactive bindings
                descriptionField.dispatchEvent(new Event('input'));
            }
            document.getElementById('ai-enhance-modal-overlay').remove();
            toastr_success_js('{{ __("Bio applied! Remember to save your changes.") }}');
        });
    }

    function showError(message) {
        if (typeof toastr_warning_js === 'function') {
            toastr_warning_js(message);
        } else {
            alert(message);
        }
    }

    function setLoading(loading) {
        btn.disabled = loading;
        spinner.style.display = loading ? 'inline-block' : 'none';
        btnText.textContent   = loading ? '{{ __("Enhancing...") }}' : '\u2728 {{ __("Enhance Bio with AI") }}';
    }

    function escapeHtml(text) {
        var d = document.createElement('div');
        d.textContent = String(text);
        return d.innerHTML;
    }
})();
</script>
