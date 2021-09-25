@extends('admin.master')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Home</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Thành viên</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Tất cả thành viên</h6>
                </nav>
                @include('admin.info')
            </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            @if (session('information'))
                            <div class="alert alert-success"><b>{{ session('information') }}</b></div>
                            @endif
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalRegister">
                                <button class="btn bg-gradient-primary mt-4 w-12" style="float: right;margin-bottom:5px;margin-left:5px;">
                                    <i class="fa fa-plus">&nbsp; Add user </i></button>
                            </a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">                           
                            <div class="table-responsive p-0">
                                @if (session('information'))
                                    <div class="alert alert-success">{{ session('information') }}</div>
                                @endif
                                <table class="table table-flush" id="datatable-basic">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">#</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Tên</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Email</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Tổng Data</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Token</th>
                                            <th class="text-secondary"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody"> 
                                        @php $i=1 @endphp     
                                        @foreach ($users as $user)                                                                     
                                        <tr>
                                            <input type="text" style="display: none" id="token_user" name="token_user" value="{{ $user->user_token }}">
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $i++ }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-info">{{ $count_data[$user->id] }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->user_token }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('data', $user->user_token) }}"><span class="badge badge-sm bg-gradient-success">Data</span></a> || 
                                                <a href="javascript:;" delete_id="{{ $user->id }}" class="text-secondary font-weight-bold text-xs simpleConfirm">
                                                    <span class="badge bg-gradient-danger">Xóa</span>
                                                </a>
                                            </td>
                                        </tr>                                                                           
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Modal -->
            <div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm thành viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <form action="#" method="post" enctype="multipart/form-data" id="add_user">
                    @csrf
                    <div class="modal-body">                     
                      <div class="form-group">       
                        <label class="form-control-label" for="basic-url">Tên: </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                            <input name="name" id="name" type="text" class="form-control" placeholder="Tên. . . . . . . . ." min="0" maxlength="50">                           
                        </div>                        
                      </div>   
                      <p id="error-name" style="color:red;font-size: 13px;margin-left: 10px"></p> 
                      <div class="form-group">       
                        <label class="form-control-label" for="basic-url">Email: </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                            <input name="email" id="email" type="text" class="form-control" placeholder="Email. . . . . . . . ." min="0" maxlength="50">                        
                        </div>                        
                      </div>
                      <p id="error-email" style="color:red;font-size: 13px;margin-left: 10px"></p>    
                      <div class="form-group">       
                        <label class="form-control-label" for="basic-url">Mật khẩu: </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                            <input name="password" id="password" type="password" class="form-control" placeholder="Mật khẩu. . . . . . . . ." min="0" maxlength="50">                  
                        </div>                        
                      </div>       
                      <p id="error-password" style="color:red;font-size: 13px;margin-left: 10px"></p>
                      <div class="form-group">       
                        <label class="form-control-label" for="basic-url">Xác nhận mật khẩu: </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                            <input name="confirm_password" id="confirm_password" type="password" class="form-control" placeholder="Xác nhận mật khẩu. . . . . . . . ." min="0" maxlength="50">
                        </div>                                              
                      </div> 
                      <p id="error-confirm_password" style="color:red;font-size: 13px;margin-left: 10px"></p>                                                   
                  </div>
                  <div class="modal-footer">
                    <button class="btn bg-gradient-primary" id="btn-add">Thêm</button>
                  </div>
                </form>
                </div>
              </div>
            </div>
        </div>    
    </main>
@endsection
@section('script')
<script src="{{ asset('dashboard/assets/js/plugins/datatables.js') }}" type="text/javascript"></script>
<script type="text/javascript">
     const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
      searchable: true,
      fixedHeight: true
    });

    $('#add_user').submit(function(e){
        e.preventDefault();
        var name = $("#name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();

        $.ajax({
            url: "{{ route('adduser') }}",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                name: name,
                email: email,
                password: password,
                confirm_password: confirm_password
            },
            success: function(response) {
                $('#add_user').find('input').each(function() {
                        $(this).val('');
                        $(this).next('p').text('');
                    }),
                    Swal.fire({
                        icon: 'success',
                        title: 'Thêm thành công',
                        showConfirmButton: false,
                        timer: 2000
                    })
                $('#modalRegister').modal('hide');
                window.location.reload();
            },
            error: function(response) {
                $('#add_user').find('p').each(function() {
                    $(this).text('');
                });
                var data = JSON.parse(response.responseText)['errors'];
                for (const key in data) {
                    $('#error-'+key).append(data[key][0]);
                }
            }
        });
    });

    $(document).on('click', '.simpleConfirm', function(e) {
        e.preventDefault();
        var id = $(this).attr('delete_id');
        var token = $('#token_user').val();
        swal.fire({
            title: "Bạn có muốn xóa user này?",
            text: "Dữ liệu sẽ mất theo khi xóa user",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa ngay!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'get',
                    url: "{{ route('users.delete') }}",
                    data: {
                        id: id,
                        user_token: token
                    },
                    success: function(data) {
                        if (data.success == true) {
                            Swal.fire(
                                'Xóa!',
                                'Xóa thành công.',
                                'success'
                            )
                            $('#tbody').html(data.data_del);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Không thể xóa admin!',
                            })
                        }
                    }
                })
            }
        });
    });
</script>
@endsection