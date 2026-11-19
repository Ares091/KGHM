{{-- Публичная информация о пользователе --}}
<div class="handbook-body-right-section-note-panel-public-content">
    <table class="table block fs-table-style-3">
        <tbody>
            @if ($doc_sup_id)
                {{-- <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Статус</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $eq_id->eq_status_id !== null ? $eq_id->EquipmentStatus->eqs_name : "" }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Тип</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $eq_id->import_type !== null ? $eq_id->import_type : "" }}</td>
                </tr> --}}
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Дата</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $doc_sup_id->doc_sup_date }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Поставщик</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $doc_sup_id->doc_sup_prov_name }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Наименование</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $doc_sup_id->doc_sup_name }}</td>
                </tr class="table-note-t-row">
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Комментарий</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $doc_sup_id->doc_sup_comment }}</td>
                </tr class="table-note-t-row">
                    {{-- <tr>
                    <th class="fs-table-row" scope="row">Комментарий</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $eq_id?->eq_cart_number !== null ? $eq_id?->eq_cart_number : "" }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Ответственный</th>
                    @if ($eq_id?->eq_client_id !== null && $eq_id?->client?->cli_name_view !== null)
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $eq_id?->client?->cli_name_view}}</td>
                    @else
                         <td class="fs-table-row table-n-t-r-info" scope="row"></td>
                    @endif
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Подразделение Ответственного</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $eq_id?->client?->division?->div_name_full }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Подразделение ед.техн</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $eq_id?->division?->div_name_full }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Документ</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $eq_id->import_doc }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Комментарий</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $eq_id->eq_comment }}</td>
                </tr> --}}
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

{{-- <div class="handbook-body-right-section-note-panel-private-content">
    

    <table class="table block fs-table-style-3" style="width: 100%; table-layout: fixed;">
        
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
                        <td class="fs-table-row table-row-th table-r-text client-name-row" scope="row" data-id="{{ $equipmentJournalItem->eqj_id }}">{{ $equipmentJournalItem->eqj_datetime }}</td>
                        <td class="fs-table-row table-row-th table-r-text" scope="row">{{ $equipmentJournalItem?->eqj_status }}</td>
                        <td class="fs-table-row table-row-th table-r-text" scope="row">{{ $equipmentJournalItem?->client?->cli_name_view }}</td>
                        <td class="fs-table-row table-row-th table-r-text" scope="row">{{ $equipmentJournalItem->eqj_comment }}</td>
                    </tr>
                @endforeach
            @endif
            
            
        </tbody>
    </table>
</div> --}}
