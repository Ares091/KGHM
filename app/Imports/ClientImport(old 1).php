<?php

namespace App\Imports;

use App\Models\Client;
use App\Models\Client67;
use App\Models\CompanyDivision;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Carbon;
use phpDocumentor\Reflection\Types\Nullable;

//
class ClientImport implements ToModel, WithHeadingRow, WithCustomCsvSettings, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);

        if (empty(trim($row['id'] ?? '')) || empty(trim($row['lastname'] ?? ''))) {
            return null;
        }

        // Ищем подразделение по его коду 1С
        $division = CompanyDivision::where('div_sync_1c_code', trim($row['division_id']))->first();
        $divId = $division ? $division->div_id : null;



        $syncCodeId = trim($row['id']);
        $syncCode = trim($row['code']);
        $lastname = trim($row['lastname'] ?? null);
        $firstname = trim($row['firstname'] ?? null);
        $middlename = trim($row['middlename'] ?? null);
        $position = trim($row['position_name'] ?? null);
        $email = trim($row['email'] ?? null);
        $mobile = trim(strval($row['mobile_phone']) ?? null);
        $workPhone = trim(strval($row['work_phone']) ?? null);
        $status = trim($row['status'] ?? null);
        $employmentType = trim($row['employment_type'] ?? null);
        $gender = isset($row['gender_id']) ? (int)$row['gender_id'] : null; // 0 или 1, но в БД bit
        $birthDate = $this->parseDate($row['birth_date'] ?? null);
        $hireDate = $this->parseDate($row['hire_date'] ?? null);
        $dismissalDate = $this->parseDate($row['dismissal_date'] ?? null);

        $privateAdress = trim($row['address'] ?? null);
        $privateActialAdress = trim($row['adress_actual'] ?? null);

        // Если есть дата увольнения – считаем сотрудника уволенным
        // $disabled = $dismissalDate ? 1 : 0;
        $disabled = $row['status'] === 'Трудовой договор приостановлен' ? 1 : 0;
        

        $data = [
            'cli_name_f'   => $lastname,
            'cli_name_i'   => $firstname,
            'cli_name_o'   => $middlename,
            'cli_name_view'=> trim("$lastname $firstname $middlename"),
            'cli_prof'     => $position,
            'cli_div_id'   => $divId,
            'cli_email'    => $email,
            'cli_tel_work' => '46-55-05',
            'cli_tel_work2' => null,
            'cli_tel_mobile' => $workPhone,
            'cli_date_born'=> $birthDate,
            'cli_comment'=> null,
            'cli_disable'  => $disabled,
            'cli_date_change' => now(),
            'cli_sex' => $gender,
            'cli_pregnant' => 0,
            'cli_sync_1c' => 1,
            'cli_sync_1c_code' => $syncCode,
            'cli_sync_1c_division_code' => trim($row['division_id']),
            'cli_sync_1c_apply' => 1,
            'cli_sync_1c_is_division_head' => 0,
            'cli_sync_1c_category' => null,
            'cli_sync_1c_status' => $status,
            'cli_sync_1c_employment_type' => $employmentType,
            'cli_sync_1c_hire_date' => $hireDate,
            // cli_sync_1c_id – можно сохранить тот же код, если нужно
            'cli_sync_AD' => null,
            'cli_sync_1c_id' => $syncCodeId,
            'cli_mobile_phone' => $mobile,
            'cli_address' => $privateAdress,
            'cli_adress_actual' => $privateActialAdress,

        ];

        // Log::info('Импорт данных сотрудников. Перем data:', [$data]);


        $client = Client67::where('cli_sync_1c_id', $syncCodeId)->where('cli_sync_1c', 1)->first();

        if (!$client) {
            Log::info('Импорт данных сотрудников. Новая Перем client:', [$data['cli_name_view']]);
            $data['cli_date_create'] = now();
            return Client67::create($data);
        } else {
            // Сравниваем значимые поля (кроме id, дат создания/изменения, sync-флагов)
            // $fieldsToCompare = [
            //     'cli_name_f', 'cli_name_i', 'cli_name_o', 'cli_name_view',
            //     'cli_prof', 'cli_div_id', 'cli_email', 'cli_tel_work',
            //     'cli_tel_mobile', 'cli_date_born', 'cli_sex',
            //     'cli_sync_1c_division_code', 'cli_sync_1c_status',
            //     'cli_sync_1c_employment_type', 'cli_sync_1c_hire_date'
            // ];
            // $changed = false;
            // foreach ($fieldsToCompare as $field) {
            //     if ($client->$field != $data[$field]) {
            //         $changed = true;
            //         break;
            //     }
            // }

            // Проверяем изменения в ключевых полях
            $changed = $this->hasChanges($client, $data);

            if ($changed) {
                // $client->update($data);
                $client->update([
                    'cli_name_f'   => $lastname,
                    'cli_name_i'   => $firstname,
                    'cli_name_o'   => $middlename,
                    'cli_name_view'=> trim("$lastname $firstname $middlename"),
                    'cli_prof'     => $position,
                    'cli_div_id'   => $divId,
                    'cli_email'    => $email,

                    'cli_sync_1c' => 1,
                    'cli_sync_1c_code' => $syncCode,
                    'cli_sync_1c_division_code' => trim($row['division_id']),
                    'cli_sync_1c_apply' => 1,
                    'cli_sync_1c_is_division_head' => 0,
                    'cli_sync_1c_category' => null,
                    'cli_sync_1c_status' => $status,
                    'cli_sync_1c_employment_type' => $employmentType,
                    'cli_sync_1c_hire_date' => $hireDate,
                    // cli_sync_1c_id – можно сохранить тот же код, если нужно
                    // 'cli_sync_AD' => null,
                    'cli_sync_1c_id' => $syncCodeId,
                    
                    'cli_mobile_phone' => $mobile,
                    'cli_address' => $privateAdress,
                    'cli_adress_actual' => $privateActialAdress,
                ]);
                Log::info('Импорт данных сотрудников. Измененная Перем client:', [$data['cli_name_view']]);
            } else {
                // Log::info('Импорт данных сотрудников. Перем БЕЗ изменений client:', [$data['cli_name_view']]);

            }
            return $client;
        }
    }


     /**
     * Проверка изменений в ключевых полях
     */
    private function hasChanges($client, array $data): bool
    {
        // Ключевые поля для сравнения (ФИО, должность, подразделение, email)
        $keyFields = [
            'cli_name_f',
            'cli_name_i',
            'cli_name_o',
            'cli_name_view',
            'cli_prof',
            'cli_div_id',
            'cli_email',
        ];

        // Дополнительные поля (телефоны, даты, статусы) тоже проверяем
        $additionalFields = [
            // 'cli_tel_work',
            // 'cli_tel_mobile',
            'cli_date_born',
            // 'cli_sex',
            // 'cli_disable',
            // 'cli_sync_1c_code',
            // 'cli_sync_1c_apply',
            'cli_sync_1c_division_code',
            'cli_sync_1c_status',
            'cli_sync_1c_employment_type',
            'cli_sync_1c_hire_date',
            // 'cli_sync_1c_id',
            // 'cli_mobile_phone',
            // 'cli_address',
            // 'cli_adress_actual'
        ];

        $allFields = array_merge($keyFields, $additionalFields);

        foreach ($allFields as $field) {
            // Сравниваем значения (приводим к строке для корректного сравнения)
            $oldValue = (string)$client->$field;
            $newValue = (string)($data[$field] ?? '');
            
            if ($oldValue !== $newValue) {
                return true;
            }
        }

        return false;
    }

    private function parseDate($value) {
         if (empty($value) || trim($value) === '') {
            return null;
        }

        try {
            return Carbon::createFromFormat('d.m.Y', trim($value))->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return Carbon::parse(trim($value))->format('Y-m-d H:i:s');      
        }
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable',
            'lastname' => 'nullable|string',
            'firstname' => 'nullable|string',
            'middlename' => 'nullable|string',
            'dismissal_date' => 'nullable|string',
            'email' => 'nullable|string',
            'mobile_phone' => 'nullable',
            'work_phone' => 'nullable',
            'status' => 'nullable|string',
            'employment_type' => 'nullable|string',
            'address' => 'nullable',
            'adress_actual' => 'nullable',
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
