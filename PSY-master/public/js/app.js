/*global Pikaday*/
(function () {
    'use strict';
    function applyPickers() {
        var pickers = document.querySelectorAll('.datepicker'),
            i = 0,
            len = pickers.length;

        window.elements = {
            datePickers: []
        };

        for (i = 0; i < len; ++i) {
            window.elements.datePickers.push(new Pikaday({
                field: pickers[i],
                format: pickers[i].getAttribute('data-format')
            }));
        }

    }

    function initDynamicLists() {

    }

    function handleDynamicList(container) {
        var htmlContent = container.innerHTML,
            frag = document.createDocumentFragment();

        frag.innerHTML = htmlContent;
        container.innerHTML = "";

    }

    applyPickers();

}());
