<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Equipment;
use App\Models\EquipmentJournal;
use App\Models\EquipmentStatus;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index() 
    {
     
    }

    public function newEquipmentActionStatus(Request $request) {
        $data = [];
        $actionType = $request->action_name;

        $equipment = Equipment::findOrFail($request->eq_id);
        $client = Client::findOrFail($request->client_id);
        // $equipmentJournal = EquipmentJournal::where('eqj_eq_id', $request->eq_id)->where('edj_cli_id', $request->client_id)->first();

        $equipmentStatus = EquipmentStatus::where('eqs_name', $request->eq_status_name);


        if ($request->action_name === "give"){
            // $newEquipmentStatus = $equipment->replicate();

            $equipment->eq_status_id = (int)$equipmentStatus->id;
            $equipment->eq_div_id = (int)$request->client_div_id;
            $equipment->eq_client_id = (int)$request->client_id;
            $equipment->date_change = now();

            $equipment->save();

            $equipmentJournal = EquipmentJournal::create([
                'eqj_eq_id' => $equipment->id ?? null,
                'eqj_datetime' => now(),
                'eqj_status' => $equipmentStatus->eqs_name ?? null,
                'eqj_cli_id' => $client->id ?? null,
                'eqj_comment' => $request->eq_comment ?? null,
            ]);

            return response()->json(['success' => true]);

        } else if ($request->action_name === "pass_off") {
            $equipment->eq_status_id = 1;
            $equipment->eq_div_id = 4104;
            $equipment->eq_client_id = null;
            $equipment->date_change = now();

            // $equipmentJournalOldClient = EquipmentJournal::where('eqj_eq_id', $request->eq_id)->where('edj_cli_id', $request->client_id)->first();

            $equipmentJournal = EquipmentJournal::create([
                'eqj_eq_id' => $equipment->id ?? null,
                'eqj_datetime' => now(),
                'eqj_status' => 'Сдан',
                'eqj_cli_id' => $client->id ?? null,
                'eqj_comment' => $request->eq_comment ?? null,
            ]);

            return response()->json(['success' => true]);

        } else if ($request->action_name === "rewrite") {
            $equipment->eq_status_id = (int)$equipmentStatus->id;
            $equipment->eq_div_id = (int)$request->client_div_id;
            $equipment->eq_client_id = (int)$request->client_id;
            $equipment->date_change = now();

            $equipment->save();

            $equipmentJournalOldClient = EquipmentJournal::where('eqj_eq_id', $request->eq_id)->where('edj_cli_id', $request->client_id)->first();
            $equipmentJournalOldClient->eqj_cli_id = (int)$request->client_id;
            $equipmentJournalOldClient->eqj_cli_id = $request->eq_comment ?? null;

            $equipmentJournalOldClient->save();
            
            return response()->json(['success' => true]);

        } else if ($request->action_name === "write_off") {
            $equipment->eq_status_id = 3;
            $equipment->eq_div_id = 4108;
            $equipment->eq_client_id = null;
            $equipment->date_change = now();

            $equipment->save();

            $equipmentJournalOldClient = EquipmentJournal::where('eqj_eq_id', $request->eq_id)->where('edj_cli_id', $request->client_id)->first();
            $equipmentJournalOldClient->eqj_status = 'Сдан';
            $equipmentJournalOldClient->eqj_cli_id = $request->eq_comment ?? null;

            $equipmentJournalOldClient->save();

            $equipmentJournal = EquipmentJournal::create([
                'eqj_eq_id' => $equipment->id ?? null,
                'eqj_datetime' => now(),
                'eqj_status' => 'Списан',
                'eqj_cli_id' => null,
                'eqj_comment' => $request->eq_comment ?? null,
            ]);
            
            return response()->json(['success' => true]);
        }

    }


    public function getPopupUserInfo(Request $request) {
        // if ($user->role === 'admin' && $user->role === 'director'){
        //     $role = $user->role;
        // }
        $user = Auth::user();


        $cliUser = Client::where('cli_id', $user->u_t_client_id)->orWhere('cli_email', $user->u_email)->first();


        return view('components/popup/popup_userInfo', ['cliUser' => $cliUser])->render();
    }

    public function getInnerPopupEditUserData(Request $request) {
        // if ($user->role === 'admin' && $user->role === 'director'){
        //     $role = $user->role;
        // }
        $userInfo = Auth::user();


        // $cliUser = Client::where('cli_id', $user->u_t_client_id)->orWhere('cli_email', $user->u_email)->first();


        return view('components/popup/inner_popup/inner_popup_editUserData', ['userInfo' => $userInfo])->render();
    }

    public function EditUserData(Request $request) {
        // if ($user->role === 'admin' && $user->role === 'director'){
        //     $role = $user->role;
        // }

        $user = Auth::user();

        // $reqData = json_decode($request->edit_data);

        // $validated = $request->validate([
        //     'u_login' => 'required|string|max:255',
        //     'u_email' => 'required|email|max:255',
        //     'u_password' => 'nullable|string|max:255',
        //     'u_new_password' => 'nullable|string|max:255',
        //     'u_new_password_confirm' => 'nullable|string|max:255|same:u_new_password',
        // ]);

        $validator = Validator::make($request->all(), [
            'u_login' => 'required|string|min:4|max:255',
            'u_email' => 'required|email|max:255',
            'u_password' => 'nullable|string|max:255',
            'u_new_password' => 'nullable|string|min:8|max:255',
            'u_new_password_confirm' => 'nullable|string|min:8|max:255',
        ], [
            'u_login.required' => 'Введите логин.',
            'u_login.min' => 'Логин не должен быть меньше 4 символов.',
            'u_email.email' => 'Имеил введен неверно',
            'u_password.required' => 'Введите пароль.',
            'u_new_password.min' => 'Новый пароль не должен быть меньше 8 символов',
            'u_new_password_confirm.min' => 'Повтор нового пароля не должен быть меньше 8 символов',
        ]);

        if ($validator->fails()) {
            Log::info('Введены неверные данные пользователя: ', []);
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(), // { field: [messages] }
            ]);
        }

        $validated = $validator->validated();

        // $cliUser = Client::where('cli_id', $user->u_t_client_id)->orWhere('cli_email', $user->u_email)->first();

        try {
            // Создаем новую запись

            if ($user) {

                $updateData = [
                    'u_login' => $validated['u_login'] ?? $user->u_login,
                    'u_email' => $validated['u_email'] ?? $user->u_email,
                ];

                $wantsNewPassword = !empty($validated['u_new_password']) ;

                if (!empty($validated['u_password']) && !Hash::check($validated['u_password'] ?? '', $user->u_password)) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['u_password' => ['Текущий пароль неверен']],
                    ]);
                }
                
                if ($wantsNewPassword) {
                    
                    if(empty($validated['u_password'])) {
                        return response()->json([
                            'success' => false,
                            'errors' => ['u_password' => ['Для смены пароля введите сначала текущий']],
                        ]);
                    }
                    
                    if ($validated['u_new_password'] !== $validated['u_new_password_confirm']) {
                        return response()->json([
                            'success' => false,
                            'errors' => ['u_new_password_confirm' => ['Пароли не совпадают']],
                        ]);
                    }
                    $updateData['u_password'] = Hash::make($validated['u_new_password']);
                }
                

                $user->update($updateData);

                // Логируем успешное создание
                Log::info('Данные пользователя успешно изменены', ['user id:' => $user->u_id, 'user' => Auth::id()]);
            }
            else {
                Log::info('Данные пользователя не найдены по id: ', []);
            }
            
            

            // Возвращаем успешный ответ
            // return redirect()->back()->with('success', 'Техника успешно изменена!');
            return response()->json([
                'success' => true,
                'answer'  => 'Техника успешно изменена!'
            ]);

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при изменении пользователя', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при изменении пользователя: ' . $e->getMessage()]);
        }

    }


    




    // public function EditUserData(Request $request) {
    //     // if ($user->role === 'admin' && $user->role === 'director'){
    //     //     $role = $user->role;
    //     // }

    //     $user = Auth::user();

    //     // $reqData = json_decode($request->edit_data);

    //     // $validated = $request->validate([
    //     //     'u_login' => 'required|string|max:255',
    //     //     'u_email' => 'required|email|max:255',
    //     //     'u_password' => 'nullable|string|max:255',
    //     //     'u_new_password' => 'nullable|string|max:255',
    //     //     'u_new_password_confirm' => 'nullable|string|max:255|same:u_new_password',
    //     // ]);

    //     $validator = Validator::make($request->all(), [
    //         'u_login' => 'required|string|min:4|max:255',
    //         'u_email' => 'required|email|max:255',
    //         'u_password' => 'nullable|string|min:8|max:255',
    //         'u_new_password' => 'nullable|string|min:8|max:255',
    //         'u_new_password_confirm' => 'nullable|string|min:8|max:255|same:u_new_password',
    //     ], [
    //         'u_login.required' => 'Введите логин.',
    //         'u_email.email' => 'Имеил введен неверно',
    //         'u_password.required' => 'Введите пароль.',
    //         'u_new_password_confirm.same' => 'Повтор нового пароля должен совпадать с идентичным полем',
    //     ]);

    //     if ($validator->fails()) {
    //         Log::info('Введены неверные данные пользователя: ', []);
    //         return response()->json([
    //             'success' => false,
    //             'errors'  => $validator->errors(), // { field: [messages] }
    //         ]);
    //     }

    //     $validated = $validator->validated();

    //     // $cliUser = Client::where('cli_id', $user->u_t_client_id)->orWhere('cli_email', $user->u_email)->first();

    //     try {
    //         // Создаем новую запись

    //         if ($user) {

    //             $updateData = [
    //                 'u_login' => $validated['u_login'] ?? $user->u_login,
    //                 'u_email' => $validated['u_email'] ?? $user->u_email,
    //             ];
                
    //             if ($validated['u_new_password'] !== null) {
    //                 if (Hash::check($validated['u_password'], $user->u_password) && $validated['u_new_password'] === $validated['u_new_password_confirm']) {
    //                     // Пароли соответствуют...
    //                     $validated['u_password'] = $validated['u_new_password'];
    //                 }
    //             }
                

    //             $user->update([
    //                 'u_login' => $validated['u_login'] ?? $user->u_login,
    //                 'u_email' => $validated['u_email'] ?? $user->u_email,
    //                 'u_password' =>  Hash::make($validated['u_password']) ?? $user->u_password,
    //             ]);

    //             // Логируем успешное создание
    //             Log::info('Данные пользователя успешно изменены', ['user id:' => $user->u_id, 'user' => Auth::id()]);
    //         }
    //         else {
    //             Log::info('Данные пользователя не найдены по id: ', []);
    //         }
            
            

    //         // Возвращаем успешный ответ
    //         // return redirect()->back()->with('success', 'Техника успешно изменена!');
    //         return response()->json([
    //             'success' => true,
    //             'answer'  => 'Техника успешно изменена!'
    //         ]);

    //     } catch (\Exception $e) {
    //         // Логируем ошибку
    //         Log::error('Ошибка при изменении пользователя', [
    //             'error' => $e->getMessage(),
    //             'data' => $request->all()
    //         ]);

    //         return redirect()->back()->withErrors(['error' => 'Ошибка при изменении пользователя: ' . $e->getMessage()]);
    //     }

    // }
}
