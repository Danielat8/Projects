<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserAboutController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\Admin\ConferencesController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\SpeakersController;
use App\Http\Controllers\Admin\AgendasController;
use App\Http\Controllers\Admin\UserLogController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\AboutUserController;
use App\Http\Controllers\Admin\GeneralinfoController;
use App\Http\Controllers\User\FriendsController;
use App\Http\Controllers\User\UserBlogsController;
use App\Http\Controllers\User\UserCommentsController;
use App\Http\Controllers\User\UsersAboutController;
use App\Http\Controllers\User\RecommendationsController;
use App\Http\Controllers\User\UserTicketsController;
use App\Http\Controllers\User\UserSettingsController;


Route::middleware([UserMiddleware::class])->prefix('user')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.userpanel');
    Route::get('/user/aboutuser', [UserController::class, 'about'])->name('user.aboutuser');
    Route::post('/user/aboutuser', [UserAboutController::class, 'store'])->name('user.aboutuser.store');
    Route::put('/user/aboutuser/{id}', [UserAboutController::class, 'update'])->name('user.aboutuser.update');
    //  ticket
    Route::get('/tickets', [UserTicketsController::class, 'index'])->name('user.tickets.index');
    Route::get('/tickets/{ticket}', [UserTicketsController::class, 'show'])->name('user.tickets.show');
    Route::post('/tickets/{ticket}/buy', [UserTicketsController::class, 'buy'])->name('user.tickets.buy');
    // navbar route 
    Route::get('/friends', [FriendsController::class, 'friends'])->name('user.friends.index');
    Route::get('/blogs', [UserBlogsController::class, 'blogs'])->name('user.blogs.index');
    Route::get('/comments', [UserCommentsController::class, 'comments'])->name('user.comments.index');
    Route::get('/usersabout', [UsersAboutController::class, 'usersabout'])->name('user.usersabout.index');
    Route::get('/recommendations', [RecommendationsController::class, 'recommendations'])->name('user.recommendations.index');
    // user
    Route::get('usersabout', [UsersAboutController::class, 'index'])->name('user.usersabout.index');
    Route::get('usersabout/create', [UsersAboutController::class, 'create'])->name('user.usersabout.create');
    Route::post('usersabout', [UsersAboutController::class, 'store'])->name('user.usersabout.store');
    Route::get('usersabout/{id}/edit', [UsersAboutController::class, 'edit'])->name('user.usersabout.edit');
    Route::put('usersabout/{id}', [UsersAboutController::class, 'update'])->name('user.usersabout.update');
    Route::delete('usersabout/{id}', [UsersAboutController::class, 'destroy'])->name('user.usersabout.destroy');
    // bloguser
    Route::get('blogs', [UserBlogsController::class, 'index'])->name('user.blogs.index');
    Route::get('blogs/create', [UserBlogsController::class, 'create'])->name('user.blogs.create');
    Route::post('blogs', [UserBlogsController::class, 'store'])->name('user.blogs.store');
    Route::get('blogs/{id}/edit', [UserBlogsController::class, 'edit'])->name('user.blogs.edit');
    Route::put('blogs/{id}', [UserBlogsController::class, 'update'])->name('user.blogs.update');
    Route::delete('blogs/{id}', [UserBlogsController::class, 'destroy'])->name('user.blogs.destroy');
    // comments
    Route::post('/user/comments/store', [UserCommentsController::class, 'store'])->name('user.comments.store');
    Route::get('comments', [UserCommentsController::class, 'index'])->name('user.comments.index');
    Route::get('comments/create', [UserCommentsController::class, 'create'])->name('user.comments.create');
    Route::post('comments', [UserCommentsController::class, 'store'])->name('user.comments.store');
    Route::get('comments/{id}/edit', [UserCommentsController::class, 'edit'])->name('user.comments.edit');
    Route::put('comments/{id}', [UserCommentsController::class, 'update'])->name('user.comments.update');
    Route::delete('comments/{id}', [UserCommentsController::class, 'destroy'])->name('user.comments.destroy');
    Route::get('/blogs/{id}', [UserBlogsController::class, 'show'])->name('user.blogs.show');
    // like comment and blog 
    Route::post('/user/comments/{id}/like', [UserCommentsController::class, 'like'])->name('user.comments.like');
    Route::post('/user/comments/{id}/unlike', [UserCommentsController::class, 'unlike'])->name('user.comments.unlike');
    Route::post('/user/blogs/{id}/like', [UserBlogsController::class, 'likeBlog'])->name('user.blogs.like');
    Route::post('/user/blogs/{id}/unlike', [UserBlogsController::class, 'unlikeBlog'])->name('user.blogs.unlike');
    // Recommendations
    Route::get('recommendations', [RecommendationsController::class, 'index'])->name('user.recommendations.index');
    Route::get('recommendations/create', [RecommendationsController::class, 'create'])->name('user.recommendations.create');
    Route::post('recommendations', [RecommendationsController::class, 'store'])->name('user.recommendations.store');
    Route::put('recommendations/{id}', [RecommendationsController::class, 'update'])->name('user.recommendations.update');
    Route::get('recommendations/{id}/edit', [RecommendationsController::class, 'edit'])->name('user.recommendations.edit');
    Route::delete('recommendations/{id}', [RecommendationsController::class, 'destroy'])->name('user.recommendations.destroy');
    // new
    Route::get('recommendations/my', [RecommendationsController::class, 'myRecommendations'])->name('user.recommendations.my');
    Route::get('recommendations/received', [RecommendationsController::class, 'receivedRecommendations'])->name('user.recommendations.received');

    // friends
    Route::post('/friends/block/{id}', [FriendsController::class, 'blockUser'])->name('user.friends.block');
    Route::post('/friends/unblock/{id}', [FriendsController::class, 'unblockUser'])->name('user.friends.unblock');
    //    setting
    Route::get('/user/settings', [UserSettingsController::class, 'index'])->name('user.settings.setting');
    Route::put('/user/settings/update', [UserSettingsController::class, 'update'])->name('user.settings.update');
    /////

});

// this is for user and admin about friends connection
Route::get('/friends', [FriendsController::class, 'index'])->name('user.friends.index');
Route::post('/friends/send-request', [FriendsController::class, 'sendRequest'])->name('user.friends.sendRequest');
Route::post('/friends/accept/{id}', [FriendsController::class, 'acceptRequest'])->name('user.friends.accept');
Route::delete('/friends/reject/{id}', [FriendsController::class, 'rejectRequest'])->name('user.friends.reject');
Route::post('/friends/unfriend', [FriendsController::class, 'unfriend'])->name('user.friends.unfriend');
Route::get('/user/{id}', [UsersAboutController::class, 'show'])->name('user.show');





Route::middleware([AdminMiddleware::class])->prefix('admin')->group(function () {
    // friends
    Route::post('/friends/ban/{id}', [FriendsController::class, 'banUser'])->name('user.ban');
    Route::post('/friends/unban/{id}', [FriendsController::class, 'unbanUser'])->name('user.unban');
    // navbar
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.adminpanel');
    // agendas
    Route::get('/agendas', [AgendasController::class, 'index'])->name('admin.agendas.index');
    Route::get('/agendas/create', [AgendasController::class, 'create'])->name('admin.agendas.create');
    Route::post('/agendas', [AgendasController::class, 'store'])->name('admin.agendas.store');
    Route::get('/agendas/{id}/edit', [AgendasController::class, 'edit'])->name('admin.agendas.edit');
    Route::put('/agendas/{id}', [AgendasController::class, 'update'])->name('admin.agendas.update');
    Route::delete('/agendas/{id}', [AgendasController::class, 'destroy'])->name('admin.agendas.destroy');
    //   conference
    Route::get('/conferences', [ConferencesController::class, 'index'])->name('admin.conferences.index');
    Route::get('/conferences/create', [ConferencesController::class, 'create'])->name('admin.conferences.create');
    Route::post('/conferences', [ConferencesController::class, 'store'])->name('admin.conferences.store');
    Route::get('/conferences/{id}/edit', [ConferencesController::class, 'edit'])->name('admin.conferences.edit');
    Route::put('/conferences/{id}', [ConferencesController::class, 'update'])->name('admin.conferences.update');
    Route::delete('/conferences/{id}', [ConferencesController::class, 'destroy'])->name('admin.conferences.destroy');
    // Employee routes
    Route::get('/employee', [EmployeesController::class, 'index'])->name('admin.employees.index');
    Route::get('/employee/create', [EmployeesController::class, 'create'])->name('admin.employees.create');
    Route::post('/employee', [EmployeesController::class, 'store'])->name('admin.employees.store');
    Route::get('/employee/{id}/edit', [EmployeesController::class, 'edit'])->name('admin.employees.edit');
    Route::put('/employee/{id}', [EmployeesController::class, 'update'])->name('admin.employees.update');
    Route::delete('/employee/{id}', [EmployeesController::class, 'destroy'])->name('admin.employees.destroy');
    // Events routes
    Route::get('/event', [EventsController::class, 'index'])->name('admin.events.index');
    Route::get('/event/create', [EventsController::class, 'create'])->name('admin.events.create');
    Route::post('/event', [EventsController::class, 'store'])->name('admin.events.store');
    Route::get('/event/{id}/edit', [EventsController::class, 'edit'])->name('admin.events.edit');
    Route::put('/event/{id}', [EventsController::class, 'update'])->name('admin.events.update');
    Route::delete('/event/{id}', [EventsController::class, 'destroy'])->name('admin.events.destroy');
    // Event Speakers routes
    Route::get('speakers', [SpeakersController::class, 'index'])->name('admin.speakers.index');
    Route::get('speakers/create', [SpeakersController::class, 'create'])->name('admin.speakers.create');
    Route::post('speakers', [SpeakersController::class, 'store'])->name('admin.speakers.store');
    Route::get('speakers/{id}/edit', [SpeakersController::class, 'edit'])->name('admin.speakers.edit');
    Route::put('speakers/{id}', [SpeakersController::class, 'update'])->name('admin.speakers.update');
    Route::delete('speakers/{id}', [SpeakersController::class, 'destroy'])->name('admin.speakers.destroy');
    // Tickets routes
    Route::get('tickets', [TicketsController::class, 'index'])->name('admin.tickets.index');
    Route::get('tickets/create', [TicketsController::class, 'create'])->name('admin.tickets.create');
    Route::post('tickets', [TicketsController::class, 'store'])->name('admin.tickets.store');
    Route::get('tickets/{id}/edit', [TicketsController::class, 'edit'])->name('admin.tickets.edit');
    Route::put('tickets/{id}', [TicketsController::class, 'update'])->name('admin.tickets.update');
    Route::delete('tickets/{id}', [TicketsController::class, 'destroy'])->name('admin.tickets.destroy');
    // About User routes
    Route::get('aboutuser', [AboutUserController::class, 'index'])->name('admin.aboutuser.index');
    Route::get('aboutuser/create', [AboutUserController::class, 'create'])->name('admin.aboutuser.create');
    Route::post('aboutuser', [AboutUserController::class, 'store'])->name('admin.aboutuser.store');
    Route::get('aboutuser/{id}/edit', [AboutUserController::class, 'edit'])->name('admin.aboutuser.edit');
    Route::put('aboutuser/{id}', [AboutUserController::class, 'update'])->name('admin.aboutuser.update');
    Route::delete('aboutuser/{id}', [AboutUserController::class, 'destroy'])->name('admin.aboutuser.destroy');
    Route::get('aboutuser/{id}/showcv', [AboutUserController::class, 'showcv'])->name('admin.aboutuser.showcv');
    // About Blogs routes
    Route::get('blogs', [BlogsController::class, 'index'])->name('admin.blogs.index');
    Route::get('blogs/create', [BlogsController::class, 'create'])->name('admin.blogs.create');
    Route::post('blogs', [BlogsController::class, 'store'])->name('admin.blogs.store');
    Route::get('blogs/{id}/edit', [BlogsController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('blogs/{id}', [BlogsController::class, 'update'])->name('admin.blogs.update');
    Route::delete('blogs/{id}', [BlogsController::class, 'destroy'])->name('admin.blogs.destroy');
    // About Comments routes
    Route::get('comments', [CommentsController::class, 'index'])->name('admin.comments.index');
    Route::delete('comments/{id}', [CommentsController::class, 'destroy'])->name('admin.comments.destroy');
    // General Info
    Route::get('generalinfo', [GeneralinfoController::class, 'index'])->name('admin.generalinfo.index');
    Route::get('generalinfo/create', [GeneralinfoController::class, 'create'])->name('admin.generalinfo.create');
    Route::post('generalinfo', [GeneralinfoController::class, 'store'])->name('admin.generalinfo.store');
    Route::get('generalinfo/{id}/edit', [GeneralinfoController::class, 'edit'])->name('admin.generalinfo.edit');
    Route::put('generalinfo/{id}', [GeneralinfoController::class, 'update'])->name('admin.generalinfo.update');
    Route::delete('generalinfo/{id}', [GeneralinfoController::class, 'destroy'])->name('admin.generalinfo.destroy');
});



// breeze
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
