<div class="px-12 pb-12">
    <div class="rounded-4xl shadow-2xs overflow-hidden">
        <div class="bg-gray-900 py-24 sm:py-32">
            {{-- Badge de instrução --}}
            <div class="px-6 pb-8 flex items-center justify-start">
                <span class="rounded-md bg-indigo-500/20 border border-indigo-500/30 px-3 py-1.5 text-xs font-semibold uppercase tracking-wider text-indigo-300">
                    Bloco Skills • Passe o mouse sobre qualquer texto ou ícone e clique para editar
                </span>
            </div>

            {{-- Grade de Logos / Ícones --}}
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto mt-4 grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-10 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:mx-0 lg:max-w-none lg:grid-cols-5">
                    @foreach ($skills as $skill)
                        @if ($skill->icons)
                            @php
                                $iconUrl = $skill->icons;
                                if ($iconUrl && !str_starts_with($iconUrl, 'http://') && !str_starts_with($iconUrl, 'https://')) {
                                    $iconUrl = asset(ltrim($iconUrl, '/'));
                                }
                            @endphp
                            {{-- Visualização do Ícone --}}
                            <div id="view-skill-icons-{{ $skill->id }}"
                                onclick="enableEdit('skill-icons-{{ $skill->id }}')"
                                title="Clique para editar o ícone"
                                class="group relative col-span-2 flex items-center justify-center cursor-pointer rounded-2xl p-3 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5 lg:col-span-1">
                                <img src="{{ $iconUrl }}"
                                    alt="{{ $skill->title }}"
                                    class="max-h-12 w-full object-contain" />
                                <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 absolute -top-1.5 -right-1.5 inline-flex items-center justify-center size-7 rounded-full bg-indigo-600 text-white shadow-md border-2 border-gray-900"
                                    aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </span>
                            </div>

                            {{-- Formulário de edição do ícone --}}
                            <div id="edit-skill-icons-{{ $skill->id }}" class="hidden col-span-2 lg:col-span-1">
                                <form action="{{ route('skills.update', $skill->id) }}" method="POST" enctype="multipart/form-data"
                                    class="bg-gray-950/90 border-2 border-indigo-500 rounded-2xl p-4 shadow-2xl text-left">
                                    @csrf
                                    @method('PUT')
                                    <p class="text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-3 text-center">Atualizar Ícone</p>

                                    {{-- Upload de arquivo --}}
                                    <label for="input-file-skill-icons-{{ $skill->id }}"
                                        class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-white/20 rounded-xl cursor-pointer bg-white/5 hover:bg-white/10 hover:border-indigo-400 transition group mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-indigo-400 mb-1 group-hover:scale-110 transition-transform">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <p class="text-[11px] text-gray-300 text-center"><span class="font-semibold text-indigo-300">Selecionar</span> ou arrastar</p>
                                        <p class="text-[10px] text-gray-500 text-center">JPG, PNG ou JPEG</p>
                                        <p id="file-name-preview-skill-icons-{{ $skill->id }}" class="text-[10px] text-indigo-400 font-semibold mt-1 hidden text-center"></p>
                                        <input id="input-file-skill-icons-{{ $skill->id }}"
                                            type="file"
                                            name="icons_file"
                                            accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                                            class="hidden"
                                            onchange="previewSelectedFileName(this, 'file-name-preview-skill-icons-{{ $skill->id }}')" />
                                    </label>

                                    {{-- Divisor ou --}}
                                    <div class="relative flex items-center justify-center my-3">
                                        <div class="border-t border-white/10 w-full"></div>
                                        <span class="bg-gray-950 px-2 text-[10px] uppercase tracking-wider text-gray-400 font-medium">ou</span>
                                        <div class="border-t border-white/10 w-full"></div>
                                    </div>

                                    {{-- URL --}}
                                    <input type="url"
                                        name="icons"
                                        value="{{ $skill->icons }}"
                                        class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 text-xs text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition mb-3"
                                        placeholder="https://exemplo.com/icone.png" />

                                    <div class="flex items-center justify-center gap-2">
                                        <button type="submit"
                                            class="rounded-md bg-indigo-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-indigo-400 cursor-pointer transition">
                                            Salvar
                                        </button>
                                        <button type="button"
                                            onclick="cancelEdit('skill-icons-{{ $skill->id }}')"
                                            class="rounded-md bg-white/10 px-3 py-1.5 text-xs font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Seção principal de Skills com texto e detalhes --}}
        <div id="skills" class="bg-gray-900 py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                @foreach ($skills as $skill)
                    <div class="mx-auto max-w-2xl lg:text-center mb-16">
                        <h2 class="text-base/7 font-semibold text-indigo-400">Details skills</h2>

                        {{-- Campo: Título --}}
                        <div>
                            <div id="view-skill-title-{{ $skill->id }}"
                                onclick="enableEdit('skill-title-{{ $skill->id }}')"
                                title="Clique para editar o título"
                                class="group relative inline-flex items-center justify-center w-full cursor-pointer rounded-2xl p-4 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                <p class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-white sm:text-5xl lg:text-balance">
                                    {{ $skill->title }}
                                </p>
                                <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-9 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 ml-4 shadow-lg"
                                    aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </span>
                            </div>

                            <div id="edit-skill-title-{{ $skill->id }}" class="hidden w-full text-center">
                                <form action="{{ route('skills.update', $skill->id) }}" method="POST" class="w-full max-w-2xl mx-auto">
                                    @csrf
                                    @method('PUT')
                                    <label for="input-skill-title-{{ $skill->id }}" class="block text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-2">
                                        Editar Título
                                    </label>
                                    <input id="input-skill-title-{{ $skill->id }}"
                                        type="text"
                                        name="title"
                                        value="{{ $skill->title }}"
                                        required
                                        class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 px-4 py-3 text-center text-3xl font-semibold text-white focus:outline-none focus:ring-4 focus:ring-indigo-500/30 sm:text-4xl"
                                        placeholder="Digite o título..." />
                                    <div class="mt-4 flex items-center justify-center gap-3">
                                        <button type="submit"
                                            class="rounded-md bg-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400 cursor-pointer transition">
                                            Salvar alterações
                                        </button>
                                        <button type="button"
                                            onclick="cancelEdit('skill-title-{{ $skill->id }}')"
                                            class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Campo: Descrição --}}
                        <div>
                            <div id="view-skill-description-{{ $skill->id }}"
                                onclick="enableEdit('skill-description-{{ $skill->id }}')"
                                title="Clique para editar a descrição"
                                class="group relative block w-full cursor-pointer rounded-2xl p-3 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                <div class="flex items-start justify-center gap-3">
                                    <p class="mt-6 text-lg/8 text-gray-300">{{ $skill->description }}</p>
                                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-8 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 mt-7 shadow-lg"
                                        aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div id="edit-skill-description-{{ $skill->id }}" class="hidden w-full text-center">
                                <form action="{{ route('skills.update', $skill->id) }}" method="POST" class="w-full max-w-2xl mx-auto">
                                    @csrf
                                    @method('PUT')
                                    <label for="input-skill-description-{{ $skill->id }}" class="block text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-2">
                                        Editar Descrição
                                    </label>
                                    <textarea id="input-skill-description-{{ $skill->id }}"
                                        name="description"
                                        rows="4"
                                        class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 px-4 py-2.5 text-center text-lg text-white focus:outline-none focus:ring-4 focus:ring-indigo-500/30"
                                        placeholder="Digite a descrição...">{{ $skill->description }}</textarea>
                                    <div class="mt-4 flex items-center justify-center gap-3">
                                        <button type="submit"
                                            class="rounded-md bg-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400 cursor-pointer transition">
                                            Salvar alterações
                                        </button>
                                        <button type="button"
                                            onclick="cancelEdit('skill-description-{{ $skill->id }}')"
                                            class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Cards de Detalhes --}}
                    <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                        <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                            <div class="relative pl-16">
                                <dt class="text-base/7 font-semibold text-white">
                                    <div class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-lg bg-indigo-500">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            data-slot="icon" aria-hidden="true" class="size-6 text-white">
                                            <path d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>

                                    {{-- Campo: title_details --}}
                                    <div id="view-skill-title_details-{{ $skill->id }}"
                                        onclick="enableEdit('skill-title_details-{{ $skill->id }}')"
                                        title="Clique para editar o título do detalhe"
                                        class="group relative inline-flex items-center cursor-pointer rounded-xl px-2 py-1 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                        <span>{{ $skill->title_details }}</span>
                                        <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-7 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 ml-2 shadow-lg"
                                            aria-hidden="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </span>
                                    </div>

                                    <div id="edit-skill-title_details-{{ $skill->id }}" class="hidden w-full">
                                        <form action="{{ route('skills.update', $skill->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="text"
                                                name="title_details"
                                                value="{{ $skill->title_details }}"
                                                class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 px-3 py-2 text-sm font-semibold text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                                                placeholder="Título do detalhe..." />
                                            <div class="mt-2 flex items-center gap-2">
                                                <button type="submit"
                                                    class="rounded-md bg-indigo-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-indigo-400 cursor-pointer transition">
                                                    Salvar
                                                </button>
                                                <button type="button"
                                                    onclick="cancelEdit('skill-title_details-{{ $skill->id }}')"
                                                    class="rounded-md bg-white/10 px-3 py-1.5 text-xs font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </dt>

                                {{-- Campo: details --}}
                                <dd class="mt-2 text-base/7 text-gray-400">
                                    <div id="view-skill-details-{{ $skill->id }}"
                                        onclick="enableEdit('skill-details-{{ $skill->id }}')"
                                        title="Clique para editar o detalhe"
                                        class="group relative inline-flex items-start cursor-pointer rounded-xl px-2 py-1 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                        <span>{{ $skill->details }}</span>
                                        <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-7 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 ml-2 mt-0.5 shadow-lg"
                                            aria-hidden="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </span>
                                    </div>

                                    <div id="edit-skill-details-{{ $skill->id }}" class="hidden w-full">
                                        <form action="{{ route('skills.update', $skill->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <textarea name="details"
                                                rows="3"
                                                class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                                                placeholder="Descrição do detalhe...">{{ $skill->details }}</textarea>
                                            <div class="mt-2 flex items-center gap-2">
                                                <button type="submit"
                                                    class="rounded-md bg-indigo-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-indigo-400 cursor-pointer transition">
                                                    Salvar
                                                </button>
                                                <button type="button"
                                                    onclick="cancelEdit('skill-details-{{ $skill->id }}')"
                                                    class="rounded-md bg-white/10 px-3 py-1.5 text-xs font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </dd>
                            </div>
                        </dl>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    // Pressionar ESC para fechar campos de skills
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('[id^="edit-skill-"]').forEach(function(el) {
                if (!el.classList.contains('hidden')) {
                    const id = el.id.replace('edit-', '');
                    cancelEdit(id);
                }
            });
        }
    });
</script>
