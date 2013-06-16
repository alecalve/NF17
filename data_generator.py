# -*- coding: utf-8 -*-

# Args :
#   1: csv des lieux
#   2: fichier de sortie

#   /!\ C’est très sale

import sys
import random
import datetime

class Table:
    
    def __init__(self, nom, *champs):
        self.nom = nom
        self.attr = []
        self.rows = []
        for champ in champs:
            self.attr.append(champ)
        self.attr = sorted(self.attr)
        
    def add(self, **kwargs):
        self.rows.append(kwargs)
        
    def output(self):
        head = "INSERT INTO %s (%s) VALUES\n" % (self.nom, ", ".join(self.attr))
        body = str()
        for ind, row in enumerate(self.rows):
            if ind != len(self.rows) - 1:
                body += "   ('"+_output_row(row)+"'),\n"
            else:
                body += "   ('"+_output_row(row)+"');\n\n"
        return head + body
        
        
def _output_row(row):
    out = []
    for key in sorted(row):
        out.append(str(row[key]))
    return "', '".join(out)
    
def load_csv(filename):
    fich = open(filename, "r")
    data = fich.read()
    fich.close()
    return filter(None, data.split("\n"))
    
def load_lieux(filename):
    for lieu in load_csv(filename):
        lieu = lieu.split(",")
        rel_lieu_temp[lieu[1]] = lieu[-3]
        rel_lieu_vent[lieu[1]] = lieu[-2]
        rel_lieu_pluie[lieu[1]] = lieu[-1]
        lieux.add(nom=lieu[1], couverture="TRUE")
        if lieu[0] == "M":
            massifs.add(fkLieu=lieu[1])
            for dep in lieu[2:]:
                try:
                    int(dep)
                except ValueError:
                    tjmassifsdeps.add(massif=lieu[1], departement=dep)
        if lieu[0] == "V":
            villes.add(fkLieu=lieu[1], fkDepartement=lieu[2])
    
def complete(n, l):
    return "0"*(l-len(n))+n

def gen_capteurs():
    prefixes = ["PL", "TMP", "VE"]
    types = ["précipitations", "température", "vent"]
    n = 1
    for lieu in lieux.rows:
        for i in range(1,4):
            capteur_id = prefixes[i-1]+complete(str(n), 3)
            n += 1
            capteurs.add(id=capteur_id, typeCapteur=types[i-1])
            affectations.add(id=capteur_id, nom=lieu["nom"], dateDebut="2010-01-01", dateFin="2020-12-31")
        
def to_datetime(date):
    date = date.split("-")
    return datetime.date(int(date[0]), int(date[1]), int(date[2])) 
    
def gen_previsions(start, end):
    start = to_datetime(start)
    end = to_datetime(end)
    while start != end:
        for affect in affectations.rows:
            date = "-".join([str(start.year), str(start.month), str(start.day)])
            for periode in periodes:
                if {'periode': periode, 'dateBulletin': date, 'lieu': affect["nom"]} not in bulletins.rows:
                    bulletins.add(dateBulletin=date, periode=periode, lieu=affect["nom"])
                if (affect["id"].startswith("TMP")):
                    temp = int(random.gauss(int(rel_lieu_temp[affect["nom"]]), 1))
                    prevs_temp.add(datePrevision=date, periode=periode, nom=affect["nom"], temp=temp, 
                                   ressenti=temp, description="RAS", typePrevision="température")
                elif (affect["id"].startswith("VE")):
                    force = int(random.gauss(int(rel_lieu_vent[affect["nom"]]), 1))
                    direction = random.sample(["N", "S", "E", "O"], 1)[0]
                    prevs_vent.add(datePrevision=date, periode=periode, nom=affect["nom"], direction=direction, 
                                   force=force, description="RAS", typePrevision="vent")
                elif (affect["id"].startswith("PL")):
                    if (random.randint(0,3) == 0):
                        hauteur = int(random.gauss(int(rel_lieu_pluie[affect["nom"]]), 1))
                        prevs_pluie.add(datePrevision=date, periode=periode, nom=affect["nom"], hauteur=hauteur, typePrecipitation="pluie",
                                        description="RAS", typePrevision="précipitations")
        start = start + datetime.timedelta(1)
        
lieux = Table("tLieu", "nom", "couverture")
capteurs = Table("tCapteur", "id", "typeCapteur")
villes = Table("tVille", "fkLieu", "fkDepartement")
massifs = Table("tMassif", "fkLieu")
affectations = Table("tAffectation", "dateDebut", "dateFin", "nom", "id")
bulletins = Table("tBulletin", "dateBulletin", "periode", "lieu")
prevs_autre = Table("tPrevision", "datePrevision", "periode", "nom", "description", "typePrevision")
prevs_vent = Table("tPrevision", "datePrevision", "periode", "nom", "force", "direction", "description", "typePrevision")
prevs_temp = Table("tPrevision", "datePrevision", "periode", "nom", "temp", "ressenti", "description", "typePrevision")
prevs_pluie = Table("tPrevision", "datePrevision", "periode", "nom", "hauteur", "typePrecipitation", "description", "typePrevision")
tjmassifsdeps = Table("tjMassifDepartement", "massif", "departement")
rel_lieu_temp = {}
rel_lieu_vent = {}
rel_lieu_pluie = {}
periodes = ["matin", "après-midi", "soirée", "nuit"]
load_lieux(sys.argv[1])
gen_capteurs()
gen_previsions("2013-06-16", "2013-06-20")

prepend = """INSERT INTO tRegion VALUES 
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
    ('Val-d''Oise','Ile-de-France','95');\n\n"""
    
out = open(sys.argv[2], "w")
out.write(prepend)
out.write(lieux.output())
out.write(villes.output())
out.write(massifs.output())
out.write(capteurs.output())
out.write(affectations.output())
out.write(tjmassifsdeps.output())
out.write(bulletins.output())
out.write(prevs_temp.output())
out.write(prevs_vent.output())
out.write(prevs_pluie.output())
out.close()

