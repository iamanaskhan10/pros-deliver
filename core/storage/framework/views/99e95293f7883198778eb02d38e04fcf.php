
<div class="modal fade" id="CoverLetterModal" tabindex="-1" aria-labelledby="coverLetterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:36px;height:36px;background:rgba(255,255,255,.2);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                        </svg>
                    </div>
                    <h5 class="modal-title mb-0 fw-bold" id="coverLetterModalLabel"><?php echo e(__('Proposal Details')); ?></h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo e(__('Close')); ?>"></button>
            </div>
            <div class="modal-body" style="padding:28px;">

                
                <div class="cover-letter-translated-label" id="cover-letter-tx-label">
                    🌐 <?php echo e(__('Translated to English')); ?>

                </div>

                
                <div class="cover-letter-text" id="cover-letter-original"></div>

                
                <div class="cover-letter-translated-text" id="cover-letter-translated"></div>

            </div>
            <div class="modal-footer" style="justify-content:space-between; align-items:center;">
                
                <button
                    type="button"
                    class="proposal-tx-pill"
                    id="cover-letter-translate-btn"
                    data-target-lang="en"
                    data-state="original"
                >
                    <span class="ptx-spinner"></span>
                    <span class="ptx-icon">🌐</span>
                    <span class="ptx-label"><?php echo e(__('Translate to English')); ?></span>
                </button>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/prosdeliver/public_html/core/resources/views/frontend/user/influencer/proposal/cover-letter-modal.blade.php ENDPATH**/ ?>