<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Url;
use App\Http\Requests\StoreUrlRequest;

class UrlControllerTest extends TestCase
{
    public function test_store_method_creates_url()
    {
        $requestData = [
            'full_url' => 'http://example.com',
            'url_desc' => 'Example description',
            'user_id' => 1,
        ];

        $response = $this->post('/api/urls', $requestData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('urls', [
            'full_url' => $requestData['full_url'],
            'url_desc' => $requestData['url_desc'],
            'user_id' => $requestData['user_id'],
        ]);
    }
}