<?php

use App\Http\Controllers\LineItemCategoryController;
use App\Http\Controllers\LineItemController;
use App\Http\Controllers\OrganisationRolesController;
use App\Http\Controllers\OrganisationsController;
use App\Http\Controllers\OrganisationTypeController;
use App\Http\Controllers\OrganisationUsersController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ServicePackageLineItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
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


//routes for site service-packages
Route::get('/web/service-packages/{service}', [\App\Http\Controllers\SiteController::class, 'servicePackage'])->name('web.service-packages');
Route::get('/web/step1/{service}', [\App\Http\Controllers\SiteController::class, 'step1'])->name('booking-form');


Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');


Route::get('/admin/index', function () {
    return view('backend.index');
})->name('admin.index');



//Display all organisation types via API
Route::get('/admin/organisation-types', [OrganisationTypeController::class, 'index'])->name('admin.organisation-types.index');
//Create new organisation types directly
Route::post('/admin/organisation-types/store', [OrganisationTypeController::class, 'store'])->name('admin.organisation-types.store');
//add organisation type of organisation type
Route::post('/admin/organisation-types/{organisationType}', [OrganisationTypeController::class, 'organisationTypeOrganisation'])->name('admin.organisation-types.organisation-type');

//Display all organisations via API
Route::get('/admin/organisations', [OrganisationsController::class, 'index'])->name('admin.organisations.index');
Route::post('/admin/organisations/store', [OrganisationsController::class, 'store'])->name('admin.organisations.store');
Route::patch('/admin/organisations/{organisation}/update', [OrganisationsController::class, 'update'])->name('admin.organisations.update');
Route::delete('/admin/organisations/{organisation}', [OrganisationsController::class, 'destroy'])->name('admin.organisations.destroy');
Route::get('/admin/organisations/manage', [OrganisationsController::class, 'manageOrganisations'])->name('admin.organisations.manage');

//organisation roles routes pass organisation slug
Route::get('/admin/organisation-roles/{organisation}', [OrganisationRolesController::class, 'index'])->name('admin.organisation-roles.index');
Route::post('/admin/organisation-roles/{organisation}/store', [OrganisationRolesController::class, 'store'])->name('admin.organisation-roles.store');
Route::get('/admin/organisation-roles/{role}/edit', [OrganisationRolesController::class, 'edit'])->name('admin.organisation-roles.edit');
Route::patch('/admin/organisation-roles/{role}/update', [OrganisationRolesController::class, 'update'])->name('admin.organisation-roles.update');
Route::delete('/admin/organisation-roles/{role}', [OrganisationRolesController::class, 'destroy'])->name('admin.organisation-roles.destroy');

//routes for organisation users
Route::get('/admin/organisation-users/{organisation}', [OrganisationUsersController::class, 'index'])->name('admin.organisation-users.index');
Route::post('/admin/organisation-users/{organisation}/store', [OrganisationUsersController::class, 'store'])->name('admin.organisation-users.store');
Route::patch('/admin/organisation-users/{user}/update', [OrganisationUsersController::class, 'update'])->name('admin.organisation-users.update');
Route::delete('/admin/organisation-users/{user}/{organisation}', [OrganisationUsersController::class, 'destroy'])->name('admin.organisation-users.destroy');

//create permissions
Route::get('/admin/permissions', [\App\Http\Controllers\PermissionController::class, 'index'])->name('admin.permissions.index');
Route::post('/admin/permissions/store', [\App\Http\Controllers\PermissionController::class, 'store'])->name('admin.permissions.store');
Route::get('/admin/permissions/{permission}/edit', [\App\Http\Controllers\PermissionController::class, 'edit'])->name('admin.permissions.edit');
Route::patch('/admin/permissions/{permission}/update', [\App\Http\Controllers\PermissionController::class, 'update'])->name('admin.permissions.update');
Route::delete('/admin/permissions/{permission}', [\App\Http\Controllers\PermissionController::class, 'destroy'])->name('admin.permissions.destroy');

//assign permission to organisation roles
Route::get('/admin/permissions/{organisation}/{role}/assignPermission', [\App\Http\Controllers\PermissionController::class, 'assignPermission'])->name('admin.permissions.assign');
Route::post('/admin/permissions/{organisation}/{role}/assignPermissionToRole', [\App\Http\Controllers\PermissionController::class, 'assignPermissionToRole'])->name('admin.permissions.assign-permission-to-role');


// Routes for ServiceController
Route::get('/admin/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/admin/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/admin/services', [ServiceController::class, 'store'])->name('services.store');
Route::get('/admin/services/{service}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/admin/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::patch('/admin/services/{service}/update', [ServiceController::class, 'update'])->name('services.update');
Route::delete('/admin/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

// Routes for LineItemCategoryController
Route::get('/admin/categories', [LineItemCategoryController::class, 'index'])->name('categories.index');
Route::get('/admin/categories/create', [LineItemCategoryController::class, 'create'])->name('categories.create');
Route::post('/admin/categories', [LineItemCategoryController::class, 'store'])->name('categories.store');
Route::get('/admin/categories/{category}', [LineItemCategoryController::class, 'show'])->name('categories.show');
Route::get('/admin/categories/{category}/edit', [LineItemCategoryController::class, 'edit'])->name('categories.edit');
Route::patch('/admin/categories/{category}', [LineItemCategoryController::class, 'update'])->name('categories.update');
Route::delete('/admin/categories/{category}', [LineItemCategoryController::class, 'destroy'])->name('categories.destroy');

// Routes for LineItemController
Route::get('/admin/line_items/index/{category}', [LineItemController::class, 'index'])->name('line_items.index');
Route::get('/admin/line_items/create/{category}', [LineItemController::class, 'create'])->name('line_items.create');
Route::post('/admin/line_items/store', [LineItemController::class, 'store'])->name('line_items.store');
Route::get('/admin/line_items/{lineItem}', [LineItemController::class, 'show'])->name('line_items.show');
Route::get('/admin/line_items/{lineItem}/edit', [LineItemController::class, 'edit'])->name('line_items.edit');
Route::patch('/admin/line_items/{lineItem}', [LineItemController::class, 'update'])->name('line_items.update');
Route::delete('/admin/line_items/{lineItem}', [LineItemController::class, 'destroy'])->name('line_items.destroy');

//package categories routes
Route::get('/admin/package-categories', [\App\Http\Controllers\PackageCategoryController::class, 'index'])->name('package-categories.index');
Route::get('/admin/package-categories/create', [\App\Http\Controllers\PackageCategoryController::class, 'create'])->name('package-categories.create');
Route::post('/admin/package-categories/store', [\App\Http\Controllers\PackageCategoryController::class, 'store'])->name('package-categories.store');
Route::get('/admin/package-categories/{packageCategory}', [\App\Http\Controllers\PackageCategoryController::class, 'show'])->name('package-categories.show');
Route::get('/admin/package-categories/{packageCategory}/edit', [\App\Http\Controllers\PackageCategoryController::class, 'edit'])->name('package-categories.edit');
Route::patch('/admin/package-categories/{packageCategory}/update', [\App\Http\Controllers\PackageCategoryController::class, 'update'])->name('package-categories.update');
Route::delete('/admin/package-categories/{packageCategory}', [\App\Http\Controllers\PackageCategoryController::class, 'destroy'])->name('package-categories.destroy');


// Routes for PackageController
Route::get('/admin/packages', [PackageController::class, 'index'])->name('packages.index');
Route::post('/admin/packages', [PackageController::class, 'store'])->name('packages.store');
Route::get('/admin/packages/{package}', [PackageController::class, 'show'])->name('packages.show');
Route::get('/admin/packages/{package}/edit', [PackageController::class, 'edit'])->name('packages.edit');
Route::patch('/admin/packages/{package}/update', [PackageController::class, 'update'])->name('packages.update');
Route::delete('/admin/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');

//ServicePackageController
Route::get('/admin/service-package/{service}/index', [\App\Http\Controllers\ServicePackageController::class, 'index'])->name('service-packages.index');
Route::post('/admin/service-package/{service}/store', [\App\Http\Controllers\ServicePackageController::class, 'store'])->name('service-packages.store');
Route::get('/admin/service-package/{service}/{servicePackage}/edit', [\App\Http\Controllers\ServicePackageController::class, 'edit'])->name('service-packages.edit');
Route::patch('/admin/service-package/{service}/{servicePackage}/update', [\App\Http\Controllers\ServicePackageController::class, 'update'])->name('service-packages.update');
Route::delete('/admin/service-package/{service}/{servicePackage}', [\App\Http\Controllers\ServicePackageController::class, 'destroy'])->name('service-packages.destroy');


// Routes for PackageLineItemController
Route::get('/admin/service-package-line-items/{servicePackage}/line-items/create', [ServicePackageLineItemController::class, 'create'])->name('service-packages.line-items.create');
Route::post('/admin/service-package-line-items/{servicePackage}/line-items', [ServicePackageLineItemController::class, 'store'])->name('service-packages.line-items.store');
Route::get('/admin/service-package-line-items/{servicePackage}/line-items/{lineItem}/edit', [ServicePackageLineItemController::class, 'edit'])->name('service-packages.line-items.edit');
Route::patch('/admin/service-package-line-items/{servicePackage}/line-items/{lineItem}', [ServicePackageLineItemController::class, 'update'])->name('service-packages.line-items.update');
Route::delete('/admin/service-package-line-items//{servicePackage}/line-items/{lineItem}', [ServicePackageLineItemController::class, 'destroy'])->name('service-packages.line-items.destroy');


// Routes for Bookings
Route::get('/admin/bookings', [\App\Http\Controllers\BookingController::class, 'index'])->name('bookings.index');
Route::get('/admin/bookings/create', [\App\Http\Controllers\BookingController::class, 'create'])->name('bookings.create');
Route::post('/admin/bookings/store', [\App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
Route::get('/admin/bookings/{booking}', [\App\Http\Controllers\BookingController::class, 'show'])->name('bookings.show');
Route::get('/admin/bookings/{booking}/edit', [\App\Http\Controllers\BookingController::class, 'edit'])->name('bookings.edit');
Route::patch('/admin/bookings/{booking}/update', [\App\Http\Controllers\BookingController::class, 'update'])->name('bookings.update');
Route::delete('/admin/bookings/{booking}', [\App\Http\Controllers\BookingController::class, 'destroy'])->name('bookings.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
