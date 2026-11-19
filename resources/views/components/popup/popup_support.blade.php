<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('login') }}" method="POST" class="form fl-popup-form block fl-align fl-col">

         @csrf

        <div class="form-div-group block fl-sp-btw">
            {{-- ИНПУТ ДЛЯ ВСТАВКИ ТЕКСТА ОТ ПОЛЬЗОВАТЕЛЯ --}}
            <div class="form-div block fl-col">
                <label for="u_login" class="label form-label form-popup-l-text">
                    На данный момент справочник находится в тестировочном режиме. 
                    Вы можете оставить сообщение об програмной ошибке или поломке техники или пожелание об 
                    добавлении/улучшении функций и работы справочника. Специалисты ответят в ближайшее время.
                </label>
            </div>

        </div>

        <div class="form-div block fl-col">
            {{-- ТЕКСТОВАЯ ПЛАШКА ПОЯСНЯЮЩАЯ ЗА ТИП ДАННЫХ, ИМЯ СТОЛБЦА ТАБЛИЦЫ --}}
            <label for="u_email" class="label form-label form-popup-l-text">
                Эл.почта
            </label>
            {{-- ТЕКСТОВАЯ ПЛАШКА ДЛЯ ВСТАВКИ ТЕКСТА В ОПРЕД. СТОЛБЕЦ ТАБЛИЦЫ --}}
            <input type="email" class="input form-input form-popup-i-text" id="u_email" name="u_email" placeholder="ivan228.t@kghm.ru">
        </div>

        <div class="form-div-group block fl-sp-btw">
            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Тип ошибки
                </label>

                <select class="input form-input form-popup-i-text" name="eq_div_id" id="msl-eq_div_id">
                    <option value="new-songs">Неисправность оборудования</option>
                    <option value="old-songs">Периферия и оргтехника</option>
                    <option value="old-songs">Сеть и интернет</option>
                    <option value="old-songs">Программный сбой</option>
                </select>
            </div>

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Важность
                </label>

                <select class="input form-input form-popup-i-text" name="eq_div_id" id="msl-eq_div_id">
                    <option value="old-songs">Без разницы</option>
                    <option value="old-songs">Не важно</option>
                    <option value="new-songs">Важно</option>
                </select>
            </div>
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
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit" data-btn="yes">Отправить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn" data-btn="no">Отмена</button>
        </div>

        <input type="hidden" id="selectedRecipient" value="">
    </form>
</div>