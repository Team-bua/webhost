<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cài đặt</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="#" method="post" enctype="multipart/form-data" id="limit_form">
            @csrf
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="form-control-label">Cài đặt số lượt để xóa</label> <br>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-quidditch"></i></span>
                            <input name="limit" id="limit" min="0" value="{{ $user->limit }}" type="number" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-gradient-success submit">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
