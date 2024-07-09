<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\GestoreFaq;

class PublicController extends Controller
{

    protected $gestFaqModel;

    public function __construct()
    {
        $this->gestFaqModel = new GestoreFaq;
    }

    public function index() : View {
        return view('home');
    }

    public function showFaq() : View {

        $faqs = $this->gestFaqModel->getFaqs();
        return view('faq')
            ->with('faqs', $faqs);
    }
}
