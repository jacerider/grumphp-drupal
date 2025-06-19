<?php

namespace jacerider\GrumPhpDrupal\Composer\Plugins;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * The GrumPhpConfiguratorPlugin class.
 */
class GrumPhpConfiguratorPlugin implements PluginInterface, EventSubscriberInterface {

  /**
   * Composer instance.
   *
   * @var \Composer\Composer
   */
  private $composer;

  /**
   * The IO interface.
   *
   * @var \Composer\IO\IOInterface
   */
  private $io;

  /**
   * Apply plugin modifications to Composer.
   *
   * @param \Composer\Composer $composer
   *   The composer instance.
   * @param \Composer\IO\IOInterface $io
   *   The IO interface.
   */
  public function activate(Composer $composer, IOInterface $io) {
    $this->composer = $composer;
    $this->io = $io;
  }

  /**
   * Returns the events this plugin subscribes to.
   */
  public static function getSubscribedEvents() {
    return [
      'post-package-install' => 'configureGrumPhp',
      'post-package-update' => 'configureGrumPhp',
    ];
  }

  /**
   * Copies the GrumPHP configuration file to the project root.
   */
  public function configureGrumPhp() {
    $filesInit = [
      '/../../../phpstan.neon' => './phpstan.neon',
    ];
    $filesOverwrite = [
      '/../../../grumphp.yml.dist' => './grumphp.yml.dist',
    ];

    foreach ($filesInit as $source => $destination) {
      if (file_exists($destination)) {
        continue;
      }
      $this->io->write('<fg=green>Copying configuration file...</fg=green>');
      if (!copy(__DIR__ . $source, $destination)) {
        $this->io->write('<fg=red>Copying config failed!</fg=red>');
        continue;
      }
      $this->io->write('<fg=green>Copying config success!</fg=green>');
    }

    foreach ($filesOverwrite as $source => $destination) {
      $this->io->write('<fg=green>Copying configuration file...</fg=green>');
      if (!copy(__DIR__ . $source, $destination)) {
        $this->io->write('<fg=red>Copying config failed!</fg=red>');
        continue;
      }
      $this->io->write('<fg=green>Copying config success!</fg=green>');
    }
  }

  /**
   * Deactivates the plugin.
   */
  public function deactivate(Composer $composer, IOInterface $io): void {
  }

  /**
   * Uninstalls the plugin.
   */
  public function uninstall(Composer $composer, IOInterface $io): void {
  }

}
