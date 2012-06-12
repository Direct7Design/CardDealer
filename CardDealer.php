<?php
/**
 * CardDealer sets up a deck and deals out cards randomly. After card is dealt it is
 * removed from deck until deck is reconstructed with resetDeck.
 *
 * CardDealer is in no way a secure way of dealing cards, and is only useful for anaylsis purposes.
 *
 * @author Tom Moitié
 **/
class CardDealer
{
    var $deck;

    /**
     * draws a random card from the deck, remove from deck
     *
     * @return int card ID - -1 if pack is empty
     * @author Tom Moitié
     **/
    public function drawCard()
    {
        if(count($this->deck) == 0){
            return -1;
        }

        $card = array_rand($this->deck);
        $card_out = $this->deck[$card];

        unset($this->deck[$card]);

        return $card_out;
    }

    /**
     * translates a card ID into readable form
     *
     * @return string card description (eg Ah 4c Jd Ks)
     * @author Tom Moitié
     **/
    public function readCardString($card_id)
    {
        $suit = $this->readSuitString($card_id);

        $number = $this->readNumberString($card_id);

        return $number . $suit;
    }

    /**
     * outputs the suit of a card without converting numbers to letter equivalents
     *
     * @return string card suit (eg h c d s)
     * @author Tom Moitié
     **/
    public function readSuit($card_id)
    {
        return ceil($card_id / 13);
    }

    /**
     * outputs the suit of a card and converts numbers to letter equivalents
     *
     * @return string card suit (eg h c d s)
     * @author Tom Moitié
     **/
    public function readSuitString($card_id)
    {
        $suit = $this->readSuit($card_id);
        switch($suit) {
            case 1:
                return 'd';
            case 2:
                return 'c';
            case 3:
                return 'h';
            case 4:
                return 's';
            default:
                throw new Exception('invalid card_id');
        }
    }

    /**
     * outputs the number of a card without converting face cards
     *
     * @return int card number (eg 1 4 7 10 13)
     * @author Tom Moitié
     **/
    public function readNumber($card_id)
    {
        return 13 - ($card_id % 13);
    }

    /**
     * outputs the number of a card and converts face cards
     *
     * @return string card number (eg A 4 7 T K)
     * @author Tom Moitié
     **/
    public function readNumberString($card_id)
    {
        $number = $this->readNumber($card_id);

        switch($number) {
            case 1:
                return 'A';
            case 10:
                return 'T';
            case 11:
                return 'J';
            case 12:
                return 'Q';
            case 13:
                return 'K';
            default:
                return (string) $number;
        }
    }

    /**
     * resetDeck reconstructs the $deck var will full 52 cards
     *
     * @return void
     * @author Tom Moitié
     **/
    public function resetDeck()
    {
        $this->deck = array();
        for($i = 1; $i <= 52; $i++) {
            $this->deck[] = $i;
        }
    }

    /**
     * constructor class calls resetDeck method to set $deck up
     *
     * @return void
     * @author Tom Moitié
     **/
    public function __construct()
    {
        $this->resetDeck();
    }

} // END class
