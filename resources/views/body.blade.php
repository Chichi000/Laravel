<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    body {
      background-image: url('https://t3.ftcdn.net/jpg/03/10/73/58/360_F_310735841_2L1kJgZWrk9JpuNREqp4gpC6y0SzewYX.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
    </style>
<header>
    <nav>
        <ul>
            <button> <a>
                    <h5>Home</h5>
                </a></button>
                <button><a href="{{ URL('pets') }}">
                    <h5>Pet</h5>
                </a></button>
            <button><a href="{{ URL('cust') }}">
                    <h5>Customer</h5>
                </a></button>

            <button>
                    <h5>Employee</h5>
             </button>

            <button>
                    <h5>Services</h5>
            </button>

        </ul>
    </nav>
</header>

<body>
    @yield('laman')
</body>

</html>
