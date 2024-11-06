<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\CalculateSalariesController;
use App\Http\Controllers\CheckinCheckoutController;
use App\Http\Controllers\ApproveController;
use App\Http\Controllers\ApprovesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Masterfile as Masterfile;
use App\Http\Controllers\RosterTemplateController;
use App\Http\Controllers\RosterController;
use App\Http\Controllers\EmpProfileController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
    Route::get('/', [AuthController::class, 'index'])->name('login.index');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'authLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('loggedin')->group(function () {

        Route::get('auth/logout', [AuthController::class, 'authLogout'])->name('auth.logout');
        Route::get('auth/check-cookie', [AuthController::class, 'checkCookie']);

        // == UserProfile
        Route::get('emp', [EmpProfileController::class, 'calendar'])->name('empprofile.roster');

        Route::get('emp/profile', [EmpProfileController::class, 'profile'])->name('empprofile.profile');
        Route::post('emp/profile/store', [EmpProfileController::class, 'profileStore'])->name('empprofile.profile.store');

        Route::get('emp/checkincheckout', [EmpProfileController::class, 'checkinCheckout'])->name('empprofile.checkincheckout');

        Route::get('emp/get-roster', [EmpProfileController::class, 'getRoster']);
        Route::get('emp/get-roster/show', [EmpProfileController::class, 'getRosterShow'])->name('empprofile.roster.show');

        // == End UserProfile


        /* ===== Super Admin Role ==== */
        Route::middleware('superadmin')->group(function () {

            // Dashboard
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // == OAT == Employee
            Route::get('employees', [EmployeesController::class, 'index'])->name('employees.index');
            Route::get('employees/datatable', [EmployeesController::class, 'datatable'])->name('employees.datatable');
            Route::get('employees/create', [EmployeesController::class, 'create'])->name('employees.create');
            Route::get('employeesedit/{id}', [EmployeesController::class, 'edit'])->name('employees.edit');
            Route::get('employeesshow/{id}', [EmployeesController::class, 'show'])->name('employees.show');
            Route::get('employeesdelete', [EmployeesController::class, 'delete'])->name('employees.delete');
            Route::post('employees/store', [EmployeesController::class, 'store'])->name('employees.store');
            // == End OAT == Employee

            // == OAT == Roster Template
            Route::get('rostertemplate', [RosterTemplateController::class, 'index'])->name('rostertemplate.index');
            Route::get('rostertemplate/datetable', [RosterTemplateController::class, 'datatable'])->name('rostertemplate.datatable');
            Route::get('rostertemplate/create', [RosterTemplateController::class, 'create'])->name('rostertemplate.create');
            Route::get('rostertemplateedit/{id}', [RosterTemplateController::class, 'edit'])->name('rostertemplate.edit');
            Route::get('rostertemplate/plusdetail', [RosterTemplateController::class, 'boxRosterDetail'])->name('rostertemplate.plus.detail');
            Route::post('rostertemplate/store', [RosterTemplateController::class, 'store'])->name('rostertemplate.store');
            Route::post('rostertemplate/delete', [RosterTemplateController::class, 'delete'])->name('rostertemplate.delete');
            // == End OAT == Roster Template

            // == OAT == Roster
            Route::get('roster', [RosterController::class, 'index'])->name('roster.index');
            Route::get('roster/datatable', [RosterController::class, 'datatable'])->name('roster.datatable');
            Route::get('roster/create', [RosterController::class, 'create'])->name('roster.create');
            Route::get('rosteredit/{id}', [RosterController::class, 'edit'])->name('roster.edit');
            Route::get('roster/detail/create', [RosterController::class, 'rosterDetailCreate'])->name('roster.detail.create');
            Route::post('roster/store', [RosterController::class, 'store'])->name('roster.store');
            Route::post('roster/update', [RosterController::class, 'update'])->name('roster.update');
            Route::post('roster/copy', [RosterController::class, 'rosterCopy'])->name('roster.copy');
            Route::post('roster/delete', [RosterController::class, 'delete'])->name('roster.delete');
            Route::get('roster/export/{id}', [RosterController::class, 'rosterExport'])->name('roster.export');
            // == End OAT == Roster

            // == OAT CheckinCheckoutController
            Route::get('checkincheckout', [CheckinCheckoutController::class, 'index'])->name('checkincheckout.index');
            Route::get('checkincheckout/datetable', [CheckinCheckoutController::class, 'datatable'])->name('checkincheckout.datatable');
            Route::get('checkincheckout/gettransaction', [CheckinCheckoutController::class, 'getTransaction'])->name('checkincheckout.gettransaction');
            Route::get('checkincheckout/edit/{id}', [CheckinCheckoutController::class, 'edit'])->name('checkincheckout.edit');
            Route::post('checkincheckout/store', [CheckinCheckoutController::class, 'store'])->name('checkincheckout.store');
            Route::get('checkincheckout/delete', [CheckinCheckoutController::class, 'delete'])->name('checkincheckout.delete');
            // == End OAT CheckinCheckoutController

            // == OAT CalculateSalariesController
            Route::get('calculatesalary', [CalculateSalariesController::class, 'index'])->name('calculatesalary.index');
            Route::get('calculatesalary/datatable', [CalculateSalariesController::class, 'datatable'])->name('calculatesalary.datatable');
            Route::get('calculatesalary/create', [CalculateSalariesController::class, 'create'])->name('calculatesalary.create');
            Route::get('calculatesalary/edit/{id}', [CalculateSalariesController::class, 'edit'])->name('calculatesalary.edit');
            Route::get('calculatesalary/detail/create', [CalculateSalariesController::class, 'salaryDetailCreate'])->name('calculatesalary.detail.create');
            Route::post('calculatesalary/store', [CalculateSalariesController::class, 'store'])->name('calculatesalary.store');
            Route::post('calculatesalary/delete', [CalculateSalariesController::class, 'delete'])->name('calculatesalary.delete');
            Route::get('calculatesalary/export/{id}', [CalculateSalariesController::class, 'calculateSalaryExport'])->name('roscalculatesalaryter.export');
            // == End OAT CalculateSalariesController

            // Masterfile
            Route::get('/branch', [Masterfile\BranchesController::class, 'index'])->name('branch.index');
            Route::get('/branch/datatable', [Masterfile\BranchesController::class, 'datatable'])->name('branch.datetable');
            Route::get('/branch/create', [Masterfile\BranchesController::class, 'create'])->name('branch.create');
            Route::get('/branch/{id}/edit', [Masterfile\BranchesController::class, 'edit'])->name('branch.edit');
            Route::post('/branch', [Masterfile\BranchesController::class, 'store'])->name('branch.store');
            Route::put('/branch', [Masterfile\BranchesController::class, 'update'])->name('branch.update');
            Route::get('/branch/delete', [Masterfile\BranchesController::class, 'delete'])->name('branch.destroy');

            // Department
            Route::get('department', [Masterfile\DepartmentController::class, 'index'])->name('department.index');
            Route::get('department/datetable', [Masterfile\DepartmentController::class, 'datatable'])->name('department.datatable');
            Route::get('department/create', [Masterfile\DepartmentController::class, 'create'])->name('department.create');
            Route::get('department/{id}/edit', [Masterfile\DepartmentController::class, 'edit'])->name('department.edit');
            Route::post('department/store', [Masterfile\DepartmentController::class, 'store'])->name('department.store');
            Route::get('department/delete', [Masterfile\DepartmentController::class, 'delete'])->name('department.delete');

        });
        /* ===== End Super Admin Role ==== */

            // User
            Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
            Route::post('/user/profile/update', [UserController::class, 'update'])->name('user.profile.update');


            // salaries: mango coco: front
            Route::get('/salaries/employeesmangococo/front', [SalaryController::class, 'front'])->name('salaries.employees.mangococo.front.index');
            Route::get('/salariesemployeesmangococo/front/create', [SalariesController::class, 'create'])->name('salaries.employees.mangococo.front.create');
            Route::get('/salariesemployeesmangococo/front/{id}/edit', [SalariesController::class, 'edit'])->name('salaries.employees.mangococo.front.edit');
            Route::delete('/salariesemployeesmangococo/front/{id}', [SalariesController::class, 'destroy'])->name('salaries.employees.mangococo.front.destroy');
            Route::post('/salaries/employeesmangococo/front', [SalariesController::class, 'store'])->name('salaries.employees.mangococo.front.store');
            Route::post('/salariesemployeesmangococo/front/bulk-delete', [SalariesController::class, 'bulkDelete'])->name('salaries.employees.mangococo.front.bulkDelete');


            // salaries: mango coco: dessert
            Route::get('/salaries/employeesmangococo/dessert', [SalaryController::class, 'dessert'])->name('salaries.employees.mangococo.dessert.index');
            Route::get('/salariesemployeesmangococo/dessert/create', [SalariesController::class, 'dessertcreate'])->name('salaries.employees.mangococo.dessert.create');
            Route::get('/salariesemployeesmangococo/dessert/{id}/edit', [SalariesController::class, 'dessertedit'])->name('salaries.employees.mangococo.dessert.edit');
            Route::delete('/salariesemployeesmangococo/dessert/{id}', [SalariesController::class, 'dessertdestroy'])->name('salaries.employees.mangococo.dessert.destroy');
            Route::post('/salaries/employeesmangococo/dessert', [SalariesController::class, 'dessertstore'])->name('salaries.employees.mangococo.dessert.store');


            // salaries: mango coco: kitchen
            Route::get('/salaries/employeesmangococo/kitchen', [SalaryController::class, 'kitchen'])->name('salaries.employees.mangococo.kitchen.index');
            Route::get('/salariesemployeesmangococo/kitchen/create', [SalariesController::class, 'kitchencreate'])->name('salaries.employees.mangococo.kitchen.create');
            Route::get('/salariesemployeesmangococo/kitchen/{id}/edit', [SalariesController::class, 'kitchenedit'])->name('salaries.employees.mangococo.kitchen.edit');
            Route::delete('/salariesemployeesmangococo/kitchen/{id}', [SalariesController::class, 'kitchendestroy'])->name('salaries.employees.mangococo.kitchen.destroy');
            Route::post('/salaries/employeesmangococo/kitchen', [SalariesController::class, 'kitchenstore'])->name('salaries.employees.mangococo.kitchen.store');


            // salaries: mango coco: bakery
            Route::get('/salaries/employeesmangococo/bakery', [SalaryController::class, 'bakery'])->name('salaries.employees.mangococo.bakery.index');
            Route::get('/salariesemployeesmangococo/bakery/create', [SalariesController::class, 'bakerycreate'])->name('salaries.employees.mangococo.bakery.create');
            Route::get('/salariesemployeesmangococo/bakery/{id}/edit', [SalariesController::class, 'bakeryedit'])->name('salaries.employees.mangococo.bakery.edit');
            Route::delete('/salariesemployeesmangococo/bakery/{id}', [SalariesController::class, 'bakerydestroy'])->name('salaries.employees.mangococo.bakery.destroy');
            Route::post('/salaries/employeesmangococo/bakery', [SalariesController::class, 'bakerystore'])->name('salaries.employees.mangococo.bakery.store');


            // salaries: mango coco: office
            Route::get('/salaries/employeesmangococo/office', [SalaryController::class, 'office'])->name('salaries.employees.mangococo.office.index');
            Route::get('/salariesemployeesmangococo/office/create', [SalariesController::class, 'officecreate'])->name('salaries.employees.mangococo.office.create');
            Route::get('/salariesemployeesmangococo/office/{id}/edit', [SalariesController::class, 'officeedit'])->name('salaries.employees.mangococo.office.edit');
            Route::delete('/salariesemployeesmangococo/office/{id}', [SalariesController::class, 'officedestroy'])->name('salaries.employees.mangococo.office.destroy');
            Route::post('/salaries/employeesmangococo/office', [SalariesController::class, 'officestore'])->name('salaries.employees.mangococo.office.store');


            // salaries: flying tigress
            Route::get('/salaries/employees/flyingtigress', [SalaryController::class, 'flyingtigress'])->name('salaries.employees.flyingtigress.index');
            Route::get('/salaries/employeesflyingtigress/create', [SalariesController::class, 'flyingtigresscreate'])->name('salaries.employees.flyingtigress.create');
            Route::get('/salaries/employeesflyingtigress/{id}/edit', [SalariesController::class, 'flyingtigressedit'])->name('salaries.employees.flyingtigress.edit');
            Route::delete('/salaries/employeesflyingtigress/{id}', [SalariesController::class, 'flyingtigressdestroy'])->name('salaries.employees.flyingtigress.destroy');
            Route::post('/salaries/employees/flyingtigress', [SalariesController::class, 'flyingtigressstore'])->name('salaries.employees.flyingtigress.store');


            // salaries: red work: myer
            Route::get('/salaries/employeesredwork/myer', [SalaryController::class, 'myer'])->name('salaries.employees.redwork.myer.index');
            Route::get('/salaries/employeesredworkmyer/create', [SalariesController::class, 'myercreate'])->name('salaries.employees.redwork.myer.create');
            Route::get('/salaries/employeesredworkmyer/{id}/edit', [SalariesController::class, 'myeredit'])->name('salaries.employees.redwork.myer.edit');
            Route::delete('/salaries/employeesredwork/myer/{id}', [SalariesController::class, 'myerdestroy'])->name('salaries.employees.redwork.myer.destroy');
            Route::post('/salaries/employeesredwork/myer', [SalariesController::class, 'myerstore'])->name('salaries.employees.redwork.myer.store');


            // salaries: red work: macquarie
            Route::get('/salaries/employeesredwork/macquarie', [SalaryController::class, 'macquarie'])->name('salaries.employees.redwork.macquarie.index');
            Route::get('/salaries/employeesredworkmacquarie/create', [SalariesController::class, 'macquariecreate'])->name('salaries.employees.redwork.macquarie.create');
            Route::get('/salaries/employeesredworkmacquarie/{id}/edit', [SalariesController::class, 'macquarieedit'])->name('salaries.employees.redwork.macquarie.edit');
            Route::delete('/salaries/employeesredwork/macquarie/{id}', [SalariesController::class, 'macquariedestroy'])->name('salaries.employees.redwork.macquarie.destroy');
            Route::post('/salaries/employeesredwork/macquarie', [SalariesController::class, 'macquariestore'])->name('salaries.employees.redwork.macquarie.store');


            // aprrove mangococo: front
            Route::prefix('approves/mangococo/front')->group(function () {
                Route::get('/checkin', [ApprovesController::class, 'checkin'])->name('approves.mangococo.front.checkin.index');
                Route::get('/checkout', [ApprovesController::class, 'checkout'])->name('approves.mangococo.front.checkout.index');
                Route::get('/breakstart', [ApprovesController::class, 'breakstart'])->name('approves.mangococo.front.breakstart.index');
                Route::get('/breakend', [ApprovesController::class, 'breakend'])->name('approves.mangococo.front.breakend.index');
            });


            // aprrove mangococo: dessert
            Route::prefix('approves/mangococo/dessert')->group(function () {
                Route::get('/checkin', [ApprovesController::class, 'checkin'])->name('approves.mangococo.dessert.checkin.index');
                Route::get('/checkout', [ApprovesController::class, 'checkout'])->name('approves.mangococo.dessert.checkout.index');
                Route::get('/breakstart', [ApprovesController::class, 'breakstart'])->name('approves.mangococo.dessert.breakstart.index');
                Route::get('/breakend', [ApprovesController::class, 'breakend'])->name('approves.mangococo.dessert.breakend.index');
            });


            // aprrove mangococo: kitchen
            Route::prefix('approves/mangococo/kitchen')->group(function () {
                Route::get('/checkin', [ApprovesController::class, 'checkin'])->name('approves.mangococo.kitchen.checkin.index');
                Route::get('/checkout', [ApprovesController::class, 'checkout'])->name('approves.mangococo.kitchen.checkout.index');
                Route::get('/breakstart', [ApprovesController::class, 'breakstart'])->name('approves.mangococo.kitchen.breakstart.index');
                Route::get('/breakend', [ApprovesController::class, 'breakend'])->name('approves.mangococo.kitchen.breakend.index');
            });

            // aprrove mangococo: bakery
            Route::prefix('approves/mangococo/bakery')->group(function () {
                Route::get('/checkin', [ApprovesController::class, 'checkin'])->name('approves.mangococo.bakery.checkin.index');
                Route::get('/checkout', [ApprovesController::class, 'checkout'])->name('approves.mangococo.bakery.checkout.index');
                Route::get('/breakstart', [ApprovesController::class, 'breakstart'])->name('approves.mangococo.bakery.breakstart.index');
                Route::get('/breakend', [ApprovesController::class, 'breakend'])->name('approves.mangococo.bakery.breakend.index');
            });

            // aprrove mangococo: ofiice
            Route::prefix('approves/mangococo/office')->group(function () {
                Route::get('/checkin', [ApprovesController::class, 'checkin'])->name('approves.mangococo.office.checkin.index');
                Route::get('/checkout', [ApprovesController::class, 'checkout'])->name('approves.mangococo.office.checkout.index');
                Route::get('/breakstart', [ApprovesController::class, 'breakstart'])->name('approves.mangococo.office.breakstart.index');
                Route::get('/breakend', [ApprovesController::class, 'breakend'])->name('approves.mangococo.office.breakend.index');
            });

            // aprrove flying tigress
            Route::prefix('approves/flyingtigress')->group(function () {
                Route::get('/checkin', [ApprovesController::class, 'checkin'])->name('approves.flyingtigress.checkin.index');
                Route::get('/checkout', [ApprovesController::class, 'checkout'])->name('approves.flyingtigress.checkout.index');
                Route::get('/breakstart', [ApprovesController::class, 'breakstart'])->name('approves.flyingtigress.breakstart.index');
                Route::get('/breakend', [ApprovesController::class, 'breakend'])->name('approves.flyingtigress.breakend.index');
            });

            // aprrove red work: myer
            Route::prefix('approves/redwork/myer')->group(function () {
                Route::get('/checkin', [ApprovesController::class, 'checkin'])->name('approves.redwork.myer.checkin.index');
                Route::get('/checkout', [ApprovesController::class, 'checkout'])->name('approves.redwork.myer.checkout.index');
                Route::get('/breakstart', [ApprovesController::class, 'breakstart'])->name('approves.redwork.myer.breakstart.index');
                Route::get('/breakend', [ApprovesController::class, 'breakend'])->name('approves.redwork.myer.breakend.index');
            });

            // aprrove red work: macquarie
            Route::prefix('approves/redwork/macquarie')->group(function () {
                Route::get('/checkin', [ApprovesController::class, 'checkin'])->name('approves.redwork.macquarie.checkin.index');
                Route::get('/checkout', [ApprovesController::class, 'checkout'])->name('approves.redwork.macquarie.checkout.index');
                Route::get('/breakstart', [ApprovesController::class, 'breakstart'])->name('approves.redwork.macquarie.breakstart.index');
                Route::get('/breakend', [ApprovesController::class, 'breakend'])->name('approves.redwork.macquarie.breakend.index');
            });
    });






    // OAT
    Route::get('get-department', [GeneralController::class, 'getDepartment'])->name('getdepartment');
    Route::get('get-rostertemplate', [GeneralController::class, 'getRosterTemplate'])->name('getrostertemplate');
    Route::get('get-roster', [GeneralController::class, 'getRoster'])->name('getroster');






Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('storage:link');
    Artisan::call('optimize:clear');
    return 'DONE'; //Return anything
});
