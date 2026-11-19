<div class="fl-popup-form-container block fl-align">
    <div class="form fl-popup-form block fl-align">

        <div class="form-div-group block fl-sp-btw fl-al-start">
            <div class="form-div-group-col form-div block popup-user-info-block popup-section-row block fl-col">
                

                <div class="popup-user-tag-block popup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">Наименование</p>
                    </div>
                    <div class="hbnd-card-row putb-st-2">
                        <p class="hbnd-card-row-text">{{ $Equipment->eq_name }}</p>
                    </div>
                </div>

                <div class="popup-user-tag-block popup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">Серийный номер</p>
                    </div>
                    <div class="hbnd-card-row putb-st-2">
                        <p class="hbnd-card-row-text">{{ $Equipment->eq_serial_number }}</p>
                    </div>
                </div>

                <div class="popup-user-tag-block popup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">Инвентарный номер</p>
                    </div>
                    <div class="hbnd-card-row putb-st-2">
                        <p class="hbnd-card-row-text">{{ $Equipment->eq_inventory_number}}</p>
                    </div>
                </div>

                <div class="popup-user-tag-block popup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">Ответственный</p>
                    </div>
                    <div class="hbnd-card-row putb-st-2">
                        <p class="hbnd-card-row-text">{{ $Equipment->client?->cli_name_view}}</p>
                    </div>
                </div>

                <div class="popup-user-tag-block popup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">Подразделение Ответственного</p>
                    </div>
                    <div class="hbnd-card-row putb-st-2">
                        <p class="hbnd-card-row-text">{{ $Equipment->client?->division?->div_name_full}}</p>
                    </div>
                </div>

                <div class="popup-user-tag-block popup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">Подразделение ед.техн</p>
                    </div>
                    <div class="hbnd-card-row putb-st-2">
                        <p class="hbnd-card-row-text">{{ $Equipment->division?->div_name_full}}</p>
                    </div>
                </div>
                    
                
                <div class="popup-section-row block fl-row">
                    <div class="popup-user-tag-block popup-section-row-col fl-col">
                        <div class="popup-user-tag-label-row">
                            <p class="popup-user-tag-label-text">Статус</p>
                        </div>
                        <div class="hbnd-card-row putb-st-0 ">
                            <p class="hbnd-card-row-text">{{ $Equipment->EquipmentStatus->eqs_name }}</p>
                        </div>
                    </div>
                    <div class="popup-user-tag-block popup-section-row-col fl-col">
                        <div class="popup-user-tag-label-row">
                            <p class="popup-user-tag-label-text">Тип</p>
                        </div>
                        <div class="hbnd-card-row putb-st-0 ">
                            <p class="hbnd-card-row-text">{{ $Equipment->EquipmentType->eqt_name }}</p>
                        </div>
                    </div>
                    <div class="popup-user-tag-block popup-section-row-col fl-col">
                        <div class="popup-user-tag-label-row">
                            <p class="popup-user-tag-label-text">Название документа</p>
                        </div>
                        <div class="hbnd-card-row putb-st-0 ">
                            <p class="hbnd-card-row-text">{{ $Equipment->import_doc }}</p>
                        </div>
                    </div>
                </div>


                <div class="popup-user-tag-block popup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">комментарий</p>
                    </div>
                    <div class="form-comment hbnd-card-row putb-st-2">
                        <p class="hbnd-card-row-text">{{ $Equipment->eq_comment }}</p>
                    </div>
                </div>

            </div>


            <div class="form-div block popup-user-info-block popup-section-row block fl-col">
                
                <table class="table block fs-table-style-3" style="width: 100%; table-layout: fixed; background: var(--hb-mdp-table-border-color-1);">
                    <thead>
                        <tr>
                            <th class="fs-table-row fs-docs-col-1 table-r-text table-top-left-corner" scope="col" style="width: 25%;">Дата</th>
                            <th class="fs-table-row fs-docs-col-2 table-r-text" scope="col" style="width: 25%;">Действие</th>
                            <th class="fs-table-row fs-docs-col-2 table-r-text" scope="col" style="width: 25%;">Ответственный</th>
                            <th class="fs-table-row fs-docs-col-4 table-r-text" scope="col" style="">Комментарий</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($EquipmentJournal)
                            @foreach ($EquipmentJournal as $equipmentJournalItem)
                                <tr class="table-row" data-id="{{ $equipmentJournalItem->eqj_id }}">
                                    <td class="fs-t-eq-journal-row fs-table-row table-row-th table-r-text client-name-row fs-t-eq-journal-date" scope="row" data-id="{{ $equipmentJournalItem->eqj_id }}">{{ Carbon\Carbon::parse($equipmentJournalItem->eqj_datetime)->translatedFormat('d F Y')}}</td>
                                    <td class="fs-t-eq-journal-row fs-table-row table-row-th table-r-text fs-t-eq-journal-status" scope="row">{{ $equipmentJournalItem?->eqj_status }}</td>
                                    <td class="fs-t-eq-journal-row fs-table-row table-row-th table-r-text fs-t-eq-journal-client" scope="row">{{ $equipmentJournalItem?->client?->cli_name_view }}</td>
                                    <td class="fs-t-eq-journal-row fs-table-row table-row-th table-r-text fs-t-eq-journal-comment" scope="row">{{ $equipmentJournalItem->eqj_comment }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
        </div>

       
        
    
        
    </div>
</div>