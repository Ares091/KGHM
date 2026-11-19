<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('editingAdminForm') }}" method="POST" class="form fl-popup-form block fl-align fl-col">

         @csrf

        <div class="form-div-group block fl-sp-btw">
            <div class="form-div form-div-32 block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    id
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $sync1C->cli_sync_1c_id }}" id="cli_sync_1c_id" name="cli_sync_1c_id" > 
            </div>

            <div class="form-div form-div-32 block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Код
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $sync1C->cli_sync_1c_code }}" id="cli_sync_1c_code" name="cli_sync_1c_code" > 
            </div>

        </div>

        
        <div class="form-div block fl-col">
            <label for="recipients" class="label form-label form-popup-l-text">
                Код подразделения
            </label>
            <input type="text" class="input form-input form-popup-i-text" value="{{ $sync1C->cli_sync_1c_division_code }}" id="cli_sync_1c_division_code" name="cli_sync_1c_division_code" > 
        </div>

        <div class="form-div block fl-col">
            <label for="recipients" class="label form-label form-popup-l-text">
                Категория
            </label>
            <input type="text" class="input form-input form-popup-i-text" value="{{ $sync1C->cli_sync_1c_category }}" id="cli_sync_1c_category" name="cli_sync_1c_category" > 
        </div>



        <div class="form-div-group block fl-sp-btw">
            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Статус
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $sync1C->cli_sync_1c_status }}" id="cli_sync_1c_status" name="cli_sync_1c_status" > 
            </div>

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Тип работы
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $sync1C->cli_sync_1c_employment_type }}" id="cli_sync_1c_employment_type" name="cli_sync_1c_employment_type" > 
            </div>
        </div>

        <div class="form-div block fl-col">
            <label for="recipients" class="label form-label form-popup-l-text">
                Дата приема
            </label>
            <input type="date" class="input form-input form-popup-i-text" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sync1C->cli_sync_1c_hire_date)->format('Y-m-d') }}" id="cli_sync_1c_hire_date" name="cli_sync_1c_hire_date" > 
        </div>

        <div class="form-div-group block fl-sp-btw">

            <div class="form-div block fl-row">
                <input type="checkbox" class="input form-input form-popup-i-text" style="margin-left: 15px;" id="cli_sync_1c_is_division_head" name="cli_sync_1c_is_division_head" {{ $sync1C->cli_sync_1c_is_division_head === true ? 'checked' : '' }}> 
                <label for="recipients" class="label form-label form-popup-l-text">
                    Начальник подразделения
                </label>
            </div>

            <div class="form-div block fl-row">
                <input type="checkbox" class="input form-input form-popup-i-text" style="margin-left: 15px;" id="cli_disable" name="cli_disable" {{ $sync1C->cli_disable === true ? 'checked' : '' }}> 
                <label for="recipients" class="label form-label form-popup-l-text">
                    Запись отключена
                </label>
            </div>

            <div class="form-div block fl-row">
                <input type="checkbox" class="input form-input form-popup-i-text" style="margin-left: 15px;" id="cli_sync_1c" name="cli_sync_1c" {{ $sync1C->cli_sync_1c === true ? 'checked' : '' }}> 
                <label for="recipients" class="label form-label form-popup-l-text">
                    Синхр-ция 1C
                </label>
            </div>
            
        </div>
        
    

        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 inner-popup-save-btn">Сохранить</button>
            <button class="form-btn button header-btn button-st-1 inner-popup-clear-btn">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 inner-popup-close-btn">Отмена</button>
        </div>
        

        <input type="hidden" id="cli_id" name="cli_id" value="{{ $sync1C->cli_id }}">

    </form>
</div>