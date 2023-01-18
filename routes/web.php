<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\NominationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProgramsController;
use App\Http\Livewire\Forms\Entry as EntryForm;
//use App\Http\Controllers\Order;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('page.index');
})->name('home');

Route::get('/leader', function () {
    return view('page.leader');
})->name('leader');

Route::get('/orgzdrav', function () {
    return view('page.orgzdrav');
})->name('orgzdrav');

Route::get('/practices', function () {
    return view('entry.index');
})->name('practices');

Route::get('/entry/pdf/{id}', [EntryController::class, 'generatePdf']);

Route::get('/account', 'App\Http\Controllers\ProfileController@index')->middleware(['auth'])->name('account');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/account/entry/create', EntryForm::class);
Route::get('/account/entry/{id?}', EntryForm::class);
Route::get('/like/entry/{id?}', [\App\Http\Controllers\LikeController::class, 'init']);

Route::resource('entries', EntryController::class);
Route::resource('nominations', NominationController::class);
Route::resource('news', NewsController::class);
Route::resource('speaker', SpeakersController::class);
Route::resource('program', ProgramsController::class);

/**
 * Sber
 */
Route::get('/order/create', function () {
    return view('order.create');
});

Route::get('order/confirm/{id?}', [OrderController::class, 'confirm']);
Route::get('order/payment/success', [OrderController::class, 'success']);
Route::get('order/payment/failure', [OrderController::class, 'failure']);
Route::get('order/latest', [OrderController::class, 'getOrdersByUpdate']);

/**
 * Admin
 */
Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['role:admin'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () {
    Route::crud('user', 'UserCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('permission', 'PermissionCrudController');
    Route::crud('entry_likes', 'EntryLikesCrudController');
    Route::crud('expert_reviews', 'ExpertReviewsCrudController');
});

/**
 * Man
 */
Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['role:manager|admin'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () {
    Route::crud('news', 'NewsCrudController');
    Route::crud('pages', 'PagesCrudController');
    Route::crud('nomination', 'NominationCrudController');
    Route::crud('entry', 'EntryCrudController');
    Route::crud('event', EventCrudController::class);
    Route::crud('shows', 'ShowsCrudController');
    Route::crud('partners', 'PartnersCrudController');
    Route::crud('reviews', 'ReviewsCrudController');
    Route::crud('programs', 'ProgramCrudController');
    Route::crud('quotes', 'QuotesCrudController');
    Route::crud('faqs', 'FaqsCrudController');
    Route::crud('speakers', 'SpeakerCrudController');
    Route::crud('gallery', 'GalleryCrudController');
    Route::crud('orders', 'OrderCrudController');
    Route::crud('order_status', 'OrderStatusCrudController');
    Route::crud('services', 'ServicesCrudController');
});

require __DIR__ . '/auth.php';
