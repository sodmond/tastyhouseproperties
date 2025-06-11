@extends('admin.layouts.main', ['title' => 'State List', 'activePage' => 'settings'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>State List</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-theme" href="{{ route('admin.settings.home') }}"><i class="fa fa-arrow-left"></i> Back</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Cities</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $row = (isset($_GET['page']) && $_GET['page'] != 1) ? 10*($_GET['page']-1)+1 : 1; ?>
                                @foreach ($states as $state)
                                <tr>
                                    <td>
                                        {{ $row++ }}
                                    </td>
                                    <td>
                                        <div class="user-name"><span>{{ $state->name }}</span></div>
                                    </td>
                                    <td>{{ count($state->cities) }}</td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.settings.cities', ['state' => $state->id]) }}">
                                                    <i class="fa fa-eye"></i> View Cities
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="py-4">{{ $states->appends($_GET)->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection