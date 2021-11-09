@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <h3 class="mb-0">Slider</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data"
                          id="slider-form">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">Page information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6 p-0">
                                    <div class="form-group error-danger error-danger-page_ids">
                                        <label class="form-control-label " for="page_ids">Pages</label>
                                        <select class="form-control" id="page_ids"
                                                data-toggle="select" multiple data-placeholder="Select multiple options"
                                                name="page_ids[]">
                                        </select>
                                        <span class="text-danger d-none error-span error-page_ids"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="steps" role="tablist" aria-multiselectable="true" class="card-collapse"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-primary" id="add-new-step"> Add new
                                                    slider item
                                                </button>
                                            </div>
                                            <div class="col-6 ml-auto mr-auto text-right">
                                                <a href="{{ route('sliders.index') }}" class="btn"> Cancel </a>
                                                <button id="submit" type="button" class="btn btn-primary"> Save Slider
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('partials.media.media-modal', ['mediaModalId' => 'mobile', 'media' => $mediaMobile])
@include('partials.media.media-modal', ['mediaModalId' => 'desktop', 'media' => $mediaDesktop])
@include('admin.sliders.slider-items.slider-step-template')

@section('js-links')

    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/card-steps.js') }}"></script>
    <script src="{{ asset('js/media-model.js') }}"></script>

    <script>
        $("#add-new-step").click();
        $('body').on('click', '#submit', function () {
            let button = $(this);
            button.addClass('disabled');
            let data = new FormData($("#slider-form").get(0));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('sliders.store') }}",
                dataType: 'json',
                type: 'post',
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    window.location.href = data.redirect;
                },
                error: function (data) {
                    showErrors(data.responseJSON);
                    button.removeClass('disabled');
                }
            });
        })
    </script>
@endsection
