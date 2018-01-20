<?php

use mykisscool\Blackjack\Player;
use mykisscool\Blackjack\Card;

class PlayerTest extends PHPUnit\Framework\TestCase {

   public function testClassPropertiesWithConstructor1()
   {
      $player = new Player;

      $this->assertAttributeEquals('player', 'type', $player);
      $this->assertAttributeEquals(0, 'currentScore', $player);
      $this->assertAttributeEquals(0, 'totalWins', $player);

      $this->assertSame(0, $player->getCurrentScore());
   }

   public function testClassPropertiesWithConstructor2()
   {
      $dealer = new Player('dealer');

      $this->assertAttributeEquals('dealer', 'type', $dealer);
      $this->assertAttributeEquals(0, 'currentScore', $dealer);
      $this->assertAttributeEquals(0, 'totalWins', $dealer);

      $this->assertSame(0, $dealer->getCurrentScore(false));
   }

   /**
    * @expectedException Exception
    */
   public function testClassPropertiesWithConstructor3()
   {
      $player = new Player('Buffalo Mike');
   }

   public function testPlayerHand1()
   {
      $player = new Player;

      $player->hit(new Card('diamond', '10'));
      $player->hit(new Card('club', '10'));

      $this->assertSame(20, $player->getCurrentScore());
   }

   public function testPlayerHand2()
   {
      $player = new Player;

      $player->hit(new Card('diamond', '6'));
      $player->hit(new Card('club', '6'));
      $player->hit(new Card('spade', 'Ace'));
      $player->hit(new Card('heart', '6'));

      $this->assertSame(19, $player->getCurrentScore());
   }

   public function testDealerHand1()
   {
      $dealer = new Player('dealer');

      $dealer->hit(new Card('diamond', '10')); // hidden
      $dealer->hit(new Card('club', '10'));

      $this->assertSame(10, $dealer->getCurrentScore());
   }

   public function testDealerHand2()
   {
      $dealer = new Player('dealer');

      $dealer->hit(new Card('diamond', '8'));
      $dealer->hit(new Card('club', '8'));
      $dealer->hit(new Card('spade', '8'));

      $this->assertSame(24, $dealer->getCurrentScore(false));
   }

   public function testClearPlayerHand()
   {
      $player = new Player;

      $player->hit(new Card('diamond', '2'));
      $player->hit(new Card('club', '6'));
      $player->hit(new Card('spade', '10'));
      $player->hit(new Card('heart', 'Ace'));

      $this->assertSame(19, $player->getCurrentScore());

      $player->clearCurrentHand();

      $this->assertAttributeEquals(0, 'currentScore', $player);
      $this->assertSame(0, $player->getCurrentScore());
   }

   public function testPlayerHandString()
   {
      $player = new Player;

      $player->hit(new Card('diamond', '2'));
      $player->hit(new Card('club', '6'));
      $player->hit(new Card('spade', '10'));

      $this->assertEquals('2 &#9830;, 6 &#9827;, 10 &#9824;', $player->getCurrentHand());
   }

   public function testDealerHand1String()
   {
      $dealer = new Player('dealer');

      $dealer->hit(new Card('diamond', 'Ace'));
      $dealer->hit(new Card('club', 'King'));

      $this->assertEquals('Ace &#9830;, King &#9827;', $dealer->getCurrentHand(false));
   }

   public function testDealerHand2String()
   {
      $dealer = new Player('dealer');

      $dealer->hit(new Card('diamond', 'Ace')); // hidden
      $dealer->hit(new Card('club', 'King'));

      $this->assertEquals('&#9641;, King &#9827;', $dealer->getCurrentHand());
   }

   public function testGetPlayer()
   {
      $player = new Player;
      $this->assertInstanceOf(Player::class, $player);
   }

   public function testGetDealer()
   {
      $dealer = new Player('dealer');
      $this->assertInstanceOf(Player::class, $dealer);
   }

   /**
    * @expectedException Exception
    */
   public function testGetBuffaloMike()
   {
      $player = new Player('Buffalo Mike');
      $this->assertInstanceOf(Player::class, $player);
   }
}