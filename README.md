[![Welcome to Codar!](https://pimp-my-readme.webapp.io/pimp-my-readme/sliding-text?emojis=1f697&text=Welcome%2520to%2520Codar%21)](#)

## ICT2x01 Introduction to Software Engineering
Team P4-8

## Members
- Kareem Mohamed Ashiq (Leader)
- Gerald Peh
- Poey Jin Rong, Jerome
- Lee Hui Shan
- Quek Chek Wee

## Repository Structure
```
├── README.md : README of codar project
└── codar-web : Main directory
    ├── Demo\ Pages : Folder containing the theme's web pages that are not in use
    ├── assets : Folder containing all assets of codar project
    │   ├── css : -
    │   ├── fonts : -
    │   ├── img : -
    │   ├── js : Folder containing all javascript files of codar project
    │   │   ├── blockly : Folder containing all blockly-related javascript files
    │   │   ├── core : -
    │   │   ├── plugins : -
    │   └── scss : -
    ├── databases : Folder containing the SQLite database
    ├── docs : Folder containing documentation of UI kit
    ├── media : -
    └── pages : Folder containing .php/.html web pages of codar project
```

## Software Versions
1. PHP
2. SQLite

## How To Run
### Mac/Linux OS
1. Change directory to codar-web  
`cd ../codar-web`
2. Execute command to host application on localhost, port 8000  
`php -S localhost:8000`
3. Open any browser and enter the url "localhost:8000/pages/dashboard.php"

### Windows OS
[TBC]

## Development Workflow
_As of **Mon 15 Nov 2021**_

### Branches
1. **main** [`protected`] - The master/main branch, merges to this branch will indicate a production-ready application.
2. **development** [`protected`] - The pre-production stage of the application.
3. **features/x** - Branches that are created for housing development of x feature.  
For example (features/x):  
[features/login_system] - Branch containing development for login system  
[features/login_page] - Branch containing development for login page  
[features/view_achievements] - Branch containing development for achievements page  

4. **bugfixes/x** - Branches that are created for housing the fixing of bugs  
For example (bugfix/x):  
[bugfixes/login_system] - Branch containing the fix for a bug in login system
[bugfixes/view_profile] - Branch containing the fix for a visual bug in profile page

### Workflow Commandments
1. Nobody shall commit to `main` and `development` branch
2. Any form of commits must not disable the applications' ability to run  
  *The application must not crash on startup or basic functionalities
3. Pull requests shall be approved by any collaborator  
  *Due diligence for working application is assumed, see 2.
4. Commits shall be named meaningfully to provide clear understanding including a comprehensive description


### Creating A New Feature/Fix Branch
[!] If you are developing a fix for a bug, open a new issue before creating the branch.

#### 1. Determine Meaningful Branch Name
Ensure that the name of the branch correctly identifies the feature that you are planning to develop/fix.

#### 2. Create The Branch Off The development/main Branch
Development Branch -
Main Branch -
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
