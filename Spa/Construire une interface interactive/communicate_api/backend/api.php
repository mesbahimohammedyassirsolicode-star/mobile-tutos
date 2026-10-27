<?php


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}
$file = __DIR__ . '/categories.json';

if (!file_exists($file)) {
    $categories = [
        ["id" => 1, "nom" => "Développement", "couleur" => "red"],
        ["id" => 2, "nom" => "Design UI/UX", "couleur" => "blue"],
        ["id" => 3, "nom" => "Productivité", "couleur" => "green"]
    ];

    file_put_contents($file, json_encode($categories));
}

$categories = json_decode(file_get_contents($file), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"), true);

    $data['id'] = count($categories) + 1;

    $categories[] = $data;

    file_put_contents($file, json_encode($categories));

    echo json_encode($data);

} 
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'];

    $categories = array_filter($categories, function ($category) use ($id) {
        return $category['id'] != $id;
    });

    $categories = array_values($categories);

    file_put_contents($file, json_encode($categories));

    echo json_encode([
        "message" => "Catégorie supprimée"
    ]);
}else {

    echo json_encode($categories);
}