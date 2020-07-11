<?php
  namespace MT940Converter;
  
  use MT940Converter\Bootstrap\MySQL\MySqlQueryException;
  use MT940Converter\Bootstrap\MySQL\MySqlSingleton;
  use MT940Converter\Exceptions\ModelValidationException;
  use MT940Converter\Models\BankStatement;
  use MT940Converter\Models\Transaction;
  use Exception;
  use Kingsquare\Banking\Statement;
  use Kingsquare\Parser\Banking\Mt940;
  use Kingsquare\Parser\Banking\Mt940\Engine\Ing as ING_Engine;

  class MT940Converter {
    private static $fakeHeader = <<<EOD
:20:MT940
-

EOD;
  
    /**
     * MT940Converter constructor.
     * @param array $dbCredentials
     * @throws Bootstrap\MySQL\MySqlDbConnException
     */
    public function __construct(array $dbCredentials) {
      MySqlSingleton::open([
          $dbCredentials["MYSQL_HOST"],
          $dbCredentials["MYSQL_USER"],
          $dbCredentials["MYSQL_PASSWORD"],
          $dbCredentials["MYSQL_DB_NAME"],
      ]);
    }
  
    /**
     * @param string $doc
     * @return int[]
     * @throws ModelValidationException
     * @throws MySqlQueryException
     * @throws Exception
     */
    public function importDocument(string $doc) {
      $newDoc = MT940Converter::$fakeHeader . $doc;
      $parser = new Mt940();
      $engine = new ING_Engine();
  
      /**
       * @var Statement[]
       */
      $parsedStatements = $parser->parse($newDoc, $engine);
  
      $importedStatements = 0; $importedTransactions = 0;
      
      foreach($parsedStatements as $statement) {
        $statementModel = new BankStatement($statement->jsonSerialize());
        $statementModel->save();
        $importedStatements++;
        
        foreach($statement->getTransactions() as $transaction) {
          $transactionModel = new Transaction(array_merge(
              $transaction->jsonSerialize(),
              ['statement_number' => $statement->getNumber(), 'currency' => $statement->getCurrency()]
          ));
          $transactionModel->save();
          $importedTransactions++;
        }
      }
      return [$importedStatements, $importedTransactions];
    }
    
    public function __destruct() {
      MySqlSingleton::close();
    }
  
  }