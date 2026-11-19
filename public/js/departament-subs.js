dropdownSubsSubListOpened = false;

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
                    // console.log("Закрываю панель");
                    dropdownSubList.classList.add('handbook-ddp-sub-rows-closed');
                } 
                else if (e.target.closest('.hb-ddp-group-with-sub-subs') ){
                    // console.log("Пепе щнейне");
                    dropdownSubSubList = dropdownSubList.querySelector('.handbook-ddp-b-subs-sub-rows-group');
                    
                    if (dropdownSubSubList.classList.contains('handbook-ddp-sub-rows-closed') ){
                        dropdownSubSubList.classList.remove('handbook-ddp-sub-rows-closed')
                        // dropdownSubsSubListOpened = true;
                    }
                    else { 
                        // dropdownSubsSubListOpened === true
                        if (e.target.closest('.handbook-ddp-b-sub-row[data-div-type="sub"]')){
                            dropdownSubSubList.classList.add('handbook-ddp-sub-rows-closed');
                        }
                        
                    }
                }
                else {
                    e.target.addEventListener('dblclick', (e) => {
                        dropdownSubList.classList.remove('handbook-ddp-sub-rows-closed');
                    });
                }
            });
        });

        // доабвление класса актива при нажатии на определенный элемент списка отделов
        const hbDepDataBtns = document.querySelectorAll('.hb-dep-data-btn');

        hbDepDataBtns.forEach(hbDepDataBtn => {
            hbDepDataBtn.addEventListener('click', (e) => {
                
                document.querySelectorAll('.hb-dep-data-btn').forEach(OTHERhbDepDataBtn => {
                    if (OTHERhbDepDataBtn.classList.contains('handbook-ddp-br-active')){
                        OTHERhbDepDataBtn.classList.remove('handbook-ddp-br-active');
                    }
                })
                e.target.closest('.hb-dep-data-btn').classList.add('handbook-ddp-br-active');
                window.refreshKeyboardNavigation();
            });
        });