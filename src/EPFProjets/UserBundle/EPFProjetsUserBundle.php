<?php

namespace EPFProjets\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EPFProjetsUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
