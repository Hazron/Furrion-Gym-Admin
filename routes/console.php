<?php

use App\Http\Controllers\Admin\MemberController;
use Illuminate\Support\Facades\Artisan;

Artisan::command('members:auto-disable', function () {
    $controller = new MemberController();
    $controller->autoDisableMember();

    $this->info('Members have been auto-disabled successfully.');
})->purpose('Auto disable members whose membership has expired')
    ->everyTwoMinutes();
