Finding auction winner and of the winning price of bid
======================================================

1. Create a list of all candidates participating in the auction and their bets. This information can be taken from database records in a real project. In this technical issue, such a list is emulated by an array of objects with the name of the participant and arrays of bids made.

2. We handle the whole list and find the highest bids of each participant. We create a pool of players. Players who haven't made a bid are excluded from the further search for a winner, i.e. from this list of players. If no one has made any bids, the winner is not announced - the list of players will be empty. If the maximum bid was made at least by two participants, then the winner is also not announced (at least nothing is said in the technical assignment so I followed my understanding of the logic of the auction. Perhaps in this case, the winner should appoint the person who made his bid earlier, but there is nothing about the timing in the assignment).

3. If maximum bids of all participants are below the reserve price, the winner is not identified and is not announced. The lot will stay with the owner, since no one has offered a bigger bid.

4. If a single player has a maximum bid, he is declared the winner, we return his name and create a list of losers, technically remove the winner from the list of players, the remaining ones are called losers. Among them, we search for the maximum bid to determine the price that the owner of the lot will receive.

5.  - If the list of losers is empty, the winning price is considered equal to the reserve price.
    - If there is one participant in the list, we compare his highest bid with the reserve price:
        - If it is less than or equal to the reserve price, this reserve price will be the winning price.
        - If it is larger than the reserve price, it will be the winning price.
    - If there are two or more participants on the list, we find the highest among them, regardless of the number of losers with the same maximum bid, and that price will be the winning price.

6. After that, we have the winner (s.4) and the winning price (s.5)

