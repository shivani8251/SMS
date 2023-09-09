<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Admin\ResellerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Tools\TreeViewController;
use App\Http\Controllers\Admin\Tools\NewsController;
use App\Http\Controllers\Admin\WhatsappController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ComplaintController;

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

// Route::get('/', function () {
//     return view('auth.login');
// });

// Route::get('/', function () {
//     return view('user.index');
// });


Auth::routes();
Route::get('/', [LoginController::class, 'index'])->name('user.login');
Route::get('/login', [LoginController::class, 'index'])->name('user.auth.login');
// Route::post('post-user-login', [LoginController::class, 'userLogin'])->name('user.auth.login');
Route::post('post-login', [LoginController::class, 'customlogin'])->name('user.login.post');

Route::group(['middleware' => 'auth'], function (){

	Route::get('home', [HomeController::class, 'index'])->name('user.home');
	Route::get('/fetch-daywise-usages-graph', [HomeController::class, 'fetchDayWiseUsagesGraph'])->name('user.home.graph');

	Route::get('/user-login-profile', [ProfileController::class, 'index'])->name('user.profile.edit');
	Route::post('/user-upload-login-profilepic', [ProfileController::class, 'upload'])->name('user.login.profilepic.upload');		
	Route::post('/update-user-profile', [ProfileController::class, 'update'])->name('user.profile.update');	

	Route::post('/login-change-password', [ProfileController::class, 'changePassword'])->name('user.login.password.change');

	Route::get('/business-details', [ProfileController::class, 'branding'])->name('user.business.edit');
	Route::post('/upload-business-logo', [ProfileController::class, 'uploadBusinessLogo'])->name('user.businesslogo.upload');		
	Route::post('/update-business-details', [ProfileController::class, 'updateBusinessDetails'])->name('user.business.update');	

	/*======================Routes for News=======================*/

		Route::get('/news', [NewsController::class, 'index'])->name('user.news.index');
		Route::get('/news-datatable', [NewsController::class, 'serverSideDataTable'])->name('user.news.serverSideDataTable');

	/*======================Routes for News=======================*/

	/*======================Routes for Resellers=======================*/

		Route::get('/resellers', [ResellerController::class, 'index'])->name('user.reseller.index');
		Route::get('/reseller-datatable', [ResellerController::class, 'serverSideDataTable'])->name('user.reseller.serverSideDataTable');

		Route::get('/activate-reseller', [ResellerController::class, 'activate'])->name('user.reseller.activate');
		Route::get('/deactivate-reseller', [ResellerController::class, 'deactivate'])->name('user.reseller.deactivate');

		Route::get('/add-reseller', [ResellerController::class, 'add'])->name('user.reseller.add');
		Route::post('/save-reseller', [ResellerController::class, 'save'])->name('user.reseller.save');

		Route::get('/edit-reseller/{id}', [ResellerController::class, 'edit'])->name('user.reseller.edit');
		Route::post('/update-reseller', [ResellerController::class, 'update'])->name('user.reseller.update');

		Route::get('/view-reseller/{id}', [ResellerController::class, 'view'])->name('user.reseller.view');

		Route::get('/add-reseller-credit/{id}', [ResellerController::class, 'addCredit']);
		Route::post('/save-reseller-credit', [ResellerController::class, 'saveCredit'])->name('user.reseller.credit.save');

		Route::get('/remove-reseller-credit/{id}', [ResellerController::class, 'removeCredit'])->name('user.reseller.credit.remove');
		Route::post('/save-subtract-reseller-credit', [ResellerController::class, 'submitSubtractCredit'])->name('user.reseller.credit.subtract');

		Route::get('/fetch-reseller-treeview', [ResellerController::class, 'getTreeView'])->name('user.reseller.treeview.fetch');

		Route::post('/reset-reseller-password', [ResellerController::class, 'resetPassword'])->name('user.reseller.password.reset');

		Route::get('/reseller-credits-datatable', [ResellerController::class, 'creditsDatatable'])->name('user.reseller.credits.dataTable');

		Route::get('/reseller-campaigns-datatable', [ResellerController::class, 'campaignsDatatable'])->name('user.reseller.campaigns.dataTable');

	/*======================Routes for Resellers=======================*/

	/*======================Routes for Users=======================*/

		Route::get('/users', [UserController::class, 'index'])->name('user.user.index');
		Route::get('/user-datatable', [UserController::class, 'serverSideDataTable'])->name('user.user.serverSideDataTable');

		Route::get('/activate-user', [UserController::class, 'activate'])->name('user.user.activate');
		Route::get('/deactivate-user', [UserController::class, 'deactivate'])->name('user.user.deactivate');

		Route::get('/add-user', [UserController::class, 'add'])->name('user.user.add');
		Route::post('/save-user', [UserController::class, 'save'])->name('user.user.save');

		Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('user.user.edit');
		Route::post('/update-user', [UserController::class, 'update'])->name('user.user.update');

		Route::get('/view-user/{id}', [UserController::class, 'view'])->name('user.user.view');

		Route::get('/add-user-credit/{id}', [UserController::class, 'addCredit']);
		Route::post('/save-user-credit', [UserController::class, 'saveCredit'])->name('user.user.credit.save');

		Route::get('/remove-user-credit/{id}', [UserController::class, 'removeCredit'])->name('user.user.credit.remove');
		Route::post('/save-subtract-user-credit', [UserController::class, 'submitSubtractCredit'])->name('user.user.credit.subtract');

		Route::post('/reset-user-password', [UserController::class, 'resetPassword'])->name('user.user.password.reset');

		Route::get('/user-credits-datatable', [UserController::class, 'creditsDatatable'])->name('user.user.credits.dataTable');
		Route::get('/user-campaigns-datatable', [UserController::class, 'campaignsDatatable'])->name('user.user.campaigns.dataTable');

		Route::get('/make-user-to-reseller', [UserController::class, 'makeReseller'])->name('user.reseller.make');

	/*======================Routes for Users=======================*/

	/*======================Routes for Send Whatsapp=======================*/

		Route::post('/send-whatsapp-message', [WhatsappController::class, 'sendParent'])->name('user.parent.send');
		Route::get('/send-whatsapp', [WhatsappController::class, 'index'])->name('user.whatsapp.index');
		Route::post('/send-whatsapp-process', [WhatsappController::class, 'send'])->name('user.whatsapp.send');

		Route::post('/upload-whatsapp-images', [WhatsappController::class, 'upload'])->name('user.whatsapp.images.upload');
		Route::post('/upload-whatsapp-pdf', [WhatsappController::class, 'uploadPDF'])->name('user.whatsapp.pdf.upload');
		Route::post('/upload-whatsapp-video', [WhatsappController::class, 'uploadVideo'])->name('user.whatsapp.video.upload');

		Route::post('/import-whatsapp-contacts', [WhatsappController::class, 'importContacts'])->name('user.whatsapp.contacts.import');

		Route::get('/export-mobile-listing/{id}', [WhatsappController::class, 'exportMobileListings'])->name('user.export.mobile.listing');

	/*======================Routes for Send Whatsapp=======================*/

	/*======================Routes for Report=======================*/

		Route::get('/whatsapp-report', [ReportController::class, 'index'])->name('user.whatsapp.report.index');
		Route::get('/whatsapp-report-datatable', [ReportController::class, 'serverSideDataTable'])->name('user.whatsapp.report.serverSideDataTable');
		Route::post('/save-update-status', [ReportController::class, 'saveUpdateStatus'])->name('user.campaign.status.update');

		Route::get('/view-campaign/{id}', [ReportController::class, 'view'])->name('user.campaign.view');
		Route::post('/mobile-list-datatable', [ReportController::class, 'mobileListDataTable'])->name('user.mobile.listing.dataTable');
		Route::post('/save-update-mobileno-status', [ReportController::class, 'updateMobileStatus'])->name('user.mobile.status.update');

		Route::get('/reseller-report', [ReportController::class, 'resellerReport'])->name('user.reseller.report.index');
		Route::get('/reseller-report-datatable', [ReportController::class, 'resellerReportDatatable'])->name('user.reseller.report.dataTable');

		Route::get('/user-report', [ReportController::class, 'userReport'])->name('user.user.report.index');
		Route::get('/user-report-datatable', [ReportController::class, 'userReportDatatable'])->name('user.user.report.dataTable');

		Route::get('/add-credit/{type}', [ReportController::class, 'addCredit'])->name('user.credit.add');
		Route::post('/save-credit', [ReportController::class, 'saveCredit'])->name('user.credit.save');

		Route::get('/credits', [ReportController::class, 'credits'])->name('user.credits.index');
		Route::get('/credits-datatable', [ReportController::class, 'creditsDatatable'])->name('user.credits.dataTable');

	/*======================Routes for Report=======================*/


	/*======================Routes for Tree View=======================*/

		Route::get('/tree-view', [TreeViewController::class, 'index'])->name('user.treeview.index');
		Route::get('/get-tree-view', [TreeViewController::class, 'getTreeView'])->name('user.treeview.fetch');
		Route::get('/get-treeview-child', [CommonController::class, 'getTreeViewChild'])->name('user.treeview.fetchchild');

	/*======================Routes for Tree View=======================*/

	Route::get('/complaints', [ComplaintController::class, 'index'])->name('user.complaints.index');
	Route::get('/complaints-datatable', [ComplaintController::class, 'serverSideDataTable'])->name('user.complaints.serverSideDataTable');

	Route::get('/complaint-form', [ComplaintController::class, 'form'])->name('user.complaints.form');
	Route::post('/save-complaint', [ComplaintController::class, 'save'])->name('user.complaints.save');
});

// Route::prefix('user')->group(function(){
// 	Route::group(['middleware' => 'auth'], function (){
// 		Route::get('home', [HomeController::class, 'index'])->name('user.home');
// 	});
// });
