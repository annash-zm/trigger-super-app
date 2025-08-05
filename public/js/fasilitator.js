var getUrl = window.location;
var base_url = getUrl.protocol + "//" + getUrl.host + '/';


function delFile(type, fileId) {
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
                    url: base_url + 'fasilitator/deleteFile',
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                    data: {
                        idpemicuan : $('#idpemicuan').val(),
                        fileId: fileId,
                        type : type
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
                        console.log(data)
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
        })
    )
}

$('#search_desa').on('keyup', function () {
    let query = $(this).val();
    console.log(query)
    $.ajax({
        url: base_url + "fasilitator/search_desa",
        type: "GET",
        data: { query: query },
        success: function (response) {
            $('.content-listdesa').html(response)
        }
    });
});

Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("#dokumentasi-1", {
    url: base_url + 'fasilitator/hasilPemicuan', // Set the url for your upload script location
    paramName: "dokumentasi",
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
$('#hasilpemicuan').submit(function (e) {
    e.preventDefault()

    var dataForm = new FormData(this);
    myDropzone.files.forEach(file => {
        dataForm.append('dokumentasi[]', file);
    });

    myDropzone.processQueue();

    t = document.getElementById("saveHasilPemicuan")
    $.ajax({
        url: base_url + "fasilitator/hasilPemicuan",
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
                $('.rt').html(error.rt)
                $('.rw').html(error.rw)
                $('.hadir').html(error.jml_peserta)
                $('.langganan').html(error.jml_berlangganan)
                $('.usulan').html(error.usulan_rkm)
                $('.berkas').html(error.berkas)
                $('.dokumentasi').html(error.dokumentasi)
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
                            data.url === 'back' ? window.location.href = base_url + "fasilitator/list-desa" : location.reload()
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
