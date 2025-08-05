var getUrl = window.location;
var base_url = getUrl.protocol + "//" + getUrl.host + '/';

function openFormUser() {
    $('#modalFormUser').modal("show")
    $('#name').val('')
    $('#email').val('')

    $('.name').html('')
    $('.email').html('')
}


function editUser(id) {
    $('#modalFormUser').modal("show")
    $('.name').html('')
    $('.email').html('')
    $('#idUser').val(id)
    $.ajax({
        url: base_url + 'getUser',
        type: 'POST',
        data: {
            id: id
        },
        headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
        success: function (data) {
            $('#name').val(data.user['name'])
            $('#email').val(data.user['email'])
        }
    })
}

function swal(title, text, icon, btn) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        buttonsStyling: !1,
        confirmButtonText: "Ok",
        customClass: { confirmButton: `btn ${btn}` }
    })
}

function hapusUser(id) {
    Swal.fire({
        text: "Apakah anda yakin?",
        icon: "warning",
        buttonsStyling: !1,
        showCancelButton: true,
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak",
        customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-secondary" }
    }).then(
        (function (t) {
            if (t.isConfirmed) {
                $.ajax({
                    url: base_url + 'deleteUser',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                    success: function (data) {
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

$('#usersForm').submit(function (e) {
    e.preventDefault()
    var dataForm = new FormData(this);
    t = document.getElementById("saveUser")
    $.ajax({
        url: base_url + "addUser",
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
                $('.name').html(error.name)
                $('.email').html(error.email)
            }
            else {
                swal('Error!', 'Something went wrong', 'error', 'btn-danger')
            }
        },
        success: function (data) {
            var conf = data.status

            if (conf) {
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
            else {
                $('.email').html(data.email)
                t.removeAttribute("data-kt-indicator")
                t.disabled = !1
            }
            //location.reload()
        },
        cache: false,
        contentType: false,
        processData: false
    });
})


