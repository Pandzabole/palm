<div class="card step-card d-none mb-3" id="step-card-template">
    <div class="card-header" id="heading">
        <span class="step-position float-left ml-3 text-primary align-middle"><i class="fa fa-sort fa-2x"></i></span>
        <a class="step-link" data-toggle="collapse" data-parent="#accordion" href="#collapse" aria-expanded="true"
           aria-controls="collapse">
            <span class="h4 ml-3 text-center">
                Slider Item <label class="step-number"></label>
                <label class="step-title h3"></label>
            </span>
        </a>
    </div>
    <div id="collapse" class="step-collapse collapse show" role="tabpanel" aria-labelledby="heading">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6 error-danger">
                    <label> CTA </label>
                    <input type="text" class="form-control submit-data input-cta" placeholder="CTA" name="cta"
                           value=""
                           required>
                    <span class="text-danger d-none error-span"></span>
                </div>
                <div class="form-group col-md-6 error-danger">
                    <label> URL </label>
                    <input type="text" class="form-control submit-data input-url" placeholder="URL" name="url"
                           value=""
                           required>
                    <span class="text-danger d-none error-span"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 error-danger">
                    <label class="form-control-label" for="image">Desktop Image</label>
                    @include('partials.media.form', ['inputName' => 'image_desktop', 'mediaName' => 'media_desktop_id',  'mediaModal' => 'media-modal-desktop', 'exists' => false])
                    <p class="form-control-label">Required image: landscape <span
                            class="image-desktop-portrait"></span>
                        <span
                            class="form-control-label recommended-image-dimension">width: 1920px, height: 950px</span>
                    </p>
                    <span class="text-danger d-none error-span"></span>
                </div>
                <div class="form-group col-md-6 error-danger">
                    <label class="form-control-label" for="image">Mobile Image</label>
                    @include('partials.media.form', ['inputName' => 'image_mobile', 'mediaName' => 'media_mobile_id', 'mediaModal' => 'media-modal-mobile', 'exists' => false])
                    <p class="form-control-label">Required image: portrait <span
                            class="image-mobile-portrait"></span>
                        <span
                            class="recommended-image-dimension form-control-label"> width: 750px,  height: 1686px</span>
                    </p>
                    <span class="text-danger d-none error-span"></span>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button class="btn btn-danger btn-round btn-sm step-delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
