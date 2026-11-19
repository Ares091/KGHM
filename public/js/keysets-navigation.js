(function() {
            'use strict';

            // состояние
            const state = {
                currentPanel: 'left',
                leftindex: -1,
                tableIndex: -1,
                noteIndex: -1,
                leftElements: [],
                tableElements: [],
                noteElements: [],
            };

            // вспомогательные функции
            function getVisibleLeftButtons() {
                const container = document.querySelector('.handbook-body-left-department-panel');
                if (!container) return [];
                const allBtns = container.querySelectorAll('.hb-dep-data-btn');
                const visible = [];
                allBtns.forEach(btn => {
                    let parent = btn.parentElement;
                    let hidden = false;
                    while (parent && parent !== container) {
                        if (parent.classList.contains('handbook-ddp-sub-rows-closed')) {
                            hidden = true;
                            break;
                        }
                        parent = parent.parentElement;
                    }
                    if (!hidden) visible.push(btn);
                });
                return visible;
            }

            function getTableRows() {
                const tbody = document.querySelector('.handbook-body-right-main-data-panel-t-content table tbody');
                return tbody ? Array.from(tbody.querySelectorAll('.table-row')) : [];
            }

            function getNoteRows() {
                const publicPart = document.querySelector('.handbook-body-right-section-note-panel-public-content');
                const privatePart = document.querySelector('.handbook-body-right-section-note-panel-private-content');

                let rows = [];
                if (publicPart) {
                    rows = rows.concat(Array.from(publicPart.querySelectorAll('.table-note-t-row')));
                }
                if (privatePart && privatePart.style.display !== 'none') {
                    rows = rows.concat(Array.from(privatePart.querySelectorAll('.table-note-t-row')));
                }
                return rows;
            }

            function refreshState() {
                state.leftElements = getVisibleLeftButtons();
                state.tableElements = getTableRows();
                state.noteElements = getNoteRows();

                // Корректировка индексов, если текущий индекс вышел за границы
                ['left', 'table', 'note'].forEach(panel => {
                    const maxIdx = state[panel + 'Elements'].length - 1;
                    if (state[panel + 'Index'] > maxIdx) {
                        state[panel + 'Index'] = maxIdx;
                    }
                    if (state[panel + 'Index'] < 0 && maxIdx >= 0) {
                        state[panel + 'Index'] = 0;
                    }
                });
            }

            // Получить текущий активный элемент
            function getActiveElement() {
                const panel = state.currentPanel;
                const idx = state[panel + 'Index'];
                const elements = state[panel + 'Elements'];
                return (idx >= 0 && idx <elements.length) ? elements[idx] : null;
            }

            // Установить активный элемент
            function setActiveElement(el, panel, index) {
                // Убрать класс у всех
               
                document.querySelectorAll('.handbook-ddp-br-active').forEach(el => el.classList.remove('handbook-ddp-br-active'));
                document.querySelectorAll('.handbook-ddp-br-active-2').forEach(el => el.classList.remove('handbook-ddp-br-active-2'));
                
                // console.log('panel', panel);
                if (panel !== 'left' && currentDepartmentId !== null) {
                    document.querySelector(`.hb-dep-data-btn[data-id="${currentDepartmentId}"]`).classList.add('handbook-ddp-br-active-2');
                }

                if (el) {
                    el.classList.add('handbook-ddp-br-active');
                    el.scrollIntoView({ block: 'nearest' });
                }
                state.currentPanel = panel;
                state[panel + 'Index'] = index;
            }

            function moveDown() {
                const panel = state.currentPanel;
                const elements = state[panel + 'Elements'];
                let idx = state[panel + 'Index'];
                if (elements.length === 0) return;

                // Особое поведение для левой панели: если текущий элемент имеет подотделы и они закрыты,
                // раскрываем их и переходим на первый дочерний элемент.

                if (panel === 'left') {
                    const current = idx >= 0 ? elements[idx] : null;

                    if (current) {
                        const parentGroup = current.closest('.hb-ddp-group-with-subs, .hb-ddp-group-with-sub-subs');

                        if (parentGroup) {
                            const subRows = parentGroup.querySelector('.handbook-ddp-b-sub-rows-group, .handbook-ddp-b-subs-sub-rows-group');
                            
                             if (subRows && subRows.classList.contains('handbook-ddp-sub-rows-closed')) {
                                // Открываем
                                subRows.classList.remove('handbook-ddp-sub-rows-closed');
                                refreshState();
                                // Находим новый индекс текущего элемента в обновлённом списке
                                const newIdx = state.leftElements.indexOf(current);
                                if (newIdx !== -1 && newIdx + 1 < state.leftElements.length) {
                                    setActiveElement(state.leftElements[newIdx + 1], 'left', newIdx + 1);
                                } else {
                                    setActiveElement(current, 'left', newIdx);
                                }
                                return;
                            }
                        }
                    }
                }

                // Обычное перемещение вниз
                let nextIdx = idx + 1;
                if (nextIdx >= elements.length) return;

                setActiveElement(elements[nextIdx], panel, nextIdx);
            }

            function moveUp() {
                const panel = state.currentPanel;
                const elements = state[panel + 'Elements'];
                let idx = state[panel + 'Index'];
                if (elements.length === 0) return;

                let prevIdx = idx - 1;
                if (prevIdx < 0) return;

                setActiveElement(elements[prevIdx], panel, prevIdx);
            }

            function switchPanel() {
                const panels = ['left', 'table', 'note'];
                let currentIdx = panels.indexOf(state.currentPanel);
                let nextIdx = (currentIdx + 1) % panels.length;
                const nextPanel = panels[nextIdx];
                const elements = state[nextPanel + 'Elements']; 

                if (elements.length === 0) {
                    // Ищем следующую непустую панель
                    let tryIdx = (nextIdx + 1) % panels.length;
                    while (tryIdx !== currentIdx) {
                        const tryPanel = panels[tryIdx];
                        if (state[tryPanel + 'Elements'].length > 0) {
                            setActiveElement(state[tryPanel + 'Elements'][0], tryPanel, 0);
                            return;
                        }
                        tryIdx = (tryIdx + 1) % panels.length;
                    }
                    return;
                }
                setActiveElement(elements[0], nextPanel, 0); 
            }

            function handleEnter() {
                if (state.currentPanel === 'table') {
                    // Переключиться на нижнюю панель (детали)
                    const noteElements =  state.noteElements;
                    if (noteElements.length > 0) {
                        setActiveElement(noteElements[0], 'note', 0);
                    }
                }
                // Для других панелей Enter можно использовать по желанию
            }

            // фукнция копирования
            function copyActive() {
                const active = getActiveElement();
                if (!active) return;
                let text = '';

                active.focus();

                if (active.classList.contains('hb-dep-data-btn')) {
                    const nameEl = active.querySelector('.handbook-ddp-text');
                    if (nameEl) text = nameEl.textContent.trim();
                } else if (active.classList.contains('table-row')) {
                    // Копируем весь текст строки (все ячейки)
                    text = active.textContent.trim();
                } else if (active.classList.contains('table-note-t-row')) {
                    // Копируем значение из второй ячейки (td)
                    const valueCell = active.querySelector('td');
                    if (valueCell) text = valueCell.textContent.trim();
                }

                if (text){
                    const textarea = document.createElement('textarea');
                    textarea.value = text;
                    textarea.setAttribute('readonly', '');
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand('copy');

                    console.log('Скопировано: ' + text);
                }

                // if (text) {
                //     navigator.clipboard.writeText(text).then(() => {
                //         console.log('Скопировано: ' + text);
                //     }).catch(() => {
                //         const textarea = document.createElement('textarea');
                //         textarea.value = text;
                //         document.body.appendChild(textarea);
                //         textarea.select();
                //         document.execCommand('copy');
                //         document.body.removeChild(textarea);
                //     });
                // }
            }


            // обработчик клавиш

            function onKeydown(e) {
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA' || e.target.isContentEditable) {
                    return;
                }

                const key = e.key;
                const isDown = (key === 'ArrowDown' || key === 's' || key === 'S');
                const isUp = (key === 'ArrowUp' || key === 'w' || key === 'W');
                const isTab = (key === 'Tab');
                const isEnter = (key === 'Enter');
                const isCopy  = (key === 'c' || key === 'C' || key === 'с' || key === 'С') && (e.ctrlKey || e.metaKey);
                const isC = (key === 'c' || key === 'C') && !e.ctrlKey && !e.metaKey && !e.altKey && !e.shiftKey;

                if (isDown) {
                    e.preventDefault();
                    moveDown();
                } else if (isUp) {
                    e.preventDefault();
                    moveUp();
                } else if (isTab) {
                    e.preventDefault();
                    refreshState(); 
                    switchPanel();
                } else if (isEnter) {
                    e.preventDefault();
                    handleEnter();
                } else if (isCopy) {
                    e.preventDefault();
                    copyActive();
                } else if (isC) {
                    // Копирование по клавише C (без Ctrl)
                    e.preventDefault();
                    copyActive();
                }
            }

            function init() {
                refreshState();

                // Установить начальный активный элемент (первый в левой панели)
                if (state.leftElements.length > 0) {
                    setActiveElement(state.leftElements[0], 'left', 0);
                } else if (state.tableElements.length > 0) {
                    setActiveElement(state.tableElements[0], 'table', 0);
                } else if (state.noteElements.length > 0) {
                    setActiveElement(state.noteElements[0], 'note', 0);
                }

                document.addEventListener('keydown', onKeydown);

                // Клик по элементу – делаем его активным

                document.addEventListener('click', function(e) {
                    const target = e.target.closest('.hb-dep-data-btn, .table-row, .table-note-t-row');
                    if (!target) return;
                    document.querySelectorAll('.hb-dep-data-btn.handbook-ddp-br-active-2').forEach(el => el.classList.remove('handbook-ddp-br-active-2'));


                    if (!target.classList.contains('handbook-ddp-br-active')) {
                        console.log('Ставлю активный элемент');
                        let panel = '';
                        let elements = [];
                        if (target.classList.contains('hb-dep-data-btn')) {
                            panel = 'left';
                            elements = state.leftElements;
                        } else if (target.classList.contains('table-row')) {
                            panel = 'table';
                            elements = state.tableElements;
                        } else if (target.classList.contains('table-note-t-row')) {
                            panel = 'note';
                            elements = state.noteElements;
                        }

                        const idx = elements.indexOf(target);
                        if (idx !== -1) {
                            setActiveElement(target, panel, idx);
                        }
                    
                    }
                    else {
                        if (state.currentPanel !== 'left' && (target.classList.contains('table-row') || target.classList.contains('table-note-t-row'))) {
                            // let elements = [];
                            // elements = state.noteElements;
                            // const idx = elements.indexOf(target);
                            // if (idx !== -1) {
                            //     setActiveElement(state.leftElements[0], 'left', 0);
                            // }
                            // setActiveElement(state.leftElements[0], 'left', 0);
                            let currentDepDiv = document.querySelector(`.hb-dep-data-btn[data-id="${currentDepartmentId}"]`);
                            let currDepIndex = Array.from(document.querySelectorAll('.hb-ddp-with-subs.block.hb-dep-data-btn')).indexOf(currentDepDiv);

                            setActiveElement(document.querySelector(`.hb-dep-data-btn[data-id="${currentDepartmentId}"]`), 'left', currDepIndex);

                            if (window.popupAPI.config.openPopupBtnsIsActive){
                                window.popupAPI.disable_btns()

                                if (typeof disableEqStatuses === 'function') {
                                    disableEqStatuses()
                                }
                            }
                                
                        }
                        // else {
                        //     setActiveElement(state.tableElements[0], 'table', 0);
                        // }
                    }
                });


                document.addEventListener('dblclick', function(e) {
                    if (window.location.pathname.includes('ad') || window.location.pathname.includes('doc')) return;

                    const target = e.target.closest('.table-row');
                    if (!target) return;
                    if (target.classList.contains('form-table-div-row')) return;
                    let targetID = parseInt(target.dataset.id)
                    activeRowId = targetID
                    getPopupWindow("equipment_view")
                    window.popupAPI.open()
                });

                // Экспортируем функцию обновления для вызова после AJAX-загрузок
                window.refreshKeyboardNavigation = refreshState;
                // Также экспортируем setActiveElement на случай, если понадобится программно переключиться
                window.setActiveElement = setActiveElement;
            }

             if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', init);
            } else {
                init();
            }
        })();