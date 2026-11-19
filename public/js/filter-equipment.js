$(document).ready(function() {

    // Функция для отправки AJAX-запроса
    function fetchEquipment() {
        // Собираем параметры фильтрации
        // const status = $('#filter-status').val();
        // const type = $('#filter-type').val();
        const status = document.querySelector('.nb-list-btn.nb-list-btn-active[data-list-name="filter-eq-statuses"]').dataset.value;
        const type = document.querySelector('.nb-list-btn.nb-list-btn-active[data-list-name="filter-eq-types"]').dataset.value;
        const withoutDivision = $('#filter-without-division').is(':checked') ? 1 : 0;
        const withoutResponsible = $('#filter-without-responsible').is(':checked') ? 1 : 0;
        const withoutBoth = $('#filter-without-both').is(':checked') ? 1 : 0;

        // Параметры сортировки (храним в data-атрибутах на таблице или в скрытых полях)
        const sortField = $('#table-container').data('sort') || 'eq_id';
        const sortDirection = $('#table-container').data('direction') || 'asc';

        // Собираем данные для GET-запроса
        const params = {
            div_id: currentDepartmentId,
            div_type: currentdivisionType,
            status: status,
            type: type,
            without_division: withoutDivision,
            without_responsible: withoutResponsible,
            without_both: withoutBoth,
            sort: sortField,
            direction: sortDirection
        };

        // Показываем индикатор загрузки (опционально)
        // $('#table-container').append('<div class="loader">Загрузка...</div>');

        // AJAX-запрос
        $.ajax({
            url: '/equipmentFilter',
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
    $('#filter-without-division, #filter-without-responsible, #filter-without-both').on('change', function() {
        fetchEquipment();
    });

    // в open-btn-lists
    $('.select-list-btn').on('click', function () {
    // $('.select-btn-group').on('click', function () {
        setTimeout(() => {
            fetchEquipment();
        }, 30);
        
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