$(document).ready(function($) {
    "use strict";

    // Lets trigger the form validation when the revalidation flag is set.
    $('form[data-rerevalidate]').each(function() {
        var form = $(this).get(0);
        if ($.isFunction(form.reportValidity)) {
            form.reportValidity();
        }
    });

});
