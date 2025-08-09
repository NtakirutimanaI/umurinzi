<?php

namespace App\Exports;

use App\Models\Device;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class DevicesExport implements FromCollection, WithHeadings, WithStyles, WithDrawings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = Device::with(['client', 'technician']);

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        $devices = $query->get();

        return $devices->map(function ($device) {
            return [
                $device->client->name ?? 'N/A',
                $device->client->phone ?? 'N/A',
                $device->brand,
                $device->model,
                $device->serial_number,
                ucfirst($device->status),
                $device->technician->name ?? 'Unassigned',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Client Name',
            'Phone',
            'Brand',
            'Model',
            'Serial #',
            'Status',
            'Technician Name',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Company Logo');
        $drawing->setPath(public_path('images/company_logo.png')); // path to your logo
        $drawing->setHeight(70);
        $drawing->setCoordinates('A1');

        return [$drawing];
    }
}
