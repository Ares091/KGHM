<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Client67;
use App\Models\CompanyDivision;
use App\Models\CompanyDivision42;
use App\Models\Equipment;
use App\Models\EquipmentDocument;
use App\Models\EquipmentJournal;
use App\Models\EquipmentStatus;
use App\Models\EquipmentType;
use App\Models\Provider;
use App\Models\User;
// use Auth;
use Hash;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Matrix\Operators\Division;
use Symfony\Component\Process\Process;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        if (request()->fullUrlIs('http://192.168.128.39')){
            return redirect()->away('http://handbook');
        }
        
        $depId = 4198;
        $depName = 'Бухгалтерия';
        $divisionType =  'main'; // 'main' или 'sub'
        $user = Auth::user();

        $userIp = $request->ip(); 
        $computerName = gethostbyaddr($userIp);


        if ($computerName === $userIp) {
            $computerName = null;
        }
        else {
            $computerName = substr($computerName, 0, 6);
        }
        

        Log::info('Пользователь открыл подраздел', [$depName]);

        if ($divisionType === 'main') {
            // Если это отдел (главный), получаем всех сотрудников из отдела и всех его подразделов
            $clients = $this->getAllClientsInDivisionTree($depId);
        } else {
            // Если это подраздел (бюро), получаем только сотрудников этого подраздела
            $clients = Client::where('cli_div_id', $depId)
                ->where('cli_sync_1c', 1)
                ->where('cli_disable', 0)
                ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
                ->orderBy('cli_name_f', 'asc')
                ->get();
        }

        $CompanyDivisions = CompanyDivision::whereNull('div_parent_id')
            ->where('div_sync_1c', 1)->where('div_disable', 0)
            ->with([
                'children' => function ($query) {
                    $query->where('div_sync_1c', 1)->where('div_disable', 0)->orderBy('div_name_full')->orderBy('div_id');
                },
                'children.children' => function ($query) {
                    $query->where('div_sync_1c', 1)->where('div_disable', 0)->orderBy('div_name_full')->orderBy('div_id');
                }
            ])
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();


            
            //->select('*')->distinct()
            return view('handbookPages.main', ['clients' => $clients, 'CompanyDivisions' => $CompanyDivisions, 'user' => $user, 'userIp' => $userIp, 'computerName' => $computerName ]);

    }

    public function directorPage()
    {
        $depId = 4198;
        $depName = 'Бухгалтерия';
        $divisionType =  'main'; // 'main' или 'sub'
        $user = Auth::user();

        // if (!$user || $user && $user->u_role !== 'director') {
        //     return redirect()->route('index');
        // }
        

        Log::info('Пользователь открыл подраздел', [$depName]);

        if ($divisionType === 'main') {
            // Если это отдел (главный), получаем всех сотрудников из отдела и всех его подразделов
            $clients = $this->getAllClientsInDivisionTree($depId);
        } else {
            // Если это подраздел (бюро), получаем только сотрудников этого подраздела
            $clients = Client::where('cli_div_id', $depId)
                ->where('cli_sync_1c', 1)
                ->where('cli_disable', 0)
                ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
                ->orderBy('cli_name_f', 'asc')
                ->get();
        }

        $CompanyDivisions = CompanyDivision::whereNull('div_parent_id')
            ->where('div_sync_1c', 1)->where('div_disable', 0)
            ->with([
                'children' => function ($query) {
                    $query->where('div_sync_1c', 1)->where('div_disable', 0)->orderBy('div_name_full')->orderBy('div_id');
                },
                'children.children' => function ($query) {
                    $query->where('div_sync_1c', 1)->where('div_disable', 0)->orderBy('div_name_full')->orderBy('div_id');
                }
            ])
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();


            
            //->select('*')->distinct()
    
        if (!$user || $user->u_role === "user"){
            $nonLogin = true;
            return view('handbookPages.directorPage', ['clients' => $clients, 'CompanyDivisions' => $CompanyDivisions, 'user' => $user, 'nonLogin' => $nonLogin ]);
        }
        else {
            return view('handbookPages.directorPage', ['clients' => $clients, 'CompanyDivisions' => $CompanyDivisions, 'user' => $user, 'nonLogin' => false ]);
        }
    }


    public function adminPage(Request $request)
    {
        $depId = 4198;
        $depName = 'Бухгалтерия';
        $divisionType =  'main'; // 'main' или 'sub'
        $user = Auth::user();

        $userIp = $request->ip(); 
        $computerName = gethostbyaddr($userIp);

        if ($computerName === $userIp) {
            $computerName = null;
        }
        else {
            $computerName = substr($computerName, 0, 6);
        }

        $pageIsMain = $request->header('referer') === 'http://handbook/' ? true : false;
        $tableType = $pageIsMain === true ? "userTable" : "AdminTable";

        // $execUN = new Process(['whoami']);
        // $execUN->run();
        
        // $execUG = new Process(['whoami /groups /fo csv /nh']);
        // $execUG->run();

        // $username = trim($execUN->getOutput());
        // $usergroups = trim($execUG->getOutput());

        // $username2 = request()->server('REMOTE_USER'); 

        // dd($username, $usergroups, $username2);
        
        

        Log::info('Пользователь открыл подраздел', [$depName]);

        if ($divisionType === 'main') {
            // Если это отдел (главный), получаем всех сотрудников из отдела и всех его подразделов
            $clients = $this->getAllClientsInDivisionTree($depId, $tableType);
        } else {
            // Если это подраздел (бюро), получаем только сотрудников этого подраздела
            $clients = Client::where('cli_div_id', $depId)
                ->where('cli_sync_1c', 1)
                ->where('cli_disable', 0)
                ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
                ->orderBy('cli_name_f', 'asc')
                ->get();
        }

        // $CompanyDivisions = CompanyDivision::whereNull('div_parent_id')
        //     ->where('div_sync_1c', 1)->where('div_disable', 0)
        //     ->with([
        //         'children' => function ($query) {
        //             $query->where('div_sync_1c', 1)->where('div_disable', 0)->orderBy('div_name_full')->orderBy('div_id');
        //         },
        //         'children.children' => function ($query) {
        //             $query->where('div_sync_1c', 1)->where('div_disable', 0)->orderBy('div_name_full')->orderBy('div_id');
        //         }
        //     ])
        //     ->orderBy('div_name_full')->orderBy('div_id')
        //     ->get();

        $CompanyDivisions = CompanyDivision::whereNull('div_parent_id')
            ->where('div_disable', 0)
            ->with([
                'children' => function ($query) {
                    $query->where('div_sync_1c', 1)->where('div_disable', 0)->orderBy('div_name_full')->orderBy('div_id');
                },
                'children.children' => function ($query) {
                    $query->where('div_sync_1c', 1)->where('div_disable', 0)->orderBy('div_name_full')->orderBy('div_id');
                }
            ])
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();


        if (!$user || $user->u_role === "user"){
            $nonLogin = true;
            return view('handbookPages.adminPage', ['clients' => $clients, 'CompanyDivisions' => $CompanyDivisions, 'user' => $user, 'userIp' => $userIp, 'computerName' => $computerName, 'nonLogin' => $nonLogin ]);
        }
        else {
            return view('handbookPages.adminPage', ['clients' => $clients, 'CompanyDivisions' => $CompanyDivisions, 'user' => $user, 'userIp' => $userIp, 'computerName' => $computerName, 'nonLogin' => false ]);
        }
            //->select('*')->distinct()

    }

    public function equipmentPage(Request $request)
    {
        $depName = 'Бухгалтерия';
        $divisionType =  'main'; // 'main' или 'sub'
        $user = Auth::user();

        if (!$user || $user && ($user->u_role !== 'admin')) {
            return redirect()->route('index');
        }
        
         $userIp = $request->ip(); 
        $computerName = gethostbyaddr($userIp);

        if ($computerName === $userIp) {
            $computerName = null;
        }
        else {
            $computerName = substr($computerName, 0, 6);
        }

        Log::info('Пользователь открыл подраздел', [$depName]);

        // if ($divisionType === 'main') {
        //     // Если это отдел (главный), получаем всех сотрудников из отдела и всех его подразделов
        //     $equipment = $this->getAllClientsInDivisionTree($eqId);
        // } else {
        //     // Если это подраздел (бюро), получаем только сотрудников этого подраздела
        //     $equipment = Equipment::where('cli_div_id', $eqId)
        //         ->where('cli_sync_1c', 1)
        //         ->where('cli_disable', 0)
        //         ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
        //         ->orderBy('cli_name_f', 'asc')
        //         ->get();
        // }
        $Equipments = Equipment::all();
        $statuses = EquipmentStatus::all();
        $types = EquipmentType::all();

        $equipmentJournal = EquipmentJournal::where('eqj_eq_id', $Equipments[0]->eq_id)->get();

        $target = CompanyDivision::where('div_name_full', '!ОИТ (учет техники)')->first();
        if (!$target) {
            // Обработка ошибки – узел не найден
            abort(404, 'Целевой узел не найден');
        }
        $targetId = $target->div_id;

        $subtreeIds = DB::select("
            WITH RECURSIVE subtree AS (
                SELECT div_id FROM t_company_division WHERE div_id = ?
                UNION ALL
                SELECT c.div_id FROM t_company_division c
                INNER JOIN subtree s ON c.div_parent_id = s.div_id
            )
            SELECT div_id FROM subtree
        ", [$targetId]);

        $subtreeIds = array_column($subtreeIds, 'div_id');

        $CompanyDivisions = CompanyDivision::whereNull('div_parent_id')
            ->withSyncRule($subtreeIds)
            ->with([
                'children' => function ($query) use ($subtreeIds) {
                    $query->withSyncRule($subtreeIds)
                        ->orderBy('div_name_full')->orderBy('div_id');
                },
                'children.children' => function ($query) use ($subtreeIds) {
                    $query->withSyncRule($subtreeIds)
                        ->orderBy('div_name_full')->orderBy('div_id');
                }
            ])
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();


            
        //->select('*')->distinct()
        return view('handbookPages.equipmentPage', ['Equipments' => $Equipments, 'CompanyDivisions' => $CompanyDivisions, 'user' => $user, 'statuses' => $statuses, 'types' => $types, 'userIp' => $userIp, 'computerName' => $computerName, 'equipmentJournal' => $equipmentJournal ]);

    }
    
    

    public function documentsPage(Request $request)
    {
        $depName = 'Бухгалтерия';
        $divisionType =  'main'; // 'main' или 'sub'
        $user = Auth::user();
        $userIp = $request->ip(); 
        $computerName = gethostbyaddr($userIp);

        if ($computerName === $userIp) {
            $computerName = null;
        }
        else {
            $computerName = substr($computerName, 0, 6);
        }


        Log::info('Пользователь открыл подраздел', [$depName]);

        // if ($divisionType === 'main') {
        //     // Если это отдел (главный), получаем всех сотрудников из отдела и всех его подразделов
        //     $equipment = $this->getAllClientsInDivisionTree($eqId);
        // } else {
        //     // Если это подраздел (бюро), получаем только сотрудников этого подраздела
        //     $equipment = Equipment::where('cli_div_id', $eqId)
        //         ->where('cli_sync_1c', 1)
        //        ->where('cli_disable', 0)
        //         ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
        //         ->orderBy('cli_name_f', 'asc')
        //         ->get();
        // }
        $Documents = EquipmentDocument::all();
       

        $target = CompanyDivision::where('div_name_full', '!ОИТ (учет техники)')->first();
        if (!$target) {
            // Обработка ошибки – узел не найден
            abort(404, 'Целевой узел не найден');
        }

        $targetId = $target->div_id;

        $subtreeIds = DB::select("
            WITH RECURSIVE subtree AS (
                SELECT div_id FROM t_company_division WHERE div_id = ?
                UNION ALL
                SELECT c.div_id FROM t_company_division c
                INNER JOIN subtree s ON c.div_parent_id = s.div_id
            )
            SELECT div_id FROM subtree
        ", [$targetId]);

        $subtreeIds = array_column($subtreeIds, 'div_id');

        $CompanyDivisions = CompanyDivision::whereNull('div_parent_id')
            ->withSyncRule($subtreeIds)
            ->with([
                'children' => function ($query) use ($subtreeIds) {
                    $query->withSyncRule($subtreeIds)
                        ->orderBy('div_name_full')->orderBy('div_id');
                },
                'children.children' => function ($query) use ($subtreeIds) {
                    $query->withSyncRule($subtreeIds)
                        ->orderBy('div_name_full')->orderBy('div_id');
                }
            ])
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();


            
        //->select('*')->distinct()
        return view('handbookPages.documentsPage', ['Documents' => $Documents, 'CompanyDivisions' => $CompanyDivisions, 'userIp' => $userIp, 'computerName' => $computerName, 'user' => $user]);

    }
    


    // $CompanyDivisions = CompanyDivision::whereNull('div_parent_id')
    //         ->where('div_sync_1c', 1)->where('div_disable', 0)
    //         ->orWhere(function ($query) {
    //             $query->where('div_name_full', '!ОИТ (учет техники)')  // или другое поле для идентификации ОИТ
    //                 ->where('div_sync_1c', 0)
    //                 ->where('div_disable', 0);
    //         })
    //         ->with([
    //             'children' => function ($query) {
    //                 $query->where('div_sync_1c', 1)->where('div_disable', 0)
    //                 ->orWhere(function ($query) {
    //                     $query->where('div_name_full', '!ОИТ (учет техники)')  // или другое поле для идентификации ОИТ
    //                         ->where('div_sync_1c', 0)
    //                         ->where('div_disable', 0);
    //                 })
    //                 ->orderBy('div_name_full')->orderBy('div_id');
    //             },
    //             'children.children' => function ($query) {
    //                 $query->where('div_sync_1c', 1)->where('div_disable', 0)
    //                 ->orWhere(function ($query) {
    //                     $query->where('div_name_full', '!ОИТ (учет техники)')  // или другое поле для идентификации ОИТ
    //                         ->where('div_sync_1c', 0)
    //                         ->where('div_disable', 0);
    //                 })
    //                 ->orderBy('div_name_full')->orderBy('div_id');
    //             }
    //         ])
    //         ->orderBy('div_name_full')->orderBy('div_id')
    //         ->get();




    public function test(Request $request)
    {
        $depId = 4198;
        $depName = 'Бухгалтерия';
        $divisionType =  'main'; // 'main' или 'sub'
        $user = Auth::user();

        if (!$user || $user && ($user->u_role !== 'admin')) {
            return redirect()->route('index');
        }

        
        $userIp = $request->ip(); 
        $computerName = gethostbyaddr($userIp);


        if ($computerName === $userIp) {
            $computerName = null;
        }
        else {
            $computerName = substr($computerName, 0, 6);
        }
        

        Log::info('Пользователь открыл подраздел', [$depName]);

        if ($divisionType === 'main') {
            // Если это отдел (главный), получаем всех сотрудников из отдела и всех его подразделов
            $clients = $this->getAllClientsInDivisionTree($depId);
        } else {
            // Если это подраздел (бюро), получаем только сотрудников этого подраздела
            $clients = Client::where('cli_div_id', $depId)
                ->where('cli_sync_1c', 1)
                ->where('cli_disable', 0)
                ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
                ->orderBy('cli_name_f', 'asc')
                ->get();
        }

        $CompanyDivisions = CompanyDivision::whereNull('div_parent_id')
            ->where('div_sync_1c', 1)->where('div_disable', 0)
            ->with([
                'children' => function ($query) {
                    $query->where('div_sync_1c', 1)->where('div_disable', 0)->orderBy('div_name_full')->orderBy('div_id');
                },
                'children.children' => function ($query) {
                    $query->where('div_sync_1c', 1)->where('div_disable', 0)->orderBy('div_name_full')->orderBy('div_id');
                }
            ])
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();

            
            
            //->select('*')->distinct()
        return view('handbookPages.test', ['clients' => $clients, 'CompanyDivisions' => $CompanyDivisions, 'user' => $user, 'userIp' => $userIp, 'computerName' => $computerName  ]);
    }

    public function getClientInfo(Request $request) {
        // if ($user->role === 'admin' && $user->role === 'director'){
        //     $role = $user->role;
        // }
        // $tableType = "userTable";
        $pageIsMain = $request->header('referer') === 'http://handbook/' ? true : false;
        $tableType = $pageIsMain === true ? "userTable" : "AdminTable";

        $clientId = (int)$request->client_id;
        $user = Auth::user();

        $client = Client::where('cli_id', $clientId)->first();
        
        if ($tableType === "AdminTable" && $client->cli_disable === true) {
            $tableType = $tableType ?? "userTable";
        }
        else {
            $client = Client::where('cli_id', $clientId)
            ->where('cli_sync_1c', 1)
            ->where('cli_disable', 0)
            ->first();
        }

        

        return view('components/data_user_note/data_user_note', ['cli' => $client, 'user' => $user, 'tableType' => $tableType])->render();
    }


    

    public function getProfessions(Request $request) {
        $depId = $request->department_id;
        $depName = $request->department_name;
        $divisionType = $request->division_type; // 'main' или 'sub'
        // $tableType = $request->table_type ?? "userTable"; //
        // $pageIsMain = $request->page_is_main ?? false;
        $pageIsMain = $request->header('referer') === 'http://handbook/' ? true : false;
        $tableType = $pageIsMain === true ? "userTable" : "AdminTable";
        // Log::info('tableType', [$tableType]);
        
        // if ($request->route()->getName() === 'adminPage'){
        //     $tableType = "AdminTable";
        // }

        Log::info('Пользователь открыл подраздел', [$depName]);
        

        if ($divisionType === 'main') {
            // Если это отдел (главный), получаем всех сотрудников из отдела и всех его подразделов
            $clients = $this->getAllClientsInDivisionTree($depId, $tableType);
        } else {
            // Если это подраздел (бюро), получаем только сотрудников этого подраздела
            //$tableType === "AdminTable"
            if ($tableType === "AdminTable") {
                $clients = Client::where('cli_div_id', $depId)
                    ->orderBy('cli_disable', 'asc')
                    ->orderBy('cli_name_f', 'asc')
                    ->get();
            }
            else {
                $clients = Client::where('cli_div_id', $depId)
                    ->where('cli_sync_1c', 1)
                    ->where('cli_disable', 0)
                    ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
                    ->orderBy('cli_name_f', 'asc')
                    ->get();
            }
        }

        return view('components/data_panel/data_table', ['clients' => $clients, 'tableType' => $tableType, 'pageIsMain' => $pageIsMain])->render();
    }

        /**
         * Рекурсивно получает всех сотрудников из отдела и всех его подразделов
         */
        private function getAllClientsInDivisionTree($divisionId, $tableType = "userTable") {
            // Получаем ID всех подразделов (включая сам отдел)
            $divisionIds = $this->getDivisionTreeIds($divisionId);
            
            if ($tableType === "AdminTable") {
                return Client::whereIn('cli_div_id', $divisionIds)
                    ->orderBy('cli_disable', 'asc')
                    ->orderBy('cli_name_f', 'asc')
                    ->get();
            }
            else {
                // Получаем всех сотрудников с этими ID подразделов
                return Client::whereIn('cli_div_id', $divisionIds)
                    ->where('cli_sync_1c', 1)
                    ->where('cli_disable', 0)
                    ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
                    ->orderBy('cli_name_f', 'asc')
                    ->get();
            }
            
        }

/**
 * Рекурсивно собирает все ID подразделов для указанного отдела
        */
        private function getDivisionTreeIds($divisionId) {
            $divisionIds = [$divisionId];
            
            // Получаем все дочерние подразделы
            $children = CompanyDivision::where('div_parent_id', $divisionId)->get();
            
            foreach ($children as $child) {
                // Рекурсивно добавляем ID дочерних подразделов
                $divisionIds = array_merge($divisionIds, $this->getDivisionTreeIds($child->div_id));
            }
            
            return $divisionIds;
        }
            
         

     

    //Для поисковика
    public function search(Request $request)
    {
        $query = $request->get('query', '');
        $divisionId = $request->get('division_id', null);
        $searchMode = $request->get('search_mode', false);

        $tableType = "userTable";
        // $pageIsMain = boolval($request->get('page_is_main', false));
        $pageIsMain = $request->header('referer') === 'http://handbook/' ? true : false;
        
        
        // Если поиск пустой и нет фильтра по отделу - возвращаем всех
        if (empty($query) && empty($divisionId)) {
            $clients = Client::with('division')
                ->where('cli_disable', 0)
                ->where('cli_sync_1c', 1)
                ->orderBy('cli_name_view')
                ->get();
            
            return response()->json([
                'success' => true,
                'html' => $this->renderTableRows($clients, $tableType, $pageIsMain),
                'count' => $clients->count()
            ]);
        }

        $searchQuery = null;

        if (!$pageIsMain) {
            $tableType = "AdminTable";
            $searchQuery = Client::with('division');
        }
        else {
            $searchQuery = Client::with('division')
            ->where('cli_disable', false);
        }
        

        Log::info('searchEqId', [$divisionId]);
        Log::info('searchMode', [$searchMode]);
        Log::info('query', [$query]);
        Log::info('page is main', [$pageIsMain]);



        // Фильтр по отделу
        if (!empty($divisionId) && $searchMode === "false") {
            $searchQuery->where('cli_div_id', $divisionId);
        }

        //with(['division' => fn($q) => $q->where('div_name_full', 'Дирекция')])

        // Поиск по текстовому запросу
        if (!empty($query)) {
            $searchQuery->where(function ($q) use ($query) {
                $q->where('cli_name_view', 'LIKE', "%{$query}%")
                  ->orWhere('cli_prof', 'LIKE', "%{$query}%")
                  ->orWhere('cli_email', 'LIKE', "%{$query}%")
                  ->orWhere('cli_tel_work2', 'LIKE', "%{$query}%")
                  ->orWhere('cli_tel_work', 'LIKE', "%{$query}%")
                  ->orWhere('cli_tel_mobile', 'LIKE', "%{$query}%")
                  ->orWhereHas('division', function ($subQuery) use ($query) {
                      $subQuery->where('div_name_full', 'LIKE', "%{$query}%");
                  })->with('division');
            });
        }

        $clients = $searchQuery->orderBy('cli_name_view')->get();

        // $clientsDivisions = [];
        // foreach ($clients as $client) {
        //     $clientsDivisions += $client->cli_div_id;
        // }

        // Если ничего не найдено
        if ($clients->isEmpty()) {
            return response()->json([
                'success' => true,
                'html' => '<tr>
                    <td colspan="6" style="text-align:center;padding:20px;">
                        <div class="block fl-align fl-col" style="">
                            <img src="/sources/media/icons/empty_request.png" class="" style="width:205px; height:260px; object-fit: contain;">
                            <p style="font-family: Averta Bold; font-size: 26px; color: var(--header-text-c-1); text-align: center;">Ничего не найдено</p>
                        </div>
                    </td>
                </tr>',
                'count' => 0
            ]);
        }

        return response()->json([
            'success' => true,
            'html' => $this->renderTableRows($clients, $tableType, $pageIsMain),
            'count' => $clients->count()
        ]);
    }

    //для поисковика техники
    public function searchEquipment(Request $request)
    {
        $query = $request->get('query', '');
        $equipmentId = $request->get('eq_div_id', null);
        $searchMode = $request->get('search_mode', false);
        
        // Если поиск пустой и нет фильтра по отделу - возвращаем всех
        if (empty($query) && empty($equipmentId)) {
            $Equipments = Equipment::with(['equipmentStatus', 'equipmentType'])->get();
            
            return response()->json([
                'success' => true,
                'html' => $this->renderEquipmentTableRows($Equipments),
                'count' => $Equipments->count()
            ]);
        }

        $searchEquipment = Equipment::query();

        Log::info('searchEqId', [$equipmentId]);
        Log::info('searchMode', [$searchMode]);
        Log::info('query', [$query]);


        // Фильтр по отделу
        if (!empty($equipmentId) && $searchMode === "false") {
            $searchEquipment->where('eq_div_id', $equipmentId);
        }

        //with(['division' => fn($q) => $q->where('div_name_full', 'Дирекция')])

        // Поиск по текстовому запросу
        if (!empty($query)) {
            // $searchEquipment->with(['equipmentStatus', 'equipmentType'])
            // ->where(function ($q) use ($query) {
            //     $q->where('eq_name', 'LIKE', "%{$query}%")
            //     ->orWhere('eq_serial_number', 'LIKE', "%{$query}%")
            //     ->orWhere('eq_inventory_number', 'LIKE', "%{$query}%")
            //     ->orWhere('eq_cart_number', 'LIKE', "%{$query}%")
            //     ->orWhere('eq_div_id', 'LIKE', "%{$query}%")
            //     ->orWhere('eq_client_id', 'LIKE', "%{$query}%") 
            //     ->orWhereHas('equipmentStatus', function ($subQuery) use ($query) {
            //         $subQuery->where('eqs_name', 'LIKE', "%{$query}%");
            //     })
            //     ->orWhereHas('equipmentType', function ($subQuery) use ($query) {
            //         $subQuery->where('eqt_name', 'LIKE', "%{$query}%");
            //     })->get(); // Метод with() отсюда убран
            // });

            $searchEquipment->with(['client', 'equipmentStatus', 'equipmentType'])
            ->where(function ($q) use ($query) {
                $q->where('eq_name', 'LIKE', "%{$query}%")
                ->orWhere('eq_serial_number', 'LIKE', "%{$query}%")
                ->orWhere('eq_inventory_number', 'LIKE', "%{$query}%")
                ->orWhere('eq_cart_number', 'LIKE', "%{$query}%")
                ->orWhere('eq_div_id', 'LIKE', "%{$query}%")
                ->orWhere('eq_client_id', 'LIKE', "%{$query}%") 
                ->orWhereHas('client', function ($subQuery) use ($query) {
                    $subQuery->where('cli_name_view', 'LIKE', "%{$query}%")->orWhere('cli_email', 'LIKE', "%{$query}%");
                })
                ->orWhereHas('equipmentStatus', function ($subQuery) use ($query) {
                    $subQuery->where('eqs_name', 'LIKE', "%{$query}%");
                })
                ->orWhereHas('equipmentType', function ($subQuery) use ($query) {
                    $subQuery->where('eqt_name', 'LIKE', "%{$query}%");
                })->get(); // Метод with() отсюда убран
            });
        }



        $Equipments = $searchEquipment->orderBy('eq_name')->get();

        // $clientsDivisions = [];
        // foreach ($clients as $client) {
        //     $clientsDivisions += $client->cli_div_id;
        // }

        // Если ничего не найдено
        if ($Equipments->isEmpty()) {
            return response()->json([
                'success' => true,
                'html' => '<tr>
                    <td colspan="6" style="text-align:center;padding:20px;">
                        <div class="block fl-align fl-col" style="">
                            <img src="/sources/media/icons/empty_request.png" class="" style="width:205px; height:260px; object-fit: contain;">
                            <p style="font-family: Averta Bold; font-size: 26px; color: var(--header-text-c-1); text-align: center;">Ничего не найдено</p>
                        </div>
                    </td>
                </tr>',
                'count' => 0
            ]);
        }

        return response()->json([
            'success' => true,
            'html' => $this->renderEquipmentTableRows($Equipments),
            'count' => $Equipments->count()
        ]);
    }


    //Для поисковика
    public function searchFormItems(Request $request)
    {
        $query = $request->get('query', '');
        $searchItemType = $request->get('search_item_type', null);
        $searchMode = $request->get('search_mode', false);

        $tableType = "userTable";
        // $pageIsMain = boolval($request->get('page_is_main', false));
        $pageIsMain = $request->header('referer') === 'http://handbook/' ? true : false;
        
        if ($searchItemType === 'clients') {

            // Если поиск пустой и нет фильтра по отделу - возвращаем всех
            if (empty($query)) {
                $clients = Client::with('division')
                    ->where('cli_disable', 0)
                    ->where('cli_sync_1c', 1)
                    ->orderBy('cli_name_view')
                    ->get();
                
                return response()->json([
                    'success' => true,
                    'html' => $this->renderFormTableRows($clients, $tableType, $searchItemType, $pageIsMain),
                    'count' => $clients->count()
                ]);
            }

            $searchQuery = Client::where('cli_disable', false);

            Log::info('searchMode', [$searchMode]);
            Log::info('query', [$query]);
            Log::info('page is main', [$pageIsMain]);


            // Поиск по текстовому запросу
            if (!empty($query)) {
                $searchQuery->where(function ($q) use ($query) {
                    $q->where('cli_name_view', 'LIKE', "%{$query}%")
                    ->orWhere('cli_prof', 'LIKE', "%{$query}%")
                    ->orWhere('cli_email', 'LIKE', "%{$query}%")
                    ->orWhere('cli_tel_work2', 'LIKE', "%{$query}%")
                    ->orWhere('cli_tel_work', 'LIKE', "%{$query}%")
                    ->orWhere('cli_tel_mobile', 'LIKE', "%{$query}%")
                    ->orWhereHas('division', function ($subQuery) use ($query) {
                        $subQuery->where('div_name_full', 'LIKE', "%{$query}%");
                    })->with('division');
                });
            }

            $clients = $searchQuery->orderBy('cli_name_view')->get();

            // $clientsDivisions = [];
            // foreach ($clients as $client) {
            //     $clientsDivisions += $client->cli_div_id;
            // }

            // Если ничего не найдено
            if ($clients->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'html' => '<tr>
                        <td colspan="6" style="text-align:center;padding:20px;">
                            <div class="block fl-align fl-col" style="">
                                <img src="/sources/media/icons/empty_request.png" class="" style="width:205px; height:260px; object-fit: contain;">
                                <p style="font-family: Averta Bold; font-size: 26px; color: var(--header-text-c-1); text-align: center;">Ничего не найдено</p>
                            </div>
                        </td>
                    </tr>',
                    'count' => 0
                ]);
            }

            return response()->json([
                'success' => true,
                'html' => $this->renderFormTableRows($clients, $tableType, $searchItemType, $pageIsMain),
                'count' => $clients->count()
            ]);

        }


    }


    

    /**
     * Рендеринг строк таблицы
     */
    private function renderTableRows($clients, $tableType, $pageIsMain)
    {
        return $html = view('components/data_panel/data_table', ['clients' => $clients, 'tableType' => $tableType, 'pageIsMain' => $pageIsMain])->render();
    }

     private function renderEquipmentTableRows($equipments)
    {
        return $html = view('components/data_panel/data_equipment', ['equipments' => $equipments])->render();
    }

    private function renderDocumentTableRows($Documents)
    {
        return $html = view('components/data_panel/data_documents', ['Documents' => $Documents])->render();
    }

    private function renderFormTableRows($items, $tableType, $searchItemType, $pageIsMain)
    {
        if ($searchItemType === 'clients') {
            return $html = view('components/popup/form_table/clients_form_table', ['items' => $items, 'tableType' => $tableType, 'searchItemType' => $searchItemType, 'pageIsMain' => $pageIsMain])->render();
        }
    }


    
    
    
    
    
    //для работы отделов и подразделов в учете техники

    public function getEquipmentsTableInfo(Request $request) {
        $eq_id = $request->department_id;
        $depName = $request->department_name;
        $divisionType = $request->division_type; // 'main' или 'sub'

        // Log::info('Пользователь открыл подраздел в учете техники', [$depName]);
        Log::info('Вывод техники в главной вкладке', [$eq_id, $depName, $divisionType]);

        // if ($divisionType === 'main') {
        //     // Если это отдел (главный), получаем всех сотрудников из отдела и всех его подразделов
        //     $Equipments = $this->getAllEquipmentsInDivisionTree($eq_id);
        //     Log::info('Вывод техники в главной вкладке', [$Equipments]);

        // } else {
        //     // Если это подраздел (бюро), получаем только сотрудников этого подраздела
            
        //     $Equipments = Equipment::where('eq_div_id', $eq_id)
        //         ->orderBy('eq_name', 'asc')
        //         ->get();
        //     Log::info('Вывод техники', [$Equipments]);
            
            

        //     $Equipments = Equipment::
        //         with(['client' => function ($query) use  ($eq_id) {
        //             $query->where('cli_div_id', $eq_id);
        //         }])
        //         ->orWhere('eq_div_id', $eq_id)
        //         ->orderBy('eq_name', 'asc')
        //         ->get();

        //     Log::info('Вывод техники', [$Equipments]);
        // }

        if ($divisionType === 'main') {
             $Equipments = $this->getAllEquipmentsInDivisionTree($eq_id);
        }
        else {
            // $Equipments = Equipment::leftJoin('t_client', 't_equipment.eq_client_id', '=', 't_client.cli_id')
            //     ->where(function ($query) use ($eq_id) {
            //         // 1) eq_div_id задан явно
            //         $query->where(function ($q) use ($eq_id) {
            //             $q->whereNotNull('t_equipment.eq_div_id')
            //             ->where('t_equipment.eq_div_id', '!=', 0)
            //             ->where('t_equipment.eq_div_id', $eq_id);
            //         });

            //         // 2) eq_div_id не задан, но есть клиент с отделом
            //         $query->orWhere(function ($q) use ($eq_id) {
            //             $q->where(function ($sub) {
            //                 $sub->whereNull('t_equipment.eq_div_id')
            //                     ->orWhere('t_equipment.eq_div_id', 0);
            //             })
            //             ->where(function ($sub) {
            //                 $sub->whereNotNull('t_equipment.eq_client_id')
            //                     ->where('t_equipment.eq_client_id', '!=', 0);
            //             })
            //             ->where('t_client.cli_div_id', $eq_id);
            //         });

            //         // 3) ни eq_div_id, ни eq_client_id не заданы → подразделение 4104
            //         $query->orWhere(function ($q) use ($eq_id) {
            //             $q->where(function ($sub) {
            //                 $sub->whereNull('t_equipment.eq_div_id')
            //                     ->orWhere('t_equipment.eq_div_id', 0);
            //             })
            //             ->where(function ($sub) {
            //                 $sub->whereNull('t_equipment.eq_client_id')
            //                     ->orWhere('t_equipment.eq_client_id', 0);
            //             })
            //             ->whereRaw('? = ?', [4104, $eq_id]); // или if ($eq_id == 4104) добавить условие
            //         });
            //     })
            //     ->select('t_equipment.*')
            //     ->get();
            $Equipments = Equipment::leftJoin('t_client', 't_equipment.eq_client_id', '=', 't_client.cli_id')
                ->where('t_equipment.eq_div_id', $eq_id)
                ->orWhere('t_equipment.eq_client_id', $eq_id)
                ->orWhere('t_client.cli_div_id', $eq_id)
                ->get();

        }
        // Log::info('Вывод техники в главной вкладке', [$Equipments]);

        return view('components/data_panel/data_equipment', ['equipments' => $Equipments])->render();
    }

        /**
         * Рекурсивно получает всех сотрудников из отдела и всех его подразделов
         */
        private function getAllEquipmentsInDivisionTree($eq_id) {
            // Получаем ID всех подразделов (включая сам отдел)
            $divisionIds = $this->getDivisionTreeIds($eq_id);

            Log::info('divisionIds', [$divisionIds]);
            
            // Получаем всех сотрудников с этими ID подразделов
            return Equipment::leftJoin('t_client', 't_equipment.eq_client_id', '=', 't_client.cli_id')
                ->whereIn('t_equipment.eq_div_id', $divisionIds)
                ->orWhereIn('t_equipment.eq_client_id', $divisionIds)
                ->orWhereIn('t_client.cli_div_id', $divisionIds)
                ->get();

            // return Equipment::where('eq_div_id', $divisionIds)
            //     ->orderBy('eq_name', 'asc')
            //     ->get();
        }




    public function getPopupUserInfo1(Request $request) {
        // if ($user->role === 'admin' && $user->role === 'director'){
        //     $role = $user->role;
        // }
        $user = Auth::user();

        $CompanyDivisions = CompanyDivision::
            where('div_sync_1c', 1)->where('div_disable', 0)
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();


        return view('components/popup/popup_divAddAdmin', ['CompanyDivisions' => $CompanyDivisions])->render();
    }



    public function getEquipmentInfo(Request $request) {
        // if ($user->role === 'admin' && $user->role === 'director'){
        //     $role = $user->role;
        // }
        $eq_id = (int)$request->eq_id;
        $user = Auth::user();

        $Equipment = Equipment::where('eq_id', $eq_id)->first();

        $equipmentJournal = EquipmentJournal::where('eqj_eq_id', $eq_id)->get();

        return view('components/data_user_note/data_equipment_note', ['eq_id' => $Equipment, 'user' => $user, 'equipmentJournal' => $equipmentJournal])->render();
    }

    public function getPopup1Сimport(Request $request){
    

        return view('components/popup/popup_import1c')->render();
    }



    public function getPopupLogin(Request $request) {

        return view('components/popup/popup_login')->render();
    
    }

     public function getPopupAddDivision(Request $request) {
        // if ($user->role === 'admin' && $user->role === 'director'){
        //     $role = $user->role;
        // }
        $user = Auth::user();

        $CompanyDivisions = CompanyDivision::
            where('div_sync_1c', 1)->where('div_disable', 0)
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();


        return view('components/popup/popup_divAddAdmin', ['CompanyDivisions' => $CompanyDivisions])->render();
    }

    


    public function getPopupaddEquipment(Request $request) {
        $EquipmentStatuses = EquipmentStatus::all();
        $EquipmentTypes = EquipmentType::all();
        $clients = Client::where('cli_sync_1c', 1)
                ->where('cli_disable', 0)
                ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
                ->orderBy('cli_name_f', 'asc')
                ->get();
         $CompanyDivisions = CompanyDivision::
            where('div_sync_1c', 1)->where('div_disable', 0)
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();
         $EquipmentDocuments = EquipmentDocument::all();

        return view('components/popup/popup_addEquiment', ['clients' => $clients, 'EquipmentTypes' => $EquipmentTypes, 'EquipmentStatuses' => $EquipmentStatuses, 'CompanyDivisions' => $CompanyDivisions, 'EquipmentDocuments' => $EquipmentDocuments])->render();

    }
    public function getPopupActionEquipment(Request $request) {
        $eq_id = (int)$request->eq_id;
        $action_name = $request->action_name;
        // $popupType = $request->popup_type;
        
        // $main_client = Client::where('cli_id', )
        
        $activeEquipment = Equipment::where('eq_id', $eq_id)->first();
        $responsibleClient = Client::where('cli_id', $activeEquipment->eq_client_id)->first();
        $activeEqJournal = EquipmentJournal::where('eqj_eq_id', $activeEquipment->eq_id)->first();

        $clients = Client::where('cli_sync_1c', 1)
                ->where('cli_disable', 0)
                ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
                ->orderBy('cli_name_f', 'asc')
                ->get();

        Log::info('Вывод действия с техникой на странице учета техники', [$action_name]);

        return view('components/popup/popup_EquipmentAction', ['clients' => $clients, 'activeEquipment' => $activeEquipment, 'responsibleClient' =>$responsibleClient, 'activeEqJournal' => $activeEqJournal, 'popupType' => $action_name])->render();
    }

    // function getPopupActionClientInfo(Request $request) {
    //     $cli_id = $request->cli_id;
    //     $eq_id = $request->eq_id;
    //     $action_name = $request->action_name;
    // }

    public function getPopupparametersEquipment(Request $request) {

        return view('components/popup/popup_parametersEquipment')->render();
    
    }

    public function getPopupMessage(Request $request) {

        $equipmentId = (int)$request->eq_div_id ?? null;
        $clientId = (int)$request->cli_id ?? null;
        $divisionId = (int)$request->div_id ?? null;
        $documentId = (int)$request->doc_sup_id ?? null;

        $Equipment = null;
        $Client = null;
        $Division = null;
        $Document = null;

        if ($equipmentId !== null && $equipmentId !== 0) {
            $Equipment = Equipment::where('eq_id', $equipmentId)->first();
            $Client = null;
        }
        else if ($clientId !== null && $clientId !== 0) {
            $Client = Client::where('cli_id', $clientId)->first();
            $Equipment = null;
        }
        else if ($divisionId !== null && $divisionId !== 0){
            $Division = CompanyDivision::where('div_id', $divisionId)->first();
        }
        else if ($documentId !== null && $documentId !== 0){
            $Document = EquipmentDocument::where('doc_sup_id', $documentId)->first();
        }

        Log::info('equipmentId, clientId, Equipment, Client', [$equipmentId, $clientId, $Equipment, $Client, $Division]);

        $messageType = $request->message_type;
        return view('components/popup/popup_message', ['eq'=> $Equipment, 'client'=> $Client, 'division' => $Division, 'document' => $Document, 'message_type'=> $messageType])->render();

    }

    

    public function DeleteEquipment(Request $request, $id){
        // $equipmentId = (int)$request->eq_div_id; 
        $Equipment = Equipment::where('eq_id', $id)->first();
        $EquipmentOldClient = $Equipment->eq_client_id;
        $EquipmentOldComment = $Equipment->eq_comment;
        
       //$Equipment -> delete();
            
        
            
        if ($request->action_name === 'disable') {
            $Equipment->update([
            'eq_status_id' => 3,
            'eq_client_id' => null,
            'eq_div_id' => 4108,
            'date_change' => now(),
        ]);
            $equipmentJournal = EquipmentJournal::create([
            'eqj_eq_id' => $Equipment->eq_id ?? null,
            'eqj_datetime' => now(),
            'eqj_status' => 'Списан',
            'eqj_cli_id' => $EquipmentOldClient ?? null,
            'eqj_comment' => $EquipmentOldComment ?? null,
        ]);
        
        }
        else {
            $Equipment -> delete();
        }
       
        Log::info('Техника c id удалена', [$id, $Equipment]);

        return response()->json(["success" => true]);

    }
    


     public function EditEquipment(Request $request){
        // eq_div_id   eq_col_name   eq_data
        $id = (int)$request->eq_div_id; 
        // $eq_col_name = $request->eq_col_name; 
        $eq_data = json_decode($request->eq_data, true); 
      
        if (empty($eq_data) || $eq_data === []) {
            Log::info('Данные не были получены');
        }
        else {
            // $Equipment = Equipment::where('eq_id', $id)->first();
            $Equipment = Equipment::findOrFail($id);
            //$Equipment -> update();

            // $Equipment->update([
            //     $eq_col_name => $eq_data,
            // ]);

            // последний вариант
            if (Auth::user() && Auth::user()->u_role === 'admin') {
                // $Equipment->update($eq_data);

                Log::info('Техника c id', [$id]);
                Log::info('Технике на замену пошли следующие поля', [$eq_data]);
            }
            
        }
        return response()->json(["success" => true]);

    }



 
    

    public function getPopupaddAdmin(Request $request) {
        $EquipmentStatuses = EquipmentStatus::all();
        $EquipmentTypes = EquipmentType::all();
        $clients = Client::where('cli_sync_1c', 1)
                ->where('cli_disable', 0)
                ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
                ->orderBy('cli_name_f', 'asc')
                ->limit(100)
                ->get();
         $CompanyDivisions = CompanyDivision::
            where('div_sync_1c', 1)->where('div_disable', 0)
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();
         $EquipmentDocuments = EquipmentDocument::all();

        return view('components/popup/popup_addAdmin', ['clients' => $clients, 'EquipmentTypes' => $EquipmentTypes, 'EquipmentStatuses' => $EquipmentStatuses, 'CompanyDivisions' => $CompanyDivisions, 'EquipmentDocuments' => $EquipmentDocuments])->render();
   
        
    
    }


     public function EditAdmin(Request $request){
        // eq_div_id   eq_col_name   eq_data
        $id = (int)$request->cli_div_id; 
        // $cli_data = $request->cli_data; 
        $cli_data = json_decode($request->cli_data, true); 

       
        if (empty($cli_data) || $cli_data === []) {
            Log::info('Данные не были получены');
        } else {
            
            $cli_data_to_add = [];

            $Client = Client::findOrFail($id);
            
            // предпоследний вариант
            // $Client->update([
            //     $cli_col_name => $cli_data,
            // ]);

            // последний вариант
            if (Auth::user() && Auth::user()->u_role === 'admin') {
                $Client->update($cli_data);

                Log::info('Пользователь c id', [$id]);
                Log::info('Пользователю на замену пошли следующие поля', [$cli_data]);
            }
        }
       
        return response()->json(["success" => true]);

    }

    public function DeleteAdmin(Request $request, $id){
        // $equipmentId = (int)$request->eq_div_id; 
        $Client = Client::where('cli_id', $id)->first();
        
        // $Client -> delete();
        
        if ($request->action_name === 'disable') {
            if ($Client->cli_disable === false) {
                $Client->update([
                    'cli_disable' => 1
                ]);
                Log::info('Сотрудник удален', [$id, $Client]);
            } else {
                $Client->update([
                    'cli_disable' => 0
                ]);
                Log::info('Сотрудник ввостановлен', [$id, $Client]);
            }
        
        }
        else {
            $Client -> delete();
        }
            

        return response()->json(["success" => true]);

    }

    //old
    // public function EditAdmin(Request $request){
    //     // eq_div_id   eq_col_name   eq_data
    //     $id = (int)$request->cli_div_id; 
    //     $cli_col_name = $request->cli_col_name; 
    //     $cli_data = $request->cli_data; 
      

    //     // $Equipment = Equipment::where('eq_id', $id)->first();
    //     $Client = Client::findOrFail($id);
    //    //$Equipment -> update();
    //     // $Equipment->update([
    //     //     $eq_col_name => $eq_data,
    //     // ]);

    //     // последний вариант
    //     // $Client->update([
    //     //     $cli_col_name => $cli_data,
    //     // ]);

    //     Log::info('Техника c id', [$id]);
       
    //     Log::info('Техника изменена', [$Client]);

    //     return response()->json(["success" => true]);

    // }


    



    



    public function newEquipmentActionStatus(Request $request) {
        $data = [];
        $actionType = $request->action_name;

        $equipment = Equipment::findOrFail($request->eq_id);
        $client = Client::findOrFail($request->eq_client_id);
        // $equipmentJournal = EquipmentJournal::where('eqj_eq_id', $request->eq_id)->where('eqj_cli_id', $request->client_id)->first();

        $equipmentStatus = EquipmentStatus::where('eqs_name', $request->eq_status_name_1)->first();


        if ($actionType === "give"){
            // $newEquipmentStatus = $equipment->replicate();

            // $equipment->eq_status_id = (int)$equipmentStatus->eqs_id;
            $equipment->eq_status_id = 2;
            $equipment->eq_div_id = (int)$request->eq_div_id;
            $equipment->eq_client_id = (int)$request->eq_client_id;
            $equipment->date_change = now();

            $equipmentJournal = EquipmentJournal::create([
                'eqj_eq_id' => $equipment->eq_id ?? null,
                'eqj_datetime' => now(),
                'eqj_status' => 'Выдан',
                'eqj_cli_id' => $client->cli_id ?? null,
                'eqj_comment' => $request->eq_comment ?? null,
            ]);

            $equipment->save();
            
            Log::info('Статус оборудования успешно обновлен!', [$equipment->eq_id, $equipment->equipmentStatus->eqs_name]);
            // return response()->json(['success' => true]);
            return redirect()->back()->with('success', 'статус Оборудования успешно обновлен!');

        } else if ($actionType === "pass_off") {
            $equipment->eq_status_id = 1;
            $equipment->eq_div_id = 4104;
            $equipment->eq_client_id = null;
            $equipment->date_change = now();

            // $equipmentJournalOldClient = EquipmentJournal::where('eqj_eq_id', $request->eq_id)->where('eqj_cli_id', $request->client_id)->first();

            $equipmentJournal = EquipmentJournal::create([
                'eqj_eq_id' => $equipment->eq_id ?? null,
                'eqj_datetime' => now(),
                'eqj_status' => 'Сдан',
                'eqj_cli_id' => $client->cli_id ?? null,
                'eqj_comment' => $request->eq_comment ?? null,
            ]);

            $equipment->save();

            // return response()->json(['success' => true]);
            Log::info('Статус оборудования успешно обновлен!', [$equipment->eq_id, $equipment->equipmentStatus->eqs_name]);
            return redirect()->back()->with('success', 'статус Оборудования успешно обновлен!');

        } else if ($actionType === "rewrite") {
            // $equipment->eq_status_id = (int)$equipmentStatus->eqs_id;
            $equipment->eq_status_id = 2;
            $equipment->eq_div_id = (int)$request->eq_div_id;
            $equipment->eq_client_id = (int)$request->eq_client_id;
            $equipment->date_change = now();


            // $equipmentJournalOldClient = EquipmentJournal::where('eqj_eq_id', $request->eq_id)->where('eqj_cli_id', (int)$request->eq_old_cli_id)->first();
            // $equipmentJournalOldClient->eqj_status = 'Сдан';
            // $equipmentJournalOldClient->eq_comment = $request->eq_comment ?? null;

            $equipmentJournalOldClient = EquipmentJournal::create([
                'eqj_eq_id' => $equipment->eq_id ?? null,
                'eqj_datetime' => now(),
                'eqj_status' => 'Сдан',
                'eqj_cli_id' => $request->eq_old_cli_id ?? null,
                'eqj_comment' => $request->eq_comment ?? null,
            ]);

            $equipmentJournal = EquipmentJournal::create([
                'eqj_eq_id' => $equipment->eq_id ?? null,
                'eqj_datetime' => now(),
                'eqj_status' => 'Выдан',
                'eqj_cli_id' => $client->cli_id ?? null,
                'eqj_comment' => $request->eq_comment ?? null,
            ]);

            // $equipmentJournalOldClient->save();
            $equipment->save();
            
            // return response()->json(['success' => true]);
            Log::info('Статус оборудования успешно обновлен!', [$equipment->eq_id, $equipment->equipmentStatus->eqs_name]);
            return redirect()->back()->with('success', 'статус Оборудования успешно обновлен!');

        } else if ($actionType === "write_off") {
            $equipment->eq_status_id = 3;
            $equipment->eq_div_id = 4108;
            $equipment->eq_client_id = null;
            $equipment->date_change = now();


            // if ($request->eq_status_name_1 === 'Выдан') {
                // $equipmentJournalOldClient = EquipmentJournal::where('eqj_eq_id', $request->eq_id)->where('eqj_cli_id', (int)$request->eq_old_cli_id)->first();
                // $equipmentJournalOldClient->eqj_status = 'Сдан';
                // $equipmentJournalOldClient->eqj_cli_id = $request->eq_comment ?? null;

                // $equipmentJournalOldClient->save();
            // }
            
            
            $equipmentJournal = EquipmentJournal::create([
                'eqj_eq_id' => $equipment->eq_id ?? null,
                'eqj_datetime' => now(),
                'eqj_status' => 'Списан',
                'eqj_cli_id' => $request->eq_old_cli_id ?? null,
                'eqj_comment' => $request->eq_comment ?? null,
            ]);
            
            $equipment->save();
            
            // return response()->json(['success' => true]);
            Log::info('Статус оборудования успешно обновлен!', [$equipment->eq_id, $equipment->equipmentStatus->eqs_name]);
            return redirect()->back()->with('success', 'статус Оборудования успешно обновлен!');
        }

    }


    public function newEquipmentActionStatusDynamicPost(Request $request) {

        // $validator = Validator::make($request->all(), [
        //     'action_name' => 'required|string|max:255',
        //     'eq_old_cli_id' => 'nullable|integer|exists:t_client,cli_id',
        //     'eq_id' => 'required|integer|exists:t_equipment_status,eq_id',
        //     'eq_status_id' => 'nullable|integer|exists:t_equipment_status,eqs_id',
        //     'eq_status_name_1' => 'required|string|max:255|exists:t_equipment_type,eqs_name',
        //     'eq_client_id' => 'nullable|integer|exists:t_client,cli_id',
        //     'eq_cli_name' => 'nullable|string|max:255',
        //     'eq_name' => 'required|string|max:255',
        //     'eq_date' => 'required|date',
        //     'eq_div_id' => 'required|integer|exists:t_company_division,div_id',
        //     'eq_div_name' => 'required|string|max:255',
        //     'eq_comment' => 'nullable|string|max:255',
        // ], [
        //     'action_name.required' => 'Неправильный тип действия.',
        //     'eq_name.required' => 'Введите наименование техники.',
        //     'eq_id.required' => 'Не введен индекс редактируемой техники',
        //     'eq_date.required' => 'Введите дату.',
        //     'eq_date.date' => 'Неправильный тип даты',
        //     'eq_div_name.required' => 'Введите наименование подразделения.',
        // ]);

        // gdfg = "
        //     'action_name' : document.querySelector('.form-input[id="action_name"]').value,
        //     'eq_old_cli_id' : document.querySelector('.form-input[id="eq_old_cli_id"]').value,
        //     'eq_id' : parseInt(document.querySelector('.form-input[id="eq_id"]').value) || "",
        //     'eq_name' : document.querySelector('input[id="eq_name"]').value,
        //     'eq_status_name_1' : document.querySelector('.form-input[id="eq_status_name_1"]').value,
        //     'eq_client_id' : parseInt(document.querySelector('.form-input[id="eq_client_id"]').value) || "",
        //     'eq_cli_name' : document.querySelector('.form-input[id="eq_cli_name"]').value,
        //     'eq_date' : document.querySelector('.form-input[id="eq_date"]').value,
        //     'eq_div_id' : parseInt(document.querySelector('.form-input[id="eq_div_id"]').value) || "",
        //     'eq_div_name' : document.querySelector('.form-input[id="eq_div_name"]').value,
        //     'eq_comment' : document.querySelector('.form-input[id="eq_comment"]').value,
        // ";

        $validator = null;

        if ($request->action_name === "give" || $request->action_name === "pass_off" || $request->action_name === "rewrite") {
            $validator = Validator::make($request->all(), [
                'action_name' => 'required|string|max:255',
                'eq_old_cli_id' => 'nullable|integer|exists:t_client,cli_id',
                'eq_id' => 'required|integer|exists:t_equipment,eq_id',
                'eq_status_id' => 'nullable|integer|exists:t_equipment_status,eqs_id',
                'eq_status_name_1' => 'required|string|max:255|exists:t_equipment_status,eqs_name',
                'eq_client_id' => 'required|integer|exists:t_client,cli_id',
                'eq_cli_name' => 'required|string|max:255',
                'eq_name' => 'required|string|max:255',
                'eq_date' => 'required|date',
                'eq_div_id' => 'required|integer|exists:t_company_division,div_id',
                'eq_div_name' => 'required|string|max:255',
                'eq_comment' => 'nullable|string|max:255',
            ], [
                'action_name.required' => 'Неправильный тип действия.',
                'eq_name.required' => 'Введите наименование техники.',
                'eq_id.required' => 'Не введен индекс редактируемой техники',
                'eq_cli_name.required' => 'Введите ФИО ответственного',
                'eq_date.required' => 'Введите дату.',
                'eq_date.date' => 'Неправильный тип даты',
                'eq_div_name.required' => 'Введите наименование подразделения.',
            ]);
        }
        else if ($request->action_name === "write_off") {
            $validator = Validator::make($request->all(), [
                'action_name' => 'required|string|max:255',
                'eq_old_cli_id' => 'nullable|integer|exists:t_client,cli_id',
                'eq_id' => 'required|integer|exists:t_equipment,eq_id',
                'eq_status_id' => 'nullable|integer|exists:t_equipment_status,eqs_id',
                'eq_status_name_1' => 'required|string|max:255|exists:t_equipment_status,eqs_name',
                'eq_client_id' => 'nullable|integer|exists:t_client,cli_id',
                'eq_cli_name' => 'nullable|string|max:255',
                'eq_name' => 'required|string|max:255',
                'eq_date' => 'required|date',
                'eq_div_id' => 'nullable|integer|exists:t_company_division,div_id',
                'eq_div_name' => 'nullable|string|max:255',
                'eq_comment' => 'nullable|string|max:255',
            ], [
                'action_name.required' => 'Неправильный тип действия.',
                'eq_name.required' => 'Введите наименование техники.',
                'eq_id.required' => 'Не введен индекс редактируемой техники',
                'eq_date.required' => 'Введите дату.',
                'eq_date.date' => 'Неправильный тип даты',
            ]);
        }

        

        try {
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(), // { field: [messages] }
                ]);
            }

            $data = [];
            $actionType = $request->action_name;

            $equipment = Equipment::findOrFail($request->eq_id);
            $client = Client::findOrFail($request->eq_client_id);
            // $equipmentJournal = EquipmentJournal::where('eqj_eq_id', $request->eq_id)->where('eqj_cli_id', $request->client_id)->first();

            $equipmentStatus = EquipmentStatus::where('eqs_name', $request->eq_status_name_1)->first();


            if ($actionType === "give"){
                // $newEquipmentStatus = $equipment->replicate();

                // $equipment->eq_status_id = (int)$equipmentStatus->eqs_id;
                $equipment->eq_status_id = 2;
                $equipment->eq_div_id = (int)$request->eq_div_id;
                $equipment->eq_client_id = (int)$request->eq_client_id;
                $equipment->date_change = now();

                $equipmentJournal = EquipmentJournal::create([
                    'eqj_eq_id' => $equipment->eq_id ?? null,
                    'eqj_datetime' => now(),
                    'eqj_status' => 'Выдан',
                    'eqj_cli_id' => $client->cli_id ?? null,
                    'eqj_comment' => $request->eq_comment ?? null,
                ]);

                $equipment->save();
                
                Log::info('Статус оборудования успешно обновлен!', [$equipment->eq_id, $equipment->equipmentStatus->eqs_name]);
                // return response()->json(['success' => true]);

            } else if ($actionType === "pass_off") {
                $equipment->eq_status_id = 1;
                $equipment->eq_div_id = 4104;
                $equipment->eq_client_id = null;
                $equipment->date_change = now();

                // $equipmentJournalOldClient = EquipmentJournal::where('eqj_eq_id', $request->eq_id)->where('eqj_cli_id', $request->client_id)->first();

                $equipmentJournal = EquipmentJournal::create([
                    'eqj_eq_id' => $equipment->eq_id ?? null,
                    'eqj_datetime' => now(),
                    'eqj_status' => 'Сдан',
                    'eqj_cli_id' => $client->cli_id ?? null,
                    'eqj_comment' => $request->eq_comment ?? null,
                ]);

                $equipment->save();

                // return response()->json(['success' => true]);
                Log::info('Статус оборудования успешно обновлен!', [$equipment->eq_id, $equipment->equipmentStatus->eqs_name]);

            } else if ($actionType === "rewrite") {
                // $equipment->eq_status_id = (int)$equipmentStatus->eqs_id;
                $equipment->eq_status_id = 2;
                $equipment->eq_div_id = (int)$request->eq_div_id;
                $equipment->eq_client_id = (int)$request->eq_client_id;
                $equipment->date_change = now();


                // $equipmentJournalOldClient = EquipmentJournal::where('eqj_eq_id', $request->eq_id)->where('eqj_cli_id', (int)$request->eq_old_cli_id)->first();
                // $equipmentJournalOldClient->eqj_status = 'Сдан';
                // $equipmentJournalOldClient->eq_comment = $request->eq_comment ?? null;

                $equipmentJournalOldClient = EquipmentJournal::create([
                    'eqj_eq_id' => $equipment->eq_id ?? null,
                    'eqj_datetime' => now(),
                    'eqj_status' => 'Сдан',
                    'eqj_cli_id' => $request->eq_old_cli_id ?? null,
                    'eqj_comment' => $request->eq_comment ?? null,
                ]);

                $equipmentJournal = EquipmentJournal::create([
                    'eqj_eq_id' => $equipment->eq_id ?? null,
                    'eqj_datetime' => now(),
                    'eqj_status' => 'Выдан',
                    'eqj_cli_id' => $client->cli_id ?? null,
                    'eqj_comment' => $request->eq_comment ?? null,
                ]);

                // $equipmentJournalOldClient->save();
                $equipment->save();
                
                // return response()->json(['success' => true]);
                Log::info('Статус оборудования успешно обновлен!', [$equipment->eq_id, $equipment->equipmentStatus->eqs_name]);

            } else if ($actionType === "write_off") {
                $equipment->eq_status_id = 3;
                $equipment->eq_div_id = 4108;
                $equipment->eq_client_id = null;
                $equipment->date_change = now();


                // if ($request->eq_status_name_1 === 'Выдан') {
                    // $equipmentJournalOldClient = EquipmentJournal::where('eqj_eq_id', $request->eq_id)->where('eqj_cli_id', (int)$request->eq_old_cli_id)->first();
                    // $equipmentJournalOldClient->eqj_status = 'Сдан';
                    // $equipmentJournalOldClient->eqj_cli_id = $request->eq_comment ?? null;

                    // $equipmentJournalOldClient->save();
                // }
                
                
                $equipmentJournal = EquipmentJournal::create([
                    'eqj_eq_id' => $equipment->eq_id ?? null,
                    'eqj_datetime' => now(),
                    'eqj_status' => 'Списан',
                    'eqj_cli_id' => $request->eq_old_cli_id ?? null,
                    'eqj_comment' => $request->eq_comment ?? null,
                ]);
                
                $equipment->save();
                
                // return response()->json(['success' => true]);
                Log::info('Статус оборудования успешно обновлен!', [$equipment->eq_id, $equipment->equipmentStatus->eqs_name]);
            }


            // Логируем успешное создание
            Log::info('статус Оборудования успешно обновлен!', ['eq_id' => $equipment->eq_id, 'user' => Auth::id()]);

            // Возвращаем успешный ответ
            return response()->json([
                'success'  => true,
                'message'  => 'статус Оборудования успешно обновлен!',
            ]);

        }
        catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при создании оборудования', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при добавлении оборудования: ' . $e->getMessage()]);
        }

    }
    


    // public function getProfessions(Request $request) {
    //     $depId = $request->department_id;
    //     $depName = $request->department_name;

    //     Log::info('Пользователь открыл подраздел', [$depName]);

    //     $clients = Client::where('cli_div_id', $depId)
    //     ->where('cli_sync_1c', 1)->where('cli_disable', 0)
    //     ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
    //     ->orderBy('cli_name_f', 'asc')
    //     ->get();

    //     // $clients = Client::whereHas('division', function($query) use ($depId) {
    //     //     $query->where('div_id', $depId);
    //     // })
    //     // ->where('cli_sync_1c', 1)->where('cli_disable', 1)
    //     // ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
    //     // ->orderBy('cli_name_f', 'asc')
    //     // ->with(['division' => fn($q) => $q->where('div_id', $depId)])
    //     // ->get();
        
    //     // $clients = Client::where('cli_prof', 'Начальник бюро')->
    //     // where('cli_sync_1c', 1)->where('cli_disable', 0)
    //     // ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
    //     // ->orderBy('cli_name_f', 'asc')->get();

    //     return view('components/data_panel/data_table', ['clients' => $clients])->
    //     render();


    // }

        
    
    /**
     * Получение контента для всплывающего окна в зависимости от типа
     */
    // public function getPopupContent(Request $request)
    // {
    //     $popupType = $request->popup_type;
        
    //     Log::info('Открыто всплывающее окно', ['type' => $popupType]);
        
    //     // В зависимости от типа возвращаем разные представления
    //     switch ($popupType) {
    //         case 'my_data':
    //             return $this->getMyDataPopup();
                
    //         case 'support':
    //             return $this->getSupportPopup();
                
    //         case 'interface':
    //             return $this->getInterfacePopup();
                
    //         case 'write_email':
    //             return $this->getWriteEmailPopup();
                
    //         case 'workshop':
    //             return $this->getWorkshopPopup();
                
    //         default:
    //             return response()->json(['error' => 'Неизвестный тип окна'], 400);
    //     }
    // }
    
    // /**
    //  * Контент для "Мои данные"
    //  */
    // private function getMyDataPopup()
    // {
    //     // Здесь можно получить данные пользователя из сессии/базы
    //     $userData = [
    //         'name' => 'Иванов Иван Иванович',
    //         'email' => 'ivanov@company.ru',
    //         'phone' => '+7 (495) 123-45-67',
    //         'department' => 'Отдел разработки',
    //         'position' => 'Ведущий разработчик'
    //     ];
        
    //     return view('components/popups/my_data_popup', ['userData' => $userData])->render();
    // }
    
    // /**
    //  * Контент для "Тех. поддержка"
    //  */
    // private function getSupportPopup()
    // {
    //     // Данные для техподдержки
    //     $supportData = [
    //         'email' => 'support@company.ru',
    //         'phone' => '+7 (495) 777-77-77',
    //         'working_hours' => '09:00 - 18:00'
    //     ];
        
    //     return view('components/popups/support_popup', ['supportData' => $supportData])->render();
    // }
    
    // /**
    //  * Контент для "Интерфейс"
    //  */
    // private function getInterfacePopup()
    // {
    //     // Настройки интерфейса
    //     $settings = [
    //         'theme' => 'light',
    //         'font_size' => 'medium',
    //         'animations' => true
    //     ];
        
    //     return view('components/popups/interface_popup', ['settings' => $settings])->render();
    // }
    
    // /**
    //  * Контент для "Написать письмо"
    //  */
    // private function getWriteEmailPopup()
    // {
    //     // Здесь можно получить список получателей
    //     $recipients = [
    //         ['id' => 1, 'name' => 'Иванов И.И.', 'email' => 'ivanov@company.ru'],
    //         ['id' => 2, 'name' => 'Петров П.П.', 'email' => 'petrov@company.ru'],
    //         ['id' => 3, 'name' => 'Сидоров С.С.', 'email' => 'sidorov@company.ru']
    //     ];
        
    //     return view('components/popups/write_email_popup', ['recipients' => $recipients])->render();
    // }
    
    // /**
    //  * Контент для "Мастерская" (пример из подсказки)
    //  */
    // private function getWorkshopPopup()
    // {
    //     $mods = [
    //         ['name' => 'Мод 1', 'description' => 'Описание мода 1', 'installed' => true],
    //         ['name' => 'Мод 2', 'description' => 'Описание мода 2', 'installed' => false],
    //         ['name' => 'Мод 3', 'description' => 'Описание мода 3', 'installed' => true]
    //     ];
        
    //     return view('components/popups/workshop_popup', ['mods' => $mods])->render();
    // }





    //для работы всплывающего окна добавления в учете техники
    public function equipmentAddPanel(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'eq_status_id' => 'nullable|integer|exists:t_equipment_status,eqs_id',
            'eq_type_id' => 'nullable|integer|exists:t_equipment_type,eqt_id',
            'eq_name' => 'required|string|max:255',
            'eq_serial_number' => 'nullable|string|max:255',
            'eq_inventory_number' => 'nullable|string|max:255',
            'eq_cart_number' => 'nullable|string|max:255',
            'eq_div_id' => 'nullable|integer|exists:t_company_division,div_id',
            'eq_client_id' => 'nullable|integer|exists:t_client,cli_id',
            'eq_comment' => 'nullable|string|max:255',
            'import_doc' => 'nullable|string|max:255',
        ]);

        try {
            if ((int)$validated['eq_status_id'] === 1 || (int)$validated['eq_status_id'] === 3) {
                $validated['eq_client_id'] = null;
            }
            // Создаем новую запись
            $equipment = Equipment::create([
                'eq_status_id' => $validated['eq_status_id'] ?? null,
                'eq_type_id' => $validated['eq_type_id'] ?? null,
                'eq_name' => $validated['eq_name'],
                'eq_serial_number' => $validated['eq_serial_number'] ?? null,
                'eq_inventory_number' => $validated['eq_inventory_number'] ?? null,
                'eq_cart_number' => $validated['eq_cart_number'] ?? null,
                'eq_div_id' => $validated['eq_div_id'] ?? null,
                'eq_client_id' => $validated['eq_client_id'] ?? null,
                'eq_comment' => $validated['eq_comment'] ?? null,
                'import_doc' => $validated['import_doc'] ?? null,
                'date_create' => now(),
                'date_change' => now(),
            ]);

            if ((int)$validated['eq_status_id'] === 2) {
                $equipmentJournal = EquipmentJournal::create([
                    'eqj_eq_id' => $equipment->eq_id,
                    'eqj_datetime' => now(),
                    'eqj_status' => $equipment->equipmentStatus->eqs_name,
                    'eqj_cli_id' => (int)$validated['eq_client_id'],
                    'eqj_comment' => '',
                ]);
            }

        

            // Логируем успешное создание
            Log::info('Новое оборудование создано', ['eq_id' => $equipment->eq_id, 'user' => Auth::id()]);

            // Возвращаем успешный ответ
            return redirect()->back()->with('success', 'Оборудование успешно добавлено!');

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при создании оборудования', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при добавлении оборудования: ' . $e->getMessage()]);
        }
    }

    public function equipmentAddDynamicPost(Request $request) {
        $validator = Validator::make($request->all(), [
            'eq_status_id' => 'nullable|integer|exists:t_equipment_status,eqs_id',
            'eq_type_id' => 'nullable|integer|exists:t_equipment_type,eqt_id',
            'eq_name' => 'required|string|max:255',
            'eq_serial_number' => 'required|string|min:4|max:255',
            'eq_inventory_number' => 'required|string|min:8|max:255',
            'eq_cart_number' => 'required|string|max:255',
            'eq_client_id' => 'nullable|integer|exists:t_client,cli_id',
            'eq_div_id' => 'nullable|integer|exists:t_company_division,div_id',
            'eq_comment' => 'nullable|string|max:255',
            'import_doc_id' => 'nullable|integer',
        ], [
            'eq_name.required' => 'Введите наименование техники.',
            'eq_serial_number.required' => 'Введите серийный номер техники.',
            'eq_inventory_number.required' => 'Введите инвентарный номер техники.',
            'eq_cart_number.required' => 'Введите номер карточки техники.',
            'import_doc.required' => 'Введите документ поставки.',
            'eq_serial_number.min' => 'Серийный номер должен быть длиной не менее 4 символов.',
            'eq_inventory_number.min' => 'Слишком короткий инвент-ный номер',
        ]);


        Log::info('Введенные данные нового оборудования', 
        ['eq_name' => $request->eq_name,'eq_serial_number' => $request->eq_serial_number,
         'eq_inventory_number' => $request->eq_inventory_number,'eq_cart_number' => $request->eq_cart_number,]);


        try {
            // Ошибки валидации входных данных
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(), // { field: [messages] }
                ]);
            }
        

            if ((int)$request->eq_status_id === 1 || (int)$request->eq_status_id === 3) {
                $request->eq_client_id = null;
            }
            // Создаем новую запись
            $equipment = Equipment::create([
                'eq_status_id' => $request->eq_status_id ?? null,
                'eq_type_id' => $request->eq_type_id ?? null,
                'eq_name' => $request->eq_name,
                'eq_serial_number' => $request->eq_serial_number ?? null,
                'eq_inventory_number' => $request->eq_inventory_number ?? null,
                'eq_cart_number' => $request->eq_cart_number ?? null,
                'eq_div_id' => $request->eq_div_id ?? null,
                'eq_client_id' => $request->eq_client_id ?? null,
                'eq_comment' => $request->eq_comment ?? null,
                'import_doc' => $request->import_doc ?? null,
                'date_create' => now(),
                'date_change' => now(),
            ]);

            if ((int)$request->eq_status_id === 2) {
                $equipmentJournal = EquipmentJournal::create([
                    'eqj_eq_id' => $equipment->eq_id,
                    'eqj_datetime' => now(),
                    'eqj_status' => $equipment->equipmentStatus->eqs_name,
                    'eqj_cli_id' => (int)$request->eq_client_id,
                    'eqj_comment' => '',
                ]);
            }


            // Логируем успешное создание
            Log::info('Новое оборудование создано', ['eq_id' => $equipment->eq_id, 'user' => Auth::id()]);

            // Возвращаем успешный ответ
            return response()->json([
                'success'  => true,
                'message'  => 'Новое оборудование создано успешно!',
            ]);

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при создании оборудования', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при добавлении оборудования: ' . $e->getMessage()]);
        }
    }



    public function adminAddPanel(Request $request) {
      //для работы всплывающего окна добавления в учете техники
            $validated = $request->validate([
                'cli_name_f' => 'required|string|max:255',
                'cli_name_i' => 'nullable|string|max:255',
                'cli_name_o' => 'nullable|string|max:255',
                'cli_prof' => 'nullable|string|max:255',
                'cli_div_id' => 'nullable|integer|exists:t_company_division,div_id',
                'cli_email' => 'nullable|string|max:255',
                'cli_tel_work' => 'nullable|string|max:255',
                'cli_tel_work2' => 'nullable|string|max:255',
                'cli_tel_mobile' => 'nullable|string|max:255',
                'cli_date_born' => 'nullable|date',
                'cli_comment' => 'nullable|string|max:255',
                'cli_sex' => 'nullable|integer',
            ]);
                Log::info('валидация', [$validated]);

            try {
                DB::beginTransaction();

                // Формируем ФИО для просмотра
                $fullName = trim(
                    ($validated['cli_name_f'] ?? '') . ' ' .
                    ($validated['cli_name_i'] ?? '') . ' ' .
                    ($validated['cli_name_o'] ?? '')
                );

                // Создаем нового сотрудника
                $client = Client::create([
                    'cli_name_f' => $validated['cli_name_f'] ?? null,
                    'cli_name_i' => $validated['cli_name_i'] ?? null,
                    'cli_name_o' => $validated['cli_name_o'] ?? null,
                    'cli_name_view' => $fullName,
                    'cli_prof' => $validated['cli_prof'] ?? null,
                    'cli_div_id' => $validated['cli_div_id'] ?? null,
                    'cli_email' => $validated['cli_email'] ?? null,
                    'cli_tel_work' => $validated['cli_tel_work'] ?? null,
                    'cli_tel_work2' => $validated['cli_tel_work2'] ?? null,
                    'cli_tel_mobile' => $validated['cli_tel_mobile'] ?? null,
                    'cli_date_born' => $validated['cli_date_born'] ?? null,
                    'cli_comment' => $validated['cli_comment'] ?? null,
                    'cli_sex' => (int)$validated['cli_sex'] ?? null,
                    'cli_pregnant' => 0,
                    'cli_disable' => 0, // Новый сотрудник активен
                    'cli_date_create' => now(),
                    'cli_date_change' => now(),
                    'cli_sync_1c_code' => null, // Не из 1С
                    'cli_sync_1c_division_code' => null, // Не из 1С
                    'cli_sync_1c' => 0, // Не из 1С
                    'cli_sync_1c_apply' => 0,
                ]);

                DB::commit();

                // Логируем успешное создание
                Log::info('Новый сотрудник создан', [
                    'cli_id' => $client->cli_id,
                    'user' => Auth::id() ?? 'system'
                ]);

                // Возвращаем успешный ответ
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Сотрудник успешно добавлен!',
                        'data' => $client
                    ]);
                }

                return redirect()->back()->with('success', 'Сотрудник успешно добавлен!');

            } catch (\Exception $e) {
                DB::rollBack();
                
                Log::error('Ошибка при создании сотрудника', [
                    'error' => $e->getMessage(),
                    'data' => $request->all()
                ]);

                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Ошибка при добавлении сотрудника: ' . $e->getMessage()
                    ], 500);
                }

                return redirect()->back()->withErrors(['error' => 'Ошибка при добавлении сотрудника: ' . $e->getMessage()]);
       }
    }

    public function adminAddDynamicPost(Request $request) {
        $validator = Validator::make($request->all(), [
                'cli_name_f' => 'required|string|min:3|max:255',
                'cli_name_i' => 'required|string|min:2|max:255',
                'cli_name_o' => 'required|string|min:5|max:255',
                'cli_prof' => 'required|string|max:255',
                'cli_div_id' => 'nullable|integer',
                'cli_comment' => 'nullable|string|max:255',
                'cli_date_born' => 'nullable|date',
                'cli_sex' => 'nullable|integer',
                'cli_email' => 'nullable|email|max:255',
                'cli_tel_mobile' => 'nullable|string|min:11|max:255',
                'cli_tel_work' => 'nullable|min:6|string|max:255',
                'cli_tel_work2' => 'nullable|min:4|string|max:255',
            ], [
                'cli_name_f.required' => 'Введите фамилию.',
                'cli_name_i.required' => 'Введите имя.',
                'cli_name_o.required' => 'Введите отчество.',
                'cli_name_f.min' => 'Короткая фамилия.',
                'cli_name_i.min' => 'Короткое имя.',
                'cli_name_o.min' => 'Короткое отчество.',
                'cli_prof.required' => 'Введите профессию.',
                'cli_email.email' => 'Эл. почта имеет неверный формат.',
                'cli_date_born.required' => 'Введите дату рождения.',
                'cli_date_born.date' => 'Дата должна иметь соответствующий формат.',
                'cli_tel_mobile.min' => 'Слишком короткий номер телефона.',
                'cli_tel_work.min' => 'Слишком короткий номер гор. телефона.',
                'cli_tel_work2.min' => 'Слишком короткий номер внутр. телефона.',
        ]);
            


        try {
            // Ошибки валидации входных данных
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(), // { field: [messages] }
                ]);
            }
            
            DB::beginTransaction();

            // Формируем ФИО для просмотра
            $fullName = trim(
                ($request->cli_name_f ?? '') . ' ' .
                ($request->cli_name_i ?? '') . ' ' .
                ($request->cli_name_o ?? '')
            );
            // Создаем нового сотрудника
          
            $client = Client::create([
                'cli_name_f' => $request->cli_name_f,
                'cli_name_i' => $request->cli_name_i,
                'cli_name_o' => $request->cli_name_o,
                'cli_name_view' => $fullName,
                'cli_prof' => $request->cli_prof ?? null,
                'cli_div_id' => (int)$request->cli_div_id ?? null,
                'cli_comment' => $request->cli_comment ?? null,
                'cli_date_born' => $request->cli_date_born ?? null,
                'cli_sex' => (int)$request->cli_sex ?? null,
                'cli_email' => $request->cli_email ?? null,
                'cli_tel_mobile' => $request->cli_tel_mobile ?? null,
                'cli_tel_work' => $request->cli_tel_work ?? null,
                'cli_tel_work2' => $request->cli_tel_work2 ?? null,
                'cli_sync_1c' => (int)$request->cli_sync_1c,
                'cli_disable' => (int)$request->cli_disable,
                'cli_pregnant' => 0,
                'cli_date_create' => now(),
                'cli_date_change' => now(),
                'cli_sync_1c_code' => null, // Не из 1С
                'cli_sync_1c_division_code' => null, // Не из 1С
                'cli_sync_1c' => 0, // Не из 1С
                'cli_sync_1c_apply' => 0,
            ]);

            DB::commit();

            // Логируем успешное создание
            Log::info('Новый сотрудник создан', [
                'cli_id' => $client->cli_id,
                'user' => Auth::id() ?? 'system'
            ]);

            // Возвращаем успешный ответ
            return response()->json([
                'success'  => true,
                'message'  => 'Новый сотрудник создан успешно!',
            ]);

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при создании сотрудника', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при добавлении сотрудника: ' . $e->getMessage()]);
        }
    }

    public function adminAddDivision(Request $request) {
      //для работы всплывающего окна добавления в учете техники
            $validated = $request->validate([
                'div_name_full' => 'required|string|max:255',
                'div_name_short' => 'nullable|string|max:255',
                'div_parent_id' => 'nullable|integer|exists:t_company_division,div_id',
                'parent_node' => 'nullable|string|max:255',
                'div_comment' => 'nullable|string|max:255',
            ]); 
                Log::info('валидация', [$validated]);

            try {
                DB::beginTransaction();

                // $parentNode = $request->parent_node

                if ($request->parent_node === "parent_node_yes") {
                    $parentNode = $request->div_parent_id;
                }
                else {
                    $parentNode = null;
                }


                // Создаем нового сотрудника
                $CompanyDivision = CompanyDivision::create([
                    'div_parent_id' => $parentNode ?? null,
                    'div_name_full' => $validated['div_name_full'] ?? null,
                    'div_name_short' => $validated['div_name_short'] ?? null,
                    'div_comment' => $validated['div_comment'] ?? null,
                    'div_disable' => 0,
                    'div_date_create' => now(),
                    'div_date_change' => now(),
                    'div_sync_1c' => 0,
                    'div_sync_1c_code' => 0,
                    'div_sync_1c_parent_code' => 0,
                    'div_sync_1c_apply' => 0,
                    'div_check_subdivision' => 0,
                    'div_send_mail_apply' => 1,
                    'div_lock' => null,
                ]);

                DB::commit();

                // Логируем успешное создание
                Log::info('Новое подразделение создано', [
                    'div_id' => $CompanyDivision->div_id,
                    'user' => Auth::id() ?? 'system'
                ]);

                // Возвращаем успешный ответ
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Подразделение успешно добавлено!',
                        'data' => $CompanyDivision
                    ]);
                }

                return redirect()->back()->with('success', 'Подразделение успешно добавлено!');

            } catch (\Exception $e) {
                DB::rollBack();
                
                Log::error('Ошибка при создании подразделения', [
                    'error' => $e->getMessage(),
                    'data' => $request->all()
                ]);

                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Ошибка при добавлении подразделения: ' . $e->getMessage()
                    ], 500);
                }

                return redirect()->back()->withErrors(['error' => 'Ошибка при добавлении подразделения: ' . $e->getMessage()]);
       }
    }
  

    public function divisionAddDynamicPost(Request $request) {
        $validator = Validator::make($request->all(), [
                'div_name_full' => 'required|string|min:3|max:255',
                'div_name_short' => 'required|string|max:255',
                'div_parent_id' => 'nullable|integer|exists:t_company_division,div_id',
                'parent_node' => 'nullable|string|max:255',
                'div_comment' => 'nullable|string|max:255',
                ], [
                'div_name_full.required' => 'Введите полное название подразделения.',
                'div_name_full.min' => 'Введите полное название подразделения.',
                'div_name_short.required' => 'Введите сокращенное название подразделения .',
                'div_comment.min' => 'Слишком короткий комментарий.',
        ]);
            


        try {
            // Ошибки валидации входных данных
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(), // { field: [messages] }
                ]);
            }

            DB::beginTransaction();

            // $parentNode = $request->parent_node
            if ($request->parent_node === "parent_node_yes") {
                $parentNode = $request->div_parent_id;
            }
            else {
                $parentNode = null;
            }
            
           // Создаем нового сотрудника
            $CompanyDivision = CompanyDivision::create([
                'div_parent_id' => $parentNode ?? null,
                'div_name_full' => $request->div_name_full ?? null,
                'div_name_short' => $request->div_name_short ?? null,
                'div_comment' => $request->div_comment ?? null,
                'div_disable' => 0,
                'div_date_create' => now(),
                'div_date_change' => now(),
                'div_sync_1c' => 0,
                'div_sync_1c_code' => 0,
                'div_sync_1c_parent_code' => 0,
                'div_sync_1c_apply' => 0,
                'div_check_subdivision' => 0,
                'div_send_mail_apply' => 1,
                'div_lock' => null,
            ]);

            DB::commit();

            // Логируем успешное создание
            Log::info('Новое подразделение создано', [
                'div_id' => $CompanyDivision->div_id,
                'user' => Auth::id() ?? 'system'
            ]);

            // Возвращаем успешный ответ
            return response()->json([
                'success'  => true,
                'message'  => 'Новый документ создан успешно!',
            ]);

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при создании документа', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при добавлении сотрудника: ' . $e->getMessage()]);
        }
    }





    //скрипт для фильтриции учета техники
    // public function filterEquipment(Request $request)
    // {
    //     // Получаем параметры фильтрации
    //     $statusFilter = $request->get('status');
    //     $typeFilter = $request->get('type');
    //     $divisionFilter = $request->get('division');
    //     $searchFilter = $request->get('search');
    //     $serialFilter = $request->get('serial');
        
    //     // Базовый запрос
    //     $query = Equipment::with(['equipmentStatus', 'equipmentType']);

        
        
    //     // Применяем фильтры
    //     if ($statusFilter) {
    //         $query->where('eq_status_id', $statusFilter);
    //     }
        
    //     if ($typeFilter) {
    //         $query->where('eq_type_id', $typeFilter);
    //     }
        
    //     if ($divisionFilter) {
    //         $query->where('eq_div_id', $divisionFilter);
    //     }
        
    //     if ($searchFilter) {
    //         $query->where(function($q) use ($searchFilter) {
    //             $q->where('eq_name', 'like', "%{$searchFilter}%")
    //               ->orWhere('eq_serial_number', 'like', "%{$searchFilter}%")
    //               ->orWhere('eq_inventory_number', 'like', "%{$searchFilter}%")
    //               ->orWhere('eq_cart_number', 'like', "%{$searchFilter}%");
    //         });
    //     }
        
    //     if ($serialFilter) {
    //         $query->where('eq_serial_number', 'like', "%{$serialFilter}%");
    //     }
        
    //     // Сортировка и пагинация
    //     $equipments = $query->orderBy('eq_id', 'desc')->paginate(20);
        
    //     // Данные для выпадающих списков
    //     $statuses = EquipmentStatus::orderBy('eqs_name')->get();
    //     $types = EquipmentType::orderBy('eqt_name')->get();
    //     $divisions = CompanyDivision::where('div_disable', 0)->orderBy('div_name_full')->get();
        
    //     Log::info('Учет техники отсортирован функцией filterEquipmentOld');

        
    //     return view('equipment.index', compact(
    //         'equipments', 
    //         'statuses', 
    //         'types', 
    //         'divisions',
    //         'statusFilter',
    //         'typeFilter',
    //         'divisionFilter',
    //         'searchFilter',
    //         'serialFilter'
    //     ));
    // }



    //для фильтра в учете технике 
    public function filter(Request $request)
    {
        // Получаем параметры фильтрации
        $div_id = (int)$request->input('div_id', '');
        $div_type = $request->input('div_type', '');
        $statusFilter = $request->input('status', '');
        $typeFilter   = $request->input('type', '');
        $withoutDiv   = $request->boolean('without_division', false);
        $withoutResp  = $request->boolean('without_responsible', false);
        $withoutBoth  = $request->boolean('without_both', false);
        
        // Параметры сортировки
        $sortField = $request->input('sort', 'eq_id');
        $sortDirection = $request->input('direction', 'asc');

        // Строим запрос
        // $query = Equipment::query()
        //     ->with(['equipmentStatus', 'equipmentType', 'client.division']);
        if ($div_type === 'main'){
            $divisionIds = $this->getDivisionTreeIds($div_id);

            // Получаем всех сотрудников с этими ID подразделов
            $query = Equipment::query()
                ->with(['equipmentStatus', 'equipmentType', 'client.division'])
                ->leftJoin('t_client', 't_equipment.eq_client_id', '=', 't_client.cli_id')
                ->select('t_equipment.*') 
                ->where(function ($q) use ($divisionIds) {
                    $q->whereIn('t_equipment.eq_div_id', $divisionIds)
                    ->orWhereIn('t_equipment.eq_client_id', $divisionIds)
                    ->orWhereIn('t_client.cli_div_id', $divisionIds);
                });
                
        }
        else {
            $query = Equipment::query()
                ->with(['equipmentStatus', 'equipmentType', 'client.division'])
                ->leftJoin('t_client', 't_equipment.eq_client_id', '=', 't_client.cli_id')
                ->select('t_equipment.*') 
                ->where(function ($q) use ($div_id) {
                    $q->where('t_equipment.eq_div_id', $div_id)
                    ->orWhere('t_equipment.eq_client_id', $div_id)
                    ->orWhere('t_client.cli_div_id', $div_id);
                });
        }
       

        // eq_id = $request->department_id;
        // $depName = $request->department_name;
        // $divisionType = $request->division_type; // 'main' или 'sub'

        

        // Применяем фильтры
        if (!empty($statusFilter)) {
            $query->where('eq_status_id', $statusFilter);
        }

        if (!empty($typeFilter)) {
            $query->where('eq_type_id', $typeFilter);
        }

        if ($withoutDiv) {
            $query->whereNull('eq_div_id');
        }

        if ($withoutResp) {
            $query->whereNull('eq_client_id');
        }

        if ($withoutBoth) {
            $query->whereNull('eq_div_id')->whereNull('eq_client_id');
        }

        if ($sortField === "eq_cli_name_view") {
            $sortField = "t_client.cli_name_view";
        }

        // Сортировка
        $query->orderBy($sortField, $sortDirection);



        // $query->where(function ($query) use ($div_id) {
        //     // 1) eq_div_id задан явно
        //     $query->where(function ($q) use ($div_id) {
        //         $q->whereNotNull('t_equipment.eq_div_id')
        //         ->where('t_equipment.eq_div_id', '!=', 0)
        //         ->where('t_equipment.eq_div_id', $div_id);
        //     });

        //     // 2) eq_div_id не задан, но есть клиент с отделом
        //     $query->orWhere(function ($q) use ($div_id) {
        //         $q->where(function ($sub) {
        //             $sub->whereNull('t_equipment.eq_div_id')
        //                 ->orWhere('t_equipment.eq_div_id', 0);
        //         })
        //         ->where(function ($sub) {
        //             $sub->whereNotNull('t_equipment.eq_client_id')
        //                 ->where('t_equipment.eq_client_id', '!=', 0);
        //         })
        //         ->where('t_client.cli_div_id', $div_id);
        //     });

        //     // 3) ни eq_div_id, ни eq_client_id не заданы → подразделение 4104
        //     $query->orWhere(function ($q) use ($div_id) {
        //         $q->where(function ($sub) {
        //             $sub->whereNull('t_equipment.eq_div_id')
        //                 ->orWhere('t_equipment.eq_div_id', 0);
        //         })
        //         ->where(function ($sub) {
        //             $sub->whereNull('t_equipment.eq_client_id')
        //                 ->orWhere('t_equipment.eq_client_id', 0);
        //         })
        //         ->whereRaw('? = ?', [4104, $div_id]); // или if ($eq_id == 4104) добавить условие
        //     });
        // })
        // ->select('t_equipment.*');



        // Пагинация (если нужна)
        // $equipments = $query->paginate(15);
        $equipments = $query->get();


        // Для селекторов нам понадобятся списки статусов и типов (они не меняются, но можно передать для обновления)
        $statuses = EquipmentStatus::all();
        $types    = EquipmentType::all();

        Log::info('Учет техники отсортирован функцией filterEquipment');
        Log::info('вирусы 10100101', [$sortField]);

        
        

        // Возвращаем частичный шаблон только с таблицей
        return view('components.data_panel.data_equipment', compact('equipments', 'statuses', 'types'));
    }


    
    public function clientFilter(Request $request)
    {
        // Получаем параметры фильтрации
        $div_id = (int)$request->input('div_id', '');
        $div_type = $request->input('div_type', '');
        $statusFilter = $request->input('status', '');
        $typeFilter   = $request->input('type', '');
        $withoutDiv   = $request->boolean('without_division', false);
        $withoutResp  = $request->boolean('without_responsible', false);
        $withoutBoth  = $request->boolean('without_both', false);
        
        // Параметры сортировки
        $sortField = $request->input('sort', 'eq_id');
        $sortDirection = $request->input('direction', 'asc');

        // Строим запрос
        // $query = Equipment::query()
        //     ->with(['equipmentStatus', 'equipmentType', 'client.division']);
        if ($div_type === 'main'){
            $divisionIds = $this->getDivisionTreeIds($div_id);

            // Получаем всех сотрудников с этими ID подразделов
            $query = Equipment::query()
                ->with(['equipmentStatus', 'equipmentType', 'client.division'])
                ->leftJoin('t_client', 't_equipment.eq_client_id', '=', 't_client.cli_id')
                ->select('t_equipment.*') 
                ->where(function ($q) use ($divisionIds) {
                    $q->whereIn('t_equipment.eq_div_id', $divisionIds)
                    ->orWhereIn('t_equipment.eq_client_id', $divisionIds)
                    ->orWhereIn('t_client.cli_div_id', $divisionIds);
                });
                
        }
        else {
            $query = Equipment::query()
                ->with(['equipmentStatus', 'equipmentType', 'client.division'])
                ->leftJoin('t_client', 't_equipment.eq_client_id', '=', 't_client.cli_id')
                ->select('t_equipment.*') 
                ->where(function ($q) use ($div_id) {
                    $q->where('t_equipment.eq_div_id', $div_id)
                    ->orWhere('t_equipment.eq_client_id', $div_id)
                    ->orWhere('t_client.cli_div_id', $div_id);
                });
        }
       

        // eq_id = $request->department_id;
        // $depName = $request->department_name;
        // $divisionType = $request->division_type; // 'main' или 'sub'

                

        // Применяем фильтры
        if (!empty($statusFilter)) {
            $query->where('eq_status_id', $statusFilter);
        }

        if (!empty($typeFilter)) {
            $query->where('eq_type_id', $typeFilter);
        }

        if ($withoutDiv) {
            $query->whereNull('eq_div_id');
        }

        if ($withoutResp) {
            $query->whereNull('eq_client_id');
        }

        if ($withoutBoth) {
            $query->whereNull('eq_div_id')->whereNull('eq_client_id');
        }

        // Сортировка
        $query->orderBy($sortField, $sortDirection);



        // $query->where(function ($query) use ($div_id) {
        //     // 1) eq_div_id задан явно
        //     $query->where(function ($q) use ($div_id) {
        //         $q->whereNotNull('t_equipment.eq_div_id')
        //         ->where('t_equipment.eq_div_id', '!=', 0)
        //         ->where('t_equipment.eq_div_id', $div_id);
        //     });

        //     // 2) eq_div_id не задан, но есть клиент с отделом
        //     $query->orWhere(function ($q) use ($div_id) {
        //         $q->where(function ($sub) {
        //             $sub->whereNull('t_equipment.eq_div_id')
        //                 ->orWhere('t_equipment.eq_div_id', 0);
        //         })
        //         ->where(function ($sub) {
        //             $sub->whereNotNull('t_equipment.eq_client_id')
        //                 ->where('t_equipment.eq_client_id', '!=', 0);
        //         })
        //         ->where('t_client.cli_div_id', $div_id);
        //     });

        //     // 3) ни eq_div_id, ни eq_client_id не заданы → подразделение 4104
        //     $query->orWhere(function ($q) use ($div_id) {
        //         $q->where(function ($sub) {
        //             $sub->whereNull('t_equipment.eq_div_id')
        //                 ->orWhere('t_equipment.eq_div_id', 0);
        //         })
        //         ->where(function ($sub) {
        //             $sub->whereNull('t_equipment.eq_client_id')
        //                 ->orWhere('t_equipment.eq_client_id', 0);
        //         })
        //         ->whereRaw('? = ?', [4104, $div_id]); // или if ($eq_id == 4104) добавить условие
        //     });
        // })
        // ->select('t_equipment.*');



        // Пагинация (если нужна)
        // $equipments = $query->paginate(15);
        $equipments = $query->get();


        // Для селекторов нам понадобятся списки статусов и типов (они не меняются, но можно передать для обновления)
        $statuses = EquipmentStatus::all();
        $types    = EquipmentType::all();

        Log::info('Учет техники отсортирован функцией filterEquipment');

        // Возвращаем частичный шаблон только с таблицей
        return view('components.data_panel.data_equipment', compact('equipments', 'statuses', 'types'));
    }




     public function changeClient1cStatus(Request $request){
        // eq_div_id   eq_col_name   eq_data
        $id = (int)$request->cli_id; 
       
        // $Equipment = Equipment::where('eq_id', $id)->first();
        $Client = Client::findOrFail($id);
        $client1cStatus = false;
        
        if($Client->cli_sync_1c === true){
            $Client->cli_sync_1c = false;
            $client1cStatus = false;
        }
        else{
            $Client->cli_sync_1c = true;
            $client1cStatus = true;
        }

        $Client->save();
        $mesage = 'Пользователю ' .$Client->cli_name_view . 'изменили статус синхронизации на ';
        Log::info($mesage, [$Client->cli_sync_1c]);


        return response()->json(["success" => true, "status" => $client1cStatus]);

        }


        public function getDocumentInfo(Request $request) {
        // if ($user->role === 'admin' && $user->role === 'director'){
        //     $role = $user->role;
        // }
        $doc_sup_id  = (int)$request->doc_sup_id ;
        $user = Auth::user();

        $Documents = EquipmentDocument::where('doc_sup_id', $doc_sup_id )->first();

        return view('components/data_user_note/data_document_note', ['doc_sup_id' => $Documents, 'user' => $user])->render();
    }

    
     public function getPopupaddDocument(Request $request) {
        $EquipmentProviders= Provider::all();
        $clients = Client::where('cli_sync_1c', 1)
                ->where('cli_disable', 0)
                ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
                ->orderBy('cli_name_f', 'asc')
                ->limit(100)
                ->get();
         $CompanyDivisions = CompanyDivision::
            where('div_sync_1c', 1)->where('div_disable', 0)
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();
         $EquipmentDocuments = EquipmentDocument::all();

        return view('components/popup/popup_addDocument', ['clients' => $clients, 'EquipmentProviders' => $EquipmentProviders, 'CompanyDivisions' => $CompanyDivisions, 'EquipmentDocuments' => $EquipmentDocuments])->render();   

    }



    //для работы всплывающего окна добавления в учете техники
    public function DocumentAddPanel(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'doc_sup_name' => 'nullable|string|max:255',
            'doc_sup_number' => 'nullable|integer',
            'doc_sup_date' => 'required|date',
            'doc_sup_comment' => 'nullable|string|max:255',
            'doc_sup_prov_id' => 'nullable',
            'doc_sup_prov_name' => 'nullable|string|max:255',
            'doc_sup_import' => 'nullable|string|max:255',
        ]);

        try {
            // Создаем новую запись
            $EquipmentDocuments = EquipmentDocument::create([
                'doc_sup_name' => $validated['doc_sup_name'] ?? null,
                'doc_sup_number' => $validated['doc_sup_number'] ?? null,
                'doc_sup_date' => $validated['doc_sup_date'],
                'doc_sup_comment' => $validated['doc_sup_comment'] ?? null,
                'doc_sup_prov_id' => $validated['doc_sup_prov_id'] ?? null,
                'doc_sup_prov_name' => $validated['doc_sup_prov_name'] ?? null,
                'doc_sup_import' => $validated['doc_sup_import'] ?? null,
            ]);

            // Логируем успешное создание
            Log::info('Новое оборудование создано', ['doc_sup_id' => $EquipmentDocuments->doc_sup_id, 'user' => Auth::id()]);

            // Возвращаем успешный ответ
            return redirect()->back()->with('success', 'Оборудование успешно добавлено!');

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при создании оборудования', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при добавлении оборудования: ' . $e->getMessage()]);
        }
    }

    public function documentAddDynamicPost(Request $request) {
        $validator = Validator::make($request->all(), [
                'doc_sup_name' => 'required|string|max:255',
                'doc_sup_number' => 'nullable|integer',
                'doc_sup_date' => 'required|date',
                'doc_sup_comment' => 'nullable|string|max:255',
                'doc_sup_prov_id' => 'required|integer',
                'doc_sup_prov_name' => 'nullable|string|max:255',
                'doc_sup_import' => 'nullable|string|max:255',
                ], [
                'doc_sup_name.required' => 'Введите название документа.',
                'doc_sup_number.min' => 'Введите номер документа.',
                'doc_sup_date.required' => 'Введите дату документа.',
                'doc_sup_date.date' => 'Введите дату документа.',
                'doc_sup_comment.min' => 'Слишком короткий комментарий.',
                'doc_sup_prov_id.required' => 'Выберите поставщика.',
                'doc_sup_prov_name.required' => 'Введите название поставщик.',
        ]);


        try {
            // Ошибки валидации входных данных
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(), // { field: [messages] }
                ]);
            }

        
            // Создаем новую запись
            $Document = EquipmentDocument::create([
                'doc_sup_name' => $request->doc_sup_name,
                'doc_sup_number' => $request->doc_sup_number ?? null,
                'doc_sup_date' => $request->doc_sup_date,
                'doc_sup_comment' => $request->doc_sup_comment ?? null,
                'doc_sup_prov_id' => $request->doc_sup_prov_id,
                'doc_sup_prov_name' => $request->doc_sup_prov_name ?? null,
                'doc_sup_import' => $request->doc_sup_import ?? null,
            ]);

            // Логируем успешное создание
            Log::info('Новый документ создан', ['doc_sup_id' => $Document->doc_sup_id, 'user' => Auth::id()]);

           
            // Возвращаем успешный ответ
            return response()->json([
                'success'  => true,
                'message'  => 'Новое оборудование создано успешно!',
            ]);

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при создании оборудования', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при добавлении оборудования: ' . $e->getMessage()]);
        }
    }



    
    public function getPopupeditingAdminForm(Request $request) {
        $cli_id = $request -> cli_id;
        $client = Client::where('cli_id', $cli_id)->first();
         $CompanyDivisions = CompanyDivision::
            where('div_sync_1c', 1)->where('div_disable', 0)
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();

        return view('components/popup/popup_editingAdmin', ['client' => $client, 'CompanyDivisions' => $CompanyDivisions])->render();
    }

    public function getInnerPopupSync1c(Request $request) {
        $cli_id = $request->cli_id;
        // $cli_id = 51194;

        $client = Client::where('cli_id', $cli_id)->first();
        //  $CompanyDivisions = CompanyDivision::
        //     where('div_sync_1c', 1)->where('div_disable', 0)
        //     ->orderBy('div_name_full')->orderBy('div_id')
        //     ->get();

        return view('components.popup.inner_popup.inner_popup_1cSync', ['sync1C' => $client])->render();
    }





    public function editingAdminForm(Request $request)
    {
        $cli_id = $request->cli_id;
        // Валидация данных
        $validated = $request->validate([
            'cli_name_f' => 'required|string|max:255',
            'cli_name_i' => 'required|string|max:255',
            'cli_name_o' => 'required|string|max:255',
            'cli_prof' => 'nullable|string|max:255',
            'cli_div_id' => 'nullable|integer',
            'cli_comment' => 'nullable|string|max:255',
            'cli_date_born' => 'nullable|date',
            'cli_sex' => 'nullable|integer',
            'cli_email' => 'nullable|string|max:255',
            'cli_tel_mobile' => 'nullable|string|max:255',
            'cli_tel_work' => 'nullable|string|max:255',
            'cli_tel_work2' => 'nullable|string|max:255',
        ]);

        $fullName = trim(
            ($validated['cli_name_f'] ?? '') . ' ' .
            ($validated['cli_name_i'] ?? '') . ' ' .
            ($validated['cli_name_o'] ?? '')
        );

        try {
            // Создаем новую запись
            $client = Client::where('cli_id', $cli_id)->first();

            $client->update([
                'cli_name_f' => $validated['cli_name_f'],
                'cli_name_i' => $validated['cli_name_i'],
                'cli_name_o' => $validated['cli_name_o'],
                'cli_name_view' => $fullName,
                'cli_prof' => $validated['cli_prof'] ?? null,
                'cli_div_id' => $validated['cli_div_id'] ?? null,
                'cli_comment' => $validated['cli_comment'] ?? null,
                'cli_date_born' => $validated['cli_date_born'] ?? null,
                'cli_sex' => (int)$validated['cli_sex'] ?? null,
                'cli_email' => $validated['cli_email'] ?? null,
                'cli_tel_mobile' => $validated['cli_tel_mobile'] ?? null,
                'cli_tel_work' => $validated['cli_tel_mobile'] ?? null,
                'cli_tel_work2' => $validated['cli_tel_work2'] ?? null,
                'cli_sync_1c' => $request->has('cli_sync_1c') ? 1 : 0,
                'cli_disable' => $request->has('cli_disable') ? 1 : 0,
            ]);

            //cli_sync_1c
            // if ($request->has('cli_sync_1c'))

            // Логируем успешное создание
            Log::info('Данные сотрудника изменены', ['cli_id' => $client->cli_id, 'user' => Auth::id()]);

            // Возвращаем успешный ответ
            return redirect()->back()->with('success', 'Данные сотрудника успешно изменены!');

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при изменении данных сотрудника', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при изменении данных сотрудника: ' . $e->getMessage()]);
        }
    }

    public function editingAdminDynamicPost(Request $request)
    {
        $data = $request->json()->all(); 
        $validator = Validator::make($request->all(), [
            'cli_name_f' => 'required|string|min:3|max:255',
            'cli_name_i' => 'required|string|min:2|max:255',
            'cli_name_o' => 'required|string|min:5|max:255',
            'cli_prof' => 'required|string|max:255',
            'cli_div_id' => 'nullable|integer',
            'cli_comment' => 'nullable|string|max:255',
            'cli_date_born' => 'nullable|date',
            'cli_sex' => 'nullable|integer',
            'cli_email' => 'nullable|email|max:255',
            'cli_tel_mobile' => 'nullable|string|min:11|max:255',
            'cli_tel_work' => 'nullable|min:6|string|max:255',
            'cli_tel_work2' => 'nullable|min:4|string|max:255',

            // вложенные данные из внутреннего окна
            'sync_1c'                                => 'nullable|array',
            'sync_1c.cli_sync_1c_id'                 => 'nullable|string|max:255',
            'sync_1c.cli_sync_1c_code'               => 'nullable|string|max:255',
            'sync_1c.cli_sync_1c_division_code'      => 'nullable|string|max:255',
            'sync_1c.cli_sync_1c_category'           => 'nullable|string|min:4|max:255',
            'sync_1c.cli_sync_1c_status'             => 'nullable|string|max:255',
            'sync_1c.cli_sync_1c_employment_type'    => 'nullable|string|max:255',
            'sync_1c.cli_sync_1c_hire_date'          => 'nullable|date',
            // 'sync_1c.cli_sync_1c_is_division_head'   => 'nullable|boolean',
        ], [
            'cli_name_f.required' => 'Введите фамилию.',
            'cli_name_i.required' => 'Введите имя.',
            'cli_name_o.required' => 'Введите отчество.',
            'cli_name_f.min' => 'Короткая фамилия.',
            'cli_name_i.min' => 'Короткое имя.',
            'cli_name_o.min' => 'Короткое отчество.',
            'cli_prof.required' => 'Введите профессию.',
            'cli_email.email' => 'Эл. почта имеет неверный формат.',
            'cli_date_born.required' => 'Введите дату рождения.',
            'cli_date_born.date' => 'Дата должна иметь соответствующий формат.',
            'cli_tel_mobile.min' => 'Слишком короткий номер телефона.',
            'cli_tel_work.min' => 'Слишком короткий номер гор. телефона.',
            'cli_tel_work2.min' => 'Слишком короткий номер внутр. телефона.',

            'sync_1c.cli_sync_1c_category' =>'Слишком короткая категория.',
        ]);


        // Log::info('Введенные данные нового оборудования', 
        // ['eq_name' => $request->eq_name,'eq_serial_number' => $request->eq_serial_number,
        //  'eq_inventory_number' => $request->eq_inventory_number,'eq_cart_number' => $request->eq_cart_number,]);
        // $data = $request->json()->all(); 
        $validated = $validator->validated();
        $syncData = $validated['sync_1c'] ?? [];
        Log::info('Введенные данные из внутреннего окна синхронизация 1с', [$request->sync_1c['cli_sync_1c_id'] ?? []]);
        // Log::info('Введенные данные из внутреннего окна синхронизация 1с', [$data['cli_id'], $syncData ?? []]);
        //, 'cli_sync_1c_id' => $request->sync_1c['cli_sync_1c_id'] $data['sync_1c']

        try {
            // Ошибки валидации входных данных
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(), // { field: [messages] }
                ]);
            }

            $fullName = trim(
                ($request->cli_name_f ?? '') . ' ' .
                ($request->cli_name_i ?? '') . ' ' .
                ($request->cli_name_o ?? '')
            );

            $cli_id = $request->cli_id;

             // Создаем новую запись
            $client = Client::where('cli_id', $cli_id)->first();

            $client->update([
                'cli_name_f' => $request->cli_name_f,
                'cli_name_i' => $request->cli_name_i,
                'cli_name_o' => $request->cli_name_o,
                'cli_name_view' => $fullName,
                'cli_prof' => $request->cli_prof ?? null,
                'cli_div_id' => (int)$request->cli_div_id ?? null,
                'cli_comment' => $request->cli_comment ?? null,
                'cli_date_born' => $request->cli_date_born ?? null,
                'cli_sex' => (int)$request->cli_sex ?? null,
                'cli_email' => $request->cli_email ?? null,
                'cli_tel_mobile' => $request->cli_tel_mobile ?? null,
                'cli_tel_work' => $request->cli_tel_work ?? null,
                'cli_tel_work2' => $request->cli_tel_work2 ?? null,
                'cli_sync_1c' => (int)$request->cli_sync_1c,
                'cli_disable' => (int)$request->cli_disable,
            ]);

            // Вложенные данные из внутреннего окна
            if ($request->filled('sync_1c')) {
                $sync = $request->input('sync_1c');

                // преобразуем 0/1 в bool для чекбоксов
                // foreach ([
                //     'cli_sync_1c_is_division_head',
                //     'cli_disable',
                //     'cli_sync_1c',
                // ] as $boolField) {
                //     if (array_key_exists($boolField, $sync)) {
                //         $sync[$boolField] = (bool) $sync[$boolField];
                //     }
                // }
                unset($sync['cli_id']);

                $client->update($sync);
                
                Log::info('Были введены данные с внутр. окошка "синхронизация 1С"', ['cli_id' => $client->cli_id, 'user' => Auth::id()]);

            }

            // Логируем успешное создание
            Log::info('Данные сотрудника изменены', ['cli_id' => $client->cli_id, 'user' => Auth::id()]);


            // Возвращаем успешный ответ
            return response()->json([
                'success'  => true,
                'message'  => 'Данные сотрудника успешно обновлены!',
            ]);

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при изменении данных сотрудника', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return response()->json([
                'success'  => false,
                'message'  => 'Ошибка при изменении данных сотрудника!',
            ]);
            // return redirect()->back()->withErrors(['error' => 'Ошибка при изменении данных сотрудника: ' . $e->getMessage()]);
        }
    }

    public function searchDocument(Request $request)
    {
        $query = $request->get('query', '');
        $documentId = $request->get('doc_sup_id', null);
        $searchMode = $request->get('search_mode', false);
        
        // Если поиск пустой и нет фильтра по отделу - возвращаем всех
        if (empty($query)) {
            $Documents = EquipmentDocument::with(['provider'])->get();
            
            return response()->json([
                'success' => true,
                'html' => $this->renderDocumentTableRows($Documents),
                'count' => $Documents->count()
            ]);
        }

        $searchDocument = EquipmentDocument::query();

        // Log::info('searchEqId', [$documentId]);
        // Log::info('searchMode', [$searchMode]);
        // Log::info('query', [$query]);

        Log::info('searchEqId, searchMode, query', [$documentId, $searchMode, $query]);

        // Фильтр по отделу
        // if (!empty($documentId) && $searchMode === "false") {
        //     $searchDocument->where('doc_sup_id', $documentId);
        // }

        //with(['division' => fn($q) => $q->where('div_name_full', 'Дирекция')])

        // Поиск по текстовому запросу
        if (!empty($query)) {
            // $searchEquipment->where(function ($q) use ($query) {
            //     $q->where('eq_name', 'LIKE', "%{$query}%")
            //       ->orWhere('eq_serial_number', 'LIKE', "%{$query}%")
            //       ->orWhere('eq_inventory_number', 'LIKE', "%{$query}%")
            //       ->orWhere('eq_cart_number', 'LIKE', "%{$query}%")
            //       ->orWhere('eq_div_id', 'LIKE', "%{$query}%")
            //       ->orWhere('eq_client_id', 'LIKE', "%{$query}%") 
            //       ->orWhereHas('equipmentStatus', function ($subQuery) use ($query) {
            //           $subQuery->where('eqs_name', 'LIKE', "%{$query}%");
            //       })->orWhereHas('equipmentType', function ($subQuery) use ($query) {
            //           $subQuery->where('eqt_name', 'LIKE', "%{$query}%");
            //       })->with(['equipmentStatus','equipmentType']);
            // });

            $searchDocument->with(['provider'])
            ->where(function ($q) use ($query) {
                $q->where('doc_sup_name', 'LIKE', "%{$query}%")
                ->orWhere('doc_sup_number', 'LIKE', "%{$query}%")
                ->orWhere('doc_sup_date', 'LIKE', "%{$query}%")
                ->orWhere('doc_sup_comment', 'LIKE', "%{$query}%")
                ->orWhere('doc_sup_id', 'LIKE', "%{$query}%")
                ->orWhereHas('provider', function ($subQuery) use ($query) {
                    $subQuery->where('prov_name', 'LIKE', "%{$query}%");
                })->get(); // Метод with() отсюда убран
            });
        }



        $Documents = $searchDocument->orderBy('doc_sup_name')->get();

        // $clientsDivisions = [];
        // foreach ($clients as $client) {
        //     $clientsDivisions += $client->cli_div_id;
        // }

        // Если ничего не найдено
        if ($Documents->isEmpty()) {
            return response()->json([
                'success' => true,
                'html' => '<tr>
                    <td colspan="6" style="text-align:center;padding:20px;">
                        <div class="block fl-align fl-col" style="">
                            <img src="/sources/media/icons/empty_request.png" class="" style="width:205px; height:260px; object-fit: contain;">
                            <p style="font-family: Averta Bold; font-size: 26px; color: var(--header-text-c-1); text-align: center;">Ничего не найдено</p>
                        </div>
                    </td>
                </tr>',
                'count' => 0
            ]);
        }

        return response()->json([
            'success' => true,
            'html' => $this->renderDocumentTableRows($Documents),
            'count' => $Documents->count()
        ]);
    }

    
    public function getEquipmentForAction(Request $request) {
        //  $request->
    }




    public function editingEquipmentForm(Request $request)
    {
        $eq_id = $request->eq_id;
        // Валидация данных
        $validated = $request->validate([
            'eq_status_id' => 'required|integer',
            'eq_type_id' => 'required|string|max:255',
            'eq_name' => 'required|string|max:255',
            'eq_serial_number' => 'nullable|string|max:255',
            'eq_inventory_number' => 'nullable|string|max:255',
            'eq_cart_number' => 'nullable|string|max:255',
            'import_doc' => 'nullable|string|max:255',
            'eq_client_id' => 'nullable|integer',
            'eq_div_id' => 'nullable|integer',
            'eq_comment' => 'nullable|string|max:255',

        ]);


        try {
            // Создаем новую запись
            $Equipment = Equipment::where('eq_id', $eq_id)->first();

            if ($Equipment) {

                $Equipment->update([
                    'eq_status_id' => $validated['eq_status_id'] ?? null,
                    'eq_type_id' => $validated['eq_type_id'] ?? null,
                    'eq_name' => $validated['eq_name'] ?? null,
                    'eq_serial_number' => $validated['eq_serial_number'] ?? null,
                    'eq_inventory_number' => $validated['eq_inventory_number'] ?? null,
                    'eq_cart_number' => $validated['eq_cart_number'] ?? null,
                    'import_doc' => $validated['import_doc'] ?? null,
                    'eq_div_id' => $validated['eq_div_id'] ?? null,
                    'eq_comment' => $validated['eq_comment'] ?? null,
                    'eq_client_id' => $validated['eq_client_id'] ?? null,

                ]);

                // Логируем успешное создание
                Log::info('Техника успешно изменена', ['eq_id' => $Equipment->eq_id, 'user' => Auth::id()]);
            }
            else {
                Log::info('Техника не найдена по id: ', ['eq_id' => $Equipment->eq_id]);
            }
            
            

            // Возвращаем успешный ответ
            return redirect()->back()->with('success', 'Техника успешно изменена!');

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при создании оборудования', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при изменении техники: ' . $e->getMessage()]);
        }
    }


    public function equipmentEditingDynamicPost(Request $request) {
        $validator = Validator::make($request->all(), [
            'eq_status_id' => 'nullable|integer|exists:t_equipment_status,eqs_id',
            'eq_type_id' => 'nullable|integer|exists:t_equipment_type,eqt_id',
            'eq_name' => 'required|string|max:255',
            'eq_serial_number' => 'required|string|min:4|max:255',
            'eq_inventory_number' => 'required|string|min:8|max:255',
            'eq_cart_number' => 'required|string|max:255',
            'eq_client_id' => 'nullable|integer|exists:t_client,cli_id',
            'eq_div_id' => 'nullable|integer|exists:t_company_division,div_id',
            'eq_comment' => 'nullable|string|max:255',
            'import_doc_id' => 'nullable|integer',
        ], [
            'eq_name.required' => 'Введите наименование техники.',
            'eq_serial_number.required' => 'Введите серийный номер техники.',
            'eq_inventory_number.required' => 'Введите инвентарный номер техники.',
            'eq_cart_number.required' => 'Введите номер карточки техники.',
            'import_doc.required' => 'Введите документ поставки.',
            'eq_serial_number.min' => 'Серийный номер должен быть длиной не менее 4 символов.',
            'eq_inventory_number.min' => 'Слишком короткий инвент-ный номер',
        ]);


        Log::info('Введенные данные нового оборудования', 
        ['eq_name' => $request->eq_name,'eq_serial_number' => $request->eq_serial_number,
         'eq_inventory_number' => $request->eq_inventory_number,'eq_cart_number' => $request->eq_cart_number,]);


        try {
            // Ошибки валидации входных данных
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(), // { field: [messages] }
                ]);
            }
        
            $eq_id = $request->eq_id;
            
            $Equipment = Equipment::where('eq_id', $eq_id)->first();

            if ((int)$request->eq_status_id === 1 || (int)$request->eq_status_id === 3) {
                $request->eq_client_id = null;
            }

            if ($Equipment) { 

                    // Создаем новую запись
                $Equipment->update([
                    'eq_status_id' => $request->eq_status_id ?? null,
                    'eq_type_id' => $request->eq_type_id ?? null,
                    'eq_name' => $request->eq_name,
                    'eq_serial_number' => $request->eq_serial_number ?? null,
                    'eq_inventory_number' => $request->eq_inventory_number ?? null,
                    'eq_cart_number' => $request->eq_cart_number ?? null,
                    'eq_div_id' => $request->eq_div_id ?? null,
                    'eq_client_id' => $request->eq_client_id ?? null,
                    'eq_comment' => $request->eq_comment ?? null,
                    'import_doc' => $request->import_doc ?? null,
                    'date_change' => now(),
                ]);

                if ((int)$request->eq_status_id === 2) {
                    $equipmentJournal = EquipmentJournal::create([
                        'eqj_eq_id' => $Equipment->eq_id,
                        'eqj_datetime' => now(),
                        'eqj_status' => $Equipment->equipmentStatus->eqs_name,
                        'eqj_cli_id' => (int)$request->eq_client_id,
                        'eqj_comment' => '',
                    ]);
                }
            }
            


            // Логируем успешное создание
            Log::info('Новое оборудование создано', ['eq_id' => $Equipment->eq_id, 'user' => Auth::id()]);

            $eqStatus = EquipmentStatus::where('eqs_id', $request->eq_status_id)->first();
            $eqType = EquipmentType::where('eqt_id', $request->eq_type_id)->first();
            // Возвращаем успешный ответ
            return response()->json([
                'success'  => true,
                'updatedData' => [
                    'eq_status_name' => $eqStatus->eqs_name,
                    'eq_type_name' => $eqType->eqt_name,
                    'eq_name' => $request->eq_name,
                    'eq_serial_number' => $request->eq_serial_number,
                    'eq_cart_number' => $request->eq_cart_number,
                    'eq_inventory_number' => $request->eq_inventory_number,
                    'eq_client' => $Equipment->client->cli_name_view ?? "",
                    'eq_div' => $Equipment->division->div_name_full ?? "",
                ],
                'message'  => 'Новое оборудование создано успешно!',
            ]);

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при создании оборудования', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);
               return response()->json([
                'success'  => false,
                'message'  => 'Ошибка при создании оборудования!',
            ]);
            
        }
    }



    public function getPopupeditingEquipmentForm(Request $request) {
        $eq_id = $request -> eq_id;
        $Equipment = Equipment::where('eq_id', $eq_id)->first();
  
        $EquipmentStatuses = EquipmentStatus::all();
        $EquipmentTypes = EquipmentType::all();
        $clients = Client::where('cli_sync_1c', 1)
                ->where('cli_disable', 0)
                ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
                ->orderBy('cli_name_f', 'asc')
                ->get();
                
         $CompanyDivisions = CompanyDivision::
            where('div_sync_1c', 1)->where('div_disable', 0)
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();

         $EquipmentDocuments = EquipmentDocument::all();

        return view('components/popup/popup_editingEquipment', ['Equipment' => $Equipment, 'clients' => $clients, 'CompanyDivisions' => $CompanyDivisions, 'EquipmentStatuses' => $EquipmentStatuses, 'EquipmentTypes' => $EquipmentTypes, 'EquipmentDocuments' => $EquipmentDocuments ])->render();
    }




    public function getPopupViewEquipment(Request $request) {
        $eq_id = $request->eq_id;
        $Equipment = Equipment::where('eq_id', $eq_id)->first();
  
        $EquipmentStatuses = EquipmentStatus::all();
        $EquipmentTypes = EquipmentType::all();
        $clients = Client::where('cli_sync_1c', 1)
                ->where('cli_disable', 0)
                ->where('cli_sync_1c_status', '!=', 'Трудовой договор приостановлен')
                ->orderBy('cli_name_f', 'asc')
                ->get();
                
         $CompanyDivisions = CompanyDivision::
            where('div_sync_1c', 1)->where('div_disable', 0)
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();

         $EquipmentDocuments = EquipmentDocument::all();

         $equipmentJournal = EquipmentJournal::where('eqj_eq_id', $Equipment->eq_id)->get();


        return view('components/popup/popup_view_equipment', ['Equipment' => $Equipment, 'clients' => $clients, 'CompanyDivisions' => $CompanyDivisions, 'EquipmentStatuses' => $EquipmentStatuses, 'EquipmentTypes' => $EquipmentTypes, 'EquipmentDocuments' => $EquipmentDocuments, 'EquipmentJournal' => $equipmentJournal ])->render();
    }











    public function getPopupdivEditingAdmin(Request $request) {
        $div_id = $request -> div_id;

        $CompanyDivision = CompanyDivision::where('div_id', $div_id)->first();

        $CompanyDivisions = CompanyDivision::
            where('div_sync_1c', 1)->where('div_disable', 0)
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();

        return view('components/popup/popup_divEditingAdmin', ['CompanyDivisions' => $CompanyDivisions, 'CompanyDivision' => $CompanyDivision])->render();
    }



    public function adminEditingDivision(Request $request)
    {
        $div_id = $request->div_id;
        $divParentId = null;
        // Валидация данных
        $validated = $request->validate([
            'div_name_full' => 'required|string|max:255',
            'div_name_short' => 'required|string|max:255',
            'parent_node' => 'nullable|string|max:255',
            'div_parent_id' => 'nullable',
            'div_comment' => 'nullable|string|max:255',

        ]);


        try {
            // Создаем новую запись
            $CompanyDivision = CompanyDivision::where('div_id', $div_id)->first();

            // if ($request->parent_node === "parent_node_yes") {
            //         $parentNode = $request->div_parent_id;
            // }
            // else {
            //     $parentNode = null;
            // }

            if ($validated['parent_node'] !== 'parent_node_no') {
                if ($validated['div_parent_id'] !== null) {
                    (int)$divParentId = $validated['div_parent_id'];
                }
                else if ($CompanyDivision->div_parent_id !== null) {
                    (int)$divParentId = $CompanyDivision->div_parent_id ?? null;
                }
            }

            

            $CompanyDivision->update([
                'div_name_full' => $validated['div_name_full'] ?? null,
                'div_name_short' => $validated['div_name_short'] ?? null,
                'div_parent_id' => $divParentId ?? null,
                'div_comment' => $validated['div_comment'] ?? null,
            ]);

            //cli_sync_1c
            // if ($request->has('cli_sync_1c'))

            // Логируем успешное создание
            Log::info('Данные подразделения изменены', ['div_id' => $CompanyDivision->div_id, 'user' => Auth::id()]);

            // Возвращаем успешный ответ
            return redirect()->back()->with('success', 'Данные подразделения успешно изменены!');

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при изменении подразделения', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при изменении данных подразделения: ' . $e->getMessage()]);
        }
    }


    public function divisionEditingDynamicPost(Request $request) {
        $validator = Validator::make($request->all(), [
                'div_name_full' => 'required|string|min:3|max:255',
                'div_name_short' => 'nullable|string|max:255',
                'div_parent_id' => 'nullable|exists:t_company_division,div_id',
                'parent_node' => 'nullable|string|max:255',
                'div_comment' => 'nullable|string|max:255',
                ], [
                'div_name_full.required' => 'Введите полное название подразделения.',
                'div_name_full.min' => 'Введите полное название подразделения.',
                'div_name_short.required' => 'Введите сокращенное название подразделения .',
                'div_comment.min' => 'Слишком короткий комментарий.',
        ]);
            


        try {
            // Ошибки валидации входных данных
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(), // { field: [messages] }
                ]);
            }

            $div_id = $request->div_id;
            $divParentId = null;
            
            $CompanyDivision = CompanyDivision::where('div_id', $div_id)->first();

            // if ($request->parent_node === "parent_node_yes") {
            //         $parentNode = $request->div_parent_id;
            // }
            // else {
            //     $parentNode = null;
            // }

            if ($request->parent_node !== 'parent_node_no') {
                if ($request->div_parent_id !== null) {
                    (int)$divParentId = $request->div_parent_id;
                }
                else if ($CompanyDivision->div_parent_id !== null) {
                    (int)$divParentId = $CompanyDivision->div_parent_id ?? null;
                }
            }

            

            $CompanyDivision->update([
                'div_name_full' => $request->div_name_full ?? null,
                'div_name_short' => $request->div_name_short ?? null,
                'div_parent_id' => $request->div_parent_id ?? null,
                'div_comment' => $request->div_comment ?? null,
            ]);

            //cli_sync_1c
            // if ($request->has('cli_sync_1c'))

            // Логируем успешное создание
            Log::info('Данные подразделения изменены', ['div_id' => $CompanyDivision->div_id, 'user' => Auth::id()]);

            // Возвращаем успешный ответ
            return response()->json([
                'success'  => true,
                'message'  => 'Новый документ создан успешно!',
            ]);

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при создании документа', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return response()->json([
                'success'  => false,
                'message'  => 'Новый документ создан успешно!'. $e->getMessage(),
            ]);
        }
    }




     public function DeleteDivision(Request $request, $id){
        // $equipmentId = (int)$request->eq_div_id; 
        $Division = CompanyDivision::where('div_id', $id)->first();
       //$Equipment -> delete();
            
       
         if ($request->action_name === 'disable') {
            if ($Division->div_disable === false) {
                $Division->update([
                    'div_disable' => 1
                ]);
                Log::info('Сотрудник удален', [$id, $Division]);
            } else {
                $Division->update([
                    'div_disable' => 0
                ]);
                Log::info('Сотрудник ввостановлен', [$id, $Division]);
            }
        
        }
        else {
            $Division -> delete();
        }
        Log::info('Техника c id удалена', [$id, $Division]);

        return response()->json(["success" => true]);

    }

    public function DeleteDocument(Request $request, $id){
        // $equipmentId = (int)$request->eq_div_id; 
        $Document = EquipmentDocument::where('doc_sup_id', $id)->first();
        
        if ($request->action_name === 'disable') {
            // if ($Document->doc_disable === false) {
            //     $Client->update([
            //         'cli_disable' => 1
            //     ]);
            //     Log::info('Сотрудник удален', [$id, $Client]);
            // } else {
            //     $Client->update([
            //         'cli_disable' => 0
            //     ]);
            //     Log::info('Сотрудник ввостановлен', [$id, $Client]);
            // }
            $Document -> delete();
        }
        else {
            $Document -> delete();
        }
        Log::info('Документ удален', [$id, $Document]);

        return response()->json(["success" => true]);

    }


    public function getPopupEditingDocument(Request $request)
    {
        $doc_sup_id = $request->doc_sup_id;

        $Document = EquipmentDocument::where('doc_sup_id', $doc_sup_id)->first();

        if (!$Document) {
            return response()->json(['error' => 'Документ не найден'], 404);
        }

        $EquipmentProviders = Provider::all();

        return view('components/popup/popup_editingDocument', ['Document'=> $Document,'EquipmentProviders' => $EquipmentProviders,])->render();
    }




    public function editingDocumentForm(Request $request)
    {
        $doc_sup_id = $request->doc_sup_id;

        $validated = $request->validate([
            'doc_sup_name'      => 'required|string|max:255',
            'doc_sup_number'    => 'nullable|string|max:255',
            'doc_sup_date'      => 'nullable|date',
            'doc_sup_comment'   => 'nullable|string|max:255',
            'doc_sup_prov_id'   => 'nullable|integer',
            'doc_sup_prov_name' => 'nullable|string|max:255',
            'doc_sup_import'    => 'nullable|string|max:255',
        ]);

        try {
            $Document = EquipmentDocument::where('doc_sup_id', $doc_sup_id)->first();

            if ($Document) {
                $Document->update([
                    'doc_sup_name'      => $validated['doc_sup_name']      ?? null,
                    'doc_sup_number'    => $validated['doc_sup_number']    ?? null,
                    'doc_sup_date'      => $validated['doc_sup_date']      ?? null,
                    'doc_sup_comment'   => $validated['doc_sup_comment']   ?? null,
                    'doc_sup_prov_id'   => (int)$request->doc_sup_prov_id,
                    'doc_sup_prov_name' => $validated['doc_sup_prov_name'] ?? null,
                    'doc_sup_import'    => $validated['doc_sup_import']    ?? null,
                ]);

                Log::info('Документ изменён', [
                    'doc_sup_id' => $Document->doc_sup_id,
                    'doc_sup_prov_id' => $request->doc_sup_prov_id,
                    'user'       => Auth::id(),
                ]);

                return redirect()->back()->with('success', 'Документ успешно изменён!');
            }

            return redirect()->back()->withErrors(['error' => 'Документ не найден']);

        } catch (\Exception $e) {
            Log::error('Ошибка при редактировании документа', [
                'error' => $e->getMessage(),
                'data'  => $request->all(),
            ]);

            return redirect()->back()->withErrors([
                'error' => 'Ошибка: ' . $e->getMessage(),
            ]);
        }
    }




    public function documentEditingDynamicPost(Request $request) {
        $validator = Validator::make($request->all(), [
                'doc_sup_name' => 'required|string|max:255',
                'doc_sup_number' => 'nullable|integer',
                'doc_sup_date' => 'required|date',
                'doc_sup_comment' => 'nullable|string|max:255',
                'doc_sup_prov_id' => 'required|integer',
                'doc_sup_prov_name' => 'nullable|string|max:255',
                'doc_sup_import' => 'nullable|string|max:255',
                ], [
                'doc_sup_name.required' => 'Введите название документа.',
                'doc_sup_number.min' => 'Введите номер документа.',
                'doc_sup_date.required' => 'Введите дату документа.',
                'doc_sup_date.date' => 'Введите дату документа.',
                'doc_sup_comment.min' => 'Слишком короткий комментарий.',
                'doc_sup_prov_id.required' => 'Выберите поставщика.',
                'doc_sup_prov_name.required' => 'Введите название поставщик.',
        ]);
            


        try {
            // Ошибки валидации входных данных
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(), // { field: [messages] }
                ]);
            }
            $doc_sup_id = $request->doc_sup_id;

             $Document = EquipmentDocument::where('doc_sup_id', $doc_sup_id)->first();
            
            // Создаем новую запись
            if ($Document) {
                $Document->update([
                    'doc_sup_name' => $request->doc_sup_name ?? null,
                    'doc_sup_number' => $request->doc_sup_number ?? null,
                    'doc_sup_date' => $request->doc_sup_date,
                    'doc_sup_comment' => $request->doc_sup_comment ?? null,
                    'doc_sup_prov_id' => (int)$request->doc_sup_prov_id,
                    'doc_sup_prov_name' => $request->doc_sup_prov_name ?? null,
                    'doc_sup_import' => $request->doc_sup_import ?? null,
                ]);

                $Document->doc_sup_prov_id = (int)$request->doc_sup_prov_id;
                $Document->save();
            }
            

            // Логируем успешное создание
            Log::info('Новый документ создан', ['doc_sup_id' => $Document->doc_sup_id, 'doc_sup_prov_id' => $Document->doc_sup_prov_id, 'user' => Auth::id()]);


            // Возвращаем успешный ответ
            return response()->json([
                'success'  => true,
                'message'  => 'Новый документ создан успешно!',
            ]);

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при создании документа', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при добавлении сотрудника: ' . $e->getMessage()]);
        }
    }




    public function getPopupExportEquipment(Request $request)
    {
        return view('components/popup/popup_equipment_export')->render();
    }


    public function getPopupExportEquipmentCurrentIds(Request $request) 
    {
        // $equipments = Equipment::
        // $currentEqsIds = json_decode($request->current_eqs_ids, true);

        $currentEqsIds = $request->input('current_eqs_ids', []);
        $divId = $request->input('div_id');
        $equipments = Equipment::whereIn('eq_id', $currentEqsIds)->get();
        // $html = view('components/data_panel/data_equipment', ['equipments' => $equipments])->render();
        $html = view('components/popup/form_table/eq_form_table', ['items' => $equipments])->render();
    
        return response()->json($html);
        // return view('components/form_table/clients_form_table', ['cli' => $client, 'user' => $user, 'tableType' => $tableType])->render();
    }


    public function providerAddDynamicPost(Request $request) {
        $validator = Validator::make($request->all(), [
                'prov_name' => 'required|string|min:2|max:255',
                'prov_comment' => 'nullable|string',
                'prov_contact_information' => 'nullable|string|max:255',
                ], [
                'prov_name.required' => 'Введите название компании.',
                'prov_name.min' => 'Слишком короткое название.',
        ]);
            
        try {
            // Ошибки валидации входных данных
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(), // { field: [messages] }
                ]);
            }
            
            
            $provider = Provider::create([
                'prov_name' => $request->prov_name,
                'prov_comment' => $request->prov_comment ?? null,
                'prov_contact_information' => $request->prov_contact_information ?? null,
            ]);

            // Логируем успешное создание
            Log::info('Новый поставщик создан', ['provider' => $provider->prov_name, 'user' => Auth::id()]);


            // Возвращаем успешный ответ
            return response()->json([
                'success'  => true,
                'message'  => 'Данные о новом поставщике созданы успешно!',
            ]);

        } catch (\Exception $e) {
            // Логируем ошибку
            Log::error('Ошибка при создании данных поставщика', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ошибка при добавлении поставщика: ' . $e->getMessage()]);
        }
    }


    public function getPopupaddProvider(Request $request)
    {
        return view('components/popup/popup_addProvider')->render();
    }


}
