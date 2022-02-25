@extends('layouts.app')

@section('content')
    <form id="slider-form" method="POST" action="{{ route('sliders.update', $slider->id) }}"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-left"> Edit Slider </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="steps" role="tablist" aria-multiselectable="true" class="card-collapse">
                                    @foreach($slider->steps as $step)
                                        <div class="card step-card mb-3" id="new-step-{{ $step->position }}"
                                             data-position="{{ $step->position }}">
                                            <input type="hidden" class="step-id" name="steps[{{ $step->position }}][step_id]"
                                                   value="{{ $step->id }}">
                                            <div class="card-header " id="heading-{{ $step->position }}">
                                <span class="step-position float-left ml-3 text-primary align-middle"><i
                                        class="fa fa-sort fa-2x"></i></span>
                                                <a class="step-link" data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse-{{ $step->position }}"
                                                   aria-expanded="false"
                                                   aria-controls="collapse-{{ $step->position }}">
                                    <span class="h4 ml-3 text-center">
                                        Slider item <label class="step-number">{{ $loop->iteration }}</label>
                                        <label class="step-title h3">{{ $step->title }}</label>
                                    </span>
                                                    <i class="mr-3 nc-icon nc-minimal-down"></i>
                                                </a>
                                            </div>
                                            <div id="collapse-{{ $step->position }}" class="step-collapse collapse" role="tabpanel"
                                                 aria-labelledby="heading-{{ $step->position }}">
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div
                                                            class="form-group col-md-6 error-danger error-danger-steps-{{ $step->position  }}-main_text">
                                                            <label> Main text </label>
                                                            <input type="text" class="form-control submit-data input-main_text"
                                                                   placeholder="Main text" name="steps[{{ $step->position }}][main_text]"
                                                                   value="{{ $step->main_text }}"
                                                                   required>
                                                            <span
                                                                class="text-danger d-none error-span error-steps-{{ $step->position  }}-main_text"></span>
                                                        </div>
                                                        <div
                                                            class="form-group col-md-6 error-danger error-danger-steps-{{ $step->position  }}-second_text">
                                                            <label> Second text </label>
                                                            <input type="text" class="form-control submit-data input-second_text"
                                                                   placeholder="Second text" name="steps[{{ $step->position }}][second_text]"
                                                                   value="{{ $step->second_text }}"
                                                                   required>
                                                            <span
                                                                class="text-danger d-none error-span error-steps-{{ $step->position  }}-second_text"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div
                                                            class="form-group col-md-6 error-danger error-danger-steps-{{ $step->position  }}-image_desktop error-danger-steps-{{ $step->position  }}-media_id error-danger-steps-{{ $step->position  }}">
                                                            <label class="asterisk"> Main image</label>
                                                            @include('partials.media.form', [
                                                                    'mediaUrl' => optional($step->desktopImage())->getUrl(),
                                                                    'inputName' => "steps[". $step->position ."][image_desktop]",
                                                                    'mediaName' => "steps[". $step->position ."][media_desktop_id]",
                                                                    'deleteName' => "steps[". $step->position ."][desktop_deleted]",
                                                                    'exists' => true,
                                                                    'resource' => $step,
                                                                    'mediaModal' => 'media-modal-desktop'
                                                               ])
                                                            <p class="form-control-label">Recommended dimensions: 1200px x 700px <span
                                                                    class="image-desktop-portrait"></span>
                                                            </p>
                                                            <span
                                                                class="text-danger d-none error-span error-steps-{{ $step->position  }}-image_desktop error-steps-{{ $step->position  }}-media_id error-steps-{{ $step->position  }}"></span>
                                                        </div>
                                                        <div
                                                            class="form-group col-md-6 error-danger error-danger-steps-{{ $step->position  }}-image_mobile error-danger-steps-{{ $step->position  }}-media_id error-danger-steps-{{ $step->position  }}">
                                                            <label class="asterisk"> Second image</label>
                                                            @include('partials.media.form', [
                                                                    'mediaUrl' => optional($step->mobileImage())->getUrl(),
                                                                    'inputName' => "steps[". $step->position ."][image_mobile]",
                                                                    'mediaName' => "steps[". $step->position ."][media_mobile_id]",
                                                                    'deleteName' => "steps[". $step->position ."][mobile_deleted]",
                                                                    'exists' => true,
                                                                    'resource' => $step,
                                                                    'mediaModal' => 'media-modal-mobile'
                                                               ])
                                                            <p class="form-control-label">Recommended dimensions: 1200px x 700px <span
                                                                    class="image-desktop-portrait"></span>
                                                            </p>
                                                            <span
                                                                class="text-danger d-none error-span error-steps-{{ $step->position  }}-image_mobile error-steps-{{ $step->position  }}-media_id error-steps-{{ $step->position  }}"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <button class="btn btn-danger btn-round btn-sm step-delete">Delete step
                                                            </button>
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
    </form>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-primary" id="add-new-step"> Add new step</button>
                        </div>
                        <div class="col-6 ml-auto mr-auto text-right">
                            <a href="{{ route('sliders.index') }}" class="btn"> Cancel </a>
                            <button id="submit" type="button" class="btn btn-primary"> Save Slider</button>
                        </div>
                    </div>
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
        stepsNumber = {{ $slider->steps->count() + 1 }};

        $('body').on('click', '#submit', function () {
            let button = $(this);
            button.addClass('disabled');
            let data = new FormData($("#slider-form").get(0));
            data.append('_method', 'put');
            $.each(deletedIds, function (index, id) {
                data.append('deleted_steps[]', id);
            })

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('sliders.update', $slider) }}",
                dataType: 'json',
                type: 'post',
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    window.location.href = data.redirect;
                    button.removeClass('disabled');
                },
                error: function (data) {
                    showErrors(data.responseJSON);
                    button.removeClass('disabled');
                }
            });
        })
    </script>
@endsection
