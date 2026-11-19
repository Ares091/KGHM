function getActiveMiniIcons() {
    document.querySelectorAll('.handbook-mini-pop-icon').forEach(hbMiniPopIcon => {
        hbMiniPopIcon.addEventListener('click', () => {
            if (hbMiniPopIcon.classList.contains('handbook-mini-pop-i-copy')) {
                
                let text = '';

                text = hbMiniPopIcon.closest('.handbook-mini-pop-i-block').querySelector('.table-row-th-text').innerHTML;

                if (text){
                    const textarea = document.createElement('textarea');
                    textarea.value = text;
                    textarea.setAttribute('readonly', '');
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand('copy');

                    console.log('Скопировано: ' + text);
                }

            }
            else if (hbMiniPopIcon.classList.contains('handbook-mini-pop-i-mail')) {
                let text = '';

                text = hbMiniPopIcon.closest('.handbook-mini-pop-i-block').querySelector('.table-row-th-text').innerHTML;

                window.location.href = 'mailto:' + text;
            }
            else if (hbMiniPopIcon.classList.contains('handbook-mini-pop-i-copy-username-title')) {
                
                let text = '';

                userNoteTitle = document.querySelector('.handbook-body-right-nd-header-text');

                if (userNoteTitle.innerHTML.includes("&gt;")){
                    text = userNoteTitle.innerHTML.split("&gt;")[1].trim();
                }
                else {
                    text = userNoteTitle.innerHTML;
                }

                if (text){
                    const textarea = document.createElement('textarea');
                    textarea.value = text;
                    textarea.setAttribute('readonly', '');
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand('copy');

                    console.log('Скопировано: ' + text);
                }

            }
        })
    });
}


getActiveMiniIcons();



function getEqStatus() {
    if (window.location.href === 'http://handbook/equipmentPage') {
        if (activeRowId !== null) {
            activeRow = document.querySelector(`.table-row[data-id="${activeRowId}"]`)
            document.querySelector('.nb-list-btn').classList.remove('nb-lb-disabled');

            if (activeRow.querySelector('.fs-table-row').innerHTML.trim() === 'Выдан') {
                document.querySelector('.nb-list-btn[data-list-name="give"]').classList.add('nb-lb-disabled');
            }
            else if (activeRow.querySelector('.fs-table-row').innerHTML.trim() === 'На складе') {
                document.querySelector('.nb-list-btn[data-list-name="pass_off"]').classList.add('nb-lb-disabled');
                document.querySelector('.nb-list-btn[data-list-name="rewrite"]').classList.add('nb-lb-disabled');
            }
            else if (activeRow.querySelector('.fs-table-row').innerHTML.trim() === 'Списан') {
                document.querySelector('.nb-list-btn[data-list-name="pass_off"]').classList.add('nb-lb-disabled');
                document.querySelector('.nb-list-btn[data-list-name="rewrite"]').classList.add('nb-lb-disabled');
                document.querySelector('.nb-list-btn[data-list-name="write_off"]').classList.add('nb-lb-disabled');
            }
        }
        else {
            document.querySelector('.nb-list-btn[data-list-name="give"]').classList.add('nb-lb-disabled');
            document.querySelector('.nb-list-btn[data-list-name="pass_off"]').classList.add('nb-lb-disabled');
            document.querySelector('.nb-list-btn[data-list-name="rewrite"]').classList.add('nb-lb-disabled');
            document.querySelector('.nb-list-btn[data-list-name="write_off"]').classList.add('nb-lb-disabled');
        }
        
    }
}