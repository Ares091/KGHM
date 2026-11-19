
// инициализируем необходимые флаги и глобальные переменные для корректной работы скрипта
let divManagementModeEnabled = false; // режим "редактирование техники" по умолчанию выключен
let divManagementModeEnabledName = null; //название активного режима редактирования

let divMMInputEditingEnabled = false; // флажок для изменения редактируемой информации в инпут

// функция входа в режим "редактирования техники". применяет стили, активирует листенеры кнопок и их функции
function EnterToDivisionManagementMode(editType) {
    if (editType === "div_delete" && !divManagementModeEnabled && divManagementModeEnabledName === null){
        // активируем флажки о начале работы в режиме
        divManagementModeEnabled = true;
        divManagementModeEnabledName = editType;
            // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
        // применение стилей делаем через функцию если мод еще не включен
        useDivCssStylesToSite(editType, false);
        divManagementFetchActions(editType, divMMInputEditingEnabled);
        
    } 
    else {
        useDivCssStylesToSite(editType, divManagementModeEnabled)
    }
}

// применение стилей к таблице в зависимости от мода
// применение стилей к таблице в зависимости от мода
function useDivCssStylesToSite(editType, used){

    if (used === false) { // стили не пременены тогда выполняем условие
        if (editType === "div_delete"){

            // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
            // к контейнеру таблицы учета техники
            document.querySelector('.handbook-body-left-department-panel-block').classList.add('bld-panel-block-delete-mod');

            // создаем и добавляем плашку с названием режима редактирования в заголовок таблицы уч. техники
            eqModeLabel = document.createElement('div');
            eqModeLabel.classList.add('nav-btn-text', 'hb-mode-label', 'fl-align');
            eqModeLabel.textContent = "Режим удаления";
            document.querySelector('.handbook-body-left-section-ui-settings-block').append(eqModeLabel)

            // список подразделений
            // добавляем стили для таблицы и её ячеек

            document.querySelectorAll('.hb-dep-data-btn').forEach(tableRow => {
                tableRow.classList.add('ddpb-delete')
            });

            // .handbook-department-data-panel-block-row.ddpb-delete

            quitFromModeBtn = document.createElement('div');
            quitFromModeBtn.classList.add('quit-from-mode-btn-block', 'fl-align');
            quitFromModeBtn.innerHTML = `
                <div class="admin-dynamic-edit-btn quit-from-mode-btn admin-btn handbook-header-nav-btn-block nav-btn  fl-align" data-edit-type="equipment_edit_close">
                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                        <img src="../sources/media/icons/import (1).png" alt="" class="handbook-hvb-icon img">
                    </div>
                    <div class="handbook-hvb-text-block">
                        <p class="nav-btn-text handbook-hvb-text">Выйти из режима удаления</p>
                    </div>
                </div>
            `;
            document.querySelector('.handbook-header-section-left-bar').append(quitFromModeBtn)

            quitFromModeBtn.addEventListener('click', () => {
                EnterToDivisionManagementMode(editType);
            });
        }
    }
    else {
        // удаляем все флажки для дальнейшей повторной работы
        divManagementModeEnabled = false;
        divManagementModeEnabledName = null;
        // выходим из режима редактирования в зависимости от его типа
        if (editType === "div_delete") {
            document.querySelector('.handbook-body-left-department-panel-block').classList.remove('bld-panel-block-delete-mod');
            
           
            document.querySelector('.nav-btn-text.hb-mode-label.fl-align').remove();

            document.querySelectorAll('.hb-dep-data-btn').forEach(tableRow => {
                tableRow.classList.remove('ddpb-delete')
            });

            document.querySelector('.quit-from-mode-btn-block').remove();
        } 
            
    }
        
}



let divEditModeTargetId = null;
let EditingDivRowsOld = null;
let divDataOld = {};
let divData = {};

// .hb-dep-data-btn .fs-table-row'
// функционал режима редактирований
function divManagementFetchActions(editType, inputEditEnabled) {
    if (editType === "div_delete" && divManagementModeEnabled && divManagementModeEnabledName === editType && inputEditEnabled === false) {
        document.querySelectorAll('.hb-dep-data-btn').forEach(tableEditingRow => {
            tableEditingRow.addEventListener('dblclick', () => {
                if ( divManagementModeEnabled && divManagementModeEnabledName !== null){
                    // получаем значения удаляемой записи
                    DivId = parseInt(tableEditingRow.dataset.id);
                    
                    tableEditingRow.classList.add('fs-popup-window-btn');
                    document.querySelectorAll('.fs-popup-window-btn');
                    // выводим окошко с вопросом о удалении
                    getPopupMessage('delete', [DivId, tableEditingRow]);

                    console.log('Удаляю элемент с id=', DivId)
                }
                

                // `/DeleteDivision?div_id=${DivId}`

                // fetch(`/DeleteDivision/${DivId}`, {
                //     method: 'POST',
                //     headers: {
                //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                //         Accept: 'application/json',
                //     },
                // })
                // .then(response => response.json())
                // .then(data => {
                //     if (data.success) {
                //         // Обновляем таблицу
                //         tableEditingRow.remove();
                        
                //     }
                // })
                // .catch(error => {
                //     console.error('Ошибка поиска:', error);
                // });

                


            });
        });
    
    
    }
    
}

function getPopupMessage(messageType, messageData, messageDesc = ""){
    fetch(`/PopupMessage?div_id=${messageData[0]}&message_type=${messageType}`)
    .then(res => res.text())
    .then(html => {
        popupAPI.open()
        document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Внимание!";
        document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
        deleteDivisionRequest(messageData[0], messageData[1]);
    })
    .catch(error => {
        console.error('Ошибка поиска:', error);
    });

}

function deleteDivisionRequest(DivId, deletingElem) {
    document.querySelectorAll('.popupActionBtn').forEach(popupActionBtn => {
        popupActionBtn.addEventListener('click', () => {
            if (popupActionBtn.dataset.btn !== "no"){
                console.log('Удаляю элемент с id=', DivId)

                // `/DeleteDivision?div_id=${DivId}`
                fetch(`/DeleteDivision/${DivId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        Accept: 'application/json',
                    },
                    body: new URLSearchParams({'action_name' : popupActionBtn.dataset.btn}),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Обновляем таблицу
                        deletingElem.remove();
                        
                    }
                })
                .catch(error => {
                    console.error('Ошибка поиска:', error);
                });
            }
            else {
                console.log('Удаление отменено')
            }

            popupAPI.close();


        })
    });


    
}

// привязываем функцию входа в режим редактирования ко всем кнопкам с классом ".admin-dynamic-edit-btn"
document.querySelectorAll('.admin-dynamic-edit-btn').forEach(adminDEBtn => {
    adminDEBtn.addEventListener('click', () => {
        EnterToDivisionManagementMode(adminDEBtn.dataset.editType)
    });
});