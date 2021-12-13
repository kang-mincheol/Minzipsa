$(function(){
    $("#btnUpload").click(function(){
        var formData = new FormData();

        i = 0;
        $($("input[name=files]")[0].files).each(function(){
            formData.append("files_" + i, $("input[name=files]")[0].files[i]);
            i++;
        })
       
        $.ajax({
          url: '/api/files/upload.php',
          data: formData,
          processData: false,
          contentType: false,
          type: 'POST',
          xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var percentComplete = (evt.loaded / evt.total) * 100;
                    console.log(percentComplete);
                    $("#pgfile").val(percentComplete);
                    //Do something with upload progress here
                }
           }, false);
           return xhr;
          },
          success: function(data){
              console.log(data);
          },
          error: function(data){
              console.log(data.responseText);
          }
        });
    });
});