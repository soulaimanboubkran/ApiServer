<?php

namespace App\Observers;

use App\Mail\ShopActivated;
use App\Models\Shop;
use Illuminate\Support\Facades\Mail;

class ShopObserver
{
    /**
     * Handle the Shop "created" event.
     */
    public function created(Shop $shop): void
    {
        //
    }

    /**
     * Handle the Shop "updated" event.
     */
    public function updated(Shop $shop)
    {
        //
    
       //check if it is changes to active 

       if($shop->getOriginal('is_active')== false && $shop->is_active == true){
        //send mail to user
        Mail::to($shop->owner)->send(new ShopActivated($shop));

        //change the role owner to seller
        $shop->owner->setRole('seller');
       }

      
    }

    /**
     * Handle the Shop "deleted" event.
     */
    public function deleted(Shop $shop): void
    {
        //
    }

    /**
     * Handle the Shop "restored" event.
     */
    public function restored(Shop $shop): void
    {
        //
    }

    /**
     * Handle the Shop "force deleted" event.
     */
    public function forceDeleted(Shop $shop): void
    {
        //
    }
}
