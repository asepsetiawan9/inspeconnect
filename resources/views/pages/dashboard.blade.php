@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="container position-relative ">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div for="filter1 " class="text-white text-sm pb-2 text-bold">Tampilkan Berdasarkan:</div>
                        <select class="form-select" id="filter1">
                            <option selected>Jumlah Penduduk</option>
                            <option value="1">One</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div for="filter2 " class="text-white text-sm pb-2 text-bold">Kecamatan:</div>
                        <select class="form-select" id="filter2">
                            <option selected>Jumlah Penduduk</option>
                            <option value="1">One</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div for="filter3 " class="text-white text-sm pb-2 text-bold">Tahun:</div>
                        <select class="form-select" id="filter3">
                            <option selected>Jumlah Penduduk</option>
                            <option value="1">One</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="pb-3 text-bold text-white">Dashboard Kemiskinan Berdasarkan Jumlah Penduduk Kabupaten Garut
                Tahun 2022
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-2">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-xs mb-0 text-uppercase font-weight-bold">JUMLAH PENDUDUK</p>
                                <h5 class="font-weight-bolder">
                                    2.759.490
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
                                <h5 class="font-weight-bolder">
                                    915.327
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
                                <p class="text-xs mb-0 text-uppercase font-weight-bold">JUMLAH PENDUDUK MISKIN</p>
                                <h5 class="font-weight-bolder">
                                    1.263.220
                                </h5>
                                <p class="mb-0">
                                    Jiwa
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
                                <p class="text-xs mb-0 text-uppercase font-weight-bold">PERSENTASE PENDUDUK MISKIN</p>
                                <h5 class="font-weight-bolder">
                                    10,42
                                </h5>
                                <p class="mb-0">
                                    %
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
                    <h6 class="text-capitalize">Perkembangan Persentase Penduduk Miskin</h6>

                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="myChart" class="chart-canvas" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row gap-3 w-100 mt-3">
                <div class="bg-danger rounded-3 p-3 w-100 text-white text-bold">Desil 1
                    <div class="fs-4 text-bold">318.704</div>
                </div>
                <div class="bg-desil-2 rounded-3 p-3 w-100 text-white text-bold">Desil 2
                    <div class="fs-4 text-bold">362.568</div>
                </div>
                <div class="bg-desil-3 rounded-3 p-3 w-100 text-white text-bold">Desil 3
                    <div class="fs-4 text-bold">305.042</div>
                </div>
                <div class="bg-desil-4 rounded-3 p-3 w-100 text-white text-bold">Desil 4
                    <div class="fs-4 text-bold">276.906</div>
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
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['2017', '2018', '2019', '2020', '2021', '2022'],
                datasets: [{
                    label: '#',
                    data: [9, 8, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

</script>
@endpush

@push('js')
<script src="./assets/js/plugins/chartjs.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('horizonChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Garut Kota",
                    "Karangpawitan",
                    "Wanaraja ",
                    "Tarogong Kaler",
                    "Tarogong Kidul ",
                    "Banyuresmi ",
                    "Samarang ",
                    "Pasirwangi ",
                    "Leles ",
                    "Kadungora ",
                    "Leuwigoong ",
                    "Cibatu ",
                    "Kersamanah ",
                    "Malangbong",
                    "Sukawening ",
                    "Karangtengah ",
                    "Bayongbong ",
                    "Cigedug",
                    "Cilawu ",
                    "Cisurupan ",
                    "Sukaresmi ",
                    "Cikajang ",
                    "Banjarwangi ",
                    "Singajaya",
                    "Cihurip ",
                    "Peundeuy ",
                    "Pameungpeuk ",
                    "Cisompet ",
                    "Cibalong ",
                    "Cikelet ",
                    "Bungbulang ",
                    "Mekarmukti ",
                    "Pakenjeng ",
                    "Pamulihan ",
                    "Cisewu ",
                    "Caringin ",
                    "Talegong ",
                    "Bl. Limbangan ",
                    "Selaawi ",
                    "Cibiuk ",
                    "Pangatikan ",
                    "Sucinaraja",
                ],
                datasets: [{
                    label: '#',
                    data: [9, 8, 3, 5, 2, 9, 8, 3, 5, 2, 9, 8, 3, 5, 2, 9, 8, 3, 5, 2, 9, 8, 3,
                        5, 2, 9, 8, 3, 5, 2, 9, 8, 3, 5, 2, 9, 8, 3, 5, 2, 6, 2
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
            }
        });
    });

</script>
@endpush

@push('js')
<script>
    // Inisialisasi peta
    var map = L.map('map').setView([-7.2278, 107.9087], 10);
    var colors = ['#ffd1d1', '#ffa3a3', '#fc5151', '#ff0000', '#a60202'];

    // Tambahkan layer peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Tambahkan geojson Kabupaten Garut
    fetch('/geojson/kecamatan.geojson')
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
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

        var geojsonLayer = L.geoJSON(data, {
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
                    layer.bindPopup(
                        "<b>Kecamatan: </b>" + properties.kecamatan +
                        "<br><b>Kabupaten: </b>" + properties.nmkab +
                        "<br><b>Provinsi: </b>" + properties.nmprov +
                        "<br><b>Keterangan: </b>" + properties.keterangan +
                        "<br><b>Nilai: </b>" + properties.nilai
                    ).openPopup();
                });

                // Menutup popup saat mouse meninggalkan area kecamatan
                layer.on('mouseout', function (e) {
                    layer.closePopup();
                });
            }
        });

        geojsonLayer.addTo(map);

        // Membuat legenda secara dinamis
        var legend = L.control({ position: 'bottomleft' });

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
    });


    // Fungsi untuk mendapatkan warna acak
    // function getRandomColor() {
    //     var letters = '0123456789ABCDEF';
    //     var color = '#';
    //     for (var i = 0; i < 6; i++) {
    //         color += letters[Math.floor(Math.random() * 16)];
    //     }
    //     return color;
    // }

</script>

@endpush
