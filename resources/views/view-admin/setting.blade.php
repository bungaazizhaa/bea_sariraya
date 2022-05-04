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
            <a type="button" data-toggle="modal" data-target="#tambahPeriode" class="btn btn-dark text-nowrap pr-3 mb-3">
                <i class="fa-solid fa-plus nav-icon"></i>&nbsp; Tambah Periode
            </a>
        </div>

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

        <div class="col-12">
            <form id="formResetBeasiswa" method="POST" action="{{ route('reset.beasiswa') }}">
                @csrf
                <a type="button" id="resetBeasiswaAlert" class="btn btn-dark text-nowrap pr-3 mb-3 text-danger">
                    <i class="fa-solid fa-recycle"></i>&nbsp; Reset Penerimaan Beasiswa
                </a>
            </form>
        </div>

        {{-- ======== MODAL EDIT PERIODE ======== --}}
        <!-- Modal -->
        <div class="modal fade" id="tambahPeriode" tabindex="-1" role="dialog" aria-labelledby="tambahPeriodeLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form id="periodeForm" autocomplete="off" method="POST" action="{{ route('store.periode') }}">
                        @csrf
                        <div class="modal-header h4 text-center">
                            <p class="mb-0 w-100">Form Tambah Periode</p>
                        </div>
                        <div class="modal-body pb-1">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bg-secondary py-md-1 pb-3 px-3 rounded myshadow mb-3">
                                        <div class="row">
                                            <label for="status" class="col col-form-label text-md-right">ID
                                                Periode
                                                :</label>
                                            <div class="col-12 col-md-10">
                                                <input autocomplete="off" id="id_periode" name="id_periode"
                                                    value="{{ $getPeriodeLast + 1 }}" class="form-control mb-1">
                                                @error('id_periode')
                                                    <div class="small text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="status" class="col col-form-label text-md-right">Nama Periode
                                                :</label>
                                            <div class="col-12 col-md-10">
                                                <input autocomplete="off" id="name" name="name"
                                                    value="batch-{{ $getPeriodeLast + 1 }}" class="form-control">
                                                @error('name')
                                                    <div class="small text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="bg-secondary p-3 rounded myshadow mb-3">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="h5 mb-0 font-weight-bold">
                                                    Tahap Administrasi
                                                </p>
                                            </div>
                                        </div>
                                        </p>
                                        <hr style="border-color:#ffffff88">
                                        <p class="mb-1">Tanggal Mulai :</p>
                                        <input autocomplete="off" id="tm_adm" type="tm_adm" class="datepicker"
                                            class="form-control @error('tm_adm') is-invalid @enderror" name="tm_adm"
                                            value="{{ old('tm_adm') }}" required autocomplete="tm_adm" autofocus>

                                        @error('tm_adm')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                        <input autocomplete="off" id="ta_adm" type="ta_adm" class="datepicker"
                                            class="form-control @error('ta_adm') is-invalid @enderror" name="ta_adm"
                                            value="{{ old('ta_adm') }}" required autocomplete="ta_adm" autofocus>

                                        @error('ta_adm')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                        <input autocomplete="off" id="tp_adm" type="tp_adm" class="datepicker"
                                            class="form-control @error('tp_adm') is-invalid @enderror" name="tp_adm"
                                            value="{{ old('tp_adm') }}" required autocomplete="tp_adm" autofocus>

                                        @error('tp_adm')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="bg-secondary p-3 rounded myshadow mb-3">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="h5 mb-0 font-weight-bold">
                                                    Tahap Wawancara
                                                </p>
                                            </div>
                                        </div>
                                        </p>
                                        <hr style="border-color:#ffffff88">
                                        <p class="mb-1">Tanggal Mulai :</p>
                                        <input autocomplete="off" id="tm_wwn" type="tm_wwn" class="datepicker"
                                            class="form-control @error('tm_wwn') is-invalid @enderror" name="tm_wwn"
                                            value="{{ old('tm_wwn') }}" required autocomplete="tm_wwn" autofocus>

                                        @error('tm_wwn')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                        <input autocomplete="off" id="ta_wwn" type="ta_wwn" class="datepicker"
                                            class="form-control @error('ta_wwn') is-invalid @enderror" name="ta_wwn"
                                            value="{{ old('ta_wwn') }}" required autocomplete="ta_wwn" autofocus>

                                        @error('ta_wwn')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                        <input autocomplete="off" id="tp_wwn" type="tp_wwn" class="datepicker"
                                            class="form-control @error('tp_wwn') is-invalid @enderror" name="tp_wwn"
                                            value="{{ old('tp_wwn') }}" required autocomplete="tp_wwn" autofocus>

                                        @error('tp_wwn')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="bg-secondary p-3 rounded myshadow mb-3">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="h5 mb-0 font-weight-bold">
                                                    Tahap Penugasan
                                                </p>
                                            </div>
                                        </div>
                                        </p>
                                        <hr style="border-color:#ffffff88">
                                        <p class="mb-1">Tanggal Mulai :</p>
                                        <input autocomplete="off" id="tm_png" type="tm_png" class="datepicker"
                                            class="form-control @error('tm_png') is-invalid @enderror" name="tm_png"
                                            value="{{ old('tm_png') }}" required autocomplete="tm_png" autofocus>

                                        @error('tm_png')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Akhir :</p>
                                        <input autocomplete="off" id="ta_png" type="ta_png" class="datepicker"
                                            class="form-control @error('ta_png') is-invalid @enderror" name="ta_png"
                                            value="{{ old('ta_png') }}" required autocomplete="ta_png" autofocus>

                                        @error('ta_png')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <p class="mb-1 mt-2">Tanggal Pengumuman :</p>
                                        <input autocomplete="off" id="tp_png" type="tp_png" class="datepicker"
                                            class="form-control @error('tp_png') is-invalid @enderror" name="tp_png"
                                            value="{{ old('tp_png') }}" required autocomplete="tp_png" autofocus>

                                        @error('tp_png')
                                            <div class="small text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                        </div>
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
            $('.datepicker').each(function() {
                $(this).datepicker({
                    format: 'dd-mm-yyyy',
                    uiLibrary: 'bootstrap4',
                    iconsLibrary: 'fontawesome',
                    showRightIcon: true,
                    todayHighlight: true,
                    autoclose: true,
                });
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
