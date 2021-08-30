document.addEventListener("DOMContentLoaded", function () {

    if ($("#drophere").length > 0) {
        console.log("ciao");
        function getAttribute(selector, attributeName) {
            return document.querySelectorAll(selector)[0].getAttribute(attributeName);
        }

        let csrfToken = getAttribute('meta[name="csrf-token"]', 'content');
        let uniqueSecret = getAttribute('input[name="uniqueSecret"]', 'value');

        let myDropzone = new window.Dropzone('#drophere', {
            url: '/article/images/upload',

            params: {
                _token: csrfToken,
                uniqueSecret: uniqueSecret
            }
        });
    }
})