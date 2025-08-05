<div class="modal fade" tabindex="-1" id="modalFormUser">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Input User</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form id="usersForm">
                    @csrf
                    <input type="hidden" name="role" value="{{ $url_insert }}" />
                    <input type="hidden" name="idUser" id="idUser" />
                    <div class="mb-5">
                        <label for="name">Nama</label>
                        <input type="text" placeholder="ketik di sini" id="name" name="name" class="form-control form-control-sm" />
                        <span class="fs-8 text-danger name"></span>
                    </div>

                    <div class="mb-5">
                        <label for="email">Email</label>
                        <input type="text" id="email" placeholder="ketik di sini" name="email" class="form-control form-control-sm" />
                        <span class="fs-8 text-danger email"></span>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary me-10" id="saveUser">
                    <span class="indicator-label">
                        Simpan
                    </span>
                    <span class="indicator-progress">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>

            </form>
        </div>
    </div>
</div>
