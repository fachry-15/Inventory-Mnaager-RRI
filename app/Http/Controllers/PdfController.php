<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use App\Models\barang;
use App\Models\TicketPerawatan;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePDF()
    {

        $barangs =  barang::with('ruangans', 'kategori')->get();

        $pdf = FacadePdf::loadView('myPDF', compact('barangs'))->setPaper('A4', 'portrait');

        return $pdf->stream('hdtuto.pdf');
    }

    public function generatePDFbarcode()
    {
        $barangs =  barang::all();
        $pdf = FacadePdf::loadView('barcodePDF', compact('barangs'))->setPaper('A4', 'portrait');

        return $pdf->stream('Barcode.pdf');
    }

    public function ticketmaintenance($id)
    {
        // Ambil data barang berdasarkan ID
        $ticket = TicketPerawatan::with('barang')->findOrFail($id);

        // Buat PDF menggunakan data barang
        $pdf = FacadePdf::loadView('maintenancetickets', compact('ticket'))->setPaper('portrait');

        return $pdf->stream('TicketMaintenance.pdf');
    }
}
