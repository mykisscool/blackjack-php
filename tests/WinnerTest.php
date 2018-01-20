<?php

use mykisscool\Blackjack\Card;
use mykisscool\Blackjack\Player;
use mykisscool\Blackjack\Game;

class WinnerTest extends PHPUnit\Framework\TestCase {

   private $player;

   public function setUp()
   {
      $this->player = new Player;
   }

   public function testPlayerBlackjack1()
   {
      $this->player->hit(new Card('heart', 'Ace'));
      $this->player->hit(new Card('club', '10'));

      $this->assertSame(Game::BLACKJACK, $this->player->getCurrentScore());
   }

   public function testPlayerBlackjack2()
   {
      $this->player->hit(new Card('heart', 'Ace'));
      $this->player->hit(new Card('club', '4'));
      $this->player->hit(new Card('spade', 'Ace'));
      $this->player->hit(new Card('diamond', '2'));
      $this->player->hit(new Card('heart', '2'));
      $this->player->hit(new Card('club', 'Ace'));

      $this->assertSame(Game::BLACKJACK, $this->player->getCurrentScore());
   }

   public function testPlayerBlackjack3()
   {
      $this->player->hit(new Card('heart', '9'));
      $this->player->hit(new Card('club', '4'));
      $this->player->hit(new Card('spade', 'Ace'));
      $this->player->hit(new Card('diamond', '7'));

      $this->assertSame(Game::BLACKJACK, $this->player->getCurrentScore());
   }

   public function testPlayerTotalScore()
   {
      $this->player->win();
      $this->player->win();
      $this->player->win();
      $this->player->win();
      $this->player->win();

      $this->assertSame(5, $this->player->getTotalWins());
   }
}