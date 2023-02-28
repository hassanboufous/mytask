<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="assets/css/nofiy.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/progressbar.css">

</head>

<body class="container bg-light" style="background-image:url('assets/imgs/mainbg.jpg');">
    <!-- ----------- Upload file section------------------ -->
    <div class="text-center text-white pt-5">
        <h3>Upload file </h3>
        <p>Allowed extentions : <span class="text-warning">.xsl , .xslx , .CSV</span></p>

    </div>
    <form enctype="multipart/form-data" id="theform" class="form-group m-5 d-flex">
        <input type="file" name="file" class="form-control" id="file" required style="background-color:#cfdae6;">
        <button type="submit" name="save" class="btn btn-light text-danger">Upload</button>
    </form>

    <!--------- Alert Messages ------------->
    <div id="messages" style="display: none;">
        <input type="checkbox" id="one" class="hidden" name="ossm">
        <label for="one" class="alert-message text-center" style="background-color:#e6ae47;">
            <strong> <i class="fa fa-heart mr-5"></i>
                <span class="text-success">Success</span></strong> Your data has been stored successfully !! ...
            <span class="close">×</button>
        </label>
    </div>

    <!-- Progress bar  -->
    <div class="progress1" id="progress-bar" style="display: none;">
        <div class="progress__counter1 text-white">0%</div>
        <svg class="progress__svg" viewBox="0 0 100 100">
            <circle class="progress__bg" cx="50" cy="50" r="45" />
            <circle class="progress__fg" cx="50" cy="50" r="45" />
        </svg>
    </div>
    <!-- Uploaded data -->
    <div id="data-table"></div>




    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>