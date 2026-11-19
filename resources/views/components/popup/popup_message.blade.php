<div class="fl-popup-form-container block fl-align">
    <form action="{{ route('login') }}" method="POST" class="form fl-popup-form block fl-align fl-col">

         @csrf
        {{-- ГРУППА ИНПУТОВ --}}

        <div class="form-div block fl-col">
            {{-- ТЕКСТОВАЯ ПЛАШКА ПОЯСНЯЮЩАЯ ЗА ТИП ДАННЫХ, ИМЯ СТОЛБЦА ТАБЛИЦЫ --}}
            @if ($eq !== null)
                @if ($message_type==='delete')
                    <label for="message_theme" class="label form-label form-popup-l-text">
                        Вы уверены что хотите удалить технику "{{ $eq->eq_name }}"?
                    </label>
                @else
                    <label for="message_theme" class="label form-label form-popup-l-text">
                        Данные успешно изменены!
                    </label>
                @endif
            @elseif ($client !== null)
                @if ($message_type === 'delete' && $client->cli_disable === true)
                    <label for="message_theme" class="label form-label form-popup-l-text">
                        Вы уверены что хотите восстановить запись сотрудника "{{ $client->cli_name_view }}"?
                    </label>
                @elseif ($message_type === 'delete')
                    <label for="message_theme" class="label form-label form-popup-l-text">
                        Вы уверены что хотите удалить запись о сотруднике "{{ $client->cli_name_view }}"?
                    </label>
                @else
                    <label for="message_theme" class="label form-label form-popup-l-text">
                        Данные успешно изменены!
                    </label>
                @endif
            @elseif ($division)
                @if ($message_type==='delete')
                    <label for="message_theme" class="label form-label form-popup-l-text">
                        Вы уверены что хотите удалить подразделение "{{ $division->div_name_full }}"?
                    </label>
                @else
                    <label for="message_theme" class="label form-label form-popup-l-text">
                        Данные успешно изменены!
                    </label>
                @endif
            @elseif ($document)
                @if ($message_type==='delete')
                    <label for="message_theme" class="label form-label form-popup-l-text">
                        Вы уверены что хотите удалить документ "{{ $document->doc_sup_name }}"?
                    </label>
                @else
                    <label for="message_theme" class="label form-label form-popup-l-text">
                        Данные успешно изменены!
                    </label>
                @endif
            @endif

            
            
            {{-- ТЕКСТОВАЯ ПЛАШКА ДЛЯ ВСТАВКИ ТЕКСТА В ОПРЕД. СТОЛБЕЦ ТАБЛИЦЫ --}}
        </div>
    
        <div class="form-btn-block form-div block fl-align">
            <div class="form-btn popupActionBtn button header-btn button-st-0 exit-form-btn" data-btn="no">Отменить</div>
            <div class="form-btn popupActionBtn button header-btn button-st-2" data-btn="disable">Отключить запись</div>
            <div class="form-btn popupActionBtn button header-btn button-st-1" data-btn="delete">Удалить полностью</div>
        </div>

        <input type="hidden" id="selectedRecipient" value="">
    </form>
</div>