<script>
/**
 * Phase 3: AI Matching Engine — Frontend Controller
 * ===================================================
 * Handles:
 *  1. "Analyze Applicants" — triggers hybrid scoring + AI reasoning
 *  2. "Contact with AI"   — generates personalized outreach message per freelancer
 *  3. Outreach preview modal — lets client review before sending
 */
(function () {
    'use strict';

    /* ── DOM references ── */
    var analyzeBtn  = document.getElementById('ai-analyze-applicants-btn');
    var spinner     = document.getElementById('ai-analyze-spinner');
    var btnText     = document.getElementById('ai-analyze-btn-text');
    var resultsWrap = document.getElementById('ai-match-results');
    var outreachModal = document.getElementById('ai-outreach-modal');

    if (!analyzeBtn) return;

    /* ── State ── */
    var pollInterval  = null;
    var pollCount     = 0;
    var MAX_POLLS     = 60;   // 60 × 1s = 1-minute max

    /* ══════════════════════════════════════════════
       1. ANALYZE APPLICANTS
    ══════════════════════════════════════════════ */
    analyzeBtn.addEventListener('click', function () {
        var jobId = analyzeBtn.dataset.jobId;
        if (!jobId) return;

        setLoading(true);
        resultsWrap.style.display = 'none';
        resultsWrap.innerHTML     = '';

        $.ajax({
            url:  '{{ route("client.ai.analyze.applicants") }}',
            type: 'POST',
            data: { job_id: jobId, _token: '{{ csrf_token() }}' },
            success: function (res) {
                if (res.status === 'processing') {
                    startPolling(res.uuid);
                } else if (res.status === 'done') {
                    renderResults(res.data);
                    setLoading(false);
                } else {
                    showError(res.message || '{{ __("An unknown error occurred.") }}');
                    setLoading(false);
                }
            },
            error: function (xhr) {
                var msg = xhr.responseJSON?.message || '{{ __("Failed to start AI analysis. Please try again.") }}';
                showError(msg);
                setLoading(false);
            }
        });
    });

    function startPolling(uuid) {
        pollCount = 0;
        pollInterval = setInterval(function () {
            if (++pollCount > MAX_POLLS) {
                clearInterval(pollInterval);
                showError('{{ __("Analysis is taking too long. Please try again.") }}');
                setLoading(false);
                return;
            }
            $.ajax({
                url:  '/client/job/analyze-status/' + uuid,
                type: 'GET',
                success: function (res) {
                    if (res.status === 'done') {
                        clearInterval(pollInterval);
                        renderResults(res.data);
                        setLoading(false);
                    } else if (res.status === 'failed') {
                        clearInterval(pollInterval);
                        showError(res.message || '{{ __("AI analysis failed. Please try again.") }}');
                        setLoading(false);
                    }
                }
            });
        }, 1000);
    }

    /* ══════════════════════════════════════════════
       2. RENDER RESULTS
    ══════════════════════════════════════════════ */
    function renderResults(ranked) {
        if (!ranked || ranked.length === 0) {
            resultsWrap.innerHTML = `
                <div class="ai-empty-state">
                    <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#94a3b8" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                    </svg>
                    <p>{{ __("No proposals found to analyze.") }}</p>
                    <span>{{ __("Share your campaign to start receiving proposals.") }}</span>
                </div>`;
            resultsWrap.style.display = 'block';
            return;
        }

        var jobId = analyzeBtn.dataset.jobId;
        var html  = `<div class="ai-match-summary">
            <span class="ai-match-summary-count">
                <strong>${ranked.length}</strong> {{ __("applicants analyzed") }}
            </span>
            <span class="ai-match-summary-pill">✨ {{ __("AI Powered") }}</span>
        </div>`;

        html += '<div class="ai-candidates-list">';
        ranked.forEach(function (c, index) {
            var rank       = index + 1;
            var score      = parseFloat(c.rule_score) || 0;
            var isTop      = rank === 1;
            var tier       = score >= 70 ? 'high' : (score >= 40 ? 'medium' : 'low');
            var tierLabel  = score >= 70 ? '{{ __("Strong Match") }}' : (score >= 40 ? '{{ __("Good Fit") }}' : '{{ __("Low Match") }}');
            var barWidth   = Math.round(score);

            html += `
            <div class="ai-candidate-card ${isTop ? 'ai-candidate-top' : ''}">
                ${isTop ? '<div class="ai-top-ribbon">🏆 {{ __("Best Match") }}</div>' : ''}
                <div class="ai-candidate-header">
                    <div class="ai-candidate-identity">
                        <div class="ai-rank-circle ${tier}">${rank}</div>
                        <div>
                            <div class="ai-candidate-name">${escapeHtml(c.name)}</div>
                            <div class="ai-candidate-meta">
                                <span>💰 ${escapeHtml(String(c.amount))}</span>
                                <span>⏱ ${escapeHtml(String(c.duration))}</span>
                            </div>
                        </div>
                    </div>
                    <div class="ai-score-block">
                        <div class="ai-score-number ${tier}">${score.toFixed(1)}</div>
                        <div class="ai-score-label">{{ __("/ 100") }}</div>
                        <div class="ai-tier-pill ${tier}">${tierLabel}</div>
                    </div>
                </div>

                <!-- Progress bar -->
                <div class="ai-score-bar-track">
                    <div class="ai-score-bar-fill ${tier}" style="width:0%" data-width="${barWidth}%"></div>
                </div>

                ${c.ai_reasoning ? `
                <div class="ai-reasoning-block">
                    <div class="ai-reasoning-icon">🧠</div>
                    <p class="ai-reasoning-text">${escapeHtml(c.ai_reasoning)}</p>
                </div>` : ''}

                <!-- Action buttons -->
                <div class="ai-candidate-actions">
                    <button
                        type="button"
                        class="ai-outreach-btn"
                        data-job-id="${jobId}"
                        data-freelancer-id="${escapeHtml(String(c.freelancer_id))}"
                        data-name="${escapeHtml(c.name)}"
                        title="{{ __('Generate personalized AI message') }}"
                    >
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                        {{ __("Contact with AI") }}
                    </button>
                    <a
                        href="/client/job/proposal/details/${escapeHtml(String(c.proposal_id))}"
                        class="ai-view-proposal-btn"
                        target="_blank"
                        title="{{ __('View full proposal') }}"
                    >
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                        {{ __("View Proposal") }}
                    </a>
                </div>
            </div>`;
        });
        html += '</div>';

        resultsWrap.innerHTML     = html;
        resultsWrap.style.display = 'block';

        // Animate score bars after render
        setTimeout(function () {
            document.querySelectorAll('.ai-score-bar-fill').forEach(function (bar) {
                bar.style.width = bar.dataset.width;
            });
        }, 100);
    }

    /* ══════════════════════════════════════════════
       3. AUTO OUTREACH
    ══════════════════════════════════════════════ */
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.ai-outreach-btn');
        if (!btn) return;

        var jobId        = btn.dataset.jobId;
        var freelancerId = btn.dataset.freelancerId;
        var name         = btn.dataset.name;

        // Show modal in loading state
        showOutreachModal(name, null, true);

        $.ajax({
            url:  '{{ route("client.ai.outreach.generate") }}',
            type: 'POST',
            data: {
                job_id:        jobId,
                freelancer_id: freelancerId,
                _token:        '{{ csrf_token() }}'
            },
            success: function (res) {
                if (res.status === 'success') {
                    showOutreachModal(name, res.message, false, res.remaining);
                } else {
                    showOutreachModal(name, null, false, null, res.message || '{{ __("Failed to generate message.") }}');
                }
            },
            error: function (xhr) {
                var msg = xhr.responseJSON?.message || '{{ __("Failed to generate message. Please try again.") }}';
                showOutreachModal(name, null, false, null, msg);
            }
        });
    });

    function showOutreachModal(freelancerName, message, loading, remaining, errorMsg) {
        var modal = document.getElementById('ai-outreach-modal');
        if (!modal) return;

        modal.querySelector('.ai-outreach-recipient').textContent = freelancerName || '';

        var loadingEl = document.getElementById('ai-outreach-loading-state');
        var contentEl = modal.querySelector('.ai-outreach-content');

        if (loadingEl) loadingEl.style.display  = loading ? 'flex' : 'none';
        if (contentEl) contentEl.style.display  = loading ? 'none' : 'block';

        if (errorMsg) {
            if (contentEl) contentEl.innerHTML =
                '<div class="ai-outreach-error">' + escapeHtml(errorMsg) + '</div>';
        } else if (message) {
            var textarea = modal.querySelector('#ai-outreach-textarea');
            if (textarea) textarea.value = message;

            var badge = modal.querySelector('.ai-remaining-badge');
            if (badge && remaining !== undefined) {
                badge.textContent = '{{ __("Remaining today") }}: ' + remaining;
                badge.style.display = '';
            }
        }

        // Show via Bootstrap modal
        var bsModal = bootstrap.Modal.getOrCreateInstance(modal);
        bsModal.show();
    }

    // Copy message to clipboard
    document.addEventListener('click', function (e) {
        if (!e.target.closest('#ai-outreach-copy-btn')) return;
        var textarea = document.getElementById('ai-outreach-textarea');
        if (!textarea) return;
        navigator.clipboard.writeText(textarea.value).then(function () {
            var btn = document.getElementById('ai-outreach-copy-btn');
            btn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> {{ __("Copied!") }}';
            setTimeout(function () {
                btn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> {{ __("Copy Message") }}';
            }, 2000);
        });
    });

    /* ── Helpers ── */
    function setLoading(loading) {
        analyzeBtn.disabled       = loading;
        spinner.style.display     = loading ? 'inline-block' : 'none';
        btnText.textContent       = loading
            ? '{{ __("Analyzing...") }}'
            : '✨ {{ __("Analyze Applicants") }}';
    }

    function showError(message) {
        resultsWrap.innerHTML = `
            <div class="ai-error-state">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#ef4444" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <span>${escapeHtml(message)}</span>
            </div>`;
        resultsWrap.style.display = 'block';
    }

    function escapeHtml(text) {
        var d = document.createElement('div');
        d.textContent = String(text);
        return d.innerHTML;
    }

})();
</script>
