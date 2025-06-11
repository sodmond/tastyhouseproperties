@extends('admin.layouts.main', ['title' => 'Abuse Reports', 'activePage' => 'products'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Abuse Report List for {{ $product->title }}</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-sm btn-custom" role="button" href="{{ route('admin.product', ['id' => $product->id]) }}">
                                        <i class="fa fa-arrow-left"></i> Back</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{--<div class="row row-cols-lg-auto g-3 align-items-center mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('admin.abuse_reports.export') }}" method="GET">
                                <div class="input-group">
                                    <select class="form-control" name="month">
                                        <option value="">- - - Month - - -</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <select class="form-control" name="year">
                                        <option value="">- - - Year - - -</option>
                                        @for ($i = 0; $i <= 10; $i++)
                                            <option value="{{ 2025 + $i }}">{{ 2025 + $i }}</option>
                                        @endfor
                                    </select>
                                    <button class="btn btn-theme" type="submit">Export</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4 justify-content-end">
                            <form>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" placeholder="Enter abuse_report ID">
                                    <button class="btn btn-theme" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @isset($_GET['search'])
                        <p>Search result for: {{ $_GET['search'] }}</p>
                    @endisset--}}

                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" >
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Product</th>
                                    <th>Title</th>
                                    <th>Date Created</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($abuse_reports as $abuse_report)
                                <tr>
                                    <td>
                                        <div class="user-name"><span>
                                            {{ $abuse_report->user->firstname.' '.$abuse_report->user->lastname }}
                                        </span></div>
                                    </td>
                                    <td>
                                        {{ $abuse_report->product->title }}
                                    </td>
                                    <td>{{ $abuse_report->title }}</td>
                                    <td>{{ $abuse_report->created_at }}</td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.abusereport', ['id' => $abuse_report->id]) }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pt-4">{{ $abuse_reports->appends($_GET)->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection