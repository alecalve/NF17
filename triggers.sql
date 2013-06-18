CREATE OR REPLACE FUNCTION function_insert_prevision() RETURNS TRIGGER AS $insert_prevision$
DECLARE
    autre tPrevision.typePrevision%TYPE;
BEGIN
    autre := 'autre';
    IF (SELECT periode FROM tBulletin B WHERE dateBulletin = NEW.datePrevision 
    AND lieu = NEW.nom AND B.periode = NEW.periode) IS NULL THEN

        INSERT INTO tBulletin
        VALUES(NEW.datePrevision, NEW.periode, NEW.nom);

    END IF;
    
    --Pas plus d’une prévision de type temp, vent ou pluie par bulletin
    IF NEW.typePrevision = autre THEN
        RETURN NEW;
    ELSE
        IF (SELECT COUNT(*) FROM tPrevision WHERE datePrevision = NEW.datePrevision
        AND nom = NEW.nom AND periode = NEW.periode AND typePrevision = NEW.typePrevision) >= 1 THEN
            RETURN NULL;
        ELSE
            RETURN NEW;
        END IF;
    END IF;
END;
$insert_prevision$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION function_delete_lieu() RETURNS TRIGGER AS $delete_lieu$
BEGIN
    UPDATE tAffectation SET dateFin = current_date - integer '1' WHERE dateFin > current_date
    AND nom = OLD.nom;
    RETURN OLD;
END;
$delete_lieu$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION function_insert_affectation() RETURNS TRIGGER AS $insert_affect$
BEGIN
	IF (SELECT nom FROM tLieu L WHERE nom = NEW.nom) IS NULL THEN
		RETURN NULL;
	END IF;
    -- On vérifie qu'un même capteur ne puisse être affecté à deux lieux pour des périodes non disjointes
    IF (SELECT dateDebut FROM tAffectation A WHERE id = NEW.id AND dateFin > NEW.dateDebut) IS NOT NULL THEN
        RETURN NULL;
    
    ELSE
        -- On update la couverture du lieu
        UPDATE tLieu L SET couverture = true WHERE L.nom = NEW.nom;
        RETURN NEW;
    END IF;

END;
$insert_affect$ LANGUAGE plpgsql;


    
CREATE TRIGGER trigger_insert_affect
BEFORE INSERT ON tAffectation
    FOR EACH ROW EXECUTE PROCEDURE function_insert_affectation();
    
CREATE TRIGGER trigger_insert_prevision
BEFORE INSERT ON tPrevision
    FOR EACH ROW EXECUTE PROCEDURE function_insert_prevision();

CREATE TRIGGER trigger_delete_lieu
BEFORE DELETE ON tLieu
    FOR EACH ROW EXECUTE PROCEDURE function_delete_lieu();


