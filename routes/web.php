<?php

use App\Models\DataManagement;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PopulationDataController;
use App\Http\Controllers\PovertyController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DataManagementController;
use App\Http\Controllers\AssistanceController;


Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard/filterKecamatan', [HomeController::class, 'filterKecamatan'])->name('dashboard.filterKecamatan');
	// Route::get('/dashboard/geojson', [HomeController::class, 'geojson'])->name('dashboard.geojson');
    Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/map', [MapController::class, 'index'])->name('map');
    Route::get('/map/filterKecamatan', [MapController::class, 'filterKecamatan'])->name('map.filterKecamatan');

    // user management
	Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management');
	Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user-management.create');
	Route::get('/user-management/edit/{id}', [UserManagementController::class, 'edit'])->name('user-management.edit');
	Route::get('/user-management/show/{id}', [UserManagementController::class, 'show'])->name('user-management.show');
    Route::get('/user-management/delete/{id}', [UserManagementController::class, 'confirmDelete'])->name('user-management.confirm-delete');
    Route::delete('/user-management/{id}', [UserManagementController::class, 'delete'])->name('user-management.delete');
    Route::patch('/user-management/{id}', [UserManagementController::class, 'update'])->name('user-management.update');
    Route::post('/user-management/store', [UserManagementController::class, 'store'])->name('user-management.store');
    // user management filter
    Route::post('/user-management/filter', [UserManagementController::class, 'FilterData'])->name('user-management.filterData');
    // Route::post('/user-management/filter', [UserManagementController::class, 'filter'])->name('user-management.filter');
    // Route::post('/user-management/filterKec', [UserManagementController::class, 'filterKec'])->name('user-management.filterKec');

    // Population Data
	Route::get('/population-data', [PopulationDataController::class, 'index'])->name('population-data');
	Route::get('/population-data/create', [PopulationDataController::class, 'create'])->name('population-data.create');
	Route::get('/population-data/edit/{id}', [PopulationDataController::class, 'edit'])->name('population-data.edit');
	Route::get('/population-data/show/{id}', [PopulationDataController::class, 'show'])->name('population-data.show');
    Route::get('/population-data/delete/{id}', [PopulationDataController::class, 'confirmDelete'])->name('population-data.confirm-delete');
    Route::delete('/population-data/{id}', [PopulationDataController::class, 'delete'])->name('population-data.delete');
    Route::patch('/population-data/{id}', [PopulationDataController::class, 'update'])->name('population-data.update');
    Route::post('/population-data/store', [PopulationDataController::class, 'store'])->name('population-data.store');

    // rumah tidak layak
	Route::get('/not_feasible', [PovertyController::class, 'index'])->name('not_feasible');
	Route::get('/not_feasible/create', [PovertyController::class, 'create'])->name('not_feasible.create');
	Route::get('/not_feasible/edit/{id}', [PovertyController::class, 'edit'])->name('not_feasible.edit');
	Route::get('/not_feasible/show/{id}', [PovertyController::class, 'show'])->name('not_feasible.show');
    Route::get('/not_feasible/delete/{id}', [PovertyController::class, 'confirmDelete'])->name('not_feasible.confirm-delete');
    //rumah layak huni
    Route::get('/worthy', [PovertyController::class, 'layakHuni'])->name('worthy');
    Route::get('/worthy/create', [PovertyController::class, 'create'])->name('worthy.create');

    Route::get('/poverty/getKecamatan', [PovertyController::class, 'getKecamatan'])->name('poverty.getKecamatan');
    Route::get('/poverty/getDesa/{id}', [PovertyController::class, 'getDesa'])->name('poverty.getDesa');
    Route::delete('/poverty/{id}', [PovertyController::class, 'delete'])->name('poverty.delete');
    Route::patch('/poverty/{id}', [PovertyController::class, 'update'])->name('poverty.update');
    Route::post('/poverty/store', [PovertyController::class, 'store'])->name('poverty.store');
     // Poverty Data filter
     Route::post('/poverty/filter', [PovertyController::class, 'FilterData'])->name('poverty.filterData');
     Route::post('/poverty/searchData', [PovertyController::class, 'searchData'])->name('poverty.searchData');
    // import dan export
    Route::get('/datamanagement', [DataManagementController::class, 'index'])->name('datamanagement');
    Route::get('/datamanagement/export', [DataManagementController::class, 'export'])->name('datamanagement.export');
    Route::post('/datamanagement/import', [DataManagementController::class, 'import'])->name('datamanagement.import');
    Route::get('/datamanagement/download-template', [DataManagementController::class, 'download'])->name('datamanagement.downloadTemplate');
    //bantuan
    Route::resource('assistance', App\Http\Controllers\AssistanceController::class);
    Route::get('/assistance/delete/{id}', [AssistanceController::class, 'confirmDelete'])->name('assistance.confirm-delete');
    Route::delete('/assistance/{id}', [AssistanceController::class, 'delete'])->name('assistance.delete');

    Route::get('/get-poverty-data', [AssistanceController::class, 'getPovertyData']);

    Route::get('/get-worthy-data', [PovertyController::class, 'layakHuni'])->name('worthy');

	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
