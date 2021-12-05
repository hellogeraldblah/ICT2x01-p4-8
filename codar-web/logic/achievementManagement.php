<?php

require_once "../constants.php";

require_once __DATABASE_DIR__ . "database.php";
require_once __CLASSES_DIR__ . "achievement.php";

class AchievementManagement
{
    function createAchievement($conn,$challengeId){
        $sql = "INSERT INTO achievements (challengeId)" . "VALUES (:challenge_id)";
        $prepared_stmt = $conn->prepare($sql);
        $prepared_stmt->bindParam(":challenge_id", $challengeId);
        $prepared_stmt->execute();
    }

    function displayAllAchievements($conn, array $achievements){
        $res = $conn->query("SELECT * FROM achievements WHERE userId = '0' ");
            while ($row = $res->fetchArray()){
            array_push($achievements, new Achievement($row['userId'], $row['challengeId'],  $row['numberOfStars']));
        }
        if ($achievements == NULL){
            return 0;
        }
        return $achievements;
    }

    //using session id, get from table achievement challengeid and stars
    public function viewAchievement($conn, $userId,array $achievements){
        $res = $conn->query("SELECT * FROM achievements where userId = '$userId'");
        while($row = $res->fetchArray()){
            array_push($achievements, new Achievement($row['userId'], $row['challengeId'],  $row['numberOfStars']));
        }
        if ($achievements == NULL){
            return 0;
        }
        return $achievements;
    }

    //from game_over.php, save to table, new achievement
    //if not exist, insert into achievement, else update/remain as highest(stars)
    public function awardAchievement($conn, $userId, $challengeId, $numberOfStars){
        $selectSql = $conn->query("SELECT * FROM achievements where userId = '$userId' AND challengeId = '$challengeId'");
        $row = $selectSql-> fetchArray();
        //No achievement yet
        if(!$row){
            $this->insertAchievement($conn, $userId, $challengeId, $numberOfStars);
        }
        else {
            $earnedStars = $row['numberOfStars'];
            if ($numberOfStars > $earnedStars){
                $this->updateAchievement($conn, $userId,$challengeId, $numberOfStars);
            }
        }
    }

    private function insertAchievement($conn, $userId, $challengeId, $numberOfStars)
    {
        $sql = "INSERT INTO achievements (userId,challengeId, numberOfStars)" . "VALUES (:user_id, :challenge_id, :number_of_stars)";
        $prepared_stmt = $conn->prepare($sql);
        $prepared_stmt->bindParam(":user_id", $userId);
        $prepared_stmt->bindParam(":challenge_id", $challengeId);
        $prepared_stmt->bindParam(":number_of_stars", $numberOfStars);
        $prepared_stmt->execute();
    }

    private function updateAchievement($conn, $userId, $challengeId, $numberOfStars )
    {
        $sql = "UPDATE achievements SET numberOfStars = :number_of_stars WHERE userId = :user_id AND challengeId = :challenge_id";
        $prepared_stmt = $conn->prepare($sql);
        $prepared_stmt->bindParam(":number_of_stars", $numberOfStars);
        $prepared_stmt->bindParam(":user_id", $userId);
        $prepared_stmt->bindParam(":challenge_id", $challengeId);
        $prepared_stmt->execute();
    }
}

$conn = connect();
$achievementManagement_obj = new AchievementManagement();
