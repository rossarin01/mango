<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\approve;

class ApprovesController extends Controller
{
    // Method สำหรับแสดงหน้าสำหรับ CheckIn
    public function checkin(Request $request)
    {
        if ($request->is('approves/mangococo/front/*')) {
            return view('approves.mangococo.front.checkin.index');
        } elseif ($request->is('approves/mangococo/dessert/*')) {
            return view('approves.mangococo.dessert.checkin.index');
        } elseif ($request->is('approves/mangococo/kitchen/*')) {
            return view('approves.mangococo.kitchen.checkin.index');
        } elseif ($request->is('approves/mangococo/bakery/*')) {
            return view('approves.mangococo.bakery.checkin.index');
        } elseif ($request->is('approves/mangococo/office/*')) {
            return view('approves.mangococo.office.checkin.index');
        } elseif ($request->is('approves/flyingtigress/*')) {
            return view('approves.flyingtigress.checkin.index');
        } elseif ($request->is('approves/redwork/myer/*')) {
            return view('approves.redwork.myer.checkin.index');
        } elseif ($request->is('approves/redwork/macquarie/*')) {
            return view('approves.redwork.macquarie.checkin.index');
        }
        return abort(404);
    }

    // Method สำหรับแสดงหน้าสำหรับ CheckOut
    public function checkout(Request $request)
    {
        if ($request->is('approves/mangococo/front/*')) {
            return view('approves.mangococo.front.checkout.index');
        } elseif ($request->is('approves/mangococo/dessert/*')) {
            return view('approves.mangococo.dessert.checkout.index');
        } elseif ($request->is('approves/mangococo/kitchen/*')) {
            return view('approves.mangococo.kitchen.checkout.index');
        } elseif ($request->is('approves/mangococo/bakery/*')) {
            return view('approves.mangococo.bakery.checkout.index');
        } elseif ($request->is('approves/mangococo/office/*')) {
            return view('approves.mangococo.office.checkout.index');
        } elseif ($request->is('approves/flyingtigress/*')) {
            return view('approves.flyingtigress.checkout.index');
        } elseif ($request->is('approves/redwork/myer/*')) {
            return view('approves.redwork.myer.checkout.index');
        } elseif ($request->is('approves/redwork/macquarie/*')) {
            return view('approves.redwork.macquarie.checkout.index');
        }
        return abort(404);
    }

    // Method สำหรับแสดงหน้าสำหรับ BreakStart
    public function breakstart(Request $request)
    {
        if ($request->is('approves/mangococo/front/*')) {
            return view('approves.mangococo.front.breakstart.index');
        } elseif ($request->is('approves/mangococo/dessert/*')) {
            return view('approves.mangococo.dessert.breakstart.index');
        } elseif ($request->is('approves/mangococo/kitchen/*')) {
            return view('approves.mangococo.kitchen.breakstart.index');
        } elseif ($request->is('approves/mangococo/bakery/*')) {
            return view('approves.mangococo.bakery.breakstart.index');
        } elseif ($request->is('approves/mangococo/office/*')) {
            return view('approves.mangococo.office.breakstart.index');
        } elseif ($request->is('approves/flyingtigress/*')) {
            return view('approves.flyingtigress.breakstart.index');
        } elseif ($request->is('approves/redwork/myer/*')) {
            return view('approves.redwork.myer.breakstart.index');
        } elseif ($request->is('approves/redwork/macquarie/*')) {
            return view('approves.redwork.macquarie.breakstart.index');
        }
        return abort(404);
    }

    // Method สำหรับแสดงหน้าสำหรับ BreakEnd
    public function breakend(Request $request)
    {
        if ($request->is('approves/mangococo/front/*')) {
            return view('approves.mangococo.front.breakend.index');
        } elseif ($request->is('approves/mangococo/dessert/*')) {
            return view('approves.mangococo.dessert.breakend.index');
        } elseif ($request->is('approves/mangococo/kitchen/*')) {
            return view('approves.mangococo.kitchen.breakend.index');
        } elseif ($request->is('approves/mangococo/bakery/*')) {
            return view('approves.mangococo.bakery.breakend.index');
        } elseif ($request->is('approves/mangococo/office/*')) {
            return view('approves.mangococo.office.breakend.index');
        } elseif ($request->is('approves/flyingtigress/*')) {
            return view('approves.flyingtigress.breakend.index');
        } elseif ($request->is('approves/redwork/myer/*')) {
            return view('approves.redwork.myer.breakend.index');
        } elseif ($request->is('approves/redwork/macquarie/*')) {
            return view('approves.redwork.macquarie.breakend.index');
        }
        return abort(404);
    }
}
