<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CoingateController;
use App\Http\Controllers\FormCommentsReplyControllerController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormValueController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailTempleteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaytmController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormCommentsController;
use App\Http\Controllers\FormCommentsReplyController;
use App\Http\Controllers\DashboardWidgetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MercadoController;
use App\Http\Controllers\RequestuserController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\SmsTemplateController;

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

Auth::routes(['verify' => true]);
Route::group(['middleware' =>  ['auth', 'verified', 'xss']], function () {
    Route::resource('mailtemplate', MailTempleteController::class);
});
Auth::routes();

// 'verified_phone'  middleware
Route::group(['middleware' => ['auth', 'xss', 'verified', '2fa']], function () {
    Route::resource('profile', '\App\Http\Controllers\ProfileController');
    Route::resource('users', '\App\Http\Controllers\UserController');
    Route::resource('permission', '\App\Http\Controllers\PermissionController');
    Route::resource('roles', '\App\Http\Controllers\RoleController');
    Route::resource('module', '\App\Http\Controllers\ModuleController');
    Route::resource('formvalues', '\App\Http\Controllers\FormValueController');
    Route::resource('forms', '\App\Http\Controllers\FormController');

    Route::resource('poll', '\App\Http\Controllers\PollController');

    Route::get('change-language/{lang}', '\App\Http\Controllers\LanguageController@changeLanquage')->name('change.language');
    Route::get('manage-language/{lang}', '\App\Http\Controllers\LanguageController@manageLanguage')->name('manage.language');
    Route::post('store-language-data/{lang}', '\App\Http\Controllers\LanguageController@storeLanguageData')->name('store.language.data');
    Route::get('create-language', '\App\Http\Controllers\LanguageController@createLanguage')->name('create.language');
    Route::post('store-language', '\App\Http\Controllers\LanguageController@storeLanguage')->name('store.language');
    Route::delete('/lang/{lang}', '\App\Http\Controllers\LanguageController@destroyLang')->name('lang.destroy');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Route::get('/', [HomeController::class, 'landingPage'])->name('landingpage');

    Route::get('/leads/order', [HomeController::class, 'leadsorder'])->name('leads.order');
    Route::post('/chart', [HomeController::class, 'formchart'])->name('get.chart.data')->middleware(['auth', 'Setting', 'xss']);
});

//sms
Route::group(['middleware' => ['Setting', 'xss']], function () {
    Route::get('sms/notice', [SmsController::class, 'smsnoticeindex'])->name('smsindex.noticeverification');
    Route::post('sms/notice', [SmsController::class, 'smsnoticeverify'])->name('sms.noticeverification');

    Route::get('sms/verify', [SmsController::class, 'smsindex'])->name('smsindex.verification');
    Route::post('sms/verify', [SmsController::class, 'smsverify'])->name('sms.verification');

    Route::post('sms/verifyresend', [SmsController::class, 'smsresend'])->name('sms.verification.resend');
});

//sms
Route::resource('sms-template', SmsTemplateController::class);
Route::post('settings/sms-setting/update', [SettingsController::class, 'smsSettingUpdate'])->name('settings/sms-setting/update');

Route::group(['middleware' => ['Setting', 'xss']], function () {
    Auth::routes(['verify' => true]);

    Route::get('/register/{lang?}', [RegisterController::class, 'index'])->name('register');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::get('/login/{lang?}', [LoginController::class, 'showLoginForm'])->name('login');

    Route::post('contact_mail', [RequestuserController::class, 'contact_mail'])->name('contact.mail');
    Route::get('contact-us', [RequestuserController::class, 'contactus'])->name('contactus');
    Route::get('faq', [RequestuserController::class, 'faq'])->name('faq');
    Route::get('privacy-policy', [RequestuserController::class, 'privacypolicy'])->name('privacypolicy');
    Route::get('terms-conditions', [RequestuserController::class, 'termsandconditions'])->name('termsandconditions');
});

Route::resource('faqs', FaqController::class)->middleware(['Setting', 'auth', 'xss']);
// Route::get('/faqs/{id}', [FaqController::class, 'faqspaginate'])->name('faqs.paginate')->middleware(['auth', 'xss']);

Route::resource('comment', '\App\Http\Controllers\CommentsController')->middleware(['xss']);
Route::resource('comment_reply', '\App\Http\Controllers\CommentsReplyController')->middleware(['xss']);
Route::resource('form_comment', FormCommentsController::class);
Route::resource('form_comment_reply', FormCommentsReplyController::class);

//dashboard
Route::get('index-dashboard', '\App\Http\Controllers\HomeController@indexdashboard')->name('index.dashboard')->middleware(['xss','auth']);

Route::get('create-dashboard', '\App\Http\Controllers\HomeController@createdashboard')->name('create.dashboard')->middleware(['xss','auth']);
Route::post('store-dashboard', '\App\Http\Controllers\HomeController@storedashboard')->name('store.dashboard')->middleware(['xss','auth']);

Route::get('edit-dashboard/{id}/edit', '\App\Http\Controllers\HomeController@editdashboard')->name('edit.dashboard')->middleware(['xss','auth']);
Route::put('update-dashboard/{id}', '\App\Http\Controllers\HomeController@updatedashboard')->name('update.dashboard')->middleware(['xss','auth']);

Route::delete('delete-dashboard/{id}', '\App\Http\Controllers\HomeController@deletedashboard')->name('delete.dashboard')->middleware(['xss','auth']);

Route::post('/updatedash/dashboard', [HomeController::class, 'updatedash'])->name('updatedash.dashboard')->middleware(['xss','auth']);

Route::post('/widget/chnages', [HomeController::class, 'WidgetChnages'])->name('widget.chnages')->middleware(['xss','auth']);
Route::post('/widget/chartdata', [DashboardWidgetController::class, 'WidgetChartData'])->name('widget.chartdata')->middleware(['xss','auth']);

Route::get('/form-values/{id}/download/pdf', ['as' => 'download.form.values.pdf', 'uses' => '\App\Http\Controllers\FormValueController@download_pdf']);

Route::get('update-avatar/{id}', [
    'as' => 'update-avatar',
    'uses' => '\App\Http\Controllers\ProfileController@showAvatar'
]);
Route::get('design/{id}', [
    'as' => 'forms.design',
    'uses' => '\App\Http\Controllers\FormController@design'
])->middleware(['auth', 'xss']);
Route::put('/forms/design/{id}', ['as' => 'forms.design.update', 'uses' => '\App\Http\Controllers\FormController@designUpdate'])->middleware(['auth', 'xss']);

Route::post('update-avatar/{id}', '\App\Http\Controllers\ProfileController@updateAvatar');

Route::post('update-profile-login/{id}', [
    'uses' => '\App\Http\Controllers\ProfileController@updateLogin',
    'as' => 'update-login',
]);
Route::get('account-status/{id}', '\App\Http\Controllers\UserController@accountStatus')->name('account.status')->middleware(['auth']);
Route::get('users/verified/{id}', '\App\Http\Controllers\UserController@useremailverified')->name('user.verified')->middleware(['auth']);
Route::get('users/phoneverified/{id}', '\App\Http\Controllers\UserController@userphoneverified')->name('user.phoneverified')->middleware(['auth']);
Route::get('profile-status', '\App\Http\Controllers\ProfileController@profileStatus')->name('profile.status')->middleware(['auth']);
Route::post('profile/update/{id}', '\App\Http\Controllers\ProfileController@update')->name('profile.update')->middleware(['auth']);

Route::get('/forms/fill/{id}', ['as' => 'forms.fill', 'uses' => '\App\Http\Controllers\FormController@fill'])->middleware(['auth']);
Route::get('/forms/survey/{id}', ['as' => 'forms.survey', 'uses' => '\App\Http\Controllers\FormController@publicFill']);
Route::get('/forms/qr/{id}', ['as' => 'forms.survey.qr', 'uses' => '\App\Http\Controllers\FormController@qrCode']);
Route::put('/forms/fill/{id}', ['as' => 'forms.fill.store', 'uses' => '\App\Http\Controllers\FormController@fillStore']);
Route::get('/form-values/{id}/edit', ['as' => 'edit.form.values', 'uses' => '\App\Http\Controllers\FormValueController@edit'])->middleware(['auth']);
Route::get('/form-values/{id}/view', ['as' => 'view.form.values', 'uses' => '\App\Http\Controllers\FormValueController@showSubmitedForms'])->middleware(['auth', 'xss']);
Route::post('/form-duplicate', ['as' => 'forms.duplicate', 'uses' => '\App\Http\Controllers\FormController@duplicate'])->middleware(['auth', 'xss']);
Route::get('/form-values/{id}/download/csv2', ['as' => 'download.form.values.csv2', 'uses' => '\App\Http\Controllers\FormValueController@download_csv_2'])->middleware(['auth', 'xss']);
Route::post('/mass/export/xlsx', ['as' => 'mass.export.xlsx', 'uses' => '\App\Http\Controllers\FormValueController@export_xlsx'])->middleware(['auth', 'xss']);
Route::post('/mass/export/csv', ['as' => 'mass.export.csv', 'uses' => '\App\Http\Controllers\FormValueController@export'])->middleware(['auth', 'xss']);

Route::get('/settings', [SettingsController::class, 'index'])->name('settings')->middleware(['xss']);
Route::get('/test-mail', [SettingsController::class, 'testMail'])->name('test.mail');

//poll system
Route::get('/poll/fill/{id}', [PollController::class, 'poll'])->name('poll.fill')->middleware(['auth', 'xss']);
Route::post('/poll/store/{id}', [PollController::class, 'fillStore'])->name('fill.poll.store')->middleware(['xss']);
Route::post('image/poll/store/{id}', [PollController::class, 'ImageStore'])->name('image.poll.store')->middleware(['xss']);
Route::post('meeting/poll/store/{id}', [PollController::class, 'MeetingStore'])->name('meeting.poll.store')->middleware(['xss']);
Route::get('/poll/image/fill/{id}', [PollController::class, 'ImagePoll'])->name('image.poll.fill')->middleware(['auth', 'xss']);
Route::get('/poll/meeting/fill/{id}', [PollController::class, 'MeetingPoll'])->name('meeting.poll.fill')->middleware(['auth', 'xss']);

Route::get('/poll/result/{id}', [PollController::class, 'PollResult'])->name('poll.result')->middleware(['auth', 'xss']);
Route::get('/poll/image/result/{id}', [PollController::class, 'PollImageResult'])->name('poll.image.result')->middleware(['auth', 'xss']);
Route::get('/poll/meeting/result/{id}', [PollController::class, 'PollMeetingResult'])->name('poll.meeting.result')->middleware(['auth', 'xss']);

Route::get('/poll/survey/{id}', [PollController::class, 'publicFill'])->name('poll.survey')->middleware(['xss']);
Route::get('/poll/survey/meeting/{id}', [PollController::class, 'PublicFillMeeting'])->name('poll.survey.meeting')->middleware(['xss']);
Route::get('/poll/survey/image/{id}', [PollController::class, 'PublicFillImage'])->name('poll.survey.image')->middleware(['xss']);
Route::get('/poll/share/{id}', [PollController::class, 'Share'])->name('poll.share');
Route::get('/qr/share/{id}', [PollController::class, 'ShareQr'])->name('poll.share.qr');

Route::get('/poll/share/image/{id}', [PollController::class, 'ShareImage'])->name('poll.share.image');
Route::get('/qr/share/image/{id}', [PollController::class, 'ShareQrImage'])->name('poll.share.qr.image');

Route::get('/poll/share/meeting/{id}', [PollController::class, 'ShareMeeting'])->name('poll.share.meeting');
Route::get('/qr/share/meeting/{id}', [PollController::class, 'ShareQrMeeting'])->name('poll.share.qr.meeting');

Route::get('/poll/shares/{id}', [PollController::class, 'Shares'])->name('poll.shares');
Route::get('/poll/shares/meetings/{id}', [PollController::class, 'ShareMeetings'])->name('poll.shares.meetings');
Route::get('/poll/shares/images/{id}', [PollController::class, 'ShareImages'])->name('poll.shares.images');
Route::get('/poll/public/result/{id}', [PollController::class, 'PublicFillResult'])->name('poll.public.result');
Route::get('/meeting/public/result/{id}', [PollController::class, 'PublicFillResultMeeting'])->name('poll.public.result.meeting');
Route::get('/image/public/result/{id}', [PollController::class, 'PublicFillResultImage'])->name('poll.public.result.image');

Route::post('settings/app-name/update', [
    'as' => 'settings/app-name/update',
    'uses' => '\App\Http\Controllers\SettingsController@appNameUpdate',
])->middleware(['auth', 'xss']);
Route::post('settings/app-logo/update', [
    'as' => 'settings/app-logo/update',
    'uses' => '\App\Http\Controllers\SettingsController@appLogoUpdate',
])->middleware(['auth', 'xss']);

Route::post('settings/pusher-setting/update', [
    'as' => 'settings/pusher-setting/update',
    'uses' => '\App\Http\Controllers\SettingsController@pusherSettingUpdate',
])->middleware(['auth', 'xss']);

Route::post('settings/wasabi-setting/update', [
    'as' => 'settings/wasabi-setting/update',
    'uses' => '\App\Http\Controllers\SettingsController@wasabiSettingUpdate',
])->middleware(['auth', 'xss']);
Route::post('settings/captcha-setting/update', [
    'as' => 'settings/captcha-setting/update',
    'uses' => '\App\Http\Controllers\SettingsController@captchaSettingUpdate',
])->middleware(['auth', 'xss']);

Route::post('filter-chart/{id}', [FormValueController::class, 'getGraphData'])->name('filter_chart');

Route::post('settings/email-setting/update', [
    'as' => 'settings/email-setting/update',
    'uses' => '\App\Http\Controllers\SettingsController@emailSettingUpdate',
])->middleware(['auth', 'xss']);

Route::post('settings/auth-settings/update', [
    'as' => 'settings/auth-settings/update',
    'uses' => '\App\Http\Controllers\SettingsController@authSettingsUpdate',
])->middleware(['auth', 'xss']);

Route::post('test-mail', '\App\Http\Controllers\SettingsController@testSendMail')->name('test.send.mail');
Route::get('setting/{id}', [
    'as' => 'setting',
    'uses' => '\App\Http\Controllers\SettingsController@loadsetting'
])->middleware(['auth', 'xss']);

Route::resource('role', '\App\Http\Controllers\RoleController');
Route::post('/role-permission/{id}', [
    'as' => 'roles_permit',
    'uses' => '\App\Http\Controllers\RoleController@assignPermission',
]);

Route::get('/invisible', function () {
    return view('invisible');
});
Route::post('/invisible', function (Request $request) {
    $request->validate([
        'g-recaptcha-response' => 'required|captcha'
    ]);

    return 'Data is valid';
});

// mercado form
Route::post('mercado/fill/prepare', [MercadoController::class, 'mercadofillPaymentPrepare'])->name('mercadofillprepare');
Route::get('mercado-fill-payment/{id}', [MercadoController::class, 'mercadofillPlanGetPayment'])->name('mercadofillcallback');

Route::post('paytm-payment', '\App\Http\Controllers\PaytmController@paytmPayment')->name('paytm.payment')->middleware(['Setting']);
Route::post('/paytm-callback', '\App\Http\Controllers\PaytmController@paytmCallback')->name('paytm.callback')->middleware(['Setting']);

Route::post('coingateprepare', [CoingateController::class, 'coingatePaymentPrepare'])->name('coingateprepare')->middleware(['Setting']);
Route::get('coingate-payment/{id}', [CoingateController::class, 'coingatePlanGetPayment'])->name('coingatecallback')->middleware(['Setting']);

Route::post('ckeditors/upload', [FormController::class, 'ckupload'])->name('ckeditors.upload')->middleware(['auth']);
Route::post('dropzone/upload/{id}', [FormController::class, 'dropzone'])->name('dropzone.upload')->middleware(['Setting']);
Route::post('ckeditor/upload', '\App\Http\Controllers\FormController@upload')->name('ckeditor.upload')->middleware(['auth']);
Route::get('form-status/{id}', [FormController::class, 'formStatus'])->name('form.status');

Route::post('settings/stripe-setting/update', [SettingsController::class, 'paymentSettingUpdate'])->name('settings/stripe-setting/update');
Route::post('settings/social-setting/update', [SettingsController::class, 'socialSettingUpdate'])->name('settings/social-setting/update');

Route::get('/redirect/{provider}', [SocialLoginController::class, 'redirect'])->middleware(['Setting']);
Route::get('/callback/{provider}', [SocialLoginController::class, 'callback'])->name('social.callback')->middleware(['Setting']);

Route::post('/2fa', function () {
    return redirect(URL()->previous());
})->name('2fa')->middleware('2fa');

Route::group(['prefix' => '2fa'], function () {
    Route::get('/', '\App\Http\Controllers\LoginSecurityController@show2faForm');
    Route::post('/generateSecret', '\App\Http\Controllers\LoginSecurityController@generate2faSecret')->name('generate2faSecret');
    Route::post('/enable2fa', '\App\Http\Controllers\LoginSecurityController@enable2fa')->name('enable2fa');
    Route::post('/disable2fa', '\App\Http\Controllers\LoginSecurityController@disable2fa')->name('disable2fa');
});
// Route::get('/test_middleware', function () {
//     return "2FA middleware work!";
// })->middleware(['auth', '2fa']);

// Route::any('(:any)/(:all?)', function ($first, $rest = '') {
//     $page = $rest ? "{$first}/{$rest}" : $first;
//     dd($page);
// });


Route::get('form-detail/id', [HomeController::class, 'form_details'])->name('form.details');

Route::get('frontend-setting', [SettingsController::class, 'frontendsetting'])->name('frontend.page')->middleware(['Setting', 'xss']);
Route::post('frontend-setting/store', [SettingsController::class, 'frontendsettingstore'])->name('frontend.page.store');
Route::post('menu-setting/store', [SettingsController::class, 'menusettingstore'])->name('menu.page.store');
Route::post('price-setting/store', [SettingsController::class, 'pricesettingstore'])->name('price.page.store');
Route::post('feature-setting/store', [SettingsController::class, 'featuresettingstore'])->name('feature.page.store');
Route::post('sidefeature-setting/store', [SettingsController::class, 'sidefeaturesettingstore'])->name('sidefeature.page.store');
Route::post('privacy-setting/store', [SettingsController::class, 'privacysettingstore'])->name('privacy.page.store');
Route::post('contactus-setting/store', [SettingsController::class, 'contactussettingstore'])->name('contactus.page.store');
Route::post('termcondition-setting/store', [SettingsController::class, 'termconditionsettingstore'])->name('termcondition.page.store');
Route::post('faq-setting/store', [SettingsController::class, 'faqsettingstore'])->name('faq.page.store')->middleware(['Setting', 'auth']);
Route::post('recaptcha-setting/store', [SettingsController::class, 'recaptchasettingstore'])->name('recaptcha.page.store');
Route::post('login-setting/store', [SettingsController::class, 'loginsettingstore'])->name('login.page.store')->middleware(['Setting', 'xss']);

Route::get('/{lang?}', [HomeController::class, 'landingPage'])->name('landingpage');
