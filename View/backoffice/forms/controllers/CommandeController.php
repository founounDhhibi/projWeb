<?php

require_once 'models/Commande.php';

class CommandeController
{
    private $model;

    public function __construct($pdo)
    {
        $this->model = new Commande($pdo);
    }

    // Liste toutes les commandes
    public function listCommandes()
    {
        $commandes = $this->model->getAllCommandes();
        require 'views/backoffice/commandes/list.php';
    }

    // Affiche le formulaire pour ajouter une commande
    public function showCreateForm()
    {
        require 'views/backoffice/commandes/create.php';
    }

    // Traite l'ajout d'une commande
    public function createCommande()
    {
        $date = $_POST['date_commande'];
        $statut = $_POST['statut_commande'];
        $montant = $_POST['montant_commande'];

        if ($this->model->createCommande($date, $statut, $montant)) {
            header('Location: index.php?controller=commande&action=list');
        } else {
            echo "Erreur lors de l'ajout de la commande.";
        }
    }

    // Affiche le formulaire pour modifier une commande
    public function showEditForm($id)
    {
        $commande = $this->model->getCommandeById($id);
        require 'views/backoffice/commandes/edit.php';
    }

    // Traite la modification d'une commande
    public function updateCommande()
    {
        $id = $_POST['id_commande'];
        $date = $_POST['date_commande'];
        $statut = $_POST['statut_commande'];
        $montant = $_POST['montant_commande'];

        if ($this->model->updateCommande($id, $date, $statut, $montant)) {
            header('Location: index.php?controller=commande&action=list');
        } else {
            echo "Erreur lors de la mise à jour de la commande.";
        }
    }

    // Supprime une commande
    public function deleteCommande($id)
    {
        if ($this->model->deleteCommande($id)) {
            header('Location: index.php?controller=commande&action=list');
        } else {
            echo "Erreur lors de la suppression de la commande.";
        }
    }
}
