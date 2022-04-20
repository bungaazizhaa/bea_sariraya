<!-- need to remove -->
<li class="nav-item mb-1" id="waktu">
    <p class="font-weight-light text-center m-0 p-0 mt-2" id="tgl">Ddd Mmm 00 0000</p>
    <p class="font-weight-light text-center m-0 p-0 mb-3" id="time">00:00:00 WIB</p>
</li>

<script>
    function myClock() {
        setTimeout(function() {
            const d = new Date();
            const n = d.toLocaleTimeString('id-ID');
            const t = d.toDateString('id-ID');
            document.getElementById("tgl").innerHTML = t;
            document.getElementById("time").innerHTML = n + ' WIB';
            myClock();
        }, 1000)
    }
    myClock();
</script>

{{-- <script>
    function startTime() {
        const today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }; // add zero in front of numbers < 10
        return i;
    }
    setInterval(startTime, 1000);
</script> --}}

<li class="nav-item mb-1">
    <a href="{{ Auth::user()->role === 'admin' ? route('admin') : route('home') }}"
        class="nav-link {{ url()->full() == (Auth::user()->role === 'admin' ? route('admin') : route('home')) ? 'active' : null }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
@if (auth()->user()->role === 'admin')
    <li class="nav-item mb-1">
        <a href="{{ route('user.index') }}"
            class="nav-link {{ url()->current() === route('user.index') ? 'active' : null }}">
            <i class="nav-icon fas fa-users"></i>
            <p class="text-nowrap">Data User</p>
        </a>
    </li>
    <li class="nav-item mb-1 menu-collapse">
        <a href="#" class="nav-link {{ Request::segment(2) === 'pendaftar' ? 'active' : null }}">
            <i class="nav-icon fas fa-graduation-cap"></i>
            <p class="text-nowrap">
                Periode Beasiswa
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('pendaftaran.index') }}"
                    class="nav-link {{ route('pendaftaran.index') === url()->current() ? 'active' : null }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Batch</p>
                </a>
            </li>
            @foreach ($periodes as $periode)
                <li class="nav-item">
                    <a href="{{ route('pendaftaranbyid.index', $periode->periode_id) }}"
                        class="nav-link {{ url()->current() === route('pendaftaranbyid.index', $periode->periode_id) ? 'active' : null }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ $periode->name }}</p>
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
                <a href="{{ route('datamahasiswa.index') }}"
                    class="nav-link {{ url()->current() === route('datamahasiswa.index') ? 'active' : null }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Mahasiswa</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dataadmin.index') }}"
                    class="nav-link {{ url()->current() === route('dataadmin.index') ? 'active' : null }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Admin</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dataperiode.index') }}"
                    class="nav-link {{ url()->current() === route('dataperiode.index') ? 'active' : null }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Periode</p>
                </a>
            </li>
        </ul>
    </li>
@endif
