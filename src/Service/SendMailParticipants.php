<?php
namespace App\Service;

use App\Entity\Formation;

class SendMailParticipants {
    // private $formation;
    // public function __construct(Formation $f=null)
    // {
    //     $this->formation= $f;
        
    // }

    public function sendMail( Formation $f,string $mess )
    {
        $insc= $f->getInscriptions();
        if (count($insc) > 0) {
            # code...
        }
    }
}

?>