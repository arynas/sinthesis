var storeFile = function (file, folder, onSuccess, onProgress) {
    var url = "/files", data;

    data = new FormData;
    data.append("folder", folder);
    data.append("file", file);

    $.ajax({
        xhr: function() {
            var xhr = new window.XMLHttpRequest();

            xhr.upload.addEventListener("progress", function(e) {
                if (e.lengthComputable) {
                    var percentComplete = e.loaded / e.total;
                    percentComplete = parseInt(percentComplete * 100);
                    if (percentComplete === 100 && onProgress) {
                        onProgress(percentComplete);
                    }
                }
            }, false);

            return xhr;
        },
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(file){
            onSuccess(file);
        }
    });
};