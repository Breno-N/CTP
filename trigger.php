<?php
/*
-- Full Trigger DDL Statements
-- Note: Only CREATE TRIGGER statements are allowed
DELIMITER $$

USE `ctp`$$

CREATE
DEFINER=`root`@`localhost`
TRIGGER `ctp`.`update_quantity_request_insert`
AFTER INSERT ON `ctp`.`ctp_user_request`
FOR EACH ROW
-- Edit trigger body code below this line. Do not edit lines above this one
BEGIN
	UPDATE ctp_requests SET quantity = (SELECT COUNT(id) FROM ctp_user_request WHERE ctp_user_request.id_request = NEW.id_request)
	WHERE ctp_requests.id = NEW.id_request;
END$$

CREATE
DEFINER=`root`@`localhost`
TRIGGER `ctp`.`update_quantity_request_delete`
AFTER DELETE ON `ctp`.`ctp_user_request`
FOR EACH ROW
-- Edit trigger body code below this line. Do not edit lines above this one
BEGIN
	UPDATE ctp_requests SET quantity = (SELECT COUNT(id) FROM ctp_user_request WHERE ctp_user_request.id_request = OLD.id_request)
	WHERE ctp_requests.id = OLD.id_request;
END$$

*/