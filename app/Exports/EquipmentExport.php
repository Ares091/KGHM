<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class EquipmentExport extends StringValueBinder implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithStyles,
    WithCustomValueBinder
{
    public function __construct(private Collection $equipments) {}

    public function collection(): Collection
    {
        return $this->equipments;
    }

    /**
     * Заголовки — соответствуют колонкам таблицы на сайте.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Статус',
            'Тип',
            'Наименование',
            'Серийный №',
            'Инв №',
            '№ Карты',
            'ФИО ответственного',
            'Подразделение ответственного',
            'Подразделение ед.техники',
            'Комментарий',
            'Дата создания',
            'Дата изменения',
        ];
    }

    /**
     * Каждая запись -> строка в файле.
     */
    public function map($equipment): array
    {
        return [
            $equipment->eq_id,
            $equipment->equipmentStatus->eqs_name ?? '',
            $equipment->equipmentType->eqt_name ?? '',
            $equipment->eq_name,
            $equipment->eq_serial_number,
            $equipment->eq_inventory_number,
            $equipment->eq_cart_number,
            $equipment->client->cli_name_view ?? '',
            $equipment->client?->division?->div_name_full ?? '',
            $equipment->import_div ?? '',
            $equipment->eq_comment ?? '',
            optional($equipment->date_create)->format('d.m.Y H:i'),
            optional($equipment->date_change)->format('d.m.Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}