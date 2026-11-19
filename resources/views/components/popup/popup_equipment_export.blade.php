{{-- Popup с формой --}}
<div class="fl-popup-form-container block fl-align" id="popup-equipment-export">
    <form action="{{ route('equipment.export') }}" method="GET" class="form fl-popup-form block fl-align fl-col">
        @csrf

        {{-- Пробрасываем текущие фильтры, чтобы экспорт совпал с таблицей --}}
        <input type="hidden" name="division_id" value="{{ request('division_id') }}">
        <input type="hidden" name="search"      value="{{ request('search') }}">
        <input type="hidden" name="sort"        value="{{ request('sort', 'eq_status_id') }}">
        <input type="hidden" name="direction"   value="{{ request('direction', 'asc') }}">

        <div class="form-div block fl-col">
            <label class="form-label form-popup-l-text">Формат файла</label>
            <select name="format" class="input form-input form-popup-i-text">
                <option value="xlsx">Excel (.xlsx)</option>
                <option value="csv">CSV (.csv)</option>
            </select>
        </div>

        <div class="form-div block fl-col">
            <label class="form-label form-popup-l-text">
                Экспортируется текущая выборка таблицы
            </label>
            <div class="form-eqs-table-block-container block" style="">
                
                <div class="form-table-div-block-main-container block" style="margin-top: 5px; border-radius: 17px; overflow: hidden; border: 5px #484d55 solid; width: calc(100% - 10px);">
                    <div class="form-eqs-table-block form-table-div-block-main-container-inner block" style="height: 463px; overflow-y: overlay; overflow-x: hidden; background: var(--hb-mdp-table-border-color-1); border-radius: 10px;">
                        
                    </div>
                    
                </div>

            </div>
        </div>

        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit">Скачать</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn" type="button">Отмена</button>
        </div>
    </form>
</div>