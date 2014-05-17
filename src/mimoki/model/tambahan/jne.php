<?php
class ModelTambahanJne extends Model {
	public function addJne($data) {
		$baki = false;
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "jne` where noresi ='".$data['noresi']."'");
		if ($query->row['total']==0) {
			$sql = "insert into ".DB_PREFIX."jne  SET noresi ='".$data['noresi']."', tanggal = '".$this->db->escape($data['tanggal']) ."', nama='".$this->db->escape($data['nama'])."', kurir = '".$this->db->escape($data['kurir'])."'";
			$this->db->query($sql);
			$baki = true;
		}
		return $baki;
	}
	
	public function getTotalFilterGroups() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "jne`");
	
		return $query->row['total'];
	}
	
	public function getFilterGroups() {
		$sql = "SELECT noresi,tanggal,nama,kurir FROM `" . DB_PREFIX . "jne` order by tanggal desc";
		$query = $this->db->query($sql);		
		return $query->rows;
	}
	
	public function get1Data($id) {
		$query = $this->db->query("SELECT tanggal,nama,kurir FROM `" . DB_PREFIX . "jne` where noresi ='".$id."'");
		return $query->rows;
	}
	
	public function editJne($id,$data) {
		$sql = "update ".DB_PREFIX."jne set  tanggal = '".$this->db->escape($data['tanggal']) ."', nama='".$this->db->escape($data['nama'])."', kurir = '".$this->db->escape($data['kurir'])."' where noresi ='".$id."'";
		$this->db->query($sql);
	}
	
	public function deleteJne($id) {
		$sql = "delete from ".DB_PREFIX."jne where noresi ='".$id."'";
		$this->db->query($sql);
	}
}
?>