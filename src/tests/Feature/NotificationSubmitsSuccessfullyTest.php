<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\{Mail, Storage};
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

use Panfu\Laravel\HCaptcha\HCaptcha;

use App\Models\Notification;
use App\Mail\NotificationSubmitted;

class NotificationSubmitsSuccessfullyTest extends TestCase
{
    use RefreshDatabase;

    protected $baseData = [
        'lic_name' => 'John Smith',
        'lic_email' => 'johnsmith@gmail.com',
        'lic_phone' => '01234567890',
        'group' => '1st Testington',
        'section' => 'Scouts',
        'date' => '2030-01-01',
        'location' => 'Everest',
        'description' => 'Climbing a mountain',
        'intouch' => 'Carrier pigeon',
        'team_leader_email' => 'glv@1sttestington.org.uk',
        'h-captcha-response' => '10000000-aaaa-bbbb-cccc-000000000001',
    ];

    public function test_form_is_viewable(): void
    {
        $response = $this->get(route('notification.form'));
        $response->assertStatus(200);
    }

    public function test_notification_is_submitted(): void
    {
        // 1 - upload a fake risk assessment
        $tmp = config('filepond.temporary_files_path', 'filepond');
        $disk = config('filepond.temporary_files_disk', 'local');
        Storage::fake($disk);

        $upload = $this->postJson('/filepond/api/process', [
            'file' => UploadedFile::fake()->create('risk_assessment.pdf', 1),
        ]);

        $upload->assertStatus(200);
        $sid = $upload->content();
        $this->assertGreaterThan(50, strlen($sid));

        // 2 - submit notification using base data and the uploaded file
        $data = array_merge($this->baseData, [
            'uploads' => json_encode([$sid]),
        ]);

        Mail::fake();
        $response = $this->post(route('notification.submit', $data));
        $response->assertStatus(200);

        // 3 - check notification and upload in DB, and mail was sent
        $this->assertDatabaseHas('notifications', ['lic_name' => 'John Smith']);
        $this->assertDatabaseHas('uploads', ['name' => 'risk_assessment.pdf']);
        Mail::assertQueued(NotificationSubmitted::class);
    }
}
