@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Pengaturan Beasiswa Sariraya</title>
@endsection
@section('title')
    <h4 class="m-0 p-0">Pengaturan</h4>
@endsection
@section('content')
    <div class="container-fluid px-3">
        <!-- Main content -->
        <div class="col-12">
            <p class="h3 font-weight-bold mb-3">Data Admin</p>
            <div class="card rounded-md myshadow">
                <div class="card-body">
                    <form method="POST" action="{{ route('pengguna.update', Auth::user()->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row mb-3">
                                    <div class="mx-auto mb-2">
                                        <img src="/pictures/{{ Auth::user()->picture == '' ? 'noimg.png' : Auth::user()->picture }}"
                                            class="rounded img-preview" alt="User Image" height="240px" width="180px">
                                    </div>
                                    @error('Foto')
                                        <div class="alert alert-danger mb-2" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row mb-3">
                                    <label for="picture"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Foto Profil') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="Foto" name="Foto"
                                                    onchange="previewImage()" value="{{ old('Foto') }}">
                                                <label class="custom-file-label" for="Foto">Pilih
                                                    File</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name', Auth::user()->name) }}" required autocomplete="name">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password Baru') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            autocomplete="off" placeholder="Isi jika ingin mengubah Password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Password Baru') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" autocomplete="off"
                                            placeholder="Ketik ulang Password Baru">
                                    </div>
                                </div>

                                <div class=" row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn  btn-outline-primary rounded-pill"><i
                                                class="fa-solid fa-floppy-disk"></i>&nbsp;
                                            {{ __('Simpan') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <p class="h3 font-weight-bold mb-3">Reset Penerimaan Beasiswa</p>
            <div class="card rounded-md myshadow">
                <div class="card-body">
                    <p class="font-weight-bold">Apa yang akan terjadi?</p>
                    <ul class="mb-3" style="padding-left: 1rem;">
                        <li>Seluruh data Pengguna akan dihapus.</li>
                        <li>Seluruh data Administrasi, Wawancara, dan Penugasan akan dihapus.</li>
                        <li>Seluruh data Periode Beasiswa akan dihapus.</li>
                        <li>Data akun Admin akan di atur ulang seperti awal (Default).<br>Default Email:
                            admin@gmail.com<br>Default Password: <span id="passwordText"
                                style="cursor: pointer">********</span></li>


                    </ul>
                    <form id="formResetBeasiswa" method="POST" action="{{ route('reset.beasiswa') }}">
                        @csrf
                        <button id="resetBeasiswaAlert" class="btn btn-outline-danger text-nowrap pr-3 rounded-pill">
                            <i class="fa-solid fa-recycle"></i>&nbsp; Reset Penerimaan Beasiswa
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger mx-2',
                    cancelButton: 'btn btn-secondary mx-2'
                },
                buttonsStyling: false
            })

            $(document).on('click', '#resetBeasiswaAlert', function(e) {
                e.preventDefault();
                swalWithBootstrapButtons.fire({
                    title: "Anda yakin ingin mereset Beasiswa ?",
                    //  (" + userid + ")
                    text: "Data Pengguna, Administrasi, Wawancara, Penugasan dan Periode akan dihapus.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("formResetBeasiswa").submit();
                    } else(
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    )
                })
            })
        </script>

        <script type="text/javascript">
            $('.custom-file input').change(function(e) {
                var files = [];
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    files.push($(this)[0].files[i].name);
                }
                $(this).next('.custom-file-label').html(files.join(', '));
            });
        </script>

        <script>
            function previewImage() {
                const image = document.querySelector('#Foto');
                const imgPreview = document.querySelector('.img-preview');

                imgPreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }
        </script>

        <script>
            document.getElementById("passwordText").addEventListener("click", function(e) {
                // element.classList.toggle("dark-mode");
                if (e.target.textContent === "********") {
                    e.target.textContent = "12345678";
                } else {
                    e.target.textContent = "********";
                }
            });
        </script>
    @endsection
