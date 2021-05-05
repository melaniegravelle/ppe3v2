<?php

namespace controller\admin;

use controller\Controller;
use model\TeamManager;
use model\Team;
use classes\Tool;

/**
 * TeamController
 * Controlleur de la partie administrateur de la gestion des équipes
 */
class TeamController extends Controller {
  
    
  /**
   * __construct
   *
   * Constructeur de la classe TeamController
   * @param Router
   */
  function __construct(\classes\Router $router)
  {
    parent::__construct($router);
    // On vérifie si l'utilisateur est un administrateur
    if (isset($this->user) && $this->user->getIsAdmin() != 1) {
      $this->errorAction("Accès interdit.");
      die();
    }
  }
  
  /**
   * defaultAction
   *
   * Action par défaut du controller TeamController
   * @return void
   */
  function defaultAction()
  {
    $teamManager = new TeamManager();
    // On récupère la liste des équipes
    $data["teamsList"] = $teamManager->getTeamsList();
    // On affiche la page avec la liste des équipes
    $this->render('team',$data);
  }

    
  /**
   * openAddAction
   *
   * Action d'ouverture de la page d'ajout d'une équipe
   * @return void
   */
  function openAddAction()
  {
    $teamManager = new TeamManager();

    $vue = 'teamEdition';
    // On récupère le nombre d'équipes
    $nbTeams = $teamManager->getNbOfTeams();
    // Si le nombre d'équipes est supérieur à 10
    if($nbTeams[0] >= 10)
    {
      // On récupère la liste des équipes.
      $data["teamsList"] = $teamManager->getTeamsList();
      // On stocke l'erreur à afficher.
      $data['error'] = "Le nombre maximal d'équipes est limité à 10.";
      // On choisit a vue es équipes
      $vue = 'team';
    }
    $data['add'] = 'add';
    $this->render($vue,$data);
  }
  
  /**
   * addAction
   *
   * Action d'ajout d'une équipe
   * @return void
   */
  function addAction()
  {
    $teamManager = new TeamManager();
    $vue = "teamEdition";
    // On récupère le nombre d'équipes.
    $nbTeams = $teamManager->getNbOfTeams();
    // Si le nb d'équipes est inférieur à 10
    if($nbTeams <= 10)
    {
      // Si toutes les valeurs renseignées par l'utilisateur sont renseignées.
      if(isset($_POST['team_name'],$_POST['coach_name'],$_FILES['logo']) && $_FILES['logo']['error'] == 0)
      {
        // Si le logo n'est pas trop grand
        if ($_FILES['logo']['size'] <= 1000000)
        {
          // On récupère les informations du fichier.
          $infoFile = pathinfo($_FILES['logo']['name']);
          // On récupère l'extension du fichier.
          $extensionFile = $infoFile['extension'];
          // On définit les extensions de fichier à accepter.
          $extensionOK = ['jpg', 'jpeg', 'gif', 'png'];
          // Si l'extension est bonne.
          if (in_array($extensionFile,$extensionOK))
          {
            $tool = new Tool;
            // On crée un nouveau nom au hasard pour l'image
            $randomFileName = $tool->random_string(10) . "." . $infoFile['extension'];
            // On initialise les données de la nouvelle équipe
            $newTeamArray = [
              "teamName"  => $_POST['team_name'],
              'coachName' => $_POST['coach_name'],
              'logo'      => $randomFileName
            ];
            // On crée un objet équipe avec les données récupérées
            $newTeam = new Team($newTeamArray);
            // On ajoute l'équipes
            $teamManager->addTeam($newTeam);
            // On récupère la liste des équipes
            $teamsList = $teamManager->getTeamsList();
            // On définit le message à afficher
            $data['message'] = "L'equipe ". $_POST['team_name'] ." a bien été créée.";
            $data["teamsList"] = $teamsList;
            $vue = "team";
            // On déplace le fichier dans le dossier uploads
            move_uploaded_file($_FILES['logo']['tmp_name'],'public/uploads/'.basename($randomFileName));
          }
          else
          {
            $data['error'] = "Les extensions de fichier acceptées sont : 'jpg', 'jpeg', 'gif' et 'png'.";
          }
        }
        else
        {
          $data['error'] = "L'image dépasse la taille maximale acceptable.";
        }
      }
      else
      {
        $data['error'] = "Tous les champs doivent être remplis.";
      }
    }
    else
    {
      // On définit un message
      $data['error'] = "Le nombre maximal d'équipes est limité à 10.";
      $vue = 'team';
      $teamManager = new TeamManager();
      // On récupère la liste des équipes
      $data["teamsList"] = $teamManager->getTeamsList();
    }
    
    
    $data['add'] = 'add';
    // On affiche la page avec les données
    $this->render($vue,$data);
  }

    
  /**
   * openEditAction
   *
   * Action d'ouverture de la modification d'une équipe
   * @return void
   */
  function openEditAction()
  {
    $teamManager = new TeamManager();
    // On récupère l'identifiant de l'équipe
    $data['team'] = $teamManager->getTeamById($_GET['id_team']);
    $data['edit'] = "edit";
    // On affiche la page d'édition
    $this->render('teamEdition',$data);
  }
  
  /**
   * editAction
   *
   * Action de modification d'une équipe
   * @return void
   */
  function editAction()
  {
    $teamManager = new TeamManager();
    $vue = "teamEdition";
    $editedTeamArray = [];
    // Si un nouveau logo est renseigné
    if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0)
    {
      // Si le logo n'est pas trop grand
      if ($_FILES['logo']['size'] <= 1000000)
      {
        $infoFile = pathinfo($_FILES['logo']['name']);
        $extensionFile = $infoFile['extension'];
        $extensionOK = ['jpg', 'jpeg', 'gif', 'png'];
        // Si le logo possède la bonne extension de fichier
        if (in_array($extensionFile,$extensionOK))
        {
          $tool = new Tool;
          // On crée une nouvelle chaîne de caractère à donner commme nom à l'image
          $randomFileName = $tool->random_string(10) . "." . $infoFile['extension'];
          $editedTeamArray['logo'] = $randomFileName;
        }
        else
        {
          $data['error'] = "Les extensions de fichier acceptées sont : 'jpg', 'jpeg', 'gif' et 'png'.";
        }
      }
      else
      {
        $data['error'] = "L'image dépasse la taille maximale acceptable.";
      }
    }
    // Si le nom de l'équipe et le nom du coach est renseigné
    if($_POST['team_name'] != null && $_POST['coach_name'] != null)
    {
      $editedTeamArray['teamName'] = $_POST['team_name'];
      $editedTeamArray['coachName'] = $_POST['coach_name'];
      $editedTeamArray['idTeam'] = $_POST['id_team'];
      
      $team = new Team($editedTeamArray);
      // On modifie l'équipe
      $teamManager->editTeam($team);
      if(isset($editedTeamArray['logo']))
      { 
        //$teamManager->deleteLogoByTeamId($_POST['id_team']);
        // On supprime l'ancienne image
        unlink('public/uploads/' . $_POST['logoBefore']);
        // On déplace la nouvelle image
        move_uploaded_file($_FILES['logo']['tmp_name'],'public/uploads/' . basename($randomFileName)); 
      }
      $data['message'] = "L'equipe ". $_POST['team_name'] ." a bien été modifiée.";
      $vue = "team";
    }
    else
    {
      $data['error'] = "Les champs équipe et coach doivent être remplis.";
      $data['team'] = $teamManager->getTeamById($_POST['id_team']);
    }
    
    $teamManager = new TeamManager();
    // On récupère la liste des équipes
    $data["teamsList"] = $teamManager->getTeamsList();
    $data['edit'] = 'edit';
    // On affiche la page et ses paramètres
    $this->render($vue,$data);
  }


    
  /**
   * deleteAction
   *
   * Action de suppression d'une équipe
   * @return void
   */
  function deleteAction()
  {
    $teamManager = new TeamManager();
    
    // On vérifie si l'équipe a des matchs dans la base de données
    if($teamManager->teamByIdHasResult($_GET['id_team']) == false)
    {
      // On récupère l'équipe par son identifiant
      $team = $teamManager->getTeamById($_GET['id_team']);
      // On supprime l'image
      unlink('public/uploads/' . $team->getLogo());
      // On supprime l'éuipe de la base de données
      $teamManager->deleteTeamById($_GET["id_team"]);
      // On prépare un message
      $data['message'] = "L'équipe a bien été supprimée.";
    }
    else
    {
      // On prépare une erreur
      $data['error'] = "L'équipe a encore des résultats, supprimez les d'abord.";
    }
    // On récupère la liste des équipes
    $teamsList = $teamManager->getTeamsList();
    $data["teamsList"] = $teamsList;
    // On affiche la page de la liste des équipes mise à jour avec l'quipe supprimée
    $this->render('team',$data);
  }

    
  /**
   * detailAction
   *
   * Action de visualisation des détails d'une équipe
   * @return void
   */
  function detailAction()
  {
    $teamManager = new TeamManager();
    // On récupère l'quipe grâce à son identifiant
    $data['team'] = $teamManager->getTeamById($_GET['id_team']);
    // On affiche la page des détails de l'équipe avec l'équipe en paramètre
    $this->render('teamDetail',$data);
  }
}