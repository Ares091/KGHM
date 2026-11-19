btnListBlockGroupOpened = false;

        function openBtnList() {
            btnListBlockGroup = document.querySelector('.nav-btn-group[data-group-name="equipmentFilter"]');
            btnListBlockGroupContainer = btnListBlockGroup.querySelector('.nav-btn-list-container');

            if (btnListBlockGroup.classList.contains('nbg-opened')) {
                btnListBlockGroupContainer.innerHTML = '';
                btnListBlockGroup.classList.replace('nbg-opened', 'nbg-closed');
                btnListBlockGroupContainer.classList.replace('nbg-container-opened', 'nbg-container-closed');
            }
            else {
                btnListBlockGroup.classList.replace('nbg-closed', 'nbg-opened');
                btnListBlockGroupContainer.classList.replace('nbg-container-closed', 'nbg-container-opened');
                btnListBlockGroupContainer.innerHTML = `
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
        }

        document.querySelector('.nav-btn-group[data-group-name="equipmentFilter"] > .nav-btn').addEventListener('click', () => {
            openBtnList();
        });





        // btnListBlockGroupOpened = false;

        // function openBtnList() {
        //     btnListBlockGroup = document.querySelector('.nav-btn-group[data-group-name="equipmentFilter"]');
        //     btnListBlockGroupContainer = btnListBlockGroup.querySelector('.nav-btn-list-container');

        //     if (btnListBlockGroup.classList.contains('nbg-opened')) {
        //         btnListBlockGroup.classList.replace('nbg-opened', 'nbg-closed');
        //         btnListBlockGroupContainer.classList.replace('nbg-container-opened', 'nbg-container-closed');
        //     }
        //     else {
        //         btnListBlockGroup.classList.replace('nbg-closed', 'nbg-opened');
        //         btnListBlockGroupContainer.classList.replace('nbg-container-closed', 'nbg-container-opened');
        //     }
        // }

        // document.querySelector('.nav-btn-group[data-group-name="equipmentFilter"] > .nav-btn').addEventListener('click', () => {
        //     openBtnList();
        // });

        // document.addEventListener('click', e => {
        //     target = e.target;
        //     //console.log('and on and on and on', e.target);
        //     if (e.target.closest('body') && !e.target.closest('.nav-btn-group') && !e.target.closest('.nav-btn-list-container')){
        //         //console.log('оливер приехал');
                
        //         // if (e.target.closest('.nav-btn-group').contains('nbg-opened')) openBtnList();
        //         if (!e.target.closest('.nav-btn-group')) openBtnList();
        //     } 
        // });