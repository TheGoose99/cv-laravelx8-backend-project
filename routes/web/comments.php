<?php
Route::get('/comments/{id}', [App\Http\Controllers\CommentController::class, 'show'])->name('comment');

Route::middleware('auth')->group(function() {
    Route::get('/comments', [App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');

    Route::delete('/comments/{comment}/destroy', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.destroy');
    Route::patch('/comments/{comment}/update', [App\Http\Controllers\CommentController::class, 'update'])->name('comment.update');
    Route::get('/comments/create', [App\Http\Controllers\CommentController::class, 'create'])->name('comments.create');
    Route::post('/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

    Route::patch('/comments/{comment}/updateText', [App\Http\Controllers\CommentController::class, 'update'])->name('comment.updateText');

    Route::get('/comments/{comment}/edit', [App\Http\Controllers\CommentController::class, 'edit'])->name('comment.edit');

    Route::post('/comment/reply', [App\Http\Controllers\CommentRepliesController::class, 'createReply'])->name('comment-reply.createReply');
    Route::delete('/replies/delete', [App\Http\Controllers\CommentRepliesController::class, 'destroy'])->name('reply.delete');
    Route::patch('/replies/{reply}/update', [App\Http\Controllers\CommentRepliesController::class, 'update'])->name('reply.update');

});