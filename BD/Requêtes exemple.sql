select * from Event e join Affected a on e.eventId = a.eventId join Worksite w on e.worksiteId = w.worksiteId; -- récupérer les évènements où il y a des travailleurs 

select * from Event e join UsedEquipment u on e.eventId = u.eventId; -- récupérer les évènements où il y a des équipements en cours d'utilisation

select * from Event e join GoTo g on e.eventId = g.eventId; -- récupérer les évènements où il y a des véhicules qui sont utilisés

select * from Affected where userId = 1; -- récupère l'ID de l'evènement où l'utilisateur 1 travaille

select * from Affected a join Event e on a.eventId = e.eventId where a.userId = 2; -- récupère les evènements où l'utilisateur 2 travaille

select * from Event; -- récupère tous les évènements

select * from Affected a join Event e on a.eventId = e.eventId where a.eventId = 1; -- récupère les employés pour un évènement donné

select * from UsedEquipment u join Event e on u.eventId = e.eventId where u.eventId = 1; -- récupère les équipements utilisés pour un évènement donné

select * from GoTo g join Event e on g.eventId = e.eventId where g.eventId = 12; -- récupère les véhicules utilisés sur un évènement donné

-- nom worksite et adresse

select * from WorkTime;

select * from Event e join Affected a on e.eventId = a.eventId left outer join UsedEquipment u on e.eventId = u.eventId left outer join GoTo g on e.eventId = g.eventId;

select e.eventId, a.userId, e.worksiteId, GROUP_CONCAT(distinct(u.equipmentName)) equipment, GROUP_CONCAT(distinct(g.vehicleLicensePlate)) vehicle 
from Event e join Affected a on e.eventId = a.eventId left outer join UsedEquipment u on e.eventId = u.eventId left outer join GoTo g on e.eventId = g.eventId
where e.eventId = 1
group by e.eventId, a.userId, e.worksiteId; -- BIGGE Requête qui renvoie les évènements où il y a des gens qui travaille et si y a ou pas des véhicule/matériel

select * from Login;
select * from User;

select distinct * from Worksite where worksiteId = 2;

select * from UsedEquipment;

select * from Equipment; -- reference du nombre disponible de l'equipment
call FreeTools();        -- liberation de l'equipment affecter a un evenement fini
select * from Equipment; -- resultats

select * from Picture;

select * from Event;

select distinct * from Event e join Worksite w on w.worksiteId = e.worksiteId where eventStartDate between '2023-01-29' and '2023-01-31' order by e.eventStartTime asc;

update Event set eventDescription = testupdate , eventStartDate = '2023-01-30' , eventEndDate = '2023-01-31' , eventStartTime = '11:00' , eventEndTime = '15:00' where eventId = 1;