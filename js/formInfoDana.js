var getUrl = window.location;
var base_url = getUrl.protocol + "//" + getUrl.host + '/';


//$("#tanggal_pemicuan").flatpickr();

// $(function () {
//     getDist()
// })

//to select district
// function getDist() {
//     $.get('https://www.emsifa.com/api-wilayah-indonesia/api/districts/3510.json',
//         function (e) {
//             var html = '<option></option>'
//             for (let i in e) {
//                 html += '<option value="' + e[i].id + ';' + e[i].name + '">' + e[i].name + '</option>'
//             }
//             $('#kecamatan').html(html)
//         }
//     )
// }

//to village
// $('#kecamatan').on('change', function (e) {
//     var idVillage = $('#kecamatan').val().split(';')[0]
//     $.get('https://www.emsifa.com/api-wilayah-indonesia/api/villages/' + idVillage + '.json',
//         function (e) {
//             var html = '<option></option>'
//             for (let i in e) {
//                 html += '<option value="' + e[i].id + ';' + e[i].name + '">' + e[i].name + '</option>'
//             }
//             $('#desa').html(html)
//         }
//     )
// })
// Dropzone.autoDiscover = false;
// var myDropzone = new Dropzone("#dokumentasi-1", {
//     url: base_url + 'addPemicuan', // Set the url for your upload script location
//     paramName: "dokumentasi",
//     acceptedFiles: 'image/*',
//     addRemoveLinks: true,
//     autoProcessQueue: false,
//     uploadMultiple: true,
//     parallelUploads: 10,
//     maxFiles: 10,
//     headers: {
//         'X-CSRF-TOKEN': $('input[name="_token"]').val()
//     },
// });


//form pra pemicuan
$('#forminfodana').submit(function (e) {
    e.preventDefault()
    t = document.getElementById("infoDanabtn")
    var dataForm = new FormData(this);
    $.ajax({
        url: base_url + "pendamping/saveInfoDana",
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
