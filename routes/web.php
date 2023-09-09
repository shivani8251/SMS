<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ResellerController;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Tools\NewsController;
use App\Http\Controllers\Admin\Tools\AlertController;
use App\Http\Controllers\Admin\Tools\SettingController;
use App\Http\Controllers\Admin\Tools\TreeViewController;
use App\Http\Controllers\Admin\WhatsappController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\HomeController;
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
//     return view('welcome');
// });
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'DONE'; //Return anything
});

Auth::routes();

Route::group(['prefix' => 'admin'], function (){

	Route::group(['middleware' => 'admin.guest:admin'], function (){
		Route::get('/', [AdminController::class, 'index']);
		Route::get('login', [AdminController::class, 'index'])->name('admin.login');
		Route::post('login', [AdminController::class, 'customLogin'])->name('admin.auth');
	});
	Route::group(['middleware' => 'admin.auth'], function (){

		Route::get('/home', [HomeController::class, 'index'])->name('home');
		Route::get('/fetch-daywise-usages-graph', [HomeController::class, 'fetchDayWiseUsagesGraph'])->name('admin.home.graph');

		Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

		Route::get('/login-profile', [ProfileController::class, 'index'])->name('admin.profile.edit');
		Route::post('/upload-login-profilepic', [ProfileController::class, 'upload'])->name('login.profilepic.upload');		
		Route::post('/update-login-profile', [ProfileController::class, 'update'])->name('login.profile.update');	

		Route::post('/login-change-password', [ProfileController::class, 'changePassword'])->name('login.password.change');
		Route::post('/update-admin-credit', [ProfileController::class, 'updateCredit'])->name('admin.credit.update');

		Route::get('/business-details', [ProfileController::class, 'branding'])->name('admin.business.edit');
		Route::post('/upload-business-logo', [ProfileController::class, 'uploadBusinessLogo'])->name('login.businesslogo.upload');		
		Route::post('/update-business-details', [ProfileController::class, 'updateBusinessDetails'])->name('login.business.update');	

		/*======================Routes for Resellers=======================*/

			Route::get('/resellers', [ResellerController::class, 'index'])->name('admin.reseller.index');
			Route::get('/reseller-datatable', [ResellerController::class, 'serverSideDataTable'])->name('admin.reseller.serverSideDataTable');

			Route::get('/activate-reseller', [ResellerController::class, 'activate'])->name('admin.reseller.activate');
			Route::get('/deactivate-reseller', [ResellerController::class, 'deactivate'])->name('admin.reseller.deactivate');

			Route::get('/add-reseller', [ResellerController::class, 'add'])->name('admin.reseller.add');
			Route::post('/save-reseller', [ResellerController::class, 'save'])->name('admin.reseller.save');

			Route::get('/edit-reseller/{id}', [ResellerController::class, 'edit'])->name('admin.reseller.edit');
			Route::post('/update-reseller', [ResellerController::class, 'update'])->name('admin.reseller.update');

			Route::get('/view-reseller/{id}', [ResellerController::class, 'view'])->name('admin.reseller.view');

			Route::get('/add-reseller-credit/{id}', [ResellerController::class, 'addCredit']);
			Route::post('/save-reseller-credit', [ResellerController::class, 'saveCredit'])->name('admin.reseller.credit.save');

			Route::get('/remove-reseller-credit/{id}', [ResellerController::class, 'removeCredit'])->name('admin.reseller.credit.remove');
			Route::post('/save-subtract-reseller-credit', [ResellerController::class, 'submitSubtractCredit'])->name('admin.reseller.credit.subtract');

			Route::get('/fetch-reseller-treeview', [ResellerController::class, 'getTreeView'])->name('admin.reseller.treeview.fetch');

			Route::post('/reset-reseller-password', [ResellerController::class, 'resetPassword'])->name('admin.reseller.password.reset');

			Route::get('/reseller-credits-datatable', [ResellerController::class, 'creditsDatatable'])->name('admin.reseller.credits.dataTable');
			Route::get('/reseller-campaigns-datatable', [ResellerController::class, 'campaignsDatatable'])->name('admin.reseller.campaigns.dataTable');

		/*======================Routes for Resellers=======================*/

		/*======================Routes for Users=======================*/

			Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
			Route::get('/user-datatable', [UserController::class, 'serverSideDataTable'])->name('admin.user.serverSideDataTable');

			Route::get('/activate-user', [UserController::class, 'activate'])->name('admin.user.activate');
			Route::get('/deactivate-user', [UserController::class, 'deactivate'])->name('admin.user.deactivate');

			Route::get('/add-user', [UserController::class, 'add'])->name('admin.user.add');
			Route::post('/save-user', [UserController::class, 'save'])->name('admin.user.save');

			Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
			Route::post('/update-user', [UserController::class, 'update'])->name('admin.user.update');

			Route::get('/view-user/{id}', [UserController::class, 'view'])->name('admin.user.view');

			Route::get('/add-user-credit/{id}', [UserController::class, 'addCredit']);
			Route::post('/save-user-credit', [UserController::class, 'saveCredit'])->name('admin.user.credit.save');

			Route::get('/remove-user-credit/{id}', [UserController::class, 'removeCredit'])->name('admin.user.credit.remove');
			Route::post('/save-subtract-user-credit', [UserController::class, 'submitSubtractCredit'])->name('admin.user.credit.subtract');

			Route::post('/reset-user-password', [UserController::class, 'resetPassword'])->name('admin.user.password.reset');

			Route::get('/user-credits-datatable', [UserController::class, 'creditsDatatable'])->name('admin.user.credits.dataTable');

			Route::get('/user-campaigns-datatable', [UserController::class, 'campaignsDatatable'])->name('admin.user.campaigns.dataTable');

			Route::get('/make-user-to-reseller', [UserController::class, 'makeReseller'])->name('admin.reseller.make');

		/*======================Routes for Users=======================*/

		/*======================Routes for News=======================*/

			Route::get('/news', [NewsController::class, 'index'])->name('admin.news.index');
			Route::get('/news-datatable', [NewsController::class, 'serverSideDataTable'])->name('admin.news.serverSideDataTable');

			Route::get('/activate-news', [NewsController::class, 'activate'])->name('admin.news.activate');
			Route::get('/deactivate-news', [NewsController::class, 'deactivate'])->name('admin.news.deactivate');
			Route::post('/save-news', [NewsController::class, 'save'])->name('admin.news.save');

		/*======================Routes for News=======================*/

		/*======================Routes for Alert=======================*/

			Route::get('/alerts', [AlertController::class, 'index'])->name('admin.alert.index');
			Route::get('/alert-datatable', [AlertController::class, 'serverSideDataTable'])->name('admin.alert.serverSideDataTable');

			Route::get('/activate-alert', [AlertController::class, 'activate'])->name('admin.alert.activate');
			Route::get('/deactivate-alert', [AlertController::class, 'deactivate'])->name('admin.alert.deactivate');
			Route::post('/save-alert', [AlertController::class, 'save'])->name('admin.alert.save');

		/*======================Routes for Alert=======================*/

		/*======================Routes for Setting=======================*/

			Route::get('/settings', [SettingController::class, 'index'])->name('admin.setting.index');
			Route::get('/setting-datatable', [SettingController::class, 'serverSideDataTable'])->name('admin.setting.serverSideDataTable');

			Route::get('/activate-setting', [SettingController::class, 'activate'])->name('admin.setting.activate');
			Route::get('/deactivate-setting', [SettingController::class, 'deactivate'])->name('admin.setting.deactivate');
			Route::post('/save-setting', [SettingController::class, 'save'])->name('admin.setting.save');

			Route::get('/fetch-setting', [SettingController::class, 'fetch'])->name('admin.setting.fetch');

		/*======================Routes for Setting=======================*/

		/*======================Routes for Send Whatsapp=======================*/

			Route::post('/send-whatsapp-message', [WhatsappController::class, 'sendParent'])->name('admin.parent.send');
			Route::get('/send-whatsapp', [WhatsappController::class, 'index'])->name('admin.whatsapp.index');
			Route::post('/send-whatsapp-process', [WhatsappController::class, 'send'])->name('admin.whatsapp.send');

			Route::post('/upload-whatsapp-images', [WhatsappController::class, 'upload'])->name('admin.whatsapp.images.upload');
			Route::post('/upload-whatsapp-pdf', [WhatsappController::class, 'uploadPDF'])->name('admin.whatsapp.pdf.upload');
			Route::post('/upload-whatsapp-video', [WhatsappController::class, 'uploadVideo'])->name('admin.whatsapp.video.upload');

			Route::post('/import-whatsapp-contacts', [WhatsappController::class, 'importContacts'])->name('admin.whatsapp.contacts.import');

			Route::get('/campaign-status-update', [WhatsappController::class, 'updateStatusPage'])->name('admin.status.campaign.update');
			Route::get('/fetch-campaign-details', [WhatsappController::class, 'fetchCampaignDetails'])->name('admin.campaign.details.fetch');
			Route::post('/post-update-campaign-status', [WhatsappController::class, 'postUpdateStatus'])->name('admin.campaign.status.post');

			Route::get('/search-mobile-numbers', [WhatsappController::class, 'searchMobileNumber'])->name('admin.mobile.number.search');
			Route::get('/search-mobile-numbers-datatable', [WhatsappController::class, 'searchMobileNumberDataTable'])->name('admin.search.numbers.dataTable');
			
			Route::get('/export-mobile-listing/{id}', [WhatsappController::class, 'exportMobileListings'])->name('export.mobile.listing');

		/*======================Routes for Send Whatsapp=======================*/

		/*======================Routes for Report=======================*/

			Route::get('/whatsapp-report', [ReportController::class, 'index'])->name('admin.whatsapp.report.index');
			Route::get('/whatsapp-report-datatable', [ReportController::class, 'serverSideDataTable'])->name('admin.whatsapp.report.serverSideDataTable');
			Route::post('/save-update-status', [ReportController::class, 'saveUpdateStatus'])->name('admin.campaign.status.update');


			Route::get('/view-campaign/{id}', [ReportController::class, 'view'])->name('admin.campaign.view');
			Route::post('/mobile-list-datatable', [ReportController::class, 'mobileListDataTable'])->name('admin.mobile.listing.dataTable');
			Route::post('/save-update-mobileno-status', [ReportController::class, 'updateMobileStatus'])->name('admin.mobile.status.update');

			Route::get('/reseller-report', [ReportController::class, 'resellerReport'])->name('admin.reseller.report.index');
			Route::get('/reseller-report-datatable', [ReportController::class, 'resellerReportDatatable'])->name('admin.reseller.report.dataTable');

			Route::get('/user-report', [ReportController::class, 'userReport'])->name('admin.user.report.index');
			Route::get('/user-report-datatable', [ReportController::class, 'userReportDatatable'])->name('admin.user.report.dataTable');

			Route::get('/add-credit/{type}', [ReportController::class, 'addCredit'])->name('admin.credit.add');
			Route::post('/save-credit', [ReportController::class, 'saveCredit'])->name('admin.credit.save');

			Route::get('/credits', [ReportController::class, 'credits'])->name('admin.credits.index');
			Route::get('/credits-datatable', [ReportController::class, 'creditsDatatable'])->name('admin.credits.dataTable');

		/*======================Routes for Report=======================*/


		/*======================Routes for Tree View=======================*/

			Route::get('/tree-view', [TreeViewController::class, 'index'])->name('admin.treeview.index');
			Route::get('/get-tree-view', [TreeViewController::class, 'getTreeView'])->name('admin.treeview.fetch');
			Route::get('/get-treeview-child', [CommonController::class, 'getTreeViewChild'])->name('admin.treeview.fetchchild');

		/*======================Routes for Tree View=======================*/

		/*======================Routes for Complaints=======================*/

			Route::get('/complaints', [ComplaintController::class, 'index'])->name('admin.complaints.index');
			Route::get('/complaints-datatable', [ComplaintController::class, 'serverSideDataTable'])->name('admin.complaints.serverSideDataTable');

			Route::get('/complaint-form', [ComplaintController::class, 'form'])->name('admin.complaints.form');
			Route::post('/save-complaint', [ComplaintController::class, 'save'])->name('admin.complaints.save');

		/*======================Routes for Complaints=======================*/

		/*======================Routes for Testing=======================*/

			Route::get('/send-test-whatsapp', [TestController::class, 'index'])->name('admin.test.index');
			Route::post('/send-whatsapp-parent-message', [TestController::class, 'sendParent'])->name('admin.parent.test.send');
			Route::post('/send-test-whatsapp-process', [TestController::class, 'send'])->name('admin.test.send');

		/*======================Routes for Testing=======================*/

		/*======================Routes for Report=======================*/

			Route::get('/backup-campaigns', [BackupController::class, 'index'])->name('admin.backup.index');
			Route::get('/whatsapp-backup-datatable', [BackupController::class, 'serverSideDataTable'])->name('admin.backup.serverSideDataTable');
			Route::get('/delete-campaign', [BackupController::class, 'deleteCampaign'])->name('admin.campaign.delete');

		/*======================Routes for Report=======================*/

	});
});
