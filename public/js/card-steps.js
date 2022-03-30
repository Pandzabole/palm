let body = 'body';
stepsNumber = 1;
deletedIds = [];

function setNewStepProperties(newStep, stepsNumber) {
    newStep.attr('id', 'new-step-' + stepsNumber).attr('data-position', stepsNumber);
    newStep.find('.step-number').text(stepsNumber);
    newStep.find('.step-title').text(newStep.find('.input-title').val());
    newStep.find('.card-header').attr('id', 'heading-' + stepsNumber);
    newStep.find('.step-link').attr('href', '#collapse-' + stepsNumber).attr('aria-controls', 'collapse-' + stepsNumber);
    newStep.find('.step-collapse').attr('id', 'collapse-' + stepsNumber).attr('aria-labelledby', 'heading-' + stepsNumber);

    let inputCta = newStep.find('.input-main_text');
    let inputUrl = newStep.find('.input-second_text');
    let inputImageDesktop = newStep.find('.input-image_desktop');
    let inputImageMobile = newStep.find('.input-image_mobile');
    let inputMediaDesktop = newStep.find('.media_desktop_id');
    let inputMediaMobile = newStep.find('.media_mobile_id');

    inputCta.attr('name', 'steps[' + stepsNumber + '][main_text]');
    inputUrl.attr('name', 'steps[' + stepsNumber + '][second_text]');
    inputImageDesktop.attr('name', 'steps[' + stepsNumber + '][image_desktop]');
    inputImageMobile.attr('name', 'steps[' + stepsNumber + '][image_mobile]');
    inputMediaDesktop.attr('name', 'steps[' + stepsNumber + '][media_desktop_id]');
    inputMediaMobile.attr('name', 'steps[' + stepsNumber + '][media_mobile_id]');

    let inputCtaFormGroup = inputCta.closest('.error-danger');
    let inputUrlFormGroup = inputUrl.closest('.error-danger');
    let inputImageDesktopFormGroup = inputImageDesktop.closest('.error-danger');
    let inputImageMobileFormGroup = inputImageMobile.closest('.error-danger');

    inputCtaFormGroup.addClass('error-danger-steps-' + stepsNumber + '-main_text');
    inputUrlFormGroup.addClass('error-danger-steps-' + stepsNumber + '-second_text');
    inputImageDesktopFormGroup.addClass('error-danger-steps-' + stepsNumber + '-image_desktop').addClass('error-danger-steps-' + stepsNumber + '-media_desktop_id').addClass('error-danger-steps-' + stepsNumber);
    inputImageMobileFormGroup.addClass('error-danger-steps-' + stepsNumber + '-image_mobile').addClass('error-danger-steps-' + stepsNumber + '-media_mobile_id').addClass('error-danger-steps-' + stepsNumber);

    inputCtaFormGroup.find('.error-span').addClass('error-steps-' + stepsNumber + '-main_text');
    inputUrlFormGroup.find('.error-span').addClass('error-steps-' + stepsNumber + '-second_text');
    inputImageDesktopFormGroup.find('.error-span').addClass('error-steps-' + stepsNumber + '-image_desktop').addClass('error-steps-' + stepsNumber + '-media_desktop_id').addClass('error-steps-' + stepsNumber);
    inputImageMobileFormGroup.find('.error-span').addClass('error-steps-' + stepsNumber + '-image_mobile').addClass('error-steps-' + stepsNumber + '-media_mobile_id').addClass('error-steps-' + stepsNumber);
}

$(body).on('click', '#add-new-step', function () {
    let template = $('#step-card-template');
    let newStep = template.clone();

    $('.step-collapse').removeClass('show');
    $('.step-link').attr('aria-expanded', false);

    newStep.removeClass('d-none');
    newStep.find('.step-link').attr('aria-expanded', true)
    newStep.find('.step-collapse').addClass('show')

    setNewStepProperties(newStep, stepsNumber);

    $('#steps').append(newStep);

    $(body).animate({
        scrollTop: $('#heading-' + stepsNumber).offset().top
    }, 1000);

    stepsNumber++;
});

$("#steps").sortable({
    handle: '.step-position',
    stop: function (event, ui) {
        let startStepPosition = parseInt(ui.item.attr('data-position'));
        let stopStepPosition = ui.item.index() + 1;
        let reorders = [];

        reorders.push({"old": startStepPosition, "new": stopStepPosition});

        while (stopStepPosition < startStepPosition) {
            reorders.push({"old": stopStepPosition, "new": stopStepPosition + 1});
            stopStepPosition++;
        }

        while (startStepPosition < stopStepPosition) {
            reorders.push({"old": startStepPosition + 1, "new": startStepPosition});
            startStepPosition++;
        }

        $.each(reorders, function (key, value) {
            $('[data-position="' + value.old + '"]').addClass('changed').attr('data-new-position', value.new);
        });

        $('.changed').each(function () {
            let stepElement = $(this);
            setNewStepProperties(stepElement, stepElement.attr('data-new-position'));
            $(this).removeClass('changed').removeAttr('data-new-position');
        });
    }
});

$(body).on('click', '.step-delete', function () {
    let deletedCard = $(this).closest('.step-card');
    let deletedNumber = deletedCard.attr('data-position');
    let deletedId = deletedCard.find('.step-id').val();

    deletedCard.remove();
    if (deletedId) {
        deletedIds.push(deletedId);
    }

    $('.step-card').each(function (key, stepCard) {
        let stepNumber = parseInt($(stepCard).attr('data-position'));
        stepsNumber = stepNumber + 1;
        if (stepNumber > deletedNumber) {
            stepsNumber = stepNumber;
            setNewStepProperties($(stepCard), stepNumber - 1);
        }
    })
});

$(body).on('keyup', '.input-title', function () {
    $(this).closest('.step-card').find('.step-title').html($(this).val());
});

function showErrors(data) {
    hideErrors();
    let errors = data.errors;
    if (errors) {
        $.each(errors, function (name, message) {
            let inputFiled = $('.error-danger-' + name.replace(/\./g, '-'));
            inputFiled.closest('.step-card').addClass('border-danger');
            inputFiled.addClass('has-danger');
            $('.error-' + name.replace(/\./g, '-')).removeClass('d-none').text('* ' + message[0]);
        });
    }
}

function hideErrors() {
    $('.error-span').addClass('d-none').text('');
    $('.step-card').removeClass('border-danger');
    $('.error-danger').removeClass('has-danger');
}
