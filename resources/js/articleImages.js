document.addEventListener("DOMContentLoaded", function () {

    if ($("#drophere").length > 0) {
        
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
            },
            addRemoveLinks : true,
            init:function(){
                $.ajax({
                    type:'GET',
                    url:'article/images',
                    data:{
                        uniqueSecret:uniqueSecret,
                    },
                    datatype:'json'
                }).done(function(data){
                    $.each(data, function(key,value){
                        let file = {serverId:value.id};
                            myDropzone.options.addedfile.call(myDropzone,file);
                            myDropzone.options.thumbnail.call(myDropzone,file,value.src);
                        
                    });
                });
            }
        });

        myDropzone.on("success", function(file,response){
            file.serverId = response.id;
        });

        myDropzone.on("removedfile", function(file){
            $.ajax({
                type:'DELETE',
                url: '/article/images/remove',
                data: {
                    _token: csrfToken,
                    id: file.serverId,
                    uniqueSecret:uniqueSecret
                },
                dataType: 'json'
            });

        });

    }
})