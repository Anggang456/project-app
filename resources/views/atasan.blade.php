<div class="container-fluid">
    <div class="row">
      <div class="col-12 mb-3">
        <div class="card bg-dark text-light">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <h6 class="fw-bold">Pemesanan Kendaraan</h6>
            </div>
            <hr>
            <div class="table-responsive" style="height: 180px;">
              <table class="table table-dark overflow-x-scroll">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col" style="white-space: nowrap;">Nomor Telepon</th>
                    <th scope="col" style="white-space: nowrap;">Nama Driver</th>
                    <th scope="col" style="white-space: nowrap;">Nama Kendaraan</th>
                    <th scope="col" style="white-space: nowrap;">Konsumsi BBM</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                
                  @foreach($booking as $booking)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $booking->nama }}</td>
                    <td>{{ $booking->telp }}</td>
                    <td>{{ $booking->driver->nama }}</td>
                    <td>{{ $booking->venichle->nama }} ({{ $booking->venichle->type }})</td>
                    <td>{{ $booking->status }}</td> 
                    <td><button data-bs-toggle="modal" data-bs-target="#modal-view-{{ $booking->id }}" class="btn btn-outline-light py-2">Update</button></td>
                    @include('update')
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-5 col-lg-3 mb-3">
        <div class="card bg-dark text-light">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h6 class="fw-bold">Total Kendaraan</h6>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center px-3">
              <span id="vehicleCount" class="fw-bold" style="font-size: 128px;">{{ $venichle_count }}</span>
              <i class="fa-solid fa-car d-none d-sm-block" style="font-size: 48px;"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-lg-9 mb-3">
        <div class="card bg-dark text-light overflow-y-auto overflow-x-auto">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h6 class="fw-bold">Jadwal Service Kendaraan</h6>
            </div>
            <hr>
            <div class="table-responsive" style="height: 190px;">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Type</th>
                    <th scope="col">Plat Nomor</th>
                    <th scope="col">Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($service as $service)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $service->type }}</td>
                    <td>{{ $service->nomor }}</td>
                    <td style="white-space: nowrap;">{{ $service->service }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-lg-9 mb-3">
        <div class="card bg-dark text-light">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h6 class="fw-bold">Riwayat Pemakaian Kendaraan</h6>
            </div>
            <hr>
            <div class="table-responsive" style="height: 265px;">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col" style="white-space: nowrap;">Nomor Telepon</th>
                    <th scope="col" style="white-space: nowrap;">Nama Driver</th>
                    <th scope="col" style="white-space: nowrap;">Nama Kendaraan</th>
                    <th scope="col" style="white-space: nowrap;">Konsumsi BBM</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($history as $history)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $history->nama }}</td>
                    <td>{{ $history->telp }}</td>
                    <td>{{ $history->driver->nama }}</td>
                    <td>{{ $history->venichle->nama }} ({{ $booking->venichle->type }})</td>
                    <td>{{ $history->konsumsi }} L</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-lg-3 mb-3">
        <div class="card bg-dark text-light">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h6 class="fw-bold">Ditolak / Disetujui</h6>
            </div>
            <hr>
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      var xValues = ["Ditolak", "Disetujui"];
      var yValues = ["{{ $rejected_count }}", "{{ $approve_count }}"];
      var barColors = [
        "#b91d47",
        "#00aba9",
      ];

      new Chart("myChart", {
        type: "doughnut",
        data: {
          labels: xValues,
          datasets: [{
            backgroundColor: barColors,
            data: yValues
          }]
        },
        options: {
          title: {
            display: true,
            text: "Ditolak / Disetujui"
          }
        }
      });

      document.addEventListener('DOMContentLoaded', function() {
        const endValue = parseInt(document.getElementById('vehicleCount').textContent);
        const duration = 2500;
        let start = 0;
        const stepTime = Math.max(1, duration / endValue);

        const counter = setInterval(() => {
          start += 1;
          document.getElementById('vehicleCount').textContent = start;
          if (start === endValue) clearInterval(counter);
        }, stepTime);
      });
    </script>