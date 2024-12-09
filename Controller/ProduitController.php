<?php
require_once __DIR__ .'/../config.php';

class ProduitController {

    public function listProduits()
    {
        $sql = "SELECT * FROM produits";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getProduit($id) {
        $sql = "SELECT * FROM produits WHERE id_produit = :id_produit";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        try{
            $req->bindValue(':id_produit', $id);
            $req->execute();
            return $req->fetch();
        }catch (Exception $e){
            die($e->getMessage());
        }
    }
}


