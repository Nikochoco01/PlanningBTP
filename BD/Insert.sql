insert into User values (0, "Bruno", "DOS SANTOS", "chevre191@gmail.com", "0411223344", 1, "administrateur");
insert into Login values (1, "Bruno.SANTOS", "1234");

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

insert into Event values (0, "Fondations", now(), now(), "15:00:00", "16:00:00", 2);
insert into Event values (0, "Evacuation des eaux usées", "2023-04-06", now(), "14:00:00", "16:00:00", 3);
insert into Event values (0, "Murs", now(), "2023-04-05", "08:00:00", "10:00:00", 3);
insert into Event values (0, "Charpente", "2023-04-04", "2023-04-04", "14:00:00", "16:00:00", 4);
insert into Event values (0, "Electricité", "2023-04-06", "2022-12-03", "15:00:00", "16:00:00", 5);
insert into Event values (0, "Fondations", now(), "2023-04-07", "14:00:00", "16:00:00", 5);
insert into Event values (0, "Sols", "2023-04-06", now(), "12:00:00", "14:00:00", 7);
insert into Event values (0, "Peintures", "2023-04-07", "2022-12-07", "14:00:00", "16:00:00", 4);
insert into Event values (0, "Tuyauterie", now(), "2023-04-06", "12:00:00", "14:00:00", 4);
insert into Event values (0, "Toit", "2023-04-06", "2023-04-06", "14:00:00", "16:00:00", 10);

call Inscription("bruno dos", "dos santos", "1theshy@gmail.com", "0311223344", null,"administrateur");
call Inscription("nikola", "chevalliot", "nikola.chevalliot@gmail.com", "0656782241", null,"administrateur");
call Inscription("niko", "chevalliot", "nikola.chevalliot@gmail.com", "0656782241", null,"employé");
call Inscription("nikola", "iokia", "tututu@gmail.com", "0211223344", null,"administrateur");
call Inscription("gwendal", "marseille", "gwen.marseille@gmail.com", "0111223344", null,"employé");
call Inscription("Jean", "de four", "j.defour@gmail.com", "0411223344", null,"responsable véhicules");
call Inscription("noah", "tokyo", "noah.tokyo@gmail.com", "0911223344", null,"chef d'équipe");
call Inscription("edwy", "shanghai", "edwy@gmail.com", "0611223344", null,"ressources humaine");
call Inscription("valentin", "lille", "val.lille@gmail.com", "0111223344", null,"administrateur");
call Inscription("géraldine", "gérard", "gérard@gmail.com", "0611223344", null,"responsable matériel");
call Inscription("emilie", "onour", "emilie@gmail.com", "0611223344", null,"administrateur");
call Inscription("René", "kilo", "kilo@gmail.com", "0511223344", null,"administrateur");

call Inscription("deft", "de four", "j.defour@gmail.com", "0411223344", null,"responsable véhicules");
call Inscription("zeka", "tokyo", "noah.tokyo@gmail.com", "0911223344", null,"chef d'équipe");
call Inscription("kingen", "shanghai", "edwy@gmail.com", "0611223344", null,"ressources humaine");
call Inscription("faker", "lille", "val.lille@gmail.com", "0111223344", null,"administrateur");
call Inscription("keria", "gérard", "gérard@gmail.com", "0611223344", null,"responsable matériel");
call Inscription("viper", "onour", "emilie@gmail.com", "0611223344", null,"administrateur");
call Inscription("theshy", "kilo", "kilo@gmail.com", "0511223344", null,"administrateur");

insert into Affected values (1, 2);
insert into Affected values (1, 1);
insert into Affected values (2, 1);
insert into Affected values (2, 2);
insert into Affected values (3, 5);
insert into Affected values (7, 8);
insert into Affected values (11, 6);
insert into Affected values (9, 3);
insert into Affected values (10, 1);
insert into Affected values (6, 9);
insert into Affected values (5, 7);
insert into Affected values (8, 7);

insert into DriverLicense values ("B", 9);

insert into Vehicle values (0, "AB-123-CD", "Lambo", "B", 2, "YES");
insert into Vehicle values (0, "ZZ-425-XY", "Ferrari", "B", 15, "NO");
INSERT INTO Vehicle (`vehicleId`, `vehicleLicensePlate`,`vehicleModel`,`vehicleDriverLicense`,`vehicleMaxPassenger`,`vehicleDisponibility`)
VALUES
  (0, "IT-649-ER","Calgary","B",6,"No"),
  (0, "AZ-147-ZE","Caldera","B",2,"Yes"),
  (0, "SK-504-OL","Jeongeup","B",6,"No"),
  (0, "CZ-443-TY","Awka","B",4,"Yes"),
  (0, "AT-566-LM","Kendari","B",7,"No"),
  (0, "IE-741-SD","Diadema","B",4,"No"),
  (0, "AL-224-PL","Belém","B",3,"No"),
  (0, "SM-836-PM","Victorias","B",6,"Yes"),
  (0, "SM-417-FG","Yeongju","B",6,"No"),
  
  (0, "AT-649-ER","Pagani","B",6,"No"),
  (0, "AE-147-ZE","Ferrari","B",2,"Yes"),
  (0, "SL-504-OL","Ferrari","B",6,"No"),
  (0, "CE-443-TY","Ferrari","B",4,"Yes"),
  (0, "AY-566-LM","Ferrari","B",7,"No"),
  (0, "IP-741-SD","Ferrari","B",4,"No"),
  (0, "AW-224-PL","Ferrari","B",3,"No"),
  (0, "SW-836-PM","Ferrari","B",6,"Yes"),
  (0, "SH-417-FG","Ferrari","B",6,"No"),
  
  (0, "RO-624-ND","Santander","B",4,"No");
  
insert into GoTo values (9, 2);
insert into GoTo values (12, 1);
insert into GoTo (vehicleId, eventId) values (1, 10),
	(2, 3),
    (3, 4),
    (4, 5),
    (5, 6),
    (6, 7),
    (7, 7),
    -- ("IE-741-SD", 9),
    (8, 8);

insert into Equipment values (0,"pelle", "105", "89");
insert into Equipment values (0,"pioche", "10", "8");
insert into Equipment values (0,"truelle", "321", "305"),
(0,"bétonnière", "21", "17"),
(0,"râteau", "100", "100"),
(0,"lampe", "80", "20"),
(0,"tourne vis", "121", "0"),
(0,"marteau", "210", "7"),
(0,"tuyaux", "5", "5"),
(0,"pince coupante", "54", "3");

CALL AffectTools(1, 1, "pelle", 4);
CALL AffectTools(2, 2,"pioche", 5);
CALL AffectTools(10, 7,"marteau", 1);
CALL AffectTools(3, 10,"pince coupante", 7);
CALL AffectTools(4, 3, "bétonnière", 9);
CALL AffectTools(8, 4,"râteau", 4);
CALL AffectTools(6, 6,"tourne vis", 5);
CALL AffectTools(9, 8,"tuyaux", 4);
CALL AffectTools(7, 8, "tuyaux", 1);
CALL AffectTools(7, 1, "pelle", 12);