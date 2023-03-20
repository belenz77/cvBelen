<?php
//para que retorne un json en vez de un twig

namespace App\Controller;

use App\Entity\Proyecto;
use App\Form\ProyectoType;
use App\Repository\ProyectoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//importamos todo loq que necesita para funcionar
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

#[Route('/apiproyecto')]
class ApiController extends AbstractController
{
    #[Route('/list', name: 'app_apiproyecto_index', methods: ['GET'])]
    public function index(ProyectoRepository $proyectoRepository): Response
    {
        // dump( $proyectoRepository);
        // die;
        $portfolio = $proyectoRepository->findAll();
        $data = [];
        foreach ($portfolio as $p) {
            $data[] = [
                'id' => $p->getId(),
                'descripcion' => $p->getDescripcion(),
                'nombre' => $p->getNombre(),
                'imagen'=> $p  ->getImagen()              

            ];
        }
        //dump($data);die;
        return $this->json($data);
        return $this->json($data, $status = 200, $headers = ['Access-Control-Allow-Origin'=>'*']);
    }
    }



