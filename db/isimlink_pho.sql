-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 01 Ara 2020, 13:34:30
-- Sunucu sürümü: 10.2.19-MariaDB-cll-lve
-- PHP Sürümü: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `isimlink_pho`
--

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `activeInfo` (IN `fuid` INT, IN `fiid` INT, IN `acc` INT)  NO SQL
BEGIN
SET @iidcorr = (SELECT COUNT(i.IID) FROM Infos i WHERE i.UID = fuid AND i.IID = fiid);
IF @iidcorr > 0 THEN
UPDATE Infos i SET i.active = acc WHERE i.IID = fiid AND i.UID = fuid;
ELSE
SELECT 'err' AS 'return';
END IF;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `addContact` (IN `fuid` INT, IN `fquery` VARCHAR(150))  NO SQL
BEGIN
SET @cuid = (SELECT u.UID FROM Domains d INNER JOIN UserDomains ud ON d.DID = ud.DID INNER JOIN Users u ON u.UID = ud.UID INNER JOIN Infos i ON i.UID = u.UID WHERE d.Domain = fquery OR (i.Info = fquery AND i.verified = 1) LIMIT 0,1);
IF ISNULL(@cuid) THEN
SELECT 'err' AS 'return';
ELSE 
INSERT INTO Contacts(UID,CUID) VALUES(fuid,@cuid);
SELECT 'ok' AS 'return';
END IF;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `addEmail` (IN `fuid` INT, IN `femail` VARCHAR(150), IN `fcode` VARCHAR(8))  NO SQL
BEGIN
SET @uidcount = (SELECT COUNT(*) FROM Users u WHERE u.UID = fuid);
IF(@uidcount >= 1) THEN
INSERT INTO Infos(UID,TypeID,Info) VALUES(fuid,1,femail);
SET @iid = LAST_INSERT_ID();
INSERT INTO EmailCodes(IID,`Code`) VALUES(@iid,fcode);
SELECT 'ok' AS 'return';
ELSE
SELECT 'notok' AS 'return';
END IF;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `addInfo` (IN `fuid` INT, IN `finfo` VARCHAR(250), IN `ftype` INT)  NO SQL
BEGIN
SET @uidcount = (SELECT COUNT(*) FROM Users WHERE UID = fuid);
IF (@uidcount < 1) THEN
SELECT 'Hata!' AS 'result';
ELSE
INSERT INTO Infos(UID,TypeID,Info) VALUES(fuid,ftype,finfo);
SET @iid = LAST_INSERT_ID();
SELECT 'Eklendi!' AS 'result', @iid AS 'IID';
END IF;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `connectDomainInfo` (IN `fuid` INT, IN `fdid` INT, IN `fiid` INT, IN `fpri` INT)  NO SQL
BEGIN
SET @didcorr = (SELECT COUNT(ud.UDID) FROM UserDomains ud WHERE ud.UID = fuid AND ud.DID = fdid);
SET @iidcorr = (SELECT COUNT(i.IID) FROM Infos i WHERE i.IID = fiid AND i.UID = fuid);
IF @didcorr > 0 AND @iidcorr > 0 THEN
UPDATE DomainInfos SET Active = 0 WHERE DID = fdid AND IID = fiid;
#onceki varsa iptal edilir. 
INSERT INTO DomainInfos(DID,IID,PID) VALUES(fdid,fiid,fpri);
#yenisi eklenir.
SELECT 'ok' AS 'return';
ELSE
SELECT 'err' AS 'return';
END IF;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `DoLogin` (IN `fdomain` VARCHAR(150), IN `fsuccess` INT)  NO SQL
BEGIN
SET @did = (SELECT DID FROM Domains d WHERE d.Domain = fdomain);
IF ISNULL(@did) THEN 
SELECT 'Domain bulunamadı.' AS 'return';
ELSE
SET @realuid = (SELECT UID FROM UserDomains ud WHERE ud.DID = @did);
IF ISNULL(@realuid) THEN
SELECT 'Kullanıcı bulunamadı.' AS 'return';
ELSE
IF fsuccess = 0 THEN
INSERT INTO Logs(UID,LTID) VALUES(@realuid, 6);
SELECT 'Şifre hatalı.' AS 'return';
ELSE
(SELECT UID, Name, Surname INTO  @uid,@name,@surname FROM Users u WHERE u.UID = @realuid);
INSERT INTO Logs(UID,LTID) VALUES(@uid, 1);
SELECT @uid AS UID, @name AS Name, @surname AS Surname, 'Başarılı' AS 'return';
END IF;
END IF;
END IF;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `DoLogin2` (IN `fdomain` VARCHAR(150), IN `fpassword` VARCHAR(150))  NO SQL
BEGIN
SET @did = (SELECT DID FROM Domains d WHERE d.Domain = fdomain);
IF ISNULL(@did) THEN 
SELECT 'Domain bulunamadı.' AS 'return';
ELSE
SET @realuid = (SELECT UID FROM UserDomains ud WHERE ud.DID = @did);
IF ISNULL(@realuid) THEN
SELECT 'Kullanıcı bulunamadı.' AS 'return';
ELSE
(SELECT UID, Name, Surname INTO  @uid,@name,@surname FROM Users u WHERE u.Password = fpassword AND u.UID = @realuid);
IF ISNULL(@uid) THEN
INSERT INTO Logs(UID,LTID) VALUES(@realuid, 6);
SELECT 'Şifre hatalı.' AS 'return';
ELSE
INSERT INTO Logs(UID,LTID) VALUES(@uid, 1);
SELECT @uid AS UID, @name AS Name, @surname AS Surname, 'Başarılı' AS 'return';
END IF;
END IF;
END IF;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `DoSearch` (IN `fquery` VARCHAR(50))  NO SQL
BEGIN
SELECT pp.Isim AS `Isim`, pp.Domain AS `Domain`, 'c' AS Type FROM PublicPhones pp 
WHERE pp.keywords LIKE CONCAT('%',fquery,'%') OR pp.Domain LIKE CONCAT('%',fquery,'%') OR pp.Isim LIKE CONCAT('%',fquery,'%')
UNION
SELECT CONCAT(u.Name,' ',u.Surname) AS `Isim`, d.Domain AS `Domain`, 'p' AS Type FROM Domains d INNER JOIN UserDomains ud ON d.DID = ud.DID INNER JOIN Users u ON u.UID = ud.UID
WHERE d.Domain LIKE CONCAT('%',fquery,'%') OR  CONCAT(u.Name,' ',u.Surname) LIKE CONCAT('%',fquery,'%');
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `emailVerif` (IN `fuid` INT, IN `femail` VARCHAR(150), IN `fcode` VARCHAR(8))  NO SQL
BEGIN
SET @iid = (SELECT i.IID FROM Infos i WHERE i.UID = fuid AND i.Info = femail AND i.TypeID = 1);
IF @iid IS NOT NULL THEN
SET @iscodetrue = (SELECT COUNT(*) FROM EmailCodes ec WHERE ec.IID = @iid AND ec.Code = fcode);
IF @iscodetrue >= 1 THEN
UPDATE Infos i SET i.verified = 1 WHERE i.IID = @iid AND i.UID = fuid;
SELECT 'ok' AS 'return';
ELSE
SELECT 'notok' AS 'return';
END IF;
ELSE
SELECT 'notok' AS 'return';
END IF;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `getContacts` (IN `fuid` INT)  NO SQL
BEGIN
SELECT * FROM Contacts c INNER JOIN Users u ON u.UID = c.CUID INNER JOIN Domains d ON d.DID = u.DDID WHERE c.UID = fuid;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `getDomainInfos` (IN `fdomain` VARCHAR(150), IN `fuid` INT)  NO SQL
BEGIN
SET @ppid = (SELECT pp.PPID FROM PublicPhones pp WHERE pp.Domain = fdomain);
IF @ppid IS NOT NULL
THEN
(SELECT pp.Phone, pp.Isim, pp.Email, pp.image_url INTO @telefon, @name, @email, @image FROM PublicPhones pp WHERE pp.PPID = @ppid);
SELECT @name AS Name, @surname AS Surname, @telefon AS Telefon, @email AS Email, @image AS Image, 'public' AS LinkType;
ELSE
SET @did = (SELECT d.DID FROM Domains d WHERE d.Domain = fdomain);
SET @uid = (SELECT ud.UID FROM UserDomains ud WHERE ud.DID = @did);
(SELECT u.Name, u.Surname INTO @name,@surname FROM Users u WHERE u.UID = @uid);
IF ISNULL(fuid) THEN
(SELECT i.Info INTO @telefon FROM Infos i INNER JOIN DomainInfos di ON i.IID = di.IID WHERE di.DID = @did AND i.TypeID = 2);
#son telefon geliyor, ona göre. Sonradan satır satır alırız farklı bir proc ile.
ELSE
#burada uidye verilen bilgiler de gelsin. sonra...
(SELECT i.Info INTO @telefon FROM Infos i INNER JOIN DomainInfos di ON i.IID = di.IID WHERE di.DID = @did AND i.TypeID = 2 LIMIT 0,1);
END IF;
IF ISNULL(@did) THEN
SET @res = '';
ELSE
SELECT @name AS Name, @surname AS Surname, @telefon AS Telefon, 'personal' AS LinkType;
END IF;
END IF;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `getDomainInfos_new` (IN `fdomain` VARCHAR(150), IN `fuid` INT)  NO SQL
BEGIN
SET @ppid = (SELECT pp.PPID FROM PublicPhones pp WHERE pp.Domain = fdomain);
IF @ppid IS NOT NULL
THEN

(SELECT pp.Phone, pp.Isim, pp.Email, pp.image_url INTO @telefon, @name, @email, @image FROM PublicPhones pp WHERE pp.PPID = @ppid);
SELECT @name AS Info, '-1' AS Type, '1' AS Privacy
UNION
SELECT @image AS Info, '-3' AS Type, '1' AS Privacy
#bunlar genel gelen infolar.
UNION
SELECT @email AS Info, '1' AS Type, '1' AS Privacy
UNION
SELECT @telefon AS Info, '2' AS Type, '1' AS Privacy;
#SELECT @name AS Name, @surname AS Surname, @telefon AS Telefon, @email AS Email, @image AS Image, 'public' AS LinkType;
ELSE
SET @did = (SELECT d.DID FROM Domains d WHERE d.Domain = fdomain);
SET @duid = (SELECT ud.UID FROM UserDomains ud WHERE ud.DID = @did);
(SELECT u.Name, u.Surname INTO @name,@surname FROM Users u WHERE u.UID = @duid);
IF (fuid) = 0 THEN
SELECT @name AS Info, '-1' AS Type 
UNION
SELECT @surname AS Info, '-2' AS Type
UNION
SELECT i.Info AS Info, i.TypeID AS Type  FROM Infos i INNER JOIN DomainInfos di ON i.IID = di.IID WHERE di.DID = @did AND di.Active = 1 AND di.PID = 1;
ELSE
#burada uidye verilen bilgiler de gelsin. sonra...
SELECT @name AS Info, '-1' AS Type, '1' AS Privacy
UNION
SELECT @surname AS Info, '-2' AS Type, '1' AS Privacy
UNION
SELECT i.Info AS Info, i.TypeID AS Type, di.PID AS Privacy FROM Infos i INNER JOIN DomainInfos di ON i.IID = di.IID WHERE di.DID = @did AND di.Active = 1 AND (di.PID = 1 OR di.PID = 2)
UNION
SELECT i.Info AS Info, i.TypeID AS Type, di.PID AS Privacy FROM Infos i INNER JOIN DomainInfos di ON i.IID = di.IID WHERE di.DID = @did AND di.PID = 3 AND di.Active = 1 AND fuid IN (SELECT c.CUID FROM Contacts c WHERE c.UID = @duid UNION SELECT @duid AS CUID);
END IF;
IF ISNULL(@did) THEN
SET @res = '';
ELSE
SET @res = 'ok';
END IF;
END IF;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `getDomainInfos_old` (IN `fdomain` VARCHAR(150), IN `fuid` INT)  NO SQL
BEGIN
SET @did = (SELECT d.DID FROM Domains d WHERE d.Domain = fdomain);
SET @uid = (SELECT ud.UID FROM UserDomains ud WHERE ud.DID = @did);
(SELECT u.Name, u.Surname INTO @name,@surname FROM Users u WHERE u.UID = @uid);
IF ISNULL(fuid) THEN
(SELECT i.Info INTO @telefon FROM Infos i WHERE i.DID = @did AND i.TypeID = 2);
#son telefon geliyor, ona göre. Sonradan satır satır alırız farklı bir proc ile.
ELSE
#burada uidye verilen bilgiler de gelsin. sonra...
(SELECT i.Info INTO @telefon FROM Infos i WHERE i.DID = @did AND i.TypeID = 2);
END IF;
IF ISNULL(@did) THEN
SET @res = '';
ELSE
SELECT @name AS Name, @surname AS Surname, @telefon AS Telefon;
END IF;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `getDomainLinksOfUser` (IN `fuid` INT)  NO SQL
BEGIN
SELECT d.Domain,i.TypeID, (SELECT p.Privacy FROM Privacies p WHERE p.PID = di.PID) AS Privacy,di.Active,i.Info,di.DIID,ud.connection_date FROM UserDomains ud INNER JOIN DomainInfos di ON ud.DID = di.DID INNER JOIN Infos i ON i.IID = di.IID INNER JOIN Domains d ON d.DID = di.DID WHERE ud.UID = fuid AND di.Active = 1;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `getDomainsOfUser` (IN `fuid` INT)  NO SQL
BEGIN
SELECT * FROM Domains d WHERE d.DID IN (SELECT ud.DID FROM UserDomains ud WHERE ud.UID = fuid);
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `getHash` (IN `flogin` VARCHAR(150))  NO SQL
BEGIN
#flogin domain ya da telefon olabilir
SET @hash = '';
SET @did = (SELECT d.DID FROM Domains d WHERE d.Domain = flogin);
IF ISNULL(@did) = 0 THEN
#dom boş değilse
SET @uid = (SELECT ud.UID FROM UserDomains ud WHERE ud.DID = @did);
SET @hash = (SELECT h.Hash FROM Hashes h INNER JOIN Users u ON u.HID = h.HID WHERE u.UID = @uid);
ELSE
SET @uid = (SELECT u.UID FROM Users u INNER JOIN UserDomains ud ON ud.UID = u.UID INNER JOIN Infos i ON i.DID = ud.DID WHERE i.Info = flogin AND i.TypeID = 2);
SET @hash = (SELECT h.Hash FROM Hashes h INNER JOIN Users u ON u.HID = h.HID WHERE u.UID = @uid);
END IF;
SELECT @hash AS Hash;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `getIndexStats` (IN `fuid` INT)  NO SQL
BEGIN
SELECT COUNT(*) INTO @iletisim_bilgileri FROM Infos i WHERE i.UID = fuid; # AND i.active = 1
SELECT COUNT(*) INTO @top_giris_say FROM LinkLogs ll WHERE ll.DID IN (SELECT ud.DID FROM UserDomains ud WHERE ud.UID = fuid) AND ll.LogType = 0;
SELECT @iletisim_bilgileri AS iletisim, @top_giris_say AS topgiris;

END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `getInfos` (IN `fuid` INT)  NO SQL
BEGIN
SELECT i.IID,i.TypeID,i.Info,i.private,i.active,i.verified,i.inserted_date,di.DIID,di.DID, (SELECT d.Domain FROM Domains d WHERE d.DID = di.DID) AS 'Domain' FROM Infos i LEFT JOIN DomainInfos di ON di.IID = i.IID  WHERE i.UID = fuid;
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `getPrivacies` ()  NO SQL
SELECT * FROM Privacies WHERE active = 1$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `LogToDom` (IN `fdomain` VARCHAR(150), IN `fuid` INT ZEROFILL, IN `flogtype` INT)  NO SQL
BEGIN
SET @did = (SELECT d.DID FROM Domains d WHERE d.Domain = fdomain);
INSERT INTO LinkLogs(LogType,DID,UID) VALUES(flogtype,@did,fuid);
END$$

CREATE DEFINER=`isimlink`@`localhost` PROCEDURE `Register` (IN `fname` VARCHAR(150) CHARSET utf8, IN `fsurname` VARCHAR(150) CHARSET utf8, IN `fdomain` VARCHAR(50), IN `fhash` VARCHAR(250))  NO SQL
    COMMENT 'Ad soyad ile basit uyelik acma islemi + domain tescili.'
BEGIN
START TRANSACTION;
SET @domaintescilid = DomainTescil(fdomain);
IF @domaintescilid = 0 THEN
SELECT 'Domain Dolu' AS 'return';
ELSE
INSERT INTO Users(Name,Surname) VALUES(fname,fsurname);
SET @uid = LAST_INSERT_ID();
INSERT INTO Hashes(UID,`Hash`) VALUES(@uid,fhash);
SET @hid = LAST_INSERT_ID();
UPDATE Users SET HID = @hid WHERE UID = @uid;
SET @domainbaglaid = DomainBagla(@uid,@domaintescilid);
IF @domainbaglaid = 0 THEN 
SELECT 'Baglanamadi' AS 'return';
ROLLBACK;
ELSE 
UPDATE Users u SET u.DDID = @domaintescilid WHERE u.UID = @uid; 
#SELECT 'Kaydedildi' AS 'return';
END IF;
END IF;
#Domain işlemleri de burada halledilir.
SELECT fname AS Name, fsurname AS Surname, fdomain AS Domain, 'ok' AS 'return'; 
COMMIT;
END$$

--
-- İşlevler
--
CREATE DEFINER=`isimlink`@`localhost` FUNCTION `DomainBagla` (`fuid` INT, `fdid` INT) RETURNS INT(11) NO SQL
    COMMENT 'Üye kaydı tamamlandığında baglama islemi yapilir.'
BEGIN
IF (SELECT COUNT(*) FROM UserDomains ud WHERE ud.DID = fdid) > 0
THEN
RETURN 0;
ELSE
INSERT INTO UserDomains(UID,DID) VALUES(fuid,fdid);
RETURN 1;
END IF;
END$$

CREATE DEFINER=`isimlink`@`localhost` FUNCTION `DomainTescil` (`fdomain` VARCHAR(50)) RETURNS INT(11) NO SQL
    COMMENT 'Domain sorgularken eğer boş ise ve devam ediliyorsa tescillenir.'
BEGIN
IF (SELECT COUNT(*) FROM Domains d WHERE d.Domain = fdomain) > 0
THEN
RETURN 0;
ELSE
INSERT INTO Domains(Domain) VALUES(fdomain);
RETURN LAST_INSERT_ID();
END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Contacts`
--

CREATE TABLE `Contacts` (
  `CID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `CUID` int(11) NOT NULL COMMENT 'contactUID, eklenen',
  `active` int(11) NOT NULL DEFAULT 1,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Contacts`
--

INSERT INTO `Contacts` (`CID`, `UID`, `CUID`, `active`, `Date`) VALUES
(1, 1, 2, 1, '2020-11-22 14:25:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `DomainInfos`
--

CREATE TABLE `DomainInfos` (
  `DIID` int(11) NOT NULL,
  `DID` int(11) NOT NULL,
  `IID` int(11) NOT NULL,
  `PID` int(11) NOT NULL DEFAULT 1 COMMENT 'PrivacyID',
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Active` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `DomainInfos`
--

INSERT INTO `DomainInfos` (`DIID`, `DID`, `IID`, `PID`, `Date`, `Active`) VALUES
(1, 2, 1, 1, '2020-11-24 14:33:00', 0),
(2, 7, 2, 1, '2020-11-22 15:27:06', 1),
(3, 3, 3, 1, '2020-11-22 15:27:08', 1),
(4, 2, 4, 1, '2020-11-22 15:27:10', 1),
(5, 8, 6, 1, '2020-11-22 15:47:04', 1),
(6, 2, 1, 3, '2020-11-22 15:47:36', 0),
(7, 2, 1, 2, '2020-11-22 15:52:03', 0),
(8, 2, 1, 2, '2020-11-25 11:36:41', 0),
(9, 2, 19, 3, '2020-11-22 15:57:01', 1),
(10, 2, 29, 3, '2020-11-25 11:35:52', 1),
(11, 2, 27, 1, '2020-11-25 11:36:25', 1),
(12, 2, 1, 3, '2020-11-25 11:36:53', 0),
(13, 2, 1, 2, '2020-11-25 11:36:53', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Domains`
--

CREATE TABLE `Domains` (
  `DID` int(11) NOT NULL,
  `Domain` varchar(30) NOT NULL,
  `image_url` varchar(250) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `secret` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Domains`
--

INSERT INTO `Domains` (`DID`, `Domain`, `image_url`, `created_date`, `secret`) VALUES
(1, 'test', NULL, '2020-11-01 08:10:52', 0),
(2, 'onur', NULL, '2020-11-01 08:30:02', 0),
(3, 'fek', NULL, '2020-11-06 22:26:32', 0),
(8, 'santiye', NULL, '2020-11-14 18:12:02', 0),
(7, 'azengin', NULL, '2020-11-13 10:54:17', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `EmailCodes`
--

CREATE TABLE `EmailCodes` (
  `ECID` int(11) NOT NULL,
  `IID` int(11) NOT NULL,
  `Code` varchar(8) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `EmailCodes`
--

INSERT INTO `EmailCodes` (`ECID`, `IID`, `Code`, `Date`) VALUES
(1, 19, '342699', '2020-11-19 06:45:25'),
(2, 20, '913177', '2020-11-19 06:46:44'),
(3, 21, '296333', '2020-11-19 06:50:12'),
(4, 22, '859809', '2020-11-19 06:51:29'),
(5, 23, '888445', '2020-11-19 06:52:12'),
(6, 24, '320406', '2020-11-19 07:02:00'),
(7, 25, '177999', '2020-11-19 07:26:02'),
(8, 26, '894665', '2020-11-19 07:38:40'),
(9, 27, '484187', '2020-11-19 07:39:30'),
(10, 28, '266171', '2020-11-19 07:41:44'),
(11, 29, '217611', '2020-11-19 07:42:41'),
(12, 30, '509092', '2020-11-19 07:43:31');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Hashes`
--

CREATE TABLE `Hashes` (
  `HID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `Hash` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Hashes`
--

INSERT INTO `Hashes` (`HID`, `UID`, `Hash`, `date`) VALUES
(1, 2, '$argon2i$v=19$m=2048,t=4,p=3$bXNLcUNqL1dreDlaYkpGZw$FIA7SJAv3tUZES1O2YhlnSMva6/xUc7YbGIr4XcIyF4', '2020-11-05 09:38:58'),
(2, 2, '$argon2i$v=19$m=2048,t=4,p=3$MXVJa0UxU2VnQnlQa2Evbg$jWPAanBGm3J2QTPfdumr7EMoZWW5I6kLNCoxfBi08mY', '2020-11-06 22:26:32'),
(3, 3, '$argon2i$v=19$m=2048,t=4,p=3$V0VrOWNkaUxUQWxNWC5WTg$U+ty/0CFmjf+I/qPRmRsrY6RfNIsXeHPCyUsK+axS7k', '2020-11-06 22:29:02'),
(7, 7, '$argon2i$v=19$m=2048,t=4,p=3$L25lcS5KNTN3aDdaYU5oTw$tbjWM9Ta8JIdBXphOhbAqOEMaa/PJKmdUrL6ryCKJzA', '2020-11-14 18:12:02'),
(6, 6, '$argon2i$v=19$m=2048,t=4,p=3$SWRGQUNrc1hEeVJVSGFIbA$ZpdjivkEwyrq0GEp8khSRe78B06MJZ8cBJ5Slhz8uxU', '2020-11-13 10:54:17');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Infos`
--

CREATE TABLE `Infos` (
  `IID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `TypeID` int(11) NOT NULL,
  `Info` varchar(250) NOT NULL,
  `private` int(11) NOT NULL DEFAULT 0 COMMENT 'hide_everywhere',
  `active` int(11) NOT NULL DEFAULT 0,
  `verified` int(11) NOT NULL DEFAULT 0,
  `inserted_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='tercihen crypted';

--
-- Tablo döküm verisi `Infos`
--

INSERT INTO `Infos` (`IID`, `UID`, `TypeID`, `Info`, `private`, `active`, `verified`, `inserted_date`) VALUES
(1, 1, 2, '+905456454845', 0, 0, 1, '2020-11-05 23:53:48'),
(2, 7, 2, '+905366637100', 0, 0, 0, '2020-11-13 10:55:22'),
(3, 2, 2, '+905375652670', 0, 0, 0, '2020-11-13 11:25:01'),
(4, 1, 1, 'onurgule@gmail.com', 0, 0, 0, '2020-11-13 20:50:52'),
(6, 8, 2, '+905323281352', 0, 0, 0, '2020-11-14 18:14:51'),
(7, 1, 2, '545', 0, 0, 0, '2020-11-16 12:13:30'),
(19, 1, 1, 'onurgule@hotmail.com', 0, 0, 0, '2020-11-19 06:45:25'),
(20, 1, 1, 'onurgule@gmaill.com', 0, 0, 0, '2020-11-19 06:46:44'),
(29, 1, 1, 'm2.hesaplar@hotmail.com', 0, 0, 1, '2020-11-19 07:42:41'),
(27, 1, 1, 'contact@onurgule.com.tr', 0, 0, 1, '2020-11-19 07:39:30');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `LinkLogs`
--

CREATE TABLE `LinkLogs` (
  `LLID` int(11) NOT NULL,
  `LogType` int(11) NOT NULL COMMENT '0:giris, 1:telefon',
  `DID` int(11) NOT NULL,
  `UID` int(11) NOT NULL DEFAULT 0 COMMENT '0: Anon',
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `LinkLogs`
--

INSERT INTO `LinkLogs` (`LLID`, `LogType`, `DID`, `UID`, `Date`) VALUES
(5, 0, 2, 1, '2020-11-19 20:08:12'),
(4, 0, 2, 1, '2020-11-19 20:01:18'),
(3, 0, 2, 1, '2020-11-19 20:01:02'),
(6, 0, 2, 1, '2020-11-19 20:08:16'),
(7, 0, 8, 0, '2020-11-19 21:44:11'),
(8, 0, 2, 0, '2020-11-20 07:19:08'),
(9, 0, 2, 0, '2020-11-20 07:20:43'),
(10, 0, 2, 0, '2020-11-20 07:21:14'),
(11, 0, 2, 0, '2020-11-20 07:21:28'),
(12, 0, 2, 0, '2020-11-20 07:25:33'),
(13, 0, 2, 0, '2020-11-20 07:27:31'),
(14, 0, 2, 0, '2020-11-20 07:27:57'),
(15, 0, 2, 0, '2020-11-20 07:30:30'),
(16, 0, 2, 0, '2020-11-20 07:33:50'),
(17, 0, 2, 0, '2020-11-20 07:33:54'),
(18, 0, 2, 0, '2020-11-20 07:34:30'),
(19, 0, 2, 0, '2020-11-20 07:35:27'),
(20, 0, 2, 0, '2020-11-20 07:36:32'),
(21, 0, 2, 0, '2020-11-20 07:36:59'),
(22, 0, 2, 0, '2020-11-20 07:37:21'),
(23, 0, 2, 0, '2020-11-20 07:37:36'),
(24, 0, 2, 0, '2020-11-20 07:39:06'),
(25, 0, 2, 0, '2020-11-20 07:39:40'),
(26, 0, 2, 0, '2020-11-20 07:39:49'),
(27, 0, 2, 0, '2020-11-20 07:40:20'),
(28, 0, 2, 0, '2020-11-20 07:41:10'),
(29, 0, 2, 0, '2020-11-20 07:41:27'),
(30, 0, 2, 0, '2020-11-20 07:41:38'),
(31, 0, 2, 0, '2020-11-20 07:43:15'),
(32, 0, 2, 0, '2020-11-20 07:43:39'),
(33, 0, 2, 0, '2020-11-20 07:44:48'),
(34, 0, 2, 0, '2020-11-20 07:45:03'),
(35, 0, 2, 0, '2020-11-20 07:45:09'),
(36, 0, 2, 0, '2020-11-20 07:45:16'),
(37, 0, 2, 0, '2020-11-20 07:45:46'),
(38, 0, 2, 0, '2020-11-20 07:46:39'),
(39, 0, 2, 0, '2020-11-20 07:46:52'),
(40, 0, 2, 0, '2020-11-20 07:47:01'),
(41, 0, 2, 0, '2020-11-20 07:47:15'),
(42, 0, 2, 0, '2020-11-20 07:47:34'),
(43, 0, 2, 0, '2020-11-20 07:48:42'),
(44, 0, 2, 0, '2020-11-20 07:48:50'),
(45, 0, 2, 0, '2020-11-20 07:49:16'),
(46, 0, 2, 0, '2020-11-20 07:49:37'),
(47, 0, 2, 0, '2020-11-20 07:49:49'),
(48, 0, 2, 0, '2020-11-20 07:50:20'),
(49, 0, 2, 0, '2020-11-20 07:52:21'),
(50, 0, 2, 0, '2020-11-20 07:53:07'),
(51, 0, 2, 0, '2020-11-20 07:54:00'),
(52, 0, 2, 0, '2020-11-20 07:54:40'),
(53, 0, 2, 0, '2020-11-20 07:57:00'),
(54, 0, 2, 0, '2020-11-20 07:57:14'),
(55, 0, 2, 0, '2020-11-20 07:57:27'),
(56, 0, 2, 0, '2020-11-20 07:57:33'),
(57, 0, 2, 0, '2020-11-20 07:57:40'),
(58, 0, 2, 0, '2020-11-20 07:58:41'),
(59, 0, 8, 0, '2020-11-20 07:59:57'),
(60, 0, 2, 1, '2020-11-20 08:02:14'),
(61, 0, 2, 1, '2020-11-20 08:02:58'),
(62, 0, 2, 1, '2020-11-20 08:10:00'),
(63, 0, 2, 1, '2020-11-20 08:10:19'),
(64, 0, 2, 1, '2020-11-20 08:10:19'),
(65, 0, 2, 1, '2020-11-20 08:10:32'),
(66, 0, 2, 1, '2020-11-20 08:10:46'),
(67, 0, 2, 1, '2020-11-20 08:10:59'),
(68, 0, 2, 0, '2020-11-20 08:11:05'),
(69, 0, 2, 0, '2020-11-20 08:11:11'),
(70, 0, 2, 1, '2020-11-20 08:13:32'),
(71, 0, 2, 1, '2020-11-20 08:13:34'),
(72, 0, 2, 1, '2020-11-20 08:13:36'),
(73, 0, 2, 1, '2020-11-20 08:26:50'),
(74, 0, 2, 1, '2020-11-20 08:26:53'),
(75, 0, 2, 1, '2020-11-20 08:27:23'),
(76, 0, 2, 1, '2020-11-20 08:27:24'),
(77, 0, 3, 1, '2020-11-20 08:27:28'),
(78, 0, 3, 1, '2020-11-20 08:27:32'),
(79, 0, 2, 1, '2020-11-20 08:29:06'),
(80, 0, 2, 1, '2020-11-20 09:51:15'),
(81, 0, 3, 1, '2020-11-20 09:51:26'),
(82, 0, 2, 1, '2020-11-20 09:51:40'),
(83, 0, 3, 1, '2020-11-20 09:51:55'),
(84, 0, 2, 0, '2020-11-20 09:52:20'),
(85, 0, 2, 0, '2020-11-21 06:22:21'),
(86, 0, 2, 1, '2020-11-21 06:23:17'),
(87, 0, 2, 1, '2020-11-21 06:24:14'),
(88, 0, 8, 0, '2020-11-21 08:47:02'),
(89, 0, 8, 0, '2020-11-21 20:54:26'),
(90, 0, 8, 0, '2020-11-21 21:22:47'),
(91, 0, 8, 0, '2020-11-21 22:41:21'),
(92, 0, 8, 0, '2020-11-22 10:08:35'),
(93, 0, 2, 0, '2020-11-22 10:36:21'),
(94, 0, 8, 0, '2020-11-22 12:48:47'),
(95, 0, 3, 1, '2020-11-22 14:11:52'),
(96, 0, 3, 1, '2020-11-22 14:11:52'),
(97, 0, 3, 1, '2020-11-22 14:21:44'),
(98, 0, 3, 1, '2020-11-22 14:21:49'),
(99, 0, 3, 1, '2020-11-22 14:21:51'),
(100, 0, 3, 1, '2020-11-22 14:22:19'),
(101, 0, 3, 1, '2020-11-22 14:22:40'),
(102, 0, 3, 1, '2020-11-22 14:22:40'),
(103, 0, 3, 1, '2020-11-22 14:53:57'),
(104, 0, 2, 1, '2020-11-22 15:09:46'),
(105, 0, 2, 1, '2020-11-22 15:10:00'),
(106, 0, 2, 1, '2020-11-22 15:59:49'),
(107, 0, 2, 0, '2020-11-22 15:59:59'),
(108, 0, 2, 1, '2020-11-22 16:00:28'),
(109, 0, 2, 1, '2020-11-22 16:00:36'),
(110, 0, 2, 1, '2020-11-22 16:03:38'),
(111, 0, 2, 0, '2020-11-22 16:03:42'),
(112, 0, 2, 1, '2020-11-22 16:03:46'),
(113, 0, 8, 0, '2020-11-23 06:13:59'),
(114, 0, 8, 0, '2020-11-23 06:56:38'),
(115, 0, 8, 0, '2020-11-23 16:52:01'),
(116, 0, 8, 0, '2020-11-23 17:57:41'),
(117, 0, 8, 0, '2020-11-23 18:08:32'),
(118, 0, 2, 1, '2020-11-23 18:56:12'),
(119, 0, 8, 0, '2020-11-23 22:25:27'),
(120, 0, 2, 0, '2020-11-24 13:52:51'),
(121, 0, 2, 0, '2020-11-24 14:28:27'),
(122, 0, 3, 0, '2020-11-24 14:28:59'),
(123, 0, 2, 0, '2020-11-24 14:29:01'),
(124, 0, 2, 0, '2020-11-24 14:32:00'),
(125, 0, 2, 0, '2020-11-24 14:32:01'),
(126, 0, 2, 0, '2020-11-24 14:32:02'),
(127, 0, 2, 0, '2020-11-24 14:32:17'),
(128, 0, 2, 0, '2020-11-24 14:32:40'),
(129, 0, 2, 0, '2020-11-24 14:32:58'),
(130, 0, 2, 0, '2020-11-24 14:32:59'),
(131, 0, 2, 0, '2020-11-24 14:33:16'),
(132, 0, 2, 0, '2020-11-24 14:34:14'),
(133, 0, 2, 0, '2020-11-24 14:34:15'),
(134, 0, 2, 1, '2020-11-24 14:34:29'),
(135, 0, 2, 0, '2020-11-24 14:34:44'),
(136, 0, 2, 1, '2020-11-24 14:34:47'),
(137, 0, 2, 0, '2020-11-24 14:35:16'),
(138, 0, 2, 1, '2020-11-24 14:35:40'),
(139, 0, 2, 1, '2020-11-24 14:37:42'),
(140, 0, 2, 1, '2020-11-24 14:37:51'),
(141, 0, 2, 1, '2020-11-24 14:37:56'),
(142, 0, 2, 1, '2020-11-24 14:37:59'),
(143, 0, 2, 0, '2020-11-24 14:38:02'),
(144, 0, 2, 0, '2020-11-24 14:38:05'),
(145, 0, 2, 0, '2020-11-24 14:38:49'),
(146, 0, 2, 0, '2020-11-24 14:38:50'),
(147, 0, 2, 0, '2020-11-24 14:39:21'),
(148, 0, 2, 0, '2020-11-24 14:39:49'),
(149, 0, 2, 0, '2020-11-24 14:39:53'),
(150, 0, 2, 0, '2020-11-24 14:39:58'),
(151, 0, 2, 0, '2020-11-24 14:40:57'),
(152, 0, 2, 0, '2020-11-24 14:41:25'),
(153, 0, 2, 1, '2020-11-24 14:42:58'),
(154, 0, 8, 0, '2020-11-24 16:44:24'),
(155, 0, 2, 0, '2020-11-25 05:36:11'),
(156, 0, 2, 0, '2020-11-25 05:36:18'),
(157, 0, 8, 0, '2020-11-25 08:36:20'),
(158, 0, 2, 0, '2020-11-25 11:09:58'),
(159, 0, 2, 0, '2020-11-25 11:10:00'),
(160, 0, 2, 1, '2020-11-25 11:10:13'),
(161, 0, 2, 0, '2020-11-25 11:10:14'),
(162, 0, 2, 0, '2020-11-25 11:10:31'),
(163, 0, 2, 1, '2020-11-25 11:35:56'),
(164, 0, 2, 1, '2020-11-25 11:36:26'),
(165, 0, 2, 1, '2020-11-25 11:36:48'),
(166, 0, 2, 1, '2020-11-25 11:36:54'),
(167, 0, 2, 0, '2020-11-25 18:30:31'),
(168, 0, 2, 0, '2020-11-25 18:31:04'),
(169, 0, 2, 0, '2020-11-25 18:31:26'),
(170, 0, 2, 0, '2020-11-25 18:43:40'),
(171, 0, 2, 0, '2020-11-25 18:43:41'),
(172, 0, 2, 0, '2020-11-25 18:44:09'),
(173, 0, 2, 0, '2020-11-25 18:44:24'),
(174, 0, 2, 0, '2020-11-25 18:44:54'),
(175, 0, 2, 0, '2020-11-25 18:48:16'),
(176, 0, 2, 0, '2020-11-25 18:48:59'),
(177, 0, 2, 0, '2020-11-25 18:49:01'),
(178, 0, 2, 0, '2020-11-25 18:52:00'),
(179, 0, 2, 0, '2020-11-25 18:52:25'),
(180, 0, 2, 0, '2020-11-25 18:53:45'),
(181, 0, 2, 1, '2020-11-25 18:54:00'),
(182, 0, 2, 1, '2020-11-25 18:55:24'),
(183, 0, 2, 1, '2020-11-25 18:56:11'),
(184, 0, 2, 1, '2020-11-25 18:56:36'),
(185, 0, 2, 1, '2020-11-25 18:59:01'),
(186, 0, 2, 1, '2020-11-25 18:59:03'),
(187, 0, 2, 1, '2020-11-25 18:59:23'),
(188, 0, 2, 1, '2020-11-25 18:59:47'),
(189, 0, 2, 1, '2020-11-25 19:01:25'),
(190, 0, 2, 1, '2020-11-25 19:01:26'),
(191, 0, 2, 1, '2020-11-25 19:01:31'),
(192, 0, 2, 1, '2020-11-25 19:05:33'),
(193, 0, 2, 1, '2020-11-25 19:05:48'),
(194, 0, 2, 0, '2020-11-25 19:06:03'),
(195, 0, 2, 1, '2020-11-25 19:06:15'),
(196, 0, 8, 0, '2020-11-26 10:50:50'),
(197, 0, 2, 0, '2020-11-26 21:36:34'),
(198, 0, 2, 1, '2020-11-26 21:36:43'),
(199, 0, 2, 1, '2020-11-26 21:36:56'),
(200, 0, 2, 1, '2020-11-26 21:37:08'),
(201, 0, 2, 0, '2020-11-27 09:01:48'),
(202, 0, 2, 0, '2020-11-27 09:02:08'),
(203, 0, 2, 0, '2020-11-27 09:02:40'),
(204, 0, 2, 0, '2020-11-29 11:46:39'),
(205, 0, 2, 0, '2020-11-30 17:09:15'),
(206, 0, 2, 1, '2020-11-30 17:09:46');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Logs`
--

CREATE TABLE `Logs` (
  `LID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `LTID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Logs`
--

INSERT INTO `Logs` (`LID`, `UID`, `LTID`, `date`) VALUES
(1, 1, 1, '2020-11-01 18:17:08'),
(2, 1, 6, '2020-11-01 18:25:24'),
(3, 1, 1, '2020-11-01 18:25:40'),
(4, 1, 1, '2020-11-01 18:38:43'),
(5, 1, 1, '2020-11-01 18:38:44'),
(6, 1, 1, '2020-11-01 18:38:44'),
(7, 1, 6, '2020-11-01 18:38:46'),
(8, 1, 1, '2020-11-01 18:38:47'),
(9, 1, 1, '2020-11-01 18:48:33'),
(10, 1, 1, '2020-11-01 18:48:42'),
(11, 1, 1, '2020-11-01 18:49:09'),
(12, 1, 1, '2020-11-01 18:52:23'),
(13, 1, 1, '2020-11-01 18:55:05'),
(14, 1, 1, '2020-11-01 18:55:10'),
(15, 1, 1, '2020-11-01 18:56:01'),
(16, 1, 1, '2020-11-01 18:56:03'),
(17, 1, 1, '2020-11-01 18:56:03'),
(18, 1, 1, '2020-11-01 18:56:40'),
(19, 1, 1, '2020-11-01 18:56:41'),
(20, 1, 1, '2020-11-01 18:56:41'),
(21, 1, 6, '2020-11-01 18:57:01'),
(22, 1, 1, '2020-11-01 18:57:02'),
(23, 1, 6, '2020-11-02 16:03:16'),
(24, 1, 6, '2020-11-02 16:03:29'),
(25, 1, 1, '2020-11-02 16:03:39'),
(26, 1, 1, '2020-11-05 20:21:20'),
(27, 1, 1, '2020-11-05 20:22:34'),
(28, 1, 6, '2020-11-05 20:22:45'),
(29, 1, 6, '2020-11-05 20:24:11'),
(30, 1, 1, '2020-11-05 20:24:13'),
(31, 1, 6, '2020-11-05 20:29:37'),
(32, 1, 6, '2020-11-05 20:33:09'),
(33, 1, 1, '2020-11-05 20:33:11'),
(34, 1, 1, '2020-11-05 20:33:42'),
(35, 1, 6, '2020-11-05 20:33:50'),
(36, 1, 1, '2020-11-05 20:34:33'),
(37, 1, 6, '2020-11-05 20:34:35'),
(38, 1, 6, '2020-11-05 20:38:35'),
(39, 1, 6, '2020-11-05 20:38:38'),
(40, 1, 6, '2020-11-05 20:38:42'),
(41, 1, 6, '2020-11-05 20:38:45'),
(42, 1, 6, '2020-11-05 20:38:45'),
(43, 1, 6, '2020-11-05 20:38:47'),
(44, 1, 6, '2020-11-05 20:39:04'),
(45, 1, 6, '2020-11-05 20:39:09'),
(46, 1, 1, '2020-11-05 20:39:17'),
(47, 1, 1, '2020-11-05 20:42:58'),
(48, 1, 1, '2020-11-05 20:47:40'),
(49, 1, 1, '2020-11-05 20:48:37'),
(50, 1, 1, '2020-11-05 20:48:42'),
(51, 1, 1, '2020-11-05 20:51:18'),
(52, 1, 1, '2020-11-05 20:52:23'),
(53, 1, 1, '2020-11-05 20:52:29'),
(54, 1, 1, '2020-11-05 21:04:37'),
(55, 1, 1, '2020-11-05 21:05:01'),
(56, 1, 1, '2020-11-05 22:13:51'),
(57, 1, 1, '2020-11-05 22:13:58'),
(58, 1, 1, '2020-11-05 22:39:10'),
(59, 1, 1, '2020-11-06 00:14:14'),
(60, 1, 1, '2020-11-06 00:25:07'),
(61, 1, 6, '2020-11-06 00:31:34'),
(62, 1, 1, '2020-11-06 00:31:41'),
(64, 1, 1, '2020-11-07 02:49:22'),
(65, 1, 1, '2020-11-07 03:01:09'),
(66, 1, 1, '2020-11-07 03:02:04'),
(67, 1, 1, '2020-11-07 03:03:48'),
(68, 1, 1, '2020-11-08 14:15:48'),
(69, 1, 6, '2020-11-13 10:49:57'),
(70, 1, 1, '2020-11-13 10:50:00'),
(71, 6, 1, '2020-11-13 10:54:17'),
(72, 1, 1, '2020-11-13 20:51:37'),
(73, 1, 1, '2020-11-14 15:20:44'),
(74, 7, 1, '2020-11-14 18:12:02'),
(75, 1, 1, '2020-11-16 09:10:34'),
(76, 1, 1, '2020-11-19 05:12:57'),
(77, 1, 1, '2020-11-19 06:24:18'),
(78, 1, 1, '2020-11-19 06:49:59'),
(79, 1, 1, '2020-11-19 15:46:21'),
(80, 1, 1, '2020-11-19 19:42:41'),
(81, 1, 1, '2020-11-20 08:02:14'),
(82, 1, 1, '2020-11-21 06:23:17'),
(83, 1, 1, '2020-11-22 09:55:59'),
(84, 1, 1, '2020-11-22 16:00:35'),
(85, 1, 1, '2020-11-23 18:56:01'),
(86, 1, 1, '2020-11-24 14:34:29'),
(87, 1, 1, '2020-11-25 11:10:13'),
(88, 1, 1, '2020-11-25 18:54:00'),
(89, 1, 1, '2020-11-25 19:06:15'),
(90, 1, 1, '2020-11-26 21:36:43'),
(91, 1, 1, '2020-11-30 17:09:46');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `LogTypes`
--

CREATE TABLE `LogTypes` (
  `LTID` int(11) NOT NULL,
  `LogType` varchar(150) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `LogTypes`
--

INSERT INTO `LogTypes` (`LTID`, `LogType`, `priority`) VALUES
(1, 'Giriş', 1),
(2, 'Telefon Ekleme', 4),
(3, 'Email Ekleme', 2),
(4, 'Adres Ekleme', 3),
(5, 'Şifre Değişikliği', 5),
(6, 'Yanlış Giriş', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `old_Users`
--

CREATE TABLE `old_Users` (
  `UID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL COMMENT '+905',
  `permission` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `old_Users`
--

INSERT INTO `old_Users` (`UID`, `username`, `name`, `surname`, `phone`, `permission`, `date`) VALUES
(1, 'onurgule', 'Onur Osman', 'Güle', '+905456454845', 0, '2020-07-20 11:29:51'),
(2, 'fek', 'Fatih Enis2', 'Kaya', '+905375652670', 0, '2020-07-20 11:29:51'),
(3, 'fatih', 'Fatih Enis', 'Kaya', '+905375652670', 0, '2020-07-20 11:29:51'),
(4, 'enis', 'Fatih Enis', 'Kaya', '+905375652670', 0, '2020-07-20 11:29:51'),
(5, 'fatiheniskaya', 'Fatih Enis', 'Kaya', '+905375652670', 0, '2020-07-20 11:29:51'),
(6, 'muratspx', 'Murat', 'SPX', '+905360323390', 0, '2020-07-20 11:29:51'),
(7, 'halil', 'Halil', 'Topsac', '+905344181234', 0, '2020-07-20 11:29:51'),
(8, 'bb', 'Blooming', 'Brothers', '+905340203030', 0, '2020-07-20 11:29:51'),
(9, 'md', 'Merve', 'Durusan ', '+905465448512', 0, '2020-07-20 11:29:51'),
(10, 'oog', 'Onur Osman', 'Güle', '+905456454845', 0, '2020-07-20 13:20:35'),
(11, 'emin', 'Emin', 'Birkan', '+905363758245', 0, '2020-07-20 18:24:24'),
(12, 'berat', 'Berat', 'Keskin', '+905543050797', 0, '2020-07-20 18:25:07'),
(13, 'enes', 'Enes', 'Aslan', '+905349131031', 0, '2020-07-20 18:28:21'),
(15, 'bh', 'Betül', 'Hacioglu', '+905309052051', 0, '2020-07-20 19:31:58'),
(16, 'gizem', 'Gizem', 'Sak', '+905313685877', 0, '2020-07-21 15:56:30'),
(17, 'ai', 'Anil', 'Öztürk', '+905376952578', 0, '2020-07-22 14:03:57'),
(18, 'uzayli', 'Sükrü', 'Ayyildiz', '+905317910423', 0, '2020-07-22 14:03:57'),
(19, 'ai.isim.link', 'An?l', 'Öztürk', '+905376952578', 0, '2020-07-22 14:06:51'),
(20, 'onur', 'Onur Osman', 'Güle', '+905456454845', 0, '2020-08-01 18:50:24'),
(21, 'Orhun', 'Orhun', 'Özdemir ', '+905417687195', 0, '2020-08-12 15:04:44');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Privacies`
--

CREATE TABLE `Privacies` (
  `PID` int(11) NOT NULL,
  `Privacy` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Privacies`
--

INSERT INTO `Privacies` (`PID`, `Privacy`, `active`) VALUES
(1, 'Herkese Açık', 1),
(2, 'Üyeler', 1),
(3, 'Rehberim', 1),
(4, 'Yetkilendirdiklerim', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `PublicPhones`
--

CREATE TABLE `PublicPhones` (
  `PPID` int(11) NOT NULL,
  `Domain` varchar(150) NOT NULL,
  `Isim` varchar(150) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `image_url` varchar(300) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `PublicPhones`
--

INSERT INTO `PublicPhones` (`PPID`, `Domain`, `Isim`, `Phone`, `Email`, `image_url`, `keywords`, `Date`) VALUES
(1, 'turktelekom', 'Türk Telekom', '+904441444', 'iletisim@turktelekom.com.tr', 'https://www.turktelekom.com.tr/assets/img/turk-telekom.png', 'ttnet, turktelekom, türk telekom, internet, iis, telekom', '2020-11-20 08:46:12');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Types`
--

CREATE TABLE `Types` (
  `TID` int(11) NOT NULL,
  `Type` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `Active` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Types`
--

INSERT INTO `Types` (`TID`, `Type`, `Active`) VALUES
(1, 'Email', 1),
(2, 'Telefon', 1),
(3, 'Adres', 0),
(-1, 'İsim', 0),
(-2, 'Soyisim', 0),
(-3, 'Fotoğraf', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `UserDomains`
--

CREATE TABLE `UserDomains` (
  `UDID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `DID` int(11) NOT NULL,
  `connection_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `UserDomains`
--

INSERT INTO `UserDomains` (`UDID`, `UID`, `DID`, `connection_date`) VALUES
(1, 1, 2, '2020-11-01 08:30:02'),
(2, 2, 3, '2020-11-06 22:26:32'),
(7, 7, 8, '2020-11-14 18:12:02'),
(6, 6, 7, '2020-11-13 10:54:17');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Users`
--

CREATE TABLE `Users` (
  `UID` int(11) NOT NULL,
  `Name` varchar(150) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `Surname` varchar(150) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `HID` int(200) NOT NULL,
  `DDID` int(11) DEFAULT NULL COMMENT 'Default Domain ID',
  `register_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Users`
--

INSERT INTO `Users` (`UID`, `Name`, `Surname`, `HID`, `DDID`, `register_date`) VALUES
(1, 'Onur Osman', 'Güle', 1, 2, '2020-11-01 08:30:02'),
(2, 'Fatih Enis', 'Kaya', 2, 3, '2020-11-06 22:26:32'),
(7, 'Şantiye', 'Coffee', 7, 8, '2020-11-14 18:12:02'),
(6, 'Ahmet', 'Zengin', 6, 7, '2020-11-13 10:54:17');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `Contacts`
--
ALTER TABLE `Contacts`
  ADD PRIMARY KEY (`CID`),
  ADD UNIQUE KEY `UID` (`UID`,`CUID`);

--
-- Tablo için indeksler `DomainInfos`
--
ALTER TABLE `DomainInfos`
  ADD PRIMARY KEY (`DIID`);

--
-- Tablo için indeksler `Domains`
--
ALTER TABLE `Domains`
  ADD PRIMARY KEY (`DID`),
  ADD UNIQUE KEY `Domain` (`Domain`),
  ADD KEY `Domain_2` (`Domain`);

--
-- Tablo için indeksler `EmailCodes`
--
ALTER TABLE `EmailCodes`
  ADD PRIMARY KEY (`ECID`);

--
-- Tablo için indeksler `Hashes`
--
ALTER TABLE `Hashes`
  ADD PRIMARY KEY (`HID`);

--
-- Tablo için indeksler `Infos`
--
ALTER TABLE `Infos`
  ADD PRIMARY KEY (`IID`),
  ADD UNIQUE KEY `UID` (`UID`,`Info`);

--
-- Tablo için indeksler `LinkLogs`
--
ALTER TABLE `LinkLogs`
  ADD PRIMARY KEY (`LLID`);

--
-- Tablo için indeksler `Logs`
--
ALTER TABLE `Logs`
  ADD PRIMARY KEY (`LID`);

--
-- Tablo için indeksler `LogTypes`
--
ALTER TABLE `LogTypes`
  ADD PRIMARY KEY (`LTID`);

--
-- Tablo için indeksler `old_Users`
--
ALTER TABLE `old_Users`
  ADD PRIMARY KEY (`UID`);

--
-- Tablo için indeksler `Privacies`
--
ALTER TABLE `Privacies`
  ADD PRIMARY KEY (`PID`);

--
-- Tablo için indeksler `PublicPhones`
--
ALTER TABLE `PublicPhones`
  ADD PRIMARY KEY (`PPID`);
ALTER TABLE `PublicPhones` ADD FULLTEXT KEY `keywords` (`keywords`);

--
-- Tablo için indeksler `Types`
--
ALTER TABLE `Types`
  ADD PRIMARY KEY (`TID`);

--
-- Tablo için indeksler `UserDomains`
--
ALTER TABLE `UserDomains`
  ADD PRIMARY KEY (`UDID`);

--
-- Tablo için indeksler `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `Contacts`
--
ALTER TABLE `Contacts`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `DomainInfos`
--
ALTER TABLE `DomainInfos`
  MODIFY `DIID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `Domains`
--
ALTER TABLE `Domains`
  MODIFY `DID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `EmailCodes`
--
ALTER TABLE `EmailCodes`
  MODIFY `ECID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `Hashes`
--
ALTER TABLE `Hashes`
  MODIFY `HID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `Infos`
--
ALTER TABLE `Infos`
  MODIFY `IID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `LinkLogs`
--
ALTER TABLE `LinkLogs`
  MODIFY `LLID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- Tablo için AUTO_INCREMENT değeri `Logs`
--
ALTER TABLE `Logs`
  MODIFY `LID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Tablo için AUTO_INCREMENT değeri `LogTypes`
--
ALTER TABLE `LogTypes`
  MODIFY `LTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `old_Users`
--
ALTER TABLE `old_Users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `Privacies`
--
ALTER TABLE `Privacies`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `PublicPhones`
--
ALTER TABLE `PublicPhones`
  MODIFY `PPID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `UserDomains`
--
ALTER TABLE `UserDomains`
  MODIFY `UDID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `Users`
--
ALTER TABLE `Users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
