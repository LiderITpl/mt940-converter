<?php
  namespace MT940Converter\Models;
  
  use MT940Converter\Bootstrap\MySQL\MySqlQueryException;
  use MT940Converter\Exceptions\ModelValidationException;
  use function MT940Converter\Bootstrap\MySQL\getMysql;

  /**
   * @property int|null id
   */
  class Transaction extends ModelBase {
    
    public function __construct(array $attributes=[]) {
      parent::__construct(
          [ 'id', 'statement_number', 'account', 'accountName', 'price', 'debitcredit', 'cancellation', 'description', 'valueTimestamp', 'entryTimestamp', 'transactionCode', 'currency' ],
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
        INSERT INTO transactions (statement_number, account, accountName, price, debitcredit, cancellation, description, valueTimestamp, entryTimestamp, transactionCode, currency)
        VALUES ('{$attrs["statement_number"]}', '{$attrs["account"]}', '{$attrs["accountName"]}', '{$attrs["price"]}', '{$attrs["debitcredit"]}', '{$attrs["cancellation"]}', '{$attrs["description"]}', FROM_UNIXTIME({$attrs["valueTimestamp"]}), FROM_UNIXTIME({$attrs["entryTimestamp"]}), '{$attrs["transactionCode"]}', '{$attrs["currency"]}')
EOD;
      $this->id = getMysql()->insert($sql);
    }
    
    protected function update() {
      // TODO: Na razie niepotrzebne
    }
    
  }