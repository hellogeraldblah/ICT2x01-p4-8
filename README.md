[![Welcome to Codar!](https://pimp-my-readme.webapp.io/pimp-my-readme/sliding-text?emojis=1f697&text=Welcome%2520to%2520Codar%21)](#)


## ICT2x01 Introduction to Software Engineering
Team P4-8

## Members
- KAREEM MOHAMED ASHIQ (Leader)
- GERALD PEH
- POEY JIN RONG, JEROME
- LEE HUI SHAN
- QUEK CHECK WEE

### How To Run
#### Mac/Linux OS
1. Change directory to codar-web  
`cd ../codar-web`
2. Execute command to host application on localhost, port 8000  
`php -S localhost:8000`
3. Open any browser and enter the url "localhost:8000/pages/dashboard.php"

#### Windows OS
[TBC]

### Development Workflow
_As of **Mon 15 Nov 2021**_

#### Branches
1. **main** - The master/main branch, merges to this branch will indicate a production-ready application.
2. **development** - The pre-production stage of the application.
3. **features/x** - Branches that are created for housing development of x feature.  
For example (features/x):  
[features/login_system] - Branch containing development for login system  
[features/login_page] - Branch containing development for login page  
[features/view_achievements] - Branch containing development for achievements page  

4. **bugfixes/x** - Branches that are created for housing the fixing of bugs  
For example (bugfix/x):  
[bugfixes/login_system] - Branch containing the fix for a bug in login system
[bugfixes/view_profile] - Branch containing the fix for a visual bug in profile page

#### Creating A New Feature/Fix Branch
[!] If you are developing a fix for a bug, open a new issue before creating the branch.


#### 1. Determine Meaningful Branch Name
Ensure that the name of the branch correctly identifies the feature that you are planning to develop/fix.

#### 2. Create The Branch Off The development Branch
If you are planning to add a new feature/fix, create the feature based off the development branch.  

Example:  
`git branch -d features/x development`

#### 3. Merging Of Feature/Fix Branch
When you have finalised your code and are ready to merge the branch (feature/fix) into the development branch, create a new "Pull Request" and select the merging from new branch to development branch.

#### 4. Deletion Of Branch
Once the pull request is approved, you may delete the branch to avoid cluttering of branches in the repository.

* Any lost of data or progress by deletion of branch will not be held liable by the owner or collaborators of the repository. The sole user who deleted the branch will be held responsibly.   


### UAT
description...

### Whitebox Testing
description...
