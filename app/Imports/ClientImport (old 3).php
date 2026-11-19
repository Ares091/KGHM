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
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
//
class ClientImport implements ToModel, WithHeadingRow, WithCustomCsvSettings, WithValidation, WithColumnFormatting
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    /** @var string[] Коды договоров, встреченные в файле */
    private array $seenSyncIds = [];
    private array $seenSyncCodes = [];

     /** @var array<string, array> Данные из CSV по каждому коду — для enableReturned() */
    private array $dataByCode = [];

    public function model(array $row)
    {
        // dd($row);

        if (empty(trim($row['id'] ?? '')) || empty(trim($row['lastname'] ?? ''))) {
            return null;
        }

        // Ищем подразделение по его коду 1С
        $division = CompanyDivision::where('div_sync_1c_code', trim($row['division_id']))->first();
        $divId = $division ? $division->div_id : null;



        $syncCodeId = trim(strval($row['id']));
        $syncCode = trim($row['code']);
        $lastname = trim($row['lastname'] ?? null);
        $firstname = trim($row['firstname'] ?? null);
        $middlename = trim($row['middlename'] ?? null);
        $position = trim($row['position_name'] ?? null);
        // $email = trim($row['email'] ?? null);
        $email = null;
        $mobile = trim(strval($row['mobile_phone']) ?? null);
        $workPhone = trim(strval($row['work_phone']) ?? null);
        $status = trim($row['status'] ?? null);
        $employmentType = trim($row['employment_type'] ?? null);
        $gender = isset($row['gender_id']) ? (int)$row['gender_id'] : null; // 0 или 1, но в БД bit
        $birthDate = $this->parseDate($row['birth_date'] ?? null);
        $hireDate = $this->parseDate($row['hire_date'] ?? null);
        $dismissalDate = $this->parseDate($row['dismissal_date'] ?? null);

        $privateAdress = trim(strval($row['address']) ?? null);
        $privateActialAdress = trim(strval($row['adress_actual']) ?? null);

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



        $fillableData = [
            'cli_name_f'   => $lastname,
            'cli_name_i'   => $firstname,
            'cli_name_o'   => $middlename,
            'cli_name_view'=> trim("$lastname $firstname $middlename"),
            'cli_prof'     => $position,
            'cli_div_id'   => $divId,
            'cli_tel_work' => '46-55-05',
            'cli_date_change' => now(),
            'cli_sex' => $gender,
            'cli_sync_1c_code' => $syncCode,
            'cli_sync_1c_division_code' => trim($row['division_id']),
            'cli_sync_1c_status' => $status,
            'cli_sync_1c_employment_type' => $employmentType,
            'cli_sync_1c_hire_date' => $hireDate,
            // cli_sync_1c_id – можно сохранить тот же код, если нужно
            'cli_sync_1c_id' => $syncCodeId,
            'cli_mobile_phone' => $mobile,
            'cli_address' => $privateAdress,
            'cli_adress_actual' => $privateActialAdress,
        ];

        $this->seenSyncIds[] = $syncCodeId;
        $this->seenSyncCodes[] = $syncCode;
        $this->dataByCode[$syncCode] = $data;

        // Log::info('Импорт данных сотрудников. Перем data:', [$data]);


        //->where('cli_disable', 0)->where('cli_sync_1c', 1)
        $client = Client67::where('cli_sync_1c_id', $syncCodeId)->first();

        if (!$client) {
            Log::info('Импорт данных сотрудников. Новая Перем client:', [$data['cli_name_view'], $syncCode]);
            $data['cli_date_create'] = now();
            return Client67::create($data);
        } else {
            // Сравниваем значимые поля (кроме id, дат создания/изменения, sync-флагов)
            $fieldsToCompare = [
                'cli_name_f', 'cli_name_i', 'cli_name_o', 'cli_name_view',
                'cli_prof', 'cli_div_id', 'cli_tel_work',
                'cli_sex', 'cli_sync_1c_code',
                'cli_sync_1c_division_code', 'cli_sync_1c_status',
                'cli_sync_1c_employment_type', 'cli_sync_1c_hire_date',
                'cli_sync_1c_id', 'cli_mobile_phone', 'cli_address', 'cli_adress_actual'
            ];
            $changed = false;
            foreach ($fieldsToCompare as $field) {
                if ($client->$field != $data[$field]) {
                    $changed = true;
                    break;
                }
            }

            

            // Проверяем изменения в ключевых полях

            if ($changed && $client->cli_disable === false) {
                
                $client->cli_mobile_phone = trim($row['mobile_phone']);
                $client->cli_address = trim($row['address']);
                $client->cli_adress_actual = trim($row['adress_actual']);
                $client->save();

                // $client->update($data);
                $client->update($fillableData);
                Log::info('Импорт данных сотрудников. Измененная Перем client:', [$data['cli_name_view']]);
            } else {
                // if ($client->cli_disable === true && (int)$client->cli_sync_1c_id === (int)$syncCodeId) {
                //     $client->cli_disable = 0;

                //     $client->cli_mobile_phone = trim($row['mobile_phone']);
                //     $client->cli_address = trim($row['address']);
                //     $client->cli_adress_actual = trim($row['adress_actual']);
                //     $client->save();

                //     // $client->update($data);
                //     $client->update($fillableData);
                //     Log::info('Импорт данных сотрудников. Ввостановленная Перем client:', [$data['cli_name_view']]);
                // }
                // Log::info('Импорт данных сотрудников. Перем БЕЗ изменений client:', [$data['cli_name_view']]);

            }
            return $client;
        }
    }

    public function disableMissing()
    {
        if (empty($this->seenSyncCodes)) {
            Log::warning('ClientImport:: Список sync-id пуст, пропускаем.');
            return 0;
        }

        //count
        $affected = Client67::where('cli_sync_1c', 1)
        ->whereNotNull('cli_sync_1c_code')
        ->whereNotIn('cli_sync_1c_code', $this->seenSyncCodes)
        ->where('cli_disable', 0)
        ->update([
            'cli_disable' => 1,
            'cli_sync_1c_status' => 'Трудовой договор приостановлен',
            'cli_address' => null,
            'cli_adress_actual' => null,
            'cli_date_change' => now(),
        ]);

        Log::info("ClientImport:: disableMissing — отключено записей: {count($affected)}");
        return $affected;
    }

    public function enableReturned()
    {
        $enabled = 0;

        foreach ($this->seenSyncCodes as $codeId => $newCode) {
            $data = $this->dataByCode[$newCode] ?? null;
            if (!$data) {
                // return 0;
                continue;
            }

            $syncId = $data['cli_sync_1c_id'] ?? null;
            // $syncId = $this->seenSyncIds[$codeId] ?? null;
            if (!$syncId) {
                Log::info('enableReturned — ошибка: $syncId неопределена', [
                    'newCode' => $newCode, 'syncId' => $syncId,
                ]);
                continue;
            }

            // 1. Запись с новым кодом (создана/найдена model())
            $current = Client67::where('cli_sync_1c_code', $newCode)
                ->where('cli_sync_1c_id', $syncId)
                ->firstOrNew([
                    'cli_sync_1c_id' => $data['cli_sync_1c_id'], 
                    'cli_sync_1c_code' => $newCode, 
                    'cli_disable' => $data['cli_disable'], 
                    'cli_date_change' => $data['cli_date_change'], 
                ]);
            if (!$current) {
                continue;
            }

            // 2. У физлица не должно быть другого активного договора
            $otherActive = Client67::where('cli_sync_1c_id', $syncId)
                ->where('cli_disable', 0)
                ->where('cli_id', '!=', $current->cli_id)
                ->exists();
            if ($otherActive) {
                Log::info('enableReturned — пропуск: есть другой активный договор', [
                    'newCode' => $newCode, 'syncId' => $syncId,
                ]);
                continue;
            }

            if ((int)$current->cli_disable === true) {
                $current->update([
                    'cli_disable'     => 0,
                    'cli_date_change' => now(),
                ]);
                $enabled++;
                Log::info('enableReturned — включена существующая отключённая запись', [
                    'code' => $newCode, 'syncId' => $syncId,
                ]);
                continue;
            }

            // 3. Ищем ровно одну отключённую старую запись с тем же id физлица
            $hireDate = $data['cli_sync_1c_hire_date'] ?? null;
            $oldQuery = Client67::where('cli_sync_1c_id', $syncId)
                ->where('cli_sync_1c_code', '!=', $newCode)
                ->where('cli_disable', 1);

            // Для надёжности сверяем дату найма (если она задана в CSV)
            if (!empty($hireDate)) {
                $oldQuery->where(function ($q) use ($hireDate) {
                    $q->where('cli_sync_1c_hire_date', $hireDate)
                    ->orWhereNull('cli_sync_1c_hire_date');
                });
            }

            $oldRecords = $oldQuery->get();
            if ($oldRecords && $oldRecords->count() > 1) {
                // Log::info('enableReturned — пропуск: старых отключённых записей ' . $oldRecords->count(), [
                //     'newCode' => $newCode, 'syncId' => $syncId,
                // ]);
                continue;
            }

            $old = $oldRecords->first();

            if (!$old) {
                continue;
            }

            $oldCode = $old->cli_sync_1c_code;

             // Обновляем данными из CSV + принудительно включаем
            $client->update(array_merge($data, [
                'cli_sync_1c_code' => $newCode,
                'cli_disable'      => 0,
                'cli_date_change'  => now(),
            ]));

            // 5. Удаляем дубликат, созданный model()
            $current->delete();

            $enabled++;
            Log::info('ClientImport::enableReturned — включён возвращенный договор:', [
                'oldCode' => $oldCode,
                'newCode' => $newCode,
                'syncId'  => $syncId,
            ]);
        } 

        Log::info("ClientImport::enableReturned — включено: {$enabled}");
        return $enabled;
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

    public function columnFormats(): array
    {
        return [
            'id' => DataType::TYPE_STRING, 
            'address' => DataType::TYPE_STRING, 
            'adress_actual' => DataType::TYPE_STRING, 
            'mobile_phone' => DataType::TYPE_STRING, 
        ];
    }
}
