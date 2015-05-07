<?php

class TextSentimentGenerator {

  public $happyWords = ['delight', 'delighted', 'delightful', 'happy', 'glad', 'joy', 'joyful', 'merry', 'pleasant'];

  public $sadWords = ['disappointed', 'miserable', 'sad', 'sorrow', 'unhappy'];

  public function splitString($string){
    return preg_split("/[\s,.!?]+/", strtolower($string));
  }

  public function checkIfWordIsHappy($word){
    foreach ($this->happyWords as $happyWord) {
      if($happyWord == $word)
        $this->happyCount += 1;
    }
  }

  public function checkIfWordIsSad($word){
    foreach ($this->sadWords as $sadWord) {
      if($sadWord == $word)
        $this->sadCount += 1;
    }    
  }

  public function returnSentiment(){
    if($this->sadCount * 2 <= $this->happyCount)
        return 'Happy :)';
    if($this->happyCount * 2 <= $this->sadCount)
        return 'Sad :(';
    return 'Unknown :S';
  }

  public function checkSentiment($text){
    $splitTextArray = $this->splitString($text);
    $this->setCountTo0();
    foreach ($splitTextArray as $word)
      $this->checkWordSentiment($word);
    return $this->returnSentiment();
  }

  public function setCountTo0(){
    $this->happyCount = 0;
    $this->sadCount = 0;
  }

  public function checkWordSentiment($word){
    $this->checkIfWordIsHappy($word);
    $this->checkIfWordIsSad($word);
  }

}