<?php
namespace mykisscool\Blackjack;

/**
* Class Player
* @package mykisscool\Blackjack
* @author Mike Petruniak <mike.petruniak@gmail.com>
*/
class Player implements PlayerActions {

   const
   /**
    * @var int The mininum card value a dealer will stand on
    */
   DEALERSTANDS = 17;

   /**
    * @var string Either player or dealer
    */
   protected $type;

   /**
    * @var array Array of Card objects representing cards in player's hand
    */
   protected $currentHand;

   /**
    * @var int Sum of card values in player's hand
    */
   protected $currentScore;

   /**
    * @var string Sum of wins earned in current session
    */
   protected $totalWins;

   public function __construct(string $type = 'player')
   {
      $this->type = $type;
      $this->currentHand = [];
      $this->currentScore = 0;
      $this->totalWins = 0;
   }

   public function hit()
   {
      $pulledCard = Card::getTopCardFromDeck();

      $this->currentHand[] = $pulledCard;
      $this->currentScore += $pulledCard->getValueOfCard();

      // Prevents busting on opening deal
      if (count($this->currentHand) === 2
         && strtolower($this->currentHand[0]->getTypeOfCard()) === 'ace'
         && strtolower($this->currentHand[1]->getTypeOfCard()) === 'ace') {

            $this->currentScore -= 10;
      }

      // @TODO This is not perfect- see Card::getValueOfCard()
      if (strtolower($pulledCard->getTypeOfCard()) === 'ace'
         && $this->currentScore > Game::BLACKJACK) {

         $this->currentScore -= 10;
      }

      // @TODO Should I just a hand score if a player busts with an Ace in hand valued
      //     at an 11 (change the Ace from an 11 to a 1)?

      $this->checkForPlayerBlackjack();
   }

   public function stand()
   {
      Game::handOver();
      Game::checkForWinner();
   }

   public function doubleDown()
   {
      // @TODO Implement this feature
   }
 
   public function split()
   {
      // @TODO Implement this feature
   }

   /**
    * To avoid tapping "Stand" after a card is dealt- this method will check for a Blackjack or a
    * bust after every hit.
    * @access public
    * @return void
    */
   public function checkForPlayerBlackjack()
   {
      if (strtolower($this->type) === 'player' && $this->currentScore >= Game::BLACKJACK) {
         $this->stand();
      }
      else {
         Game::refresh();
      }
   }

   /**
    * A winner is determined and this method will either increment the player's or the dealer's total
    * score by one.
    * @access public
    * @return void
    */
   public function win()
   {
      $this->totalWins++;
   }

   /**
    * Called whenever a new game has started.  The player and the dealer essentially hand over their
    * previously-played hand and their card score; naturally, is zero.
    * @access public
    * @return void
    */
   public function clearCurrentHand()
   {
      $this->currentHand = [];
      $this->currentScore = 0;
   }

   /**
    * Returns a comma-delimited list of the player's hand
    * @access public
    * @param bool $activeHand If the dealer is calling this method with a value of "true",
    *   then we want to conceal the first card.
    * @return string
    */
   public function getCurrentHand(bool $activeHand = true): string
   {
      $hand = '';
      $i = 0;

      foreach ($this->currentHand as $card) {
         if (strtolower($this->type) === 'dealer' && $activeHand && $i === 0) {
            $hand .= '&#9641;, ';
         }
         else {
            $hand .= $card . ', ';
         }

         $i++;
      }

      return substr($hand, 0, -2);
   }

   /**
    * Returns the score of the player's [visible] hand
    * @access public
    * @param bool $activeHand If the dealer is calling this method with a value of "true",
    *   then we want to conceal the first card.
    * @return int
    */
   public function getCurrentScore(bool $activeHand = true): int
   {
      if (strtolower($this->type) === 'player' || (strtolower($this->type) === 'dealer' && !$activeHand)) {
         $score = $this->currentScore;
      }
      else {
         $score = $this->currentHand[1]->getValueOfCard();
      }

      return $score;
   }

   /**
    * Returns the player's total number of wins
    * @access public
    * @return int
    */
   public function getTotalWins(): int
   {
      return $this->totalWins;
   }

   /**
    * Once the player stands, the dealer will draw cards until a minimum value of 17 is met
    * @throws Exception If a non-dealer (Player) attempts to call this method
    * @access public
    * @return void
    */
   public function dealersTurn()
   {
      if (strtolower($this->type) !== 'dealer') {
         throw new \Exception('This method is intended for the Dealer.');
      }

      while ($this->currentScore <= self::DEALERSTANDS) {
         $this->hit();
      }

      Game::checkForWinner();
   }

   /**
    * Once the player stands, the dealer will draw cards until a minimum value of 17 is met
    * @static
    * @throws Exception If the string parameter is not "player" or "dealer"
    * @access public
    * @param string $type Player or dealer
    * @return Player
    */
   public static function getPlayer(string $type = 'player'): self
   {
      Game::checkForValidSession();

      if (! isset($_SESSION[$type])) {
         throw new \Exception('Player "' . $type . '" not recognized.');
      }
      else {
         return $_SESSION[$type];
      }
   }
}