<?php

require_once "logic/challengeManagement.php";
require_once "databases/database.php";

class challengeManagementTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $challengeManagementObj;

    protected function _before()
    {
      $this->challengeManagementObj = new ChallengeManagement();
      $conn = connect();
      $this->challengeManagementObj->set_conn($conn);
      $this->challengeManagementObj->retrieve_challenges_from_db();
    }

    protected function _after()
    {
    }

    public function testRetrieveChallenge() {
      // Create a sqlite3 connection to a fake database
      $fakeChallengeManagementObj = new ChallengeManagement();
      $fakeconn = connect("test_assets/fakedb.sqlite");
      $fakeChallengeManagementObj->set_conn($fakeconn);

      // Fake database should return false
      $this->assertFalse($fakeChallengeManagementObj->retrieve_challenges_from_db());

      // $conn = connect();
      // $this->challengeManagementObj->set_conn($conn);

      // Challenges table should contain at least 3 (pre-defined) challenges
      $this->assertNotFalse($this->challengeManagementObj->retrieve_challenges_from_db());

    }

    public function testGetLastId(){
      $current_row_id = $this->challengeManagementObj->get_last_id();

      $challenge_name = "Test Challenge";
      $challenge_moves = 30;
      $challenge_file_info = array("name"=>"testimage.jpg", "type"=>"image/jpg", "tmp_name"=>"test_assets/testimage.jpg", "error"=>"0", "size"=>"1");

      // Create new challenge
      $this->challengeManagementObj->create_challenge($challenge_name, $challenge_moves, $challenge_file_info);

      // get_last_id should return $current_row_id+1
      $this->assertEquals($current_row_id+1, $this->challengeManagementObj->get_last_id());
    }

    // tests validation of challenge name
    public function testValidateName()
    {

      // Empty name returns an error message
      $this->assertEquals("Challenge Name cannot be empty. \\n", $this->challengeManagementObj->validate_name(""));

      // Name with special characters returns an error message
      $this->assertEquals("Challenge Name cannot contain special characters. \\n", $this->challengeManagementObj->validate_name("R@inbow R@od"));

      // Too long name returns an error message
      $this->assertEquals("Challenge Name must be within 100 characters. \\n", $this->challengeManagementObj->validate_name(str_repeat("RainbowRoad", 100)));

      // Alphabetic name returns an empty error message which indicates success
      $this->assertEquals("", $this->challengeManagementObj->validate_name("Rainbow Road"));

      // Alphanumeric name returns an empty error message which indicates success
      $this->assertEquals("", $this->challengeManagementObj->validate_name("Rainbow Road 2"));
    }

    // tests validation of challenge moves
    public function testValidateMoves()
    {

      // Moves with alphabets returns an error message
      $this->assertEquals("Challenge Moves must be an integer. \\n", $this->challengeManagementObj->validate_moves("ABC"));

      // Moves above 100 returns an error message
      $this->assertEquals("Challenge Moves cannot be more than 100. \\n", $this->challengeManagementObj->validate_moves("10000"));

      // Moves below 100 returns an empty error message which indicates success
      $this->assertEquals("", $this->challengeManagementObj->validate_moves("25"));

    }

    public function testValidateFile()
    {
      // craft fake oversized file array
      $oversized_file_info = array("name"=>"testimage.jpg", "type"=>"image/jpg", "tmp_name"=>"test_assets/testimage.jpg", "error"=>"0", "size"=>"50000001");

      $this->assertEquals("Challenge File is too large. \\n", $this->challengeManagementObj->validate_file($oversized_file_info));

      $not_image_file_info = array("name"=>"fakedb.sqlite", "type"=>"image/jpg", "tmp_name"=>"test_assets/fakedb.sqlite", "error"=>"0", "size"=>"500");

      $this->assertEquals("Challenge File is not an image. \\nChallenge File only accepts JPG, JPEG, PNG extensions. \\n", $this->challengeManagementObj->validate_file($not_image_file_info));

      $image_with_wrong_extension_file_info = array("name"=>"testimage.pdf", "type"=>"image/jpg", "tmp_name"=>"test_assets/testimage.pdf", "error"=>"0", "size"=>"500");

      $this->assertEquals("Challenge File only accepts JPG, JPEG, PNG extensions. \\n", $this->challengeManagementObj->validate_file($image_with_wrong_extension_file_info));

      $file_info = array("name"=>"testimage.jpg", "type"=>"image/jpg", "tmp_name"=>"test_assets/testimage.jpg", "error"=>"0", "size"=>"10");

      $this->assertEquals("", $this->challengeManagementObj->validate_file($file_info));

    }

    public function testValidateChallenge()
    {
      $challenge_name = "Test Challenge";
      $challenge_moves = 30;
      $challenge_file_info = array("name"=>"testimage.jpg", "type"=>"image/jpg", "tmp_name"=>"test_assets/testimage.jpg", "error"=>"0", "size"=>"1");

      $current_row_id = $this->challengeManagementObj->get_last_id();
      $this->assertEquals("", $this->challengeManagementObj->validate_challenge($challenge_name, $challenge_moves, $challenge_file_info));
    }

    public function testGenerateFilename() {
      // Get current latest row id
      $current_row_id = $this->challengeManagementObj->get_last_id();

      // Filename should return next row id
      $expected_filename = "challengemap_" . strval($current_row_id + 1) . ".png";

      // get_last_id should return challengemap_($current_row_id+1).png
      $this->assertEquals($expected_filename, $this->challengeManagementObj->generate_filename());
    }

    public function testCreateChallenge() {
      $challenge_name = "Test Challenge";
      $challenge_moves = 30;
      $challenge_file_info = array("name"=>"testimage.jpg", "type"=>"image/jpg", "tmp_name"=>"test_assets/testimage.jpg", "error"=>"0", "size"=>"1");

      $expected_row_id = $this->challengeManagementObj->get_last_id() + 1;
      $actual_row_id = $this->challengeManagementObj->create_challenge($challenge_name, $challenge_moves, $challenge_file_info);

      $this->assertNotEquals($expected_row_id-1, $actual_row_id);
      $this->assertNotEquals($expected_row_id+1, $actual_row_id);
      $this->assertEquals($expected_row_id, $actual_row_id);

      $this->assertNotEmpty($this->challengeManagementObj->search_challenge($expected_row_id));
    }

    public function testSearchChallenge()
    {

      // Nonexistent challenge ID
      $this->assertFalse($this->challengeManagementObj->search_challenge(9999999));

      // Real challenge ID as integer
      $this->assertNotEmpty($this->challengeManagementObj->search_challenge(1));

      // Real challenge ID as string
      $this->assertNotEmpty($this->challengeManagementObj->search_challenge("1"));

    }

    public function testGetChallenge()
    {
      $fakeChallengeManagementObj = new ChallengeManagement();
      $fakeconn = connect("test_assets/fakedb.sqlite");
      $fakeChallengeManagementObj->set_conn($fakeconn);
      $fakeChallengeManagementObj->retrieve_challenges_from_db();

      $this->assertFalse($fakeChallengeManagementObj->get_challenges());


      $this->assertNotEmpty($this->challengeManagementObj->get_challenges());
    }

    public function testEditChallengeName() {
      // selecting a challenge
      $chosen_challenge_id = 1;

      // retrieve challenge object
      $old_challenge_obj = $this->challengeManagementObj->search_challenge($chosen_challenge_id);

      // store challenge name
      $old_challenge_name = $old_challenge_obj->get_name();
      // create new challenge name for testing
      $new_challenge_name = "Test Challenge Name";

      // Assert a true boolean return value
      $this->assertTrue($this->challengeManagementObj->edit_challenge_name($chosen_challenge_id, $new_challenge_name));

      // Retrieve new challenge object
      $new_challenge_obj = $this->challengeManagementObj->search_challenge($chosen_challenge_id);

      // Assert new challenge object name is equals to test challenge name
      $this->assertEquals($new_challenge_name, $new_challenge_obj->get_name());

      // revert changes
      $this->assertTrue($this->challengeManagementObj->edit_challenge_name($chosen_challenge_id, $old_challenge_name));
    }

    public function testEditChallengeMoves() {
      // selecting a challenge
      $chosen_challenge_id = 1;

      // retrieve challenge object
      $old_challenge_obj = $this->challengeManagementObj->search_challenge($chosen_challenge_id);

      // store challenge moves
      $old_challenge_moves = $old_challenge_obj->get_number_of_moves();
      // create new challenge moves for testing
      $new_challenge_moves = $old_challenge_moves + 1;

      // Assert a true boolean return value
      $this->assertTrue($this->challengeManagementObj->edit_challenge_moves($chosen_challenge_id, $new_challenge_moves));

      // Retrieve new challenge object
      $new_challenge_obj = $this->challengeManagementObj->search_challenge($chosen_challenge_id);

      // Assert new challenge object name is equals to test challenge name
      $this->assertEquals($new_challenge_moves, $new_challenge_obj->get_number_of_moves());

      // revert changes
      $this->assertTrue($this->challengeManagementObj->edit_challenge_moves($chosen_challenge_id, $old_challenge_moves));
    }

    public function testEditChallengeFile() {
      // selecting a challenge
      $chosen_challenge_id = 1;

      // retrieve challenge object
      $old_challenge_obj = $this->challengeManagementObj->search_challenge($chosen_challenge_id);

      // store challenge file
      $old_challenge_file = $old_challenge_obj->get_filepath();
      // create new challenge file for testing
      $new_challenge_file = "test_challenge_file.png";

      // Assert a true boolean return value
      $this->assertTrue($this->challengeManagementObj->edit_challenge_file($chosen_challenge_id, $new_challenge_file));

      // Retrieve new challenge object
      $new_challenge_obj = $this->challengeManagementObj->search_challenge($chosen_challenge_id);

      // Assert new challenge object name is equals to test challenge name
      $this->assertEquals($new_challenge_file, $new_challenge_obj->get_filepath());

      // revert changes
      $this->assertTrue($this->challengeManagementObj->edit_challenge_file($chosen_challenge_id, $old_challenge_file));
    }

    public function testDetermineNumberOfStars()
    {
      $challenge_id = "1";
      $number_of_moves = $this->challengeManagementObj->search_challenge($challenge_id)->get_number_of_moves();

      // 0 moves will return false
      $this->assertFalse($this->challengeManagementObj->determineNumberOfStars($challenge_id, 0));

      // negative moves will return false
      $this->assertFalse($this->challengeManagementObj->determineNumberOfStars($challenge_id, -102));

      // moves from 1 - number_of_moves will return 3 stars
      $this->assertEquals($this->challengeManagementObj->determineNumberOfStars($challenge_id, 1), 3);
      $this->assertEquals($this->challengeManagementObj->determineNumberOfStars($challenge_id, $number_of_moves), 3);

      // moves from number_of_moves + 1 - 1.5 x number_of_moves will return 2 stars
      $this->assertEquals($this->challengeManagementObj->determineNumberOfStars($challenge_id, $number_of_moves + 1), 2);
      $this->assertEquals($this->challengeManagementObj->determineNumberOfStars($challenge_id, $number_of_moves * 1.5), 2);

      // moves from 1.5 x number_of_moves + 1 - 2 x number_of_moves will return 1 star
      $this->assertEquals($this->challengeManagementObj->determineNumberOfStars($challenge_id, $number_of_moves * 1.5 + 1), 1);
      $this->assertEquals($this->challengeManagementObj->determineNumberOfStars($challenge_id, $number_of_moves * 2), 1);

      // moves from 2 x number_of_moves onwards will return 0 stars
      $this->assertEquals($this->challengeManagementObj->determineNumberOfStars($challenge_id, $number_of_moves * 2 + 1), 0);
      $this->assertEquals($this->challengeManagementObj->determineNumberOfStars($challenge_id, $number_of_moves * 999), 0);

    }

}
