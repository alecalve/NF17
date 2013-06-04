INSERT INTO tRegion VALUES 
    ('Alsace'),
    ('Aquitaine'),
    ('Auvergne'),
    ('Basse-Normandie'),
    ('Bourgogne'),
    ('Bretagne'),
    ('Centre'),
    ('Champagne-Ardenne'),
    ('Corse'),
    ('Franche-Comté'),
    ('Haute-Normandie'),
    ('Ile-de-France'),
    ('Languedoc-Roussillon'),
    ('Limousin'),
    ('Lorraine'),
    ('Midi-Pyrénées'),
    ('Nord-Pas-de-Calais'),
    ('Pays de la Loire'),
    ('Picardie'),
    ('Poitou-Charentes'),
    ('Provence-Alpes-Côte d''Azur'),
    ('Rhône-Alpes'),
    ('Outre-mer');
    
INSERT INTO tDepartement (nom, fkregion, numero) VALUES
    ('Ain','Rhône-Alpes','01'),
    ('Aisne','Picardie','02'),
    ('Allier','Auvergne','03'),
    ('Alpes de Hautes-Provence','Provence-Alpes-Côte d''Azur','04'),
    ('Hautes-Alpes','Provence-Alpes-Côte d''Azur','05'),
    ('Alpes-Maritimes','Provence-Alpes-Côte d''Azur','06'),
    ('Ardèche','Rhône-Alpes','07'),
    ('Ardennes','Champagne-Ardenne','08'),
    ('Ariège','Midi-Pyrénées','09'),
    ('Aube','Champagne-Ardenne','10'),
    ('Aude','Languedoc-Roussillon','11'),
    ('Aveyron','Midi-Pyrénées','12'),
    ('Bouches-du-Rhône','Provence-Alpes-Côte d''Azur','13'),
    ('Calvados','Basse-Normandie','14'),
    ('Cantal','Auvergne','15'),
    ('Charente','Poitou-Charentes','16'),
    ('Charente-Maritime','Poitou-Charentes','17'),
    ('Cher','Centre','18'),
    ('Corrèze','Limousin','19'),
    ('Corse-du-Sud','Corse','2A'),
    ('Haute-Corse','Corse','2B'),
    ('Côte-d''Or','Bourgogne','21'),
    ('Côtes d''Armor','Bretagne','22'),
    ('Creuse','Limousin','23'),
    ('Dordogne','Aquitaine','24'),
    ('Doubs','Franche-Comté','25'),
    ('Drôme','Rhône-Alpes','26'),
    ('Eure','Haute-Normandie','27'),
    ('Eure-et-Loir','Centre','28'),
    ('Finistère','Bretagne','29'),
    ('Gard','Languedoc-Roussillon','30'),
    ('Haute-Garonne','Midi-Pyrénées','31'),
    ('Gers','Midi-Pyrénées','32'),
    ('Gironde','Aquitaine','33'),
    ('Hérault','Languedoc-Roussillon','34'),
    ('Ille-et-Vilaine','Bretagne','35'),
    ('Indre','Centre','36'),
    ('Indre-et-Loire','Centre','37'),
    ('Isère','Rhône-Alpes','38'),
    ('Jura','Franche-Comté','39'),
    ('Landes','Aquitaine','40'),
    ('Loir-et-Cher','Centre','41'),
    ('Loire','Rhône-Alpes','42'),
    ('Haute-Loire','Auvergne','43'),
    ('Loire-Atlantique','Pays de la Loire','44'),
    ('Loiret','Centre','45'),
    ('Lot','Midi-Pyrénées','46'),
    ('Lot-et-Garonne','Aquitaine','47'),
    ('Lozère','Languedoc-Roussillon','48'),
    ('Maine-et-Loire','Pays de la Loire','49'),
    ('Manche','Basse-Normandie','50'),
    ('Marne','Champagne-Ardenne','51'),
    ('Haute-Marne','Champagne-Ardenne','52'),
    ('Mayenne','Pays de la Loire','53'),
    ('Meurthe-et-Moselle','Lorraine','54'),
    ('Meuse','Lorraine','55'),
    ('Morbihan','Bretagne','56'),
    ('Moselle','Lorraine','57'),
    ('Nièvre','Bourgogne','58'),
    ('Nord','Nord-Pas-de-Calais','59'),
    ('Oise','Picardie','60'),
    ('Orne','Basse-Normandie','61'),
    ('Pas-de-Calais','Nord-Pas-de-Calais','62'),
    ('Puy-de-Dôme','Auvergne','63'),
    ('Pyrénées-Atlantiques','Aquitaine','64'),
    ('Hautes-Pyrénées','Midi-Pyrénées','65'),
    ('Pyrénées-Orientales','Languedoc-Roussillon','66'),
    ('Bas-Rhin','Alsace','67'),
    ('Haut-Rhin','Alsace','68'),
    ('Rhône','Rhône-Alpes','69'),
    ('Haute-Saône','Franche-Comté','70'),
    ('Saône-et-Loire','Bourgogne','71'),
    ('Sarthe','Pays de la Loire','72'),
    ('Savoie','Rhône-Alpes','73'),
    ('Haute-Savoie','Rhône-Alpes','74'),
    ('Paris','Ile-de-France','75'),
    ('Seine-Maritime','Haute-Normandie','76'),
    ('Seine-et-Marne','Ile-de-France','77'),
    ('Yvelines','Ile-de-France','78'),
    ('Deux-Sèvres','Poitou-Charentes','79'),
    ('Somme','Picardie','80'),
    ('Tarn','Midi-Pyrénées','81'),
    ('Tarn-et-Garonne','Midi-Pyrénées','82'),
    ('Var','Provence-Alpes-Côte d''Azur','83'),
    ('Vaucluse','Provence-Alpes-Côte d''Azur','84'),
    ('Vendée','Pays de la Loire','85'),
    ('Vienne','Poitou-Charentes','86'),
    ('Haute-Vienne','Limousin','87'),
    ('Vosges','Lorraine','88'),
    ('Yonne','Bourgogne','89'),
    ('Territoire-de-Belfort','Franche-Comté','90'),
    ('Essonne','Ile-de-France','91'),
    ('Hauts-de-Seine','Ile-de-France','92'),
    ('Seine-Saint-Denis','Ile-de-France','93'),
    ('Val-de-Marne','Ile-de-France','94'),
    ('Val-d''Oise','Ile-de-France','95');

INSERT INTO tCapteur (id, typecapteur) VALUES
    ('PL001', 'précipitations'),
    ('PL002', 'précipitations'),
    ('PL003', 'précipitations'),
    ('METEOR001', 'autre'),
    ('METEOR002', 'autre'),
    ('TMP001', 'température'),
    ('TMP002', 'température'),
    ('VE001', 'vent'),
    ('VE002', 'vent'),
    ('VE003', 'vent');    
    
INSERT INTO tLieu (nom, couverture) VALUES
    ('Massif des Vosges', FALSE),
    ('Compiègne', TRUE),
    ('Cannes', TRUE),
    ('Paris', TRUE),
    ('Alpes', TRUE);

INSERT INTO tAffectation (nom, id, dateDebut, dateFin) VALUES
    ('Compiègne', 'VE001', '2013-01-01', '2013-05-31'),
    ('Cannes', 'METEOR001', '2010-01-01', '2020-12-31'),
    ('Compiègne', 'PL001', '2013-01-01', '2018-12-31'),
    ('Alpes', 'VE001', '2013-06-01', '2015-01-31'),
    ('Paris', 'TMP001', '2010-06-01', '2015-01-31');

INSERT INTO tMassif (fkLieu) VALUES
    ('Massif des Vosges'),
    ('Alpes');
    
INSERT INTO tBulletin (dateBulletin, periode, lieu) VALUES
    ('2013-06-04', 'matin', 'Compiègne'),
    ('2013-06-04', 'matin', 'Paris'),
    ('2013-06-04', 'matin', 'Alpes');
    
-- Prévisions de type pluie/autres
INSERT INTO tPrevision (id, datePrevision, periode, nom, description, typePrevision) VALUES
    (1, '2013-06-04', 'matin', 'Compiègne', 'Grêle attendue en Picardie','précipitations');
 
-- Prévisions de type vent
INSERT INTO tPrevision (id, datePrevision, periode, nom, description, force, direction, typePrevision) VALUES
    (2, '2013-06-04', 'matin', 'Alpes', 'RAS', 13, 'S', 'vent'),
    (3, '2013-06-04', 'matin', 'Compiègne', 'Attention, risque de chute d’arbre', 135, 'N', 'vent');
    
-- Prévisions de type température
INSERT INTO tPrevision (id, datePrevision, periode, nom, description, temp, ressenti, typePrevision) VALUES
    (4, '2013-06-04', 'matin', 'Paris', 'Beau temps, agréable', 22, 20, 'température');
    
    
INSERT INTO tVille (fkLieu, fkDepartement) VALUES
    ('Compiègne', 'Oise'),
    ('Cannes', 'Alpes-Maritimes'),
    ('Paris', 'Paris');

INSERT INTO tjMassifDepartement (massif, departement) VALUES
    ('Massif des Vosges','Vosges'),
    ('Massif des Vosges','Bas-Rhin'),
    ('Alpes','Savoie'),
    ('Alpes','Hautes-Alpes');




