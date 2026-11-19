<table class="table block fs-table-style-3" style="width: 100%; table-layout: fixed;">
    <!-- <caption>
        Все классы Flexstyles
    </caption> -->
    <thead>
        <tr>
            <th class="fs-table-row fs-docs-col-1 table-r-text table-top-left-corner" scope="col" style="width: 100px;">Статус</th>
            <th class="fs-table-row fs-docs-col-2 table-r-text" scope="col" style="width: 7%;">Тип</th>
            <th class="fs-table-row fs-docs-col-3 table-r-text" scope="col" style="width: 22%;">Наименование</th>
            <th class="fs-table-row fs-docs-col-3 table-r-text" scope="col" style="width: 12%;">Серийный №</th>
            <th class="fs-table-row fs-docs-col-3 table-r-text" scope="col" style="width: 5%;">Инв №</th>
            <th class="fs-table-row fs-docs-col-4 table-r-text" scope="col" style="width: 5%;">№ Карты</th>
            <th class="fs-table-row fs-docs-col-4 table-r-text" scope="col" style="width: 22%;">Подразделение ответственного</th>
            <th class="fs-table-row fs-docs-col-4 table-r-text" scope="col" style="">Подразделение ед.техники</th>
        </tr>
    </thead>
    <tbody>

        @if ($Equipments)
            @foreach ($Equipments as $equipment)
                
                <tr class="table-row" data-id="{{ $equipment->eq_id }}">
                    <th class="fs-table-row table-row-th table-r-text" scope="row">
                        @if ($equipment->eq_status_id !== null)
                            {{ $equipment->equipmentStatus->eqs_name }}
                        @endif
                    </th>
                    <td class="fs-table-row table-row-th table-r-text" scope="row">
                        @if ($equipment->eq_type_id !== null)
                            {{ $equipment->equipmentType->eqt_name }}
                        @endif
                    </td>
                    <td class="fs-table-row table-row-th table-r-text client-name-row" scope="row" data-id="{{ $equipment->eq_id }}">{{ $equipment->eq_name}}</td>
                    <td class="fs-table-row table-row-th table-r-text" scope="row">{{ $equipment->eq_serial_number }}</td>
                    <td class="fs-table-row table-row-th table-r-text" scope="row">{{ $equipment->eq_inventory_number }}</td>
                    <td class="fs-table-row table-row-th table-r-text" scope="row">{{ $equipment->eq_cart_number }}</td>
                    <td class="fs-table-row table-row-th table-r-text" scope="row">{{ $equipment->eq_comment }}</td>
                    <td class="fs-table-row table-row-th table-r-text" scope="row">{{ $equipment->import_div }}</td>
                    
                </tr>
                
            @endforeach
            
        @endif
        
    </tbody>
    {{-- <td class="fs-table-row" scope="row">{{ $client->cli_sync_1c_status }}</td> --}}
</table>