<?php

namespace App\Class\Connection;
use PDO;
  require(dirname(__DIR__) . '../../Page/handleErrors.php');

  class Connection{

      private string $dsn;
      private string $username;
      private string $password;
      private string $charset;
      private array  $options;
      private static $db;

      /**
       * Connection constructor.
       * @param string $dsn
       * @param string $username
       * @param string $password
       * @param string $charset
       * @param array $options
       */
      public function __construct(string $dsn, string $username, string $password, string $charset, array $options)
      {
          $this->dsn = $dsn;
          $this->username = $username;
          $this->password = $password;
          $this->charset = $charset;
          $this->options = $options;
      }


      public static function get(): ?PDO
      {
          $config = require(dirname(__DIR__) . '../../../../config/app.conf.php');
          $config = $config['database'];
          $dsn = $config['connection'];
          $username = $config['username'];
          $password = $config['password'];
          $charset = $config['charset'];

          if (empty(self::$db)){
              self::$db = $dsn.';'.$username.';'.$password.';'.$charset;
              $options = [
                  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                  PDO::ATTR_EMULATE_PREPARES   => false,
                  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
              ];
              try{
                  self::$db = new PDO($dsn, $username, $password, $options);
              } catch (\PDOException $e) {
                  error_log(PHP_EOL.$e->getMessage(), 3, "php-errors.log");
                  throw new \PDOException($e->getMessage(), (int)$e->getCode());
              }
          }
          return self::$db;
      }
  }
