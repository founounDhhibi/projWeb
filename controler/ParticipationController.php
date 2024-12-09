<?php
require_once "events.php";
require_once __DIR__."/../Modele/Participation.php";
require_once 'mail.php';
class ParticipationController
{
    private EventController $eventController;

    public function __construct()
    {
        $this->eventController = new EventController();
    }

    public function getEventController() : EventController {
        return $this->eventController;
    }
    public function showParticipations($user_id)
    {
        $sql = "SELECT * FROM event_participants where id_user = :id_user";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue('id_user', $user_id);
        try {
            return $req->fetchAll();
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function deleteParticipation($id_event, $id_user)
    {
        $sql = " DELETE FROM event_participants WHERE id_event=:id_event AND id_user=:id_user";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_event', $id_event);
        $req->bindValue(':id_user', $id_user);
        try {
            $this->eventController->updateNbrPlace(true,$id_event);
            $req->execute();
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function addParticipation($participation)
    {
        $sql = "INSERT INTO event_participants (id_event,id_user)
                 VALUES (:id_event, :id_user)";
        $sql2 = "SELECT * FROM user WHERE id_user = :id_user";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query2 = $db->prepare($sql2);
            $query2->execute(['id_user' => $participation->getIdUser()]);
            $user = $query2->fetch();
            if ($this->eventController->updateNbrPlace(false, $participation->getIdEvent())) {
                $query->execute([
                    'id_event' => $participation->getIdEvent(),
                    'id_user' => $participation->getIdUser()
                ]);
                sendemail($user);
            } else
                throw new Exception("Can't update event nbr place !");
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function getParticipation($id_event, $id_user)
    {
        $sql = " SELECT * FROM event_participants WHERE id_event=:id_event AND id_user=:id_user";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_event', $id_event);
        $req->bindValue(':id_user', $id_user);
        try {
            return $db->query($sql);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
}