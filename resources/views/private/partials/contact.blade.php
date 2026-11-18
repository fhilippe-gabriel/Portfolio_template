{{-- Adicionamos o id="contact" --}}
@php
    $contacts = $contact instanceof \Illuminate\Support\Collection ? ($contact->first() ?? null) : $contact;
@endphp

<div class="px-12 pb-12">
    <div class="rounded-4xl shadow-2xs overflow-hidden">
        <div id="contact" class="bg-gray-900">
            {{-- Badge de instrução --}}
            <div class="px-6 pt-8 pb-4 flex items-center justify-start">
                <span class="rounded-md bg-indigo-500/20 border border-indigo-500/30 px-3 py-1.5 text-xs font-semibold uppercase tracking-wider text-indigo-300">
                    Bloco Contact • Passe o mouse sobre qualquer campo e clique para editar
                </span>
            </div>

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="px-4 sm:px-0">
                    <h3 class="text-base/7 font-semibold text-white pt-2">Contact</h3>
                    <p class="mt-1 max-w-2xl text-sm/6 text-gray-400">Media Sociais e Contato</p>
                </div>

                @if ($contacts)
                    <div class="mt-6 border-t border-white/10 mb-10">
                        <dl class="divide-y divide-white/10">

                            {{-- Campo: name_contact --}}
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm/6 font-medium text-gray-100">Nome completo</dt>
                                <dd class="mt-1 text-sm/6 text-gray-400 sm:col-span-2 sm:mt-0">
                                    <div id="view-contact-name_contact-{{ $contacts->id }}"
                                        onclick="enableEdit('contact-name_contact-{{ $contacts->id }}')"
                                        title="Clique para editar o nome"
                                        class="group relative inline-flex items-center w-full cursor-pointer rounded-xl px-2 py-1 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                        <span>{{ $contacts->name_contact }}</span>
                                        <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-7 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 ml-2 shadow-lg"
                                            aria-hidden="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </span>
                                    </div>

                                    <div id="edit-contact-name_contact-{{ $contacts->id }}" class="hidden w-full max-w-sm">
                                        <form action="{{ route('contact.update', $contacts->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <label for="input-contact-name-{{ $contacts->id }}" class="block text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-1.5">
                                                Editar Nome
                                            </label>
                                            <input id="input-contact-name-{{ $contacts->id }}"
                                                type="text"
                                                name="name_contact"
                                                value="{{ $contacts->name_contact }}"
                                                required
                                                class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                                                placeholder="Nome completo..." />
                                            <div class="mt-2 flex items-center gap-2">
                                                <button type="submit"
                                                    class="rounded-md bg-indigo-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-indigo-400 cursor-pointer transition">
                                                    Salvar
                                                </button>
                                                <button type="button"
                                                    onclick="cancelEdit('contact-name_contact-{{ $contacts->id }}')"
                                                    class="rounded-md bg-white/10 px-3 py-1.5 text-xs font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </dd>
                            </div>

                            {{-- Campo: email_contact --}}
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm/6 font-medium text-gray-100">E-mail</dt>
                                <dd class="mt-1 text-sm/6 text-gray-400 sm:col-span-2 sm:mt-0">
                                    <div id="view-contact-email_contact-{{ $contacts->id }}"
                                        onclick="enableEdit('contact-email_contact-{{ $contacts->id }}')"
                                        title="Clique para editar o e-mail"
                                        class="group relative inline-flex items-center w-full cursor-pointer rounded-xl px-2 py-1 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                        <span>{{ $contacts->email_contact }}</span>
                                        <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-7 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 ml-2 shadow-lg"
                                            aria-hidden="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </span>
                                    </div>

                                    <div id="edit-contact-email_contact-{{ $contacts->id }}" class="hidden w-full max-w-sm">
                                        <form action="{{ route('contact.update', $contacts->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <label for="input-contact-email-{{ $contacts->id }}" class="block text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-1.5">
                                                Editar E-mail
                                            </label>
                                            <input id="input-contact-email-{{ $contacts->id }}"
                                                type="email"
                                                name="email_contact"
                                                value="{{ $contacts->email_contact }}"
                                                required
                                                class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                                                placeholder="email@exemplo.com" />
                                            <div class="mt-2 flex items-center gap-2">
                                                <button type="submit"
                                                    class="rounded-md bg-indigo-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-indigo-400 cursor-pointer transition">
                                                    Salvar
                                                </button>
                                                <button type="button"
                                                    onclick="cancelEdit('contact-email_contact-{{ $contacts->id }}')"
                                                    class="rounded-md bg-white/10 px-3 py-1.5 text-xs font-semibold text-white hover:bg-white/20 cursor-pointer transition">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </dd>
                            </div>

                            {{-- Campo: social_contact --}}
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm/6 font-medium text-gray-100">Rede Social</dt>
                                <dd class="mt-1 text-sm/6 text-gray-400 sm:col-span-2 sm:mt-0">
                                    <div id="view-contact-social_contact-{{ $contacts->id }}"
                                        onclick="enableEdit('contact-social_contact-{{ $contacts->id }}')"
                                        title="Clique para editar a rede social"
                                        class="group relative inline-flex items-center w-full cursor-pointer rounded-xl px-2 py-1 transition-all duration-200 hover:ring-2 hover:ring-indigo-400 hover:ring-dashed hover:bg-white/5">
                                        @if ($contacts->social_contact)
                                            <a href="{{ $contacts->social_contact }}" target="_blank" rel="noopener noreferrer"
                                                class="text-indigo-400 underline truncate"
                                                onclick="event.stopPropagation()">{{ $contacts->social_contact }}</a>
                                        @else
                                            <span class="text-gray-500 italic">Sem rede social — clique para adicionar</span>
                                        @endif
                                        <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 inline-flex items-center justify-center size-7 rounded-lg bg-indigo-500/30 text-indigo-200 border border-indigo-400/50 shrink-0 ml-2 shadow-lg"
                                            aria-hidden="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </span>
                                    </div>

                                    <div id="edit-contact-social_contact-{{ $contacts->id }}" class="hidden w-full max-w-sm">
                                        <form action="{{ route('contact.update', $contacts->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <label for="input-contact-social-{{ $contacts->id }}" class="block text-xs font-semibold uppercase tracking-wider text-indigo-400 mb-1.5">
                                                Link da Rede Social
                                            </label>
                                            <input id="input-contact-social-{{ $contacts->id }}"
                                                type="url"
                                                name="social_contact"
                                                value="{{ $contacts->social_contact }}"
                                                class="w-full rounded-xl bg-gray-950/90 border-2 border-indigo-500 px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                                                placeholder="https://linkedin.com/in/seu-perfil" />
                                            <div class="mt-2 flex items-center gap-2">
                                                <button type="submit"
                                                    class="rounded-md bg-indigo-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-indigo-400 cursor-pointer transition">
                                                    Salvar
                                                </button>
                                                <button type="button"
                                                    onclick="cancelEdit('contact-social_contact-{{ $contacts->id }}')"
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
                @else
                    <p class="py-10 text-center text-sm text-gray-500">Nenhum registro de contato encontrado.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    // Pressionar ESC para fechar campos de contact
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('[id^="edit-contact-"]').forEach(function(el) {
                if (!el.classList.contains('hidden')) {
                    const id = el.id.replace('edit-', '');
                    cancelEdit(id);
                }
            });
        }
    });
</script>
