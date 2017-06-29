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
<html lang="es">
<head>
  <?php echo $this->Html->charset(); ?>

  <title>
    <?php echo $this->fetch('title'); ?>
  </title>

  <script type="text/javascript">
    window.baseUrl = "<?php echo Router::url('/') ?>";
  </script>

  <?php
  echo $this->Html->meta('icon');
  echo $this->Html->meta('description',
    'Sistema de administración de tutorías para alumnos de la UTN Facultad Regional Delta.'
  );
  echo $this->Html->meta(array(
    'name' => 'author',
    'content' => 'Laboratorío de Sistemas de Información de la UTN Facultad Regional Delta'
  ));
  echo $this->Html->meta(array(
    'name' => 'viewport',
    'content' => 'width=device-width'
  ));

  echo $this->Html->css('bootstrap');
  echo $this->Html->css('tutorias');

  echo $this->Html->script('jquery');
  echo $this->Html->script('bootstrap');

  echo $this->fetch('meta');
  echo $this->fetch('script');
  echo $this->fetch('css');
  ?>
</head>

<body>
  <header>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <?php if (AuthComponent::user()) { ?>
            <!-- Brand and toggle get grouped for better mobile display -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          <?php } ?>

          <a id="navbar-brand" class="navbar-brand" href="<?php echo Router::url('/'); ?>">
            <?php
            echo $this->Html->image('utn-logo.png', array(
              'class' => 'logo'
            ));
            ?>
              <?php // Configurar APP.TITTLE en app/Config/core.php ?>
            <span><?php echo Configure::read('APP.TITLE') ?></span>
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="navbar-collapse" class="collapse navbar-collapse">
          <?php if (AuthComponent::user()) { ?>
            <ul id="navbar-nav" class="nav navbar-nav">
              <li <?php if ($this->request->params['controller'] == 'estudiantes') { echo 'class="active"'; } ?> >
                <?php
                echo $this->Html->link(
                // Configurar APP.USERS en app/Config/core.php 
                  Configure::read('APP.USERS'),
                  array('controller' => 'estudiantes', 'action' => 'index')
                );
                ?>
              </li>

              <?php if (AuthComponent::user('role') == 'admin') { ?>
                <li <?php if ($this->request->params['controller'] == 'users') { echo 'class="active"'; } ?> >
                  <?php
                  echo $this->Html->link(
                    'Usuarios',
                    array('controller' => 'users', 'action' => 'index')
                  );
                  ?>
                </li>

                <li <?php if ($this->request->params['controller'] == 'preguntas') { echo 'class="active"'; } ?> >
                  <?php
                  echo $this->Html->link(
                    'Preguntas',
                    array('controller' => 'preguntas', 'action' => 'index')
                  );
                  ?>
                </li>
              <?php } ?>
            </ul>

            <ul id="navbar-right" class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <?php echo h(AuthComponent::user('username')); ?>
                  <span class="caret"></span>
                </a>


                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'edit')); ?>">
                      <span class="glyphicon glyphicon-user"></span>Perfil
                    </a>
                  </li>

                  <li class="divider"></li>

                  <li>
                    <a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'logout')); ?>">
                      <span class="glyphicon glyphicon-log-out"></span>Salir
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          <?php } ?>
        </div>
      </div>
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
      Desarrollado en el Laboratorío de Sistemas de la UTN FRD | Versión <a href="https://github.com/UTN-FRD/tutorias/tree/master" target="_blank">master</a>
    </div>
  </footer>
</body>
</html>
