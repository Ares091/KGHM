<div class="fl-popup-form-container block fl-align">
    <div class="form fl-popup-form block fl-align fl-col">

        
        <div class="popup-user-name-block popup-section-row block fl-row">
            <div class="popup-user-fio-text-block">
                <div class="popup-user-fio-text">{{ $cliUser->cli_name_view }}</div>
            </div>
            <div class="popup-user-tags-block fl-sp-btw">
                <div class="hbnd-card-row popup-user-tag-mini">
                    Администратор
                </div>
            </div>
        </div>

        <div class="popup-user-info-block popup-section-row block fl-col">
            <div class="popup-section-row block fl-row">

                <div class="popup-user-tag-block popup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">Должность</p>
                    </div>
                    <div class="hbnd-card-row putb-st-0 ">
                        <p class="hbnd-card-row-text">{{ $cliUser->cli_prof }}</p>
                    </div>
                </div>

                <div class="popup-user-tag-block popup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">Подразделение</p>
                    </div>
                    <div class="hbnd-card-row putb-st-1">
                        <p class="hbnd-card-row-text">{{ $cliUser->division->div_name_short }}</p>
                    </div>
                </div>
                
            </div>

            <div class="popup-section-row block fl-row">

                @if ($cliUser->cli_email !== null)
                <div class="popup-user-tag-block popup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">Почта</p>
                    </div>
                    <div class="hbnd-card-row putb-st-1">
                        <p class="hbnd-card-row-text">{{ $cliUser->cli_email }}</p>
                    </div>
                </div>
                @endif
                <div class="popup-user-tag-blockpopup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">Статус</p>
                    </div>
                    <div class="hbnd-card-row putb-st-0">
                        <p class="hbnd-card-row-text">{{ $cliUser->cli_sync_1c_employment_type }}</p>
                    </div>
                </div>
                
            </div>

            <div class="popup-section-row block fl-row">

                <div class="popup-user-tag-block popup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">Внутренний тел.</p>
                    </div>
                    <div class="hbnd-card-row putb-st-0">
                        <p class="hbnd-card-row-text">{{ $cliUser->cli_tel_work2 }}</p>
                    </div>
                </div>

                <div class="popup-user-tag-block popup-section-row-col fl-col">
                    <div class="popup-user-tag-label-row">
                        <p class="popup-user-tag-label-text">Городской тел.</p>
                    </div>
                    <div class="hbnd-card-row putb-st-1">
                        <p class="hbnd-card-row-text">{{ $cliUser->cli_tel_work }}</p>
                    </div>
                </div>

                @if ($cliUser->cli_tel_mobile !== null)
                    <div class="popup-user-tag-block popup-section-row-col fl-col">
                        <div class="popup-user-tag-label-row">
                            <p class="popup-user-tag-label-text">Мобильный тел.</p>
                        </div>
                        <div class="hbnd-card-row putb-st-1">
                            <p class="hbnd-card-row-text">{{ $cliUser->cli_tel_mobile }}</p>
                        </div>
                    </div>
                @endif
                
                
            </div>
        </div>
        
    
        <div class="form-btn-block form-div block fl-align">
            {{-- @if(Auth::user() && (Auth::user()->u_login === 'matveev.m' || Auth::user()->u_login === 'babchuk.i'))
                <button class="form-btn button header-btn button-st-2 inner-module-popup-btn" type="button" data-inner-popup-type="edit_data" data-inner-popup-mode="data_input">Изменить данные</button>
            @else
                <button class="form-btn button header-btn button-st-2">Изменить данные</button>
            @endif --}}
            <button class="form-btn button header-btn button-st-2 inner-module-popup-btn" type="button" data-inner-popup-type="edit_data" data-inner-popup-mode="data_input">Изменить данные</button>
            <button class="form-btn button header-btn button-st-2" type="submit">Ок</button>
            <button class="form-btn button header-btn button-st-0 exit-form-btn">Отмена</button>
        </div>
        
    </div>
</div>