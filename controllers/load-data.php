<?php
require 'excelReader/SpreadsheetReader.php';
require '../database/database.php';
require 'helpers/upload-file.php';

$tableX = $tableZ = $tableY = array();

if (isset($_FILES["file"])) {
    $file = $_FILES["file"];
    $filename = $file["name"];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // Check if the file is a CSV or Excel file
    if ($extension == 'csv' || $extension == 'xlsx'|| $extension == 'xls') {
        // Read the file data
        if ($extension == 'csv') {
            // $data = array_map('str_getcsv', file($tmp_path));
        }
        else{
            $path = '../uploads/';
            $file_path = UploadFile::upload($file,$path);
            if(!empty($file_path)){
                $reader = new SpreadsheetReader($file_path);
    
                $data = array();
                foreach ($reader as $key => $row) {
                    array_push($data, $row);
                }
                
                $nbrRow = count($data);
                // Fill tables (X,Y,Z) with data that comes from excel sheet
                for ($i = 0; $i < $nbrRow - 1; $i++) {
                    array_push($tableX, $data[$i + 1][0]);
                    array_push($tableY, $data[$i + 1][1]);
                    array_push($tableZ, $data[$i + 1][2]);
                }
            }
            
            // Display the data to the user for validation 
               if (isset($tableX) && isset($tableY) && isset($tableZ)) {
                     echo '
                            <table class="table  mx-auto">
                                <thead class="table-light">
                                    <tr class="table-success">
                                        <th>TableX</th>
                                        <th>TableY</th>
                                        <th>TableZ</th>
                                    </tr>
                                </thead>
                                <tbody class="text-primary">
                                    ';
                                    for ($i = 0; $i < $nbrRow - 1; $i++) { 
                                    echo '
                                        <tr>
                                            <td>'.  $tableX[$i] .'</td>
                                            <td>'.  $tableY[$i] .'</td>
                                            <td>'.  $tableZ[$i] .'</td>
                                        </tr>
                                        ' ;
                                    } 
                                echo '
                                </tbody>

                            </table>
                            <div class="d-flex justify-content-between">
                                <button onclick="validate(\''.$file_path. '\')" class="btn btn-success">Save</button><button class="btn btn-danger ml-4" onclick="clearData()">Cancel</button>
                            </div>
                    '; 
                }
            }
        }
}


// Submit imported data to the database 
if (isset($_POST["validation"])) {
    
    $file_path = $_POST['directory'];
    $reader = new SpreadsheetReader($file_path);
    $data = array();

    foreach ($reader as $key => $row) {
        array_push($data, $row);
    }
    for ($i = 0; $i <count($data) - 1; $i++) {
        array_push($tableX, $data[$i + 1][0]);
        array_push($tableY, $data[$i + 1][1]);
        array_push($tableZ, $data[$i + 1][2]);
    }

    // Insert into table x 
    $pdo = new Dbh();
    $res = $pdo->content()->exec("INSERT INTO tablex 
                 (fieldOne ,fieldTwo , fieldThree,fieldFour ,fieldFive ,fieldSix ,fieldSeven, fieldEight , fieldNine ,fieldTen) VALUES 
                ('". $tableX[0]. "','" . $tableX[1] ."','" . $tableX[2] ."','" . $tableX[3]. "','". $tableX[4] . "','"  .$tableX[5] . "','" . $tableX[6]."','".$tableX[7] . "','"  . $tableX[8] . "','" . $tableX[9]. "')");

    $res .= $pdo->content()->exec("INSERT INTO tabley 
                 (fieldOne ,fieldTwo , fieldThree,fieldFour ,fieldFive ,fieldSix ,fieldSeven, fieldEight , fieldNine ,fieldTen) VALUES 
                ('". $tableY[0]. "','" . $tableY[1] ."','" . $tableY[2] ."','" . $tableY[3]. "','". $tableY[4] . "','"  .$tableY[5] . "','" . $tableY[6]."','".$tableY[7] . "','"  . $tableY[8] . "','" . $tableY[9]. "')");
    echo $res;
    exit();
}


?>