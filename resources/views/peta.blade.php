<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CCTV | Jepin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .full-height {
            height: calc(100% - 56px);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Peta | Pontianak Smart City</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/dashboard') }}">Kembali <span
                            class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="map" class="full-height">
    </div>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var map = L.map('map').setView([-0.02556348919550322, 109.33408763468232], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var cctvIcon = L.icon({
            iconUrl: "{{ asset('images/marker-1614303544.png') }}",
            iconSize:     [64, 64],
            iconAnchor: [32, 64],
        });

    

        $.ajax({
            url: 'api/marker',
            type: 'GET',
            dataType: 'json',
            success: function(markers) {
                dataMarkers = markers.data;
                // console.log('data markers : ' + dataMarkers);
                callback(dataMarkers);
            }
        });

        function callback(dataMarkers) {
            for (var i = 0; i < dataMarkers.length; i++) {
                marker = dataMarkers[i];
                
                console.log(marker);
                var latitude = parseFloat(marker.latitude);
                var longitude = parseFloat(marker.longitude);
                var pin = new L.marker([latitude, longitude], {
                    icon: L.icon({
            iconUrl: "{{ asset('images/') }}/"+marker.details.icon,
            iconSize:     [64, 64],
            iconAnchor: [32, 64],
        }),
                    title: marker.nama,
                    id: marker.id
                }).bindTooltip(marker.nama, {
                    direction: 'top',
                    offset: new L.Point(0, -64)
                }).addTo(map);
                // var mark = new L.Marker([latitude, longitude], {
                //     icon: icons,
                //     title: cctv_jogja.cctv_title.toUpperCase(),
                //     id: cctv_jogja.cctv_id,
                //     url: cctv_jogja.cctv_link
                // }).bindTooltip(cctv_jogja.cctv_title.toUpperCase(), {
                //     direction: 'top',
                //     offset: new L.Point(1, -31)
                // }).addTo(map);

                // mark.on("click", function(data) {
                //     $('#element').append(`<div id=\"playerElement` + data.target.options.id + `\" style="width:100%; height:0; padding:0 0 82% 0"></div>`);
                //     CallCam('playerElement' + data.target.options.id, data.target.options.title, data.target.options.url);

                //     $('#cctv_modal').modal({
                //         backdrop: 'static',
                //         keyboard: false
                //     }, 'show');
                //     $('#cctv_title').html(data.target.options.title);

                //     $('.close').click(function() {
                //         idparent = 'playerElement' + data.target.options.id;

                //         thePlayer = WowzaPlayer.get(idparent);
                //         if (thePlayer != null) {
                //             thePlayer.destroy();
                //         }

                //         $('#' + idparent).remove();
                //         // map.setView(pemkot, 14);
                //     });
                // });
            }
        }

        // L.marker([-0.02556348919550322, 109.33408763468232], {icon: cctvIcon}).bindTooltip('CCTV 1', {
        //             direction: 'top',
        //             offset: new L.Point(1, -34)
        //         }).addTo(map);
        // L.marker([-0.020305464320408455, 109.33577440292905], {icon: cctvIcon}).bindTooltip('CCTV 2', {
        //             direction: 'top',
        //             offset: new L.Point(1, -34)
        //         }).addTo(map);

    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>