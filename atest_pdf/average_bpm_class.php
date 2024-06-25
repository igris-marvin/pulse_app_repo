<?php
class Average {
    private $number;
    private $bpm;
    private $mood;
    private $date;
    private $time;

    public function __construct($number, $bpm, $mood, $date, $time) {
        $this->number = $number;
        $this->bpm = $bpm;
        $this->mood = $mood;
        $this->date = $date;
        $this->time = $time;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getBpm() {
        return $this->bpm;
    }

    public function getMood() {
        return $this->mood;
    }

    public function getDate() {
        return $this->date;
    }

    public function getTime() {
        return $this->time;
    }
}
?>
