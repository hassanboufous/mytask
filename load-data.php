<?php
//require 'excelReader/excel_reader2.php';
require 'excelReader/SpreadsheetReader.php';
require 'db/database.php';


$tableX = $tableZ = $tableY = array();

if (isset($_FILES["file"])) {
    $file = $_FILES["file"];
    $filename = $file["name"];
    $tmp_path = $file["tmp_name"];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // Check if the file is a CSV or Excel file
    if ($extension == 'csv' || $extension == 'xlsx') {
        // Read the file data
        if ($extension == 'csv') {
            $data = array_map('str_getcsv', file($tmp_path));
        }else{
            $new_file_name = date('Y.m.d') . '.' . $extension;
            $Directory = 'uploads/' . $new_file_name;
            move_uploaded_file($file["tmp_name"], $Directory);
            $reader = new SpreadsheetReader($Directory);
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
            
            
            // Display the data to the user for validation 
               if (isset($tableX) && isset($tableY) && isset($tableZ)) {
                     echo '
                                <table class="table table-info mx-auto">
                                    <thead>
                                        <tr class="table-danger">
                                            <th>TableX</th>
                                            <th>TableY</th>
                                            <th>TableZ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                            <button onclick="validate(\''.$Directory.'\')" class="btn btn-success mx-auto mt-3">Validate and submit</button>
                    '; 
                }
            }
        }
}

// Submit imported data to the database 
if (isset($_POST["validation"])) {
    $pdo = new Dbh();
    
    $Directory = $_POST['directory'];
    $reader = new SpreadsheetReader($Directory);
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
    $res = $pdo->content()->exec("INSERT INTO tablex 
                 (fieldOne ,fieldTwo , fieldThree,fieldFour ,fieldFive ,fieldSix ,fieldSeven, fieldEight , fieldNine ,fieldTen) VALUES 
                ('". $tableX[0]. "','" . $tableX[1] ."','" . $tableX[2] ."','" . $tableX[3]. "','". $tableX[4] . "','"  .$tableX[5] . "','" . $tableX[6]."','".$tableX[7] . "','"  . $tableX[8] . "','" . $tableX[9]. "')");
    echo $res;
    exit();
}


?>