<!DOCTYPE html>
<html>
<head>
    <title>Connecting to a database</title>
</head>
<body>
<?php
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "php_pracitc";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $mesaj = $_POST['Mesaj'];
    $numarordine = $_POST['NumarOrdine'];
    $timp = $_POST['Timp'];
    $tip = $_POST['Tip'];
    if($tip == 'adaugare'){
        //Adaugare
        $gasit = false;
    
        $results_mesages= mysqli_query($conn, "SELECT mesaj_id FROM mesages");
        while($row = mysqli_fetch_row($results_mesages)){
            if($row[0] == $numarordine) $gasit = true;
        }
        if ($gasit == false){
            mysqli_query($conn,"INSERT INTO mesages(mesaj_id,mesaj_secunde,mesaj_text) VALUES('$numarordine','$timp','$mesaj')");
            $string = 'A fost introdus';
            echo $string;
        }
        else {
            $string = 'Exista deja in baza de date un mesaj cu numarul de ordin respectiv';
            echo $string;
        }
        
    }
    if($tip == 'modificare'){
        //Modificare
        $gasit = false;
    
        $results_mesages= mysqli_query($conn, "SELECT mesaj_id FROM mesages");
        while($row = mysqli_fetch_row($results_mesages)){
            if($row[0] == $numarordine) $gasit = true;
        }
        if ($gasit == false){
            $string = 'Nu a fost gasit';
            echo $string;
        }
        else{
            if(mysqli_query($conn,"UPDATE mesages SET mesaj_secunde = '".$timp."', mesaj_text = '".$mesaj."'  WHERE mesaj_id = '".$numarordine."'") == TRUE){
                echo "A fost modificat";
            }
            else{
                echo "Eroare la modificare";
            }
        }
    }
    if($tip == 'stergere') {
        //Stergere
        $gasit = false;
    
        $results_mesages= mysqli_query($conn, "SELECT mesaj_id FROM mesages");
        while($row = mysqli_fetch_row($results_mesages)){
            if($row[0] == $numarordine) $gasit = true;
        }
        if ($gasit == false){
            $string = 'Nu a fost gasit';
            echo $string;
        }
        else{
            if(mysqli_query($conn, "DELETE FROM mesages WHERE mesaj_id = '".$numarordine."'") == true){
                echo "A fost sters";
            }
            else{
                echo "Eroare la stergere";
            }
        }
    }

    $conn->close();
?>
</body>
</html>