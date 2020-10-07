ALTER TABLE auctionaccessstate
ADD CONSTRAINT AK_Password UNIQUE (auctionId, bidderId);

