<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require __DIR__ . '/custom/auth_routes.php';
    require __DIR__ . '/custom/guardian_routes.php';
    require __DIR__ . '/custom/business_admin_routes.php';
    require __DIR__ . '/custom/school_admin_routes.php';
});
