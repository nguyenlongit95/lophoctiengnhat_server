<?php

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
Route::group(['prefix' => '/admin', 'namespace' => '\App\Http\Controllers\Auth'], function () {
    Route::get('/login', 'LoginController@login');
    Route::post('/login', 'LoginController@postLogin');
    Route::get('/logout', 'LoginController@logout');
});

Route::get('login', '\App\Http\Controllers\FrontEnd\LoginController@login');
Route::post('login', '\App\Http\Controllers\FrontEnd\LoginController@postLogin');
Route::get('register', '\App\Http\Controllers\FrontEnd\LoginController@register');
Route::post('register', '\App\Http\Controllers\FrontEnd\LoginController@postRegister');
Route::get('logout', '\App\Http\Controllers\FrontEnd\LoginController@logout');
Route::get('forgot-password', '\App\Http\Controllers\FrontEnd\LoginController@forgotPassword');
Route::post('forgot-password', '\App\Http\Controllers\FrontEnd\LoginController@forgotPassword');

/**
 * Routing API charge pay gate
 */
Route::group(['prefix' => 'ngan-luong'], function () {
    Route::post('ngan-luong-init-payment', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'nganLuongInitPayment']);
    Route::get('success', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'nganLuongSuccessPayment']);
    Route::get('cancel', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'nganLuongCancelPayment']);
    Route::get('failed', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'nganLuongFailedPayment']);
});

Route::group(['prefix' => 'vn-pay'], function () {
    Route::post('vn-pay-init-payment', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'vnPayInitPayment']);
    Route::get('return', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'vnPayReturn']);
});

Route::group(['prefix' => 'momo'], function () {
    Route::post('momo-init-payment', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'momoInitPayment']);
    Route::get('result', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'momoResult']);
    Route::get('ipn', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'momoIPN']);
});

Route::group(['prefix' => 'paypal'], function () {
    Route::get('init-payment', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'payPalInitPayment']);
});

Route::get('/check-purchase', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'checkPurchase']);
Route::post('/purchase', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'purchase']);

/**
 * Route frontend free
 */
Route::group(['middleware' => 'frontendParam', 'namespace' => 'FrontEnd'], function () {
    // index router
     Route::get('', 'IndexController@index');
     Route::get('index', 'IndexController@index');
     Route::get('home', 'IndexController@index');
     Route::post('send-contact', 'IndexController@addContact');

     // Course online router
    Route::group(['prefix' => 'hoc-online-voi-gv'], function () {
        // TODO add route more course online
        Route::get('/{slug}', 'CourseOnlineController@show');
    });

    // Course level router
    Route::group(['prefix' => 'hoc-theo-cap-do'], function () {
        Route::get('/{slug}', 'CourseLevelController@show');
        Route::get('/{slug}/{course}', 'CourseLevelController@detail');
    });

    Route::group(['prefix' => 'hoc-theo-chuyen-de'], function () {
        Route::get('/{slug}', 'CourseThematicController@show');
        Route::get('/{course}/{slug}', 'CourseThematicController@detail');
    });

    Route::group(['prefix' => 'hoc-free-moi-ngay'], function () {
        Route::get('/gioi-thieu', 'CourseFreeController@index');
        Route::get('/{slug}', 'CourseFreeController@show');
    });

    Route::group(['prefix' => 'de-thi-online'], function () {
        Route::get('/{slug}', 'QuestionController@show');
        Route::get('{question}/{detail}', 'QuestionController@detail');
    });

    Route::group(['prefix' => 'tai-lieu'], function () {
        Route::get('/{slug}', 'DocumentController@index');
    });

    Route::group(['prefix' => 'hoc-vien'], function () {
        Route::get('/thong-tin', 'CustomerController@detail');
        Route::get('/cap-nhat', 'CustomerController@edit');
        Route::post('/update', 'CustomerController@update');
        Route::post('credit', 'CustomerController@credit');
    });
});

/**
 * Router callback after payment transaction
 */
Route::group(['prefix' => 'pay-gate-callback', 'namespace' => 'FrontEnd'], function () {
    // VNPAY
    Route::get('vn-pay', 'CustomerController@vnPayCallBack');
    // Ngan Luong
    Route::get('ngan-luong-success', 'CustomerController@nganLuongCallBack');
    // PayPal
    Route::get('pay-pal', 'CustomerController@payPalCallBack');
});

/**
 * Route frontend login
 */
Route::group(['middleware' => 'checkUserLogin', 'namespace' => 'FrontEnd'], function () {
    // Route front end has required login
});

/**
 * Route admin panel
 * Middelware
 */
Route::group(['middleware' => 'checkAdminLogin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'DashBoardController@index');

    Route::group(['prefix' => 'widgets'], function () {
        Route::get('/index', 'WidgetController@index');
        Route::post('{id}/update', 'WidgetController@update');
        Route::get('{id}/delete', 'WidgetController@delete');
        Route::post('create','WidgetController@create');
    });

    Route::group(['prefix' => 'paygates'], function () {
        Route::get('index', 'PaygateController@index');
        Route::get('{id}/edit', 'PaygateController@edit');
        Route::post('{id}/update', 'PaygateController@update');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('index', 'UserController@index');
        Route::get('{id}/edit', 'UserController@edit');
        Route::post('{id}/update', 'UserController@update');
        Route::get('{id}/delete', 'UserController@delete');
    });

    Route::group(['prefix' => 'menus'], function () {
        Route::get('index', 'MenuController@index');
        Route::get('{id}/edit', 'MenuController@edit');
        Route::post('{id}/update', 'MenuController@update');
        Route::post('create', 'MenuController@store');
        Route::get('show', 'MenuController@show');
        Route::get('create', 'MenuController@create');
        Route::get('{id}/delete', 'MenuController@destroy');
        Route::get('add', 'MenuController@add');
    });

    Route::group(['prefix' => 'pages'], function () {
        Route::get('index', 'PagesController@index');
        Route::get('create', 'PagesController@create');
        Route::post('store', 'PagesController@store');
        Route::get('{id}/edit', 'PagesController@edit');
        Route::post('{id}/update', 'PagesController@update');
        Route::get('{id}/delete', 'PagesController@destroy');
    });

    Route::group(['prefix' => 'course-online'], function () {
        Route::get('index', 'CourseOnlineController@index');
        Route::get('create', 'CourseOnlineController@create');
        Route::post('store', 'CourseOnlineController@store');
        Route::get('{id}/edit', 'CourseOnlineController@edit');
        Route::post('{id}/update', 'CourseOnlineController@update');
        Route::get('{id}/delete', 'CourseOnlineController@destroy');

        Route::post('/course-online-course/{id}/update', 'CourseOnlineController@updateCourseResource');
        Route::post('/course-online-course/create/{id}', 'CourseOnlineController@createCourseResource');
    });

    Route::group(['prefix' => 'course-level'], function () {
        Route::get('index', 'CourseLevelController@index');
        Route::get('create', 'CourseLevelController@create');
        Route::post('store', 'CourseLevelController@store');
        Route::get('{id}/edit', 'CourseLevelController@edit');
        Route::post('{id}/update', 'CourseLevelController@update');
        Route::get('{id}/delete', 'CourseLevelController@destroy');
    });

    Route::group(['prefix' => 'course-level-source'], function () {
        Route::post('store', 'CourseLevelSourceController@store');
        Route::post('{id}/update', 'CourseLevelSourceController@update');
        Route::get('{id}/delete', 'CourseLevelSourceController@destroy');
    });

    Route::group(['prefix' => 'course-level-quiz'], function () {
        Route::post('store', 'CourseLevelQuizController@store');
        Route::post('{id}/update', 'CourseLevelQuizController@update');
    });

    Route::group(['prefix' => 'course-thematic'], function () {
        Route::get('index', 'CourseThematicController@index');
        Route::get('create', 'CourseThematicController@create');
        Route::post('store', 'CourseThematicController@store');
        Route::get('{id}/edit', 'CourseThematicController@edit');
        Route::post('{id}/update', 'CourseThematicController@update');
        Route::get('{id}/delete', 'CourseThematicController@destroy');
    });

    Route::group(['prefix' => 'course-thematic-source'], function () {
        Route::post('store', 'CourseThematicSourceController@store');
        Route::post('{id}/update', 'CourseThematicSourceController@update');
        Route::get('{id}/delete', 'CourseThematicSourceController@destroy');
        Route::get('render-view-word/{id}/{courseId}', 'CourseThematicSourceController@renderViewWord');
        Route::post('word-edit/{id}', 'CourseThematicSourceController@wordEdit');
        Route::post('word-add', 'CourseThematicSourceController@wordAdd');
        Route::get('word-delete/{id}', 'CourseThematicSourceController@wordDelete');
    });

    Route::group(['prefix' => 'course-free'], function () {
        Route::get('index', 'CourseFreeController@index');
        Route::get('create', 'CourseFreeController@create');
        Route::post('store', 'CourseFreeController@store');
        Route::get('{id}/edit', 'CourseFreeController@edit');
        Route::post('{id}/update', 'CourseFreeController@update');
        Route::get('{id}/delete', 'CourseFreeController@destroy');
    });

    Route::group(['prefix' => 'course-free-source'], function () {
        Route::post('store', 'CourseFreeSourceController@store');
        Route::post('{id}/update', 'CourseFreeSourceController@update');
        Route::get('{id}/delete', 'CourseFreeSourceController@destroy');
    });

    Route::group(['prefix' => 'course-free-quiz'], function () {
        Route::post('store', 'CourseFreeQuizController@store');
        Route::post('{id}/update', 'CourseFreeQuizController@update');
    });

    Route::group(['prefix' => 'question'], function () {
        Route::get('index', 'QuestionController@index');
        Route::get('create', 'QuestionController@create');
        Route::post('store', 'QuestionController@store');
        Route::get('{id}/edit', 'QuestionController@edit');
        Route::post('{id}/update', 'QuestionController@update');
        Route::get('{id}/delete', 'QuestionController@destroy');
    });

    Route::group(['prefix' => 'question-detail'], function () {
        Route::post('store', 'QuestionDetailController@store');
        Route::post('{id}/update', 'QuestionDetailController@update');
    });

    Route::group(['prefix' => 'documentation'], function () {
        Route::get('index', 'DocumentationController@index');
        Route::get('create', 'DocumentationController@create');
        Route::post('store', 'DocumentationController@store');
        Route::get('{id}/edit', 'DocumentationController@edit');
        Route::post('{id}/update', 'DocumentationController@update');
        Route::get('{id}/delete', 'DocumentationController@destroy');
    });

    Route::group(['prefix' => 'doc-resource'], function () {
        Route::post('store', 'DocumentationResourceController@store');
        Route::post('{id}/update', 'DocumentationResourceController@update');
        Route::get('{id}/delete', 'DocumentationResourceController@destroy');
    });

    Route::group(['prefix' => 'e-wallet'], function () {
        Route::get('/index', 'EWalletController@index');
        Route::get('/{id}/detail', 'EWalletController@show');
        Route::post('/{id}/update', 'EWalletController@update');
        Route::get('/logs', 'EWalletController@listLogs');
    });

    /**
     * Demo route paygates
     */
    Route::group(['prefix' => 'ngan-luong'], function () {
        Route::get('direct-payment', 'DashBoardController@doDirectPayment');
        Route::any('success', 'DashBoardController@success');
    });

    Route::group(['prefix' => 'VNPAY'], function () {
        Route::get('direct-payment', 'DashBoardController@doDirectPayment');
    });

    Route::group(['prefix' => 'Paypal'], function () {
        Route::get('direct-payment', 'DashBoardController@paypalDirectPayment');
    });
});
