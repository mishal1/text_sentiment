<?php

require 'lib/textSentiment.php';

class textSentimentTest extends PHPUnit_Framework_TestCase{

  public function __construct(){
    $this->textSentiment = new TextSentimentGenerator();
  }

  public function testTextSentimentIsAClass(){
    $expected = is_a($this->textSentiment, 'TextSentimentGenerator');
    $this->assertTrue($expected);
  }

  public function testContainsDefaultHappyWords(){
    $expectedHappyWords = ['delight', 'delighted', 'delightful', 'happy', 'glad', 'joy', 'joyful', 'merry', 'pleasant'];
    $actualWords = $this->textSentiment->happyWords;
    $this->assertEquals($actualWords, $expectedHappyWords);
  }

  public function testContainsDefaultSadWords(){
    $expectedSadWords = ['disappointed', 'miserable', 'sad', 'sorrow', 'unhappy'];
    $actualWords = $this->textSentiment->sadWords;
    $this->assertEquals($actualWords, $expectedSadWords);
  }

  public function testSplitsInputStringIntoArray(){
    $expectedSplitString = ['happy', 'sad'];
    $actualStringSplit = $this->textSentiment->splitString('happy sad');
    $this->assertEquals($actualStringSplit, $expectedSplitString);
  }

  public function testMakesSplitStringAllLowercase(){
    $expectedSplitString = ['happy', 'sad'];
    $actualStringSplit = $this->textSentiment->splitString('Happy sad');
    $this->assertEquals($actualStringSplit, $expectedSplitString);
  }

  public function testHappyCountSetTo0(){
    $this->textSentiment->setCountTo0();
    $actualWords = $this->textSentiment->happyCount;
    $this->assertEquals($actualWords, 0);
  }

  public function testSadCountSetTo0(){
    $this->textSentiment->setCountTo0();
    $actualWords = $this->textSentiment->sadCount;
    $this->assertEquals($actualWords, 0);
  }

  public function testchecksIfWordIsHappy(){
    $this->textSentiment->setCountTo0();
    $this->textSentiment->checkIfWordIsHappy('happy');
    $actualWords = $this->textSentiment->happyCount;
    $this->assertEquals($actualWords, 1);
  }

  public function testchecksIfWordIsNotHappy(){
    $this->textSentiment->setCountTo0();
    $this->textSentiment->checkIfWordIsHappy('sad');
    $actualWords = $this->textSentiment->happyCount;
    $this->assertEquals($actualWords, 0);
  }

  public function testCheckIfWordIsSad(){
    $this->textSentiment->setCountTo0();
    $this->textSentiment->checkIfWordIsSad('sad');
    $actualWords = $this->textSentiment->sadCount;
    $this->assertEquals($actualWords, 1);
  }

  public function testchecksIfWordIsNotSad(){
    $this->textSentiment->setCountTo0();
    $this->textSentiment->checkIfWordIsSad('happy');
    $actualWords = $this->textSentiment->sadCount;
    $this->assertEquals($actualWords, 0);
  }

  public function testCheckWordSentiment(){
    $this->textSentiment->setCountTo0();
    $this->textSentiment->checkWordSentiment('happy');
    $actualWords = $this->textSentiment->happyCount;
    $this->assertEquals($actualWords, 1);
    $actualWords = $this->textSentiment->sadCount;
    $this->assertEquals($actualWords, 0);
  }

  public function testChecksIfHappyCount50PercentGreaterThanSadCount(){
    $this->textSentiment->sadCount = 1;
    $this->textSentiment->happyCount = 2;
    $actualSentiment = $this->textSentiment->returnSentiment();
    $this->assertEquals($actualSentiment, 'Happy :)');
  }

  public function testChecksIfSadCount50PercentGreaterThanHappyCount(){
    $this->textSentiment->sadCount = 2;
    $this->textSentiment->happyCount = 1;
    $actualSentiment = $this->textSentiment->returnSentiment();
    $this->assertEquals($actualSentiment, 'Sad :(');
  }

  public function testChecksIfNoClearDifferenceInSentiment(){ 
    $this->textSentiment->sadCount = 2;
    $this->textSentiment->happyCount = 3;
    $actualSentiment = $this->textSentiment->returnSentiment();
    $this->assertEquals($actualSentiment, 'Unknown :S');  
  }

  public function testChecksTextSentiment(){
    $actualTextSentiment = $this->textSentiment->checkSentiment('I was glad to go to the beach. Very glad. Even though it was a miserable day.');
    $this->assertEquals($actualTextSentiment, 'Happy :)');
  }

}