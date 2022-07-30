<?php
class Patients{

    private $patientsTable = "patients";
    private $visitsTable = "visits";
    public $id;
    public $patient_id;
    public $firstname;
    public $lastname;
    public $dob;
    public $gender;
    public $date;

    public $height;
    public $weight;
    public $bmi;
    public $good_health;
    public $ever_on_diet;
    public $comments;

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        if($this->id) {
            $stmt = $this->conn->prepare("SELECT * FROM ".$this->patientsTable." WHERE patient_id = ?");
            $stmt->bind_param("i", $this->id);
        } else {
            $stmt = $this->conn->prepare("SELECT * FROM ".$this->patientsTable);
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    function read_all(){
        if($this->id) {
            // SELECT p.firstname, p.lastname, p.dob, p.date, v.bmi FROM patients p INNER JOIN visits v ON p.patient_id = v.patient_id WHERE p.patient_id = 7 ORDER BY p.date DESC LIMIT 1
            $stmt = $this->conn->prepare("SELECT p.patient_id, p.firstname, p.lastname, p.dob, p.date, v.bmi,  v.id, v.patient_id FROM ".$this->patientsTable." p INNER JOIN visits v ON p.patient_id = v.patient_id WHERE p.patient_id = ? ORDER BY p.date DESC LIMIT 1");
            $stmt->bind_param("i", $this->id);
        } else {
            $stmt = $this->conn->prepare("SELECT p.patient_id, p.firstname, p.lastname, p.dob, p.date, v.bmi, v.id, v.patient_id FROM ".$this->patientsTable." p INNER JOIN ".$this->visitsTable." v ON p.patient_id=v.patient_id");
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    function create(){
        $stmt = $this->conn->prepare("
			INSERT INTO ".$this->patientsTable."(firstname, lastname, dob, gender, date)
			VALUES(?,?,?,?,?)");

        $this->extracted_patient();

        $stmt->bind_param("sssss",
            $this->firstname,
            $this->lastname,
            $this->dob,
            $this->gender,
            $this->date
        );

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function update_patient(){

        $stmt = $this->conn->prepare("
			UPDATE ".$this->patientsTable." 
			SET firstname= ?, lastname = ?, dob = ?, gender = ?, date = ?
			WHERE patient_id = ?");

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->extracted_patient();

        $stmt->bind_param("sssssi",
            $this->firstname,
            $this->lastname,
            $this->dob,
            $this->gender,
            $this->date,
            $this->id
        );

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function update_visit(){

        $stmt = $this->conn->prepare("
			UPDATE ".$this->visitsTable." 
			SET height = ?, weight = ?, bmi = ?, good_health = ?, ever_on_diet = ?, comments = ?
			WHERE patient_id = ?");

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->extracted_visit();

        $stmt->bind_param("sssssi",
            $this->height,
            $this->weight,
            $this->bmi,
            $this->good_health,
            $this->ever_on_diet,
            $this->comments,
            $this->id
        );

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function patient_visit(){
        $stmt = $this->conn->prepare("                                                     
        	INSERT INTO ".$this->visitsTable."(height, weight, bmi, good_health, ever_on_diet, comments, patient_id)   
        	VALUES(?,?,?,?,?,?,?)");

        $this->patient_id = htmlspecialchars(strip_tags($this->patient_id));
        $this->extracted_visit();

        $stmt->bind_param("dddsssi",
            $this->height,
            $this->weight,
            $this->bmi,
            $this->good_health,
            $this->ever_on_diet,
            $this->comments,
            $this->patient_id
        );

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function delete(){

        $stmt = $this->conn->prepare("
			DELETE FROM ".$this->patientsTable." 
			WHERE patient_id = ?");

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bind_param("i", $this->id);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // search patients
    function search($keywords){

        // select all query
        $query = "SELECT
                p.id, p.firstname, p.lastname, p.dob, p.gender, p.date
            FROM
                " . $this->patientsTable . " p
            WHERE
                p.firstname LIKE ? OR p.lastname LIKE ?
            ORDER BY
                p.id DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // used for paging products
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->patientsTable . "";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

    /**
     * @return void
     */
    public function extracted_patient(): void
    {
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->dob = htmlspecialchars(strip_tags($this->dob));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->date = htmlspecialchars(strip_tags($this->date));
    }

    /**
     * @return void
     */
    public function extracted_visit(): void
    {
    $this->height = htmlspecialchars(strip_tags($this->height));
    $this->weight = htmlspecialchars(strip_tags($this->weight));
    $this->bmi = htmlspecialchars(strip_tags($this->bmi));
    $this->good_health = htmlspecialchars(strip_tags($this->good_health));
    $this->ever_on_diet = htmlspecialchars(strip_tags($this->ever_on_diet));
    $this->comments = htmlspecialchars(strip_tags($this->comments));
    }
}
