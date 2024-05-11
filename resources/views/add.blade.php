<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{ route('app.booking') }}" method="POST">
        @csrf
        @method('POST')
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pemesanan Kendaraan</h1>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('#exampleModal').modal('show');
                        });
                    </script>
                @endif
                <div class="row text-dark">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="nama" required placeholder="Nama Lengkap">
                            <label for="floatingInput">Nama Lengkap</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" name="telp" required placeholder="Nomor Telepon">
                            <label for="floatingInput">Nomor Telepon</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" name="type" aria-label="Floating label select example">
                                <option selected>--- Pilih Menu ---</option>
                                @foreach($venichle as $venichle)
                                <option value="{{ $venichle->id }}">{{ $venichle->nama }} ({{ $venichle->type }})</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Tipe Kendaraan</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select text-dark" name="driver" id="floatingSelect" required aria-label="Floating label select example">
                                <option selected>--- Pilih Menu ---</option>
                                @foreach($driver as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->nama }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Driver</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="floatingInput" name="tgl_mulai" required placeholder="name@example.com">
                            <label for="floatingInput">Tanggal Mulai</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="floatingInput" name="tgl_selesai" required placeholder="name@example.com">
                            <label for="floatingInput">Tanggal Selesai</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" name="konsumsi" required placeholder="name@example.com">
                            <label for="floatingInput">Perjalanan/KM</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select text-dark" id="floatingSelect1" name="atasan_1" required aria-label="Floating label select example">
                                <option selected>--- Pilih Menu ---</option>
                                @foreach($atasan as $atasan1)
                                <option value="{{ $atasan1->id }}">{{ $atasan1->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect1">Persetujuan 1</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select text-dark" id="floatingSelect2" name="atasan_2" required aria-label="Floating label select example">
                                <option selected>--- Pilih Menu ---</option>
                                @foreach($atasan as $atasan2)
                                <option value="{{ $atasan2->id }}">{{ $atasan2->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect2">Persetujuan 2</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" id="saveButton" class="btn btn-light">Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi</h5>
        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menyimpan data ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-outline-light" id="confirmSave">Ya, Simpan</button>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#floatingSelect1').change(function() {
        var selectedAtasan1 = $(this).val();
        $('#floatingSelect2 option').prop('disabled', false); // Reset semua pilihan menjadi aktif
        if (selectedAtasan1) {
            $('#floatingSelect2 option[value="' + selectedAtasan1 + '"]').prop('disabled', true); // Non-aktifkan pilihan yang sama dengan Persetujuan 1
        }
    });
});

$(document).ready(function() {
    $('#saveButton').click(function(e) {
        e.preventDefault(); 

        var isFormValid = true;
        $('input, select').each(function() { 
            if ($.trim($(this).val()).length == 0) {
                isFormValid = false; 
                $(this).css('border', '2px solid red'); 
                $(this).css('border', '');
            }
        });

        if (isFormValid) {
            $('#confirmationModal').modal('show');
        } else {
            alert('Mohon isi semua field yang diperlukan.');
        }
    });

    $('#confirmSave').click(function() {
        $('form').submit(); 
    });
});
</script>

