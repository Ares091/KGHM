<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data" class="form fl-popup-form block fl-align fl-col">

         @csrf
        <div class="form-div-group block fl-sp-btw">
            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Логин
                </label>
                <input type="text" class="input form-input form-popup-i-text" id="u_login" name="u_login" placeholder="ivanov.i" autofocus> 
                <span class="form-valid-error" data-field="u_login"></span>
            </div>

        </div>

        <div class="form-div block fl-col">
            <label for="message_theme" class="label form-label form-popup-l-text">
                Пароль
            </label>
            <input type="password" class="input form-input form-popup-i-text" id="u_password" name="u_password">
            <span class="form-valid-error" data-field="u_password"></span>
        </div>

        <div class="form-div block fl-row">
            <input type="checkbox" class="input form-input form-popup-i-text" style="margin-left: 15px;" id="remember" name="remember"> 
            <label for="remember" class="label form-label form-popup-l-text">
                Запомнить меня
            </label>
        </div>
    
        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-0 clear-form-btn">Сброс данных</button>
            <button class="form-btn button header-btn button-st-1 apply-form-btn" type="submit">Войти</button>
        </div>
        

        <input type="hidden" id="selectedRecipient" value="">
    </form>
</div>