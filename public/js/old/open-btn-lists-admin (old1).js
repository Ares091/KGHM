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

        function clearBtnSettings() {
            document.querySelectorAll('.nb-list-btn[data-list-name]').forEach(nbListBtn => {
                localStorage.removeItem(nbListBtn.dataset.listName);
            })
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