CREATE TABLE ProviderIdentifierTBL (
  ID BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  ProviderID BIGINT UNSIGNED NULL,
  ProviderIdentifier VARCHAR(15) NULL,
  ProviderIdentifierTypeID INTEGER UNSIGNED NULL,
  PRIMARY KEY(ID)
);

CREATE TABLE ProviderIdentifierTypeTBL (
  ID INTEGER UNSIGNED NOT NULL,
  ProviderIdentifierType VARCHAR(20) NULL,
  PRIMARY KEY(ID)
);


