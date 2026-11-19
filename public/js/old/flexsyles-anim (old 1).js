        // toggle-switches
        document.querySelectorAll('.form-toggle-switch-block').forEach(block => {
            block.addEventListener('click', () => {
                const toggle = block.querySelector('.form-toggle-switch');
                const isActive = toggle.classList.toggle('fts-active');
                block.dataset.enabled = isActive ? 'on' : 'off';
            });
        });

        // accordion elements

        document.querySelectorAll('.fs-accordion-block-row').forEach(row => {
            row.addEventListener('click', () => {
                const bottom = row.querySelector('.fs-accordion-block-row-bottom-section');
                const btn = row.querySelector('.fs-accordion-open-btn');
                const isClosed = bottom.classList.contains('fs-abr-b-section-closed');
                
                bottom.classList.toggle('fs-abr-b-section-closed', !isClosed);
                bottom.classList.toggle('fs-abr-b-section-opened', isClosed);
                btn.classList.toggle('fs-ao-btn-opened', isClosed);
            });
        });

        // popup UI and btns

        // popup window button
        const popupWindow = document.querySelector('.fl-popup-window');
        if (popupWindow) {
            const popupBlock = document.querySelector('.fl-popup-window-block');

            // close button helper
            // if popup window opened
            // closing the popup window when you click on an empty space
            const closePopup = () => {
                popupBlock.classList.add('fl-popup-window-block-clos-anim');
                popupWindow.classList.add('fl-popup-window-closing-anim');
                setTimeout(() => {
                    popupBlock.classList.remove('fl-popup-window-block-clos-anim');
                    popupWindow.classList.remove('fl-popup-window-closing-anim');
                    popupWindow.classList.remove('fl-popup-w-opened');
                    popupWindow.classList.add('fl-popup-w-closed');
                }, 1000);
            };

            // open button helper
            document.querySelectorAll('.fs-popup-window-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                if (popupWindow.classList.contains('fl-popup-w-closed') && popupWindow.dataset.opened === 'false') {
                    popupWindow.classList.add('fl-popup-w-opened');
                    setTimeout(() => {
                    popupBlock.classList.add('fl-popup-window-block-opening-anim');
                    popupWindow.classList.add('fl-popup-window-opening-anim');
                    popupWindow.classList.remove('fl-popup-w-closed');
                    }, 1);
                    setTimeout(() => {
                        popupBlock.classList.remove('fl-popup-window-block-opening-anim');
                        popupWindow.classList.remove('fl-popup-window-opening-anim');
                    }, 1000);
                }
                });
            });


            // close triggers (nav buttons and outside click)
            document.querySelectorAll('.fl-pwb-nav-button-tab').forEach(navBtn => {
                navBtn.addEventListener('click', () => {
                if (navBtn.classList.contains('fl-pwb-nbt-close') || navBtn.classList.contains('fl-pwb-nbt-submit')) {
                        closePopup();
                    }
                });
            });

            document.body.addEventListener('click', e => {
                if (e.target.closest('.fl-popup-window') && !e.target.closest('.fl-popup-window-block')) {
                    if (popupWindow.classList.contains('fl-popup-w-opened')) closePopup();
                }
            });
        }