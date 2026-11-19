<?php

namespace App\Imports;

use App\Models\CompanyDivision;
use App\Models\CompanyDivision42;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Carbon;

// WithValidation
class CompanyDivisionImport implements ToModel, WithHeadingRow, WithCustomCsvSettings, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        
        if (empty(trim($row['id'] ?? '')) || empty(trim($row['name'] ?? ''))) {
            return null;
        }


        $syncCode = trim($row['id']);
        $parentSyncCode = trim($row['parent_id']) ?: null;
        $fullName = trim($row['name']);
        $shortName = trim($row['code']);
        $startDate = trim($row['start_date'] ?? null);
        $endDate = trim($row['end_date'] ?? null);
        $comment = strlen($row['comment']) > 2 ? trim($row['comment']) : null;
        
        $division = CompanyDivision::where('div_sync_1c_code', $syncCode)->where('div_sync_1c', 1)->first();
        

        $data = [
            'div_name_full' => $fullName,
            'div_name_short' => $shortName ?: $fullName,
            'div_comment'     => $comment,
            'div_disable' => 0,
            'div_date_change' => now(),
            'div_sync_1c' => 1,
            'div_sync_1c_code' => $syncCode,
            'div_sync_1c_parent_code' => $parentSyncCode,
            'div_sync_1c_apply' => 0,
            'div_check_subdivision' => 0,
            'div_send_mail_apply' => 0,
        ];

        $fillableData = [
            'div_name_full'   => $fullName,
            'div_name_short'  => $shortName,
            'div_comment'     => $comment,
            'div_sync_1c_parent_code' => $parentSyncCode,
            'div_date_change' => now(),
        ];

        if (!$division) {
            $division = CompanyDivision::create(array_merge($data, [
                'div_date_create' => now(),
            ]));
            Log::info('Импорт отдела создан:', [$row['name']]);

        } else {
            $changed = false;
            $fieldsToCompare = ['div_name_full', 'div_name_short', 'div_comment', 'div_sync_1c_parent_code'];

            foreach ($fieldsToCompare as $field) {
                if ($division->field != $fillableData[$field] ) {
                    $changed = true;
                    break;
                }
            }

            if ($changed) {
                $division->update($fillableData);
                Log::info('Импорт отдела обновлен:', [$row['name']]);

            }
        }

        // Log::info('В таблицу Подразделений была внесена след информация', [$data]);
        // dd($data);
        // return $data;
         
        return $division;
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable|string',
            'parent_id' => 'nullable',
            'name' => 'nullable|string',
            'code' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'comment' => 'nullable',
        ];
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',             // разделитель полей (у вас скорее всего ;)
            'input_encoding' => 'CP1251',   // или 'Windows-1251'
            'bom' => true, // для обработки BOM
        ];
    }
}
