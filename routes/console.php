<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

Schedule::command('app:get-demanda-actual')->everyTenSeconds();
Schedule::command('app:get-demanda-historico')->everyFiveMinutes();
Schedule::command('app:get-currencies')->daily();
