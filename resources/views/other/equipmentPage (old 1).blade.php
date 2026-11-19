<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="../css/flexstyles.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/darkTheme.css">
    <link class="settingsCssLink1" rel="stylesheet" href="">
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
 


                                {{-- <div class="admin-btn handbook-header-nav-btn-block nav-btn fl-align" data-popup-type="interface">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/dashboard-interface.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-hvb-text">Справочник</p>
                                    </div>
                                </div>  --}}

                                {{-- <div class="admin-btn handbook-header-nav-btn-block nav-btn  fl-align" data-popup-type="interface">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/dashboard-interface.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-hvb-text">упр. данными сотрадников
                                        </p>
                                    </div>
                                </div> --}}

                                <a href="{{ route('adminPage') }}" class="nav-btn handbook-header-nav-btn-block-2 hhnb-user-btn fl-align">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/dashboard-interface.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hnbb-text">Справочник</p>
                                        </div>
                                    </a>

                                <div class="fs-popup-window-btn admin-btn handbook-header-nav-btn-block nav-btn  fl-align" data-popup-type="import_1c">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/import (1).png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                    <div class="handbook-hvb-text-block">
                                        <p class="nav-btn-text handbook-hvb-text">Импорт 1с</p>
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

                                    <a href="{{route('logout')}}" class="nav-btn handbook-header-nav-btn-block-2 hhnb-user-btn fl-align">
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
                                
                                <div class="nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/folder.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                </div> 

                                <div class="fs-popup-window-btn nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align" data-popup-type="getPopupparametersEquipment">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/folder.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                </div>

                                <div class="nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align">
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/folder.png" alt="" class="handbook-hvb-icon img">
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

                                    {{-- popup btns --}}
                                    {{-- Кнопка с всплывающим окном, поэтому имеет класс '.fs-popup-window-btn' --}}
                                    <div class="fs-popup-window-btn eq-add-btn nav-btn-add-client nav-btn  fl-align" data-popup-type="equipment_add">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/folder (1).png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">
                                                Добавить ед.тех
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Динамические кнопки для редактирования на странице --}}
                                    {{-- Кнопки для редактирования на странице, поэтому имеют класс '.admin-dynamic-edit-btn' 
                                    и имеют параметр data-edit-type="equipment_edit" для определения типа редактирования (изменить или удалить) --}}
                                    <div class="admin-dynamic-edit-btn eq-edit-btn nav-btn-change-info-client nav-btn  fl-align" data-edit-type="equipment_edit">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/folder (1).png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">
                                                Ред ед.тех
                                            </p>
                                        </div>
                                    </div>

                                    <div class="admin-dynamic-edit-btn eq-delete-btn nav-btn-delete-client nav-btn  fl-align" data-edit-type="equipment_delete">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/folder (1).png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">
                                                Удалить ед.тех
                                            </p>
                                        </div>
                                    </div>

                                    

                                    <div class="nav-btn-group" data-group-name="equipmentActions">
                                        <div class="fs-popup-window-btn  nav-btn-action-client nav-btn  fl-align" data-popup-type="getPopupActionsForEquipment">
                                            <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                                <img src="../sources/media/icons/folder (1).png" alt="" class="handbook-hvb-icon img">
                                            </div>
                                            <div class="handbook-hvb-text-block">
                                                <p class="nav-btn-text handbook-hvb-text">
                                                    Действие с ед.тех
                                                </p>
                                            </div>
                                        </div>
                                        <div class="nav-btn-list-container fl-align">
                                            {{-- <div class="nav-btn-list-block handbook-header-nav-btn block fl-align fl-col">
                                                <div class="nb-list-btn nav-btn-list-row block fl-row">
                                                    <div class="nb-list-icon">
                                                        <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                                                    </div>
                                                    <div class="nb-list-text-block">
                                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">Выдать</p>
                                                    </div>
                                                </div>

                                                <div class="nb-list-btn nav-btn-list-row block fl-row">
                                                    <div class="nb-list-icon">
                                                        <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                                                    </div>
                                                    <div class="nb-list-text-block">
                                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">Сдать</p>
                                                    </div>
                                                </div>

                                                <div class="nb-list-btn nav-btn-list-row block fl-row">
                                                    <div class="nb-list-icon">
                                                        <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                                                    </div>
                                                    <div class="nb-list-text-block">
                                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">Переписать</p>
                                                    </div>
                                                </div>

                                                <div class="nb-list-btn nav-btn-list-row block fl-row">
                                                    <div class="nb-list-icon">
                                                        <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                                                    </div>
                                                    <div class="nb-list-text-block">
                                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">Списать</p>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div> 


                                    <div class="nav-btn-group nbg-closed" data-group-name="equipmentFilter">
                                        <div class="nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align">
                                            <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                                <img src="../sources/media/icons/filter.png" alt="" class="handbook-hvb-icon img">
                                            </div>
                                        </div>
                                        <div class="nav-btn-list-container nbg-container-closed fl-align">  
                                            <div class="nav-btn-list-block handbook-header-nav-btn block fl-align fl-col">
                                                <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="allStatuses">
                                                    <div class="nb-list-icon">
                                                        <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                                                    </div>
                                                    <div class="nb-list-text-block">
                                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">Все статусы</p>
                                                    </div>
                                                </div>

                                                <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="onSklad">
                                                    <div class="nb-list-icon">
                                                        <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                                                    </div>
                                                    <div class="nb-list-text-block">
                                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">На складе</p>
                                                    </div>
                                                </div>

                                                <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="vidan">
                                                    <div class="nb-list-icon">
                                                        <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                                                    </div>
                                                    <div class="nb-list-text-block">
                                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">Выдан</p>
                                                    </div>
                                                </div>

                                                <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="spisan">
                                                    <div class="nb-list-icon">
                                                        <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                                                    </div>
                                                    <div class="nb-list-text-block">
                                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">Списан</p>
                                                    </div>
                                                </div>
                                            </div>
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
                                                            <input type="number" min="12" max="22" value="16" name="" id="" class="nbl-text-input nb-lt-integer-i input form-input" style="padding-top: 0px; padding-bottom: 0px;">
                                                            {{-- <div class="arrow-buttons">
                                                                <!-- Up Arrow (Increment) -->
                                                                <button type="button" onclick="document.getElementById('myNumber').stepUp()">▲</button>
                                                                <!-- Down Arrow (Decrement) -->
                                                                <button type="button" onclick="document.getElementById('myNumber').stepDown()">▼</button>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                            </div>
                                        </div>
                                    </div> 


                                    {{-- <div class="fs-popup-window-btn nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align" data-popup-type="getPopupparametersEquipment">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/excel.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                    </div>  --}}

                                </div>

                            </div>

                        </div>
                        
                        {{-- таблица пользователей --}}
                        <div class="handbook-body-right-main-data-panel-section fl-align fl-col fl-start">
                            <div class="handbook-body-right-main-data-panel-section-header block fl-align fl-start">
                                <div class="handbook-body-right-mdps-header-text-block fl-row">
                                    <p class="handbook-body-right-mdps-header-text">Бухгалтерия</p>
                                </div>
                                <div class="handbook-body-right-mdps-header-filter-block">
                                    <div class="handbook-br-mdps-h-filter-group block fl-sp-btw fl-wrap" style="gap: 10px;">
            
                                        {{-- место для фильтролв --}}
                                        <div class="handbook-br-mdps-h-filter-group-items block fl-sp-btw fl-wrap" style="gap: 8x;">
                                            {{-- Фильтр по статусу --}}
                                            <select id="filter-status" class="input handbook-br-mdps-hfg-item handbook-br-mdps-hfg-input">
                                                <option value="">Все статусы</option>
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status->eqs_id }}">{{ $status->eqs_name }}</option>
                                                @endforeach
                                            </select>

                                            {{-- Фильтр по типу --}}
                                            <select id="filter-type" class="input handbook-br-mdps-hfg-item handbook-br-mdps-hfg-input">
                                                <option value="">Все типы</option>
                                                @foreach($types as $type)
                                                    <option value="{{ $type->eqt_id }}">{{ $type->eqt_name }}</option>
                                                @endforeach
                                            </select>

                                            {{-- Чекбоксы --}}
                                            <label class="handbook-br-mdps-hfg-item handbook-br-mdps-hfg-text">
                                                <input type="checkbox" id="filter-without-division"> Без подразделения
                                            </label>
                                            <label class="handbook-br-mdps-hfg-item handbook-br-mdps-hfg-text">
                                                <input type="checkbox" id="filter-without-responsible"> Без ответственного
                                            </label>
                                            <label class="handbook-br-mdps-hfg-item handbook-br-mdps-hfg-text">
                                                <input type="checkbox" id="filter-without-both"> Без подрраздел. и ответств.
                                            </label>

                                            {{-- Кнопка сброса (опционально) --}}
                                            <button id="reset-filters" class="button handbook-br-mdps-hfg-btn btn-sm btn-secondary">Сбросить</button>
                                        </div>

                                        
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="handbook-body-right-main-data-panel-section-inner fl-align fl-col">
                                <div class="handbook-body-right-main-data-panel-block block fl-align">
                                    
                                    <div class="handbook-body-right-main-data-panel-table-container block fl-align">
                                        <div id="table-container" class="handbook-body-right-main-data-panel-t-content example-subsub-block-content example-subsub-bc-with-settings-block block-content">
                                                    {{-- Контейнер для таблицы (сюда будем подгружать HTML) --}}
                                            @include('components/data_panel/data_equipment' , ['equipments' => $Equipments])
                                            
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
                                        @include('components/data_user_note/data_equipment_note' , ['eq_id' => $Equipments[0], 'user' => $user, 'equipmentJournal' => $equipmentJournal])
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

        // $('.input-file input[type=file]').on('change', function(){
        //     let file = this.files[0];
        //     $(this).closest('.input-file').find('.input-file-text').html(file.name);
        //     // document.querySelector('.input-file-text') = document.querySelector('.load-prev').files[0].name;
        // }); 
    </script>

    {{-- вывод подотделов и подподотделов в списке отделов --}}
    <script src="../js/departament-subs.js"></script>


    <script>

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

            EquipmentInfo(eqId, eqName);
            
        });

        // });
    </script>


    <script src="../js/keysets-navigation.js"></script>

    

    <script>
        groupNavBtnListOpened = false;

        function getPopupWindow(popupName, popupMode = "default") {
            console.log('вывожу окно');
            if (popupName === 'import_1c') {
                console.log('вывожу окно ', popupName);

                
                fetch(`{{ route('getPopup1Сimport') }}`)
                    .then(res => res.text())
                    .then(html => {
                        document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
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
            else if (popupName === 'registration') {
                fetch(`{{ route('registerForm') }}`)
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
                window.popupAPI.close();
                if (groupNavBtnListOpened === false) {
                    equipmentActionsBlockGroup = document.querySelector('.nav-btn-group[data-group-name="equipmentActions"]');

                    if (equipmentActionsBlockGroup.classList.contains('nbg-opened')) {
                        equipmentActionsBlockGroup.querySelector('.nav-btn-list-container').innerHTML = '';
                        equipmentActionsBlockGroup.classList.remove('nbg-opened');
                    }
                    else {
                        equipmentActionsBlockGroup.classList.add('nbg-opened');
                        equipmentActionsBlockGroup.querySelector('.nav-btn-list-container').innerHTML = `
                            <div class="nav-btn-list-block handbook-header-nav-btn block fl-align fl-col">
                                <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="give">
                                    <div class="nb-list-icon">
                                        <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                                    </div>
                                    <div class="nb-list-text-block">
                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">Выдать</p>
                                    </div>
                                </div>

                                <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="pass_off">
                                    <div class="nb-list-icon">
                                        <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                                    </div>
                                    <div class="nb-list-text-block">
                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">Сдать</p>
                                    </div>
                                </div>

                                <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="rewrite">
                                    <div class="nb-list-icon">
                                        <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                                    </div>
                                    <div class="nb-list-text-block">
                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">Переписать</p>
                                    </div>
                                </div>

                                <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="write_off">
                                    <div class="nb-list-icon">
                                        <img src="../sources/media/icons/folder (1).png" alt="" class="nb-list-icon-img img">
                                    </div>
                                    <div class="nb-list-text-block">
                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">Списать</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    }

                    document.querySelectorAll('.nb-list-btn').forEach(nbListBtn => {
                        nbListBtn.addEventListener('click', () => {
                            console.log(nbListBtn.dataset.listName)
                            $url = `/PopupActionEquipment?popup_type=${nbListBtn.dataset.listName}`;
                            fetch($url)
                            .then(res => res.text())
                            .then(html => {
                                if (nbListBtn.dataset.listName === 'give' || nbListBtn.dataset.listName === 'rewrite'){
                                    document.querySelector('.fl-popup-window-block').classList.add("fl-pwb-wide-mode");
                                }
                                
                                document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Переписать технику на др. сотрудника";
                                document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
                                console.log(`окно ${popupName} выведено успешно`);
                                getEqActionSettings(nbListBtn.dataset.listName);
                                window.popupAPI.open();
                            })
                            .catch(() => {
                                console.log(`Ошибка загрузки ${popupName} окошка`);
                            });
                        });
                    });
                } else {

                }
                

                // fetch(`{{ route('getPopupActionEquipment') }}`)
                // .then(res => res.text())
                // .then(html => {
                //     document.querySelector('.fl-popup-window-block').classList.add("fl-pwb-wide-mode");
                //     document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Переписать технику на др. сотрудника";
                //     document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
                //     console.log(`окно ${popupName} выведено успешно`);
                //     getEqActionSettings(nbListBtn.dataset.listName);
                // })
                // .catch(() => {
                //     console.log(`Ошибка загрузки ${popupName} окошка`);
                // });
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



    <script>
        btnListBlockGroupOpened = false;

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
                        })

                        // Добавляем тег в секцию head документа
                        document.head.appendChild(newCsslink);

                    }
                });
            });

            // <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="fontsWidth">

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
    </script>






    {{-- скрипт работы кнопок управления данными техники (удаление, редактирование) для страницы учета техники --}}
    {{-- скрипт добавления единицы техники находится выше, в скрипте отображения разных окон в popup--}}
    <script>

        // инициализируем необходимые флаги и глобальные переменные для корректной работы скрипта
        let eqManagementModeEnabled = false; // режим "редактирование техники" по умолчанию выключен
        let eqManagementModeEnabledName = null; //название активного режима редактирования

        let eqMMInputEditingEnabled = false; // флажок для изменения редактируемой информации в инпут

        // функция входа в режим "редактирования техники". применяет стили, активирует листенеры кнопок и их функции
        function EnterToEquipmentManagementMode(editType) {
            if (editType === "equipment_delete" && !eqManagementModeEnabled && eqManagementModeEnabledName === null){
                // активируем флажки о начале работы в режиме
                eqManagementModeEnabled = true;
                eqManagementModeEnabledName = editType;
                 // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
                // применение стилей делаем через функцию если мод еще не включен
                useCssStylesToSite(editType, false);
                equipmentManagementFetchActions(editType, eqMMInputEditingEnabled);
                
            } 
            else if (editType === "equipment_edit" && !eqManagementModeEnabled && eqManagementModeEnabledName === null) {
                eqManagementModeEnabled = true;
                eqManagementModeEnabledName = editType;
                 // применяем стили к таблице учета техники чтобы можно было понять что мы в зашли в режим
                // применение стилей делаем через функцию если мод еще не включен
                useCssStylesToSite(editType, false);
                equipmentManagementFetchActions(editType, eqMMInputEditingEnabled);
            }
            else {
                useCssStylesToSite(editType, eqManagementModeEnabled)
            }
        }

        // применение стилей к таблице в зависимости от мода
        function useCssStylesToSite(editType, used){
            if (used === false) { // стили не пременены тогда выполняем условие
                if (editType === "equipment_delete"){

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
                        EnterToEquipmentManagementMode(editType);
                    });
                }
                if (editType === "equipment_edit") {
                    document.querySelector('.handbook-body-right-main-data-panel-section').classList.add('brm-dp-secton-edit-mode');
                    document.querySelector('.handbook-body-right-main-data-panel-section-header').classList.add('brm-dp-header-edit-mode');

                    eqModeLabel = document.createElement('div');
                    eqModeLabel.classList.add('nav-btn-text', 'hb-mode-label', 'fl-align');
                    eqModeLabel.textContent = "Режим изменения";
                    document.querySelector('.handbook-body-right-mdps-header-text-block').append(eqModeLabel);

                    document.querySelector("thead tr").classList.add('table-tr-header-edit-mode');

                    document.querySelectorAll('.table-row').forEach(tableRow => {
                        tableRow.classList.add('table-tr-delete-mode')
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
                        EnterToEquipmentManagementMode(editType);
                    });
                }
            }
            else {
                // удаляем все флажки для дальнейшей повторной работы
                eqManagementModeEnabled = false;
                eqManagementModeEnabledName = null;
                // выходим из режима редактирования в зависимости от его типа
                if (editType === "equipment_delete") {
                    document.querySelector('.handbook-body-right-main-data-panel-section').classList.remove('brm-dp-secton-delete-mode');
                    document.querySelector('.handbook-body-right-main-data-panel-section-header').classList.remove('brm-dp-header-delete-mode');

                    document.querySelector('.nav-btn-text.hb-mode-label.fl-align').remove();

                    document.querySelector("thead tr").classList.remove('table-tr-header-delete-mode');

                    document.querySelectorAll('.table-row').forEach(tableRow => {
                        tableRow.classList.remove('table-tr-delete-mode')
                    });

                    document.querySelector('.quit-from-mode-btn-block').remove();
                } else if (editType === "equipment_edit") {
                    document.querySelector('.handbook-body-right-main-data-panel-section').classList.remove('brm-dp-secton-edit-mode');
                    document.querySelector('.handbook-body-right-main-data-panel-section-header').classList.remove('brm-dp-header-edit-mode');

                    document.querySelector('.nav-btn-text.hb-mode-label.fl-align').remove();

                    document.querySelector("thead tr").classList.remove('table-tr-header-edit-mode');

                    document.querySelectorAll('.table-row').forEach(tableRow => {
                        tableRow.classList.remove('table-tr-delete-mode')
                    });

                    document.querySelector('.quit-from-mode-btn-block').remove();
                }
                  
            }
            
               
        }

        // .table-tr-delete-mode .fs-table-row'
        // функционал режима редактирований
        function equipmentManagementFetchActions(editType, inputEditEnabled) {
            if  (editType === "equipment_edit" && eqManagementModeEnabled && eqManagementModeEnabledName === editType && inputEditEnabled === false) {
                document.querySelectorAll('.table-tr-delete-mode').forEach(tableEditingRowLine => {

                    
                    
                    tableEditingRowLine.addEventListener('dblclick', (e) => {

                        tableEditingRowLine = e.target.closest('.table-tr-delete-mode');
                        console.log(tableEditingRowLine);
                        tableEditingRowLine.querySelectorAll('.fs-table-row').forEach((tableEdRowData, tRowId) => {
                            if (tRowId === 0){
                                tableEdRowData.setAttribute('data-name', 'eq_status_id')
                            } else if (tRowId === 1){
                                tableEdRowData.setAttribute('data-name', 'eq_type_id')
                            } else if (tRowId === 2){
                                tableEdRowData.setAttribute('data-name', 'eq_name')
                            } else if (tRowId === 3){
                                tableEdRowData.setAttribute('data-name', 'eq_serial_number')
                            } else if (tRowId === 4){
                                tableEdRowData.setAttribute('data-name', 'eq_inventory_number')
                            } else if (tRowId === 5){
                                tableEdRowData.setAttribute('data-name', 'eq_cart_number')
                            } else if (tRowId === 6) {
                                tableEdRowData.setAttribute('data-name', 'eq_comment')
                            } else {
                                tableEdRowData.setAttribute('data-name', 'import_div')
                            }
                        });

                        tableEditingRow = e.target.closest('.fs-table-row');
                        // изменяем элемент на инпут
                        let inputER = document.createElement('input');
                        inputER.innerHTML = tableEditingRow.innerHTML;
                        for (let attr of tableEditingRow.attributes) {
                            inputER.setAttribute(attr.name, attr.value);
                        }
                        inputER.setAttribute('value', tableEditingRow.innerHTML.trim());
                        tableEditingRow.replaceWith(inputER);
                        inputER.classList.add('input-edit', 'input');

                        // сохраняем значения
                        
                        // console.log(inputER.dataset.name);
                        console.log('tableEditingRow', tableEditingRow);
                        console.log('tableEditingRow id', tableEditingRow.dataset.id);


                        // выход
                        inputER.addEventListener('keydown', (e) => {
                            // сохраняем значения
                            const key = e.key;
                            const isEnter = (key === 'Enter');
                            newinputValue = inputER.value;

                            console.log('inputER', inputER);

                            eqDivId = tableEditingRowLine.dataset.id;
                            eqName = inputER.dataset.name;
                            eqData = newinputValue;

                            console.log(eqDivId, eqName, eqData);

                            
                            if (isEnter) {
                                // отправляем запрос 
                                
                                fetch(`/EditEquipment?eq_div_id=${eqDivId}&eq_col_name=${eqName}&eq_data=${eqData}`, {
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
                                        // e.target.closest('.table-row').remove();
                                        
                                    }
                                })
                                .catch(error => {
                                    console.error('Ошибка поиска:', error);
                                });


                                // ввостанавливаем прошлый элемент
                                oldER = document.createElement('td');
                                oldER.innerHTML = inputER.value;

                                for (let attr of inputER.attributes) {
                                    oldER.setAttribute(attr.name, attr.value);
                                }
                                oldER.classList.remove('input-edit');
                                oldER.classList.remove('input');

                                inputER.replaceWith(oldER);

                            }
                        });


                    });
                });
            
            }
            else if (editType === "equipment_delete" && eqManagementModeEnabled && eqManagementModeEnabledName === editType && inputEditEnabled === false) {
                document.querySelectorAll('.table-tr-delete-mode').forEach(tableEditingRow => {
                    tableEditingRow.addEventListener('dblclick', () => {
                        if ( eqManagementModeEnabled && eqManagementModeEnabledName !== null){
                            // получаем значения удаляемой записи
                            eqDivId = parseInt(tableEditingRow.dataset.id);
                            
                            tableEditingRow.classList.add('fs-popup-window-btn');
                            document.querySelectorAll('.fs-popup-window-btn');
                            // выводим окошко с вопросом о удалении
                            getPopupMessage('delete', [eqDivId, tableEditingRow]);

                            console.log('Удаляю элемент с id=', eqDivId)
                        }
                        

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
            fetch(`/PopupMessage?eq_div_id=${messageData[0]}&message_type=${messageType}`)
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
                EnterToEquipmentManagementMode(adminDEBtn.dataset.editType)
            });
        });





        

        


        
    </script>




    {{-- ПОИСК --}}
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
            function searchEquipment(query, equipmentId) {
                const url = new URL('/searchEquipment', window.location.origin);
                url.searchParams.append('query', query || '');
                
                if (equipmentId) {
                    url.searchParams.append('eq_div_id', equipmentId);
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
                        } else if (equipmentId) {
                            // headerTitle.textContent = `Фильтр по отделу (${data.count})`;
                        } else {
                            headerTitle.textContent = 'Вся техника';
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
                        searchTimeout = setTimeout(() => searchEquipment('', null), 200);
                    }
                    return;
                }
                
                searchTimeout = setTimeout(() => searchEquipment(query, currentDepartmentId), 300);
            });

            // Обработка нажатия Enter
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    searchEquipment(this.value.trim(), currentDepartmentId);
                }
            });

            // Функция для обновления фильтра по отделу (вызывается при клике на папку)
            window.setDepartmentFilter = function(departmentId) {
                currentDepartmentId = departmentId;
                const query = searchInput.value.trim();
                
                // Если есть запрос - ищем с учетом отдела
                if (query.length >= 2) {
                    searchEquipment(query, departmentId);
                } else {
                    // Иначе показываем сотрудников отдела
                    searchEquipment('', departmentId);
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
                    let eqId = document.querySelector('.client-name-row').dataset.id;
                    let eqName = document.querySelector('.client-name-row').innerHTML;

                    EquipmentInfo(eqId, eqName)
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

            console.log('✅ Поисковик инициализирован');
        })();
    </script>





    <script src="{{ asset('js/action-popup.js') }}"></script>




    <script>
        
        $(document).ready(function() {

            // Функция для отправки AJAX-запроса
            function fetchEquipment() {
                // Собираем параметры фильтрации
                const status = $('#filter-status').val();
                const type = $('#filter-type').val();
                const withoutDivision = $('#filter-without-division').is(':checked') ? 1 : 0;
                const withoutResponsible = $('#filter-without-responsible').is(':checked') ? 1 : 0;
                const withoutBoth = $('#filter-without-both').is(':checked') ? 1 : 0;

                // Параметры сортировки (храним в data-атрибутах на таблице или в скрытых полях)
                const sortField = $('#table-container').data('sort') || 'eq_id';
                const sortDirection = $('#table-container').data('direction') || 'asc';

                // Собираем данные для GET-запроса
                const params = {
                    status: status,
                    type: type,
                    without_division: withoutDivision,
                    without_responsible: withoutResponsible,
                    without_both: withoutBoth,
                    sort: sortField,
                    direction: sortDirection
                };

                // Показываем индикатор загрузки (опционально)
                $('#table-container').append('<div class="loader">Загрузка...</div>');

                // AJAX-запрос
                $.ajax({
                    url: '{{ route("equipment.filter") }}',
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

            // События изменения фильтров (селекторы, чекбоксы)
            $('#filter-status, #filter-type, #filter-without-division, #filter-without-responsible, #filter-without-both').on('change', function() {
                fetchEquipment();
            });

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
                fetchEquipment();
            });

            // Сброс фильтров
            $('#reset-filters').on('click', function() {
                $('#filter-status').val('');
                $('#filter-type').val('');
                $('#filter-without-division').prop('checked', false);
                $('#filter-without-responsible').prop('checked', false);
                $('#filter-without-both').prop('checked', false);
                // Сброс сортировки (опционально)
                $('#table-container').data('sort', 'eq_id');
                $('#table-container').data('direction', 'asc');
                fetchEquipment();
            });

            // Инициализация – сохраняем начальную сортировку
            // Если нужно, можно установить из данных, пришедших с сервера
            $('#table-container').data('sort', 'eq_id');
            $('#table-container').data('direction', 'asc');
        });
    </script>
    
    



  
</body>
</html>