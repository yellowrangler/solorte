CREATE TABLE ClientHostTBL (
  ID BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  MEDPAL BIGINT UNSIGNED NULL,
  HostID BIGINT UNSIGNED NULL,
  PRIMARY KEY(ID),
  INDEX indexMEDPAL(MEDPAL)
);


