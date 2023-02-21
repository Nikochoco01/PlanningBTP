<?php

/**
 * Class Database
 * pour une abstraction totale de la base de données, le but étant de simplifier le code
 */
class Database
{
    public const FORMAT_NUMBER = 'number';
    public const FORMAT_STRING = 'string';

    /**
     * @var null|PDO stocke l'instance de PDO
     */
    private $pdo = null;

    /**
     * @const Le DSN pilote de la base de données
     */
    private const DSN = "mysql:host=iutbg-lamp.univ-lyon1.fr:3306;dbname=p2103916";

    /**
     * @const Le nom d'utilisateur de l'accès à la base de données
     */
    private const USER = "p2103916";

    /**
     * @const Le mot de passe d'accès à la base de données
     */
    private const PASSWORD = "12103916";

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
        if(count($data) > 0){
            foreach ($data as $key => $value){
                $condition .= ($condition != "")?" AND ":"";
                $operator = explode(" ", $key); // gestion des opérateurs dans les conditions : <= >= != <> LIKE
                if(isset($operator[1])){
                    $condition .= $operator[0] . " " . $operator[1] . " ? ";
                }else{
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
    private function getPdo():PDO
    {
        if(!$this->pdo){
            if (
                preg_match("/^sqlite:(.*)$/", self::DSN, $match) &&
                !file_exists($match[1])
            ){
                throw new Exception('Fichier de base de données Sqlite introuvable');
            }
            try{
                $param = [];
                if (!self::PRODUCTION){
                    $param[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; // on affiche les erreurs en mode dev uniquement
                }
                $param[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_OBJ;
                $this->pdo = new PDO(self::DSN, self::USER, self::PASSWORD, $param);
            }catch (PDOException $e){
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
        if ($statement === false){
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

        // on crée la chaine des champs à sélectionner
        if(count($options['fields']) > 0){
            $fields = implode(',', $options['fields']);
        }else{
            $fields = "*";
        }

        $req = "SELECT " . $fields . " FROM " . $table;
        if($condition['condition'] != ""){
            $req .= " WHERE " . $condition['condition'];
        }

        // on crée la chaine pour le ORDER BY
        if(count($options['order'])> 0){
            $req .= " ORDER BY " . implode(', ', $options['order']);
        }

        // on ajoute la limite de la requête
        if($options['limit']){
            $req .= " LIMIT " . $options['offset'] . ", " . $options['limit'];
        }


        // on retourne les résultats
        $stmt = $this->query($req, $condition['values']);
        $result = $one?$stmt->fetch():$stmt->fetchAll();
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
     * @return bool
     * @throws Exception
     */
    public function save(string $table, array $datas): bool
    {
        $id = null;
        if(isset($datas['id']) && is_numeric($datas['id'])){
            $id = $datas['id'];
            unset($datas['id']);
        }
        if(!$datas){
            return false;
        }
        if(isset($datas['password'])){ // on hache le mot de passe s'il fait partie des données
            $datas['password'] = $this->hash($datas['password']);
        }
        $keys = array_keys($datas);
        $values = substr(str_repeat('?,',count($keys)),0,-1);
        if($id){ // si l'id existe on va faire une mise à jour
            $fields = implode('=?, ',$keys);
            $req = "UPDATE " . $table . " SET $fields=? WHERE id=" . $id;
        }else{ // sinon on fait une insertion
            $fields = implode(', ',$keys);
            $req = "INSERT INTO $table ($fields) VALUES ($values)";
        }
        return !($this->query($req, array_values($datas)) == false);
    }

    /**
     * Ajout des données dans une table avec 1 ou plusieur champ de clé primaire (si l'element existe déja dans la table alors la raquête fera un UPDATE)
     * @param string $table Le nom de la table
     * @param array $datas un tableau des valeurs à ajouter, champs de la clé primaire exclus (sauf si vous ne voulez pas vérifier ) ex: array('col1' => 'val1', 'col2' => 'val2', 'col3' => 'val3', ...)
     * @param array $conditions un tableau vers les chaps de la clé primaire
     * @return bool
     * @throws Exception
     */
    public function add(string $table, array $datas, array $conditions = []): bool
    {
        if($conditions){
            $one = $this->getOne($table, ['conditions' => $conditions]);
            var_dump($one);
            if($one){
                return $this->update($table, $datas, $conditions);
            }
            else{
                $array = array_merge($conditions, $datas);
                array_walk($array, function(string &$value){ $value = "\"$value\""; });
                $fields = implode(', ' ,array_keys($array));
                $values = implode(', ',array_values($array));
                $req = "INSERT INTO $table($fields) VALUES($values)";
                return $this->getPdo()->exec($req);
            }
        }
        else{
            $array = $datas;
            array_walk($array, function(string &$value){ $value = "\"$value\""; });
            $fields = implode(', ' ,array_keys($array));
            $values = implode(', ',array_values($array));
            $req = "INSERT INTO $table($fields) VALUES($values)";
            return $this->getPdo()->exec($req);
        }
    }

    /**
     * Supprime un élément de la table dont l'id est $id
     * @param string $table Le nom de la table
     * @param int $id L'id de l'élément à supprimer
     * @return bool
     * @throws Exception
     */
    public function delete(string $table, int $id): bool
    {
        $req = "DELETE FROM " . $table . " WHERE id=" . $id;
        return $this->getPdo()->exec($req) == 1;
    }

    /**
     * Supprime un élément d'une table dont la clé primaire possède 1 ou plusieur champ
     * @param string $table Le nom de la table
     * @param array $condition Un tableaux vers les champ de la clé primaire ex: array('col1' => 'val1', 'col2' => 'val2')
     * @return bool
     * @throws Exception
     */
    public function deleteBtp(string $table, array $conditions): bool
    {
        $cond = $conditions;
        array_walk($cond, function(string &$value, string $keys){ $value = "$keys = \"$value\""; });
        $fields = implode(" AND ", $cond);
        $req = "DELETE FROM " . $table . " WHERE $fields";
        return $this->getPdo()->exec($req) == 1;
    }

    /**
     * Méthode pour faire un UPDATE sur une table
     * @todo cette méthode n'est pas optimale, il faudra revoir sa conception pour éviter de réaliser une boucle
     * @param string $table
     * @param array $datas
     * @param array $conditions
     * @return bool|int Le nombre de champs concernés
     * @throws Exception
     */
    public function update(string $table, array $datas, array $conditions){
        $search = $this->read($table, $conditions); // on vérifie s'il y a des correspondances dans la table selon les conditions demandées
        if(!$search){
            return false; // retourne false si aucun résultat
        }
        $cpt = 0;
        foreach ($search as $value){
            $cpt++;
            $datas["id"] = $value->id;
            $this->save($table, $datas); // met à jour chaque élément trouvé dans le $search
        }
        return $cpt;
    }

    /**
     * Méthode pour faire un UPDATE sur une table dont la clé primaire possède 1 ou plusieur champ
     * @param string $table Le nom de la table
     * @param array $datas Un tableaux vers un tableaux contenant les valeurs à modifier et leur type ex: array('col1' => 'val1', 'col2' => array('val' => 'val2', 'type' => 'int'), 'col3' => 'val3', ...)
     * @param array $conditions Un tableaux vers les condition de la requête
     * @return bool
     * @throws Exception
     */
    public function updateBtp(string $table, array $datas, array $conditions){
        $search = $this->read($table, $conditions);
        if(!$search){
            return false;
        }
        $fields = $datas;
        $id = $conditions;
        array_walk($fields, function( &$value, string $keys){ is_array($value) ? $value = "$keys = {$this->formatForSql($value['val'], $value['type'])}" : $value = "$keys = $value"; });
        array_walk($id, function( &$value, string $keys){ is_array($value) ? $value = "$keys = {$this->formatForSql($value['val'], $value['type'])}" : $value = "$keys = $value"; });
        $fieldsStr = implode(', ', $fields);
        $idStr = implode(' AND ', $id);
        $req = "UPDATE $table SET $fieldsStr WHERE $idStr";
        return $this->getPdo()->exec($req) == 1;
    }

    private function formatForSql(string $value, string $format){
        switch($format){
            case self::FORMAT_NUMBER:
                return str_replace('"', "", $value);
            case self::FORMAT_STRING:
                return '"' . str_replace('"', "", $value) . '"';
            default:
                return '"' . str_replace('"', "", $value) . '"';
        }
    }
}

