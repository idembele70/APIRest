
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
    default:
        echo "Par defaut : ";
        getNameEntraineurs();
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

function updateProduct($id)
{
    global $conn;
    $_PUT = array();
    parse_str(file_get_contents('php://input'), $_PUT);
    $name = $_PUT['name'];
    $description = $_PUT['description'];
    $price = $_PUT['price'];
    $category = $_PUT['category'];
    $created = 'NULL';
    $modified = date('Y-m-d H:i:s');
    $query = "UPDATE produit SET name = '" . $name . "', description = '" . $description . "', price = '" . $price . "', 
    category = '" . $category . "', modified = '" . $modified . "', WHERE id='" . $id . "'";

    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Produit mis a jour avec succes.'
        );
    } else {
        $reponse = array(
            'status' => 1,
            'status_message' => 'Echec de la mise à jour de produit' . mysqli_error($conn)
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

?>