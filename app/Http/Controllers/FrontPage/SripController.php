<?php

namespace App\Http\Controllers\FrontPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institute;
use App\Company;
use App\Srip;

class SripController extends Controller
{
    public function index($number, $slug)
    {
        $items = $this->getDropdownItems($number, $slug);

        return view('pages.srip/'.$slug, compact("items", "number", "slug"));
    }

    public function show(Request $request, $number, $slug, $id)
    {
        $items = $this->getDropdownItems($number, $slug);
        $item = null;
        $items->each(function ($sripItem) use ($id, &$item) {
            if ($id == $sripItem->id) {
                $item = $sripItem;
            }
        });

        $goals = $item->goals->pluck("id");

        if (get_class($item) === Company::class) {
            $relatedClass = Institute::class;
        } else {
            $relatedClass = Company::class;
        }

        $related = $relatedClass::whereHas("goals", function ($query) use ($goals) {
            $query->whereIn("id", $goals);
        })->get();

        return view('pages.srip/'.$slug, compact("items", "related", "item", "number", "slug"));
    }

    /**
     * Get dropdown items
     *
     * @param int $number
     * @param string $slug
     * @return void
     */
    private function getDropdownItems($number, $slug)
    {
        $srip = Srip::whereName("SRIP$number")->with("fields.goals.$slug")->first();

        $items = collect();

        if ($srip) {
            $srip->fields->each(function ($field) use (&$items, $slug) {
                $field->goals->each(function ($goal) use (&$items, $slug) {
                    $items = $items->concat($goal->{$slug});
                });
            });
        }

        return $items;
    }
}
