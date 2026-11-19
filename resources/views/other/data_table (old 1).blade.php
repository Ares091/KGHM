<table class="table block fs-table-style-3">
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
    <tbody>

        @if ($clients)
            
            @foreach ($clients as $client)
                @if ($tableType === "AdminTable" && $client->cli_disable === true && $client->cli_sync_1c === true)
                    <tr class="table-row tr-disabled" data-id="{{ $client->cli_id }}">
                        @if ( $pageIsMain === false || $pageIsMain === 0)
                           
                            @if ($client->cli_sync_1c === true)
                                <td class="fs-table-row table-row-th fs-t-row-1c td-row-1c-sync-true" scope="row">✔</th>
                            @else
                                <td class="fs-table-row table-row-th fs-t-row-1c td-row-1c-sync-false" scope="row">✘</th>
                            @endif
                        @endif
                        <th class="fs-table-row table-row-th client-name-row" scope="row" data-id="{{ $client->cli_id }}">{{ $client->cli_name_view }}</th>
                        <td class="fs-table-row table-row-th" scope="row">{{ $client->cli_prof }}</td>
                        <td class="fs-table-row table-row-th" scope="row">{{ $client->cli_tel_work }}</td>
                        <td class="fs-table-row table-row-th" scope="row">{{ $client->cli_tel_work2 }}</td>
                        <td class="fs-table-row table-row-th" scope="row">{{ $client->cli_tel_mobile }}</td>
                        @if(request()->routeIs('directorPage'))
                            <td class="fs-table-row table-row-th" scope="row">{{ $client->cli_email }}</td>
                        @else
                            <td class="fs-table-row table-row-th" scope="row">{{ $client->cli_email }}</td>
                        @endif
                        
                        <td class="fs-table-row table-row-th" scope="row">{{ $client->cli_sync_1c_status }}</td>
                    </tr>
                @else
                    <tr class="table-row" data-id="{{ $client->cli_id }}">
                        @if ($pageIsMain === false || $pageIsMain === 0) 
                            @if ($client->cli_sync_1c === true)
                                <td class="fs-table-row table-row-th fs-t-row-1c td-row-1c-sync-true" scope="row">✔</th>
                            @else
                                <td class="fs-table-row table-row-th fs-t-row-1c td-row-1c-sync-false" scope="row">✘</th>
                            @endif
                        @endif
                        <th class="fs-table-row table-row-th client-name-row" scope="row" data-id="{{ $client->cli_id }}">{{ $client->cli_name_view }}</th>
                        <td class="fs-table-row table-row-th" scope="row">{{ $client->cli_prof }}</td>
                        <td class="fs-table-row table-row-th" scope="row">{{ $client->cli_tel_work }}</td>
                        <td class="fs-table-row table-row-th" scope="row">{{ $client->cli_tel_work2 }}</td>
                        <td class="fs-table-row table-row-th" scope="row">{{ $client->cli_tel_mobile }}</td>
                        @if(request()->routeIs('directorPage'))
                            @if ($client->cli_email !== null)
                                <td class="fs-table-row table-row-th handbook-mini-pop-i-block" scope="row">
                                    <span class="table-row-th-text">{{ $client->cli_email }}</span>
                                    <img src="../sources/media/icons/copy2_64.png" alt="" class="handbook-mini-pop-icon handbook-mini-pop-i-copy img" style="width: 16px; height: 16px;">
                                    <img src="../sources/media/icons/message2_64.png" alt="" class="handbook-mini-pop-icon handbook-mini-pop-i-mail img" style="width: 16px; height: 16px;">
                                </td>
                            @else
                                <td class="fs-table-row table-row-th" scope="row">
                                    <span class="table-row-th-text">{{ $client->cli_email }}</span>
                                </td>
                            @endif
                            
                        @else
                            <td class="fs-table-row table-row-th" scope="row"><a style="color: var(--text-c-0);" href="mailto:{{ $client->cli_email  }}">{{ $client->cli_email }}</a></td>
                        @endif
                        <td class="fs-table-row table-row-th" scope="row">{{ $client->cli_sync_1c_status }}</td>
                    </tr>
                @endif
                
                
                
            @endforeach
            
        @endif
        
    </tbody>
    {{-- <td class="fs-table-row" scope="row">{{ $client->cli_sync_1c_status }}</td> --}}
</table>