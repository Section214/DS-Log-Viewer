/*global jQuery, document, window, CodeMirror*/
jQuery(document).ready(function ($) {
    'use strict';

    var textArea = document.getElementById('ds-log-viewer');
    CodeMirror.fromTextArea(textArea, {
        theme: 'eclipse',
        lineNumbers: true,
        readOnly: true,
        autofocus: true
    });

    $('.sk-fading-circle').remove();
});