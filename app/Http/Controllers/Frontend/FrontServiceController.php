<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\InnovationService;
use App\Models\InnovationServiceItem;
use App\Models\Service;
use App\Models\ServiceCard;
use Illuminate\Http\Request;

class FrontServiceController extends Controller
{

    public function index()
    {
        $service_intro = Service::languages(app()->getLocale())->first();
        $innovation = InnovationService::languages(app()->getLocale())->first();
        $limited_items = InnovationServiceItem::limited_items(app()->getLocale());
        $row_items = InnovationServiceItem::row_items(app()->getLocale());
        $service_cards = ServiceCard::languages(app()->getLocale());
        return view('pages.services.services',compact('limited_items','innovation','service_intro','row_items','service_cards'));
    }
    public function read_more($id)
    {
        $card = ServiceCard::read(app()->getLocale(),$id);
        return view('pages.services.read_more',compact('card'));
    }
}
