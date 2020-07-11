<?php
  namespace MT940Converter\Models;
  
  use MT940Converter\Bootstrap\MySQL\MySqlQueryException;
  use MT940Converter\Exceptions\ModelValidationException;
  use function MT940Converter\Bootstrap\MySQL\getMysql;

  /**
   * @property int|null id
   */
  class BankStatement extends ModelBase {
    
    public function __construct(array $attributes=[]) {
      parent::__construct(
          [ 'id', 'bank', 'account', 'startPrice', 'endPrice', 'startTimestamp', 'endTimestamp', 'number', 'currency' ],
          $attributes
      );
    }
  
    /**
     * @throws ModelValidationException
     * @throws MySqlQueryException
     */
    protected function insert() {
      $attrs = $this->validateAttrs();
      $sql = <<<EOD
        INSERT INTO statements (bank, account, startPrice, endPrice, startTimestamp, endTimestamp, number, currency)
        VALUES ('{$attrs["bank"]}', '{$attrs["account"]}', '{$attrs["startPrice"]}', '{$attrs["endPrice"]}', FROM_UNIXTIME({$attrs["startTimestamp"]}), FROM_UNIXTIME({$attrs["endTimestamp"]}), '{$attrs["number"]}', '{$attrs["currency"]}')
EOD;
      $this->id = getMysql()->insert($sql);
    }
  
    protected function update() {
      //TODO: Na razie niepotrzebne
    }
  
  }