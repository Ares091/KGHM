<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('newEquipmentActionStatus') }}" method="POST" class="form fl-popup-form block fl-align fl-col" enctype="multipart/form-data">

        @csrf

        @if ($popupType === "give" || $popupType === "rewrite")
            <div class="form-table-div-container block fl-align fl-sp-btw fl-al-start fl-stretch">
                {{-- <label for="message_theme" class="label form-label form-popup-l-text">
                    Выбрать сотрудника
                </label> --}}
                <div class="form-table-div-block-col" style="width: 48%; padding: 10px; background: #676a6d; border-radius: 17px;">
                    <div class="form-table-div-block block fl-align">
                        <div class="form-table-div-block-inner block fl-align fl-col">

                            {{-- <div class="form-table-search-block block fl-align">
                                <div class="form-div block fl-col">
                                    <label for="message_theme" class="label form-label form-popup-l-text">
                                        Выбрать сотрудника
                                    </label>
                                    <input type="text" class="input form-input form-popup-i-text" id="u_password" name="u_password">
                                </div>
                            </div> --}}
                            <div class="form-table-search-block block fl-align">
                                <div class="form-div block fl-col">
                                    <label for="search_client" class="label form-label form-table-search-bar-label form-popup-l-text">
                                        Выбрать сотрудника
                                    </label>
                                    <div class="form-table-search-bar-container block fl-row">
                                        <div class="input-search-box-bar search-box-bar search-box-bar-styles-2 block fl-row">
                                            <div class="search-icon-container">
                                                <img src="../sources/media/icons/search.svg" alt="" class="search-icon">
                                            </div>
                                            <input type="text" class="form-table-search-input search-input search-input-2 input search-input-width-standart" id="search_client" name="search_client" data-search-type="clients" placeholder="Поиск сотрудника">
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                                
                            
                            
                            <div class="form-table-div-block-main-container block" style="margin-top: 5px; border-radius: 17px; overflow: hidden; border: 5px #484d55 solid; width: calc(100% - 10px);">
                                <div class="form-table-div-block-main-container-inner block" style="height: 300px; overflow-y: overlay; overflow-x: hidden; background: var(--hb-mdp-table-border-color-1); border-radius: 10px;">
                                    <table class="table block fs-table-style-3">
                                        <!-- <caption>
                                            Все классы Flexstyles
                                        </caption> -->
                                        <thead style="position: sticky; top: 0; z-index: 1;">
                                            <tr>
                                                <th class="fs-table-row fs-docs-col-1 table-top-left-corner" scope="col">Имя</th>
                                                <th class="fs-table-row fs-docs-col-2" scope="col">Должность</th>
                                                <th class="fs-table-row fs-docs-col-4 table-top-right-corner" scope="col">Подразделение</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($clients)
                                                @foreach ($clients as $client)
                                                    
                                                    <tr class="form-table-div-row table-row">
                                                        <th class="form-table-row fs-table-row table-row-th client-name-row" scope="row" data-id="{{ $client->cli_id }}">{{ $client->cli_name_view }}</th>
                                                        <td class="form-table-row fs-table-row table-row-th" scope="row">{{ $client->cli_prof }}</td>
                                                        <td class="form-table-row fs-table-row table-row-th client-div-row" data-div-id="{{ $client->cli_div_id }}" scope="row">{{ $client->division->div_name_full }}</td>
                                                    </tr>
                                                    
                                                @endforeach
                                                
                                            @endif
                                            
                                        </tbody>
                                        {{-- <td class="fs-table-row" scope="row">{{ $client->cli_sync_1c_status }}</td> --}}
                                    </table>
                                </div>
                                
                            </div>
                        
                            
                        </div>
                    </div>

                </div>

                <div class="form-table-div-block-col" style="width: 48%; padding: 10px; background: #676a6d; border-radius: 17px;">
                    <div class="block fl-col">
                        <div class="form-div-group block fl-sp-btw">
                            <div class="form-div form-div-55 fl-col">
                                <label for="eq_name" class="label form-label form-popup-l-text">
                                    Наименование техники
                                </label>
                                <input type="text" class="input form-input form-popup-i-text" value="{{ $activeEquipment->eq_name }}" id="eq_name" name="eq_name">
                            </div>

                            <div class="form-div form-div-20 fl-col">
                                <label for="eq_id" class="label form-label form-popup-l-text">
                                    Id техники
                                </label>
                                <input type="text" class="input form-input form-popup-i-text" value="{{ $activeEquipment->eq_id }}" id="eq_id" name="eq_id">
                            </div>
                            <div class="form-div form-div-25 fl-col">
                                <label for="eq_status_name" class="label form-label form-popup-l-text">
                                    Статус
                                </label>
                                <div class="input form-input form-popup-i-text" id="eq_status_name" name="eq_status_name">{{ $activeEquipment->equipmentStatus->eqs_name }}</div>
                                <input type="hidden" class="input form-input form-popup-i-text" value="{{ $activeEquipment->equipmentStatus->eqs_name ?? ""  }}" id="eq_status_name_1" name="eq_status_name_1">
                            </div>
                        </div>
                        

                        <div class="form-div-group block fl-sp-btw">
                            
                            <div class="form-div block fl-col">
                                <label for="eq_cli_name" class="label form-label form-popup-l-text">
                                    Ответственный
                                </label>
                                <input type="text" class="input form-input form-popup-i-text" value="{{ $responsibleClient->cli_name_view ?? "" }}" id="eq_cli_name" name="eq_cli_name">
                                <input type="text" class="input form-input form-popup-i-text" value="{{ $responsibleClient->cli_id ?? ""  }}" id="eq_client_id" name="eq_client_id" style="display: none">
                            </div>

                            <div class="form-div block fl-col">
                                <label for="eq_date" class="label form-label form-popup-l-text">
                                    Дата
                                </label>
                                <input type="date" class="input form-input form-popup-i-text" id="eq_date" name="eq_date" value="{{ now()->format('Y-m-d') }}">
                            </div>
                        </div>
                        

                        <div class="form-div block fl-col">
                            <label for="eq_div_name" class="label form-label form-popup-l-text">
                                Подразделение
                            </label>
                            <input disabled type="text" class="input form-input form-popup-i-text" value="{{ $responsibleClient->division->div_name_full ?? "" }}" id="eq_div_name" name="eq_div_name">
                            <input type="text" class="input form-input form-popup-i-text" value="{{ $responsibleClient->division->div_id ?? "" }}" id="eq_div_id" name="eq_div_id" style="display: none">
                        </div>

                        <div class="form-div block fl-col">
                            <label for="eq_comment" class="label form-label form-popup-l-text">
                                Комментарий
                            </label>
                            <textarea class="input form-input form-popup-i-text" value="{{ $activeEquipment->eq_comment }}" name="eq_comment" id="eq_comment" style="height: 114px;"></textarea>
                        </div>

                    </div>
                </div>
                
                
            </div>
        @elseif ($popupType === "pass_off")
            <div class="form-table-div-block-col" style="width: 100%; padding: 10px; background: #676a6d; border-radius: 17px;">
                <div class="block fl-col">
                    <div class="form-div-group block fl-sp-btw">
                        <div class="form-div form-div-55 fl-col">
                            <label for="eq_name" class="label form-label form-popup-l-text">
                                Наименование техники
                            </label>
                            <input type="text" class="input form-input form-popup-i-text" value="{{ $activeEquipment->eq_name }}" id="eq_name" name="eq_name">
                        </div>

                        <div class="form-div form-div-20 fl-col">
                            <label for="eq_id" class="label form-label form-popup-l-text">
                                Id техники
                            </label>
                            <input type="text" class="input form-input form-popup-i-text" value="{{ $activeEquipment->eq_id }}" id="eq_id" name="eq_id">
                        </div>
                        <div class="form-div form-div-25 fl-col">
                            <label for="eq_status_name" class="label form-label form-popup-l-text">
                                Статус
                            </label>
                            <div class="input form-input form-popup-i-text" id="eq_status_name" name="eq_status_name">{{ $activeEquipment->equipmentStatus->eqs_name }}</div>
                            <input type="hidden" class="input form-input form-popup-i-text" value="{{ $activeEquipment->equipmentStatus->eqs_name ?? ""  }}" id="eq_status_name_1" name="eq_status_name_1">
                        </div>
                    </div>
                    

                    <div class="form-div-group block fl-sp-btw">
                        
                        <div class="form-div block fl-col">
                            <label for="eq_cli_name" class="label form-label form-popup-l-text">
                                Ответственный
                            </label>
                            <input type="text" class="input form-input form-popup-i-text" value="{{ $responsibleClient->cli_name_view ?? "" }}" id="eq_cli_name" name="eq_cli_name">
                            <input type="text" class="input form-input form-popup-i-text" value="{{ $responsibleClient->cli_id ?? "" }}" id="eq_client_id" name="eq_client_id" style="display: none">
                        </div>

                        <div class="form-div block fl-col">
                            <label for="eq_date" class="label form-label form-popup-l-text">
                                Дата
                            </label>
                            <input type="date" class="input form-input form-popup-i-text" id="eq_date" name="eq_date" value="{{ now()->format('Y-m-d') }}">
                        </div>
                    </div>
                    

                    <div class="form-div block fl-col">
                        <label for="eq_div_name" class="label form-label form-popup-l-text">
                            Подразделение
                        </label>
                        <input type="text" class="input form-input form-popup-i-text" value="{{ $responsibleClient->division->div_name_full ?? ""}}" id="eq_div_name" name="eq_div_name">
                        <input type="text" class="input form-input form-popup-i-text" value="{{ $responsibleClient->division->div_id ?? "" }}" id="eq_div_id" name="eq_div_id" style="display: none">
                    </div>

                    <div class="form-div block fl-col">
                        <label for="eq_comment" class="label form-label form-popup-l-text">
                            Комментарий
                        </label>
                        <textarea class="input form-input form-popup-i-text" value="{{ $activeEquipment->eq_comment }}" name="eq_comment" id="eq_comment" style="height: 114px;"></textarea>
                    </div>

                </div>
            </div>
        @elseif ($popupType === "write_off")
            <div class="form-table-div-block-col" style="width: 100%; padding: 10px; background: #676a6d; border-radius: 17px;">
                <div class="block fl-col">
                    <div class="form-div-group block fl-sp-btw">
                        <div class="form-div form-div-55 fl-col">
                            <label for="eq_name" class="label form-label form-popup-l-text">
                                Наименование техники
                            </label>
                            <input type="text" class="input form-input form-popup-i-text" value="{{ $activeEquipment->eq_name }}" id="eq_name" name="eq_name">
                        </div>

                        <div class="form-div form-div-20 fl-col">
                            <label for="eq_id" class="label form-label form-popup-l-text">
                                Id техники
                            </label>
                            <input type="text" class="input form-input form-popup-i-text" value="{{ $activeEquipment->eq_id }}" id="eq_id" name="eq_id">
                        </div>
                        <div class="form-div form-div-25 fl-col">
                            <label for="eq_status_name" class="label form-label form-popup-l-text">
                                Статус
                            </label>
                            <div class="input form-input form-popup-i-text" id="eq_status_name" name="eq_status_name">{{ $activeEquipment->equipmentStatus->eqs_name ?? "" }}</div>
                            <input type="hidden" class="input form-input form-popup-i-text" value="{{ $activeEquipment->equipmentStatus->eqs_name ?? ""  }}" id="eq_status_name_1" name="eq_status_name_1">
                        </div>
                    </div>

                    
                    

                    <div class="form-div block fl-col">
                        <label for="eq_date" class="label form-label form-popup-l-text">
                            Дата
                        </label>
                        <input type="date" class="input form-input form-popup-i-text" id="eq_date" name="eq_date" value="{{ now()->format('Y-m-d') }}">
                    </div>
                    

                    <div class="form-div block fl-col">
                        <label for="eq_comment" class="label form-label form-popup-l-text">
                            Комментарий
                        </label>
                        <textarea class="input form-input form-popup-i-text" value="{{ $activeEquipment->eq_comment }}" name="eq_comment" id="eq_comment" style="height: 114px;"></textarea>
                    </div>

                    <input type="hidden" class="input form-input form-popup-i-text" value="{{ $responsibleClient->cli_id ?? "" }}" id="eq_client_id" name="eq_client_id" style="display: none">


                </div>
            </div>
        @endif

        {{-- <div class="form-btn-block form-div block fl-align">
            <div class="form-btn popup-form-btn button header-btn button-st-0 ">Отменить</div>
            <div class="form-btn popup-form-btn button header-btn button-st-1 ">Отправить</div>
        </div> --}}

        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 pfb-submit" type="submit">Сохранить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn pfb-cancel">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn">Отмена</button>
        </div>
        

        <input type="hidden" id="selectedRecipient" value="">
        <input type="hidden" class="input form-input form-popup-i-text" value="{{ $popupType }}" id="action_name" name="action_name">
        <input type="hidden" class="input form-input form-popup-i-text" value="{{ $responsibleClient->cli_id ?? "" }}" id="eq_old_cli_id" name="eq_old_cli_id">

        
    </form>

</div>


