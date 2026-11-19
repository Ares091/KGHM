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
        fetch(`/PopupActionEquipment`)
        .then(res => res.text())
        .then(html => {
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Переписать технику на др. сотрудника";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
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
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Добавить ";
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
            document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Добавить ";
            document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
            console.log(`окно ${popupName} выведено успешно`);
            
        })
        .catch(() => {
            console.log(`Ошибка загрузки ${popupName} окошка`);
        });
    } 
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
    });
});




// document.querySelectorAll('.fs-popup-window-btn').addEventListener('click', (e) => {
//     popupbtn = e.target.closest('.fs-popup-window-btn');

//     getPopupWindow(popupbtn.dataset.popupType);
// });