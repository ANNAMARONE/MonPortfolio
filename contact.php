<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validation des champs
    if (empty($name) || strlen($name) < 4) {
        echo json_encode(["status" => "error", "message" => "Le nom doit contenir au moins 4 caractères."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Adresse email invalide."]);
        exit;
    }

    if (empty($message)) {
        echo json_encode(["status" => "error", "message" => "Le message ne peut pas être vide."]);
        exit;
    }

    // Configuration de l'email
    $to = "annamarone72@gmail.com"; 
    $subject = "Nouveau message de $name";
    $body = "Nom: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    // Tentative d'envoi de l'email
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["status" => "success", "message" => "Votre message a été envoyé avec succès !"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Une erreur est survenue lors de l'envoi de l'email."]);
    }
    exit;
}
?>
