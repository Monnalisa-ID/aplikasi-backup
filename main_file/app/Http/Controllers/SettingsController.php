<?php

namespace App\Http\Controllers;

use App\Facades\UtilityFacades;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Artisan;
use Illuminate\Support\Facades\Mail;
use Str;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'web',  'permission:manage-setting']);
    }

    public function index()
    {
        $alllanguages = UtilityFacades::languages();
        foreach ($alllanguages as  $lang) {
            $languages[$lang] = Str::upper($lang);
        }
        return view('settings.main-setting', compact('languages'));
    }

    public function appNameUpdate(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'app_name' => 'required|min:4',
            'app_logo' => 'image|max:2048|mimes:png',
            'favicon_logo' => 'image|max:2048|mimes:png',
            'app_dark_logo' => 'image|max:2048|mimes:png',
            'app_small_logo' => 'image|max:2048|mimes:png',
        ], [
            'app_name.regex' =>  __('Invalid entry! the app name only letters and numbers are allowed.'),
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $app_logo = UtilityFacades::getsettings('app_logo');
        $app_dark_logo = UtilityFacades::getsettings('app_dark_logo');
        $app_small_logo = UtilityFacades::getsettings('app_small_logo');
        $favicon_logo = UtilityFacades::getsettings('favicon_logo');
        $data = [
            'app_name' => $request->app_name
        ];
        if ($request->app_logo) {
            $app_logo = 'app-logo' . '.' . 'png';
            $logoPath = "uploads/appLogo";
            $image = request()->file('app_logo')->storeAs(
                $logoPath,
                $app_logo,
            );
            $data['app_logo'] = $image;
        }
        if ($request->app_dark_logo) {
            $app_dark_logo = 'app-dark-logo' . '.' . 'png';
            $logoPath = "uploads/appLogo";
            $image = request()->file('app_dark_logo')->storeAs(
                $logoPath,
                $app_dark_logo,
            );
            $data['app_dark_logo'] = $image;
        }
        if ($request->app_small_logo) {
            $app_small_logo = 'app-small-logo' . '.' . 'png';
            $logoPath = "uploads/appLogo";
            $image = request()->file('app_small_logo')->storeAs(
                $logoPath,
                $app_small_logo,
            );
            $data['app_small_logo'] = $image;
        }
        if ($request->favicon_logo) {
            $favicon_logo = 'app-favicon-logo' . '.' . 'png';
            $logoPath = "uploads/appLogo";
            $image = request()->file('favicon_logo')->storeAs(
                $logoPath,
                $favicon_logo,
            );
            $data['favicon_logo'] = $image;
        }
        $arrEnv = [
            'APP_NAME' => $request->app_name,
        ];
        UtilityFacades::setEnvironmentValue($arrEnv);
        $this->updateSettings($data);
        return redirect()->back()->with('success',  __('App setting updated successfully.'));
    }

    public function appLogoUpdate(Request $request)
    {
        $disk = Storage::disk('');
        $validator = \Validator::make($request->all(), [
            'app_logo' => 'required|image|max:2048|mimes:jpeg,bmp,png,jpg',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $dark_logo = $request->file('app_logo');
        $app_dark_logo = 'app-logo' . '.' . 'png';
        $logoPath = "uploads/appLogo";
        $data = request()->file('app_logo')->storeAs(
            $logoPath,
            $app_dark_logo,
        );
        $dark_logo_url =  $disk->url($data);
        $data = [
            'app_logo' => $dark_logo_url,
        ];
        $this->updateSettings($data);
        return redirect()->back()->with('success',  __('App logo updated successfully.'));
    }

    public function appThemeUpdate(Request $request)
    {
        $this->validate($request, [
            'app_theme' => 'required',
        ]);
        $data = [
            'app_theme' => $request->app_theme,
            'app_sidebar' => $request->app_sidebar,
            'app_navbar' => $request->app_navbar,
        ];
        $this->updateSettings($data);
        return redirect()->back()->with('success',  __('App theme updated successfully.'));
    }

    public function pusherSettingUpdate(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'pusher_id' => 'required|regex:/^[0-9]+$/',
            'pusher_key' => 'required|regex:/^[A-Za-z0-9_.,()]+$/',
            'pusher_secret' => 'required|regex:/^[A-Za-z0-9_.,()]+$/',
            'pusher_cluster' => 'required|regex:/^[A-Za-z0-9_.,()]+$/',
        ], [
            'pusher_id.regex' =>  __('Invalid entry! the pusher id only letters, underscore and numbers are allowed.'),
            'pusher_key.regex' =>  __('Invalid entry! the pusher key only letters, underscore and numbers are allowed.'),
            'pusher_secret.regex' =>  __('Invalid entry! the pusher secret only letters, underscore and numbers are allowed.'),
            'pusher_cluster.regex' =>  __('Invalid entry! the pusher cluster only letters, underscore and numbers are allowed.'),
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $data = [
            'pusher_id' => $request->pusher_id,
            'pusher_key' => $request->pusher_key,
            'pusher_secret' => $request->pusher_secret,
            'pusher_cluster' => $request->pusher_cluster,
            'pusher_status' => ($request->pusher_status == 'on') ? 1 : 0,
        ];
        $arrEnv = [
            'PUSHER_APP_ID' => $request->pusher_id,
            'PUSHER_APP_KEY' => $request->pusher_key,
            'PUSHER_APP_SECRET' => $request->pusher_secret,
            'PUSHER_APP_CLUSTER' => $request->pusher_cluster,
        ];
        UtilityFacades::setEnvironmentValue($arrEnv);
        $this->updateSettings($data);
        return redirect()->back()->with('success',  __('Pusher API key updated successfully.'));
    }

    public function testMail()
    {
        return view('settings.test-mail');
    }

    public function wasabiSettingUpdate(Request $request)
    {
        if ($request->settingtype == 's3') {
            $validator = \Validator::make($request->all(),  [
                's3_key' => 'required',
                's3_secret' => 'required',
                's3_region' => 'required',
                's3_bucket' => 'required',
                's3_url' => 'required',
                's3_endpoint' => 'required',
            ], [
                's3_key.regex' =>  __('Invalid entry! the s3 key only letters, underscore and numbers are allowed.'),
                's3_secret.regex' =>  __('Invalid entry! the s3 secret only letters, underscore and numbers are allowed.'),
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
        }
        $s3 = [
            'AWS_ACCESS_KEY_ID' => $request->s3_key,
            'AWS_SECRET_ACCESS_KEY' => $request->s3_secret,
            'AWS_DEFAULT_REGION' => $request->s3_region,
            'AWS_BUCKET' => $request->s3_bucket,
            'AWS_URL' => $request->s3_url,
            'AWS_ENDPOINT' => $request->s3_endpoint,
            'FILESYSTEM_DRIVER' => $request->settingtype,
        ];
        UtilityFacades::setEnvironmentValue($s3);
        $this->updateSettings($request->all());
        return redirect()->route('settings')->with('success',  __('S3 API key updated successfully.'));
    }

    public function emailSettingUpdate(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'mail_mailer' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required|email',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'mail_from_address' => 'required',
            'mail_from_name' => 'required',
        ], [
            'mail_mailer.regex' => 'Required entry! the mail mailer not allow empty.',
            'mail_host.regex' => 'Required entry! the mail host not allow empty.',
            'mail_port.regex' => 'Required entry! the mail port not allow empty.',
            'mail_username.regex' => 'Required entry! the username mailer not allow empty.',
            'mail_password.regex' => 'Required entry! the password mailer not allow empty.',
            'mail_encryption.regex' => 'Invalid entry! the mail encryption mailer not allow empty.',
            'mail_from_address.regex' => 'Invalid entry! the mail from address not allow empty.',
            'mail_from_name.regex' => 'Invalid entry! the from name not allow empty.',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $data = [
            'mail_mailer' => $request->mail_mailer,
            'mail_host' => $request->mail_host,
            'mail_port' => $request->mail_port,
            'mail_username' => $request->mail_username,
            'mail_password' => $request->mail_password,
            'mail_encryption' => $request->mail_encryption,
            'mail_from_address' => $request->mail_from_address,
            'mail_from_name' => $request->mail_from_name,
        ];
        $arrEnv = [
            'MAIL_MAILER' => $request->mail_mailer,
            'MAIL_HOST' => $request->mail_host,
            'MAIL_PORT' => $request->mail_port,
            'MAIL_USERNAME' => $request->mail_username,
            'MAIL_PASSWORD' => $request->mail_password,
            'MAIL_ENCRYPTION' => $request->mail_encryption,
            'MAIL_FROM_ADDRESS' => $request->mail_from_address,
            'MAIL_FROM_NAME' => $request->mail_from_name,
        ];
        UtilityFacades::setEnvironmentValue($arrEnv);
        $this->updateSettings($data);
        return redirect()->back()->with('success',  __('Email setting updated successfully.'));
    }

    public function captchaSettingUpdate(Request $request)
    {
        if ($request->captcha == 'hcaptcha') {
            $this->validate($request, [
                'hcaptcha_key' => 'required',
                'hcaptcha_secret' => 'required',
            ], [
                'hcaptcha_sitekey.regex' =>  __('Invalid entry! the hcaptcha key only letters, underscore and numbers are allowed.'),
                'hcaptcha_secret.regex' =>  __('Invalid entry! the hcaptcha secret only letters, underscore and numbers are allowed.'),
            ]);
        }
        if ($request->captcha == 'recaptcha') {
            $this->validate($request, [
                'recaptcha_key' => 'required',
                'recaptcha_secret' => 'required',
            ], [
                'recaptcha_sitekey.regex' =>  __('Invalid entry! the hcaptcha key only letters, underscore and numbers are allowed.'),
                'recaptcha_secret.regex' =>  __('Invalid entry! the hcaptcha secret only letters, underscore and numbers are allowed.'),
            ]);
        }
        $data = [
            'captcha'  => $request->captcha,
            'captcha_secret' => $request->recaptcha_secret,
            'captcha_sitekey' => $request->recaptcha_key,
            'hcaptcha_secret' => $request->hcaptcha_secret,
            'hcaptcha_sitekey' => $request->hcaptcha_key,
        ];
        $input = [
            'captcha'  => $request->captcha,
            'recaptcha_secret' => $request->recaptcha_secret,
            'recaptcha_key' => $request->recaptcha_key,
            'hcaptcha_secret' => $request->hcaptcha_secret,
            'hcaptcha_key' => $request->hcaptcha_key,
        ];
        $this->updateSettings($input);
        return redirect()->back()->with('success',  __('Captcha setting updated successfully.'));
    }

    public function socialSettingUpdate(Request $request)
    {
        $this->validate($request, [
            'socialsetting' => 'required|min:1'
        ]);
        $googlestatus = 'off';
        $facebookstatus = 'off';
        $githubstatus = 'off';
        $linkedinstatus = 'off';
        if ($request->socialsetting) {
            if (in_array('google', $request->get('socialsetting'))) {
                $validator = \Validator::make($request->all(), [
                    'google_client_id' => 'required',
                    'google_client_secret' => 'required',
                    'google_redirect' => 'required',
                ], [
                    'google_client_id.regex' => 'Invalid entry! the google key only letters, underscore and numbers are allowed.',
                    'google_client_secret.regex' => 'Invalid entry! the google secret only letters, underscore and numbers are allowed.',
                    'google_redirect.regex' => 'Invalid entry! the google redirect only letters, underscore and numbers are allowed.',
                ]);
                if ($validator->fails()) {
                    $messages = $validator->errors();
                    return redirect()->back()->with('errors', $messages->first());
                }
                $data = [
                    'google_client_id' => $request->google_client_id,
                    'google_client_secret' => $request->google_client_secret,
                    'google_redirect' => $request->google_redirect,
                    'googlesetting' => (!empty($request->googlesetting)) ? 'on' : 'off',
                ];
                $googlestatus = 'on';
            }
            if (in_array('facebook', $request->get('socialsetting'))) {
                $validator = \Validator::make($request->all(), [
                    'facebook_client_id' => 'required',
                    'facebook_client_secret' => 'required',
                    'facebook_redirect' => 'required',
                ], [
                    'facebook_client_id.regex' => 'Invalid entry! the facebook key only letters, underscore and numbers are allowed.',
                    'facebook_client_secret.regex' => 'Invalid entry! the facebook secret only letters, underscore and numbers are allowed.',
                    'facebook_redirect.regex' => 'Invalid entry! the facebook redirect only letters, underscore and numbers are allowed.',
                ]);
                if ($validator->fails()) {
                    $messages = $validator->errors();
                    return redirect()->back()->with('errors', $messages->first());
                }
                $data = [
                    'facebook_client_id' => $request->facebook_client_id,
                    'facebook_client_secret' => $request->facebook_client_secret,
                    'facebook_redirect' => $request->facebook_redirect,
                    'facebooksetting' => (!empty($request->facebooksetting)) ? 'on' : 'off',
                ];
                $facebookstatus = 'on';
            }
            if (in_array('github', $request->get('socialsetting'))) {
                $validator = \Validator::make($request->all(), [
                    'github_client_id' => 'required',
                    'github_client_secret' => 'required',
                    'github_redirect' => 'required',
                ], [
                    'github_client_id.regex' => 'Invalid entry! the github key only letters, underscore and numbers are allowed.',
                    'github_client_secret.regex' => 'Invalid entry! the github secret only letters, underscore and numbers are allowed.',
                    'github_redirect.regex' => 'Invalid entry! the github redirect only letters, underscore and numbers are allowed.',
                ]);
                if ($validator->fails()) {
                    $messages = $validator->errors();
                    return redirect()->back()->with('errors', $messages->first());
                }
                $data = [
                    'github_client_id' => $request->github_client_id,
                    'github_client_secret' => $request->github_client_secret,
                    'github_redirect' => $request->github_redirect,
                    'githubsetting' => (!empty($request->githubsetting)) ? 'on' : 'off',
                ];
                $githubstatus = 'on';
            }
            if (in_array('linkedin', $request->get('socialsetting'))) {

                $validator = \Validator::make($request->all(), [
                    'linkedin_client_id' => 'required',
                    'linkedin_client_secret' => 'required',
                    'linkedin_redirect' => 'required',
                ], [
                    'linkedin_client_id.regex' => 'Invalid entry! the linkedin key only letters, underscore and numbers are allowed.',
                    'linkedin_client_secret.regex' => 'Invalid entry! the linkedin secret only letters, underscore and numbers are allowed.',
                    'linkedin_redirect.regex' => 'Invalid entry! the linkedin redirect only letters, underscore and numbers are allowed.',
                ]);
                if ($validator->fails()) {
                    $messages = $validator->errors();
                    return redirect()->back()->with('errors', $messages->first());
                }
                $data = [
                    'linkedin_client_id' => $request->linkedin_client_id,
                    'linkedin_client_secret' => $request->linkedin_client_secret,
                    'linkedin_redirect' => $request->linkedin_redirect,
                    'linkedinsetting' => (!empty($request->linkedinsetting)) ? 'on' : 'off',
                ];
                $linkedinstatus = 'on';
            }
            $data = [
                'google_client_id' => $request->google_client_id,
                'google_client_secret' => $request->google_client_secret,
                'google_redirect' => $request->google_redirect,
                'facebook_client_id' => $request->facebook_client_id,
                'facebook_client_secret' => $request->facebook_client_secret,
                'facebook_redirect' => $request->facebook_redirect,
                'github_client_id' => $request->github_client_id,
                'github_client_secret' => $request->github_client_secret,
                'github_redirect' => $request->github_redirect,
                'linkedin_client_id' => $request->linkedin_client_id,
                'linkedin_client_secret' => $request->linkedin_client_secret,
                'linkedin_redirect' => $request->linkedin_redirect,
                'googlesetting' => (in_array('google', $request->get('socialsetting'))) ? 'on' : 'off',
                'facebooksetting' => (in_array('facebook', $request->get('socialsetting'))) ? 'on' : 'off',
                'githubsetting' => (in_array('github', $request->get('socialsetting'))) ? 'on' : 'off',
                'linkedinsetting' => (in_array('linkedin', $request->get('socialsetting'))) ? 'on' : 'off',
            ];
        } else {
            $data = [
                'googlesetting' => 'off',
                'facebooksetting' => 'off',
                'githubsetting' => 'off',
                'linkedinsetting' => 'off',
            ];
        }
        $this->updateSettings($data);
        return redirect()->back()->with('success', __('Social setting updated successfully.'));
    }

    public function authSettingsUpdate(Request $request)
    {
        if ($request->email_verification == 'on') {
            if (UtilityFacades::getsettings('mail_host') != '') {
                $val = [
                    'email_verification' => ($request->email_verification == 'on') ? '1' : '0',
                ];
                $this->updateSettings($val);
            } else {
                return redirect("/settings#useradd-6")->with('warning', __('Please set email setting.'));
            }
        }
        if ($request->sms_verification == 'on') {
            if (UtilityFacades::getsettings('multisms_setting') == 'on') {
                $val = [
                    'sms_verification' => ($request->sms_verification == 'on') ? '1' : '0',
                ];
                $this->updateSettings($val);
            } else {
                return redirect("/settings#useradd-9")->with('warning', __('Please set sms setting.'));
            }
        }
        $data = [
            'rtl' => ($request->rtl_setting == 'on') ? 1 : 0,
            '2fa' => ($request->two_factor_auth == 'on') ? 1 : 0,
            'register' => ($request->register == 'on') ? 1 : 0,
            'gtag' => $request->gtag,
            'default_language' => $request->default_language,
            'date_format' => $request->date_format,
            'time_format' => $request->time_format,
            'email_verification' => ($request->email_verification == 'on') ? 1 : 0,
            'sms_verification' => ($request->sms_verification == 'on') ? 1 : 0,
            'color' => ($request->color) ? $request->color : UtilityFacades::getsettings('color'),
            'dark_mode' => $request->dark_mode,
            'roles' => $request->roles
        ];
        $this->updateSettings($data);
        return redirect()->back()->with('success',  __('General setting updated successfully.'));
    }

    public function paymentSettingUpdate(Request $request)
    {
        $this->validate($request, [
            'paymentsetting' => 'required|min:1'
        ]);
        $stripestatus = 'off';
        $paypalstatus = 'off';
        $razorpaystatus = 'off';
        $Offlinestatus = 'off';
        $mercadostatus = 'off';
        if (in_array('stripe', $request->get('paymentsetting'))) {
            $validator = \Validator::make($request->all(), [
                'stripe_key' => 'required',
                'stripe_secret' => 'required',
            ], [
                'stripe_key.regex' => 'Invalid entry! the stripe key only letters, underscore and numbers are allowed.',
                'stripe_secret.regex' => 'Invalid entry! the stripe secret only letters, underscore and numbers are allowed.',
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
            $data = [
                'stripe_key' => $request->stripe_key,
                'stripe_secret' => $request->stripe_secret,
                'stripesetting' => (in_array('stripe', $request->get('paymentsetting'))) ? 'on' : 'off',
            ];
            $stripestatus = 'on';
        }
        if (in_array('paypal', $request->paymentsetting)) {
            $validator = \Validator::make($request->all(), [
                'client_id' => 'required',
                'client_secret' => 'required',
            ], [
                'client_id.regex' => 'Invalid entry! the stripe key only letters, underscore and numbers are allowed.',
                'client_secret.regex' => 'Invalid entry! the stripe secret only letters, underscore and numbers are allowed.',
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
            $data = [
                'paypal_sandbox_client_id' => $request->client_id,
                'paypal_sandbox_client_secret' => $request->client_secret,
                'paypal_mode' => $request->paypal_mode,
                'paypalsetting' => (in_array('paypal', $request->get('paymentsetting'))) ? 'on' : 'off',
            ];
            $paypalstatus = 'on';
        }
        if (in_array('razorpay', $request->paymentsetting)) {
            $validator = \Validator::make($request->all(), [
                'razorpay_key' => 'required',
                'razorpay_secret' => 'required',
            ], [
                'razorpay_key.regex' => 'Invalid entry! the stripe secret only letters, underscore and numbers are allowed.',
                'razorpay_secret.regex' => 'Invalid entry! the stripe secret only letters, underscore and numbers are allowed.',
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
            $data = [
                'razorpay_key' => $request->razorpay_key,
                'razorpay_secret' =>  $request->razorpay_secret,
                'razorpaysetting' => (in_array('razorpay', $request->get('paymentsetting'))) ? 'on' : 'off',
            ];
            $razorpaystatus = 'on';
        }
        if (in_array('paytm', $request->get('paymentsetting'))) {
            $validator = \Validator::make($request->all(), [
                'merchant_id' => 'required',
                'merchant_key' => 'required',
                'paytm_environment' => 'required',
            ], [
                'merchant_id.regex' => 'Invalid entry! the stripe key only letters, underscore and numbers are allowed.',
                'merchant_key.regex' => 'Invalid entry! the stripe secret only letters, underscore and numbers are allowed.',
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
            $data = [
                'paytm_merchant_id' => $request->merchant_id,
                'paytm_merchant_key' => $request->merchant_key,
                'paytm_environment' => $request->paytm_environment,
                'paytm_merchant_website' => 'local',
                'paytm_channel' => 'WEB',
                'paytm_indistry_type' => 'local',
                'paytmsetting' => (in_array('paytm', $request->get('paymentsetting'))) ? 'on' : 'off',
            ];
            $paytmstatus = 'on';
        }
        if (in_array('flutterwave', $request->get('paymentsetting'))) {
            $validator = \Validator::make($request->all(), [
                'flw_public_key' => 'required',
                'flw_secret_key' => 'required',
            ], [
                'flw_public_key.regex' => 'Invalid entry! the stripe key only letters, underscore and numbers are allowed.',
                'flw_secret_key.regex' => 'Invalid entry! the stripe secret only letters, underscore and numbers are allowed.',
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
            $data = [
                'flw_public_key' => $request->flw_public_key,
                'flw_secret_key' => $request->flw_secret_key,
                'flutterwavesetting' => (in_array('flutterwave', $request->get('paymentsetting'))) ? 'on' : 'off',
            ];
            $flutterwavestatus = 'on';
        }
        if (in_array('coingate', $request->get('paymentsetting'))) {
            $validator = \Validator::make($request->all(), [
                'coingate_mode' => 'required',
                'coingate_auth_token' => 'required',
            ], [
                'coingate_auth_token.regex' => 'Invalid entry! the stripe secret only letters, underscore and numbers are allowed.',
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
            $data = [
                'coingate_environment' => $request->coingate_mode,
                'coingate_auth_token' => $request->coingate_auth_token,
                'coingatesetting' => (in_array('coingate', $request->get('paymentsetting'))) ? 'on' : 'off',
            ];
            $stripestatus = 'on';
        }
        if (in_array('paystack', $request->get('paymentsetting'))) {
            $validator = \Validator::make($request->all(), [
                'paystack_public_key' => 'required',
                'paystack_secret_key' => 'required',
            ], [
                'paystack_public_key.regex' => 'Invalid entry! the stripe key only letters, underscore and numbers are allowed.',
                'paystack_secret_key.regex' => 'Invalid entry! the stripe secret only letters, underscore and numbers are allowed.',
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
            $data = [
                'paystack_public_key' => $request->paystack_public_key,
                'paystack_secret_key' => $request->paystack_secret_key,
                'paystacksetting' => (in_array('paystack', $request->get('paymentsetting'))) ? 'on' : 'off',
            ];
            $flutterwavestatus = 'on';
        }
        if (in_array('mercado', $request->paymentsetting)) {
            $validator = \Validator::make($request->all(), [
                'mercado_access_token' => 'required',
            ], [
                'mercado_access_token.regex' => 'Invalid entry! the mercado access token only letters, underscore and numbers are allowed.',
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
            $data = [
                'mercado_mode' => $request->mercado_mode,
                'mercado_access_token' => $request->mercado_access_token,
                'mercadosetting' => (in_array('mercado', $request->get('paymentsetting'))) ? 'on' : 'off',
            ];
            $mercadostatus = 'on';
        }

        if (in_array('offline', $request->paymentsetting)) {
            $validator = \Validator::make($request->all(), [
                'payment_mode' => 'required',
            ], [
                'payment_mode.regex' => 'Invalid entry! the payment mode only letters, underscore and numbers are allowed.',
                'payment_details.regex' => 'Invalid entry! the payment details only letters, underscore and numbers are allowed.',
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
            $data = [
                'payment_mode' => $request->payment_mode,
                'payment_details' =>  $request->payment_details,
                'offlinesetting' => (in_array('offline', $request->get('paymentsetting'))) ? 'on' : 'off',
            ];
            $Offlinestatus = 'on';
        }
        $data = [
            'stripe_key' => $request->stripe_key,
            'stripe_secret' => $request->stripe_secret,
            'paypal_sandbox_client_id' => $request->client_id,
            'paypal_sandbox_client_secret' => $request->client_secret,
            'paypal_mode' => $request->paypal_mode,
            'razorpay_key' => $request->razorpay_key,
            'razorpay_secret' =>  $request->razorpay_secret,
            'paytm_merchant_id' => $request->merchant_id,
            'paytm_merchant_key' => $request->merchant_key,
            'paytm_environment' => $request->paytm_environment,
            'paytm_merchant_website' => 'local',
            'paytm_channel' => 'WEB',
            'paytm_indistry_type' => 'local',
            'flw_public_key' => $request->flw_public_key,
            'flw_secret_key' => $request->flw_secret_key,
            'paystack_public_key' => $request->paystack_public_key,
            'paystack_secret_key' => $request->paystack_secret_key,
            'coingate_environment' => $request->coingate_mode,
            'coingate_auth_token' => $request->coingate_auth_token,
            'payment_mode' => $request->payment_mode,
            'payment_details' =>  $request->payment_details,
            'mercado_mode' => $request->mercado_mode,
            'mercado_access_token' => $request->mercado_access_token,
            'mercadosetting' => (in_array('mercado', $request->get('paymentsetting'))) ? 'on' : 'off',
            'coingatesetting' => (in_array('coingate', $request->get('paymentsetting'))) ? 'on' : 'off',
            'stripesetting' => (in_array('stripe', $request->get('paymentsetting'))) ? 'on' : 'off',
            'paypalsetting' => (in_array('paypal', $request->get('paymentsetting'))) ? 'on' : 'off',
            'razorpaysetting' => (in_array('razorpay', $request->get('paymentsetting'))) ? 'on' : 'off',
            'offlinesetting' => (in_array('offline', $request->get('paymentsetting'))) ? 'on' : 'off',
            'paytmsetting' => (in_array('paytm', $request->get('paymentsetting'))) ? 'on' : 'off',
            'flutterwavesetting' => (in_array('flutterwave', $request->get('paymentsetting'))) ? 'on' : 'off',
            'paystacksetting' => (in_array('paystack', $request->get('paymentsetting'))) ? 'on' : 'off',
        ];
        $this->updateSettings($data);
        return redirect()->back()->with('success', __('Payment setting updated successfully.'));
    }

    public function smsSettingUpdate(Request $request)
    {
        if ($request->smssetting == 'twilio') {
            $validator = \Validator::make($request->all(), [
                'twilio_sid' => 'required',
                'twilio_auth_token' => 'required',
                'twilio_verify_sid' => 'required',
                'twilio_number' => 'required',
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
        } else if ($request->smssetting == 'nexmo') {
            $validator = \Validator::make($request->all(), [
                'nexmo_key' => 'required',
                'nexmo_secret' => 'required',
                'nexmo_url' => 'required',
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
        }
        $data = [
            'multisms_setting' => ($request->multisms_setting) ? 'on' : 'off',
            'smssetting' => ($request->smssetting),
            'nexmo_key' => $request->nexmo_key,
            'nexmo_secret' => $request->nexmo_secret,
            'nexmo_url' => $request->nexmo_url,
            'twilio_sid' => $request->twilio_sid,
            'twilio_auth_token' => $request->twilio_auth_token,
            'twilio_verify_sid' => $request->twilio_verify_sid,
            'twilio_number' => $request->twilio_number,
        ];
        $this->updateSettings($data);
        return redirect()->back()->with('success',  __('Sms setting updated successfully.'));
    }

    private function updateSettings($input)
    {
        foreach ($input as $key => $value) {
            setting([$key => $value])->save();
        }
    }

    public function backupFiles()
    {
        Artisan::call('backup:run', ['--only-files' => true]);
        $output = Artisan::output();
        if (Str::contains($output, 'Backup completed!')) {
            return redirect()->back()->with('success',  __('Application files backed-up successfully.'));
        } else {
            return redirect()->back()->with('error',  __('Application files backed-up failed.'));
        }
    }

    public function backupDb()
    {
        Artisan::call('backup:run', ['--only-db' => true]);
        $output = Artisan::output();
        if (Str::contains($output, 'Backup completed!')) {
            return redirect()->back()->with('success',  __('Application database backed-up successfully.'));
        } else {
            return redirect()->back()->with('error',  __('Application database backed-up failed.'));
        }
    }

    private function getBackups()
    {
        $path = storage_path('app/app-backups');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $files = File::allFiles($path);
        $backups = collect([]);
        foreach ($files as $dt) {
            $backups->push([
                'filename' => pathinfo($dt->getFilename(), PATHINFO_FILENAME),
                'extension' => pathinfo($dt->getFilename(), PATHINFO_EXTENSION),
                'path' => $dt->getPath(),
                'size' => $dt->getSize(),
                'time' => $dt->getMTime(),
            ]);
        }
        return $backups;
    }

    public function downloadBackup($name, $ext)
    {
        $path = storage_path('app/app-backups');
        $file = $path . '/' . $name . '.' . $ext;
        $status = Storage::disk('backup')->download($name . '.' . $ext, $name . '.' . $ext);
        return $status;
    }

    public function deleteBackup($name, $ext)
    {
        $path = storage_path('app/app-backups');
        $file = $path . '/' . $name . '.' . $ext;
        $status = File::delete($file);
        if ($status) {
            return redirect()->back()->with('success',  __('Backup deleted successfully.'));
        } else {
            return redirect()->back()->with('error',  __('Oops! an error occured, try again.'));
        }
    }

    public function frontendsetting(Request $request)
    {
        return view('settings.froentend');
    }

    public function frontendsettingstore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'apps_paragraph' => 'required',
            'image' => 'image|mimes:svg',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $data = [
            'apps_paragraph' => $request->apps_paragraph,
        ];
        if ($request->image) {
            Storage::delete(UtilityFacades::getsettings('image'));
            $image_name = 'image.' . $request->image->extension();
            $request->image->storeAs('landingpage', $image_name);
            $data['image'] = 'landingpage/' . $image_name;
        }
        $this->updateSettings($data);
        return redirect()->back()->with('success', __('App setting updated successfully.'));
    }

    public function menusettingstore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'menu_name' => 'required',
            'menu_title' => 'required',
            'menu_subtitle' => 'required',
            'menu_paragraph' => 'required',
            'images1' => 'image|mimes:png,jpg,jpeg',

            'submenu_name' => 'required',
            'submenu_title' => 'required',
            'submenu_subtitle' => 'required',
            'submenu_paragraph' => 'required',
            'images2' => 'image|mimes:svg',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $data = [
            'menu_name' => $request->menu_name,
            'menu_title' => $request->menu_title,
            'menu_subtitle' => $request->menu_subtitle,
            'menu_paragraph' => $request->menu_paragraph,
            'submenu_name' => $request->submenu_name,
            'submenu_title' => $request->submenu_title,
            'submenu_subtitle' => $request->submenu_subtitle,
            'submenu_paragraph' => $request->submenu_paragraph,
        ];
        if ($request->images1) {
            Storage::delete(UtilityFacades::getsettings('images1'));
            $images1_name = 'images1.' . $request->images1->extension();
            $request->images1->storeAs('landingpage', $images1_name);
            $data['images1'] = 'landingpage/' . $images1_name;
        }
        if ($request->images2) {
            Storage::delete(UtilityFacades::getsettings('images2'));
            $images2_name = 'images2.' . $request->images2->extension();
            $request->images2->storeAs('landingpage', $images2_name);
            $data['images2'] = 'landingpage/' . $images2_name;
        }
        $this->updateSettings($data);
        return redirect()->back()->with('success', __('Menu setting updated successfully.'));
    }

    public function featuresettingstore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'feature_name' => 'required',
            'feature_paragraph' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $data = [
            'feature_name' => $request->feature_name,
            'feature_paragraph' => $request->feature_paragraph,
            'feature_setting' => json_encode($request->feature_setting),
        ];
        $this->updateSettings($data);
        return redirect()->back()->with('success', __('Feature setting updated successfully.'));
    }

    public function faqsettingstore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'faq_title' => 'required',
            'faq_paragraph' => 'required',
            'faq_page_content' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $data = [
            'faq_title' => $request->faq_title,
            'faq_paragraph' => $request->faq_paragraph,
            'faq_page_content' => $request->faq_page_content,
        ];
        $this->updateSettings($data);
        return redirect()->back()->with('success', __('Faq setting updated successfully.'));
    }

    public function sidefeaturesettingstore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'sidefeature_name' => 'required',
            'sidefeature_title' => 'required',
            'sidefeature_subtitle' => 'required',
            'sidefeature_paragraph' => 'required',
            'image1' => 'image|mimes:png,jpg,jpeg',
            'image2' => 'image|mimes:png,jpg,jpeg',
            'image3' => 'image|mimes:png,jpg,jpeg',
            'image4' => 'image|mimes:png,jpg,jpeg',
            'image5' => 'image|mimes:png,jpg,jpeg',
            'image6' => 'image|mimes:png,jpg,jpeg',
            'image7' => 'image|mimes:png,jpg,jpeg',
            'image8' => 'image|mimes:png,jpg,jpeg',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $data = [
            'sidefeature_name' => $request->sidefeature_name,
            'sidefeature_title' => $request->sidefeature_title,
            'sidefeature_subtitle' => $request->sidefeature_subtitle,
            'sidefeature_paragraph' => $request->sidefeature_paragraph,
        ];
        if ($request->image1) {
            Storage::delete(UtilityFacades::getsettings('image1'));
            $image1_name = 'image1.' . $request->image1->extension();
            $request->image1->storeAs('landingpage', $image1_name);
            $data['image1'] = 'landingpage/' . $image1_name;
        }
        if ($request->image2) {
            Storage::delete(UtilityFacades::getsettings('image2'));
            $image2_name = 'image2.' . $request->image2->extension();
            $request->image2->storeAs('landingpage', $image2_name);
            $data['image2'] = 'landingpage/' . $image2_name;
        }
        if ($request->image3) {
            Storage::delete(UtilityFacades::getsettings('image3'));
            $image3_name = 'image3.' . $request->image3->extension();
            $request->image3->storeAs('landingpage', $image3_name);
            $data['image3'] = 'landingpage/' . $image3_name;
        }
        if ($request->image4) {
            Storage::delete(UtilityFacades::getsettings('image4'));
            $image4_name = 'image4.' . $request->image4->extension();
            $request->image4->storeAs('landingpage', $image4_name);
            $data['image4'] = 'landingpage/' . $image4_name;
        }
        if ($request->image5) {
            Storage::delete(UtilityFacades::getsettings('image5'));
            $image5_name = 'image5.' . $request->image5->extension();
            $request->image5->storeAs('landingpage', $image5_name);
            $data['image5'] = 'landingpage/' . $image5_name;
        }
        if ($request->image6) {
            Storage::delete(UtilityFacades::getsettings('image6'));
            $image6_name = 'image6.' . $request->image6->extension();
            $request->image6->storeAs('landingpage', $image6_name);
            $data['image6'] = 'landingpage/' . $image6_name;
        }
        if ($request->image7) {
            Storage::delete(UtilityFacades::getsettings('image7'));
            $image7_name = 'image7.' . $request->image7->extension();
            $request->image7->storeAs('landingpage', $image7_name);
            $data['image7'] = 'landingpage/' . $image7_name;
        }
        if ($request->image8) {
            Storage::delete(UtilityFacades::getsettings('image8'));
            $image8_name = 'image8.' . $request->image8->extension();
            $request->image8->storeAs('landingpage', $image8_name);
            $data['image8'] = 'landingpage/' . $image8_name;
        }
        $this->updateSettings($data);
        return redirect()->back()->with('success', __('Side feature setting updated successfully.'));
    }

    public function privacysettingstore(Request $request)
    {
        $validator = \Validator::make($request->all(), []);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $data = [
            'privacy' => $request->privacy,
        ];
        $this->updateSettings($data);
        return redirect()->back()->with('success', __('Privacy setting updated successfully.'));
    }

    public function contactussettingstore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            // 'app_logo' => 'required|image|max:2048|mimes:jpeg,bmp,png,jpg',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $data = [
            'footer_page_content' => $request->footer_page_content,
            'contact_us' => $request->contact_us,
            'contact_email' => $request->contact_email,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'captcha_status' => ($request->captcha_status == 'on') ? 1 : 0,
            'skype_id' => $request->skype_id,
            'skype_name' => $request->skype_name,
            'technical_support_email' => $request->technical_support_email,
            'custom_projects_email' => $request->custom_projects_email,
        ];
        $captcha_data = [
            'CAPTCHA_SITEKEY' => $request->recaptcha_key,
            'CAPTCHA_SECRET' => $request->recaptcha_secret,
        ];
        foreach ($captcha_data as $key => $value) {
            UtilityFacades::setEnvironmentValue([$key => $value]);
        }
        $this->updateSettings($data);
        return redirect()->back()->with('success', __('Contact us setting updated successfully.'));
    }

    public function termconditionsettingstore(Request $request)
    {
        $validator = \Validator::make($request->all(), []);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $data = [
            'term_condition' => $request->term_condition,
        ];
        $this->updateSettings($data);
        return redirect()->back()->with('success', __('Term & condition setting updated successfully.'));
    }

    public function loginsettingstore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'login_title' => 'required',
            'login_subtitle' => 'required',
            'login_image' => 'image|mimes:svg',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            return redirect()->back()->with('errors', $messages->first());
        }
        $data = [
            'login_title' => $request->login_title,
            'login_subtitle' => $request->login_subtitle,
        ];
        if ($request->login_image) {
            Storage::delete(UtilityFacades::getsettings('login_image'));
            $login_image_name = 'loginpage.' . $request->login_image->extension();
            $request->login_image->storeAs('loginpage', $login_image_name);
            $data['login_image'] = 'loginpage/' . $login_image_name;
        }
        $this->updateSettings($data);
        return redirect()->back()->with('success', __('Frontend page setting updated successfully.'));
    }

    public function recaptchasettingstore(Request $request)
    {
        if ($request->contact_us_recaptcha_status == '1' || $request->login_recaptcha_status == '1') {
            $validator = \Validator::make($request->all(), [
                'recaptcha_key' => 'required',
                'recaptcha_secret' => 'required',
            ]);
            if ($validator->fails()) {
                $messages = $validator->errors();
                return redirect()->back()->with('errors', $messages->first());
            }
        }
        $data = [
            'contact_us_recaptcha_status' => ($request->contact_us_recaptcha_status == 'on') ? '1' : '0',
            'login_recaptcha_status' => ($request->login_recaptcha_status == 'on') ? '1' : '0',
            'recaptcha_key' => $request->recaptcha_key,
            'recaptcha_secret' => $request->recaptcha_secret,
        ];
        $this->updateSettings($data);
        return redirect()->back()->with('success', __('Recaptcha setting updated successfully.'));
    }

    function loadsetting($type)
    {
        $alllanguages = UtilityFacades::languages();
        foreach ($alllanguages as  $lang) {
            $languages[$lang] = Str::upper($lang);
        }
        return view('settings.main-setting', compact('languages'));
    }

    public function testSendMail(Request $request)
    {
        $validator = \Validator::make($request->all(), ['email' => 'required|email']);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        try {
            Mail::to($request->email)->send(new TestMail());
        } catch (\Exception $e) {  //$e->getMessage()
            $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
            return redirect()->back()->with('error', $smtp_error);
        }
        return redirect()->back()->with('success', __('Email send successfully.'));
    }
}
