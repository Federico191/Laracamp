<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/styles/main.css" type="text/css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <title>Laracamp by BuildWith Angga</title>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{route('welcome')}}">
            <img src="{{asset('images/logo.png')}}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mentor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Business</a>
                </li>
            </ul>
            <div class="d-flex user-logged">
                <a href="#">
                    Halo, {{Auth::user()->name}}!
                    @if(Auth::user()->avatar)
                        <img src="{{asset(Auth::user()->avatar)}}" class="user-photo" alt="" style="border-radius: 50%">

                    @else
                        <img src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" class="user-photo" alt=""
                             style="border-radius: 50%">

                    @endif
                </a>
            </div>
        </div>
    </div>
</nav>

<section class="dashboard my-5">
    <div class="container">
        <div class="row text-left">
            <div class=" col-lg-12 col-12 header-wrap mt-4">
                <p class="story">
                    DASHBOARD
                </p>
                <h2 class="primary-header ">
                    My Bootcamps
                </h2>
            </div>
        </div>
        <div class="row my-5">
            @include('components.alert')
            <table class="table">
                <tbody>
                @forelse($checkouts as $checkout)
                    <tr class="align-middle">
                        <td width="18%">
                            <img src="{{asset('images/item_bootcamp.png')}}" height="120" alt="">
                        </td>
                        <td>
                            <p class="mb-2">
                                <strong>{{$checkout->Camp->title}}</strong>
                            </p>
                            <p>
                                {{$checkout->created_at->format('M d, Y')}}
                            </p>
                        </td>
                        <td>
                            <strong>{{$checkout->Camp->price}}k</strong>
                        </td>
                        <td>
                            <strong>{{$checkout->payment_status}}</strong>
                        </td>
                        <td>
                            @if($checkout->payment_status == 'Waiting')
                                <a href="{{$checkout->midtrans_url}}" class="btn btn-primary">Pay Here</a>
                            @endif
                        </td>
                        <td>
                            <a href="https://wa.me//081xxxxxxxx?text=Hi, saya ingin bertanya mengenai kelas {{$checkout->Camp->title}}"
                               class="btn btn-primary">
                                Contact Support
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5"></td>
                        <h3>No Camp Registered</h3>
                    </tr>

                @endforelse

                </tbody>
            </table>
        </div>
    </div>
</section>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js "
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj "
        crossorigin="anonymous "></script>

</body>

</html>
