@extends('view-admin.layouts.app')
@section('titlepage')
    <title>Dashboard Beasiswa Sariraya</title>
@endsection
@section('title')
    <h4 class="m-0 p-0">Dashboard</h4>
@endsection
@section('content')
    <div class="container-fluid px-3">
        <!-- Main content -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Edit Admin
                </div>
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
                                        class="col-md-4 col-form-label text-right">{{ __('Foto Profil') }}</label>
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
                                    <label for="name" class="col-md-4 col-form-label text-right">{{ __('Name') }}</label>

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
                                        class="col-md-4 col-form-label text-right">{{ __('E-Mail Address') }}</label>

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
                                        class="col-md-4 col-form-label text-right">{{ __('Password') }}</label>

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
                                        class="col-md-4 col-form-label text-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" autocomplete="off"
                                            placeholder="Ketik ulang Password Baru">
                                    </div>
                                </div>

                                <div class=" row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
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
            <form id="formResetBeasiswa" method="POST" action="{{ route('reset.beasiswa') }}">
                @csrf
                <a type="button" id="resetBeasiswaAlert" class="btn btn-dark text-nowrap pr-3 mb-3 text-danger">
                    <i class="fa-solid fa-recycle"></i>&nbsp; Reset Penerimaan Beasiswa
                </a>
            </form>
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
    @endsection
