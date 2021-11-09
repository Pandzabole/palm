@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title text-left">Product details</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('products.edit', $product->id) }}"
                               class="btn btn-warning btn-fab btn-icon btn-round">
                                <i class="fa fa-edit"></i>
                            </a>
                            @include('partials.delete-with-confirmation', ['model' => $product, 'routeModelName' => 'products'])
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Name</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Package Number</th>
                                    <td>{{ $product->packageNumber->value }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%"> Package Volume</th>
                                    <td>{{ $product->packageVolume->value }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%" class="component-description"> Description</th>
                                    <td class="component-description">{!! $product->description !!}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%">Image Desktop</th>
                                    <td>
                                        <img class="thumbnail-show-products" alt=""
                                             src="{{ asset( $product->desktopImage()->getThumbUrl()) }}">
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th scope="row" width="30%">Image Mobile</th>
                                    <td>
                                        <img class="thumbnail-show-products" alt=""
                                             src="{{ asset( $product->mobileImage()->getThumbUrl()) }}">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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
