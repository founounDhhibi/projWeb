<?php
require_once 'C:/xampp/htdocs/kaiadmin-lite-1.2.0/cnx.php';
require_once 'C:/xampp/htdocs/kaiadmin-lite-1.2.0/Modele/eventwho.php';

class EventController
{
    public function showAllEvents()
    {
        $sql = "SELECT * FROM event";
        $db = config::getConnexion();
        try {
            return $db->query($sql);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function showDispoEvents($id_user)
    {
        $sql = "
        SELECT * FROM event e
        WHERE e.nbr_place > 0 
          AND e.date_event > CURRENT_DATE()
          AND e.id_event NOT IN (
              SELECT ep.id_event
              FROM event_participants ep
              WHERE ep.id_user = :id_user
          )
        ";
        $db = config::getConnexion();
        try {
            $req = $db->prepare($sql);
            $req->bindValue('id_user', $id_user);
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function showDispoEventsSearch($id_user, $keywords)
    {
        $sql = "
        SELECT * FROM event e
        WHERE e.nbr_place > 0 
          AND e.date_event > CURRENT_DATE()
          AND e.id_event NOT IN (
              SELECT ep.id_event
              FROM event_participants ep
              WHERE ep.id_user = :id_user
          )
        AND id_event = :keyword OR nom_event = :keyword 
        ";
        $db = config::getConnexion();
        try {
            $req = $db->prepare($sql);
            $req->bindValue('id_user', $id_user);
            $req->bindValue('keyword', $keywords);
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function deleteEvent($id_event)
    {
        $sql = " DELETE FROM event WHERE id_event=:id_event";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue('id_event', $id_event);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function addEvent($event)
    {
        $sql = "INSERT INTO event (nom_event,date_event,description_event,nbr_place,image,type)
                 VALUES (:nom_event, :date_event, :description_event, :nbr_place,:image,:type)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom_event' => $event->getNomEvent(),
                'date_event' => $event->getDateEvent(),
                'description_event' => $event->getDescriptionEvent(),
                'nbr_place' => $event->getNbrPlace(),
                'image' => $event->getImage(),
                'type' => $event->getType()
            ]);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function getEvent($id_event)
    {
        $sql = "SELECT * FROM event WHERE id_event = :id_event";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_event', $id_event);

        try {
            $req->execute();
            return $req->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }


    public function editEvent($event)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('UPDATE event
                SET nom_event = :nom_event, date_event = :date_event, type = :type,
                    description_event = :description_event, nbr_place = :nbr_place, image = :image 
                WHERE id_event = :id_event');
            $query->execute([
                'nom_event' => $event->getNomEvent(),
                'date_event' => $event->getDateEvent(),
                'description_event' => $event->getDescriptionEvent(),
                'nbr_place' => $event->getNbrPlace(),
                'image' => $event->getImage(),
                'type' => $event->getType(),
                'id_event' => $event->getIdEvent()
            ]);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function updateNbrPlace($isIncrease, $id_event)
    {
        $event = $this->getEvent($id_event);
        if ($isIncrease) {
            $event['nbr_place'] = $event['nbr_place'] + 1;
        } else {
            if ($event['nbr_place'] == 0) {
                return false;
            }
            $event['nbr_place'] = $event['nbr_place'] - 1;
        }
        $eventEntity = new Event(
            $event["nom_event"],
            $event["date_event"],
            $event["description_event"],
            $event["nbr_place"],
            $event["image"],
            $event["type"]
        );
        $eventEntity->setIdEvent($event["id_event"]);
        $this->editEvent($eventEntity);
        return true;
    }

    public function joinParticipation($id_event)
    {
        $query = "
        SELECT * from event e join event_participants ep 
            on e.id_event = ep.id_event 
                 WHERE e.id_event = :id_event
        ";
        $db = config::getConnexion();
        $req = $db->prepare($query);
        $req->bindValue('id_event', $id_event);
        try {
            $req->execute();
            return $req->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function joinParticipationUser($id_user)
    {
        $query = "
        SELECT * FROM event e 
        JOIN event_participants ep ON e.id_event = ep.id_event 
        WHERE ep.id_user = :id_user
        ";
        $db = config::getConnexion();
        $req = $db->prepare($query);
        $req->bindValue('id_user', $id_user);
        try {
            $req->execute();
            return $req->fetchAll();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }


    public function searchEvent($keyword)
    {
        $sql = "SELECT * FROM event WHERE id_event = :keyword OR nom_event = :keyword";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue('keyword', $keyword);
        try {
            $req->execute();
            return $req->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function filterEvent($type)
    {
        $sql = "SELECT * FROM event WHERE type = :type";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue('type', $type);
        try {
            $req->execute();
            return $req->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Pagination
    public function paginationLIMIT($sql)
    {
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function paginationCOUNTER($sql)
    {
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $row = $liste->fetch(PDO::FETCH_NUM);
            $total = $row[0];
            return $total;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function joinParticipationQR($id_event)
    {
        $query = "
        SELECT * from event e join event_participants ep 
            on e.id_event = ep.id_event JOIN user u ON ep.id_user = u.id_user
                 WHERE e.id_event = :id_event
        ";
        $db = config::getConnexion();
        $req = $db->prepare($query);
        $req->bindValue('id_event', $id_event);
        try {
            $req->execute();
            return $req->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
