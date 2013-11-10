ALTER TABLE  `oc_address` ADD  `name` VARCHAR( 50 ) NOT NULL;
ALTER TABLE  `oc_address` ADD  `kecamatan` VARCHAR( 60 ) NOT NULL;
ALTER TABLE  `oc_order` ADD  `name` VARCHAR( 100 ) NULL ,
ADD  `kecamatan` VARCHAR( 100 ) NULL,  ADD  `payment_name` VARCHAR( 100 ) NULL ,
ADD  `shipping_name` VARCHAR( 100 ) NULL,  ADD  `shipping_kecamatan` VARCHAR( 100 ) NULL;