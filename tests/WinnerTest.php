<?php

use mykisscool\Blackjack\Card;
use mykisscool\Blackjack\Player;
use mykisscool\Blackjack\Game;

class WinnerTest extends PHPUnit\Framework\TestCase {

   private $player;
   private $dealer;

   public function setUp()
   {
      $this->player = new Player;
      $this->dealer = new Player('dealer');
   }

   public function testPlayerBlackjack1()
   {
      $this->player->hit(new Card('heart', 'Ace'));
      $this->player->hit(new Card('club', '10'));

      $this->assertEquals(Game::BLACKJACK, $this->player->getCurrentScore());
   }

   // @TODO
}