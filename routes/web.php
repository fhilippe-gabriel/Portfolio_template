<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/edit', [PortfolioController::class, 'edit'])->name('private.edit');

Route::put('/about/{about}', [PortfolioController::class, 'updateAbout'])->name('about.update');
Route::put('/skills/{skill}', [PortfolioController::class, 'updateSkill'])->name('skills.update');
Route::put('/projects/{project}', [PortfolioController::class, 'updateProject'])->name('projects.update');
Route::put('/contact/{contact}', [PortfolioController::class, 'updateContact'])->name('contact.update');
Route::post('/skill-logos', [PortfolioController::class, 'storeSkillLogo'])->name('skill-logos.store');
Route::delete('/skill-logos/{skillLogo}', [PortfolioController::class, 'destroySkillLogo'])->name('skill-logos.destroy');

Route::get('/p', function () {
    return view('private.partials.panel');
})->name('edit');
