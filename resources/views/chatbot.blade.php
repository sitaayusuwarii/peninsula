<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PBL Chatbot</title> <meta name="description" content="Chatbot informasi Peninsula Island">
    <meta name="keywords" content="chatbot, peninsula island, nusa dua, bali, tiket, lokasi, fasilitas">

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
    <link href="{{ asset('style/assets/css/chatbot.css')}}" rel="stylesheet">
</head>

<body class="index-page">

    @include('partials.navbar')

    <main class="main">
        <section id="chatbot-area" class="py-5 bg-light">
            <div class="container">
                <div class="chat-container">
                    <div id="chat-box" class="chat-box card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Peninsula Island Chatbot</h5>
                        </div>
                        <div class="card-body chat-messages">
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
            const chatBoxMessages = document.getElementById('chat-box').querySelector('.chat-messages');

            if (chatBoxMessages) {
                // Kosongkan chatbox untuk memastikan tidak ada duplikasi jika elemen awal sudah ada di Blade
                chatBoxMessages.innerHTML = '';
                chatBoxMessages.innerHTML += `<div class="bot-message mb-2">Halo! Ada yang bisa saya bantu tentang Peninsula Island?</div>`;
                addInitialOptions(chatBoxMessages);
            }
        });

        function showResponse(option) {
            const chatBoxMessages = document.getElementById('chat-box').querySelector('.chat-messages');
            let response = '';

            // Hapus opsi yang sudah ada agar tidak menumpuk
            const existingOptions = chatBoxMessages.querySelector('.options');
            if (existingOptions) {
                existingOptions.remove();
            }

            // Tambahkan pesan pengguna (pilihan tombol) ke chatbox
            let userOptionDisplay = option.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
            chatBoxMessages.innerHTML += `<div class="user-message mb-2">${userOptionDisplay}</div>`;

            // Logika respons berdasarkan pilihan tombol
            switch (option) {
                case 'tiket':
                    response = 'Untuk masuk ke Peninsula Island tidak diperlukan tiket masuk. Anda hanya perlu membayar biaya parkir kendaraan jika membawa mobil atau motor. Tarif yang dikenakan adalah Rp 5.000 untuk motor dan Rp 10.000 untuk mobil.';
                    break;
                case 'lokasi':
                    response = 'Peninsula Island terletak di Nusa Dua, Bali. Anda bisa mencarinya di Google Maps dengan "Peninsula Island Nusa Dua".';
                    break;
                case 'info':
                    response = 'Peninsula Island adalah tempat yang indah untuk bersantai dan menikmati waktu bersama keluarga. Cocok untuk piknik, olahraga, event, dan fotografi.';
                    break;
                case 'fasilitas':
                    response = 'Fasilitas yang tersedia meliputi area parkir, toilet, ATM, vending machine, dan beberapa warung kecil.';
                    break;
                case 'kontak':
                    response = 'Anda dapat menghubungi kami melalui sosial media instagram @peninsula.nusadua atau email commercial@itdc.co.id';
                    break;
                case 'jam_buka':
                    response = 'Untuk wisatawan umum, Peninsula Island buka setiap hari dari pukul 08.00 hingga pukul 22.00 WITA.';
                    break;
                case 'toilet':
                    response = 'Toilet terletak di dekat Taksu Art Stage (tempat tari kecak), di bawah pohon rindang dengan tembok motif batu. Tenang saja, toilet untuk pria dan wanita terpisah dengan fasilitas yang cukup bersih dan nyaman.';
                    break;
                case 'taksu_art_stage':
                    response = 'Taksu Art Stage di Peninsula Island adalah tempat yang sering digunakan untuk pertunjukan seni seperti tari kecak. Tempat ini memiliki tatanan yang indah dan nyaman untuk menikmati pertunjukan.';
                    break;
                 case 'parkir':
                    response = 'Area parkir tersedia di Peninsula Island dengan tarif Rp 5.000 untuk motor dan Rp 10.000 untuk mobil. Parkir cukup luas dan aman.';
                    break;
                case 'atm':
                    response = 'ATM tersedia di Peninsula Island untuk memudahkan pengunjung yang membutuhkan uang tunai. Lokasinya dekat dengan area parkir. ATM yang tersedia adalah BCA, Mandiri, BNI, dan BPD.';
                    break;
                case 'tari_kecak':
                    response = 'Tari Kecak adalah pertunjukan seni tradisional Bali yang sering diadakan di Peninsula Island. Pertunjukan ini biasanya berlangsung setiao hari Jumat sore dan merupakan daya tarik utama bagi pengunjung.';
                    break;
                case 'event':
                    response = 'Peninsula Island sering digunakan untuk berbagai event seperti konser, festival, dan acara komunitas. Untuk informasi lebih lanjut tentang event yang akan datang, silakan cek sosial media kami.';
                    break;
                case 'olahraga':
                    response = 'Peninsula Island menyediakan area yang luas untuk berbagai aktivitas olahraga seperti jogging dan bersepeda. Anda juga bisa membawa peralatan olahraga sendiri.';
                    break;
                case 'foto':
                    response = 'Peninsula Island adalah tempat yang sangat fotogenik dengan pemandangan laut yang indah, pohon-pohon yang rimbun, dan area hijau yang luas. Cocok untuk sesi foto keluarga, prewedding, atau sekadar berswafoto.';
                    break;
                case 'warung':
                    response = 'Terdapat beberapa warung makan kecil dan warung yang menjual aksesoris di Peninsula Island. Anda bisa menemukan makanan ringan, minuman, dan beberapa suvenir khas Bali di sini. Anda juga bisa membawa bekal sendiri untuk piknik.';
                case 'waterblow':
                    response = 'Waterblow adalah salah satu atraksi terkenal di Peninsula Island. Ini adalah tempat di mana ombak besar menghantam batu karang, menciptakan semburan air yang spektakuler. Tempat ini sangat populer untuk fotografi dan menikmati keindahan alam. Untuk tiket masuk Waterblow, anda cukup membayar Rp 15.000 per orang untuk wisatawan domestik, dan Rp 30.000 untuk wisatawan mancanegara. Waterblow buka setiap hari dari pukul 08.00 hingga 17.00 WITA.';
                    break;
                default:
                    response = 'Mohon maaf, pilihan tersebut tidak valid.';
            }

            // Tambahkan respons bot ke chatbox
            chatBoxMessages.innerHTML += `<div class="bot-message mb-2">${response}</div>`;

            // Tampilkan kembali opsi-opsi utama setelah respons bot
            addInitialOptions(chatBoxMessages);

            // Gulir chatbox ke bawah agar pesan terbaru terlihat
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
                    <button class="btn btn-primary" onclick="showResponse('jam_buka')">Jam Buka</button>
                    <button class="btn btn-primary" onclick="showResponse('toilet')">Toilet</button>
                    <button class="btn btn-primary" onclick="showResponse('taksu_art_stage')">Taksu Art Stage</button>
                    <button class="btn btn-primary" onclick="showResponse('parkir')">Parkir</button>
                    <button class="btn btn-primary" onclick="showResponse('atm')">ATM</button>
                    <button class="btn btn-primary" onclick="showResponse('tari_kecak')">Tari Kecak</button>
                    <button class="btn btn-primary" onclick="showResponse('event')">Event</button>
                    <button class="btn btn-primary" onclick="showResponse('olahraga')">Olahraga</button>
                    <button class="btn btn-primary" onclick="showResponse('foto')">Foto</button>
                    <button class="btn btn-primary" onclick="showResponse('warung')">Warung</button>
                    <button class="btn btn-primary" onclick="showResponse('waterblow')">Waterblow</button>
                </div>
            `;
        }
    </script>

</body>

</html>