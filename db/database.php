<?php

class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getCondomini()
    {
        $query = "SELECT * FROM CONDOMINI";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function getAppartamentiByCondominio($id_Condominio)
    {
        $id = intval($id_Condominio);
        $query = "SELECT * FROM APPARTAMENTI WHERE id_condominio=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function checkDate($inizio, $fine, $id_app)
    {
        $query = "SELECT * FROM PRENOTAZIONI WHERE id_appartamento=? AND ((dataInizio>=? AND dataFine<=?) OR (dataInizio<=? AND dataFine>=?) OR (dataInizio<=? AND dataFine>=?))";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssss', $id_app, $inizio, $fine, $inizio, $inizio, $fine, $fine);
        $stmt->execute();
        return count($stmt->get_result()->fetch_all(MYSQLI_ASSOC)) == 0;
    }

    public function getAllCLienti()
    {
        $query = "SELECT Nome, Cognome, Codice_Documento FROM CLIENTI";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function addCliente($nome, $cognome, $codice_documento, $data_rilascio, $da_chi, $luogo_nascita, $provincia, $data_nascita, $comune_residenza, $cap, $via, $numero_civico, $mail, $telefono)
    {
        $query = "INSERT INTO CLIENTI(Nome, Cognome, Codice_Documento, Data_rilascio, Da_chi, LuogoNascita, Provincia, DataNascita, Comune_residenza, CAP, Via, Numero_civico, Mail, Numero) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssssssssssss', $nome, $cognome, $codice_documento, $data_rilascio, $da_chi, $luogo_nascita, $provincia, $data_nascita, $comune_residenza, $cap, $via, $numero_civico, $mail, $telefono);
        $stmt->execute();
    }
    private function getLasGruppoId()
    {
        $query = "SELECT MAX(id_gruppo) as id FROM GRUPPI";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $res[0]['id'] + 1;
    }
    public function createGruppo($cognome)
    {
        $id = $this->getLasGruppoId();
        $query = "INSERT INTO GRUPPI(Cognome, id_gruppo) VALUES (?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $cognome, $id);
        $stmt->execute();
        return $id;
    }

    public function getAllGruppi()
    {
        $query = "SELECT * FROM GRUPPI";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function addPerson($cod, $idGruppo, $ruolo)
    {
        $query = "INSERT INTO formato(Codice_Documento, id_gruppo, ruolo) VALUES (?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sis', $cod, $idGruppo, $ruolo);
        $stmt->execute();
    }

    public function checkListinoYear($anno, $app)
    {
        $query = "SELECT Anno FROM LISTINI WHERE Anno=? AND id_appartamento=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $anno, $app);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return count($res) == 0;
    }

    public function addListino($anno, $app)
    {
        $query = "INSERT INTO LISTINI(id_appartamento, Anno) VALUES (?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $app, $anno);
        $stmt->execute();
    }

    public function getListinoDate($data_inizio, $data_fine, $anno, $app)
    {
        $query = "SELECT Prezzo, Data_fine, Data_Inizio FROM PERIODI WHERE id_appartamento=? AND Anno=? AND ((Data_Inizio<=? AND Data_fine>=?) OR (Data_Inizio<=? AND Data_fine>=?))";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $app, $anno, $data_fine, $data_fine, $data_inizio, $data_inizio);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function insertNewPeriod($data_inizio, $data_fine, $anno, $app, $prezzo)
    {
        $query = "INSERT INTO PERIODI(id_appartamento, Anno, Prezzo, Data_fine, Data_Inizio) VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $app, $anno, $prezzo, $data_fine, $data_inizio);
        $stmt->execute();
    }

    public function getFreeBici($data_inizio, $data_fine)
    {
        $query = "SELECT id_bicicletta FROM BICICLETTE EXCEPT SELECT id_bicicletta FROM Noleggiare WHERE (DataInizio<=? AND DataFine>=?) OR (DataInizio<=? AND DataFine>=?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $data_fine, $data_fine, $data_inizio, $data_inizio);
        $stmt->execute();
        return count($stmt->get_result()->fetch_all(MYSQLI_ASSOC));
    }

    public function getClienteByID($id)
    {
        $query = "SELECT Codice_Documento FROM CLIENTI WHERE Codice_Documento=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function getGruppoByID($id)
    {
        $query = "SELECT id_gruppo FROM GRUPPO WHERE id_gruppo=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    private function getLastPrenotId()
    {
        $query = "SELECT MAX(numero) as id FROM PRENOTAZIONI";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $res[0]['id'] + 1;
    }

    public function prenote($sconto, $from, $to, $importo, $app, $cliente, $gruppo)
    {
        $numero = $this->getLastPrenotId();
        if ($cliente == "") {
            $query = "INSERT INTO PRENOTAZIONI(sconto, dataInizio, dataFine, Importo, numero, id_appartamento, Codice_Documento, id_gruppo) VALUES (?,?,?,?,?,?,NULL,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssssssss', $sconto, $from, $to, $importo, $numero, $app, $gruppo);
            return $stmt->execute();
        } else {
            $query = "INSERT INTO PRENOTAZIONI(sconto, dataInizio, dataFine, Importo, numero, id_appartamento, Codice_Documento, id_gruppo) VALUES (?,?,?,?,?,?,?,NULL)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssssss', $sconto, $from, $to, $importo, $numero, $app, $cliente);
            return $stmt->execute();
        }
    }

    public function checkAvailability($from, $to) {
            $query = "SELECT * FROM APPARTAMENTI EXCEPT SELECT id_appartamento FROM PRENOTAZIONI WHERE (DataInizio<=? AND DataFine>=?) OR (DataInizio<=? AND DataFine>=?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssss', $from, $from, $to, $to);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
} 

?>