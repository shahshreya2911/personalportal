<?php

use Spatie\Analytics\Period;
/**
 * Authentication
 */
 
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');

Route::get('clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});



Route::get('logout', [
    'as' => 'auth.logout',
    'uses' => 'Auth\AuthController@getLogout'
]);

// Allow registration routes only if registration is enabled.
if (settings('reg_enabled')) {
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
    Route::get('register/confirmation/{token}', [
        'as' => 'register.confirm-email',
        'uses' => 'Auth\AuthController@confirmEmail'
    ]);
}

// Register password reset routes only if it is enabled inside website settings.
if (settings('forgot_password')) {
    Route::get('password/remind', 'Auth\PasswordController@forgotPassword');
    Route::post('password/remind', 'Auth\PasswordController@sendPasswordReminder');
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
}

/**
 * Two-Factor Authentication
 */
if (settings('2fa.enabled')) {
    Route::get('auth/two-factor-authentication', [
        'as' => 'auth.token',
        'uses' => 'Auth\AuthController@getToken'
    ]);

    Route::post('auth/two-factor-authentication', [
        'as' => 'auth.token.validate',
        'uses' => 'Auth\AuthController@postToken'
    ]);
}

/**
 * Social Login
 */
Route::get('auth/{provider}/login', [
    'as' => 'social.login',
    'uses' => 'Auth\SocialAuthController@redirectToProvider',
    'middleware' => 'social.login'
]);

Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('auth/twitter/email', 'Auth\SocialAuthController@getTwitterEmail');
Route::post('auth/twitter/email', 'Auth\SocialAuthController@postTwitterEmail');


    Route::group(['prefix' => 'category'], function () {
       Route::get('/', 'CategoryController@index')->name('category');
        Route::get('create', 'CategoryController@create')->name('category.create');
        Route::post('store', 'CategoryController@store')->name('category.store');
        Route::get('edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::post('storeedit', 'CategoryController@storeedit')->name('category.storeedit');
        Route::delete('delete/{subcatid}', [
        'as' => 'category.delete',
        'uses' => 'CategoryController@delete'
        ]);

    });

    Route::group(['prefix' => 'player'], function () {
       Route::get('/', 'PlayerController@index')->name('player');
        Route::get('create', 'PlayerController@create')->name('player.create');
        Route::post('store', 'PlayerController@store')->name('player.store');
        Route::get('edit/{id}', 'PlayerController@edit')->name('player.edit');
        Route::post('storeedit', 'PlayerController@storeedit')->name('player.storeedit');
        Route::delete('delete/{subcatid}', [
        'as' => 'player.delete',
        'uses' => 'PlayerController@delete'
        ]);
        Route::post('get-weight-cat', 'PlayerController@getWeightCat')->name('player.get-weight-cat');
    });

Route::group(['middleware' => 'auth', 'prefix' => 'users', 'as' => 'users.'], function () {
	Route::get('/', 'ExamController@index')->name('questions');
	#Route::get('main-dashboard', 'ExamController@mainDashboard')->name('questions.main-dashboard');
	Route::get('dashboard', 'ExamController@dashboard')->name('questions.dashboard');
	Route::post('store', 'ExamController@store')->name('questions.store');
    Route::get('certification', 'ExamController@certification');
	Route::get('story', 'ExamController@story')->name('questions.story');
});	



Route::group(['middleware' => 'auth'], function () {

	Route::group(['prefix' => 'questions'], function () {
		Route::get('/', 'QuestionsController@index')->name('questions');
		Route::get('create', 'QuestionsController@create')->name('question.create');
		Route::post('store', 'QuestionsController@store')->name('question.store');
		Route::get('edit/{id}', 'QuestionsController@edit')->name('questions.edit');
		Route::post('storeedit', 'QuestionsController@storeedit')->name('question.storeedit');
		Route::post('generate-child-category', 'QuestionsController@generateChildCategory')->name('question.generate-child-category');
		
	});
    Route::group(['prefix' => 'leads'], function () {
       Route::get('/', 'LeadController@index')->name('leads');
    });
    Route::get('/pdf', 'LeadController@pdf')->name('pdf');
     Route::group(['prefix' => 'allpdf'], function () {
        Route::get('/hybrid', 'LeadController@hybrid')->name('allpdf.hybrid');
        Route::get('/chart', 'LeadController@chart')->name('allpdf.chart');
        Route::get('/resource', 'LeadController@resource')->name('allpdf.resource');
        Route::get('/mind', 'LeadController@mind')->name('allpdf.mind');
    });
    Route::post('/customer/print-pdf', 'LeadController@printPDF')->name('customer.printpdf');

    Route::group(['prefix' => 'choices'], function () {
		Route::get('/', 'QuestionsController@indexChoice')->name('choices');
		Route::get('create', 'QuestionsController@createChoice')->name('choices.create');
		Route::post('store', 'QuestionsController@storeChoice')->name('choices.store');
		Route::get('edit/{id}', 'QuestionsController@editChoice')->name('choices.edit');
		Route::post('storeedit', 'QuestionsController@storeeditChoice')->name('choices.storeedit');
    });
    Route::group(['prefix' => 'parentcat'], function () {
        Route::get('/', 'ParentcatController@index')->name('parentcat');
        Route::get('create', 'ParentcatController@create')->name('parentcat.create');
        Route::post('store', 'ParentcatController@store')->name('parentcat.store');
        Route::get('edit/{id}', 'ParentcatController@edit')->name('parentcat.edit');
        Route::post('storeedit', 'ParentcatController@storeedit')->name('parentcat.storeedit');
    });
	Route::group(['prefix' => 'results'], function () {
        Route::get('/', 'ResultsController@index')->name('results');
    });
	Route::group(['prefix' => 'zone'], function () {
        Route::get('/', 'ZonesController@index')->name('zone');
        Route::get('create', 'ZonesController@create')->name('zone.create');
        Route::post('store', 'ZonesController@store')->name('zone.store');
        Route::get('edit/{id}', 'ZonesController@edit')->name('zone.edit');
        Route::post('storeedit', 'ZonesController@storeedit')->name('zone.storeedit');
        Route::delete('delete/{zoneid}', [
        'as' => 'zone.delete',
        'uses' => 'ZonesController@delete'
        ]);
    });
    Route::group(['prefix' => 'product'], function () {
       Route::get('/', 'ProductsController@index')->name('product');
        Route::get('create', 'ProductsController@create')->name('product.create');
        Route::post('store', 'ProductsController@store')->name('product.store');
        Route::get('edit/{id}', 'ProductsController@edit')->name('product.edit');
        Route::post('storeedit', 'ProductsController@storeedit')->name('product.storeedit');
         Route::delete('attrdelete/{attrid}', [
        'as' => 'product.attrdel',
        'uses' => 'ProductsController@attrdelete'
    ]);
        Route::delete('delete/{productid}', [
        'as' => 'product.delete',
        'uses' => 'ProductsController@delete'
    ]);
        
    });
     Route::group(['prefix' => 'job'], function () {
       Route::get('/', 'JobsController@index')->name('job');
        Route::get('create', 'JobsController@create')->name('job.create');
        Route::post('store', 'JobsController@store')->name('job.store');
        Route::get('edit/{id}', 'JobsController@edit')->name('job.edit');
        Route::post('storeedit', 'JobsController@storeedit')->name('job.storeedit');
        Route::delete('delete/{jobid}', [
        'as' => 'job.delete',
        'uses' => 'JobsController@delete'
    ]);
    Route::post('generate-child-category', 'JobsController@generateChildCategory')->name('job.generate-child-category');
    });
     
    Route::group(['prefix' => 'stockin'], function () {
       Route::get('/', 'StockinsController@index')->name('stockin');
        Route::get('create', 'StockinsController@create')->name('stockin.create');
        Route::post('store', 'StockinsController@store')->name('stockin.store');
        Route::get('edit/{id}', 'StockinsController@edit')->name('stockin.edit');
        Route::post('storeedit', 'StockinsController@storeedit')->name('stockin.storeedit');
        Route::delete('delete/{stockinid}', [
        'as' => 'stockin.delete',
        'uses' => 'StockinsController@delete'
    ]);

    });
    Route::group(['prefix' => 'subcat'], function () {
       Route::get('/', 'SubcategoryController@index')->name('subcat');
        Route::get('create', 'SubcategoryController@create')->name('subcat.create');
        Route::post('store', 'SubcategoryController@store')->name('subcat.store');
        Route::get('edit/{id}', 'SubcategoryController@edit')->name('subcat.edit');
        Route::post('storeedit', 'SubcategoryController@storeedit')->name('subcat.storeedit');
        Route::delete('delete/{subcatid}', [
        'as' => 'subcat.delete',
        'uses' => 'SubcategoryController@delete'
    ]);

    });
    Route::group(['prefix' => 'stockout'], function () {
       Route::get('/', 'StockoutsController@index')->name('stockout');
        Route::get('create', 'StockoutsController@create')->name('stockout.create');
        Route::post('store', 'StockoutsController@store')->name('stockout.store');
        Route::get('edit/{id}', 'StockoutsController@edit')->name('stockout.edit');
        Route::post('storeedit', 'StockoutsController@storeedit')->name('stockout.storeedit');
        Route::delete('delete/{stockoutid}', [
        'as' => 'stockout.delete',
        'uses' => 'StockoutsController@delete'
    ]);
    });
    Route::group(['prefix' => 'report'], function () {
       Route::get('/', 'ReportsController@index')->name('report');
           Route::post('showdetails', 'ReportsController@showDetails')->name('report.showdetails');
    
    });
    /**
     * Impersonate Routes
     */
    Route::impersonate();

    /**
     * Dashboard
     */

    Route::get('/', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index'
    ]);

    /**
     * User Profile
     */

    Route::get('profile', [
        'as' => 'profile',
        'uses' => 'ProfileController@index'
    ]);

    Route::get('profile/activity', [
        'as' => 'profile.activity',
        'uses' => 'ProfileController@activity'
    ]);

    Route::put('profile/details/update', [
        'as' => 'profile.update.details',
        'uses' => 'ProfileController@updateDetails'
    ]);

    Route::post('profile/avatar/update', [
        'as' => 'profile.update.avatar',
        'uses' => 'ProfileController@updateAvatar'
    ]);

    Route::post('profile/avatar/update/external', [
        'as' => 'profile.update.avatar-external',
        'uses' => 'ProfileController@updateAvatarExternal'
    ]);

    Route::put('profile/login-details/update', [
        'as' => 'profile.update.login-details',
        'uses' => 'ProfileController@updateLoginDetails'
    ]);

    /**
     * Two-Factor Authentication Setup
     */

    if (settings('2fa.enabled')) {
        Route::post('two-factor/enable', [
            'as' => 'two-factor.enable',
            'uses' => 'TwoFactorController@enable'
        ]);

        Route::get('two-factor/verification', [
            'as' => 'two-factor.verification',
            'uses' => 'TwoFactorController@verification',
            'middleware' => 'verify-2fa-phone'
        ]);

        Route::post('two-factor/resend', [
            'as' => 'two-factor.resend',
            'uses' => 'TwoFactorController@resend',
            'middleware' => ['throttle:1,1', 'verify-2fa-phone']
        ]);

        Route::post('two-factor/verify', [
            'as' => 'two-factor.verify',
            'uses' => 'TwoFactorController@verify',
            'middleware' => 'verify-2fa-phone'
        ]);

        Route::post('two-factor/disable', [
            'as' => 'two-factor.disable',
            'uses' => 'TwoFactorController@disable'
        ]);
    }

    /**
     * Sessions
     */

    Route::get('profile/sessions', [
        'as' => 'profile.sessions',
        'uses' => 'ProfileController@sessions'
    ]);

    Route::delete('profile/sessions/{session}/invalidate', [
        'as' => 'profile.sessions.invalidate',
        'uses' => 'ProfileController@invalidateSession'
    ]);

    /**
     * User Management
     */
    Route::get('/analytics', [
        'as' => 'home.analytics',
        'uses' => 'HomeController@googleAnalytics'
    ]);
   
    Route::get('user', [
        'as' => 'user.list',
        'uses' => 'UsersController@index'
    ]);

    Route::get('user/create', [
        'as' => 'user.create',
        'uses' => 'UsersController@create'
    ]);

    Route::post('user/create', [
        'as' => 'user.store',
        'uses' => 'UsersController@store'
    ]);

    Route::get('user/{user}/show', [
        'as' => 'user.show',
        'uses' => 'UsersController@view'
    ]);

    Route::get('user/{user}/edit', [
        'as' => 'user.edit',
        'uses' => 'UsersController@edit'
    ]);

    Route::put('user/{user}/update/details', [
        'as' => 'user.update.details',
        'uses' => 'UsersController@updateDetails'
    ]);

    Route::put('user/{user}/update/login-details', [
        'as' => 'user.update.login-details',
        'uses' => 'UsersController@updateLoginDetails'
    ]);

    Route::delete('user/{user}/delete', [
        'as' => 'user.delete',
        'uses' => 'UsersController@delete'
    ]);

    Route::post('user/{user}/update/avatar', [
        'as' => 'user.update.avatar',
        'uses' => 'UsersController@updateAvatar'
    ]);

    Route::post('user/{user}/update/avatar/external', [
        'as' => 'user.update.avatar.external',
        'uses' => 'UsersController@updateAvatarExternal'
    ]);

    Route::get('user/{user}/sessions', [
        'as' => 'user.sessions',
        'uses' => 'UsersController@sessions'
    ]);

    Route::delete('user/{user}/sessions/{session}/invalidate', [
        'as' => 'user.sessions.invalidate',
        'uses' => 'UsersController@invalidateSession'
    ]);

    Route::post('user/{user}/two-factor/enable', [
        'as' => 'user.two-factor.enable',
        'uses' => 'UsersController@enableTwoFactorAuth'
    ]);

    Route::post('user/{user}/two-factor/disable', [
        'as' => 'user.two-factor.disable',
        'uses' => 'UsersController@disableTwoFactorAuth'
    ]);

    /**
     * Roles & Permissions
     */

    Route::get('role', [
        'as' => 'role.index',
        'uses' => 'RolesController@index'
    ]);

    Route::get('role/create', [
        'as' => 'role.create',
        'uses' => 'RolesController@create'
    ]);

    Route::post('role/store', [
        'as' => 'role.store',
        'uses' => 'RolesController@store'
    ]);

    Route::get('role/{role}/edit', [
        'as' => 'role.edit',
        'uses' => 'RolesController@edit'
    ]);

    Route::put('role/{role}/update', [
        'as' => 'role.update',
        'uses' => 'RolesController@update'
    ]);

    Route::delete('role/{role}/delete', [
        'as' => 'role.delete',
        'uses' => 'RolesController@delete'
    ]);


    Route::post('permission/save', [
        'as' => 'permission.save',
        'uses' => 'PermissionsController@saveRolePermissions'
    ]);

    Route::resource('permission', 'PermissionsController');

    /**
     * Settings
     */

    Route::get('settings', [
        'as' => 'settings.general',
        'uses' => 'SettingsController@general',
        'middleware' => 'permission:settings.general'
    ]);

    Route::post('settings/general', [
        'as' => 'settings.general.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'permission:settings.general'
    ]);

    Route::get('settings/auth', [
        'as' => 'settings.auth',
        'uses' => 'SettingsController@auth',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::post('settings/auth', [
        'as' => 'settings.auth.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'permission:settings.auth'
    ]);

// Only allow managing 2FA if AUTHY_KEY is defined inside .env file
    if (env('AUTHY_KEY')) {
        Route::post('settings/auth/2fa/enable', [
            'as' => 'settings.auth.2fa.enable',
            'uses' => 'SettingsController@enableTwoFactor',
            'middleware' => 'permission:settings.auth'
        ]);

        Route::post('settings/auth/2fa/disable', [
            'as' => 'settings.auth.2fa.disable',
            'uses' => 'SettingsController@disableTwoFactor',
            'middleware' => 'permission:settings.auth'
        ]);
    }

    Route::post('settings/auth/registration/captcha/enable', [
        'as' => 'settings.registration.captcha.enable',
        'uses' => 'SettingsController@enableCaptcha',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::post('settings/auth/registration/captcha/disable', [
        'as' => 'settings.registration.captcha.disable',
        'uses' => 'SettingsController@disableCaptcha',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::get('settings/notifications', [
        'as' => 'settings.notifications',
        'uses' => 'SettingsController@notifications',
        'middleware' => 'permission:settings.notifications'
    ]);

    Route::post('settings/notifications', [
        'as' => 'settings.notifications.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'permission:settings.notifications'
    ]);

    /**
     * Activity Log
     */

    Route::get('activity', [
        'as' => 'activity.index',
        'uses' => 'ActivityController@index'
    ]);

    Route::get('activity/user/{user}/log', [
        'as' => 'activity.user',
        'uses' => 'ActivityController@userActivity'
    ]);

});


/**
 * Installation
 */

$router->get('install', [
    'as' => 'install.start',
    'uses' => 'InstallController@index'
]);

$router->get('install/requirements', [
    'as' => 'install.requirements',
    'uses' => 'InstallController@requirements'
]);

$router->get('install/permissions', [
    'as' => 'install.permissions',
    'uses' => 'InstallController@permissions'
]);

$router->get('install/database', [
    'as' => 'install.database',
    'uses' => 'InstallController@databaseInfo'
]);

$router->get('install/start-installation', [
    'as' => 'install.installation',
    'uses' => 'InstallController@installation'
]);

$router->post('install/start-installation', [
    'as' => 'install.installation',
    'uses' => 'InstallController@installation'
]);

$router->post('install/install-app', [
    'as' => 'install.install',
    'uses' => 'InstallController@install'
]);

$router->get('install/complete', [
    'as' => 'install.complete',
    'uses' => 'InstallController@complete'
]);

$router->get('install/error', [
    'as' => 'install.error',
    'uses' => 'InstallController@error'
]);
