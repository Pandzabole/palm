let mediaHolder;

$('.media-modal').on('show.bs.modal', function (e) {
    mediaHolder = $(e.relatedTarget).closest('.fileinput');
    $('body').on('click', '.image-select', function () {
        let mediaUrl = $(this).attr('data-media-url');
        let mediaId = $(this).attr('data-media-id');
        mediaHolder.find('.fileinput-preview').empty().html("<img class='mw-100' style='object-fit: contain;' src='" + mediaUrl + "' alt='...'>");
        mediaHolder.removeClass('fileinput-new').addClass('fileinput-exists');
        mediaHolder.find('.existing-image').val(mediaId);
    });
});

