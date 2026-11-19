
// инициализируем необходимые флаги и глобальные переменные для корректной работы скрипта
let eqManagementModeEnabled = false; // режим "редактирование техники" по умолчанию выключен
let eqManagementModeEnabledName = null; //название активного режима редактирования

let eqMMInputEditingEnabled = false; // флажок для изменения редактируемой информации в инпут

// функция входа в режим "редактирования техники". применяет стили, активирует листенеры кнопок и их функции
function EnterToEquipmentManagementMode(editType) {
    if (editType === "equipment_delete" && !eqManagementModeEnabled && eqManagementModeEnabledName === null){
        // активируем флажки о начале работы в режиме
        eqManagementModeEnabled = true;
        eqManagementModeEnabledName = editType;
            // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
        // применение стилей делаем через функцию если мод еще не включен
        useCssStylesToSite(editType, false);
        equipmentManagementFetchActions(editType, eqMMInputEditingEnabled);
        
    } 
    else if (editType === "equipment_edit" && !eqManagementModeEnabled && eqManagementModeEnabledName === null) {
        eqManagementModeEnabled = true;
        eqManagementModeEnabledName = editType;
            // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
        // применение стилей делаем через функцию если мод еще не включен
        useCssStylesToSite(editType, false);
        equipmentManagementFetchActions(editType, eqMMInputEditingEnabled);
    }
    else {
        useCssStylesToSite(editType, eqManagementModeEnabled)
    }
}

// применение стилей к таблице в зависимости от мода
function useCssStylesToSite(editType, used){

    if (used === false) { // стили не пременены тогда выполняем условие
        if (editType === "equipment_delete"){

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
                        <p class="nav-btn-text handbook-hvb-text">Выйти из режима удаления</p>
                    </div>
                </div>
            `;
            document.querySelector('.handbook-header-section-left-bar').append(quitFromModeBtn)

            quitFromModeBtn.addEventListener('click', () => {
                EnterToEquipmentManagementMode(editType);
            });
        }
        if (editType === "equipment_edit") {
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
                        <p class="nav-btn-text handbook-hvb-text">Выйти из р. редактирования</p>
                    </div>
                </div>
            `;
            document.querySelector('.handbook-header-section-left-bar').append(quitFromModeBtn)

            quitFromModeBtn.addEventListener('click', () => {
                EnterToEquipmentManagementMode(editType);
            });
        }
    }
    else {
        // удаляем все флажки для дальнейшей повторной работы
        eqManagementModeEnabled = false;
        eqManagementModeEnabledName = null;
        // выходим из режима редактирования в зависимости от его типа
        if (editType === "equipment_delete") {
            document.querySelector('.handbook-body-right-main-data-panel-section').classList.remove('brm-dp-secton-delete-mode');
            document.querySelector('.handbook-body-right-main-data-panel-section-header').classList.remove('brm-dp-header-delete-mode');

            document.querySelector('.nav-btn-text.hb-mode-label.fl-align').remove();

            document.querySelector("thead tr").classList.remove('table-tr-header-delete-mode');

            document.querySelectorAll('.table-row').forEach(tableRow => {
                tableRow.classList.remove('table-tr-delete-mode')
            });

            document.querySelector('.quit-from-mode-btn-block').remove();
        } else if (editType === "equipment_edit") {
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
    // console.log('Вызываем выход из режима редактирования объекта с id', eqEditModeTargetId);
    if (eqEditModeTargetId !== null){
        document.querySelectorAll('.table-row.editing-tr').forEach(EdRowLine => {
            if (EdRowLine.classList.contains('editing-tr')) {
                EdRowLine.classList.remove('editing-tr');

                // EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                //     if (tRowIndex !== 0) { 
                //         const oldRow = EditingRowsOld[tRowIndex + 1];
                //         oldRow.textContent = eqData;

                //         newRow.replaceWith(oldRow);
                //     }
                // });
                const tableInputs = EdRowLine.querySelectorAll('.fs-table-row input, .fs-table-row select')

                console.log('EditingRowsOld:', EditingRowsOld);
                console.log('Current tableInputs:', tableInputs);

                EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                    const oldRow = EditingRowsOld[tRowIndex];
                    let newRowValue = null;

                    if (tableInputs[tRowIndex].type === 'select-one' ) {
                        newRowValue = tableInputs[tRowIndex].selectedOptions[0].innerHTML;
                        // tableInputs[0].options.selectedIndex //selected index
                        // console.log('tableInputs[tRowIndex].selectedOptions', tableInputs[tRowIndex].selectedOptions[0].innerHTML)
                        oldRow.innerHTML = newRowValue;
                    }
                    else {
                        newRowValue = tableInputs[tRowIndex];
                        // console.log('newRowValue', newRowValue);
                        // console.log('oldRow: ', oldRow, tRowIndex);
                        oldRow.innerHTML = newRowValue.value;
                    }
                    
                    
                    
                    newRow.replaceWith(oldRow);
                });

                eqEditModeTargetId = null;
                EditingRowsOld = null;
                // tableInputs = [];
                console.log('Выход из режима редактирования произведен')
            }
        });
    }
}

let eqEditModeTargetId = null;
let EditingRowsOld = null;
let eqDataOld = {};
let eqData = {};

// .table-tr-delete-mode .fs-table-row'
// функционал режима редактирований
function equipmentManagementFetchActions(editType, inputEditEnabled) {
    if  (editType === "equipment_edit" && eqManagementModeEnabled && eqManagementModeEnabledName === editType && inputEditEnabled === false) {
        document.querySelectorAll('.table-tr-edit-mode')?.forEach(EditingRowLine => {

            EditingRowLine?.addEventListener('dblclick', (e) => {

                if (eqEditModeTargetId !== null){
                    return exitFromEditMode();
                }

                EditingRowLine = e.target.closest('.table-tr-edit-mode');
                EditingRows = EditingRowLine.querySelectorAll('.fs-table-row');

                EditingRowLineOld = EditingRowLine;
                EditingRowsOld = EditingRows;

                console.log('EditingRowsOld: ', EditingRowsOld)

                eqEditModeTargetId = parseInt(EditingRowLine.dataset.id);
                EditingRowLine.classList.add('editing-tr');
                const tableInputs = [];

                // editRow = e.target.closest('.fs-table-row');
                // tableEditingRowOld = editRow;

                // console.log(EditingRowLine);

                EditingRows.forEach((EdRowData, tRowIndex) => {
                    let EditingRowText = null;
                    let inputER = null;
                    if (tRowIndex === 0 || tRowIndex === 1 || tRowIndex === 7) {

                        EditingRowText = EdRowData.textContent.trim();
                        inputER = document.createElement('select');
                        optionsHtml = null;
                        // inputER.type = 'text';

                        if (tRowIndex === 0) {
                            optionsHtml = `
                                <option value="1" ${EditingRowText === 'На складе' ? 'selected' : ""}>На складе</option>
                                <option value="2" ${EditingRowText === 'Выдан' ? 'selected' : ""}>Выдан</option>
                                <option value="3" ${EditingRowText === 'Списан' ? 'selected' : ""}>Списан</option>
                            `;
                        }
                        else if (tRowIndex === 1) {
                            optionsHtml = `
                                <option value="1" ${EditingRowText === 'Компьютер' ? 'selected' : ""}>Компьютер</option>
                                <option value="2">Ламинатор</option>
                                <option value="3" ${EditingRowText === 'Монитор' ? 'selected' : ""}>Монитор</option>
                                <option value="4" ${EditingRowText === 'МФУ' ? 'selected' : ""}>МФУ</option>
                                <option value="5">Системный блок</option>
                                <option value="6">Ноутбук</option>
                                <option value="7" ${EditingRowText === 'Принтер лазерный' ? 'selected' : ""}>Принтер лазерный</option>
                                <option value="9" ${EditingRowText === 'Принтер струйный' ? 'selected' : ""}>Принтер струйный</option>
                                <option value="10">Регистратор фискальный</option>
                                <option value="11">Сетевое хранилище</option>
                                <option value="13" ${EditingRowText === 'Сканер' ? 'selected' : ""}>Сканер</option>
                                <option value="14">Фотоаппарат</option>
                                <option value="16">ИБП</option>
                                <option value="17">Инженерная система</option>
                                <option value="18">Компьютер-мини</option>
                                <option value="19">Копир</option>
                                <option value="20">Малоценка</option>
                                <option value="21">Неттоп</option>
                                <option value="22">Принтер матричный</option>
                                <option value="24">Проектор</option>
                                <option value="25">Прочее</option>
                                <option value="26">Сервер</option>
                                <option value="27" ${EditingRowText === 'Факс' ? 'selected' : ""}>Факс</option>
                                <option value="28">Шредер</option>
                                <option value="29">Ноутбук</option>
                            `;
                        }
                        else {
                            optionsHtml = `
                                <option value="3766">Отдел информационных технологий</option>
                                <option value="3768">Котельно-сварочный цех № 22</option>
                                <option value="3769" selected>Котлоаппаратурный цех № 23</option>
                                <option value="3770">Цех № 28 покрытий и упаковки</option>
                                <option value="3771">Заготовительно-сварочный цех № 45</option>
                                <option value="3772">Транспортный цех</option>
                                <option value="3773">Центральная бухгалтерия</option>
                                <option value="3774">Департамент главного конструктора</option>
                                <option value="3775">Дирекция</option>
                                <option value="3777">Отдел контроля промышленной безопасности</option>
                                <option value="3778">Отдел промышленной электроники</option>
                                <option value="3779">Отдел безопасности</option>
                                <option value="3782">Отдел сбыта</option>
                            `;
                        }
                        

                        // <select type="text" class="input form-input form-popup-i-text" id="doc_sup_prov_id" name="doc_sup_prov_id" > 
                        // </select>

                        inputER.innerHTML = optionsHtml;

                        // inputER.setAttribute('value', EditingRowText);
                        
                    }
                    else {
                        EditingRowText = EdRowData.textContent.trim();
                        inputER = document.createElement('input');
                        inputER.type = 'text';

                        inputER.setAttribute('value', EditingRowText);
                    }
                    

                    const erDataNames = ['eq_status_id', 'eq_type_id', 'eq_name', 'eq_serial_number', 'eq_inventory_number', 'eq_cart_number', 'eq_div_id', 'import_div'];
                    if (tRowIndex < erDataNames.length) {
                        inputER.dataset.name = erDataNames[tRowIndex];
                    }
                    inputER.dataset.id = EditingRowLine.dataset.id;

                    EdRowData.innerHTML = '';
                    EdRowData.appendChild(inputER);

                    inputER.classList.add('input-edit-1', 'input');

                    tableInputs.push(inputER);

                    eqDataOld[inputER.dataset.name] = EditingRowText;
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
                        const eqDivId = tableInputs[0].dataset.id;
                        // const eqData = tInput.value;
                        const eqData1 = {};

                        tableInputs.forEach((tInput, index) => {
                            eqData1[tInput.dataset.name] = tInput.value;
                        })

                        tableInputs.forEach((tInput, index) => {
                            // console.log(`eqData1[${tInput.dataset.name}]`, eqData1[tInput.dataset.name], `eqDataOld[${tInput.dataset.name}}]`, eqDataOld[tInput.dataset.name])
                            if (eqData1[tInput.dataset.name] !== eqDataOld[tInput.dataset.name]) {
                                eqData[tInput.dataset.name] = tInput.value;
                            } 
                        })
                        //fsddsf

                        fetch(`/EditEquipment?eq_div_id=${eqDivId}&eq_data=${JSON.stringify(eqData)}`, {
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
                                // newRow.textContent = eqData;
                                // tInput.replaceWith(newRow);
                                // eqEditModeTargetId = null;
                                // EdRowLine = document.querySelector('.table-tr-delete-mode.editing-tr');
                                EdRowLine = document.querySelector(`.table-tr-edit-mode[data-id="${eqEditModeTargetId}"]`);
                                console.log('edRowline id', eqEditModeTargetId, 'EdRowLine elem', EdRowLine = document.querySelector(`.table-tr-edit-mode[data-id="${eqEditModeTargetId}"]`))
                                if (EdRowLine.classList.contains('editing-tr')) {
                                    EdRowLine.classList.remove('editing-tr');

                                    console.log('EdRowLine.querySelectorAll(.fs-table-row): ', EdRowLine.querySelectorAll('.fs-table-row'))
                                    console.log('EdRowLine.EditingRowsOld: ', EditingRowsOld)

                                    EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                                        const oldRow = EditingRowsOld[tRowIndex];
                                        const newRowValue = tableInputs[tRowIndex];
                                        // console.log('newRowValue', newRowValue);
                                        // console.log('oldRow: ', oldRow, tRowIndex);
                                        oldRow.innerHTML = newRowValue.value;

                                        newRow.replaceWith(oldRow);
                                    });

                                    eqEditModeTargetId = null;
                                    EditingRowsOld = null;
                                    // tableInputs = []
                                }


                            }
                        })
                        .catch(error => {
                            console.error('Ошибка поиска:', error);
                        });

                        console.log('eqDivId', eqDivId, 'eqData', eqData, 'eqDataOld', eqDataOld);
                    }
                    
                });


            });



        });
    
    }
    else if (editType === "equipment_delete" && eqManagementModeEnabled && eqManagementModeEnabledName === editType && inputEditEnabled === false) {
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
        deleteEquipmentRequest(messageData[0], messageData[1]);
    })
    .catch(error => {
        console.error('Ошибка поиска:', error);
    });

}

function deleteEquipmentRequest(eqDivId, deletingElem) {
    document.querySelectorAll('.popupActionBtn').forEach(popupActionBtn => {
        popupActionBtn.addEventListener('click', () => {
            if (popupActionBtn.dataset.btn !== "no"){
                console.log('Удаляю элемент с id=', eqDivId)

                // `/DeleteEquipment?eq_div_id=${eqDivId}`
                fetch(`/DeleteEquipment/${eqDivId}`, {
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
        if (window.popupAPI.config.openPopupBtnsIsActive === true) {
            EnterToEquipmentManagementMode(adminDEBtn.dataset.editType)
        }
    });
});