{{-- ВСПЛЫВАЮЩЕЕ ОКНО --}}
<div class="fl-inner-popup-window fl-popup-w-closed block fl-align" data-opened="false">
    <div class="fl-inner-popup-window-inner block fl-align">

        <div class="fl-inner-popup-window-block block-border-2 block-shadow-2 fl-align fl-col">
            <div class="fl-inner-popup-window-header-block block fl-sp-btw">

                {{-- ЗАГОЛОВОК --}}
                <div class="fl-popup-w-h-title-block">
                    <div class="fl-popup-w-h-title-text">Изменить учетные данные</div>
                </div>

                {{-- кнопки действия для мобилки --}}
                <div class="fl-pwb-nav-buttons-block fl-pwb-n-b-block-closed fl-pwb-nbb-top fl-align fl-end">
                    <button type="button" class="fl-pwb-nav-button-tab button fl-pwb-nbt-submit fl-pwb-nbt-submit-style-1 fl-align">
                        <p class="fl-pwb-nav-button-text">Подтвердить</p>
                    </button>
                    <button type="button" class="fl-pwb-nav-button-tab button fl-pwb-nbt-close fl-pwb-nbt-close-style-1 fl-align">
                        <p class="fl-pwb-nav-button-text">Закрыть</p>
                    </button>
                </div>
            </div>
            
                {{-- контейнер  куда записываются данные--}}
            <div class="fl-inner-popup-window-block-inner fl-col">
                {{-- содержимое контейнерс сюда записываем данные --}}

                <div class="fl-popup-form-container block fl-align">
                    <form action="{{ route('register') }}" method="POST" class="form fl-popup-form block fl-align fl-col">

                        @csrf

                        {{-- <div class="form-div-group block fl-sp-btw">
            
                        </div> --}}

                        <div class="form-div-group block fl-sp-btw fl-al-start">
                            <div class="form-div-group block fl-col">
                                <div class="form-div block fl-col">
                                    <label for="recipients" class="label form-label form-popup-l-text">
                                        Логин
                                    </label>
                                    <input type="text" class="input form-input form-popup-i-text" value="{{ $userInfo->u_login }}" id="u_login" name="u_login" > 
                                    <span class="form-valid-error" data-field="u_login"></span>
                                </div>

                                <div class="form-div block fl-col">
                                    <label for="recipients" class="label form-label form-popup-l-text">
                                        Почта
                                    </label>
                                    <input type="text" class="input form-input form-popup-i-text" value="{{ $userInfo->u_email }}" id="u_email" name="u_email" > 
                                    <span class="form-valid-error" data-field="u_email"></span>
                                </div>
                            </div>

                            <div class="form-div-group block fl-col">
                                <div class="form-div block fl-col">
                                    <label for="recipients" class="label form-label form-popup-l-text">
                                        Пароль
                                    </label>
                                    <input type="password" class="input form-input form-popup-i-text" id="u_password" name="u_password" > 
                                    <span class="form-valid-error" data-field="u_password"></span>
                                </div>

                                <div class="form-div block fl-col">
                                    <label for="recipients" class="label form-label form-popup-l-text">
                                        Новый пароль
                                    </label>
                                    <input type="password" class="input form-input form-popup-i-text" id="u_new_password" name="u_new_password" > 
                                    <span class="form-valid-error" data-field="u_new_password"></span>
                                </div>

                                <div class="form-div block fl-col">
                                    <label for="recipients" class="label form-label form-popup-l-text">
                                        Повтор нового пароля
                                    </label>
                                    <input type="password" class="input form-input form-popup-i-text" id="u_new_password_confirm" name="u_new_password_confirm" > 
                                    <span class="form-valid-error" data-field="u_new_password_confirm"></span>
                                </div>
                            </div>
                        </div>
                                      

                        <div class="form-btn-block form-div block fl-align">
                            <button class="form-btn button header-btn button-st-2 inner-popup-save-btn" type="submit">Сохранить</button>
                            <button class="form-btn button header-btn button-st-1 inner-popup-clear-btn" type="button">Сброс данных</button>
                            <button class="form-btn button header-btn button-st-0 inner-popup-close-btn" type="button">Отмена</button>
                        </div>
                        

                    </form>
                </div>

            </div>

           
        </div>

    </div>
</div

