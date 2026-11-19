<table class="table block fs-table-style-3 fixed-table-2">
    <!-- <caption>
        Все классы Flexstyles
    </caption> -->
    @if ($items)
        <thead style="position: sticky; top: 0; z-index: 1;">
            <tr>
                <th class="fs-table-row fs-docs-col-2" style="width: 0%;" scope="col">+</th>
                <th class="fs-table-row fs-docs-col-1 table-top-left-corner" style="width: 20%;" scope="col">Наименование</th>
                <th class="fs-table-row fs-docs-col-2" style="width: 2%;" scope="col">№ карточки</th>
                <th class="fs-table-row fs-docs-col-4 table-top-right-corner" style="width: 18%;" scope="col">ФИО ответственного</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($items as $item)
                
                <tr class="form-table-div-row table-row" data-id="{{ $item->eq_id }}">
                    <td class="form-table-row fs-table-row table-row-th" scope="row">
                        <input type="checkbox" class="eq-export-checkbox" name="eq_ids[]" value="{{ $item->eq_id }}" checked>
                    </td>
                    <td class="form-table-row fs-table-row table-row-th" scope="row">{{ $item->eq_name }}</td>
                    <th class="form-table-row fs-table-row table-row-th client-name-row" scope="row">{{ $item->eq_cart_number }}</th>
                    <td class="form-table-row fs-table-row table-row-th client-div-row" scope="row">{{ $item?->client?->cli_name_view }}</td>
                </tr>
                
            @empty
                <tr class="form-table-div-row table-row"><td colspan="4" class="form-table-row fs-table-row table-row-th">Нет записей для экспорта</td></tr>
            @endforelse
        
        </tbody>
    @endif
    
</table>