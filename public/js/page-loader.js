document.addEventListener('DOMContentLoaded', () => {
    const loader = document.getElementById('page-loader');
    if (!loader) return;

    // Проверяем настройку из localStorage
    const enabled = localStorage.getItem('pageLoaderEnabled') !== 'false';

    // Если отключено — сразу прячем
    if (!enabled) {
        loader.remove();
        return;
    }

    // Минимальное время показа (чтобы не мигало на быстрых загрузках)
    let MIN_SHOW_TIME = 300;
    let END_CLOSE_TIME = 200;
    const startTime = performance.now();

    // if (nonLogin){
    //     MIN_SHOW_TIME = 1600;
    //     END_CLOSE_TIME = 1200;
    // }

    const hideLoader = () => {
        const elapsed = performance.now() - startTime;
        const delay = Math.max(0, MIN_SHOW_TIME - elapsed);

        setTimeout(() => {
            loader.classList.add('hidden');
            // Полностью удаляем из DOM после анимации
            setTimeout(() => loader.remove(), END_CLOSE_TIME);
        }, delay);
    };

    // Ждём полной загрузки страницы (картинки, шрифты и т.д.)
    if (document.readyState === 'complete') {
        hideLoader();
    } else {
        window.addEventListener('load', hideLoader);
    }
});