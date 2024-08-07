# Change Log

# BB-FIDELITY-SYST PROJECT (BACKEND)

all notables vhanges to this project will be docummented in this file

## Version [1] 2024-07-16

[github project link](https://github.com/MTPaulette/bb-fidelity-backend)

### ADDED

Date:   2024/07/26
- change logout method type to post method
- recent created uservice and user routes

Date:   2024/07/25

- authentification and authorization using laravel sanctum

Date:   2024/07/24

- affichage du nom de l utilisateur dans le purchase

Date:   2024/07/23
- add of created_at column in pivot table

Date:   2024/07/22

- all purchase's route done

Date:   2024/07/20

- mise a jour des informations d'un service identifie par son id

Date:   2024/07/18

- creation d un nouveau service terminee
- refactoring de la base de donnees. creation de la table purchase pour enregistrer les donnees d; achat d un service

Date:   2024/07/17

- recuperation de la liste des services
- refactoring du code, suppression des dependances javascript, suppression des routes web
- denut du refactoring general du backend

Date:   2024/07/16

- mise a jour des points utilisateur avec verification
- route de mise a jour du mot de passe avec verification
- validation des donnees lors de l authentification. retour de messages d erreur et affichage

## Version [2.0.0] 2024-07-28

[github project link](https://github.com/MTPaulette/bb-fidelity-backend-v2)

### prerequis
php version greater than php 8.0.2

### context
This version follows the failure to deploy the system. After careful attempts to resolve the 419 token expired and CORS policy errors that occured in production. The new laravel project was created in scrupulous compliance with the requirements of the documentation.

### ADDED

Date:   2024/08/06

- separating seeder
- filtering with no result

Date:   2024/08/05

- delete expiration
- superadmin creation and adding of agency, service_type, validity enum colonm
- ready ro deploy

Date:   2024/08/02

- laravel-cors
- out service_name in allUsersOfService

Date:   2024/08/01

- good data in db
- before deploy
- add 404 errors for find using id

Date:   2024/07/31

- delete service route
- revoke token after 1 month

Date:   2024/07/30

- config cors.php, .env for error 419 csfr-token expired

Date:   2024/07/29

- replace .env
- delete token destruction after login
- generate token after change password

Date:   2024/07/28

- new project after fail deploy

### Added dependencies
- "php": "^8.0.2",
- "guzzlehttp/guzzle": "^7.2",
- "laravel/framework": "^9.19",
- "laravel/sanctum": "^3.3",
- "laravel/tinker": "^2.7"
