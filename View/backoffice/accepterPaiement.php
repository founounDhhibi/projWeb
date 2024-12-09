<?php
require_once "../../Controller/commande_Controller.php";
require_once "../../Controller/paiement_Controller.php";
require_once "../../pdf/fpdf.php";
require_once "../../Controller/mail.php";

$commandeController = new CommandController();
$paiementController = new PaiementController();

if (isset($_GET["id_commande"]) && isset($_GET["id_paiement"])) {
    $pdf = new FPDF();
    $pdf->AddPage();

    // Ajouter le logo
    $pdf->Image('../frontoffice/img/logo.jpg', 10, 10, 30); // Chemin du logo
    $pdf->SetFont('Times', 'B', 20);
    $pdf->Cell(190, 10, 'Facture', 0, 1, 'C');
    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(190, 10, 'Heritech', 0, 1, 'C');
    $pdf->Cell(190, 5, 'Adresse : Esprit, El Ghazela, Ariana', 0, 1, 'C');
    $pdf->Cell(190, 5, 'Contact : +216 55 589 000 | contact@heritech.com', 0, 1, 'C');
    $pdf->Ln(10);

    // Informations de la facture
    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(100, 10, 'Facture #: ' . $_GET["id_paiement"], 0, 0);
    $pdf->Cell(90, 10, 'Date : ' . date('Y-m-d'), 0, 1);
    $pdf->Cell(100, 10, 'Commande #: ' . $_GET["id_commande"], 0, 1);

    // Ajouter une ligne
    $pdf->Ln(5);
    $pdf->Cell(190, 0, '', 'T', 1, 'C');
    $pdf->Ln(5);

    // Détails de la commande
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(100, 10, 'Description', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Quantite', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Prix Unit.', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Total', 1, 1, 'C');

    $commande = $commandeController->joinProduitCommandePDF($_GET["id_commande"]);
    $pdf->SetFont('Times', '', 12);
    foreach ($commande as $detail) { // Exemple de structure
        $pdf->Cell(100, 10, $detail['nom_produit'], 1, 0);
        $pdf->Cell(30, 10, $detail['quantite_commande_produit'], 1, 0, 'C');
        $pdf->Cell(30, 10, number_format($detail['prix_produit'], 2) . " TND", 1, 0, 'R');
        $pdf->Cell(30, 10, number_format($detail['quantite_commande_produit'] * $detail['prix_produit'], 2) . " TND", 1, 1, 'R');
    }

    // Total général
    $paiement = $paiementController->getPaiement($_GET["id_paiement"]);
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(160, 10, 'Remise :', 1, 0, 'R');
    $pdf->Cell(30, 10, number_format($paiement['remise'], 2) . " %", 1, 1, 'R');
    $pdf->Cell(160, 10, 'Total :', 1, 0, 'R');
    $pdf->Cell(30, 10, number_format($paiement['montant_paiement'], 2) . " TND", 1, 1, 'R');

    $pdf->Ln(10);
    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(190, 10, 'Merci pour votre confiance !', 0, 1, 'C');

    $fileName = "factures/Facture_#" . $_GET["id_paiement"] . ".pdf";
    $pdf->Output('F',$fileName);

    $paiementController->accepterPaiement($_GET["id_paiement"]);
    $commandeController->updateStatus($_GET["id_commande"], "Payer");
    sendInvoiceByEmail("khelil.hachich@esprit.tn", "Khelil", $fileName);
    header("Location: commandes.php");
} else {
    header("Location:commandes.php");
}
