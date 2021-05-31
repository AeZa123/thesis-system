<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckStatusAdmin;
use App\Http\Middleware\CheckStatusTeacher;
use App\Http\Middleware\CheckStatusStudent;
use App\Http\Middleware\CheckStatusUser;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\App;

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
    return view('index');
});




//notification
Route::get('show-notification', [\App\Http\Controllers\NotificationController::class, 'index'])->name('show-notification');
Route::get('detail-notification/{id}', [\App\Http\Controllers\NotificationController::class, 'detail']);
Route::post('confirm-group', [\App\Http\Controllers\NotificationController::class, 'confirm_group'])->name('confirm-group');
Route::get('only-student/{id}', [\App\Http\Controllers\NotificationController::class, 'onlyStudent']);


Auth::routes();

//create new rout search
Route::get('public-search', [\App\Http\Controllers\PublicController::class, 'search'])->name('public-search');
Route::get('public/show/{id}', [\App\Http\Controllers\PublicController::class, 'showThesis']);
Route::get('public-download', [\App\Http\Controllers\PublicController::class, 'download']);
Route::get('public-topdowload', [\App\Http\Controllers\PublicController::class, 'topdownload'])->name('public-topdowload');


    //middleware CheckUser
Route::middleware([CheckStatusUser::class])->group(function () {


    //members
    Route::get('/members', [\App\Http\Controllers\ManageMember\ManageMemberController::class, 'index'])->name('managemember')->middleware([CheckStatusTeacher::class]);
    Route::get('/profile/member/{id}', [\App\Http\Controllers\ManageMember\ManageMemberController::class, 'profile']);
    Route::post('/create', [\App\Http\Controllers\ManageMember\ManageMemberController::class, 'store'])->name('create')->middleware([CheckStatusAdmin::class]);
    Route::post('/update-user', [\App\Http\Controllers\ManageMember\ManageMemberController::class, 'update'])->name('update-user')->middleware([CheckStatusUser::class]);
    Route::get('/edit/member/{id}', [\App\Http\Controllers\ManageMember\ManageMemberController::class, 'edit'])->middleware([CheckStatusTeacher::class]);
    Route::get('/profile/member/edit/member-profile/{id}', [\App\Http\Controllers\ManageMember\ManageMemberController::class, 'edit']);
    Route::get('/add-member', [\App\Http\Controllers\ManageMember\ManageMemberController::class, 'create'])->name('add-member')->middleware([CheckStatusAdmin::class]);
    Route::post('/delete-member', [\App\Http\Controllers\ManageMember\ManageMemberController::class, 'delete'])->name('delete-member')->middleware([CheckStatusTeacher::class]);
    Route::post('importCSV', [\App\Http\Controllers\ManageMember\ManageMemberController::class, 'importFileCSV'])->name('import-users');
    Route::get('export-excel', [\App\Http\Controllers\ManageMember\ManageMemberController::class, 'exportUserToExcel'])->name('export-excel')->middleware([CheckStatusTeacher::class]);
    Route::get('export-csv', [\App\Http\Controllers\ManageMember\ManageMemberController::class, 'exportUserToCSV'])->name('export-csv')->middleware([CheckStatusTeacher::class]);
    Route::post('change-password', [\App\Http\Controllers\ManageMember\ManageMemberController::class, 'updatepassword'])->name('update-password');


    //thesis
    Route::get('/theses', [\App\Http\Controllers\ThesisController::class, 'index'])->name('theses')->middleware([CheckStatusTeacher::class]);
    Route::get('/create-thesis', [\App\Http\Controllers\ThesisController::class, 'create'])->name('createthesis')->middleware([CheckStatusStudent::class]);
    Route::post('/add-thesis', [\App\Http\Controllers\ThesisController::class, 'store'])->name('create-thesis')->middleware([CheckStatusStudent::class]);
    Route::get('/edit/thesis/{id}', [\App\Http\Controllers\ThesisController::class, 'edit'])->middleware([CheckStatusTeacher::class]);
    Route::post('/update/thesis', [\App\Http\Controllers\ThesisController::class, 'update'])->name('update-thesis')->middleware([CheckStatusTeacher::class]);
    Route::post('/delete-thesis', [\App\Http\Controllers\ThesisController::class, 'delete'])->name('delete-thesis')->middleware([CheckStatusTeacher::class]);
    Route::get('/show/{id}', [\App\Http\Controllers\ThesisController::class, 'showThesis']);
    Route::post('/CheckStatusThesis', [\App\Http\Controllers\ThesisController::class, 'CheckStatusThesis'])->name('check-thesis')->middleware([CheckStatusTeacher::class]);


    //download
    Route::get('/download/thesis/{file_thesis}', [\App\Http\Controllers\DownloadController::class, 'downloads']);
    Route::get('/history-download', [\App\Http\Controllers\DownloadController::class, 'index'])->name('history-download')->middleware([CheckStatusTeacher::class]);
    Route::get('/detail/{id}', [\App\Http\Controllers\DownloadController::class, 'details'])->middleware([CheckStatusTeacher::class]);
    //Route::get('top-download', [\App\Http\Controllers\DownloadController::class, 'topdownload'])->name('topdownload');



    //search
    Route::get('/search-theses', [\App\Http\Controllers\SearchController::class, 'index'])->name('search-theses');
    Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');


    //Group
    Route::get('show-group', [\App\Http\Controllers\GroupController::class, 'index'])->name('show-group')->middleware([CheckStatusStudent::class]);
    Route::get('manage-group', [\App\Http\Controllers\GroupController::class, 'indexForAdmin'])->name('manage-group')->middleware([CheckStatusTeacher::class]);
    Route::get('create-group', [\App\Http\Controllers\GroupController::class, 'createGroup'])->name('create-group')->middleware([CheckStatusStudent::class]); //ไปหน้าฟอร์ม สร้างกลุ่ม
    Route::post('create-data', [\App\Http\Controllers\GroupController::class, 'storage'])->name('create-data')->middleware([CheckStatusStudent::class]);  //บันทึกข้อมูลจากฟอร์มลง table
    Route::get('edit-group/{id}', [\App\Http\Controllers\GroupController::class, 'edit'])->middleware([CheckStatusStudent::class]);
    Route::post('editSave', [\App\Http\Controllers\GroupController::class, 'editSave'])->name('editSave')->middleware([CheckStatusStudent::class]);
    Route::post('delete-group', [\App\Http\Controllers\GroupController::class, 'delete'])->name('delete-group')->middleware([CheckStatusTeacher::class]);
    //Route::post('editSave', [\App\Http\Controllers\GroupController::class, 'test'])->name('editSave');


    //work
    Route::post('createWork', [\App\Http\Controllers\WorkController::class, 'createWork'])->name('createWork')->middleware([CheckStatusTeacher::class]);
    Route::get('show-work/{id}', [\App\Http\Controllers\GroupController::class, 'showWork'])->middleware([CheckStatusStudent::class]);
    Route::post('addWork', [\App\Http\Controllers\WorkController::class, 'storage'])->name('addWork')->middleware([CheckStatusTeacher::class]);
    Route::get('sendwork/{id}', [\App\Http\Controllers\WorkController::class, 'sendWork'])->middleware([CheckStatusStudent::class]);
    Route::get('editPage/{id}', [\App\Http\Controllers\WorkController::class, 'edit'])->middleware([CheckStatusTeacher::class]);
    Route::post('updateWork', [\App\Http\Controllers\WorkController::class, 'update'])->name('updateWork')->middleware([CheckStatusStudent::class]);



    //report
    Route::post('workstorag', [\App\Http\Controllers\ReportController::class, 'storage'])->name('workstorag')->middleware([CheckStatusStudent::class]);
    Route::get('download/work/{document}', [\App\Http\Controllers\DownloadController::class, 'downloadsWork'])->middleware([CheckStatusStudent::class]);
    Route::get('download/report/{document}', [\App\Http\Controllers\DownloadController::class, 'downloadsReport'])->middleware([CheckStatusStudent::class]);
    Route::get('delete/report/{id}', [\App\Http\Controllers\ReportController::class, 'delete'])->middleware([CheckStatusStudent::class]);

    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware([CheckStatusTeacher::class]);



});











//test











