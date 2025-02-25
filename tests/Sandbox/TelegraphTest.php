<?php

/** @noinspection LaravelFunctionsInspection */

use DefStudio\Telegraph\Facades\Telegraph;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('can return bot info', function () {
    $bot = sandbox_bot();

    $response = Telegraph::bot($bot)->botInfo()->send();
    assertMatchesSnapshot($response->json('result'));
})->skip(fn () => empty(env('SANDOBOX_TELEGRAM_BOT_TOKEN')) || env('SANDOBOX_TELEGRAM_BOT_TOKEN') === ':fake_bot_token:', 'Sandbox telegram bot token missing');
