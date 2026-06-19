{{--
    AI Translate Toggle Component (v5 — Production)
    ================================================
    Shared CSS + JS engine used by:
      - Job/Campaign description translate button
      - Chat message inline translate link
      - Proposal cover letter translate pill

    Include via <x-ai-translate-toggle /> on any page that needs translation.
    Renders once per page via @once.
--}}

@once
<style>
/* ═══════════════════════════════════════════════════════════════════════
   ANIMATIONS
   ═══════════════════════════════════════════════════════════════════════ */
@keyframes ai-tx-spin   { to { transform: rotate(360deg); } }
@keyframes ai-tx-fadeIn { from { opacity:0; transform:translateY(-4px); } to { opacity:1; transform:translateY(0); } }
@keyframes ai-tx-slideDown { from { opacity:0; max-height:0; } to { opacity:1; max-height:300px; } }

/* ═══════════════════════════════════════════════════════════════════════
   1. JOB DESCRIPTION — Translate Button
   ═══════════════════════════════════════════════════════════════════════ */
.job-translate-wrap { display:flex; flex-direction:column; }
.job-translate-body { font-size:15px; line-height:1.7; color:#374151; }
.job-translate-btn-row { display:flex; align-items:center; gap:10px; margin-top:14px; }
.job-translate-toggle-btn {
    display:inline-flex; align-items:center; gap:7px;
    padding:8px 20px; border-radius:50px; font-size:13px; font-weight:600;
    background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff; border:none;
    cursor:pointer; transition:all .2s ease;
    box-shadow:0 4px 14px rgba(99,102,241,.3);
}
.job-translate-toggle-btn:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(99,102,241,.4); }
.job-translate-toggle-btn:active { transform:scale(.97); }
.job-translate-toggle-btn:disabled { opacity:.7; cursor:wait; }
.job-translate-toggle-btn .jt-spinner {
    width:13px; height:13px; border:2px solid rgba(255,255,255,.35); border-top-color:#fff;
    border-radius:50%; animation:ai-tx-spin .65s linear infinite; display:none;
}
.job-translate-toggle-btn .jt-icon { font-size:15px; line-height:1; }
.job-translate-badge {
    display:inline-flex; align-items:center; gap:5px;
    padding:4px 10px; border-radius:20px; font-size:11px; font-weight:600;
    background:rgba(99,102,241,.08); color:#6366f1; border:1px solid rgba(99,102,241,.15);
    animation:ai-tx-fadeIn .3s ease;
}

/* ═══════════════════════════════════════════════════════════════════════
   2. CHAT — Inline Translate Link (replaces broken hover menu)
   ═══════════════════════════════════════════════════════════════════════ */

/* Footer row: timestamp + translate link side by side */
.chat-msg-footer {
    display:flex; align-items:center; gap:12px; margin-top:6px;
}

/* The inline translate button: small, elegant, clickable */
.chat-tx-inline-btn {
    display:inline-flex; align-items:center; gap:5px;
    padding:3px 10px; border-radius:14px; font-size:11.5px; font-weight:600;
    color:#6366f1; background:rgba(99,102,241,.08); border:1px solid rgba(99,102,241,.12);
    cursor:pointer; transition:all .18s ease; line-height:1;
}
.chat-tx-inline-btn:hover {
    background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff;
    border-color:transparent; transform:translateY(-1px);
    box-shadow:0 3px 10px rgba(99,102,241,.3);
}
.chat-tx-inline-btn:hover .chat-tx-inline-icon { stroke:#fff; }
.chat-tx-inline-btn:disabled { opacity:.7; cursor:wait; }
.chat-tx-inline-btn .chat-tx-inline-spinner {
    width:10px; height:10px; border:2px solid rgba(99,102,241,.3); border-top-color:#6366f1;
    border-radius:50%; animation:ai-tx-spin .65s linear infinite; display:none; flex-shrink:0;
}
.chat-tx-inline-btn:hover .chat-tx-inline-spinner {
    border-color:rgba(255,255,255,.3); border-top-color:#fff;
}
.chat-tx-inline-icon { stroke:#6366f1; transition:stroke .18s; flex-shrink:0; }

/* Active state (showing translated) */
.chat-tx-inline-btn[data-tx-state="translated"] {
    background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff;
    border-color:transparent;
}
.chat-tx-inline-btn[data-tx-state="translated"] .chat-tx-inline-icon { stroke:#fff; }

/* Translated text area below original message */
.chat-tx-translated-area {
    margin-top:8px; padding:10px 14px;
    background:linear-gradient(135deg, rgba(99,102,241,.06), rgba(139,92,246,.06));
    border-left:3px solid #6366f1; border-radius:0 8px 8px 0;
    animation:ai-tx-fadeIn .3s ease;
}
.chat-tx-translated-label {
    display:flex; align-items:center; gap:5px;
    font-size:10.5px; font-weight:700; color:#6366f1;
    text-transform:uppercase; letter-spacing:.5px; margin-bottom:5px;
}
.chat-tx-translated-label svg { stroke:#6366f1; }
.chat-tx-translated-text {
    font-size:13.5px; line-height:1.6; color:#374151; margin:0;
}

/* ═══════════════════════════════════════════════════════════════════════
   3. PROPOSAL — Cover Letter Modal + Translate Pill
   ═══════════════════════════════════════════════════════════════════════ */
#CoverLetterModal .modal-content {
    border-radius:16px; border:none; box-shadow:0 20px 60px rgba(0,0,0,.15);
}
#CoverLetterModal .modal-header {
    background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff;
    border-radius:16px 16px 0 0; border:none; padding:18px 24px;
}
#CoverLetterModal .modal-header .btn-close { filter:invert(1) brightness(2); }
#CoverLetterModal .modal-body { padding:24px 28px; }
#CoverLetterModal .modal-footer { border-top:1px solid #f1f5f9; padding:14px 24px; }

.cover-letter-text { font-size:14.5px; line-height:1.8; color:#374151; white-space:pre-line; }
.cover-letter-translated-text { font-size:14.5px; line-height:1.8; color:#374151; white-space:pre-line; }
.cover-letter-translated-label {
    display:none; align-items:center; gap:5px; margin-bottom:12px;
    padding:5px 12px; border-radius:20px; font-size:11px; font-weight:700;
    background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff; width:fit-content;
}

.proposal-tx-pill {
    display:inline-flex; align-items:center; gap:6px;
    padding:7px 16px; border-radius:50px; font-size:12.5px; font-weight:600;
    background:linear-gradient(135deg,#0ea5e9,#6366f1); color:#fff; border:none;
    cursor:pointer; transition:all .2s ease;
    box-shadow:0 4px 12px rgba(14,165,233,.3);
}
.proposal-tx-pill:hover { transform:translateY(-2px); box-shadow:0 8px 18px rgba(99,102,241,.35); }
.proposal-tx-pill:disabled { opacity:.7; cursor:wait; }
.proposal-tx-pill .ptx-spinner {
    width:12px; height:12px; border:2px solid rgba(255,255,255,.35); border-top-color:#fff;
    border-radius:50%; animation:ai-tx-spin .65s linear infinite; display:none; flex-shrink:0;
}
.proposal-tx-pill .ptx-icon { font-size:14px; line-height:1; }
</style>

<script>
(function() {
    'use strict';

    /* ═══════════════════════════════════════════════════════════════════
       GLOBAL TRANSLATION ENGINE
       ═══════════════════════════════════════════════════════════════════ */
    window.AITranslator = {
        csrfToken : document.querySelector('meta[name=csrf-token]')?.content ?? '',
        endpoint  : '{{ route("ai.translate.request") }}',
        statusUrl : '/ai/translate/status/',

        translate: function(text, targetLang, onStart, onDone, onError) {
            if (!text || !text.trim()) { onError && onError(); return; }
            onStart && onStart();
            fetch(this.endpoint, {
                method : 'POST',
                headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': this.csrfToken },
                body   : JSON.stringify({ text: text.trim(), target_lang: targetLang }),
            })
            .then(function(r){ return r.json(); })
            .then(function(res){
                if (res.status === 'done')              onDone && onDone(res);
                else if (res.status === 'processing')   AITranslator._poll(res.poll_key, onDone, onError);
                else                                    onError && onError();
            })
            .catch(function(){ onError && onError(); });
        },

        _poll: function(key, onDone, onError) {
            var polls = 0, max = 25;
            var iv = setInterval(function() {
                if (++polls > max) { clearInterval(iv); onError && onError(); return; }
                fetch(AITranslator.statusUrl + key)
                    .then(function(r){ return r.json(); })
                    .then(function(res){
                        if (res.status === 'done')   { clearInterval(iv); onDone && onDone(res); }
                        if (res.status === 'failed') { clearInterval(iv); onError && onError(); }
                    })
                    .catch(function(){ clearInterval(iv); onError && onError(); });
            }, 1200);
        }
    };

    /* ═══════════════════════════════════════════════════════════════════
       1. JOB DESCRIPTION — Translate Button Handler
       ═══════════════════════════════════════════════════════════════════ */
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.job-translate-toggle-btn');
        if (!btn) return;

        var wrap       = btn.closest('.job-translate-wrap');
        var bodyEl     = wrap ? wrap.querySelector('.job-translate-body') : null;
        var spinner    = btn.querySelector('.jt-spinner');
        var icon       = btn.querySelector('.jt-icon');
        var label      = btn.querySelector('.jt-label');
        var targetLang = btn.dataset.targetLang || 'en';
        var state      = btn.dataset.state || 'original';

        if (!bodyEl) return;

        if (state === 'translated') {
            bodyEl.innerHTML  = btn.dataset.original;
            btn.dataset.state = 'original';
            icon.textContent  = '🌐';
            label.textContent = '{{ __("Translate") }}';
            var oldBadge = wrap.querySelector('.job-translate-badge');
            if (oldBadge) oldBadge.remove();
            return;
        }

        if (btn.dataset.translated) {
            bodyEl.innerHTML  = btn.dataset.translated;
            btn.dataset.state = 'translated';
            icon.textContent  = '📄';
            label.textContent = '{{ __("Show Original") }}';
            _addJobBadge(wrap, btn.dataset.detectedLang);
            return;
        }

        AITranslator.translate(
            bodyEl.innerText || bodyEl.textContent, targetLang,
            function() {
                btn.disabled = true;
                spinner.style.display = 'inline-block';
                icon.style.display    = 'none';
                label.textContent     = '{{ __("Translating...") }}';
            },
            function(res) {
                btn.dataset.translated   = res.translated;
                btn.dataset.detectedLang = res.detected_lang || '';
                btn.dataset.original     = bodyEl.innerHTML;
                bodyEl.innerHTML         = res.translated;
                btn.dataset.state        = 'translated';
                btn.disabled             = false;
                spinner.style.display    = 'none';
                icon.style.display       = '';
                icon.textContent         = '📄';
                label.textContent        = '{{ __("Show Original") }}';
                _addJobBadge(wrap, res.detected_lang);
            },
            function() {
                btn.disabled          = false;
                spinner.style.display = 'none';
                icon.style.display    = '';
                icon.textContent      = '🌐';
                label.textContent     = '{{ __("Translate") }}';
            }
        );
    });

    function _addJobBadge(wrap, lang) {
        var old = wrap.querySelector('.job-translate-badge');
        if (old) old.remove();
        if (!lang) return;
        var row = wrap.querySelector('.job-translate-btn-row');
        if (!row) return;
        var b = document.createElement('span');
        b.className = 'job-translate-badge';
        b.innerHTML = '🔍 {{ __("Detected") }}: <strong>' + lang.toUpperCase() + '</strong>';
        row.appendChild(b);
    }

    /* ═══════════════════════════════════════════════════════════════════
       2. CHAT — Inline Translate Button Handler
       ═══════════════════════════════════════════════════════════════════ */
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.chat-tx-inline-btn');
        if (!btn) return;

        var msgId      = btn.dataset.msgId;
        var targetLang = btn.dataset.targetLang || 'en';
        var state      = btn.dataset.txState || 'original';
        var spinner    = btn.querySelector('.chat-tx-inline-spinner');
        var iconSvg    = btn.querySelector('.chat-tx-inline-icon');
        var labelEl    = btn.querySelector('.chat-tx-inline-label');
        var txArea     = document.getElementById('chat-tx-area-' + msgId);

        if (!txArea) return;

        var txText = txArea.querySelector('.chat-tx-translated-text');

        // Toggle back to original: hide translated area
        if (state === 'translated') {
            txArea.style.display = 'none';
            btn.dataset.txState  = 'original';
            labelEl.textContent  = '{{ __("Translate") }}';
            if (iconSvg) iconSvg.style.display = '';
            return;
        }

        // Use cached translation
        if (btn.dataset.txCached) {
            txText.textContent   = btn.dataset.txCached;
            txArea.style.display = '';
            btn.dataset.txState  = 'translated';
            labelEl.textContent  = '{{ __("Show Original") }}';
            return;
        }

        // Fetch fresh translation
        var originalText = btn.dataset.originalText || '';

        AITranslator.translate(
            originalText, targetLang,
            function() {
                btn.disabled          = true;
                spinner.style.display = 'inline-block';
                if (iconSvg) iconSvg.style.display = 'none';
                labelEl.textContent   = '{{ __("Translating...") }}';
            },
            function(res) {
                btn.disabled          = false;
                spinner.style.display = 'none';
                if (iconSvg) iconSvg.style.display = '';
                labelEl.textContent   = '{{ __("Show Original") }}';

                btn.dataset.txCached = res.translated;
                btn.dataset.txState  = 'translated';

                txText.textContent   = res.translated;
                txArea.style.display = '';
            },
            function() {
                btn.disabled          = false;
                spinner.style.display = 'none';
                if (iconSvg) iconSvg.style.display = '';
                labelEl.textContent   = '{{ __("Translate") }}';
            }
        );
    });

    /* ═══════════════════════════════════════════════════════════════════
       3. PROPOSAL — Cover Letter Translate Pill
       ═══════════════════════════════════════════════════════════════════ */
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.proposal-tx-pill');
        if (!btn) return;

        var originalEl   = document.getElementById('cover-letter-original');
        var translatedEl = document.getElementById('cover-letter-translated');
        var txLabel      = document.getElementById('cover-letter-tx-label');
        var spinner      = btn.querySelector('.ptx-spinner');
        var icon         = btn.querySelector('.ptx-icon');
        var btnLabel     = btn.querySelector('.ptx-label');
        var targetLang   = btn.dataset.targetLang || 'en';
        var state        = btn.dataset.state || 'original';

        if (!originalEl || !translatedEl) return;

        // Toggle back to original
        if (state === 'translated') {
            originalEl.style.display   = '';
            translatedEl.style.display = 'none';
            if (txLabel) txLabel.style.display = 'none';
            btn.dataset.state    = 'original';
            icon.textContent     = '🌐';
            btnLabel.textContent = '{{ __("Translate to English") }}';
            return;
        }

        // Use cached
        if (btn.dataset.translated) {
            originalEl.style.display    = 'none';
            translatedEl.textContent    = btn.dataset.translated;
            translatedEl.style.display  = '';
            if (txLabel) txLabel.style.display = 'flex';
            btn.dataset.state    = 'translated';
            icon.textContent     = '📄';
            btnLabel.textContent = '{{ __("Show Original") }}';
            return;
        }

        // Fetch fresh
        var text = originalEl.textContent || '';

        AITranslator.translate(
            text, targetLang,
            function() {
                btn.disabled          = true;
                spinner.style.display = 'inline-block';
                icon.style.display    = 'none';
                btnLabel.textContent  = '{{ __("Translating...") }}';
            },
            function(res) {
                btn.disabled          = false;
                spinner.style.display = 'none';
                icon.style.display    = '';
                icon.textContent      = '📄';
                btnLabel.textContent  = '{{ __("Show Original") }}';

                btn.dataset.translated = res.translated;
                btn.dataset.state      = 'translated';

                originalEl.style.display   = 'none';
                translatedEl.textContent   = res.translated;
                translatedEl.style.display = '';

                if (txLabel) {
                    txLabel.innerHTML = '🌐 {{ __("Translated to English") }}' + (res.detected_lang ? ' &middot; {{ __("from") }} <strong>' + res.detected_lang.toUpperCase() + '</strong>' : '');
                    txLabel.style.display = 'flex';
                }
            },
            function() {
                btn.disabled          = false;
                spinner.style.display = 'none';
                icon.style.display    = '';
                icon.textContent      = '🌐';
                btnLabel.textContent  = '{{ __("Translate to English") }}';
            }
        );
    });

}());
</script>
@endonce
