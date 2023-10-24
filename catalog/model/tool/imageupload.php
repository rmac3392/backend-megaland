<?php

class ModelToolImageUpload extends Model {

	public function addUpload($name, $filename) {



		$this->db->query("INSERT INTO `" . DB_PREFIX . "upload` SET `name` = '" . $this->db->escape($name) . "', `filename` = '" . $this->db->escape($filename) . "', `code` = '" . $this->db->escape($filename) . "', `date_added` = NOW()");



		return $filename;

	}



	public function getUploadByCode($code) {

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "upload` WHERE code = '" . $this->db->escape($code) . "'");



		return $query->row;

	}

}