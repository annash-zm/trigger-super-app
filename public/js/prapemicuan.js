var getUrl = window.location;
var base_url = getUrl.protocol + "//" + getUrl.host + '/';



function openFormExcel() {
    $('#modalFormExcel').modal("show")
    $('#excel').val('')

    $('.excel').html('')
}

$('#importPraPemicuan').submit(function (e) {
    e.preventDefault()
    //console.log(e)
    var dataForm = new FormData(this);
    t = document.getElementById("importButton")
    $.ajax({
        url: base_url + "admin/importprapemicuan",
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
            var error = err.responseJSON.errors
            if (error) {
                $('.excel').html(error.excel)
            }
            else {
                Swal.fire({
                    text: "Something Went Wrong!",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok",
                    customClass: { confirmButton: "btn btn-danger" }
                }).then(
                    (function (t) {
                        if (t.isConfirmed) {

                            location.reload()
                        }

                    })
                )
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
                            //window.location.href = base_url + "data-pemicuan";
                            location.reload()
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