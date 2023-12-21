<?php

namespace App\Http\Controllers;

use App\Models\Subpage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
  // Handle a user subscribing to a subpage
  public function subscribe(Subpage $subpage)
  {
      $user = auth()->user();
      $user->subscriptions()->attach($subpage);

      return back();
  }

  // Handle a user unsubscribing from a subpage
  public function unsubscribe(Subpage $subpage)
  {
      $user = auth()->user();
      $user->subscriptions()->detach($subpage);

      return back();
  }
}
