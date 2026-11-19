<script>
    function getPopupWindow(popupName) {
    console.log('вывожу окно');
    if (popupName === 'import_1c') {
        console.log('вывожу окно ', popupName);

        
        fetch(`{{ route('getPopup1Сimport') }}`)
            .then(res => res.text())
            .then(html => {
                document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
                document.querySelector('.fl-popup-w-h-title-text').innerHTML = 'Импорт 1С'
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
        fetch(`{{ route('getPopupLogin') }}`)
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
        fetch(`{{ route('getPopupaddEquipment') }}`)
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
        fetch(`{{ route('getPopupActionEquipment') }}`)
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
        fetch(`{{ route('getPopupparametersEquipment') }}`)
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
        fetch(`{{ route('getPopupaddAdmin') }}`)
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
    else if (popupName === 'document_editing') { 
        fetch(`{{ route('getPopupaddAdmin') }}`)
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
</script>