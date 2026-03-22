<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    {{-- A diretiva @vite é injetada aqui no head para carregar o seu CSS/JS principal compilado (onde o Tailwind está configurado) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Alteramos o body para flex-col (coluna) para que o topo, conteúdo e rodapé fiquem empilhados corretamente na tela --}}

<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- A diretiva @include importa uma view simples como um "bloco" (ex: resources/views/public/partials/navbar.blade.php) --}}
    @include('public.partials.navbar')
    @include('public.partials.aboute')
    @include('public.partials.skills')
    @include('public.partials.projects')
    @include('public.partials.contact')
    @include('public.partials.footer')

    {{-- Envolvemos o @yield em um <main> com flex-grow para que ocupe todo o espaço livre e empurre o footer para baixo --}}
    <main class="flex-grow flex flex-col">
        {{-- A diretiva @yield('content') recebe o conteúdo principal das outras views --}}
        @yield('content')
    </main>

    {{-- Como alternativa ao @include, você pode usar "Componentes Blade", com a sintaxe <x-nome />. (ex: resources/views/components/footer.blade.php) --}}

</body>

</html>
