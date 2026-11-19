<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="../css/flexstyles.css">
    <link rel="stylesheet" href="../css/style.css?v=1.4">
    <link rel="stylesheet" href="../css/darkTheme.css">
    <link class="settingsCssLink1" rel="stylesheet" href="">
    <link class="settingsCssLink2" rel="stylesheet" href="">
    {{-- <link class="settingsCssLink2" rel="stylesheet" href="../css/settings/compactDesign.css"> --}}

    <link rel="icon" type="image/svg+xml" href="{{ asset('sources/media/icons/app-icons/kghm-handbook2-0.ico') }}">
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


                                @if ($user)
                                    
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
                                            <p class="nav-btn-text handbook-hvb-text">Заявки</p>
                                        </div>
                                    </div>  --}}

                                    <a href="{{ route('equipmentPage') }}" class="admin-btn nav-btn-change-info-client nav-btn fl-align" data-popup-type="interface"> 
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/dashboard-interface.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">Учёт техники</p>
                                        </div>
                                    </a> 

                                    <a href="{{ route('documentsPage') }}" class="admin-btn nav-btn-change-info-client nav-btn fl-align" data-popup-type="interface"> 
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/dashboard-interface.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">Документы поступления</p>
                                        </div>
                                    </a> 

                                    <a href="{{ route('requestsPage') }}" class="admin-btn nav-btn-change-info-client nav-btn fl-align" data-popup-type="interface"> 
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/user2.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">Заявки</p>
                                        </div>
                                    </a> 

                                    

                                    {{-- <div class="admin-btn nav-btn-change-info-client nav-btn  fl-align" data-popup-type="interface">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/dashboard-interface.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">упр. данными сотрадников
                                            </p>
                                        </div>
                                    </div> --}}

                                    <div class="fs-popup-window-btn admin-btn handbook-header-nav-btn-block nav-btn  fl-align" data-popup-type="import_1c">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/import (1).png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">Импорт 1с</p>
                                        </div>
                                    </div>
                                @endif


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

                                
                                {{-- <div class="admin-btn nav-btn-add-client nav-btn fl-align" data-popup-type="interface">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/dashboard-interface.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-hvb-text">Подгруз.Сотрудника (отключено)</p>
                                    </div>
                                </div> --}}
                               
                                

                            </div>

                            <div class="handbook-header-section-right-bar fl-row">
                                
                                <div class="handbook-header-text-block fl-align">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/app-icons/kghm-handbook2-0.ico" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-header-text">КГХМ Справочник админа</p>
                                    </div>
                                </div> 

                                @if ($user && $user->u_role !=='user')
                                    <div class="fs-popup-window-btn nav-btn handbook-header-nav-btn-block-2 hhnb-user-btn fl-align" data-popup-type="autorization">
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
                                    <div class="fs-popup-window-btn nav-btn handbook-header-nav-btn-block-2 hhnb-user-btn fl-align" data-popup-type="autorization">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/pass2.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hnbb-text">Войти Руководству</p>
                                        </div>
                                    </div> 
                                @endif

                                


                            </div>
                        </div>
                    </div>
                </div>
                <div class="handbook-bottom-body-section block fl-row fl-align fl-stretch">
                    <div class="handbook-body-left-department-panel-section fl-al-start">
                        <div class="handbook-body-left-department-panel-section-inner block fl-align fl-col">
                            <div class="handbook-body-left-section-ui-settings-block fl-row">
                                
                                <div class="fs-popup-window-btn nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align" data-popup-type="division_admin_add"> 
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/folder_add.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                </div> 

                                <div class="nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/folder_edit.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                </div> 

                                <div class="nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/folder_delete.png" alt="" class="handbook-hvb-icon img">
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
                        
                        {{-- панель инструментов --}}
                        <div class="handbook-body-right-main-data-panel-top-settings-section fl-align fl-col">
                            <div class="handbook-body-right-mdp-top-settings-section-inner block fl-align fl-sp-btw">

                                <div class="handbook-body-right-mdp-top-left-settings-block fl-row">

                                    @if ($user)
                                        <div class="fs-popup-window-btn eq-add-btn admin-btn nav-btn-add-client nav-btn  fl-align" data-popup-type="admin_add">
                                            <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                                <img src="../sources/media/icons/add-user.png" alt="" class="handbook-hvb-icon img">
                                            </div>
                                            <div class="handbook-hvb-text-block">
                                                <p class="nav-btn-text handbook-hvb-text">
                                                    Добавить сотрудника
                                                </p>
                                            </div>
                                        </div>
                                        

                                        <div class="admin-dynamic-edit-btn eq-edit-btn nav-btn-change-info-client nav-btn  fl-align" data-edit-type="admin_edit">
                                            <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                                <img src="../sources/media/icons/edit-user-0.png" alt="" class="handbook-hvb-icon img">
                                            </div>
                                            <div class="handbook-hvb-text-block">
                                                <p class="nav-btn-text handbook-hvb-text">
                                                    Ред сотрудника (динам.)
                                                </p>
                                            </div>
                                        </div>

                                        <div class="fs-popup-window-btn admin-dynamic-edit-btn eq-edit-btn nav-btn-change-info-client-2 nav-btn  fl-align" data-popup-type="admin_edit_form">
                                            <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                                <img src="../sources/media/icons/edit-user-0.png" alt="" class="handbook-hvb-icon img">
                                            </div>
                                            <div class="handbook-hvb-text-block">
                                                <p class="nav-btn-text handbook-hvb-text">
                                                    Ред сотрудника (форма)
                                                </p>
                                            </div>
                                        </div>

                                        <div class="admin-dynamic-edit-btn eq-delete-btn nav-btn-delete-client nav-btn  fl-align" data-edit-type="admin_delete">
                                            <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                                <img src="../sources/media/icons/delete-user.png" alt="" class="handbook-hvb-icon img">
                                            </div>
                                            <div class="handbook-hvb-text-block">
                                                <p class="nav-btn-text handbook-hvb-text">
                                                    Удалить сотрудника
                                                </p>
                                            </div>
                                        </div>


                                        <div class="nav-btn-group nbg-closed" data-group-name="equipmentFilter">

                                            <div class="handbook-header-nav-btn-block nav-btn hbsb-nav-btn  fl-align" data-popup-type="import_1c">
                                                <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                                    <img src="../sources/media/icons/settings2.png" alt="" class="handbook-hvb-icon img">
                                                </div>
                                                <div class="handbook-hvb-text-block">
                                                    <p class="nav-btn-text handbook-hvb-text">Настройки</p>
                                                </div>
                                            </div>

                                            <div class="nav-btn-list-container nav-btn-list-container-2 nbg-container-closed fl-align">  
                                                <div class="nav-btn-list-block handbook-header-nav-btn block fl-align fl-col">

                                                    <div class="nav-btn-list-block-category nav-btn-list-bc-row block fl-align fl-col">

                                                        <div class="nav-btn-list-block-category-header block">
                                                            <div class="nav-btn-list-block-category-header-text handbook-hvb-text">
                                                                Интерфейс
                                                            </div>
                                                        </div>
                                                        <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="compactDesign">
                                                            <div class="nb-list-icon">
                                                                <img src="../sources/media/icons/cells1.png" alt="" class="nb-list-icon-img img">
                                                            </div>
                                                            <div class="nb-list-text-block">
                                                                <p class="nb-list-text nav-btn-text handbook-hvb-text">Компактный дизайн сайта</p>
                                                            </div>
                                                        </div>

                                                        <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="TableCellsInterface">
                                                            <div class="nb-list-icon">
                                                                <img src="../sources/media/icons/cells.png" alt="" class="nb-list-icon-img img">
                                                            </div>
                                                            <div class="nb-list-text-block">
                                                                <p class="nb-list-text nav-btn-text handbook-hvb-text">Данные в виде таблицы</p>
                                                            </div>
                                                        </div>

                                                        <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="TableCardInterface">
                                                            <div class="nb-list-icon">
                                                                <img src="../sources/media/icons/menu.png" alt="" class="nb-list-icon-img img">
                                                            </div>
                                                            <div class="nb-list-text-block">
                                                                <p class="nb-list-text nav-btn-text handbook-hvb-text">Данные в виде карточек</p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    
                                                    <div class="nav-btn-list-block-category nav-btn-list-bc-row block fl-align fl-col">
                                                        <div class="nav-btn-list-block-category-header block">
                                                            <div class="nav-btn-list-block-category-header-text handbook-hvb-text">
                                                                Шрифты
                                                            </div>
                                                        </div>
                                                        <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="fontsWidth">
                                                            <div class="nb-list-icon">
                                                                <img src="../sources/media/icons/fonts1.png" alt="" class="nb-list-icon-img img">
                                                            </div>
                                                            <div class="nb-list-text-block fl-sp-btw">
                                                                <p class="nb-list-text nav-btn-text handbook-hvb-text">Размер шрифта</p>
                                                                {{-- <input type="number" min="12" max="22" value="16" name="" id="" class="nbl-text-input nb-lt-integer-i input form-input"> --}}
                                                                
                                                                <select type="text" class="input form-input form-popup-i-text nbl-text-input nb-lt-integer-i-2" id="fontWidthSelect" style="padding-top: 0px; padding-bottom: 0px;"> 
                                                                    <option value="12">12</option>
                                                                    <option value="13">13</option>
                                                                    <option value="14">14</option>
                                                                    <option value="15">15</option>
                                                                    <option value="16" selected>16</option>
                                                                    <option value="17">17</option>
                                                                    <option value="18">18</option>
                                                                    <option value="19">19</option>
                                                                    <option value="20">20</option>
                                                                    <option value="21">21</option>
                                                                    <option value="22">22</option>
                                                                </select> 
                                                            </div>
                                                        </div>
                                                    </div>

                                                    

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    

                                    {{-- <div class="admin-btn nav-btn-action-client nav-btn  fl-align" data-popup-type="interface">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/folder (1).png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">
                                                Действие с ед.тех
                                            </p>
                                        </div>
                                    </div> --}}

                                </div>

                            </div>

                        </div>

                        {{-- таблица пользователей --}}
                        <div class="handbook-body-right-main-data-panel-section fl-align fl-col fl-start">
                            <div class="handbook-body-right-main-data-panel-section-header block fl-align fl-start">
                                <div class="handbook-body-right-mdps-header-text-block fl-row">
                                    <p class="handbook-body-right-mdps-header-text">Бухгалтерия</p>
                                </div>
                            </div>

                            <div class="handbook-body-right-main-data-panel-section-inner fl-align fl-col">
                                <div class="handbook-body-right-main-data-panel-block block fl-align">
                                    
                                    <div class="handbook-body-right-main-data-panel-table-container block fl-align">
                                        <div class="handbook-body-right-main-data-panel-t-content example-subsub-block-content example-subsub-bc-with-settings-block block-content">
                                           
                                            @include('components/data_panel/data_table_test' , ['clients' => $clients, "tableType" => "AdminTable", 'pageIsMain' => false ])
                                            
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>


                        {{-- информационная панель о пользователе --}}
                        <div class="handbook-body-right-section-note-data-block block">
                            <div class="handbook-body-right-main-data-panel-section-header block fl-align fl-start">
                                <div class="handbook-body-right-mdps-header-text-block">
                                    <p class="handbook-body-right-nd-header-text">Бухгалтерия > Букреева Светлана Валерьевна
                                        
                                    </p>
                                </div>
                            </div>
                            <div class="handbook-body-right-section-note-data-block-inner fl-align fl-col">
                                <div class="handbook-body-right-section-note-panel-block block fl-align">
                                    <div class="handbook-body-right-section-note-panel-content block-content fl-sp-btw fl-al-start">
                                        @include('components/data_user_note/data_user_note' , ['cli' => $clients[0], 'user' => $user, "tableType" => "UserTable"])
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
    <div class="fl-popup-window fl-popup-w-closed block fl-align" data-opened="false">
        <div class="fl-popup-window-inner block fl-align">

            <div class="fl-popup-window-block block-border-2 block-shadow-2 fl-align fl-col">
                <div class="fl-popup-window-header-block block fl-sp-btw">

                    {{-- ЗАГОЛОВОК --}}
                    <div class="fl-popup-w-h-title-block">
                        <div class="fl-popup-w-h-title-text">Авторизация</div>
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

                     @include('components.popup.popup_login')

                </div>

               

                <!-- <div class="fl-pwb-nav-buttons-block fl-pwb-nbb-bottom block fl-align">
                    <div class="fl-pwb-nbb-bottom-inner fl-sp-btw">
                        <button class="fl-pwb-nbb-bottom-button fl-pwb-nav-button-tab fl-pwb-nbt-submit form-btn btn-m-b button block header-btn button-st-3">Подтвердить</button>
                        <button class="fl-pwb-nbb-bottom-button fl-pwb-nav-button-tab fl-pwb-nbt-close form-btn btn-m-b button block header-btn button-st-2">Закрыть</button>
                    </div>
                </div> -->
            </div>

        </div>
    </div
    


    <script src="../js/flexsyles-anim.js"></script>
    <script src="../js/flexsyles-anim.js"></script>

    <script
        src="../js/jquery-3.7.1.min.js"
        integrity="sha256-PnUB0Vw2MOeRyLIDkuud7jGp9lzj793nbO9ccQFBqyQ="
        crossorigin="anonymous">
    </script>

    @if ($nonLogin)
        {{-- <div class="">Вы не зарегистрированы</div> --}}
        <script>
            window.popupAPI.open()
        </script>
    @else

    {{-- функционал подразделений в левой панели - вызов метода вывода сотрудников --}}
    <script src="{{ asset('js/departament-subs.js') }}"></script>

    {{-- скрипт вывода сотрудников в таблице по нажатию на подразделение --}}
    <script  src="{{ asset('js/get-professions-admin.js') }}"> </script>

    {{-- вывод нижней панели о сотруднике--}}
    <script src="{{ asset('js/data-panel.js?v=1.4') }}"></script>

    {{-- скрипт поиска --}}
    <script src="{{ asset('js/search.js') }}"></script>

    {{-- скрипт мини иконок и т.д --}}
    <script src="../js/other-ui.js"></script>

    {{-- скрипт вывода всплывающего окна --}}
    {{-- @include('components.js.get-popup-window') --}}
    <script src="../js/get-popup-window.js"></script>


    <script>
        btnListBlockGroupOpened = false;
        selectedFontSize = localStorage.getItem("fontsWidth");

        function openBtnList(btnListBlockGroup) {
            // btnListBlockGroup = document.querySelector('.nav-btn-group[data-group-name="equipmentFilter"]');
            btnListBlockGroupContainer = btnListBlockGroup.querySelector('.nav-btn-list-container');
            // console.log('btnListBlockGroupContainer', btnListBlockGroupContainer);

            if (btnListBlockGroup.classList.contains('nbg-opened')) {
                btnListBlockGroup.classList.replace('nbg-opened', 'nbg-closed');
                btnListBlockGroupContainer.classList.replace('nbg-container-opened', 'nbg-container-closed');
                btnListBlockGroupContainer.classList.replace('nbg-container-opened', 'nbg-container-closed-anim');
                setTimeout(() => {
                    btnListBlockGroupContainer.classList.replace('nbg-container-closed-anim', 'nbg-container-closed');
                }, 210);
            }
            else {
                btnListBlockGroup.classList.replace('nbg-closed', 'nbg-opened');
                btnListBlockGroupContainer.classList.replace('nbg-container-closed', 'nbg-container-opened');
            }
        }

        function checkOpenedBtns() {
            document.querySelectorAll('.nav-btn-group').forEach(nbg => {
                if (nbg.classList.contains('nbg-opened')){
                    nbg.classList.replace('nbg-opened', 'nbg-closed');
                    nbg.querySelector('.nav-btn-list-container').classList.replace('nbg-container-opened', 'nbg-container-closed-anim');
                    setTimeout(() => {
                        nbg.querySelector('.nav-btn-list-container').classList.replace('nbg-container-closed-anim', 'nbg-container-closed');
                    }, 210);
                }
            });
        }

        function initBtnListOptions(navBtnGroup){

            btnListBlockGroupContainer = navBtnGroup.querySelector('.nav-btn-list-container');

            btnListBlockGroupContainer.querySelectorAll('.nb-list-btn').forEach(nbListBtn => {
                nbListBtn.addEventListener('click', () => {
                    used = false;

                    if (nbListBtn.dataset.listName === "fontsWidth") {
                        // const newCsslink = document.createElement('link');
                        // newCsslink.rel = 'stylesheet';
                        // newCsslink.type = 'text/css';
                        // newCsslink.href = '../css/settings/fontSize20.css';
                        newCsslink = document.querySelector('.settingsCssLink1');


                        // nb-lt-integer-i
                        nbListBtn.querySelector('.nb-lt-integer-i').addEventListener('change', () => {
                            nbltIntegerValue = nbListBtn.querySelector('.nb-lt-integer-i').value;
                            newCsslink.href = `../css/settings/fontSize${nbltIntegerValue}.css`;
                            selectedFontSize = nbltIntegerValue;
                        })



                        // Добавляем тег в секцию head документа
                        document.head.appendChild(newCsslink);

                    }
                    else if (nbListBtn.dataset.listName === "compactDesign") {
                        if (localStorage.getItem("compactDesign") !== null) {
                            localStorage.removeItem("compactDesign");

                            newCsslink = document.querySelector('.settingsCssLink2');
                            newCsslink.href = "";
                            used = true;
                            console.log(used);
                        }
                        else {
                            newCsslink = document.querySelector('.settingsCssLink2');
                            newCsslink.href = `../css/settings/compactDesign.css`;


                            // // Добавляем тег в секцию head документа
                            document.head.appendChild(newCsslink);
                        }
                        

                    }

                    if (!used) {
                        saveBtnSetting(nbListBtn.dataset.listName);
                    }
                });
            });

            // <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="fontsWidth">

        } 


        function saveBtnSetting(setting) {
            if (setting === "fontsWidth") {
                localStorage.setItem(setting, selectedFontSize);
            }
            else if (setting === "compactDesign") {
                localStorage.setItem(setting, true);
            }
        }

        function loadBtnSettings() {
            if (localStorage.getItem("fontsWidth") !== null && localStorage.getItem("compactDesign") === null) {
                fontsWidth = localStorage.getItem("fontsWidth");

                document.querySelector('.nb-lt-integer-i').value = parseInt(fontsWidth);

                //fontsWidth
                newCsslink = document.querySelector('.settingsCssLink1');
                newCsslink.href = `../css/settings/fontSize${fontsWidth}.css`;
                document.head.appendChild(newCsslink);
                console.log("Настройка 'Размер шрифта' инициализирован");
            }

            if (localStorage.getItem("compactDesign") !== null) {
                compactDesign =  localStorage.getItem("compactDesign");

                
                newCsslink2 = document.querySelector('.settingsCssLink2');
                newCsslink2.href = `../css/settings/compactDesign.css`;
                document.head.appendChild(newCsslink2);
                console.log("Настройка 'компактный дизайн' инициализирован");
            }
            
        }

        // document.querySelector('.nav-btn-group[data-group-name="equipmentFilter"] > .nav-btn').addEventListener('click', () => {
        //     openBtnList();
        // });
        document.querySelectorAll('.nav-btn-group[data-group-name="equipmentFilter"] > .nav-btn').forEach(navBtn => {
            navBtn.addEventListener('click', () => {
                navBtnGroup = navBtn.closest('.nav-btn-group');
                // console.log('navBtnGroup', navBtnGroup);
                checkOpenedBtns();
                openBtnList(navBtnGroup);
                initBtnListOptions(navBtnGroup);
            });
        });

        document.addEventListener('click', e => {
            target = e.target;
            //console.log('and on and on and on', e.target);
            if (e.target.closest('body') && !e.target.closest('.nav-btn-group') && !e.target.closest('.nav-btn-list-container')){
                //console.log('оливер приехал');
                
                // if (e.target.closest('.nav-btn-group').contains('nbg-opened')) openBtnList();
                if (!e.target.closest('.nav-btn-group')) checkOpenedBtns();
            } 
        });

        // setTimeout(() => {
        //     loadBtnSettings();
        // }, 100);

        loadBtnSettings();
    </script>

    <script>

        // инициализируем необходимые флаги и глобальные переменные для корректной работы скрипта
        let cliManagementModeEnabled = false; // режим "редактирование техники" по умолчанию выключен
        let cliManagementModeEnabledName = null; //название активного режима редактирования

        let cliMMInputEditingEnabled = false; // флажок для изменения редактируемой информации в инпут

        // функция входа в режим "редактирования техники". применяет стили, активирует листенеры кнопок и их функции
        function EnterToAdminManagementMode(editType) {
            if (editType === "admin_delete" && !cliManagementModeEnabled && cliManagementModeEnabledName === null){
                // активируем флажки о начале работы в режиме
                cliManagementModeEnabled = true;
                cliManagementModeEnabledName = editType;
                 // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
                // применение стилей делаем через функцию если мод еще не включен
                useCssStylesToSite(editType, false);
                adminManagementFetchActions(editType, cliMMInputEditingEnabled);
                
            } 
            else if (editType === "admin_edit" && !cliManagementModeEnabled && cliManagementModeEnabledName === null) {
                cliManagementModeEnabled = true;
                cliManagementModeEnabledName = editType;
                 // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
                // применение стилей делаем через функцию если мод еще не включен
                useCssStylesToSite(editType, false);
                adminManagementFetchActions(editType, cliMMInputEditingEnabled);

            }
            else {
                useCssStylesToSite(editType, cliManagementModeEnabled)
            }
        }

        // применение стилей к таблице в зависимости от мода
        function useCssStylesToSite(editType, used){
            if (used === false) { // стили не пременены тогда выполняем условие
                if (editType === "admin_delete"){

                    // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
                    // к контейнеру таблицы учета техники
                    document.querySelector('.handbook-body-right-main-data-panel-section').classList.add('brm-dp-secton-delete-mode');
                    // к фону заголовка таблицы учета техники
                    document.querySelector('.handbook-body-right-main-data-panel-section-header').classList.add('brm-dp-header-delete-mode');

                    // создаем и добавляем плашку с названием режима редактирования в заголовок таблицы уч. техники
                    eqModeLabel = document.createElement('div');
                    eqModeLabel.classList.add('nav-btn-text', 'hb-mode-label', 'fl-align');
                    eqModeLabel.textContent = "Режим удаления";
                    document.querySelector('.handbook-body-right-mdps-header-text-block').append(eqModeLabel)

                    // таблица
                    // добавляем стили для таблицы и её ячеек
                    document.querySelector("thead tr").classList.add('table-tr-header-delete-mode');

                    document.querySelectorAll('.table-row').forEach(tableRow => {
                        tableRow.classList.add('table-tr-delete-mode')
                    });


                    // 
                    quitFromModeBtn = document.createElement('div');
                    quitFromModeBtn.classList.add('quit-from-mode-btn-block', 'fl-align');
                    quitFromModeBtn.innerHTML = `
                        <div class="admin-dynamic-edit-btn quit-from-mode-btn admin-btn handbook-header-nav-btn-block nav-btn  fl-align" data-edit-type="equipment_edit_close">
                            <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                <img src="../sources/media/icons/import (1).png" alt="" class="handbook-hvb-icon img">
                            </div>
                            <div class="handbook-hvb-text-block">
                                <p class="nav-btn-text handbook-hvb-text">Выйти из режима редактивания</p>
                            </div>
                        </div>
                    `;
                    document.querySelector('.handbook-header-section-left-bar').append(quitFromModeBtn)

                    quitFromModeBtn.addEventListener('click', () => {
                        EnterToAdminManagementMode(editType);
                    });
                }
                if (editType === "admin_edit") {
                    document.querySelector('.handbook-body-right-main-data-panel-section').classList.add('brm-dp-secton-edit-mode');
                    document.querySelector('.handbook-body-right-main-data-panel-section-header').classList.add('brm-dp-header-edit-mode');

                    eqModeLabel = document.createElement('div');
                    eqModeLabel.classList.add('nav-btn-text', 'hb-mode-label', 'fl-align');
                    eqModeLabel.textContent = "Режим изменения";
                    document.querySelector('.handbook-body-right-mdps-header-text-block').append(eqModeLabel);

                    document.querySelector("thead tr").classList.add('table-tr-header-edit-mode');

                    document.querySelectorAll('.table-row').forEach(tableRow => {
                        tableRow.classList.add('table-tr-edit-mode')
                    });


                    // 
                    quitFromModeBtn = document.createElement('div');
                    quitFromModeBtn.classList.add('quit-from-mode-btn-block', 'fl-align');
                    quitFromModeBtn.innerHTML = `
                        <div class="admin-dynamic-edit-btn quit-from-mode-btn quit-from-edit-mode-btn admin-btn handbook-header-nav-btn-block nav-btn  fl-align" data-edit-type="equipment_edit_close">
                            <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                <img src="../sources/media/icons/import (1).png" alt="" class="handbook-hvb-icon img">
                            </div>
                            <div class="handbook-hvb-text-block">
                                <p class="nav-btn-text handbook-hvb-text">Выйти из режима редактивания</p>
                            </div>
                        </div>
                    `;
                    document.querySelector('.handbook-header-section-left-bar').append(quitFromModeBtn)

                    quitFromModeBtn.addEventListener('click', () => {
                        EnterToAdminManagementMode(editType);
                    });
                }
            }
            else {
                // удаляем все флажки для дальнейшей повторной работы
                cliManagementModeEnabled = false;
                cliManagementModeEnabledName = null;
                // выходим из режима редактирования в зависимости от его типа
                if (editType === "admin_delete") {
                    document.querySelector('.handbook-body-right-main-data-panel-section').classList.remove('brm-dp-secton-delete-mode');
                    document.querySelector('.handbook-body-right-main-data-panel-section-header').classList.remove('brm-dp-header-delete-mode');

                    document.querySelector('.nav-btn-text.hb-mode-label.fl-align').remove();

                    document.querySelector("thead tr").classList.remove('table-tr-header-delete-mode');

                    document.querySelectorAll('.table-row').forEach(tableRow => {
                        tableRow.classList.remove('table-tr-delete-mode')
                    });

                    document.querySelector('.quit-from-mode-btn-block').remove();
                } else if (editType === "admin_edit") {
                    document.querySelector('.handbook-body-right-main-data-panel-section').classList.remove('brm-dp-secton-edit-mode');
                    document.querySelector('.handbook-body-right-main-data-panel-section-header').classList.remove('brm-dp-header-edit-mode');

                    document.querySelector('.nav-btn-text.hb-mode-label.fl-align').remove();

                    document.querySelector("thead tr").classList.remove('table-tr-header-edit-mode');

                    document.querySelectorAll('.table-row').forEach(tableRow => {
                        tableRow.classList.remove('table-tr-edit-mode')
                    });

                    document.querySelector('.quit-from-mode-btn-block').remove();
                    
                    exitFromEditMode();

                }
                  
            }
            
               
        }

        function exitFromEditMode() {
            // console.log('Вызываем выход из режима редактирования объекта с id', cliEditModeTargetId);
            if (cliEditModeTargetId !== null){
                document.querySelectorAll('.table-row.editing-tr').forEach(EdRowLine => {
                    if (EdRowLine.classList.contains('editing-tr')) {
                        EdRowLine.classList.remove('editing-tr');

                        // EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                        //     if (tRowIndex !== 0) { 
                        //         const oldRow = EditingRowsOld[tRowIndex + 1];
                        //         oldRow.textContent = cliData;

                        //         newRow.replaceWith(oldRow);
                        //     }
                        // });
                        const tableInputs = EdRowLine.querySelectorAll('.fs-table-row input');

                        EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                            if (tRowIndex !== 0) { 
                                const oldRow = EditingRowsOld[tRowIndex];
                                const newRowValue = tableInputs[tRowIndex - 1];
                                console.log('newRowValue', newRowValue);
                                console.log('oldRow: ', oldRow, tRowIndex);
                                oldRow.innerHTML = newRowValue.value;
                                
                                
                                newRow.replaceWith(oldRow);
                            }
                        });

                        cliEditModeTargetId = null;
                        EditingRowsOld = null;
                        // tableInputs = [];
                        console.log('Выход из режима редактирования произведен')
                    }
                });
            }
        }

        let cliEditModeTargetId = null;
        let EditingRowsOld = null;
        let cliDataOld = {};
        let cliData = {};
        // .table-tr-delete-mode .fs-table-row'
        // функционал режима редактирований
        function adminManagementFetchActions(editType, inputEditEnabled) {
            if  (editType === "admin_edit" && cliManagementModeEnabled && cliManagementModeEnabledName === editType && inputEditEnabled === false) {
                document.querySelectorAll('.table-tr-edit-mode')?.forEach(EditingRowLine => {

                    EditingRowLine?.addEventListener('dblclick', (e) => {

                        if (cliEditModeTargetId !== null){
                            document.querySelectorAll('.table-tr-edit-mode').forEach(EdRowLine => {
                                if (EdRowLine.classList.contains('editing-tr')) {
                                    EdRowLine.classList.remove('editing-tr');

                                    // EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                                    //     if (tRowIndex !== 0) { 
                                    //         const oldRow = EditingRowsOld[tRowIndex + 1];
                                    //         oldRow.textContent = cliData;

                                    //         newRow.replaceWith(oldRow);
                                    //     }
                                    // });
                                    const tableInputs = EdRowLine.querySelectorAll('.fs-table-row input');

                                    EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                                        if (tRowIndex !== 0) { 
                                            const oldRow = EditingRowsOld[tRowIndex];
                                            const newRowValue = tableInputs[tRowIndex - 1];
                                            console.log('newRowValue', newRowValue);
                                            console.log('oldRow: ', oldRow, tRowIndex);
                                            oldRow.innerHTML = newRowValue.value;
                                            
                                            
                                            newRow.replaceWith(oldRow);
                                        }
                                    });

                                    cliEditModeTargetId = null;
                                    EditingRowsOld = null;
                                    // tableInputs = [];
                                }
                            });
                        }

                        EditingRowLine = e.target.closest('.table-tr-edit-mode');
                        EditingRows = EditingRowLine.querySelectorAll('.fs-table-row');

                        EditingRowLineOld = EditingRowLine;
                        EditingRowsOld = EditingRows;

                        console.log('EditingRowsOld: ', EditingRowsOld)

                        cliEditModeTargetId = parseInt(EditingRowLine.dataset.id);
                        EditingRowLine.classList.add('editing-tr');
                        const tableInputs = [];

                        // editRow = e.target.closest('.fs-table-row');
                        // tableEditingRowOld = editRow;

                        // console.log(EditingRowLine);

                        EditingRows.forEach((EdRowData, tRowIndex) => {
                            if (tRowIndex !== 0) {
                                const EditingRowText = EdRowData.textContent.trim();
                                const inputER = document.createElement('input');
                                inputER.type = 'text';

                                inputER.setAttribute('value', EditingRowText);

                                const erDataNames = ['cli_name_view', 'cli_prof', 'cli_tel_work', 'cli_tel_work2', 'cli_tel_mobile', 'cli_email', 'cli_sync_1c_status'];
                                if (tRowIndex < erDataNames.length + 1) {
                                    inputER.dataset.name = erDataNames[tRowIndex - 1];
                                }
                                inputER.dataset.id = EditingRowLine.dataset.id;

                                EdRowData.innerHTML = '';
                                EdRowData.appendChild(inputER);

                                inputER.classList.add('input-edit-1', 'input');

                                tableInputs.push(inputER);

                                cliDataOld[inputER.dataset.name] = EditingRowText;
                            }
                        });
                      
                        // сохраняем значения
                        

                        // тут закончил / сверял с old 2
                        // надо проверить прошлый скрипт
                        
                        // выход
                        // console.log('EditingRowLine: ', EditingRowLine)
                        // EditingRowLine 
                        //document.querySelector('.table-tr-delete-mode.editing-tr')
                        document.querySelector('.table-tr-edit-mode.editing-tr').addEventListener('keydown', (e) => {
                            console.log(e.key);
                            if (e.key === 'Enter') {
                                const cliDivId = tableInputs[0].dataset.id;
                                // const cliData = tInput.value;
                                const cliData1 = {};

                                tableInputs.forEach((tInput, index) => {
                                    cliData1[tInput.dataset.name] = tInput.value;
                                })

                                tableInputs.forEach((tInput, index) => {
                                    // console.log(`cliData1[${tInput.dataset.name}]`, cliData1[tInput.dataset.name], `cliDataOld[${tInput.dataset.name}}]`, cliDataOld[tInput.dataset.name])
                                    if (cliData1[tInput.dataset.name] !== cliDataOld[tInput.dataset.name]) {
                                        cliData[tInput.dataset.name] = tInput.value;
                                    } 
                                })
                                //fsddsf

                                fetch(`/EditAdmin?cli_div_id=${cliDivId}&cli_data=${JSON.stringify(cliData)}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        Accept: 'application/json',
                                    },
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // const newRow = document.createElement('td');

                                        // const newRow = EditingRowsOld[index + 1]
                                        // newRow.textContent = cliData;
                                        // tInput.replaceWith(newRow);
                                        // cliEditModeTargetId = null;
                                        // EdRowLine = document.querySelector('.table-tr-delete-mode.editing-tr');
                                        EdRowLine = document.querySelector(`.table-tr-edit-mode[data-id="${cliEditModeTargetId}"]`);
                                        if (EdRowLine.classList.contains('editing-tr')) {
                                            EdRowLine.classList.remove('editing-tr');

                                            console.log('EdRowLine.querySelectorAll(.fs-table-row): ', EdRowLine.querySelectorAll('.fs-table-row'))
                                            console.log('EdRowLine.EditingRowsOld: ', EditingRowsOld)

                                            EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                                                if (tRowIndex !== 0) { 
                                                    const oldRow = EditingRowsOld[tRowIndex];
                                                    const newRowValue = tableInputs[tRowIndex - 1];
                                                    // console.log('newRowValue', newRowValue);
                                                    // console.log('oldRow: ', oldRow, tRowIndex);
                                                    oldRow.innerHTML = newRowValue.value;
                                                    

                                                    newRow.replaceWith(oldRow);
                                                }
                                            });

                                            cliEditModeTargetId = null;
                                            EditingRowsOld = null;
                                            // tableInputs = []
                                        }


                                    }
                                })
                                .catch(error => {
                                    console.error('Ошибка поиска:', error);
                                });

                                console.log('cliDivId', cliDivId, 'cliData', cliData, 'cliDataOld', cliDataOld);
                            }
                            
                        });

                        // tableInputs.forEach((tInput, index) => {
                        //     tInput.addEventListener('keydown', (e) => {
                        //         if (e.key === 'Enter') {
                        //             const cliDivId = tInput.dataset.id;
                        //             const cliName = tInput.dataset.name;
                        //             const cliData = tInput.value;

                        //             fetch(`/EditAdmin?cli_div_id=${cliDivId}&cli_col_name=${cliName}&cli_data=${cliData}`, {
                        //                 method: 'POST',
                        //                 headers: {
                        //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        //                     Accept: 'application/json',
                        //                 },
                        //             })
                        //             .then(response => response.json())
                        //             .then(data => {
                        //                 if (data.success) {
                        //                     // const newRow = document.createElement('td');

                        //                     // const newRow = EditingRowsOld[index + 1]
                        //                     // newRow.textContent = cliData;
                        //                     // tInput.replaceWith(newRow);
                        //                     // cliEditModeTargetId = null;
                        //                     EdRowLine = document.querySelector('.table-tr-delete-mode[data-id="49299"]');
                        //                     if (EdRowLine.classList.contains('editing-tr')) {
                        //                         EdRowLine.classList.remove('editing-tr');

                        //                         console.log('EdRowLine.querySelectorAll(.fs-table-row): ', EdRowLine.querySelectorAll('.fs-table-row'))
                        //                         console.log('EdRowLine.EditingRowsOld: ', EditingRowsOld)

                        //                         EdRowLine.querySelectorAll('.fs-table-row').forEach((newRow, tRowIndex) => {
                        //                             if (tRowIndex !== 0) { 
                        //                                 const oldRow = EditingRowsOld[tRowIndex];
                        //                                 const newRowValue = tableInputs[tRowIndex - 1];
                        //                                 console.log('newRowValue', newRowValue);
                        //                                 console.log('oldRow: ', oldRow, tRowIndex);
                        //                                 oldRow.innerHTML = newRowValue.value;
                                                        

                        //                                 newRow.replaceWith(oldRow);
                        //                             }
                        //                         });

                        //                         cliEditModeTargetId = null;
                        //                         EditingRowsOld = null;
                        //                     }


                        //                 }
                        //             })
                        //             .catch(error => {
                        //                 console.error('Ошибка поиска:', error);
                        //             });
                        //         }

                        //     });
                        // });

                      



                    });
                });
            
            }
            else if (editType === "admin_delete" && cliManagementModeEnabled && cliManagementModeEnabledName === editType && inputEditEnabled === false) {
                document.querySelectorAll('.table-tr-delete-mode').forEach(tableEditingRow => {
                    tableEditingRow.addEventListener('dblclick', () => {
                        // получаем значения удаляемой записи
                        cliDivId = parseInt(tableEditingRow.dataset.id);
                        
                        tableEditingRow.classList.add('fs-popup-window-btn');
                        document.querySelectorAll('.fs-popup-window-btn');
                        // выводим окошко с вопросом о удалении
                        getPopupMessage('delete', [cliDivId, tableEditingRow]);

                        console.log('Удаляю элемент с id=', cliDivId)

                        // `/DeleteEquipment?eq_div_id=${eqDivId}`

                        // fetch(`/DeleteEquipment/${eqDivId}`, {
                        //     method: 'POST',
                        //     headers: {
                        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        //         Accept: 'application/json',
                        //     },
                        // })
                        // .then(response => response.json())
                        // .then(data => {
                        //     if (data.success) {
                        //         // Обновляем таблицу
                        //         tableEditingRow.remove();
                                
                        //     }
                        // })
                        // .catch(error => {
                        //     console.error('Ошибка поиска:', error);
                        // });

                      


                    });
                });
            
            
            }
            
        }

        function getPopupMessage(messageType, messageData, messageDesc = ""){
            fetch(`/PopupMessage?cli_id=${messageData[0]}&message_type=${messageType}`)
            .then(res => res.text())
            .then(html => {
                popupAPI.open()
                document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Внимание!";
                document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
                deleteRequest(messageData[0], messageData[1]);
            })
            .catch(error => {
                console.error('Ошибка поиска:', error);
            });

        }

        function deleteRequest(eqDivId, deletingElem) {
            document.querySelectorAll('.popupActionBtn').forEach(popupActionBtn => {
                popupActionBtn.addEventListener('click', () => {
                    if (popupActionBtn.dataset.btn === "yes"){
                        console.log('Удаляю элемент с id=', eqDivId)

                        // `/DeleteEquipment?eq_div_id=${eqDivId}`
                        fetch(`/DeleteEquipment/${eqDivId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                Accept: 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Обновляем таблицу
                                deletingElem.remove();
                                
                            }
                        })
                        .catch(error => {
                            console.error('Ошибка поиска:', error);
                        });
                    }
                    else {
                        console.log('Удаление отменено')
                    }

                    popupAPI.close();


                })
            });


          
        }

        // привязываем функцию входа в режим редактирования ко всем кнопкам с классом ".admin-dynamic-edit-btn"
        document.querySelectorAll('.admin-dynamic-edit-btn').forEach(adminDEBtn => {
            adminDEBtn.addEventListener('click', () => {
                EnterToAdminManagementMode(adminDEBtn.dataset.editType)
            });
        });




        function changeClient1cStatus(cliId) {
            document.querySelectorAll('.fs-t-row-1c').forEach(cli1CBtn => {
                cli1CBtn.addEventListener('click', () => {
                        console.log('Удаляю элемент с id=', cliId)

                        // `/DeleteEquipment?eq_div_id=${eqDivId}`
                        fetch(`/changeClient1cStatus?cli_id=${cliId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                Accept: 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Обновляем таблицу
                                if (data.status) {
                                    cli1CBtn.innerHTML = '✔';
                                }
                                else {
                                    cli1CBtn.innerHTML = '✘';
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Ошибка:', error);
                        });
                })
            });


          
        }


        

        


        
    </script>

    <script src="../js/keysets-navigation.js"></script>

    <script>
        
        $(document).ready(function() {

            // Функция для отправки AJAX-запроса
            function fetchClients() {

                // Параметры сортировки (храним в data-атрибутах на таблице или в скрытых полях)
                const sortField = $('#table-container').data('sort') || 'eq_id';
                const sortDirection = $('#table-container').data('direction') || 'asc';

                // Собираем данные для GET-запроса
                const params = {
                    div_id: currentDepartmentId,
                    div_type: currentdivisionType,
                    sort: sortField,
                    direction: sortDirection
                };

                // Показываем индикатор загрузки (опционально)
                $('#table-container').append('<div class="loader">Загрузка...</div>');

                // AJAX-запрос
                $.ajax({
                    url: '{{ route("clientFilter") }}',
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: params,
                    success: function(html) {
                        // Заменяем содержимое контейнера на полученный HTML
                        $('#table-container').html(html);
                        // Сохраняем текущие параметры сортировки в data-атрибутах контейнера (для следующего запроса)
                        const newSort = html.match(/data-sort="([^"]+)"/); // можно проще - взять из текущих параметров
                        // Но проще: после обновления мы снова сохраняем sort из данных, которые использовали
                        $('#table-container').data('sort', sortField);
                        $('#table-container').data('direction', sortDirection);
                    },
                    error: function() {
                        alert('Ошибка при загрузке данных');
                    },
                    complete: function() {
                        $('.loader').remove();
                    }
                });
            }


            // Обработка клика по заголовкам таблицы (сортировка)
            $(document).on('click', '#equipment-table th[data-sort]', function() {
                const sortField = $(this).data('sort');
                // Определяем текущее направление
                let direction = 'asc';
                const currentSort = $('#table-container').data('sort');
                const currentDir = $('#table-container').data('direction');
                if (currentSort === sortField) {
                    direction = currentDir === 'asc' ? 'desc' : 'asc';
                }
                // Сохраняем новые параметры сортировки в контейнере
                $('#table-container').data('sort', sortField);
                $('#table-container').data('direction', direction);
                // Выполняем запрос
                fetchClients();
            });

            
            // Инициализация – сохраняем начальную сортировку
            // Если нужно, можно установить из данных, пришедших с сервера
            $('#table-container').data('sort', 'eq_id');
            $('#table-container').data('direction', 'asc');
        });
    </script>

    @endif



    



</body>
</html>