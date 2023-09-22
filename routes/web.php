<?php

use App\User;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);


/*
|--------------------------------------------------------------------------
| Normal user routes
|--------------------------------------------------------------------------
*/

// Community
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'approved', 'alumni.permissions.directory'])->prefix('community')->name('community.')->group(function () {
    Route::get('/', 'Alumni\CommunityController@index')->name('index');
    Route::get('/filter', 'Alumni\CommunityController@filter')->name('filter');
});

// chats
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'approved', 'alumni.permissions.directory'])->prefix('chat')->name('chat.')->group(function () {
    Route::get('/', 'Alumni\ChatController@index')->name('index');
    Route::get('detail/{user}', 'Alumni\ChatController@show')->name('show');
    Route::post('detail/{user}', 'Alumni\ChatController@store')->name('store');
    Route::get('block/{user}', 'Alumni\ChatController@block')->name('block');
    Route::get('unblock/{user}', 'Alumni\ChatController@unblock')->name('unblock');
});

// events
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'approved'])->prefix('events')->name('events.')->group(function () {
    Route::get('/', 'Alumni\EventController@index')->name('index');
    Route::get('detail/{seo_url}', 'Alumni\EventController@show')->where('seo_url', '[a-zA-Z0-9_.-]+')->name('show');
    Route::post('join/{seo_url}', 'Alumni\EventController@join')->where('seo_url', '[a-zA-Z0-9_.-]+')->name('join');
    Route::post('disjoin/{seo_url}', 'Alumni\EventController@disjoin')->where('seo_url', '[a-zA-Z0-9_.-]+')->name('disjoin');
});

// hobby clubs
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'approved'])->prefix('hobby-clubs')->name('hobbies.')->group(function () {
    Route::get('/', 'Alumni\HobbyController@index')->name('index');
    Route::get('detail/{seo_url}', 'Alumni\HobbyController@show')->where('seo_url', '[a-zA-Z0-9_.-]+')->name('show');
    Route::post('join/{seo_url}', 'Alumni\HobbyController@join')->where('seo_url', '[a-zA-Z0-9_.-]+')->name('join');
    Route::post('disjoin/{seo_url}', 'Alumni\HobbyController@disjoin')->where('seo_url', '[a-zA-Z0-9_.-]+')->name('disjoin');
});

// profile settings
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'approved'])->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', 'Alumni\ProfileUpdateController@index')->name('index');
    Route::post('/update-profile', 'Alumni\ProfileUpdateController@update')->name('update');
    Route::post('/update-password', 'Alumni\ProfileUpdateController@password')->name('password');
    Route::post('/update-permission', 'Alumni\ProfileUpdateController@updatePermissions')->name('permission');
    Route::post('/update-skills', 'Alumni\ProfileUpdateController@updateSkills')->name('skills');
});


// Campaigns
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'approved'])->prefix('campaigns')->name('campaign.')->group(function () {
    Route::get('/', 'Alumni\CampaignController@index')->name('index');
    Route::get('detail/{seo_url}', 'Alumni\CampaignController@show')->where('seo_url', '[a-zA-Z0-9_.-]+')->name('show');
    Route::get('join/{seo_url}', 'Alumni\CampaignController@join')->where('seo_url', '[a-zA-Z0-9_.-]+')->name('join');
    Route::get('/filter', 'Alumni\CampaignController@filter')->name('filter');
});

// Announcement
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'approved'])->prefix('announcement')->name('announcement.')->group(function () {
    Route::get('/', 'Alumni\AnnouncementController@index')->name('index');
    Route::get('detail/{seo_url}', 'Alumni\AnnouncementController@show')->where('seo_url', '[a-zA-Z0-9_.-]+')->name('show');
    Route::get('/filter', 'Alumni\AnnouncementController@filter')->name('filter');
});

// Jobs
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'approved'])->prefix('jobs')->name('jobs.')->group(function () {
    Route::get('/', 'Alumni\JobController@index')->name('index');
    Route::get('/filter', 'Alumni\JobController@filter')->name('filter');
    Route::get('detail/{seo_url}', 'Alumni\JobController@show')->where('seo_url', '[a-zA-Z0-9_.-]+')->name('show');
    Route::get('join/{seo_url}', 'Alumni\JobController@join')->where('seo_url', '[a-zA-Z0-9_.-]+')->name('join');
    Route::post('share', 'Alumni\JobShareController@store')->name('share');
});


// media
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'isalumni', 'approved'])->prefix('media')->name('media.')->group(function () {
    Route::get('/', 'Alumni\MediaController@index')->name('index');
    Route::get('detail/{seo_url}', 'Alumni\MediaController@show')->where('seo_url', '[a-zA-Z0-9_.-]+')->name('show');
});


// notifications
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'approved'])->prefix('notification')->name('notification.')->group(function () {
    Route::get('handle/{notification_id}', 'Alumni\NotificationController@handle')->where('notification_id', '[a-zA-Z0-9_.-]+')->name('handle');
});

// contacts
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'approved'])->prefix('contactform')->name('contactform.')->group(function () {
    Route::post('send', 'Alumni\ContactController@store')->name('store');
});

// legal documents
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'approved'])->prefix('legal')->name('legal.')->group(function () {
    Route::view('/aydinlatma-metni', 'alumni.legals.aydinlatma')->name('aydinlatma');
    Route::view('/uyelik-sozlesmesi', 'alumni.legals.uyeliksozlesmesi')->name('uyeliksozlesmesi');
    Route::view('/acik-riza-metni', 'alumni.legals.acikriza')->name('acikriza');
    Route::view('/yasal-uyari', 'alumni.legals.yasaluyari')->name('yasaluyari');
    Route::get('/terms/{name}', 'Alumni\TermController@export')->name('export');
});

// homepage
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'approved'])->group(function () {
    Route::get('/', 'Alumni\HomeController@index')->name('home');
});

// delete account
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved'])->group(function () {
    Route::delete('/account/delete', static function () {
        $user = User::find(Auth::user()->id);
        Auth::logout();
        if ($user->delete()) {
            return redirect()->route('login')->with('status', 'Hesabınız silindi.');
        }
    })->name('delete-account');
});


// Verify phone number after registration
Route::middleware(['auth'])->prefix('verification/phone')->group(function () {
    Route::get('/', 'Register\PhoneVerificationController@show')->name('verification.phone.notice');
    Route::post('/', 'Register\PhoneVerificationController@verify')->name('verification.phone.verify');
    Route::get('/resend', 'Register\PhoneVerificationController@resend')->name('verification.phone.resend');
});

// 2fa routes
Route::middleware(['auth', 'notverified_two_factor_only'])->prefix('2fa')->group(function () {
    Route::get('/resend', 'Auth\TwoFactorController@resend')->name('2fa.resend');
    Route::get('/verify', 'Auth\TwoFactorController@index')->name('2fa.display');
    Route::post('/verify', 'Auth\TwoFactorController@store')->name('2fa.verify');
});

// Routes for not approved users
Route::middleware(['auth', 'unapproved'])->prefix('approval')->group(function () {
    // logout user
    Route::get('/not-approved', function () {
        return view('auth.not_approved');
    })->name('user.not_approved');
});

// media
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'isalumni', 'isalumni', 'approved'])->prefix('permission')->name('permission.')->group(function () {
    Route::post('/', 'Alumni\PermissionController@update')->name('update');
});
/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/', 'HomeController@index')->name('homepage');
});

// Campaigns
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('campaigns', 'CampaignController');
    Route::post('campaigns/search', 'CampaignController@search')->name('campaigns.search');
});

// Knowledge & Development
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('knowledge', 'KnowledgeController');
    Route::post('knowledge/search', 'KnowledgeController@search')->name('knowledge.search');
    Route::get('knowledge/{knowledge}/gallery/create', 'KnowledgeController@galleryCreate')->name('knowledge.gallery.create');
    Route::get('knowledge/{knowledge}/gallery/', 'KnowledgeController@gallery')->name('knowledge.gallery');
    Route::post('knowledge/{knowledge}/gallery/create', 'KnowledgeController@galleryStore')->name('knowledge.gallery.store');
    Route::delete('knowledge/{knowledge}/gallery/{id}', 'KnowledgeController@galleryDestroy')->name('knowledge.gallery.destroy')->where('id', '[0-9]+');
});

// Jobs
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('job-offers', 'JobOfferController')->names('jobs');
    Route::post('job-offers/search', 'JobOfferController@search')->name('jobs.search');
});

// Events
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('events', 'EventController')->names('events');
    Route::post('events/search', 'EventController@search')->name('events.search');
});

// User approvals
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('approval', 'ApproveUserController')->except(['show']);
    Route::post('approval/search', 'ApproveUserController@search')->name('approval.search');
});

// Hobby clubs
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('hobby', 'HobbyController');
    Route::post('hobby/search', 'HobbyController@search')->name('hobby.search');
    Route::get('hobby/events/{id}', 'HobbyController@events')->name('hobby.events')->where('id', '[0-9]+');
});

// Media
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('medias', 'MediaController')->except(['show']);
    Route::get('medias/{media}/gallery/', 'MediaController@gallery')->name('medias.gallery');
    Route::get('medias/{media}/gallery/create', 'MediaController@galleryCreate')->name('medias.gallery.create');
    Route::post('medias/{media}/gallery/create', 'MediaController@galleryStore')->name('medias.gallery.store');
    Route::delete('medias/{media}/gallery/{id}', 'MediaController@galleryDestroy')->name('medias.gallery.destroy')->where('id', '[0-9]+');
});


// Announcements
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('announcement', 'AnnouncementController')->except(['show']);
    Route::post('announcement/search', 'AnnouncementController@search')->name('announcement.search');
});

// Alumni users
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('users', 'AlumniUserController');
    Route::post('users/search', 'AlumniUserController@search')->name('users.search');
});

// Shared jobs by alumni users
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('job-shares', 'JobShareController')->names('shared')->only(['index', 'show', 'destroy']);
    Route::post('job-shares/search', 'JobShareController@search')->name('shared.search');
});

// Password controller
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager/password')->name('manager.password.')->group(function () {
    Route::get('', 'AdminPasswordController@index')->name('index');
    Route::post('update', 'AdminPasswordController@update')->name('update');
});

// Profile controller
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager/settings')->name('manager.settings.')->group(function () {
    Route::get('', 'AdminProfileController@index')->name('index');
    Route::patch('update', 'AdminProfileController@update')->name('update');
});


// Sliders
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('sliders', 'SliderController');
    Route::post('sliders/search', 'SliderController@search')->name('sliders.search');
});

// Media uploader
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::post('media/upload', 'MediaUploaderController@upload')->name('uploader');
});

// File uploader
Route::middleware(['throttle:10,1','auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('storage', 'StorageController')->except(['show', 'edit', 'update']);
});

// PwC Los
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('los', 'PwcLosController')->except(['show']);
});

// PwC SubLos
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('sublos', 'PwcSubLosController')->except(['show']);
});

// Skills
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'isadmin', 'ipblock'])->prefix('manager')->name('manager.')->group(function () {
    Route::resource('skills', 'SkillController')->except(['show']);
});

/*
|--------------------------------------------------------------------------
| Uploaded files
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->get('storage/{filename}', 'FileController@proccess')->name('storage.images');

/*
|--------------------------------------------------------------------------
| Second mail verification
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verifiedphone', 'twofactor', 'approved', 'unverified_second_email'])->group(function () {
    Route::get('verify/business-mail/{token}', 'Auth\VerifySecondMailController@verify')->name('user.verify.second.mail');
    Route::post('verify/business-mail', 'Auth\VerifySecondMailController@resend')->name('user.resend.second.mail');
});
