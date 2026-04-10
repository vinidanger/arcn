<?php

use App\Services\ServiceHealthRefresher;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('service-health:refresh', function () {
    app(ServiceHealthRefresher::class)->refresh();
    $this->info('Status dos serviços gravado no banco.');
})->purpose('Mede HTTP dos endpoints e atualiza a tabela service_health_entries (uso manual / debug).');
