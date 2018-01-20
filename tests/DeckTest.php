<?php

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
      $cardArray = array_map(function ($card) {
         return (array) $card;
      }, $this->deck);

      // Assert we have 52 unique cards (no jokers!)
      $this->assertContains((array) new Card('heart', '2'), $cardArray);
      $this->assertContains((array) new Card('heart', '3'), $cardArray);
      $this->assertContains((array) new Card('heart', '4'), $cardArray);
      $this->assertContains((array) new Card('heart', '5'), $cardArray);
      $this->assertContains((array) new Card('heart', '6'), $cardArray);
      $this->assertContains((array) new Card('heart', '7'), $cardArray);
      $this->assertContains((array) new Card('heart', '8'), $cardArray);
      $this->assertContains((array) new Card('heart', '9'), $cardArray);
      $this->assertContains((array) new Card('heart', '10'), $cardArray);
      $this->assertContains((array) new Card('heart', 'Jack'), $cardArray);
      $this->assertContains((array) new Card('heart', 'Queen'), $cardArray);
      $this->assertContains((array) new Card('heart', 'King'), $cardArray);
      $this->assertContains((array) new Card('heart', 'Ace'), $cardArray);

      $this->assertContains((array) new Card('spade', '2'), $cardArray);
      $this->assertContains((array) new Card('spade', '3'), $cardArray);
      $this->assertContains((array) new Card('spade', '4'), $cardArray);
      $this->assertContains((array) new Card('spade', '5'), $cardArray);
      $this->assertContains((array) new Card('spade', '6'), $cardArray);
      $this->assertContains((array) new Card('spade', '7'), $cardArray);
      $this->assertContains((array) new Card('spade', '8'), $cardArray);
      $this->assertContains((array) new Card('spade', '9'), $cardArray);
      $this->assertContains((array) new Card('spade', '10'), $cardArray);
      $this->assertContains((array) new Card('spade', 'Jack'), $cardArray);
      $this->assertContains((array) new Card('spade', 'Queen'), $cardArray);
      $this->assertContains((array) new Card('spade', 'King'), $cardArray);
      $this->assertContains((array) new Card('spade', 'Ace'), $cardArray);

      $this->assertContains((array) new Card('diamond', '2'), $cardArray);
      $this->assertContains((array) new Card('diamond', '3'), $cardArray);
      $this->assertContains((array) new Card('diamond', '4'), $cardArray);
      $this->assertContains((array) new Card('diamond', '5'), $cardArray);
      $this->assertContains((array) new Card('diamond', '6'), $cardArray);
      $this->assertContains((array) new Card('diamond', '7'), $cardArray);
      $this->assertContains((array) new Card('diamond', '8'), $cardArray);
      $this->assertContains((array) new Card('diamond', '9'), $cardArray);
      $this->assertContains((array) new Card('diamond', '10'), $cardArray);
      $this->assertContains((array) new Card('diamond', 'Jack'), $cardArray);
      $this->assertContains((array) new Card('diamond', 'Queen'), $cardArray);
      $this->assertContains((array) new Card('diamond', 'King'), $cardArray);
      $this->assertContains((array) new Card('diamond', 'Ace'), $cardArray);

      $this->assertContains((array) new Card('club', '2'), $cardArray);
      $this->assertContains((array) new Card('club', '3'), $cardArray);
      $this->assertContains((array) new Card('club', '4'), $cardArray);
      $this->assertContains((array) new Card('club', '5'), $cardArray);
      $this->assertContains((array) new Card('club', '6'), $cardArray);
      $this->assertContains((array) new Card('club', '7'), $cardArray);
      $this->assertContains((array) new Card('club', '8'), $cardArray);
      $this->assertContains((array) new Card('club', '9'), $cardArray);
      $this->assertContains((array) new Card('club', '10'), $cardArray);
      $this->assertContains((array) new Card('club', 'Jack'), $cardArray);
      $this->assertContains((array) new Card('club', 'Queen'), $cardArray);
      $this->assertContains((array) new Card('club', 'King'), $cardArray);
      $this->assertContains((array) new Card('club', 'Ace'), $cardArray);
   }
}