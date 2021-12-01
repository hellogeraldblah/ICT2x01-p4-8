<?php
define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
require_once "../databases/database.php";
require_once "../logic/classes/achievement.php";

class AchievementManagement
{
    // Achievements entity, stores array of achievements objects
    private $achievements = array();
    private $conn;
//    function __construct($conn) {
//        $this->conn = $conn;
//        $res = $this->conn->query("SELECT * FROM achievements");
//
//        while ($row = $res->fetchArray()) {
//            array_push($this->achievements, new Achievement($row['userId'], $row['challengeId'],  $row['numberOfStars']));
//        }
//    }

    function createAchievement(){

    }
    function editAchievement(){

    }
    function deleteAchivement(){

    }

    function displayParticipatedChallenges(){

    }

    function displayAllAchievements(){

    }

    //using session id, get from table achievement challengeid and stars
    //get from database, all rows
    //return all rows
    public function viewAchievement($userId){
        $this->conn = connect(); //need to change
        $res = $this->conn->query("SELECT * FROM achievements where userId = '$userId'");
        while ($row = $res->fetchArray()) {
            array_push($this->achievements, new Achievement($row['userId'], $row['challengeId'],  $row['numberOfStars']));
        }
        return $this->achievements;
    }

    //from game_over.php, save to table, new achievement
    //if not exist, insert into achievement, else update/remain as highest(stars)
    public function awardAchievement($userId, $challengeId, $numberOfStars){

    }
}