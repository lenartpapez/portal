<?php

namespace App\Http\Controllers\FrontPage;

use App\Company;
use App\Http\Controllers\Controller;
use App\Institute;
use App\Srip;
use Illuminate\Http\Request;

class SripController extends Controller
{
    public function index($number, $slug)
    {
        $items = $this->getDropdownItems($number, $slug);
        return view('pages.srip/' . $slug, compact("items", "number", "slug"));
    }

    public function getSrips()
    {
        $srips = Srip::all();
        return view('pages.fields.index', compact('srips'));
    }

    public function getFieldsAndGoals($id)
    {
        $srips = Srip::all();
        $fields = Srip::findOrFail($id)->fields()->with('goals')->get();
        return view('pages.fields.index', compact('srips', 'fields'));
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
        return view('pages.srip/' . $slug, compact("items", "item", "number", "slug"));
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
        return $items->unique('id');
    }

    public function getResults($number, $slug, $itemId, $goalId)
    {
        $items = $this->getDropdownItems($number, $slug);
        if ($slug === 'institutes') {
            $class = Institute::class;
            $relatedClass = Company::class;
        } else {
            $class = Company::class;
            $relatedClass = Institute::class;
        }
        $item = $class::findOrFail($itemId);
        $goal = $item->goals()->where('id', '=', $goalId)->firstOrFail();
        $related = $relatedClass::whereHas("goals", function ($query) use ($goalId) {
            $query->where("id", $goalId);
        })->get();
        return view('pages.srip/' . $slug, compact("related", "goal", "items", "item", "number", "slug"));
    }
}
