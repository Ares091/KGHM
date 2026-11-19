<table class="table block fs-table-style-3">
    <!-- <caption>
        Все классы Flexstyles
    </caption> -->
    @if ($items && $searchItemType === 'clients')
        <thead style="position: sticky; top: 0; z-index: 1;">
            <tr>
                <th class="fs-table-row fs-docs-col-1 table-top-left-corner" scope="col">Имя</th>
                <th class="fs-table-row fs-docs-col-2" scope="col">Должность</th>
                <th class="fs-table-row fs-docs-col-4 table-top-right-corner" scope="col">Подразделение</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($items as $item)
                
                <tr class="form-table-div-row table-row">
                    <th class="form-table-row fs-table-row table-row-th client-name-row" scope="row" data-id="{{ $item->cli_id }}">{{ $item->cli_name_view }}</th>
                    <td class="form-table-row fs-table-row table-row-th" scope="row">{{ $item->cli_prof }}</td>
                    <td class="form-table-row fs-table-row table-row-th client-div-row" data-div-id="{{ $item->cli_div_id }}" scope="row">{{ $item->division->div_name_full }}</td>
                </tr>
                
            @endforeach
        
        </tbody>
    @endif
    {{-- <td class="fs-table-row" scope="row">{{ $item->cli_sync_1c_status }}</td> --}}
</table>