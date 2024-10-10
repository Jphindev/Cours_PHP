<?php
class SubAbs extends UserAbs
{
  public function __construct($n, $p, $a)
  {
    $this->user_name = $n;
    $this->user_pass = $p;
    $this->user_age = $a;
  }

  public function setPrixAbo()
  {
    if ($this->user_age === 'mineur') {
      return $this->prix_abo = parent::ABONNEMENT / 2;
    } else {
      return $this->prix_abo = parent::ABONNEMENT;
    }
  }
}
?>
