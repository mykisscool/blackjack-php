<?php
namespace mykisscool\Blackjack;

/**
* Interface PlayerActions
* @package mykisscool\Blackjack
* @author Mike Petruniak <mike.petruniak@gmail.com>
*/
interface PlayerActions {

   /**
    * Player takes a card from the top of the deck
    * @param Card $cardForTesting Allow this method to accept an instance of class Card for testing purposes
    * @access public
    * @return void
    */
   public function hit(Card $cardForTesting);

   /**
    * The player no longer wishes to hit- and is ending his/her hand.  A winner is determined at this
    * point.
    * @access public
    * @return void
    */
   public function stand();

   /**
    * The player can double his/her bet after the first two cards have been dealt
    * @access public
    * @return void
    */
   public function doubleDown();

   /**
    * The player can split his/her current hand into two separate hands
    * @access public
    * @return void
    */
   public function split();
}