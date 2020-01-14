<?php
    $fileName = $_GET['fileName'];
    $fileType = $_GET['fileType'];

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Pragma: no-cache"); 
    header("Expires: 0");

    $solDetalleJSON = get_curl('200/detalle/solicitud/'.$fileType);

    echo '<table border="1">';
    echo '<tr><th>Company Name</th><th>CONFEDERACION SUDAMERICANA DE FUTBOL</th><th>Field Name 3</th></tr>';

    if ($solDetalleJSON['code'] === 200) {
        foreach ($solDetalleJSON['data'] as $key => $value) {
            echo "<tr><td>".$row['field1']."</td><td>".$row['field2']."</td><td>".$row['field3']."</td></tr>";
        }
    }

    echo '</table>';
?>