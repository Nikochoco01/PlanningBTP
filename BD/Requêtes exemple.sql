select * from Event e join Affected a on e.eventId = a.eventId join Worksite w on e.worksiteId = w.worksiteId; -- récupérer les évènements où il y a des travailleurs 

select * from Event e join UsedEquipment u on e.eventId = u.eventId; -- récupérer les évènements où il y a des équipements en cours d'utilisation

select * from Event e join GoTo g on e.eventId = g.eventId; -- récupérer les évènements où il y a des véhicules qui sont utilisés

select * from Affected where userId = 1; -- récupère l'ID de l'evènement où l'utilisateur 1 travaille

select * from Affected a join Event e on a.eventId = e.eventId where a.userId = 2; -- récupère les evènements où l'utilisateur 2 travaille

select * from Event; -- récupère tous les évènements

select * from Affected a join Event e on a.eventId = e.eventId where a.eventId = 4; -- récupère les employés pour un évènement donné

select * from UsedEquipment u join Event e on u.eventId = e.eventId where u.eventId = 11; -- récupère les équipements utilisés pour un évènement donné

select * from GoTo g join Event e on g.eventId = e.eventId where g.eventId = 1; -- récupère les véhicules utilisés sur un évènement donné

-- nom worksite et adresse

select * from Vehicle v left join GoTo g on v.vehicleId = g.vehicleId where g.eventId is null;

select * from GoTo;

select * from Affected;

select * from User where userId not in (select userId from Affected);

select * from User u join Affected a on u.userId = a.userId where a.userId is null;

select * from WorkTime;

select * from Event e join Affected a on e.eventId = a.eventId left outer join UsedEquipment u on e.eventId = u.eventId left outer join GoTo g on e.eventId = g.eventId;

select e.eventId, a.userId, e.worksiteId, GROUP_CONCAT(distinct(u.equipmentName)) equipment, GROUP_CONCAT(distinct(g.vehicleId)) vehicle 
from Event e join Affected a on e.eventId = a.eventId left outer join UsedEquipment u on e.eventId = u.eventId left outer join GoTo g on e.eventId = g.eventId 
group by e.eventId, a.userId, e.worksiteId; -- BIGGE Requête qui renvoie les évènements où il y a des gens qui travaille et si y a ou pas des véhicule/matériel

select * from Login;
select * from User;

select * from UsedEquipment;


select e.equipmentId , e.equipmentName , e.equipmentAvailableQuantity , e.equipmentTotalQuantity
from Equipment e left join UsedEquipment u on e.equipmentId = u.equipmentId
where e.equipmentAvailableQuantity > 0;

select * from Equipment; -- reference du nombre disponible de l'equipment
call FreeTools();        -- liberation de l'equipment affecter a un evenement fini
select * from Equipment; -- resultats

select * from Picture;
delete from Picture;

select * from Worksite;
select * from User;

select* from Event;

select * from GoTo;
select * from Vehicle;

select * from Equipment;

insert into WorkTime values (3, 21, 2, 6, 2023, "11:00");
select * from WorkTime where userId = 3 and workTimeWeek = 4 order by workTimeDay ASC;

select * from Picture where pictureId=3 limit 1;

select * from User where userId = (select userId from Login where loginUsername= "nikola.iokia" and loginUserPassword = sha1(1234));

update User  set userFirstName = "bruno" , userLastName = "DOS SANTOS", userMail = "rzea@gmail.com" , userPhone = "0605010456", pictureId = 3 , userPosition = "administrateur" where userId = 3;

select * from Vehicle;

select * from Event where eventEndDate >= now() and eventStartDate <= now();

select * from Affected;