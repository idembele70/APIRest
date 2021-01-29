
<?php
include('db_connect.php');
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            getNameEntraineur($id);
        } else {
            getNameEntraineurs();
        }
        break;
        case 'PUT':
            $id = intval($_GET['id']);
            updateProduct($id);
            break;
}
function getNameEntraineurs()
{
    global $conn;
    $query = "SELECT * FROM entraineurs";
    $response = array();
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function getNameEntraineur($id)
{
    global $conn;
    $query = "SELECT * FROM entraineurs WHERE id = '" . $id . "'";
    $response = array();
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function updateEntraineur($id)
{
    global $conn;
    $_PUT = array();
    parse_str(file_get_contents('php://input'), $_PUT);
    $nomEntraineur = $_PUT['nomEntraineur'];
    $typeEntraineurs = $_PUT['typeEntraineurs'];
    $salaire = $_PUT['salaire'];
    $tactique = $_PUT['tactique'];
    $created = 'NULL';
    $modified = date('Y-m-d H:i:s');
    $query = "UPDATE entraineurs SET nomEntraineur = '" . $nomEntraineur . "', typeEntraineurs = '" . $typeEntraineurs . "', salaire = '" . $salaire . "', 
    tactique = '" . $tactique . "' WHERE id='" . $id . "'";

    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'information sur l\'entraineurs mis a jour avec succes.'
        );
    } else {
        $reponse = array(
            'status' => 1,
            'status_message' => 'Echec de la mise à jour des informations sur  l\'entraineurs' . mysqli_error($conn)
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

//

function addEntraineur()
{
    global $conn;
    
    $nomEntraineur = $_POST['nomEntraineur'];
    $typeEntraineurs = $_POST['typeEntraineurs'];
    $salaire = $_POST['salaire'];
    $tactique = $_POST['tactique'];
    $query = "INSERT INTO entraineurs (nomEntraineur, typeEntraineurs,tactique, salaire) VALUES ('" . $nomEntraineur . "','" . $typeEntraineurs . "',
   '" . $tactique . "', '" . $salaire . "') ";

    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Le nouveaux entraineurs ajouté avec success.'
        );
    } else {
        $response = array(
            'status' => 1,
            'status_message' => 'Echec de l\'ajout de l\'entraineurs' . mysqli_error($conn)
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function deleteProduct($id)
{
    global $conn;
    $query = "DELETE FROM entraineurs WHERE id=" . $id;

    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'L\'entraineurs a été supprimer.'
        );
    } else {
        $response = array(
            'status' => 1,
            'status_message' => 'Echec de la suppression de l\'entraineurs' . mysqli_error($conn)
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

?>