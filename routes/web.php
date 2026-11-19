<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\EquipmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
///});

Route::get('/professions', [RequestController::class, 'getProfessions'])->name('getProfessions');

//вывод информации о сотруднике в нижней панели
Route::get('/clientInfo', [RequestController::class, 'getClientInfo'])->name('getClientInfo');

// для теста всплывающих
//Route::get('/popup-content', [RequestController::class, 'getPopupContent'])->name('popup.content');

//для поисковака
Route::get('/search', [RequestController::class, 'search'])->name('search');
Route::get('/searchFormItems', [RequestController::class, 'searchFormItems'])->name('searchFormItems');

//для авторизации
Route::get('/loginForm', [LoginController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/registerForm', [LoginController::class, 'showRegisterForm'])->name('registerForm');
Route::post('/registerForm/AddUserDynamicPost', [LoginController::class, 'AddUserDynamicPost'])->name('AddUserDynamicPost');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/profile', [LoginController::class, 'profile'])->name('profile');
Route::patch('/profile', [LoginController::class, 'updateProfile'])->name('updateProfile');
Route::get('/change-password', [LoginController::class, 'changePasswordForm'])->name('changePasswordForm');
Route::post('/change-password', [LoginController::class, 'changePassword'])->name('changePassword');

Route::post('/importCSV', [ImportController::class, 'import'])->name('import');


Route::get('/', [RequestController::class, 'index'])->name('index');
Route::get('/test', [RequestController::class, 'test']);
Route::get('/directorPage', [RequestController::class, 'directorPage'])->name('directorPage');
Route::get('/equipmentPage', [RequestController::class, 'equipmentPage'])->name('equipmentPage');
Route::get('/adminPage', [RequestController::class, 'adminPage'])->name('adminPage');
Route::get('/documentsPage', [RequestController::class, 'documentsPage'])->name('documentsPage');
// ->middleware('banned.ip');

//вывод информации в отделах и подотделах УЧЕТА ТЕХНИКИ
Route::get('/EquipmentsTableInfo', [RequestController::class, 'getEquipmentsTableInfo'])->name('getEquipmentsTableInfo');
Route::get('/EquipmentInfo', [RequestController::class, 'getEquipmentInfo'])->name('getEquipmentInfo');


Route::get('/Popup1Сimport', [RequestController::class, 'getPopup1Сimport'])->name('getPopup1Сimport');
Route::get('/PopupLogin', [RequestController::class, 'getPopupLogin'])->name('getPopupLogin');
Route::post('/PopupLogin/loginDynamicValidation', [LoginController::class, 'loginDynamicValidation'])->name('loginDynamicValidation');
Route::get('/PopupUserInfo', [PageController::class, 'getPopupUserInfo'])->name('getPopupUserInfo');
Route::get('/InnerPopupEditUserData', [PageController::class, 'getInnerPopupEditUserData'])->name('getInnerPopupEditUserData');
Route::post('/editUserData', [PageController::class, 'editUserData'])->name('editUserData');

Route::get('/PopupMessage', [RequestController::class, 'getPopupMessage'])->name('getPopupMessage');

Route::get('/PopupaddEquipment', [RequestController::class, 'getPopupaddEquipment'])->name('getPopupaddEquipment');
Route::get('/PopupActionEquipment', [RequestController::class, 'getPopupActionEquipment'])->name('getPopupActionEquipment');
Route::post('/newEquipmentActionStatus', [RequestController::class, 'newEquipmentActionStatus'])->name('newEquipmentActionStatus');
Route::post('/PopupActionEquipment/newEquipmentActionStatusDynamicPost', [RequestController::class, 'newEquipmentActionStatusDynamicPost'])->name('newEquipmentActionStatusDynamicPost');
Route::get('/PopupparametersEquipment', [RequestController::class, 'getPopupparametersEquipment'])->name('getPopupparametersEquipment');

Route::get('/getEquipmentForAction', [RequestController::class, 'getEquipmentForAction'])->name('getEquipmentForAction');

//для удаления техники
Route::post('/DeleteEquipment/{id}', [RequestController::class, 'DeleteEquipment'])->name('DeleteEquipment');
//для редактирования техники 
Route::post('/EditEquipment', [RequestController::class, 'EditEquipment'])->name('EditEquipment');

Route::get('/searchEquipment', [RequestController::class, 'searchEquipment'])->name('searchEquipment');

//для удаления сотрудников
//Route::post('/DeleteEquipment/{id}', [RequestController::class, 'DeleteEquipment'])->name('DeleteEquipment');


Route::post('/adminAddDivision', [RequestController::class, 'adminAddDivision'])->name('adminAddDivision');

//для добавления сотрудников
Route::get('/PopupaddAdmin', [RequestController::class, 'getPopupaddAdmin'])->name('getPopupaddAdmin');
//для удаления техники
Route::post('/DeleteAdmin/{id}', [RequestController::class, 'DeleteAdmin'])->name('DeleteAdmin');
//для редактирования техники 
Route::post('/EditAdmin', [RequestController::class, 'EditAdmin'])->name('EditAdmin');
//для всплывающего окна для добавления в учете техники
Route::post('/equipmentAddPanel', [RequestController::class, 'equipmentAddPanel'])->name('equipmentAddPanel');
Route::post('/PopupaddEquipment/equipmentAddDynamicPost', [RequestController::class, 'equipmentAddDynamicPost'])->name('equipmentAddDynamicPost');

//для всплывающего окна для добавления в Админ панели
Route::post('/adminAddPanel', [RequestController::class, 'adminAddPanel'])->name('adminAddPanel');
//для фильтра в учете техники
Route::get('/equipmentFilter', [RequestController::class, 'filter'])->name('equipmentFilter');
Route::get('/clientFilter', [RequestController::class, 'clientFilter'])->name('clientFilter');
//для отмены или добавления(крестити и галочки) в учете техники
Route::post('/changeClient1cStatus', [RequestController::class, 'changeClient1cStatus'])->name('changeClient1cStatus');

Route::get('/PopupAddDivision', [RequestController::class, 'getPopupAddDivision'])->name('getPopupAddDivision');



Route::get('/PopupSupport', [TestController::class, 'getPopupSupport'])->name('getPopupSupport');
Route::get('/RequestsPage', [TestController::class, 'requestsPage'])->name('requestsPage');

//для нижней понели в документах
Route::get('/DocumentInfo', [RequestController::class, 'getDocumentInfo'])->name('getDocumentInfo');


// Route::middleware(['windows.auth'])->group(function () {
//     Route::get('/adminPage', [RequestController::class, 'adminPage'])->name('adminPage');
// });
Route::get('/PopupaddDocument', [RequestController::class, 'getPopupaddDocument'])->name('getPopupaddDocument');

Route::post('/DocumentAddPanel', [RequestController::class, 'DocumentAddPanel'])->name('DocumentAddPanel');

Route::get('/PopupeditingAdminForm', [RequestController::class, 'getPopupeditingAdminForm'])->name('getPopupeditingAdminForm');

Route::post('/PopupeditingAdminForm/editingAdminDynamicPost', [RequestController::class, 'editingAdminDynamicPost'])->name('editingAdminDynamicPost');

Route::post('/editingAdminForm', [RequestController::class, 'editingAdminForm'])->name('editingAdminForm');

Route::get('/searchDocument', [RequestController::class, 'searchDocument'])->name('searchDocument');

Route::get('/InnerPopupSync1c', [RequestController::class, 'getInnerPopupSync1c'])->name('getInnerPopupSync1c');

Route::post('/editingEquipmentForm', [RequestController::class, 'editingEquipmentForm'])->name('editingEquipmentForm');


Route::get('/PopupeditingEquipmentForm', [RequestController::class, 'getPopupeditingEquipmentForm'])->name('getPopupeditingEquipmentForm');



Route::get('/PopupdivEditingAdmin', [RequestController::class, 'getPopupdivEditingAdmin'])->name('getPopupdivEditingAdmin');
Route::post('/adminEditingDivision', [RequestController::class, 'adminEditingDivision'])->name('adminEditingDivision');

Route::post('/DeleteDivision/{id}', [RequestController::class, 'DeleteDivision'])->name('DeleteDivision');

Route::get('/PopupEditingDocument', [RequestController::class, 'getPopupEditingDocument'])->name('getPopupEditingDocument');
Route::post('/editingDocumentForm', [RequestController::class, 'editingDocumentForm'])->name('editingDocumentForm');
Route::post('/DeleteDocument/{id}', [RequestController::class, 'DeleteDocument'])->name('DeleteDocument');

Route::post('/PopupaddAdmin/adminAddDynamicPost', [RequestController::class, 'adminAddDynamicPost'])->name('adminAddDynamicPost');

Route::post('/PopupeditingEquipment/equipmentEditingDynamicPost', [RequestController::class, 'equipmentEditingDynamicPost'])->name('equipmentEditingDynamicPost');

Route::post('/PopupaddDocument/documentAddDynamicPost', [RequestController::class, 'documentAddDynamicPost'])->name('documentAddDynamicPost');

Route::post('/PopupeditingDocument/documentEditingDynamicPost', [RequestController::class, 'documentEditingDynamicPost'])->name('documentEditingDynamicPost');

Route::post('/PopupaddDivision/divisionAddDynamicPost', [RequestController::class, 'divisionAddDynamicPost'])->name('divisionAddDynamicPost');

Route::post('/PopupeditingDivision/divisionEditingDynamicPost', [RequestController::class, 'divisionEditingDynamicPost'])->name('divisionEditingDynamicPost');

Route::get('/PopupViewEquipment', [RequestController::class, 'getPopupViewEquipment'])->name('getPopupViewEquipment');
Route::post('/ViewEquipmentForm', [RequestController::class, 'ViewEquipmentForm'])->name('ViewEquipmentForm');

// PopupExportEquipment
Route::get('/PopupExportEquipment', [RequestController::class, 'getPopupExportEquipment'])->name('getPopupExportEquipment');
Route::post('/PopupExportEquipment/getCurrentEqIds', [RequestController::class, 'getPopupExportEquipmentCurrentIds'])->name('getPopupExportEquipmentCurrentIds');

// Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
Route::get('/PopupExportEquipment/export', [EquipmentController::class, 'export'])->name('equipment.export');


Route::get('/PopupaddProvider', [RequestController::class, 'getPopupaddProvider'])->name('getPopupaddProvider');
Route::post('/PopupaddProvider/providerAddDynamicPost', [RequestController::class, 'providerAddDynamicPost'])->name('providerAddDynamicPost');
// Route::get('/' '')