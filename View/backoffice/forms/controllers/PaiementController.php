<?php

require_once 'models/Paiement.php';

class PaiementController
{
    private $model;

    public function __construct($pdo)
    {
        $this->model = new Paiement($pdo);
    }

    // Liste tous les paiements
    public function listPaiements()
    {
        $paiements = $this->model->getAllPaiements();
        require 'views/backoffice/paiements/list.php';
    }

    // Affiche le formulaire pour ajouter un paiement
    public function showCreateForm()
    {
        require 'views/backoffice/paiements/create.php';
    }

    // Traite l'ajout d'un paiement
    public function createPaiement()
    {
        $commande_id = $_POST['id_commande'];
        $montant = $_POST['montant_paiement'];
        $date = $_POST['date_paiement'];
        $mode = $_POST['mode_paiement'];
        $statut = $_POST['statut_paiement'];

        if ($this->model->createPaiement($commande_id, $montant, $date, $mode, $statut)) {
            header('Location: index.php?controller=paiement&action=list');
        } else {
            echo "Erreur lors de l'ajout du paiement.";
        }
    }

    // Affiche le formulaire pour modifier un paiement
    public function showEditForm($id)
    {
        $paiement = $this->model->getPaiementById($id);
        require 'views/backoffice/paiements/edit.php';
    }

    // Traite la modification d'un paiement
    public function updatePaiement()
    {
        $id = $_POST['id_paiement'];
        $commande_id = $_POST['id_commande'];
        $montant = $_POST['montant_paiement'];
        $date = $_POST['date_paiement'];
        $mode = $_POST['mode_paiement'];
        $statut = $_POST['statut_paiement'];

        if ($this->model->updatePaiement($id, $commande_id, $montant, $date, $mode, $statut)) {
            header('Location: index.php?controller=paiement&action=list');
        } else {
            echo "Erreur lors de la mise à jour du paiement.";
        }
    }

    // Supprime un paiement
    public function deletePaiement($id)
    {
        if ($this->model->deletePaiement($id)) {
            header('Location: index.php?controller=paiement&action=list');
        } else {
            echo "Erreur lors de la suppression du paiement.";
        }
    }
}
