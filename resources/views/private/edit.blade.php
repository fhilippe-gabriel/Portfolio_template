<!DOCTYPE html>
{{-- Adicionado scroll-smooth para a navegação por âncoras ser suave --}}
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Portfolio</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    {{-- A diretiva @vite é injetada aqui no head para carregar o seu CSS/JS principal compilado (onde o Tailwind está configurado) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-800 min-h-screen flex flex-col text-white">
    <div class="min-h-screen flex flex-col">
        @include('private.partials.navbar')

        {{-- Toast / Notificação de feedback de salvamento --}}
        @if (session('success'))
            <div class="mx-auto w-full max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between rounded-xl bg-emerald-500/10 border border-emerald-500/30 p-4 text-emerald-300 shadow-lg">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-emerald-400 shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                    <button type="button" onclick="this.closest('.flex.items-center.justify-between').parentElement.remove()" class="text-emerald-400 hover:text-emerald-200 cursor-pointer">
                        <span class="sr-only">Fechar</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mx-auto w-full max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                <div class="rounded-xl bg-red-500/10 border border-red-500/30 p-4 text-red-300 shadow-lg">
                    <p class="text-sm font-medium">Por favor, verifique os erros abaixo:</p>
                    <ul class="mt-2 list-disc list-inside text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @include('private.partials.about')
        @include('private.partials.skills')
        @include('private.partials.projects')
        @include('private.partials.contact')
        @include('private.partials.footer')
    </div>
</body>

</html>
