-- insert into User values (0, "bruno", "DOS SANTOS", "chevre191@jeint.com", "001122334455", 1, "administrateur");
-- insert into Login values (1, "Bruno.SANTOS", "1234");

insert into Worksite values (0, "P.O. Box 243, 8967 Nullam Rd.", "Restaurant");
insert into Worksite values (0, "8855 Eleifend Rd.", "Ecole");
insert into Worksite values (0, "Middlesbrough", "Mairie");
insert into Worksite values (0, "5037 Quisque Street", "Salle des fêtes");
insert into Worksite values (0, "1260 Laoreet, St.", "Immeuble");
insert into Worksite values (0, "487-8253 Nullam St.", "Maison de campagne");
insert into Worksite values (0, "Ap 810-5326 Enim. Av.", "Conservatoire");
insert into Worksite values (0, "6254 Suspendisse Road", "Caserne de pompier");
insert into Worksite values (0, "572-1505 Aliquam, Rd.", "Extension de l'université");
insert into Worksite values (0, "393-8638 Morbi Av.", "Entrepôt");

insert into Event values (0, "Fondations", "2023-01-23", now(), "15:00:00", "16:00:00", 2);
insert into Event values (0, "Evacuation des eaux usées", "2023-01-23", now(), "14:00:00", "16:00:00", 3);
insert into Event values (0, "Murs", "2023-01-21", "2023-01-21", "15:00:00", "16:00:00", 3);
insert into Event values (0, "Charpente", "2023-01-26", "2022-01-27", "14:00:00", "16:00:00", 4);
insert into Event values (0, "Electricité", "2023-01-30", "2023-01-30", "15:00:00", "16:00:00", 5);
insert into Event values (0, "Fondations", "2022-12-04", "2022-12-07", "14:00:00", "16:00:00", 5);
insert into Event values (0, "Sols", "2022-12-01", now(), "15:00:00", "16:00:00", 7);
insert into Event values (0, "Peintures", "2022-12-04", "2022-12-07", "14:00:00", "16:00:00", 4);
insert into Event values (0, "Tuyauterie", "2022-12-01", now(), "15:00:00", "16:00:00", 4);
insert into Event values (0, "Toit", "2022-12-04", "2022-12-07", "14:00:00", "16:00:00", 10);

call Inscription("bruno dos", "dos santos", "theshy@gmail.com", "0611223344", 1, "administrateur");
call Inscription("nikola", "chevalliot", "nikola.chevalliot@gmail.com", "0611223344", 1, "administrateur");
call Inscription("gwendal", "marseille", "jesuis@gmail.com", "0711223344", 1, "employé");
call Inscription("jean", "lyon de la marne", "adresse@gmail.com", "0711223344", 1, "responsable véhicules");
call Inscription("noah", "tokyo", "pasbien@gmail.com", "0611223344", 1, "chef d'équipe");
call Inscription("edwy", "shanghai", "pasgrave@gmail.com", "0711223344", 1, "ressources humaine");
call Inscription("valentin", "lille", "val.lille@gmail.com", "0611223344", 1, "administrateur");
call Inscription("géraldine", "gérard", "gérard@gmail.com", "0711223344", 1, "responsable matériel");
call Inscription("émilie", "onour", "emilie@gmail.com", "0611223344", 1, "administrateur");
call Inscription("rené", "kilo", "kilo@gmail.com", "0711223344", 1, "employé");

insert into Affected values (1, 2);
insert into Affected values (1, 1);
insert into Affected values (2, 1);
insert into Affected values (2, 2);
insert into Affected values (3, 5);
insert into Affected values (7, 8);
-- insert into Affected values (11, 6);
insert into Affected values (9, 3);
insert into Affected values (10, 1);
insert into Affected values (6, 9);
insert into Affected values (5, 7);
insert into Affected values (8, 7);

insert into DriverLicense values ("B", 9);

insert into Vehicle values ("AB-123-CD", "Lambo", "B", 2, "YES");
insert into Vehicle values ("ZZ-425-XY", "Ferrari", "B", 15, "NO");
INSERT INTO Vehicle (`vehicleLicensePlate`,`vehicleModel`,`vehicleDriverLicense`,`vehicleMaxPassenger`,`vehicleDisponibility`)
VALUES
  ("IT-649-ER","Calgary","B",6,"No"),
  ("AZ-147-ZE","Caldera","B",2,"Yes"),
  ("SK-504-OL","Jeongeup","B",6,"No"),
  ("CZ-443-TY","Awka","B",4,"Yes"),
  ("AT-566-LM","Kendari","B",7,"No"),
  ("IE-741-SD","Diadema","B",4,"No"),
  ("AL-224-PL","Belém","B",3,"No"),
  ("SM-836-PM","Victorias","B",6,"Yes"),
  ("SM-417-FG","Yeongju","B",6,"No"),
  ("RO-624-ND","Santander","B",4,"No");
  
insert into GoTo values ("AB-123-CD", 2);
insert into GoTo values ("ZZ-425-XY", 1);
insert into GoTo (vehicleLicensePlate, eventId) values ("IT-649-ER", 10),
	("AZ-147-ZE", 3),
    ("SK-504-OL", 4),
    ("CZ-443-TY", 5),
    ("AT-566-LM", 6),
    ("IE-741-SD", 7),
    ("SM-836-PM", 7),
    -- ("IE-741-SD", 9),
    ("AL-224-PL", 8);

insert into Equipment values ("Pelle", "105", "89");
insert into Equipment values ("Pioche", "10", "8");
insert into Equipment values ("Truelle", "321", "305"),
("Bétonnière", "21", "17"),
("Râteau", "100", "100"),
("Lampe", "80", "20"),
("Tourne vis", "121", "0"),
("Marteau", "210", "7"),
("Tuyaux", "5", "5"),
("Pince coupante", "54", "3");

CALL AffectTools(2, "Pelle", 4);
CALL AffectTools(1, "Pioche", 5);
CALL AffectTools(10, "Marteau", 1);
CALL AffectTools(3, "Pince coupante", 7);
CALL AffectTools(4, "Bétonnière", 9);
CALL AffectTools(8, "Râteau", 4);
CALL AffectTools(6, "Tourne vis", 5);
CALL AffectTools(9, "Tuyaux", 4);
CALL AffectTools(7, "Tuyaux", 1);
CALL AffectTools(7, "Pelle", 12);