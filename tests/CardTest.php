<?php

use mykisscool\Blackjack\Card;

class CardTest extends PHPUnit\Framework\TestCase {

   public function testClassPropertiesWithConstructor()
   {
      $card = new Card('heart', 'Queen');

      $this->assertAttributeEquals('heart', 'type', $card);
      $this->assertAttributeEquals('Queen', 'value', $card);
      $this->assertAttributeEquals('&#9829;', 'symbol', $card);
   }

   public function testRetunsStringWithToString()
   {
      $card = new Card('spade', '10');

      $this->assertEquals('10 &#9824;', $card);
   }

   /**
    * @expectedException Exception
    */
   public function testForJoker()
   {
      $card = new Card('', 'Joker');
   }
}