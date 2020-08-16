<?php
class Database{
	private $connection;

	public function getDatabaseData(){
		return $this->connection;
	}

	public function connectToDB(){
		//TODO anpassen der Datenbankverbindung
        $db = new mysqli("localhost:3306","root","","dipltml");
		$db->set_charset("utf8");
		$this->connection = $db;
		if($this->connection->connect_error){
			die("Connection failed");
		}
	}

	public function closeDBConnection()
    {
        mysqli_close($this->connection);
    }

    public function query($query){
    	$result = mysqli_query($this->connection,$query);
    	return $result;
    }

    public function select($query){
    	$rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        while ($row = $result -> fetch_object()) {
            $rows[] = $row;
        }
        return $rows;
    }

     /**
    	Register Statement
    **/
    public function getPersonID($age,$gender,$videofreq,$naviusage,$navifreq,$navitype){
    	$this->connectToDB();
        $unqid = uniqid();
    	$resultData = $this->connection->query("INSERT INTO person(age,gender,videofreq,naviusage,navifreq,navitype,unqid) 
            VALUES ($age,$gender,$videofreq,$naviusage,$navifreq,$navitype,'$unqid')");

        if(!$resultData){
            throw new Exception("Message: " . $resultData . "<br>" . mysqli_error($this->connection));
        }
    	//get the inserted id
    	$id = $this->select("SELECT personid AS ID FROM person WHERE unqid = '$unqid'");

        $this->closeDBConnection();

    	return $id[0]->ID;
    }

    //3 Antworten richtig - 3 Antworten falsch
    public function saveTask1($tasknr,$corr1,$corr2,$corr3,$personid){
       $this->connectToDB();

       //Änderung wegen auch möglich weniger Auswahl bei Task1 (muss nicht min 3 Namen ausgewählt werden)
       $values = '';
       $valuesNum = '';
       if($corr2 == 'Corr0'){
            $values = $corr1;
            $valuesNum = 1;
       }
       else if($corr3 == 'Corr0'){
            $values = $corr1 . ",". $corr2;
            $valuesNum = 1 . "," . 1;
        }
        else{
            $values = $corr1 . ",". $corr2 . "," . $corr3;
            $valuesNum = 1 . "," . 1 . "," . 1;
        }
       
       $resultData = $this->connection->query("INSERT INTO tasks(TaskNr,$values,PersonID) 
            VALUES ($tasknr,$valuesNum,$personid)"); 
       if(!$resultData){
            throw new Exception("Message: " . $resultData . "<br>" . mysqli_error($this->connection));
        }
    }

    //Anzahl Links- und Rechtskurven
    public function saveTask2($tasknr,$defstreet,$personid){
       $this->connectToDB();
       $resultData = $this->connection->query("INSERT INTO tasks(TaskNr,DefStreet,PersonID) 
            VALUES ($tasknr,'$defstreet',$personid)"); 
       if(!$resultData){
            throw new Exception("Message: " . $resultData . "<br>" . mysqli_error($this->connection));
        }
    }

    //3 Variante - nur eine Variante ausgewählt
    public function saveTask3($tasknr,$var1,$var2,$var3,$var4,$personid){
       $this->connectToDB();
       $resultData = $this->connection->query("INSERT INTO tasks(TaskNr,Var1,Var2,Var3,Var4,PersonID) 
            VALUES ($tasknr,$var1,$var2,$var3,$var4,$personid)"); 
       if(!$resultData){
            throw new Exception("Message: " . $resultData . "<br>" . mysqli_error($this->connection));
        }
    }

    //prüfen Task1 richtige Antwort
    public function checkCorrectAnswer1($tasknr,$personid){
        $this->connectToDB();
        $resultData = $this->select("SELECT COUNT(*) AS Count FROM tasks a INNER JOIN answers b ON a.Corr1 = b.Corr1 AND a.Corr2 = b.Corr2 AND a.Corr3 = b.Corr3 AND a.Corr4 = b.Corr4 AND a.Corr5 = b.Corr5 AND a.Corr6 = b.Corr6 AND a.TaskNr = b.TaskNr WHERE a.TaskNr = $tasknr AND a.PersonID = $personid");

        $this->count = $resultData[0]->Count;
        //richtige Anwort
        if ($this->count > 0) {
            $resultData = $this->connection->query("INSERT INTO correctanswers(PersonID,TaskNr) VALUES ($personid,$tasknr)");
            if(!$resultData){
                throw new Exception("Message: " . $resultData . "<br>" . mysqli_error($this->connection));
            }
        }
        return $this->count;
    }

    //prüfen Task2 richtige Antwort
    public function checkCorrectAnswer2($tasknr,$personid){
        $this->connectToDB();
        $resultData = $this->select("SELECT COUNT(*) AS Count FROM tasks a INNER JOIN answers b ON a.DefStreet = b.DefStreet AND a.TaskNr = b.TaskNr WHERE a.TaskNr = $tasknr AND a.PersonID = $personid");
        $this->count = $resultData[0]->Count;
        //richtige Anwort
        if ($this->count > 0) {
            $resultData = $this->connection->query("INSERT INTO correctanswers(PersonID,TaskNr) VALUES ($personid,$tasknr)");
            if(!$resultData){
                throw new Exception("Message: " . $resultData . "<br>" . mysqli_error($this->connection));
            }
        }
        return $this->count;
    }

    //prüfen Task3 richtige Antwort
    public function checkCorrectAnswer3($tasknr,$personid){
        $this->connectToDB();
        $resultData = $this->select("SELECT COUNT(*) AS Count FROM tasks a INNER JOIN answers b ON a.Var1 = b.Var1 AND a.Var2 = b.Var2 AND a.Var3 = b.Var3 AND a.Var4 = b.Var4 AND a.TaskNr = b.TaskNr WHERE a.TaskNr = $tasknr AND a.PersonID = $personid");
        $this->count = $resultData[0]->Count;
        //richtige Anwort
        if ($this->count > 0) {
            $resultData = $this->connection->query("INSERT INTO correctanswers(PersonID,TaskNr) VALUES ($personid,$tasknr)");
            if(!$resultData){
                throw new Exception("Message: " . $resultData . "<br>" . mysqli_error($this->connection));
            }
        }
        return $this->count;
    }

    /**
    * Insgesamt richtige Antworten
    */
    public function getNumCorrectAnswers($personid){
        $this->connectToDB();
        $resultData = $this->select("SELECT COUNT(*) AS Count FROM correctanswers WHERE PersonID = $personid AND TaskNr NOT IN (-1,-2,-3)");
        //richtige Anwort
        return $resultData[0]->Count;
    }

    /**
    * Richtige Anworten für Task 1-6
    */
    public function getNumCorrTask1($personid){
        $this->connectToDB();
        $resultData = $this->select("SELECT COUNT(*) AS Count FROM correctanswers WHERE PersonID = $personid AND TaskNr IN (1,2,3,4,5,6)");
        //richtige Anwort
        return $resultData[0]->Count;
    }

    /**
    * Richtige Anworten für Task 7-12
    */
    public function getNumCorrTask2($personid){
        $this->connectToDB();
        $resultData = $this->select("SELECT COUNT(*) AS Count FROM correctanswers WHERE PersonID = $personid AND TaskNr IN (7,8,9,10,11,12)");
        //richtige Anwort
        return $resultData[0]->Count;
    }

    /**
    * Richtige Anworten für Task 13-18
    */
    public function getNumCorrTask3($personid){
        $this->connectToDB();
        $resultData = $this->select("SELECT COUNT(*) AS Count FROM correctanswers WHERE PersonID = $personid AND TaskNr IN (13,14,15,16,17,18)");
        //richtige Anwort
        return $resultData[0]->Count;
    }

    /**
    * Feedback zu person speichern
    */
    public function updatePerson($feedText,$personid){
        $this->connectToDB();
        $resultData = $this->connection->query("UPDATE person SET feedback = '$feedText' WHERE PersonID = $personid");
        if (!$resultData) {
            echo "Message: " . $resultData . "<br>" . mysqli_error($this->connection);
        }
        $this->closeDBConnection();  
    }

    /**
    * Antwortmöglichkeiten für Task1
    */
    public function getTask1($taskid){
        $this->connectToDB();
        $resultData = $this->select("SELECT Val1,Val2,Val3,Val4,Val5,Val6 FROM task1value WHERE TaskNr = $taskid");
        $_return = array();
        if(!$resultData){
            $this->closeDBConnection();
            return $_return;
        }
        foreach($resultData as $array){
            $task1 = new task1($array->Val1,$array->Val2,$array->Val3,$array->Val4,$array->Val5,$array->Val6);
            $_return[] = $task1;
        }
        $this->closeDBConnection();
        return $_return[0]; 
    }

    /**
    * Antwortmöglichkeiten für Task3
    */
    public function getTask3($taskid){
        $this->connectToDB();
        $resultData = $this->select("SELECT Val1,Val2,Val3,Var FROM task3value WHERE TaskNr = $taskid ORDER BY Var");
        $_return = array();
        if(!$resultData){
            $this->closeDBConnection();
            return $_return;
        }
        foreach($resultData as $array){
            $task3 = new task3($array->Val1,$array->Val2,$array->Val3,$array->Var);
            $_return[] = $task3;
        }
        $this->closeDBConnection();
        return $_return; 
    }


}
?>