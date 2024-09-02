<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePDF()
    {
        $pdf = FacadePdf::loadView('myPDF')->setPaper('A4', 'portrait');

        return $pdf->stream('hdtuto.pdf');
    }
}
