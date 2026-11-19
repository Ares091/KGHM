<!DOCTYPE html>
<html lang="ru" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="../css/flexstyles.css">
    <link rel="stylesheet" href="../css/style.css?v=1.4">
    <link rel="stylesheet" href="../css/darkTheme.css?v=1.2">
    <link rel="icon" type="image/svg+xml" href="{{ asset('sources/media/icons/app-icons/kghm-handbook2-0.ico') }}">
    <title>Spravochnik 2.0 </title>

    
    <script>
        (function() {
            const enabled = localStorage.getItem('pageLoaderEnabled') !== 'false';
            if (!enabled) {
                // Помечаем, что лоадер не нужен
                document.documentElement.classList.add('loader-disabled');
            }
        })();
    </script>
    <script src="../js/page-loader.js"></script>
</head>
<body>
    <div id="page-loader" class="page-loader">
        <div class="loader-spinner"></div>
    </div>

    <div class="handbook-main block fl-align">
        <div class="handbook-inner fl-align">
            <div class="handbook-inner-items block fl-align fl-col">
                <div class="handbook-top-header-section block fl-align">
                    <!-- header -->
                    <div class="handbook-header-section block fl-align">
                        <div class="handbook-header-section-inner fl-sp-btw">
                            <div class="handbook-header-section-left-bar fl-row">

                                {{-- <div class="nav-btn handbook-header-nav-btn-block fl-align" data-popup-type="my_data">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/pass2.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-hvb-text">Мои данные</p>
                                    </div>
                                </div>  --}}

                                {{-- <div class="nav-btn handbook-header-nav-btn-block fl-align" data-popup-type="support">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/user.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-hvb-text">Тех. поддержка</p>
                                    </div>
                                </div>  --}}

                                {{-- <div class="nav-btn-group fl-align">
                                    <div class="nav-btn handbook-header-nav-btn-block fl-align" data-popup-type="interface">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/dashboard-interface.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">Интерфейс</p>
                                        </div>
                                    </div>  --}}
                                    {{-- <div class="nav-btn-list handbook-header-nav-btn fl-align">
                                        <div class="nav-btn-list-inner block fl-align fl-col">
                                            <div class="nb-list-btn nav-btn-list-row fl-align">
                                                <div class="nb-list-icon">
                                                    <img src="" alt="" class="nb-list-icon-img img">
                                                </div>
                                                <div class="nb-list-text-block">
                                                    <p class="nb-list-text"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                {{-- </div> --}}
                                


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

                                <div class="handbook-header-text-block fl-align">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/app-icons/kghm-handbook2-0.ico" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-header-text">КХМ Справочник</p>
                                    </div>
                                </div> 

                                @if ($user && $user->u_role !=='user')
                                    <div class="fs-popup-window-btn nav-btn handbook-header-nav-btn-block-2 hhnb-user-btn fl-align" data-popup-type="user_info">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/pass2.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hnbb-text">{{$user->u_login}}</p>
                                        </div>
                                    </div> 

                                    <a href="{{route('logout')}}" class="nav-btn handbook-header-nav-btn-block-2 hhnb-user-btn fl-align" data-popup-type="autorization">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/logout.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                    </a> 
                                @elseif ($user && $user->u_role ==='user')
                                    <div class="fs-popup-window-btn nav-btn handbook-header-nav-btn-block-2 hhnb-user-btn fl-align" data-popup-type="user_info">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/pass2.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hnbb-text">{{$user->u_login}}</p>
                                        </div>
                                    </div> 

                                    <a href="{{route('logout')}}" class="nav-btn handbook-header-nav-btn-block-2 hhnb-user-btn fl-align" data-popup-type="autorization">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/logout.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                    </a> 
                                @else
                                    {{-- <div class="fs-popup-window-btn nav-btn handbook-header-nav-btn-block-2 hhnb-user-btn fl-align" data-popup-type="autorization">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/pass2.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hnbb-text">Войти Руководству</p>
                                        </div>
                                    </div>  --}}
                                @endif

                                


                            </div>
                        </div>
                    </div>
                </div>
                <div class="handbook-bottom-body-section block fl-row fl-align fl-stretch">
                    <div class="handbook-body-left-department-panel-section fl-al-start">
                        <div class="handbook-body-left-department-panel-section-inner block fl-align fl-col">
                            {{-- <div class="handbook-body-left-section-ui-settings-block fl-row">
                                
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
                            </div> --}}

                            <div class="handbook-body-left-department-panel-block block">
                                
                                <div class="handbook-body-left-department-panel-section-inner fl-align fl-col">
                                    <div class="handbook-body-left-department-panel hb-bl-dp-h-max fl-col">
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

                                            @include('components/data_panel/data_card_table', ['clients' => $clients, 'tableComponentType' => 'cards', 'tableType' => 'UserTable', 'pageIsMain' => true ])
                                            
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>


                        {{-- информационная панель о пользователе --}}
                        <div class="handbook-body-right-section-note-data-block hbb-rsnd-without-act-btns block">
                            <div class="handbook-body-right-main-data-panel-section-header block fl-align fl-start">
                                <div class="handbook-body-right-mdps-header-text-block handbook-mini-pop-i-block fl-row">
                                    <p class="handbook-body-right-nd-header-text">Бухгалтерия > Букреева Светлана Валерьевна</p>
                                    <img src="../sources/media/icons/copy2_64.png" alt="" class="handbook-mini-pop-icon handbook-mini-pop-i-copy-username-title img" style="width: 16px; height: 16px;">
                                </div>
                            </div>
                            <div class="handbook-body-right-section-note-data-block-inner fl-align fl-col">
                                <div class="handbook-body-right-section-note-panel-block block fl-align">
                                    <div class="handbook-body-right-section-note-panel-content block-content fl-sp-btw fl-al-start">
                                        
                                        @include('components/data_user_note/data_user_note', ['cli' => $clients[0], 'user' => $user, 'tableType' => 'UserTable'])
                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="handbook-user-info-block fl-row">
        <div class="handbook-user-info-block-inner fl-row">
            <p class="handbook-uib-text">Имя ПК: {{ $computerName }} / Ваш IP адрес: {{ $userIp }}</p>
        </div>
    </div>


    

    {{-- ВСПЛЫВАЮЩЕЕ ОКНО --}}
    
    @include('components.popup.container.popup_container')
    

    @include('components.pop_messages.popup_message')


    <script src="../js/flexsyles-anim.js"></script>
    <script src="../js/flexsyles-anim.js"></script>

    <script src="../js/get-popup-window.js"></script>

    <script src="../js/inner-popup.js"></script>

    <script src="../js/departament-subs.js"></script>
    
    <script src="../js/get-clients-main-info.js"></script>

    <script>
        
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

    </script>

    {{-- скрипт поиска --}}
    <script src="../js/search.js?v=1.2"></script>
    

    <script src="../js/keysets-navigation.js"></script>
    <script src="../js/other-ui.js"></script>


</body>
</html>