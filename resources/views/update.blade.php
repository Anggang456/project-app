<div class="modal fade" id="modal-view-{{$booking->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row text-dark">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" value="{{ $booking->nama }}" readonly id="floatingInput" name="nama" required placeholder="Nama Lengkap">
                            <label for="floatingInput">Nama Lengkap</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" value="{{ $booking->telp }}" readonly name="telp" required placeholder="Nomor Telepon">
                            <label for="floatingInput">Nomor Telepon</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" disabled name="type" aria-label="Floating label select example">
                                <option selected>{{ $booking->venichle->nama }} ({{ $booking->venichle->type }})</option>
                            </select>
                            <label for="floatingSelect">Tipe Kendaraan</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select text-dark" name="driver" disabled id="floatingSelect" required aria-label="Floating label select example">
                                <option selected>{{ $booking->driver->nama }}</option>
                            </select>
                            <label for="floatingSelect">Driver</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="floatingInput" value="{{ $booking->tgl_mulai }}" readonly name="tgl_mulai" required placeholder="name@example.com">
                            <label for="floatingInput">Tanggal Mulai</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="floatingInput" value="{{ $booking->tgl_selesai }}" readonly name="tgl_selesai" required placeholder="name@example.com">
                            <label for="floatingInput">Tanggal Selesai</label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-0">
                    <?php

                    use App\Models\Approve;

                    $existingApproval = Approve::where('booking_id', $booking->id)->where('user_id',Auth::user()->id)->first(); ?>
                    @if($existingApproval)
                    <button disabled class="btn btn-outline-light py-3 px-5">{{ $existingApproval->status }}</button>
                    @else
                    <a href="{{ route('app.approve',$booking->id) }}" class="btn btn-outline-light py-3 px-5">Setujui</a>
                    <a href="{{ route('app.reject',$booking->id) }}" class="btn btn-outline-danger py-3 px-5">Tolak</a>
                    @endif
                </div>
            </div>
        </div>
    </div>