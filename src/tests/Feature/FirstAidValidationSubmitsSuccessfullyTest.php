<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\{Mail, Storage};
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

use Panfu\Laravel\HCaptcha\HCaptcha;

use App\Models\FirstAidValidation;
use App\Mail\FirstAidValidationSubmitted;

class FirstAidValidationSubmitsSuccessfullyTest extends TestCase
{
    use RefreshDatabase;

    protected $baseData = [
        'name' => 'John Smith',
        'email' => 'johnsmith@gmail.com',
        'membership' => '01234',
        'date' => '2025-01-01',
        'additional' => 'Additional information here',
        'h-captcha-response' => '10000000-aaaa-bbbb-cccc-000000000001',
    ];

    public function test_validation_is_submitted(): void
    {
        // 1 - upload fake evidence
        $tmp = config('filepond.temporary_files_path', 'filepond');
        $disk = config('filepond.temporary_files_disk', 'local');
        Storage::fake($disk);

        $upload = $this->postJson('/filepond/api/process', [
            'file' => UploadedFile::fake()->create('checklist.pdf', 1),
        ]);

        $upload->assertStatus(200);
        $sid = $upload->content();
        $this->assertGreaterThan(50, strlen($sid));

        // 2 - submit validation request using base data and the uploaded file
        $data = array_merge($this->baseData, [
            'uploads' => json_encode([$sid]),
        ]);

        Mail::fake();
        $response = $this->post(route('fa.submit', $data));
        $response->assertStatus(302);

        // 3 - check validation request and upload in DB, and mail was sent
        $this->assertDatabaseHas('first_aid_validations', ['name' => 'John Smith']);
        $this->assertDatabaseHas('uploads', ['name' => 'checklist.pdf']);
        Mail::assertQueued(FirstAidValidationSubmitted::class);
    }
}
