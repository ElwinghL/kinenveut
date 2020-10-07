ALTER TABLE AuctionAccessState
ADD CONSTRAINT AK_Auction_Bidder UNIQUE (auctionId, bidderId);

