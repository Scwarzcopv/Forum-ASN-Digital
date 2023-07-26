CREATE TABLE `notulen_foto` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`rapat` INT(11) NULL DEFAULT NULL,
	`path` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`_active` TINYINT(4) NULL DEFAULT '1',
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `FK_notulen` (`rapat`) USING BTREE,
	CONSTRAINT `FK_notulen` FOREIGN KEY (`rapat`) REFERENCES `komin_sekartaji`.`notulen_hasil_rapat` (`id`) ON UPDATE RESTRICT ON DELETE RESTRICT
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=529
;

CREATE TABLE `notulen_hasil_rapat` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`no_surat` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`tempat_rapat` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`penyelenggara` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`tgl_mulai` DATE NULL DEFAULT NULL,
	`jam_mulai` TIME NULL DEFAULT NULL,
	`tgl_selesai` DATE NULL DEFAULT NULL,
	`jam_selesai` TIME NULL DEFAULT NULL,
	`agenda_rapat` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`pimpinan_rapat` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`id_notulis` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`nip_notulis` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`nama_notulis` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`kirim` TINYINT(4) NULL DEFAULT '0',
	`verified` TINYINT(4) NULL DEFAULT '0',
	`hasil_rapat` MEDIUMTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`list_peserta` VARCHAR(1024) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`cek_peserta` VARCHAR(4) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`kode_unik` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`skpd_id` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`materi` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`cek_pimpinan` VARCHAR(4) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
    `cek_lppd` VARCHAR(4) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`_active` TINYINT(4) NULL DEFAULT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=594
;

CREATE TABLE `notulen_peserta` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_notulen` INT(11) NULL DEFAULT NULL,
	`users_id` INT(11) NULL DEFAULT NULL,
	`instansi` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`status` CHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`time` INT(11) NULL DEFAULT NULL,
	`skpd_id` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`_active` TINYINT(4) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=11730
;

CREATE TABLE `notulen_peserta_guest` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_notulen` INT(11) NULL DEFAULT NULL,
	`nik` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`nama` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`instansi` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`no_hp` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`email` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`status` CHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`time` INT(11) NULL DEFAULT NULL,
	`_active` TINYINT(4) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=240
;

CREATE TABLE `ref_skpd` (
	`id` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`pid` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`name` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`eselon_id` INT(11) NOT NULL DEFAULT '0',
	`created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `id` (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
ROW_FORMAT=DYNAMIC
;

CREATE TABLE `ref_skpd_kode` (
	`skpd_id` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`kode` VARCHAR(10) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`name` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`address` VARCHAR(160) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`phone` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`fax` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`website` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`email` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`notifikasi_wa` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`skpd_id`) USING BTREE
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;


ALTER TABLE `user`
	CHANGE COLUMN `name` `name` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci' AFTER `id`,
	ADD COLUMN `nip` VARCHAR(50) NULL DEFAULT NULL AFTER `date_created`;

ALTER TABLE `user`
	CHANGE COLUMN `nip` `nip` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci' AFTER `name`;

ALTER TABLE `user`
	ADD COLUMN `skpd_id` VARCHAR(50) NULL DEFAULT NULL AFTER `password`;