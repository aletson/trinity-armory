<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class World_model extends CI_Model
{

    protected $world;

    public function __construct()
    {
        parent::__construct();
        $this->world = $this->load->database('world', TRUE);
    }

    public function getAdditionalItemInfoByID($itemID) {
        return $this->world->select('name, ItemLevel, Quality, displayid')
            ->from('item_template')
            ->where('entry', $itemID)
            ->get()->row();
    }

}