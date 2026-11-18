@php
    $aboutItem = $abouts instanceof \Illuminate\Support\Collection ? ($abouts->first() ?? new \App\Models\About()) : $abouts;
    $photoUrl = $aboutItem?->user_imagem;
    if ($photoUrl && !str_starts_with($photoUrl, 'http://') && !str_starts_with($photoUrl, 'https://')) {
        $photoUrl = asset(ltrim($photoUrl, '/'));
    }
@endphp

{{-- Adicionamos o id="about" para que a âncora do menu encontre esta seção --}}
<section id="about" class="relative isolate overflow-hidden bg-gray-900 px-6 py-24 sm:py-32 lg:px-8">
    <div class="mx-auto max-w-2xl lg:max-w-4xl">
        @if ($aboutItem)
            <figure class="mt-10">
                <blockquote class="text-center text-xl/8 font-semibold text-white sm:text-2xl/9">
                    <p>
                        {{ $aboutItem->description }}
                    </p>
                </blockquote>
                <figcaption class="mt-10 flex flex-col items-center justify-center text-center">
                    <img src="{{ $photoUrl ?: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                        alt="{{ $aboutItem->title }}"
                        class="mx-auto size-20 rounded-full object-cover shadow-lg" />
                    <div class="mt-4 flex items-center justify-center space-x-3 text-base">
                        <div class="font-semibold text-indigo-400">{{ $aboutItem->title }}</div>
                    </div>
                </figcaption>
            </figure>
        @endif
    </div>
</section>
