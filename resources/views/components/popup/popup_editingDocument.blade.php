<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('editingDocumentForm') }}" method="POST" class="form fl-popup-form block fl-align fl-col">

        @csrf


        <div class="form-div-group block fl-sp-btw">
            <div class="form-div block fl-col">
                <div class="form-div-group block fl-sp-btw">
                    <div class="form-div block fl-col">
                        <label for="doc_sup_date" class="label form-label form-popup-l-text">
                            Дата
                        </label>
                        <input type="date"
                               class="input form-input form-popup-i-text"
                               id="doc_sup_date"
                               name="doc_sup_date"
                               value="{{ \Carbon\Carbon::parse($Document->doc_sup_date)->format('Y-m-d') }}">
                        <span class="form-valid-error" data-field="doc_sup_date"></span>
                    </div>
                </div>
            </div>

            <div class="form-div block fl-col">
                <label for="doc_sup_prov_id" class="label form-label form-popup-l-text">
                    Поставщик
                </label>
                <select class="input form-input form-popup-i-text"
                        id="doc_sup_prov_id"
                        name="doc_sup_prov_id">
                    @if ($EquipmentProviders)
                        @foreach ($EquipmentProviders as $EquipmentProvider)
                            <option value="{{ $EquipmentProvider->prov_id }}"
                                {{ $EquipmentProvider->prov_id == $Document->doc_sup_prov_id ? 'selected' : '' }}>
                                {{ $EquipmentProvider->prov_name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        {{-- Наименование --}}
        <div class="form-div block fl-col">
            <label for="doc_sup_name" class="label form-label form-popup-l-text">
                Наименование
            </label>
            <input type="text"
                   class="input form-input form-popup-i-text"
                   value="{{ $Document->doc_sup_name }}"
                   id="doc_sup_name"
                   name="doc_sup_name">
            <span class="form-valid-error" data-field="doc_sup_name"></span>
        </div>

        {{-- Комментарий --}}
        <div class="form-div block fl-col">
            <label for="doc_sup_comment" class="label form-label form-popup-l-text">
                Комментарий
            </label>
            <input type="text"
                   class="input form-input form-popup-i-text"
                   value="{{ $Document->doc_sup_comment }}"
                   id="doc_sup_comment"
                   name="doc_sup_comment">
            <span class="form-valid-error" data-field="doc_sup_comment"></span>
        </div>

        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit">Сохранить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn" type="button">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn" type="button">Отмена</button>
        </div>

        <input type="hidden" id="doc_sup_id" name="doc_sup_id" value="{{ $Document->doc_sup_id }}">
    </form>
</div>