{{-- Эта таблица будет перерисовываться при каждом AJAX-запросе --}}
<table class="table block fs-table-style-3" style="width: 100%; table-layout: fixed;" id="equipment-table">
    <thead>
        <tr>
            <th class="fs-table-row fs-docs-col-1 table-r-text table-top-left-corner" 
                style="width: 10%; cursor: pointer;"
                data-sort="doc_sup_prov_id ">
                Поставщик
                @if(request('sort') === 'doc_sup_prov_name ')
                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                @endif
            </th>
            <th class="fs-table-row fs-docs-col-2 table-r-text" 
                style="width: 7%; cursor: pointer;"
                data-sort="doc_sup_prov_name ">
                Наименование
                @if(request('sort') === 'doc_sup_name')
                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                @endif
            </th>
            <th class="fs-table-row fs-docs-col-3 table-r-text" 
                style="width: 5%; cursor: pointer;"
                data-sort="doc_sup_name">
                Дата
                @if(request('sort') === 'doc_sup_date')
                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                @endif
            </th>
            <th class="fs-table-row fs-docs-col-3 table-r-text" 
                style="width: 17%; cursor: pointer;"
                data-sort="doc_sup_date">
                Коментарий
                @if(request('sort') === 'doc_sup_date')
                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                @endif
            </th>
            
        </tr>
    </thead>
    <tbody class="main-table-tbody">
        @forelse($Documents as $Document)
            <tr class="table-row" data-id="{{ $Document->doc_sup_id  }}">
                <th class="fs-table-row fs-t-eq-row table-row-th table-r-text" scope="row">
                    {{ $Document->provider->prov_name ?? '' }}
                </th>
                <td class="fs-table-row fs-t-eq-row table-row-th table-r-text" scope="row">
                    {{ $Document->doc_sup_name ?? '' }}
                </td>
                <td class="fs-table-row fs-t-eq-row table-row-th table-r-text" scope="row" >
                    {{ $Document->doc_sup_date }}
                </td>
                <td class="fs-table-row fs-t-eq-row table-row-th table-r-text client-name-row" data-id="{{ $Document->doc_sup_id }}" scope="row">
                    {{ $Document->doc_sup_comment }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Нет данных</td>
            </tr>
        @endforelse
    </tbody>
</table>

