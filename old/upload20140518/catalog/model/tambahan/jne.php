<?php
class ModelTambahanJne extends Model {
	function getJne() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "jne order by tanggal desc");
		return $query->rows;
	}
}