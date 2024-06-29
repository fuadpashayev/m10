<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="{{asset('css/pay.css')}}">
    <title>m10 - Payment</title>
</head>
<body>
    @include('receive.create-card')
    @include('receive.qr-card')
    @include('receive.complete-card')
    @include('receive.result-card', ['type' => 'success'])
    @include('receive.result-card', ['type' => 'fail'])
    @include('receive.scripts')
</body>
</html>
