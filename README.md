# bence.net
Çevrimiçi Anket Sitesi - bence.net

## Gerekli Yazılımlar
- XAMPP https://www.apachefriends.org/tr/index.html
- MySQL (XAMPP ile kuruluyor olabilir. Tekrardan kurmak gerekli mi bilmiyorum.)

## Sunucuyu Yayınlama
- XAMPP'ın kurulu olduğu klasördeki şu adresi açın: "XAMPP\htdocs\"
- Bu klasörün içine proje klasörünü ekleyin. "XAMPP\htdocs\bence" 
- Proje klasörünün ismi "bence" olmak zorundadır.
- XAMPP programını yönetici olarak çalıştırın.
- "Apache Server" ve "MySQL DB" servislerini çalıştırın.
- MySQL Servisinin yanındaki "Admin" düğmesine tıklayın.
- Açılan phpMyAdmin sayfasının solundaki panelden "yeni/new" yazan seçeneğe tıklayarak yeni bir veritabanı oluşturun.
- Veritabanı ismine "bence" yazın, karakter kodlamasını da "utf8_turkish_ci" olarak seçin ve "oluştur/create" tuşuna tıklayın.
- Oluşturulan veritabanında "SQL" sekmesine gelin ve aşağıdaki kodları yazıp sorguyu çalıştırın.
```mysql
CREATE TABLE `bence`.`user` ( `email_address` TEXT NOT NULL , `password` TEXT NOT NULL , `name` TEXT NOT NULL ) ENGINE = InnoDB;
CREATE TABLE `bence`.`company` ( `email_address` TEXT NOT NULL , `password` TEXT NOT NULL , `name` TEXT NOT NULL , `tax_number` TEXT NOT NULL ) ENGINE = InnoDB;
CREATE TABLE `bence`.`survey` ( `sid` TEXT NOT NULL , `sname` TEXT NOT NULL , `creator` TEXT NOT NULL , `cmail` TEXT NOT NULL , `info` TEXT NOT NULL ) ENGINE = InnoDB;
CREATE TABLE `bence`.`question_selection` ( `sid` TEXT NOT NULL , `question_number` TEXT NOT NULL , `question` TEXT NOT NULL , `selection_number` TEXT NOT NULL , `sel_1` TEXT NOT NULL , `sel_2` TEXT NOT NULL , `sel_3` TEXT NOT NULL , `sel_4` TEXT NOT NULL , `sel_5` TEXT NOT NULL , `ans_1` TEXT NOT NULL , `ans_2` TEXT NOT NULL , `ans_3` TEXT NOT NULL , `ans_4` TEXT NOT NULL , `ans_5` TEXT NOT NULL ) ENGINE = InnoDB;
CREATE TABLE `bence`.`question_text` ( `sid` TEXT NOT NULL , `question_number` TEXT NOT NULL , `question` TEXT NOT NULL ) ENGINE = InnoDB;
CREATE TABLE `bence`.`answer_record` ( `sid` TEXT NOT NULL , `uid` TEXT NOT NULL , `ip_address` TEXT NOT NULL , `qnumber` TEXT NOT NULL , `answer` TEXT NOT NULL ) ENGINE = InnoDB;

CREATE TABLE `bence`.`vars` ( `type` TEXT NOT NULL , `var` TEXT NOT NULL ) ENGINE = InnoDB;
INSERT INTO `vars` (`type`, `var`) VALUES ('sid', '0');
```
