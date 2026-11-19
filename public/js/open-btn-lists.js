btnListBlockGroupOpened = false;
selectedFontSize = localStorage.getItem("fontsWidth");
let getBLBTimeout = null;

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

            if (nbListBtn.dataset.listName === "LightTheme") {

                if (localStorage.getItem("theme") !== 'LightTheme' && document.querySelector('.settingsCssDTL').getAttribute('href') !== "") {

                    Csslink = document.querySelector('.settingsCssDTL');
                    Csslink.href = "";
                    // used = true;
                    // // Добавляем тег в секцию head документа
                    document.head.appendChild(Csslink);
                    // saveBtnSetting(nbListBtn.dataset.listName);
                }
                // else {
                //     localStorage.setItem("theme", null);
                //     localStorage.removeItem("theme");
                //     console.log('local storage theme removed')

                //     Csslink = document.querySelector('.settingsCssDTL');
                //     Csslink.href = `../css/darkTheme.css`;
                // }
                

            }
            else if (nbListBtn.dataset.listName === "DarkTheme") {
               
                if (localStorage.getItem("theme") !=="DarkTheme" && document.querySelector('.settingsCssDTL').getAttribute('href') === "") {
                    
                    console.log('local storage theme removed')

                    Csslink = document.querySelector('.settingsCssDTL');
                    Csslink.href = `../css/darkTheme.css`;
                    
                }
                // else {
                //     Csslink = document.querySelector('.settingsCssDTL');
                //     Csslink.href = "";
                //     // used = true;


                //     // // Добавляем тег в секцию head документа
                //     document.head.appendChild(Csslink);
                //     // saveBtnSetting(nbListBtn.dataset.listName);

                // }
                

            }
            else if (nbListBtn.dataset.listName === "fontsWidth") {
                // const newCsslink = document.createElement('link');
                // newCsslink.rel = 'stylesheet';
                // newCsslink.type = 'text/css';
                // newCsslink.href = '../css/settings/fontSize20.css';
                newCsslink = document.querySelector('.settingsCssLink1');


                // nb-lt-integer-i
                nbListBtn.querySelector('.nb-lt-integer-i-2').addEventListener('change', () => {
                    nbltIntegerValue = nbListBtn.querySelector('.nb-lt-integer-i-2').value;
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
            // else if ((nbListBtn.dataset.listName === "give" || nbListBtn.dataset.listName === "pass_off" || nbListBtn.dataset.listName === "rewrite" || nbListBtn.dataset.listName === "write_off") && !nbListBtn.classList.contains('nb-lb-disabled')) {
            else if ((nbListBtn.dataset.listName === "give" || nbListBtn.dataset.listName === "pass_off" || nbListBtn.dataset.listName === "rewrite" || nbListBtn.dataset.listName === "write_off") && !nbListBtn.classList.contains('nb-lb-disabled')) {
               
                // if (getBLBTimeout !== null){
                //     clearTimeout(getBLBTimeout);
                // }

                // equipmentRow = document.querySelector('tr.handbook-ddp-br-active') ?? document.querySelector('tr.table-row');
                // eq_id = parseInt(equipmentRow.dataset.id);
                //activeRowId

                // clientRow = document.querySelector('tr.handbook-ddp-br-active') ?? document.querySelector('tr.table-row');
                // eq_id = parseInt(equipmentRow.dataset.id);

                console.log(nbListBtn.dataset.listName);
                console.log('eq_id', document.querySelector('tr.handbook-ddp-br-active')?.dataset.id ?? activeRowId);
                url = `/PopupActionEquipment?eq_id=${document.querySelector('tr.handbook-ddp-br-active')?.dataset.id ?? activeRowId}&action_name=${nbListBtn.dataset.listName}`;
                fetch(url)
                .then(res => res.text())
                .then(html => {
                    
                    // clearTimeout(getActionSetTimeout);


                    if (nbListBtn.dataset.listName === 'give'){
                        document.querySelector('.fl-popup-window-block').classList.add("fl-pwb-wide-mode");
                        document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Выдать технику сотруднику";
                    }
                    else if (nbListBtn.dataset.listName === 'rewrite') {
                        document.querySelector('.fl-popup-window-block').classList.add("fl-pwb-wide-mode");
                        document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Переписать технику на др. сотрудника";
                    }
                    else if (nbListBtn.dataset.listName === 'pass_off') {
                        document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Сдать технику";
                    }
                    else if (nbListBtn.dataset.listName === 'write_off') {
                        document.querySelector('.fl-popup-w-h-title-text').innerHTML = "Списать технику";
                    }
                    
                    document.querySelector('.fl-popup-window-block-inner').innerHTML=html;
                    // console.log(`окно ${popupName} выведено успешно`);

                    // getBLBTimeout = setTimeout(() => {
                    //     getEqActionSettings(nbListBtn.dataset.listName);
                    //     console.log('моргун')
                    // }, 100);
                    currentPopupType = 'eq_action_form';
                    getEqActionSettings(nbListBtn.dataset.listName);
                    window.popupAPI.open();
                })
                .catch(() => {
                    console.log(`Ошибка загрузки окошка`);
                });

            }
            else if (nbListBtn.dataset.listName === "clearSettings") {
                clearBtnSettings()
            }
            else if (nbListBtn.dataset.listName === "filter-eq-statuses") {
                document.querySelectorAll('.nb-list-btn[data-list-name="filter-eq-statuses"]').forEach(filterEqStatusOpt => {
                    filterEqStatusOpt.classList.remove('nb-list-btn-active');
                });
                nbListBtn.classList.add('nb-list-btn-active')
            }
            else if (nbListBtn.dataset.listName === "filter-eq-types") {
                document.querySelectorAll('.nb-list-btn[data-list-name="filter-eq-types"]').forEach(filterEqStatusOpt => {
                    filterEqStatusOpt.classList.remove('nb-list-btn-active');
                });
                nbListBtn.classList.add('nb-list-btn-active')
            }

            if (!used) {
                saveBtnSetting(nbListBtn.dataset.listName);
            }
        });
        
        
    });

    // <div class="nb-list-btn nav-btn-list-row block fl-row" data-list-name="fontsWidth">

} 


function saveBtnSetting(setting) {
    console.log('сохраняем настройку', setting)


    if (setting === "fontsWidth") {
        localStorage.setItem(setting, selectedFontSize);
    }
    else if (setting === "compactDesign") {
        localStorage.setItem(setting, true);
    }
    else if (setting === "LightTheme") {
        localStorage.setItem('theme', 'LightTheme');
    }
    else if (setting === "DarkTheme") {
        localStorage.setItem('theme', 'DarkTheme');
    }
}

function loadBtnSettings() {
    if (localStorage.getItem("fontsWidth") !== null && localStorage.getItem("compactDesign") === null) {
        fontsWidth = localStorage.getItem("fontsWidth");

        document.querySelector('.nb-lt-integer-i-2').value = parseInt(fontsWidth);

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

     if (localStorage.getItem("theme") !== null) {
        compactDesign =  localStorage.getItem("theme");
        
        if (localStorage.getItem("theme") === "LightTheme") {
            settingsCssDTL = document.querySelector('.settingsCssDTL');
            settingsCssDTL.href = "";
            document.head.appendChild(settingsCssDTL);
            console.log("Настройка 'Светлая тема' инициализирован");
        }
 
        
        
    }
    
}

function clearBtnSettings() {
    document.querySelectorAll('.nb-list-btn[data-list-name]').forEach(nbListBtn => {
        localStorage.removeItem(nbListBtn.dataset.listName);
    })

    // document.querySelector('.settingsCssLink1').remove();
    // document.querySelector('.settingsCssLink2').remove();
    document.querySelector('.settingsCssLink1').setAttribute('href', '');
    document.querySelector('.settingsCssLink2').setAttribute('href', '');

    document.querySelector('.nb-lt-integer-i-2').value = '16';
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
    if ((e.target.closest('body') && !e.target.closest('.nav-btn-group') && !e.target.closest('.nav-btn-list-container')) || e.target.closest('.nbl-b-category-closable')){
        //console.log('оливер приехал');
        console.log('fdgdf');
        
        // if (e.target.closest('.nav-btn-group').contains('nbg-opened')) openBtnList();
        if (!e.target.closest('.nav-btn-group') || e.target.closest('.nbl-b-category-closable')) checkOpenedBtns();
    } 
});

loadBtnSettings();