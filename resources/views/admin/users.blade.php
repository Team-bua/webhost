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
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Total</th>
                                            <th class="text-secondary"></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @php $i=1 @endphp     
                                        @foreach ($users as $user)                                                                     
                                        <tr>
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
                                                <a href="#"><span class="badge badge-sm bg-gradient-success">Data</span></a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalMessage" class="text-secondary font-weight-bold text-xs">
                                                    <span class="badge bg-gradient-info">Sửa</span>
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="col-md-4">
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật tiền</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                    </button>
                                                  </div>
                                                  <form  action="#"method="post" enctype="multipart/form-data" id="form_data">
                                                  @csrf
                                                    <div class="modal-body">                     
                                                      <div class="form-group">       
                                                        <label class="form-control-label" for="basic-url">Số tiền: </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                                                            <input name="money" id="money" type="number" class="form-control" id="exampleFormControlInput1" placeholder="Số tiền. . . . . . . . ." min="0" maxlength="50" required>
                                                            <span class="input-group-text" id="basic-addon2">VNĐ</span>
                                                        </div>                        
                                                      </div>                                                 
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="submit" class="btn bg-gradient-secondary">Cập nhật</button>
                                                  </div>
                                                </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div>                                                                             
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
</script>
@endsection