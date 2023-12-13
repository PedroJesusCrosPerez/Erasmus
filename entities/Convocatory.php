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
    private $movilities;
    private $project_id;

    // Constructor
    public function __construct($id=null, $type, $date_start_requests, $date_end_requests, $date_baremation, $date_definitive_lists, $country, $movilities, $project_id) {
        $this->setId($id);
        $this->setType($type);
        $this->setDate_start_requests($date_start_requests);
        $this->setDate_end_requests($date_end_requests);
        $this->setDate_baremation($date_baremation);
        $this->setDate_definitive_lists($date_definitive_lists);
        $this->setCountry($country);
        $this->setMovilities($movilities);
        $this->setProject_id($project_id);
    }

    // Getters public
    public function getId() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
    }

    public function getDate_start_requests() {
        return $this->date_start_requests;
    }

    public function getDate_end_requests() {
        return $this->date_end_requests;
    }

    public function getDate_baremation() {
        return $this->date_baremation;
    }

    public function getDate_definitive_lists() {
        return $this->date_definitive_lists;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getMovilities() {
        return $this->movilities;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    // Setters private
    private function setId($id) {
        $this->id = $id;
    }

    private function setType($type) {
        $this->type = $type;
    }

    private function setDate_start_requests($date_start_requests) {
        $this->date_start_requests = $date_start_requests;
    }

    private function setDate_end_requests($date_end_requests) {
        $this->date_end_requests = $date_end_requests;
    }

    private function setDate_baremation($date_baremation) {
        $this->date_baremation = $date_baremation;
    }

    private function setDate_definitive_lists($date_definitive_lists) {
        $this->date_definitive_lists = $date_definitive_lists;
    }

    private function setCountry($country) {
        $this->country = $country;
    }

    private function setMovilities($movilities) {
        $this->movilities = $movilities;
    }

    private function setProject_id($project_id) {
        $this->project_id = $project_id;
    }

    // Methods
    public function __toString() {
        return sprintf(
            "Convocatory ID: %d, Type: %s, Start Requests: %s, End Requests: %s, Baremation Date: %s, Definitive Lists Date: %s, Country: %s, Movilities: %s, Project ID: %d",
            $this->getId(),
            $this->getType(),
            $this->getDate_start_requests(),
            $this->getDate_end_requests(),
            $this->getDate_baremation(),
            $this->getDate_definitive_lists(),
            $this->getCountry(),
            $this->getMovilities(),
            $this->getProject_id()
        );
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}