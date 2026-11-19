<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('equipmentAddPanel') }}" method="POST" class="form fl-popup-form block fl-align fl-col">

        @csrf

        <div class="form-table-div-container block fl-align fl-sp-btw fl-al-start fl-stretch">
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
                            <div class="form-table-div-block-main-container-inner block" style="height: 51vh; overflow-y: overlay; overflow-x: hidden; background: var(--hb-mdp-table-border-color-1); border-radius: 10px;">
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
                        <div class="form-div block fl-col">
                            <label for="recipients" class="label form-label form-popup-l-text">
                                Статус
                            </label>
                            <select type="text" class="input form-input form-popup-i-text" id="eq_status_id" name="eq_status_id" > 
                                @if ($EquipmentStatuses)
                                    @foreach ($EquipmentStatuses as $EquipmentStatus)
                                        <option value="{{ $EquipmentStatus->eqs_id }}">{{ $EquipmentStatus->eqs_name }}</option>
                                    @endforeach
                                @else
                                    <option value="1">На складе</option>
                                    <option value="2">Выдан</option>
                                    <option value="3">Списан</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-div block fl-col">
                            <label for="recipients" class="label form-label form-popup-l-text">
                                Тип
                            </label>
                            <select type="text" class="input form-input form-popup-i-text" id="eq_type_id" name="eq_type_id" > 
                                @if ($EquipmentTypes)
                                    @foreach ($EquipmentTypes as $EquipmentType)
                                        <option value="{{ $EquipmentType->eqt_id }}">{{ $EquipmentType->eqt_name }}</option>
                                    @endforeach
                                @else
                                    <option value="new-songs">3D принтер</option>
                                    <option value="old-songs">ИБП</option>
                                    <option value="old-songs">Инженерная система</option>
                                    <option value="old-songs">Компьютер</option>
                                    <option value="old-songs">Компьютер-мини</option>
                                    <option value="old-songs">Копир</option>
                                    <option value="old-songs">Ламинатор</option>
                                @endif
                            </select>
                        </div>

                    </div>

                    <div class="form-div block fl-col">
                        <label for="eq_name" class="label form-label form-popup-l-text">
                            Наименование
                        </label>
                        <input type="text" class="input form-input form-popup-i-text" id="eq_name" name="eq_name" placeholder="Canon MF-3228">
                        <span class="form-valid-error" data-field="eq_name"></span>
                    </div>

                    <div class="form-div block fl-col">
                        <label for="eq_serial_number" class="label form-label form-popup-l-text">
                            Серийный номер
                        </label>
                        <input type="text" class="input form-input form-popup-i-text" id="eq_serial_number" name="eq_serial_number" placeholder="1268548 74L8013234">
                        <span class="form-valid-error" data-field="eq_serial_number"></span>
                    </div>

                    <div class="form-div-group block fl-sp-btw">
                        <div class="form-div block fl-col">
                            <label for="eq_inventory_number" class="label form-label form-popup-l-text">
                                Инвентарный номер
                            </label>
                            <input type="text" class="input form-input form-popup-i-text" id="eq_inventory_number" name="eq_inventory_number" placeholder="41-26-1933"> 
                            <span class="form-valid-error" data-field="eq_inventory_number"></span>
                        </div>

                        <div class="form-div block fl-col">
                            <label for="eq_cart_number" class="label form-label form-popup-l-text">
                                Номер карточки
                            </label>
                            <input type="text" class="input form-input form-popup-i-text" id="eq_cart_number" name="eq_cart_number" placeholder="817"> 
                            <span class="form-valid-error" data-field="eq_cart_number"></span>
                        </div>
                    </div>

                    <div class="form-div block fl-col">
                        <label for="message_theme" class="label form-label form-popup-l-text">
                            Документ поставки
                        </label>
                        <select type="text" class="input form-input form-popup-i-text" id="import_doc" name="import_doc" > 
                            @if ($EquipmentDocuments)
                                @foreach ($EquipmentDocuments as $EquipmentDocument)
                                    <option value="{{ $EquipmentDocument->doc_sup_id }}">{{ $EquipmentDocument->doc_sup_name }}</option>
                                @endforeach
                            @else
                            
                            @endif
                        </select>
                    </div>

                    <div class="form-div block fl-col">
                        <label for="message_theme" class="label form-label form-popup-l-text">
                            Ответственный
                        </label>
                        <select type="text" class="input form-input form-popup-i-text" data-search-div="responsible" id="eq_client_id" name="eq_client_id" > 
                            @if ($clients)
                                @foreach ($clients as $Client)
                                    <option value="{{ $Client->cli_id }}">{{ $Client->cli_name_view }}</option>
                                @endforeach
                            @else
                            <option value="new-songs">3D принтер</option>
                                <option value="old-songs">ИБП</option>
                                <option value="old-songs">Инженерная система</option>
                                <option value="old-songs">Компьютер</option>
                                <option value="old-songs">Компьютер-мини</option>
                                <option value="old-songs">Копир</option>
                                <option value="old-songs">Ламинатор</option>
                            @endif
                            
                        </select>
                    </div>

                    <div class="form-div block fl-col">
                        <label for="message_theme" class="label form-label form-popup-l-text">
                            Подразделение
                        </label>
                        <select type="text" class="input form-input form-popup-i-text" data-search-div="division" id="eq_div_id" name="eq_div_id" > 
                            @if ($CompanyDivisions)
                                @foreach ($CompanyDivisions as $CompanyDivision)
                                    <option value="{{ $CompanyDivision->div_id }}">{{ $CompanyDivision->div_name_full }}</option>
                                @endforeach
                            @else
                            <option value="new-songs">3D принтер</option>
                                <option value="old-songs">ИБП</option>
                                <option value="old-songs">Инженерная система</option>
                                <option value="old-songs">Компьютер</option>
                                <option value="old-songs">Компьютер-мини</option>
                                <option value="old-songs">Копир</option>
                                <option value="old-songs">Ламинатор</option>
                            @endif
                        </select>
                    </div>

                    <div class="form-div block fl-col">
                        <label for="eq_comment" class="label form-label form-popup-l-text">
                            Комментарий
                        </label>
                        <input type="text" class="input form-input form-popup-i-text" id="eq_comment" name="eq_comment" placeholder="Заметка для данной техники">
                        <span class="form-valid-error" data-field="eq_comment"></span>
                    </div>


                </div>
            </div>
        </div>
        


        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit">Сохранить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn">Отмена</button>
        </div>

    </form>
</div>