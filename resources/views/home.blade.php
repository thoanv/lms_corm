<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
   <link  href="{{asset('libraries/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
</head>
<body class="antialiased">
<div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form  action="{{route('scorms.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tải file</label>
                        <input type="file" class="form-control" name="file">
                    </div>
                    <button type="submit" class="btn btn-success">Gửi</button>
                </form>
            </div>
        </div>
    </div>

</div>
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('libraries/bootstrap/js/bootstrap.js')}}"></script>
</body>
</html>
