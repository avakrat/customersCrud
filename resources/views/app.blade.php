<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <title>Customers CRUD</title>
</head>
<body>
    <div id="app">
        <app-main></app-main>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>