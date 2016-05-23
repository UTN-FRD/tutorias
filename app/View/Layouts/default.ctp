<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html>
<html>
<head>
  <?php echo $this->Html->charset(); ?>

  <title>
    <?php echo $this->fetch('title'); ?>
  </title>

  <?php
  echo $this->Html->meta('icon');

  echo $this->Html->css('cake-generic.min');
  echo $this->Html->css('bootstrap.min');
  echo $this->Html->css('styles');

  echo $this->Html->script('jquery/jquery-1.12.1.min');
  echo $this->Html->script('bootstrap.min');

  echo $this->fetch('meta');
  echo $this->fetch('script');
  echo $this->fetch('css');
  ?>
</head>

<body>
  <header>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/tutorias/">Tutorías</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <?php if (AuthComponent::user()) { ?>
            <ul class="nav navbar-nav">
              <li <?php if ($this->request->params['controller'] == 'estudiantes') { echo 'class="active"'; } ?>>
                <a href="/tutorias/estudiantes">Estudiantes</a>
              </li>

              <?php if (AuthComponent::user('role') == 'admin') { ?>
                <li <?php if ($this->request->params['controller'] == 'users') { echo 'class="active"'; } ?>>
                  <a href="/tutorias/users">Usuarios</a>
                </li>

                <li <?php if ($this->request->params['controller'] == 'preguntas') { echo 'class="active"'; } ?>>
                  <a href="/tutorias/preguntas">Preguntas</a>
                </li>
              <?php } ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <?php echo h(AuthComponent::user('username'))?>
                  <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a href="/tutorias/settings">
                      <span class="glyphicon glyphicon-user" aria-hidden="true"></span>Perfil</a>
                  </li>

                  <li class="divider"></li>

                  <li>
                    <a href="/tutorias/users/logout">
                      <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>Salir</a>
                  </li>
                </ul>
              </li>
            </ul>
          <?php } ?>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

  <main>
    <div class="container">
      <?php echo $this->Flash->render(); ?>
      <div id="content">
        <?php echo $this->fetch('content'); ?>
      </div>
    </div>
  </main>

  <footer>
    <div class="row">
      <?php echo $this->element('sql_dump'); ?>
      <p>Desarrollado por &#x2192 UTN - FRD - LSI</p>
    </div>
  </footer>
</body>
</html>
