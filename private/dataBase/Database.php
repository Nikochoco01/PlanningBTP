<?php


$iutLog = "mysql:host=iutbg-lamp.univ-lyon1.fr:3306;dbname=p2101430";
$iutLogUser = "p2101430";
$iutLogPassword = "12101430";

$LocalHost = "mysql:host=localhost:3306;dbname=bdsite";
$LocalhostLogUser = "root";
$LocalhostLogPassword = "root";

/**
 * Class Database
 * pour une abstraction totale de la base de données, le but étant de simplifier le code
 */
class Database
{
    /**
     * @var null|PDO stocke l'instance de PDO
     */
    private $pdo = null;

    /**
     * @const Le DSN pilote de la base de données
     */
    private const DSN = "mysql:host=iutbg-lamp.univ-lyon1.fr:3306;dbname=p2101430";

    /**
     * @const Le nom d'utilisateur de l'accès à la base de données
     */
    private const USER = "p2101430";

    /**
     * @const Le mot de passe d'accès à la base de données
     */
    private const PASSWORD = "12101430";

    /**
     * @const Si on est en mode production ou développement, car les erreurs seront affichées en mode dev, pas en prod
     */
    private const PRODUCTION = true;

    /**
     * @param string $password
     * @return string hashed
     */
    private function hash(string $password): string
    {
        // on choisira ici la méthode de hash de mot de passe
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Une fonction intermédiaire qui formate les conditions d'un select
     * @param array $data
     * @return array
     */
    private function conditions(array $data): array
    {
        $condition = "";
        $values = [];
        if (isset($data['password'])) { // on exclut password de la recherche, car on ne trouvera jamais de correspondance
            unset($data['password']);
        }
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $condition .= ($condition != "") ? " AND " : "";
                $operator = explode(" ", $key); // gestion des opérateurs dans les conditions : <= >= != <> LIKE
                if (isset($operator[1])) {
                    $condition .= $operator[0] . " " . $operator[1] . " ? ";
                } else {
                    $condition .= $operator[0] . " = ? ";
                }
                $values[] = $value;
            }
        }
        return [
            'condition' => $condition,
            'values' => $values,
        ];
    }

    /**
     * Initialise PDO si l'instance n'est pas créée, retourne l'instance sinon
     * @return PDO
     * @throws Exception
     */
    private function getPdo(): PDO
    {
        if (!$this->pdo) {
            if (
                preg_match("/^sqlite:(.*)$/", self::DSN, $match) &&
                !file_exists($match[1])
            ) {
                throw new Exception('Fichier de base de données Sqlite introuvable');
            }
            try {
                $param = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]; // pour avoir les résultats sous forme d'objet
                if (!self::PRODUCTION) {
                    $param[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; // on affiche les erreurs en mode dev uniquement
                }
                $this->pdo = new PDO(self::DSN, self::USER, self::PASSWORD, $param);
            } catch (PDOException $e) {
                throw new Exception("Erreur : " . $e->getMessage());
            }
        }
        return $this->pdo;
    }

    /**
     * Execute une requête sql en mode préparé
     *
     * @param string $query La requête à exécuter
     * @param array $values Les valeurs à injecter dans la requête préparée
     * @return PDOStatement En fonction du type de résultat généré par la requête
     * @throws Exception
     */
    public function query(string $query, array $values = []): PDOStatement
    {
        $statement = $this->getPdo()->prepare($query);
        if ($statement === false) {
            throw new Exception('Erreur de requête SQL');
        }
        $statement->execute($values);
        return $statement;
    }

    /**
     * Lire des données d'une $table en indiquant une série d'options au format d'un tableau (voir structure tableau $default)
     *
     * @param string $table Le nom de la table
     * @param array $options
     *  [
     *      "conditions" => ["champ" => "valeur"],
     *      "fields" => ['col1', 'col2', 'col6'],
     *      "limit" => 10,
     *      "offset" => 0,
     *      "order" => ['col5', 'col7 DESC']
     *  ]
     * @param bool $one Pour ne récupérer qu'un seul résultat
     * @return array|object Les résultats de la requête de recherche
     * @throws Exception
     */
    public function read(string $table, array $options = [], bool $one = false)
    {
        $options = array_merge(
            [
                "conditions" => [], // exemple : ["champ" => "valeur"] correspond à WHERE champ='valeur'
                "fields" => [], // exemple : ['col1', 'col2', 'col6'] correspond à SELECT col1,col2,col6 FROM ...
                "limit" => null, // exemple : 10 correspond à LIMIT 10
                "offset" => 0, // ne fonctionne que si limit est défini, en donnant une valeur numérique, correspondra à l'offset de départ
                "order" => [] // exemple : array('col5', 'col7 DESC') correspond à ORDER BY col5, col7 DESC
            ],
            $options
        );
        $condition = $this->conditions($options['conditions']);

        // on crée la chaîne des champs à sélectionner
        if(count($options['fields']) > 0){
            $fields = implode(',', $options['fields']);
        } else {
            $fields = "*";
        }

        $req = "SELECT " . $fields . " FROM " . $table;
        if ($condition['condition'] != "") {
            $req .= " WHERE " . $condition['condition'];
        }

        // on crée la chaîne pour le ORDER BY
        if(count($options['order'])> 0){
            $req .= " ORDER BY " . implode(', ', $options['order']);
        }

        // on ajoute la limite de la requête
        if ($options['limit']) {
            $req .= " LIMIT " . $options['offset'] . ", " . $options['limit'];
        }
        // on retourne les résultats
        $stmt = $this->query($req, $condition['values']);
        $result = $one ? $stmt->fetch() : $stmt->fetchAll();
        // Si password est dans les conditions, on vérifie la correspondance
        if ($one && isset($options['conditions']['password']) && !password_verify($options['conditions']['password'], $result->password)) {
            return (object) [];
        }

        return $result;
    }

    /**
     * getOne method pour récupérer le premier résultat de la requête
     *
     * @param string $table Le nom de la table
     * @param array $options Un tableau d'options pour construire la requête
     * @return object
     * @throws Exception
     */
    public function getOne(string $table, array $options = [])
    {
        return $this->read($table, $options, true);
    }


    /**
     * Ajoute des données dans la table (si l'id est défini dans $datas alors la requête fera un UPDATE
     * @param string $table le nom de la table
     * @param array $datas un tableau des valeurs à ajouter ex: array('col1' => 'val1', 'col2' => 'val2', 'col3' => 'val3', ...)
     * @param string $name une chaîne de caractères pour donner le nom de la colonne id
     * @return bool
     * @throws Exception
     */
    public function save(string $table, array $datas , string $idName): bool
    {
        $id = null;
        if (isset($datas[$idName]) && is_numeric($datas[$idName])) {
            $id = $datas[$idName];
            unset($datas[$idName]);
        }
        if (!$datas) {
            return false;
        }
        if (isset($datas['password'])) { // on hache le mot de passe s'il fait partie des données
            $datas['password'] = $this->hash($datas['password']);
        }
        $keys = array_keys($datas);
        $values = substr(str_repeat('?,', count($keys)), 0, -1);
        if ($id) { // si l'id existe on va faire une mise à jour
            $fields = implode('=?, ', $keys);
            $req = "UPDATE " . $table . " SET $fields=? WHERE ".$idName."=" . $id;
        } else { // sinon on fait une insertion
            $fields = implode(', ', $keys);
            $req = "INSERT INTO $table ($fields) VALUES ($values)";
        }
       return !($this->query($req, array_values($datas)) == false);
    }

    /**
     * Supprime un élément de la table dont l'id est $id
     * @param string $table Le nom de la table
     * @param int $id L'id de l'élément à supprimer
     * @return bool
     * @throws Exception
     */
    public function delete(string $table , string $idName , int $id): bool
    {
        $req = "DELETE FROM " . $table . " WHERE ".$idName."=" . $id;
        return $this->getPdo()->exec($req) == 1;
    }

    /**
     * Méthode pour faire un UPDATE sur une table
     * @todo cette méthode n'est pas optimale, il faudra revoir sa conception pour éviter de réaliser une boucle
     * @param string $table
     * @param array $datas
     * @param array $conditions
     * @param string $name une chaîne de caractères pour donner le nom de la colonne id
     * @return bool|int Le nombre de champs concernés
     * @throws Exception
     */
    public function update(string $table, array $datas, array $conditions , string $idName)
    {
        $search = $this->read($table, $conditions); // on vérifie s'il y a des correspondances dans la table selon les conditions demandées
        if (!$search) {
            return false; // retourne false si aucun résultat
        }
        $cpt = 0;
        foreach ($search as $value) {
            $cpt++;
            $datas[$idName] = $value->id;
            $this->save($table, $datas , $idName); // met à jour chaque élément trouvé dans le $search
        }
        return $cpt;
    }
}
