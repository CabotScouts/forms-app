<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\{Exceptions, Log};

use Tests\TestCase;

class DiscordLogsSendSuccessfullyTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        if(env('LOG_DISCORD_WEBHOOK_URL') === null) {
            $this->markTestSkipped('Discord webhook has not been set');
        }
    }

    #[UnitTest]
    public function test_errors_send_to_discord(): void
    {
        Exceptions::fake();
        config(['logging.default' => 'discord']);
        Log::error('Test error log');
        Exceptions::assertNothingReported();
    }

}
