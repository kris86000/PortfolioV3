<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class CVController extends AbstractController
{
    #[Route('/cv', name: 'app_cv')]
    public function index(): Response
    {
        return $this->render('cv/index.html.twig', [
            'controller_name' => 'CVController',
        ]);
    }

    #[Route('/dl-cv', name: 'dl_cv')]
    public function telechargerCvPdf(): Response
    {
        $fichier = "CV-baudouinChristopher.pdf"; // Nom du fichier PDF
        $cheminFichier = $this->getParameter('kernel.project_dir') . '/public/assets/images/' . $fichier; // Chemin vers le fichier PDF

        if (!file_exists($cheminFichier)) {
            throw $this->createNotFoundException('Le fichier CV n\'a pas été trouvé.');
        }

        return $this->file($cheminFichier, $fichier, ResponseHeaderBag::DISPOSITION_ATTACHMENT);
    }
}
