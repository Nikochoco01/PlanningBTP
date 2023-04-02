<div class="event border-rad-10 bg-color-light-gray text-color-gray margin-bottom-5px">
    <div class="event-informations">
        <p> <?= $event->worksiteName ?> </p>
        <p> <?= $event->worksiteAddress ?> </p>
        <p> <?= (new DateTime($event->eventStartTime))->format('H:m') ?> - <?= (new DateTime($event->eventEndTime))->format('H:m') ?> </p>
    </div>
    <div class="btn-container width-80 height-50px">
        <a href="<?= URLManagement::addUrlParam(array('event'=>$event->eventId))?>" class="btn-link width-80 height-50 border-rad-10 bg-color-orange text-color-gray"> détails </a>
    </div>
</div>