<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('DocumentAddPanel') }}" method="POST" class="form fl-popup-form block fl-align fl-col">

         @csrf
        <div class="form-div-group block fl-sp-btw">
            <div class="form-div block fl-col">
                {{-- <label for="recipients" class="label form-label form-popup-l-text">
                    Дата
                </label> --}}
                <div class="form-div-group block fl-sp-btw">
                    <div class="form-div block fl-col">
                        <label for="eq_date" class="label form-label form-popup-l-text">
                             Дата
                        </label>
                        <input type="date" class="input form-input form-popup-i-text" id="doc_sup_date" name="doc_sup_date" value="{{ now()->format('Y-m-d') }}">
                        <span class="form-valid-error" data-field="doc_sup_date"></span>
                    </div>
                 </div>
            </div>

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Поставщик
                </label>
                <select type="text" class="input form-input form-popup-i-text" id="doc_sup_prov_id" name="doc_sup_prov_id" > 
                     @if ($EquipmentProviders)
                        @foreach ($EquipmentProviders as $EquipmentProvider)
                            <option value="{{ $EquipmentProvider->prov_id }}">{{ $EquipmentProvider->prov_name }}</option>
                        @endforeach
                    @else
                        <option value="new-songs">3D принтер</option>
                        <option value="old-songs">ИБП</option>
                        <option value="old-songs">Инженерная система</option>
                        <option value="old-songs">Компьютер</option>
                        <option value="old-songs">Компьютер-мини</option>
                        <option value="old-songs">Копир</option>
                        <option value="old-songs">Ламинатор</option>
                    @endif
                </select>
            </div>

        </div>

        <div class="form-div block fl-col">
            <label for="message_theme" class="label form-label form-popup-l-text">
                Наименование
            </label>
            <input type="text" class="input form-input form-popup-i-text" id="doc_sup_name" name="doc_sup_name">
            <span class="form-valid-error" data-field="doc_sup_name"></span>
        </div>

        <div class="form-div block fl-col">
            <label for="message_theme" class="label form-label form-popup-l-text">
                Комментарий
            </label>
            <input type="text" class="input form-input form-popup-i-text" id="doc_sup_comment" name="doc_sup_comment">
            <span class="form-valid-error" data-field="doc_sup_comment"></span>
        </div>

    
        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit">Сохранить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn">Отмена</button>
        </div>
        

        <input type="hidden" id="selectedRecipient" value="">
    </form>
</div>