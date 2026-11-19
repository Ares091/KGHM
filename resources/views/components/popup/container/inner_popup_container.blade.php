{{-- ВСПЛЫВАЮЩЕЕ ОКНО --}}
<div class="fl-inner-popup-window fl-popup-w-closed block fl-align" data-opened="false">
    <div class="fl-inner-popup-window-inner block fl-align">

        <div class="fl-inner-popup-window-block block-border-2 block-shadow-2 fl-align fl-col">
            <div class="fl-inner-popup-window-header-block block fl-sp-btw">

                {{-- ЗАГОЛОВОК --}}
                <div class="fl-popup-w-h-title-block">
                    <div class="fl-popup-w-h-title-text">Авторизация</div>
                </div>

                {{-- кнопки действия для мобилки --}}
                <div class="fl-pwb-nav-buttons-block fl-pwb-n-b-block-closed fl-pwb-nbb-top fl-align fl-end">
                    <button type="button" class="fl-pwb-nav-button-tab button fl-pwb-nbt-submit fl-pwb-nbt-submit-style-1 fl-align">
                        <p class="fl-pwb-nav-button-text">Подтвердить</p>
                    </button>
                    <button type="button" class="fl-pwb-nav-button-tab button fl-pwb-nbt-close fl-pwb-nbt-close-style-1 fl-align">
                        <p class="fl-pwb-nav-button-text">Закрыть</p>
                    </button>
                </div>
            </div>
            
                {{-- контейнер  куда записываются данные--}}
            <div class="fl-inner-popup-window-block-inner fl-col">
                {{-- содержимое контейнерс сюда записываем данные --}}

                    @include('components.popup.popup_login')

            </div>

            

            <!-- <div class="fl-pwb-nav-buttons-block fl-pwb-nbb-bottom block fl-align">
                <div class="fl-pwb-nbb-bottom-inner fl-sp-btw">
                    <button class="fl-pwb-nbb-bottom-button fl-pwb-nav-button-tab fl-pwb-nbt-submit form-btn btn-m-b button block header-btn button-st-3">Подтвердить</button>
                    <button class="fl-pwb-nbb-bottom-button fl-pwb-nav-button-tab fl-pwb-nbt-close form-btn btn-m-b button block header-btn button-st-2">Закрыть</button>
                </div>
            </div> -->
        </div>

    </div>
</div