const popupConfig = {
  // Селекторы основных элементов
  popupWindowSelector: '.fl-popup-window',
  popupBlockSelector: '.fl-popup-window-block',
  // Классы состояний
  openedClass: 'fl-popup-w-opened',
  closedClass: 'fl-popup-w-closed',
  openingAnimClass: 'fl-popup-window-opening-anim',
  closingAnimClass: 'fl-popup-window-closing-anim',
  blockOpeningAnimClass: 'fl-popup-window-block-opening-anim',
  blockClosingAnimClass: 'fl-popup-window-block-clos-anim',
  // Классы кнопок-триггеров (можно перечислить все нужные)
  triggerButtonClasses: ['fs-popup-window-btn', 'fs-popup-window-btn-2', 'fs-popup-window-btn-3'],
  triggerButtonDisableClasses: ['fs-popup-w-disabled', 'nb-list-btn-disabled'],
  // Классы кнопок закрытия внутри попапа (навигационные)
  closeNavButtonClass: 'fl-pwb-nbt-close',
  submitNavButtonClass: 'fl-pwb-nbt-submit',
  // Длительность анимации (мс)
  animationDuration: 1000,
  // Дополнительно: задержка перед началом открытия (для смены классов)
  openDelay: 1,

  openPopupBtnsIsActive: false,
};

// ==================== ОСНОВНОЙ КОД ====================
(function() {
  // 1. Получаем элементы
  const popupWindow = document.querySelector(popupConfig.popupWindowSelector);
  if (!popupWindow) return;

  const popupBlock = document.querySelector(popupConfig.popupBlockSelector);
  if (!popupBlock) return;

  // 2. Функция открытия
  function openPopup(e = null) {

    // if (!btn.classList.contains(popupConfig.triggerButtonDisableClasses[0])) {
    //   btn.addEventListener('click', openPopup);
    // }
    // if (document.querySelectorAll('.fs-popup-window-btn.fs-popup-w-disabled, .admin-dynamic-edit-btn.fs-popup-w-disabled').length !== 0) return;

    btnDisabled = e?.target.closest('.admin-dynamic-edit-btn, .fs-popup-window-btn')?.classList.contains('fs-popup-w-disabled');
    // console.log('btnDisabled', btnDisabled)
    if (btnDisabled) return;
    
    // Если уже открыт – не делаем ничего
    if (popupWindow.classList.contains(popupConfig.openedClass)) return;

    // Убираем класс "закрыт", добавляем "открыт"
    popupWindow.classList.add(popupConfig.openedClass);

    // Через минимальную задержку запускаем анимацию открытия
    setTimeout(() => {
      popupBlock.classList.add(popupConfig.blockOpeningAnimClass);
      popupWindow.classList.add(popupConfig.openingAnimClass);
      popupWindow.classList.remove(popupConfig.closedClass);
    }, popupConfig.openDelay);

    // По окончании анимации убираем временные классы
    setTimeout(() => {
      popupBlock.classList.remove(popupConfig.blockOpeningAnimClass);
      popupWindow.classList.remove(popupConfig.openingAnimClass);
      initPopupBtns();
    }, popupConfig.animationDuration);
    
  }

  // 3. Функция закрытия
  function closePopup() {
    if (!popupWindow.classList.contains(popupConfig.openedClass)) return;

    // Добавляем классы анимации закрытия
    popupBlock.classList.add(popupConfig.blockClosingAnimClass);
    popupWindow.classList.add(popupConfig.closingAnimClass);

    // По окончании анимации убираем временные классы и меняем состояние
    setTimeout(() => {
      popupBlock.classList.remove("fl-pwb-wide-mode");
      popupBlock.classList.remove(popupConfig.blockClosingAnimClass);
      popupWindow.classList.remove(popupConfig.closingAnimClass);
      popupWindow.classList.remove(popupConfig.openedClass);
      popupWindow.classList.add(popupConfig.closedClass);
    }, popupConfig.animationDuration);
  }

  function initPopupBtns() {
    let nullElements = 0;
    let clearBtn = document.querySelector('.fl-popup-window-block-inner .clear-form-btn');
    if (clearBtn !== null) {
      // console.log('document.querySelector(clear-form-btn) :', clearBtn);
      clearBtn.addEventListener('click', (e) => {
          e.preventDefault();

          // let formInputs = document.querySelectorAll('.form-div.block > .form-input')
          let formInputs = document.querySelectorAll('.form-div.block > input')


          formInputs.forEach(formInput => {
              if (formInput.value !== '') {
                formInput.value = '';
              }
              else {
                nullElements += 1;
              }
          });

          if (nullElements === formInputs.length) {
            closePopup();
          }
          console.log('поля очищены');
          formInputs = null;
          nullElements = 0;
      });
    }

    let exitBtn = document.querySelector('.fl-popup-window-block-inner .exit-form-btn');
    if (exitBtn !== null) {
      // console.log('document.querySelector(clear-form-btn) :', clearBtn);
      exitBtn.addEventListener('click', (e) => {
          e.preventDefault();

          // let formInputs = document.querySelectorAll('.form-div.block > .form-input')
          let formInputs = document.querySelectorAll('.form-div.block > input')

          formInputs.forEach(formInput => {
              if (formInput.value !== '') {
                formInput.value = '';
              }
              else {
                nullElements += 1;
              }
          });

          closePopup();
          
          formInputs = null;
          nullElements = 0;
      });
    }
  }

  function enableOpenPopupBtns() {
    popupConfig.openPopupBtnsIsActive = true;

    document.querySelectorAll('.fs-popup-window-btn.fs-popup-w-disabled, .admin-dynamic-edit-btn.fs-popup-w-disabled')?.forEach(fsPopupBtn => {
        fsPopupBtn.classList.remove('fs-popup-w-disabled');
    });
  }

  function disableOpenPopupBtns() {
    popupConfig.openPopupBtnsIsActive = false;
    activeRowId = null;

    document.querySelectorAll('.fs-pw-btn')?.forEach(fsPopupBtn => {
        fsPopupBtn.classList.add('fs-popup-w-disabled');
    });
  }

  // 4. Навешиваем обработчики на все кнопки-триггеры
  // Формируем селектор из переданных классов (через запятую)
  const triggerSelector = popupConfig.triggerButtonClasses.map(cls => `.${cls}`).join(',');
  document.querySelectorAll(triggerSelector).forEach(btn => {
    
    btn.addEventListener('click', openPopup);
    
  });

  // 5. Навешиваем обработчики на кнопки закрытия внутри попапа
  // Используем общий селектор для навигационных кнопок (можно уточнить при необходимости)
  document.querySelectorAll('.fl-pwb-nav-button-tab').forEach(navBtn => {
    // Если кнопка имеет класс закрытия или отправки – закрываем
    if (navBtn.classList.contains(popupConfig.closeNavButtonClass) ||
        navBtn.classList.contains(popupConfig.submitNavButtonClass)) {
      navBtn.addEventListener('click', closePopup);
    }
  });
// fl-inner-popup-window
  // 6. Закрытие по клику вне блока (на затемнённом фоне)
  document.body.addEventListener('click', function(e) {
    // Клик именно по самому окну (не по его блоку-контейнеру)
    if (e.target.closest(popupConfig.popupWindowSelector) && !e.target.closest(popupConfig.popupBlockSelector) && !e.target.closest('.fl-inner-popup-window')) {
      if (popupWindow.classList.contains(popupConfig.openedClass)) {
        closePopup();
      }
    }
  });

  function popupKeySet(e) {
    if (e.target.closest('input')) return;

    const key = e.key;

    console.log('key', key);

    if (key === 'Escape') {
      if (popupWindow.classList.contains(popupConfig.openedClass)) {
        closePopup();
      }
    }
    else if (key === 'Enter') {
      fetchPopupFormActions(e, currentPopupType);
    }
    else if (key === 'Shift' || key === 'e') {
      if (popupConfig.openPopupBtnsIsActive) {
        curPopupType = document.querySelector('.fs-pw-btn').dataset.popupType;
        getPopupWindow(curPopupType);
        openPopup();
      }
    }
    else if (key === '-' || key === 'z') {
      if (popupConfig.openPopupBtnsIsActive) {
        curPopupType = document.querySelector('.fs-pw-btn.eq-delete-btn').dataset.popupType;
        getPopupWindow(curPopupType);
        openPopup();
      }
    }
    else if (key === 'Delete') {
      let formInputs = document.querySelectorAll('.form-div.block > input')
      nullElements = 0;

      formInputs.forEach(formInput => {
          if (formInput.value !== '') {
            formInput.value = '';
          }
          else {
            nullElements += 1;
          }
      });

      if (nullElements === formInputs.length) {
        closePopup();
      }
    }
  }

  document.addEventListener('keydown', popupKeySet);

  // 7. (Опционально) Добавляем глобальные переменные для вызова из консоли или других скриптов
  window.popupAPI = {
    open: openPopup,
    close: closePopup,
    config: popupConfig,
    disable_btns: disableOpenPopupBtns,
    enable_btns: enableOpenPopupBtns,
  };

})();

// ==================== ОСТАЛЬНЫЕ ВАШИ МЕХАНИКИ (toggle, accordion) ====================
// Они не были изменены, но вы можете аналогично вынести их настройки в переменные,
// если потребуется. Пока оставлено как есть.

// toggle-switches
document.querySelectorAll('.form-toggle-switch-block').forEach(block => {
  block.addEventListener('click', () => {
    const toggle = block.querySelector('.form-toggle-switch');
    const isActive = toggle.classList.toggle('fts-active');
    block.dataset.enabled = isActive ? 'on' : 'off';
  });
});

// accordion elements
document.querySelectorAll('.fs-accordion-block-row').forEach(row => {
  row.addEventListener('click', () => {
    const bottom = row.querySelector('.fs-accordion-block-row-bottom-section');
    const btn = row.querySelector('.fs-accordion-open-btn');
    const isClosed = bottom.classList.contains('fs-abr-b-section-closed');

    bottom.classList.toggle('fs-abr-b-section-closed', !isClosed);
    bottom.classList.toggle('fs-abr-b-section-opened', isClosed);
    btn.classList.toggle('fs-ao-btn-opened', isClosed);
  });
});