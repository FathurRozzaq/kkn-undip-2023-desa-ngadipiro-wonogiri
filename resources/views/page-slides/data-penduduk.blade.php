<li class="slider-item">
    <div class="heading">
        <h1>DATA PENDUDUK</h1>
    </div>
    <div class="cd-half-width first-slide">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="content" width="100%">
                      @include('page-slides.load-data.update-timestamp')
                      <p>Diperbarui pada : {{ updateDataPenduduk()['update_time'] }}</p>
                        <table class="table-1">
                            <thead>
                              <tr>
                                <th class="column1">Nama Lengkap</th>
                                <th class="column2">Jenis Kelamin</th>
                                <th class="column3">Status Kawin</th>
                                <th class="column4">Kedudukan dalam Keluarga</th>
                                <th class="column5">No. KTP</th>
                                <th class="column6">Nomor KK</th>
                                <th class="column7">Tempat Lahir</th>
                                <th class="column8">Tanggal Lahir</th>
                                <th class="column9">Agama</th>
                                <th class="column10">Alamat</th>
                                <th class="column11">RW</th>
                                <th class="column12">RT</th>
                                <th class="column13">Pendidikan</th>
                                <th class="column14">Pekerjaan</th>
                                <th class="column15">WNI/WNA</th>
                                <th class="column16">Darah</th>
                                <th class="column17">Cacat</th>
                              </tr>
                            </thead>
                            <tbody id="data-table-body">
                              <?php
                                $data = DB::select('SELECT * FROM data_penduduk LIMIT 20');
                                foreach ($data as $key => $data) {
                              ?>
                                <tr>
                                    <td class="column1">{{ $data->nama_lengkap }}</td>
                                    <td class="column2">{{ $data->jenis_kelamin }}</td>
                                    <td class="column3">{{ $data->status_kawin }}</td>
                                    <td class="column4">{{ $data->kedudukan_dalam_keluarga }}</td>
                                    <td class="column5">{{ $data->no_ktp }}</td>
                                    <td class="column6">{{ $data->nomor_kk }}</td>
                                    <td class="column7">{{ $data->tempat_lahir }}</td>
                                    <td class="column8">{{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d/m/Y') }}</td>
                                    <td class="column9">{{ $data->agama }}</td>
                                    <td class="column10">{{ $data->alamat }}</td>
                                    <td class="column11">{{ $data->rw }}</td>
                                    <td class="column12">{{ $data->rt }}</td>
                                    <td class="column13">{{ $data->pendidikan }}</td>
                                    <td class="column14">{{ $data->pekerjaan }}</td>
                                    <td class="column15">{{ $data->kewarganegaraan }}</td>
                                    <td class="column16">{{ $data->darah }}</td>
                                    <td class="column17">{{ $data->cacat }}</td>
                                </tr>
                              <?php
                                }
                              ?>
                            </tbody>
                          </table>
                          <button id="load-more">Lihat Semua</button>
                          <style>
                            #load-more {
                              background: none;
                              border: none;
                              color: blue;
                              text-decoration: underline;
                              cursor: pointer;
                            }
                          </style>
                    </section>
                </div>
            </div>
        </div>
    </div>
</li>

<style>
    .table-1 th, 
    .table-1 td{
        font-size: 12px; 
        border: 1px solid black;
        width: 10%;
        text-align: center;
    }

    .table-1 .column1{
        width: 20%;
    }
</style>

<script>
    document.getElementById("load-more").addEventListener("click", function() {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var dataRows = JSON.parse(xhr.responseText);
          var tableBody = document.getElementById("data-table-body");
          for (var i = 0; i < dataRows.length; i++) {
            var newRow = document.createElement("tr");
            newRow.innerHTML = `
            <td class="column1">${dataRows[i].nama_lengkap}</td>
            <td class="column2">${dataRows[i].jenis_kelamin}</td>
            <td class="column3">${dataRows[i].status_kawin}</td>
            <td class="column4">${dataRows[i].kedudukan_dalam_keluarga}</td>
            <td class="column5">${dataRows[i].no_ktp}</td>
            <td class="column6">${dataRows[i].nomor_kk}</td>
            <td class="column7">${dataRows[i].tempat_lahir}</td>
            <td class="column8">${dataRows[i].tanggal_lahir}</td>
            <td class="column9">${dataRows[i].agama}</td>
            <td class="column10">${dataRows[i].alamat}</td>
            <td class="column11">${dataRows[i].rw}</td>
            <td class="column12">${dataRows[i].rt}</td>
            <td class="column13">${dataRows[i].pendidikan}</td>
            <td class="column14">${dataRows[i].pekerjaan}</td>
            <td class="column15">${dataRows[i].kewarganegaraan}</td>
            <td class="column16">${dataRows[i].darah}</td>
            <td class="column17">${dataRows[i].cacat}</td>
            `;
            tableBody.appendChild(newRow);
          }
          document.getElementById("load-more").style.display = "none";
        }
      };
      xhr.open("GET", "/load-data/semua-penduduk", true);
      xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
      xhr.send();
    });
  </script>