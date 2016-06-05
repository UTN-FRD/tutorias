<?php
/**
 * Proyecto de Administración de Tutorías
 *
 * (c) Universidad Tecnológica Nacional - Facultad Regional Delta
 */
namespace App\Console;

use Composer\Script\Event;

/**
 * Provee hooks de instalación para cuando esta aplicación se instala a través de Composer
 */
class Installer {

/**
 * Ejecuta tareas de rutina posteriores a la instalación
 *
 * @param \Composer\Script\Event $event Evento
 *
 * @return void
 */
	public static function postInstall(Event $event) {
		$io = $event->getIO();
		$rootDir = dirname(dirname(__FILE__));

		$io->write('  <info>> Estableciendo permisos...</info>');
		static::_setFolderPermissions($rootDir, $io);

		$io->write('  <info>> Creando archivos de configuración...</info>');
		if (static::_createConfigFiles($rootDir, $io)) {
			$io->write('  <info>> Actualizando configuración de seguridad...</info>');
			static::_updateSecurityConfig($rootDir, $io);
		}
	}

/**
 * Establece permisos de escritura en el directorio temporal
 *
 * @param string $dir Ruta de acceso al directorio de la aplicación
 * @param \Composer\IO\IOInterface $io Interfaz de Entrada/Salida para escribir a la consola
 *
 * @return void
 */
	protected static function _setFolderPermissions($dir, $io) {
		$changePerms = function ($path, $perms, $io) {
			$currentPerms = octdec(substr(sprintf('%o', fileperms($path)), -4));
			if (($currentPerms & $perms) == $perms) {
				return;
			}

			$res = chmod($path, $currentPerms | $perms);
			$path = substr($path, strpos($path, '/tmp') + 1);
			if ($res) {
				$io->write('    > Permisos establecidos en `' . $path . '`');
			} else {
				$io->write('    > No fue posible establecer permisos en `' . $path . '`');
			}
		};

		$walker = function ($dir, $perms, $io) use (&$walker, $changePerms) {
			$files = array_diff(scandir($dir), array('.', '..'));
			foreach ($files as $file) {
				$path = $dir . '/' . $file;
				if (!is_dir($path)) {
					continue;
				}

				$changePerms($path, $perms, $io);
				$walker($path, $perms, $io);
			}
		};

		$worldWritable = bindec('0000000111');
		$walker($dir . '/tmp', $worldWritable, $io);
		$changePerms($dir . '/tmp', $worldWritable, $io);
	}

/**
 * Crea los archivos de configuración si no existen
 *
 * @param string $dir Ruta de acceso al directorio de la aplicación
 * @param \Composer\IO\IOInterface $io Interfaz de Entrada/Salida para escribir a la consola
 *
 * @return bool
 */
	protected static function _createConfigFiles($dir, $io) {
		$appConfig = $dir . '/Config/core.php';
		$dbConfig = $dir . '/Config/database.php';

		if (!file_exists($appConfig)) {
			if (copy($appConfig . '.default', $appConfig)) {
				$io->write('    > Creado `Config/core.php`');
			} else {
				$io->write('    > No fue posible crear `Config/core.php`');
				return false;
			}
		}

		if (!file_exists($dbConfig)) {
			if (copy($dbConfig . '.default', $dbConfig)) {
				$io->write('    > Creado `Config/database.php`');
			} else {
				$io->write('    > No fue posible crear `Config/database.php`');
				return false;
			}
		}

		return true;
	}

/**
 * Actualiza opciones de configuración de seguridad
 *
 * @param string $dir Ruta de acceso al directorio de la aplicación
 * @param \Composer\IO\IOInterface $io Interfaz de Entrada/Salida para escribir a la consola
 *
 * @return void
 */
	protected static function _updateSecurityConfig($dir, $io) {
		$config = $dir . '/Config/core.php';
		$content = file_get_contents($config);

		$newSalt = hash('sha256', $dir . php_uname() . microtime(true));
		$newCipher = mt_rand(1, 9);
		for ($i = 0; $i <= 24; $i++) {
			$newCipher .= mt_rand(0, 9);
		}

		$content = str_replace('__SALT__', $newSalt, $content, $count);
		if ($count == 0) {
			$io->write('    > <warning>No se encontró el marcador de posición de `Security.salt` para reemplazarlo.</warning>');
			return;
		}

		$content = str_replace('__CIPHER__', $newCipher, $content, $count);
		if ($count == 0) {
			$io->write('    > <warning>No se encontró el marcador de posición de `Security.cipherSeed` para reemplazarlo.</warning>');
			return;
		}

		$result = file_put_contents($config, $content);
		if ($result) {
			$io->write('    > Actualizado `Config/core.php`');
		} else {
			$io->write('    > No fue posible actualizar `Config/core.php`');
		}
	}
}
