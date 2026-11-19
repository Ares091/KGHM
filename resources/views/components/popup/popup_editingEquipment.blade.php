<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('editingEquipmentForm') }}" method="POST" class="form fl-popup-form block fl-align fl-col">

         @csrf
        <div class="form-div-group block fl-sp-btw">

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Статус
                </label>
                <select type="text" class="input form-input form-popup-i-text" id="eq_status_id" name="eq_status_id" > 
                    @if ($EquipmentStatuses)

                        @foreach ($EquipmentStatuses as $EquipmentStatus)
                            @if ($EquipmentStatus->eqs_id  === $Equipment->eq_status_id)
                                <option value="{{ $EquipmentStatus->eqs_id }}" selected>{{ $EquipmentStatus->eqs_name }}</option>
                            @else
                                <option value="{{ $EquipmentStatus->eqs_id }}">{{ $EquipmentStatus->eqs_id }}</option>
                            @endif
                            
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
                            @if ($EquipmentType->eqt_id  === $Equipment->eq_type_id)
                                <option value="{{ $EquipmentType->eqt_id }}" selected>{{ $EquipmentType->eqt_name }}</option>
                            @else
                                <option value="{{ $EquipmentType->eqt_id }}">{{ $EquipmentType->eqt_name }}</option>
                            @endif

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
            <label for="message_theme" class="label form-label form-popup-l-text">
                Наименование
            </label>
            <input type="text" class="input form-input form-popup-i-text" value="{{ $Equipment->eq_name }}" id="eq_name" name="eq_name">
            <span class="form-valid-error" data-field="eq_name"></span>
        </div>

        <div class="form-div-group block fl-sp-btw">
            <div class="form-div block fl-col">
                <label for="message_theme" class="label form-label form-popup-l-text">
                    Серийный номер
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $Equipment->eq_serial_number }}" id="eq_serial_number" name="eq_serial_number">
                <span class="form-valid-error" data-field="eq_serial_number"></span>
            </div>

            <div class="form-div block fl-col">
                <label for="message_theme" class="label form-label form-popup-l-text">
                    Документ поставки
                </label>
                <select type="text" class="input form-input form-popup-i-text" value="{{ $Equipment->import_doc }}" id="import_doc" name="import_doc" > 
                        @if ($EquipmentDocuments)
                            @foreach ($EquipmentDocuments as $EquipmentDocument)
                                @if ($EquipmentDocument->doc_sup_document === $Equipment->import_doc)
                                    <option value="{{ $EquipmentDocument->doc_sup_id }}" selected>{{ $EquipmentDocument->doc_sup_name }}</option>
                                @else
                                    <option value="{{ $EquipmentDocument->doc_sup_id }}">{{ $EquipmentDocument->doc_sup_name }}</option>
                                @endif
                            @endforeach
                        @else
                        
                        @endif
                </select>
            </div>
        </div>
        


        <div class="form-div-group block fl-sp-btw">
            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Инвентарный номер
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $Equipment->eq_inventory_number }}"  id="eq_inventory_number" name="eq_inventory_number" > 
                <span class="form-valid-error" data-field="eq_inventory_number"></span>
            </div>

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Номер карточки
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $Equipment->eq_cart_number }}"  id="eq_cart_number" name="eq_cart_number" > 
                <span class="form-valid-error" data-field="eq_cart_number"></span>
            </div>

        </div>

        

        <div class="form-div block fl-col">
            <label for="message_theme" class="label form-label form-popup-l-text">
                Ответственный
            </label>
            <select type="text" class="input form-input form-popup-i-text"  value="{{ $Equipment->eq_client_id }}" id="eq_client_id" name="eq_client_id" > 
                     @if ($clients)
                        @if ($Equipment->eq_client_id === null)
                            <option value="" selected></option>
                        @endif
                        @foreach ($clients as $Client)
                            @if ($Client->cli_id === $Equipment->eq_client_id)
                                <option value="{{ $Client->cli_id }}" selected>{{ $Client->cli_name_view }}</option>
                            @else
                                <option value="{{ $Client->cli_id }}">{{ $Client->cli_name_view }}</option>
                            @endif
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
            <select type="text" class="input form-input form-popup-i-text"  value="{{ $Equipment->eq_div_id }}" id="eq_div_id" name="eq_div_id" > 
                     @if ($CompanyDivisions)
                        @if ($Equipment->eq_div_id === null ||$Equipment->eq_div_id === "" && $Equipment->client->cli_div_id === null)
                            <option value="" selected></option>
                        @endif
                        @foreach ($CompanyDivisions as $CompanyDivision)
                            @if ($CompanyDivision->div_id === $Equipment->eq_div_id || $CompanyDivision->div_id === $Equipment?->client?->cli_div_id)
                                <option value="{{ $CompanyDivision->div_id }}" selected>{{ $CompanyDivision->div_name_full }}</option>
                            @else
                                <option value="{{ $CompanyDivision->div_id }}">{{ $CompanyDivision->div_name_full }}</option>
                            @endif
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
                Комментарий
            </label>
            <!-- <input type="text" class="input form-input form-popup-i-text" value="{{ $Equipment->eq_comment }}" id="eq_comment" name="eq_comment"> -->
            <textarea class="input form-input form-popup-i-text" id="eq_comment" name="eq_comment" style="height: 150px;">{{ $Equipment->eq_comment }}</textarea>
            <span class="form-valid-error" data-field="eq_comment"></span>
        </div>


        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit">Сохранить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn">Отмена</button>
        </div>
        
        <input type="hidden" class="input form-input form-popup-i-text" value="{{ $Equipment->eq_id }}" id="eq_id" name="eq_id">
        <input type="hidden" id="selectedRecipient" value="">
    </form>
</div>