<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> @yield("title", "Molveno Resort Restaurant App") </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="bg-gray-100 min-h-screen">
        @yield("content")
    </div>
</body>
</html>
