<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillLogoRequest;
use App\Http\Requests\UpdateAboutRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\About;
use App\Models\Contact;
use App\Models\Projects;
use App\Models\SkillLogo;
use App\Models\Skills;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $abouts = About::all();
        $skills = Skills::all();
        $projects = Projects::all();
        $contact = Contact::all();
        $skillLogos = SkillLogo::orderBy('order')->orderBy('id')->get();

        return view('public.layout', [
            'about' => $abouts,
            'abouts' => $abouts,
            'skills' => $skills,
            'projects' => $projects,
            'contact' => $contact,
            'skillLogos' => $skillLogos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        $about = About::all();
        $skills = Skills::all();
        $projects = Projects::all();
        $contact = Contact::all();
        $skillLogos = SkillLogo::orderBy('order')->orderBy('id')->get();

        return view('private.edit', [
            'about' => $about,
            'skills' => $skills,
            'projects' => $projects,
            'contact' => $contact,
            'skillLogos' => $skillLogos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Update the specified about resource in storage.
     */
    public function updateAbout(UpdateAboutRequest $request, About $about): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('user_imagem_file')) {
            if ($about->user_imagem && str_starts_with($about->user_imagem, '/storage/abouts/')) {
                $oldPath = str_replace('/storage/', '', $about->user_imagem);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('user_imagem_file')->store('abouts', 'public');
            $data['user_imagem'] = Storage::url($path);
            unset($data['user_imagem_file']);
        }

        $about->update($data);

        return redirect()->route('private.edit')->with('success', 'Informações de Sobre mim atualizadas com sucesso!');
    }

    /**
     * Update the specified skill resource in storage.
     */
    public function updateSkill(UpdateSkillRequest $request, Skills $skill): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('icons_file')) {
            if ($skill->icons && str_starts_with($skill->icons, '/storage/skills/')) {
                $oldPath = str_replace('/storage/', '', $skill->icons);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('icons_file')->store('skills', 'public');
            $data['icons'] = Storage::url($path);
            unset($data['icons_file']);
        }

        $skill->update($data);

        return redirect()->route('private.edit')->with('success', 'Habilidade atualizada com sucesso!');
    }

    /**
     * Update the specified project resource in storage.
     */
    public function updateProject(UpdateProjectRequest $request, Projects $project): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('imagem_file')) {
            if ($project->imagem && str_starts_with($project->imagem, '/storage/projects/')) {
                $oldPath = str_replace('/storage/', '', $project->imagem);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('imagem_file')->store('projects', 'public');
            $data['imagem'] = Storage::url($path);
            unset($data['imagem_file']);
        }

        $project->update($data);

        return redirect()->route('private.edit')->with('success', 'Projeto atualizado com sucesso!');
    }

    /**
     * Update the specified contact resource in storage.
     */
    public function updateContact(UpdateContactRequest $request, Contact $contact): RedirectResponse
    {
        $contact->update($request->validated());

        return redirect()->route('private.edit')->with('success', 'Informações de contato atualizadas com sucesso!');
    }

    /**
     * Store a new skill logo in storage.
     */
    public function storeSkillLogo(StoreSkillLogoRequest $request): RedirectResponse
    {
        $imageUrl = $request->input('image_url');

        if ($request->hasFile('logo_file')) {
            $path = $request->file('logo_file')->store('skill-logos', 'public');
            $imageUrl = Storage::url($path);
        }

        if (! $imageUrl) {
            return redirect()->route('private.edit')->withErrors(['image_url' => 'Envie um arquivo ou informe uma URL de imagem.']);
        }

        SkillLogo::create([
            'image_url' => $imageUrl,
            'alt' => $request->input('alt') ?: 'Tech logo',
            'order' => SkillLogo::max('order') + 1,
        ]);

        return redirect()->route('private.edit')->with('success', 'Logo adicionada ao carrossel com sucesso!');
    }

    /**
     * Remove a skill logo from storage.
     */
    public function destroySkillLogo(SkillLogo $skillLogo): RedirectResponse
    {
        if (str_starts_with($skillLogo->image_url, '/storage/skill-logos/')) {
            $oldPath = str_replace('/storage/', '', $skillLogo->image_url);
            Storage::disk('public')->delete($oldPath);
        }

        $skillLogo->delete();

        return redirect()->route('private.edit')->with('success', 'Logo removida com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }
}
