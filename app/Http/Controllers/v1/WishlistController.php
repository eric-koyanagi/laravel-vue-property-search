<?php

namespace App\Http\Controllers\v1;

use App\Models\Property;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class WishlistController extends Controller
{
    public function getWishlist(Request $request)
    {
        return Property::where('wishlist_id', '1')->get();
    }

    public function addToWishlist(Request $request)
    {
        // get a default wish list instance for this sample, which doesn't have a notion of users or multiple WLs
        $wishlist = Wishlist::firstOrCreate(['id' => 1]);

        $prop = $this->getExistingProperty($request, $wishlist->id);
        if (empty($prop)) {
            $prop = Property::create([...$this->getPropertyData($request), "wishlist_id" => 1]);
        }
    }

    public function removeFromWishlist(Request $request)
    {
        $wishlist = Wishlist::firstOrCreate(['id' => 1]);
        $prop = $this->getExistingProperty($request, $wishlist->id);
        if (!empty($prop)) {
            $prop->delete();
        }
    }

    protected function getExistingProperty($request, $wishlistId)
    {
        return Property::where([...$this->getPropertyData($request), "wishlist_id" => $wishlistId])->first();
    }

    protected function getPropertyData($request) : array
    {
        return [
            'address' => $request->post('address'),
            'city' => $request->post('city'),
            'province' => $request->post('province'),
            'postal' => $request->post('postal'),
            'categories' => $request->post('categories'),
            'dateAdded' => $request->post('dateAdded'),
            'dateUpdated' => $request->post('dateUpdated'),
        ];
    }
}
