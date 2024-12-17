<?php
session_start() ;

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "USER_ROLE" )
        header("location:../front/produits.php") ;
} else {
    header("location:../front/login.php") ;
}

require_once '../../phpqrcode/qrlib.php';
require_once '../../Controller/events.php';

if (isset($_GET['id_event'])) {
    $id_event = $_GET['id_event'];
    $eventController = new EventController();

    $event = $eventController->joinParticipationQR($id_event);

    if ($event) {
        $content = "Event #" . $id_event . "\nList of participants:\n";
        foreach ($event as $e) {
            $content .= "Name: " . $e['nom_user'] . "\n";
            $content .= "Email: " . $e['email_user'] . "\n";
        }

        $fileName = "event_#" . $id_event . ".png";
        if (ob_get_length()) {
            ob_end_clean();
        }

        header('Content-Type: image/png');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Expires: 0');

        QRcode::png($content, null, QR_ECLEVEL_L, 4);
    } else {
        header("Location: event.php");
    }
} else {
    header("Location: event.php");
}
