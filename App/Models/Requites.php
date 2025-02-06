<?php
    namespace App\Models;
    
    use App\Models\Database;
    
    class Requites {
        private $dbcon;
        private $sql;
        private $data;


        public function __construct() 
        {
            $this->dbcon = Database::getInstance()->getConnection(); 
        }

        // insertData
        public function insertData($table, $values) {
            $columns = "";
            $placeholders = "";

            foreach($values as $key => $value) {
                $columns .= $key . ", ";
                $placeholders .= ":" . $key . ", ";
            }

            $columns = rtrim($columns, ", ");
            $placeholders = rtrim($placeholders, ", ");

            $this->sql = "INSERT INTO $table($columns) VALUES ($placeholders)";
            $result = $this->dbcon->prepare($this->sql);

            foreach($values as $key => $value) {
                $type = is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                $result->bindValue(":" . $key , $value, $type);
            }
            
            return $result->execute();
        }

        //  selectAll
        public function selectAll($table, $columnName1 = null, $columnValue1 = null, $tableJoin1 = null, $conditionJoin1 = null) {
            $this->sql = "SELECT * FROM $table ";

            if ($tableJoin1 != null && $conditionJoin1 != null) {
                $this->sql .= " JOIN $tableJoin1 tb ON $table.$conditionJoin1 = tb.$conditionJoin1";
            }

            $this->data = $this->dbcon->query($this->sql);

            if ($columnName1 != null && $columnValue1 != null) {
                $this->sql .= " WHERE $columnName1 = :$columnName1";
                $this->data = $this->dbcon->prepare($this->sql);

                $type = is_int($columnValue1) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                $this->data->bindValue(":$columnName1", $columnValue1, $type);
            }

            if ( $this->data->execute()) {
                return $this->data->fetchAll(\PDO::FETCH_ASSOC);
            }
        }

        // selectWhere 
        public function selectWhere($table, $columnName1, $columnValue1, $columnName2=null, $columnValue2=null ) {
            $this->sql = "SELECT * FROM $table WHERE $columnName1 = :$columnName1";

            if ($columnName2!=null && $columnValue2!=null) {
                $this->sql .= " AND $columnName2 = :$columnName2";

                $result = $this->dbcon->prepare($this->sql);
                $type1 = is_int($columnName2) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                $result->bindValue(":".$columnName2, $columnValue2, $type1);
            } else {
                $result = $this->dbcon->prepare($this->sql);
            }
            

            
            $type = is_int($columnValue1) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
            $result->bindValue(":".$columnName1, $columnValue1, $type);

            if ($result->execute()) {
                return $result->fetch(\PDO::FETCH_ASSOC);
            }
        }

        // selectCount
        public function selectCount($table, $columnName1 = null, $columnValue1 = null, $columnName2 = null, $columnValue2 = null) {
            $this->sql = "SELECT COUNT(*) AS totale FROM $table ";
            $result = $this->dbcon->query($this->sql);

            if ($columnName1 != null && $columnValue1 != null) {
                $this->sql .= " WHERE $columnName1 = :$columnName1";
                $result = $this->dbcon->prepare($this->sql);
                $type = is_int($columnValue1) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                $result->bindValue(":$columnName1", $columnValue1, $type);
            } 

            
            
            if ($result->execute()) {
                $this->data = $result->fetch(\PDO::FETCH_ASSOC);
                return $this->data["totale"];
            }
        }

        // update
        public function update($table, $values, $columnName1, $columnValue1) {
            $columnSet = "";
            $param = [];

            foreach($values as $Key => $value) {
                $paramKey = "parame" . count($param);
                $columnSet .= $Key . "= :" . $paramKey .", ";
                $param[$paramKey] = $value;
            }

            $columnSet = rtrim($columnSet, ", ");
            $this->sql = "UPDATE $table SET $columnSet WHERE $columnName1 = :conditionValue";
            
            $stmt = $this->dbcon->prepare($this->sql);

            foreach($param as $Key => $value) {
                $type = is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                $stmt->bindValue(":$Key", $value, $type);
            }    

            $type = is_int($columnValue1) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
            $stmt->bindValue(":conditionValue", $columnValue1, $type);

            if ($stmt->execute()) {
                return $stmt;   
            }
        }

        // deleteWhere
        public function deleteWhere($table, $columnName1, $columnValue1, $columnName2=null, $columnValue2=null) {
            $this->sql = "DELETE FROM $table WHERE $columnName1 = :keyName";

            if ($columnName2!=null && $columnValue2!=null) {
                $this->sql .= " AND $columnName2 = :$columnName2";

                $stmt = $this->dbcon->prepare($this->sql);
                $type1 = is_int($columnName2) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                $stmt->bindValue(":".$columnName2, $columnValue2, $type1);
            } else {
                $stmt = $this->dbcon->prepare($this->sql);
            }

            $type = is_int($columnValue1) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
            $stmt->bindValue(':keyName', $columnValue1, $type);
            if ($stmt->execute()) {
                return $stmt;
            }
        }

        // fetchData
        public function fetchData($table, $columnfilter1, $filter1, $columnfilter2, $filter2, $columnsearch1, $columnsearch2, $search, $status = null, $id_user=null, $enseig = null) {
            $this->sql = "SELECT * FROM $table WHERE 1";
            if ($status != null) {
                $this->sql .= " AND status = '$status'";
            }
            $params = array();

            if ($filter1 != "") {
                $this->sql .= " AND $columnfilter1 = ?";
                $params [] = $filter1;
            }
            if ($enseig != null) {
                $this->sql .= " AND $id_user = ?";
                $params [] = $enseig;
            }
            if ($filter2 != "") {
                $this->sql .= " AND $columnfilter2 = ?";
                $params [] = $filter2;
            }
            if ($search != "") {
                $this->sql .= " AND (($columnsearch1 LIKE ?) OR ($columnsearch2 LIKE ?))";
                $params [] = "%" . $search . "%"; 
                $params [] = "%" . $search . "%";
            }

            $stmt = $this->dbcon->prepare($this->sql);
            $stmt->execute($params);
                return $this->data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        // Max
        public function selectMAX($table, $columnName)
        {
            $this->sql = "SELECT MAX($columnName) FROM $table";
            $this->data = $this->dbcon->query($this->sql);
            $this->data = $this->data->fetch(\PDO::FETCH_ASSOC);
            return $this->data["MAX($columnName)"];
        }
        
        public function GroupOrder($table1, $table2, $conditionJoin1, $conditionJoin2, $conditionGroup, $conditionOrder) {
            $this->sql = "SELECT $table2.*, COUNT(*) AS Totale FROM $table1 LEFT JOIN $table2 ON $table2.$conditionJoin2 = $table1.$conditionJoin1 GROUP BY $conditionGroup ORDER BY $conditionOrder DESC";
            $this->data = $this->dbcon->query($this->sql);
            if ($this->data->execute()) {
                return $this->data->fetchAll(\PDO::FETCH_ASSOC);
            }
        } 


    }