@php
    $abouts = $about instanceof \Illuminate\Support\Collection ? ($about->first() ?? new \App\Models\About()) : $about;
@endphp

<div class="p-12">
    <div class="border-blue-500">
        <div class="bg-indigo-950 rounded-4xl shadow-2xs overflow-hidden">
            <div class="place-content-center justify-center items-center">
                <div class="p-5 flex items-center justify-between">
                    <span class="rounded-md bg-indigo-500/20 border border-indigo-500/30 px-3 py-1.5 text-xs font-semibold uppercase tracking-wider text-indigo-300">
                        Bloco About • Passe o mouse sobre qualquer texto ou foto e clique para editar
                    </span>
                </div>
            </div>

            @if ($abouts)
                {{-- Hero Topo do Bloco About --}}
                <div class="relative isolate px-6 pt-14 lg:px-8">
                    <div aria-hidden="true"
                        class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                        <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
                            class="relative left-[calc(50%-11rem)] aspect-1155/678 w-144.5 -translate-x-1/2 rotate-30 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-288.75">
                        </div>
                    </div>

                    <div class="mx-auto max-w-3xl py-24 sm:py-32 lg:py-40">
                        <div class="text-center space-y-8">
                            {{-- Campo: Título Principal --}}
                            <div>
                                {{-- Visualização (com contorno e ícone no hover) --}}
                                <div id="view-about-title-{{ $abouts->id }}"
                                    onclick="enableEdit('about-title-{{ $abouts->id }}')"
                                    title="Clique para editar o título"
                                    class="group relative inline-flex items-center justify-center w-full cursor-pointer rounded-2xl p-4 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                    <h1 class="text-5xl font-semibold tracking-tight text-balance text-white sm:text-7xl">
                                        {{ $abouts->title }}
                                    </h1>
                                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-9 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 ml-4 shadow-lg"
                                        aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </span>
                                </div>

                                {{-- Formulário de Edição Inline --}}
                                <div id="edit-about-title-{{ $abouts->id }}" class="hidden w-full text-center">
                                    <form action="{{ route('about.update', $abouts->id) }}" method="POST" class="w-full max-w-2xl mx-auto">
                                        @csrf
                                        @method('PUT')
                                        <label for="input-about-title-{{ $abouts->id }}" class="block text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-2">
                                            Editar Título Principal
                                        </label>
                                        <input id="input-about-title-{{ $abouts->id }}"
                                            type="text"
                                            name="title"
                                            value="{{ $abouts->title }}"
                                            required
                                            class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 px-4 py-3 text-center text-3xl font-semibold text-white focus:outline-none focus:ring-4 focus:ring-indigo-500/30 sm:text-5xl"
                                            placeholder="Digite o título principal..." />
                                        <div class="mt-4 flex items-center justify-center gap-3">
                                            <button type="submit"
                                                class="rounded-md bg-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 cursor-pointer transition">
                                                Salvar alterações
                                            </button>
                                            <button type="button"
                                                onclick="cancelEdit('about-title-{{ $abouts->id }}')"
                                                class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                                Cancelar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Campo: Subtítulo --}}
                            <div>
                                {{-- Visualização (com contorno e ícone no hover) --}}
                                <div id="view-about-subtitle-{{ $abouts->id }}"
                                    onclick="enableEdit('about-subtitle-{{ $abouts->id }}')"
                                    title="Clique para editar o subtítulo"
                                    class="group relative inline-flex items-center justify-center w-full cursor-pointer rounded-2xl p-3 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                    <p class="text-lg font-medium text-pretty text-gray-400 sm:text-xl/8">
                                        {{ $abouts->subtitle }}
                                    </p>
                                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-8 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 ml-3 shadow-lg"
                                        aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </span>
                                </div>

                                {{-- Formulário de Edição Inline --}}
                                <div id="edit-about-subtitle-{{ $abouts->id }}" class="hidden w-full text-center">
                                    <form action="{{ route('about.update', $abouts->id) }}" method="POST" class="w-full max-w-2xl mx-auto">
                                        @csrf
                                        @method('PUT')
                                        <label for="input-about-subtitle-{{ $abouts->id }}" class="block text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-2">
                                            Editar Subtítulo
                                        </label>
                                        <textarea id="input-about-subtitle-{{ $abouts->id }}"
                                            name="subtitle"
                                            rows="3"
                                            class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 px-4 py-2.5 text-center text-lg text-white focus:outline-none focus:ring-4 focus:ring-indigo-500/30 sm:text-xl"
                                            placeholder="Digite o subtítulo...">{{ $abouts->subtitle }}</textarea>
                                        <div class="mt-4 flex items-center justify-center gap-3">
                                            <button type="submit"
                                                class="rounded-md bg-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 cursor-pointer transition">
                                                Salvar alterações
                                            </button>
                                            <button type="button"
                                                onclick="cancelEdit('about-subtitle-{{ $abouts->id }}')"
                                                class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                                Cancelar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div aria-hidden="true"
                        class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
                        <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
                            class="relative left-[calc(50%+3rem)] aspect-1155/678 w-144.5 -translate-x-1/2 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-288.75">
                        </div>
                    </div>
                </div>

                {{-- Seção de Biografia / Descrição --}}
                <section id="about" class="relative isolate overflow-hidden bg-gray-900 px-6 py-24 sm:py-32 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:max-w-4xl">
                        <figure class="mt-10">
                            {{-- Campo: Descrição --}}
                            <blockquote class="text-center text-xl/8 font-semibold text-white sm:text-2xl/9">
                                {{-- Visualização (com contorno e ícone no hover) --}}
                                <div id="view-about-description-{{ $abouts->id }}"
                                    onclick="enableEdit('about-description-{{ $abouts->id }}')"
                                    title="Clique para editar a descrição"
                                    class="group relative block w-full cursor-pointer rounded-2xl p-4 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                    <div class="flex items-start justify-center gap-3">
                                        <p>
                                            {{ $abouts->description }}
                                        </p>
                                        <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-9 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 mt-1 shadow-lg"
                                            aria-hidden="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                {{-- Formulário de Edição Inline --}}
                                <div id="edit-about-description-{{ $abouts->id }}" class="hidden w-full text-center">
                                    <form action="{{ route('about.update', $abouts->id) }}" method="POST" class="w-full">
                                        @csrf
                                        @method('PUT')
                                        <label for="input-about-description-{{ $abouts->id }}" class="block text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-2">
                                            Editar Descrição / Bio
                                        </label>
                                        <textarea id="input-about-description-{{ $abouts->id }}"
                                            name="description"
                                            rows="5"
                                            class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 p-4 text-center text-lg text-white focus:outline-none focus:ring-4 focus:ring-indigo-500/30 sm:text-xl"
                                            placeholder="Digite a descrição/biografia...">{{ $abouts->description }}</textarea>
                                        <div class="mt-4 flex items-center justify-center gap-3">
                                            <button type="submit"
                                                class="rounded-md bg-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 cursor-pointer transition">
                                                Salvar alterações
                                            </button>
                                            <button type="button"
                                                onclick="cancelEdit('about-description-{{ $abouts->id }}')"
                                                class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                                Cancelar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </blockquote>

                            {{-- Subseção da Foto e Identificação (Centralizada) --}}
                            <figcaption class="mt-10 flex flex-col items-center justify-center text-center">
                                <div class="w-full flex flex-col items-center justify-center text-center">
                                    {{-- Visualização da Foto --}}
                                    <div id="view-about-photo-{{ $abouts->id }}"
                                        onclick="enableEdit('about-photo-{{ $abouts->id }}')"
                                        title="Clique para editar a foto de perfil"
                                        class="group relative inline-flex flex-col items-center justify-center cursor-pointer rounded-2xl p-4 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                        <div class="relative inline-block">
                                            @php
                                                $photoUrl = $abouts->user_imagem;
                                                if ($photoUrl && !str_starts_with($photoUrl, 'http://') && !str_starts_with($photoUrl, 'https://')) {
                                                    $photoUrl = asset(ltrim($photoUrl, '/'));
                                                }
                                            @endphp
                                            <img src="{{ $photoUrl ?: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                                alt="{{ $abouts->title }}"
                                                class="mx-auto size-24 rounded-full object-cover shadow-xl border-2 border-indigo-500/40" />
                                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 absolute -bottom-1 -right-1 inline-flex items-center justify-center size-8 rounded-full bg-indigo-600 text-white shadow-md border-2 border-gray-900"
                                                aria-hidden="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="mt-4 flex items-center justify-center space-x-3 text-base">
                                            <div class="font-semibold text-indigo-400">{{ $abouts->title }}</div>
                                        </div>
                                    </div>

                                    {{-- Formulário de Edição da Foto (Upload de JPEG/PNG/JPG ou URL) --}}
                                    <div id="edit-about-photo-{{ $abouts->id }}" class="hidden w-full max-w-lg mx-auto text-center mt-4">
                                        <form action="{{ route('about.update', $abouts->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-950/90 border-2 border-indigo-500 rounded-2xl p-6 shadow-2xl text-left">
                                            @csrf
                                            @method('PUT')

                                            <h3 class="text-sm font-semibold uppercase tracking-wider text-indigo-400 mb-4 text-center">
                                                Atualizar Foto de Perfil
                                            </h3>

                                            {{-- Opção 1: Upload de Arquivo (jpeg, png, jpg) --}}
                                            <div class="mb-5">
                                                <label for="input-file-about-photo-{{ $abouts->id }}" class="block text-xs font-medium text-gray-300 mb-1.5">
                                                    Enviar arquivo de imagem (JPEG, PNG, JPG)
                                                </label>
                                                <div class="relative flex items-center justify-center w-full">
                                                    <label for="input-file-about-photo-{{ $abouts->id }}"
                                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-white/20 rounded-xl cursor-pointer bg-white/5 hover:bg-white/10 hover:border-indigo-400 transition group">
                                                        <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4 text-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-indigo-400 mb-2 group-hover:scale-110 transition-transform">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                            </svg>
                                                            <p class="text-xs text-gray-300 mb-1">
                                                                <span class="font-semibold text-indigo-300">Clique para selecionar</span> ou arraste o arquivo
                                                            </p>
                                                            <p class="text-[11px] text-gray-400">Formatos aceitos: JPG, JPEG ou PNG (máx. 5MB)</p>
                                                            <p id="file-name-preview-{{ $abouts->id }}" class="text-xs text-indigo-400 font-semibold mt-1 hidden"></p>
                                                        </div>
                                                        <input id="input-file-about-photo-{{ $abouts->id }}"
                                                            type="file"
                                                            name="user_imagem_file"
                                                            accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                                                            class="hidden"
                                                            onchange="previewSelectedFileName(this, 'file-name-preview-{{ $abouts->id }}')" />
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="relative flex items-center justify-center my-4">
                                                <div class="border-t border-white/10 w-full"></div>
                                                <span class="bg-gray-950 px-3 text-[11px] uppercase tracking-wider text-gray-400 font-medium">ou</span>
                                                <div class="border-t border-white/10 w-full"></div>
                                            </div>

                                            {{-- Opção 2: Inserir URL direta da imagem --}}
                                            <div class="mb-6">
                                                <label for="input-url-about-photo-{{ $abouts->id }}" class="block text-xs font-medium text-gray-300 mb-1.5">
                                                    Vincular URL externa da imagem
                                                </label>
                                                <input id="input-url-about-photo-{{ $abouts->id }}"
                                                    type="url"
                                                    name="user_imagem"
                                                    value="{{ $abouts->user_imagem }}"
                                                    class="w-full rounded-xl bg-white/5 border border-white/10 px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition"
                                                    placeholder="https://exemplo.com/sua-foto.jpg" />
                                            </div>

                                            {{-- Botões de Ação --}}
                                            <div class="flex items-center justify-center gap-3 pt-2">
                                                <button type="submit"
                                                    class="rounded-md bg-indigo-500 px-5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 cursor-pointer transition">
                                                    Salvar foto
                                                </button>
                                                <button type="button"
                                                    onclick="cancelEdit('about-photo-{{ $abouts->id }}')"
                                                    class="rounded-md bg-white/10 px-4 py-2.5 text-sm font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </section>
            @endif
        </div>
    </div>
</div>

{{-- Script nativo para alternância entre modo de visualização e modo de edição inline --}}
<script>
    function enableEdit(id) {
        const viewElement = document.getElementById('view-' + id);
        const editElement = document.getElementById('edit-' + id);

        if (viewElement && editElement) {
            viewElement.classList.add('hidden');
            editElement.classList.remove('hidden');

            const inputField = editElement.querySelector('input, textarea');
            if (inputField) {
                inputField.focus();
                if (typeof inputField.setSelectionRange === 'function' && inputField.type !== 'url' && inputField.type !== 'file') {
                    const length = inputField.value.length;
                    inputField.setSelectionRange(length, length);
                }
            }
        }
    }

    function cancelEdit(id) {
        const viewElement = document.getElementById('view-' + id);
        const editElement = document.getElementById('edit-' + id);

        if (viewElement && editElement) {
            editElement.classList.add('hidden');
            viewElement.classList.remove('hidden');
        }
    }

    function previewSelectedFileName(input, targetId) {
        const previewElement = document.getElementById(targetId);
        if (previewElement && input.files && input.files[0]) {
            previewElement.textContent = 'Arquivo selecionado: ' + input.files[0].name;
            previewElement.classList.remove('hidden');
        }
    }

    // Permite pressionar ESC para fechar qualquer campo aberto em edição
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('[id^="edit-about-"]').forEach(function(editElement) {
                if (!editElement.classList.contains('hidden')) {
                    const id = editElement.id.replace('edit-', '');
                    cancelEdit(id);
                }
            });
        }
    });
</script>
