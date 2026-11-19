div class="fl-popup-form-container block fl-align">
    <form action="{{ route('getPopupdivEditingAdmin') }}" method="POST" class="form fl-popup-form block fl-align fl-col">

         @csrf
        {{-- ГРУППА ИНПУТОВ --}}
           

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Наименование полное
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $CompanyDivision->div_name_full }}" id="div_name_full" name="div_name_full" > 
            </div>

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Наименование краткое
                </label>
                <input type="text" class="input form-input form-popup-i-text" value="{{ $CompanyDivision->div_name_short }}" id="div_name_short" name="div_name_short" > 
            </div>

            <div class="form-div block fl-col">
                <label for="recipients" class="label form-label form-popup-l-text">
                    Родительский элемент
                </label>

                
                <div class="form-div block fl-sp-btw">
                    <div class="form-div form-div-20 fl-col">
                        <select type="text" class="input form-input form-popup-i-text" value="{{ $CompanyDivision->parent_node }}" id="parent_node" name="parent_node" > 
                            <option value="parent_node_no">Нет</option>
                            <option value="parent_node_yes">Да</option>
                        </select> 
                    </div>

                    <div class="form-div form-div-79 fl-col">
                        <select type="text" class="input form-input form-popup-i-text" value="{{ $CompanyDivision->div_parent_id }}" id="div_parent_id" name="div_parent_id" > 
                            @if ($CompanyDivisions)
                                @if ($CompanyDivision->div_parent_id === null)
                                    <option value="" selected></option>
                                @endif
                                @foreach ($CompanyDivisions as $CompDiv)
                                    @if ($CompanyDivision->div_parent_id !== null && $CompDiv->div_parent_id === $CompanyDivision->div_parent_id)
                                        <option value="{{ $CompDiv->div_id }}" selected>{{ $CompDiv->div_name_full }}</option>
                                    @else 
                                        <option value="{{ $CompDiv->div_id }}">{{ $CompDiv->div_name_full }}</option>
                                    @endif
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
                <input type="text" class="input form-input form-popup-i-text" value="{{ $CompanyDivision->div_comment }}" id="div_comment" name="div_comment" >
            </div>
        

        <div class="form-btn-block form-div block fl-align">
            <button class="form-btn button header-btn button-st-2 apply-form-btn" type="submit">Сохранить</button>
            <button class="form-btn button header-btn button-st-1 clear-form-btn">Сброс данных</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn">Отмена</button>
        </div>
        

        <input type="hidden" id="selectedRecipient" value="">
    </form>
</div>