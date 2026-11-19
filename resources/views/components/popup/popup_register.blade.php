<div class="fl-popup-form-container block fl-align">
    <form class="form fl-popup-form block fl-align fl-col" action="{{ route('register') }}" method="POST">

        @csrf
        <div class="form-div-group block fl-sp-btw">
            <div class="form-div block fl-col">
                <label for="u_login" class="label form-label form-popup-l-text">
                    Логин
                </label>
                <input type="text" class="input form-input form-popup-i-text" id="u_login" name="u_login"  placeholder="ivan.t"> 
                <span class="form-valid-error" data-field="u_login"></span>
            </div>
        </div>

        <div class="form-div block fl-col">
            <label for="u_email" class="label form-label form-popup-l-text">
                Эл.почта
            </label>
            <input type="email" class="input form-input form-popup-i-text" id="u_email" name="u_email" placeholder="ivan.t@kghm.ru">
            <span class="form-valid-error" data-field="u_email"></span>
        </div>

        <div class="form-div block fl-col">
            <label for="u_password" class="label form-label form-popup-l-text">
                Пароль
            </label>
            <input type="password" class="input form-input form-popup-i-text" id="u_password" name="u_password">
            <span class="form-valid-error" data-field="u_password"></span>
        </div>

        
    
        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit">Сохранить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn">Отмена</button>
        </div>
        

        <input type="hidden" id="selectedRecipient" value="">
    </form>
</div>

<script>
    
</script>