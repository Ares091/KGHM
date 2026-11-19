@if ($tableComponentType === 'cards')
    <div class="handbook-body-r-nd-cards-block-content block fl-row fl-wrap">

        @if ($clients)
            @foreach ($clients as $client)
                <div class="hbnd-card table-row fl-align" data-id="{{ $client->cli_id }}">
                    <div class="hbnd-card-inner block fl-align fl-sp-btw fl-col">

                        <div class="hbnd-card-row fl-align client-name-row" data-id="{{ $client->cli_id }}">
                            {{-- <img src="" alt="" class="hbnd-card-row-icon"> --}}
                            <p class="hbnd-card-row-text">{{ $client->cli_name_view }}</p>
                        </div>

                        <div class="hbnd-card-row hbnd-card-prof fl-align">
                            {{-- <img src="" alt="" class="hbnd-card-row-icon"> --}}
                            <p class="hbnd-card-row-text">{{ $client->cli_prof }}</p>
                        </div>

                        <div class="hbnd-card-row-group block fl-sp-btw">
                            <div class="hbnd-card-row hbnd-card-row-50 fl-align">
                                {{-- <img src="" alt="" class="hbnd-card-row-icon"> --}}
                                <p class="hbnd-card-row-text">{{ $client->cli_tel_work }}</p>
                            </div>

                            <div class="hbnd-card-row hbnd-card-row-50 fl-align">
                                {{-- <img src="" alt="" class="hbnd-card-row-icon"> --}}
                                <p class="hbnd-card-row-text">{{ $client->cli_tel_work2 }}</p>
                            </div>
                        </div>

                        <div class="hbnd-card-row fl-align">
                            {{-- <img src="" alt="" class="hbnd-card-row-icon"> --}}
                            <p class="hbnd-card-row-text">{{ $client->cli_tel_mobile }}</p>
                        </div>
                        
                        <div class="hbnd-card-row fl-align">
                            {{-- <img src="" alt="" class="hbnd-card-row-icon"> --}}
                            <p class="hbnd-card-row-text">{{ $client->cli_email }}</p>
                        </div>

                        <div class="hbnd-card-row fl-align">
                            {{-- <img src="" alt="" class="hbnd-card-row-icon"> --}}
                            <p class="hbnd-card-row-text">{{ $client->cli_sync_1c_status }}</p>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        @endif
        
    </div>
@else 
    {{-- пример таблицы в противном случае --}}
    <table class="table block fs-table-style-3 {{ !$pageIsMain ? 'fixed-table' : ''}}">
    <!-- <caption>
        Все классы Flexstyles
    </caption> -->
    <thead>
        <tr>
            @if (!request()->routeIs('index') && $pageIsMain === false || $pageIsMain === 0)
                <th class="fs-table-row fs-docs-col-1 table-top-left-corner" scope="col">1c</th>            
            @endif
            <th class="fs-table-row fs-docs-col-1" scope="col">Имя</th>
            <th class="fs-table-row fs-docs-col-2" scope="col">Должность</th>
            <th class="fs-table-row fs-docs-col-3" scope="col">Тел. город</th>
            <th class="fs-table-row fs-docs-col-3" scope="col">Тел. Внутренний</th>
            <th class="fs-table-row fs-docs-col-3" scope="col">Тел. Мобильный</th>
            <th class="fs-table-row fs-docs-col-4 table-top-right-corner" scope="col">Эл.Почта</th>
            <th class="fs-table-row fs-docs-col-4 table-top-right-corner" scope="col">Статус</th>
        </tr>
    </thead>
    <tbody class="main-table-tbody">
        
    </tbody>
    {{-- <td class="fs-table-row" scope="row">{{ $client->cli_sync_1c_status }}</td> --}}
</table>
@endif