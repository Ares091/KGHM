{{-- resources/views/handbook/partials/_department_sub.blade.php --}}

@if($CompanyDivision->children->isNotEmpty())
    {{-- У подотдела есть подподотделы --}}
    <div class="handbook-ddp-b-sub-row-group hb-ddp-group-with-sub-subs fl-align fl-col">
        <div class="hb-dep-data-btn handbook-ddp-b-sub-row block fl-sp-btw" data-id="{{ $CompanyDivision->div_id }}" data-div-type="sub">
            <div class="handbook-department-data-panel-text-block">
                <p class="handbook-ddp-text">{{ $CompanyDivision->div_name_full }}</p>
            </div>
            <div class="handbook-main-department-panel-open-subs-block fl-align">
                <div class="handbook-ddp-open-subs" style="width: 25px; height: 25px;">
                    <img src="../sources/media/icons/down-arrow.png" alt="" class="handbook-ddp-open-subs-img img">
                </div>
            </div>
        </div>
        <div class="handbook-ddp-b-subs-sub-rows-group block fl-col handbook-ddp-sub-rows-closed">
            @foreach($CompanyDivision->children as $subChild)
                @include('components.handbook._department_sub_sub', ['CompanyDivision' => $subChild])
            @endforeach
        </div>
    </div>
@else
    {{-- Обычный подотдел без детей --}}
    @if($CompanyDivision->div_disable === 1)
        <div class="hb-dep-data-btn handbook-ddp-b-sub-row block fl-sp-btw" style="background: #ff8fad" data-id="{{ $CompanyDivision->div_id }}" data-div-type="sub">
            <div class="handbook-department-data-panel-text-block">
                <p class="handbook-ddp-text">{{ $CompanyDivision->div_name_full }}  (ОТКЛЮЧЕН)</p>
            </div>
        </div>
    @else
        <div class="hb-dep-data-btn handbook-ddp-b-sub-row block fl-sp-btw" data-id="{{ $CompanyDivision->div_id }}" data-div-type="sub">
            <div class="handbook-department-data-panel-text-block">
                <p class="handbook-ddp-text">{{ $CompanyDivision->div_name_full }} </p>
            </div>
        </div>
    @endif
   
@endif