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

		echo $this->fetch('meta');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('styles');
		echo $this->Html->script('jquery-1.11.2.min');
		echo $this->Html->script('bootstrap.min');

		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>

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
	      <a class="navbar-brand" href="/">Tutorias</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li <?php echo ($this->request->params['controller'] == 'estudiantes')? 'class="active"' : ''?>><a href="/tutorias/estudiantes">Estudiantes</a></li>
	        <li <?php echo ($this->request->params['controller'] == 'tutores')? 'class="active"' : ''?>><a href="/tutorias/tutores">Tutores</a></li>
	        <li <?php echo ($this->request->params['controller'] == 'preguntas')? 'class="active"' : ''?>><a href="/tutorias/preguntas">Preguntas</a></li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $username?><span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="/tutorias/users/edit/<?php echo $id ?>">Perfil</a></li>
	            <li class="divider"></li>
	            <li><a href="/tutorias/users/logout">logout</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="content">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>

	</div>
	<nav class="navbar-bottom" id="footer">
	<?php echo $this->element('sql_dump'); ?>
	
	  <span class="navbar-right">Desarrollado por -> UTN - FRD - LSI</span>
	</nav>
</body>
</html>
