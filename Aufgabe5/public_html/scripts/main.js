$(document).ready(function($) {
    "use strict";

    // Lets trigger the form validation when the revalidation flag is set.
    $('form[data-rerevalidate]').each(function() {
        var form = $(this).get(0);
        if ($.isFunction(form.reportValidity)) {
            form.reportValidity();
        }
    });


    $('form#search_form').submit(function(event) {
        var query = $(this).find(':input').val();
        var action = $(this).attr('action');
        action = action.replace('${query}', query);
        event.preventDefault();
        window.location.href=action;
    });

});
