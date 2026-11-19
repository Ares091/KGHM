
<div class="handbook-body-right-section-note-panel-main-content">
    <table class="table block fs-table-style-3">
        <tbody>
            @if ($cli)
                <tr>
                    <th class="fs-table-row" scope="row">Статус</th>
                    <td class="fs-table-row" scope="row">{{ $eqi->status->eqs_name }}</td>
                </tr>
                <tr>
                    <th class="fs-table-row" scope="row">Тип</th>
                    <td class="fs-table-row" scope="row">{{ $eqi->type->eqt_name }}</td>
                </tr>
                <tr>
                    <th class="fs-table-row" scope="row">Наименование</th>
                    <td class="fs-table-row" scope="row">{{ $eqi->eq_name }}</td>
                </tr>
                <tr>
                    <th class="fs-table-row" scope="row">Серийный номер</th>
                    <td class="fs-table-row" scope="row">{{ $eqi->eq_serial_number }}</td>
                </tr>
                 <tr>
                    <th class="fs-table-row" scope="row">Инвентарный номер</th>
                    <td class="fs-table-row" scope="row">{{ $eqi->eq_inventory_number }}</td>
                </tr>
                <tr>
                    <th class="fs-table-row" scope="row">№ карточки</th>
                    <td class="fs-table-row" scope="row">{{ $eqi->eq_cart_number }}</td>
                </tr>
                <tr>
                    <th class="fs-table-row" scope="row">Подразделение (отв.)</th>
                    <td class="fs-table-row" scope="row">{{ $eqi->client->cli_name_view }}</td>
                </tr>
                <tr>
                    <th class="fs-table-row" scope="row">Подразделение (ед. техн)</th>
                    <td class="fs-table-row" scope="row">{{ $eqi->cli_email }}</td>
                </tr>
                <tr>
                    <th class="fs-table-row" scope="row">Документ</th>
                    <td class="fs-table-row" scope="row">{{ $eqi->import_doc }}</td>
                </tr>
                <tr>
                    <th class="fs-table-row" scope="row">Комментарий</th>
                    <td class="fs-table-row" scope="row">{{ $eqi->eq_comment }}</td>
                </tr>
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
<div class="handbook-body-right-section-note-panel-second-info-content">

</div>