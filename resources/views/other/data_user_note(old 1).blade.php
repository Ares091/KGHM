{{-- Публичная информация о пользователе --}}
<div class="handbook-body-right-section-note-panel-public-content">
    <table class="table block fs-table-style-3">
        <tbody>
            @if ($cli)
                @if ($tableType === "AdminTable")
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Имя</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_name_view }}</td>
                    </tr>
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Статус</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">Запись отключена</td>
                    </tr>
                @else
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Имя</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_name_view }}</td>
                    </tr>
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Должность</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_prof }}</td>
                    </tr>
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Отдел</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->division->div_name_full }}</td>
                    </tr>
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Тел. Город</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_tel_work }}</td>
                    </tr>
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Тел. Внутренний</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_tel_work2 }}</td>
                    </tr>
                        <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Тел. Мобильный</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_tel_mobile }}</td>
                    </tr>
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Эл. почта</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row"></td>
                    </tr>
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Статус</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_sync_1c_status }}</td>
                    </tr>
                @endif
                
            @endif
        </tbody>
        <!-- <tfoot>
            <tr>
                <th class="fs-table-row table-bottom-left-corner" scope="row" colspan="3">Итого классов</th>
                <th class="fs-table-row table-bottom-right-corner">20</td>
            </tr>
        </tfoot> -->
    </table>
</div>



{{-- Приватная информация о пользователе --}}
<div class="handbook-body-right-section-note-panel-private-content">
    <table class="table block fs-table-style-3">
        <tbody>
            @if ($cli && $user && $user->u_role !== 'user')
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Дата Рождения</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_date_born }}</td>
                </tr>
                <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Эл. почта</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_email }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Личный телефон</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_mobile_phone }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Адрес Прописки</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_tel_mobile }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Адрес Проживания</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_tel_mobile }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Доп.Информация</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_tel_mobile }}</td>
                </tr>
            @endif
        </tbody>
    </table>
    
</div>