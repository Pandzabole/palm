@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title text-left">Slider details</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('sliders.edit', $slider->id) }}"
                               class="btn btn-warning btn-fab btn-icon btn-round">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div role="tablist" aria-multiselectable="true" class="card-collapse">
                                @foreach($slider->steps as $step)
                                    <div class="card step-card mb-3">
                                        <div class="card-header" id="heading-{{ $step->position }}">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                               href="#collapse-{{ $step->position }}"
                                               aria-expanded="false"
                                               aria-controls="collapse-{{ $step->position }}">
                                    <span class="h4 ml-3 text-center">
                                        Slider item  <label class="step-number">{{ $loop->iteration }}</label>
                                    </span>
                                                <i class="mr-3 nc-icon nc-minimal-down"></i>
                                            </a>
                                        </div>
                                        <div id="collapse-{{ $step->position }}" class="step-collapse collapse" role="tabpanel"
                                             aria-labelledby="heading-{{ $step->position }}">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless">
                                                                <tbody>
                                                                <tr class="border-bottom">
                                                                    <th scope="row" width="30%"> Cta</th>
                                                                    <td>{{ $step->cta }}</td>
                                                                </tr>
                                                                <tr class="border-bottom">
                                                                    <th scope="row" width="30%"> Url</th>
                                                                    <td>{{ $step->url }}</td>
                                                                </tr>
                                                                <tr class="border-bottom">
                                                                    <th scope="row" width="30%">Image Desktop</th>
                                                                    <td>
                                                                        <img class="thumbnail-show" alt=""
                                                                             src="{{ asset(optional($step->desktopImage())->getThumbUrl()) }}">
                                                                    </td>
                                                                </tr>
                                                                <tr class="border-bottom">
                                                                    <th scope="row" width="30%">Image Mobile</th>
                                                                    <td>
                                                                        <img class="thumbnail-show" alt=""
                                                                             src="{{ asset(optional($step->mobileImage())->getThumbUrl()) }}">
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
                                @endforeach
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
