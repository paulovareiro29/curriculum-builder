<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';

class Info extends Database
{
    public $id;
    public $curriculum_id;
    public $href;
    public $content;
    public $icon;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function create()
    {
        $sql = "INSERT INTO info (curriculum_id, href, content, icon) VALUES (?,?,?,?)";

        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->curriculum_id, $this->href, $this->content, $this->icon]);
        $this->close();

        if ($stmt->rowCount() > 0) return true;
        return false;
    }

    public function get()
    {
        $sql = "SELECT * FROM info WHERE id = :id";

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
            'href' => $this->href,
            'content' => $this->content,
            'icon' => $this->icon,
            'id' => $this->id,
        ];

        $sql = "UPDATE info SET 
                href = :href,
                content = :content,
                icon = :icon
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
        $sql = "SELECT * FROM info";

        $db = new Database();
        $db->connect();

        $stmt = $db->conn->query($sql);
        $result = $stmt->fetchAll();
        $db->close();

        return $result;
    }

    public static function indexByCurriculum($id)
    {
        $sql = "SELECT * FROM info WHERE curriculum_id = :id";

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
        $sql = "DELETE FROM info WHERE curriculum_id = :id";

        $db = new Database();
        $db->connect();

        $stmt = $db->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $db->close();

        if ($stmt->rowCount() > 0) return true;
        return false;
    }
}
