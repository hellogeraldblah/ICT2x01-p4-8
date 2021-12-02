<?php
if(!defined("__ROOT__")) define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
require_once "../databases/database.php";
require_once "../logic/classes/achievement.php";

class AchievementManagement
{
    // Achievements entity, stores array of achievements objects
    private $achievements = array();
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    function createAchievement($challengeId){
        $sql = "INSERT INTO achievements (challengeId)" . "VALUES (:challenge_id)";
        $prepared_stmt = $this->conn->prepare($sql);
        $prepared_stmt->bindParam(":challenge_id", $challengeId);
        $prepared_stmt->execute();
    }

    //check already achieved?
    function displayAllAchievements(){
        $res = $this->conn->query("SELECT * FROM achievements WHERE userId = '0' ");
            while ($row = $res->fetchArray()){
            array_push($this->achievements, new Achievement($row['userId'], $row['challengeId'],  $row['numberOfStars']));
        }
        if ($this->achievements == NULL){
            return 0;
        }
        return $this->achievements;
    }

    //using session id, get from table achievement challengeid and stars
    //get from database, all rows
    //return all rows
    public function viewAchievement($userId){
        $res = $this->conn->query("SELECT * FROM achievements where userId = '$userId'");
        while($row = $res->fetchArray()){
            array_push($this->achievements, new Achievement($row['userId'], $row['challengeId'],  $row['numberOfStars']));
        }
        if ($this->achievements == NULL){
            return 0;
        }
        return $this->achievements;
    }

    //from game_over.php, save to table, new achievement
    //if not exist, insert into achievement, else update/remain as highest(stars)
    public function awardAchievement($userId, $challengeId, $numberOfStars){
        $selectSql = $this->conn->query("SELECT * FROM achievements where userId = '$userId' AND challengeId = '$challengeId'");
        $row = $selectSql-> fetchArray();
        //No achievement yet
        if(!$row){
            $this->insertAchievement($userId, $challengeId, $numberOfStars);
        }
        else {
            $earnedStars = $row['numberOfStars'];
            if ($numberOfStars > $earnedStars){
                $this->updateAchievement($userId, $numberOfStars);
            }
        }
    }

    private function insertAchievement($userId, $challengeId, $numberOfStars)
    {
        $sql = "INSERT INTO achievements (userId,challengeId, numberOfStars)" . "VALUES (:user_id, :challenge_id, :number_of_stars)";
        $prepared_stmt = $this->conn->prepare($sql);
        $prepared_stmt->bindParam(":user_id", $userId);
        $prepared_stmt->bindParam(":challenge_id", $challengeId);
        $prepared_stmt->bindParam(":number_of_stars", $numberOfStars);
        $prepared_stmt->execute();
    }

    private function updateAchievement($userId, $numberOfStars )
    {
        $sql = "UPDATE achievements SET numberOfStars = :number_of_stars WHERE userId = :user_id ";
        $prepared_stmt = $this->conn->prepare($sql);
        $prepared_stmt->bindParam(":number_of_stars", $numberOfStars);
        $prepared_stmt->bindParam(":user_id", $userId);
        $prepared_stmt->execute();
    }
}

$conn = connect();
$achievementManagement_obj = new AchievementManagement($conn);