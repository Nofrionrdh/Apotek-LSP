<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\JenisObatController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Middleware\CheckUserJabatan;
use App\Http\Middleware\RoleAuth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\JenisPengirimanController;
use App\Http\Controllers\PengirimanController;




// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/register', [AuthController::class, 'store'])->name('auth.register');

Route::get('/register', [AuthController::class, 'registerForm'])->middleware('guest')->name('registerForm');
Route::post('/register', [AuthController::class, 'registerProcess'])->middleware('guest')->name('registerProcess');

Route::get('/admin', [AdminController::class, 'index'])->name('Auth.Login')->middleware(Roleauth::class . ':admin');

Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'loginUser'])->name('login-user');
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'registerUser'])->name('register-user');
});

// Logout (Hanya bisa diakses oleh user yang sudah login)
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Role-based dashboard
// Route::middleware(['auth.role:admin'])->get('/admin', fn() => view('admin.dashboard'));
// Route::middleware(['auth.role:apoteker'])->get('/apoteker', fn() => view('apoteker.dashboard'));
// Route::middleware(['auth.role:pemilik'])->get('/pemilik', fn() => view('pemilik.dashboard'));
// Route::middleware(['auth.role:kasir'])->get('/kasir', fn() => view('kasir.dashboard'));
// Route::middleware(['auth.role:karyawan'])->get('/karyawan', fn() => view('karyawan.dashboard'));

// dst...

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('/', App\Http\Controllers\HomeController::class);
Route::resource('/home', App\Http\Controllers\HomeController::class);
Route::resource('/contact', App\Http\Controllers\ContactController::class);
Route::resource('/about', App\Http\Controllers\AboutController::class);
Route::resource('/Cart', App\Http\Controllers\CartController::class);
Route::resource('/Profile', App\Http\Controllers\ProfileController::class);

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->level === 'admin') {
        return redirect()->route('admin');
    }
    if ($user->level === 'karyawan') {
        return redirect()->route('karyawan');
    }
    if ($user->level === 'apoteker') {
        return redirect()->route('apoteker');
    }
    if ($user->level === 'pemilik') {
        return redirect()->route('pemilik');
    }
    if ($user->level === 'kasir') {
        return redirect()->route('kasir');
    }
    if ($user->level === 'kurir') {
        return redirect()->route('kurir');
    }

    return redirect()->back()->withErrors('Unauthorized access.');
})->middleware('auth')->name('dashboard');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])
    ->middleware(['auth',  RoleAuth::class . ':admin'])
    ->name('admin');

// Endpoint to query Midtrans for a single transaction status and update local order
Route::get('/midtrans/status/{orderId}', [MidtransController::class, 'checkStatus'])->name('midtrans.status');

// Get pengiriman information by order id (used by frontend pemesanan view)
Route::get('/pengiriman/order/{orderId}', [App\Http\Controllers\PengirimanController::class, 'getByOrder'])->name('pengiriman.byOrder');

Route::get('/karyawan', [App\Http\Controllers\KaryawanController::class, 'index'])
    ->middleware(['auth', RoleAuth::class . ':karyawan'])
    ->name('karywanan');

Route::get('/pemilik', [App\Http\Controllers\PemilikController::class, 'index'])
    ->middleware(['auth', RoleAuth::class . ':pemilik'])
    ->name('pemilik');

Route::get('/apoteker', [App\Http\Controllers\ApotekerController::class, 'index'])
    ->middleware(['auth', RoleAuth::class . ':apoteker'])
    ->name('apoteker');

Route::get('/kasir', [App\Http\Controllers\KasirController::class, 'index'])
    ->middleware(['auth', RoleAuth::class . ':kasir'])
    ->name('kasir');

Route::get('/kurir', [App\Http\Controllers\KurirController::class, 'index'])
    ->middleware(['auth', RoleAuth::class . ':kurir'])
    ->name('kurir.index');

Route::middleware(['auth', RoleAuth::class . ':apoteker'])->group(function () {
    Route::resource('obat', ObatController::class);
    Route::resource('jenis-obat', JenisObatController::class);
});

Route::middleware(['auth', RoleAuth::class . ':admin'])->group(function () {
    Route::resource('manage-user', ManageUserController::class);
});

Route::middleware(['auth', RoleAuth::class . ':apoteker'])->group(function () {
    Route::resource('distributor', DistributorController::class);
});

Route::middleware(['auth', RoleAuth::class . ':apoteker'])->group(function () {
    Route::resource('pembelian', PembelianController::class);
});

Route::middleware(['auth', RoleAuth::class . ':kasir'])->group(function () {
    Route::resource('penjualan', PenjualanController::class);
    Route::put('penjualan/{id}/approve', [PenjualanController::class, 'approve'])->name('penjualan.approve');
    Route::put('penjualan/{id}/reject', [PenjualanController::class, 'reject'])->name('penjualan.reject');
    Route::put('penjualan/{id}/keterangan', [PenjualanController::class, 'updateKeterangan'])->name('penjualan.updateKeterangan');
});

// Admin routes
Route::resource('obat', ObatController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/manage-user', [App\Http\Controllers\ManageUserController::class, 'index'])->name('manage-user.index');
Route::get('/manage-user/create', [App\Http\Controllers\ManageUserController::class, 'create'])->name('manage-user.create');
Route::post('/manage-user/store', [App\Http\Controllers\ManageUserController::class, 'store'])->name('manage-user.store');
Route::get('/manage-user/{id}/edit', [App\Http\Controllers\ManageUserController::class, 'edit'])->name('manage-user.edit');
Route::put('/manage-user/{id}', [App\Http\Controllers\ManageUserController::class, 'update'])->name('manage-user.update');
Route::delete('/manage-user/{id}', [App\Http\Controllers\ManageUserController::class, 'destroy'])->name('manage-user.destroy');

Route::get('/obat', [App\Http\Controllers\ObatController::class, 'index'])->name('obat.index');
Route::get('/obat/create', [App\Http\Controllers\ObatController::class, 'create'])->name('obat.create');
Route::post('/obat/store', [App\Http\Controllers\ObatController::class, 'store'])->name('obat.store');
Route::get('/obat/{id}/edit', [App\Http\Controllers\ObatController::class, 'edit'])->name('obat.edit');
Route::put('/obat/{id}', [App\Http\Controllers\ObatController::class, 'update'])->name('obat.update');
Route::delete('/obat/{id}', [App\Http\Controllers\ObatController::class, 'destroy'])->name('obat.destroy');

Route::get('/jenis-obat', [App\Http\Controllers\JenisObatController::class, 'index'])->name('jenis-obat.index');
Route::get('/jenis-obat/create', [App\Http\Controllers\JenisObatController::class, 'create'])->name('jenis-obat.create');
Route::post('/jenis-obat/store', [App\Http\Controllers\JenisObatController::class, 'store'])->name('jenis-obat.store');
Route::get('/jenis-obat/{id}/edit', [App\Http\Controllers\JenisObatController::class, 'edit'])->name('jenis-obat.edit');
Route::put('/jenis-obat/{id}', [App\Http\Controllers\JenisObatController::class, 'update'])->name('jenis-obat.update');
Route::delete('/jenis-obat/{id}', [App\Http\Controllers\JenisObatController::class, 'destroy'])->name('jenis-obat.destroy');

Route::get('/distributor', [App\Http\Controllers\DistributorController::class, 'index'])->name('distributor.index');
Route::get('/distributor/create', [App\Http\Controllers\DistributorController::class, 'create'])->name('distributor.create');
Route::post('/distributor/store', [App\Http\Controllers\DistributorController::class, 'store'])->name('distributor.store');
Route::get('/distributor/{id}/edit', [App\Http\Controllers\DistributorController::class, 'edit'])->name('distributor.edit');
Route::put('/distributor/{id}', [App\Http\Controllers\DistributorController::class, 'update'])->name('distributor.update');
Route::delete('/distributor/{id}', [App\Http\Controllers\DistributorController::class, 'destroy'])->name('distributor.destroy');

Route::get('pembelian', [App\Http\Controllers\PembelianController::class, 'index'])->name('pembelian.index');
Route::get('pembelian/create', [App\Http\Controllers\PembelianController::class, 'create'])->name('pembelian.create');
Route::post('pembelian/store', [App\Http\Controllers\PembelianController::class, 'store'])->name('pembelian.store');
Route::get('pembelian/{id}/edit', [App\Http\Controllers\PembelianController::class, 'edit'])->name('pembelian.edit');
Route::put('pembelian/{id}', [App\Http\Controllers\PembelianController::class, 'update'])->name('pembelian.update');
Route::delete('pembelian/{id}', [App\Http\Controllers\PembelianController::class, 'destroy'])->name('pembelian.destroy');

Route::get('/jenis-pengiriman', [App\Http\Controllers\JenisPengirimanController::class, 'index'])->name('jenis-pengiriman.index');
Route::get('/jenis-pengiriman/create', [App\Http\Controllers\JenisPengirimanController::class, 'create'])->name('jenis-pengiriman.create');
Route::post('/jenis-pengiriman/store', [App\Http\Controllers\JenisPengirimanController::class, 'store'])->name('jenis-pengiriman.store');
Route::get('/jenis-pengiriman/{id}/edit', [App\Http\Controllers\JenisPengirimanController::class, 'edit'])->name('jenis-pengiriman.edit');
Route::put('/jenis-pengiriman/{id}', [App\Http\Controllers\JenisPengirimanController::class, 'update'])->name('jenis-pengiriman.update');
Route::delete('/jenis-pengiriman/{id}', [App\Http\Controllers\JenisPengirimanController::class, 'destroy'])->name('jenis-pengiriman.destroy');

// Products and Checkout routes
// Route::prefix('product')->group(function () {
//     Route::get('/', [ProductController::class, 'index'])->name('product.index');
//     Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
// });

Route::get('/products', [HomeController::class, 'product'])->name('products');
Route::get('/product', [App\Http\Controllers\HomeController::class, 'product'])->name('product');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/{productId}/update', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/cart/{productId}/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
Route::get('/cart/checkout/success', [CartController::class, 'checkoutSuccess'])->name('cart.checkout.success');
Route::get('/cart/checkout/failure', [CartController::class, 'checkoutFailure'])->name('cart.checkout.failure');
// Route::get('/cart/checkout/success', [CartController::class, 'checkoutSuccess'])->name('cart.checkout.success');
// Route::get('/cart/checkout/failure', [CartController::class, 'checkoutFailure'])->name('cart.checkout.failure');

// Frontend Pelanggan Auth (FE)
Route::prefix('pelanggan')->group(function () {
    // Route untuk guest (belum login)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [PelangganController::class, 'showLoginForm'])->name('pelanggan.login');
        Route::post('/login', [PelangganController::class, 'login'])->name('pelanggan.login.submit');
        Route::get('/register', [PelangganController::class, 'showRegisterForm'])->name('pelanggan.register');
        Route::post('/register', [PelangganController::class, 'register'])->name('pelanggan.register.submit');
    });

    // Route untuk pelanggan yang sudah login
    Route::post('/logout', [PelangganController::class, 'logout'])->name('pelanggan.logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
});

Route::resource('data-pelanggan', App\Http\Controllers\DataPelangganController::class)->only(['index', 'destroy']);

// Tambahkan route khusus untuk product.index (FE)
Route::get('/product-list', [ProductController::class, 'index'])->name('product.index');
Route::get('/product-checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::prefix('be')->name('be.')->group(function() {
    Route::resource('jenis-obat', JenisObatController::class);
});

// Tambahkan route resource pengiriman (CRUD backend)
Route::resource('pengiriman', App\Http\Controllers\PengirimanController::class);
Route::get('/pengiriman/{id}/print', [App\Http\Controllers\PengirimanController::class, 'print'])->name('pengiriman.print');
Route::get('/pengiriman/{id}/show', [App\Http\Controllers\PengirimanController::class, 'show'])->name('pengiriman.show');

// Tambahkan route untuk proses pembayaran
Route::post('/checkout/process-payment', [CheckoutController::class, 'processPayment'])->name('checkout.processPayment');

// RajaOngkir cost lookup
Route::post('/rajaongkir/cost', [App\Http\Controllers\OngkirController::class, 'calculateCost'])->name('rajaongkir.cost');
// RajaOngkir provinces and cities
Route::get('/rajaongkir/province', [App\Http\Controllers\OngkirController::class, 'getProvinces'])->name('rajaongkir.province');
Route::get('/rajaongkir/city', [App\Http\Controllers\OngkirController::class, 'getCities'])->name('rajaongkir.city');
Route::post('/checkout/payment-callback', [CheckoutController::class, 'paymentCallback'])->name('checkout.payment.callback');
// Route::post('/checkout/process-order', [CheckoutController::class, 'processOrder'])->name('checkout.processOrder');

Route::resource('pemesanan', App\Http\Controllers\PemesananController::class)->only(['index', 'destroy']);
Route::put('/pemesanan/{id}/cancel', [App\Http\Controllers\PemesananController::class, 'cancel'])->name('pemesanan.cancel');
Route::post('/checkout/fake-order', [CheckoutController::class, 'fakeOrder'])->name('checkout.fakeOrder');
Route::put('/pemesanan/{id}/cancel', [App\Http\Controllers\PemesananController::class, 'cancel'])->name('pemesanan.cancel');
Route::post('/upload-resep', [CheckoutController::class, 'uploadResep'])->name('checkout.uploadResep');
Route::resource('checkout', App\Http\Controllers\CheckoutController::class)->only(['index', 'store']);

// Tambahkan route resource untuk Metode Pembayaran
Route::resource('metode-bayar', MetodePembayaranController::class);

// Midtrans Routes
Route::get('/midtrans/token/{id}', [MidtransController::class, 'getSnapToken'])->name('midtrans.token');
Route::post('/midtrans/notification', [MidtransController::class, 'handleNotification'])->name('midtrans.notification');
Route::get('/midtrans/finish', [MidtransController::class, 'finishRedirect'])->name('midtrans.finish');
Route::get('/midtrans/unfinish', [MidtransController::class, 'unfinishRedirect'])->name('midtrans.unfinish');
Route::get('/midtrans/error', [MidtransController::class, 'errorRedirect'])->name('midtrans.error');

Route::post('/pengiriman/{id}/menunggu-kurir', [App\Http\Controllers\PengirimanController::class, 'setMenungguKurir'])->name('pengiriman.setMenungguKurir');
Route::post('/kurir/{id}/dikirim', [App\Http\Controllers\KurirController::class, 'setDikirim'])->name('kurir.setDikirim');
Route::post('/kurir/{id}/selesai', [App\Http\Controllers\KurirController::class, 'setSelesai'])->name('kurir.setSelesai');

// Tambahkan di bawah route dashboard.index
Route::get('/dashboard/laporan', [DashboardController::class, 'laporan'])->name('dashboard.laporan');
Route::get('/dashboard/laporan/pdf', [DashboardController::class, 'laporanPdf'])->name('dashboard.laporan.pdf');

Route::get('/dashboard/export-pdf', [DashboardController::class, 'exportPdf'])
    ->name('dashboard.export.pdf')
    ->middleware('auth');






