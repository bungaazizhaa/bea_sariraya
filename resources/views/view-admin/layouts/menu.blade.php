<!-- need to remove -->
<li class="nav-item mb-1" id="waktu">
    <p class="font-weight-light text-center m-0 p-0 mt-2" id="tgl">Tgl, 00 Bulan 0000</p>
    <p class="font-weight-light text-center m-0 p-0 mt-1" id="jam">Jam : 00:00:00</p>
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
        <a href="{{ route('admin') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p class="text-nowrap">Data User</p>
        </a>
    </li>
    <li
        class="nav-item mb-1 menu-collapse  {{ Request::segment(1) === 'periode' || Request::segment(1) === 'nilai-administrasi' ? 'menu-open' : null }}">
        <a href="#"
            class="nav-link {{ Request::segment(1) === 'periode' || Request::segment(1) === 'nilai-administrasi' ? 'active' : null }}">
            <i class="nav-icon fas fa-graduation-cap"></i>
            <p class="text-nowrap">
                Periode Beasiswa
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @foreach ($getAllPeriode as $periode)
                <li class="nav-item">
                    <a href="{{ route('periode', $periode->name) }}"
                        class="nav-link {{ url()->current() === route('periode', $periode->name) ||url()->current() === route('nilai.adm', $periode->name)? 'active': null }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ ucfirst($periode->name) . ' (' . ucfirst($periode->status) . ')' }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
    <li class="nav-item mb-1 menu-collapse">
        <a href="#" class="nav-link {{ Request::segment(2) === 'masterdata' ? 'active' : null }}">
            <i class="nav-icon fas fa-server"></i>
            <p class="text-nowrap">
                Master Data
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('admin') }}"
                    class="nav-link {{ url()->current() === route('admin') ? 'active' : null }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Mahasiswa</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin') }}"
                    class="nav-link {{ url()->current() === route('admin') ? 'active' : null }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Admin</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin') }}"
                    class="nav-link {{ url()->current() === route('admin') ? 'active' : null }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Periode</p>
                </a>
            </li>
        </ul>
    </li>
@endif
