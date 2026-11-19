let documentId = parseInt(document.querySelector('.client-name-row').dataset.id);
let activeRowId = null;
// вывод таблиц техники по определенному отделу

document.addEventListener('click', function(e) {
    // инициализация кнопок отделов в панели подразделений для вывода таблиц
    const btn = e.target.closest('.hb-dep-data-btn');
    if (!btn) return;

    const departmentName = btn.querySelector('.handbook-ddp-text')?.innerHTML;
    if (!departmentName) return;

    const departmentId = btn.dataset.id;
    if (!departmentId) return;

    const divisionType = btn.dataset.divType || 'sub'; // 'main' для отделов, 'sub' для подразделов

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

function DocumentInfo(doc_sup_id , doc_sup_name) {
    fetch(`/DocumentInfo?doc_sup_id=${doc_sup_id }`)
    .then(response => response.text())
    .then(html => {
        // вывод заголовка т.е. название отдела
        document.querySelector('.handbook-body-right-nd-header-text').innerHTML = doc_sup_name;
        // вывод таблицы
        document.querySelector('.handbook-body-right-section-note-panel-content').innerHTML = html;

        console.log(`/clientInfo?client_id=${doc_sup_id }`)
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
    
    const doc_sup_id  = btn.querySelector('.client-name-row').dataset.id;
    if (!doc_sup_id ) return;

    const doc_sup_name = btn.querySelector('.client-name-row').innerHTML;
    if (!doc_sup_name) return;

    documentId = parseInt(doc_sup_id);
    activeRowId = documentId;

    window.popupAPI?.enable_btns();

    DocumentInfo(doc_sup_id , doc_sup_name);
    window.refreshKeyboardNavigation();
});