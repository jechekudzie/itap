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
use App\Http\Controllers\EquipmentCategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ServicePackageController;
use App\Http\Controllers\PackageCategoryController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SpecificationTemplateController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Equipment Categories Routes
Route::prefix('admin')->group(function () {
    // Admin dashboard routes
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::get('index', function () {
        return view('backend.index');
    })->name('admin.index');

    // Organisation Types Routes
    Route::get('organisation-types', [OrganisationTypeController::class, 'index'])->name('admin.organisation-types.index');
    Route::post('organisation-types/store', [OrganisationTypeController::class, 'store'])->name('admin.organisation-types.store');
    Route::post('organisation-types/{organisationType}', [OrganisationTypeController::class, 'organisationTypeOrganisation'])->name('admin.organisation-types.organisation-type');

    // Organisations Routes
    Route::get('organisations', [OrganisationsController::class, 'index'])->name('admin.organisations.index');
    Route::post('organisations/store', [OrganisationsController::class, 'store'])->name('admin.organisations.store');
    Route::patch('organisations/{organisation}/update', [OrganisationsController::class, 'update'])->name('admin.organisations.update');
    Route::delete('organisations/{organisation}', [OrganisationsController::class, 'destroy'])->name('admin.organisations.destroy');
    Route::get('organisations/manage', [OrganisationsController::class, 'manageOrganisations'])->name('admin.organisations.manage');

    // Organisation Roles Routes
    Route::get('organisation-roles/{organisation}', [OrganisationRolesController::class, 'index'])->name('admin.organisation-roles.index');
    Route::post('organisation-roles/{organisation}/store', [OrganisationRolesController::class, 'store'])->name('admin.organisation-roles.store');
    Route::get('organisation-roles/{role}/edit', [OrganisationRolesController::class, 'edit'])->name('admin.organisation-roles.edit');
    Route::patch('organisation-roles/{role}/update', [OrganisationRolesController::class, 'update'])->name('admin.organisation-roles.update');
    Route::delete('organisation-roles/{role}', [OrganisationRolesController::class, 'destroy'])->name('admin.organisation-roles.destroy');

    // Organisation Users Routes
    Route::get('organisation-users/{organisation}', [OrganisationUsersController::class, 'index'])->name('admin.organisation-users.index');
    Route::post('organisation-users/{organisation}/store', [OrganisationUsersController::class, 'store'])->name('admin.organisation-users.store');
    Route::patch('organisation-users/{user}/update', [OrganisationUsersController::class, 'update'])->name('admin.organisation-users.update');
    Route::delete('organisation-users/{user}/{organisation}', [OrganisationUsersController::class, 'destroy'])->name('admin.organisation-users.destroy');

    // Permissions Routes
    Route::get('permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::post('permissions/store', [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::patch('permissions/{permission}/update', [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');
    Route::get('permissions/{organisation}/{role}/assignPermission', [PermissionController::class, 'assignPermission'])->name('admin.permissions.assign');
    Route::post('permissions/{organisation}/{role}/assignPermissionToRole', [PermissionController::class, 'assignPermissionToRole'])->name('admin.permissions.assign-permission-to-role');

    // Services Routes
    Route::resource('services', ServiceController::class);

    // Line Item Categories Routes
    Route::resource('categories', LineItemCategoryController::class);

    // Line Items Routes
    Route::get('line_items/index/{category}', [LineItemController::class, 'index'])->name('line_items.index');
    Route::get('line_items/create/{category}', [LineItemController::class, 'create'])->name('line_items.create');
    Route::post('line_items/store', [LineItemController::class, 'store'])->name('line_items.store');
    Route::get('line_items/{lineItem}', [LineItemController::class, 'show'])->name('line_items.show');
    Route::get('line_items/{lineItem}/edit', [LineItemController::class, 'edit'])->name('line_items.edit');
    Route::patch('line_items/{lineItem}', [LineItemController::class, 'update'])->name('line_items.update');
    Route::delete('line_items/{lineItem}', [LineItemController::class, 'destroy'])->name('line_items.destroy');

    // Package Categories Routes
    Route::resource('package-categories', PackageCategoryController::class);

    // Packages Routes
    Route::resource('packages', PackageController::class);

    // Service Package Routes
    Route::get('service-package/{service}/index', [ServicePackageController::class, 'index'])->name('service-packages.index');
    Route::post('service-package/{service}/store', [ServicePackageController::class, 'store'])->name('service-packages.store');
    Route::get('service-package/{service}/{servicePackage}/edit', [ServicePackageController::class, 'edit'])->name('service-packages.edit');
    Route::patch('service-package/{service}/{servicePackage}/update', [ServicePackageController::class, 'update'])->name('service-packages.update');
    Route::delete('service-package/{service}/{servicePackage}', [ServicePackageController::class, 'destroy'])->name('service-packages.destroy');

    // Service Package Line Items Routes
    Route::get('service-package-line-items/{servicePackage}/line-items/create', [ServicePackageLineItemController::class, 'create'])->name('service-packages.line-items.create');
    Route::post('service-package-line-items/{servicePackage}/line-items', [ServicePackageLineItemController::class, 'store'])->name('service-packages.line-items.store');
    Route::get('service-package-line-items/{servicePackage}/line-items/{lineItem}/edit', [ServicePackageLineItemController::class, 'edit'])->name('service-packages.line-items.edit');
    Route::patch('service-package-line-items/{servicePackage}/line-items/{lineItem}', [ServicePackageLineItemController::class, 'update'])->name('service-packages.line-items.update');
    Route::delete('service-package-line-items/{servicePackage}/line-items/{lineItem}', [ServicePackageLineItemController::class, 'destroy'])->name('service-packages.line-items.destroy');

    // Bookings Routes
    Route::resource('bookings', BookingController::class);

    // Equipment Routes (your new routes)
    Route::resource('equipment', EquipmentController::class);

    // Equipment Categories Routes
    Route::get('equipment-categories', [EquipmentCategoryController::class, 'index'])->name('equipment-categories.index');
    Route::get('equipment-categories/create', [EquipmentCategoryController::class, 'create'])->name('equipment-categories.create');
    Route::post('equipment-categories', [EquipmentCategoryController::class, 'store'])->name('equipment-categories.store');
    Route::get('equipment-categories/{equipment_category}', [EquipmentCategoryController::class, 'show'])->name('equipment-categories.show');
    Route::get('equipment-categories/{equipment_category}/edit', [EquipmentCategoryController::class, 'edit'])->name('equipment-categories.edit');
    Route::patch('equipment-categories/{equipment_category}', [EquipmentCategoryController::class, 'update'])->name('equipment-categories.update');
    Route::delete('equipment-categories/{equipment_category}', [EquipmentCategoryController::class, 'destroy'])->name('equipment-categories.destroy');

    // Specification Templates Routes
    Route::get('specification-templates/{equipmentCategory}', [SpecificationTemplateController::class, 'index'])
        ->name('specification-templates.index');

    Route::get('specification-templates/{equipmentCategory}/create', [SpecificationTemplateController::class, 'create'])
        ->name('specification-templates.create');

    Route::post('specification-templates/{equipmentCategory}', [SpecificationTemplateController::class, 'store'])
        ->name('specification-templates.store');

    Route::get('specification-templates/{equipmentCategory}/{template}', [SpecificationTemplateController::class, 'show'])
        ->name('specification-templates.show');

    Route::get('specification-templates/{equipmentCategory}/{template}/edit', [SpecificationTemplateController::class, 'edit'])
        ->name('specification-templates.edit');

    Route::put('specification-templates/{equipmentCategory}/{template}', [SpecificationTemplateController::class, 'update'])
        ->name('specification-templates.update');

    Route::delete('specification-templates/{equipmentCategory}/{template}', [SpecificationTemplateController::class, 'destroy'])
        ->name('specification-templates.destroy');

    // Get Specification Templates for Equipment Category
    Route::get('equipment-categories/{categoryId}/specification-templates',
    [EquipmentCategoryController::class, 'getSpecificationTemplates'])
    ->name('equipment-categories.specification-templates');
});
