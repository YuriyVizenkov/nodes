<?php

/**
 * Class m150516_082757_create_table_nodes
 */
class m150516_082757_create_table_nodes extends CDbMigration
{
	public function up()
	{
		$this->execute("CREATE TABLE `tbl_nodes` (
							`id` INT(11) NOT NULL AUTO_INCREMENT,
							`root_node_id` INT(11) NULL DEFAULT NULL,
							`node_id` INT(11) NULL DEFAULT NULL,
							`name` VARCHAR(255) NOT NULL,
							`weight` INT(3) NOT NULL,
							`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
							`updated_at` TIMESTAMP NULL DEFAULT NULL,
							PRIMARY KEY (`id`)
						)
						COLLATE='utf8_general_ci'
						ENGINE=InnoDB;");
	}

	public function down()
	{
		$this->dropTable("tbl_nodes");
	}
}