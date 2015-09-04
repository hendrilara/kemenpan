@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Dashboard
            </header>
            <div class="panel-body">
                <p>Selamat datang Ibu/Bapak.....</p>

                <p>Kemenpan-RB dalam pengelolaan sumberdaya manusianya mengimplementasikan Manajemen Sumber Daya Manusia
                    Terbuka (MSDM-TBK) atau Pengelolaan Sumberdaya Manusia Berbasis Kompetensi dengan model kompetensi
                    sebagai berikut :</p>
                <img src="{{ asset('img/model_kompetensi.png') }}" alt="Kemenpan-RB" width="600px"
                     style=" display: block; margin-left: auto; margin-right: auto;">

                <p>Untuk itu diperlukan sistem pengelolaan sumberdaya terpadu dengan dukungan teknologi informasi, yang
                    disebut MSDM-TBK Online.</p>

                <p>Sebagai langkah awal penerapan Sistem MSDM-TBK, Kemenpan-RB telah menyusun Profil Kompetensi, yang
                    merupakan persyaratan kompetensi yang harus dimiliki karyawan dalam memegang jabatan tertentu. Untuk
                    mengetahui sejauh mana kesesuaian antarakompetensi jabatan dengan kompetensi individual, maka
                    dilakukan pengukuran Competency LevelIndex/CLI.</p>

                <p>Competency Level Index/CLI merupakan indeks yang menunjukkan tingkat kesesuaian kompetensi yang
                    dimiliki individu pemegang jabatan dibandingkan dengan kompetensi yang dipersyaratkan pada jabatan
                    tersebut. Tujuan Pengukuran CLI adalah untuk mengetahui sejauh mana kompetensi individual (Current
                    Competency Level/CCL) sesuai dengan kompetensi jabatan (Required Competency Level) untuk menyusun
                    program pengembangan (Purposed Competency Level/PCL).</p>

                <p>Aplikasi CLI ini memberikan informasi kepada karyawan tentang pengukuran CLI dan hasil pengukuran
                    yang dapat digunakan oleh masing-masing karyawan untuk mengembangkan potensi dan kompetensi yang
                    dimilikinya untuk mencapai efektivitas kinerja. Aplikasi ini akan dikembangkan secara berkelanjutan
                    untuk dapat memberikan informasi tentang penerapan sistem-sistem SDM yang berbasis kompetensi
                    lainnya.</p>

                <p>Aplikasi ini dapat diakses oleh seluruh karyawan pimpinan sesuai dengan wewenang jabatannya, sehingga
                    untuk jabatan manajerial yang lebih tinggi memiliki kewenangan untuk dapat mengakses data bawahan
                    langsungnya.

                <p>Apabila Bapak/Ibu menemui kesulitan dalam mengimplementasikan aplikasi ini, silahkan menghubungi
                    administrator program MSDM-TBK Kemenpan-RB ini.</p>

                <p>Silahkan melanjutkan pekerjaan Anda. Jangan lupa untuk keluar setelah selesai melakukan pekerjaan
                    Anda. Terimakasih.</p>
            </div>
        </section>
    </div>
</div>
@stop

@section('customjs')
    <script type="text/javascript">
        $("#menu_dash").addClass("active");
    </script>
@stop