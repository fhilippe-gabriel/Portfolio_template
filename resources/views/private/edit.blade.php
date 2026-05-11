<!DOCTYPE html>
{{-- Adicionado scroll-smooth para a navegação por âncoras ser suave --}}
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Portfolio </title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    {{-- A diretiva @vite é injetada aqui no head para carregar o seu CSS/JS principal compilado (onde o Tailwind está configurado) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<div class="bg-gray-700 min-h-screen flex flex-col">
    {{-- Alteramos o body para flex-col (coluna) para que o topo, conteúdo e rodapé fiquem empilhados corretamente na tela --}}
    @include('private.partials.navbar')
    @include('private.partials.about')
    @include('private.partials.skills')
    @include('private.partials.projects')
    @include('private.partials.contact')
    @include('private.partials.footer')
</div>

<body class="bg-gray-100 min-h-screen flex flex-col">
</body>

</html>
