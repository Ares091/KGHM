//для вывода окна с добавлением пользователя
// инициализация кнопок подразделений с выводом таблицы пользователей
currentDepartmentId = 4198;
currentdivisionType = 'main';

document.addEventListener('click', function(e) {
    const btn = e.target.closest('.hb-dep-data-btn');
    if (!btn) return;

    const departmentName = btn.querySelector('.handbook-ddp-text')?.innerHTML;
    if (!departmentName) return;

    const departmentId = btn.dataset.id;
    if (!departmentId) return;
    currentDepartmentId = parseInt(departmentId);

    const divisionType = btn.dataset.divType || 'sub'; // 'main' для отделов, 'sub' для подразделов
    currentdivisionType = divisionType;

    fetch(`/professions?department_id=${departmentId}&department_name=${departmentName}&division_type=${divisionType}`)
        .then(response => {
            if (!response.ok) {
                window.popupAPI.open();
                if (response.status === 401) {
                    throw new Error('Unauthorized');
                }
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            // вывод заголовка т.е. название отдела
            document.querySelector('.handbook-body-right-mdps-header-text').innerHTML = departmentName;
            // вывод таблицы
            document.querySelector('.handbook-body-right-main-data-panel-t-content').innerHTML = html;
        })
        .catch(error => {
            console.error('Ошибка вывода данных:', error);
        });

    setTimeout(() => {
        let clientId = document.querySelector('.client-name-row').dataset.id;
        let clientName = document.querySelector('.client-name-row').innerHTML;

        getClientInfoNow(clientId, clientName)
        getActiveMiniIcons();

        if (window.location.href !== 'http://handbook/') {
            
            changeClient1cStatus(clientId);
        }
    }, 80);
});


function getDivClients(e, departmentName = null, departmentId = null, departmentType = null, requestType = "divTab"){
    let newdepartmentName = null;
    let newdepartmentId = null;
    let newdivisionType = null;
    
    if (requestType === "divTab"){
        // const btn = e.target.closest('.hb-dep-data-btn');
        // if (!btn) return;

        newdepartmentName = departmentName ?? e.target.closest('.hb-dep-data-btn').querySelector('.handbook-ddp-text')?.innerHTML;
        if (!departmentName) return;

        newdepartmentId = departmentId ?? e.target.closest('.hb-dep-data-btn').dataset.id;
        if (!departmentId) return;

        newdivisionType = departmentType ?? e.target.closest('.hb-dep-data-btn').dataset.divType; // 'main' для отделов, 'sub' для подразделов

        // console.log('newdepartmentId, newdepartmentName, newdivisionType', newdepartmentId, newdepartmentName, newdivisionType);
    }
    else {
        if (departmentName === "" || departmentId === "") return;
    }
    
    fetch(`/professions?department_id=${newdepartmentId}&department_name=${newdepartmentName}&division_type=${newdivisionType}`)
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

    setTimeout(() => {
        let clientId = document.querySelector('.client-name-row').dataset.id;
        let clientName = document.querySelector('.client-name-row').innerHTML;

        getClientInfoNow(clientId, clientName);
        if (window.location.href !== 'http://handbook/') {
            changeClient1cStatus(clientId);
        }
    }, 80);
}

// function getDivClients(e, departmentName = "", departmentId = "", requestType = "divTab"){
    
//     if (requestType === "divTab"){
//         const btn = e.target.closest('.hb-dep-data-btn');
//         if (!btn) return;

//         const departmentName = btn.querySelector('.handbook-ddp-text')?.innerHTML;
//         if (!departmentName) return;

//         const departmentId = btn.dataset.id;
//         if (!departmentId) return;

//         const divisionType = btn.dataset.divType ?? 'sub'; // 'main' для отделов, 'sub' для подразделов

//     }
//     else {
//         if (departmentName === "" || departmentId === "") return;
//     }
    
//     fetch(`/professions?department_id=${departmentId}&department_name=${departmentName}&division_type=${divisionType}&table_type=AdminTable`)
//         .then(response => response.text())
//         .then(html => {
//             // вывод заголовка т.е. название отдела
//             document.querySelector('.handbook-body-right-mdps-header-text').innerHTML = departmentName;
//             // вывод таблицы
//             document.querySelector('.handbook-body-right-main-data-panel-t-content').innerHTML = html;
//         })
//         .catch(error => {
//             console.error('Ошибка вывода данных:', error);
//         });

//     setTimeout(() => {
//         let clientId = document.querySelector('.client-name-row').dataset.id;
//         let clientName = document.querySelector('.client-name-row').innerHTML;

//         getClientInfoNow(clientId, clientName)
//         changeClient1cStatus(clientId) 
//     }, 80);
// }