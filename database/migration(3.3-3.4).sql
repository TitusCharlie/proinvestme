--
-- Dumping data for table `tbl_settings`
--
INSERT INTO `tbl_settings` (`type`, `value`, `updatedDtm`) VALUES
('backend_template', '2', '2021-02-09 11:50:57');

UPDATE `tbl_settings` SET type='frontend_template' WHERE type='template';