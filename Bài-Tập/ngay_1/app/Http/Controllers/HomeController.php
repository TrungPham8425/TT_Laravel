<?php
// Controller này dùng để test TranslatorInterface
namespace App\Http\Controllers;

use App\Contracts\TranslatorInterface;

class HomeController extends Controller
{
    protected TranslatorInterface $translator;

    // Inject TranslatorInterface qua constructor
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    // Trả về thông báo greeting
    public function index()
    {
        return response()->json([
            'message' => $this->translator->greeting(),
        ]);
    }
}
