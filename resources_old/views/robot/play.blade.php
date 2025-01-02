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
            </div>
            <div class="flex justify-end">
                @if($robot->status == 1)
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
                @elseif($robot->status == 2)
                    <button style="margin-top: 40px; margin-bottom: 40px;" class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.586 3.658A1 1 0 017 13.962V10.04a1 1 0 011.166-.99l6.586 1.118a1 1 0 01.832 1.118z"></path>
                        </svg>
                        Robot sedang berjalan
                    </button>
                @else
                    <button style="margin-top: 40px; margin-bottom: 40px;" href="#"class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Status: Tidak Aktif
                    </button>
                @endif
            </div>
        </div>
    </div>
    <div class="p-4 h-full sm:ml-56 bg-white shadow rounded-lg message-alert" style="margin-right: 40px; margin-top: 50px; height: 330px; display: none;">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <div class="p-6 rounded-lg relative">
                <img src="{{ asset('assets/loading2.gif') }}" style="
                    width: 400px;
                    height: 300px;
                    position: absolute;
                    right: 0;
                    top: 0;
                " class="bg-gray-200">
            </div>
            <div class="flex" style="margin-top: 170px;">
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
            // Handler ketika tombol Play Robot diklik
        $('#play').click(function(e) {
            e.preventDefault();           
            $("#playStop").show(); 
            $("#play").hide(); 
            let url = '{{ url('/robotRun/'.$robot->workflow_id) }}';
            let url_cek = '{{ url('/robotRunCek/'.$robot->workflow_id) }}';

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    console.log(response)
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
                    }, 5000);
                },
                error: function() {
                    alert('Error: Tidak dapat menjalankan robot.');
                    $('.bg-gray-200').hide();
                }
            });
        });
    });
</script>
