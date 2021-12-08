<html>
    <head>
        <title></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
        @include('/partials/navbar')
        @yield('content')
    </body>
    <footer class="d-flex justify-content-center align-items-center" style="background-color: #14171A; color: #C4C4C4; height: 70px; border-top: 1px solid  #878787">
        <p style="padding-top: 10px">Copyright © Tembaga Studio 2021</p>
    </footer>
</html> 