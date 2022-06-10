<!-- need to remove -->
<li class="nav-item mb-1" id="waktu">
    <p class="font-weight-light text-center m-0 p-0 mt-2" id="tgl">Tgl, 00 Bulan
        0000</p>
    <p class="font-weight-light text-center m-0 p-0 mt-1" id="jam">Jam : 00:00:00
    </p>
</li>

<script>
    function myClock() {
        setTimeout(function() {
            moment.locale('id');
            var Tanggal = moment().format('dddd, DD MMMM YYYY');
            var Jam = moment().format('HH:mm:ss');
            var eTgl = document.getElementById('tgl');
            var eJam = document.getElementById('jam');
            eTgl.innerHTML = Tanggal;
            eJam.innerHTML = 'Jam : ' + Jam;
            myClock();
        }, 100)
    };
    $(document).ready(function() {
        myClock();
    });
</script>

<li class="nav-item mb-1">
    <a href="{{ route('admin') }}" class="nav-link {{ url()->full() == route('admin') ? 'active' : null }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
@if (auth()->user()->role === 'admin')
    <li class="nav-item mb-1">
        <a href="{{ route('data.pengguna') }}"
            class="nav-link {{ Request::segment(2) === 'data-pengguna' ? 'active' : null }}">
            <i class="nav-icon fas fa-users"></i>
            <p class="text-nowrap">Data Pengguna</p>
        </a>
    </li>
    <li
        class="nav-item mb-1 menu-collapse  {{ Request::segment(2) === 'detail-periode' || Request::segment(2) === 'nilai-administrasi' || Request::segment(2) === 'nilai-wawancara' || Request::segment(2) === 'nilai-penugasan' || Request::segment(1) === 'periode' ? 'menu-open' : null }}">
        <a href="#"
            class="nav-link {{ Request::segment(2) === 'detail-periode' || Request::segment(2) === 'nilai-administrasi' || Request::segment(2) === 'nilai-wawancara' || Request::segment(2) === 'nilai-penugasan' || Request::segment(1) === 'periode' ? 'active' : null }}">
            <i class="nav-icon fas fa-graduation-cap"></i>
            <p class="text-nowrap">
                Periode Beasiswa
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('index.periode') }}"
                    class="nav-link {{ url()->current() === route('index.periode') ? 'active' : null }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tambah / Hapus
                    </p>
                </a>
            </li>
            @foreach ($getAllPeriode as $periode)
                <li class="nav-item">
                    <a href="{{ route('periode', $periode->name) }}"
                        class="nav-link {{ url()->current() === route('periode', $periode->name) || url()->current() === route('nilai.adm', $periode->name) || url()->current() === route('nilai.wwn', $periode->name) || url()->current() === route('nilai.png', $periode->name) ? 'active' : null }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ ucfirst($periode->name) . ' (' . ucfirst($periode->status) . ')' }}
                        </p>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
    <li class="nav-item mb-1">
        <a href="{{ route('setting.beasiswa') }}"
            class="nav-link {{ Request::segment(2) === 'setting' ? 'active' : null }}">
            <i class="nav-icon fa-solid fa-gear"></i>
            <p class="text-nowrap">Pengaturan</p>
        </a>
    </li>
    <li class="nav-item mb-1">
        <a href="{{ route('panduan.aplikasi') }}"
            class="nav-link {{ Request::segment(1) === 'panduan-aplikasi' ? 'active' : null }}">
            <i class="nav-icon fa-solid fa-circle-info"></i>
            <p class="text-nowrap">Panduan Aplikasi</p>
        </a>
    </li>
@endif
