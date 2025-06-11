@extends('admin.layouts.main', ['title' => 'Advert Placement', 'activePage' => 'settings'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>{{ 'Advert Placement' }}</h5>
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
                                    <th>Title</th>
                                    <th>Size</th>
                                    <th>Cost</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $row = (isset($_GET['page']) && $_GET['page'] != 1) ? 10*($_GET['page']-1)+1 : 1; ?>
                                @foreach ($adverts as $advert)
                                <tr>
                                    <td>
                                        {{ $row++ }}
                                    </td>
                                    <td>
                                        <div class="user-name"><span>{{ ucwords($advert->title) }}</span></div>
                                    </td>
                                    <td>
                                        {{ $advert->width .'x'. $advert->height .'px' }}
                                    </td>
                                    <td>
                                        {{ $currency.number_format($advert->cost, 2) }}
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.settings.advert', ['id' => $advert->id]) }}">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>
                                        </ul>
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
@endsection