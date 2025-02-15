<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Translation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TranslationFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_translation()
    {
        $this->withoutMiddleware();

        $response = $this->withHeaders([
        ])->postJson('/api/translations', [
            'locale' => 'en',
            'key' => 'welcome',
            'content' => 'Welcome',
            'context' => 'web',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('translations', ['key' => 'welcome']);
    }

    public function test_update_translation()
    {
        $this->withoutMiddleware();
        $translation = Translation::factory()->create();

        $response = $this->withHeaders([
        ])->putJson("/api/translations/{$translation->id}", [
            'content' => 'Updated Content',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('translations', ['content' => 'Updated Content']);
    }

    public function test_get_translation()
    {
        $this->withoutMiddleware();
        $translation = Translation::factory()->create();

        $response = $this->withHeaders([
        ])->getJson("/api/translations/{$translation->id}");

        $response->assertStatus(200);
        $response->assertJson(['id' => $translation->id]);
    }

    public function test_search_translations()
    {
        $this->withoutMiddleware();
        Translation::factory()->count(3)->create();

        $response = $this->withHeaders([
        ])->postJson("/api/translations/search", [
            'key' => 'test',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'locale', 'key', 'content', 'context']
        ]);
    }

    public function test_export_translations()
    {
        $this->withoutMiddleware();
        Translation::factory()->count(3)->create();

        $response = $this->withHeaders([
        ])->getJson('/api/export-translations');

        $response->assertStatus(200);
        $response->assertJsonStructure(['en']);
    }
}
