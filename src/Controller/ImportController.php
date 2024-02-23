<?php

namespace App\Controller;

use App\Service\FileImportService;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ImportController extends AbstractController
{
    private const MIME_TYPE_XLSX = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

    #[Route('/import', name: 'import_file', options: ['expose' => true], methods: ['POST'])]
    public function importFile(Request $request, FileImportService $fileImportService): JsonResponse
    {
        if (!$request->files->count() > 0) {
            throw new BadRequestException('No file received.');
        }

        /** @var UploadedFile $file */
        $file = $request->files->all()[array_key_first($request->files->all())];

        if ($file->getMimeType() !== self::MIME_TYPE_XLSX) {
            throw new BadRequestException('.xlsx files are currently the only ones supported.');
        }

        $reader = new Xlsx();
        /** @var Spreadsheet $spreadsheet */
        $spreadsheet = $reader->load($file->getRealPath());
        $errors = $fileImportService->importSpreadsheetData($spreadsheet);

        if (count($errors) > 0) {
            return new JsonResponse($errors);
        }

        return new JsonResponse();
    }
}
