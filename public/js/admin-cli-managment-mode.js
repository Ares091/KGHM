// инициализируем необходимые флаги и глобальные переменные для корректной работы скрипта
let cliManagementModeEnabled = false; // режим "редактирование техники" по умолчанию выключен
let cliManagementModeEnabledName = null; //название активного режима редактирования
let cliMMInputEditingEnabled = false; // флажок для изменения редактируемой информации в инпут

// функция входа в режим "редактирования техники". применяет стили, активирует листенеры кнопок и их функции
function EnterToAdminManagementMode(editType) {
    if (editType === "admin_delete" && !cliManagementModeEnabled && cliManagementModeEnabledName === null){
        // активируем флажки о начале работы в режиме
        cliManagementModeEnabled = true;
        cliManagementModeEnabledName = editType;
            // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
        // применение стилей делаем через функцию если мод еще не включен
        useCssStylesToSite(editType, false);
        adminManagementFetchActions(editType, cliMMInputEditingEnabled);
        
    } 
    else if (editType === "admin_edit" && !cliManagementModeEnabled && cliManagementModeEnabledName === null) {
        cliManagementModeEnabled = true;
        cliManagementModeEnabledName = editType;
            // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
        // применение стилей делаем через функцию если мод еще не включен
        useCssStylesToSite(editType, false);
        adminManagementFetchActions(editType, cliMMInputEditingEnabled);

    }
    else {
        useCssStylesToSite(editType, cliManagementModeEnabled)
    }
}

// применение стилей к таблице в зависимости от мода
function useCssStylesToSite(editType, used){
    if (used === false) { // стили не пременены тогда выполняем условие
        if (editType === "admin_delete"){

            // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
            // к контейнеру таблицы учета техники
            document.querySelector('.handbook-body-right-main-data-panel-section').classList.add('brm-dp-secton-delete-mode');
            // к фону заголовка таблицы учета техники
            document.querySelector('.handbook-body-right-main-data-panel-section-header').classList.add('brm-dp-header-delete-mode');

            // создаем и добавляем плашку с названием режима редактирования в заголовок таблицы уч. техники
            eqModeLabel = document.createElement('div');
            eqModeLabel.classList.add('nav-btn-text', 'hb-mode-label', 'fl-align');
            eqModeLabel.textContent = "Режим удаления";
            document.querySelector('.handbook-body-right-mdps-header-text-block').append(eqModeLabel)

            // таблица
            // добавляем стили для таблицы и её ячеек
            document.querySelector("thead tr").classList.add('table-tr-header-delete-mode');

            document.querySelectorAll('.table-row').forEach(tableRow => {
                tableRow.classList.add('table-tr-delete-mode')
            });


            // 
            quitFromModeBtn = document.createElement('div');
            quitFromModeBtn.classList.add('quit-from-mode-btn-block', 'fl-align');
            quitFromModeBtn.innerHTML = `
                <div class="admin-dynamic-edit-btn quit-from-mode-btn admin-btn handbook-header-nav-btn-block nav-btn  fl-align" data-edit-type="equipment_edit_close">
                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                        <img src="../sources/media/icons/import (1).png" alt="" class="handbook-hvb-icon img">
                    </div>
                    <div class="handbook-hvb-text-block">
                        <p class="nav-btn-text handbook-hvb-text">Выйти из режима редактивания</p>
                    </div>
                </div>
            `;
            document.querySelector('.handbook-header-section-left-bar').append(quitFromModeBtn)

            quitFromModeBtn.addEventListener('click', () => {
                EnterToAdminManagementMode(editType);
            });
        }
        if (editType === "admin_edit") {
            document.querySelector('.handbook-body-right-main-data-panel-section').classList.add('brm-dp-secton-edit-mode');
            document.querySelector('.handbook-body-right-main-data-panel-section-header').classList.add('brm-dp-header-edit-mode');

            eqModeLabel = document.createElement('div');
            eqModeLabel.classList.add('nav-btn-text', 'hb-mode-label', 'fl-align');
            eqModeLabel.textContent = "Режим изменения";
            document.querySelector('.handbook-body-right-mdps-header-text-block').append(eqModeLabel);

            document.querySelector("thead tr").classList.add('table-tr-header-edit-mode');

            document.querySelectorAll('.table-row').forEach(tableRow => {
                tableRow.classList.add('table-tr-edit-mode')
            });


            // 
            quitFromModeBtn = document.createElement('div');
            quitFromModeBtn.classList.add('quit-from-mode-btn-block', 'fl-align');
            quitFromModeBtn.innerHTML = `
                <div class="admin-dynamic-edit-btn quit-from-mode-btn quit-from-edit-mode-btn admin-btn handbook-header-nav-btn-block nav-btn  fl-align" data-edit-type="equipment_edit_close">
                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                        <img src="../sources/media/icons/import (1).png" alt="" class="handbook-hvb-icon img">
                    </div>
                    <div class="handbook-hvb-text-block">
                        <p class="nav-btn-text handbook-hvb-text">Выйти из режима редактивания</p>
                    </div>
                </div>
            `;
            document.querySelector('.handbook-header-section-left-bar').append(quitFromModeBtn)

            quitFromModeBtn.addEventListener('click', () => {
                EnterToAdminManagementMode(editType);
            });
        }
    }
    else {
        // удаляем все флажки для дальнейшей повторной работы
        cliManagementModeEnabled = false;
        cliManagementModeEnabledName = null;
        // выходим из режима редактирования в зависимости от его типа
        if (editType === "admin_delete") {
            document.querySelector('.handbook-body-right-main-data-panel-section').classList.remove('brm-dp-secton-delete-mode');
            document.querySelector('.handbook-body-right-main-data-panel-section-header').classList.remove('brm-dp-header-delete-mode');

            document.querySelector('.nav-btn-text.hb-mode-label.fl-align').remove();

            document.querySelector("thead tr").classList.remove('table-tr-header-delete-mode');

            document.querySelectorAll('.table-row').forEach(tableRow => {
                tableRow.classList.remove('table-tr-delete-mode')
            });

            document.querySelector('.quit-from-mode-btn-block').remove();
        } else if (editType === "admin_edit") {
            document.querySelector('.handbook-body-right-main-data-panel-section').classList.remove('brm-dp-secton-edit-mode');
            document.querySelector('.handbook-body-right-main-data-panel-section-header').classList.remove('brm-dp-header-edit-mode');

            document.querySelector('.nav-btn-text.hb-mode-label.fl-align').remove();

            document.querySelector("thead tr").classList.remove('table-tr-header-edit-mode');

            document.querySelectorAll('.table-row').forEach(tableRow => {
                tableRow.classList.remove('table-tr-edit-mode')
            });

            document.querySelector('.quit-from-mode-btn-block').remove();
            
            exitFromEditMode();

        }
            
    }
    
        
}

function exitFromEditMode() {
    // console.log('Вызываем выход из режима редактирования объекта с id', cliEditModeTargetId);
    if (cliEditModeTargetId !== null){
        document.querySelectorAll('.table-row.editing-tr').forEach(EdRowLine => {
            if (EdRowLine.classList.contains('editing-tr')) {
                EdRowLine.classList.remove('editing-tr');

                // EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                //     if (tRowIndex !== 0) { 
                //         const oldRow = EditingRowsOld[tRowIndex + 1];
                //         oldRow.textContent = cliData;

                //         newRow.replaceWith(oldRow);
                //     }
                // });
                const tableInputs = EdRowLine.querySelectorAll('.fs-table-row input');

                EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                    if (tRowIndex !== 0) { 
                        const oldRow = EditingRowsOld[tRowIndex];
                        const newRowValue = tableInputs[tRowIndex - 1];
                        console.log('newRowValue', newRowValue);
                        console.log('oldRow: ', oldRow, tRowIndex);
                        oldRow.innerHTML = newRowValue.value;
                        
                        
                        newRow.replaceWith(oldRow);
                    }
                });

                cliEditModeTargetId = null;
                EditingRowsOld = null;
                // tableInputs = [];
                console.log('Выход из режима редактирования произведен')
            }
        });
    }
}

let cliEditModeTargetId = null;
let EditingRowsOld = null;
let cliDataOld = {};
let cliData = {};
// .table-tr-delete-mode .fs-table-row'
// функционал режима редактирований
function adminManagementFetchActions(editType, inputEditEnabled) {
    if  (editType === "admin_edit" && cliManagementModeEnabled && cliManagementModeEnabledName === editType && inputEditEnabled === false) {
        document.querySelectorAll('.table-tr-edit-mode')?.forEach(EditingRowLine => {

            EditingRowLine?.addEventListener('dblclick', (e) => {

                if (cliEditModeTargetId !== null){
                    document.querySelectorAll('.table-tr-edit-mode').forEach(EdRowLine => {
                        if (EdRowLine.classList.contains('editing-tr')) {
                            EdRowLine.classList.remove('editing-tr');

                            // EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                            //     if (tRowIndex !== 0) { 
                            //         const oldRow = EditingRowsOld[tRowIndex + 1];
                            //         oldRow.textContent = cliData;

                            //         newRow.replaceWith(oldRow);
                            //     }
                            // });
                            const tableInputs = EdRowLine.querySelectorAll('.fs-table-row input');

                            EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                                if (tRowIndex !== 0) { 
                                    const oldRow = EditingRowsOld[tRowIndex];
                                    const newRowValue = tableInputs[tRowIndex - 1];
                                    console.log('newRowValue', newRowValue);
                                    console.log('oldRow: ', oldRow, tRowIndex);
                                    oldRow.innerHTML = newRowValue.value;
                                    
                                    
                                    newRow.replaceWith(oldRow);
                                }
                            });

                            cliEditModeTargetId = null;
                            EditingRowsOld = null;
                            // tableInputs = [];
                        }
                    });
                }

                EditingRowLine = e.target.closest('.table-tr-edit-mode');
                EditingRows = EditingRowLine.querySelectorAll('.fs-table-row');

                EditingRowLineOld = EditingRowLine;
                EditingRowsOld = EditingRows;

                console.log('EditingRowsOld: ', EditingRowsOld)

                cliEditModeTargetId = parseInt(EditingRowLine.dataset.id);
                EditingRowLine.classList.add('editing-tr');
                const tableInputs = [];

                // editRow = e.target.closest('.fs-table-row');
                // tableEditingRowOld = editRow;

                // console.log(EditingRowLine);

                EditingRows.forEach((EdRowData, tRowIndex) => {
                    if (tRowIndex !== 0) {
                        const EditingRowText = EdRowData.textContent.trim();
                        const inputER = document.createElement('input');
                        inputER.type = 'text';

                        inputER.setAttribute('value', EditingRowText);

                        const erDataNames = ['cli_name_view', 'cli_prof', 'cli_tel_work', 'cli_tel_work2', 'cli_tel_mobile', 'cli_email', 'cli_sync_1c_status'];
                        if (tRowIndex < erDataNames.length + 1) {
                            inputER.dataset.name = erDataNames[tRowIndex - 1];
                        }
                        inputER.dataset.id = EditingRowLine.dataset.id;

                        EdRowData.innerHTML = '';
                        EdRowData.appendChild(inputER);

                        inputER.classList.add('input-edit-1', 'input');

                        tableInputs.push(inputER);

                        cliDataOld[inputER.dataset.name] = EditingRowText;
                    }
                });
                
                // сохраняем значения
                

                // тут закончил / сверял с old 2
                // надо проверить прошлый скрипт
                
                // выход
                // console.log('EditingRowLine: ', EditingRowLine)
                // EditingRowLine 
                //document.querySelector('.table-tr-delete-mode.editing-tr')
                document.querySelector('.table-tr-edit-mode.editing-tr').addEventListener('keydown', (e) => {
                    console.log(e.key);
                    if (e.key === 'Enter') {
                        const cliDivId = tableInputs[0].dataset.id;
                        // const cliData = tInput.value;
                        const cliData1 = {};

                        tableInputs.forEach((tInput, index) => {
                            cliData1[tInput.dataset.name] = tInput.value;
                        })

                        tableInputs.forEach((tInput, index) => {
                            // console.log(`cliData1[${tInput.dataset.name}]`, cliData1[tInput.dataset.name], `cliDataOld[${tInput.dataset.name}}]`, cliDataOld[tInput.dataset.name])
                            if (cliData1[tInput.dataset.name] !== cliDataOld[tInput.dataset.name]) {
                                cliData[tInput.dataset.name] = tInput.value;
                            } 
                        })
                        //fsddsf

                        fetch(`/EditAdmin?cli_div_id=${cliDivId}&cli_data=${JSON.stringify(cliData)}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                Accept: 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // const newRow = document.createElement('td');

                                // const newRow = EditingRowsOld[index + 1]
                                // newRow.textContent = cliData;
                                // tInput.replaceWith(newRow);
                                // cliEditModeTargetId = null;
                                // EdRowLine = document.querySelector('.table-tr-delete-mode.editing-tr');
                                EdRowLine = document.querySelector(`.table-tr-edit-mode[data-id="${cliEditModeTargetId}"]`);
                                if (EdRowLine.classList.contains('editing-tr')) {
                                    EdRowLine.classList.remove('editing-tr');

                                    console.log('EdRowLine.querySelectorAll(.fs-table-row): ', EdRowLine.querySelectorAll('.fs-table-row'))
                                    console.log('EdRowLine.EditingRowsOld: ', EditingRowsOld)

                                    EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                                        if (tRowIndex !== 0) { 
                                            const oldRow = EditingRowsOld[tRowIndex];
                                            const newRowValue = tableInputs[tRowIndex - 1];
                                            // console.log('newRowValue', newRowValue);
                                            // console.log('oldRow: ', oldRow, tRowIndex);
                                            oldRow.innerHTML = newRowValue.value;
                                            

                                            newRow.replaceWith(oldRow);
                                        }
                                    });

                                    cliEditModeTargetId = null;
                                    EditingRowsOld = null;
                                    // tableInputs = []
                                }


                            }
                        })
                        .catch(error => {
                            console.error('Ошибка поиска:', error);
                        });

                        console.log('cliDivId', cliDivId, 'cliData', cliData, 'cliDataOld', cliDataOld);
                    }
                    
                });

                // tableInputs.forEach((tInput, index) => {
                //     tInput.addEventListener('keydown', (e) => {
                //         if (e.key === 'Enter') {
                //             const cliDivId = tInput.dataset.id;
                //             const cliName = tInput.dataset.name;
                //             const cliData = tInput.value;

                //             fetch(`/EditAdmin?cli_div_id=${cliDivId}&cli_col_name=${cliName}&cli_data=${cliData}`, {
                //                 method: 'POST',
                //                 headers: {
                //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                //                     Accept: 'application/json',
                //                 },
                //             })
                //             .then(response => response.json())
                //             .then(data => {
                //                 if (data.success) {
                //                     // const newRow = document.createElement('td');

                //                     // const newRow = EditingRowsOld[index + 1]
                //                     // newRow.textContent = cliData;
                //                     // tInput.replaceWith(newRow);
                //                     // cliEditModeTargetId = null;
                //                     EdRowLine = document.querySelector('.table-tr-delete-mode[data-id="49299"]');
                //                     if (EdRowLine.classList.contains('editing-tr')) {
                //                         EdRowLine.classList.remove('editing-tr');

                //                         console.log('EdRowLine.querySelectorAll(.fs-table-row): ', EdRowLine.querySelectorAll('.fs-table-row'))
                //                         console.log('EdRowLine.EditingRowsOld: ', EditingRowsOld)

                //                         EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                //                             if (tRowIndex !== 0) { 
                //                                 const oldRow = EditingRowsOld[tRowIndex];
                //                                 const newRowValue = tableInputs[tRowIndex - 1];
                //                                 console.log('newRowValue', newRowValue);
                //                                 console.log('oldRow: ', oldRow, tRowIndex);
                //                                 oldRow.innerHTML = newRowValue.value;
                                                

                //                                 newRow.replaceWith(oldRow);
                //                             }
                //                         });

                //                         cliEditModeTargetId = null;
                //                         EditingRowsOld = null;
                //                     }


                //                 }
                //             })
                //             .catch(error => {
                //                 console.error('Ошибка поиска:', error);
                //             });
                //         }

                //     });
                // });

                



            });
        });
    
    }
    else if (editType === "admin_delete" && cliManagementModeEnabled && cliManagementModeEnabledName === editType && inputEditEnabled === false) {
        document.querySelectorAll('.table-tr-delete-mode').forEach(tableEditingRow => {
            tableEditingRow.addEventListener('dblclick', () => {
                // получаем значения удаляемой записи
                if (cliManagementModeEnabled && cliManagementModeEnabledName === "admin_delete") {
                    cliDivId = parseInt(tableEditingRow.dataset.id);

                    tableEditingRow.classList.add('fs-popup-window-btn');
                    document.querySelectorAll('.fs-popup-window-btn');
                    // выводим окошко с вопросом о удалении
                    getCleintPopupMessage('delete', [cliDivId, tableEditingRow]);

                    console.log('Удаляю элемент с id=', cliDivId)

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

                }
               
                


            });
        });
    
    
    }
    
}

function getCleintPopupMessage(messageType, messageData, messageDesc = ""){
    console.log(`/PopupMessage?cli_id=${messageData[0]}&message_type=${messageType}`)
    console.log(`messageData: ${messageData}`)

    fetch(`/PopupMessage?cli_id=${messageData[0]}&message_type=${messageType}`)
    .then(res => res.text())
    .then(html => {
        popupAPI.open()
        document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Внимание!";
        document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
        deleteClientRequest(messageData[0], messageData[1]);
    })
    .catch(error => {
        console.error('Ошибка поиска:', error);
    });

}

function deleteClientRequest(eqDivId, deletingElem) {
    document.querySelectorAll('.popupActionBtn').forEach(popupActionBtn => {
        popupActionBtn.addEventListener('click', () => {
            if (popupActionBtn.dataset.btn !== "no"){
                console.log('Удаляю элемент с id=', eqDivId)

                // `/DeleteEquipment?eq_div_id=${eqDivId}`
                fetch(`/DeleteAdmin/${eqDivId}`, {
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
                        // deletingElem.remove();
                        deletingElem.classList.add('tr-disabled');

                        
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
        if (window.popupAPI.config.openPopupBtnsIsActive === true) {
            EnterToAdminManagementMode(adminDEBtn.dataset.editType);
        }
    });
});




function changeClient1cStatus(cliId) {
    document.querySelectorAll('.fs-t-row-1c').forEach(cli1CBtn => {
        cli1CBtn.addEventListener('click', () => {
                console.log('изменяю статус 1С у id=', cliId)

                // `/DeleteEquipment?eq_div_id=${eqDivId}`
                fetch(`/changeClient1cStatus?cli_id=${cliId}`, {
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
                        if (data.status) {
                            cli1CBtn.innerHTML = '✔';
                        }
                        else {
                            cli1CBtn.innerHTML = '✘';
                        }
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                });
        })
    });


    
}