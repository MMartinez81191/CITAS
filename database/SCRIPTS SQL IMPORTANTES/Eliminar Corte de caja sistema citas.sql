SELECT * FROM pinguino_citas.cortes_caja ORDER BY id_corte DESC;


UPDATE citas SET contabilizado = 0 
WHERE fecha > '2020-07-31' AND contabilizado = 1 ORDER BY fecha ASC;

DELETE from cortes_caja WHERE numero_session = 21;

ALTER TABLE cortes_caja  AUTO_INCREMENT = 1343;
