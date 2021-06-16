<?php
namespace controller;

abstract class Controller
{

    protected $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $this->twig = new \Twig\Environment( $loader );

        /*
         * On détermine s'il existe dans l'url un paramètre
         * action correspondant à une action du contrôleur
         */
        if( isset( $_REQUEST['action'] ) &&  method_exists($this, $_REQUEST["action"] . 'Action' )) {

            //Si c'est le cas, on appelle cette action
            $action = $_REQUEST["action"] . 'Action';
            $this->$action();
        } else {
            $this->defaultAction();
        }
    }


    /**
     * Action par défaut du contrôleur
     * (à définir dans les classes filles)
     */
    abstract public function defaultAction();


    /**
     * Affiche la vue
     * @param   string $vue nom de la vue
     * @param   array $data tableau contenant les données à passer à la vue
     * @return  aucun
     */
    public function render( $view, $data = [] )
    {
        //Les valeurs du tableau sont mappées en variables
       // extract( $data );

        $viewPath = ucfirst( $view ) . 'View.twig';

        if( file_exists( 'view/' . $viewPath ) ) {
            echo $this->twig->render( $viewPath, $data );
        } else {
            $this->errorAction( 'View not exist !' );
        }
    }


    /**
     * Méthode affichant une page d'erreur
     * @param  string $message Message d'erreur à afficher
     * @return aucun
     */
    protected function errorAction($message = '')
    {
        $data = [
            'title' => "Error",
            'message' => $message
        ];
        // $this->render("message", $data);
        var_dump($data);
    }


}
?>
