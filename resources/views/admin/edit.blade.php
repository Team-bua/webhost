<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sửa dữ liệu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="{{ route('update.data', $data->id) }}" method="post" enctype="multipart/form-data" id="edit-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Dữ liệu</label>
                    <textarea class="form-control" id="data_text" name="data_text">{{ $data->data }}</textarea>
                </div>
                <p id="error-data-text" style="color:red;font-size: 13px;margin-left: 10px"></p>
            </div>       
            <div class="modal-footer">
                <button type="submit" class="btn bg-gradient-success" id="update">Cập nhật</button>
            </div>
        </form>
    </div>
</div>