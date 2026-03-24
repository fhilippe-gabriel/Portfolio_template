{{-- Adicionamos o id="projects" --}}
<div id="projects" class="bg-gray-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-32">

            <h2 class="text-2xl font-bold text-indigo-400">
                Projects
            </h2>


            <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:space-y-0 lg:gap-x-6">
                <div class="group relative">
                    @foreach ($projects as $project)
                        <img src="{{ $project->imagem }}"
                            alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug."
                            class="w-full rounded-lg bg-white object-cover group-hover:opacity-75 max-sm:h-80 sm:aspect-2/1 lg:aspect-square" />
                        <h3 class="mt-6 text-sm text-gray-300">
                            <a href="{{ $project->link }}">
                                <span class="absolute inset-0"></span>
                                {{ $project->title }}

                            </a>
                        </h3>
                        <p class="text-base font-semibold text-gray-100">

                            {{ $project->description }}


                        </p>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</div>
