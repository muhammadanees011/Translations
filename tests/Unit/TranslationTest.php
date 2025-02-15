<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Translation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TranslationTest extends TestCase
{
    use RefreshDatabase;

    public function test_translation_creation()
    {
        $translation = Translation::create([
            'locale' => 'en',
            'key' => 'hello',
            'content' => 'Hello',
            'context' => 'web',
        ]);

        $this->assertDatabaseHas('translations', ['key' => 'hello']);
        $this->assertEquals('Hello', $translation->content);
    }
}
