<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

use App\Models\AccidentReport;
use App\Mail\AccidentReportSubmitted;

class AccidentReportSubmitsSuccessfullyTest extends TestCase
{
    use RefreshDatabase;

    protected $baseData = [
        'reporter_name' => 'John Smith',
        'reporter_email' => 'johnsmith@gmail.com',
        'reporting_unit' => 'Team',
        'their_name' => "A Scout",
        'their_dob' => '2020-01-01',
        'their_unit' => 'Unit',
        'when' => '2025-01-01',
        'where' => 'A location',
        'details' => 'Accident',
        'treatment' => 'Treatment',
        'further_reporting' => '1',
        'h-captcha-response' => '10000000-aaaa-bbbb-cccc-000000000001',
    ];

    public function test_form_is_viewable(): void
    {
        $response = $this->get(route('accident.form'));
        $response->assertStatus(200);
    }

    public function test_report_is_submitted(): void
    {
        Mail::fake();
        $response = $this->post(route('accident.submit'), $this->baseData);
        $response->assertStatus(200);

        $this->assertDatabaseHas('accident_reports', ['reporter_name' => 'John Smith']);
        Mail::assertQueued(AccidentReportSubmitted::class);
    }

    // we should add some tests here to make sure removal date logic doesn't get broken
}