<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientUserController;
use App\Http\Controllers\Client\ClientTicketController;
use App\Http\Controllers\Client\ClientViewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmailCampaignController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailVariableController;
use App\Http\Controllers\Marketing\ContactMarketingController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\Tools\MessageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Route::group(['prefix' => ''], function () {
    if (!defined("ADMIN_AVATAR_URL")) {
        define('ADMIN_AVATAR_URL', 'http://superadmin.websitetest.co.in/public/uploads/admin_doc/');
    }
    if (!defined("STAFF_AVATAR_URL")) {
        define('STAFF_AVATAR_URL', 'http://127.0.0.1:8001/public/uploads/');
    }
    if (!defined("UPLOAD_URL")) {
        define('UPLOAD_URL', 'http://admin.websitetest.co.in/public/');
    }

});

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('optimize:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    return 'DONE'; //Return anything
});

Route::get('client/register/{id}', [RegisterController::class, 'clientRegister'])->name('clientRegister');
Route::post('client/register/{id}', [RegisterController::class, 'storeClientRegister'])->name('storeClientRegister');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'root'])->name('root');
    Route::get('staff/change_status/{user_id}/{status}/', [StaffController::class, 'status'])->name('staff.change_status');
    Route::resource('staff', StaffController::class);
    Route::get('staff/{id}/{key}/', [StaffController::class, 'userShow'])->name('userShow');
    Route::get('country-state-city', 'CountryStateCityController@index');
    Route::post('get-states-by-country', [FilterController::class, 'getState']);
    Route::post('get-cities-by-state', [FilterController::class, 'getCity']);
    Route::get('lead/change_status/{user_id}/{lead}/', [ClientController::class, 'status'])->name('leads.change_status');
    Route::resource('ticket', TicketController::class);
    Route::get('ticket/change_status/{id}/{type}', [TicketController::class, 'ticketStatus'])->name('ticket.change_status');
    Route::get('ticket/reply/{id}', [TicketController::class, 'reply'])->name('ticket.reply');
    Route::post('ticket/reply', [TicketController::class, 'saveReply'])->name('ticket.saveReply');
    // LEAD & CLIENT ROUTES
    Route::resource('leads', ClientController::class);
    Route::post('leads/changeStatus', [ClientController::class, 'makeClient'])->name('lead.changeStatus');
    Route::post('lead/makeClient', [ClientController::class, 'makeClientUser'])->name('makeClientUser');
    Route::get('lead/{id}/{key}/{type?}', [ClientViewController::class, 'clientShow'])->name('clientShow');
    Route::post('lead/makeClient/update', [ClientController::class, 'makeClientUserUpdate'])->name('makeClientUser.update');
    Route::resource('client', ClientUserController::class, ["name" => "client"]);
    Route::post('lead/sendMail', [ClientViewController::class, 'leadSendMail'])->name('leadSendMail');
    Route::post('lead/uploadKyc', [ClientViewController::class, 'uploadLeadFiles'])->name('uploadLeadFiles');
    Route::get('doc/delete/{id}', [ClientViewController::class, 'deleteUploadDoc'])->name('deleteUploadDoc');
    Route::get('send_verification_mail/{id}', [ClientViewController::class, 'sendVerificationMail'])->name('sendVerificationMail');
    Route::get('doc_remainder_mail/{id}', [ClientViewController::class, 'sendDocumentMail'])->name('sendDocumentMail');
    Route::post('comment/lead', [ClientViewController::class, "saveclientReply"])->name('comments.saveleadreply');
    Route::post('comments/store', [ClientViewController::class, 'commentStore'])->name('commentStore');
    // CLIENT TICKET ROUTES
    Route::resource('client-ticket', ClientTicketController::class, ["name" => "client-ticket"]);
    Route::get('client-ticket/reply/{id}', [ClientTicketController::class, 'reply'])->name('client-ticket.reply');
    Route::post('client-ticket/reply', [ClientTicketController::class, 'saveReply'])->name('client-ticket.saveReply');
    Route::get('client-ticket/admin/reply/{id}', [ClientTicketController::class, 'adminReply'])->name('admin_client-ticket.reply');
    Route::post('client-ticket/admin/reply', [ClientTicketController::class, 'adminsaveReply'])->name('admin_client-ticket.saveReply');
    Route::get('client-ticket/change_status/{id}/{type}', [ClientTicketController::class, 'ticketStatus'])->name('client-ticket.change_status');

    // Email Template Routes
    Route::resource('email', EmailController::class, ["names" => "email"]);
    Route::get('email/change_status/{id}/{type}', [EmailController::class, 'status'])->name('email.change_status');

    // EMAIL CAMPAIGN ROUTES
    Route::resource('email_campaign', EmailCampaignController::class, ["name" => "email_campaign"]);
    Route::get('email_campaign/change_status/{id}/{type}', [EmailCampaignController::class, 'status'])->name('email_campaign.change_status');
    // CONTACT MARKETING ROUTE
    Route::resource('contact', ContactController::class, ['name' => 'contact']);
    Route::get('/contact/{id}/{key}/{type?}', [ContactMarketingController::class, 'index'])->name('contactEmail');
    Route::post('get_email_template', [ContactMarketingController::class, 'getTemplate'])->name('getTemplate');
    Route::post('contact/conversation', [ContactMarketingController::class, 'conversationStore'])->name('conversationStore');

    /*========================= TOOLS MODULE START ============================== */
    // MESSAGE MODULE
    Route::resource('messages', MessageController::class, ["name" => "messages"]);
    Route::post('messages/admin', [MessageController::class, "saveadminReply"])->name('messages.saveadminreply');
    Route::post('messages/staff', [MessageController::class, "saveReply"])->name('messages.savereply');
    Route::get('messages/search_user/{key}', [MessageController::class, 'searchUser']);
    // NOTES MODULE
    Route::resource('note', NoteController::class);
    // TODO MODULE
    Route::resource('todo', TodoController::class);
    // CALENDER MODULE
    Route::resource('calendar', CalenderController::class, ['name' => 'calendar']);
    Route::get('calendar/event/create', [CalenderController::class, 'eventCreate'])->name('calendar.event.create');
    Route::post('calendar/event/store', [CalenderController::class, 'eventStore'])->name('calendar.event.store');
    Route::get('calendar/event/edit/{id}', [CalenderController::class, 'eventEdit'])->name('calendar.event.edit');
    Route::post('calendar/event/update/{id}', [CalenderController::class, 'eventUpdate'])->name('calendar.event.update');
    Route::delete('calendar/event/delete/{id}', [CalenderController::class, 'eventDestroy'])->name('calendar.event.delete');
    Route::get('calendar/appointment/create', [CalenderController::class, 'appointmentCreate'])->name('calendar.appointment.create');
    Route::post('calendar/appointment/store', [CalenderController::class, 'appointmentStore'])->name('calendar.appointment.store');
    Route::get('calendar/appointment/edit/{id}', [CalenderController::class, 'appointmentEdit'])->name('calendar.appointment.edit');
    Route::post('calendar/appointment/update/{id}', [CalenderController::class, 'appointmentUpdate'])->name('calendar.appointment.update');
    Route::delete('calendar/appointment/delete/{id}', [CalenderController::class, 'appointmentDestroy'])->name('calendar.appointment.delete');

    /*========================= TOOLS MODULE END ============================== */

    /*========================= EXPORT ROUTES START =========================== */

    Route::get('/import/leads', [ClientUserController::class, 'importView'])->name('import.leads.view');
    Route::post('/importLeads', [ClientUserController::class, 'importLeads'])->name('import.leads');
    Route::get('/export-leads', [ClientUserController::class, 'exportLeads'])->name('export.leads');

    /*========================= EXPORT ROUTES END =========================== */

    /*========================= SETTINGS ROUTES START =========================== */

    // SETTINGS ROUTES
    Route::get('/setting/{key}', [GeneralSettingController::class, 'index']);
    Route::post('/setting/{key}', [GeneralSettingController::class, 'store'])->name('setting.store');

    Route::post('email-configuration/store', [GeneralSettingController::class, 'emailConfiguration'])->name('emailConfiguration.store');

    /*========================= SETTINGS ROUTES END =========================== */
    // Route::get('/', App\Http\Livewire\MailVariable\ListMailVariable::class);
    Route::resource('mail_variables', MailVariableController::class, ["names" => "mail_variables"]);
    Route::post('send_test_mail', [EmailController::class, "sendTestMail"])->name('sendTestMail');
    //Update User Details
    Route::get('profile', [HomeController::class, 'contactProfile'])->name('contactProfile');
    Route::post('/update-lead-profile/{id}', [ClientController::class, 'updateLeadProfile'])->name('updateLeadProfile');
    Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');

    Route::get('{any}', [HomeController::class, 'index'])->name('index');
    // Route::get('leads',[ClientController::class,'index'])->name('leads.index');

    //Language Translation
    Route::get('index/{locale}', [HomeController::class, 'lang']);
});
