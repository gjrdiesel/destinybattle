<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Page Description">
    <meta name="author" content="justin">
    <title>Page Title</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>



<div class="container-fluid no-padding" style="background-color: black">

    <div class="image-banner">
        <div class="image-overlay">
            <div class="header-content">
                <h1 class="text-center header-title">Destiny Stats</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <component :is="currentView"></component>
    </div>

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>
    window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
    ]); ?>
</script>

{{--<script src="/js/app.js"></script>--}}
<script src="{{ asset('/js/app.js') }}"></script>
<script src="{{ asset('/js/plugins/app.js') }}"></script>

<script>
    $('body').flowtype({
        minFont : 12,
        maxFont : 18
    });
</script>


</body>
</html>