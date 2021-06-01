<?php

namespace App\Providers;

use App\Repositories\CourseOnlineSource\CourseOnlineSourceEloquentRepository;
use App\Repositories\CourseOnlineSource\CourseOnlineSourceRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Paygates\PaygateRepositoryInterface::class,
            \App\Repositories\Paygates\PaygateEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Widgets\WidgetRepositoryInterface::class,
            \App\Repositories\Widgets\WidgetEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Users\UserRepositoryinterface::class,
            \App\Repositories\Users\UserEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Menus\MenusRepositoryInterface::class,
            \App\Repositories\Menus\MenusEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Pages\PagesRepositoryInterface::class,
            \App\Repositories\Pages\PagesEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\CourseOnline\CourseOnlineRepositoryInterface::class,
            \App\Repositories\CourseOnline\CourseOnlineEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\CourseLevels\CourseLevelsRepositoryInterface::class,
            \App\Repositories\CourseLevels\CourseLevelsEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\CourseThematics\CourseThematicsRepositoryInterface::class,
            \App\Repositories\CourseThematics\CourseThematicsEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\CourseFrees\CourseFreeQuizsRepositoryInterface::class,
            \App\Repositories\CourseFrees\CourseFreesEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Questions\QuestionsRepositoryInterface::class,
            \App\Repositories\Questions\QuestionsEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contacts\ContactsRepositoryInterface::class,
            \App\Repositories\Contacts\ContactsEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Reviews\ReviewsRepositoryInterface::class,
            \App\Repositories\Reviews\ReviewsEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\NewCurriculums\NewCurriculumsRepositoryInterface::class,
            \App\Repositories\NewCurriculums\NewCurriculumsEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Documentations\DocumentationsRepositoryInterface::class,
            \App\Repositories\Documentations\DocumentationsEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\DocResources\DocResourcesRepositoryInterface::class,
            \App\Repositories\DocResources\DocResourceEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\CoursePurchase\CoursePurchaseRepositoryInterface::class,
            \App\Repositories\CoursePurchase\CoursePurchaseEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Vocabularies\VocabulariesRepositoryInterface::class,
            \App\Repositories\Vocabularies\VocabulariesEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\CourseLevelSources\CourseLevelSourcesRepositoryInterface::class,
            \App\Repositories\CourseLevelSources\CourseLevelSourcesEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\CourseThematicsSource\CourseThematicSourcesRepositoryInterface::class,
            \App\Repositories\CourseThematicsSource\CourseThematicSourcesEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\CourseFreeSources\CourseFreeSourcesRepositoryInterface::class,
            \App\Repositories\CourseFreeSources\CourseFreeSourceEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\QuestionDetails\QuestionDetailsRepositoryInterface::class,
            \App\Repositories\QuestionDetails\QuestionDetailsEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\CourseLevelQuizs\CourseLevelQuizsRepositoryInterface::class,
            \App\Repositories\CourseLevelQuizs\CourseLevelQuizsEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\CourseFrees\CourseFreesRepositoryInterface::class,
            \App\Repositories\CourseFrees\CourseFreesEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\CourseFreeQuizs\CourseFreeQuizsRepositoryInterface::class,
            \App\Repositories\CourseFreeQuizs\CourseFreeQuizsEloquentRepository::class
        );
        $this->app->bind(
            CourseOnlineSourceRepositoryInterface::class,
            CourseOnlineSourceEloquentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
