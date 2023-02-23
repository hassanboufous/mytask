<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/nofiy.css" rel="stylesheet">
</head>

<body class="container bg-light">

    <form enctype="multipart/form-data" id="theform" class="form-group m-5 d-flex">
        <input type="file" name="file" accept=".xls,.xlsx,.csv" class="form-control" id="file" required>
        <button type="submit" name="save" class="btn btn-warning">Upload</button>
    </form>

    <div id="messages">
        <input type="checkbox" id="one" class="hidden" name="ossm">
        <label for="one" class="alert-message text-center">
            <strong> <i class="fa fa-heart mr-5"></i>
                <span class="success">Success</span></strong> Your data has been stored successfully !! ...
            <span class="close">×</button>
        </label>
    </div>

    <!-- Progress bar  -->
    <div class="progress-elem" style="max-width: 110px; margin: 40px auto;" id="load-bar">
        <svg style="transform: rotate(90deg)" height="100%" viewBox="0 0 110 110" width="100%" style="overflow: visible;">
            <!-- gray dashed -->
            <circle cx="50%" cy="50%" fill="none" stroke-width="20" r="40" stroke="#D4D4D8" stroke-dasharray="1.4137,1.4137"></circle>
            <!-- green solid -->
            <circle class="progress-bar" cx="50%" cy="50%" fill="none" stroke-width="20" r="40" stroke="#19C558" style="stroke-dashoffset: 251.3274; stroke-dasharray: 251.3274;"></circle>
            <!-- inner black stroke -->
            <circle cx="50%" cy="50%" fill="none" stroke-width="1.5" r="27.5" stroke="#27272A"></circle>
            <!-- outer black stroke -->
            <circle cx="50%" cy="50%" fill="none" stroke-width="1.5" r="52.5" stroke="#27272A"></circle>
            <g class="success" style="display:none;">
                <!-- inner solid green success -->
                <circle cx="50%" cy="50%" fill="#19C558" r="50"></circle>
                <!-- checkmark line -->
                <polyline points="52 74, 65 60, 40 36" stroke="#fff" fill="none" stroke-width="10" />
            </g>
        </svg>
        <div class="progress-text-container">
            <div class="progress-text">
                <span class="progress-text-inner">0</span><span class="progress-text-percent">%</span>
            </div>
        </div>
    </div>

    <!-- Uploaded data -->
    <div id="data-table"></div>






    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/ajax.js"></script>
</body>

</html>