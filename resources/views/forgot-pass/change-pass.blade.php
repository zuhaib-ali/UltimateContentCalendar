<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/logo_square1.png') }}" type="image/png" />

    <!-- Exernal Styling -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <!-- Boostrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <title>Change Password</title>
</head>

<body>
    <div class="bg">
        <div class="white-bg bg-light">
            <div class="container-fluid">
                <!-- NAV BAR -->
                <nav class="navbar navbar-light ">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('login_images/snapsvg-seeklogo.com.svg') }}" alt="">
                    </a>
                    Task Management System
                </nav>
            </div>
            <!-- NAV BAR -->
        </div>

        <!-- <img src="Images/Graduation.jpg" alt=""> -->
        <div class="containerr">
            <div class="formy ">
                <!-- LOGIN form -->
                <form action="{{ url('/change-password') }}" method="POST" class="">
                {{-- <label for="form-heading"> Change Password </label> --}}

                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="password" name="password" id="password"  placeholder="Enter Your Password" class="p-2 mt-4">

                    <input type="password" name="confirm_pass" id="confirm_pass"  placeholder="Retype Your Password" class="p-2 mt-4">
                    {{-- <input type="password" name="password" id="Password" placeholder="Password" class="p-2 mt-2"> --}}

                    <div class="fp-login d-flex  justify-content-between  mt-3 mb-3">
                        {{-- <a href="{{ url('forgot-password') }}" class="forgetPass">forgot password ?</a> --}}
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <div class="login">
     <div class="conatiner"> -->


    <!-- </div>
</div> -->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    @if(Session::has("success"))
        <script>
            toastr.success("{{Session::get('success')}}")
        </script>
    @endif
    @if($errors->any())
        <script>
            @foreach($errors->all() as $error)
                toastr.error("{{$error}}");
            @endforeach
        </script>
    @endif

</body>

</html>
