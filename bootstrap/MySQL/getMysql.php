<?php
  namespace MT940Converter\Bootstrap\MySQL;

  function getMysql() {
    return MySqlSingleton::getInstance();
  }