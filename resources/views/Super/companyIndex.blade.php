@extends('layouts.adminLte')

@section('mainContent')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <p><a href="{{ route('Company.create') }}" class="btn btn-primary">Add New Company</a></p>
                    </div>
                </div>

                <div class="container my-2">
                    <table class="table table-bordered data-table" id="datatable">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Website</th>
                            <th scope="col">show</th>
                            <th scope="col">edit</th>
                            <th scope="col">delete</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{$company->id}}</td>
                                <td>{{$company->name }}</td>
                                <td>{{$company->email}}</td>
                                <td>{{$company->website}}</td>
                                <td><a href="{{ route('Company.show', $company->id) }}" class="btn btn-info">Show</a></td>
                                <td><a href="{{ route('Company.edit', $company->id) }}" class="btn btn-success">Edit</a></td>
                                <td><a href="{{ route('Company.destroy', $company->id) }}" class="btn btn-danger">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->

        {{--                        <div class="card">--}}
        {{--                            <div class="card-header border-0">--}}
        {{--                                <h3 class="card-title">Products</h3>--}}
        {{--                                <div class="card-tools">--}}
        {{--                                    <a href="#" class="btn btn-tool btn-sm">--}}
        {{--                                        <i class="fas fa-download"></i>--}}
        {{--                                    </a>--}}
        {{--                                    <a href="#" class="btn btn-tool btn-sm">--}}
        {{--                                        <i class="fas fa-bars"></i>--}}
        {{--                                    </a>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                            <div class="card-body table-responsive p-0">--}}
        {{--                                <table class="table table-striped table-valign-middle">--}}
        {{--                                    <thead>--}}
        {{--                                    <tr>--}}
        {{--                                        <th>Product</th>--}}
        {{--                                        <th>Price</th>--}}
        {{--                                        <th>Sales</th>--}}
        {{--                                        <th>More</th>--}}
        {{--                                    </tr>--}}
        {{--                                    </thead>--}}
        {{--                                    <tbody>--}}
        {{--                                    <tr>--}}
        {{--                                        <td>--}}
        {{--                                            <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">--}}
        {{--                                            Some Product--}}
        {{--                                        </td>--}}
        {{--                                        <td>$13 USD</td>--}}
        {{--                                        <td>--}}
        {{--                                            <small class="text-success mr-1">--}}
        {{--                                                <i class="fas fa-arrow-up"></i>--}}
        {{--                                                12%--}}
        {{--                                            </small>--}}
        {{--                                            12,000 Sold--}}
        {{--                                        </td>--}}
        {{--                                        <td>--}}
        {{--                                            <a href="#" class="text-muted">--}}
        {{--                                                <i class="fas fa-search"></i>--}}
        {{--                                            </a>--}}
        {{--                                        </td>--}}
        {{--                                    </tr>--}}
        {{--                                    <tr>--}}
        {{--                                        <td>--}}
        {{--                                            <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">--}}
        {{--                                            Another Product--}}
        {{--                                        </td>--}}
        {{--                                        <td>$29 USD</td>--}}
        {{--                                        <td>--}}
        {{--                                            <small class="text-warning mr-1">--}}
        {{--                                                <i class="fas fa-arrow-down"></i>--}}
        {{--                                                0.5%--}}
        {{--                                            </small>--}}
        {{--                                            123,234 Sold--}}
        {{--                                        </td>--}}
        {{--                                        <td>--}}
        {{--                                            <a href="#" class="text-muted">--}}
        {{--                                                <i class="fas fa-search"></i>--}}
        {{--                                            </a>--}}
        {{--                                        </td>--}}
        {{--                                    </tr>--}}
        {{--                                    <tr>--}}
        {{--                                        <td>--}}
        {{--                                            <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">--}}
        {{--                                            Amazing Product--}}
        {{--                                        </td>--}}
        {{--                                        <td>$1,230 USD</td>--}}
        {{--                                        <td>--}}
        {{--                                            <small class="text-danger mr-1">--}}
        {{--                                                <i class="fas fa-arrow-down"></i>--}}
        {{--                                                3%--}}
        {{--                                            </small>--}}
        {{--                                            198 Sold--}}
        {{--                                        </td>--}}
        {{--                                        <td>--}}
        {{--                                            <a href="#" class="text-muted">--}}
        {{--                                                <i class="fas fa-search"></i>--}}
        {{--                                            </a>--}}
        {{--                                        </td>--}}
        {{--                                    </tr>--}}
        {{--                                    <tr>--}}
        {{--                                        <td>--}}
        {{--                                            <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">--}}
        {{--                                            Perfect Item--}}
        {{--                                            <span class="badge bg-danger">NEW</span>--}}
        {{--                                        </td>--}}
        {{--                                        <td>$199 USD</td>--}}
        {{--                                        <td>--}}
        {{--                                            <small class="text-success mr-1">--}}
        {{--                                                <i class="fas fa-arrow-up"></i>--}}
        {{--                                                63%--}}
        {{--                                            </small>--}}
        {{--                                            87 Sold--}}
        {{--                                        </td>--}}
        {{--                                        <td>--}}
        {{--                                            <a href="#" class="text-muted">--}}
        {{--                                                <i class="fas fa-search"></i>--}}
        {{--                                            </a>--}}
        {{--                                        </td>--}}
        {{--                                    </tr>--}}
        {{--                                    </tbody>--}}
        {{--                                </table>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
    {{--                    <div class="col-lg-6">--}}
    {{--                        <div class="card">--}}
    {{--                            <div class="card-header border-0">--}}
    {{--                                <div class="d-flex justify-content-between">--}}
    {{--                                    <h3 class="card-title">Sales</h3>--}}
    {{--                                    <a href="javascript:void(0);">View Report</a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <div class="card-body">--}}
    {{--                                <div class="d-flex">--}}
    {{--                                    <p class="d-flex flex-column">--}}
    {{--                                        <span class="text-bold text-lg">$18,230.00</span>--}}
    {{--                                        <span>Sales Over Time</span>--}}
    {{--                                    </p>--}}
    {{--                                    <p class="ml-auto d-flex flex-column text-right">--}}
    {{--                    <span class="text-success">--}}
    {{--                      <i class="fas fa-arrow-up"></i> 33.1%--}}
    {{--                    </span>--}}
    {{--                                        <span class="text-muted">Since last month</span>--}}
    {{--                                    </p>--}}
    {{--                                </div>--}}
    {{--                                <!-- /.d-flex -->--}}

    {{--                                <div class="position-relative mb-4">--}}
    {{--                                    <canvas id="sales-chart" height="200"></canvas>--}}
    {{--                                </div>--}}

    {{--                                <div class="d-flex flex-row justify-content-end">--}}
    {{--                  <span class="mr-2">--}}
    {{--                    <i class="fas fa-square text-primary"></i> This year--}}
    {{--                  </span>--}}

    {{--                                    <span>--}}
    {{--                    <i class="fas fa-square text-gray"></i> Last year--}}
    {{--                  </span>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <!-- /.card -->--}}

    {{--                        <div class="card">--}}
    {{--                            <div class="card-header border-0">--}}
    {{--                                <h3 class="card-title">Online Store Overview</h3>--}}
    {{--                                <div class="card-tools">--}}
    {{--                                    <a href="#" class="btn btn-sm btn-tool">--}}
    {{--                                        <i class="fas fa-download"></i>--}}
    {{--                                    </a>--}}
    {{--                                    <a href="#" class="btn btn-sm btn-tool">--}}
    {{--                                        <i class="fas fa-bars"></i>--}}
    {{--                                    </a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <div class="card-body">--}}
    {{--                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">--}}
    {{--                                    <p class="text-success text-xl">--}}
    {{--                                        <i class="ion ion-ios-refresh-empty"></i>--}}
    {{--                                    </p>--}}
    {{--                                    <p class="d-flex flex-column text-right">--}}
    {{--                    <span class="font-weight-bold">--}}
    {{--                      <i class="ion ion-android-arrow-up text-success"></i> 12%--}}
    {{--                    </span>--}}
    {{--                                        <span class="text-muted">CONVERSION RATE</span>--}}
    {{--                                    </p>--}}
    {{--                                </div>--}}
    {{--                                <!-- /.d-flex -->--}}
    {{--                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">--}}
    {{--                                    <p class="text-warning text-xl">--}}
    {{--                                        <i class="ion ion-ios-cart-outline"></i>--}}
    {{--                                    </p>--}}
    {{--                                    <p class="d-flex flex-column text-right">--}}
    {{--                    <span class="font-weight-bold">--}}
    {{--                      <i class="ion ion-android-arrow-up text-warning"></i> 0.8%--}}
    {{--                    </span>--}}
    {{--                                        <span class="text-muted">SALES RATE</span>--}}
    {{--                                    </p>--}}
    {{--                                </div>--}}
    {{--                                <!-- /.d-flex -->--}}
    {{--                                <div class="d-flex justify-content-between align-items-center mb-0">--}}
    {{--                                    <p class="text-danger text-xl">--}}
    {{--                                        <i class="ion ion-ios-people-outline"></i>--}}
    {{--                                    </p>--}}
    {{--                                    <p class="d-flex flex-column text-right">--}}
    {{--                    <span class="font-weight-bold">--}}
    {{--                      <i class="ion ion-android-arrow-down text-danger"></i> 1%--}}
    {{--                    </span>--}}
    {{--                                        <span class="text-muted">REGISTRATION RATE</span>--}}
    {{--                                    </p>--}}
    {{--                                </div>--}}
    {{--                                <!-- /.d-flex -->--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    <!-- /.col-md-6 -->
    </div>

@endsection

@section('MyScripts')
    <script>
        $(document).ready(function (){
            $('#datatable').DataTable();
        });
    </script>
@endsection
