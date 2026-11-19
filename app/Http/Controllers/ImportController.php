<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Validators\ValidationException;
use App\Imports\ClientImport;
use App\Imports\CompanyDivisionImport;
use App\Models\CompanyDivision42;
use App\Models\CompanyDivision;
use App\Models\Client67;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class ImportController extends Controller
{
    public function import(Request $request) 
    {   
        // $allUploadedfiles = $request->allFiles();
        // dd($allUploadedfiles);

        // if (!$request->hasFile('divisions_file') || !$request->hasFile('clients_file')) {
        //     dd('Файл не загружен');
        // }

        // if (!$request->file('divisions_file')->isValid() || !$request->file('clients_file')->isValid()) {
        //     dd('Файл повреждён или не загружен');
        // }


            
        // try {
        //     // $request->validate([
        //     //     'divisions_file' => 'required|file|mimes:csv,xls,xlsx|mimetypes:text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        //     //     'clients_file'   => 'nullable|file|mimes:csv,xls,xlsx|mimetypes:text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // теперь не обязателен
        //     // ]);

        //     // DB::transaction(function () use ($request) {
        //     //     $divisionImport = new CompanyDivisionImport();
        //     //     $divisionImported = Excel::import($divisionImport, $request->file('divisions_file'));
        //     //     $this->updateDivisionParents();
                
        //     //     // dd($divisionImported);
        //     //     // Excel::import(new ClientImport(), $request->file('clients_file'))
                
        //     //     Log::info('Отделы обновлены', [$divisionImport]);
        //     // });

        //     // $collection = Excel::toCollection(new CompanyDivisionImport(), $request->file('divisions_file'));
        //     // $collection = Excel::toCollection(new ClientImport(), $request->file('clients_file'));
        //     $clientImport = new ClientImport();
        //     $clientImported = Excel::import($clientImport, $request->file('clients_file'));
        //     // dd($clientImported); 
        // } catch (ValidationException $e) {
        //     $failures = $e->failures();
        //     $errors = [];
        //     foreach ($failures as $failure) {
        //         $errors[] = "Строка {$failure->row()}: " . implode(', ', $failure->errors());
        //     }
        //     // return back()->withErrors($errors);
        //     dd($errors);
        // } catch (\Exception $e) {
        //     // $allUploadedfiles = $request->allFiles();
        //     // dd($allUploadedfiles);
        //     // $collection = Excel::toCollection(new CompanyDivisionImport(), $request->file('divisions_file'));
        //     // dd($collection);
        //     dd('Тип исключения: ' . get_class($e), 'Ошибка: ' . $e->getMessage(), $e->getTraceAsString(), $request->file('divisions_file'));

        //     // return back()->withErrors('Ошибка импорта: ' . $e->getMessage());
        // }
        // dd($clientImported); 



        
        // $request->validate([
        //     'divisions_file' => 'file|mimes:csv,xlsx',
        // ]);

        DB::transaction(function () use ($request) {
            if ($request->hasFile('divisions_file')) {
                $divisionImport = new CompanyDivisionImport();
                $divisionImported = Excel::import($divisionImport, $request->file('divisions_file'));
                $this->updateDivisionParents();
                $disabledDivisions = $divisionImport->disableMissing();
                Log::info('Данные подразделений обновлены');
            }
            
            // dd("Импорт", $divisionImported);
            
            // Log::info('Отделы обновлены', [$divisionImported]);

             // 3. Импорт сотрудников (теперь подразделения уже есть)
            $disabledClients = 0;
            if ($request->hasFile('clients_file')) {
                $clientImport = new ClientImport();
                $clientImported = Excel::import($clientImport, $request->file('clients_file'));
                $disabledClients = $clientImport->disableMissing();
                $enabled  = $clientImport->enableReturned();
                Log::info("Импорт сотрудников. Данные обновлены: отключено {$disabledClients}, включено {$enabled}");

            }
            
        });

        return redirect()->back()->with('success', 'Данные успешно импортированы!');
    }

    private function updateDivisionParents()
    {
        $divisions = CompanyDivision::whereNotNull('div_sync_1c_parent_code')->get();
        foreach ($divisions as $div) {
            $parent = CompanyDivision::where('div_sync_1c_code', $div->div_sync_1c_parent_code)->first();
            if ($parent && $parent->div_id != $div->div_parent_id) {
                $div->div_parent_id = $parent->div_id;
                $div->save();
            }
        }
    }
}
