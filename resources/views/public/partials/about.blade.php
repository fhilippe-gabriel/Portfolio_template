{{-- Adicionamos o id="about" para que a âncora do menu encontre esta seção --}}
<section id="about" class="relative isolate overflow-hidden bg-gray-900 px-6 py-24 sm:py-32 lg:px-8">

    <div class="mx-auto max-w-2xl lg:max-w-4xl">

        <figure class="mt-10">
            <blockquote class="text-center text-xl/8 font-semibold text-white sm:text-2xl/9">
                @foreach ($about as $abouts)
                    <p>

                        {{ $abouts->description }}

                    </p>
                @endforeach

            </blockquote>
            <figcaption class="mt-10">
                <img src="{{ $abouts->user_image }}" alt="" class="mx-auto size-20 rounded-full" />
                <div class="mt-4 flex items-center justify-center space-x-3 text-base">
                    <div class="font-semibold text-indigo-400">NAME</div>
                
                </div>
            </figcaption>
        </figure>
    </div>
</section>
