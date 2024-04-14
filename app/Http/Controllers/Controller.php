<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Notification;

abstract class Controller
{
    protected $categories;
    protected $notifications;

    public function __construct(Request $request)
    {

        $this->categories = Category::where('current', 1)->get();
        $this->notifications = Notification::where('current', 1)->get();

    }
}
