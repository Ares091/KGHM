// ============================================
// 1. ПОИСК СОТРУДНИКОВ С АВТОЗАПОЛНЕНИЕМ
// ============================================

searchMode = false;

(function() {
    let searchTimeout = null;
    const searchInput = document.querySelector('.search-input-2');
    const tableContainer = document.querySelector('.handbook-body-right-main-data-panel-t-content');
    const headerTitle = document.querySelector('.handbook-body-right-mdps-header-text');
    let currentDepartmentId = null;

    if (!searchInput || !tableContainer) return;

    // Функция выполнения поиска
    function performSearch(query, divisionId) {
        const url = new URL('/search', window.location.origin);
        url.searchParams.append('query', query || '');
        
        if (divisionId) {
            url.searchParams.append('division_id', divisionId);
        }
        if (searchInput.value.length > 0){
            url.searchParams.append('search_mode', true);
        }
        else{
            url.searchParams.append('search_mode', false);
        }

        // searchMode = query;
        
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
                } else if (divisionId) {
                    // headerTitle.textContent = `Фильтр по отделу (${data.count})`;
                } else {
                    headerTitle.textContent = 'Все сотрудники';
                }
                console.log('Поисковик: элементы найдены');

                // Обновляем информационную панель
                updateNotePanelDefault();
                getActiveMiniIcons()
            }
        })
        .catch(error => {
            console.error('Ошибка поиска:', error);
            tableContainer.innerHTML = '<tr><td colspan="6" style="text-align:center;padding:20px;color:red;">Ошибка при выполнении поиска</td></tr>';
        });
    }

    // Обработка ввода с задержкой
    searchInput.addEventListener('input', function(e) {
        searchMode = true;
        clearTimeout(searchTimeout);
        if (window.popupAPI.config.openPopupBtnsIsActive){
            window.popupAPI.disable_btns();
        }
        const query = this.value.trim();

        // Не ищем если меньше 2 символов (кроме случая когда есть фильтр по отделу)
        if (query.length < 2 && !currentDepartmentId) {
            // Если запрос пустой - загружаем всех
            if (query.length === 0) {
                searchTimeout = setTimeout(() => performSearch('', null), 200);
                searchMode = false;
            }
            return;
        }
        
        if (query.length > 2) {
            searchTimeout = setTimeout(() => performSearch(query, currentDepartmentId), 300);
        }
    });

    // Обработка нажатия Enter
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(searchTimeout);
            performSearch(this.value.trim(), currentDepartmentId);
        }
    });

    // Функция для обновления фильтра по отделу (вызывается при клике на папку)
    window.setDepartmentFilter = function(departmentId) {
        currentDepartmentId = departmentId;
        const query = searchInput.value.trim();
        
        // Если есть запрос - ищем с учетом отдела
        if (query.length >= 2) {
            performSearch(query, departmentId);
        } else {
            // Иначе показываем сотрудников отдела
            performSearch('', departmentId);
        }
    };

    // Обновление информационной панели по умолчанию
    window.updateNotePanelDefault = function() {
        // Можно оставить как есть или сбросить на дефолтные значения
        const notePanel = document.querySelector('.handbook-body-right-section-note-panel-public-content table tbody');
        if (notePanel) {
            // Сброс на дефолтные данные или оставляем как есть
        }

        setTimeout(() => {
            let clientId = document.querySelector('.client-name-row')?.dataset.id;
            let clientName = document.querySelector('.client-name-row')?.innerHTML;

            getClientInfoNow(clientId, clientName)
        }, 80);
    };

    // ============================================
    // 2. ОБРАБОТКА КЛИКОВ ПО ПАПКАМ (ДОПОЛНЕНИЕ)
    // ============================================
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.hb-dep-data-btn');
        if (!btn) return;

        const departmentName = btn.querySelector('.handbook-ddp-text')?.innerHTML;
        if (!departmentName) return;

        const departmentId = btn.dataset.id;
        if (!departmentId) return;

        const divisionType = btn.dataset.divType || 'sub';


        searchInput.value = '';

        // Устанавливаем фильтр по отделу
        // window.setDepartmentFilter(departmentId);

        // Меняем заголовок
        const headerTitle = document.querySelector('.handbook-body-right-mdps-header-text');
        if (headerTitle) {
            headerTitle.textContent = departmentName;
        }

        // Обновляем информационную панель
        // const noteHeader = document.querySelector('.handbook-body-right-nd-header-text');
        // if (noteHeader) {
        //     noteHeader.textContent = departmentName + ' > Выберите сотрудника';
        // }
    });

    console.log('✅ Поисковик инициализирован');
})();