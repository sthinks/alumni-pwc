<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Anasayfa
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Anasayfa', route('home'));
});

// Anasayfa > Profil
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Profil', route('profile.index'));
});

// Anasayfa > Community
Breadcrumbs::for('community', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Alumni Topluluğu', route('community.index'));
});

// Anasayfa > Knowledge and Development
Breadcrumbs::for('knowledge', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Knowledge And Development', route('knowledge.index'));
});

// Anasayfa > Knowledge and development > [Knowledge and Development]
Breadcrumbs::for('knowledge-detail', function (BreadcrumbTrail $trail, $knowledge) {
    $trail->parent('knowledge');
    $trail->push($knowledge->knowledge_title, route('knowledge.show', $knowledge));
});

// Anasayfa > Event
Breadcrumbs::for('event', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Etkinlikler', route('events.index'));
});

// Anasayfa > Event > [Event]
Breadcrumbs::for('event-detail', function (BreadcrumbTrail $trail, $event) {
    $trail->parent('event');
    $trail->push($event->event_title, route('events.show', $event));
});

// Anasayfa > Hobbies
Breadcrumbs::for('hobbies', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Hobi Kulüpleri', route('hobbies.index'));
});

// Anasayfa > Hobbies > [Hobby]
Breadcrumbs::for('hobby-detail', function (BreadcrumbTrail $trail, $hobby) {
    $trail->parent('hobbies');
    $trail->push($hobby->hobby_title, route('hobbies.show', $hobby));
});

// Anasayfa > Campaign
Breadcrumbs::for('campaign', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Ayrıcalıklar', route('campaign.index'));
});

// Anasayfa > Campaign > [Campaign]
Breadcrumbs::for('campaign-detail', function (BreadcrumbTrail $trail, $campaign) {
    $trail->parent('campaign');
    $trail->push($campaign->campaign_title, route('campaign.show', $campaign));
});

// Anasayfa > Announcement
Breadcrumbs::for('announcement', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Duyurular', route('announcement.index'));
});

// Anasayfa > Announcement > [Announcement]
Breadcrumbs::for('announcement-detail', function (BreadcrumbTrail $trail, $announcement) {
    $trail->parent('announcement');
    $trail->push($announcement->announcement_title, route('announcement.show', $announcement));
});

// Anasayfa > Media
Breadcrumbs::for('media', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Hatırlı Sohbetler', route('media.index'));
});

// Anasayfa > Media > [Media]
Breadcrumbs::for('media-detail', function (BreadcrumbTrail $trail, $media) {
    $trail->parent('home');
    $trail->push($media->media_title, route('media.show', $media));
});

// Anasayfa > Jobs
Breadcrumbs::for('jobs', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('İş İlanları', route('jobs.index'));
});

// Anasayfa > Jobs > [Jobs]
Breadcrumbs::for('jobs-detail', function (BreadcrumbTrail $trail, $job) {
    $trail->parent('jobs');
    $trail->push($job->job_title, route('jobs.show', $job));
});

// Anasayfa > Chat
Breadcrumbs::for('chat', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Alumni Chat', route('chat.index'));
});

// Anasayfa > Chat > [Chat]
Breadcrumbs::for('chat-detail', function (BreadcrumbTrail $trail, $friend) {
    $trail->parent('chat');
    $trail->push($friend->name, route('chat.show', $friend));
});

// Anasayfa > Yasal Uyarı
Breadcrumbs::for('yasaluyari', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Yasal Uyarı', route('legal.yasaluyari'));
});

// Anasayfa > Üyelik Sözleşmesi
Breadcrumbs::for('uyeliksözlesmesi', function (BreadcrumbTrail $trail) {
    $trail->parent('yasaluyari');
    $trail->push('Üyelik Sözleşmesi', route('legal.uyeliksozlesmesi'));
});

// Anasayfa >Aydınlatma Metni
Breadcrumbs::for('aydinlatma', function (BreadcrumbTrail $trail) {
    $trail->parent('yasaluyari');
    $trail->push('Aydınlatma Metni', route('legal.aydinlatma'));
});

// Anasayfa > Açık Rıza Metni
Breadcrumbs::for('acikriza', function (BreadcrumbTrail $trail) {
    $trail->parent('yasaluyari');
    $trail->push('Açık Rıza Metni', route('legal.acikriza'));
});
