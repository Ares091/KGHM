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
    else if (popupName === 'admin_edit_form') { 
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
    else if (popupName === 'equipment_edit_form') { 
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
        fetchPopupFormActions(popupbtn.dataset.popupType);
    });
});




// document.querySelectorAll('.fs-popup-window-btn').addEventListener('click', (e) => {
//     popupbtn = e.target.closest('.fs-popup-window-btn');

//     getPopupWindow(popupbtn.dataset.popupType);
// });


function fetchPopupFormActions(popupName) {
    document.querySelector('.apply-form-btn')?.addEventListener('click', (e) => {

        if (popupName === 'autorization') {
            e.preventDefault();

            data = {
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
                body: new URLSearchParams({ u_login: data['u_login'], u_password: data['u_password']}),
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
        else if (popupName === 'equipment_add') {
            e.preventDefault();

            data = {
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
            
            fetch(`/PopupaddEquipment/equipmentAddDynamicPost`, {
                method: 'POST',
                headers: {
                    // 'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    Accept: 'application/json',
                },
                body: JSON.stringify(data),
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






    });
    
}