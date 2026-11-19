<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="../css/flexstyles.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/darkTheme.css">
    <title>Spravochnik 2.0 </title>
</head>
<body>
    <div class="handbook-main block fl-align">
        <div class="handbook-inner fl-align">
            <div class="handbook-inner-items block fl-align fl-col">
                <div class="handbook-top-header-section block fl-align">
                    <!-- header -->
                    <div class="handbook-header-section block fl-align">
                        <div class="handbook-header-section-inner fl-sp-btw">
                            <div class="handbook-header-section-left-bar fl-row">

                                <div class="nav-btn handbook-header-nav-btn-block fl-align" data-popup-type="my_data">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/pass2.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-hvb-text">Мои данные</p>
                                    </div>
                                </div> 

                                <div class="nav-btn handbook-header-nav-btn-block fl-align" data-popup-type="support">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/user.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-hvb-text">Тех. поддержка</p>
                                    </div>
                                </div> 

                                <div class="nav-btn handbook-header-nav-btn-block fl-align" data-popup-type="interface">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/dashboard-interface.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-hvb-text">Интерфейс</p>
                                    </div>
                                </div> 

                                <div class="songs-block-search-bar-container fl-row">
                                    <div class="search-box-bar search-box-bar-styles  fl-row fl-sp-btw">
                                        <div class="search-icon-container">
                                            <img src="../sources/media/icons/search.svg" alt="" class="search-icon">
                                        </div>
                                        <input type="text" class="search-input search-input-2 input search-input-width-standart" placeholder="Поиск">
                                    </div>
                                    {{-- <div class="search-box-btn-block handbook-header-nav-btn-block fl-align">
                                        <p class="search-btn nav-btn-text handbook-hvb-text">Найти</p>
                                    </div> --}}
                                </div>


                                {{-- <div class="nav-btn handbook-header-nav-btn-block fl-align">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/settings.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-hvb-text">Общие Настройки</p>
                                    </div>
                                </div>  --}}

                                
                                

                            </div>

                            <div class="handbook-header-section-right-bar fl-row">

                                <div class="fs-popup-window-btn nav-btn handbook-header-nav-btn-block-2 hhnb-user-btn fl-align" data-popup-type="autorization">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/pass2.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-hnbb-text">Войти Руководству</p>
                                    </div>
                                </div> 

                            </div>
                        </div>
                    </div>
                </div>
                <div class="handbook-bottom-body-section block fl-row fl-align fl-stretch">
                    <div class="handbook-body-left-department-panel-section fl-al-start">
                        <div class="handbook-body-left-department-panel-section-inner block fl-align fl-col">
                            <div class="handbook-body-left-section-ui-settings-block fl-row">
                                
                                <div class="nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/reload.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                </div> 

                                <div class="nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/cells.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                </div> 

                                <div class="nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/multiple.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                </div> 

                               

                            </div>

                            <div class="handbook-body-left-department-panel-block block">
                                
                                <div class="handbook-body-left-department-panel-section-inner fl-align fl-col">
                                    <div class="handbook-body-left-department-panel fl-col">
                                        {{-- 1 уровень --}} 
                                        {{-- сюда вставляем первый уровень корневого отдела --}} 
                                                 {{-- resources/views/handbook/index.blade.php --}}

                                        @foreach($CompanyDivisions as $CompanyDivision)
                                            @include('components.handbook.department_root', ['CompanyDivision' => $CompanyDivision])
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- группа таблицы пользователя и нижней панели о пользователе --}}
                    <div class="handbook-body-right-main-data-and-note-panel fl-col fl-sp-btw">
                        
                        {{-- таблица пользователей --}}
                        <div class="handbook-body-right-main-data-panel-section fl-align fl-col fl-start">
                            <div class="handbook-body-right-main-data-panel-section-header block fl-align fl-start">
                                <div class="handbook-body-right-mdps-header-text-block">
                                    <p class="handbook-body-right-mdps-header-text">Бухгалтерия</p>
                                </div>
                            </div>

                            <div class="handbook-body-right-main-data-panel-section-inner fl-align fl-col">
                                <div class="handbook-body-right-main-data-panel-block block fl-align">
                                    
                                    <div class="handbook-body-right-main-data-panel-table-container block fl-align">
                                        <div class="handbook-body-right-main-data-panel-t-content example-subsub-block-content block-content">

                                            @include('components/data_panel/data_table' , ['clients' => $clients])
                                            
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>


                        {{-- информационная панель о пользователе --}}
                        <div class="handbook-body-right-section-note-data-block block">
                            <div class="handbook-body-right-main-data-panel-section-header block fl-align fl-start">
                                <div class="handbook-body-right-mdps-header-text-block">
                                    <p class="handbook-body-right-nd-header-text">Бухгалтерия > Букреева Светлана Валерьевна</p>
                                </div>
                            </div>
                            <div class="handbook-body-right-section-note-data-block-inner fl-align fl-col">
                                <div class="handbook-body-right-section-note-panel-block block fl-align">
                                    <div class="handbook-body-right-section-note-panel-content block-content fl-sp-btw fl-al-start">
                                        <div class="handbook-body-right-section-note-panel-public-content">
                                            <table class="table block fs-table-style-3">
                                               
                                                <tbody>

                                                    <tr>
                                                        <th class="fs-table-row" scope="row">Имя</th>
                                                        <td class="fs-table-row" scope="row">Букреева Светлана Валерьевна</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fs-table-row" scope="row">Должность</th>
                                                        <td class="fs-table-row" scope="row">Заместитель главного бухгалтера по реализации</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fs-table-row" scope="row">Отдел</th>
                                                        <td class="fs-table-row" scope="row">Бухгалтерия</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fs-table-row" scope="row">Тел. Город</th>
                                                        <td class="fs-table-row" scope="row">46-55-05</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fs-table-row" scope="row">Тел. Внутренний</th>
                                                        <td class="fs-table-row" scope="row">2273</td>
                                                    </tr>
                                                     <tr>
                                                        <th class="fs-table-row" scope="row">Тел. Мобильный</th>
                                                        <td class="fs-table-row" scope="row"></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fs-table-row" scope="row">Эл. почта</th>
                                                        <td class="fs-table-row" scope="row">bukreeva.s@mail.ru</td>
                                                    </tr>
                                                    
                                                </tbody>
                                                <!-- <tfoot>
                                                    <tr>
                                                        <th class="fs-table-row table-bottom-left-corner" scope="row" colspan="3">Итого классов</th>
                                                        <th class="fs-table-row table-bottom-right-corner">20</td>
                                                    </tr>
                                                </tfoot> -->
                                            </table>
                                        </div>
                                        <div class="handbook-body-right-section-note-panel-private-content">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    
                </div>
            </div>
        </div>
    </div>




    

    {{-- ВСПЛЫВАЮЩЕЕ ОКНО --}}
    <div class="fl-popup-window fl-popup-w-closed block fl-align" data-opened="false">
        <div class="fl-popup-window-inner block-inner fl-align">

            <div class="fl-popup-window-block block-border-2 block-shadow-2 fl-align fl-col">
                <div class="fl-popup-window-header-block block fl-sp-btw">

                    {{-- ЗАГОЛОВОК --}}
                    <div class="fl-popup-w-h-title-block">
                        <div class="fl-popup-w-h-title-text">Регистрация</div>
                    </div>

                    {{-- кнопки действия для мобилки --}}
                    <div class="fl-pwb-nav-buttons-block fl-pwb-n-b-block-closed fl-pwb-nbb-top fl-align fl-end">
                        <button class="fl-pwb-nav-button-tab button fl-pwb-nbt-submit fl-pwb-nbt-submit-style-1 fl-align">
                            <p class="fl-pwb-nav-button-text">Подтвердить</p>
                        </button>
                        <button class="fl-pwb-nav-button-tab button fl-pwb-nbt-close fl-pwb-nbt-close-style-1 fl-align">
                            <p class="fl-pwb-nav-button-text">Закрыть</p>
                        </button>
                    </div>
                </div>
                
                    {{-- контейнер  куда записываются данные--}}
                <div class="fl-popup-window-block-inner fl-col">
                    {{-- содержимое контейнерс сюда записываем данные --}}

                    @include('components.popup.popup_register')

                    

                </div>

               

                <!-- <div class="fl-pwb-nav-buttons-block fl-pwb-nbb-bottom block fl-align">
                    <div class="fl-pwb-nbb-bottom-inner fl-sp-btw">
                        <button class="fl-pwb-nbb-bottom-button fl-pwb-nav-button-tab fl-pwb-nbt-submit form-btn btn-m-b button block header-btn button-st-3">Подтвердить</button>
                        <button class="fl-pwb-nbb-bottom-button fl-pwb-nav-button-tab fl-pwb-nbt-close form-btn btn-m-b button block header-btn button-st-2">Закрыть</button>
                    </div>
                </div> -->
            </div>

        </div>
    </div>

    {{-- Всплывающее окно --}}



    <script src="../js/flexsyles-anim.js"></script>

    <script>
        const dropdownListBtnsContainer = document.querySelectorAll('.hb-ddp-group-with-subs');
        //const dropdownListBtns = document.querySelectorAll('.hb-ddp-with-subs');

        dropdownListBtnsContainer.forEach(dropdownListBtnsContainerItems => {

            dropdownListBtnsContainerItems.addEventListener('click', (e) => {
                dropdownListBtn = dropdownListBtnsContainerItems.querySelector('.hb-ddp-with-subs');
                dropdownSubList = dropdownListBtnsContainerItems.querySelector('.handbook-ddp-b-sub-rows-group');
                dropdownSubSubListContainer = dropdownListBtnsContainerItems.querySelector('.hb-ddp-group-with-sub-subs');;
                // console.log(e.target);
                // console.log(e.target.closest('.handbook-ddp-text') === null);
                
                if (dropdownSubList.classList.contains('handbook-ddp-sub-rows-closed') ){
                    dropdownSubList.classList.remove('handbook-ddp-sub-rows-closed')
                }
                else if (e.target.closest('.handbook-ddp-b-sub-rows-group') === null && e.target.closest('.handbook-ddp-b-sub-row') === null && e.target.closest('.handbook-department-data-panel-text-block') === null && e.target.closest('.handbook-ddp-sub-text') === null) {
                    console.log("Закрываю панель");
                    dropdownSubList.classList.add('handbook-ddp-sub-rows-closed');
                } 
                else if (e.target.closest('.hb-ddp-group-with-sub-subs') ){
                    console.log("Пепе щнейне");
                    dropdownSubSubList = dropdownSubList.querySelector('.handbook-ddp-b-subs-sub-rows-group');
                    
                    if (dropdownSubSubList.classList.contains('handbook-ddp-sub-rows-closed') ){
                        dropdownSubSubList.classList.remove('handbook-ddp-sub-rows-closed')
                    }
                    else {
                        dropdownSubSubList.classList.add('handbook-ddp-sub-rows-closed');
                    }
                }
                else {
                    e.target.addEventListener('dblclick', (e) => {
                        dropdownSubList.classList.remove('handbook-ddp-sub-rows-closed');
                    });
                }
            });
        });
    </script>

    <script>

        // инициализация кнопок с выводом таблиц

        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.hb-dep-data-btn');
            if (!btn) return;

            const departmentName = btn.querySelector('.handbook-ddp-text')?.innerHTML;
            if (!departmentName) return;

            const departmentId = btn.dataset.id;
            if (!departmentId) return;

            const divisionType = btn.dataset.divType || 'sub'; // 'main' для отделов, 'sub' для подразделов

            fetch(`/professions?department_id=${departmentId}&department_name=${departmentName}&division_type=${divisionType}`)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('.handbook-body-right-main-data-panel-t-content').innerHTML = html;
                    document.querySelector('.handbook-body-right-mdps-header-text').innerHTML = departmentName;
                })
                .catch(error => {
                    console.error('Ошибка вывода данных:', error);
                });
        });
        
     


        //динамическое окно информации нижнее панели
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.table-row');
            if (!btn) return;

            const clientId = btn.querySelector('.client-name-row').dataset.id;
            if (!clientId) return;

            const clientName = btn.querySelector('.client-name-row').innerHTML;
            if (!clientName) return;


            fetch(`/clientInfo?client_id=${clientId}`)
                .then(response => response.text())
                .then(html => {
                    // вывод заголовка т.е. название отдела
                    document.querySelector('.handbook-body-right-nd-header-text').innerHTML = clientName;
                    // вывод таблицы
                    document.querySelector('.handbook-body-right-section-note-panel-content').innerHTML = html;
                })
                .catch(error => {
                    console.error('Ошибка вывода данных:', error);
                });
        });
 
    

</script>






{{-- скрипт поиска --}}

<script>
    // ============================================
    // 1. ПОИСК СОТРУДНИКОВ С АВТОЗАПОЛНЕНИЕМ
    // ============================================
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

                    // Обновляем информационную панель
                    updateNotePanelDefault();
                }
            })
            .catch(error => {
                console.error('Ошибка поиска:', error);
                tableContainer.innerHTML = '<tr><td colspan="6" style="text-align:center;padding:20px;color:red;">Ошибка при выполнении поиска</td></tr>';
            });
        }

        // Обработка ввода с задержкой
        searchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            const query = this.value.trim();
            
            // Не ищем если меньше 2 символов (кроме случая когда есть фильтр по отделу)
            if (query.length < 2 && !currentDepartmentId) {
                // Если запрос пустой - загружаем всех
                if (query.length === 0) {
                    searchTimeout = setTimeout(() => performSearch('', null), 200);
                }
                return;
            }
            
            searchTimeout = setTimeout(() => performSearch(query, currentDepartmentId), 300);
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




            // Устанавливаем фильтр по отделу
            window.setDepartmentFilter(departmentId);

            // Меняем заголовок
            const headerTitle = document.querySelector('.handbook-body-right-mdps-header-text');
            if (headerTitle) {
                headerTitle.textContent = departmentName;
            }

            // Обновляем информационную панель
            const noteHeader = document.querySelector('.handbook-body-right-nd-header-text');
            if (noteHeader) {
                noteHeader.textContent = departmentName + ' > Выберите сотрудника';
            }
        });

        // // ============================================
        // // 3. КЛИК ПО СТРОКЕ ТАБЛИЦЫ ДЛЯ ПРОСМОТРА ДАННЫХ
        // // ============================================
        // document.addEventListener('click', function(e) {
        //     const row = e.target.closest('tbody tr');
        //     if (!row) return;

        //     // Получаем данные из строки
        //     const cells = row.querySelectorAll('td, th');
        //     if (cells.length < 2) return;

        //     const name = cells[0]?.textContent.trim() || '';
        //     const profession = cells[1]?.textContent.trim() || '';
        //     const telWork = cells[2]?.textContent.trim() || '';
        //     const telInternal = cells[3]?.textContent.trim() || '';
        //     const telMobile = cells[4]?.textContent.trim() || '';
        //     const status = cells[5]?.textContent.trim() || '';

        //     // Ищем email в данных (если есть)
        //     const email = row.dataset.email || '';

        //     // Обновляем информационную панель
        //     const noteTable = document.querySelector('.handbook-body-right-section-note-panel-public-content table tbody');
        //     const noteHeader = document.querySelector('.handbook-body-right-nd-header-text');
        //     const currentDept = document.querySelector('.handbook-body-right-mdps-header-text')?.textContent || '';

        //     if (noteTable && noteHeader) {
        //         // Обновляем заголовок
        //         noteHeader.textContent = currentDept + ' > ' + name;

        //         // Обновляем таблицу
        //         noteTable.innerHTML = `
        //             <tr>
        //                 <th class="fs-table-row" scope="row">Имя</th>
        //                 <td class="fs-table-row" scope="row">${name}</td>
        //             </tr>
        //             <tr>
        //                 <th class="fs-table-row" scope="row">Должность</th>
        //                 <td class="fs-table-row" scope="row">${profession}</td>
        //             </tr>
        //             <tr>
        //                 <th class="fs-table-row" scope="row">Отдел</th>
        //                 <td class="fs-table-row" scope="row">${currentDept}</td>
        //             </tr>
        //             <tr>
        //                 <th class="fs-table-row" scope="row">Тел. Город</th>
        //                 <td class="fs-table-row" scope="row">${telWork}</td>
        //             </tr>
        //             <tr>
        //                 <th class="fs-table-row" scope="row">Тел. Внутренний</th>
        //                 <td class="fs-table-row" scope="row">${telInternal}</td>
        //             </tr>
        //             <tr>
        //                 <th class="fs-table-row" scope="row">Тел. Мобильный</th>
        //                 <td class="fs-table-row" scope="row">${telMobile}</td>
        //             </tr>
        //             <tr>
        //                 <th class="fs-table-row" scope="row">Эл. почта</th>
        //                 <td class="fs-table-row" scope="row">${email || '—'}</td>
        //             </tr>
        //             <tr>
        //                 <th class="fs-table-row" scope="row">Статус</th>
        //                 <td class="fs-table-row" scope="row">${status}</td>
        //             </tr>
        //         `;
        //     }
        // });

        console.log('✅ Поисковик инициализирован');
    })();
</script>







  
</body>
</html>


