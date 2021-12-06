[![Welcome to Codar!](https://pimp-my-readme.webapp.io/pimp-my-readme/sliding-text?emojis=1f697&text=Welcome%2520to%2520Codar%21)](#)

# ICT2x01 Introduction to Software Engineering

## Members (Team P4-8)
- Kareem Mohamed Ashiq (Leader)
- Gerald Peh
- Poey Jin Rong, Jerome
- Lee Hui Shan
- Quek Chek Wee

## Repository Structure
```
.
├── README.md
└── codar-web
    ├── assets
    │   ├── css
    │   ├── fonts
    │   ├── img
    │   │   ├── challenges
    │   │   │   ├── challengemap_1.png
    │   │   │   ├── challengemap_2.png
    │   │   │   ├── challengemap_3.png
    │   │   │   └── challengemap_<..>.png
    │   ├── js
    │   │   ├── blockly
    │   │   ├── core
    │   │   ├── plugins
    ├── databases
    │   ├── codar-db.sqlite
    │   └── database.php
    ├── logic
    │   ├── classes
    │   │   └── achievement.php
    │   │   └── challenge.php
    │   ├── achievementManagement.php
    │   ├── challengeManagement.php
    │   └── create_challenge_form.php
    │   └── edit_challenge_form.php
    └── presentation
        ├── achievements.php
        ├── allAchievements.php
        ├── blockly.php
        ├── challenges.php
        ├── create_challenge.php
        ├── dashboard.php
        ├── edit_challenge.php
        ├── game_over.php
        ├── play_challenge.php
        ├── profile.php
        ├── shared_presentation
        │   ├── footer.php
        │   ├── head.php
        │   ├── navbar.php
        │   └── sidepanel.php
        ├── sign-in.php
        └── sign-up.php
```

## Software Versions
1. PHP v7.3/7.4 (You can use php >7.4 at your own risk, testing and development was done on 7.3/7.4)
2. SQLite3 v3.32.3
3. Codeception PHP Testing Framework v4.1.22 (For whitebox testing)

## Prerequisites
Between Windows or Mac/Linux OS, PHP is required to run Codar along with the SQLite3 extension. The following are guides on the installation of software for the respective OS.

### Mac/Linux OS
1. Install PHP v7.3/7.4  
[Linux guide to install php v7.3](https://askubuntu.com/questions/1231381/unable-to-install-php-7-3-on-ubuntu-20-04)  
2. Install SQLite3 extension for PHP  
[Linux guide to install and enable sqlite3 extension](https://stackoverflow.com/questions/948899/how-to-enable-sqlite3-for-php)  

### Windows OS
1. Install PHP  
[Install PHP from official PHP downloads page](https://www.php.net/downloads)  
2. For convenience, configure php.exe as system environment variable   
[Configure php.exe as part of OS environment variable](https://stackoverflow.com/questions/2736528/how-to-set-the-env-variable-for-php)
3. Enable SQLite3 for php.exe   
[Windows guide to enable sqlite3 extension](https://roytuts.com/configure-php-7-and-sqlite3-in-windows/)  

### How To Run Codar
1. Change your working directory to ICT2x01-p4-8/codar-web/  
`cd ../codar-web`
2. Execute command to host application on localhost, in this case port 8000 is used  
`php -S localhost:8000`
3. Open any browser and enter the url:  
`localhost:8000/sign-in.php`

## Development Workflow
_As of **Mon 15 Nov 2021**_  
_Updated: **Sat 4 Dev 2021**_  

### Branches
1. **main** [`protected`] - The master/main branch, merges to this branch will indicate a production-ready application.
2. **development** [`protected`] - The pre-production stage of the application.
3. **features/x** - Branches that are created for housing development of **x** feature.  
For example (features/x):  
[features/login_system] - Branch containing development for login system  
[features/create_challenges] - Branch containing development for creating challenges
[features/view_achievements] - Branch containing development for the achievements page

4. **bugfixes/x** - Branches that are created for housing the fixing of bugs  
For example (bugfix/x):  
[bugfixes/login_system] - Branch containing the fix for a bug in login system
[bugfixes/view_profile] - Branch containing the fix for a visual bug in profile page

5. **whiteboxtest/x** -- Branch containing code for whitebox testing
For example (whiteboxtest/x):
[whiteboxtest/codeception] - Branch containing codes and resources for the usage of codeception test framework

### Workflow Commandments
1. Nobody shall commit to `main` and `development` branch  
\* Exceptions to the development branch can be made under the following conditions:
    - the changes you are planning to make do not require another branch (minor updates, perfective maintenance)
    - you are absolutely certain that your changes does not disrupt any member's development progress
    - you agree to hold all responsibility in the event of a disruption
3. Any branch that are ready for merging with development must have a working application with the feature fully developed  
3. Pull requests shall be approved by any collaborator, and only to the development branch for staging
4. Commits shall be named meaningfully to provide clear understanding including a comprehensive description


### Creating A New Feature/Fix Branch
#### 1. Determine Meaningful Branch Name
Ensure that the name of the branch correctly identifies the feature that you are planning to develop/fix.

#### 2. Create The Branch
If you are planning to add a new feature/fix, create the branch off the **development** branch. Unless the development of the new feature requires certain aspects of in-development branches. *please seek team approval before doing so.

Example for branching off development branch:  
`git branch -b features/x development` or create a new branch through the Github website. [Main Page](https://github.com/hellogeraldblah/ICT2x01-p4-8)

#### 3. Merging Of Feature/Fix Branch
When you have finalised your code and are ready to merge the branch (feature/fix) into the development branch, create a new "Pull Request" and select the merging from new branch to **development** branch. Any collaborator is able to review and approve.

#### 4. Deletion Of Branch
Once the pull request is approved, you would usually delete the branch to avoid cluttering of branches in the repository. However, in this case, we will keep them for logging purposes.

* Any lost of data or progress by deletion of branch will not be held liable by the owner or collaborators of the repository. The sole user who deleted the branch will be held responsibly.   


### UAT
Here is an embedded video that runs through all the test cases that we have created and refined from the Milestone 2 submission.
[![IMAGE ALT TEXT HERE](https://user-images.githubusercontent.com/48905199/144790851-7afc3d09-359c-4bfe-99e0-928c2bf3d358.png)](https://youtu.be/F2rMhGwOggw)

| Test Case ID | ST1 |
| ------------ | --- |
| Test Case Name | Open |
| Precondition | Browser is already opened |
| Test Steps | 1. Type Type “http://localhost:8000/index.php” into browsers’ URL bar <br /> 2. Press enter on the keyboard <br /> 3. Observe Screen |
| Test Data | - |
| Expected Results | Picture |
| Actual Results | Picture |
| Pass/Fail | Pass |

| Test Case ID | ST2 |
| ------------ | --- |
| Test Case Name | Attempt Invalid Login |
| Precondition | User ‘Username’ does not exist |
| Test Steps | 1. Type username into Username input field <br /> 2. Type password into Password input field <br /> 3. Click on Login button <br /> 4. Observe screen |
| Test Data | Username: username <br /> Password: password |
| Expected Results | Picture |
| Actual Results | Picture |
| Pass/Fail | Pass |

| Test Case ID | ST3 |
| ------------ | --- |
| Test Case Name | View Register Page |
| Precondition | User is in login page |
| Test Steps | 1. Click on “Don’t have an account? Sign up” button <br /> 2. Observe screen |
| Test Data | - |
| Expected Results | Picture |
| Actual Results | Picture |
| Pass/Fail | Pass |

### Whitebox Testing
The class that we have chosen to perform our whitebox test suite is the ChallengeManagement class. The team felt that this class would be the most meaningful as the core idea of the project (Gamification) majorly depends on this class.

The classes it interacts with are as follows:
- AchievementManagement Class `[codar-web/logic/achievementManagement.php]`
- Challenge Class `[codar-web/logic/classes/achievement.php]`

The framework we have chosen is the [Codeception Framework](https://codeception.com/) v4.1.22 which uses PHPUnit v8.5.20. Additionally, we have also enabled the [codecoverage](https://codeception.com/docs/11-Codecoverage) feature for test statistics. A custom test suite has been written to perform unit testing on the ChallengeManagement class.

#### File/Directory Structure and information
`codar-web/codeception.yml` contains information on the test configuration.  
`codar-web/test_assets/` contains resources that are used purely for testing.  
`codar-web/tests/unit/challengeManagementTest.php` is where the test suite is located.  
`codar-web/tests/_output/coverage/challengeManagement.php.html` contains a HTML report of the test suite.

#### How to install Codeception
[Codeception Quickstart Guide](https://codeception.com/quickstart)

1. Download codeception  
`wget https://codeception.com/codecept.phar`
2. Install codeception using phar  
`php codecept.phar`
3. Since codeception requires php curl and mbstring extension as well,  
[Guide on installing php curl extension](https://stackoverflow.com/questions/33775897/how-do-i-install-the-ext-curl-extension-with-php-7)  
`sudo apt-get install php7.4-curl`   
[Guide on installing php mbstring extension](https://askubuntu.com/questions/491629/how-to-install-php-mbstring-extension-in-ubuntu)  
`sudo apt-get install php7.4-mbstring`  
4. Install pcov for [codeception code coverage](https://codeception.com/docs/11-Codecoverage)  
[Guide on installing pcov](https://github.com/krakjoe/pcov/blob/develop/INSTALL.md)  
`sudo apt install php-pcov`


#### How to run Codeception
1. Ensure you are in the `whiteboxtest/codeception` branch
2. Change your working directory to ICT2x01-p4-8/codar-web/  
`cd ICT2x01-p4-8/codar-web`
3. Execute the following command  
`./codecept.phar run unit --coverage --coverage-html`  
\* if you encounter an error specifying insufficient permissions, you might consider using `sudo`.

\* Visit the following directory `codar-web/tests/_output/coverage/challengeManagement.php.html` to view the HTML report of the test suite or view it online [here](https://htmlpreview.github.io/?https://github.com/hellogeraldblah/ICT2x01-p4-8/blob/whiteboxtest/codeception/codar-web/tests/_output/coverage/challengeManagement.php.html).


#### Test Cases
The challengeManagementTest file can be located at `codar-web/tests/unit/challengeManagementTest.php`. The test cases are as follows:
- `testRetrieveChallenge()`
- `testGetLastId()`
- `testValidateName()`
- `testValidateMoves()`
- `testValidateFile()`
- `testValidateChallenge()`
- `testGenerateFile()`
- `testCreateChallenge()`
- `testSearchChallenge()`
- `testGetChallenge()`
- `testEditChallengeName()`
- `testEditChallengeMoves()`
- `testEditChallengeFile()`
- `testDetermineNumberOfStars()`


#### Test Suite Code Coverage Statistics
The code coverage statistic was generated using [Codeception](https://codeception.com/) and the [PCOV](https://github.com/krakjoe/pcov) extension. The full HTML report coverage can be found in `codar-web/tests/_output/coverage/challengeManagement.php.html` or [here](https://htmlpreview.github.io/?https://github.com/hellogeraldblah/ICT2x01-p4-8/blob/whiteboxtest/codeception/codar-web/tests/_output/coverage/challengeManagement.php.html). Additionally, the report showcases the number of test cases that the line was used in.

You can view the full report online [here](https://htmlpreview.github.io/?https://github.com/hellogeraldblah/ICT2x01-p4-8/blob/whiteboxtest/codeception/codar-web/tests/_output/coverage/challengeManagement.php.html).

![HTML Coverage](readme_assets/html-coverage.png)  

![HTML Coverage Lines](readme_assets/html-coverage-lines.png)

![HTML Coverage Line Gif](readme_assets/html-testcase-coverage.gif)


#### Codeception Unit Test Demonstration
![Codeception demonstration gif](readme_assets/codeception_demo.gif)
