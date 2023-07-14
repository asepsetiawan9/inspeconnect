@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="container position-relative ">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <div for="filter2" class="text-white text-sm pb-2 text-bold">Kecamatan:</div>
                        <select class="form-select" id="filter2" onchange="filterByKecamatan()">
                            <option selected value="kec_all">Pilih Kecamatan</option>
                            @foreach ($kecLabels as $index => $kecLabel)
                                <option value="{{ $kecId[$index] }}">{{ $kecLabel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div for="filter3 " class="text-white text-sm pb-2 text-bold">Tahun:</div>
                        <select class="form-select" id="filter3" onchange="filterByKecamatan()" name="year">
                            <option selected value="all">Pilih Tahun</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="pb-3 text-bold text-white">Dashboard Perumahan Kabupaten Garut
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-2">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-xs mb-0 text-uppercase font-weight-bold">JUMLAH RUMAH</p>
                            <h5 class="font-weight-bolder" id="jumlah_rumah">
                                {{ number_format($latestPopulation->jumlah_penduduk ?? 0) }}
                            </h5>
                            <p class="mb-0">
                                Jiwa
                            </p>
                        </div>
                    </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-xs mb-0 text-uppercase font-weight-bold">JUMLAH KK</p>
                                <h5 class="font-weight-bolder" id="jml_kk">
                                    {{ number_format($latestPopulation->jumlah_kk ?? 0) }}
                                </h5>
                                <p class="mb-0">
                                    Kepala Keluarga
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="fa fa-user text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-xs mb-0 text-uppercase font-weight-bold">Jumlah Rumah Tidak Sehat dan Tidak Layak Huni</p>
                                <h5 class="font-weight-bolder" id="jml_tidak_layak">
                                    {{ number_format($jml_pen_miskin ?? 0) }}
                                </h5>
                                <p class="mb-0">
                                    Rumah
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="fa fa-usd text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-xs mb-0 text-uppercase font-weight-bold">Jumlah Rumah Sehat dan layak Huni </p>
                                <h5 class="font-weight-bolder" id="jml_layak">
                                    0
                                </h5>
                                <p class="mb-0">
                                    Rumah
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fa fa-percent text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card z-index-2">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Perkembangan Jumlah Rumah Tidak Layak Huni</h6>

                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="myChart" class="chart-canvas" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="card mt-3 p-3">
                <h5>Peta Sebaran</h5>
                <div id="map"></div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card ">
                <div class="chart">
                    <canvas id="horizonChart" class="chart-canvas" height="500"></canvas>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
</div>
@endsection

@push('js')
<script src="./assets/js/plugins/chartjs.min.js"></script>
<script>
 document.addEventListener('DOMContentLoaded', function () {
    const ctx1 = document.getElementById('myChart').getContext('2d');
    const ctx2 = document.getElementById('horizonChart').getContext('2d');
    let chart1, chart2;
    let labels = <?php echo json_encode($years); ?>;
    let labels2 = <?php echo json_encode($namaKecamatan); ?>;
    let data1 = <?php echo json_encode($dataTidakLayakCountByYear); ?>;
    let data2 = <?php echo json_encode($dataLayakCountByYear); ?>;
    let data3 = <?php echo json_encode($kec_value_rm_tidak_layak); ?>;
    let data4 = <?php echo json_encode($kec_value_rm_layak); ?>;
  

    function createChart1(labels, data, data2) {
        // console.log('ini data', data2);
        chart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Rumah Tidak Layak',
                    data: data,
                    backgroundColor: 'rgba(255, 99, 132, 0.8)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Rumah Layak',
                    data: data2,
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                hover: {
                    mode: 'index',
                    intersect: false
                },
                animation: {
                    duration: 5000
                }
        }
    });

    return chart1;

    }

    function createChart2(labels, data, data2) {
        chart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Rumah Tidak Layak',
                    data: data,
                    backgroundColor: 'rgba(255, 99, 132, 0.8)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Rumah Layak',
                    data: data2,
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
        },
            options: {
                indexAxis: 'y',
                hover: {
                    mode: 'index',
                    intersect: false
                },
                animation: {
                    duration: 5000
                }
            },
            
        });

        return chart2;
    }

    chart1 = createChart1(labels, data1, data2);
    chart2 = createChart2(labels2, data3, data4);

    function filterByKecamatan() {
        // const selectElement1 = document.getElementById('filter1');
        // const selectedStatus = selectElement1.value;
        const selectElement = document.getElementById('filter2');
        const selectedKecId = selectElement.value;
        const selectedKecLabel = selectElement.options[selectElement.selectedIndex].text;
        const selectedYear = document.getElementById('filter3').value;

        const data = {
            // status: selectedStatus,
            kecId: selectedKecId,
            kecLabel: selectedKecId === 'jumlah_penduduk' ? 'jumlah_penduduk' : selectedKecLabel,
            year: selectedYear
        };

        // Send data using AJAX
        $.ajax({
            url: '{{ route("dashboard.filterKecamatan") }}',
            method: 'GET',
            data: data,
            success: function (response) {
                const message = response.message;
                labels = message.label_tahun;
                labels2 = message.namaKecamatan;

                data1 = message.jml_tidak_layak_tahun;
                data2 = message.jml_layak_tahun;

                chart1.data.labels = labels;
                chart1.data.datasets[0].data = data1;
                chart1.data.datasets[1].data = data2;
                chart1.update();

                //chart2
                
                // console.log(labels2);
                data3 = message.labels2 = message.kec_value_rm_tidak_layak;
                data4 =  message.labels2 = message.kec_value_rm_layak;
                
                chart2.data.labels = labels2;
                chart2.data.datasets[0].data = data3;
                chart2.data.datasets[1].data = data4;
                chart2.update();

                document.getElementById('jumlah_rumah').innerText = message.jumlah_rumah;
                document.getElementById('jml_tidak_layak').innerText = message.jml_tidak_layak;
                document.getElementById('jml_layak').innerText = message.jml_layak;
                document.getElementById('jml_kk').innerText = message.jml_kk;
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
    // document.getElementById('filter1').addEventListener('change', filterByKecamatan);
    document.getElementById('filter2').addEventListener('change', filterByKecamatan);
    document.getElementById('filter3').addEventListener('change', filterByKecamatan);
});

</script>

@endpush


@push('js')
<script>
    var map = L.map('map').setView([-7.2278, 107.9087], 10);
var colors = ['#ffd1d1', '#ffa3a3', '#fc5151', '#ff0000', '#a60202'];
var legend;

// Tambahkan layer peta dari OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Fungsi untuk memperbarui tampilan geojson dengan filter tahun dan variabel
function updateGeojson(year, variable) {
    fetch(`/api/geojson?year=${year}&variable=${variable}`)
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            console.log(data);
            // Menghapus layer geojson yang ada sebelumnya
            if (geojsonLayer) {
                map.removeLayer(geojsonLayer);
            }

            // Mendapatkan semua nilai dari setiap kecamatan
            var allValues = data.features.map(function (feature) {
                return feature.properties.nilai;
            });

            // Menghitung rentang nilai secara dinamis
            var min = Math.min.apply(null, allValues);
            var max = Math.max.apply(null, allValues);
            var rangeSize = Math.ceil((max - min + 1) / 5); // Jumlah rentang diatur menjadi 5

            // Definisikan rentangan nilai dan warna yang sesuai
            var ranges = [];
            for (var i = 0; i < 5; i++) {
                var rangeMin = min + i * rangeSize;
                var rangeMax = rangeMin + rangeSize - 1;
                ranges.push({
                    min: rangeMin,
                    max: rangeMax,
                    color: colors[i % colors.length]
                });
            }

            geojsonLayer = L.geoJSON(data, {
                style: function (feature) {
                    // Mendapatkan nilai dari setiap kecamatan
                    var nilai = feature.properties.nilai;

                    // Tentukan warna berdasarkan rentangan nilai
                    var color = 'gray'; // Warna default
                    for (var i = 0; i < ranges.length; i++) {
                        if (nilai >= ranges[i].min && nilai <= ranges[i].max) {
                            color = ranges[i].color;
                            break;
                        }
                    }

                    // Kembalikan style dengan warna yang sesuai
                    return {
                        fillColor: color,
                        color: '#000000',
                        fillOpacity: 1,
                        weight: 1
                    };
                },
                onEachFeature: function (feature, layer) {
                    // Mendapatkan properti dari setiap kecamatan
                    var properties = feature.properties;

                    // Menampilkan popup saat mouse memasuki area kecamatan
                    layer.on('mouseover', function (e) {
                        var tahun = properties.tahun !== null ? properties.tahun : 'Semua Tahun';
                        var variabel = properties.variabel !== 'all' ? properties.variabel : 'Semua Variabel';
                        variabel = properties.variabel === null ? 'TIDAK BERSEKOLAH' : variabel;

                        layer.bindPopup(
                            "<b>Tahun: </b>" + tahun +
                            // "<br><b>Variabel: </b>" + variabel +
                            "<br><b>Kecamatan: </b>" + properties.kecamatan +
                            "<br><b>Kabupaten: </b>" + properties.nmkab +
                            "<br><b>Provinsi: </b>" + properties.nmprov +
                            "<br><b>Jumlah: </b>" + properties.nilai
                        ).openPopup();
                    });

                    // Menutup popup saat mouse meninggalkan area kecamatan
                    layer.on('mouseout', function (e) {
                        layer.closePopup();
                    });
                }
            });

            geojsonLayer.addTo(map);

            // Menghapus legenda yang ada sebelumnya
            if (legend) {
                legend.remove();
            }

            // Membuat legenda secara dinamis
            legend = L.control({ position: 'bottomleft' });

            legend.onAdd = function (map) {
                var div = L.DomUtil.create('div', 'legend');
                var labels = [];

                // Menampilkan label untuk setiap rentangan nilai
                for (var i = 0; i < ranges.length; i++) {
                    var range = ranges[i];
                    var color = range.color;

                    labels.push(
                        '<i style="background:' + color + '"></i> ' +
                        range.min + ' - ' + range.max
                    );
                }

                div.innerHTML = labels.join('<br>');
                return div;
            };

            legend.addTo(map);
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
}

// Mendapatkan elemen select untuk filter variabel
var filterVarSelect = document.getElementById('filterVar');
// Mendapatkan elemen select untuk filter tahun
var filterYearSelect = document.getElementById('filter3');

// Menambahkan event listener saat nilai filter variabel berubah
filterVarSelect.addEventListener('change', function () {
    var selectedVariable = this.value;
    var selectedYear = filterYearSelect.value;
    updateGeojson(selectedYear, selectedVariable);
});

// Menambahkan event listener saat nilai filter tahun berubah
filterYearSelect.addEventListener('change', function () {
    var selectedYear = this.value;
    var selectedVariable = filterVarSelect.value;
    updateGeojson(selectedYear, selectedVariable);
});

// Memuat geojson awal saat halaman dimuat
var geojsonLayer;
updateGeojson('all', 'all');


</script>

@endpush

