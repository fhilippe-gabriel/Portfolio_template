<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\Projects;
use App\Models\Skills;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdatePortfolioTest extends TestCase
{
    use RefreshDatabase;

    // ─────────────────────────────────────────────
    //  Skills
    // ─────────────────────────────────────────────

    /**
     * Test updating the skill title successfully.
     */
    public function test_can_update_skill_title(): void
    {
        $skill = Skills::factory()->create(['title' => 'Título Original']);

        $response = $this->put(route('skills.update', $skill), [
            'title' => 'Título Atualizado',
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('skills', [
            'id' => $skill->id,
            'title' => 'Título Atualizado',
        ]);
    }

    /**
     * Test updating the skill description successfully.
     */
    public function test_can_update_skill_description(): void
    {
        $skill = Skills::factory()->create(['description' => 'Descrição original da skill.']);

        $response = $this->put(route('skills.update', $skill), [
            'description' => 'Descrição atualizada da skill.',
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('skills', [
            'id' => $skill->id,
            'description' => 'Descrição atualizada da skill.',
        ]);
    }

    /**
     * Test updating the skill title_details successfully.
     */
    public function test_can_update_skill_title_details(): void
    {
        $skill = Skills::factory()->create(['title_details' => 'Detalhe Original']);

        $response = $this->put(route('skills.update', $skill), [
            'title_details' => 'Detalhe Atualizado',
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('skills', [
            'id' => $skill->id,
            'title_details' => 'Detalhe Atualizado',
        ]);
    }

    /**
     * Test uploading a skill icon file successfully.
     */
    public function test_can_upload_skill_icon_file_successfully(): void
    {
        Storage::fake('public');

        $skill = Skills::factory()->create(['icons' => 'https://exemplo.com/icone-antigo.png']);

        // 1x1 pixel JPEG válido
        $jpegBinary = hex2bin('ffd8ffe000104a46494600010101006000600000ffdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffc0000b080001000101011100ffda0008010100003f00bf80ffc9');
        $file = UploadedFile::fake()->createWithContent('icone.jpg', $jpegBinary);

        $response = $this->put(route('skills.update', $skill), [
            'icons_file' => $file,
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');

        $skill->refresh();
        $this->assertStringContainsString('/storage/skills/', $skill->icons);

        $storedPath = str_replace('/storage/', '', $skill->icons);
        Storage::disk('public')->assertExists($storedPath);
    }

    /**
     * Test that skill icon upload fails for invalid MIME types.
     */
    public function test_skill_icon_upload_fails_for_invalid_mime_types(): void
    {
        Storage::fake('public');

        $skill = Skills::factory()->create();
        $invalidFile = UploadedFile::fake()->create('documento.pdf', 100, 'application/pdf');

        $response = $this->put(route('skills.update', $skill), [
            'icons_file' => $invalidFile,
        ]);

        $response->assertSessionHasErrors(['icons_file']);
    }

    // ─────────────────────────────────────────────
    //  Projects
    // ─────────────────────────────────────────────

    /**
     * Test updating a project title successfully.
     */
    public function test_can_update_project_title(): void
    {
        $project = Projects::factory()->create(['title' => 'Projeto Original']);

        $response = $this->put(route('projects.update', $project), [
            'title' => 'Projeto Atualizado',
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => 'Projeto Atualizado',
        ]);
    }

    /**
     * Test updating a project description successfully.
     */
    public function test_can_update_project_description(): void
    {
        $project = Projects::factory()->create(['description' => 'Descrição original do projeto.']);

        $response = $this->put(route('projects.update', $project), [
            'description' => 'Descrição atualizada do projeto.',
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'description' => 'Descrição atualizada do projeto.',
        ]);
    }

    /**
     * Test updating a project link successfully.
     */
    public function test_can_update_project_link(): void
    {
        $project = Projects::factory()->create(['link' => null]);

        $response = $this->put(route('projects.update', $project), [
            'link' => 'https://meu-projeto.com',
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'link' => 'https://meu-projeto.com',
        ]);
    }

    /**
     * Test uploading a project image file successfully.
     */
    public function test_can_upload_project_image_file_successfully(): void
    {
        Storage::fake('public');

        $project = Projects::factory()->create(['imagem' => 'https://exemplo.com/imagem-antiga.jpg']);

        // 1x1 pixel JPEG válido
        $jpegBinary = hex2bin('ffd8ffe000104a46494600010101006000600000ffdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffc0000b080001000101011100ffda0008010100003f00bf80ffc9');
        $file = UploadedFile::fake()->createWithContent('projeto.jpg', $jpegBinary);

        $response = $this->put(route('projects.update', $project), [
            'imagem_file' => $file,
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');

        $project->refresh();
        $this->assertStringContainsString('/storage/projects/', $project->imagem);

        $storedPath = str_replace('/storage/', '', $project->imagem);
        Storage::disk('public')->assertExists($storedPath);
    }

    /**
     * Test that project image upload fails for invalid MIME types.
     */
    public function test_project_image_upload_fails_for_invalid_mime_types(): void
    {
        Storage::fake('public');

        $project = Projects::factory()->create();
        $invalidFile = UploadedFile::fake()->create('arquivo.pdf', 100, 'application/pdf');

        $response = $this->put(route('projects.update', $project), [
            'imagem_file' => $invalidFile,
        ]);

        $response->assertSessionHasErrors(['imagem_file']);
    }

    // ─────────────────────────────────────────────
    //  Contact
    // ─────────────────────────────────────────────

    /**
     * Test updating the contact name successfully.
     */
    public function test_can_update_contact_name(): void
    {
        $contact = Contact::factory()->create(['name_contact' => 'Nome Original']);

        $response = $this->put(route('contact.update', $contact), [
            'name_contact' => 'Nome Atualizado',
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'name_contact' => 'Nome Atualizado',
        ]);
    }

    /**
     * Test updating the contact email successfully.
     */
    public function test_can_update_contact_email(): void
    {
        $contact = Contact::factory()->create(['email_contact' => 'antigo@exemplo.com']);

        $response = $this->put(route('contact.update', $contact), [
            'email_contact' => 'novo@exemplo.com',
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'email_contact' => 'novo@exemplo.com',
        ]);
    }

    /**
     * Test updating the contact social link successfully.
     */
    public function test_can_update_contact_social(): void
    {
        $contact = Contact::factory()->create(['social_contact' => null]);

        $response = $this->put(route('contact.update', $contact), [
            'social_contact' => 'https://linkedin.com/in/usuario',
        ]);

        $response->assertRedirect(route('private.edit'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'social_contact' => 'https://linkedin.com/in/usuario',
        ]);
    }

    /**
     * Test that contact email validation fails with invalid email format.
     */
    public function test_contact_email_validation_fails_with_invalid_format(): void
    {
        $contact = Contact::factory()->create();

        $response = $this->put(route('contact.update', $contact), [
            'email_contact' => 'nao-e-um-email-valido',
        ]);

        $response->assertSessionHasErrors(['email_contact']);
    }
}
