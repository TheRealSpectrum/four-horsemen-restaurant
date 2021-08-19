<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> @yield("title", "Molveno Resort Restaurant App") </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Oxygen:wght@400;700&display=swap" rel="stylesheet">
    <!-- Rik heeft de hik -->
</head>
<body>
    <div class="bg-light text-dark min-h-screen">
        @yield("content")
    </div>
</body>
</html>
