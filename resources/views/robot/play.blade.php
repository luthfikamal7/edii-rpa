<x-app-layout>
    <x-slot name="links">
        {{ __($links) }}
    </x-slot>
    <x-slot name="header">
        {{ __($title) }}
    </x-slot>
    <x-slot name="subheader">
        {{ __('Play') }}
    </x-slot>

    <div class="p-4 h-full sm:ml-56 bg-white shadow rounded-lg" style="margin-right: 40px;">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <div class="p-6 rounded-lg ">
                <h1 class="text-3xl font-bold text-blue-900 mb-4">{{ $robot->name }}</h1>
                <p class="text-lg text-gray-700">{{ $robot->description }}</p>
                <p class="text-lg text-gray-700" id="val-code"></p>
            </div>
            <div class="flex justify-end">
                @if($robot->status == 1)
                    @if($cekRobot > 0)
                        <button style="margin-top: 40px; margin-bottom: 40px;" class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.586 3.658A1 1 0 017 13.962V10.04a1 1 0 011.166-.99l6.586 1.118a1 1 0 01.832 1.118z"></path>
                            </svg>
                            Robot lain sedang berjalan
                        </button>
                    @else
                        <button style="margin-top: 40px;
                        margin-bottom: 40px;" href="#" id="play" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.586 3.658A1 1 0 017 13.962V10.04a1 1 0 011.166-.99l6.586 1.118a1 1 0 01.832 1.118z"></path>
                            </svg>
                            Play Robot
                        </button>
                        <button style="margin-top: 40px;
                        margin-bottom: 40px;" href="#" id="playStop" class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.586 3.658A1 1 0 017 13.962V10.04a1 1 0 011.166-.99l6.586 1.118a1 1 0 01.832 1.118z"></path>
                            </svg>
                            Play Robot
                        </button>
                        <button style="margin-top: 40px; margin-left: 20px;
                        margin-bottom: 40px;" href="#" id="log-detail" class="inline-flex items-center px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.586 3.658A1 1 0 017 13.962V10.04a1 1 0 011.166-.99l6.586 1.118a1 1 0 01.832 1.118z"></path>
                            </svg>
                            Log Detail
                        </button>
                    @endif
                @elseif($robot->status == 2)
                    <button style="margin-top: 40px;
                        margin-bottom: 40px;" href="#" id="play" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.586 3.658A1 1 0 017 13.962V10.04a1 1 0 011.166-.99l6.586 1.118a1 1 0 01.832 1.118z"></path>
                            </svg>
                            Play Robot
                    </button>
                    <button style="margin-top: 40px;
                        margin-bottom: 40px;" href="#" id="playStop" class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.586 3.658A1 1 0 017 13.962V10.04a1 1 0 011.166-.99l6.586 1.118a1 1 0 01.832 1.118z"></path>
                            </svg>
                            Play Robot
                        </button>
                    <button id="playStopBerjalan" style="margin-top: 40px; margin-bottom: 40px;" class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.586 3.658A1 1 0 017 13.962V10.04a1 1 0 011.166-.99l6.586 1.118a1 1 0 01.832 1.118z"></path>
                        </svg>
                        Robot sedang berjalan
                    </button>
                    <button style="margin-top: 40px; margin-left: 20px;
                    margin-bottom: 40px;" href="#" id="log-detail" class="inline-flex items-center px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.586 3.658A1 1 0 017 13.962V10.04a1 1 0 011.166-.99l6.586 1.118a1 1 0 01.832 1.118z"></path>
                        </svg>
                        Log Detail
                    </button>
                @else
                    <button style="margin-top: 40px; margin-bottom: 40px;" href="#"class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Status: Tidak Aktif
                    </button>
                @endif
            </div>
        </div>
        <div class="" style="margin-left: 22px;" id="div-progress">
            <!-- Progress Bar -->
            <div class="mt-4">
                <p class="text-lg text-gray-700 mb-2" id="p-progress">Progress: 10%</p>
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div class="bg-blue-500 h-4 rounded-full" id="value-progress" style="width: 10%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="list-log-detail" class="p-4 h-full sm:ml-56 bg-white shadow rounded-lg message-success" style="margin-right: 40px; margin-top: 20px; height: auto; display: none;">
        <div class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <div class="ms-3 text-sm font-medium" style="width: 100%!important;">
                Waktu Mulai: <span id="log-detail-waktu-mulai"></span> 
                <br>
                <br>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Waktu Selesai
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nomor
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                            </tr>
                        </thead>
                        <tbody id="list-value-log-detail">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 h-full sm:ml-56 bg-white shadow rounded-lg message-alert" style="margin-right: 40px; margin-top: 20px; height: 280px; display: none;">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <div class="p-6 rounded-lg relative">
                <img src="{{ asset('assets/loading2.gif') }}" style="
                    width: 400px;
                    height: 260px;
                    position: absolute;
                    right: 0;
                    top: 0;
                " class="bg-gray-200">
            </div>
            <div class="flex" style="margin-top: 100px;">
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Robot</span> sedang berjalan, harap tunggu.
                </div>
            </div>
        </div>
    </div>
    
    <div id="alert-1" class="p-4 h-full sm:ml-56 bg-white shadow rounded-lg message-success" style="margin-right: 40px; margin-top: 50px; height: 240px; display: none;">
        <div class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <div class="ms-3 text-sm font-medium">
                Robot berhasil dan selesai dijalankan
                <ul class="mt-1.5 list-disc list-inside">
                    <li>Waktu Mulai: <span id="start-date"></span></li>
                    <li>Waktu Selesai: <span id="end-date"></span></li>
                    <li>Durasi berjalan: <span id="duration"></span></li>
                </ul>
                <br>
                Informasi minor:
                <ul class="mt-1.5 list-disc list-inside" id="respon-error">
                    
                </ul>
            </div>
              <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>
    <div id="alert-2" class="p-4 h-full sm:ml-56 bg-white shadow rounded-lg message-error" style="margin-right: 40px; margin-top: 50px; height: 90px; display: none;">
        <div class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <div class="ms-3 text-sm font-medium">
                Robot Error: 
                <span id="msg-error"></span>
            </div>
              <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
          </div>
    </div>
</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $("#playStop").hide();
        $("#log-detail").hide();
        $("#div-progress").hide();
        let percentase = {{$percentase}};
        // alert(percentase)
        let url_log_detail = '{{ url('/robotGetLogDetail/'.$robot->workflow_id) }}';
        let url = '{{ url('/robotRun/'.$robot->workflow_id) }}';
        let url_cek = '{{ url('/robotRunCek/'.$robot->workflow_id) }}';
        let url_get_code = '{{ url('/robotRunCekCode/'.$robot->workflow_id) }}';

        if({{$robot->status}} == 2){
            $("#log-detail").show();
            $("#playStopBerjalan").show(); 
            $("#playStop").hide(); 
            $("#play").hide(); 
            $("#div-progress").show();
            $('#list-log-detail').toggle();
            $.ajax({
                url: url_get_code,
                type: 'GET',
                success: function(responseCode) {
                    $("#val-code").text('Kode: '+responseCode.code)
                },
                error: function() {
                    console.error('Error: Gagal menjalankan operasi setiap 5 detik.');
                }
            });
            let intervalId = setInterval(function() {
                console.log("Operasi setiap 5 detik");
                $.ajax({
                    url: url_cek,
                    type: 'GET',
                    success: function(resp) {
                        if(resp.status == 1){
                            let startTime = new Date(resp.start_date);
                            // Waktu selesai
                            let endTime = new Date(resp.end_date);

                            // Menghitung selisih waktu dalam milidetik
                            let timeDifference = endTime.getTime() - startTime.getTime();

                            // Mengonversi selisih waktu dari milidetik ke detik
                            let durationInSeconds = Math.floor(timeDifference / 1000); // Menggunakan Math.floor untuk pembulatan ke bawah

                            // Menghitung menit dan detik
                            let minutes = Math.floor(durationInSeconds / 60);
                            let seconds = durationInSeconds % 60;

                            // Format output
                            let durationString = `${minutes} Menit, ${seconds} detik`;
                            $("#start-date").text(resp.start_date)
                            $("#end-date").text(resp.end_date)
                            $("#duration").text(durationString)

                            let errors = resp.array_error;
                            let errorList = $("#respon-error");
                            errorList.empty(); // Mengosongkan ul sebelum menambahkan kembali error baru

                            errors.forEach(function(error) {
                                let listItem = `<li>${error}</li>`;
                                errorList.append(listItem);
                            });

                            $('.message-alert').hide();
                            $('.message-success').show();
                            $("#playStop").hide(); 
                            $("#playStopBerjalan").hide(); 
                            $("#playStop").hide(); 
                            $("#play").show(); 
                            clearInterval(intervalId);
                        }else if(resp.status == 3){
                            $("#msg-error").text(resp.message)                                    
                            $('.message-alert').hide();
                            $('.message-error').show();
                            $("#playStop").hide(); 
                            $("#play").show();
                            clearInterval(intervalId);
                        }
                    },
                    error: function() {
                        console.error('Error: Gagal menjalankan operasi setiap 5 detik.');
                    }
                });

                $.ajax({
                    url: url_log_detail,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response_log) {
                        $("#log-detail-waktu-mulai").text(response_log.start_date)
                        $('#list-value-log-detail').empty(); // Bersihkan isi sebelum di-append ulang
                        let value = 10;
                        if (!response_log.value_percentase || response_log.value_percentase.nomor == null || response_log.value_percentase.nomor === '') {
                            value = 10;
                        } else {
                            value = response_log.value_percentase.nomor;
                        }
                        let calculatedPercentage = value * percentase;
                        calculatedPercentage = Math.ceil(calculatedPercentage);
                        // Update progress bar width and text
                        $("#value-progress").css("width", calculatedPercentage + "%");
                        $("#p-progress").text("Progress: " + calculatedPercentage + "%");
                        
                        // Loop response data dan append ke dalam tbody
                        $.each(response_log.data, function(index, data) {
                            if(data.status_error == 1){
                                $('#list-value-log-detail').append('<tr style="background: rgb(240 82 82 / var(--tw-bg-opacity));" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.waktu_selesai + '</th><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.nomor + '</th><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.title + '</th></tr>');
                            }else{
                                $('#list-value-log-detail').append('<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.waktu_selesai + '</th><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.nomor + '</th><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.title + '</th></tr>');
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Handle error jika ada
                    }
                });

            }, 5000);
        }
        // Handler ketika tombol Play Robot diklik
        $('#play').click(function(e) {
            e.preventDefault();           
            $("#log-detail").show();
            $("#playStop").show(); 
            $("#play").hide(); 
            $("#div-progress").show();
            let default_percentage = 10;
            $("#value-progress").css("width", default_percentage + "%");
            $("#p-progress").text("Progress: " + default_percentage + "%");

            let url = '{{ url('/robotRun/'.$robot->workflow_id) }}';
            let url_cek = '{{ url('/robotRunCek/'.$robot->workflow_id) }}';
            $('#list-log-detail').toggle();
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if(response.success == "refresh"){
                        alert(response.message)
                        window.location = "/edii-rpa/public/robotPlay/"+response.id;
                    }

                    $("#val-code").text('Kode: '+response.code)
                    $('.message-alert').show();

                    
                    let intervalId = setInterval(function() {
                        console.log("Operasi setiap 5 detik");
                        $.ajax({
                            url: url_cek,
                            type: 'GET',
                            success: function(resp) {
                                if(resp.status == 1){
                                    let startTime = new Date(resp.start_date);
                                    // Waktu selesai
                                    let endTime = new Date(resp.end_date);

                                    // Menghitung selisih waktu dalam milidetik
                                    let timeDifference = endTime.getTime() - startTime.getTime();

                                    // Mengonversi selisih waktu dari milidetik ke detik
                                    let durationInSeconds = Math.floor(timeDifference / 1000); // Menggunakan Math.floor untuk pembulatan ke bawah

                                    // Menghitung menit dan detik
                                    let minutes = Math.floor(durationInSeconds / 60);
                                    let seconds = durationInSeconds % 60;

                                    // Format output
                                    let durationString = `${minutes} Menit, ${seconds} detik`;
                                    $("#start-date").text(resp.start_date)
                                    $("#end-date").text(resp.end_date)
                                    $("#duration").text(durationString)

                                    let errors = resp.array_error;
                                    let errorList = $("#respon-error");
                                    errorList.empty(); // Mengosongkan ul sebelum menambahkan kembali error baru

                                    errors.forEach(function(error) {
                                        let listItem = `<li>${error}</li>`;
                                        errorList.append(listItem);
                                    });

                                    $('.message-alert').hide();
                                    $('.message-success').show();
                                    $("#playStop").hide(); 
                                    $("#play").show(); 
                                    let calculatedPercentage = 100;
                                    $("#value-progress").css("width", calculatedPercentage + "%");
                                    $("#p-progress").text("Progress: " + calculatedPercentage + "%");
                                    clearInterval(intervalId);
                                }else if(resp.status == 3){
                                    $("#msg-error").text(resp.message)                                    
                                    $('.message-alert').hide();
                                    $('.message-error').show();
                                    $("#playStop").hide(); 
                                    $("#play").show();
                                    let calculatedPercentage = 100;
                                    $("#value-progress").css("width", calculatedPercentage + "%");
                                    $("#p-progress").text("Progress: " + calculatedPercentage + "%");
                                    clearInterval(intervalId);
                                }
                            },
                            error: function() {
                                console.error('Error: Gagal menjalankan operasi setiap 5 detik.');
                            }
                        });

                        $.ajax({
                            url: url_log_detail,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response_log) {
                                $("#log-detail-waktu-mulai").text(response_log.start_date)
                                $('#list-value-log-detail').empty(); // Bersihkan isi sebelum di-append ulang
                                let value = 0;
                                if(response_log.value_percentase.nomor == null || response_log.value_percentase.nomor == ''){
                                    value = 0;
                                }else{
                                    value = response_log.value_percentase.nomor;
                                }
                                let calculatedPercentage = value * percentase;
                                calculatedPercentage = Math.ceil(calculatedPercentage);
                                // Update progress bar width and text
                                $("#value-progress").css("width", calculatedPercentage + "%");
                                $("#p-progress").text("Progress: " + calculatedPercentage + "%");
                                
                                // Loop response data dan append ke dalam tbody
                                $.each(response_log.data, function(index, data) {
                                    if(data.status_error == 1){
                                        $('#list-value-log-detail').append('<tr style="background: rgb(240 82 82 / var(--tw-bg-opacity));" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.waktu_selesai + '</th><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.nomor + '</th><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.title + '</th></tr>');
                                    }else{
                                        $('#list-value-log-detail').append('<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.waktu_selesai + '</th><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.nomor + '</th><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.title + '</th></tr>');
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText); // Handle error jika ada
                            }
                        });
                    }, 5000);
                },
                error: function() {
                    alert('Error: Tidak dapat menjalankan robot.');
                    $('.bg-gray-200').hide();
                }
            });
        });

        $('#log-detail').on('click', function() {
            $('#list-log-detail').toggle(); // Toggle show/hide list-log-detail

            // Jika list-log-detail ditampilkan, lakukan Ajax request
            if ($('#list-log-detail').is(':visible')) {
                $.ajax({
                    url: url_log_detail,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $("#log-detail-waktu-mulai").text(response.start_date)
                        $('#list-value-log-detail').empty(); // Bersihkan isi sebelum di-append ulang
                        // Loop response data dan append ke dalam tbody
                        $.each(response.data, function(index, data) {
                            if(data.status_error == 1){
                                $('#list-value-log-detail').append('<tr style="background: rgb(240 82 82 / var(--tw-bg-opacity));" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.waktu_selesai + '</th><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.nomor + '</th><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.title + '</th></tr>');
                            }else{
                                $('#list-value-log-detail').append('<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.waktu_selesai + '</th><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.nomor + '</th><th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + data.title + '</th></tr>');
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Handle error jika ada
                    }
                });
            }
        });
    });
</script>
