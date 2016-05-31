<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Characters_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getCharacters() {
        return $this->db->select('guid,name,race,class,gender,level')
            ->from('characters')
            ->where('level >', 9)
            ->order_by('level DESC')
            ->get()->result();
    }

    public function getGlyphs($characterGuid) {
        return $this->db->select('*')
            ->from('character_glyphs')
            ->where('guid', $characterGuid)
            ->get()->result(); //could be 2 rows here for 2 specs keep in mind
    }

    public function getGear($characterGuid) {
        return $this->db->select('ci.*, ii.enchantments, ii.durability, ii.itemEntry')
            ->from('character_inventory ci')
            ->where('ci.guid', $characterGuid)
            ->where('ci.bag', 0)
            ->where('ci.slot >=', 0)
            ->where('ci.slot <=', 18)
            ->join('item_instance ii', 'ii.guid = ci.item')
            ->get()->result(); //ii.enchantments is a space-separated field, containing numbers like "927" (Gloves - Greater Strength) for example.
            //The armory.sql dump from https://raw.githubusercontent.com/Seejayz/WorldofwarcraftArmory/master/sql/armory.sql has all of these ID's in the armory_enchantments table, we can use that data.
    }

    public function getReputations($characterGuid) {
        return $this->db->select('*')
            ->from('character_reputation')
            ->where('guid', $characterGuid)
            ->where("MOD (flags, 2) = 1")
            ->get()->result(); //sort in PHP because this one is wonky
    }

    public function getCharacterGuidByName($characterName) {
        return $this->db->select('guid')
            ->from('characters')
            ->where('lower(name) = lower("' .  $characterName . '")')
            ->get()->row()
            ->guid;
    }

    public function getCharacterDisplayData($characterGuid) {
        return $this->db->select('race,class,gender,level')
            ->from('characters')
            ->where('guid', $characterGuid)
            ->get()->row();
    }

    public function getCharacterTalents($characterGuid) {
        return $this->db->select('spell, talentGroup')
            ->from('character_talent')
            ->where('guid', $characterGuid)
            ->get()->result();
    }

}