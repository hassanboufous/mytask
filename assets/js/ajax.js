$("#load-bar").hide();
$("#messages").hide();

$("#theform").submit(function (e) {
  e.preventDefault();
  $("#data-table").hide();
  $("#load-bar").show();

  startAnimation();

  setTimeout(function () {
    $("#load-bar").hide();
    $("#data-table").show();
  }, 5500);

  var formData = new FormData();
  var file = $("#file")[0].files[0];
  formData.append("file", file);
  $.ajax({
    url: "controllers/load-data.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      $("#data-table").html(response);
    },
    error: function (errorThrown) {},
  });
});

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

// showing the progress bar while loading the file
let progressElem = document.querySelector(".progress-elem");
let progressElemSvg = document.querySelector(".progress-elem svg");
let progressBar = document.querySelector(".progress-bar");
let success = document.querySelector(".success");
let progressTextContainer = document.querySelector(".progress-text-container");
let progressTextInner = document.querySelector(".progress-text-inner");

let interval;

function startAnimation() {
    clearInterval(interval);
    progressTextInner.innerHTML = 0;
    progressTextContainer.style.display = "";
    success.style.display = "none";

    let initial = 251.3274;
    let increment = 251.3274 / 100;
    let incrementCount = 0;
    interval = setInterval(() => {
        if (incrementCount === 100) {
        initial = 0;
        progressBar.style.strokeDashoffset = initial;
        clearInterval(interval);
        setTimeout(() => {
            progressTextContainer.style.display = "none";
            success.style.display = "";
        }, 100);
        } else {
        initial -= increment;
        progressBar.style.strokeDashoffset = initial;
        incrementCount += 1;

        if (incrementCount !== 100) {
            progressTextInner.innerHTML = incrementCount;
        }
        }
    }, 50);
}
