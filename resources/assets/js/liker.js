const saveLike = (el, state) => {
    const url = (state ? 'like' : 'unlike') + '/' + el.data('id');
    el.attr('disabled', true);
    console.log('calling ' + url);
    $.ajax(url, {
        success: function(result) {
            console.log('response received', result);
            el.attr('disabled', false);
        },
    });
};

export const doLike = (el, state, save = true) => {
    if (state) {
        el.removeClass('btn-light');
        el.addClass('btn-primary');
        el.text('Liked');
    } else {
        el.addClass('btn-light');
        el.removeClass('btn-primary');
        el.text('Like');
    }
    if (save) {
        saveLike(el, state);
    }
};

export const toggleLike = (el) => {
    const newState = el.text() === 'Like';
    doLike(el, newState);
};
