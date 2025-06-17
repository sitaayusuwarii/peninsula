{{-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PBL</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('style/assets/img/favicon.png')}}" rel="icon">
  <link href="{{ asset('style/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('style/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('style/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('style/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('style/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('style/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('style/assets/css/main.css')}}" rel="stylesheet">

 
</head>

<body class="index-page">

    @include('partials.navbar')

  <main class="main">
 <div class="chat-container">
    <div id="chat-box" class="chat-box">
      <div class="bot-message">Halo! Ada yang bisa saya bantu tentang Peninsula Island?</div>
      <div class="bot-message">Silakan pilih salah satu:</div>
      <div class="options">
        <button onclick="showResponse('tiket')">Tiket</button>
        <button onclick="showResponse('lokasi')">Lokasi</button>
        <button onclick="showResponse('info')">Info Tambahan</button>
        <button onclick="showResponse('fasilitas')">Fasilitas</button>
      </div>
    </div>
  </div>
  </main>
      @include('partials.footer') --}}

      <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PBL</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <link href="{{ asset('style/assets/img/favicon.png')}}" rel="icon">
  <link href="{{ asset('style/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link href="{{ asset('style/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('style/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('style/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('style/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('style/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <link href="{{ asset('style/assets/css/main.css')}}" rel="stylesheet">

  <link href="{{ asset('style/assets/css/chatbot.css')}}" rel="stylesheet"> </head>

<body class="index-page">

  @include('partials.navbar')

<main class="main">
    <section id="chatbot-area" class="py-5 bg-light"> {{-- Contoh section dengan background --}}
        <div class="container"> {{-- Ini adalah kontainer Bootstrap yang akan menentukan lebar maksimal chatbot --}}
            <div class="chat-container">
                <div id="chat-box" class="chat-box card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Peninsula Island Chatbot</h5>
                    </div>
                    <div class="card-body chat-messages">
                        <div class="bot-message mb-2">Halo! Ada yang bisa saya bantu tentang Peninsula Island?</div>
                        <div class="bot-message mb-2">Silakan pilih salah satu:</div>
                        <div class="options mt-3 d-grid gap-2">
                            <button class="btn btn-primary" onclick="showResponse('tiket')">Tiket</button>
                            <button class="btn btn-primary" onclick="showResponse('lokasi')">Lokasi</button>
                            <button class="btn btn-primary" onclick="showResponse('info')">Info Tambahan</button>
                            <button class="btn btn-primary" onclick="showResponse('fasilitas')">Fasilitas</button>
                            <button class="btn btn-primary" onclick="showResponse('kontak')">Kontak Kami</button>
                            <button class="btn btn-primary" onclick="showResponse('jam_buka')">Jam Buka</button>
                        </div>
                    </div>
                    <div class="card-footer d-flex">
                        <input type="text" id="user-input" class="form-control me-2" placeholder="Ketik pertanyaan Anda...">
                        <button class="btn btn-primary" onclick="sendMessage()">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

{{-- FOOTER --}}
  @include('partials.footer')

  <script src="{{ asset('style/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('style/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('style/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{ asset('style/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{ asset('style/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{ asset('style/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{ asset('style/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

  <script src="{{ asset('style/assets/js/main.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userInputField = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn'); // Pastikan id="send-btn" ada di tombol Kirim Anda

        // Tambahkan event listener untuk tombol Kirim
        if (sendBtn) {
            sendBtn.addEventListener('click', sendMessage);
        }

        // Tambahkan event listener untuk tombol Enter di input teks
        if (userInputField) {
            userInputField.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault(); // Mencegah default action (misal submit form jika ada)
                    sendMessage();
                }
            });
        }

        // Tampilkan pesan dan opsi awal saat halaman dimuat
        // Pastikan ini hanya berjalan sekali di awal
        const chatBoxMessages = document.getElementById('chat-box').querySelector('.chat-messages');
        if (chatBoxMessages && chatBoxMessages.children.length === 0) { // Hanya jika chatbox kosong
            chatBoxMessages.innerHTML += `<div class="bot-message mb-2">Halo! Ada yang bisa saya bantu tentang Peninsula Island?</div>`;
            addInitialOptions(chatBoxMessages);
        }
    });
    // --- Akhir dari blok DOMContentLoaded ---


    function showResponse(option) {
        const chatBoxMessages = document.getElementById('chat-box').querySelector('.chat-messages');
        let response = '';

        const existingOptions = chatBoxMessages.querySelector('.options');
        if (existingOptions) {
            existingOptions.remove();
        }

        // Pesan pengguna dari opsi
        chatBoxMessages.innerHTML += `<div class="user-message mb-2">${option.charAt(0).toUpperCase() + option.replace('_', ' ').slice(1)}</div>`;

        switch (option) {
            case 'tiket':
                response = 'Harga tiket masuk Peninsula Island adalah Rp 25.000 untuk dewasa dan Rp 15.000 untuk anak-anak.';
                break;
            case 'lokasi':
                response = 'Peninsula Island terletak di Nusa Dua, Bali. Anda bisa mencarinya di Google Maps dengan "Peninsula Island Nusa Dua".';
                break;
            case 'info':
                response = 'Peninsula Island adalah tempat yang indah untuk bersantai dan menikmati pemandangan laut. Cocok untuk piknik dan fotografi.';
                break;
            case 'fasilitas':
                response = 'Fasilitas yang tersedia meliputi area parkir, toilet, dan beberapa warung makan kecil.';
                break;
            case 'kontak':
                response = 'Anda dapat menghubungi kami di melalui sosial media instagram @peninsula.nusadua atau email commercial@itdc.co.id';
                break;
            case 'jam buka': // Hati-hati dengan spasi, pastikan konsisten dengan value di button
                response = 'Untuk wisatawan umum, Peninsula Island buka setiap hari dari pukul 08.00 hingga pukul 22.00 WITA.';
                break;
            default:
                response = 'Mohon maaf, saya tidak memahami pilihan Anda.';
        }
        chatBoxMessages.innerHTML += `<div class="bot-message mb-2">${response}</div>`;

        addInitialOptions(chatBoxMessages);
        chatBoxMessages.scrollTop = chatBoxMessages.scrollHeight;
    }

    function addInitialOptions(chatBoxElement) {
        chatBoxElement.innerHTML += `
            <div class="bot-message mb-2">Ada lagi yang bisa saya bantu? Silakan pilih:</div>
            <div class="options mt-3 d-grid gap-2">
                <button class="btn btn-primary" onclick="showResponse('tiket')">Tiket</button>
                <button class="btn btn-primary" onclick="showResponse('lokasi')">Lokasi</button>
                <button class="btn btn-primary" onclick="showResponse('info')">Info Tambahan</button>
                <button class="btn btn-primary" onclick="showResponse('fasilitas')">Fasilitas</button>
                <button class="btn btn-primary" onclick="showResponse('kontak')">Kontak Kami</button>
                <button class="btn btn-primary" onclick="showResponse('jam_buka')">Jam Buka</button> </div>
        `;
    }

    function sendMessage() {
        const userInputField = document.getElementById('user-input');
        const userMessage = userInputField.value.trim();
        const chatBoxMessages = document.getElementById('chat-box').querySelector('.chat-messages'); // Pastikan ini benar

        if (userMessage === '') return;

        chatBoxMessages.innerHTML += `<div class="user-message mb-2">${userMessage}</div>`;
        userInputField.value = '';

        let botReply = "Maaf, saya hanya bisa menjawab pertanyaan dari pilihan yang tersedia saat ini.";
        const lowerCaseMessage = userMessage.toLowerCase();

        if (lowerCaseMessage.includes('tiket') || lowerCaseMessage.includes('harga')) {
            botReply = 'Harga tiket masuk Peninsula Island adalah Rp 25.000 untuk dewasa dan Rp 15.000 untuk anak-anak.';
        } else if (lowerCaseMessage.includes('lokasi') || lowerCaseMessage.includes('alamat') || lowerCaseMessage.includes('dimana')) {
            botReply = 'Peninsula Island terletak di Nusa Dua, Bali. Anda bisa mencarinya di Google Maps dengan "Peninsula Island Nusa Dua".';
        } else if (lowerCaseMessage.includes('info') || lowerCaseMessage.includes('tentang')) {
            botReply = 'Peninsula Island adalah tempat yang indah untuk bersantai dan menikmati pemandangan laut. Cocok untuk piknik dan fotografi.';
        } else if (lowerCaseMessage.includes('fasilitas') || lowerCaseMessage.includes('ada apa')) {
            botReply = 'Fasilitas yang tersedia meliputi area parkir, toilet, dan beberapa warung makan kecil.';
        } else if (lowerCaseMessage.includes('kontak') || lowerCaseMessage.includes('hubungi')) {
            botReply = 'Anda dapat menghubungi kami melalui sosial media instagram @peninsula.nusadua atau email commercial@itdc.co.id';
        } else if (lowerCaseMessage.includes('jam buka') || lowerCaseMessage.includes('buka jam berapa')) {
            botReply = 'Untuk wisatawan umum, Peninsula Island buka setiap hari dari pukul 08.00 hingga pukul 22.00 WITA.';
        } else if (lowerCaseMessage.includes('toilet') || lowerCaseMessage.includes('wc')) {
            botReply = 'Di Peninsula Island ada toilet umum dengan fasilitas yang lengkap. Toilet terletak di dekat area Amphitheater Outdoor.';
        } else if (lowerCaseMessage.includes('parkir') || lowerCaseMessage.includes('tempat parkir')) {
            botReply = 'Ya, tersedia area parkir yang cukup luas untuk pengunjung.';
        } else if (lowerCaseMessage.includes('foto') || lowerCaseMessage.includes('fotografi')) {
            botReply = 'Peninsula Island adalah tempat yang sangat fotogenik, cocok untuk fotografi.';
        } else if (lowerCaseMessage.includes('halo') || lowerCaseMessage.includes('hai') || lowerCaseMessage.includes('selamat datang') || lowerCaseMessage.includes('hallo') || lowerCaseMessage.includes('hi')) {
            botReply = 'Halo! Ada yang bisa saya bantu tentang Peninsula Island?';
        } else if (lowerCaseMessage.includes('terima kasih') || lowerCaseMessage.includes('makasih')) {
            botReply = 'Sama-sama! Jika ada pertanyaan lain, silakan tanyakan.';
        } else if (lowerCaseMessage.includes('buka') && !lowerCaseMessage.includes('jam buka')) { // Memperbaiki logika 'buka' agar tidak bentrok dengan 'jam buka'
            botReply = 'Peninsula Island buka setiap hari dari pukul 06:00 hingga 22:00 WITA.';
        }

        chatBoxMessages.innerHTML += `<div class="bot-message mb-2">${botReply}</div>`;

        // addInitialOptions(chatBoxMessages); // Jika tidak ingin opsi muncul setelah setiap balasan input teks
        chatBoxMessages.scrollTop = chatBoxMessages.scrollHeight;
    }
</script>

</body>
</html>