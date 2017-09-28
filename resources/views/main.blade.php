<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Analysis</title>

        <script src="{{ asset('js/app.js') }}"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style type="text/css">
        img{
            width:100%;
            height: 100%;
        }
      



    </style>

    
</head>
<body>

        <div class="col-md-6" ><a  href="/analysis"><img id="img1" src="img/site_pass.png" alt="site" onmousemove="$(this).attr('src','img/site_activ.png')" onmouseleave="$(this).attr('src','img/site_pass.png')"></a></div>
        <div class="col-md-6" ><a  href="/journal"><img id="img2" src="img/Ejednevik_pass.png" alt="ejed" onmousemove="$(this).attr('src','img/Ejednevik_activ.png')" onmouseleave="$(this).attr('src','img/Ejednevik_pass.png')"></a></div>

</body>
</html>