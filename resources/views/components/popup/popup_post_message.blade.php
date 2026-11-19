<div class="fl-popup-form-container block fl-align">
    <form action="" class="form fl-popup-form block fl-align fl-col">

        {{-- ГРУППА ИНПУТОВ --}}
        <div class="form-div-group block fl-sp-btw">
            {{-- ИНПУТ ДЛЯ ВСТАВКИ ТЕКСТА ОТ ПОЛЬЗОВАТЕЛЯ --}}
            <div class="form-div block fl-col">
                {{-- ТЕКСТОВАЯ ПЛАШКА ПОЯСНЯЮЩАЯ ЗА ТИП ДАННЫХ, ИМЯ СТОЛБЦА ТАБЛИЦЫ --}}
                <label for="recipients" class="label form-label form-popup-l-text">
                    Кому
                </label>
                {{-- ТЕКСТОВАЯ ПЛАШКА ДЛЯ ВСТАВКИ ТЕКСТА В ОПРЕД. СТОЛБЕЦ ТАБЛИЦЫ --}}
                <input type="text" class="input form-input form-popup-i-text" id="recipients" name="recipients">
            </div>

            {{-- ИНПУТ ДЛЯ ВСТАВКИ ТЕКСТА ОТ ПОЛЬЗОВАТЕЛЯ --}}
            <div class="form-div block fl-col">
                {{-- ТЕКСТОВАЯ ПЛАШКА ПОЯСНЯЮЩАЯ ЗА ТИП ДАННЫХ, ИМЯ СТОЛБЦА ТАБЛИЦЫ --}}
                <label for="copy_for_recipients" class="label form-label form-popup-l-text">
                    Копия
                </label>
                {{-- ТЕКСТОВАЯ ПЛАШКА ДЛЯ ВСТАВКИ ТЕКСТА В ОПРЕД. СТОЛБЕЦ ТАБЛИЦЫ --}}
                <input type="text" class="input form-input form-popup-i-text" id="copy_for_recipients" name="copy_for_recipients">
            </div>
        </div>

        <div class="form-div block fl-col">
            {{-- ТЕКСТОВАЯ ПЛАШКА ПОЯСНЯЮЩАЯ ЗА ТИП ДАННЫХ, ИМЯ СТОЛБЦА ТАБЛИЦЫ --}}
            <label for="message_theme" class="label form-label form-popup-l-text">
                Тема
            </label>
            {{-- ТЕКСТОВАЯ ПЛАШКА ДЛЯ ВСТАВКИ ТЕКСТА В ОПРЕД. СТОЛБЕЦ ТАБЛИЦЫ --}}
            <input type="text" class="input form-input form-popup-i-text" id="message_theme" name="message_theme">
        </div>

        <div class="form-div block fl-col">
            {{-- ТЕКСТОВАЯ ПЛАШКА ПОЯСНЯЮЩАЯ ЗА ТИП ДАННЫХ, ИМЯ СТОЛБЦА ТАБЛИЦЫ --}}
            <label for="message_theme" class="label form-label form-popup-l-text">
                Сообщение
            </label>
            {{-- ТЕКСТОВАЯ ПЛАШКА ДЛЯ ВСТАВКИ ТЕКСТА В ОПРЕД. СТОЛБЕЦ ТАБЛИЦЫ --}}
            <textarea class="input text-area form-input form-popup-i-text" style="height: 160px" name="message_text" id="message_text"></textarea>
        </div>
        
        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2" type="submit">Оправить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn">Отмена</button>
        </div>
        

        <input type="hidden" id="selectedRecipient" value="">
    </form>
</div>