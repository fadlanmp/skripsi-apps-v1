<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardKitabController;
use App\Http\Controllers\UstadController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfilController;

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
    return view('landingpage', [
        "title" => "Landingpage",
        "active" => 'home',
        "image" => "heroes.jpg"
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "active" => 'about',
        "nama" => "Manarul Hasan",
        "email" => "manaruhasankotabanjar@gmail.com",
        "image" => "logo.png"
    ]);
});


Route::get('/posts', [PostController::class, 'index']);
// Halaman single post
Route::get('/posts/{post:slug}', [PostController::class, 'show']);


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/dashboard/profil', [ProfilController::class, 'index'])->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

// Route::resource('/dashboard/posts', DashboardPostController::class)->scoped(['post' => 'slug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');



Route::get('/dashboard/kitabs/checkSlug', [DashboardKitabController::class, 'checkSlug'])->middleware('auth');

Route::resource('/dashboard/kitabs', DashboardKitabController::class)->middleware('auth');

Route::post('/dashboard/ustads/{ustad}/reset', [UstadController::class, 'reset']);
Route::resource('/dashboard/ustads', UstadController::class)->middleware('auth');

Route::post('/dashboard/santris/{santri}/reset', [SantriController::class, 'reset']);
Route::resource('/dashboard/santris', SantriController::class)->middleware('auth');

Route::resource('/dashboard/nilais', NilaiController::class)->middleware('auth');


// Route::post('/dashboard/password/{user}/reset', [PasswordController::class, 'reset']);
Route::get('/dashboard/password/{user}', [PasswordController::class, 'index']);
Route::put('/dashboard/password/{user}', [PasswordController::class, 'update']);
