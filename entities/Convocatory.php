<?php

class Convocatory implements JsonSerializable {
    // Properties
    private $id;
    private $type;
    private $date_start_requests;
    private $date_end_requests;
    private $date_baremation;
    private $date_definitive_lists;
    private $country;
    private $proyect_id;

    // Constructor
    public function __construct($id=null, $type, $date_start_requests, $date_end_requests, $date_baremation, $date_definitive_lists, $country, $proyect_id) {
        $this->setId($id);
        $this->setType($type);
        $this->setDateStartRequests($date_start_requests);
        $this->setDateEndRequests($date_end_requests);
        $this->setDateBaremation($date_baremation);
        $this->setDateDefinitiveLists($date_definitive_lists);
        $this->setCountry($country);
        $this->setProyectId($proyect_id);
    }

    // Getters public
    public function getId() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
    }

    public function getDateStartRequests() {
        return $this->date_start_requests;
    }

    public function getDateEndRequests() {
        return $this->date_end_requests;
    }

    public function getDateBaremation() {
        return $this->date_baremation;
    }

    public function getDateDefinitiveLists() {
        return $this->date_definitive_lists;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getProyectId() {
        return $this->proyect_id;
    }

    // Setters private
    private function setId($id) {
        $this->id = $id;
    }

    private function setType($type) {
        $this->type = $type;
    }

    private function setDateStartRequests($date_start_requests) {
        $this->date_start_requests = $date_start_requests;
    }

    private function setDateEndRequests($date_end_requests) {
        $this->date_end_requests = $date_end_requests;
    }

    private function setDateBaremation($date_baremation) {
        $this->date_baremation = $date_baremation;
    }

    private function setDateDefinitiveLists($date_definitive_lists) {
        $this->date_definitive_lists = $date_definitive_lists;
    }

    private function setCountry($country) {
        $this->country = $country;
    }

    private function setProyectId($proyect_id) {
        $this->proyect_id = $proyect_id;
    }

    // Methods
    public function __toString() {
        return sprintf(
            "Convocatory ID: %d, Type: %s, Start Requests: %s, End Requests: %s, Baremation Date: %s, Definitive Lists Date: %s, Country: %s, Project ID: %d",
            $this->getId(),
            $this->getType(),
            $this->getDateStartRequests(),
            $this->getDateEndRequests(),
            $this->getDateBaremation(),
            $this->getDateDefinitiveLists(),
            $this->getCountry(),
            $this->getProyectId()
        );
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}