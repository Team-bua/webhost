@extends('admin.master')
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Data @if(Auth::user()->role == 1 && $user->role != 1)- Thành viên: {{ $user->name }} - {{ $user->email }} @endif</h6>
            </nav>
        @include('admin.info')        
        </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Tổng số mã thẻ</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-credit-card text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Tổng hóa đơn nạp</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Tổng số user</p>
                                    <h5 class="font-weight-bolder mb-0">
                                     
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Tổng hóa đơn bán</p>
                                    <h5 class="font-weight-bolder mb-0">
                                       
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        @if (session('information'))
                            <div class="alert alert-{{ session('information') }}"><b>{{ session('messege') }}</b></div>
                        @endif                      
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalMessage" class="text-secondary font-weight-bold text-xs">
                            <button class="btn bg-gradient-primary mt-4 w-12" style="float: right;;margin-bottom:5px;margin-left:5px;">
                                <i class="fa fa-plus">&nbsp; Create Data </i></button>
                        </a>
                        <a href="{{ route('export.data', $token) }}">
                            <button class="btn bg-gradient-info mt-4 w-12" style="float: right;;margin-bottom:5px;margin-left:5px;">
                                <i class="fa fa-plus">&nbsp; Export File </i></button>
                        </a>
                            <button class="btn bg-gradient-success mt-4 w-12" id="btn_import" style="float: right;;margin-bottom:5px;margin-left:5px;">
                                <i class="fa fa-plus">&nbsp; Import File </i></button>
                                <form action="{{ route('import.file') }}" id="import_file" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="text" style="display: none" name="token_user" value="{{ $token }}">
                                <input type="file" style="display: none" onchange="importFile(this)" id="text_file" name="text_file">
                                </form>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">                           
                        <div class="table-responsive p-0">
                            <table class="table table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">#</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Data</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Ngày</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs delete_all">
                                                <span class="badge bg-gradient-danger">Xoá tất cả</span>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if(isset($datas))      
                                    @foreach($datas as $data)                                                             
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ $i++ }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->data }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->created_at }}</p>
                                        </td>
                                        <td class="align-middle">
                                            {{-- <a href="#" class="text-secondary font-weight-bold text-xs">
                                                <span class="badge bg-gradient-info">Sửa</span>
                                            </a>
                                            || --}}
                                            <a href="javascript:;" delete_id="{{ $data->id }}" class="text-secondary font-weight-bold text-xs simpleConfirm">
                                                <span class="badge bg-gradient-danger">Xoá</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
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
        <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm dữ liệu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="#" method="post" enctype="multipart/form-data" id="import-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Dữ liệu</label>
                                <textarea class="form-control" id="data_text" name="data_text" rows="3"></textarea>
                            </div>
                            <p id="error-data-text" style="color:red;font-size: 13px;margin-left: 10px"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-gradient-success">Thêm</button>
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

    $('#import-data').submit(function(e){
        e.preventDefault();
        var data_text = $("#data_text").val();
        $.ajax({
                url: "{{ route('import.data', $token) }}",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    data_text: data_text,
                },
                success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thêm thành công',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    $('#exampleModalMessage').modal('hide');
                },
                error: function(response) {
                    // $('#add_user').find('input').each(function() {
                    //     $(this).next('p').text('');
                    // });
                    var data = JSON.parse(response.responseText)['errors'];
                    for (const key in data) {
                        $('#error-'+key).html('')
                        $('#error-'+key).append(data[key][0]);
                    }
                }
            });
    });

    $('#btn_import').on('click', function(){
        $('#text_file').click();
    })

    function importFile(input){
        $('#import_file').submit();
    }

    $(document).on('click', '.simpleConfirm', function(e) {
        e.preventDefault();
        var id = $(this).attr('delete_id');
        var that = $(this);
        swal.fire({
            title: "Bạn có muốn xóa dữ liệu này?",
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
                    url: "{{ route('data.delete') }}",
                    data: {
                        id: id,
                        user_token: '{{ $token }}'
                    },
                    success: function(data) {
                        if (data.success == true) {
                            Swal.fire(
                                'Xóa!',
                                'Xóa thành công.',
                                'success'
                            )
                            $('#tbody').html(data.data_del);
                        }
                    }
                })
            }
        });
    });

    $(document).on('click', '.delete_all', function(e) {
        e.preventDefault();
        var id = $(this).attr('delete_id');
        var that = $(this);
        swal.fire({
            title: "Bạn có muốn xóa tất cả dữ liệu này?",
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
                    url: "{{ route('data.delete.all') }}",
                    data: {
                        id: id,
                        user_token: '{{ $token }}'
                    },
                    success: function(data) {
                        if (data.success == true) {
                            Swal.fire(
                                'Xóa!',
                                'Xóa thành công.',
                                'success'
                            )
                            window.location.reload();
                        }
                    }
                })
            }
        });
    });
  </script> 
@endsection