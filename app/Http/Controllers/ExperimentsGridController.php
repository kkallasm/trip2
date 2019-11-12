<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Support\Facades\Storage;

class ExperimentsGridController extends Controller
{
    public function index()
    {
        $photos = Content::getLatestItems('photo', 6);

        return layout('Two')
            ->with('title', 'Styles')
            ->with(
                'content',
                collect()
                    ->push(region('ExperimentalMenu'))
                    ->push(component('Title')->with('title', 'Grids'))
                    ->push(
                        component('Title')
                            ->is('small')
                            ->with('title', 'Row')
                    )
                    ->merge($this->row($photos))
                    ->br()
                    ->push(
                        component('Title')
                            ->is('small')
                            ->with('title', 'Flexbox grid I')
                    )
                    ->merge($this->grid($photos))
                    ->br()
                    ->push(
                        component('Title')
                            ->is('small')
                            ->with('title', 'Flexbox grid II')
                    )
                    ->merge($this->grid2($photos))
                    ->br()
                    ->push(
                        component('Title')
                            ->is('small')
                            ->with('title', 'Experimental CSS grid')
                    )
                    ->merge($this->grid3($photos))
            )
            ->render();
    }

    public function row($photos)
    {
        return collect()
            ->push(
                component('Code')
                    ->is('gray')
                    ->with(
                        'code',
                        "component('ExperimentalRow')
    ->with('gap', 'md') // resolves to 2 * \$spacer. Can also be a number
    ->with('items', \$photos->take(4)->map(function (\$photo) {
      return component('Title')
          ->is('smallest')
          ->with('title', \$photo->vars()->shortTitle);
  }))"
                    )
            )
            ->push(
                component('ExperimentalRow')
                    ->with('gap', 'md')
                    ->with(
                        'items',
                        $photos->take(4)->map(function ($photo) {
                            return component('Title')
                                ->is('smallest')
                                ->with('title', $photo->vars()->shortTitle);
                        })
                    )
            );
    }

    public function grid($photos)
    {
        return collect()
            ->push(
                component('Code')
                    ->is('gray')
                    ->with(
                        'code',
                        "component('Grid')
    ->with('cols', 2) // Default is 3
    ->with('items', \$photos->take(4)->...)"
                    )
            )
            ->push(
                component('Grid')
                    ->with('cols', 2)
                    ->with(
                        'items',
                        $photos->take(4)->map(function ($photo) {
                            return component('ExperimentalCard')
                                ->with('title', $photo->vars()->shortTitle)
                                ->with(
                                    'background',
                                    $photo->imagePreset('medium')
                                );
                        })
                    )
            );
    }

    public function grid2($photos)
    {
        return collect()
            ->push(
                component('Code')
                    ->is('gray')
                    ->with(
                        'code',
                        "component('Grid')
    ->with('gap', 'sm') // Resolves to 1 * \$spacer. Can be a number
    ->with('widths', '2fr 3fr 2fr') // maps to flex:2, flex:3, flex:2 columns
    ->with('items', \$photos->take(6)->...)"
                    )
            )
            ->push(
                component('Grid')
                    ->with('gap', 1)
                    ->with('widths', '2fr 3fr 2fr')
                    ->with(
                        'items',
                        $photos->take(6)->map(function ($photo) {
                            return component('ExperimentalCard')
                                ->with('title', $photo->vars()->shortTitle)
                                ->with(
                                    'background',
                                    $photo->imagePreset('medium')
                                );
                        })
                    )
            );
    }

    public function grid3($photos)
    {
        return collect()
            ->push(
                component('Body')->with(
                    'body',
                    'Only supported in <a href="https://caniuse.com/css-grid">latest browsers</a>'
                )
            )
            ->push(
                component('Code')
                    ->is('gray')
                    ->with(
                        'code',
                        "component('ExperimentalGrid')
    ->with('gap', 'sm') // Resolves to 1 * \$spacer. Can be a number
    ->with('widths', '1fr 2fr') // maps to grid-template-columns
    ->with('heights', '2fr 1fr 2fr') // maps to grid-template-rows
    ->with('items', \$photos->take(6)->...)"
                    )
            )
            ->push(
                component('ExperimentalGrid')
                    ->with('gap', 'sm')
                    ->with('widths', '1fr 2fr')
                    ->with('heights', '2fr 1fr 2fr')
                    ->with(
                        'items',
                        $photos->map(function ($photo) {
                            return component('ExperimentalCard')
                                ->with('title', $photo->vars()->shortTitle)
                                ->with(
                                    'background',
                                    $photo->imagePreset('medium')
                                );
                        })
                    )
            );
    }
}
