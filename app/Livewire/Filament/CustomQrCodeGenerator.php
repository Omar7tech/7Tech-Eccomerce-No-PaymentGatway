<?php
namespace App\Livewire\Filament;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CustomQrCodeGenerator extends Component
{
    public string $customUrl = '';

    public function render()
    {
        $qrSvg = null;
        if (filter_var($this->customUrl, FILTER_VALIDATE_URL)) {
            $qrSvg = QrCode::size(220)->margin(2)->generate($this->customUrl);
        }
        return view('livewire.custom-qr-code-generator', [
            'qrSvg' => $qrSvg,
        ]);
    }
}