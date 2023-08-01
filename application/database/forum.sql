-- SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS forum;
CREATE TABLE IF NOT EXISTS forum (
	id INT(11) AUTO_INCREMENT,
	id_notulen INT(11),
	forum_active TINYINT(4),
	tanya_active TINYINT(4),
	komentar_active TINYINT(4),
	PRIMARY KEY(id)
);
ALTER TABLE forum ADD FOREIGN KEY (id_notulen) REFERENCES notulen_hasil_rapat(id);
-- INSERT INTO forum (id_notulen,forum_active,tanya_active,komentar_active)
-- VALUES
-- 	(1,1,0,0),
-- 	(2,1,0,0),
-- 	(3,1,0,0),
-- 	(4,1,0,0),
-- 	(5,1,0,0),
-- 	(6,1,0,0),
-- 	(7,1,0,0),
-- 	(8,1,0,0),
-- 	(9,1,0,0),
-- 	(10,1,0,0),
-- 	(11,0,0,0),
-- 	(12,0,0,0),
-- 	(13,0,0,0),
-- 	(14,0,0,0),
-- 	(15,0,0,0),
-- 	(16,0,0,0),
-- 	(17,0,0,0),
-- 	(18,0,0,0),
-- 	(19,0,0,0),
-- 	(20,0,0,0),
-- 	(21,1,0,0);

DROP TABLE IF EXISTS forum_access;
CREATE TABLE IF NOT EXISTS forum_access (
	id INT(11) AUTO_INCREMENT,
	id_forum INT(11),
	id_user INT(11),
	
	PRIMARY KEY(id)
);
ALTER TABLE forum_access ADD FOREIGN KEY (id_forum) REFERENCES forum(id);
ALTER TABLE forum_access ADD FOREIGN KEY (id_user) REFERENCES user(id);
-- INSERT INTO forum_access (id_forum,id_user)
-- VALUES
-- 	(1,5),
-- 	(2,5),
-- 	(3,5),
-- 	(4,5),
-- 	(5,5),
-- 	(6,5),
-- 	(7,5),
-- 	(8,5),
-- 	(9,5),
-- 	(10,5),
-- 	(11,5),
-- 	(12,5),
-- 	(13,5),
-- 	(14,5),
-- 	(15,5),
-- 	(16,5),
-- 	(17,5),
-- 	(18,5),
-- 	(19,5),
-- 	(20,5);
	
DROP TABLE IF EXISTS forum_pertanyaan;
CREATE TABLE IF NOT EXISTS forum_pertanyaan (
	id INT(11) AUTO_INCREMENT,
	id_forum INT(11),
	
-- User tanya
	id_user_tanya INT(11),
	isi_pertanyaan VARCHAR(256),
	created_at TIMESTAMP NULL DEFAULT NULL,
	valid TINYINT(4),
-- Admin Menjawab
	id_admin INT(11),
	isi_jawaban VARCHAR(256),
	answered_at TIMESTAMP NULL DEFAULT NULL,
	
	total_like INT,
	PRIMARY KEY(id)
);
ALTER TABLE forum_pertanyaan ADD FOREIGN KEY (id_forum) REFERENCES forum(id);
ALTER TABLE forum_pertanyaan ADD FOREIGN KEY (id_user_tanya) REFERENCES user(id);
ALTER TABLE forum_pertanyaan ADD FOREIGN KEY (id_admin) REFERENCES user(id);

DROP TABLE IF EXISTS forum_comment;
CREATE TABLE IF NOT EXISTS forum_comment (
	id INT(11) AUTO_INCREMENT,
	id_forum INT(11),
	id_forum_pertanyaan INT(11),
	
-- 	User Comment
	id_user INT(11),
	id_parent INT(11),
	created_at TIMESTAMP NULL DEFAULT NULL,
	updated_at TIMESTAMP NULL DEFAULT NULL,
	isi_comment VARCHAR(255),
	
	total_like INT,
	PRIMARY KEY(id)
);	
ALTER TABLE forum_comment ADD FOREIGN KEY (id_forum) REFERENCES forum(id);
ALTER TABLE forum_comment ADD FOREIGN KEY (id_forum_pertanyaan) REFERENCES forum_pertanyaan(id);
ALTER TABLE forum_comment ADD FOREIGN KEY (id_user) REFERENCES user(id);
ALTER TABLE forum_comment ADD FOREIGN KEY (id_parent) REFERENCES user(id);