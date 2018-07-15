import {doLike, toggleLike} from './liker.js';

// view
$('#viewModal').on('show.bs.modal', function(event) {
    const modal = $(this);
    const button = $(event.relatedTarget);
    const id = button.data('id');
    const name = button.data('name');
    const liked = button.data('liked');

    modal.find('.modal-title').text(name);
    modal.find('.modal-body > video').prop('src', '/videos/' + id);
    const liker = modal.find('.modal-footer > .liker');
    doLike(liker, liked, false);
    liker.data('id', id);
});
$('#viewModal .liker').click(function() {
    toggleLike($(this));
});

// edit
$('#editModal').on('show.bs.modal', function(e) {
    const modal = $(this);
    const button = $(e.relatedTarget);
    const id = button.data('id');
    const name = button.data('name');
    const location_id = button.data('location_id');
    const keywords = button.data('keywords') || [];

    modal.find('form').prop('action', '/videos/' + id);
    modal.find('#name').val(name);
    modal.find('#location_id').val(location_id);
    keywords.forEach(function(kw) {
        modal.find('#kw-' + kw.id).prop('checked', true);
    });
});
$('#editModal .do-save').click(function() {
    $(this).parents('form').submit();
});

// del
$('#delModal').on('show.bs.modal', function(e) {
    const modal = $(this);
    const button = $(e.relatedTarget);
    const id = button.data('id');
    const title = button.data('name');

    modal.find('form').prop('action', '/videos/' + id);
    modal.find('.modal-body').text('Delete video "' + title + '"?');
});
$('#delModal .do-del').on('click', function() {
    $(this).parents('form').submit();
});
