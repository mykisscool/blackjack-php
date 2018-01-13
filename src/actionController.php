<?php

require_once('vendor/autoload.php');

use mykisscool\Blackjack\Game;
use mykisscool\Blackjack\Player;

if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

if (isset($_GET['action'])) {

   switch($_GET['action']) {

      case 'new';
         new Game;
         break;

      case 'end';
         Game::end();
         break;

      case 'hit';
         Player::getPlayer()->hit();
         break;

      case 'stand';
         Player::getPlayer()->stand();
         break;

      case 'doubleDown';
      case 'split';
         // @TODO Implement these methods
         break;

      default;
   }
}

// Pass values back to "view"
if (isset($_SESSION['player']) && isset($_SESSION['dealer'])) {

   $activeHand = ($_SESSION['handOver'] ?? true === true) ? false : true;

   $playerScore = $_SESSION['player']->getCurrentScore();
   $playerHand = $_SESSION['player']->getCurrentHand();
   $playerWins = $_SESSION['player']->getTotalWins();

   $dealerScore = $_SESSION['dealer']->getCurrentScore($activeHand);
   $dealerHand = $_SESSION['dealer']->getCurrentHand($activeHand);
   $dealerWins = $_SESSION['dealer']->getTotalWins();
}
else {
   $playerScore = 0;
   $playerHand = '';
   $playerWins = 0;

   $dealerScore = 0;
   $dealerHand = '';
   $dealerWins = 0;
}