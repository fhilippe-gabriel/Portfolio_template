<?php

namespace Tests\Feature;

use App\Models\About;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateAboutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the edit page renders successfully with about data.
     */
    public function test_edit_page_renders_with_about_data(): void
    {
        $about = About::factory()->create([
            'title' => 'Titulo Exemplo Teste',
            'subtitle' => 'Subtitulo Exemplo Teste',
            'description' => 'Descricao Exemplo Teste',
        ]);

        $response = $this->get(route('private.edit'));

        $response->assertStatus(200);
        $response->assertSee('Titulo Exemplo Teste');
        $response->assertSee('Subtitulo Exemplo Teste');
        $response->assertSee('Descricao Exemplo Teste');
        $response->assertSee(route('about.update', $about));
    }

    /**
     * Test updating the about title successfully.
     */
    public function test_can_update_about_title(): void
    {
        $about = About::factory()->create([
            'title' => 'Titulo Original',
        ]);

        $response = $this->put(route('about.update', $about), [
            'title' => 'Titulo Atualizado',
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('abouts', [
            'id' => $about->id,
            'title' => 'Titulo Atualizado',
        ]);
    }

    /**
     * Test updating the about subtitle successfully.
     */
    public function test_can_update_about_subtitle(): void
    {
        $about = About::factory()->create([
            'subtitle' => 'Subtitulo Original',
        ]);

        $response = $this->put(route('about.update', $about), [
            'subtitle' => 'Subtitulo Atualizado',
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('abouts', [
            'id' => $about->id,
            'subtitle' => 'Subtitulo Atualizado',
        ]);
    }

    /**
     * Test updating the about description successfully.
     */
    public function test_can_update_about_description(): void
    {
        $about = About::factory()->create([
            'description' => 'Descricao Original',
        ]);

        $response = $this->put(route('about.update', $about), [
            'description' => 'Descricao Atualizada',
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('abouts', [
            'id' => $about->id,
            'description' => 'Descricao Atualizada',
        ]);
    }

    /**
     * Test uploading a photo file successfully (jpg, png, jpeg).
     */
    public function test_can_upload_photo_file_successfully(): void
    {
        Storage::fake('public');

        $about = About::factory()->create([
            'user_imagem' => 'https://exemplo.com/antiga.jpg',
        ]);

        // 1x1 pixel JPEG válido
        $jpegBinary = hex2bin('ffd8ffe000104a46494600010101006000600000ffdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffc0000b080001000101011100ffda0008010100003f00bf80ffc9');
        $file = UploadedFile::fake()->createWithContent('perfil.jpg', $jpegBinary);

        $response = $this->put(route('about.update', $about), [
            'user_imagem_file' => $file,
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');

        $about->refresh();
        $this->assertStringContainsString('/storage/abouts/', $about->user_imagem);

        $storedPath = str_replace('/storage/', '', $about->user_imagem);
        Storage::disk('public')->assertExists($storedPath);
    }

    /**
     * Test upload fails when file is not an allowed image format.
     */
    public function test_photo_upload_fails_for_invalid_mime_types(): void
    {
        Storage::fake('public');

        $about = About::factory()->create();

        $invalidFile = UploadedFile::fake()->create('documento.pdf', 100, 'application/pdf');

        $response = $this->put(route('about.update', $about), [
            'user_imagem_file' => $invalidFile,
        ]);

        $response->assertSessionHasErrors(['user_imagem_file']);
    }

    /**
     * Test validation failure with invalid data.
     */
    public function test_update_about_validation_fails_with_invalid_data(): void
    {
        $about = About::factory()->create();

        $response = $this->put(route('about.update', $about), [
            'title' => str_repeat('a', 300),
        ]);

        $response->assertSessionHasErrors(['title']);
    }
}
