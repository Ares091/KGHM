(function () {
    const config = {
        triggerSelector: '.inner-module-popup-btn',
        wrapClass: 'fl-inner-popup-wrap',
        containerClass: '.fl-inner-popup-window',
        openedClass: 'fl-popup-w-opened',
        closedClass: 'fl-popup-w-closed',
        animationDuration: 350,
        // Маршруты получения контента внутреннего окна
        routes: {
            // sync_1c: `/InnerPopupSync1c?cli_id=${parseInt(activeRowId)}`,
            sync_1c: '/InnerPopupSync1c',
            edit_data: '/InnerPopupEditUserData',
        },
        // Какой основной форме отдавать данные (поле внутри .fl-popup-window)
        mainFormSelector: '.fl-popup-window-block-inner .fl-popup-form',
    };
    // Накопленные данные из режима data_input
    const collectedData = {}; // { sync_1c: { name: value, ... } }

    let activeInnerPopup = null;
    let activeTrigger = null;
    let closePopupTimer = null;

    // -------- Утилиты --------
    function getOrCreateWrap() {
        let wrap = document.querySelector('.' + config.wrapClass);
        if (!wrap) {
        wrap = document.createElement('div');
        wrap.className = config.wrapClass;
        // кладём прямо в .fl-popup-window, чтобы накрывало весь контент
        const host = document.querySelector('.fl-popup-window');
        host.appendChild(wrap);
        }
        return wrap;
    }

    function clearWrap() {
        const wrap = document.querySelector('.' + config.wrapClass);
        if (wrap) wrap.innerHTML = '';
    }

    // -------- Открытие/закрытие --------
    function openInnerPopup(trigger) {
        const type = trigger.dataset.innerPopupType;
        const mode = trigger.dataset.innerPopupMode || 'data_input';
        let route = config.routes[type];

        if (!route) {
            console.warn('Не задан маршрут для внутреннего окна типа:', type);
            return;
        }
        else if (type === "sync_1c") {
            // sync_1c: `/InnerPopupSync1c?cli_id=${parseInt(activeRowId)}`,
            route = route + `?cli_id=${parseInt(activeRowId)}`;
        }
        
        activeTrigger = trigger;



        fetch(route, { headers: {'X-Requested-With': 'XMLHttpRequest'}})
            .then(res => res.text())
            .then(html => {
                const wrap = getOrCreateWrap();
                wrap.innerHTML = html;

                const innerPopup = wrap.querySelector(config.containerClass);
                if (!innerPopup) return;

                innerPopup.dataset.type = type;
                innerPopup.dataset.mode = mode;

                if (mode === 'data_input' && collectedData[type]) {
                    fillInnerForm(innerPopup, collectedData[type]);
                }

                // Анимация
                innerPopup.classList.remove(config.closedClass);

                // Форсируем reflow чтобы анимация сработала при повторном открытии
                void innerPopup.offsetWidth;
                innerPopup.classList.add(config.openedClass);

                activeInnerPopup = innerPopup;
                bindInnerButtons(innerPopup, mode, type);
            })
            .catch(err => console.error('Ошибка загрузки внутреннего окна:', err));
    }

    function closeInnerPopup() {
        if (!activeInnerPopup) return;
        const el = activeInnerPopup;

        el.classList.remove(config.openedClass);
        el.classList.add(config.closedClass);

        setTimeout(() => {
            clearWrap();
            activeInnerPopup = null;
            activeTrigger = null;
        }, config.animationDuration);
    }

    // -------- Логика кнопок внутри внутреннего окна --------
    function bindInnerButtons(innerPopup, mode, type) {
        // Отмена / крестик
        innerPopup.querySelectorAll('.inner-popup-close-btn, .fl-pwb-nbt-close')
        .forEach(btn => btn.addEventListener('click', (e) => {
            e.preventDefault();
            closeInnerPopup();
        }));

        // Сброс
        innerPopup.querySelectorAll('.inner-popup-clear-btn')
        .forEach(btn => btn.addEventListener('click', (e) => {
            e.preventDefault();
            const form = innerPopup.querySelector('form');
            if (form) form.reset();
        }));

        // Сохранить
        innerPopup.querySelectorAll('.inner-popup-save-btn, .fl-pwb-nbt-submit')
        .forEach(btn => btn.addEventListener('click', (e) => {
            e.preventDefault();
            handleInnerSave(innerPopup, mode, type);
        }));
    }


    function handleInnerSave(innerPopup, mode, type) {
        if(closePopupTimer !== null) clearTimeout(closePopupTimer);
        formErrors = false;
        const form = innerPopup.querySelector('form');
        if (!form) return;

        const data = formDataToObject(new FormData(form), form);

        if (mode === 'data_select') {
            copyToMainForm(data);
            closeInnerPopup();
        } else {
            // data_input
            collectedData[type] = Object.assign(collectedData[type] || {}, data);

            // Скрытые инпуты в основную форму, чтобы уехали с обычным submit
            // syncHiddenInputs(type, collectedData[type]);

            // Обновим визуальный чекбокс "Синхронизация 1C" в основной форме, если это sync_1c
            if (type === 'sync_1c') {
                const flag = document.querySelector('.fl-popup-window .form-input[name="cli_sync_1c"]');
                if (flag) flag.checked = true;
            }

            if (type === 'edit_data') {

                // console.log('collectedData[type][0]', collectedData[type]['u_email'], 
                //     'collectedData[type][1]', collectedData[type]['u_login'], 
                //     'collectedData[type][2]', collectedData[type]['u_new_password'],)
                // fetch(`/editUserData?edit_data=${JSON.parse(collectedData[type])}`, {
                // fetch(`/editUserData?u_login=${collectedData[type]['u_login']}&u_email=${collectedData[type]['u_email'].trim()}&u_password=${collectedData[type]['u_password'].trim()}&u_new_password=${collectedData[type]['u_new_password'].trim()}&u_new_password_confirm=${collectedData[type]['u_new_password_confirm'].trim()}`, {
                fetch(`/editUserData`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        u_login: collectedData[type].u_login.trim(),
                        u_email: collectedData[type].u_email.trim(),
                        u_password: collectedData[type].u_password.trim(),
                        u_new_password: collectedData[type].u_new_password.trim(),
                        u_new_password_confirm: collectedData[type].u_new_password_confirm.trim(),
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Обновляем таблицу
                        console.log('Учетные данные пользователя были успешно изменены')
                        
                    }
                    if (data.errors) {
                        formErrors = true;
                        for (const [field, messages] of Object.entries(data.errors)) {
                            // span имеет id равный имени поля: login / password
                            const el = document.querySelector(`.form-valid-error[data-field="${field}"]`);
                            if (el) el.textContent = messages[0];
                        }

                        console.log('Получены ошибки валидации', data.errors);
                    }
                })
                .catch(error => {
                    console.error('Ошибка редактирования данных пользователя:', error);
                });

            }

            console.log('сохранено во внутреннем окне: ', collectedData);

            closePopupTimer = setTimeout(() => {
                if (!formErrors){
                    console.log('ошибки не найдены', formErrors);
                    console.log('закрываю окно');
                    closeInnerPopup();
                }
            }, 120);
            
        }
    }

    //хелперы
    function formDataToObject(formData, form) {
        const obj = {};
        formData.forEach((value, name) => {obj[name] = value;});
        if (form) {
            form.querySelectorAll('input[type="checkbox"][name]').forEach(cb => {
                obj[cb.name] = cb.checked ? 1 : 0;
            });
        }
        return obj;
    }

    function fillInnerForm(innerPopup, data) {
        const form = innerPopup.querySelector('form');
        if (!form) return;
        Object.entries(data).forEach(([name, value]) => {
            const field = form.querySelector(`[name="${name}"]`);
            if (!field) return;
            if (field.type === 'checkbox') {
                field.checked = value === 'on' || value === true || value === 'true' || value === '1' || value === 1;
            } else {
                field.value = value;
            }
        });
    }

    function copyToMainForm(data) {
        const mainForm = document.querySelector(config.mainFormSelector);
        if (!mainForm) return;

        Object.entries(data).forEach(([name, value]) => {
            const field = mainForm.querySelector(`[name="${name}"]`);
            if (!field) return;
            if (field.type === 'checkbox') {
                field.checked = value === 'on' || value === '1' || value === 'true' || value === true;
            } else {
                field.value = value;
            }
        });
    }

    function syncHiddenInputs(type, data) {
        const mainForm = document.querySelector(config.mainFormSelector);
        if (!mainForm) return;

        // Удаляем прошлые hidden этой группы
        mainForm.querySelectorAll(`input[data-inner-hidden="${type}"]`)
        .forEach(el => el.remove());

        Object.entries(data).forEach(([name, value]) => {
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = `${type}[${name}]`;  // в контроллере: $request->input('sync_1c.cli_sync_1c_code')
            hidden.value = value;
            hidden.dataset.innerHidden = type;
            mainForm.appendChild(hidden);
        });
    }

    // -------- Делегирование клика по кнопкам-триггерам --------
    document.addEventListener('click', (e) => {
    const trigger = e.target.closest(config.triggerSelector);
        if (!trigger) return;
        e.preventDefault();
        openInnerPopup(trigger);
    });

    // -------- Публичный API --------
    window.innerPopupAPI = {
        open: openInnerPopup,
        close: closeInnerPopup,
        getCollected: () => collectedData,
        clearCollected: (type) => {
            if (type) delete collectedData[type];
            else Object.keys(collectedData).forEach(k => delete collectedData[k]);
        }
    };

})();