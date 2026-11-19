// инициализация кнопок с выводом таблиц

        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.hb-dep-data-btn');
            if (!btn) return;

            const departmentName = btn.querySelector('.handbook-ddp-text')?.innerHTML;
            if (!departmentName) return;

            const departmentId = btn.dataset.id;
            if (!departmentId) return;

            const divisionType = btn.dataset.divType || 'sub'; // 'main' для отделов, 'sub' для подразделов

            // fetch(`/professions?department_id=${departmentId}&department_name=${departmentName}&division_type=${divisionType}`)
            fetch(`/professions?department_id=${departmentId}&department_name=${departmentName}&division_type=${divisionType}`)
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

                getClientInfoNow(clientId, clientName, "UserTable");
                // getActiveMiniIcons()
            }, 100);
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

                console.log('newdepartmentId, newdepartmentName, newdivisionType', newdepartmentId, newdepartmentName, newdivisionType);
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

                getClientInfoNow(clientId, clientName, "userTable")
            }, 80);
        }
        


        //функция для динамич. окна информации нижнее панели

        function getClientInfoNow(clientId, clientName) {
            fetch(`/clientInfo?client_id=${clientId}`)
            .then(response => response.text())
            .then(html => {
                // вывод заголовка т.е. название отдела
                document.querySelector('.handbook-body-right-nd-header-text').innerHTML = clientName;
                // вывод таблицы
                document.querySelector('.handbook-body-right-section-note-panel-content').innerHTML = html;

                if (document.querySelector('.table-r-div-name') !== null){
                    document.querySelector('.table-r-div-name').addEventListener('click', function(e) {
                        // getDivClients(e, departmentName = "", departmentId = "", divisionType = "", requestType = "divTab")
                        departmentName = document.querySelector('.table-r-div-name').innerHTML;
                        myElement = getElementByText(departmentName);
                        departmentId = myElement.closest('.hb-dep-data-btn').dataset.id;
                        departmentType = myElement.closest('.hb-dep-data-btn').dataset.divType;
                        //console.log(departmentName, departmentId, departmentType)
                        
                        getDivClients(e, departmentName, departmentId, departmentType, requestType = "divTab")
                        
                    })
                }

                // console.log(`/clientInfo?client_id=${clientId}`)
            })
            .catch(error => {
                console.error('Ошибка вывода данных:', error);
            });
        }

        function getElementByText(text) {
            const xpath = `//node()[normalize-space(text())='${text.trim()}']`;
            return document.evaluate(xpath, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
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

            // const clientInfoTimer = setTimeout(getClientInfoNow(clientId, clientName), 280);
           
            const clientId = btn.querySelector('.client-name-row').dataset.id;
            if (!clientId) return;

            const clientName = btn.querySelector('.client-name-row').innerHTML;
            if (!clientName) return;

            getClientInfoNow(clientId, clientName);
            
        });