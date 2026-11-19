<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Client67
 *
 * @property int $cli_id
 * @property string|null $cli_name_f
 * @property string|null $cli_name_i
 * @property string|null $cli_name_o
 * @property string|null $cli_name_view
 * @property string|null $cli_prof
 * @property int|null $cli_div_id
 * @property string|null $cli_email
 * @property string|null $cli_tel_work
 * @property string|null $cli_tel_work2
 * @property string|null $cli_tel_mobile
 * @property \Illuminate\Support\Carbon|null $cli_date_born
 * @property string|null $cli_comment
 * @property bool|null $cli_disable
 * @property \Illuminate\Support\Carbon|null $cli_date_create
 * @property \Illuminate\Support\Carbon|null $cli_date_change
 * @property bool|null $cli_sex
 * @property bool|null $cli_pregnant
 * @property bool|null $cli_sync_1c
 * @property string|null $cli_sync_1c_code
 * @property string|null $cli_sync_1c_division_code
 * @property bool|null $cli_sync_1c_apply
 * @property bool|null $cli_sync_1c_is_division_head
 * @property string|null $cli_sync_1c_category
 * @property string|null $cli_sync_1c_status
 * @property string|null $cli_sync_1c_employment_type
 * @property \Illuminate\Support\Carbon|null $cli_sync_1c_hire_date
 * @property string|null $cli_sync_AD
 * @property string|null $cli_sync_1c_id
 * @property-read \App\Models\CompanyDivision|null $division
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliDateBorn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliDateChange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliDateCreate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliDisable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliDivId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliNameF($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliNameI($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliNameO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliNameView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliPregnant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliProf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliSync1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliSync1cApply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliSync1cCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliSync1cCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliSync1cDivisionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliSync1cEmploymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliSync1cHireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliSync1cId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliSync1cIsDivisionHead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliSync1cStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliSyncAD($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliTelMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliTelWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client67 whereCliTelWork2($value)
 */
	class Client67 extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CompanyDivision42
 *
 * @property int $div_id
 * @property int|null $div_parent_id
 * @property string|null $div_name_full
 * @property string|null $div_name_short
 * @property string|null $div_comment
 * @property int|null $div_disable
 * @property string|null $div_date_create
 * @property string|null $div_date_change
 * @property int|null $div_sync_1c
 * @property string|null $div_sync_1c_code
 * @property string|null $div_sync_1c_parent_code
 * @property int|null $div_sync_1c_apply
 * @property int|null $div_check_subdivision
 * @property int|null $div_send_mail_apply
 * @property int|null $div_lock
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompanyDivision> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Client> $employees
 * @property-read int|null $employees_count
 * @property-read \App\Models\CompanyDivision|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivCheckSubdivision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivDateChange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivDateCreate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivDisable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivLock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivNameFull($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivNameShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivSendMailApply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivSync1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivSync1cApply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivSync1cCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyDivision42 whereDivSync1cParentCode($value)
 */
	class CompanyDivision42 extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Equipment
 *
 * @property int $eq_id
 * @property int|null $eq_status_id
 * @property int|null $eq_type_id
 * @property string|null $eq_name
 * @property string|null $eq_serial_number
 * @property string|null $eq_inventory_number
 * @property string|null $eq_cart_number
 * @property int|null $eq_div_id
 * @property int|null $eq_client_id
 * @property string|null $eq_comment
 * @property string|null $import_div
 * @property string|null $import_client
 * @property string|null $import_type
 * @property string|null $import_doc
 * @property string|null $import_comment
 * @property \Illuminate\Support\Carbon|null $date_create
 * @property \Illuminate\Support\Carbon|null $date_change
 * @property int|null $eq_doc_supply_id
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\CompanyDivision|null $division
 * @property-read \App\Models\EquipmentStatus|null $equipmentStatus
 * @property-read \App\Models\EquipmentType|null $equipmentType
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereDateChange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereDateCreate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEqCartNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEqClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEqComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEqDivId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEqDocSupplyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEqId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEqInventoryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEqName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEqSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEqStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereEqTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereImportClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereImportComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereImportDiv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereImportDoc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment whereImportType($value)
 */
	class Equipment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EquipmentDocument
 *
 * @property int $doc_sup_id
 * @property string|null $doc_sup_name
 * @property int|null $doc_sup_number
 * @property string|null $doc_sup_date
 * @property string|null $doc_sup_comment
 * @property int|null $doc_sup_prov_id
 * @property string|null $doc_sup_prov_name
 * @property string|null $doc_sup_import
 * @property-read \App\Models\Provider|null $provider
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentDocument whereDocSupComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentDocument whereDocSupDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentDocument whereDocSupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentDocument whereDocSupImport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentDocument whereDocSupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentDocument whereDocSupNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentDocument whereDocSupProvId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentDocument whereDocSupProvName($value)
 */
	class EquipmentDocument extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EquipmentJournal
 *
 * @property int $eqj_id
 * @property int|null $eqj_eq_id
 * @property string|null $eqj_datetime
 * @property string|null $eqj_status
 * @property int|null $eqj_cli_id
 * @property string|null $eqj_comment
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\Equipment|null $equipment
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentJournal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentJournal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentJournal query()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentJournal whereEqjCliId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentJournal whereEqjComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentJournal whereEqjDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentJournal whereEqjEqId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentJournal whereEqjId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentJournal whereEqjStatus($value)
 */
	class EquipmentJournal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EquipmentStatus
 *
 * @property int $eqs_id
 * @property string|null $eqs_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Equipment> $equipment
 * @property-read int|null $equipment_count
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentStatus whereEqsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentStatus whereEqsName($value)
 */
	class EquipmentStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EquipmentType
 *
 * @property int $eqt_id
 * @property string|null $eqt_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Equipment> $equipment
 * @property-read int|null $equipment_count
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType query()
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType whereEqtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EquipmentType whereEqtName($value)
 */
	class EquipmentType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Provider
 *
 * @property int $prov_id
 * @property string|null $prov_name
 * @property string|null $prov_comment
 * @property string|null $prov_contact_information
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EquipmentDocument> $EquipmentDocument
 * @property-read int|null $equipment_document_count
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereProvComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereProvContactInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereProvId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereProvName($value)
 */
	class Provider extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $u_id
 * @property int|null $u_t_client_id
 * @property string $u_login
 * @property string $u_password
 * @property string|null $u_email
 * @property string|null $u_ad_pc_name
 * @property string|null $u_ad_user_name
 * @property string $u_role
 * @property int $u_authorized
 * @property bool $u_sync_AD
 * @property bool $u_disabled
 * @property bool $u_sync_1c
 * @property \Illuminate\Support\Carbon|null $u_updated_at
 * @property \Illuminate\Support\Carbon|null $u_created_at
 * @property string|null $remember_token
 * @property string|null $current_session_id
 * @property-read \App\Models\Client|null $client
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUAdPcName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUAdUserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUAuthorized($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereULogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereURole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUSync1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUSyncAD($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUTClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

