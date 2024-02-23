<?php

namespace App\Service;

use App\Entity\Band;
use App\Repository\BandRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FileImportService
{
    private EntityManagerInterface $em;
    private ValidatorInterface $validator;
    private BandManager $bandManager;
    private BandRepository $bandRepository;

    public function __construct(
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        BandManager $bandManager,
        BandRepository $bandRepository
    ) {
        $this->em = $em;
        $this->validator = $validator;
        $this->bandManager = $bandManager;
        $this->bandRepository = $bandRepository;
    }

    public function importSpreadsheetData(Spreadsheet $spreadSheet): array
    {
        $arrayBrands = $spreadSheet->getActiveSheet()->toArray();
        unset($arrayBrands[0]); // Columns titles

        $names = array_map(function ($arrayBrand) {
            return $arrayBrand[0];
        }, $arrayBrands);

        $bandsToUpdate = $this->bandRepository->findByNames($names);

        $errors = [];
        foreach ($arrayBrands as $arrayBand) {

            $band = new Band();

            if (isset($bandsToUpdate[$arrayBand[0]])) {
                $band = $bandsToUpdate[$arrayBand[0]];
            }

            $band->setName($arrayBand[0]);
            $band->setCountry($arrayBand[1]);
            $band->setCity($arrayBand[2]);
            $band->setStartYear($arrayBand[3]);
            $band->setEndYear($arrayBand[4]);
            $band->setFounders($arrayBand[5]);
            $band->setMembers($arrayBand[6]);
            $band->setMusicStyle($arrayBand[7]);
            $band->setDetails($arrayBand[8]);

            $errorMessages = $this->bandManager->getBandErrorMessages($band);

            if ($errorMessages !== null) {
                $errors[] = $errorMessages;
                $this->em->detach($band);
            } else {
                $this->em->persist($band);
            }
        }

        $this->em->flush();

        return $errors;
    }
}
