
$("#theform").submit(function (e) {
  e.preventDefault();
  $("#data-table").hide();
  $("#load-bar").show();
  $("#progress-bar").show();

// Upload files
  var formData = new FormData();
  var file = $("#file")[0].files[0];
  formData.append("file", file);
  $.ajax({
    url: "controllers/load-data.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      // tracking the load progress
      xhr.upload.addEventListener("progress",function (evt) {
              let percent = Math.round((evt.loaded / evt.total) * 100);
               // Loading function increase the progress bar based on the loading progress 
               loading(percent);
               if(percent > 99){
                  setTimeout(() => {
                    $("#progress-bar").hide();
                    $("#data-table").show();
                  }, 1000);
               }
        });
      return xhr;
    },
    success: function (response) {
      $("#data-table").html(response);
    },
    error: function (errorThrown) {
      console.log(errorThrown)
    },
  });
});


// validate data and store into Database
function validate(path) {
  alert("submit data to database");
  $.ajax({
    url: "controllers/load-data.php",
    type: "POST",
    data: {
      validation: true,
      directory: path,
    },
    success: function (response) {
      if (response > 0) {
        $("#data-table").hide();
        $("#messages").show();
        setTimeout(function () {
          $("#messages").fadeOut();
          $("#file").val("");
        }, 3000);
      }
    },
    error: function (errorThrown) {},
  });
}

// Cancel submitting --------------------
function clearData(){
  $("#data-table").hide();
}

function loading(progress) {

       var interval = setInterval(function () {
        if (progress <= 99) {
          progress += 1;
        }
        $(".progress__counter1").text(progress + "%");
        var dasharray = (283 / 100) * progress;
        $(".progress__fg").css("stroke-dasharray", dasharray + ", 283");
        if (progress >= 100) {
          clearInterval(interval);
        }
      }, progress);
  };