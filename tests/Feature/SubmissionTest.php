<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->postJson("/api/submit", [
            "name" => "John Doe",
            "email" => "john.doe@example.com",
            "message" => "This is a test message."
        ])->assertJson([
            "message" => __('submission.submission_processed'),
        ]);

        $response->assertStatus(Response::HTTP_ACCEPTED);
    }

    public function test_submission_create_validation(): void
    {
        $response = $this->postJson('/api/submit', [
            'name' => '',
            'email' => '',
            'message' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
                'email',
                'message',
            ]);
    }
}
