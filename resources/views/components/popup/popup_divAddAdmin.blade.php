<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('adminAddDivision') }}" method="POST" class="form fl-popup-form block fl-align fl-col">

         @csrf
        {{-- ГРУППА ИНПУТОВ --}}
           

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Наименование полное
                </label>
                <input type="text" class="input form-input form-popup-i-text" id="div_name_full" name="div_name_full" > 
                <span class="form-valid-error" data-field="div_name_full"></span>
            </div>

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Наименование краткое
                </label>
                <input type="text" class="input form-input form-popup-i-text" id="div_name_short" name="div_name_short" > 
                <span class="form-valid-error" data-field="div_name_short"></span>
            </div>

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Родительский элемент
                </label>
                
                <div class="form-div block fl-sp-btw">
                    <div class="form-div form-div-20 fl-col">
                        <select type="text" class="input form-input form-popup-i-text" id="parent_node" name="parent_node" > 
                            <option value="parent_node_no">Нет</option>
                            <option value="parent_node_yes">Да</option>
                        </select> 
                    </div>

                    <div class="form-div form-div-79 fl-col">
                        <select type="text" class="input form-input form-popup-i-text" id="div_parent_id" name="div_parent_id" > 
                            @if ($CompanyDivisions)
                                @foreach ($CompanyDivisions as $CompanyDivision)
                                    <option value="{{ $CompanyDivision->div_id }}">{{ $CompanyDivision->div_name_full }}</option>
                                @endforeach
                            @endif
                        </select> 
                    </div>
                </div>
                
            </div>

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Комментарий
                </label>
                <input type="text" class="input form-input form-popup-i-text" id="div_comment" name="div_comment" >
                <span class="form-valid-error" data-field="div_comment"></span>
            </div>
        

        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit">Сохранить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn">Отмена</button>
        </div>
        

        <input type="hidden" id="selectedRecipient" value="">
    </form>
</div>