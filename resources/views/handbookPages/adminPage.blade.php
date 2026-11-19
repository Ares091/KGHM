<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="../css/flexstyles.css">
    <link rel="stylesheet" href="../css/style.css?v=1.5.1">
    <link rel="stylesheet" href="../css/darkTheme.css">
    <link class="settingsCssLink1" rel="stylesheet" href="">
    <link class="settingsCssLink2" rel="stylesheet" href="">
    {{-- <link class="settingsCssLink2" rel="stylesheet" href="../css/settings/compactDesign.css"> --}}

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
                                            <img src="../sources/media/icons/eq_page.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">Учёт техники</p>
                                        </div>
                                    </a> 

                                    <a href="{{ route('documentsPage') }}" class="admin-btn nav-btn-change-info-client nav-btn fl-align" data-popup-type="interface"> 
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/documents_64.png" alt="" class="handbook-hvb-icon img">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path style="fill:#F5F0EB;" d="M445.984,122.161v333.362c0,31.143-25.334,56.477-56.467,56.477H122.48 c-31.133,0-56.467-25.334-56.467-56.477V56.477C66.014,25.334,91.348,0,122.48,0h201.353c0.39,0,0.79,0,1.18,0.02 c14.647,0.29,28.363,6.139,38.751,16.526l65.685,65.685C440.116,92.888,445.984,107.075,445.984,122.161z"/><path style="fill:#DCD2CD;" d="M445.984,122.161v333.362c0,31.143-25.334,56.477-56.467,56.477H255.999V0h67.834 c0.39,0,0.79,0,1.18,0.02c14.647,0.29,28.363,6.139,38.751,16.526l65.685,65.685C440.116,92.888,445.984,107.075,445.984,122.161z"/><path style="fill:#C8BEB9;" d="M445.984,122.161v1.81h-87.619c-18.396,0-33.352-14.956-33.352-33.342V0.02 c14.647,0.29,28.363,6.139,38.751,16.526l65.685,65.685C440.116,92.888,445.984,107.075,445.984,122.161z"/><path style="fill:#FFB64C;" d="M485.826,278.395v125.861c0,20.895-16.996,37.891-37.891,37.891H64.065 c-20.895,0-37.891-16.996-37.891-37.891V278.395c0-20.895,16.996-37.891,37.891-37.891h383.87 C468.83,240.504,485.826,257.5,485.826,278.395z"/><path style="fill:#FF9100;" d="M485.826,278.395v125.861c0,20.895-16.996,37.891-37.891,37.891H256V240.504h191.935 C468.83,240.504,485.826,257.5,485.826,278.395z"/><g><path style="fill:#FFFFFF;" d="M193.745,293.861c-6.888-5.859-16.076-8.788-27.584-8.788h-27.274c-3.089,0-5.609,0.72-7.558,2.159 s-2.919,3.139-2.919,5.089v98.157c0,1.96,0.97,3.649,2.919,5.089s4.469,2.16,7.558,2.16h27.274c11.507,0,20.695-2.929,27.584-8.788 c6.878-5.859,10.328-15.046,10.328-27.584v-39.911C204.072,308.908,200.623,299.72,193.745,293.861z M180.028,361.355 c0,10.278-4.619,15.406-13.867,15.406h-13.717v-70.723h13.717c9.248,0,13.867,5.139,13.867,15.406V361.355z"/><path style="fill:#FFFFFF;" d="M283.434,293.861c-6.858-5.829-16.006-8.758-27.434-8.788h-0.15 c-11.407,0-20.555,2.929-27.434,8.788c-6.888,5.859-10.328,15.046-10.328,27.584v40.84c0,12.527,3.439,21.725,10.328,27.584 c6.878,5.849,16.026,8.778,27.434,8.778H256c11.427-0.03,20.575-2.959,27.434-8.778c6.878-5.859,10.318-15.056,10.318-27.584 v-40.84C293.751,308.908,290.312,299.72,283.434,293.861z M269.717,362.285c0,10.208-4.579,15.346-13.717,15.406h-0.15 c-9.148,0-13.717-5.139-13.717-15.406v-40.84c0-10.268,4.569-15.406,13.717-15.406H256c9.138,0.06,13.717,5.199,13.717,15.406 V362.285z"/></g><g><path style="fill:#F5F0EB;" d="M371.423,355.037c-7.508,0-11.457,2.419-11.867,7.248c-0.21,2.149-0.44,3.849-0.7,5.079 c-0.25,1.24-0.79,2.799-1.61,4.699c-0.83,1.91-2.189,3.319-4.089,4.239c-1.9,0.93-4.289,1.39-7.168,1.39 c-9.348,0-14.017-5.139-14.017-15.406v-40.84c0-10.268,4.619-15.406,13.867-15.406c8.838,0,13.407,4.619,13.717,13.867 c0.31,4.829,4.309,7.238,12.017,7.238c4.319,0,7.398-0.79,9.248-2.389c1.85-1.59,2.769-4.589,2.769-9.008 c0-9.558-3.619-17.056-10.857-22.505c-7.248-5.439-16.516-8.168-27.823-8.168c-10.987,0-19.905,2.929-26.734,8.788 c-6.828,5.859-10.248,15.046-10.248,27.584v40.84c0,12.527,3.419,21.725,10.248,27.584c6.828,5.849,15.746,8.778,26.734,8.778 c11.307,0,20.575-2.869,27.823-8.628c7.238-5.749,10.857-13.607,10.857-23.574c0-4.419-0.92-7.428-2.769-9.018 C378.971,355.837,375.832,355.037,371.423,355.037z"/><path style="fill:#F5F0EB;" d="M293.751,321.445v40.84c0,12.527-3.439,21.725-10.318,27.584 c-6.858,5.819-16.006,8.748-27.434,8.778v-20.955c9.138-0.06,13.717-5.199,13.717-15.406v-40.84 c0-10.208-4.579-15.346-13.717-15.406v-20.965c11.427,0.03,20.575,2.959,27.434,8.788 C290.312,299.72,293.751,308.908,293.751,321.445z"/></g></svg> --}}
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">Документы поступления</p>
                                        </div>
                                    </a> 

                                    {{-- <a href="{{ route('requestsPage') }}" class="admin-btn nav-btn-change-info-client nav-btn fl-align" data-popup-type="interface"> 
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/user2.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">Заявки</p>
                                        </div>
                                    </a>  --}}

                                    

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


                                            <div class="nav-btn-list-block-category nav-btn-list-bc-row block fl-align fl-col">
                                                <div class="nav-btn-list-block-category-header block">
                                                    <div class="nav-btn-list-block-category-header-text handbook-hvb-text">
                                                        Общее
                                                    </div>
                                                </div>
                                                <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="clearSettings">
                                                    <div class="nb-list-icon">
                                                        <img src="../sources/media/icons/delete-user.png" alt="" class="nb-list-icon-img img">
                                                    </div>
                                                    <div class="nb-list-text-block">
                                                        <p class="nb-list-text nav-btn-text handbook-hvb-text">Сбросить настройки</p>
                                                    </div>
                                                </div>
                                            </div>

                                            

                                        </div>
                                    </div>
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
                                        <p class="nav-btn-text handbook-header-text">КХМ Справочник</p>
                                    </div>
                                </div> 



                                @if ($user && $user->u_role !=='user')
                                    <div class="fs-popup-window-btn admin-btn handbook-header-nav-btn-block nav-btn  fl-align" data-popup-type="user_add">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            <img src="../sources/media/icons/add-user.png" alt="" class="handbook-hvb-icon img">
                                        </div>
                                        <div class="handbook-hvb-text-block">
                                            <p class="nav-btn-text handbook-hvb-text">Создать пользователя</p>
                                        </div>
                                    </div>

                                    <div class="fs-popup-window-btn nav-btn handbook-header-nav-btn-block-2 hhnb-user-btn fl-align" data-popup-type="user_info">
                                        <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                            {{-- <img src="../sources/media/icons/pass2.png" alt="" class="handbook-hvb-icon img"> --}}
                                            <svg style="width: var(--nav-btn-1-width); height: var(--nav-btn-1-height);" xmlns="http://www.w3.org/2000/svg" viewBox="155.492 51.758 256.033 223.894" width="256.033px" height="223.894px"><g id="object-0"><rect x="155.492" y="83.317" width="256.033" height="192.335" rx="30.293" ry="30.293" style="fill: rgb(236, 239, 241);"/><path d="M 185.785 83.317 L 283.098 83.317 L 283.391 113.61 L 283.391 245.359 L 283.098 275.652 L 185.785 275.652 C 169.055 275.652 155.492 262.089 155.492 245.359 L 155.492 113.61 C 155.492 96.88 169.055 83.317 185.785 83.317 Z" style="fill: rgb(207, 216, 220);"/><g style=""><g style="visibility: visible;"><rect x="304.747" y="131.638" width="74.859" height="16.087" rx="8.043" ry="8.043" style="fill: rgb(96, 125, 139);"/><path d="M 312.79 131.638 L 337.757 131.638 L 345.8 131.681 L 345.8 147.682 L 337.757 147.725 L 312.79 147.725 C 308.348 147.725 304.747 144.124 304.747 139.682 L 304.747 139.681 C 304.747 135.239 308.348 131.638 312.79 131.638 Z" style="fill: rgb(84, 109, 121);"/></g><g transform="matrix(1, 0, 0, 1, 0, 43)" style="visibility: visible;"><rect x="304.747" y="131.638" width="74.859" height="16.087" rx="8.043" ry="8.043" style="fill: rgb(96, 125, 139);"/><path d="M 312.79 131.638 L 337.757 131.638 L 345.8 131.681 L 345.8 147.682 L 337.757 147.725 L 312.79 147.725 C 308.348 147.725 304.747 144.124 304.747 139.682 L 304.747 139.681 C 304.747 135.239 308.348 131.638 312.79 131.638 Z" style="fill: rgb(84, 109, 121);"/></g><g transform="matrix(1, 0, 0, 1, 0, 85)" style="visibility: visible;"><rect x="304.747" y="131.638" width="74.859" height="16.087" rx="8.043" ry="8.043" style="fill: rgb(96, 125, 139);"/><path d="M 312.79 131.638 L 337.757 131.638 L 345.8 131.681 L 345.8 147.682 L 337.757 147.725 L 312.79 147.725 C 308.348 147.725 304.747 144.124 304.747 139.682 L 304.747 139.681 C 304.747 135.239 308.348 131.638 312.79 131.638 Z" style="fill: rgb(84, 109, 121);"/></g></g><g style=""><path d="M 200.424 190.322 L 218.431 190.521 L 218.431 232.88 L 184.861 232.88 C 169.186 232.774 170.12 227.186 170.719 215.988 C 171.318 204.79 183.688 190.322 200.424 190.322 Z" style="fill: rgb(33, 150, 243);"/><path d="M 248.427 232.88 L 266.444 232.681 L 266.444 190.322 L 232.856 190.322 C 216.639 190.354 218.106 196.016 218.706 207.214 C 219.305 218.412 231.682 232.88 248.427 232.88 Z" style="fill: rgb(66, 165, 245); transform-box: fill-box; transform-origin: 50% 50%;" transform="matrix(-1, 0, 0, -1, 0.000029, -0.000018)"/><ellipse style="fill: rgb(33, 150, 243);" cx="218.527" cy="153.075" rx="26.806" ry="26.455"/><path d="M 245.333 153.075 C 245.333 167.686 233.332 179.53 218.527 179.53 C 218.478 179.53 218.429 179.53 218.38 179.53 L 218.38 126.621 C 218.429 126.621 218.478 126.621 218.527 126.621 C 233.332 126.621 245.333 138.465 245.333 153.076 L 245.333 153.075 Z" style="fill: rgb(66, 165, 245);"/></g><rect x="240.877" y="51.758" width="84.975" height="58.493" rx="18.433" ry="18.433" style="fill: rgb(96, 125, 139);"/><path d="M 259.31 51.758 L 282.936 51.758 L 283.354 110.251 L 264.936 110.251 L 259.31 110.251 C 249.13 110.251 240.877 101.998 240.877 91.818 L 240.877 70.191 C 240.877 60.011 249.13 51.758 259.31 51.758 Z" style="fill: rgb(84, 109, 121);"/></g></svg>
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
                                            <p class="nav-btn-text handbook-hnbb-text">Войти</p>
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

                                <div class="fs-popup-window-btn nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align" data-popup-type="division_edit_form" >
                                    <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                        <img src="../sources/media/icons/folder_edit.png" alt="" class="handbook-hvb-icon img">
                                    </div>
                                </div> 

                                <div class="fs-popup-window-btn admin-dynamic-edit-btn div-delete-btn nav-btn handbook-second-header-nav-btn-block hbsb-nav-btn fl-align" data-popup-type="division_delete_form">
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
                                        
                                        <div class="fs-popup-window-btn fs-popup-w-disabled admin-dynamic-edit-btn fs-pw-btn eq-edit-btn nav-btn-change-info-client-2 nav-btn  fl-align" data-popup-type="admin_edit_form">
                                            <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                                <img src="../sources/media/icons/edit-user-0.png" alt="" class="handbook-hvb-icon img">
                                            </div>
                                            <div class="handbook-hvb-text-block">
                                                <p class="nav-btn-text handbook-hvb-text">
                                                    Редактирование сотрудника
                                                </p>
                                            </div>
                                        </div>

                                        {{-- <div class="admin-dynamic-edit-btn eq-edit-btn nav-btn-change-info-client nav-btn  fl-align" data-edit-type="admin_edit">
                                            <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                                <img src="../sources/media/icons/edit-user-0.png" alt="" class="handbook-hvb-icon img">
                                            </div>
                                            <div class="handbook-hvb-text-block">
                                                <p class="nav-btn-text handbook-hvb-text">
                                                    Ред сотрудника (динам.)
                                                </p>
                                            </div>
                                        </div> 

                                        <div class="admin-dynamic-edit-btn fs-popup-w-disabled eq-delete-btn fs-pw-btn nav-btn-delete-client nav-btn  fl-align" data-edit-type="admin_delete">
                                            <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                                <img src="../sources/media/icons/delete-user.png" alt="" class="handbook-hvb-icon img">
                                            </div>
                                            <div class="handbook-hvb-text-block">
                                                <p class="nav-btn-text handbook-hvb-text">
                                                    Удалить сотрудника
                                                </p>
                                            </div>
                                        </div>--}}

                                        <div class="fs-popup-window-btn fs-popup-w-disabled eq-delete-btn admin-dynamic-edit-btn fs-pw-btn eq-delete-btn nav-btn-delete-client nav-btn  fl-align" data-popup-type="admin_delete_form">
                                            <div class="nav-btn-icon-block handbook-hvb-icon-block">
                                                <img src="../sources/media/icons/delete-user.png" alt="" class="handbook-hvb-icon img">
                                            </div>
                                            <div class="handbook-hvb-text-block">
                                                <p class="nav-btn-text handbook-hvb-text h-hvb-t-delete">
                                                    Удалить сотрудника
                                                </p>
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
                                           
                                            @include('components/data_panel/data_table' , ['clients' => $clients, "tableType" => "AdminTable", 'pageIsMain' => false ])
                                            
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>


                        {{-- информационная панель о пользователе --}}
                        <div class="handbook-body-right-section-note-data-block block">
                            <div class="handbook-body-right-main-data-panel-section-header block fl-align fl-start">
                                <div class="handbook-body-right-mdps-header-text-block">
                                    <!-- Бухгалтерия > Букреева Светлана Валерьевна -->
                                    <p class="handbook-body-right-nd-header-text">
                                        {{ $clients[0]->cli_name_view }}
                                    </p>
                                </div>
                            </div>
                            <div class="handbook-body-right-section-note-data-block-inner fl-align fl-col">
                                <div class="handbook-body-right-section-note-panel-block block fl-align">
                                    <div class="handbook-body-right-section-note-panel-content block-content fl-sp-btw fl-al-start">
                                        @include('components/data_user_note/data_user_note' , ['cli' => $clients[0], 'user' => $user, "tableType" => "AdminTable"])
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




    




    <script src="../js/flexsyles-anim.js?v=1.0.3"></script>
    <script src="../js/flexsyles-anim.js?v={{time()}}"></script>


    
    <script
        src="../js/jquery-3.7.1.min.js"
        integrity="sha256-PnUB0Vw2MOeRyLIDkuud7jGp9lzj793nbO9ccQFBqyQ="
        crossorigin="anonymous">
    </script>

    @if ($nonLogin)
        {{-- <div class="">Вы не зарегистрированы</div> --}}
        <script>
            window.popupAPI.open()


            function fetchPopupFormActions(popupName) {
                document.querySelector('.apply-form-btn').addEventListener('click', (e) => {
                    e.preventDefault();

                        if (popupName === 'autorization') {
                        data = {
                            'u_login':  document.querySelector('.form-input[id="u_login"]').value,
                            'u_password' : document.querySelector('.form-input[id="u_password"]').value,
                            'remember' : document.querySelector('input[name="remember"]').checked
                        };
                        
                        fetch(`/PopupLogin/loginDynamicValidation`, {
                            method: 'POST',
                            headers: {
                                // 'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                Accept: 'application/json',
                            },
                            body: new URLSearchParams(data),
                        })
                        .then(response => response.json())
                        .then(data => {
                            document.querySelectorAll('.form-valid-error').forEach(el => el.textContent = '');

                            if (data.success) {
                                console.log('Вы успешно вошли в систему');
                                window.popupAPI.close();
                                window.location.reload()
                            }

                            if (data.errors) {
                                for (const [field, messages] of Object.entries(data.errors)) {
                                    // span имеет id равный имени поля: login / password
                                    const el = document.querySelector(`.form-valid-error[data-field="${field}"]`);
                                    if (el) el.textContent = messages[0];
                                }
                                // alert('Вы не авторизованы. Введены неверные данные.')
                            }
                        })
                        .catch(() => {
                            console.log(`Ошибка отправки данных в окошке "${popupName}"`);
                        });
                    } 
                });
                
            }
            fetchPopupFormActions('autorization');
        </script>
    @else

    {{-- функционал подразделений в левой панели - вызов метода вывода сотрудников --}}
    <script src="{{ asset('js/departament-subs.js?v=1.0.5') }}"></script>

    {{-- скрипт вывода сотрудников в таблице по нажатию на подразделение --}}
    <script  src="{{ asset('js/get-clients-main-info.js?v=1.0.6') }}"> </script>

    {{-- вывод нижней панели о сотруднике--}}
    <script src="{{ asset('js/client-note-panel.js?v=1.0.7') }}"></script>

    {{-- скрипт поиска --}}
    <script src="{{ asset('js/search.js?v=1.0.6') }}"></script>

    {{-- скрипт мини иконок и т.д --}}
    <script src="../js/other-ui.js?v=1.0.5"></script>

    {{-- скрипт вывода всплывающего окна --}}
    {{-- @include('components.js.get-popup-window') --}}
    <script src="../js/get-popup-window.js?v=1.0.9"></script>

    <script src="../js/inner-popup.js?v=1.0.5"></script>

    <script src="../js/open-btn-lists.js?v=1.0.6"></script>

    <script src="../js/admin-cli-managment-mode.js?v=1.0.7"></script>

    <script src="../js/admin-div-managment-mode.js?v=1.0.7"></script>

    <script src="../js/keysets-navigation.js?v=1.0.8"></script>

    @endif



    



</body>
</html>