<?php

require_once(dirname(__DIR__) . '/src/mykisscool/Blackjack/Card.php');

use mykisscool\Blackjack\Card;

class DeckTest extends PHPUnit\Framework\TestCase {

   private $deck;

   public function setUp()
   {
      $this->deck = Card::shuffleDeck();
   }

   public function testSizeOfDeck()
   {
      $this->assertEquals(count($this->deck), 52);
   }

   public function testDeckContainsOnlyCards()
   {
      $this->assertContainsOnlyInstancesOf(Card::class, $this->deck);
   }

   public function testFiftyTwoCardPickup()
   {
      // Build an an associate array of cards
      $cardArray = [];
      foreach($this->deck as $card) {
         $cardArray[] = (array) $card;
      }

      // Cycle through class constants and assert we have each type of card (no jokers!)
      foreach (Card::CARDTYPES as $type) {
         foreach (Card::CARDVALUES as $value) {
            $this->assertContains((array) new Card($type, $value), $cardArray);
         }
      }
   }
}