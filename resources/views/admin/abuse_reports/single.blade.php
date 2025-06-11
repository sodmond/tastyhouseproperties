@extends('admin.layouts.main', ['title' => 'Abuse Report Details', 'activePage' => 'abuse_reports'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Abuse Report Details</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-sm btn-custom" role="button" href="{{ route('admin.abusereports') }}">
                                        <i class="fa fa-arrow-left"></i> Back</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-product">
                                <table class="table all-packag theme-tabl" >
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>
                                                {{ $abuse_report->id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>User</th>
                                            <td>
                                                <a href="{{ route('admin.user', ['id' => $abuse_report->user_id]) }}" target="_blank">
                                                    <u>{{ $abuse_report->user->firstname.' '.$abuse_report->user->lastname }}</u>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Product</th>
                                            <td>
                                                <a href="{{ route('admin.product', ['id' => $abuse_report->product_id]) }}" target="_blank">
                                                    <u>{{ $abuse_report->product->title }}</u>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ $abuse_report->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $abuse_report->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date Created</th>
                                            <td>{{ $abuse_report->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>{{ $abuse_report->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection