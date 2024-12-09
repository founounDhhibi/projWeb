<?php
require_once '../../Controller/commande_Controller.php';
require_once '../../Controller/CommandeProduitsController.php';
require_once '../../Controller/ProduitController.php';

$user = 1; // pour tester à changer pendant l intégration
if(isset($_GET['id_prod'])){
    $id_prod = $_GET['id_prod'];
    $commandeController = new CommandController();
    $produitController = new ProduitController();
    $cpController = new CommandeProduitsController();

    $produit = $produitController->getProduit($id_prod);
    $commande = $commandeController->getLastCommande($user);
    if($commande != null){
        $produitsCommande = $commandeController->joinProduitCommande($commande['id_commande']);
        if($produitsCommande != null){
            foreach($produitsCommande as $cp){
                if($cp['id_produit'] == $id_prod){
                    $updatedQuantity = $cp['quantite_commande_produit'] + 1;
                    $cpController->updateQuantity($cp['id_commande'], $id_prod, $updatedQuantity);
                    $updated_price = $commande['montant_commande'] + $produit['prix_produit'];
                    $commandeController->updatePrice($commande['id_commande'], $updated_price);
                    header("Location:cart.php");
                }
            }
        }

        $cp = new CommandeProduits(
            $commande['id_commande'],
            $id_prod,
            1
        );
        $cpController->addProduitCommande($cp);
        $updated_price = $commande['montant_commande'] + $produit['prix_produit'];
        $commandeController->updatePrice($commande['id_commande'], $updated_price);
        header("Location:cart.php");
    } else {
        $commande = new Commande(
            "Non confirmée",
            $produit['prix_produit'],
            $user
        );
        $commandeController->addCommande($commande);
        $commande = $commandeController->getLastCommande($user);
        $cp = new CommandeProduits(
            $commande['id_commande'],
            $id_prod,
            1
        );
        $cpController->addProduitCommande($cp);
        header("Location:cart.php");
    }
} else
    header("Location:produits.php");