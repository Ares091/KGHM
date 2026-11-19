{{-- Публичная информация о пользователе --}}
<div class="handbook-body-right-section-note-panel-public-content">
    <table class="table block fs-table-style-3">
        <tbody>
            @if ($eq_id)
                <tr class="table-note-t-row">
                    <th class="fs-table-row table-r-text" scope="row">Статус</th>
                    <td class="fs-table-row table-n-t-r-info table-r-text" scope="row">{{ $eq_id->eq_status_id !== null ? $eq_id->EquipmentStatus->eqs_name : "" }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row table-r-text" scope="row">Тип</th>
                    <td class="fs-table-row table-n-t-r-info table-r-text" scope="row">{{ $eq_id->import_type !== null ? $eq_id->import_type : "" }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row table-r-text" scope="row">Наименование</th>
                    <td class="fs-table-row table-n-t-r-info table-r-text" scope="row">{{ $eq_id->eq_name }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row table-r-text" scope="row">Серийный номер</th>
                    <td class="fs-table-row table-n-t-r-info table-r-text" scope="row">{{ $eq_id->eq_serial_number }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row table-r-text" scope="row">Инвентарный номер</th>
                    <td class="fs-table-row table-n-t-r-info table-r-text" scope="row">{{ $eq_id->eq_inventory_number }}</td>
                </tr class="table-note-t-row">
                    <tr>
                    <th class="fs-table-row table-r-text" scope="row">№ карточки</th>
                    <td class="fs-table-row table-n-t-r-info table-r-text" scope="row">{{ $eq_id?->eq_cart_number !== null ? $eq_id?->eq_cart_number : "" }}</td>
                </tr>
                <tr class="table-note-t-row handbook-mini-pop-i-block">
                    <th class="fs-table-row table-r-text" scope="row">Ответственный</th>
                    @if ($eq_id?->eq_client_id !== null && $eq_id?->client?->cli_name_view !== null)
                        <td class="fs-table-row table-n-t-r-info table-r-text" scope="row" data-client-id="{{ $eq_id?->eq_client_id}}">
                            {{ $eq_id?->client?->cli_name_view}}
                            @if ($eq_id?->client?->cli_disable === true )
                                <div class="fs-table-row-tag">Отключен</div>
                            @endif
                        </td>
                    @else
                         <td class="fs-table-row table-n-t-r-info table-r-text" data-client-id="" scope="row"></td>
                    @endif
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row table-r-text" scope="row">Подразделение Ответственного</th>
                    <td class="fs-table-row table-n-t-r-info table-r-text" scope="row" data-div-id="{{ $eq_id?->client?->division?->div_id}}">{{ $eq_id?->client?->division?->div_name_full }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row table-r-text" scope="row">Подразделение ед.техн</th>
                    <td class="fs-table-row table-n-t-r-info table-r-text" scope="row">{{ $eq_id?->division?->div_name_full }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row table-r-text" scope="row">Документ</th>
                    <td class="fs-table-row table-n-t-r-info table-r-text" scope="row">{{ $eq_id->import_doc }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row table-r-text" scope="row">Комментарий</th>
                    <td class="fs-table-row table-n-t-r-info table-r-text" scope="row">{{ $eq_id->eq_comment }}</td>
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

<div class="handbook-body-right-section-note-panel-private-content">
    

    <table class="table block fs-table-style-3" style="width: 100%; table-layout: fixed;">
        <!-- <caption>
            Все классы Flexstyles
        </caption> -->
        <thead>
            <tr>
                <th class="fs-table-row fs-docs-col-1 table-r-text table-top-left-corner" scope="col" style="width: 25%;">Дата</th>
                <th class="fs-table-row fs-docs-col-2 table-r-text" scope="col" style="width: 25%;">Действие</th>
                <th class="fs-table-row fs-docs-col-2 table-r-text" scope="col" style="width: 25%;">Ответственный</th>
                <th class="fs-table-row fs-docs-col-4 table-r-text" scope="col" style="">Комментарий</th>
            </tr>
        </thead>
        <tbody>
            @if ($equipmentJournal)
                @foreach ($equipmentJournal as $equipmentJournalItem)
                    <tr class="table-row" data-id="{{ $equipmentJournalItem->eqj_id }}">
                        <td class="fs-t-eq-journal-row fs-table-row table-row-th table-r-text client-name-row fs-t-eq-journal-date" scope="row" data-id="{{ $equipmentJournalItem->eqj_id }}">{{ Carbon\Carbon::parse($equipmentJournalItem->eqj_datetime)->translatedFormat('d F Y')}}</td>
                        <td class="fs-t-eq-journal-row fs-table-row table-row-th table-r-text fs-t-eq-journal-status" scope="row">{{ $equipmentJournalItem?->eqj_status }}</td>
                        <td class="fs-t-eq-journal-row fs-table-row table-row-th table-r-text fs-t-eq-journal-client" scope="row">{{ $equipmentJournalItem?->client?->cli_name_view }}</td>
                        <td class="fs-t-eq-journal-row fs-table-row table-row-th table-r-text fs-t-eq-journal-comment" scope="row">{{ $equipmentJournalItem->eqj_comment }}</td>
                    </tr>
                @endforeach
            @endif
            
            
        </tbody>
        {{-- <td class="fs-table-row" scope="row">{{ $client->cli_sync_1c_status }}</td> --}}
    </table>
</div>
