<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('login') }}" method="POST" class="form fl-popup-form block fl-align fl-col">

         @csrf
        {{-- ГРУППА ИНПУТОВ --}}
        <div class="form-div-group block fl-sp-btw">
            {{-- ИНПУТ ДЛЯ ВСТАВКИ ТЕКСТА ОТ ПОЛЬЗОВАТЕЛЯ --}}
            <div class="form-div block fl-col">
                {{-- ТЕКСТОВАЯ ПЛАШКА ПОЯСНЯЮЩАЯ ЗА ТИП ДАННЫХ, ИМЯ СТОЛБЦА ТАБЛИЦЫ --}}
                <label for="recipients" class="label form-label form-popup-l-text">
                    Подразделение для новых единиц техники:
                </label>
                {{-- ТЕКСТОВАЯ ПЛАШКА ДЛЯ ВСТАВКИ ТЕКСТА В ОПРЕД. СТОЛБЕЦ ТАБЛИЦЫ --}}

                <select class="input form-input form-popup-i-text" name="eq_div_id" id="msl-eq_div_id">
                    <option value="new-songs">Сначала новые</option>
                    <option value="old-songs">Сначала старые</option>
                </select>
            </div>

        </div>

        <div class="form-div block fl-col">
            {{-- ТЕКСТОВАЯ ПЛАШКА ПОЯСНЯЮЩАЯ ЗА ТИП ДАННЫХ, ИМЯ СТОЛБЦА ТАБЛИЦЫ --}}
            <label for="message_theme" class="label form-label form-popup-l-text">
                Подразделение для сданной техники
            </label>
            {{-- ТЕКСТОВАЯ ПЛАШКА ДЛЯ ВСТАВКИ ТЕКСТА В ОПРЕД. СТОЛБЕЦ ТАБЛИЦЫ --}}
            <select class="input form-input form-popup-i-text" name="eq_div_id" id="msl-eq_div_id">
                    <option value="new-songs">Сначала новые</option>
                    <option value="old-songs">Сначала старые</option>
                </select>
        </div>
        
        <div class="form-div block fl-col">
            {{-- ТЕКСТОВАЯ ПЛАШКА ПОЯСНЯЮЩАЯ ЗА ТИП ДАННЫХ, ИМЯ СТОЛБЦА ТАБЛИЦЫ --}}
            <label for="message_theme" class="label form-label form-popup-l-text">
                Подразделение для списанной техники
            </label>
            {{-- ТЕКСТОВАЯ ПЛАШКА ДЛЯ ВСТАВКИ ТЕКСТА В ОПРЕД. СТОЛБЕЦ ТАБЛИЦЫ --}}
            <select class="input form-input form-popup-i-text" name="eq_div_id" id="msl-eq_div_id">
                    <option value="new-songs">Сначала новые</option>
                    <option value="old-songs">Сначала старые</option>
                </select>
        </div>
    
        

        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit">Сохранить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn">Отмена</button>
        </div>
        

        <input type="hidden" id="selectedRecipient" value="">
    </form>
</div>