<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>EDII RPA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="EDII RPA" name="description" />
    <meta content="EDII RPA" name="author" />


        <!-- style css -->
    <link href="{{asset('assets-login/css/style.min.css')}}" rel="stylesheet" type="text/css">
</head>

<body>
    <section class="relative p-4 md:p-6 lg:h-screen flex items-center bg-right-bottom bg-no-repeat bg-cover" style="background-image: url('{{ asset('assets-login/images/bg-login.jpeg') }}');">
        <div class="absolute inset-0 w-full h-full"></div>
        <!-- end backdrop -->
        <div class="container">
            <div class="backdrop-blur-2xl bg-white/20 rounded-xl" style="float: right; width: 461px;">
                <div class="grid items-center">
                    <div class="text-white relative p-8 order-2 lg:order-1">
                        <div class="flex justify-center items-center mb-4">
                            <img src="{{ asset('assets-login/images/Logo Athena.png') }}" style="width: 60%;">
                        </div>
                        <div class="max-w-xl">
                            <h2 class="text-4xl font-bold capitalize mb-4 text-center">Login to Account</h2>
                            <p class="text-center">Please enter your email and password to continue</p>
                        </div>

                        <div class="mt-10">
                            <!-- Error Notification -->
                            @if ($errors->has('login'))
                                <div id="error-message" class="bg-red-500 text-white p-4 rounded-md mb-4">
                                    {{ $errors->first('login') }}
                                </div>
                            @endif

                            <div class="rounded-md" style="background: transparent!important;">
                                <form class="w-full mt-7" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <label style="font-size: 18px;">Email</label>
                                    <div style="background-color: transparent; margin-bottom: 30px;">
                                        <input type="email" style="width: 100%; background-color: #FFFFFF; color: black; height: 48px!important; border-radius: 8px;" name="email" id="email" class="w-full p-4 border-0 focus:outline-none focus:ring-0 text-sm bg-transparent placeholder:text-black" placeholder="Enter Your Email" required autocomplete="off">
                                    </div>
                                    <label style="font-size: 18px;">Password</label>
                                    <div style="background-color: transparent;">
                                        <input type="password" style="width: 100%; background-color: #FFFFFF; color: black; height: 48px!important; border-radius: 8px;" name="password" id="password" class="w-full p-4 border-0 focus:outline-none focus:ring-0 text-sm bg-transparent placeholder:text-black" placeholder="Enter Your Password" required autocomplete="off">
                                    </div>
                                    <br>
                                    <button class="py-2 px-6 me-2 border-0 text-white font-semibold text-sm rounded-md backdrop-blur-2xl bg-white/10 hover:bg-black/40 hover:text-black transition-all duration-500" style="width: 100%;background: linear-gradient(90deg, #0060AF 0%, #2CA0FF 47.64%, #0A6CBA 91.59%);">
                                        <div class="flex items-center justify-center gap-1">
                                            <span>Submit</span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="{{ asset('assets-login/libs/preline/preline.js') }}"></script>
    <script src="{{ asset('assets-login/js/counter.js') }}"></script>
    <script>
        // Hide the error message after 5 seconds
        setTimeout(function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>

</body>

</html>
