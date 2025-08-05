var getUrl = window.location;
var base_url = getUrl.protocol + "//" + getUrl.host + '/';

$('#loginForm').submit(function (e) {
    e.preventDefault()
    var dataForm = new FormData(this);
    t = document.getElementById("loginButton")
    $.ajax({
        url: base_url + "login/",
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
                $('.email').html(error.email)
                $('.password').html(error.password)
            }
            else {
                swal('Error!', 'Something went wrong', 'error', 'btn-danger')
            }
        },
        success: function (data) {
            var conf = data.status

            if (conf) {
                window.location.href = base_url + data.redirect;
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