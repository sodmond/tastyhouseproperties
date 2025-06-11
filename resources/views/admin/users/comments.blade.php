@extends('admin.layouts.main', ['title' => ucwords($user->firstname)."'s Comments", 'activePage' => 'users'])

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.user', ['id' => $user->id]) }}">{{ ucwords($user->firstname) }}'s Details</a></li>
                                <li class="breadcrumb-item active">Comments</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{ ucwords($user->firstname) }}'s Comments</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-custom">
                            <h4 class="h5 text-white">All Comments</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <a class="btn btn-custom" href="{{ route('admin.user', ['id' => $user->id]) }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Body</th>
                                            <th>Date Created</th>
                                            <th>...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $row = (isset($_GET['page']) && $_GET['page'] != 1) ? 10*($_GET['page']-1)+1 : 1; ?>
                                        @foreach ($comments as $comment)
                                            <tr>
                                                <td>{{ $row++ }}</td>
                                                <td>{{ $comment->body }}</td>
                                                <td>{{ $comment->created_at }}</td>
                                                <td><a class="btn btn-sm btn-custom" href="{{-- route('admin.comment', ['id' => $comment->id]) --}}">
                                                    <i class="fa fa-eye"></i>
                                                </a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-auto">{{ $comments->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div> <!-- container -->

    </div> <!-- content -->
@endsection