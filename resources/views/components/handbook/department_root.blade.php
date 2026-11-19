{{-- resources/views/handbook/partials/_department_root.blade.php --}}

<div class="handbook-body-left-department-panel-row-group {{ $CompanyDivision->children->isNotEmpty() ? 'hb-ddp-group-with-subs' : '' }} fl-align fl-col">
    <div class="hb-dep-data-btn handbook-department-data-panel-block-row hb-ddp-with-subs block fl-sp-btw" data-id="{{ $CompanyDivision->div_id }}" data-div-type="main">
        <div class="handbook-department-data-panel-text-block">
            <p class="handbook-ddp-text">{{ $CompanyDivision->div_name_full }}</p>
        </div>
        @if($CompanyDivision->children->isNotEmpty())
            <div class="handbook-main-department-panel-open-subs-block fl-align">
                <div class="handbook-ddp-open-subs" style="width: 25px; height: 25px;">
                    <img src="../sources/media/icons/down-arrow.png" alt="" class="handbook-ddp-open-subs-img img">
                </div>
            </div>
        @endif
    </div>

    @if($CompanyDivision->children->isNotEmpty())
        <div class="handbook-ddp-b-sub-rows-group block fl-col handbook-ddp-sub-rows-closed">
            @foreach($CompanyDivision->children as $child)
                @include('components.handbook._department_sub', ['CompanyDivision' => $child])
            @endforeach
        </div>
    @endif
</div>

