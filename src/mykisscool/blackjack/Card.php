<?php 
namespace mykisscool\Blackjack;

/**
* Class Card
* @package mykisscool\Blackjack
* @author Mike Petruniak <mike.petruniak@gmail.com>
*/
class Card {

   const
   /**
    * @var array The four different card suits
    */
   CARDTYPES = ['heart', 'spade', 'diamond', 'club'],
   
   /**
    * @var array The thirteen different card ranks
    */
   CARDVALUES = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King', 'Ace'];

   /**
    * @var string Card suit
    */
   protected $type;

   /**
    * @var string Card rank
    */
   protected $value;

   /**
    * @var string Unicode card symbol
    */
   protected $symbol;
   
   public function __construct(string $type, string $value)
   {
      if (! in_array($type, self::CARDTYPES)) {
         throw new \Exception('An invalid card type was specified: "' . $type . '".');
      }

      if (! in_array($value, self::CARDVALUES)) {
         throw new \Exception('An invalid card value was specified: "' . $value . '".');
      }

      $this->type = $type;
      $this->value = $value;
      $this->symbol = $this->pairTypeWithUnicode($type);
   }

   public function __toString()
   {
      return $this->value . ' ' . $this->symbol;
   }

   /**
    * Returns the numeric value of the Card object
    * @access public
    * @return int
    */
   public function getValueOfCard(): int
   {
      if (strtolower($this->value) === 'ace') {
         $value = 11; // @TODO An Ace can be either 1 or 11; player choice
      }
      else {
         $value = is_numeric($this->value) ? $this->value : 10;
      }

      return $value;
   }

   /**
    * Returns the rank value of the Card object
    * @access public
    * @return string
    */
   public function getTypeOfCard(): string
   {
      return $this->value;
   }

   /**
    * Returns the unicode equivalent of the card suit
    * @param string $type Card object
    * @access protected
    * @return string
    */
   protected function pairTypeWithUnicode(string $type): string
   {
      switch($type) {
         case 'heart';
            $unicode = '&#9829;';
            break;

         case 'spade';
            $unicode = '&#9824;';
            break;

         case 'diamond';
            $unicode = '&#9830;';
            break;

         case 'club';
            $unicode = '&#9827;';
      }

      return $unicode;
   }

   /**
    * Shuffles and returns a fresh deck of cards
    * @static
    * @access public
    * @return array
    */
   public static function shuffleDeck(): array
   {
      foreach (self::CARDTYPES as $type) {
         foreach (self::CARDVALUES as $value) {
            $deck[] = new static($type, $value);
         }
      }
      shuffle($deck);

      return $deck;
   }

   /**
    * Returns the first Card object on top of the deck (and removes that card from the deck)
    * @static
    * @throws Exception If there is no deck
    * @access public
    * @return Card
    */
   public static function getTopCardFromDeck(): self
   {
      if (! isset($_SESSION['deck'])) {
         throw new \Exception('There is no active deck.');
      }

      if (! count($_SESSION['deck'])) {
         $_SESSION['deck'] = self::shuffleDeck();
         Game::flash('warning', 'Ran out cards. Hand cancelled. Reshuffling.');
      }

      return array_shift($_SESSION['deck']);
   }
}