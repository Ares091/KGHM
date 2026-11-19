<?php

namespace App\Http\Controllers;

use App\Exports\EquipmentExport;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class EquipmentController extends Controller
{
    /**
     * HTML таблицы чекбоксов для popup.
     * Приходит массив ID техники, отображаемой сейчас в таблице.
     */
    public function getCurrentEqIds(Request $request)
    {
        $ids = collect($request->input('current_eqs_ids', []))
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->unique()
            ->values();

        if ($ids->isEmpty()) {
            return '<p class="text-center">Нет записей для экспорта.</p>';
        }

        // Подтягиваем только нужные поля + связи
        $equipments = Equipment::query()
            ->with(['client', 'division', 'equipmentStatus', 'equipmentType'])
            ->whereIn('eq_id', $ids)
            ->orderByRaw('FIELD(eq_id, ' . $ids->implode(',') . ')') // сохраняем порядок таблицы
            ->get();

        return view('popups.equipment_export_table', [
            'equipments' => $equipments,
        ])->render();
    }

    /**
     * Собственно экспорт. Принимает массив отмеченных ID.
     */
    public function export(Request $request)
    {
        $validated = $request->validate([
            'eq_ids'   => ['required', 'array', 'min:1'],
            'eq_ids.*' => ['integer', 'exists:t_equipment,eq_id'],
            'format'   => ['nullable', 'in:xlsx,csv'],
        ], [
            'eq_ids.required' => 'Выберите хотя бы одну единицу техники.',
        ]);

        // Сортировка сохраняет порядок, в котором пришли ID (как в таблице)
        $ids = array_map('intval', $validated['eq_ids']);
        $equipments = Equipment::query()
            ->with(['client', 'division', 'equipmentStatus', 'equipmentType'])
            ->whereIn('eq_id', $ids)
            ->orderByRaw('FIELD(eq_id, ' . implode(',', $ids) . ')')
            ->get();

        $format = $validated['format'] ?? 'xlsx';
        $filename = 'equipment_' . now()->format('Y-m-d_His') . '.' . $format;

        Log::info("Найдены id техник", [$ids]);

        Log::info("Файл сформирован {$filename}. Подготавливаю к скачиванию.");

        return Excel::download(new EquipmentExport($equipments), $filename);

        // return response()->json([
        //     'success'  => true,
        //     'message'  => 'документ сформирован успешно!',
        // ]); 
    }
}
