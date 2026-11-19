
// инициализируем необходимые флаги и глобальные переменные для корректной работы скрипта
let eqManagementModeEnabled = false; // режим "редактирование техники" по умолчанию выключен
let eqManagementModeEnabledName = null; //название активного режима редактирования

let eqMMInputEditingEnabled = false; // флажок для изменения редактируемой информации в инпут

// функция входа в режим "редактирования техники". применяет стили, активирует листенеры кнопок и их функции
function EnterToDivisionManagementMode(editType) {
    if (editType === "equipment_delete" && !eqManagementModeEnabled && eqManagementModeEnabledName === null){
        // активируем флажки о начале работы в режиме
        eqManagementModeEnabled = true;
        eqManagementModeEnabledName = editType;
            // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
        // применение стилей делаем через функцию если мод еще не включен
        //useCssStylesToSiteDivision(editType, false);
        equipmentManagementFetchActions(editType, eqMMInputEditingEnabled);
        
    } 
    else {
        //useCssStylesToSiteDivision(editType, eqManagementModeEnabled)
    }
}

// применение стилей к таблице в зависимости от мода



let eqEditModeTargetId = null;
let EditingRowsOld = null;
let eqDataOld = {};
let eqData = {};

// .table-tr-delete-mode .fs-table-row'
// функционал режима редактирований
function equipmentManagementFetchActions(editType, inputEditEnabled) {
    if (editType === "equipment_delete" && eqManagementModeEnabled && eqManagementModeEnabledName === editType && inputEditEnabled === false) {
        document.querySelectorAll('.table-tr-delete-mode').forEach(tableEditingRow => {
            tableEditingRow.addEventListener('dblclick', () => {
                if ( eqManagementModeEnabled && eqManagementModeEnabledName !== null){
                    // получаем значения удаляемой записи
                    eqDivId = parseInt(tableEditingRow.dataset.id);
                    
                    tableEditingRow.classList.add('fs-popup-window-btn');
                    document.querySelectorAll('.fs-popup-window-btn');
                    // выводим окошко с вопросом о удалении
                    getPopupMessage('delete', [eqDivId, tableEditingRow]);

                    console.log('Удаляю элемент с id=', eqDivId)
                }
                

                // `/DeleteEquipment?eq_div_id=${eqDivId}`

                // fetch(`/DeleteEquipment/${eqDivId}`, {
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
    fetch(`/PopupMessage?eq_div_id=${messageData[0]}&message_type=${messageType}`)
    .then(res => res.text())
    .then(html => {
        popupAPI.open()
        document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Внимание!";
        document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
        deleteRequest(messageData[0], messageData[1]);
    })
    .catch(error => {
        console.error('Ошибка поиска:', error);
    });

}

function deleteRequest(eqDivId, deletingElem) {
    document.querySelectorAll('.popupActionBtn').forEach(popupActionBtn => {
        popupActionBtn.addEventListener('click', () => {
            if (popupActionBtn.dataset.btn === "yes"){
                console.log('Удаляю элемент с id=', eqDivId)

                // `/DeleteEquipment?eq_div_id=${eqDivId}`
                fetch(`/DeleteEquipment/${eqDivId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        Accept: 'application/json',
                    },
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