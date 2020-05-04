<?php


namespace Felis;


class Cases extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site,"case");
    }

    /**
     * Get a case by id
     * @param $id The case by ID
     * @return Object that represents the case if successful,
     *  null otherwise.
     */
    public function get($id) {
        $users = new Users($this->site);
        $usersTable = $users->getTableName();

        $sql = <<<SQL
SELECT c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
from $this->tableName c,
     $usersTable client,
     $usersTable agent
where c.client = client.id and
      c.agent=agent.id and
      c.id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($id));
        if($statement->rowCount() === 0){
            return null;
        }
        return new ClientCase($statement->fetch(\PDO::FETCH_ASSOC));

    }

    public function insert($client, $agent, $number) {
        $sql = <<<SQL
insert into $this->tableName(client, agent, number, summary, status)
values(?, ?, ?, "", ?)
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute([$client,
                        $agent,
                        $number,
                        ClientCase::STATUS_OPEN]
                ) === false) {
                return null;
            }
        } catch(\PDOException $e) {
            return null;
        }

        return $pdo->lastInsertId();
    }

    public function getCases(){
        $users = new Users($this->site);
        $usersTable = $users->getTableName();
        $sql = <<<SQL
select distinct c.id, c.client, client.name as clientName, c.agent, agent.name as agentName, number, summary, status
from $usersTable as client, $usersTable as agent
inner join $this->tableName AS c on c.agent=agent.id
where c.client = client.id
order by status desc, number
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute();
        if($statement->rowCount() === 0){
            return array();
        }
        $cases = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $casesArray = array();
        foreach($cases as $case){
            $clientCase = new ClientCase($case);
            array_push($casesArray,$clientCase);
        }
        return $casesArray;
    }

    public function update(ClientCase $case){
        $sql = <<<SQL
UPDATE $this->tableName
SET number=?, summary=?,status=?,agent=?
WHERE id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $params = array($case->getNumber(), $case->getSummary(), $case->getStatus(), $case->getAgent(), $case->getId());
        try{
            $ret = $statement->execute($params);
        } catch(\PDOException $e){
            return false;
        }
        return true;
    }

    public function delete($id){
        $sql = <<<SQL
DELETE FROM $this->tableName
WHERE id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        try{
            $ret = $statement->execute(array($id));
        } catch(\PDOException $e){
            return false;
        }
    }

}