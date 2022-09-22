<?php
class MySQLConnection {

	private $sqlHost;
	private $sqlUser;
	private $sqlPassword;
	private $sqlDatabase;
	private $MySQLi = FALSE;
	private $numQueries = 0;
	public $UsedTime = 0;

	public function __construct($sqlHost, $sqlUser, $sqlPassword, $sqlDatabase = FALSE) {
		$this->sqlHost = $sqlHost;
		$this->sqlUser = $sqlUser;
		$this->sqlPassword = $sqlPassword;
		$this->sqlDatabase = $sqlDatabase;
	}

	public function __destruct() {
		$this->Close();
	}

	public function Connect() {
		if ($this->MySQLi !== FALSE) {
			return $this->MySQLi;
		}
		$this->MySQLi = new mysqli($this->sqlHost, $this->sqlUser, $this->sqlPassword, $this->sqlDatabase);
		if ($this->MySQLi === FALSE) {
			return FALSE;
		}
		return $this->MySQLi;
	}

	public function Close() {
		if ($this->MySQLi !== FALSE) {
			$this->MySQLi->close();
			$this->MySQLi = FALSE;
		}
	}

	public function Query($query, $unbuffered = false, $show_error = false) {
		$start = microtime(true);
		$query = $this->MySQLi->query($query, ($unbuffered ? MYSQLI_USE_RESULT : MYSQLI_STORE_RESULT));
		$this->UsedTime += microtime(true) - $start;
		$this->numQueries++;
		if ($show_error && $query === false){
			die($this->GetErrorMessage());
		}
		return $query;
	}

	public function FetchArray($result) {
		$result = $result->fetch_array();
		return $result;
	}

	public function FetchArrayAll($result){
		$retval = array();
		if ($this->GetNumRows($result)) {
			while ($row = $this->FetchArray($result)) {
				$retval[] = $row;
			}
		}
		return $retval;
	}

	public function GetNumRows($result) {
		return $result->num_rows;
	}

	public function QueryGetNumRows($result) {
		$result = $this->Query($result);
		$result = $this->GetNumRows($result);
		return $result;
	}

	public function GetNumAffectedRows() {
		return $this->MySQLi->affected_rows();
	}

	public function QueryFetchArray($result) {
		$result = $this->Query($result, true);
		$result = $this->FetchArray($result);
		return $result;
	}

	public function QueryFetchArrayAll($result) {
		$result = $this->Query($result, true);
		if ($result === FALSE) {
			return FALSE;
		}
		$retval = array();
		while ($row = $this->FetchArray($result)) {
			$retval[] = $row;
		}
		return $retval;
	}

	public function EscapeString($string, $no_html = 1) {
		if (is_array($string)) {
			$str = array();
			foreach ($string as $key => $value) {
				$str[$key] = $this->EscapeString($value);
			}
			return $str;
		} elseif($no_html == 1) {
			$string = htmlspecialchars($string);
		}
		return $this->MySQLi->escape_string(stripslashes($string));
	}

	public function GetErrorMessage() {
		return "SQL Error: ".$this->MySQLi->error.": ";
	}

}
