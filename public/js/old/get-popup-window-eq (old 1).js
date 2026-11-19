groupNavBtnListOpened = false;

function getPopupWindow(popupName, popupMode = "default") {
    console.log('вывожу окно');
    if (popupName === 'import_1c') {
        console.log('вывожу окно ', popupName);

        
        fetch(`/Popup1Сimport`)
            .then(res => res.text())
            .then(html => {
                document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
                console.log(`окно ${popupName} выведено успешно`);

                setTimeout(() => {
                    $('.input-file input[type=file]').on('change', function(){
                        let file = this.files[0];
                        $(this).closest('.input-file').find('.input-file-text').html(file.name);
                        $(this).closest('.input-file').find('.form-upload-btn').html('Загружено');
                        $(this).closest('.input-file').find('.form-upload-btn').addClass('button-st-success');
                        // document.querySelector('.input-file-text') = document.querySelector('.load-prev').files[0].name;
                    }); 
                }, 1100);
                
            })
            .catch(() => {
                console.log(`Ошибка загрузки ${popupName} окошка`);
            });
    }
    else if (popupName === 'autorization') {
        fetch(`/PopupLogin`)
        .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);

        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } // окошко создания единицы техники
    else if (popupName === 'registration') {
        fetch(`/registerForm`)
        .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);

        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } // окошко создания единицы техники
    else if (popupName === 'equipment_add') { 
        fetch(`/PopupaddEquipment`)
        .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Добавить единицу техники";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } 
    else if (popupName === 'getPopupActionsForEquipment') { 
        window.popupAPI.close();
        if (groupNavBtnListOpened === false) {
            equipmentActionsBlockGroup = document.querySelector('.nav-btn-group[data-group-name="equipmentActions"]');

            if (equipmentActionsBlockGroup.classList.contains('nbg-opened')) {
                equipmentActionsBlockGroup.querySelector('.nav-btn-list-container').innerHTML = '';
                equipmentActionsBlockGroup.classList.remove('nbg-opened');
            }
            else {
                equipmentActionsBlockGroup.classList.add('nbg-opened');
                equipmentActionsBlockGroup.querySelector('.nav-btn-list-container').innerHTML = `
                    <div class="nav-btn-list-block handbook-header-nav-btn block fl-align fl-col">
                        <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="give">
                            <div class="nb-list-icon">
                                <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                            </div>
                            <div class="nb-list-text-block">
                                <p class="nb-list-text nav-btn-text handbook-hvb-text">Выдать</p>
                            </div>
                        </div>

                        <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="pass_off">
                            <div class="nb-list-icon">
                                <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                            </div>
                            <div class="nb-list-text-block">
                                <p class="nb-list-text nav-btn-text handbook-hvb-text">Сдать</p>
                            </div>
                        </div>

                        <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="rewrite">
                            <div class="nb-list-icon">
                                <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                            </div>
                            <div class="nb-list-text-block">
                                <p class="nb-list-text nav-btn-text handbook-hvb-text">Переписать</p>
                            </div>
                        </div>

                        <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="write_off">
                            <div class="nb-list-icon">
                                <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                            </div>
                            <div class="nb-list-text-block">
                                <p class="nb-list-text nav-btn-text handbook-hvb-text">Списать</p>
                            </div>
                        </div>
                    </div>
                `;
            }

            document.querySelectorAll('.nb-list-btn').forEach(nbListBtn => {
                nbListBtn.addEventListener('click', () => {
                    console.log(nbListBtn.dataset.listName)
                    $url = `/PopupActionEquipment?popup_type=${nbListBtn.dataset.listName}`;
                    fetch($url)
                    .then(res => res.text())
                    .then(html => {
                        if (nbListBtn.dataset.listName === 'give' || nbListBtn.dataset.listName === 'rewrite'){
                            document.querySelector('.fl-popup-window-block').classList.add("fl-pwb-wide-mode");
                        }
                        
                        document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Переписать технику на др. сотрудника";
                        document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
                        console.log(`окно ${popupName} выведено успешно`);
                        getEqActionSettings(nbListBtn.dataset.listName);
                        window.popupAPI.open();
                    })
                    .catch(() => {
                        console.log(`Ошибка загрузки ${popupName} окошка`);
                    });
                });
            });
        } else {

        }
        

        // fetch(`{{ route('getPopupActionEquipment') }}`)
        // .then(res => res.text())
        // .then(html => {
        //     document.querySelector('.fl-popup-window-block').classList.add("fl-pwb-wide-mode");
        //     document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Переписать технику на др. сотрудника";
        //     document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
        //     console.log(`окно ${popupName} выведено успешно`);
        //     getEqActionSettings(nbListBtn.dataset.listName);
        // })
        // .catch(() => {
        //     console.log(`Ошибка загрузки ${popupName} окошка`);
        // });
    }
    else if (popupName === 'getPopupparametersEquipment') { 
        fetch(`/PopupparametersEquipment`)
        .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Параметры";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    }
}

document.querySelectorAll('.fs-popup-window-btn').forEach(popupbtn => {
    popupbtn.addEventListener('click', () => {
        getPopupWindow(popupbtn.dataset.popupType)
    });
});

// document.querySelectorAll('.fs-popup-window-btn').addEventListener('click', (e) => {
//     popupbtn = e.target.closest('.fs-popup-window-btn');

//     getPopupWindow(popupbtn.dataset.popupType);
// });