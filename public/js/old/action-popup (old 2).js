currentActionName = null;
formTableRows = null;

function getEqActionSettings(actionName){
    currentActionName = actionName;
    activeElem = document.querySelector('.handbook-ddp-br-active');
    let formSearchimeout = null;

    if (activeElem.classList.contains('table-row')){
        getElemId = parseInt(activeElem.dataset.id);
    } 
    else {
        activeElem = document.querySelector('.table-row');
        getElemId = parseInt(activeElem.dataset.id);
    }

    getElemName = activeElem.querySelector('.client-name-row').innerHTML.trim();
    getElemStatus = activeElem.querySelector('.fs-table-row').innerHTML.trim();
    getClientName = document.querySelector('.table-n-t-r-info[data-client-id]').innerHTML.trim();
    getClientId = document.querySelector('.table-n-t-r-info[data-client-id]').dataset.clientId;
    getClientDivName = document.querySelector('.table-n-t-r-info[data-div-id]').innerHTML.trim();
    getClientDivId = document.querySelector('.table-n-t-r-info[data-div-id]').dataset.divId
        
    console.log("Действие с элементом", getElemId, getElemStatus);

    document.querySelector('.form-input[id="eq_name"]').value = getElemName;
    document.querySelector('.form-input[id="eq_id"]').value = getElemId;
    document.querySelector('.form-input[id="eq_status_name"]').value = getElemStatus;
    document.querySelector('.form-input[id="eq_status_name"]').innerHTML = getElemStatus;
    document.querySelector('.form-input[id="eq_cli_name"]').value = getClientName;
    document.querySelector('.form-input[id="eq_client_id"]').value = getClientId;
    document.querySelector('.form-input[id="eq_div_name"]').value = getClientDivName;
    document.querySelector('.form-input[id="eq_div_id"]').value = getClientDivId;

    addActonEvListeners(actionName);

    formSearchInput = null;

    if (actionName === "give" || actionName === "rewrite") {
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

            // formSearchimeout = setTimeout(() => {
            //         formTableRows = document.querySelectorAll('.form-table-div-row');
            //         addActonEvListeners(actionName);
            // }, 200);
            
        });
    }
    
}

function addActonEvListeners(actionName){
    formTableRows = document.querySelectorAll('.form-table-div-row');
    formTableRows.forEach(formTableDRow => {
        formTableDRow.addEventListener('click', () => {
            console.log('formTableDRow');
            clientId =  formTableDRow.querySelector('.client-name-row').dataset.id;
            clientName = formTableDRow.querySelector('.client-name-row').innerHTML;
            clientDivisionId = formTableDRow.querySelector('.client-div-row').dataset.divId;
            clientDivisionName = formTableDRow.querySelector('.client-div-row').innerHTML;

            document.querySelector('.form-input[id="eq_client_id"]').value = clientId;
            document.querySelector('.form-input[id="eq_cli_name"]').value = clientName;
            document.querySelector('.form-input[id="eq_div_name"]').value = clientDivisionName;
            document.querySelector('.form-input[id="eq_div_id"]').value = clientDivisionId;


            data = {
                'action_name': actionName,
                'client_id' : parseInt(clientId),
                'client_name' : clientName,
                'client_div_id' : parseInt(clientDivisionId),
                'client_div_name' : clientDivisionName,
                'eq_id': parseInt(getElemId),
                'eq_name': getElemName,
                'eq_status_name' : getElemStatus,
                'eq_date' : document.querySelector('.form-input[id="eq_date"]').value,
                'eq_comment' : document.querySelector('.form-input[id="eq_comm"]').value ?? null,
            };

            console.log('Action data', data);
            applyNewActionSettings(data);
        });
    });
}



function performItemFormSearch(query, searchItemType) {
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



function applyNewActionSettings(data){
    document.querySelectorAll('.popup-form-btn').forEach(popupFormBtn => {
        popupFormBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (popupFormBtn.classList.contains('pfb-cancel')){
                window.popupAPI.close();
            }
            else {
                fetch('/newEquipmentActionStatus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Обновляем таблицу
                        // e.target.closest('.table-row').remove();
                        console.log('Статус успешно обновлен');
                        window.popupAPI.close();
                    }
                })
                .catch(error => {
                    console.error('Ошибка поиска:', error);
                });
            }
        });
    });
}
