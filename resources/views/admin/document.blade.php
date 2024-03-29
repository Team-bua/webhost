@extends('admin.master')
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Home</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tài liệu</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Tài liệu API</h6>
            </nav>
            @include('admin.info')
        </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Import Data</h6>
                    </div>
                        <div class="card-body p-3">
                            <p>URL : <b style="color: green">POST</b>=>{{url('api/import?user_token={token}&data={data}')}}</p>
                            <p>Token : Vào trang cá nhân để lấy và nhập vào</p>
                            <p>Data : Là dữ liệu người dùng nhập vào</p>
                            <p>Ví dụ : {{url('api/import?user_token=abcxyz&data=string')}}</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Get Data</h6>
                    </div>
                        <div class="card-body p-3">
                            <p>URL : <b style="color: green">GET</b>=>{{url('api/get-data/{token}')}}</p>
                            <p>Token : Vào trang cá nhân để lấy và nhập vào</p>
                            <p>Ví dụ : {{url('api/get-data/abcxyz')}}</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
