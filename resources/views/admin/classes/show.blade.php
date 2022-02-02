@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title text-left">Class details</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('classes.edit', $classes->id) }}"
                               class="btn btn-warning btn-fab btn-icon btn-round">
                                <i class="fa fa-edit"></i>
                            </a>
                            @include('partials.delete-with-confirmation', ['model' => $classes, 'routeModelName' => 'teachers'])
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Class title</th>
                                                <td>{{ $classes->name }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Main category</th>
                                                <td>{{ $classes->classCategory->name }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Price</th>
                                                <td>{{ $classes->price_usd }} usd /
                                                    {{ $classes->price_eur }} eur /
                                                    {{ $classes->price_sar }} sar /
                                                    {{ $classes->price_omr }} omr
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Sub category</th>
                                                <td>{{ $classes->classSubCategory->name }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Teacher</th>
                                                <td><b>Teacher name : </b> {{ $classes->teacher->name }} , <b>gender : {{$classes->teacher->gender->gender}}</b></td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Class location</th>
                                                <td>
                                                    @foreach($classes->locations as $location)
                                                        {{ $location->location }},
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Class level</th>
                                                <td>{{ $classes->level }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Class length</th>
                                                <td>{{ $classes->class_length }} minutes</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Age restriction</th>
                                                <td>{{ $classes->age_restriction }} years</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Class materials</th>
                                                <td>{{ $classes->materials }}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%">On home page</th>
                                                <td>
                                                    <img src="@if($classes->highlighted) {{ asset('img/checked.png') }}
                                                    @else {{ asset('img/unchecked.png') }} @endif" width="20px">
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%">Popular</th>
                                                <td>
                                                    <img src="@if($classes->popular) {{ asset('img/checked.png') }}
                                                    @else {{ asset('img/unchecked.png') }} @endif" width="20px">
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%">Discounted</th>
                                                <td>
                                                    <img src="@if($classes->discount) {{ asset('img/checked.png') }}
                                                    @else {{ asset('img/unchecked.png') }} @endif" width="20px">
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Discount</th>
                                                @if($classes->discount_percentage )
                                                    <td>{{ $classes->discount_percentage }} %</td>
                                                @endif
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%">Main Image</th>
                                                <td>
                                                    <img class="thumbnail-show-products" alt=""
                                                         src="{{ asset( $classes->desktopImage()->getThumbUrl()) }}">
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%">Second Image</th>
                                                <td>
                                                    <img class="thumbnail-show-products" alt=""
                                                         src="{{ asset( $classes->mobileImage()->getThumbUrl()) }}">
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Class location</th>
                                                <td>{!!  $classes->map_location !!}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Class description </th>
                                                <td class="component-description">{!! $classes->description !!}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Description right</th>
                                                <td class="component-description">{!! $classes->description_first !!}</td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th scope="row" width="30%"> Description left</th>
                                                <td class="component-description">{!! $classes->description_second !!}</td>
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
    </div>
@endsection

@section('script-links')
    @parent
    <script src="{{ asset('js/delete-confirmation-modal.js') }}"></script>
@endsection
