<div class="fl-popup-form-container block fl-align">
    <form action="" method="POST" class="form fl-popup-form block fl-align fl-col">
         @csrf
        
        <div class="form-div block fl-col">
            <label for="message_theme" class="label form-label form-popup-l-text">
                Наименование компании
            </label>
            <input type="text" class="input form-input form-popup-i-text" id="prov_name" name="prov_name">
            <span class="form-valid-error" data-field="prov_name"></span>
        </div>

        

        <div class="form-div block fl-col">
            <label for="message_theme" class="label form-label form-popup-l-text">
                Контактные данные
            </label>
            <input type="text" class="input form-input form-popup-i-text" id="prov_contact_information" name="prov_contact_information">
            <span class="form-valid-error" data-field="prov_contact_information"></span>
        </div>

        <div class="form-div block fl-col">
            <label for="message_theme" class="label form-label form-popup-l-text">
                Комментарий
            </label>
            <input type="text" class="input form-input form-popup-i-text" id="prov_comment" name="prov_comment">
            <span class="form-valid-error" data-field="prov_comment"></span>
        </div>
    
        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit">Сохранить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn">Отмена</button>
        </div>
        
    </form>
</div>