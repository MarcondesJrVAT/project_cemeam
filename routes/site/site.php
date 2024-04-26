<?php

use App\Livewire\Site\About\History;
use App\Livewire\Site\About\OrgChart;
use App\Livewire\Site\About\Partners;
use App\Livewire\Site\About\Projects;
use App\Livewire\Site\Contact\ContactUs;
use App\Livewire\Site\Lessons\Adult\Elementary\AdultElementaryEducation;
use App\Livewire\Site\Lessons\Adult\High\AdultHighEducation;
use App\Livewire\Site\Lessons\Elementary\ElementarySchool;
use App\Livewire\Site\Lessons\High\HighSchool;
use App\Livewire\Site\Principal\Home;
use App\Livewire\Site\Stayin\Events;
use App\Livewire\Site\Stayin\News;
use App\Livewire\Site\Stayin\Publications;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('site.home');

Route::get('/quem-somos/historico', History::class)->name('site.about.history');
Route::get('/quem-somos/organograma', OrgChart::class)->name('site.about.orgchart');
Route::get('/quem-somos/projetos', Projects::class)->name('site.about.projects');
Route::get('/quem-somos/parceirias', Partners::class)->name('site.about.partners');

Route::get('/aulas/ensino-fundamental', ElementarySchool::class)->name('site.lessons.elementary');
Route::get('/aulas/ensino-medio', HighSchool::class)->name('site.lessons.high');
Route::get('/aulas/ensino-fundamental-eja', AdultElementaryEducation::class)->name('site.lessons.elementary.eja');
Route::get('/aulas/ensino-medio-eja', AdultHighEducation::class)->name('site.lessons.high.eja');

Route::get('/fique-por-dentro/eventos', Events::class)->name('site.stayin.events');
Route::get('/fique-por-dentro/noticias', News::class)->name('site.stayin.news');
Route::get('/fique-por-dentro/publicacoes', Publications::class)->name('site.stayin.publications');

Route::get('/entre-em-contato', ContactUs::class)->name('site.contact');
