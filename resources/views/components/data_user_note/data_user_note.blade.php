{{-- Публичная информация о пользователе --}}
<div class="handbook-body-right-section-note-panel-public-content">
    <table class="table block fs-table-style-3">
        <tbody>
            @if ($cli)
                @if ($cli->cli_disable === true)
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row" style="width: 25%;">Имя</th>
                        <td class="table-note-t-row fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_name_view }}</td>
                    </tr>
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Статус</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">Запись отключена</td>
                    </tr>
                @else
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row" style="width: 25%;">Имя</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_name_view }}</td>
                    </tr>
                    <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Должность</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_prof }}</td>
                    </tr>

                    @if ($cli->division->div_parent_id !== null)
                        <tr class="table-note-t-row">
                            <th class="fs-table-row" scope="row">Отдел</th>
                            <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->division->parent->div_name_full }}</td>
                        </tr>

                        <tr class="table-note-t-row">
                            <th class="fs-table-row" scope="row">Подразделение</th>
                            <td class="fs-table-row table-n-t-r-info table-r-div-name" scope="row">{{ $cli->division->div_name_full }}</td>
                        </tr>
                    @else
                        <tr class="table-note-t-row">
                            <th class="fs-table-row" scope="row">Отдел</th>
                            <td class="fs-table-row table-n-t-r-info table-r-div-name" scope="row">{{ $cli->division->div_name_full }}</td>
                        </tr>
                    @endif
                    
                    
                    {{-- <tr class="table-note-t-row">
                        <th class="fs-table-row" scope="row">Статус</th>
                        <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_sync_1c_status }}</td>
                    </tr> --}}
                    
                @endif
                
            @endif
        </tbody>
        <!-- <tfoot>
            <tr>
                <th class="fs-table-row table-bottom-left-corner" scope="row" colspan="3">Итого классов</th>
                <th class="fs-table-row table-bottom-right-corner">20</td>
            </tr>
        </tfoot> -->
    </table>

    <table class="table block fs-table-style-3">
        <tbody>
            @if ($cli)
                <tr class="table-note-t-row">
                    <td class="fs-table-row" scope="row" style="width: 25%;">Тел. Город</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_tel_work }}</td>
                
                    <td class="fs-table-row" scope="row">Тел. Внутренний</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_tel_work2 }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <td class="fs-table-row" scope="row">Эл. почта</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_email }}</td>
                    <td class="fs-table-row" scope="row">Статус</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_sync_1c_status }}</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>



{{-- Приватная информация о пользователе --}}
<div class="handbook-body-right-section-note-panel-private-content">
    @if ($cli && $cli->cli_disable === false && $user && $user->u_role !== 'user') 
        <table class="table block fs-table-style-3">
            <tbody>
                 @php
                    $phoneArray = [];
                    if($cli->cli_mobile_phone !== null) {
                        $phoneArray = explode(',', $cli->cli_mobile_phone, 2);
                    }
                 @endphp    
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Дата Рождения</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ Carbon\Carbon::parse($cli->cli_date_born)->translatedFormat('d F Y')}}</td>
                    
                    {{-- <th class="fs-table-row" scope="row">Эл. почта</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row"></td> --}}
                </tr>       
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Тел. Мобильный</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{$phoneArray[0] ?? ""  }}</td>
                </tr>  
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Телефон родственника</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{array_key_exists(1, $phoneArray) ? $phoneArray[1] : '' }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Адрес Прописки</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_address }}</td>
                </tr>
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Адрес Проживания</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{ $cli->cli_adress_actual }}</td>
                </tr>
                {{-- <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Доп.Информация</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row"></td>
                </tr> --}}
            </tbody>
        </table>
    @elseif ($user && $user->u_role !== 'user')
        <table class="table block fs-table-style-3">
            <tbody>
                 @php
                    $phoneArray = [];
                    if($cli->cli_mobile_phone !== null) {
                        $phoneArray = explode(',', $cli->cli_mobile_phone, 2);
                    }
                 @endphp    
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Тел. Мобильный</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{$phoneArray[0] ?? "" }}</td>
                </tr>  
                <tr class="table-note-t-row">
                    <th class="fs-table-row" scope="row">Телефон родственника</th>
                    <td class="fs-table-row table-n-t-r-info" scope="row">{{array_key_exists(1, $phoneArray) ? $phoneArray[1] : '' }}</td>
                </tr>
        </table>
    @endif

    
</div>