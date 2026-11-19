<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('import') }}" method="POST" class="form fl-popup-form block fl-align fl-col" enctype="multipart/form-data">

        @csrf
        <div class="form-div-group block fl-sp-btw">
            <div class="form-div block fl-sp-btw">

                <div class="form-div fl-col">
                    <label for="user_avatar_img" class="form-label setting-form-label">Загрузить таблицу Подразделений</label>
                    <label class="input-file upload-file fl-align fl-col">
                        <span class="form-upload-btn form-btn button header-btn button-st-1">Загрузить</span>
                        <input class="load-prev" type="file" name="divisions_file" id="divisions_file">        
                        <span class="input-file-text"></span>
                    </label>
                </div>

                <div class="form-div fl-col">
                    <label for="user_avatar_img" class="form-label setting-form-label">Загрузить таблицу Клиентов</label>
                    <label class="input-file upload-file fl-align fl-col">
                        <span class="form-upload-btn form-btn button header-btn button-st-1">Загрузить</span>
                        <input class="load-prev" type="file" name="clients_file" id="clients_file">        
                        <span class="input-file-text"></span>
                    </label>
                </div>

                {{-- <input type="file"  class="input form-input form-popup-i-text" id="clients_file" name="clients_file" placeholder="Загрузить сотрудников"> 
                <input type="file"  class="input form-input form-popup-i-text" id="divisions_file" name="divisions_file" placeholder="Загрузить подразделения">  --}}

            </div>

        </div>

        <div class="form-div block fl-col">
            <label for="message_theme" class="label form-label form-popup-l-text">
                Сообщение от сервера (об выводе/ошибке документа)
            </label>
            <textarea class="input form-input form-popup-i-text" name="import_raport" id="import_raport" style="font-size: 13px; font-family: Consolas; height: 290px;"></textarea>
        </div>

        
        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit">Ок</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn">Отмена</button>
        </div>

    </form>

</div>



