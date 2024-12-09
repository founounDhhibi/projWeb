<?php
include_once(__DIR__ . '/../config.php');
include_once(__DIR__ . '/../Model/CodeCoupon.php');

class CodeCouponController{
    public function showAllNotUsed(){
        $sql = "SELECT * FROM code_coupon WHERE is_used = :is_used";
        try{
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindValue(':is_used', false);
            $query->execute();
            return $query->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function getOneCodeCoupon($id){
        $sql = "SELECT * FROM code_coupon WHERE code = :id";
        try{
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function createCodeCoupon($remise){
        $sql = "SELECT id_code FROM code_coupon ORDER BY id_code DESC LIMIT 1";
        try{
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute();
            $new_id = $query->fetchColumn() + 1;
            $end_code = date("i") . date("s");
            $code = $new_id . "-HTC-" . $end_code;
            $cc = new CodeCoupon(
                $new_id, $code, $remise,
            );
            $sql = "INSERT INTO code_coupon(code, remise) VALUES(:code, :remise)";
            $query = $db->prepare($sql);
            $query->bindValue(':code', $code);
            $query->bindValue(':remise', $remise);
            $query->execute();
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function deleteOneCodeCoupon($id){
        $sql = "DELETE FROM code_coupon WHERE id_code = :id_code";
        try{
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindValue(':id_code', $id);
            $query->execute();
        }catch (Exception $e){
            die($e->getMessage());
        }
    }
}