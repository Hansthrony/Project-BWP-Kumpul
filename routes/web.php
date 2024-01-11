<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CekAdmin;
use App\Http\Middleware\CekAuthor;
use App\Http\Middleware\CekLogin;
use App\Http\Middleware\CekUSer;
use App\Models\User;
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

// Route::get('/', [MyController::class, 'home']);
// Route::get('/', [MyController::class, 'showBuku']);

// Route::get('/login', [MyController::class, 'login'])->name("login");

// Route::get('/register', [MyController::class, 'register'])->name("register");

// Route::get('/showrole', [MyController::class, 'showrole']);
// Route::post('/simpanrole', [MyController::class, 'simpanrole']);
// Route::post('doLogin', [MyController::class, 'doLogin'])->name("doLogin");

Route::controller(MyController::class)->group(function () {
    Route::get('/','home')->name('index');
    Route::get('/home','home')->name('home');
    Route::get('/description','getDescriptionPage')->name('description');
    Route::get('/login','login')->name('login');
    Route::get('/register','register')->name('register');
    Route::get('admin/adminhome','getAdminHomePage')->name('admin-home');
    Route::get('author/authorhome','getAuthorHomePage')->name('author-home');
    Route::get('logout','logout')->name('logout');
    Route::post('doLogin','doLogin')->name('do-login');
    Route::post('doRegister','doRegister')->name('do-register');
    Route::get('user/userhome','getUserHomePage')->name('user-home');
    Route::get('cust/custhome','getCustHomePage')->name('cust-home');
    Route::get('kirimLamaran/{id_user}','kirimLamaran')->name('kirim-lamaran');
    Route::get('/forgetpass/{email}','forgetpasspage')->name('forget-pass');
    Route::post('changepass','changepass')->name('change-pass');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('admin/adminhome','getAdminHomePage')->name('admin-home');
    Route::get('admin/adminuser','getAdminUserPage')->name('admin-user');
    Route::get('admin/adminbuku','getAdminBukuPage')->name('admin-buku');
    Route::get('admin/viewlamaran/{id_lamaran}','detailLamaran')->name('detail-lamaran');
    Route::post('acceptOrReject','acceptOrReject')->name('accept-or-reject');
    Route::post('toggleUser','toggleUser')->name('toggle-user');
    Route::get('admin/test','getAdminTestPage')->name('test');
    Route::get('admin/admintransaksi','getAdminTransaksiPage')->name('transaksi');
    Route::get('/hasiltrans', 'trans')->name('trans');
});

Route::controller(AuthorController::class)->group(function (){
    Route::get('author/authorhome','getAuthorHomePage')->name('author-home')->middleware([CekLogin::class, CekAuthor::class]);
    Route::get('author/authorhome','getBookUser')->name('author-book')->middleware([CekLogin::class, CekAuthor::class]);
    Route::get('author/authordetail/{id}','authordetail')->name('authorDetail')->middleware([CekLogin::class, CekAuthor::class]);
    Route::get('dodelete/{id}','doDelete')->name('doDelete')->middleware([CekLogin::class, CekAuthor::class]);
    Route::get('author/uploadbook', 'authorUploadBook')->name('authorUploadBook')->middleware([CekLogin::class, CekAuthor::class]);
    Route::get('author/authorNonBook','authorNonBook')->name('authorNonBook')->middleware([CekLogin::class, CekAuthor::class]);
    Route::post('doUpload','doUpload')->name('doUpload');
    Route::post('doUpdate','doUpdate')->name('doUpdate');
    Route::post('doUploadNonBook','doUploadNonBook')->name('doUploadNonBook');
    Route::get('author/authorupdate/{id}','authorupdate')->name('authorupdate')->middleware([CekLogin::class, CekAuthor::class]);
    Route::get('logout', 'logout')->name('logout')->middleware([CekLogin::class, CekAuthor::class]);
    Route::get('/nonaktifkan','nonaktifkan')->name('nonaktifkan')->middleware([CekLogin::class, CekAuthor::class]);
    Route::get('/aktifkan','aktifkan')->name('aktifkan')->middleware([CekLogin::class, CekAuthor::class]);
});

Route::controller(UserController::class)->group(function () {
    Route::get('user/details','getUserDetail')->name('user-detail')->middleware([CekLogin::class, CekUSer::class]);
    Route::get('user/userhome','getUserHomePage')->name('user-home')->middleware([CekLogin::class, CekUSer::class]);
    Route::get('user/usersearch','getUserSearchPage')->name('user-search')->middleware([CekLogin::class, CekUSer::class]);
    Route::get('user/usersearch2','getUserSearchPage2')->name('user-search-2')->middleware([CekLogin::class, CekUSer::class]);
    Route::get('user/usercart','getUserCartPage')->name('user-cart')->middleware([CekLogin::class, CekUSer::class]);
    Route::post('searchBuku','searchBuku')->name('search-buku');
    Route::post('searchNonBuku','searchNonBuku')->name('search-nonbuku');
    Route::get('user/detailnonbuku/{id_alat_tulis}','detailNonBuku')->name('detail-NonBuku')->middleware([CekLogin::class, CekUSer::class]);
    Route::get('user/isisaldo/{id_user}','getIsiSaldoPage')->name('isisaldo-page')->middleware([CekLogin::class, CekUSer::class]);
    Route::post('isiSaldo','isiSaldo')->name('isi-saldo');
    Route::get('user/edituser/{id_user}','getEditUserPage')->name('edituser-page')->middleware([CekLogin::class, CekUSer::class]);
    Route::post('editUser','editUser')->name('edit-user');
    Route::get('user/transaksimember/{id_user}','transaksiMemberPage')->name('transaksi-page')->middleware([CekLogin::class, CekUSer::class]);
    Route::post('beliMember','beliMember')->name('beli-member');
    Route::post('batalMember','batalMember')->name('batal-member');
    Route::get('user/detailbuku/{id_buku}','detailBuku')->name('detail-buku')->middleware([CekLogin::class, CekUSer::class]);
    Route::post('addToCartBook','addToCartBook')->name('add-cart-book');
    Route::post('addToCartNonBuku','addToCartNonBuku')->name('add-to-cart-nonbuku');
    Route::get('deleteFromCart','deleteFromCart')->name('delete')->middleware([CekLogin::class, CekUSer::class]);
    Route::get('user/checkout','getCheckoutPage')->name('user-checkout')->middleware([CekLogin::class, CekUSer::class]);
    Route::post('checkoutCart','checkoutCart')->name('checkout');
    Route::get('user/library','getUserLibraryPage')->name('library')->middleware([CekLogin::class, CekUSer::class]);
    Route::get('logout', 'logout')->name('logout');
});

Route::controller(TestController::class)->group(function() {
    Route::post('lihatSemuaUser','lihatSemuaUser')->name('lihat-semua-user');
    Route::post('tesAddUser','tesAddUser')->name('tes-add-user');
    Route::post('tesLogin','tesLogin')->name('tes-login');
    Route::post('lihatDataUser','lihatDataUser')->name('lihat-data-user');
    Route::post('isiSaldo','isiSaldo')->name('isi-saldo');
    Route::post('buymember','buymember')->name('buy');
    Route::post('showAllBook','showAllBook')->name('show-all-book');
    Route::post('tesAddBook','tesAddBook')->name('tes-add-book');
});
