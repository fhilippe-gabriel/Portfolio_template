{{-- Adicionamos o id="projects" --}}
<div class="px-12 pb-12">
    <div class="rounded-4xl shadow-2xs overflow-hidden">
        <div id="projects" class="bg-gray-900">
            {{-- Badge de instrução --}}
            <div class="px-6 pt-8 pb-4 flex items-center justify-start">
                <span class="rounded-md bg-indigo-500/20 border border-indigo-500/30 px-3 py-1.5 text-xs font-semibold uppercase tracking-wider text-indigo-300">
                    Bloco Projects • Passe o mouse sobre qualquer campo e clique para editar
                </span>
            </div>

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl py-8 sm:py-12 lg:max-w-none lg:py-16">
                    <h2 class="text-2xl font-bold text-indigo-400">Projects</h2>
                    <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:space-y-0 lg:gap-x-6">
                        @foreach ($projects as $project)
                            <div class="group relative">
                                {{-- Campo: Imagem do Projeto --}}
                                <div>
                                    <div id="view-project-imagem-{{ $project->id }}"
                                        onclick="enableEdit('project-imagem-{{ $project->id }}')"
                                        title="Clique para editar a imagem"
                                        class="group/img relative cursor-pointer rounded-2xl overflow-hidden transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:ring-offset-2 hover:ring-offset-gray-900">
                                        @php
                                            $projectImgUrl = $project->imagem;
                                            if ($projectImgUrl && !str_starts_with($projectImgUrl, 'http://') && !str_starts_with($projectImgUrl, 'https://')) {
                                                $projectImgUrl = asset(ltrim($projectImgUrl, '/'));
                                            }
                                        @endphp
                                        <img src="{{ $projectImgUrl }}"
                                            alt="{{ $project->title }}"
                                            class="w-full rounded-lg bg-white object-cover max-sm:h-80 sm:aspect-2/1 lg:aspect-square" />
                                        <span class="opacity-0 group-hover/img:opacity-100 transition-opacity duration-200 absolute top-2 right-2 inline-flex items-center justify-center size-8 rounded-full bg-indigo-600 text-white shadow-md border-2 border-gray-900"
                                            aria-hidden="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </span>
                                    </div>

                                    <div id="edit-project-imagem-{{ $project->id }}" class="hidden mt-2">
                                        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data"
                                            class="bg-gray-950/90 border-2 border-indigo-500 rounded-2xl p-5 shadow-2xl text-left">
                                            @csrf
                                            @method('PUT')
                                            <p class="text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-3 text-center">Atualizar Imagem do Projeto</p>

                                            {{-- Upload de arquivo --}}
                                            <label for="input-file-project-imagem-{{ $project->id }}"
                                                class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-white/20 rounded-xl cursor-pointer bg-white/5 hover:bg-white/10 hover:border-indigo-400 transition group/upload mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-indigo-400 mb-1 group-hover/upload:scale-110 transition-transform">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                                <p class="text-xs text-gray-300 text-center"><span class="font-semibold text-indigo-300">Selecionar</span> ou arrastar arquivo</p>
                                                <p class="text-[11px] text-gray-500 text-center">JPG, JPEG ou PNG (máx. 5MB)</p>
                                                <p id="file-name-preview-project-imagem-{{ $project->id }}" class="text-[11px] text-indigo-400 font-semibold mt-1 hidden text-center"></p>
                                                <input id="input-file-project-imagem-{{ $project->id }}"
                                                    type="file"
                                                    name="imagem_file"
                                                    accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                                                    class="hidden"
                                                    onchange="previewSelectedFileName(this, 'file-name-preview-project-imagem-{{ $project->id }}')" />
                                            </label>

                                            {{-- Divisor ou --}}
                                            <div class="relative flex items-center justify-center my-3">
                                                <div class="border-t border-white/10 w-full"></div>
                                                <span class="bg-gray-950 px-3 text-[11px] uppercase tracking-wider text-gray-400 font-medium">ou</span>
                                                <div class="border-t border-white/10 w-full"></div>
                                            </div>

                                            {{-- URL --}}
                                            <input type="url"
                                                name="imagem"
                                                value="{{ $project->imagem }}"
                                                class="w-full rounded-xl bg-white/5 border border-white/10 px-3 py-2 text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition mb-4"
                                                placeholder="https://exemplo.com/imagem.jpg" />

                                            <div class="flex items-center justify-center gap-3">
                                                <button type="submit"
                                                    class="rounded-md bg-indigo-500 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-400 cursor-pointer transition">
                                                    Salvar imagem
                                                </button>
                                                <button type="button"
                                                    onclick="cancelEdit('project-imagem-{{ $project->id }}')"
                                                    class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- Campo: Título do Projeto --}}
                                <div class="mt-4">
                                    <div id="view-project-title-{{ $project->id }}"
                                        onclick="enableEdit('project-title-{{ $project->id }}')"
                                        title="Clique para editar o título"
                                        class="group/title relative inline-flex items-center w-full cursor-pointer rounded-xl p-2 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                        <h3 class="text-sm text-gray-300">{{ $project->title }}</h3>
                                        <span class="opacity-0 group-hover/title:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-7 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 ml-2 shadow-lg"
                                            aria-hidden="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </span>
                                    </div>

                                    <div id="edit-project-title-{{ $project->id }}" class="hidden w-full">
                                        <form action="{{ route('projects.update', $project->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <label for="input-project-title-{{ $project->id }}" class="block text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-1.5">
                                                Editar Título
                                            </label>
                                            <input id="input-project-title-{{ $project->id }}"
                                                type="text"
                                                name="title"
                                                value="{{ $project->title }}"
                                                required
                                                class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                                                placeholder="Título do projeto..." />
                                            <div class="mt-2 flex items-center gap-2">
                                                <button type="submit"
                                                    class="rounded-md bg-indigo-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-indigo-400 cursor-pointer transition">
                                                    Salvar
                                                </button>
                                                <button type="button"
                                                    onclick="cancelEdit('project-title-{{ $project->id }}')"
                                                    class="rounded-md bg-white/10 px-3 py-1.5 text-xs font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- Campo: Descrição do Projeto --}}
                                <div class="mt-2">
                                    <div id="view-project-description-{{ $project->id }}"
                                        onclick="enableEdit('project-description-{{ $project->id }}')"
                                        title="Clique para editar a descrição"
                                        class="group/desc relative inline-flex items-start w-full cursor-pointer rounded-xl p-2 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                        <p class="text-base font-semibold text-gray-100">{{ $project->description }}</p>
                                        <span class="opacity-0 group-hover/desc:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-7 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 ml-2 mt-0.5 shadow-lg"
                                            aria-hidden="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </span>
                                    </div>

                                    <div id="edit-project-description-{{ $project->id }}" class="hidden w-full">
                                        <form action="{{ route('projects.update', $project->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <label for="input-project-description-{{ $project->id }}" class="block text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-1.5">
                                                Editar Descrição
                                            </label>
                                            <textarea id="input-project-description-{{ $project->id }}"
                                                name="description"
                                                rows="3"
                                                class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                                                placeholder="Descrição do projeto...">{{ $project->description }}</textarea>
                                            <div class="mt-2 flex items-center gap-2">
                                                <button type="submit"
                                                    class="rounded-md bg-indigo-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-indigo-400 cursor-pointer transition">
                                                    Salvar
                                                </button>
                                                <button type="button"
                                                    onclick="cancelEdit('project-description-{{ $project->id }}')"
                                                    class="rounded-md bg-white/10 px-3 py-1.5 text-xs font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- Campo: Link do Projeto --}}
                                <div class="mt-2">
                                    <div id="view-project-link-{{ $project->id }}"
                                        onclick="enableEdit('project-link-{{ $project->id }}')"
                                        title="Clique para editar o link"
                                        class="group/link relative inline-flex items-center w-full cursor-pointer rounded-xl p-2 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                        @if ($project->link)
                                            <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer"
                                                class="text-xs text-indigo-400 underline truncate"
                                                onclick="event.stopPropagation()">{{ $project->link }}</a>
                                        @else
                                            <span class="text-xs text-gray-500 italic">Sem link — clique para adicionar</span>
                                        @endif
                                        <span class="opacity-0 group-hover/link:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-7 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 ml-2 shadow-lg"
                                            aria-hidden="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </span>
                                    </div>

                                    <div id="edit-project-link-{{ $project->id }}" class="hidden w-full">
                                        <form action="{{ route('projects.update', $project->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <label for="input-project-link-{{ $project->id }}" class="block text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-1.5">
                                                Link do Projeto (URL)
                                            </label>
                                            <input id="input-project-link-{{ $project->id }}"
                                                type="url"
                                                name="link"
                                                value="{{ $project->link }}"
                                                class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                                                placeholder="https://meu-projeto.com" />
                                            <div class="mt-2 flex items-center gap-2">
                                                <button type="submit"
                                                    class="rounded-md bg-indigo-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-indigo-400 cursor-pointer transition">
                                                    Salvar
                                                </button>
                                                <button type="button"
                                                    onclick="cancelEdit('project-link-{{ $project->id }}')"
                                                    class="rounded-md bg-white/10 px-3 py-1.5 text-xs font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Pressionar ESC para fechar campos de projects
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('[id^="edit-project-"]').forEach(function(el) {
                if (!el.classList.contains('hidden')) {
                    const id = el.id.replace('edit-', '');
                    cancelEdit(id);
                }
            });
        }
    });
</script>
