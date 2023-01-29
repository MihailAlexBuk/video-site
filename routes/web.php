<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');
Route::get('/video/{id}', [\App\Http\Controllers\VideoController::class, 'show'])->name('watch');
Route::get('/search', [\App\Http\Controllers\Components\SearchBarController::class, 'search'])->name('search');
Route::post('/find', [\App\Http\Controllers\Components\SearchBarController::class, 'find'])->name('find');

Route::get('profile/{id}', [\App\Http\Controllers\Profile\UserProfileController::class, 'index'])->name('profile');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('videos', \App\Http\Controllers\VideoController::class);

    ROute::post('add-comment', [\App\Http\Controllers\Components\CommentController::class, 'add_comment'])->name('add-comment');

    Route::get('likedlist', [\App\Http\Controllers\Profile\LikedListController::class, 'index'])->name('likedlist');
    Route::get('subscriptions', [\App\Http\Controllers\Profile\SubscriptionListController::class, 'index'])->name('subscriptions');

    Route::post('save-likedislike',[\App\Http\Controllers\VideoController::class, 'save_likedislike']);
    Route::post('check-likedislike',[\App\Http\Controllers\VideoController::class, 'check_likedislike']);

    Route::post('users/{id}/follow', [\App\Http\Controllers\Components\FollowerController::class, 'follow'])->name('follow');
    Route::delete('users/{id}/unfollow', [\App\Http\Controllers\Components\FollowerController::class, 'unfollow'])->name('unfollow');

    Route::post('markAsRead', [\App\Http\Controllers\Components\FollowerController::class, 'markAsRead']);
    Route::get('markAsReadAll', [\App\Http\Controllers\Components\FollowerController::class, 'markAsReadAll']);

    Route::get('settings', [\App\Http\Controllers\Profile\SettingsController::class, 'settings'])->name('settings');
    Route::put('updateUserData', [\App\Http\Controllers\Profile\SettingsController::class, 'updateUserData'])->name('updateUserData');

});

Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth']], function(){
    Route::get('/', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('admin.index');

    Route::resources([
        'categories' => \App\Http\Controllers\Admin\CategoryController::class,
        'tags' => \App\Http\Controllers\Admin\TagController::class,
        'users' => \App\Http\Controllers\Admin\UserController::class,
    ]);
});

Auth::routes();

