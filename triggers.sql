--
-- Database: `beasiswa`
--

-- --------------------------------------------------------

--
-- Triggers `r_univ`
--
DROP TRIGGER IF EXISTS `delUniv`;
DELIMITER //
CREATE TRIGGER `delUniv` BEFORE DELETE ON `r_univ`
 FOR EACH ROW BEGIN
  DECLARE jml_univ INTEGER;
  select count(*) into jml_univ from r_fakul where KD_UNIV = old.KD_UNIV;
  IF (jml_univ > 0) THEN
    CALL cannot_delete_error; 
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `r_fakul`
--
DROP TRIGGER IF EXISTS `delFakul`;
DELIMITER //
CREATE TRIGGER `delFakul` BEFORE DELETE ON `r_fakul`
 FOR EACH ROW BEGIN
  DECLARE jml_fakul INTEGER;
  select count(*) into jml_fakul from r_jur where KD_FAKUL = old.KD_FAKUL;
  IF (jml_fakul > 0) THEN
    CALL cannot_delete_error; 
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `r_jur`
--
DROP TRIGGER IF EXISTS `delJur`;
DELIMITER //
CREATE TRIGGER `delJur` BEFORE DELETE ON `r_jur`
 FOR EACH ROW BEGIN
  DECLARE jml_jur_1 INTEGER;
  DECLARE jml_jur_2 INTEGER;
  DECLARE jml_jur_3 INTEGER;
  DECLARE jml_jur_4 INTEGER;
  
  select count(*) into jml_jur_1 from d_kontrak where KD_JUR = old.KD_JUR;
  select count(*) into jml_jur_2 from d_srt_tugas where KD_JUR = old.KD_JUR;
  select count(*) into jml_jur_3 from d_pb where KD_JUR = old.KD_JUR;
  select count(*) into jml_jur_4 from d_elemen_beasiswa where KD_JUR = old.KD_JUR;
    
  IF (jml_jur_1 + jml_jur_2 + jml_jur_3 + jml_jur_4 > 0) THEN
    CALL cannot_delete_error; 
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `r_bank`
--
DROP TRIGGER IF EXISTS `delBank`;
DELIMITER //
CREATE TRIGGER `delBank` BEFORE DELETE ON `r_bank`
 FOR EACH ROW BEGIN
  DECLARE jml_bank INTEGER;
    
  select count(*) into jml_bank from d_pb where KD_BANK = old.KD_BANK;
      
  IF (jml_bank > 0) THEN
    CALL cannot_delete_error; 
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `r_strata`
--
DROP TRIGGER IF EXISTS `delStrata`;
DELIMITER //
CREATE TRIGGER `delStrata` BEFORE DELETE ON `r_strata`
 FOR EACH ROW BEGIN
  DECLARE jml_strata INTEGER;
    
  select count(*) into jml_strata from r_jur where KD_STRATA = old.KD_STRATA;
      
  IF (jml_strata > 0) THEN
    CALL cannot_delete_error; 
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `d_pemb`
--
DROP TRIGGER IF EXISTS `delPemb`;
DELIMITER //
CREATE TRIGGER `delPemb` BEFORE DELETE ON `d_pemb`
 FOR EACH ROW BEGIN
  DECLARE jml_pemb INTEGER;
    
  select count(*) into jml_pemb from d_srt_tugas where KD_PEMB = old.KD_PEMB;
      
  IF (jml_pemb > 0) THEN
    CALL cannot_delete_error; 
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `r_jsc`
--
DROP TRIGGER IF EXISTS `delJsc`;
DELIMITER //
CREATE TRIGGER `delJsc` BEFORE DELETE ON `r_jsc`
 FOR EACH ROW BEGIN
  DECLARE jml_jsc INTEGER;
    
  select count(*) into jml_jsc from d_cuti where KD_JNS_SRT_CUTI = old.KD_JNS_SRT_CUTI;
      
  IF (jml_jsc > 0) THEN
    CALL cannot_delete_error; 
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `d_user`
--
DROP TRIGGER IF EXISTS `delUser`;
DELIMITER //
CREATE TRIGGER `delUser` BEFORE DELETE ON `d_user`
 FOR EACH ROW BEGIN
  DECLARE jml_user INTEGER;
    
  select count(*) into jml_user from d_entry_log where USER = old.USER;
      
  IF (jml_user > 0) THEN
    CALL cannot_delete_error; 
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `r_jst`
--
DROP TRIGGER IF EXISTS `delJst`;
DELIMITER //
CREATE TRIGGER `delJst` BEFORE DELETE ON `r_jst`
 FOR EACH ROW BEGIN
  DECLARE jml_jst INTEGER;
    
  select count(*) into jml_jst from d_srt_tugas where KD_JENIS_ST = old.KD_JENIS_ST;
      
  IF (jml_jst > 0) THEN
    CALL cannot_delete_error; 
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `d_pb`
--
DROP TRIGGER IF EXISTS `delPb`;
DELIMITER //
CREATE TRIGGER `delPb` BEFORE DELETE ON `d_pb`
 FOR EACH ROW BEGIN
  DECLARE jml_pb_1 INTEGER;
  DECLARE jml_pb_2 INTEGER;
  DECLARE jml_pb_3 INTEGER;
  DECLARE jml_pb_4 INTEGER;
  DECLARE jml_pb_5 INTEGER;
  
  select count(*) into jml_pb_1 from d_cuti where KD_PB = old.KD_PB;
  select count(*) into jml_pb_2 from d_mas_tb where KD_PB = old.KD_PB;
  select count(*) into jml_pb_3 from d_nil_pb where KD_PB = old.KD_PB;
  select count(*) into jml_pb_4 from t_elem_beasiswa where KD_PB = old.KD_PB;
  select count(*) into jml_pb_5 from t_tagihan_kontrak where KD_PB = old.KD_PB;
      
  IF (jml_pb_1 + jml_pb_2 + jml_pb_3 + jml_pb_4 + jml_pb_5 > 0) THEN
    CALL cannot_delete_error; 
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `d_kontrak`
--
DROP TRIGGER IF EXISTS `delKontrak`;
DELIMITER //
CREATE TRIGGER `delKontrak` BEFORE DELETE ON `d_kontrak`
 FOR EACH ROW BEGIN
  DECLARE jml_kontrak_1 INTEGER;
  DECLARE jml_kontrak_2 INTEGER;
    
  select count(*) into jml_kontrak_1 from d_tagihan where KD_KON = old.KD_KON;
  select count(*) into jml_kontrak_2 from d_kontrak where KONTRAK_LAMA = old.KD_KON;
       
  IF (jml_kontrak_1 + jml_kontrak_2 > 0) THEN
    CALL cannot_delete_error; 
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `d_srt_tugas`
--
DROP TRIGGER IF EXISTS `delSrtgs`;
DELIMITER //
CREATE TRIGGER `delSrtgs` BEFORE DELETE ON `d_srt_tugas`
 FOR EACH ROW BEGIN
  DECLARE jml_srtgs_1 INTEGER;
  DECLARE jml_srtgs_2 INTEGER;
    
  select count(*) into jml_srtgs_1 from d_pb where KD_ST = old.KD_ST;
  select count(*) into jml_srtgs_2 from d_srt_tugas where KD_ST_LAMA = old.KD_ST;
       
  IF (jml_srtgs_1 + jml_srtgs_2 > 0) THEN
    CALL cannot_delete_error; 
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `d_elemen_beasiswa`
--
DROP TRIGGER IF EXISTS `delElemen`;
DELIMITER //
CREATE TRIGGER `delElemen` AFTER DELETE ON `d_elemen_beasiswa`
 FOR EACH ROW BEGIN
  DELETE FROM t_elem_beasiswa
  WHERE (KD_D_ELEM_BEASISWA = old.KD_D_ELEM_BEASISWA); 
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Triggers `d_tagihan`
--
DROP TRIGGER IF EXISTS `delTagihan`;
DELIMITER //
CREATE TRIGGER `delTagihan` AFTER DELETE ON `d_tagihan`
 FOR EACH ROW BEGIN
  DELETE FROM t_tagihan_kontrak
  WHERE (KD_TAGIHAN = old.KD_TAGIHAN); 
END
//
DELIMITER ;