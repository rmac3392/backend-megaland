<?php

class ModelAgentWishlist extends Model {

	public function addWishlist($property_id) {

		$this->event->trigger('pre.wishlist.add');



		$this->db->query("DELETE FROM " . DB_PREFIX . "property_wishlist WHERE property_agent_id = '" . (int)$this->agent->getId() . "' AND property_id = '" . (int)$property_id . "'");



		$this->db->query("INSERT INTO " . DB_PREFIX . "property_wishlist SET property_agent_id = '" . (int)$this->agent->getId() . "', property_id = '" . (int)$property_id . "', date_added = NOW()");



		$this->event->trigger('post.wishlist.add');

	}



	public function deleteWishlist($property_id) {

		$this->event->trigger('pre.wishlist.delete');



		$this->db->query("DELETE FROM " . DB_PREFIX . "property_wishlist WHERE property_agent_id = '" . (int)$this->agent->getId() . "' AND property_id = '" . (int)$property_id . "'");



		$this->event->trigger('post.wishlist.delete');

	}



	public function getWishlist() {

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_wishlist WHERE property_agent_id = '" . (int)$this->agent->getId() . "'");



		return $query->rows;

	}



	public function getTotalWishlist() {

		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "property_wishlist WHERE property_agent_id = '" . (int)$this->agent->getId() . "'");



		return $query->row['total'];

	}

}

