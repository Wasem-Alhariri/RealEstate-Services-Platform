<?php

use App\Events\MessageSent;
use App\Http\Controllers\Web\CityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\FCMController;
use App\Http\Controllers\Web\ActivityController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\BusinessAccountController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\DynamicFieldController;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\ServiceReportController;
use App\Http\Controllers\Web\SliderController;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Login 
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:web']], function () {

    // logout & FCM 
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('fcm/register-token', [FCMController::class, 'store'])->defaults('guardName', 'web');

    // Notifications
    Route::prefix('notifications/')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/{notification}/read', [NotificationController::class, 'readAndRedirect'])->name('notifications.readAndRedirect');
        Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
        Route::delete('/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    });

    // Admins
    Route::group(['middleware' => ['permission:view-admins']], function () {
        Route::get('admins', [AdminController::class, 'index'])->name('admins.index');
    });
    Route::group(['middleware' => ['permission:create-admins']], function () {
        Route::get('admins/create', [AdminController::class, 'create'])->name('admins.create');
        Route::post('admins', [AdminController::class, 'store'])->name('admins.store');
    });
    Route::group(['middleware' => ['permission:edit-admins']], function () {
        Route::get('admins/edit/{admin}', [AdminController::class, 'edit'])->name('admins.edit');
        Route::put('admins/{admin}', [AdminController::class, 'update'])->name('admins.update');
    });
    Route::group(['middleware' => ['permission:delete-admins']], function () {
        Route::delete('admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');
    });

    // Roles
    Route::group(['middleware' => ['permission:view-roles']], function () {
        Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    });
    Route::group(['middleware' => ['permission:create-roles']], function () {
        Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    });
    Route::group(['middleware' => ['permission:edit-roles']], function () {
        Route::get('roles/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    });
    Route::group(['middleware' => ['permission:delete-roles']], function () {
        Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    // Cities
    Route::group(['middleware' => ['permission:view-cities']], function () {
        Route::get('cities', [CityController::class, 'index'])->name('cities.index');
    });
    Route::group(['middleware' => ['permission:create-cities']], function () {
        Route::get('cities/create', [CityController::class, 'create'])->name('cities.create');
        Route::post('cities', [CityController::class, 'store'])->name('cities.store');
    });
    Route::group(['middleware' => ['permission:edit-cities']], function () {
        Route::get('cities/edit/{city}', [CityController::class, 'edit'])->name('cities.edit');
        Route::put('cities/{city}', [CityController::class, 'update'])->name('cities.update');
    });
    Route::group(['middleware' => ['permission:delete-cities']], function () {
        Route::delete('cities/{city}', [CityController::class, 'destroy'])->name('cities.destroy');
    });

    // Activities
    Route::group(['middleware' => ['permission:view-activities']], function () {
        Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    });
    Route::group(['middleware' => ['permission:create-activities']], function () {
        Route::get('activities/create', [ActivityController::class, 'create'])->name('activities.create');
        Route::post('activities', [ActivityController::class, 'store'])->name('activities.store');
    });
    Route::group(['middleware' => ['permission:edit-activities']], function () {
        Route::get('activities/edit/{activity}', [ActivityController::class, 'edit'])->name('activities.edit');
        Route::put('activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
    });
    Route::group(['middleware' => ['permission:delete-activities']], function () {
        Route::delete('activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');
    });

    // Business Accounts
    Route::group(['middleware' => ['permission:view-business-accounts']], function () {
        Route::get('business-accounts', [BusinessAccountController::class, 'index'])->name('business-accounts.index');
        Route::get('business-accounts/{businessAccount}', [BusinessAccountController::class, 'show'])->name('business-accounts.show');
    });
    Route::group(['middleware' => ['permission:manage-business-accounts']], function () {
        Route::post('business-accounts/update/{businessAccount}', [BusinessAccountController::class, 'updateStatus'])->name('business-accounts.update-status');
    });


    // Categories - Main & Sub
    Route::group(['middleware' => ['permission:view-categories']], function () {
        Route::get('categories/main', [CategoryController::class, 'indexMain'])->name('categories.main.index');
        Route::get('categories/sub', [CategoryController::class, 'indexSub'])->name('categories.sub.index');
    });
    Route::group(['middleware' => ['permission:create-categories']], function () {
        Route::get('categories/main/create', [CategoryController::class, 'createMain'])->name('categories.main.create');
        Route::get('categories/sub/create', [CategoryController::class, 'createSub'])->name('categories.sub.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    });
    Route::group(['middleware' => ['permission:edit-categories']], function () {
        Route::get('categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    });
    Route::group(['middleware' => ['permission:delete-categories']], function () {
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // Dynamic Fields
    Route::prefix('categories/fields/')->group(function () {
        Route::group(['middleware' => ['permission:view-dynamic-fields']], function () {
            Route::get('{category}', [DynamicFieldController::class, 'index'])->name('categories.fields.index');
        });
        Route::group(['middleware' => ['permission:create-dynamic-fields']], function () {
            Route::get('{category}/create', [DynamicFieldController::class, 'create'])->name('categories.fields.create');
            Route::post('{category}', [DynamicFieldController::class, 'store'])->name('categories.fields.store');
        });
        Route::group(['middleware' => ['permission:edit-dynamic-fields']], function () {
            Route::get('{dynamicField}/{category}/edit', [DynamicFieldController::class, 'edit'])->name('categories.fields.edit');
            Route::put('{dynamicField}/{category}', [DynamicFieldController::class, 'update'])->name('categories.fields.update');
        });
        Route::group(['middleware' => ['permission:delete-dynamic-fields']], function () {
            Route::delete('{dynamicField}/{category}', [DynamicFieldController::class, 'destroy'])->name('categories.fields.destroy');
        });
    });

    // Services
    Route::prefix('services/')->group(function () {
        Route::group(['middleware' => ['permission:view-services']], function () {
            Route::get('/', [ServiceController::class, 'index'])->name('services.index');
            Route::get('/{service}', [ServiceController::class, 'show'])->name('services.show');
        });
        Route::group(['middleware' => ['permission:manage-services']], function () {
            Route::post('update/{service}', [ServiceController::class, 'updateStatus'])->name('services.update-status');
        });
    });

    // reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::group(['middleware' => ['permission:view-reports']], function () {
            Route::get('/', [ServiceReportController::class, 'index'])->name('index');
        });
        Route::group(['middleware' => ['permission:manage-reports']], function () {
            Route::post('/{report}/resolve', [ServiceReportController::class, 'resolve'])->name('resolve');
        });
        Route::group(['middleware' => ['permission:delete-reports']], function () {
            Route::delete('/{report}', [ServiceReportController::class, 'destroy'])->name('destroy');
        });
    });

    // sliders
    Route::group(['prefix' => 'sliders', 'as' => 'sliders.'], function () {
        Route::middleware(['permission:view-sliders'])->group(function () {
            Route::get('/', [SliderController::class, 'index'])->name('index');
        });
        Route::middleware(['permission:create-sliders'])->group(function () {
            Route::get('/create', [SliderController::class, 'create'])->name('create');
            Route::post('/', [SliderController::class, 'store'])->name('store');
        });
        Route::middleware(['permission:edit-sliders'])->group(function () {
            Route::get('/{slider}/edit', [SliderController::class, 'edit'])->name('edit');
            Route::put('/{slider}', [SliderController::class, 'update'])->name('update');
            Route::post('/{slider}/toggle-status', [SliderController::class, 'toggleStatus'])->name('toggle-status');
        });
        Route::middleware(['permission:delete-sliders'])->group(function () {
            Route::delete('/{slider}', [SliderController::class, 'destroy'])->name('destroy');
        });
    });

    // profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/security', [ProfileController::class, 'security'])->name('security');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
        Route::put('/avatar', [ProfileController::class, 'updateAvatar'])->name('avatar.update');
    });

    // lang
    Route::get('locale/{lang}', function ($lang) {
        $supportedLanguages = ['en', 'ar'];
        if (in_array($lang, $supportedLanguages)) {
            session(['locale' => $lang]);
        }
        return redirect()->back();
    })->name('locale');

    // Dashboard home
    Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');
});




// chat (private channel)

Route::post("/send-message", function (Request $request) {
    $message = $request->message;
    $receiverId = $request->receiver_id;

    broadcast(new MessageSent($message, auth('web')->id(), $receiverId))->toOthers();

    return response()->json(['status' => 'Message Sent!']);
});

Route::get('chat/{id}', function (int $id) {
    $receiver = Admin::with('media')->findOrFail($id);
    $sender = auth('web')->user();

    return view('chat', compact('receiver'));
})->middleware('auth:web')->name('chat');

Route::get('login/{id}', function (int $id) {
    $user = Admin::findOrFail($id);

    Auth::login($user);
});
