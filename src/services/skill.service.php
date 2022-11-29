<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';

class Skill extends Database
{
    public $id;
    public $curriculum_id;
    public $content;
    public $rating;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function create()
    {
        $sql = "INSERT INTO skill (curriculum_id,  content, rating) VALUES (?,?,?)";

        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->curriculum_id, $this->content, $this->rating]);
        $this->close();

        if ($stmt->rowCount() > 0) return true;
        return false;
    }

    public function get()
    {
        $sql = "SELECT * FROM skill WHERE id = :id";

        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $result = $stmt->fetch();
        $this->close();

        if ($result) return $result;
        return null;
    }

    public function update()
    {
        $data = [
            'content' => $this->content,
            'rating' => $this->rating,
            'id' => $this->id,
        ];

        $sql = "UPDATE skill SET 
                content = :content,
                rating = :rating
                WHERE id = :id";


        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        $this->close();

        if ($stmt->rowCount() > 0) return true;
        return false;
    }

    public static function index()
    {
        $sql = "SELECT * FROM skill";

        $db = new Database();
        $db->connect();

        $stmt = $db->conn->query($sql);
        $result = $stmt->fetchAll();
        $db->close();

        return $result;
    }

    public static function indexByCurriculum($id)
    {
        $sql = "SELECT * FROM skill WHERE curriculum_id = :id";

        $db = new Database();
        $db->connect();

        $stmt = $db->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll();
        $db->close();

        return $result;
    }

    public static function deleteByCurriculum($id)
    {
        $sql = "DELETE FROM skill WHERE curriculum_id = :id";

        $db = new Database();
        $db->connect();

        $stmt = $db->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $db->close();

        if ($stmt->rowCount() > 0) return true;
        return false;
    }
}
