<?php

namespace App\Service;

use App\Entity\Band;
use App\Repository\BandRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BandManager
{
    private ValidatorInterface $validator;
    private BandRepository $bandRepository;

    public function __construct(ValidatorInterface $validator, BandRepository $bandRepository)
    {
        $this->validator = $validator;
        $this->bandRepository = $bandRepository;
    }

    /**
     * This have to work in create and update context
     * @param object $object supposed to follow Band properties name (camelCase mandatory)
     * @param Band &$band
     * @return ?string errors list if any
     */
    public function fillDataAndApplyVerifications(object $object, Band &$band): ?string
    {
        $bandProperties = ['name', 'country', 'city', 'startYear', 'details'];
        foreach ($bandProperties as $property) {
            if (isset($object->{$property})) {
                $band->{"set" . ucfirst($property)}($object->{$property});
            }
        }

        $nullableProperties = ['endYear', 'founders', 'members', 'musicStyle'];
        foreach ($nullableProperties as $property) {
            $value = $object->{$property} ?? null;
            $currentValue = $band->{"get" . ucfirst($property)}();

            if ($value !== $currentValue && $value !== null) {
                $band->{"set" . ucfirst($property)}($value);
            }
        }

        $errors = $this->validator->validate($band);

        $errorMessage = null;
        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();

            }

            $errorMessage = implode(' ', $messages);
        }

        return $errorMessage;
    }

    public function fetchAndCheckBandById(int $id): Band
    {
        $band = $this->bandRepository->find($id);

        if ($band === null) {
            throw new NotFoundHttpException();
        }

        return $band;
    }
}
