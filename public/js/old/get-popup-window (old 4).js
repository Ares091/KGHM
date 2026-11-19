groupNavBtnListOpened = false;
applyFormBtn = null;
currentPopupType = null;

function getPopupWindow(popupName, popupMode = "default") {
    console.log('вывожу окно');
    currentPopupType = popupName;

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
    } 
    else if (popupName === 'user_info') { 
        fetch(`/PopupUserInfo`)
        .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Учетные данные";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } 
    else if (popupName === 'support') { 
        fetch(`/PopupSupport`)
        .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Тех. подержка";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } 
     else if (popupName === 'user_add') { 
        fetch(`/registerForm`)
        .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Добавить пользователя";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } 

    // окошко создания единицы техники
    else if (popupName === 'equipment_add') { 
        document.querySelector('.fl-popup-window-block').classList.add("fl-pwb-wide-mode");
        fetch(`/PopupaddEquipment`)
        .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Добавить единицу техники";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
            initItemsFormSearch();
            addSearchEvListeners('clients');
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } 
    else if (popupName === 'getPopupActionsForEquipment') { 
        // fetch(`/PopupActionEquipment`)
        // .then(res => res.text())
        // .then(html => {
        //     document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Переписать технику на др. сотрудника";
        //     document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
        //     console.log(`окно ${popupName} выведено успешно`);
            
        // })
        // .catch(() => {
        //     console.log(`Ошибка загрузки ${popupName} окошка`);
        // });

        window.popupAPI.close();
        
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
    else if (popupName === 'admin_add') { 
        fetch(`/PopupaddAdmin`)
        .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Добавить сотрудника";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } 
    else if (popupName === 'division_admin_add') { 
        fetch(`/PopupAddDivision`)
        .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Добавить подразделение";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } 
    else if (popupName === 'admin_edit_form' && activeRowId !== null) { 
        fetch(`/PopupeditingAdminForm?cli_id=${activeRowId}`)
       .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Изменить данные сотрудника";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } 
    else if (popupName === 'equipment_edit_form' && activeRowId !== null) { 
        fetch(`/PopupeditingEquipmentForm?eq_id=${activeRowId}`)
       .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Редактировать единицу техники";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } 
    else if (popupName === 'division_edit_form') { 
        fetch(`/PopupdivEditingAdmin?div_id=${currentDepartmentId}`)
       .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Изменить подразделение";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } //currentDepartmentId
    else if (popupName === 'document_add') { 
                fetch(`{{ route('getPopupaddDocument') }}`)
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
 else if (popupName === 'document_edit_form') { 
        fetch(`/PopupEditingDocument?doc_sup_id=${documentId}`)
        .then(res => res.text())
        .then(html => {
                document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Изменить подразделение";
                document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
                console.log(`окно ${popupName} выведено успешно`);
                    
            })
            .catch(() => {
                console.log(`Ошибка загрузки ${popupName} окошка`);
            });
            }
    else if (popupName === 'document_edit_form') { 
        fetch(`/PopupEditingDocument?doc_sup_id=${document_edit}`)
       .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Изменить документ";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } //currentDepartmentId

    // checkPopupFormActions(popupName);
    // fetchPopupFormActions(popupName);

}

// function initPopupBtns() {
//     let clearBtn = document.querySelector('.clear-form-btn');
//     console.log('document.querySelector(clear-form-btn) :', clearBtn);
//     clearBtn.addEventListener('click', (e) => {
//         e.preventDefault();

//         document.querySelectorAll('.form-div.block > .form-input').forEach(formInput => {
//             formInput.value = '';
//         });
//     });
// }

document.querySelectorAll('.fs-popup-window-btn').forEach(popupbtn => {
    popupbtn.addEventListener('click', () => {
        getPopupWindow(popupbtn.dataset.popupType);
        // fetchPopupFormActions(popupbtn.dataset.popupType);
    });
});
fetchPopupFormActions(currentPopupType);

// document.querySelectorAll('.fs-popup-window-btn').addEventListener('click', (e) => {
//     popupbtn = e.target.closest('.fs-popup-window-btn');

//     getPopupWindow(popupbtn.dataset.popupType);
// });


function performItemsFormSearch(query, searchItemType) {
    const headerTitle = document.querySelector('.form-table-search-bar-label');
    const tableContainer = document.querySelector('.form-table-div-block-main-container-inner')
    const formSearchInput = document.querySelector('.form-table-search-input');
    
    const url = new URL('/searchFormItems', window.location.origin);
    url.searchParams.append('query', query || '');
    
    if (searchItemType) {
        url.searchParams.append('search_item_type', searchItemType);
    }
    if (formSearchInput.value.length > 0){
        url.searchParams.append('search_mode', true);
    }
    else{
        url.searchParams.append('search_mode', false);
    }
    
    // url.searchParams.append('page_is_main', window.location.href === "http://handbook/" ? true : false);

    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Обновляем таблицу
            tableContainer.innerHTML = data.html;
            
            // Обновляем заголовок
            if (data.count > 0 && query) {
                headerTitle.textContent = `Результаты поиска: "${query}" (${data.count})`;
            } else if (query) {
                headerTitle.textContent = `Результаты поиска: "${query}" (0)`;
            } else {
                headerTitle.textContent = 'Все сотрудники';
            }
            console.log('Поисковик: элементы найдены');

            addActonEvListeners(currentActionName);
            // Обновляем информационную панель
            // updateNotePanelDefault();
            // getActiveMiniIcons()
        }
    })
    .catch(error => {
        console.error('Ошибка поиска:', error);
        tableContainer.innerHTML = '<tr><td colspan="6" style="text-align:center;padding:20px;color:red;">Ошибка при выполнении поиска</td></tr>';
    });
}


function initItemsFormSearch() {
    formSearchInput = document.querySelector('.form-table-search-input');
    formSearchInput.addEventListener('input', (e) => {
        clearTimeout(formSearchimeout);
        const query = e.target.value.trim();

        if (query.length === 0){
            formSearchimeout = setTimeout(() => {
                performItemFormSearch('', formSearchInput.dataset.searchType)
            }, 200);
        }
        if (query.length > 2) {
            formSearchimeout = setTimeout(() => performItemFormSearch(query, formSearchInput.dataset.searchType), 300);
            
        }
        
    });
}

function addSearchEvListeners(searchItemType){
    formTableRows = document.querySelectorAll('.form-table-div-row');
    formTableRows.forEach(formTableDRow => {
        formTableDRow.addEventListener('click', () => {
            clientId =  formTableDRow.querySelector('.client-name-row').dataset.id;
            clientName = formTableDRow.querySelector('.client-name-row').innerHTML;
            clientDivisionId = formTableDRow.querySelector('.client-div-row').dataset.divId;
            clientDivisionName = formTableDRow.querySelector('.client-div-row').innerHTML;


            if (document.querySelector('.form-input[data-search-div="responsible"]').type === 'select-one' &&
                document.querySelector('.form-input[data-search-div="division"]').type === 'select-one'
            ) {
                document.querySelector(`.form-input[data-search-div="responsible"] option[value="${clientId}"]`).selected = true;
                document.querySelector(`.form-input[data-search-div="division"] option[value="${clientDivisionId}"]`).selected = true;
            }
            else {
                document.querySelector('.form-input[id="eq_client_id"]').value = clientId;
                document.querySelector('.form-input[id="eq_cli_name"]').value = clientName;
                document.querySelector('.form-input[id="eq_div_name"]').value = clientDivisionName;
                document.querySelector('.form-input[id="eq_div_id"]').value = clientDivisionId;
            }
            
            // console.log('Action data', data);
            // applyNewActionSettings(data);
        });
    });
}

function fetchPopupFormActions(popupName) {
    //document.querySelector('.apply-form-btn')
    document.addEventListener('click', function (e) {
        popupName = currentPopupType;

        if (e.target.closest('.apply-form-btn')){

            if (popupName === 'autorization') {
                e.preventDefault();

                formData = {
                    'u_login':  document.querySelector('.form-input[id="u_login"]').value,
                    'u_password' : document.querySelector('.form-input[id="u_password"]').value,
                };
                
                fetch(`/PopupLogin/loginDynamicValidation`, {
                    method: 'POST',
                    headers: {
                        // 'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        Accept: 'application/json',
                    },
                    body: new URLSearchParams({ u_login: formData['u_login'], u_password: formData['u_password']}),
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelectorAll('.form-valid-error').forEach(el => el.textContent = '');

                    if (data.success) {
                        console.log('Вы успешно вошли в систему');
                        window.popupAPI.close();

                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            window.location.reload()
                        }
                        return;
                    }

                    if (data.errors) {
                        for (const [field, messages] of Object.entries(data.errors)) {
                            // span имеет id равный имени поля: login / password
                            const el = document.querySelector(`.form-valid-error[data-field="${field}"]`);
                            if (el) el.textContent = messages[0];
                        }
                        // alert('Вы не авторизованы. Введены неверные данные.')
                    }
                })
                .catch(() => {
                    console.log(`Ошибка отправки данных в окошке "${popupName}"`);
                });
            } 
            else if (popupName === 'admin_add') {
                e.preventDefault();

                formData = {
                    'cli_name_f':  document.querySelector('.form-input[id="cli_name_f"]').value,
                    'cli_name_i' : document.querySelector('.form-input[id="cli_name_i"]').value,
                    'cli_name_o' : document.querySelector('.form-input[id="cli_name_o"]').value,
                    'cli_prof' : document.querySelector('.form-input[id="cli_prof"]').value,
                    'cli_div_id' : parseInt(document.querySelector('.form-input[id="cli_div_id"]').value),
                    'cli_comment' : document.querySelector('.form-input[id="cli_comment"]').value,
                    'cli_date_born' : document.querySelector('.form-input[id="cli_date_born"]').value,
                    'cli_sex' : parseInt(document.querySelector('.form-input[id="cli_sex"]').value),
                    'cli_email' : document.querySelector('.form-input[id="cli_email"]').value,
                    'cli_tel_mobile' : document.querySelector('.form-input[id="cli_tel_mobile"]').value,
                    'cli_tel_work' : document.querySelector('.form-input[id="cli_tel_work"]').value,
                    'cli_tel_work2' : document.querySelector('.form-input[id="cli_tel_work2"]').value,
                    'cli_tel_work2' : document.querySelector('.form-input[id="cli_tel_work2"]').value,
                    'cli_disable' : document.querySelector('.form-input[id="cli_disable"]').checked === true ? 1 : 0,
                    'cli_sync_1c' : document.querySelector('.form-input[id="cli_sync_1c"]').checked === true ? 1 : 0,
                };

                console.log('data:', formData);
                // поменять url
                fetch(`/PopupaddAdmin/adminAddDynamicPost`, {
                    method: 'POST',
                    headers: {
                        // 'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        Accept: 'application/json',
                    },
                    body: new URLSearchParams(formData),
                    // body: new URLSearchParams({ u_login: data['u_login'], u_password: data['u_password']}),
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelectorAll('.form-valid-error').forEach(el => el.textContent = '');

                    if (data.success) {
                        console.log('Вы успешно отправили запрос');
                        window.popupAPI.close();

                    }

                    if (data.errors) {
                        console.log('data.errors', data.errors);
                        for (const [field, messages] of Object.entries(data.errors)) {
                            // span имеет id равный имени поля: login / password
                            const el = document.querySelector(`.form-valid-error[data-field="${field}"]`);
                            if (el) el.textContent = messages[0];
                        }
                        // alert('Вы не авторизованы. Введены неверные данные.')
                    }
                })
                .catch((err) => {
                    console.log(`Ошибка отправки данных в окошке "${popupName}", ${err}`);
                });
            } 
            else if (popupName === 'admin_edit_form') {
                e.preventDefault();

                formData = {
                    'cli_id': document.querySelector('input[id="cli_id"]').value,
                    'cli_name_f':  document.querySelector('.form-input[id="cli_name_f"]').value,
                    'cli_name_i' : document.querySelector('.form-input[id="cli_name_i"]').value,
                    'cli_name_o' : document.querySelector('.form-input[id="cli_name_o"]').value,
                    'cli_prof' : document.querySelector('.form-input[id="cli_prof"]').value,
                    'cli_div_id' : parseInt(document.querySelector('.form-input[id="cli_div_id"]').value),
                    'cli_comment' : document.querySelector('.form-input[id="cli_comment"]').value,
                    'cli_date_born' : document.querySelector('.form-input[id="cli_date_born"]').value,
                    'cli_sex' : parseInt(document.querySelector('.form-input[id="cli_sex"]').value),
                    'cli_email' : document.querySelector('.form-input[id="cli_email"]').value,
                    'cli_tel_mobile' : document.querySelector('.form-input[id="cli_tel_mobile"]').value,
                    'cli_tel_work' : document.querySelector('.form-input[id="cli_tel_work"]').value,
                    'cli_tel_work2' : document.querySelector('.form-input[id="cli_tel_work2"]').value,
                    'cli_tel_work2' : document.querySelector('.form-input[id="cli_tel_work2"]').value,
                    'cli_disable' : document.querySelector('.form-input[id="cli_disable"]').checked === true ? 1 : 0,
                    'cli_sync_1c' : document.querySelector('.form-input[id="cli_sync_1c"]').checked === true   ? 1 : 0,
                };

                const innerData = window.innerPopupAPI?.getCollected() || {};
                // innerData = { sync_1c: { cli_sync_1c_code: "...", ... } }
                Object.assign(formData, innerData);

                console.log('data:', formData);
                
                fetch(`/PopupeditingAdminForm/editingAdminDynamicPost`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        Accept: 'application/json',
                    },
                    // body: new URLSearchParams(formData),
                    body: JSON.stringify(formData),
                    // body: new URLSearchParams({ u_login: data['u_login'], u_password: data['u_password']}),
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelectorAll('.form-valid-error').forEach(el => el.textContent = '');

                    if (data.success) {
                        console.log('Вы успешно отправили запрос');
                        window.innerPopupAPI?.clearCollected();
                        window.popupAPI.close();

                    }

                    if (data.errors) {
                        console.log('data.errors', data.errors);
                        for (const [field, messages] of Object.entries(data.errors)) {
                            // span имеет id равный имени поля: login / password
                            const el = document.querySelector(`.form-valid-error[data-field="${field}"]`);
                            if (el) el.textContent = messages[0];
                        }
                        // alert('Вы не авторизованы. Введены неверные данные.')
                    }
                })
                .catch((err) => {
                    console.log(`Ошибка отправки данных в окошке "${popupName}", ${err}`);
                });
            } 
            else if (popupName === 'equipment_add') {
                e.preventDefault();

                formData = {
                    'eq_status_id':  parseInt(document.querySelector('.form-input[id="eq_status_id"]').value),
                    'eq_type_id' : parseInt(document.querySelector('.form-input[id="eq_type_id"]').value),
                    'eq_name' : document.querySelector('.form-input[id="eq_name"]').value,
                    'eq_serial_number' : document.querySelector('.form-input[id="eq_serial_number"]').value,
                    'eq_inventory_number' : document.querySelector('.form-input[id="eq_inventory_number"]').value,
                    'eq_cart_number' : document.querySelector('.form-input[id="eq_cart_number"]').value,
                    'import_doc_id' : parseInt(document.querySelector('.form-input[id="import_doc"]').value),
                    'eq_client_id' : parseInt(document.querySelector('.form-input[id="eq_client_id"]').value),
                    'eq_div_id' : parseInt(document.querySelector('.form-input[id="eq_div_id"]').value),
                    'eq_comment' : document.querySelector('.form-input[id="eq_comment"]').value,
                };

                console.log('data:', formData);
                
                fetch(`/PopupaddEquipment/equipmentAddDynamicPost`, {
                    method: 'POST',
                    headers: {
                        // 'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        Accept: 'application/json',
                    },
                    body: new URLSearchParams(formData),
                    // body: new URLSearchParams({ u_login: data['u_login'], u_password: data['u_password']}),
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelectorAll('.form-valid-error').forEach(el => el.textContent = '');

                    if (data.success) {
                        console.log('Вы успешно отправили запрос');
                        window.popupAPI.close();

                    }

                    if (data.errors) {
                        console.log('data.errors', data.errors);
                        for (const [field, messages] of Object.entries(data.errors)) {
                            // span имеет id равный имени поля: login / password
                            const el = document.querySelector(`.form-valid-error[data-field="${field}"]`);
                            if (el) el.textContent = messages[0];
                        }
                        // alert('Вы не авторизованы. Введены неверные данные.')
                    }
                })
                .catch(() => {
                    console.log(`Ошибка отправки данных в окошке "${popupName}"`);
                });
            }       
            else if (popupName === 'equipment_edit_form') {
                e.preventDefault();

                formData = {
                    'eq_id':  parseInt(document.querySelector('.input[id="eq_id"]').value),
                    'eq_status_id':  parseInt(document.querySelector('.form-input[id="eq_status_id"]').value),
                    'eq_type_id' : parseInt(document.querySelector('.form-input[id="eq_type_id"]').value),
                    'eq_name' : document.querySelector('.form-input[id="eq_name"]').value,
                    'eq_serial_number' : document.querySelector('.form-input[id="eq_serial_number"]').value,
                    'eq_inventory_number' : document.querySelector('.form-input[id="eq_inventory_number"]').value,
                    'eq_cart_number' : document.querySelector('.form-input[id="eq_cart_number"]').value,
                    'import_doc_id' : parseInt(document.querySelector('.form-input[id="import_doc"]').value),
                    'eq_client_id' : parseInt(document.querySelector('.form-input[id="eq_client_id"]').value),
                    'eq_div_id' : parseInt(document.querySelector('.form-input[id="eq_div_id"]').value),
                    'eq_comment' : document.querySelector('.form-input[id="eq_comment"]').value,
                };

                console.log('data:', formData);
                
                fetch(`/PopupeditingEquipment/equipmentEditingDynamicPost`, {
                    method: 'POST',
                    headers: {
                        // 'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        Accept: 'application/json',
                    },
                    body: new URLSearchParams(formData),
                    // body: new URLSearchParams({ u_login: data['u_login'], u_password: data['u_password']}),
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelectorAll('.form-valid-error').forEach(el => el.textContent = '');

                    if (data.success) {
                        console.log('Вы успешно отправили запрос');
                        window.popupAPI.close();

                    }

                    if (data.errors) {
                        console.log('data.errors', data.errors);
                        for (const [field, messages] of Object.entries(data.errors)) {
                            // span имеет id равный имени поля: login / password
                            const el = document.querySelector(`.form-valid-error[data-field="${field}"]`);
                            if (el) el.textContent = messages[0];
                        }
                        // alert('Вы не авторизованы. Введены неверные данные.')
                    }
                })
                .catch(() => {
                    console.log(`Ошибка отправки данных в окошке "${popupName}"`);
                });
            }   
            else if (popupName === 'document_add') {
                e.preventDefault();

                formData = {
                    'doc_sup_date' : document.querySelector('.form-input[id="doc_sup_date"]').value,
                    'doc_sup_prov_id' : parseInt(document.querySelector('.form-input[id="doc_sup_prov_id"]').value),
                    'doc_sup_name' : document.querySelector('.form-input[id="doc_sup_name"]').value,
                    'doc_sup_comment' : document.querySelector('.form-input[id="doc_sup_comment"]').value,
                };

                console.log('data:', formData);
                
                fetch(`/PopupaddDocument/documentAddDynamicPost`, {
                    method: 'POST',
                    headers: {
                        // 'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        Accept: 'application/json',
                    },
                    body: new URLSearchParams(formData),
                    // body: new URLSearchParams({ u_login: data['u_login'], u_password: data['u_password']}),
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelectorAll('.form-valid-error').forEach(el => el.textContent = '');
                    console.log('отправка данных в динамической форме')

                    if (data.success) {
                        console.log('Вы успешно отправили запрос');
                        window.popupAPI.close();

                    }

                    if (data.errors) {
                        
                        for (const [field, messages] of Object.entries(data.errors)) {
                            // span имеет id равный имени поля: login / password
                            const el = document.querySelector(`.form-valid-error[data-field="${field}"]`);
                            if (el) el.textContent = messages[0];
                        }
                        // alert('Вы не авторизованы. Введены неверные данные.')
                    }
                    console.log('data.errors', data.errors);
                })
                .catch(() => {
                    console.log(`Ошибка отправки данных в окошке "${popupName}"`);
                });
            }
            else if (popupName === 'document_edit_form') {
                e.preventDefault();

                formData = {
                    'doc_sup_date' : document.querySelector('.form-input[id="doc_sup_date"]').value,
                    'doc_sup_prov_id' : parseInt(document.querySelector('.form-input[id="doc_sup_prov_id"]').value),
                    'doc_sup_name' : document.querySelector('.form-input[id="doc_sup_name"]').value,
                    'doc_sup_comment' : document.querySelector('.form-input[id="doc_sup_comment"]').value,
                };

                console.log('data:', formData);
                
                fetch(`/PopupeditingDocument/documentEditingDynamicPost`, {
                    method: 'POST',
                    headers: {
                        // 'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        Accept: 'application/json',
                    },
                    body: new URLSearchParams(formData),
                    // body: new URLSearchParams({ u_login: data['u_login'], u_password: data['u_password']}),
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelectorAll('.form-valid-error').forEach(el => el.textContent = '');

                    if (data.success) {
                        console.log('Вы успешно отправили запрос');
                        window.popupAPI.close();

                    }

                    if (data.errors) {
                        console.log('data.errors', data.errors);
                        for (const [field, messages] of Object.entries(data.errors)) {
                            // span имеет id равный имени поля: login / password
                            const el = document.querySelector(`.form-valid-error[data-field="${field}"]`);
                            if (el) el.textContent = messages[0];
                        }
                        // alert('Вы не авторизованы. Введены неверные данные.')
                    }
                })
                .catch(() => {
                    console.log(`Ошибка отправки данных в окошке "${popupName}"`);
                });
            }
            else if (popupName === 'division_admin_add') {
                e.preventDefault();

                formData = {
                    'div_name_full' : document.querySelector('.form-input[id="div_name_full"]').value,
                    'parent_node' : parseInt(document.querySelector('.form-input[id="parent_node"]').value),
                    'div_parent_id' : parseInt(document.querySelector('.form-input[id="div_parent_id"]').value),
                    'div_name_short' : document.querySelector('.form-input[id="div_name_short"]').value,
                    'div_comment' : document.querySelector('.form-input[id="div_comment"]').value,
                };

                console.log('data:', formData);
                
                fetch(`/PopupaddDivision/divisionAddDynamicPost`, {
                    method: 'POST',
                    headers: {
                        // 'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        Accept: 'application/json',
                    },
                    body: new URLSearchParams(formData),
                    // body: new URLSearchParams({ u_login: data['u_login'], u_password: data['u_password']}),
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelectorAll('.form-valid-error').forEach(el => el.textContent = '');

                    if (data.success) {
                        console.log('Вы успешно отправили запрос');
                        window.popupAPI.close();

                    }

                    if (data.errors) {
                        console.log('data.errors', data.errors);
                        for (const [field, messages] of Object.entries(data.errors)) {
                            // span имеет id равный имени поля: login / password
                            const el = document.querySelector(`.form-valid-error[data-field="${field}"]`);
                            if (el) el.textContent = messages[0];
                        }
                        // alert('Вы не авторизованы. Введены неверные данные.')
                    }
                })
                .catch(() => {
                    console.log(`Ошибка отправки данных в окошке "${popupName}"`);
                });
            }
            else if (popupName === 'division_edit_form') {
                e.preventDefault();

                formData = {
                    'div_id' : document.querySelector('input[id="div_id"]').value,
                    'div_name_full' : document.querySelector('.form-input[id="div_name_full"]').value,
                    'parent_node' : document.querySelector('.form-input[id="parent_node"]').value,
                    'div_parent_id' : parseInt(document.querySelector('.form-input[id="div_parent_id"]').value) || "",
                    'div_name_short' : document.querySelector('.form-input[id="div_name_short"]').value,
                    'div_comment' : document.querySelector('.form-input[id="div_comment"]').value,
                };

                console.log('data:', formData);
                
                fetch(`/PopupeditingDivision/divisionEditingDynamicPost`, {
                    method: 'POST',
                    headers: {
                        // 'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        Accept: 'application/json',
                    },
                    body: new URLSearchParams(formData),
                    // body: new URLSearchParams({ u_login: data['u_login'], u_password: data['u_password']}),
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelectorAll('.form-valid-error').forEach(el => el.textContent = '');

                    if (data.success) {
                        console.log('Вы успешно отправили запрос');
                        window.popupAPI.close();

                    }

                    if (data.errors) {
                        console.log('data.errors', data.errors);
                        for (const [field, messages] of Object.entries(data.errors)) {
                            // span имеет id равный имени поля: login / password
                            const el = document.querySelector(`.form-valid-error[data-field="${field}"]`);
                            if (el) el.textContent = messages[0];
                        }
                        // alert('Вы не авторизованы. Введены неверные данные.')
                    }
                })
                .catch((err) => {
                    console.log(`Ошибка отправки данных в окошке "${popupName}", ${err}`);
                });
            }





        }

    });

}