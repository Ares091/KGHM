{{-- Эта таблица будет перерисовываться при каждом AJAX-запросе --}}
<table class="table block fs-table-style-3" style="width: 100%; table-layout: fixed;" id="equipment-table">
    <thead>
        <tr>
            <th class="fs-table-row fs-docs-col-1 table-r-text table-top-left-corner" 
                style="width: 100px; cursor: pointer;" data-sort="eq_status_id">
                Статус
                @if(request('sort') === 'eq_status_id')
                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                @endif
            </th>
            <th class="fs-table-row fs-docs-col-2 table-r-text" 
                style="width: 7%; cursor: pointer;" data-sort="eq_type_id">
                Тип
                @if(request('sort') === 'eq_type_id')
                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                @endif
            </th>
            <th class="fs-table-row fs-docs-col-3 table-r-text" 
                style="width: 22%; cursor: pointer;" data-sort="eq_name">
                Наименование
                @if(request('sort') === 'eq_name')
                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                @endif
            </th>
            <th class="fs-table-row fs-docs-col-3 table-r-text" 
                style="width: 12%; cursor: pointer;" data-sort="eq_serial_number">
                Серийный №
                @if(request('sort') === 'eq_serial_number')
                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                @endif
            </th>
            <th class="fs-table-row fs-docs-col-3 table-r-text" 
                style="width: 5%; cursor: pointer;" data-sort="eq_inventory_number">
                Инв №
                @if(request('sort') === 'eq_inventory_number')
                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                @endif
            </th>
            <th class="fs-table-row fs-docs-col-4 table-r-text" 
                style="width: 5%; cursor: pointer;" data-sort="eq_cart_number">
                № Карты
                @if(request('sort') === 'eq_cart_number')
                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                @endif
            </th>
            <th class="fs-table-row fs-docs-col-4 table-r-text" 
                style="width: 22%; cursor: pointer;" data-sort="eq_cli_name_view">
                ФИО ответственного
                @if(request('sort') === 'eq_cli_name_view')
                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                @endif
            </th>
            <th class="fs-table-row fs-docs-col-4 table-r-text" 
                style="cursor: pointer;" data-sort="import_div">
                Подразделение ед.техники
                @if(request('sort') === 'import_div')
                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                @endif
            </th>
        </tr>
    </thead>
    <tbody class="main-table-tbody">
        @forelse($equipments as $equipment)
            @php
                //$tableType === "AdminTable" && $client->cli_disable === true && $client->cli_sync_1c === true
                if ($equipment?->client?->cli_disable === true) {
                    $additionalClass = 'tr-responsible-disabled';
                }
                else if ($equipment?->eq_status_id === null || ($equipment?->eq_div_id === null && $equipment?->client?->cli_div_id === null)) {
                    $additionalClass = 'non-type-equipment';
                }
                else {
                    $additionalClass = '';
                }
            @endphp
            <tr class="table-row {{ $additionalClass }}" data-id="{{ $equipment->eq_id }}">
                <th class="fs-table-row fs-t-eq-row table-row-th table-r-text" scope="row">
                    {{ $equipment->equipmentStatus->eqs_name ?? '' }}
                </th>
                <td class="fs-table-row fs-t-eq-row table-row-th table-r-text" scope="row">
                    {{ $equipment->equipmentType->eqt_name ?? '' }}
                </td>
                <td class="fs-table-row fs-t-eq-row table-row-th table-r-text client-name-row" scope="row" data-id="{{ $equipment->eq_id }}">
                    {{ $equipment->eq_name }}
                </td>
                <td class="fs-table-row fs-t-eq-row table-row-th table-r-text" scope="row">
                    {{ $equipment->eq_serial_number }}
                </td>
                <td class="fs-table-row fs-t-eq-row table-row-th table-r-text" scope="row">
                    {{ $equipment->eq_inventory_number }}
                </td>
                <td class="fs-table-row fs-t-eq-row table-row-th table-r-text" scope="row">
                    {{ $equipment->eq_cart_number }}
                </td>
                <td class="fs-table-row fs-t-eq-row table-row-th table-r-text" scope="row">
                    {{ $equipment?->client?->cli_name_view }}
                </td>
                <td class="fs-table-row fs-t-eq-row table-row-th table-r-text" scope="row">
                    {{ $equipment->import_div }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Нет данных</td>
            </tr>
        @endforelse
    </tbody>
</table>

