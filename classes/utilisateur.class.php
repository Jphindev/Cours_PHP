<?php
abstract class UserAbs
{
  protected $user_name;
  protected $user_age;
  protected $prix_abo;
  protected $user_pass;
  public const ABONNEMENT = 15;

  abstract public function setPrixAbo();

  public function getNom()
  {
    echo $this->user_name;
  }
  public function getPrixAbo()
  {
    echo $this->prix_abo;
  }
}

//

class UserAbo
{
  protected $user_name;
  protected $user_pass;
  protected $prix_abo;
  protected $user_cat;
  public const ABONNEMENT = 15;

  public function __construct($n, $p, $c)
  {
    $this->user_name = $n;
    $this->user_pass = $p;
    $this->user_cat = $c;
  }

  public function getNom()
  {
    echo $this->user_name;
  }

  public function setPrixAbo()
  {
    if ($this->user_cat === 'mineur') {
      return $this->prix_abo = self::ABONNEMENT / 2;
    } else {
      return $this->prix_abo = self::ABONNEMENT;
    }
  }

  public function getPrixAbo()
  {
    echo $this->prix_abo;
  }
}

//

class User
{
  protected $user_name;
  protected $user_pass;

  public function __construct($n, $p)
  {
    $this->user_name = $n;
    $this->user_pass = $p;
  }

  public function getNom()
  {
    echo $this->user_name;
  }
}

//

class Utilisateur
{
  private $user_name;
  private $user_pass;

  public function getNom()
  {
    return $this->user_name;
  }

  public function setNom($new_user_name)
  {
    $this->user_name = $new_user_name;
  }

  public function setPasse($new_user_pass)
  {
    $this->user_pass = $new_user_pass;
  }
}

//

class Utilisateur_test
{
  public $user_name;
  public $user_pass;
}
?>
