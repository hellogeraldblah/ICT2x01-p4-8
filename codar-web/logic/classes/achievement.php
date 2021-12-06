<?php

class Achievement{
//Achivement entity
public $userId;
public $challengeId;
public $numberOfStars;

    function __construct($userId,$challengeId,$numberOfStars){
        $this->userId = $userId;
        $this->challengeId = $challengeId;
        $this->numberOfStars = $numberOfStars;
    }

    function getUserId(){
        return $this->userId;
    }

    function setUserId($userId){
        $this->userId = $userId;
    }

    function getChallengeId(){
        return $this->challengeId;
    }

    function setChallengeId($challengeId){
        $this->challengeId = $challengeId;
    }

    function getNumberOfStars(){
        return $this->numberOfStars;
    }

    function setNumberOfStars($numberOfStars){
        $this->numberOfStars = $numberOfStars;
    }
}