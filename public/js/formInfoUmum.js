var getUrl = window.location;
var base_url = getUrl.protocol + "//" + getUrl.host + '/';

$(function () {
    tomap()
})


function delFotoSpot(fileId) {
    Swal.fire({
        text: "Apa kamu yakin?",
        icon: "warning",
        buttonsStyling: !1,
        showCancelButton: true,
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak",
        customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-secondary" }
    }).then(
        (function (t) {
            if (t.isConfirmed) {
                $.post({
                    url: base_url + 'pendamping/delFotoSpot',
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                    data: {
                        idpemicuan: $('#id_prapemicuan').val(),
                        fileId: fileId,
                    },
                    error: function (err) {
                        Swal.fire({
                            text: err.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok",
                            customClass: { confirmButton: "btn btn-primary" }
                        })
                    },
                    success: function (data) {
                        //console.log(data)
                        if (data.status) {
                            Swal.fire({
                                text: "Berhasil!",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok",
                                customClass: { confirmButton: "btn btn-primary" }
                            }).then(
                                (function (t) {
                                    if (t.isConfirmed) {
                                        location.reload()
                                    }

                                })
                            )
                        }
                    }
                })
            }
        }))


}

function tomap() {
    $.get(base_url + 'pendamping/villageView',
        { id: $('#id_prapemicuan').val() },
        function (res) {
            fetch('/banyuwangi.json')
                .then(response => response.json())
                .then(data => {
                    var dist = data.features.filter(e => e.properties.district_code === 'id' + res.iddist).filter(e => e.properties.village_code === 'id' + res.idvill)
                    var coor = [
                        dist[0].geometry.coordinates[0][0][0][1], 
                        dist[0].geometry.coordinates[0][0][0][0]]
                    const map = L.map('map').setView(coor, 11.4);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: ''
                    }).addTo(map);


                    L.geoJSON(dist, {
                        style: {
                            color: 'blue',
                            weight: 0.3,
                            fillColor: 'lightgreen',
                            fillOpacity: 0.2
                        }
                    }).addTo(map);

                    let marker = res.latlong != null ? L.marker(res.latlong).addTo(map) : null;

                    map.on('click', function (e) {
                        const lat = e.latlng.lat;
                        const lng = e.latlng.lng;

                        // Hapus marker lama jika ada
                        if (marker) {
                            map.removeLayer(marker);
                        }

                        // Tambahkan marker baru
                        marker = L.marker([lat, lng]).addTo(map)
                        $('#lat').val(lat)
                        $('#long').val(lng)
                    });

                })
                .catch(error => console.error('Gagal load file JSON:', error));
        });
}

Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("#dokumentasi-1", {
    url: base_url + 'pendamping/saveInfoUmum', // Set the url for your upload script location
    paramName: "foto_spot_pembuangan",
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 10,
    maxFiles: 10,
    headers: {
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
    },
});


//form pra pemicuan
$('#forminfoumum').submit(function (e) {
    e.preventDefault()
    t = document.getElementById("infoUmumbtn")
    var dataForm = new FormData(this);

    myDropzone.files.forEach(file => {
        dataForm.append('foto_spot_pembuangan[]', file);
    });

    myDropzone.processQueue();

    $.ajax({
        url: base_url + "pendamping/saveInfoUmum",
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
        data: dataForm,
        dataType: 'json',
        beforeSend: function () {
            t.setAttribute("data-kt-indicator", "on");
            t.disabled = !0
        },
        error: function (err) {
            t.removeAttribute("data-kt-indicator")
            t.disabled = !1
            //console.log(err)
            var error = err.responseJSON.errors
            if (error) {
                $('.rw').html(error.rw)
                $('.pendidikan').html(error.pendidikan)
                $('.pekerjaan').html(error.pekerjaan)
                $('.kelembagaan').html(error.kelembagaan)
                $('.nama_tokoh').html(error.nama_tokoh)
                $('.no_hp_tokoh').html(error.no_hp_tokoh)
            }
            else {
                swal('Error!', 'Something went wrong', 'error', 'btn-danger')
            }
        },
        success: function (data) {
            var conf = data.status

            if (conf) {
                t.removeAttribute("data-kt-indicator")
                t.disabled = !1
                Swal.fire({
                    text: "Berhasil!",
                    icon: "success",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok",
                    customClass: { confirmButton: "btn btn-primary" }
                }).then(
                    (function (t) {
                        if (t.isConfirmed) {
                            window.location.href = base_url + "kategori-pemicuan/" + $('#id_prapemicuan').val();
                            //location.reload()
                        }

                    })
                )
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
})
