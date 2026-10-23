<?php

namespace App\Providers;

use App\Models\EcosystemLink;
use App\Models\Field;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.public', function ($view) {
            $navFields = collect();
            $siteSettings = [];
            $navEcosystemLinks = collect();

            if (Schema::hasTable('fields') && Schema::hasTable('majors')) {
                $navFields = Field::with(['majors' => fn ($q) => $q->orderBy('order_index')])
                    ->orderBy('id')
                    ->get();
            }

            if (Schema::hasTable('site_settings')) {
                $siteSettings = SiteSetting::pluck('value', 'key')->toArray();
            }

            if (Schema::hasTable('ecosystem_links')) {
                $navEcosystemLinks = EcosystemLink::orderBy('order_index')->get();
            }

            $view->with([
                'navFields' => $navFields,
                'siteSettings' => $siteSettings,
                'navEcosystemLinks' => $navEcosystemLinks,
            ]);
        });
    }
}
