<?php

namespace Soyons\FootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Soyons\FootBundle\Entity\Users;

use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;


class DefaultController extends Controller
{
  public function indexAction()
  {
    return $this->render('SoyonsFootBundle:Default:index.html.twig');
  }

  public function debutantguideAction()
  {
    return $this->render('SoyonsFootBundle:Debutantguide:index.html.twig');
  }

  public function techniquesAction()
  {
    return $this->render('SoyonsFootBundle:Techniques:index.html.twig');
  }

  public function connexionAction()
  {

    if(empty($_POST) == false ) {

      $session = new Session();

      $session->start();

      $pdo = new \PDO('mysql:host=localhost;dbname=SoyonsFoot', 'root', 'troiswa');

      $pdo->exec('SET NAMES UTF8');

      $query = $pdo->prepare
      (
        'SELECT
        *
        FROM
        Users
        WHERE Email = ?'
      );

      $query->execute([ $_POST['email'] ]);

      $user = $query->fetch(\PDO::FETCH_ASSOC);

      function verifyPassword($password, $hashedPassword)
      {
        // Si le mot de passe en clair est le même que la version hachée alors renvoie true.
        return crypt($password, $hashedPassword) == $hashedPassword;
      }

      if(verifyPassword($_POST['motdepasse'], $user['Password']) && $user != false ) {

      $_SESSION['user']['Id'] = $user['Id'];
      $_SESSION['user']['Firstname'] = $user['Firstname'];
      $_SESSION['user']['Lastname'] = $user['Lastname'];
      $_SESSION['user']['Email'] = $user['Email'];
      $_SESSION['user']['Score'] = $user['Score'];

      return $this->redirectToRoute('soyons_foot_jeu');

      }

    }

    return $this->render('SoyonsFootBundle:Connexion:index.html.twig');

  }

  public function loginAction()
  {

    if(empty($_POST) == false ) {


      function hashPassword($password)
      {
        $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);


        return crypt($password, $salt);
      }

      $hash = hashPassword($_POST['motdepasse']);

      $user = new Users();

      $user->setLastName($_POST['nom']);
      $user->setFirstName($_POST['prenom']);
      $user->setEmail($_POST['email']);
      $user->setPassword($hash);

      $em = $this->getDoctrine()->getManager();

      $em->persist($user);

      $em->flush();

      return $this->render('SoyonsFootBundle:Connexion:index.html.twig');

    }

    return $this->render('SoyonsFootBundle:Login:index.html.twig');

  }

  public function jeuAction()
  {

    session_start();

    $pdo = new \PDO('mysql:host=localhost;dbname=SoyonsFoot', 'root', 'troiswa');

    $pdo->exec('SET NAMES UTF8');

    $query = $pdo->prepare
    (
      'SELECT
      *
      FROM
      Users
      ORDER BY Score DESC'
    );

    $query->execute([]);

    $classement = $query->fetchAll(\PDO::FETCH_ASSOC);


    $queryo = $pdo->prepare
    (
      'SELECT * FROM Lesmatchs
      ORDER BY Idette
      DESC LIMIT 1'
    );

    $queryo->execute([]);

    $matchs = $queryo->fetch(\PDO::FETCH_ASSOC);



    if(empty($_POST) == false) {

      $queryProno = $pdo->prepare
		    (
		    ' INSERT INTO
                Pronostics
                (MatchId, Prono, UserId)
            VALUES
                (?, ?, ?)'
		    );

      $queryProno->execute([$_POST['id'], $_POST['prono'], $_SESSION['user']['Id']]);

      $message = "VOTRE PARI A ETE PRIS EN COMPTE" ;

      return $this->render('SoyonsFootBundle:Jeu:index.html.twig', ['classemento' => $classement, 'match' => $matchs, 'message' => $message]);

    }

    $message = "" ;

    return $this->render('SoyonsFootBundle:Jeu:index.html.twig', ['classemento' => $classement, 'match' => $matchs, 'message' => $message]);

  }

}
