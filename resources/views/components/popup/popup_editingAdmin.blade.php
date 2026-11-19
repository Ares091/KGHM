<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('editingAdminForm') }}" method="POST" class="form fl-popup-form block fl-align fl-col">

        @csrf
        <div class="form-div-group block fl-sp-btw">
            <div class="form-div form-div-32 block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Фамилия
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $client->cli_name_f }}" id="cli_name_f" name="cli_name_f" placeholder="Иванов"> 
                <span class="form-valid-error" data-field="cli_name_f"></span>
            </div>

            <div class="form-div form-div-32 block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Имя
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $client->cli_name_i }}" id="cli_name_i" name="cli_name_i" placeholder="Иван"> 
                <span class="form-valid-error" data-field="cli_name_i"></span>
            </div>

            <div class="form-div form-div-32 block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Отчество
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $client->cli_name_o }}" id="cli_name_o" name="cli_name_o" placeholder="Иванович"> 
                <span class="form-valid-error" data-field="cli_name_o"></span>
            </div>

        </div>

        
        <div class="form-div block fl-col">
            <label for="recipients" class="label form-label form-popup-l-text">
                Должность
            </label>
            <input type="text" class="input form-input form-popup-i-text" value="{{ $client->cli_prof }}" id="cli_prof" name="cli_prof" placeholder="Слесарь 1 разряда"> 
            <span class="form-valid-error" data-field="cli_prof"></span>
        </div>

        <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Подразделение
                </label>
                <select type="text" class="input form-input form-popup-i-text" id="cli_div_id" name="cli_div_id" > 
                     @if ($CompanyDivisions)
                        @foreach ($CompanyDivisions as $CompanyDivision)
                            @if ($CompanyDivision->div_id === $client->cli_div_id)
                                <option value="{{ $CompanyDivision->div_id }}" selected>{{ $CompanyDivision->div_name_full }}</option>
                            @else
                                <option value="{{ $CompanyDivision->div_id }}">{{ $CompanyDivision->div_name_full }}</option>
                            @endif
                        @endforeach
                    @endif
                </select> 
            </div>


        <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Комментарий
                </label>
                <!-- <input type="text" class="input form-input form-popup-i-text"> -->
                <textarea class="input form-input form-popup-i-text" value="{{ $client->cli_comment }}" id="cli_comment" name="cli_comment" style="height: 100px;"></textarea>
                <span class="form-valid-error" data-field="cli_comment"></span>
            </div>


        <div class="form-div-group block fl-sp-btw">
            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Дата рождения 
                </label>
                <input type="date" class="input form-input form-popup-i-text" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $client->cli_date_born)->format('Y-m-d') }}" id="cli_date_born" name="cli_date_born" > 
                <span class="form-valid-error" data-field="cli_date_born"></span>
            </div>

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Пол
                </label>
                <select type="text" class="input form-input form-popup-i-text" value="{{ $client->cli_sex }}" id="cli_sex" name="cli_sex" > 
                    <option value="0" {{ $client->cli_sex === false ? 'selected' : '' }}>муж</option>
                    <option value="1" {{ $client->cli_sex === true ? 'selected' : '' }}>жен</option>
                </select>
            </div>

        </div>

        

        <div class="form-div-group block fl-sp-btw">
            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Эл.Почта
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $client->cli_email }}" id="cli_email" name="cli_email" placeholder="ivanov.i@kghm.ru"> 
                <span class="form-valid-error" data-field="cli_email"></span>
            </div>

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Моб.Телефон
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $client->cli_tel_mobile }}" id="cli_tel_mobile" name="cli_tel_mobile"  placeholder="8-999-999-99-99"> 
                <span class="form-valid-error" data-field="cli_tel_mobile"></span>
            </div>
        </div>

        <div class="form-div-group block fl-sp-btw">
            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Город.Телефон
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $client->cli_tel_work }}" id="cli_tel_work" name="cli_tel_work"  placeholder="45-45-45"> 
                <span class="form-valid-error" data-field="cli_tel_work"></span>
            </div>

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Внутр.Телефон
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $client->cli_tel_work2 }}" id="cli_tel_work2" name="cli_tel_work2" placeholder="1111"> 
                <span class="form-valid-error" data-field="cli_tel_work2"></span>
            </div>
        </div>


        <div class="form-div-group block fl-sp-btw">

            <div class="form-div block fl-row">
                <input type="checkbox" class="input form-input form-popup-i-text" style="margin-left: 15px;" id="cli_disable" name="cli_disable" {{ $client->cli_disable === true ? 'checked' : '' }}> 
                <label for="recipients" class="label form-label form-popup-l-text">
                    Запись отключена
                </label>
            </div>

            <div class="form-div block fl-row">
                <input type="checkbox" class="input form-input form-popup-i-text" style="margin-left: 15px;" id="cli_sync_1c" name="cli_sync_1c" {{ $client->cli_sync_1c === true ? 'checked' : '' }}> 
                <label for="recipients" class="label form-label form-popup-l-text">
                    Синхронизация 1C
                </label>
            </div>
        
        </div>
        
    

        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 inner-module-popup-btn" type="button" data-inner-popup-type="sync_1c" data-inner-popup-mode="data_input">Синхронизация 1с</button>
            
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit">Сохранить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn" type="button">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn" type="button">Отмена</button>
        </div>
        

        <input type="hidden" id="cli_id" name="cli_id" value="{{ $client->cli_id }}">

    </form>
</div>