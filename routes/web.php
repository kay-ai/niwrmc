<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DischargeWaterWasteFormController as DischargeWater;
use App\Http\Controllers\AmendmentOfLicenseFormController as AmendmentOfLicense;
use App\Http\Controllers\ApplicationFormController;
use App\Http\Controllers\BoreHoleContractorLicenseFormController as BoreHoleContractor;
use App\Http\Controllers\DrillersLicenseFormController as DrillersLicense;
use App\Http\Controllers\LicenseCategoryController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\LicenseSubCategoryController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PricingController;
use App\Models\LicenseCategory;
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

Route::middleware('auth:customer')->group(function () {
    Route::controller(PagesController::class)->group(function () {
        Route::get('/apply-license', 'applyLicense')->name('apply.license');
        Route::get('/customer-dashboard', 'customerDashboard')->name('customer-dashboard');
    });

    Route::controller(LicenseController::class)->group(function () {
        Route::get('/customer-licenses', 'customerLicense')->name('customer.license');
    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/customer-invoices', 'customerInvoices')->name('customer.invoices');
        Route::post('/generate-invoice', 'generateInvoice')->name('generate.invoice');
        Route::get('/view-invoice/{id}', 'viewInvoice')->name('view.invoice');
    });

    Route::controller(PaymentController::class)->group(function () {
        Route::get('/customer-payments', 'customerPayments')->name('customer.payments');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('/user-logout', [LoginController::class, 'logoutUser'])->name('logout.user');

    Route::controller(PagesController::class)->group(function () {
        Route::get('/user-dashboard', 'dashboard')->name('user-dashboard');
    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoices', 'invoices')->name('invoices');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers', 'index')->name('customers.index');
    });

    Route::controller(PaymentController::class)->group(function () {
        Route::get('/payments', 'index')->name('payments');
    });

    Route::controller(PricingController::class)->group(function () {
        Route::get('/license-prices', 'index')->name('pricing.index');
        Route::post('/create-price', 'create')->name('pricing.create');
        Route::get('/delete-pricing/{id}', 'destroy')->name('pricing.delete');
    });

    Route::controller(LicenseController::class)->group(function () {
        Route::post('/license-approve/{id}/{slug}', 'approveLicense')->name('license.approve');
        Route::post('/license-generate/{id}', 'generateLicense')->name('license.generate');
        Route::get('/licenses', 'index')->name('license.index');
        Route::post('/license/{id}/delete', 'destroy')->name('license.delete');
    });

    Route::controller(LicenseCategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::post('/categories/create', 'create')->name('categories.create');
        Route::post('/categories/{id}/delete', 'destroy')->name('categories.delete');
    });

    Route::controller(LicenseSubCategoryController::class)->group(function () {
        Route::get('/subcategories', 'index')->name('subcategories.index');
        Route::post('/subcategories/create', 'create')->name('subcategories.create');
        Route::post('/subcategories/{id}/delete', 'destroy')->name('subcategories.delete');
    });
});

Route::controller(InvoiceController::class)->group(function () {
    Route::get('/view-invoice/{id}', 'viewInvoice')->name('view.invoice');
});

Route::controller(PaymentController::class)->group(function () {
    Route::post('/payments/upload/{id}', 'uploadReceipt')->name('upload.receipt');
    Route::post('/payments/verify/{id}', 'verify')->name('payments.verify');
    Route::post('/view-receipt', 'viewReceipt')->name('view.receipt');
});

Route::controller(PagesController::class)->group(function () {
    Route::post('/view-document', 'viewDocument')->name('view.document');
});

Route::controller(ApplicationFormController::class)->group(function () {
    Route::get('/application-form', 'index')->name('apply.index');
    Route::get('/application-form/clear/documents', 'clearDocuments')->name('apply.clear.documents');
    Route::post('/application-form', 'saveCustomer')->name('apply.save.customer');
    Route::get('/application-form-step1', 'getFormStep1')->name('apply.getFormStep1');
    Route::post('/application-form-step1', 'saveFormStep1')->name('apply.saveFormStep1');
    Route::get('/application-form-step2', 'getFormStep2')->name('apply.getFormStep2');
    Route::post('/application-form-step2', 'saveFormStep2')->name('apply.saveFormStep2');
    Route::get('/application-form-step3', 'getFormStep3')->name('apply.getFormStep3');
    Route::get('/application-form-step4/{application_id}', 'getFormStep4')->name('apply.getFormStep4');
    Route::get('/application-form-step5', 'getFormStep5')->name('apply.getFormStep5');
});

Route::middleware('guest:customer')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::controller(LoginController::class)->group(function () {
        Route::post('/login', 'attemptLogin')->name('attempt.login');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::post('/register', 'create')->name('attempt.register');
    });
});

Route::middleware('guest')->group(function () {
    Route::get('/user-login', function () {
        return view('auth.login');
    })->name('user-login');

    Route::controller(LoginController::class)->group(function () {
        Route::post('/user-login', 'attemptLogin')->name('attempt.login');
    });
});

Route::post('/customer-logout', [LoginController::class, 'logoutCustomer'])->name('logout.customer');

