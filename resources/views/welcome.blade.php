    <!-- Navbar Start -->
    <nav class="navbar fixed top-0 start-0 end-0 z-999 transition-all duration-500 py-5 items-center shadow-md lg:shadow-none [&amp;.is-sticky]:bg-white group [&amp;.is-sticky]:shadow-md bg-white lg:bg-transparent" id="navbar">
        <div class="container">
        
            <div class="flex lg:flex-nowrap flex-wrap items-center">

                <a class="flex items-center" href="/">
                    <img src="{{ asset('assets/logo-iiac.png') }}" class="h-9 flex" style="margin-right: 20px;"> Indonesian Islamic Astronomy Club
                </a>

                <div class="lg:hidden flex items-center ms-auto px-2.5">
                    <button class="hs-collapse-toggle" type="button" id="hs-unstyled-collapse" data-hs-collapse="#navbarCollapse">
                        <i data-lucide="menu" class="h-8 w-8 text-black"></i>
                    </button>
                </div>

                <div class="navigation hs-collapse transition-all duration-300 lg:basis-auto basis-full grow hidden items-center justify-center lg:flex mx-auto overflow-hidden mt-6 lg:mt-0 nav-light" id="navbarCollapse">
                    <ul class="navbar-nav flex-col lg:flex-row gap-y-2 flex lg:items-center justify-center" id="navbar-navlist">
                        <li class="nav-item mx-1.5 transition-all text-dark lg:text-black group-[&amp;.is-sticky]:text-dark all duration-300 hover:text-primary [&amp;.active]:!text-primary group-[&amp;.is-sticky]:[&amp;.active]:text-primary">
                            <a class="nav-link inline-flex items-center text-sm lg:text-base font-medium py-0.5 px-2 capitalize" href="#home">Home</a>
                        </li>

                        <li class="nav-item mx-1.5 transition-all text-dark lg:text-black group-[&amp;.is-sticky]:text-dark duration-300 hover:text-primary [&amp;.active]:!text-primary group-[&amp;.is-sticky]:[&amp;.active]:text-primary">
                            <a class="nav-link inline-flex items-center text-sm lg:text-base font-medium py-0.5 px-2 capitalize" href="#program-kami">Program Kami</a>
                        </li>

                        <li class="nav-item mx-1.5 transition-all text-dark lg:text-black group-[&amp;.is-sticky]:text-dark duration-300 hover:text-primary [&amp;.active]:!text-primary group-[&amp;.is-sticky]:[&amp;.active]:text-primary">
                            <a class="nav-link inline-flex items-center text-sm lg:text-base font-medium py-0.5 px-2 capitalize" href="#about">Tentang Kami</a>
                        </li>

                        <li class="nav-item mx-1.5 transition-all text-dark lg:text-black group-[&amp;.is-sticky]:text-dark duration-300 hover:text-primary [&amp;.active]:!text-primary group-[&amp;.is-sticky]:[&amp;.active]:text-primary">
                            <a class="nav-link inline-flex items-center text-sm lg:text-base font-medium py-0.5 px-2 capitalize" href="#galeri">Galeri</a>
                        </li>

                        <li class="nav-item mx-1.5 transition-all text-dark lg:text-black group-[&amp;.is-sticky]:text-dark duration-300 hover:text-primary [&amp;.active]:!text-primary group-[&amp;.is-sticky]:[&amp;.active]:text-primary">
                            <a class="nav-link inline-flex items-center text-sm lg:text-base font-medium py-0.5 px-2 capitalize" href="#artikel">Artikel</a>
                        </li>

                        <li class="nav-item mx-1.5 transition-all text-dark lg:text-black group-[&amp;.is-sticky]:text-dark duration-300 hover:text-primary [&amp;.active]:!text-primary group-[&amp;.is-sticky]:[&amp;.active]:text-primary">
                            <a class="nav-link inline-flex items-center text-sm lg:text-base font-medium py-0.5 px-2 capitalize" href="#contact">Contact</a>
                        </li>
                    </ul>
                </div>

                <div class="ms-auto shrink hidden lg:inline-flex gap-2">
                    <a href="{{ url('/pendaftaran') }}" class="py-2 px-6 inline-flex items-center gap-2 rounded-md text-base text-white bg-primary hover:bg-primaryDark transition-all duration-500 font-medium">
                        <i data-lucide="download-cloud" class="h-4 w-4 fill-white/40"></i>
                        <span class="hidden sm:block">Daftar</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>



    <!-- =========== Hero Section Start =========== -->
    <section class="relative pt-32 pb-32 overflow-x-hidden from-slate-500/10 bg-[url(../images/home/bg-1.png)] bg-no-repeat bg-cover" id="home">
        <div class="container">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 items-center">
                <div class="text-sm py-20 px-10">
                    <span class="inline-flex py-2 text-lg text-black font-medium items-center justify-center rounded-full">
                        <i data-lucide="minus"></i> Indonesian Islamic Astronomy Club (IIAC)</span>
                    <h1 class="md:text-6xl/tight text-4xl text-dark tracking-normal leading-normal font-bold mb-4 mt-6">
                        "Membaca ayat langit, <span class="text-primary"> menebarkan </span> ilmu di Bumi."</h1>
                    <p class="text-base font-medium text-muted leading-7 mt-5 capitalize">#beriman #berilmu #berkarya</p>
                </div>

                <div class="mt-4 pt-2 sm:mt-0 sm:pt-0 relative">
                    <img src="{{ asset('assets/indonesia.svg') }}" alt="" class=" max-w-full mx-auto">

                    <div class="absolute bottom-3/4 -end-14 2xl:end-8 hidden xl:block">
                        <div class="flex items-center gap-2 p-2 pe-6 rounded-full bg-white shadow-2xl">
                            <div class="rounded-full bg-primary h-9 w-9 items-center justify-center flex">
                                <i data-lucide="codesandbox" class="h-6 w-6 text-white"></i>
                            </div>
                            <div class="">
                                <h6 class="text-base font-medium text-default-900">933 Anggota</h6>
                            </div>
                        </div>
                    </div>


                    <div class="absolute bottom-28 start-6 hidden xl:block">
                        <div class="flex items-center gap-2 p-2 pe-6 rounded-full bg-white shadow-2xl">
                            <div class="rounded-full bg-primary h-9 w-9 items-center justify-center flex">
                                <i data-lucide="headset" class="h-6 w-6 text-white"></i>
                            </div>
                            <div class="">
                                <h6 class="text-base font-medium text-default-900">21 Provinsi</h6>
                            </div>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-4/4 -end-14 2xl:end-8 hidden xl:block">
                        <div class="flex items-center gap-2 p-2 pe-6 rounded-full bg-white shadow-2xl">
                            <div class="rounded-full bg-primary h-9 w-9 items-center justify-center flex">
                                <i data-lucide="codesandbox" class="h-6 w-6 text-white"></i>
                            </div>
                            <div class="">
                                <h6 class="text-base font-medium text-default-900">83 Pengurus</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Services Start -->
    <section id="program-kami" class="py-20">
        <div class="container">
            <div class="max-w-2xl mx-auto text-center">
                <span class="text-sm text-primary uppercase font-semibold tracking-wider text-default-950">Program Kami</span>
                <h2 class="text-3xl md:text-4xl/tight font-semibold text-black mt-4">Beriman, Berilmu, Berkarya</h2>
                <p class="text-base font-medium mt-4 text-muted">Membaca Ayat Langit, Menebarkan Ilmu di Bumi</p>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-3 gap-y-6 md:gap-y-12 lg:gap-y-24 md:pt-20 pt-12">
                @foreach($list_program as $q)
                    <div class="text-center">
                        <div class="flex items-center justify-center">
                            <div class="items-center justify-center flex bg-primary/10 rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border">
                                <i data-lucide="{{ $q->icon }}" class="h-10 w-10 text-primary"></i>
                            </div>
                        </div>
                        <h1 class="text-xl font-semibold pt-4">{{ $q->title }}</h1>
                        <p class="text-base text-gray-600 mt-2">{{ $q->description }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- Services End -->

    <section class="relative py-20 bg-cover bg-no-repeat bg-center" style="background-image: url('{{ asset('assets/background.png') }}');" data-jarallax="" data-speed="0.20">
        <div class="absolute inset-0 w-full h-full bg-gray-900/70"></div>

        <div class="container">
            <div class="pb-10 lg:pb-0 flex flex-col items-center justify-center">
                <h1 class="text-3xl md:text-4xl/tight font-semibold text-white text-center">“Membaca Ayat Langit, Menebarkan Ilmu di Bumi”</h1>
                <p class="text-base font-normal max-w-xl text-center mx-auto text-white mt-6">Nangroe Aceh Darusalam, Sumatera Utara, Riau, Sumatera Barat, Bengkulu, Sumatera Selatan, Lampung, Banten, DKI Jakarta, Jawa Barat, Jawa Tengah, DI Yogyakarta, Jawa Timur, Kalimantan Tengah, Kalimantan Timur, Kalimantan Selatan, Sulawesi Selatan, Gorontalo, Bali, NTB, NTT, Luar Negeri.</p>
            </div>
        </div>
    </section>

    <!-- About Start -->
    <section id="about" class="py-20">
        <div class="container">

            <div class="grid lg:grid-cols-2 items-center gap-6">
                <div class="lg:ms-5 ms-8">
                    <h2 class="text-3xl md:text-4xl/tight font-semibold text-black mt-4">Tentang IIAC</h2>
                    <p class="text-base font-normal text-muted mt-6">Indonesian Islamic Astronomy Club (IIAC) diresmikan di Surabaya pada 7 Agustus 2022.</p>
                    <p class="text-base font-normal text-muted mt-6">IIAC telah terdaftar di Kementerian Hukum dan HAM sebagai perkumpulan berbadan hukum yang bergerak di bidang keilmuan astronomi.</p>

                    <br>
                    <h4 class="text-3xl md:text-2xl/tight font-semibold text-black mt-4">Visi</h4>
                    <p class="text-base font-normal text-muted mt-6">Menjadi wadah aktualisasi diri bagi para penggiat astronomi muslim se-Indonesia untuk mengagungkan kebesaran Allah.</p>

                    <br>
                    <h4 class="text-3xl md:text-2xl/tight font-semibold text-black mt-4">Misi</h4>
                    <p class="text-base font-normal text-muted mt-6">Menjadi wadah pengembangan keilmuan dalam bidang astronomi dan multidisiplin terkait.
                        Menjalin kemitraan dan kolaborasi dengan organisasi lain baik di dalam maupun luar negeri.
                        Memberikan kontribusi dalam bentuk penelitian dan pengabdian masyarakat.</p>
                    <br>
                    <h4 class="text-3xl md:text-2xl/tight font-semibold text-black mt-4">Motto</h4>
                    <p class="text-base font-normal text-muted mt-6">Membaca Ayat Langit, Menebarkan Ilmu di Bumi.</p>
                </div>

                <div class="flex items-center">
                    <img src="{{ asset('assets/fe/images') }}/tentang-kami.png" class="h-[600px] rounded-xl mx-auto" alt="feature-image">
                </div>

            </div>
        </div>
    </section>
    <!-- About End -->

    <!-- Blog Start -->
    <section id="galeri" class="py-20 bg-gray-50">
        <div class="container">
            <div class="">
                <div class="text-center mx-auto">
                    <span class="text-sm text-primary uppercase font-semibold tracking-wider text-default-950">Galeri</span>
                    <h2 class="text-3xl md:text-3xl/tight font-semibold mt-4">Kegiatan Indonesian Islamic Astronomy Club</h2>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6 mt-14 items-center">
                @foreach($list_gallery as $q)
                    <div class="bg-white rounded-xl border">
                        <div class="relative">
                            <img class="rounded-t-xl" src="{{ asset('storage/'.$q->image) }}" alt="">
                        </div>
                        <div class="flex py-6 px-6">
                            <div>
                                <a href="#" class="text-xl text-black font-semibold line-clamp-2">{{ $q->title }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog End -->

    <section id="artikel" class="py-20">
        <div class="container">
            <div class="">
                <div class="text-center max-w-xl mx-auto">
                    <h2 class="text-3xl md:text-4xl/tight font-semibold mt-4">Artikel</h2>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6 mt-14 items-center">
                @foreach($list_article as $q)
                    <div class="bg-white rounded-xl border">
                        <div class="relative">
                            <img class="rounded-t-xl" src="{{ asset('storage/'.$q->image) }}" alt="">
                        </div>
                        <div class="flex py-6 px-6">
                            <div>
                                <a href="{{ url('/article/' . str_replace(' ', '-', $q->title)) }}" class="text-xl text-black font-semibold line-clamp-2">{{ $q->title }}</a>
                                <p class="mt-4 mb-6 text-gray-500 leading-6">{{ Illuminate\Support\Str::limit(strip_tags($q->description), 140, '...') }}</p>

                                <div class="flex items-center justify-between gap-3 mt-4">
                                    <p class="flex font-medium text-muted">{{ \Carbon\Carbon::parse($q['created_at'])->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Start -->
    <section id="contact" class="py-20 bg-gray-50">
        <div class="container">
            <div class="">
                <div class="text-center mx-auto">
                    <span class="text-sm text-primary uppercase font-semibold tracking-wider text-default-950">Contact</span>
                    <h2 class="text-3xl md:text-3xl/tight font-semibold mt-4">Hubungi Kami</h2>
                </div>
            </div>
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-3 gap-y-6 md:gap-y-12 lg:gap-y-24 md:pt-20 pt-12">

                <div class="text-center">
                    <div class="flex items-center justify-center">
                        <div class="items-center justify-center flex bg-primary/10 rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border">
                            <i data-lucide="map-pin" class="text-2xl text-primary"></i>
                        </div>
                    </div>
                    <h1 class="text-xl font-semibold pt-4">Alamat</h1>
                    <p class="text-base text-gray-600 mt-2">City Home Regency G6, Keputih, Sukolilo, Surabaya</p>
                </div>

                <div class="text-center">
                    <div class="flex items-center justify-center">
                        <div class="items-center justify-center flex bg-primary/10 rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border">
                            <i data-lucide="phone" class="text-2xl text-primary"></i>
                        </div>
                    </div>
                    <h1 class="text-xl font-semibold pt-4">Nomor HP / Whatsapp</h1>
                    <p class="text-base text-gray-600 mt-2">0812-2184-1829</p>
                </div>

                <div class="text-center">
                    <div class="flex items-center justify-center">
                        <div class="items-center justify-center flex bg-primary/10 rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border">
                            <i data-lucide="instagram" class="text-2xl text-primary"></i>
                        </div>
                    </div>
                    <h1 class="text-xl font-semibold pt-4">Instagram</h1>
                    <p class="text-base text-gray-600 mt-2">islamicastronomy.id</p>
                </div>

            </div>
        </div>
    </section>
    <!-- Contact End -->

    <!-- Footer Start -->
    <footer class="bg-[#17243A]">

        <div class="py-4 bg-[#1C2940]">
            <!-- 1B283F -->
            <div class="container">
                <div class="flex justify-between items-center">
                    <p class="text-base text-white">2024© Indonesian Islamic Astronomy Club | develop by <a href="tukangbikin.web.id">tukangbikin.web.id</a></p>

                    <div>
                        <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-md border border-transparent text-white hover:bg-primary transition-all duration-300" href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                            </svg>
                        </a>
                        <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-md border border-transparent text-white hover:bg-primary transition-all duration-300" href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"></path>
                            </svg>
                        </a>
                        <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-md border border-transparent text-white hover:bg-primary transition-all duration-300" href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                            </svg>
                        </a>
                        <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-md border border-transparent text-white hover:bg-primary transition-all duration-300" href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path>
                            </svg>
                        </a>
                        <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-md border border-transparent text-white hover:bg-primary transition-all duration-300" href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M3.362 10.11c0 .926-.756 1.681-1.681 1.681S0 11.036 0 10.111C0 9.186.756 8.43 1.68 8.43h1.682v1.68zm.846 0c0-.924.756-1.68 1.681-1.68s1.681.756 1.681 1.68v4.21c0 .924-.756 1.68-1.68 1.68a1.685 1.685 0 0 1-1.682-1.68v-4.21zM5.89 3.362c-.926 0-1.682-.756-1.682-1.681S4.964 0 5.89 0s1.68.756 1.68 1.68v1.682H5.89zm0 .846c.924 0 1.68.756 1.68 1.681S6.814 7.57 5.89 7.57H1.68C.757 7.57 0 6.814 0 5.89c0-.926.756-1.682 1.68-1.682h4.21zm6.749 1.682c0-.926.755-1.682 1.68-1.682.925 0 1.681.756 1.681 1.681s-.756 1.681-1.68 1.681h-1.681V5.89zm-.848 0c0 .924-.755 1.68-1.68 1.68A1.685 1.685 0 0 1 8.43 5.89V1.68C8.43.757 9.186 0 10.11 0c.926 0 1.681.756 1.681 1.68v4.21zm-1.681 6.748c.926 0 1.682.756 1.682 1.681S11.036 16 10.11 16s-1.681-.756-1.681-1.68v-1.682h1.68zm0-.847c-.924 0-1.68-.755-1.68-1.68 0-.925.756-1.681 1.68-1.681h4.21c.924 0 1.68.756 1.68 1.68 0 .926-.756 1.681-1.68 1.681h-4.21z"></path>
                            </svg>
                        </a>
                    </div>
                </div>

            
            </div>
        </div>
    
    </footer>
    <!-- Footer End -->
    <!-- Back to top -->
    <a href="javascript: void(0);" onclick="topFunction()" id="back-to-top" class="back-to-top fixed text-base rounded-md z-10 bottom-8 right-8 h-8 w-8 text-center bg-primary text-white leading-9 justify-center items-center">
        <i data-lucide="arrow-up" class="h-4 w-4 text-white stroke-2"></i>
    </a>
    <!-- Back to top -->

    