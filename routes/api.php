<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::prefix("cashier")->group(function () {
    Route::post("contact/send", [EmailController::class, "contact"])->name("cashier.contact");
});
