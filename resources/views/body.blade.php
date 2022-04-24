<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<style>
    body {
      background-image: url('https://mcallistervetservice.com/storage/app/media/573b721102d39_vet1.png');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;

    }
    </style>
<header>
    <nav>
        <ul>
            <div class="w3-bar w3-green w3-border w3-card-4">
             <a href="#" class="w3-bar-item w3-button w3-mobile" >
                    <h5>Home</h5>
                </a>

               <a href="{{ URL('pets') }}" class="w3-bar-item w3-button w3-mobile">
                    <h5>Pet</h5>
                </a>

            <a href="{{ URL('cust') }}" class="w3-bar-item w3-button w3-mobile">
                    <h5>Customer</h5>
                </a>

               <a href="{{ URL('employees') }}" class="w3-bar-item w3-button w3-mobile">
                    <h5>Employees</h5>
                </a>

             <a href="{{ URL('service') }}" class="w3-bar-item w3-button w3-mobile">
                <h5>Services</h5>
            </a>

            <a href="{{ URL('consultation') }}" class="w3-bar-item w3-button w3-mobile">
                <h5>Consultation</h5>
            </a>

            <a href="{{ URL('info') }}" class="w3-bar-item w3-button w3-mobile">
                <h5>Test</h5>
            </a>

            <li class="nav-item">
                <a href="{{ route('transaction.shoppingCart') }}">
                    <i class="fa fa-paw" aria-hidden="true"></i> Pet Transaction
                    <span class="text-xs text-white">{{ Session::has('cart') ? Session::get('cart')->totalCost :
                        '' }}</span>
                </a>
            </li>
        </div>
        </ul>

        @guest
        @if (Route::has('employees.signin'))
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('employees.signin') }}">Sign In</a>
        </li>
        @endif

        @if (Route::has('employees.signup'))
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('employees.signup') }}">Sign Up</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->full_name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('employees.logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('employees.logout') }}" method="POST"
                    class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
    </nav>
</header>

<body>
    @yield('laman')
</body>

</html>
