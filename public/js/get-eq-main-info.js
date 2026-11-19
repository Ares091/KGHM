// вывод таблиц техники по определенному отделу
currentDepartmentId = 4104;
currentdivisionType = 'main';
// activeRowId = '4185';
activeRowId = null;
getEqStatus();

document.addEventListener('click', function(e) {
    // инициализация кнопок отделов в панели подразделений для вывода таблиц
    const btn = e.target.closest('.hb-dep-data-btn');
    if (!btn) return;

    const departmentName = btn.querySelector('.handbook-ddp-text')?.innerHTML;
    if (!departmentName) return;

    const departmentId = btn.dataset.id;
    if (!departmentId) return;
    currentDepartmentId = parseInt(departmentId);


    const divisionType = btn.dataset.divType || 'sub'; // 'main' для отделов, 'sub' для подразделов
    currentdivisionType = divisionType;

    fetch(`/EquipmentsTableInfo?department_id=${departmentId}&department_name=${departmentName}&division_type=${divisionType}`)
        .then(response => response.text())
        .then(html => {
            // вывод заголовка т.е. название отдела
            document.querySelector('.handbook-body-right-mdps-header-text').innerHTML = departmentName;
            // вывод таблицы
            document.querySelector('.handbook-body-right-main-data-panel-t-content').innerHTML = html;
        })
        .catch(error => {
            console.error('Ошибка вывода данных:', error);
        });

    // setTimeout(() => {
    //     let clientId = document.querySelector('.client-name-row').dataset.id;
    //     let clientName = document.querySelector('.client-name-row').innerHTML;

    //     EquipmentInfo(eq_id, clientName)
    // }, 80);
});


//функция для динамич. окна информации нижнее панели

function EquipmentInfo(eqId, eqName) {
    fetch(`/EquipmentInfo?eq_id=${eqId}`)
    .then(response => response.text())
    .then(html => {
        // вывод заголовка т.е. название отдела
        document.querySelector('.handbook-body-right-nd-header-text').innerHTML = eqName;
        // вывод таблицы
        document.querySelector('.handbook-body-right-section-note-panel-content').innerHTML = html;

        console.log(`/clientInfo?client_id=${eqId}`)
    })
    .catch(error => {
        console.error('Ошибка вывода данных:', error);
    });
}

//динамическое окно информации нижнее панели
document.addEventListener('click', function(e) {
    // const btn = e.target.closest('.table-row') || e.target.closest('.hb-dep-data-btn');
    const btn = e.target.closest('.table-row');
    if (!btn) return;

    // if (btn.classList.contains('hb-dep-data-btn')){
    //     clientId = document.querySelector('.client-name-row').dataset.id;
    //     clientName = document.querySelector('.client-name-row').innerHTML;
    // }
    // else {
    //     clientId = btn.querySelector('.client-name-row').dataset.id;
    //     if (!clientId) return;
    //     clientName = btn.querySelector('.client-name-row').innerHTML;
    //     if (!clientName) return;
    // }

    // const clientInfoTimer = setTimeout(EquipmentInfo(clientId, clientName), 280);
    
    const eqId = btn.querySelector('.client-name-row').dataset.id;
    if (!eqId) return;

    const eqName = btn.querySelector('.client-name-row').innerHTML;
    if (!eqName) return;

    activeRowId = eqId;

    window.popupAPI?.enable_btns();


    if (btn.querySelector('.fs-t-eq-journal-row')){
        searchInput = document.querySelector('.search-input-2');
        searchInput.value = btn.querySelector('.fs-t-eq-journal-client').innerHTML;
        window.searchEquipment(searchInput.value.trim(), currentDepartmentId);
    } else {
        EquipmentInfo(eqId, eqName);
    }

    if (!e.target.closest('.form-table-row')){
        getEqStatus();
    }
    window.refreshKeyboardNavigation();
    
});

function disableEqStatuses() {
    document.querySelector('.nb-list-btn[data-list-name="give"]').classList.add('nb-lb-disabled');
    document.querySelector('.nb-list-btn[data-list-name="pass_off"]').classList.add('nb-lb-disabled');
    document.querySelector('.nb-list-btn[data-list-name="rewrite"]').classList.add('nb-lb-disabled');
    document.querySelector('.nb-list-btn[data-list-name="write_off"]').classList.add('nb-lb-disabled');
}


function getEqStatus() {
    if (window.location.href === 'http://handbook/equipmentPage') {
        if (activeRowId !== null) {
            activeRow = document.querySelector(`.table-row[data-id="${activeRowId}"]`)
            document.querySelectorAll('.nb-list-btn').forEach(nbListBtn => {
                nbListBtn.classList.remove('nb-lb-disabled');
            });
            //:not(.form-table-row)
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
            disableEqStatuses();
        }
        
    }
}

// document.querySelector('click', function(e) {
//     console.log('disableEqStatuses', e.target.closest(`.table-row[data-id="${activeRowId}"]`));
//     if (e.target.closest(`.table-row[data-id="${activeRowId}"]`) === null) {
        
//         disableEqStatuses();
//     }
    
// })

